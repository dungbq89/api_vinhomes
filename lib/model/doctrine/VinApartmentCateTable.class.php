<?php

/**
 * VinApartmentCateTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VinApartmentCateTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object VinApartmentCateTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('VinApartmentCate');
    }

    public function getAllApartmentCategory($vinModel = 'ApartmentCategory')
    {
        $q = $this->createQuery()
            ->andWhere('vin_model = ?', $vinModel)
            ->orderBy('priority asc');
        return $q->execute();
    }

    public function getAllApartmentCategoryByParent($parent, $vinModel = false)
    {
        $q = $this->createQuery()
            ->andWhere('parent = ?', $parent);
        if ($vinModel) {
            $q->andWhere('vin_model = ?', $vinModel);
        };
        $q->orderBy('priority asc');
        return $q->execute();
    }

    public function getAllFloor($parent, $vinModel = false)
    {
        $q = $this->createQuery()
            ->andWhere('parent = ?', $parent);
        if ($vinModel) {
            $q->andWhere('vin_model = ?', $vinModel);
        };
        $q->orderBy('priority asc')->groupBy('type');
        return $q->execute();
    }

    public function getAllApartmentCat($parent = false, $vinModel = false)
    {
        $q = $this->createQuery();
        if ($parent) {
            $q = $q->andWhere('parent = ?', $parent);
        }
        if ($vinModel) {
            $q = $q->andWhere('vin_model = ?', $vinModel);
        }
        $q = $q->orderBy('priority asc');
        return $q->execute();
    }

}