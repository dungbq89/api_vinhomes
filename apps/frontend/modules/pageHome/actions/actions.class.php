<?php

/**
 * pageHome actions.
 *
 * @package    VTP2.0
 * @subpackage pageHome
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageHomeActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {

    }

    public function executeGetHomeData(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->setTemplate(false);
        header('Content-Type: application/json');
        if ($request->getMethod() != 'GET') {
            $data['errorCode'] = 3;
            $data['message'] = 'Phương thức không hợp lệ';
            $data['data'] = array();
            $this->renderText(json_encode($data));
        }
        $news = AdHocVienTable::getAllStudent();
        $arrNews = array();
        if ($news && count($news) > 0) {
            foreach ($news as $item) {
                $arr = array();
                $arr['id'] = $item['id'];
                $arr['title'] = $item['name'];
                $arr['description'] = $item['name'];
                $arr['image'] = sfConfig::get('app_domain') . 'uploads/' . sfConfig::get('app_article_images') . $item['image'];
                $arr['content'] = $item['body'];
                $arrNews[] = $arr;
            }
        }
        $resData = array(
            "news" => $arrNews,
            "favorite_hourse" => array()
        );
        $data['errorCode'] = 0;
        $data['message'] = 'Thành công';
        $data['data'] = $resData;
        return $this->renderText(json_encode($data));
    }


    public function executeGetMedia(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->setTemplate(false);
        header('Content-Type: application/json');
        if ($request->getMethod() != 'GET') {
            $data['errorCode'] = 3;
            $data['message'] = 'Phương thức không hợp lệ';
            $data['data'] = array();
            $this->renderText(json_encode($data));
        }
        $videos = AdYoutubeTable::getVideos(10);
        $arrVideos = array();
        if ($videos && count($videos) > 0) {
            foreach ($videos as $item) {
                $arr = array();
                $arr['id'] = $item['id'];
                $arr['title'] = $item['name'];
                $arr['link'] = $item['link'];
                $arr['image'] = $item['link'];
                $arrVideos[] = $arr;
            }
        }

        $documents = AdDocumentDownloadTable::getDocuments(5);
        $arrDocs = array();
        if ($documents && count($documents) > 0) {
            foreach ($documents as $item) {
                $arr = array();
                $arr['id'] = $item['id'];
                $arr['title'] = $item['name'];
                $arr['link'] = $item['link'];
                $arrDocs[] = $arr;
            }
        }

        $resData = array(
            "album" => array(),
            "videos" => $arrVideos,
            "documents" => $arrDocs
        );
        $data['errorCode'] = 0;
        $data['message'] = 'Thành công';
        $data['data'] = $resData;
        return $this->renderText(json_encode($data));
    }

    /*
     * API dat han
     */
    public function executeOrder(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->setTemplate(false);
        header('Content-Type: application/json');
        if ($request->getMethod() != 'POST') {
            $data['errorCode'] = 3;
            $data['message'] = 'Phương thức không hợp lệ';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
        }
        $name = trim($request->getParameter('name', null));
        $phone = trim($request->getParameter('phone'));
        $email = trim($request->getParameter('email'));
        $requirements = trim($request->getParameter('requirements'));
        if (strlen($requirements) >= 255) {
            $data['errorCode'] = 4;
            $data['message'] = 'Thông tin đầu vào không hợp lệ';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
        }
        if ($name == '') {
            $data['errorCode'] = 5;
            $data['message'] = 'Nhập thiếu Họ và tên';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
        }
        if ($phone == '') {
            $data['errorCode'] = 6;
            $data['message'] = 'Nhập thiếu Số điện thoại';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
        }
        if ($email == '') {
            $data['errorCode'] = 7;
            $data['message'] = 'Nhập thiếu email';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
        }
        try {
            $feedBack = new AdFeedBack();
            $feedBack->setName($name);
            $feedBack->setEmail($email);
            $feedBack->setPhone($phone);
            $feedBack->setTitle($requirements);
            $feedBack->setMessage($requirements);
            $feedBack->setIsActive(0);
            $feedBack->setLang('vi');
            $feedBack->save();
            $mess = 'Liên hệ thành công';
            $errCode = 0;
        } catch (Exception $exception) {
            $errCode = 10;
            $mess = 'Đặt mua không thành công';
        }
        $data['errorCode'] = $errCode;
        $data['message'] = $mess;
        $data['data'] = array();
        return $this->renderText(json_encode($data));
    }

    public function executeCrawNews(sfWebRequest $request)
    {
        $this->setLayout(false);
        $folderRoot = sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_article_images') . '/';
        $url = 'http://178.128.86.192:4200/api/v1/news?page=1';
        $data = $this->curlGet($url);
        $count = 0;
        if ($data) {
            $response = $data->data;
            foreach ($response as $item) {
                $articleCheck = AdHocVienTable::getNewsByDesc($item->_id);
                if (!$articleCheck) {
                    try {
                        $article = new AdHocVien();
                        $article->setName($item->title);
                        $article->setBody($item->content);
                        //save image to server
                        $imageName = $item->_id . '.jpg';
                        $this->saveImage($item->thumbnail, $folderRoot . $imageName);
                        $article->setImage('/' . $imageName);
                        $article->setIsActive(1);
                        $article->setPriority(10);
                        $article->setDescription($item->_id);
                        $article->save();
                        $count++;
                    } catch (Exception $e) {
                    }

                }
            }
        }
        var_dump('Update thành công ' . $count . ' tin tức');
        die;
    }

    public function executeCrawVideo(sfWebRequest $request)
    {
        $this->setLayout(false);
        $url = 'http://178.128.86.192:4200/api/v1/hotdata';
        $data = $this->curlGet($url);
        $count = 0;
        if ($data) {
            $response = $data->data->videos;
            foreach ($response as $item) {
                $videoCheck = AdYoutubeTable::getYoutubeByDesc($item->_id);
                if (!$videoCheck) {
                    try {
                        $article = new AdYoutube();
                        $article->setName($item->name);
                        $article->setBody($item->name);
                        $article->setIsActive(1);
                        $article->setPriority(10);
                        $article->setImage($item->link);
                        $article->setDescription($item->_id);
                        $article->setLink($item->link);
                        $article->save();
                        $count++;
                    } catch (Exception $e) {

                    }

                }
            }

            $responseDoc = $data->data->documents;
            foreach ($responseDoc as $item) {
                $videoCheck = AdDocumentDownloadTable::getDocByDesc($item->_id);
                if (!$videoCheck) {
                    try {
                        $article = new AdDocumentDownload();
                        $article->setName($item->name);
                        $article->setBody($item->name);
                        $article->setIsActive(1);
                        $article->setPriority(10);
                        $article->setImage($item->link);
                        $article->setDescription($item->_id);
                        $article->setLink($item->link);
                        $article->setCategoryId(1);
                        $article->save();
                        $count++;
                    } catch (Exception $e) {

                    }

                }
            }
        }
        var_dump('Update thành công ' . $count . ' tin tức');
        die;
    }

    public function curlGet($url)
    {
        $data = file_get_contents($url);
        return json_decode($data);
    }

    public function saveImage($urlImage, $newImage)
    {
        //Get the file
        $content = file_get_contents($urlImage);
//Store in the filesystem.
        $fp = fopen($newImage, "w");
        fwrite($fp, $content);
        fclose($fp);
    }
}
