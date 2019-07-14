<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author ngoctv1
 */
class ajaxActions extends sfActions{
    //put your code here
    
    public function executeLoadArticle(sfWebRequest $request){
        
        $type=$request->getParameter('type');
        if ($type==null){$type=1;}
        $keyword = $request->getParameter('keyword');
        $pageIndex = $request->getParameter('pageIndex');
        $pageSize =  10;
        $myPager = new sfDoctrinePager('AdArticle', $pageSize);
        $keyword = trim($keyword);
        $articleId = sfContext::getInstance()->getUser()->getAttribute('article_id');
        if($articleId){
            $myPager->setQuery(AdArticleTable::getSearchArticle($keyword,$articleId));
        }
        else{
            $myPager->setQuery(AdArticleTable::getSearchArticle($keyword));
        }
        $myPager->setPage($this->getRequestParameter('page', $pageIndex));
        $myPager->init();
        $arrayResult = $myPager->getResults(Doctrine::HYDRATE_ARRAY);
        $paging = array("paging" => true, "pageIndex" => $pageIndex, "pageSize" => $pageSize, "maxPage" => $myPager->getLastPage()); //
        array_push($arrayResult, $paging);
        return $this->renderText(json_encode($arrayResult));
    }

    public function executeMove(sfWebRequest $request)
    {
        try {
            $request->checkCSRFProtection();
        } catch (Exception $e) {
            return $this->renderText('csrf');
        }
        $type=$request->getGetParameters('type');
        if($type=='up'){

        }elseif($type=='down'){

        }

        $table = Doctrine_Core::getTable('VtpCategory');

        if (
            $table->hasField($field = $request->getParameter('field'))
            && ($record = $table->find($request->getParameter('pk')))
        ) {
            $record->set($field, !$record->get($field));
            $record->save();

            return $this->renderText($record->$field ? '1' : '0');
        } else {
            return $this->renderText('404');
        }
    }
    
    // upload nhieu file trong photo album
    public function executeAjaxUploadImageFiles(sfWebRequest $request) {
        $i18n = $this->getContext()->getI18N();
        //-- disable debug
        sfConfig::set('sf_web_debug', false);

        if ($this->getUser()->isAuthenticated()) {
            if (!$request->isXmlHttpRequest()) {

                $token = $request->getParameter('token', 0);

                // Set the upload directory
                $uploadDir = sfConfig::get("app_url_media_images", "/medias/app");
                if (!is_dir($uploadDir))
                    mkdir($uploadDir, 0777, true);
                // Set the allowed file extensions
                $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
                $fileMimeTypes = array('application/octet-stream', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif', '');

                if (!empty($_FILES)) {

                    $maxFileSize = 10048576;
                    if ($_FILES['Filedata']['size'] > $maxFileSize) {
                        return $this->renderText(json_encode(array('errCode' => 5, 'message' => 'Max Size ' . $maxFileSize . "(B)")));
                    }

                    $tempFile = $_FILES['Filedata']['tmp_name'];
                    // Validate the filetype
                    $fileParts = pathinfo($_FILES['Filedata']['name']);
                    if (in_array(strtolower($fileParts['extension']), $fileTypes) && in_array($_FILES['Filedata']['type'], $fileMimeTypes)) {
                        $fileNameUnique = uniqid() . "." . $fileParts['extension'];
                        try {
                            
                        } catch (Exception $e) {
                            sfContext::getInstance()->getLogger()->log("[CP CMS] Upload move file/create thumb Exception:" . $e->getMessage());
                            return $this->renderText(json_encode(array('errCode' => 999, 'message' => 'unknown')));
                        }
                    } else {
                        // The file type wasn't allowed
                        return $this->renderText(json_encode(array('errCode' => 2, 'message' => $i18n->__('File upload không đúng định đạng'))));
                    }
                }
                return $this->renderText(json_encode(array('errCode' => 3, 'message' => $i18n->__('Truy cập không hợp lệ'))));
            } else
                return $this->renderText(json_encode(array('errCode' => 3, 'message' => $i18n->__('Truy cập không hợp lệ'))));
        }
    }

    public function executeAjaxRemoveImageFiles(sfWebRequest $request) {
        $i18n = $this->getContext()->getI18N();
        //-- disable debug
        sfConfig::set('sf_web_debug', false);

        if ($this->getUser()->isAuthenticated()) {
            if ($request->isXmlHttpRequest()) {
                $appId = $request->getParameter('file_id', null);
                $objImg = VtPictureAlbumTable::getInstance()->findOneBy("id", $appId);
                if ($objImg) {
                    try {
                        $objImg->delete();
                        return $this->renderText(json_encode(array(
                                    'errorCode' => 0,
                                    'message' => $i18n->_('Xóa file thành công')
                        )));
                    } catch (Exception $exc) {
                        //ghi log
                        // echo $exc->getTraceAsString();
                        return $this->renderText(json_encode(array(
                                    'errorCode' => 1,
                                    'message' => $exc->getTraceAsString(),
                        )));
                    }
                }
            }
        }
        return $this->renderText(json_encode(array(
                    'errorCode' => 1,
                    'message' => $i18n->_('Xóa file thất bại')
        )));
    }
    
    public function executeAjaxLoadCategoryNews(sfWebRequest $request) {
        $listCategoryNews = VtpCategoryTable::getCategoryByTypeClone(VtCommonEnum::NewCategory, sfContext::getInstance()->getUser()->getAttribute('portal',0),'');
        return $this->renderText(json_encode($listCategoryNews));
    }
    public function executeAjaxLoadCategoryService(sfWebRequest $request) {
        $listCategoryService = VtpCategoryTable::getCategoryByTypeClone(VtCommonEnum::ServiceCategory, sfContext::getInstance()->getUser()->getAttribute('portal',0),'');
        return $this->renderText(json_encode($listCategoryService));
    }
    public function executeAjaxLoadArticleDetail(sfWebRequest $request){
        $listArticle = AdArticleTable::getActiveArticleQuery()->execute();
        $arrResult = array();
        if(count($listArticle)>0){
            foreach($listArticle as $value){
                $arrResult[$value['slug']] = htmlspecialchars($value['title']);
            }
        }
        return $this->renderText(json_encode($arrResult));
    }
    public function executeAjaxLoadServiceDetail(sfWebRequest $request){
        $listService = VtpServicesTable::getServiceActiveQuery(sfContext::getInstance()->getUser()->getAttribute('portal',0))->execute();
        $arrResult = array();
        if(count($listService)>0){
            foreach($listService as $value){
                $arrResult[$value['slug']] = htmlspecialchars($value['title']);
            }
        }
        return $this->renderText(json_encode($arrResult));
    }
}


