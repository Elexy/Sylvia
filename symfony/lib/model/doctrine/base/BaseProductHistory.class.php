<?php

/**
 * BaseProductHistory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $producthistoryid
 * @property integer $productid
 * @property integer $employee
 * @property string $old_value
 * @property string $new_value
 * @property timestamp $date_updated_at
 * @property string $fieldname
 * 
 * @method integer        getProducthistoryid() Returns the current record's "producthistoryid" value
 * @method integer        getProductid()        Returns the current record's "productid" value
 * @method integer        getEmployee()         Returns the current record's "employee" value
 * @method string         getOldValue()         Returns the current record's "old_value" value
 * @method string         getNewValue()         Returns the current record's "new_value" value
 * @method timestamp      getDateUpdatedAt()    Returns the current record's "date_updated_at" value
 * @method string         getFieldname()        Returns the current record's "fieldname" value
 * @method ProductHistory setProducthistoryid() Sets the current record's "producthistoryid" value
 * @method ProductHistory setProductid()        Sets the current record's "productid" value
 * @method ProductHistory setEmployee()         Sets the current record's "employee" value
 * @method ProductHistory setOldValue()         Sets the current record's "old_value" value
 * @method ProductHistory setNewValue()         Sets the current record's "new_value" value
 * @method ProductHistory setDateUpdatedAt()    Sets the current record's "date_updated_at" value
 * @method ProductHistory setFieldname()        Sets the current record's "fieldname" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductHistory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product_history');
        $this->hasColumn('producthistoryid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('productid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('employee', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('old_value', 'string', 100, array(
             'type' => 'string',
             'default' => '0',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('new_value', 'string', 100, array(
             'type' => 'string',
             'default' => '0',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('date_updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('fieldname', 'string', 25, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}