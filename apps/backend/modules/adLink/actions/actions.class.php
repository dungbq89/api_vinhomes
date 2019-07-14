<?php

require_once dirname(__FILE__).'/../lib/adLinkGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adLinkGeneratorHelper.class.php';

/**
 * adLink actions.
 *
 * @package    Vt_Portals
 * @subpackage adLink
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adLinkActions extends autoAdLinkActions
{

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $values=$request->getParameter($form->getName());
        $form->bind($values, $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_link = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_link)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_link');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@ad_link_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'ad_link_edit', 'sf_subject' => $ad_link));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
