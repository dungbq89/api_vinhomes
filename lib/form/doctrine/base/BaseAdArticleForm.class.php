<?php

/**
 * AdArticle form base class.
 *
 * @method AdArticle getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdArticleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'title'                 => new sfWidgetFormTextarea(),
      'alttitle'              => new sfWidgetFormInputText(),
      'header'                => new sfWidgetFormTextarea(),
      'body'                  => new sfWidgetFormTextarea(),
      'image_path'            => new sfWidgetFormInputText(),
      'attributes'            => new sfWidgetFormInputText(),
      'hit_count'             => new sfWidgetFormInputText(),
      'priority'              => new sfWidgetFormInputText(),
      'published_time'        => new sfWidgetFormDateTime(),
      'expiredate_time'       => new sfWidgetFormDateTime(),
      'meta'                  => new sfWidgetFormInputText(),
      'keywords'              => new sfWidgetFormInputText(),
      'author'                => new sfWidgetFormInputText(),
      'other_link'            => new sfWidgetFormTextarea(),
      'is_active'             => new sfWidgetFormInputText(),
      'is_hot'                => new sfWidgetFormInputCheckbox(),
      'lang'                  => new sfWidgetFormInputText(),
      'slug'                  => new sfWidgetFormInputText(),
      'category_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdArticleCategory'), 'add_empty' => true)),
      'created_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
      'updated_by'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'articles_related_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'AdArticle')),
      'related_articles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'AdArticle')),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'                 => new sfValidatorString(array('max_length' => 512)),
      'alttitle'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'header'                => new sfValidatorString(array('required' => false)),
      'body'                  => new sfValidatorString(array('required' => false)),
      'image_path'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'attributes'            => new sfValidatorInteger(array('required' => false)),
      'hit_count'             => new sfValidatorInteger(array('required' => false)),
      'priority'              => new sfValidatorInteger(),
      'published_time'        => new sfValidatorDateTime(array('required' => false)),
      'expiredate_time'       => new sfValidatorDateTime(array('required' => false)),
      'meta'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'keywords'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'other_link'            => new sfValidatorString(array('required' => false)),
      'is_active'             => new sfValidatorInteger(array('required' => false)),
      'is_hot'                => new sfValidatorBoolean(array('required' => false)),
      'lang'                  => new sfValidatorString(array('max_length' => 10)),
      'slug'                  => new sfValidatorString(array('max_length' => 255)),
      'category_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdArticleCategory'), 'required' => false)),
      'created_by'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'required' => false)),
      'updated_by'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
      'articles_related_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'AdArticle', 'required' => false)),
      'related_articles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'AdArticle', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AdArticle', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('ad_article[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdArticle';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['articles_related_list']))
    {
      $this->setDefault('articles_related_list', $this->object->ArticlesRelated->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['related_articles_list']))
    {
      $this->setDefault('related_articles_list', $this->object->RelatedArticles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticlesRelatedList($con);
    $this->saveRelatedArticlesList($con);

    parent::doSave($con);
  }

  public function saveArticlesRelatedList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['articles_related_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ArticlesRelated->getPrimaryKeys();
    $values = $this->getValue('articles_related_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ArticlesRelated', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ArticlesRelated', array_values($link));
    }
  }

  public function saveRelatedArticlesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['related_articles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->RelatedArticles->getPrimaryKeys();
    $values = $this->getValue('related_articles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('RelatedArticles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('RelatedArticles', array_values($link));
    }
  }

}
