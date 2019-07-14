<?php

/**
 * AdAdvertiseImage form base class.
 *
 * @method AdAdvertiseImage getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdAdvertiseImageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'file_path'    => new sfWidgetFormInputText(),
      'advertise_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdAdvertiseImage'), 'add_empty' => true)),
      'extension'    => new sfWidgetFormInputText(),
      'priority'     => new sfWidgetFormInputText(),
      'is_active'    => new sfWidgetFormInputCheckbox(),
      'link'         => new sfWidgetFormInputText(),
      'created_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'file_path'    => new sfValidatorString(array('max_length' => 255)),
      'advertise_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdAdvertiseImage'), 'required' => false)),
      'extension'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'priority'     => new sfValidatorInteger(),
      'is_active'    => new sfValidatorBoolean(array('required' => false)),
      'link'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_advertise_image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdAdvertiseImage';
  }

}
