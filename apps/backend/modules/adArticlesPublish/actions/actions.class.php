<?php

require_once dirname(__FILE__).'/../lib/adArticlesPublishGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adArticlesPublishGeneratorHelper.class.php';

/**
 * adArticlesPublish actions.
 *
 * @package    Vt_Portals
 * @subpackage adArticlesPublish
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adArticlesPublishActions extends autoAdArticlesPublishActions
{
    public function executeNew(sfWebRequest $request)
    {
        $this->redirect('@ad_article_adArticlesPublish');
        $this->sidebar_status = $this->configuration->getNewSidebarStatus();
        $this->form = $this->configuration->getForm();
        $this->ad_article = $this->form->getObject();
    }
    public function executeEdit(sfWebRequest $request)
    {
        $this->redirect('@ad_article_adArticlesPublish');
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_article = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->ad_article);
        $this->fields = $this->ad_article->getTable()->getColumnNames();
    }
    protected function getPager()
    {
        $query = $this->buildQuery();
        $user = sfContext::getInstance()->getUser();
        $id = $user->getGuardUser()->getId();
        $query->andWhere('is_active=?',  VtCommonEnum::NUMBER_TWO);
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());
        //Nếu user có cả 2 quyền Editor và Approved
        if(!$user->isSuperAdmin() && !$user->hasCredential('admin')){
            //Nếu user có cả 2 quyền Editor và Public
            if($user->hasCredential('news_editor') && $user->hasCredential('news_public')){
                $query->andWhere('(created_by=? or updated_by=?)',array($id, $id));
            }
            //Nếu là user có quyền Public
            elseif($user->hasCredential('news_public')){
                $query->andWhere('updated_by=?',$id);
            }
            //Nếu user có quyền Editor
            elseif($user->hasCredential('news_editor')){
                $query->andWhere('created_by=?',$id);
            }
            //Điều kiện hiển thị chuyên mục theo quyền
            $arrPer = AdCategoryPermissionTable::getPermissionByUserId($id);
            $arrCat=AdCategoryPermissionTable::getCatgoryIdByArrPermission($arrPer);
            $query->andWhereIn('category_id', $arrCat);
        }
        $query->orderBy('priority asc');

        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdArticle');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }




}
