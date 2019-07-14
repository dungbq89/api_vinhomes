<?php

/**
 * AdHtml form base class.
 *
 * @method AdHtml getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdHtmlForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'image_path'  => new sfWidgetFormInputText(),
      'content'     => new sfWidgetFormTextarea(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'lang'        => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'prefix_path' => new sfWidgetFormInputText(),
      'created_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'image_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'     => new sfValidatorString(array('required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'lang'        => new sfValidatorString(array('max_length' => 10)),
      'slug'        => new sfValidatorString(array('max_length' => 255)),
      'prefix_path' => new sfValidatorString(array('max_length' => 255)),
      'created_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AdHtml', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('ad_html[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdHtml';
  }

}
