<?php

/**
 * AdCategory form base class.
 *
 * @method AdCategory getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'image_path'  => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'lang'        => new sfWidgetFormInputText(),
      'parent_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdParentCategory'), 'add_empty' => true)),
      'slug'        => new sfWidgetFormInputText(),
      'link'        => new sfWidgetFormInputText(),
      'level'       => new sfWidgetFormInputText(),
      'priority'    => new sfWidgetFormInputText(),
      'is_category' => new sfWidgetFormInputCheckbox(),
      'is_hot'      => new sfWidgetFormInputCheckbox(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('required' => false)),
      'image_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'lang'        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'parent_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdParentCategory'), 'required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255)),
      'link'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'level'       => new sfValidatorInteger(array('required' => false)),
      'priority'    => new sfValidatorInteger(),
      'is_category' => new sfValidatorBoolean(array('required' => false)),
      'is_hot'      => new sfValidatorBoolean(array('required' => false)),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AdCategory', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('ad_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdCategory';
  }

}
