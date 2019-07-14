<?php

require_once dirname(__FILE__) . '/../lib/adMassageGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/adMassageGeneratorHelper.class.php';

/**
 * adMassage actions.
 *
 * @package    symfony
 * @subpackage adMassage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adMassageActions extends autoAdMassageActions
{
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $values = $request->getParameter($form->getName());
        $form->bind($values, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_massage = $form->save();
                sfContext::getInstance()->getUser()->setAttribute('default_massage_id',$ad_massage->id);
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_massage)));

            if ($request->hasParameter('_save_and_exit')) {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_massage');
            } elseif ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('success', $notice . ' You can add another one below.');

                $this->redirect('@ad_massage_new');
            } else {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'ad_massage_edit', 'sf_subject' => $ad_massage));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_massage = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->ad_massage);
        $this->fields = $this->ad_massage->getTable()->getColumnNames();
        sfContext::getInstance()->getUser()->setAttribute('default_massage_id',$this->ad_massage->id);
    }
}
