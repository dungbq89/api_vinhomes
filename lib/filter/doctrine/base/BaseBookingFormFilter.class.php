<?php

/**
 * Booking filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBookingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'full_name'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'         => new sfWidgetFormFilterInput(),
      'email'         => new sfWidgetFormFilterInput(),
      'body'          => new sfWidgetFormFilterInput(),
      'category_id'   => new sfWidgetFormFilterInput(),
      'product_id'    => new sfWidgetFormFilterInput(),
      'lang'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_check'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'from_time'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'to_time'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'number_person' => new sfWidgetFormFilterInput(),
      'number_room'   => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'full_name'     => new sfValidatorPass(array('required' => false)),
      'phone'         => new sfValidatorPass(array('required' => false)),
      'email'         => new sfValidatorPass(array('required' => false)),
      'body'          => new sfValidatorPass(array('required' => false)),
      'category_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lang'          => new sfValidatorPass(array('required' => false)),
      'is_check'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'from_time'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'to_time'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'number_person' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'number_room'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('booking_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Booking';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'full_name'     => 'Text',
      'phone'         => 'Text',
      'email'         => 'Text',
      'body'          => 'Text',
      'category_id'   => 'Number',
      'product_id'    => 'Number',
      'lang'          => 'Text',
      'is_check'      => 'Number',
      'from_time'     => 'Date',
      'to_time'       => 'Date',
      'number_person' => 'Number',
      'number_room'   => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
