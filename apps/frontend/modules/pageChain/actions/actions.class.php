<?php

/**
 * pageProduct actions.
 *
 * @package    Vt_Portals
 * @subpackage pageProduct
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageChainActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        try {
            $max_row = 16;
            $this->page = $this->getRequestParameter('page', 1);
            $pager = new sfDoctrinePager('VtpProductsCategory', $max_row);
            $query = VtpProductsCategoryTable::getListProductCategory();
            $pager->setQuery($query);
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->url_paging = 'chain';
            $this->listChain = $pager->getResults();
        } catch (Exception $e) {
            return $this->redirect404();
        }
    }

    public function executeChainDetail(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug');
        $chain = VtpProductsCategoryTable::getCategoryProductBySlugV2($slug);
        if ($chain) {
            $this->chain = $chain;
            // lay danh sach anh
            $this->images = AdChainImageTable::getInstance()->getAllChainImage($chain['id']);
            // lay danh sach dich vu
            $this->listParam = ParameterCategoryTable::getInstance()->getListParamFront(explode(',', $chain['parameter_ids']));
            // danh sach san pham
            $this->listRoom = VtpProductsTable::getInstance()->getListProduct($chain['id']);
        } else {
            return $this->redirect404();
        }
    }

    public function executeRoom(sfWebRequest $request)
    {

    }

    public function executeRoomDetail(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug');
        $room = VtpProductsTable::getInstance()->getProductbySlugV2($slug);
        if ($room) {
            // dia chi
            $this->chain = VtpProductsCategoryTable::getCategoryByIdV2($room['category_id']);
            // danh sach anh
            $this->listImage = VtpProductImageTable::getImagesByProductId($room['id']);
            $this->room = $room;
            // danh sach phong khac
            $this->listOtherRoom = VtpProductsTable::getProductByCatIdV2($room['category_id']);
        } else {
            return $this->redirect404();
        }
    }
}
