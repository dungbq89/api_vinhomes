<?php

require_once dirname(__FILE__).'/../lib/adArticlesAprovedGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adArticlesAprovedGeneratorHelper.class.php';

/**
 * adArticlesAproved actions.
 *
 * @package    Vt_Portals
 * @subpackage adArticlesAproved
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adArticlesAprovedActions extends autoAdArticlesAprovedActions
{
    public function executeNew(sfWebRequest $request)
    {
        $this->redirect('@ad_article_adArticlesAproved');
        $this->sidebar_status = $this->configuration->getNewSidebarStatus();
        $this->form = $this->configuration->getForm();
        $this->ad_article = $this->form->getObject();
    }
    public function executeEdit(sfWebRequest $request)
    {
        $this->redirect('@ad_article_adArticlesAproved');
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_article = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->ad_article);
        $this->fields = $this->ad_article->getTable()->getColumnNames();
    }
    protected function getPager()
    {
        $query = $this->buildQuery();
        $user = sfContext::getInstance()->getUser();
        $id = $user->getGuardUser()->getId();
        $query->andWhere('is_active=?',  VtCommonEnum::NUMBER_ONE);
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());

        if(!$user->isSuperAdmin() && !$user->hasCredential('admin')){
            //Nếu user có cả 2 quyền Editor và Approved
            if($user->hasCredential('news_editor') && $user->hasCredential('news_approved')){
                $query->andWhere('(created_by=? or updated_by=?)',array($id, $id));
            }
            //Nếu user có quyền Approved
            elseif($user->hasCredential('news_approved')){
                $query->andWhere('updated_by=?',$id);
            }
            //Nếu user có quyền Editor
            elseif($user->hasCredential('news_editor')){
                $query->andWhere('created_by=?',$id);
            }
            //Điều kiện hiển thị chuyên mục
            $arrPer = AdCategoryPermissionTable::getPermissionByUserId($id);
            $arrCat=AdCategoryPermissionTable::getCatgoryIdByArrPermission($arrPer);
            $query->andWhereIn('category_id', $arrCat);
        }
        $query->orderBy('priority asc');
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdArticle');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }
}
