<?php

/**
 * AdUsersLog filter form base class.
 *
 * @package    Web_Portals
 * @subpackage filter
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdUsersLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name'  => new sfWidgetFormFilterInput(),
      'error_code' => new sfWidgetFormFilterInput(),
      'error_desc' => new sfWidgetFormFilterInput(),
      'content'    => new sfWidgetFormFilterInput(),
      'datetime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_name'  => new sfValidatorPass(array('required' => false)),
      'error_code' => new sfValidatorPass(array('required' => false)),
      'error_desc' => new sfValidatorPass(array('required' => false)),
      'content'    => new sfValidatorPass(array('required' => false)),
      'datetime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_users_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdUsersLog';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'user_name'  => 'Text',
      'error_code' => 'Text',
      'error_desc' => 'Text',
      'content'    => 'Text',
      'datetime'   => 'Date',
    );
  }
}
