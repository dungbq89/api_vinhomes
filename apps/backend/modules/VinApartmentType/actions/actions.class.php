<?php

require_once dirname(__FILE__) . '/../lib/VinApartmentTypeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/VinApartmentTypeGeneratorHelper.class.php';

/**
 * VinApartmentType actions.
 *
 * @package    symfony
 * @subpackage VinApartmentType
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinApartmentTypeActions extends autoVinApartmentTypeActions
{

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $values = $request->getParameter($form->getName());
        $form->bind($values, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $vin_apartment_type = $form->save();
                $vin_apartment_type->setFeaturedImage(VinHelper::getImage($vin_apartment_type->featured_image, 'building_image'));
                $vin_apartment_type->setStandardTransferFile(VinHelper::getImage($vin_apartment_type->standard_transfer_file, 'building_image'));
                $vin_apartment_type->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vin_apartment_type)));

            if ($request->hasParameter('_save_and_exit')) {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@vin_apartment_type');
            } elseif ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('success', $notice . ' You can add another one below.');

                $this->redirect('@vin_apartment_type_new');
            } else {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'vin_apartment_type_edit', 'sf_subject' => $vin_apartment_type));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
