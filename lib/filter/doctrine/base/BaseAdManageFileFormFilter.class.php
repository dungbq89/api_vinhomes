<?php

/**
 * AdManageFile filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdManageFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_id'   => new sfWidgetFormFilterInput(),
      'short_url'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'type'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'duration'     => new sfWidgetFormFilterInput(),
      'position'     => new sfWidgetFormFilterInput(),
      'type_product' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'article_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'short_url'    => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'type'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'duration'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'position'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type_product' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ad_manage_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdManageFile';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'article_id'   => 'Number',
      'short_url'    => 'Text',
      'description'  => 'Text',
      'type'         => 'Number',
      'duration'     => 'Number',
      'position'     => 'Number',
      'type_product' => 'Number',
    );
  }
}
