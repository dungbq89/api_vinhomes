<?php

require_once dirname(__FILE__).'/../lib/adArticlesPublishGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adArticlesPublishGeneratorHelper.class.php';

/**
 * adArticlesPublish actions.
 *
 * @package    Vt_Portals
 * @subpackage adArticlesPublish
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adArticlesPublishActions extends autoAdArticlesPublishActions
{
    public function executeNew(sfWebRequest $request)
    {
        $this->redirect('@ad_article_adArticlesPublish');
        $this->sidebar_status = $this->configuration->getNewSidebarStatus();
        $this->form = $this->configuration->getForm();
        $this->ad_article = $this->form->getObject();
    }
    public function executeEdit(sfWebRequest $request)
    {
        $this->redirect('@ad_article_adArticlesPublish');
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_article = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->ad_article);
        $this->fields = $this->ad_article->getTable()->getColumnNames();
    }
    protected function getPager()
    {
        $query = $this->buildQuery();
        $user = sfContext::getInstance()->getUser();
        $id = $user->getGuardUser()->getId();
        $query->andWhere('is_active=?',  VtCommonEnum::NUMBER_TWO);
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());

        $query->orderBy('priority asc');

        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdArticle');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }




}
