<?php

/**
 * VtpCategoryPermission filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVtpCategoryPermissionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id'   => new sfWidgetFormFilterInput(),
      'permission_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'category_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'permission_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('vtp_category_permission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VtpCategoryPermission';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'category_id'   => 'Number',
      'permission_id' => 'Number',
    );
  }
}
