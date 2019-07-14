<?php

require_once dirname(__FILE__).'/../lib/vtManageProductsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vtManageProductsGeneratorHelper.class.php';

/**
 * vtManageProducts actions.
 *
 * @package    Vt_Portals
 * @subpackage vtManageProducts
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtManageProductsActions extends autoVtManageProductsActions
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
        $pager = $this->configuration->getPager('VtpProducts');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        ini_set('memory_limit', '-1');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $vtp_products = $form->save();
                $slug=removeSignClass::removeSign($vtp_products->product_name);

                $objCat = count(VtpProductsTable::checkSlug($slug,$vtp_products->id));
                while ($objCat>0){
                    $slug=$slug.'_'.VtHelper::generateString(5);
                    $objCat = count(VtpProductsTable::checkSlug($slug,$vtp_products->id));
                }
                $vtp_products->slug=$slug;
                $vtp_products->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vtp_products)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@vtp_products');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@vtp_products_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'vtp_products_edit', 'sf_subject' => $vtp_products));
            }
        }
        else
        {
            if(!$form->getObject()->isNew()){
                if ($request->getParameter('page')) {
                    $this->setPagePhoto($request->getParameter('page'));
                } else
                    $this->setPagePhoto(1);
                // max per page
                if ($request->getParameter('max_per_page')) {
                    $this->setMaxPerPagePhoto($request->getParameter('max_per_page'));
                    $maxPerPage = $request->getParameter('max_per_page');
                } else {
                    $maxPerPage = $this->getMaxPerPagePhoto();
                }
                //tra ve danh sach bai viet chi tiet thuoc thuoc dich vu
                $id = $this->vtp_products->getId();
                $pagerDetail = new sfDoctrinePager('VtpProductImage', $maxPerPage);
                $pagerDetail->setQuery(VtpProductImageTable::getPhotoByProductId($id));
                $pagerDetail->setPage($this->getPageSubCategory());
                $pagerDetail->init();
                if($pagerDetail){
                    $this->pager = $pagerDetail;
                }
                else $this->pager = 0;

                $this->sort = $this->getSort();
            }

            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
    
    public function executeEdit(sfWebRequest $request)
    {
      $this->sidebar_status = $this->configuration->getEditSidebarStatus();
      $this->vtp_products = $this->getRoute()->getObject();
      $this->form = $this->configuration->getForm($this->vtp_products);
      $this->fields = $this->vtp_products->getTable()->getColumnNames();
      if ($request->getParameter('page')) {
        $this->setPagePhoto($request->getParameter('page'));
      } else
        $this->setPagePhoto(1);
      // max per page
      if ($request->getParameter('max_per_page')) {
        $this->setMaxPerPagePhoto($request->getParameter('max_per_page'));
        $maxPerPage = $request->getParameter('max_per_page');
      } else {
        $maxPerPage = $this->getMaxPerPagePhoto();
      }
      //tra ve danh sach bai viet chi tiet thuoc thuoc dich vu
      $id = $this->vtp_products->getId();
      $pagerDetail = new sfDoctrinePager('VtpProductImage', $maxPerPage);
      $pagerDetail->setQuery(VtpProductImageTable::getPhotoByProductId($id));
      $pagerDetail->setPage($this->getPageSubCategory());
      $pagerDetail->init();
      if($pagerDetail){
          $this->pager = $pagerDetail;
      }
      else $this->pager = 0;

      $this->sort = $this->getSort(); 
    }
    
    
    
  protected function setPagePhoto($page)
  {
    $this->getUser()->setAttribute('vtpManageProductImage.page', $page, 'admin_module');
  }
  
   protected function setMaxPerPagePhoto($max_per_page)
  {
    $this->getUser()->setAttribute('vtpManageProductImage.max_per_page', (integer) $max_per_page, 'admin_module');
  }
  
  protected function getMaxPerPagePhoto()
  {
    return $this->getUser()->getAttribute('vtpManageProductImage.max_per_page', sfConfig::get('app_default_max_per_page', 20), 'admin_module');
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('vtpManageProductImage.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('vtpManageProductImage.page', 1, 'admin_module');
  }
  
  protected function getPageSubCategory()
  {
    return $this->getUser()->getAttribute('vtpManageProductImage.page', 1, 'admin_module');
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $i18n = sfContext::getInstance()->getI18N();
    $form = new BaseForm();
    $form->bind($form->isCSRFProtected() ? array($form->getCSRFFieldName() => $request->getParameter($form->getCSRFFieldName())) : array());
    if (!$form->isValid())
    {
        $this->getUser()->setFlash('error', $i18n->__('Token không hợp lệ'));
    }
    else{
        VtpProductImageTable::getInstance()->deleteImageByProduct($this->getRoute()->getObject()->id);
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        if ($this->getRoute()->getObject()->delete()){
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

    }
    $this->redirect('@vtp_products');
  }
  
   public function executeBatch(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $form->bind($form->isCSRFProtected() ? array($form->getCSRFFieldName() => $request->getParameter($form->getCSRFFieldName())) : array());
        if (!$form->isValid())
        {
            $this->getUser()->setFlash('error', $i18n->__('Token không hợp lệ'));
            $this->redirect('@vtp_products');
        }
    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@vtp_products');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@vtp_products');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'VtpProducts'));
    try
    {
      // validate ids
      $ids = $validator->clean($ids);

      // execute batch
      $this->$method($request);
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error','A problem occurs when deleting the selected items some items do not exist anymore.');
    }

    $this->redirect('@vtp_products');
  }
  
  protected function executeBatchDelete(sfWebRequest $request)
  {
        $ids = $request->getParameter('ids');

        $records = Doctrine_Query::create()
          ->from('VtpProducts')
          ->whereIn('id', $ids)
          ->execute();
        VtpProductImageTable::getInstance()->deleteImageByProduct($ids);
        foreach ($records as $record)
        {
          $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));

          $record->delete();
        }

        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect('@vtp_products');
  }
    
}
