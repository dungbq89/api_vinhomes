<?php

/**
 * csdl_dmnghenghiep form base class.
 *
 * @method csdl_dmnghenghiep getObject() Returns the current form's model object
 *
 * @package    Web_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basecsdl_dmnghenghiepForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'tendanhmuc' => new sfWidgetFormInputText(),
      'gioithieu'  => new sfWidgetFormTextarea(),
      'anhdaidien' => new sfWidgetFormInputText(),
      'thutu'      => new sfWidgetFormInputText(),
      'trangthai'  => new sfWidgetFormInputText(),
      'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tendanhmuc' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'gioithieu'  => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'anhdaidien' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thutu'      => new sfValidatorInteger(array('required' => false)),
      'trangthai'  => new sfValidatorInteger(array('required' => false)),
      'created_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('csdl_dmnghenghiep[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'csdl_dmnghenghiep';
  }

}
