<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AdUserSigninLock', 'doctrine');

/**
 * BaseAdUserSigninLock
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $user_name
 * @property integer $created_time
 * 
 * @method string           getUserName()     Returns the current record's "user_name" value
 * @method integer          getCreatedTime()  Returns the current record's "created_time" value
 * @method AdUserSigninLock setUserName()     Sets the current record's "user_name" value
 * @method AdUserSigninLock setCreatedTime()  Sets the current record's "created_time" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAdUserSigninLock extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ad_user_signin_lock');
        $this->hasColumn('user_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('created_time', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}