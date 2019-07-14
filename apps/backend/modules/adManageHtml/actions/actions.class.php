<?php

require_once dirname(__FILE__).'/../lib/adManageHtmlGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adManageHtmlGeneratorHelper.class.php';

/**
 * adManageHtml actions.
 *
 * @package    Vt_Portals
 * @subpackage adManageHtml
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adManageHtmlActions extends autoAdManageHtmlActions
{
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
        {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page'))
        {
            $this->setPage($request->getParameter('page'));
        }
        else
        {
            $this->setPage(1);
        }

        // max per page
        if ($request->getParameter('max_per_page'))
        {
            $this->setMaxPerPage($request->getParameter('max_per_page'));
        }else{
            $this->setMaxPerPage(10);
        }

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();

        //Start - thongnq1 - 03/05/2013 - fix loi xoa du lieu tren trang danh sach
        if ($request->getParameter('current_page'))
        {
            $current_page = $request->getParameter('current_page');
            $this->setPage($current_page);
            $this->pager = $this->getPager();
        }
        //end thongnq1

        $this->sort = $this->getSort();
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_html = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->ad_html);
        $this->fields = $this->ad_html->getTable()->getColumnNames();
//        VtHelper::getGUID();
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_html = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_html)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_html');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@ad_html_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'ad_html_edit', 'sf_subject' => $ad_html));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    protected function getPager()
    {
        $query = $this->buildQuery();
        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());
        $query->orderby('created_at desc');
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdHtml');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }
}
