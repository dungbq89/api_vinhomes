<?php

/**
 * AdReportTotalRecord filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdReportTotalRecordFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdReportTotalRecord'), 'add_empty' => true)),
      'total_record' => new sfWidgetFormFilterInput(),
      'date_time'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'category_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdReportTotalRecord'), 'column' => 'id')),
      'total_record' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_time'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_report_total_record_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdReportTotalRecord';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'category_id'  => 'ForeignKey',
      'total_record' => 'Number',
      'date_time'    => 'Date',
    );
  }
}
