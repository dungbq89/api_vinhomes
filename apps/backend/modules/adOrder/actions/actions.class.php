<?php

require_once dirname(__FILE__).'/../lib/adOrderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adOrderGeneratorHelper.class.php';

/**
 * adOrder actions.
 *
 * @package    Web_Portals
 * @subpackage adOrder
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adOrderActions extends autoAdOrderActions
{
    protected function getPager()
    {
        $query = $this->buildQuery();
        $query->orderBy("status asc");
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdOrder');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }
}
