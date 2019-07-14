<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 5/7/14
 * Time: 2:56 PM
 * To change this template use File | Settings | File Templates.
 */
class moduleArticleComponents extends sfComponents
{
    public function executeNewArticle(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 10;
        $attributes=$this->getVar('att');
        if (!isset($attributes))
            $attributes = 1;
        $articles = AdArticleTable::getRandomArticle($attributes,$limit);
        if($articles){
            $this->articles = $articles;
        }
        else{
            return sfView::NONE;
        }
    }

    public function executeHotArticle(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 4;
        $articles = AdArticleTable::getHotArticle($limit);
        if($articles){
            $this->articles = $articles;
        }
        else{
            return sfView::NONE;
        }
    }

    public function executeCategoryNews(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 10;
        $categories = AdCategoryTable::getCategoryFrontend($limit)->execute();
        if($categories){
            $this->categories = $categories;
        }
        else{
            return sfView::NONE;
        }
    }

    public function executeCategoryHot(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 5;
        $categories = AdCategoryTable::getCategoryFrontendHot($limit)->execute();
        if($categories){
            $this->categories = $categories;
        }
        else{
            return sfView::NONE;
        }
    }
    //tin tieu diem
    public function executeFocusNews(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 5;
        $attributes=$this->getVar('att');
        if (!isset($attributes))
            $attributes = 8;
        $articles = AdArticleTable::getRandomArticle($attributes,$limit);
        if($articles){
            $this->articles = $articles;
        }
        else{
            return sfView::NONE;
        }
    }
    public function executeNewsImages(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 10;
        $attributes=$this->getVar('att');
        if (!isset($attributes))
            $attributes = 2;
        $articles = AdArticleTable::getRandomArticle($attributes,$limit);
        if($articles){
            $this->articles = $articles;
        }
        else{
            return sfView::NONE;
        }
    }
    //tin xem nhieu
    public function executeMostViewNews(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 10;
        $articles = AdArticleTable::getMostViewNews($limit)->fetchArray();
        if($articles){
            $this->articles = $articles;
        }
        else{
            return sfView::NONE;
        }
    }

    //tin doc nhieu
    public function executeReadNews(sfWebRequest $request){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 10;
        $articles = AdArticleTable::getMostViewNews($limit)->fetchArray();
        if($articles){
            $this->articles = $articles;
        }
        else{
            return sfView::NONE;
        }
    }
}