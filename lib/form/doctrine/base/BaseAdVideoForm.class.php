<?php

/**
 * AdVideo form base class.
 *
 * @method AdVideo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdVideoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'event_date'  => new sfWidgetFormDateTime(),
      'file_path'   => new sfWidgetFormInputText(),
      'image_path'  => new sfWidgetFormInputText(),
      'extension'   => new sfWidgetFormInputText(),
      'priority'    => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'is_default'  => new sfWidgetFormInputCheckbox(),
      'lang'        => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('max_length' => 1000)),
      'event_date'  => new sfValidatorDateTime(),
      'file_path'   => new sfValidatorString(array('max_length' => 255)),
      'image_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'extension'   => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'priority'    => new sfValidatorInteger(),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'is_default'  => new sfValidatorBoolean(array('required' => false)),
      'lang'        => new sfValidatorString(array('max_length' => 10)),
      'slug'        => new sfValidatorString(array('max_length' => 255)),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'AdVideo', 'column' => array('name'))),
        new sfValidatorDoctrineUnique(array('model' => 'AdVideo', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('ad_video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdVideo';
  }

}
