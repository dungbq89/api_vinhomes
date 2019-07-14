<?php

/**
 * VtpProducts form base class.
 *
 * @method VtpProducts getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVtpProductsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'product_name'         => new sfWidgetFormInputText(),
      'product_code'         => new sfWidgetFormInputText(),
      'category_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VtpProducts'), 'add_empty' => true)),
      'price'                => new sfWidgetFormInputText(),
      'price_promotion'      => new sfWidgetFormInputText(),
      'image_path'           => new sfWidgetFormInputText(),
      'link'                 => new sfWidgetFormInputText(),
      'priority'             => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'content'              => new sfWidgetFormTextarea(),
      'comment'              => new sfWidgetFormTextarea(),
      'warranty_information' => new sfWidgetFormTextarea(),
      'manufacturer'         => new sfWidgetFormInputText(),
      'do_day'               => new sfWidgetFormInputText(),
      'trong_luong'          => new sfWidgetFormInputText(),
      'duong_kinh_trong'     => new sfWidgetFormInputText(),
      'duong_kinh_ngoai'     => new sfWidgetFormInputText(),
      'chung_loai'           => new sfWidgetFormInputText(),
      'accessories'          => new sfWidgetFormInputText(),
      'is_active'            => new sfWidgetFormInputCheckbox(),
      'is_home'              => new sfWidgetFormInputCheckbox(),
      'is_hot'               => new sfWidgetFormInputCheckbox(),
      'slug'                 => new sfWidgetFormInputText(),
      'portal_id'            => new sfWidgetFormInputText(),
      'lang'                 => new sfWidgetFormInputText(),
      'meta'                 => new sfWidgetFormInputText(),
      'keywords'             => new sfWidgetFormInputText(),
      'created_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'product_name'         => new sfValidatorString(array('max_length' => 255)),
      'product_code'         => new sfValidatorString(array('max_length' => 100)),
      'category_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VtpProducts'), 'required' => false)),
      'price'                => new sfValidatorInteger(array('required' => false)),
      'price_promotion'      => new sfValidatorInteger(array('required' => false)),
      'image_path'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'priority'             => new sfValidatorInteger(array('required' => false)),
      'description'          => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'content'              => new sfValidatorString(array('required' => false)),
      'comment'              => new sfValidatorString(array('required' => false)),
      'warranty_information' => new sfValidatorString(array('required' => false)),
      'manufacturer'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'do_day'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'trong_luong'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'duong_kinh_trong'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'duong_kinh_ngoai'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'chung_loai'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'accessories'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'            => new sfValidatorBoolean(array('required' => false)),
      'is_home'              => new sfValidatorBoolean(array('required' => false)),
      'is_hot'               => new sfValidatorBoolean(array('required' => false)),
      'slug'                 => new sfValidatorString(array('max_length' => 255)),
      'portal_id'            => new sfValidatorInteger(array('required' => false)),
      'lang'                 => new sfValidatorString(array('max_length' => 10)),
      'meta'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'VtpProducts', 'column' => array('product_name'))),
        new sfValidatorDoctrineUnique(array('model' => 'VtpProducts', 'column' => array('product_code'))),
        new sfValidatorDoctrineUnique(array('model' => 'VtpProducts', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('vtp_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VtpProducts';
  }

}
