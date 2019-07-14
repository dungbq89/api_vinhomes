<?php

/**
 * csdl_coquanbaochi filter form base class.
 *
 * @package    Web_Portals
 * @subpackage filter
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basecsdl_coquanbaochiFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'madonvi'      => new sfWidgetFormFilterInput(),
      'tendonvi'     => new sfWidgetFormFilterInput(),
      'gioithieu'    => new sfWidgetFormFilterInput(),
      'nguoidaidien' => new sfWidgetFormFilterInput(),
      'anhdaidien'   => new sfWidgetFormFilterInput(),
      'thutu'        => new sfWidgetFormFilterInput(),
      'trangthai'    => new sfWidgetFormFilterInput(),
      'created_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'madonvi'      => new sfValidatorPass(array('required' => false)),
      'tendonvi'     => new sfValidatorPass(array('required' => false)),
      'gioithieu'    => new sfValidatorPass(array('required' => false)),
      'nguoidaidien' => new sfValidatorPass(array('required' => false)),
      'anhdaidien'   => new sfValidatorPass(array('required' => false)),
      'thutu'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'trangthai'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_by'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('csdl_coquanbaochi_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'csdl_coquanbaochi';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'madonvi'      => 'Text',
      'tendonvi'     => 'Text',
      'gioithieu'    => 'Text',
      'nguoidaidien' => 'Text',
      'anhdaidien'   => 'Text',
      'thutu'        => 'Number',
      'trangthai'    => 'Number',
      'created_by'   => 'ForeignKey',
      'updated_by'   => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
