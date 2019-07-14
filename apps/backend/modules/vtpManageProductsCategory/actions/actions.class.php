<?php

require_once dirname(__FILE__).'/../lib/vtpManageProductsCategoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vtpManageProductsCategoryGeneratorHelper.class.php';

/**
 * vtpManageProductsCategory actions.
 *
 * @package    Vt_Portals
 * @subpackage vtpManageProductsCategory
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtpManageProductsCategoryActions extends autoVtpManageProductsCategoryActions
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

    protected function getPager()
    {
        $query = $this->buildQuery();
        $query->orderBy('priority ASC');
        $query->andWhere('portal_id=?',sfContext::getInstance()->getUser()->getAttribute('portal',0));
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());
//        $query->andWhere('is_active=1');
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('VtpProductsCategory');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }

    public function executeDelete(sfWebRequest $request)
    {
        $i18n = sfContext::getInstance()->getI18N();
        $request->checkCSRFProtection();
        $ids = $request->getParameter('id');//Xóa sản phẩm trong chuyên mục
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        if ($this->getRoute()->getObject()->delete())
        {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }
        VtpProductsTable::deleteProductByCategory($ids);


            $this->redirect('@vtp_products_category');
//        }
    }


    protected function executeBatchDelete(sfWebRequest $request)
    {
        $i18n = sfContext::getInstance()->getI18N();
        $ids = $request->getParameter('ids');
//        VtpProductsTable::deleteProductByCategory($ids);//Xóa sản phẩm trong chuyên mục
        $records = Doctrine_Query::create()
            ->from('VtpProductsCategory')
            ->whereIn('id', $ids)
            ->execute();

        foreach ($records as $record)
        {
            $products = VtpProductsTable::getProductByCategoryId($record->getId());
            if(count($products)>0){
                $this->getUser()->setFlash('notice', $i18n->__('Danh mục đang tồn tại sản phẩm, bạn không thể xóa.'));
            }
            else{
                $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
                $record->delete();
                $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
            }
        }
        $this->redirect('@vtp_products_category');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $vtp_products_category = $form->save();

                $slug=removeSignClass::removeSign($vtp_products_category->name);

                $objCat = count(VtpProductsCategoryTable::checkSlug($slug,$vtp_products_category->id));
                while ($objCat>0){
                    $slug=$slug.'_'.VtHelper::generateString(5);
                    $objCat = count(VtpProductsCategoryTable::checkSlug($slug,$vtp_products_category->id));
                }
                $vtp_products_category->slug=$slug;
                //luu thong tin level
                $level=0;
                if($vtp_products_category->parent_id>0){
                    $objParent=  VtpProductsCategoryTable::getCategoryById($vtp_products_category->parent_id);
                    if($objParent){
                        $newLevel=$objParent->level;
                        $level = $newLevel+1;
                    }
                }
                $vtp_products_category->level = $level;
                $vtp_products_category->save();

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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vtp_products_category)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@vtp_products_category');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@vtp_products_category_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'vtp_products_category_edit', 'sf_subject' => $vtp_products_category));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
