<?php

/**
 * AdOrder filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdOrderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'            => new sfWidgetFormFilterInput(),
      'customer_name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_phone'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_address' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'            => new sfWidgetFormFilterInput(),
      'body'             => new sfWidgetFormFilterInput(),
      'status'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'            => new sfValidatorPass(array('required' => false)),
      'customer_name'    => new sfValidatorPass(array('required' => false)),
      'customer_phone'   => new sfValidatorPass(array('required' => false)),
      'customer_address' => new sfValidatorPass(array('required' => false)),
      'price'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'body'             => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_order_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdOrder';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'title'            => 'Text',
      'customer_name'    => 'Text',
      'customer_phone'   => 'Text',
      'customer_address' => 'Text',
      'price'            => 'Number',
      'body'             => 'Text',
      'status'           => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
