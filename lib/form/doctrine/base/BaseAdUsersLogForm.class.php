<?php

/**
 * AdUsersLog form base class.
 *
 * @method AdUsersLog getObject() Returns the current form's model object
 *
 * @package    Web_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdUsersLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_name'  => new sfWidgetFormInputText(),
      'error_code' => new sfWidgetFormInputText(),
      'error_desc' => new sfWidgetFormInputText(),
      'content'    => new sfWidgetFormTextarea(),
      'datetime'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_name'  => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'error_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'error_desc' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'    => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'datetime'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_users_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdUsersLog';
  }

}
