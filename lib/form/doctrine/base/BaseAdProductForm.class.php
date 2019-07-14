<?php

/**
 * AdProduct form base class.
 *
 * @method AdProduct getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'content'          => new sfWidgetFormTextarea(),
      'image_path'       => new sfWidgetFormInputText(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'is_hot'           => new sfWidgetFormInputCheckbox(),
      'lang'             => new sfWidgetFormInputText(),
      'category_id'      => new sfWidgetFormInputText(),
      'slug'             => new sfWidgetFormInputText(),
      'meta_keyword'     => new sfWidgetFormInputText(),
      'meta_description' => new sfWidgetFormInputText(),
      'price'            => new sfWidgetFormInputText(),
      'created_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'description'      => new sfValidatorString(array('required' => false)),
      'content'          => new sfValidatorString(array('required' => false)),
      'image_path'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'is_hot'           => new sfValidatorBoolean(array('required' => false)),
      'lang'             => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'category_id'      => new sfValidatorInteger(array('required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 255)),
      'meta_keyword'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'meta_description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price'            => new sfValidatorPass(array('required' => false)),
      'created_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AdProduct', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('ad_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdProduct';
  }

}
