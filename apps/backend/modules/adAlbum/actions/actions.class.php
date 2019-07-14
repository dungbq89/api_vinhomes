<?php

require_once dirname(__FILE__) . '/../lib/adAlbumGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/adAlbumGeneratorHelper.class.php';

/**
 * adAlbum actions.
 *
 * @package    Vt_Portals
 * @subpackage adAlbum
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adAlbumActions extends autoAdAlbumActions
{
    protected function getPager()
    {
        $query = $this->buildQuery();
        $query->where('is_active=1');
        $query->orderBy("priority");
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdAlbum');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_album = $form->save();
                $ad_album->lang = sfContext::getInstance()->getUser()->getCulture();
                $slug = removeSignClass::removeSign($ad_album->getName());
                $objCat = count(AdAlbumTable::checkSlug($slug, $ad_album->getId()));
                while ($objCat > 0) {
                    $slug = $slug . '_' . VtHelper::generateString(5);
                    $objCat = count(AdAlbumTable::checkSlug($slug, $ad_album->getId()));
                }
                $ad_album->slug = $slug;
                $ad_album->save();
                if ($ad_album->getIsDefault() == 1) {
                    AdAlbumTable::updateDefault($ad_album->getId());
                }
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_album)));

            if ($request->hasParameter('_save_and_exit')) {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_album');
            } elseif ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('success', $notice . ' You can add another one below.');

                $this->redirect('@ad_album_new');
            } else {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'ad_album_edit', 'sf_subject' => $ad_album));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->sidebar_status = $this->configuration->getEditSidebarStatus();
        $this->ad_album = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->ad_album);
        $this->fields = $this->ad_album->getTable()->getColumnNames();

        if ($request->getParameter('page')) {
            $this->setPagePhoto($request->getParameter('page'));
        } else
            $this->setPagePhoto(1);
        // max per page
        if ($request->getParameter('max_per_page')) {
            $this->setMaxPerPagePhoto($request->getParameter('max_per_page'));
            $maxPerPage = $request->getParameter('max_per_page');
        } else {
            $maxPerPage = $this->getMaxPerPagePhoto();
        }
        //tra ve danh sach bai viet chi tiet thuoc thuoc dich vu
        $id = $this->ad_album->getId();
        $pagerDetail = new sfDoctrinePager('AdPhoto', $maxPerPage);
        $pagerDetail->setQuery(AdPhotoTable::getPhotoByAlbumId($id));
        $pagerDetail->setPage($this->getPageSubCategory());
        $pagerDetail->init();
        if ($pagerDetail) {
            $this->pager = $pagerDetail;
        } else $this->pager = 0;

        $this->sort = $this->getSort();

    }

    protected function setPagePhoto($page)
    {
        $this->getUser()->setAttribute('AdPhoto.page', $page, 'admin_module');
    }

    protected function setMaxPerPagePhoto($max_per_page)
    {
        $this->getUser()->setAttribute('AdPhoto.max_per_page', (integer)$max_per_page, 'admin_module');
    }

    protected function getMaxPerPagePhoto()
    {
        return $this->getUser()->getAttribute('AdPhoto.max_per_page', sfConfig::get('app_default_max_per_page', 20), 'admin_module');
    }

    protected function setPage($page)
    {
        $this->getUser()->setAttribute('AdPhoto.page', $page, 'admin_module');
    }

    protected function getPage()
    {
        return $this->getUser()->getAttribute('AdPhoto.page', 1, 'admin_module');
    }

    protected function getPageSubCategory()
    {
        return $this->getUser()->getAttribute('AdPhoto.page', 1, 'admin_module');
    }
}
