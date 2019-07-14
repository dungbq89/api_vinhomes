<?php

require_once dirname(__FILE__).'/../lib/adArticlesEditorGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adArticlesEditorGeneratorHelper.class.php';


class adArticlesEditorActions extends autoAdArticlesEditorActions
{
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
        {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page'))
        {
            $this->setPage($request->getParameter('page'));
        }
        else
        {
            $this->setPage(1);
        }

        // max per page
        if ($request->getParameter('max_per_page'))
        {
            $this->setMaxPerPage($request->getParameter('max_per_page'));
        }else{
            $this->setMaxPerPage(10);
        }

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();

        //Start - thongnq1 - 03/05/2013 - fix loi xoa du lieu tren trang danh sach
        if ($request->getParameter('current_page'))
        {
            $current_page = $request->getParameter('current_page');
            $this->setPage($current_page);
            $this->pager = $this->getPager();
        }
        //end thongnq1

        $this->sort = $this->getSort();
    }
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        ini_set('memory_limit', '-1');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_article = $form->save();
                $vals = $form->getValues();
                $ad_article->lang=sfContext::getInstance()->getUser()->getCulture();

                if ($ad_article->is_active=='2' && $ad_article->published_time ===null){
                    $ad_article->published_time=date('Y-m-d H:i:s',time());
                }
                if($vals['slug']){
                    $slug=removeSignClass::removeSign($vals['slug']);
                }
                else{
                    $slug=removeSignClass::removeSign($ad_article->title);
                }

                if($slug==''){
                    $slug=VtHelper::generateString(5);
                }
                $objCat = count(AdArticleTable::checkSlug($slug,$ad_article->id));
                while ($objCat>0){
                    $slug=$slug.'_'.VtHelper::generateString(5);
                    $objCat = count(AdArticleTable::checkSlug($slug,$ad_article->id));
                }
                $ad_article->slug=$slug;
                if (!$form->getObject()->isNew()){
                    $user = sfContext::getInstance()->getUser();
                    $ad_article->updated_at=date('Y-m-d H:i:s',time());
                    $ad_article->updated_by=$user->getGuardUser()->getId();
                }
                $ad_article->save();
                //xoa tin lien quan
                AdArticlesRelatedTable::deleteArticleRelated($ad_article->id);
                //ngoctv cap nhat tin lien quan

