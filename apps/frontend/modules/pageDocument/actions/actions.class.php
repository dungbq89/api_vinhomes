<?php

/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/14/15
 * Time: 2:01 PM
 */
class pageDocumentActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $form = new documentForm();
        $user = sfContext::getInstance()->getUser();
        if ($request->hasParameter('page') && $user->getAttribute('searchDoc', false)) {
            $values = $request->getParameter($form->getName());
            $values['category'] = $user->getAttribute('category');
            $values['keyword'] = $user->getAttribute('keyword');
            $form->bind($values);
            $limit = 20;
            $user->setAttribute('searchDoc', true);
            $user->setAttribute('category', $values['category']);
            $user->setAttribute('keyword', $values['keyword']);

            $this->page = $request->getParameter('page', 1);
            $query = AdDocumentTable::getListDocument($values['category'], $values['keyword'], $limit);
            $pager = new sfDoctrinePager('AdDocument', $limit);
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->listDocument = $this->pager->getResults();
        }

        if ($request->isMethod('POST')) {
            $values = $request->getParameter($form->getName());
            $form->bind($values);
            $limit = 20;
            $user->setAttribute('searchDoc', true);
            $user->setAttribute('category', $values['category']);
            $user->setAttribute('keyword', $values['keyword']);

            $this->page = $request->getParameter('page', 1);
            $query = AdDocumentTable::getListDocument($values['category'], $values['keyword'], $limit);
            $pager = new sfDoctrinePager('AdDocument', $limit);
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->listDocument = $this->pager->getResults();
        }
        $this->form = $form;
    }

    public function executeList(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        if ($id) {
            $category = AdDocumentCategoryTable::getCategoryDocumentById($id);
            if ($category) {
                $this->catName = $category->getName();
                $this->url_paging = 'category_document';
                $this->page = $this->getRequestParameter('page', 1);
                $pager = new sfDoctrinePager('AdDocument', 10);
                $pager->setQuery(AdDocumentTable::getDocumentByCatId($category->getId()));
                $pager->setPage($this->page);
                $pager->init();
                $this->pager = $pager;
                $this->listDocument = $pager->getResults();
            } else {
                return $this->redirect404();
            }

        } else {
            return $this->redirect404();
        }

    }

    public function executeDetail(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        if ($id) {
            $document = AdDocumentTable::getDocumentById($id)->fetchOne();
            if ($document) {
                $this->document = $document;
            } else {
                return $this->redirect404();
            }
        } else {
            return $this->redirect404();
        }
    }

    public function executeListDocument(sfWebRequest $request)
    {
        $limit = 9;
        $this->page = $page = $request->getParameter('page');
        $cat = trim($request->getParameter('cat', ''));
        $this->cat = false;
        if ($cat) $this->cat = $cat;
        $cate = AdDocumentCategoryTable::getCateById($cat);
        $pager = AdDocumentDownloadTable::getInstance()->getListDocumentDownload($limit, $page, $cat);
        $this->pager = $pager;
        $seoHomePage = VtSEO::getSeoCatDocument($cate[0]);
        if($seoHomePage){
            $this->returnHtmlSeoPage($seoHomePage);
        }
    }

    public function executeListStudent(sfWebRequest $request)
    {
        $limit = 9;
        $this->page = $page = $request->getParameter('page');
        $pager = AdHocVienTable::getInstance()->getListStudent($limit, $page);
        $this->pager = $pager;
        $seoHomePage = VtSEO::getSeoHomepage();
        if($seoHomePage){
            $this->returnHtmlSeoPage($seoHomePage);
        }
    }

    public function executeDetailStudent(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        $student = AdHocVienTable::getInstance()->createQuery()->andWhere('id=?', $id)
            ->andWhere('is_active=?', 1)->fetchArray();
        if (!empty($student)) {
            $this->student = $student[0];
        } else {
            return $this->redirect404();
        }
        $seoHomePage = VtSEO::getSeoHomepage();
        if($seoHomePage){
            $this->returnHtmlSeoPage($seoHomePage);
        }
    }

    //render meta tag
    public function returnHtmlSeoPage($seo_homepage)
    {
        $this->getResponse()->setTitle($seo_homepage['title']);
        $this->getResponse()->addMeta('description', $seo_homepage['description']);
        $this->getResponse()->addMeta('keywords', $seo_homepage['keywords']);
        $this->getResponse()->addMeta('og:url', $seo_homepage['og_url']);
        $this->getResponse()->addMeta('og:description', $seo_homepage['og_description']);
        $this->getResponse()->addMeta('og:image', $seo_homepage['og_image']);
        $this->getResponse()->addMeta('og:title', $seo_homepage['og_title']);
        $this->getResponse()->addMeta('og:site_name', $seo_homepage['og_site_name']);
        $this->getResponse()->addMeta('dc.title', $seo_homepage['dc_title']);
        $this->getResponse()->addMeta('dc.keywords', $seo_homepage['dc_keywords']);
        $this->getResponse()->addMeta('news_keywords', $seo_homepage['news_keywords']);
    }
}