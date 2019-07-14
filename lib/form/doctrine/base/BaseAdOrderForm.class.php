<?php

/**
 * AdOrder form base class.
 *
 * @method AdOrder getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdOrderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInputText(),
      'customer_name'    => new sfWidgetFormInputText(),
      'customer_phone'   => new sfWidgetFormInputText(),
      'customer_address' => new sfWidgetFormInputText(),
      'price'            => new sfWidgetFormInputText(),
      'body'             => new sfWidgetFormTextarea(),
      'status'           => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'customer_name'    => new sfValidatorString(array('max_length' => 255)),
      'customer_phone'   => new sfValidatorString(array('max_length' => 255)),
      'customer_address' => new sfValidatorString(array('max_length' => 255)),
      'price'            => new sfValidatorInteger(array('required' => false)),
      'body'             => new sfValidatorString(array('required' => false)),
      'status'           => new sfValidatorInteger(),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdOrder';
  }

}
