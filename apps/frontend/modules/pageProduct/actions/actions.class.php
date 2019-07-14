<?php

/**
 * pageProduct actions.
 *
 * @package    Vt_Portals
 * @subpackage pageProduct
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageProductActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $this->page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $max_row = 12;
        $slug = $request->getParameter('slug');
        $cateProduct = VtpProductsCategoryTable::getCategoryProductBySlug($slug);
        if ($cateProduct) {
            $seoCat = VtSEO::getSeoCategory($cateProduct);
            if ($seoCat) {
                $this->returnHtmlSeoPage($seoCat);
            }
            $this->catName = $cateProduct->getName();
            $this->page = $this->getRequestParameter('page', 1);
            $pager = new sfDoctrinePager('VtpProducts', $max_row);
            //$query = VtpProductsTable::getListProducts(VtCommonEnum::portalDefault, $slug);
			$query = VtpProductsTable::getAllProductByCategory($cateProduct->getId());
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->url_paging = 'products';
            $this->listProduct = $pager->getResults();
        } else {
            return $this->redirect404();
        }
    }

    public function executeDetail(sfWebRequest $request)
    {
        $this->page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $slug = $this->slug = $request->getParameter('slug');
        if ($slug) {
            $product = VtpProductsTable::getProductbySlug($slug, VtCommonEnum::portalDefault);
            if ($product) {
                $seoCat = VtSEO::getSeoProductDetail($product);
                if ($seoCat) {
                    $this->returnHtmlSeoPage($seoCat);
                }
                $this->product = $product;
                $productImages = VtpProductImageTable::getImagesByProductId($product->getId());
                if ($productImages) {
                    $this->productImages = $productImages;
                }
            } else {
                return $this->redirect404();
            }
        } else {
            return $this->redirect404();
        }
    }

    public function executeList(sfWebRequest $request)
    {
        $this->page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $max_row = 20;
        $this->catName = 'Sản Phẩm';
        $this->page = $this->getRequestParameter('page', 1);
        $pager = new sfDoctrinePager('VtpProducts', $max_row);
        $query = VtpProductsTable::getListProducts(VtCommonEnum::portalDefault, '');
        $pager->setQuery($query);
        $pager->setPage($this->page);
        $pager->init();
        $this->pager = $pager;
        $this->url_paging = 'product_all';
        $this->listProduct = $pager->getResults();
    }

    //render meta tag
    public function returnHtmlSeoPage($seoPage)
    {
        $this->getResponse()->setTitle($seoPage['title']);
        $this->getResponse()->addMeta('description', $seoPage['description']);
        $this->getResponse()->addMeta('keywords', $seoPage['keywords']);
        $this->getResponse()->addMeta('og:url', $seoPage['og_url']);
        $this->getResponse()->addMeta('og:description', $seoPage['og_description']);
        $this->getResponse()->addMeta('og:image', $seoPage['og_image']);
        $this->getResponse()->addMeta('og:title', $seoPage['og_title']);
        $this->getResponse()->addMeta('og:site_name', $seoPage['og_site_name']);
        $this->getResponse()->addMeta('dc.title', $seoPage['dc_title']);
        $this->getResponse()->addMeta('dc.keywords', $seoPage['dc_keywords']);
        $this->getResponse()->addMeta('news_keywords', $seoPage['news_keywords']);
    }

}
