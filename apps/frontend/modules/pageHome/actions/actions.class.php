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

    public function executeGetProducts(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        // lay danh sach cat
        $listApamentCat = VinApartmentCateTable::getInstance()->getAllApartmentCategory();
        $arrCat = null;
        foreach ($listApamentCat as $objCat) {
            // lay danh sach apamentType
            $listApamentType = $objCat->getObjApartmentType();
            $image360 = null;
            $arrImage = null;
            $imageWark = null;
            $itemArpament = null;
            $imageCat = null;
            foreach ($listApamentType as $objApartmentType) {
                if ($objApartmentType) {
                    if($imageCat == null){
                        $imageCat = $objApartmentType->featured_image;
                    }
                    $allImage = $objApartmentType->getAllImage();
                    foreach ($allImage as $itImage) {
                        if ($itImage->groups == '1') {
                            $image360 = $itImage->file_path;
                        }
                        if ($itImage->groups == '1') {
                            $imageWark = $itImage->file_path;
                        }
                        if ($itImage->groups == '3') {
                            $arrImage[] = $itImage->file_path;
                        }
                        if ($itImage->groups == '4') {
                            $arrImage[] = $itImage->file_path;
                        }
                    }
                    $itemArpament[] = [
                        'id' => $objApartmentType->id,
                        'name' => 'Căn hộ mẫu ' . $objApartmentType->parent_type,
                        'nameType' => $objApartmentType->name_type,
                        'building' => null,
                        'image' => $objApartmentType ? $objApartmentType->featured_image : null,
                        'description' => $objApartmentType ? $objApartmentType->description : $objApartmentType->name_type,
                        'bedroom' => $objApartmentType ? $objApartmentType->bad_room . " phòng ngủ" : null,
                        'bathroom' => $objApartmentType ? $objApartmentType->bath_room . " phòng tắm" : null,
                        'kitchen' => $objApartmentType ? $objApartmentType->kitchen_room . " phòng bếp" : null,
                        'balcony' => $objApartmentType ? $objApartmentType->balcony . " ban công" : null,
                        'image360' => $image360,
                        'linkWark' => $imageWark,
                        'acreage' => [
                            [
                                'title' => 'Diện tích tim tường',
                                'value' => $objApartmentType->heart_wall,
                            ],
                            [
                                'title' => 'Diện tích thông thủy',
                                'value' => $objApartmentType->clear_span,
                            ],
                        ],
                        'images' => $arrImage
                    ];
                }
            }

            $item = [
                'categoryName' => $objCat->name,
                'image' => $imageCat,
                'items' => $itemArpament
            ];
            $arrCat[] = $item;
        }
        $arrReturn['errorCode'] = 0;
        $arrReturn['message'] = 'Thành công';
        $arrReturn['data'] = $arrCat;
        return $this->renderText(json_encode($arrReturn));
    }

    public function executeGetHomeData(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
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
                $arr['content'] = str_replace('src="/','src="'.sfConfig::get('app_domain'),$item['body']);
                $arrNews[] = $arr;
            }
        }
        $listAllConfig = AdConfigTable::getAllConfig();
        $listConfig = array();
        if ($listAllConfig) {
            foreach ($listAllConfig as $val) {
                $listConfig[$val['config_key']] = $val['config_val'];
            }
        }
        $imgExperience = $listConfig['anh_trai_nghiem'];
        $resData = array(
            "news" => $arrNews,
            "favorite_hourse" => self::getFavoriteHouse(),
            'img_experience' => $imgExperience ? $imgExperience : 'http://vhsland.vn/wp-content/uploads/2018/07/p.jpg'
        );


        $data['errorCode'] = 0;
        $data['message'] = 'Thành công';
        $data['data'] = $resData;

        return $this->renderText(json_encode($data));
    }

    function getFavoriteHouse()
    {
        $arrBuilding = null;
        $listBuilding = VinBuildingTypeTable::getInstance()->getListBuildingHot();
        if (!empty($listBuilding)) {
            foreach ($listBuilding as $building) {
                $arrBuilding[] = self::buidingItem($building);
            }
        }
        return $arrBuilding;
    }

    public function buidingItem($building)
    {
        $objApartmentCat = $building->getObjApartmentCat();
        $objApartmentType = $building->getObjApartmentType();
        $image360 = null;
        $arrImage = null;
        $imageWark = null;
        if ($objApartmentType) {
            $allImage = $objApartmentType->getAllImage();
            foreach ($allImage as $itImage) {
                if ($itImage->groups == '1') {
                    $image360 = $itImage->file_path;
                }
                if ($itImage->groups == '1') {
                    $imageWark = $itImage->file_path;
                }
                if ($itImage->groups == '3') {
                    $arrImage[] = $itImage->file_path;
                }
                if ($itImage->groups == '4') {
                    $arrImage[] = $itImage->file_path;
                }
            }
        }
        $item = [
            'id' => $building->id,
            'name' => 'Căn hộ ' . $building->name,
            'building' => $objApartmentCat ? 'Tòa ' . $objApartmentCat->name : null,
            'image' => $objApartmentType ? $objApartmentType->featured_image : $building->image,
            'description' => $objApartmentType ? $objApartmentType->description : $objApartmentType->name_type,
            'bedroom' => $objApartmentType ? $objApartmentType->bad_room . " phòng ngủ" : null,
            'bathroom' => $objApartmentType ? $objApartmentType->bath_room . " phòng tắm" : null,
            'kitchen' => $objApartmentType ? $objApartmentType->kitchen_room . " phòng bếp" : null,
            'balcony' => $objApartmentType ? $objApartmentType->balcony . " ban công" : null,
            'image360' => $image360,
            'linkWark' => $imageWark,
            'acreage' => [
                [
                    'title' => 'Diện tích tim tường',
                    'value' => $building->heart_wall,
                ],
                [
                    'title' => 'Diện tích thông thủy',
                    'value' => $building->clear_span,
                ],
            ],
            'images' => $arrImage
        ];
        return $item;
    }


    public function executeGetMedia(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout(false);
        $this->setTemplate(false);
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

        $albums = AdPhotoTable::getAllPhotos(10);
        $arrPhotos = array();
        if ($albums && count($albums) > 0) {
            foreach ($albums as $item) {
                $path = sfConfig::get('app_url_media_file') . '/' . sfConfig::get('app_album_images') . $item['file_path'];
                $arrPhotos[] = $path;
            }
        }

        $resData = array(
            "album" => $arrPhotos,
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
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout(false);
        $this->setTemplate(false);
        if ($request->getMethod() != 'POST') {
            $data['errorCode'] = 3;
            $data['message'] = 'Phương thức không hợp lệ';
            $data['data'] = array();
            return $this->renderText(json_encode($data));
        }
        $name = trim($request->getParameter('name'));
        $phone = trim($request->getParameter('phone'));
        $email = trim($request->getParameter('email'));
        $requirements = trim($request->getParameter('requirements'));
        $arr = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'requirements' => $requirements
        );
        self::logs("API order: ".json_encode($arr));
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
//        if ($email == '') {
//            $data['errorCode'] = 7;
//            $data['message'] = 'Nhập thiếu email';
//            $data['data'] = array();
//            return $this->renderText(json_encode($data));
//        }
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

    public function executeGetLibrary(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout(false);
        $this->setTemplate(false);
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
        $listAlbum = AdAlbumTable::getAllAlbum()->fetchArray();
        $arrAlbum = array();
        if ($listAlbum) {
            foreach ($listAlbum as $album) {
                $arr = array();
                $arrPhotos = array();
                $arr['category'] = $album['name'];
                $listPhotos = AdPhotoTable::getPhotoByAlbumId($album['id'])->fetchArray();
                if ($listPhotos) {
                    foreach ($listPhotos as $item) {
                        $path = sfConfig::get('app_url_media_file') . '/' . sfConfig::get('app_album_images') . $item['file_path'];
                        $arrPhotos[] = $path;
                    }
                }
                $arr['images'] = $arrPhotos;
                $arrAlbum[] = $arr;
            }
        }


        $resData = array(
            "videos" => $arrVideos,
            "album" => $arrAlbum,
            "documents" => $arrDocs
        );
        $data['errorCode'] = 0;
        $data['message'] = 'Thành công';
        $data['data'] = $resData;
        return $this->renderText(json_encode($data));
    }

    public function executeGetSubDivision(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        // lay danh floor cat: toa dang l, z...
        $listFloors = VinApartmentCateTable::getInstance()->getAllApartmentCategory('floorsCategory');
        $arrFloors = [];
        $arrFloorsType = [];
        $arrFloorsParent = [];
        if ($listFloors && count($listFloors) > 0) {
            foreach ($listFloors as $objFloors) {
                $arrFloorsType[$objFloors->parent][$objFloors->type][] = $objFloors->id;
                $arrFloorsParent[$objFloors->parent][$objFloors->type] = [
                    'name' => sprintf('Tòa dạng %s', $objFloors->type),
                    'type' => $objFloors->type,
                    'building' => null,
                ];
//                $arrFloors[$objFloors->parent][$objFloors->id] = [
//                    'id' => $objFloors->id,
//                    'code' => !empty($objFloors->code) ? $objFloors->code : null,
//                    'name' => !empty($objFloors->name) ? $objFloors->name : null,
//                    'type' => !empty($objFloors->type) ? $objFloors->type : null,
//                ];
            }
        }
        foreach ($arrFloorsParent as $parent => $floors) {
            foreach ($floors as $floor) {
                $ids = !empty($arrFloorsType[$parent][$floor['type']]) ? $arrFloorsType[$parent][$floor['type']] : null;
                if ($ids) {
                    // lay danh asch toa nha
                    $listBuilding = VinBuildingTypeTable::getInstance()->getListBuildingByCat($ids, 1000);
                    if ($listBuilding && count($listBuilding) > 0) {
                        $arrBuilding = null;
                        foreach ($listBuilding as $building) {
                            $arrBuilding[] = [
                                'id' => $building->id,
                                'name' => !empty($building->name) ? $building->name : null,
                                'isView' => !empty($building->isView) ? $building->isView : 0,
                            ];
                        }
                        $arrFloorsParent[$parent][$floor['type']]['building'] = $arrBuilding;
                    }
                }
            }
        }

        // lay danh sach toan nha: the park
        $listZone = VinApartmentCateTable::getInstance()->getAllApartmentCategory('zoneCategory');
        $arrZone = [];
        if ($listZone && count($listZone) > 0) {
            foreach ($listZone as $objZone) {
                $itFloors = !empty($arrFloorsParent[$objZone->id]) ? array_values($arrFloorsParent[$objZone->id]) : null;
                $arrZone[$objZone->parent][$objZone->id] = [
                    'id' => $objZone->id,
                    'code' => !empty($objZone->code) ? $objZone->code : null,
                    'name' => !empty($objZone->name) ? $objZone->name : null,
                    'floors' => $itFloors,
                ];
            }
        }

        // lay danh sach phan khu: cao tang, thap tang
        $listSubDivision = VinApartmentCateTable::getInstance()->getAllApartmentCategory('subdivisionCategory');
        $arrSubDivision = null;
        if ($listSubDivision && count($listSubDivision) > 0) {
            foreach ($listSubDivision as $objSubDivision) {
                $itSubDivision = !empty($arrZone[$objSubDivision->id]) ? array_values($arrZone[$objSubDivision->id]) : null;
                $item = [
                    'id' => $objSubDivision->id,
                    'code' => $objSubDivision->code,
                    'name' => $objSubDivision->name,
                    'subDivision' => $itSubDivision,
                ];
                $arrSubDivision[] = $item;
            }
        }
        $data['errorCode'] = 0;
        $data['message'] = 'Thành công';
        $data['data'] = $arrSubDivision;
        return $this->renderText(json_encode($data));
    }


    public function executeGetProductDetail(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $product = null;
        $id = $request->getParameter('id');
        $objBuilding = VinBuildingTypeTable::getInstance()->findOneBy('id', $id);
        if ($objBuilding && count($objBuilding) > 0) {
            $product = self::buidingItem($objBuilding);
        }
        $data['errorCode'] = 0;
        $data['message'] = 'Thành công';
        $data['data'] = $product;
        return $this->renderText(json_encode($data));
    }

}
