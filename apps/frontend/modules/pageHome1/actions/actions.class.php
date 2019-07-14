<?php

/**
 * pageHome actions.
 *
 * @package    VTP2.0
 * @subpackage pageHome
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageHomeActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
//        var_dump(sfContext::getInstance()->getUser()->getCulture());
        //seo trang chu
//        $seoHomePage = VtSEO::getSeoHomepage();
//        if($seoHomePage){
//            $this->returnHtmlSeoPage($seoHomePage);
//        }
//        //Lấy danh sách sản phẩm theo chuyên mục
//        $productCategory = VtpProductsCategoryTable::getProductCategoryHome('',4)->execute();
//        $this->productCategory = $productCategory;
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

    public function executeGetProductByCatId(sfWebRequest $request){
        $id = $request->getParameter('catid');
        $strProduct = "<option selected='selected' value=''>Chọn loại phòng</option>";
        if($id){
            $products = VtpProductsTable::getProductByCatId($id, 50)->fetchArray();
            if(count($products)>0){
                $strProduct = "";
                foreach($products as $value){
                    $strProduct .= "<option value=".$value['id'].">".$value['product_name']."</option>";
                }
            }
        }
        return $this->renderText(json_encode($strProduct));
    }
}
