<?php

require_once dirname(__FILE__) . '/../lib/VinBuildingTypeGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/VinBuildingTypeGeneratorHelper.class.php';

/**
 * VinBuildingType actions.
 *
 * @package    symfony
 * @subpackage VinBuildingType
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinBuildingTypeActions extends autoVinBuildingTypeActions
{
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $values = $request->getParameter($form->getName());
        $form->bind($values, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $vin_building_type = $form->save();
                // cap nhap thong tin
                $apartmentType = VinApartmentTypeTable::getInstance()->findOneById($vin_building_type->apartment_type_id);
                if ($apartmentType) {
                    $vin_building_type->setType($apartmentType->vin_key);
                }
                $vin_building_type->setImage(VinHelper::getImage($vin_building_type->image, 'building_image'));
                $vin_building_type->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $vin_building_type)));

            if ($request->hasParameter('_save_and_exit')) {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@vin_building_type');
            } elseif ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('success', $notice . ' You can add another one below.');

                $this->redirect('@vin_building_type_new');
            } else {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'vin_building_type_edit', 'sf_subject' => $vin_building_type));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
