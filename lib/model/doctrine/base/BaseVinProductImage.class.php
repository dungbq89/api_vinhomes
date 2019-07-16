<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('VinProductImage', 'doctrine');

/**
 * BaseVinProductImage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $file_path
 * @property integer $product_id
 * @property string $extension
 * @property integer $priority
 * @property integer $type
 * @property integer $groups
 * 
 * @method string          getFilePath()   Returns the current record's "file_path" value
 * @method integer         getProductId()  Returns the current record's "product_id" value
 * @method string          getExtension()  Returns the current record's "extension" value
 * @method integer         getPriority()   Returns the current record's "priority" value
 * @method integer         getType()       Returns the current record's "type" value
 * @method integer         getGroups()     Returns the current record's "groups" value
 * @method VinProductImage setFilePath()   Sets the current record's "file_path" value
 * @method VinProductImage setProductId()  Sets the current record's "product_id" value
 * @method VinProductImage setExtension()  Sets the current record's "extension" value
 * @method VinProductImage setPriority()   Sets the current record's "priority" value
 * @method VinProductImage setType()       Sets the current record's "type" value
 * @method VinProductImage setGroups()     Sets the current record's "groups" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVinProductImage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vin_products_image');
        $this->hasColumn('file_path', 'string', 255, array(
             'type' => 'string',
             'notnull' => false,
             'comment' => 'Đường dẫn file',
             'length' => 255,
             ));
        $this->hasColumn('product_id', 'integer', null, array(
             'type' => 'integer',
             'comment' => 'sản phẩm thiết bị',
             ));
        $this->hasColumn('extension', 'string', 200, array(
             'type' => 'string',
             'comment' => 'phần mở rộng của file',
             'length' => 200,
             ));
        $this->hasColumn('priority', 'integer', 5, array(
             'type' => 'integer',
             'notnull' => false,
             'comment' => 'Độ ưu tiên hiển thị',
             'length' => 5,
             ));
        $this->hasColumn('type', 'integer', 5, array(
             'type' => 'integer',
             'notnull' => false,
             'comment' => '1: thu muc, 2 link',
             'length' => 5,
             ));
        $this->hasColumn('groups', 'integer', 5, array(
             'type' => 'integer',
             'notnull' => false,
             'comment' => '1: 360, 2: walk, 3: thiet ke, 4: anh demo',
             'length' => 5,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}