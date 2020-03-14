<?php

require_once dirname(__FILE__) . '/../lib/VinProductImageGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/VinProductImageGeneratorHelper.class.php';

/**
 * VinProductImage actions.
 *
 * @package    symfony
 * @subpackage VinProductImage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinProductImageActions extends autoVinProductImageActions
{
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $values = $request->getParameter($form->getName());
        $form->bind($values, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $vin_product_image = $form->save();
                if (in_array($vin_product_image->groups, ['1', '2'])) {
                    $vin_product_image->file_path = $vin_product_image->extension;
                }
                $vin_product_image->setFilePath(VinHelper::getImage($vin_product_image->file_path, 'building_image'));
                $vin_product_image->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vin_product_image)));

            if ($request->hasParameter('_save_and_exit')) {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@vin_product_image');
            } elseif ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('success', $notice . ' You can add another one below.');

                $this->redirect('@vin_product_image_new');
            } else {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'vin_product_image_edit', 'sf_subject' => $vin_product_image));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
