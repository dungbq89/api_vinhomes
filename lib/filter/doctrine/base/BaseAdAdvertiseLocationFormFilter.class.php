<?php

/**
 * AdAdvertiseLocation filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdAdvertiseLocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'page'         => new sfWidgetFormFilterInput(),
      'template'     => new sfWidgetFormFilterInput(),
      'advertise_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdAdvertiseLocation'), 'add_empty' => true)),
      'priority'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'page'         => new sfValidatorPass(array('required' => false)),
      'template'     => new sfValidatorPass(array('required' => false)),
      'advertise_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdAdvertiseLocation'), 'column' => 'id')),
      'priority'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ad_advertise_location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdAdvertiseLocation';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'page'         => 'Text',
      'template'     => 'Text',
      'advertise_id' => 'ForeignKey',
      'priority'     => 'Number',
    );
  }
}
