<?php

/**
 * AdPhoto form base class.
 *
 * @method AdPhoto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdPhotoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'file_path'  => new sfWidgetFormInputText(),
      'album_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdAlbumPhoto'), 'add_empty' => true)),
      'extension'  => new sfWidgetFormInputText(),
      'priority'   => new sfWidgetFormInputText(),
      'is_active'  => new sfWidgetFormInputCheckbox(),
      'is_default' => new sfWidgetFormInputCheckbox(),
      'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'file_path'  => new sfValidatorString(array('max_length' => 255)),
      'album_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdAlbumPhoto'), 'required' => false)),
      'extension'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'priority'   => new sfValidatorInteger(),
      'is_active'  => new sfValidatorBoolean(array('required' => false)),
      'is_default' => new sfValidatorBoolean(array('required' => false)),
      'created_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdPhoto';
  }

}
