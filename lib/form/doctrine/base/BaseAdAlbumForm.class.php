<?php

/**
 * AdAlbum form base class.
 *
 * @method AdAlbum getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdAlbumForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'event_date'  => new sfWidgetFormDateTime(),
      'priority'    => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'is_default'  => new sfWidgetFormInputCheckbox(),
      'image_path'  => new sfWidgetFormInputText(),
      'lang'        => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('max_length' => 1000)),
      'event_date'  => new sfValidatorDateTime(),
      'priority'    => new sfValidatorInteger(),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'is_default'  => new sfValidatorBoolean(array('required' => false)),
      'image_path'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'        => new sfValidatorString(array('max_length' => 10)),
      'slug'        => new sfValidatorString(array('max_length' => 255)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AdAlbum', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('ad_album[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdAlbum';
  }

}
