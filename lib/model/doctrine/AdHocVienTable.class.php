<?php

/**
 * AdHocVienTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AdHocVienTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AdHocVienTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AdHocVien');
    }

    public static function getAllStudent($limit=12)
    {
        return AdHocVienTable::getInstance()->createQuery()
            ->where('is_active=1')
            ->orderBy('priority desc')
            ->limit($limit)
            ->fetchArray();
    }

    public function getListStudent($limit, $page)
    {
        $query = $this->createQuery()
            ->where('is_active=?', VtCommonEnum::NUMBER_ONE)
            ->orderBy('priority asc');

        $pager = new sfDoctrinePager('AdHocVien', $limit);
        $pager->setQuery($query);
        $pager->setPage($page);
        $pager->init();
        return $pager;
    }

    public static function getNewsByDesc($desc)
    {
        return AdHocVienTable::getInstance()->createQuery()
            ->where('description =?', $desc)
            ->fetchOne();
    }

}