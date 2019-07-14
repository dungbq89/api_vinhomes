<?php

/**
 * AdDocument form base class.
 *
 * @method AdDocument getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdDocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'file_path'       => new sfWidgetFormInputText(),
      'extension'       => new sfWidgetFormInputText(),
      'document_number' => new sfWidgetFormInputText(),
      'document_date'   => new sfWidgetFormDateTime(),
      'priority'        => new sfWidgetFormInputText(),
      'category_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdDocCategory'), 'add_empty' => true)),
      'is_home'         => new sfWidgetFormInputCheckbox(),
      'is_active'       => new sfWidgetFormInputCheckbox(),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'description'     => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'file_path'       => new sfValidatorString(array('max_length' => 255)),
      'extension'       => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'document_number' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'document_date'   => new sfValidatorDateTime(array('required' => false)),
      'priority'        => new sfValidatorInteger(array('required' => false)),
      'category_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdDocCategory'), 'required' => false)),
      'is_home'         => new sfValidatorBoolean(array('required' => false)),
      'is_active'       => new sfValidatorBoolean(array('required' => false)),
      'created_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdDocument';
  }

}
