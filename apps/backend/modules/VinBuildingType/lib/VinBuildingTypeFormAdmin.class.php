<?php

/**
 * VinBuildingType form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinBuildingTypeFormAdmin extends BaseVinBuildingTypeForm
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $apartmentType = VinHelper::getParentAparmentType();
        $apartmentCat = VinHelper::getParentAparmentCat(false, 'floorsCategory');
        $apartmentCat[0] = $i18n->__('Chọn tòa nhà');
        $apartmentType[0] = $i18n->__('Chọn loại phòng');
        $this->setWidgets(array(
            'vin_key' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
            'clear_span' => new sfWidgetFormInputText(),
            'heart_wall' => new sfWidgetFormInputText(),
            'apartment_type_id' => new sfWidgetFormChoice(array(
                'choices' => $apartmentType,
                'multiple' => false,
                'expanded' => false)),
            'apartment_cat' => new sfWidgetFormChoice(array(
                'choices' => $apartmentCat,
                'multiple' => false,
                'expanded' => false)),
            'is_hot' => new sfWidgetFormInputCheckbox(),
            'isView' => new sfWidgetFormInputCheckbox(),
        ));
        $this->setDefault('is_hot', 0);
        $this->setDefault('isView', 0);

        $this->setValidators(array(
            'vin_key' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'clear_span' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'heart_wall' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'apartment_type_id' => new sfValidatorChoice(
                array('choices' => array_keys($apartmentType), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
            'apartment_cat' => new sfValidatorChoice(
                array('choices' => array_keys($apartmentCat), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
            'is_hot' => new sfValidatorBoolean(array('required' => false)),
            'isView' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('vin_building_type[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);


    }
}
