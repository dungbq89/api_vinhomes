<?php

/**
 * VinApartmentType filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVinApartmentTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'vin_key'                => new sfWidgetFormFilterInput(),
      'name_type'              => new sfWidgetFormFilterInput(),
      'featured_image'         => new sfWidgetFormFilterInput(),
      'standard_transfer_file' => new sfWidgetFormFilterInput(),
      'ground_apartment_file'  => new sfWidgetFormFilterInput(),
      'bad_room'               => new sfWidgetFormFilterInput(),
      'bath_room'              => new sfWidgetFormFilterInput(),
      'kitchen_room'           => new sfWidgetFormFilterInput(),
      'balcony'                => new sfWidgetFormFilterInput(),
      'description'            => new sfWidgetFormFilterInput(),
      'heart_wall'             => new sfWidgetFormFilterInput(),
      'clear_span'             => new sfWidgetFormFilterInput(),
      'vin_model'              => new sfWidgetFormFilterInput(),
      'parent_type'            => new sfWidgetFormFilterInput(),
      'apartment_cat'          => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'vin_key'                => new sfValidatorPass(array('required' => false)),
      'name_type'              => new sfValidatorPass(array('required' => false)),
      'featured_image'         => new sfValidatorPass(array('required' => false)),
      'standard_transfer_file' => new sfValidatorPass(array('required' => false)),
      'ground_apartment_file'  => new sfValidatorPass(array('required' => false)),
      'bad_room'               => new sfValidatorPass(array('required' => false)),
      'bath_room'              => new sfValidatorPass(array('required' => false)),
      'kitchen_room'           => new sfValidatorPass(array('required' => false)),
      'balcony'                => new sfValidatorPass(array('required' => false)),
      'description'            => new sfValidatorPass(array('required' => false)),
      'heart_wall'             => new sfValidatorPass(array('required' => false)),
      'clear_span'             => new sfValidatorPass(array('required' => false)),
      'vin_model'              => new sfValidatorPass(array('required' => false)),
      'parent_type'            => new sfValidatorPass(array('required' => false)),
      'apartment_cat'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vin_apartment_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VinApartmentType';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'vin_key'                => 'Text',
      'name_type'              => 'Text',
      'featured_image'         => 'Text',
      'standard_transfer_file' => 'Text',
      'ground_apartment_file'  => 'Text',
      'bad_room'               => 'Text',
      'bath_room'              => 'Text',
      'kitchen_room'           => 'Text',
      'balcony'                => 'Text',
      'description'            => 'Text',
      'heart_wall'             => 'Text',
      'clear_span'             => 'Text',
      'vin_model'              => 'Text',
      'parent_type'            => 'Text',
      'apartment_cat'          => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
