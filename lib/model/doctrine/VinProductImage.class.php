<?php

/**
 * VinProductImage
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class VinProductImage extends BaseVinProductImage
{
    public function getProductIdName()
    {
        if ($this->product_id) {
            $obj = VinApartmentTypeTable::getInstance()->findOneById($this->product_id);
            return !empty($obj) ? $obj->name_type : '';
        }
        return '';
    }

    public function getGroupsName()
    {
        return VinHelper::getImageGroup($this->groups);
    }
}