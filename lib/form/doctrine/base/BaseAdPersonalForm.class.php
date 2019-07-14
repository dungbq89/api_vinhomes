<?php

/**
 * AdPersonal form base class.
 *
 * @method AdPersonal getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdPersonalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'full_name'    => new sfWidgetFormInputText(),
      'birthday'     => new sfWidgetFormDateTime(),
      'sex'          => new sfWidgetFormInputText(),
      'phone_number' => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'address'      => new sfWidgetFormInputText(),
      'introduction' => new sfWidgetFormTextarea(),
      'created_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'full_name'    => new sfValidatorString(array('max_length' => 255)),
      'birthday'     => new sfValidatorDateTime(array('required' => false)),
      'sex'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'phone_number' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'introduction' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'created_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_personal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdPersonal';
  }

}
