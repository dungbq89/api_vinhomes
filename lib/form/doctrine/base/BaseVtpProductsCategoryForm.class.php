<?php

/**
 * VtpProductsCategory form base class.
 *
 * @method VtpProductsCategory getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVtpProductsCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'address'       => new sfWidgetFormInputText(),
      'image_path'    => new sfWidgetFormInputText(),
      'link'          => new sfWidgetFormInputText(),
      'priority'      => new sfWidgetFormInputText(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'is_home'       => new sfWidgetFormInputCheckbox(),
      'lang'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'slug'          => new sfWidgetFormInputText(),
      'portal_id'     => new sfWidgetFormInputText(),
      'meta'          => new sfWidgetFormInputText(),
      'keywords'      => new sfWidgetFormInputText(),
      'parent_id'     => new sfWidgetFormInputText(),
      'level'         => new sfWidgetFormInputText(),
      'lat'           => new sfWidgetFormInputText(),
      'log'           => new sfWidgetFormInputText(),
      'parameter_ids' => new sfWidgetFormInputText(),
      'list_image'    => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      'msisdn'        => new sfWidgetFormInputText(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image_path'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'priority'      => new sfValidatorInteger(array('required' => false)),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
      'is_home'       => new sfValidatorBoolean(array('required' => false)),
      'lang'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'slug'          => new sfValidatorString(array('max_length' => 255)),
      'portal_id'     => new sfValidatorInteger(array('required' => false)),
      'meta'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parent_id'     => new sfValidatorInteger(array('required' => false)),
      'level'         => new sfValidatorInteger(array('required' => false)),
      'lat'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'log'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parameter_ids' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'list_image'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'msisdn'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'VtpProductsCategory', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('vtp_products_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VtpProductsCategory';
  }

}
