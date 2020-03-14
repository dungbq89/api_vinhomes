<?php

/**
 * VinApartmentCate form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinApartmentCateFormAdmin extends BaseVinApartmentCateForm
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $arrVinModel = VinHelper::getVinModel();
        $arrParents = VinHelper::getParentAparmentCat();
        $this->setWidgets(array(
            'code' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
            'vin_model' => new sfWidgetFormChoice(array(
                'choices' => $arrVinModel,
                'multiple' => false,
                'expanded' => false)),
            'type' => new sfWidgetFormInputText(),
            'priority' => new sfWidgetFormInputText(),
            'parent' => new sfWidgetFormChoice(array(
                'choices' => $arrParents,
                'multiple' => false,
                'expanded' => false)),
        ));

        $this->setValidators(array(
            'code' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'name' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'vin_model' => new sfValidatorChoice(
                array('choices' => array_keys($arrVinModel), 'required' => true),
                array('invalid' => $i18n->__('Category required.'))),
            'type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'priority' => new sfValidatorInteger(array('required' => false)),
            'parent' => new sfValidatorChoice(
                array('choices' => array_keys($arrParents), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
        ));

        $this->widgetSchema->setNameFormat('vin_apartment_cate[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }


}
