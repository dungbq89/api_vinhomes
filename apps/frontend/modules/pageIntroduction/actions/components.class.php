<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 7/24/14
 * Time: 6:03 PM
 * To change this template use File | Settings | File Templates.
 */
class pageIntroductionComponents extends sfComponents
{
    public function executeCategoryIntro(){
        $catIntro = sfConfig::get('app_cat_id',0);
        $listCat = AdCategoryTable::getCategoryByParentID($catIntro);
        if($listCat){
            $this->listCat = $listCat;
        }
        else{
            return sfView::NONE;
        }
    }

}