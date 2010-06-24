<?php

/**
 * BaseCommited
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $orderdetailsid
 * @property integer $orderid
 * @property integer $productid
 * @property decimal $unitprice
 * @property decimal $unitbtw
 * @property decimal $extended_price
 * @property decimal $discount
 * @property timestamp $dummy
 * @property integer $shipid
 * @property decimal $btw_percentage
 * @property float $cost_percentage
 * @property integer $delivered
 * @property string $productname
 * @property string $productdescription
 * @property integer $quantity
 * @property string $serialnb
 * @property date $orderdate
 * 
 * @method integer   getOrderdetailsid()     Returns the current record's "orderdetailsid" value
 * @method integer   getOrderid()            Returns the current record's "orderid" value
 * @method integer   getProductid()          Returns the current record's "productid" value
 * @method decimal   getUnitprice()          Returns the current record's "unitprice" value
 * @method decimal   getUnitbtw()            Returns the current record's "unitbtw" value
 * @method decimal   getExtendedPrice()      Returns the current record's "extended_price" value
 * @method decimal   getDiscount()           Returns the current record's "discount" value
 * @method timestamp getDummy()              Returns the current record's "dummy" value
 * @method integer   getShipid()             Returns the current record's "shipid" value
 * @method decimal   getBtwPercentage()      Returns the current record's "btw_percentage" value
 * @method float     getCostPercentage()     Returns the current record's "cost_percentage" value
 * @method integer   getDelivered()          Returns the current record's "delivered" value
 * @method string    getProductname()        Returns the current record's "productname" value
 * @method string    getProductdescription() Returns the current record's "productdescription" value
 * @method integer   getQuantity()           Returns the current record's "quantity" value
 * @method string    getSerialnb()           Returns the current record's "serialnb" value
 * @method date      getOrderdate()          Returns the current record's "orderdate" value
 * @method Commited  setOrderdetailsid()     Sets the current record's "orderdetailsid" value
 * @method Commited  setOrderid()            Sets the current record's "orderid" value
 * @method Commited  setProductid()          Sets the current record's "productid" value
 * @method Commited  setUnitprice()          Sets the current record's "unitprice" value
 * @method Commited  setUnitbtw()            Sets the current record's "unitbtw" value
 * @method Commited  setExtendedPrice()      Sets the current record's "extended_price" value
 * @method Commited  setDiscount()           Sets the current record's "discount" value
 * @method Commited  setDummy()              Sets the current record's "dummy" value
 * @method Commited  setShipid()             Sets the current record's "shipid" value
 * @method Commited  setBtwPercentage()      Sets the current record's "btw_percentage" value
 * @method Commited  setCostPercentage()     Sets the current record's "cost_percentage" value
 * @method Commited  setDelivered()          Sets the current record's "delivered" value
 * @method Commited  setProductname()        Sets the current record's "productname" value
 * @method Commited  setProductdescription() Sets the current record's "productdescription" value
 * @method Commited  setQuantity()           Sets the current record's "quantity" value
 * @method Commited  setSerialnb()           Sets the current record's "serialnb" value
 * @method Commited  setOrderdate()          Sets the current record's "orderdate" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCommited extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('commited');
        $this->hasColumn('orderdetailsid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('orderid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('productid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('unitprice', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'notnull' => true,
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('unitbtw', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'notnull' => true,
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('extended_price', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'notnull' => true,
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('discount', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('shipid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('btw_percentage', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'notnull' => true,
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('cost_percentage', 'float', 6, array(
             'type' => 'float',
             'default' => '0',
             'notnull' => true,
             'length' => 6,
             ));
        $this->hasColumn('delivered', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 2,
             ));
        $this->hasColumn('productname', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('productdescription', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
        $this->hasColumn('quantity', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             ));
        $this->hasColumn('serialnb', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('orderdate', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}