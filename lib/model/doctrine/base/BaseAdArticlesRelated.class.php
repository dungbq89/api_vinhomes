<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AdArticlesRelated', 'doctrine');

/**
 * BaseAdArticlesRelated
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $article_id
 * @property integer $related_article_id
 * 
 * @method integer           getArticleId()          Returns the current record's "article_id" value
 * @method integer           getRelatedArticleId()   Returns the current record's "related_article_id" value
 * @method AdArticlesRelated setArticleId()          Sets the current record's "article_id" value
 * @method AdArticlesRelated setRelatedArticleId()   Sets the current record's "related_article_id" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAdArticlesRelated extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ad_article_related');
        $this->hasColumn('article_id', 'integer', null, array(
             'type' => 'integer',
             'comment' => 'Id của bài tin tức',
             ));
        $this->hasColumn('related_article_id', 'integer', null, array(
             'type' => 'integer',
             'comment' => 'Id của bài viết liên quan',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}