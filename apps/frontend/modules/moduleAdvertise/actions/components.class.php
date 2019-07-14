<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 5/6/14
 * Time: 6:08 PM
 * To change this template use File | Settings | File Templates.
 */
class moduleAdvertiseComponents extends sfComponents
{
    public function executeTopOne()
    {
        $page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $this->advertise = AdAdvertiseTable::getAdvertise($page, 'topone',VtCommonEnum::portalDefault);
    }

    public function executeAdvertise()
    {
        $page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $this->advertise = AdAdvertiseTable::getAdvertise($page, 'topone',VtCommonEnum::portalDefault);
    }
    public function executeLeft()
    {
        $page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $this->advertise = AdAdvertiseTable::getAdvertise($page, $this->getVar('location'), VtCommonEnum::portalDefault);
    }
    public function executeRightTop()
    {
        $page = sfContext::getInstance()->getRouting()->getCurrentRouteName();
        $this->advertise = AdAdvertiseTable::getAdvertise($page, $this->getVar('location'), VtCommonEnum::portalDefault);
    }
}
