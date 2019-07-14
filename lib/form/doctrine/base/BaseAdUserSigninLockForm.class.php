<?php

/**
 * AdUserSigninLock form base class.
 *
 * @method AdUserSigninLock getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdUserSigninLockForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_name'    => new sfWidgetFormInputText(),
      'created_time' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_name'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_time' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ad_user_signin_lock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdUserSigninLock';
  }

}
