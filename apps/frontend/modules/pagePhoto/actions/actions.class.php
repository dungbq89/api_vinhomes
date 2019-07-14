<?php

/**
 * pageNewsDetails actions.
 *
 * @package    Vt_Portals
 * @subpackage pageNewsDetails
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pagePhotoActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $albumPhoto = AdAlbumTable::getAllAlbumPhoto();
        if ($albumPhoto) {
            $this->albumPhoto = $albumPhoto;

        } else {
            return $this->redirect404();
        }

    }

    public function executeCategoryPhoto(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug');
        $albumPhoto = AdAlbumTable::getALbumBySlugV2($slug);
        if ($albumPhoto) {
            // danh sach photo
            $listPhoto = AdPhotoTable::getPhotoByAlbumId($albumPhoto['id'])
//                ->andWhere('lang=?', sfContext::getInstance()->getUser()->getCulture())
                ->orderBy('priority DESC')->fetchArray();
            $this->albumPhoto = $albumPhoto;
            $this->listPhoto = $listPhoto;
        } else {
            return $this->redirect404();
        }

    }

    public function executePhotoDetail(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug');
        $article = AdArticleTable::getInstance()->createQuery()->andWhere('slug=?', $slug)->andWhere('lang=?', sfContext::getInstance()->getUser()->getCulture())
            ->andWhere('is_active=?', 2)->fetchArray();
        if (!empty($article)) {
            $this->article = $article[0];
        } else {
            return $this->redirect404();
        }

    }

}
