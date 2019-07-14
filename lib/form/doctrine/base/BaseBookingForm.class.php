<?php

/**
 * Booking form base class.
 *
 * @method Booking getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBookingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'full_name'     => new sfWidgetFormInputText(),
      'phone'         => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      'body'          => new sfWidgetFormTextarea(),
      'category_id'   => new sfWidgetFormInputText(),
      'product_id'    => new sfWidgetFormInputText(),
      'lang'          => new sfWidgetFormInputText(),
      'is_check'      => new sfWidgetFormInputText(),
      'from_time'     => new sfWidgetFormDateTime(),
      'to_time'       => new sfWidgetFormDateTime(),
      'number_person' => new sfWidgetFormInputText(),
      'number_room'   => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'full_name'     => new sfValidatorString(array('max_length' => 255)),
      'phone'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'          => new sfValidatorString(array('required' => false)),
      'category_id'   => new sfValidatorInteger(array('required' => false)),
      'product_id'    => new sfValidatorInteger(array('required' => false)),
      'lang'          => new sfValidatorString(array('max_length' => 10)),
      'is_check'      => new sfValidatorInteger(array('required' => false)),
      'from_time'     => new sfValidatorDateTime(array('required' => false)),
      'to_time'       => new sfValidatorDateTime(array('required' => false)),
      'number_person' => new sfValidatorInteger(array('required' => false)),
      'number_room'   => new sfValidatorInteger(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('booking[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Booking';
  }

}
