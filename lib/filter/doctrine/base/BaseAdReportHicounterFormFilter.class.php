<?php

/**
 * AdReportHicounter filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdReportHicounterFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id' => new sfWidgetFormFilterInput(),
      'hitcounter'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'category_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hitcounter'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ad_report_hicounter_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdReportHicounter';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'category_id' => 'Number',
      'hitcounter'  => 'Number',
    );
  }
}
