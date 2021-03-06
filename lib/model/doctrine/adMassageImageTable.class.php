<?php

/**
 * adMassageImageTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class adMassageImageTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object adMassageImageTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('adMassageImage');
    }

    public static function getListSlideByMassage($massageId)
    {
        $query = adMassageImageTable::getInstance()->createQuery()
            ->andWhere('massage_id=?', $massageId)
            ->andWhere('is_active=1')
            ->orderBy('priority asc, updated_at desc')
            ->fetchArray();
        if (!empty($query)) {
            return $query;
        }
        return false;
    }
}