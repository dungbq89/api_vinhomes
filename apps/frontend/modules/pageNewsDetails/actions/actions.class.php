<?php

/**
 * pageNewsDetails actions.
 *
 * @package    Vt_Portals
 * @subpackage pageNewsDetails
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageNewsDetailsActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        //lay thong tin chi tiet bai viet
        $articleId=0;
        $slug = $request->getParameter('slug');
        if($slug){
            $article = AdArticleTable::getArticleBySlug($slug);
            if($article){
                $this->article = $article;
                $seoArticle = VtSEO::getSeoArticle($article);
                if($seoArticle){
                    $this->returnHtmlSeoPage($seoArticle);
                }
            }
            else{
                return $this->redirect404();
            }

        }
        else{
            return $this->redirect404();
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
