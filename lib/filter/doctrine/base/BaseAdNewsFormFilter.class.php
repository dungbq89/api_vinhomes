<?php

/**
 * AdNews filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdNewsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alttitle'        => new sfWidgetFormFilterInput(),
      'header'          => new sfWidgetFormFilterInput(),
      'body'            => new sfWidgetFormFilterInput(),
      'image_path'      => new sfWidgetFormFilterInput(),
      'attributes'      => new sfWidgetFormFilterInput(),
      'priority'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'published_time'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'expiredate_time' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'meta'            => new sfWidgetFormFilterInput(),
      'keywords'        => new sfWidgetFormFilterInput(),
      'author'          => new sfWidgetFormFilterInput(),
      'is_active'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_hot'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'lang'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'category_id'     => new sfWidgetFormFilterInput(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'           => new sfValidatorPass(array('required' => false)),
      'alttitle'        => new sfValidatorPass(array('required' => false)),
      'header'          => new sfValidatorPass(array('required' => false)),
      'body'            => new sfValidatorPass(array('required' => false)),
      'image_path'      => new sfValidatorPass(array('required' => false)),
      'attributes'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'priority'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'published_time'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'expiredate_time' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'meta'            => new sfValidatorPass(array('required' => false)),
      'keywords'        => new sfValidatorPass(array('required' => false)),
      'author'          => new sfValidatorPass(array('required' => false)),
      'is_active'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_hot'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'lang'            => new sfValidatorPass(array('required' => false)),
      'slug'            => new sfValidatorPass(array('required' => false)),
      'category_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_news_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNews';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'title'           => 'Text',
      'alttitle'        => 'Text',
      'header'          => 'Text',
      'body'            => 'Text',
      'image_path'      => 'Text',
      'attributes'      => 'Number',
      'priority'        => 'Number',
      'published_time'  => 'Date',
      'expiredate_time' => 'Date',
      'meta'            => 'Text',
      'keywords'        => 'Text',
      'author'          => 'Text',
      'is_active'       => 'Number',
      'is_hot'          => 'Boolean',
      'lang'            => 'Text',
      'slug'            => 'Text',
      'category_id'     => 'Number',
      'created_by'      => 'ForeignKey',
      'updated_by'      => 'ForeignKey',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
