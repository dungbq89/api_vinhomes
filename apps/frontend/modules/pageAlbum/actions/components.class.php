<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 7/24/14
 * Time: 6:03 PM
 * To change this template use File | Settings | File Templates.
 */
class pageAlbumComponents extends sfComponents
{

    public function executeAlbumTop(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug');
        //        $request=sfContext::getInstance()->getRequest();
        if ($slug!='') {
            $slug = $request->getParameter('slug');
            $album = AdAlbumTable::getALbumBySlug($slug)->fetchOne();
            if ($album) {
                $this->album = $album;
                $this->listImage = AdPhotoTable::getPhotoByAlbumId($album->getId())->fetchArray();
            } else {
                return sfView::NONE;
            }
        }
        else{
            $album = AdAlbumTable::getALbumDefault()->fetchOne();
            if ($album) {
                $this->album = $album;
                $this->listImage = AdPhotoTable::getPhotoByAlbumId($album->getId())->fetchArray();
            } else {
                return sfView::NONE;
            }
        }


    }


    public function executePageContent(sfWebRequest $request)
    {
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = sfConfig::get('app_limit_videos', 6);
        $slug = '';
        if ($slug) {
            $slug = sfContext::getInstance()->getRequest()->getParameter('slug');
        }
        $this->url_paging = 'page_album';
        $this->page = $this->getRequestParameter('page', 1);
        $pager = new sfDoctrinePager('AdAlbum', 8);
        $pager->setQuery(AdAlbumTable::getListAlbum());
        $pager->setPage($this->page);
        $pager->init();
        $this->pager = $pager;
        $this->listAlbum = $pager->getResults();
    }


}