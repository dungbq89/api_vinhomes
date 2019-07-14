<?php

/**
 * VtpProducts filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVtpProductsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product_code'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'category_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VtpProducts'), 'add_empty' => true)),
      'price'                => new sfWidgetFormFilterInput(),
      'price_promotion'      => new sfWidgetFormFilterInput(),
      'image_path'           => new sfWidgetFormFilterInput(),
      'link'                 => new sfWidgetFormFilterInput(),
      'priority'             => new sfWidgetFormFilterInput(),
      'description'          => new sfWidgetFormFilterInput(),
      'content'              => new sfWidgetFormFilterInput(),
      'comment'              => new sfWidgetFormFilterInput(),
      'warranty_information' => new sfWidgetFormFilterInput(),
      'manufacturer'         => new sfWidgetFormFilterInput(),
      'do_day'               => new sfWidgetFormFilterInput(),
      'trong_luong'          => new sfWidgetFormFilterInput(),
      'duong_kinh_trong'     => new sfWidgetFormFilterInput(),
      'duong_kinh_ngoai'     => new sfWidgetFormFilterInput(),
      'chung_loai'           => new sfWidgetFormFilterInput(),
      'accessories'          => new sfWidgetFormFilterInput(),
      'is_active'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_home'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_hot'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'slug'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'portal_id'            => new sfWidgetFormFilterInput(),
      'lang'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'meta'                 => new sfWidgetFormFilterInput(),
      'keywords'             => new sfWidgetFormFilterInput(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'product_name'         => new sfValidatorPass(array('required' => false)),
      'product_code'         => new sfValidatorPass(array('required' => false)),
      'category_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('VtpProducts'), 'column' => 'id')),
      'price'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price_promotion'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image_path'           => new sfValidatorPass(array('required' => false)),
      'link'                 => new sfValidatorPass(array('required' => false)),
      'priority'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'          => new sfValidatorPass(array('required' => false)),
      'content'              => new sfValidatorPass(array('required' => false)),
      'comment'              => new sfValidatorPass(array('required' => false)),
      'warranty_information' => new sfValidatorPass(array('required' => false)),
      'manufacturer'         => new sfValidatorPass(array('required' => false)),
      'do_day'               => new sfValidatorPass(array('required' => false)),
      'trong_luong'          => new sfValidatorPass(array('required' => false)),
      'duong_kinh_trong'     => new sfValidatorPass(array('required' => false)),
      'duong_kinh_ngoai'     => new sfValidatorPass(array('required' => false)),
      'chung_loai'           => new sfValidatorPass(array('required' => false)),
      'accessories'          => new sfValidatorPass(array('required' => false)),
      'is_active'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_home'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_hot'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'slug'                 => new sfValidatorPass(array('required' => false)),
      'portal_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lang'                 => new sfValidatorPass(array('required' => false)),
      'meta'                 => new sfValidatorPass(array('required' => false)),
      'keywords'             => new sfValidatorPass(array('required' => false)),
      'created_by'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreatedBy'), 'column' => 'id')),
      'updated_by'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UpdatedBy'), 'column' => 'id')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('vtp_products_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VtpProducts';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'product_name'         => 'Text',
      'product_code'         => 'Text',
      'category_id'          => 'ForeignKey',
      'price'                => 'Number',
      'price_promotion'      => 'Number',
      'image_path'           => 'Text',
      'link'                 => 'Text',
      'priority'             => 'Number',
      'description'          => 'Text',
      'content'              => 'Text',
      'comment'              => 'Text',
      'warranty_information' => 'Text',
      'manufacturer'         => 'Text',
      'do_day'               => 'Text',
      'trong_luong'          => 'Text',
      'duong_kinh_trong'     => 'Text',
      'duong_kinh_ngoai'     => 'Text',
      'chung_loai'           => 'Text',
      'accessories'          => 'Text',
      'is_active'            => 'Boolean',
      'is_home'              => 'Boolean',
      'is_hot'               => 'Boolean',
      'slug'                 => 'Text',
      'portal_id'            => 'Number',
      'lang'                 => 'Text',
      'meta'                 => 'Text',
      'keywords'             => 'Text',
      'created_by'           => 'ForeignKey',
      'updated_by'           => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
