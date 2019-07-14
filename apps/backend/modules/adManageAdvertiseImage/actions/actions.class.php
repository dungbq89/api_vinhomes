<?php

require_once dirname(__FILE__).'/../lib/adManageAdvertiseImageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adManageAdvertiseImageGeneratorHelper.class.php';

/**
 * adManageAdvertiseImage actions.
 *
 * @package    Vt_Portals
 * @subpackage adManageAdvertiseImage
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adManageAdvertiseImageActions extends autoAdManageAdvertiseImageActions
{
    public function executeNew(sfWebRequest $request)
    {
        $adId= $this->getUser()->getAttribute('adManageAdvertiseImage.adid', -1, 'admin_module');
        $this->advertise=null;
        if($adId==-1){
            $this->redirect('@ad_advertise');
        }else{
            $this->advertise=AdAdvertiseTable::getAdvertiseById($adId);
        }
        $this->sidebar_status = $this->configuration->getNewSidebarStatus();
        $this->form = $this->configuration->getForm();
        $this->ad_advertise_image = $this->form->getObject();
    }

    public function executeEdit(sfWebRequest $request)
    {
        $adId= $this->getUser()->getAttribute('adManageAdvertiseImage.adid', -1, 'admin_module');
        $advertise=AdAdvertiseTable::getAdvertiseById($adId);
//        $this->redirect(array('sf_route' => 'ad_advertise_edit', 'sf_subject' => $advertise));
        $this->advertise = $advertise;
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_advertise_image = $this->getRoute()->getObject();

        $this->form = $this->configuration->getForm($this->ad_advertise_image);
        $this->fields = $this->ad_advertise_image->getTable()->getColumnNames();

    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_advertise_image = $form->save();
                $ad_advertise_image->extension=pathinfo($ad_advertise_image->file_path, PATHINFO_EXTENSION);
                $adId= $this->getUser()->getAttribute('adManageAdvertiseImage.adid', -1, 'admin_module');
                if($adId>0){
                    $ad_advertise_image->advertise_id=$adId;
                    $ad_advertise_image->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_advertise_image)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_advertise_image');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@ad_advertise_image_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'ad_advertise_image_edit', 'sf_subject' => $ad_advertise_image));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            $adId= $this->getUser()->getAttribute('adManageAdvertiseImage.adid', -1, 'admin_module');
            $this->advertise=null;
            if($adId==-1){
                $this->redirect('@ad_advertise');
            }else{
                $this->advertise=AdAdvertiseTable::getAdvertiseById($adId);
            }
        }
    }
}
