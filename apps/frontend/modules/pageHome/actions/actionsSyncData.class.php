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
//        self::apartmentCat();
//        self::apartment_type();
//        self::building_type();
        die('1');
    }

    function building_type()
    {
        $building_type = json_decode(file_get_contents('http://178.128.86.192/VinCity/building_type.json'), true);
        $apartment_type = VinApartmentTypeTable::getInstance()->findAll();
        $arrApartmentType = [];
        foreach ($apartment_type as $item) {
            $arrApartmentType[md5($item->vin_key)] = $item->id;
        }
        foreach ($building_type as $build) {
            $objCat = new VinApartmentCate();
            $objCat->setCode($build['key']);
            $objCat->setName($build['name']);
            $objCat->setVinModel('floorsCategory');
            $objCat->setType($build['type']);
            $objCat->save();
            $idCat = $objCat->getId();
            foreach ($build['floors'][0] as $it) {
                $objBuilding = new VinBuildingType();
                $objBuilding->setVinKey($it['key']);
                $objBuilding->setName($it['name']);
                $objBuilding->setClearSpan($it['clearSpan']);
                $objBuilding->setHeartWall($it['heartWall']);
                $objBuilding->setType($it['type']);
                $objBuilding->setImage($it['image']);
                $objBuilding->setApartmentTypeId($arrApartmentType[md5($it['type'])]);
                $objBuilding->setApartmentCat($idCat);
                $objBuilding->save();
            }

        }
    }

    function apartment_type()
    {
        $arrApartmentType = json_decode(file_get_contents('http://178.128.86.192/VinCity/apartment_type.json'), true);
        $arrHot = json_decode(file_get_contents('http://178.128.86.192:4200/api/v1/hotdata'), true);
        $apartmentFavorites = [];
        foreach ($arrHot['data']['apartmentFavorites'] as $hot) {
            $apartmentFavorites[md5($hot['nameType'])] = $hot;
        }
        foreach ($arrApartmentType as $type) {
            $nameType = md5($type['nameType']);
            $item = !empty($apartmentFavorites[$nameType]) ? $apartmentFavorites[$nameType] : false;

            $obj = new VinApartmentType();
            $obj->setVinKey($type['key']);
            $obj->setNameType($type['nameType']);
            $obj->setFeaturedImage($item !== false ? $item['featuredImage'] : $type['featuredImage']);
            $obj->setStandardTransferFile($type['standardTransferFile']);
            $obj->setGroundApartmentFile($type['groundApartmentFile']);
            $obj->setBadRoom($type['badRoom']);
            $obj->setBathRoom($type['bathRoom']);
            $obj->setKitchenRoom($type['kitchenRoom']);
            $obj->setDescription($type['description']);
            $obj->setHeartWall($type['heartWall']);
            $obj->setClearSpan($type['clearSpan']);
            $obj->setVinModel($type['model']);
            $obj->setParentType($type['parentType']);
            $obj->save();
            $id = $obj->getId();
            // them vao bang image
            $imagesGround = $item ? $item['imagesGround'] : $type['imagesGround'];
            $imagesFurniture = $item ? $item['imagesFurniture'] : $type['imagesFurniture'];
            $images360 = $item ? $item['images360'] : $type['images360'];
            // VinProductImage
            // images360 anh 360 1 // anh walk 2
            foreach ($images360 as $it1) {
                if ($it1['name'] == '360') {
//                    $arrName = explode('/', $it1);
//                    $_name = str_replace('.jpg', '', $arrName[count($arrName)]);
                    $objImage = new VinProductImage();
                    $objImage->setFilePath($it1['link']);
                    $objImage->setProductId($id);
                    $objImage->setType(2);
                    $objImage->setGroups(1);
                    $objImage->save();
                }
                if ($it1['name'] == 'Walk Through') {
//                    $arrName = explode('/', $it1);
//                    $_name = str_replace('.jpg', '', $arrName[count($arrName)]);
                    $objImage = new VinProductImage();
                    $objImage->setFilePath($it1['link']);
                    $objImage->setProductId($id);
                    $objImage->setType(2);
                    $objImage->setGroups(2);
                    $objImage->save();
                }
            }
            // anh thiet ke 3 imagesGround
            foreach ($imagesGround as $it1) {
//                $arrName = explode('/', $it1);
//                $_name = str_replace('.jpg', '', $arrName[count($arrName)]);
                // VinProductImage
                $objImage = new VinProductImage();
                $objImage->setFilePath($it1);
                $objImage->setProductId($id);
                $objImage->setType(2);
                $objImage->setGroups(3);
                $objImage->save();
            }
            // anh can ho 4 imagesFurniture
            foreach ($imagesFurniture as $it1) {
//                $arrName = explode('/', $it1);
//                $_name = str_replace('.jpg', '', $arrName[count($arrName)]);
                // VinProductImage
                $objImage = new VinProductImage();
                $objImage->setFilePath($it1);
                $objImage->setProductId($id);
                $objImage->setType(2);
                $objImage->setGroups(4);
                $objImage->save();
            }
        }
    }

    function apartmentCat()
    {
        $arrApartmentCat = json_decode(file_get_contents('http://178.128.86.192/VinCity/apartment_cate.json'), true);
        foreach ($arrApartmentCat as $cat) {
            $obj = new VinApartmentCate();
            $obj->setCode($cat['code']);
            $obj->setName($cat['name']);
            $obj->setVinModel($cat['model']);
            $obj->save();
        }
        die;
    }

    public function executeGetHomeData(sfWebRequest $request)
    {
        header("Content-Type: application/json; charset=UTF-8");
        $this->setLayout(false);
        $this->setTemplate(false);
        if ($request->getMethod() != 'GET') {
            $data['errorCode'] = 3;
            $data['message'] = 'Phương thức không hợp lệ';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
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
