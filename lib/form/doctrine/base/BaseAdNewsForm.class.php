<?php

/**
 * AdNews form base class.
 *
 * @method AdNews getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdNewsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'title'           => new sfWidgetFormTextarea(),
      'alttitle'        => new sfWidgetFormInputText(),
      'header'          => new sfWidgetFormTextarea(),
      'body'            => new sfWidgetFormTextarea(),
      'image_path'      => new sfWidgetFormInputText(),
      'attributes'      => new sfWidgetFormInputText(),
      'priority'        => new sfWidgetFormInputText(),
      'published_time'  => new sfWidgetFormDateTime(),
      'expiredate_time' => new sfWidgetFormDateTime(),
      'meta'            => new sfWidgetFormInputText(),
      'keywords'        => new sfWidgetFormInputText(),
      'author'          => new sfWidgetFormInputText(),
      'is_active'       => new sfWidgetFormInputText(),
      'is_hot'          => new sfWidgetFormInputCheckbox(),
      'lang'            => new sfWidgetFormInputText(),
      'slug'            => new sfWidgetFormInputText(),
      'category_id'     => new sfWidgetFormInputText(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 512)),
      'alttitle'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'header'          => new sfValidatorString(array('required' => false)),
      'body'            => new sfValidatorString(array('required' => false)),
      'image_path'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'attributes'      => new sfValidatorInteger(array('required' => false)),
      'priority'        => new sfValidatorInteger(),
      'published_time'  => new sfValidatorDateTime(array('required' => false)),
      'expiredate_time' => new sfValidatorDateTime(array('required' => false)),
      'meta'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'       => new sfValidatorInteger(array('required' => false)),
      'is_hot'          => new sfValidatorBoolean(array('required' => false)),
      'lang'            => new sfValidatorString(array('max_length' => 10)),
      'slug'            => new sfValidatorString(array('max_length' => 255)),
      'category_id'     => new sfValidatorInteger(array('required' => false)),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AdNews', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('ad_news[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNews';
  }

}
