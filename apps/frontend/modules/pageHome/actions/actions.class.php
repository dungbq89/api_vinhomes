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
        if($request->getMethod() != 'GET'){
            $data['errorCode'] = 3;
            $data['message'] = 'Phương thức không hợp lệ';
            $data['data'] = array();
            $this->renderText(json_encode($data));
        }
        $news = AdHocVienTable::getAllStudent();
        $arrNews = array();
        if($news && count($news) > 0){
            foreach ($news as $item){
                $arr = array();
                $arr['id'] = $item['id'];
                $arr['title'] = $item['name'];
                $arr['description'] = $item['name'];
                $arr['image'] = sfConfig::get('app_domain').'uploads/' . sfConfig::get('app_article_images') . $item['image'];
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

    public function executeCrawNews(sfWebRequest $request)
    {
        $this->setLayout(false);
        $folderRoot = sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_article_images').'/';
        $url = 'http://178.128.86.192:4200/api/v1/news?page=1';
        $data = $this->curlGet($url);
        $count = 0;
        if ($data) {
            $response = $data->data;
            foreach ($response as $item) {
                $articleCheck = AdHocVienTable::getNewsByDesc($item->_id);
                if (!$articleCheck) {
                    try{
                        $article = new AdHocVien();
                        $article->setName($item->title);
                        $article->setBody($item->content);
                        //save image to server
                        $imageName = $item->_id.'.jpg';
                        $this->saveImage($item->thumbnail, $folderRoot.$imageName);
                        $article->setImage('/'.$imageName);
                        $article->setIsActive(1);
                        $article->setPriority(10);
                        $article->setDescription($item->_id);
                        $article->save();
                        $count++;
                    }catch (Exception $e){
                        var_dump($e->getMessage());die;
                    }

                }
            }
        }
        echo ('Update thành công '.$count. ' tin tức');
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