                if (!empty($vals['item_list'])){
                    $itemlist=  explode(',', $vals['item_list']);
                    if (is_array($itemlist)){
                        foreach ($itemlist as $item){
                            if ($item!=''){
                                $vtp_article_related = new AdArticlesRelated();
                                $vtp_article_related->article_id=$ad_article->id;
                                $vtp_article_related->related_article_id=$item;
                                $vtp_article_related->save();
                            }
                        }
                    }
                }


            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_article)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_article');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@ad_article_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect(array('sf_route' => 'ad_article_edit', 'sf_subject' => $ad_article));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        if ($this->getRoute()->getObject()->delete())
        {
          $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@ad_article');
    }
    public function executeNew(sfWebRequest $request)
    {
        if(sfContext::getInstance()->getUser()->isSuperAdmin() || sfContext::getInstance()->getUser()->hasCredential('news_editor') || sfContext::getInstance()->getUser()->hasCredential('admin')){
            $this->sidebar_status = $this->configuration->getNewSidebarStatus();
            $this->form = $this->configuration->getForm();
            $this->ad_article = $this->form->getObject();
        }
        else{
            $i18n = sfContext::getInstance()->getI18N();
            $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền tạo bài viết.'));
            $this->redirect('@ad_article');
        }


    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_article = $this->getRoute()->getObject();
        $user = sfContext::getInstance()->getUser();
        $user->setAttribute('article_id', $this->getRoute()->getObject()->getId());
        $user->setAttribute('article_status', $this->getRoute()->getObject()->getIsActive());
        $id = $user->getGuardUser()->getId();
        $i18n = sfContext::getInstance()->getI18N();

        $checkPermission = AdCategoryPermissionTable::checkPermissionCategoryUser($id, $this->ad_article->category_id, VtCommonEnum::NewCategory);
        if(!$user->isSuperAdmin() && !$user->hasCredential('admin')){
            if($checkPermission){
                $status = $this->ad_article->is_active;
                if($status==-1 || $status==0){
                    if(!$user->isSuperAdmin() && !$user->hasCredential('admin')){

                        if(!$user->hasCredential('news_public')){
                            if(!$user->hasCredential('news_approved')){
                                if($id != $this->ad_article->created_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                            else{
                                if($status==-1){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                        }
                        else{
                            $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                            $this->redirect('@ad_article');
                        }
                    }
                }
                //dịch vụ ở trạng thái đã duyệt
                else if($status==1){
                    if(!$user->isSuperAdmin() && !$user->hasCredential('admin')){
                        if(!$user->hasCredential('news_public')){
                            if($user->hasCredential('news_approved') && $user->hasCredential('news_editor')){
                                if($id != $this->ad_article->created_by && $id != $this->ad_article->updated_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                            else if($user->hasCredential('news_approved')){
                                if($id != $this->ad_article->updated_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                            else if($user->hasCredential('news_editor')){
                                if($id != $this->ad_article->created_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                        }
                    }
                }
                //Dịch vụ ở trạng thái đã đăng
                else{
                    if(!$user->isSuperAdmin() && !$user->hasCredential('admin')){
                        if(!$user->hasCredential('news_approved')){
                            if($user->hasCredential('news_public') && $user->hasCredential('news_editor')){
                                if($id != $this->ad_article->created_by && $id != $this->ad_article->updated_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                            else if($user->hasCredential('news_public')){
                                if($id != $this->ad_article->updated_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                            else if($user->hasCredential('news_editor')){
                                if($id != $this->ad_article->created_by){
                                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                                    $this->redirect('@ad_article');
                                }
                            }
                        }
                        else{
                            $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                            $this->redirect('@ad_article');
                        }
                    }
                }
            }
            else{
                if($user->isSuperAdmin() || $user->hasCredential('admin') || $user->hasCredential('news_editor')){
                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                    $this->redirect('@ad_article');
                }
                if($user->hasCredential('news_approved')){
                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                    $this->redirect('@ad_article');
                }
                if($user->hasCredential('news_approved')){
                    $this->getUser()->setFlash('notice', $i18n->__('Bạn không có quyền thao tác với bản ghi này.'));
                    $this->redirect('@ad_article');
                }
            }
        }
        $this->form = $this->configuration->getForm($this->ad_article);
        $this->fields = $this->ad_article->getTable()->getColumnNames();
    }

    protected function getPager()
    {
        $user = sfContext::getInstance()->getUser();
        $id = $user->getGuardUser()->getId();
        $query = $this->buildQuery();
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());

        if($user->isSuperAdmin()||$user->hasCredential('admin')){
            $query->andWhere('(is_active=? or is_active=?)', array(VtCommonEnum::NUMBER_ZERO,VtCommonEnum::NUMBER_MINUS_ONE));
        }
        else{
            //Neu User có 2 quyền là Editor và Approved thì hiển thị cả 2 trạng thái là nháp và chờ duyệt
            if($user->hasCredential('news_editor') && $user->hasCredential('news_approved')){
                $query->andWhere('(is_active=? or is_active=?)', array(VtCommonEnum::NUMBER_ZERO,VtCommonEnum::NUMBER_MINUS_ONE));
//            $query->andWhere('created_by=?', $id);
            }
            //Nếu là Editor thì hiển thị cả 2 trạng thái là nháp, chờ duyệt và điều kiện created_by = id của user Editor
            else if($user->hasCredential('news_editor')){
                $query->andWhere('(is_active=? or is_active=?)', array(VtCommonEnum::NUMBER_ZERO,VtCommonEnum::NUMBER_MINUS_ONE));
                $query->andWhere('created_by=?', $id);
            }
            //Nếu là Approved thì hiển thị trạng thái dịch vụ là chờ duyệt
            else if($user->hasCredential('news_approved')){
                $query->andWhere('is_active=?', VtCommonEnum::NUMBER_ZERO);
            }
            // Điều kiện lấy các chuyên mục được phân quyền của user
            $arrPer = AdCategoryPermissionTable::getPermissionByUserId($id);
            $arrCat=AdCategoryPermissionTable::getCatgoryIdByArrPermission($arrPer, VtCommonEnum::NewCategory);
            $query->andWhereIn('category_id', $arrCat);
        }

        $query->orderby('priority ASC');
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdArticle');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();
        return $pager;
    }


}
