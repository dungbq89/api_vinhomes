<?php

/**
 * VinApartmentType form base class.
 *
 * @method VinApartmentType getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVinApartmentTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'vin_key'                => new sfWidgetFormInputText(),
      'name_type'              => new sfWidgetFormInputText(),
      'featured_image'         => new sfWidgetFormInputText(),
      'standard_transfer_file' => new sfWidgetFormInputText(),
      'ground_apartment_file'  => new sfWidgetFormInputText(),
      'bad_room'               => new sfWidgetFormInputText(),
      'bath_room'              => new sfWidgetFormInputText(),
      'kitchen_room'           => new sfWidgetFormInputText(),
      'description'            => new sfWidgetFormInputText(),
      'heart_wall'             => new sfWidgetFormInputText(),
      'clear_span'             => new sfWidgetFormInputText(),
      'vin_model'              => new sfWidgetFormInputText(),
      'parent_type'            => new sfWidgetFormInputText(),
      'apartment_cat'          => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'vin_key'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name_type'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'featured_image'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'standard_transfer_file' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ground_apartment_file'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'bad_room'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'bath_room'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'kitchen_room'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'heart_wall'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'clear_span'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'vin_model'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parent_type'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'apartment_cat'          => new sfValidatorInteger(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vin_apartment_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VinApartmentType';
  }

}
