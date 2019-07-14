<?php

/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 7/6/2017
 * Time: 3:25 PM
 */
class pageHomeComponents extends sfComponents
{
    public function executeIndex(sfWebRequest $request)
    {

    }

    public function executeOceanPark(sfWebRequest $request)
    {

    }

    public function executeNewsHot(sfWebRequest $request)
    {

    }

    public function executeListMenu(sfWebRequest $request)
    {
        $listLocation = adLocationTable::getAllLocation();

        $countMessage = adMassageTable::countListMassageGroupByLocation();

        $strLocation = 'H004,H008,VN';
        $arrLocation = explode(',', $strLocation);
        $arrLocationName = [
            'H004' => 'Hà Nội',
            'H008' => 'HCM',
            'VN' => 'Đà Nẵng',
        ];
        $arrMenu = [];
        foreach ($listLocation as $item) {
            $arrMenu[$item['code']]['listItem'][] = $item;
        }
        $this->arrMenu = $arrMenu;
        $this->arrLocation = $arrLocation;
        $this->arrLocationName = $arrLocationName;
        $this->countMessage = $countMessage;
    }
}
