<?php

/**
 * AdManageFile form base class.
 *
 * @method AdManageFile getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdManageFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'article_id'   => new sfWidgetFormInputText(),
      'short_url'    => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'type'         => new sfWidgetFormInputText(),
      'duration'     => new sfWidgetFormInputText(),
      'position'     => new sfWidgetFormInputText(),
      'type_product' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'article_id'   => new sfValidatorInteger(array('required' => false)),
      'short_url'    => new sfValidatorString(array('max_length' => 255)),
      'description'  => new sfValidatorString(array('required' => false)),
      'type'         => new sfValidatorInteger(array('required' => false)),
      'duration'     => new sfValidatorInteger(array('required' => false)),
      'position'     => new sfValidatorInteger(array('required' => false)),
      'type_product' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ad_manage_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdManageFile';
  }

}
