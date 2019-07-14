<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 7/24/14
 * Time: 6:03 PM
 * To change this template use File | Settings | File Templates.
 */
class pageVideoComponents extends sfComponents
{

    public function executeVideoTop(sfWebRequest $request)
    {
        $slug = '';
        //        $request=sfContext::getInstance()->getRequest();
        if ($request->getParameter('slug') != '') {
            $slug = $request->getParameter('slug');
        }
        $videoDefault = AdVideoTable::getVideoDefaultBySlug($slug);
        if ($videoDefault) {
            $this->videoDefault = $videoDefault;//AdVideoTable::getVideoDefaultBySlug($slug);
        }
        else {
            return sfView::NONE;
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
        $pager = AdVideoTable::getInstance()->returnSqlVideoDefaultBySlugNew($slug, $limit, $request->getParameter('page', 1));

        $this->pager = $pager;
    }


}