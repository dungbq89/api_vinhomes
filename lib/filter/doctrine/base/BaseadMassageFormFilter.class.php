<?php

/**
 * adMassage filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseadMassageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'       => new sfWidgetFormFilterInput(),
      'address'     => new sfWidgetFormFilterInput(),
      'time_open'   => new sfWidgetFormFilterInput(),
      'time_close'  => new sfWidgetFormFilterInput(),
      'keywords'    => new sfWidgetFormFilterInput(),
      'phone'       => new sfWidgetFormFilterInput(),
      'slug'        => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'location_id' => new sfWidgetFormFilterInput(),
      'rate'        => new sfWidgetFormFilterInput(),
      'total_view'  => new sfWidgetFormFilterInput(),
      'lat'         => new sfWidgetFormFilterInput(),
      'lng'         => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_home'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'priority'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'     => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'image'       => new sfValidatorPass(array('required' => false)),
      'address'     => new sfValidatorPass(array('required' => false)),
      'time_open'   => new sfValidatorPass(array('required' => false)),
      'time_close'  => new sfValidatorPass(array('required' => false)),
      'keywords'    => new sfValidatorPass(array('required' => false)),
      'phone'       => new sfValidatorPass(array('required' => false)),
      'slug'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'location_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rate'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_view'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lat'         => new sfValidatorPass(array('required' => false)),
      'lng'         => new sfValidatorPass(array('required' => false)),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_home'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'priority'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content'     => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_massage_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'adMassage';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'image'       => 'Text',
      'address'     => 'Text',
      'time_open'   => 'Text',
      'time_close'  => 'Text',
      'keywords'    => 'Text',
      'phone'       => 'Text',
      'slug'        => 'Text',
      'description' => 'Text',
      'location_id' => 'Number',
      'rate'        => 'Number',
      'total_view'  => 'Number',
      'lat'         => 'Text',
      'lng'         => 'Text',
      'is_active'   => 'Boolean',
      'is_home'     => 'Boolean',
      'priority'    => 'Number',
      'content'     => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
