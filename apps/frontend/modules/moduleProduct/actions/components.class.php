<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 5/13/14
 * Time: 5:35 PM
 * To change this template use File | Settings | File Templates.
 */
class moduleProductComponents extends sfComponents {

    public function executeHomeProduct() {
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 9;
        $products = VtpProductsTable::getHomeProducts($limit);
        if (!count($products))
            return sfView::NONE;

        $this->products = $products;
    }

    public function executeProductNew() {
        $productsHot = VtpProductsTable::getProductSpecialHome(8)->execute();
        $productsNew = VtpProductsTable::getProductHome(8)->execute();
        if ($productsHot || $productsNew){
            $this->productsNew = $productsNew;
            $this->productsHot = $productsHot;
        }else{
            return sfView::NONE;
        }
    }

    //Trang danh sach san pham
    public function executeListProduct($request) {
        $max_row = $this->getVar('limit', 8);
        $slug = $request->getParameter('slug');
        $cateProduct = VtpProductsCategoryTable::getCategoryProductBySlug($slug);
        if ($cateProduct) {
            $this->catName = $cateProduct->getName();
            $this->page = $this->getRequestParameter('page', 1);
            $pager = new sfDoctrinePager('VtpProducts', $max_row);
            $query = VtpProductsTable::getListProducts(VtCommonEnum::portalDefault, $slug);
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->url_paging = $this->getVar('url_paging');
            $this->listProduct = $pager->getResults();
        } else {
            return sfView::NONE;
        }
    }

    /**
     * @param sfRequest $request
     */
    public function executeListProductCategory(sfRequest $request) {
        $this->products_category = VtpProductsCategoryTable::getListProductCategoryAll();
    }

    public static function getListProductByCategory($catId) {
        $product = VtpProductsTable::getProductByCatId($catId, VtCommonEnum::portalDefault);
        if ($product) {
            return $product;
        }
        return null;
    }

    /**
     *  Trang chi tiet san pham
     * @param $request
     */
    public function executeProductDetail($request) {
        if ($request->hasParameter('slug')) {
            $slug = $request->getParameter('slug');
            if ($slug) {
                $product = VtpProductsTable::getProductbySlug($slug, VtCommonEnum::portalDefault);
                if ($product) {
                    $this->product = $product;
                    $productImages = VtpProductImageTable::getImagesByProductId($product->getId());
                    if ($productImages) {
                        $this->productImages = $productImages;
                    }
                }
                else{
                    
                }
            } else {
                
            }
        }
    }

    public function executeProductMenu(){
        $productCategory = VtpProductsCategoryTable::getCategoryByLevel(0,10)->execute();
        if(count($productCategory) > 0){
            $this->productCategory = $productCategory;
        }
        else{
            return sfView::NONE;
        }
    }

    public function executeProductCategoryHome(){
        $productCategory = VtpProductsCategoryTable::getProductCategoryHome('',10)->execute();
        if(count($productCategory) > 0){
            $this->productCategory = $productCategory;
        }
        else{
            return sfView::NONE;
        }
    }

    public function executeBoxSupport(){

    }

    public function executePartner()
    {

    }

    public function executeProductItem($request){
        $product = $this->getVar('product');
        if($product){
            $this->product = $product;
            $this->image = '/uploads/' . sfConfig::get('app_product_images') . $product->getImagePath();
            $percent = 0;
            if ($product->price_promotion && $product->price_promotion != 0) {
                if ($product->price && $product->price != 0) {
                    $subPer = intval($product->price) - intval($product->price_promotion);
                    $percent = round(($subPer / $product->price) * 100);
                }
            }
            $this->percent = $percent;
        }else{
            return sfView::NONE;
        }
    }
}
