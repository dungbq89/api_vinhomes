<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 7/24/14
 * Time: 6:03 PM
 * To change this template use File | Settings | File Templates.
 */
class moduleVideoComponents extends sfComponents
{
    public function executeListVideoHome(){
        $limit = $this->getVar('limit');
        if (!isset($limit))
            $limit = 5;
        $this->width=($this->getVar('width'))?$this->getVar('width'):'300';
        $listVideo = AdVideoTable::getListVideoHome($limit)->execute();
        if($listVideo){
            $this->listVideo = $listVideo;
        }
        else{
            return sfView::NONE;
        }
    }

}