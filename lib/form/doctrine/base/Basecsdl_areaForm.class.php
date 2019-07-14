<?php

/**
 * csdl_area form base class.
 *
 * @method csdl_area getObject() Returns the current form's model object
 *
 * @package    Web_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basecsdl_areaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'PROVINCE'     => new sfWidgetFormInputText(),
      'DISTRICT'     => new sfWidgetFormInputText(),
      'PRECINCT'     => new sfWidgetFormInputText(),
      'STREET_BLOCK' => new sfWidgetFormInputText(),
      'STREET'       => new sfWidgetFormInputText(),
      'NAME'         => new sfWidgetFormInputText(),
      'FULL_NAME'    => new sfWidgetFormInputText(),
      'STATUS'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'PROVINCE'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'DISTRICT'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'PRECINCT'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'STREET_BLOCK' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'STREET'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'NAME'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'FULL_NAME'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'STATUS'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('csdl_area[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'csdl_area';
  }

}
