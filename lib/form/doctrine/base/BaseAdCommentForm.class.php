<?php

/**
 * AdComment form base class.
 *
 * @method AdComment getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInputText(),
      'full_name'    => new sfWidgetFormInputText(),
      'phone_number' => new sfWidgetFormInputText(),
      'email'        => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'create_date'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255)),
      'full_name'    => new sfValidatorString(array('max_length' => 255)),
      'phone_number' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'create_date'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ad_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdComment';
  }

}
