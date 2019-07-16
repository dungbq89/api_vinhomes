<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('VinApartmentCate', 'doctrine');

/**
 * BaseVinApartmentCate
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $code
 * @property string $name
 * @property string $vin_model
 * @property string $type
 * @property integer $priority
 * 
 * @method string           getCode()      Returns the current record's "code" value
 * @method string           getName()      Returns the current record's "name" value
 * @method string           getVinModel()  Returns the current record's "vin_model" value
 * @method string           getType()      Returns the current record's "type" value
 * @method integer          getPriority()  Returns the current record's "priority" value
 * @method VinApartmentCate setCode()      Sets the current record's "code" value
 * @method VinApartmentCate setName()      Sets the current record's "name" value
 * @method VinApartmentCate setVinModel()  Sets the current record's "vin_model" value
 * @method VinApartmentCate setType()      Sets the current record's "type" value
 * @method VinApartmentCate setPriority()  Sets the current record's "priority" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVinApartmentCate extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vin_apartment_cate');
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'comment' => 'code,key',
             'length' => 255,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'comment' => 'name',
             'length' => 255,
             ));
        $this->hasColumn('vin_model', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'comment' => 'ApartmentCategory, floorsCategory',
             'length' => 255,
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'comment' => 'model',
             'length' => 255,
             ));
        $this->hasColumn('priority', 'integer', 3, array(
             'type' => 'integer',
             'notnull' => false,
             'comment' => 'model',
             'length' => 3,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}