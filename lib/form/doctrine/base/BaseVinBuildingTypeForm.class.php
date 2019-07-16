<?php

/**
 * VinBuildingType form base class.
 *
 * @method VinBuildingType getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVinBuildingTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'vin_key'           => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'clear_span'        => new sfWidgetFormInputText(),
      'heart_wall'        => new sfWidgetFormInputText(),
      'image'             => new sfWidgetFormInputText(),
      'type'              => new sfWidgetFormInputText(),
      'apartment_type_id' => new sfWidgetFormInputText(),
      'apartment_cat'     => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'vin_key'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clear_span'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'heart_wall'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'apartment_type_id' => new sfValidatorInteger(array('required' => false)),
      'apartment_cat'     => new sfValidatorInteger(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vin_building_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VinBuildingType';
  }

}
