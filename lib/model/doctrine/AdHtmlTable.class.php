<?php

/**
 * AdHtmlTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AdHtmlTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AdHtmlTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AdHtml');
    }

    public static function checkSlug($slug, $id)
    {
        $query = AdHtmlTable::getInstance()->createQuery()
            ->select('slug')
            ->where('slug=?', $slug)
            ->andWhere('id<>?', $id);
        return $query;
    }

    public static function getAllHtml()
    {
        $query = AdHtmlTable::getInstance()->createQuery()
            ->where('is_active=?', VtCommonEnum::NUMBER_ONE)
            ->orderBy('id ASC');
        return $query->fetchArray();
    }

    public static function getHtmlByHtml($slug)
    {
        $query = AdHtmlTable::getInstance()->createQuery()
            ->where('is_active=?', VtCommonEnum::NUMBER_ONE)
            ->andWhere('slug=?', $slug)
            ->andWhere('lang=?', sfContext::getInstance()->getUser()->getCulture());
        return $query->fetchOne();
    }

    public static function getHtmlById($id)
    {
        $query = AdHtmlTable::getInstance()->createQuery()
            ->where('is_active=?', VtCommonEnum::NUMBER_ONE)
            ->andWhere('id=?', $id)
            ->andWhere('lang=?', sfContext::getInstance()->getUser()->getCulture());
        return $query->fetchOne();
    }

    public static function getHtmlByRouting($routing)
    {
        $query = AdHtmlTable::getInstance()->createQuery()
            ->where('is_active=?', VtCommonEnum::NUMBER_ONE)
            ->andWhere('prefix_path=?', $routing)
            ->andWhere('lang=?', sfContext::getInstance()->getUser()->getCulture());
        return $query->fetchOne();
    }
}