<?php

require_once dirname(__FILE__) . '/../lib/adPhotoGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/adPhotoGeneratorHelper.class.php';

/**
 * adPhoto actions.
 *
 * @package    Vt_Portals
 * @subpackage adPhoto
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adPhotoActions extends autoAdPhotoActions
{
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        } else {
            $this->setPage(1);
        }

        // max per page
        if ($request->getParameter('max_per_page')) {
            $this->setMaxPerPage($request->getParameter('max_per_page'));
        }

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();

        //Start - thongnq1 - 03/05/2013 - fix loi xoa du lieu tren trang danh sach
        if ($request->getParameter('current_page')) {
            $current_page = $request->getParameter('current_page');
            $this->setPage($current_page);
            $this->pager = $this->getPager();
        }
        //end thongnq1

        $this->sort = $this->getSort();
        if ($request->hasParameter('default_album_id')) {
            $albumId = $request->getParameter('default_album_id');
            $this->Ad_album = AdAlbumTable::getALbumById($albumId);
        }
    }

    protected function getPager()
    {
        $request = sfContext::getInstance()->getRequest();
        $query = $this->buildQuery();
        if ($request->hasParameter('default_album_id')) {
            $albumId = $request->getParameter('default_album_id');
            $query->where('album_id=?', $albumId);
        }
        $query->andwhere('is_active=1');
        $query->orderBy('priority');
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdPhoto');
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
            $values = $form->getValues();
            $defaultALbumId = $values['album_id'];
            try {
                $Ad_photo = $form->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $Ad_photo)));

            if ($request->hasParameter('_save_and_exit')) {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect(array('sf_route' => 'Ad_photo', 'default_album_id' => $defaultALbumId));
            } elseif ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('success', $notice . ' You can add another one below.');
                $this->redirect(array('sf_route' => 'Ad_photo_new', 'default_album_id' => $defaultALbumId));
            } else {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect(array('sf_route' => 'ad_photo_edit', 'sf_subject' => $Ad_photo, 'default_album_id' => $defaultALbumId));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $albumId = $this->getRoute()->getObject()->getAlbumId();
        if ($this->getRoute()->getObject()->delete()) {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect(array('sf_route' => 'Ad_photo', 'default_album_id' => $albumId));
    }

    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');

        $records = Doctrine_Query::create()
            ->from('AdPhoto')
            ->whereIn('id', $ids)
            ->execute();
        $idAlbum = 0;
        foreach ($records as $record) {
            $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
            $idAlbum = $record->getAlbumId();
            $record->delete();
        }

        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect(array('sf_route' => 'Ad_photo', 'default_album_id' => $idAlbum));
    }
}
