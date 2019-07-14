<?php

require_once dirname(__FILE__).'/../lib/sfGuardPermissionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardPermissionGeneratorHelper.class.php';

/**
 * sfGuardPermission actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardPermission
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardPermissionActions extends autosfGuardPermissionActions
{

    protected function getPager()
    {
        $query = $this->buildQuery();
        $query->orderBy('name asc');
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('sfGuardPermission');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }
    public function executeDelete(sfWebRequest $request)
    {
      $i18n = sfContext::getInstance()->getI18N();
      $request->checkCSRFProtection();
      $checkPermission = sfGuardUserPermissionTable::checkPermissionWhenDelete($this->getRoute()->getObject()->getId());
      if(count($checkPermission)>0){
          $this->getUser()->setFlash('notice',$i18n->__('Bạn không thể xóa khi quyền đã được gán cho người dùng.'));
          $this->redirect(array('sf_route' => 'sf_guard_permission_edit', 'id' => $this->getRoute()->getObject()->getId()));
      }
      else{
            $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
            if ($this->getRoute()->getObject()->delete())
            {
              $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
            }
            $this->redirect('@sf_guard_permission');
      }
      
      
    }

    public function executeBatch(sfWebRequest $request)
    {
      $request->checkCSRFProtection();

      if (!$ids = $request->getParameter('ids'))
      {
        $this->getUser()->setFlash('error', 'You must at least select one item.');

        $this->redirect('@sf_guard_permission');
      }

      if (!$action = $request->getParameter('batch_action'))
      {
        $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

        $this->redirect('@sf_guard_permission');
      }

      if (!method_exists($this, $method = 'execute'.ucfirst($action)))
      {
        throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
      }

      if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
      {
        $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }

      $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission'));
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

      $this->redirect('@sf_guard_permission');
    }

    protected function executeBatchDelete(sfWebRequest $request)
    {
      $ids = $request->getParameter('ids');

      $records = Doctrine_Query::create()
        ->from('sfGuardPermission')
        ->whereIn('id', $ids)
        ->execute();
      $countFalse = 0;
      $countSuccess = 0;
      foreach ($records as $record)
      {
        $i18n = sfContext::getInstance()->getI18N();
        $checkPermission = sfGuardUserPermissionTable::checkPermissionWhenDelete($record->getId());
        if(count($checkPermission)>0){
            $countFalse++;
//            $this->getUser()->setFlash('notice',$i18n->__('Bạn không thể xóa khi quyền đã được gán cho người dùng.'));
//            $this->redirect('@sf_guard_permission');
        }
        else{
            $countSuccess++;
            $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
            $record->delete();
            
        }
      }
      if($countFalse>0){
        if($countSuccess>0){
            $this->getUser()->setFlash('success',$i18n->__('Có '.$countSuccess.' bản ghi được xóa thành công.'));
        }
        $this->getUser()->setFlash('notice',$i18n->__('Có '.$countFalse.' bản ghi không được xóa do đã được quyền đã được gán cho người dùng.'));
        $this->redirect('@sf_guard_permission');
      }
      if($countSuccess>0){
          $this->getUser()->setFlash('notice',$i18n->__('Có '.$countSuccess.' bản ghi được xóa thành công.'));
          $this->redirect('@sf_guard_permission');
      }
    }
}
