<?php

require_once dirname(__FILE__).'/../lib/ManageParameterCategoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ManageParameterCategoryGeneratorHelper.class.php';

/**
 * ManageParameterCategory actions.
 *
 * @package    Web_Portals
 * @subpackage ManageParameterCategory
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ManageParameterCategoryActions extends autoManageParameterCategoryActions
{

    protected function getPager()
    {

        $query = $this->buildQuery();
        $query->andwhere('lang=?', sfContext::getInstance()->getUser()->getCulture());
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('ParameterCategory');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }
}
