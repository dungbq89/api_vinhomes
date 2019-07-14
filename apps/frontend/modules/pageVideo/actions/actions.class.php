<?php

/**
 * moduleVideo actions.
 *
 * @package    Vt_Portals
 * @subpackage moduleVideo
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageVideoActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $limit = sfConfig::get('app_limit_videos', 9);
        $pager = AdYoutubeTable::getInstance()->getListSqlVideoYT($limit, $request->getParameter('page', 1));
        $this->pager = $pager;
        $seoHomePage = VtSEO::getSeoHomepage();
        if($seoHomePage){
            $this->returnHtmlSeoPage($seoHomePage);
        }
    }

    public function executeVideoDetail(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug');
        $this->video = AdYoutubeTable::getInstance()->getVideoYTBySlug($slug);
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