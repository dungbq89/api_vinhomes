<?php

require_once dirname(__FILE__).'/../lib/adVideoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adVideoGeneratorHelper.class.php';

/**
 * adVideo actions.
 *
 * @package    Vt_Portals
 * @subpackage adVideo
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adVideoActions extends autoAdVideoActions
{
    protected function getPager()
    {
        $query = $this->buildQuery();
        $pages = ceil($query->count() / $this->getMaxPerPage());
        $pager = $this->configuration->getPager('AdVideo');
        $pager->setQuery($query);
        $pager->setPage(($this->getPage() > $pages) ? $pages : $this->getPage());
        $pager->init();

        return $pager;
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $ad_video = $form->save();
                $vals = $form->getValues();

                if($vals['is_default']==true){
                    //Cap nhat trang thai defaul ve false
                    AdVideoTable::updateDefault($ad_video->id);
                }
                $ad_video->extension=pathinfo($ad_video->file_path, PATHINFO_EXTENSION);
                $ad_video->lang=sfContext::getInstance()->getUser()->getCulture();
                $slug=removeSignClass::removeSign($ad_video->name);

                $objCat = count(AdVideoTable::checkSlug($slug, $ad_video->id));
                while ($objCat>0){
                    $slug=$slug.'_'.VtHelper::generateString(5);
                    $objCat = count(AdVideoTable::checkSlug($slug,$ad_video->id));
                }
                $ad_video->slug=$slug;
                $ad_video->save();

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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('form' => $form, 'object' => $ad_video)));

            if ($request->hasParameter('_save_and_exit'))
            {
                $this->getUser()->setFlash('success', $notice);
                $this->redirect('@ad_video');
            } elseif ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('success', $notice.' You can add another one below.');

                $this->redirect('@ad_video_new');
            }
            else
            {
                $this->getUser()->setFlash('success', $notice);

                $this->redirect(array('sf_route' => 'ad_video_edit', 'sf_subject' => $ad_video));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
