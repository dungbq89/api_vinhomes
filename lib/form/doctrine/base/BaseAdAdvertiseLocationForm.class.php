<?php

/**
 * AdAdvertiseLocation form base class.
 *
 * @method AdAdvertiseLocation getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdAdvertiseLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'page'         => new sfWidgetFormInputText(),
      'template'     => new sfWidgetFormInputText(),
      'advertise_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdAdvertiseLocation'), 'add_empty' => true)),
      'priority'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 200)),
      'page'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'template'     => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'advertise_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdAdvertiseLocation'), 'required' => false)),
      'priority'     => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('ad_advertise_location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdAdvertiseLocation';
  }

}
