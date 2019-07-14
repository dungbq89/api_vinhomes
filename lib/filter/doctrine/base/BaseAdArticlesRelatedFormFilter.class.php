<?php

/**
 * AdArticlesRelated filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdArticlesRelatedFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'article_id'         => new sfWidgetFormFilterInput(),
      'related_article_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'article_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'related_article_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ad_articles_related_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdArticlesRelated';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'article_id'         => 'Number',
      'related_article_id' => 'Number',
    );
  }
}
