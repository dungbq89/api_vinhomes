<?php

/**
 * csdl_area filter form base class.
 *
 * @package    Web_Portals
 * @subpackage filter
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basecsdl_areaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'PROVINCE'     => new sfWidgetFormFilterInput(),
      'DISTRICT'     => new sfWidgetFormFilterInput(),
      'PRECINCT'     => new sfWidgetFormFilterInput(),
      'STREET_BLOCK' => new sfWidgetFormFilterInput(),
      'STREET'       => new sfWidgetFormFilterInput(),
      'NAME'         => new sfWidgetFormFilterInput(),
      'FULL_NAME'    => new sfWidgetFormFilterInput(),
      'STATUS'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'PROVINCE'     => new sfValidatorPass(array('required' => false)),
      'DISTRICT'     => new sfValidatorPass(array('required' => false)),
      'PRECINCT'     => new sfValidatorPass(array('required' => false)),
      'STREET_BLOCK' => new sfValidatorPass(array('required' => false)),
      'STREET'       => new sfValidatorPass(array('required' => false)),
      'NAME'         => new sfValidatorPass(array('required' => false)),
      'FULL_NAME'    => new sfValidatorPass(array('required' => false)),
      'STATUS'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('csdl_area_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'csdl_area';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'PROVINCE'     => 'Text',
      'DISTRICT'     => 'Text',
      'PRECINCT'     => 'Text',
      'STREET_BLOCK' => 'Text',
      'STREET'       => 'Text',
      'NAME'         => 'Text',
      'FULL_NAME'    => 'Text',
      'STATUS'       => 'Number',
    );
  }
}
