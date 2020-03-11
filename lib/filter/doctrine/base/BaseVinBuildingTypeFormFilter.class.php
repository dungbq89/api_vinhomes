<?php

/**
 * VinBuildingType filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVinBuildingTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vin_key'           => new sfWidgetFormFilterInput(),
      'name'              => new sfWidgetFormFilterInput(),
      'clear_span'        => new sfWidgetFormFilterInput(),
      'heart_wall'        => new sfWidgetFormFilterInput(),
      'image'             => new sfWidgetFormFilterInput(),
      'type'              => new sfWidgetFormFilterInput(),
      'apartment_type_id' => new sfWidgetFormFilterInput(),
      'apartment_cat'     => new sfWidgetFormFilterInput(),
      'is_hot'            => new sfWidgetFormFilterInput(),
      'attr'              => new sfWidgetFormFilterInput(),
      'isView'            => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'vin_key'           => new sfValidatorPass(array('required' => false)),
      'name'              => new sfValidatorPass(array('required' => false)),
      'clear_span'        => new sfValidatorPass(array('required' => false)),
      'heart_wall'        => new sfValidatorPass(array('required' => false)),
      'image'             => new sfValidatorPass(array('required' => false)),
      'type'              => new sfValidatorPass(array('required' => false)),
      'apartment_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'apartment_cat'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_hot'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'attr'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isView'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vin_building_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VinBuildingType';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'vin_key'           => 'Text',
      'name'              => 'Text',
      'clear_span'        => 'Text',
      'heart_wall'        => 'Text',
      'image'             => 'Text',
      'type'              => 'Text',
      'apartment_type_id' => 'Number',
      'apartment_cat'     => 'Number',
      'is_hot'            => 'Number',
      'attr'              => 'Number',
      'isView'            => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
