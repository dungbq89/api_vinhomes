<?php

/**
 * csdl_lylichhoivien filter form base class.
 *
 * @package    Web_Portals
 * @subpackage filter
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basecsdl_lylichhoivienFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hoivien_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Groups'), 'add_empty' => true)),
      'ten'           => new sfWidgetFormFilterInput(),
      'hodem'         => new sfWidgetFormFilterInput(),
      'ngaysinh'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gioitinh'      => new sfWidgetFormFilterInput(),
      'diachi'        => new sfWidgetFormFilterInput(),
      'maquan'        => new sfWidgetFormFilterInput(),
      'matinh'        => new sfWidgetFormFilterInput(),
      'ngayvaodoan'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'noiketnapdoan' => new sfWidgetFormFilterInput(),
      'ngayvaodang'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'noiketnapdang' => new sfWidgetFormFilterInput(),
      'tieusu'        => new sfWidgetFormFilterInput(),
      'nghenghiep_id' => new sfWidgetFormFilterInput(),
      'dantoc_id'     => new sfWidgetFormFilterInput(),
      'quoctich'      => new sfWidgetFormFilterInput(),
      'donvi_id'      => new sfWidgetFormFilterInput(),
      'images'        => new sfWidgetFormFilterInput(),
      'dienthoai'     => new sfWidgetFormFilterInput(),
      'email'         => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'hoivien_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Groups'), 'column' => 'id')),
      'ten'           => new sfValidatorPass(array('required' => false)),
      'hodem'         => new sfValidatorPass(array('required' => false)),
      'ngaysinh'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'gioitinh'      => new sfValidatorPass(array('required' => false)),
      'diachi'        => new sfValidatorPass(array('required' => false)),
      'maquan'        => new sfValidatorPass(array('required' => false)),
      'matinh'        => new sfValidatorPass(array('required' => false)),
      'ngayvaodoan'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'noiketnapdoan' => new sfValidatorPass(array('required' => false)),
      'ngayvaodang'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'noiketnapdang' => new sfValidatorPass(array('required' => false)),
      'tieusu'        => new sfValidatorPass(array('required' => false)),
      'nghenghiep_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dantoc_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quoctich'      => new sfValidatorPass(array('required' => false)),
      'donvi_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'images'        => new sfValidatorPass(array('required' => false)),
      'dienthoai'     => new sfValidatorPass(array('required' => false)),
      'email'         => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('csdl_lylichhoivien_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'csdl_lylichhoivien';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'hoivien_id'    => 'ForeignKey',
      'ten'           => 'Text',
      'hodem'         => 'Text',
      'ngaysinh'      => 'Date',
      'gioitinh'      => 'Text',
      'diachi'        => 'Text',
      'maquan'        => 'Text',
      'matinh'        => 'Text',
      'ngayvaodoan'   => 'Date',
      'noiketnapdoan' => 'Text',
      'ngayvaodang'   => 'Date',
      'noiketnapdang' => 'Text',
      'tieusu'        => 'Text',
      'nghenghiep_id' => 'Number',
      'dantoc_id'     => 'Number',
      'quoctich'      => 'Text',
      'donvi_id'      => 'Number',
      'images'        => 'Text',
      'dienthoai'     => 'Text',
      'email'         => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
