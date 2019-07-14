<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 5/6/14
 * Time: 11:08 AM
 * To change this template use File | Settings | File Templates.
 */
class moduleMenuComponents extends sfComponents
{
    public function executeHeader(){
        $listAllConfig = AdConfigTable::getAllConfig();
        $listConfig = array();
        if($listAllConfig){
            foreach ($listAllConfig as $val){
                $listConfig[$val['config_key']] = $val['config_val'];
            }
        }
        $this->listConfig = $listConfig;
        //lay danh sach menu
        $this->listCategory = VtpProductsCategoryTable::getProductCategoryHome('',4)->execute();
    }

    public function executeFooter(){
        $listAllConfig = AdConfigTable::getAllConfig();
        $listConfig = array();
        if($listAllConfig){
            foreach ($listAllConfig as $val){
                $listConfig[$val['config_key']] = $val['config_val'];
            }
        }
        $this->listConfig = $listConfig;
    }
    public function executeMenuMobile(){

    }
}