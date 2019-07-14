<?php

require_once dirname(__FILE__).'/../lib/vtpManageProductImageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vtpManageProductImageGeneratorHelper.class.php';

/**
 * vtpManageProductImage actions.
 *
 * @package    Vt_Portals
 * @subpackage vtpManageProductImage
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtpManageProductImageActions extends autoVtpManageProductImageActions
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
      if ($request->hasParameter('default_product_id'))
        {
            $productId=$request->getParameter('default_product_id');
            $this->vtp_album = VtpProductsTable::getProductById($productId);
        }
    }

    protected function getPager()
    {
      $request=  sfContext::getInstance()->getRequest();
      $query = $this->buildQuery();
      if($request->hasParameter('default_product_id')){
        $productId=$request->getParameter('default_product_id');
        $query->where('product_id=?', $productId);
      }
      $query->orderBy('priority');
      $pages = ceil($query->count() / $this->getMaxPerPage());
      $pager = $this->configuration->getPager('VtpProductImage');
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
      $values = $form->getValues();
      $defaultProductId=$values['product_id'];
      try {
        $vtp_products = $form->save();
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
        $this->redirect(array('sf_route' =>'vtp_product_image', 'default_product_id'=>$defaultProductId));
      } elseif ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('success', $notice.' You can add another one below.');
        $this->redirect(array('sf_route' => 'vtp_product_image_new','default_product_id'=>$defaultProductId));
      }
      else
      {
        $this->getUser()->setFlash('success', $notice);
        $this->redirect(array('sf_route' => 'vtp_product_image_edit', 'sf_subject' => $vtp_products, 'default_product_id'=>$defaultProductId));
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
    $productId = $this->getRoute()->getObject()->getProductId();
    if ($this->getRoute()->getObject()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect(array('sf_route' =>'vtp_products_edit','id'=>$productId));
  }
  
  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $records = Doctrine_Query::create()
      ->from('VtpProductImage')
      ->whereIn('id', $ids)
      ->execute();
    $idProduct = 0;
    foreach ($records as $record)
    {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
      $idProduct = $record->getProductId();
      $record->delete();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
//    $this->redirect(array('sf_route' =>'vtp_products', 'id'=>$idProduct));
    $this->redirect(array('sf_route' => 'vtp_products_edit', 'id' => $idProduct));
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->sidebar_status = $this->configuration->getNewSidebarStatus();
    $this->form = $this->configuration->getForm();
    $this->vtp_product_image = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->sidebar_status = $this->configuration->getNewSidebarStatus();
    $this->form = $this->configuration->getForm();
    $this->vtp_product_image = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->sidebar_status = $this->configuration->getEditSidebarStatus();
    $this->vtp_product_image = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->vtp_product_image);
    $this->fields = $this->vtp_product_image->getTable()->getColumnNames();
  }
}
