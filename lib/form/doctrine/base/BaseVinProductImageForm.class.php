<?php

/**
 * VinProductImage form base class.
 *
 * @method VinProductImage getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVinProductImageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'file_path'  => new sfWidgetFormInputText(),
      'product_id' => new sfWidgetFormInputText(),
      'extension'  => new sfWidgetFormInputText(),
      'priority'   => new sfWidgetFormInputText(),
      'type'       => new sfWidgetFormInputText(),
      'groups'     => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'file_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'product_id' => new sfValidatorInteger(array('required' => false)),
      'extension'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'priority'   => new sfValidatorInteger(array('required' => false)),
      'type'       => new sfValidatorInteger(array('required' => false)),
      'groups'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('vin_product_image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VinProductImage';
  }

}
