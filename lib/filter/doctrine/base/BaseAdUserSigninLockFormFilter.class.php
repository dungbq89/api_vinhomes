<?php

/**
 * AdUserSigninLock filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdUserSigninLockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name'    => new sfWidgetFormFilterInput(),
      'created_time' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_name'    => new sfValidatorPass(array('required' => false)),
      'created_time' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ad_user_signin_lock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdUserSigninLock';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_name'    => 'Text',
      'created_time' => 'Number',
    );
  }
}
