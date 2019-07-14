<?php

/**
 * adMassage form base class.
 *
 * @method adMassage getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseadMassageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'image'       => new sfWidgetFormInputText(),
      'address'     => new sfWidgetFormInputText(),
      'time_open'   => new sfWidgetFormInputText(),
      'time_close'  => new sfWidgetFormInputText(),
      'keywords'    => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'location_id' => new sfWidgetFormInputText(),
      'rate'        => new sfWidgetFormInputText(),
      'total_view'  => new sfWidgetFormInputText(),
      'lat'         => new sfWidgetFormInputText(),
      'lng'         => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'is_home'     => new sfWidgetFormInputCheckbox(),
      'priority'    => new sfWidgetFormInputText(),
      'content'     => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'image'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'time_open'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'time_close'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 2000)),
      'location_id' => new sfValidatorInteger(array('required' => false)),
      'rate'        => new sfValidatorInteger(array('required' => false)),
      'total_view'  => new sfValidatorInteger(array('required' => false)),
      'lat'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lng'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'is_home'     => new sfValidatorBoolean(array('required' => false)),
      'priority'    => new sfValidatorInteger(),
      'content'     => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_massage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'adMassage';
  }

}
