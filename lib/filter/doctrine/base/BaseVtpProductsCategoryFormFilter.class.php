<?php

/**
 * VtpProductsCategory filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVtpProductsCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'address'       => new sfWidgetFormFilterInput(),
      'image_path'    => new sfWidgetFormFilterInput(),
      'link'          => new sfWidgetFormFilterInput(),
      'priority'      => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_home'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'lang'          => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'slug'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'portal_id'     => new sfWidgetFormFilterInput(),
      'meta'          => new sfWidgetFormFilterInput(),
      'keywords'      => new sfWidgetFormFilterInput(),
      'parent_id'     => new sfWidgetFormFilterInput(),
      'level'         => new sfWidgetFormFilterInput(),
      'lat'           => new sfWidgetFormFilterInput(),
      'log'           => new sfWidgetFormFilterInput(),
      'parameter_ids' => new sfWidgetFormFilterInput(),
      'list_image'    => new sfWidgetFormFilterInput(),
      'email'         => new sfWidgetFormFilterInput(),
      'msisdn'        => new sfWidgetFormFilterInput(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'address'       => new sfValidatorPass(array('required' => false)),
      'image_path'    => new sfValidatorPass(array('required' => false)),
      'link'          => new sfValidatorPass(array('required' => false)),
      'priority'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_home'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'lang'          => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
      'slug'          => new sfValidatorPass(array('required' => false)),
      'portal_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'meta'          => new sfValidatorPass(array('required' => false)),
      'keywords'      => new sfValidatorPass(array('required' => false)),
      'parent_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lat'           => new sfValidatorPass(array('required' => false)),
      'log'           => new sfValidatorPass(array('required' => false)),
      'parameter_ids' => new sfValidatorPass(array('required' => false)),
      'list_image'    => new sfValidatorPass(array('required' => false)),
      'email'         => new sfValidatorPass(array('required' => false)),
      'msisdn'        => new sfValidatorPass(array('required' => false)),
      'created_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vtp_products_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VtpProductsCategory';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'address'       => 'Text',
      'image_path'    => 'Text',
      'link'          => 'Text',
      'priority'      => 'Number',
      'is_active'     => 'Boolean',
      'is_home'       => 'Boolean',
      'lang'          => 'Text',
      'description'   => 'Text',
      'slug'          => 'Text',
      'portal_id'     => 'Number',
      'meta'          => 'Text',
      'keywords'      => 'Text',
      'parent_id'     => 'Number',
      'level'         => 'Number',
      'lat'           => 'Text',
      'log'           => 'Text',
      'parameter_ids' => 'Text',
      'list_image'    => 'Text',
      'email'         => 'Text',
      'msisdn'        => 'Text',
      'created_by'    => 'ForeignKey',
      'updated_by'    => 'ForeignKey',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
