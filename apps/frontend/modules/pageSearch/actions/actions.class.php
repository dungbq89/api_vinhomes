<?php

/**
 * pageNewsDetails actions.
 *
 * @package    Vt_Portals
 * @subpackage pageNewsDetails
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageSearchActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->queryName = $queryName = $request->getParameter('keyword');
        if($queryName){
            $this->keyword = $queryName;
            $this->url_paging = 'page_search';
            $this->page = $this->getRequestParameter('page', 1);
            $pager = new sfDoctrinePager('VtpProducts', 16);
            $pager->setQuery(VtpProductsTable::getSearchProduct($queryName));
            $pager->setPage($this->page);
            $pager->init();
            $this->pager = $pager;
            $this->listProduct = $pager->getResults();
        }

    }

}
