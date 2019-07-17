<?php

/**
 * pageHome actions.
 *
 * @package    VTP2.0
 * @subpackage pageHome
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
include('simple_html_dom.php');
class pageHtmlActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {

    }

    public function executeIntroduction(sfWebRequest $request)
    {

    }

    public function executeBorrowing(sfWebRequest $request)
    {

    }

    public function executeCrawAlbum(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $str = 'https://oceanpark.vinhomes.vn/wp-content/uploads/2019/07/VHOP_PV_106_RB_Vuonnhat.jpg,https://oceanpark.vinhomes.vn/wp-content/uploads/2019/07/VHOP_PV_105_RB_Phankhu.jpg,https://oceanpark.vinhomes.vn/wp-content/uploads/2019/07/VHOP_PV_103_RB_Phankhu.jpg,https://oceanpark.vinhomes.vn/wp-content/uploads/2019/07/VHOP_PV_102_RB_Phankhu.jpg,https://oceanpark.vinhomes.vn/wp-content/uploads/2019/07/VHOP_PV_100_RB_VuonNhat.jpg,https://oceanpark.vinhomes.vn/wp-content/uploads/2019/07/VHOP_PV_101_RB_Vuonnhat_RE.jpg';
        $arr = explode(',', $str);
        foreach ($arr as $key => $item){
            try{
                $category = 3;
                $adPhoto = new AdPhoto();
                $adPhoto->setName($category.$key);
                $adPhoto->setFilePath($item);
                $adPhoto->setAlbumId($category);
                $adPhoto->setPriority(1);
                $adPhoto->setIsActive(1);
                $adPhoto->save();

            }catch (Exception $exception){
                var_dump($exception->getMessage());die;

            }

        }

        return $this->renderText('ok');

    }
}
