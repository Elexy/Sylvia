<?php

/**
 * BaseInventoryTransactions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $transactionid
 * @property integer $podetailsid
 * @property integer $orderid
 * @property integer $orderdetailsid
 * @property integer $shipmentid
 * @property decimal $unitprice
 * @property integer $unitsordered
 * @property integer $backorder
 * @property integer $unitsreceived
 * @property integer $unitssold
 * @property integer $unitsshrinkage
 * @property timestamp $dummy
 * @property decimal $btw_percentage
 * @property float $added_cost
 * @property integer $box_id
 * @property integer $employee
 * @property integer $stock_owner_id
 * @property timestamp $transactiondate
 * @property integer $productid
 * @property string $description
 * @property string $externalid
 * @property integer $purchaseorderid
 * @property string $transactiondescription
 * 
 * @method integer               getTransactionid()          Returns the current record's "transactionid" value
 * @method integer               getPodetailsid()            Returns the current record's "podetailsid" value
 * @method integer               getOrderid()                Returns the current record's "orderid" value
 * @method integer               getOrderdetailsid()         Returns the current record's "orderdetailsid" value
 * @method integer               getShipmentid()             Returns the current record's "shipmentid" value
 * @method decimal               getUnitprice()              Returns the current record's "unitprice" value
 * @method integer               getUnitsordered()           Returns the current record's "unitsordered" value
 * @method integer               getBackorder()              Returns the current record's "backorder" value
 * @method integer               getUnitsreceived()          Returns the current record's "unitsreceived" value
 * @method integer               getUnitssold()              Returns the current record's "unitssold" value
 * @method integer               getUnitsshrinkage()         Returns the current record's "unitsshrinkage" value
 * @method timestamp             getDummy()                  Returns the current record's "dummy" value
 * @method decimal               getBtwPercentage()          Returns the current record's "btw_percentage" value
 * @method float                 getAddedCost()              Returns the current record's "added_cost" value
 * @method integer               getBoxId()                  Returns the current record's "box_id" value
 * @method integer               getEmployee()               Returns the current record's "employee" value
 * @method integer               getStockOwnerId()           Returns the current record's "stock_owner_id" value
 * @method timestamp             getTransactiondate()        Returns the current record's "transactiondate" value
 * @method integer               getProductid()              Returns the current record's "productid" value
 * @method string                getDescription()            Returns the current record's "description" value
 * @method string                getExternalid()             Returns the current record's "externalid" value
 * @method integer               getPurchaseorderid()        Returns the current record's "purchaseorderid" value
 * @method string                getTransactiondescription() Returns the current record's "transactiondescription" value
 * @method InventoryTransactions setTransactionid()          Sets the current record's "transactionid" value
 * @method InventoryTransactions setPodetailsid()            Sets the current record's "podetailsid" value
 * @method InventoryTransactions setOrderid()                Sets the current record's "orderid" value
 * @method InventoryTransactions setOrderdetailsid()         Sets the current record's "orderdetailsid" value
 * @method InventoryTransactions setShipmentid()             Sets the current record's "shipmentid" value
 * @method InventoryTransactions setUnitprice()              Sets the current record's "unitprice" value
 * @method InventoryTransactions setUnitsordered()           Sets the current record's "unitsordered" value
 * @method InventoryTransactions setBackorder()              Sets the current record's "backorder" value
 * @method InventoryTransactions setUnitsreceived()          Sets the current record's "unitsreceived" value
 * @method InventoryTransactions setUnitssold()              Sets the current record's "unitssold" value
 * @method InventoryTransactions setUnitsshrinkage()         Sets the current record's "unitsshrinkage" value
 * @method InventoryTransactions setDummy()                  Sets the current record's "dummy" value
 * @method InventoryTransactions setBtwPercentage()          Sets the current record's "btw_percentage" value
 * @method InventoryTransactions setAddedCost()              Sets the current record's "added_cost" value
 * @method InventoryTransactions setBoxId()                  Sets the current record's "box_id" value
 * @method InventoryTransactions setEmployee()               Sets the current record's "employee" value
 * @method InventoryTransactions setStockOwnerId()           Sets the current record's "stock_owner_id" value
 * @method InventoryTransactions setTransactiondate()        Sets the current record's "transactiondate" value
 * @method InventoryTransactions setProductid()              Sets the current record's "productid" value
 * @method InventoryTransactions setDescription()            Sets the current record's "description" value
 * @method InventoryTransactions setExternalid()             Sets the current record's "externalid" value
 * @method InventoryTransactions setPurchaseorderid()        Sets the current record's "purchaseorderid" value
 * @method InventoryTransactions setTransactiondescription() Sets the current record's "transactiondescription" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInventoryTransactions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('inventory_transactions');
        $this->hasColumn('transactionid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('podetailsid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('orderid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('orderdetailsid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('shipmentid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('unitprice', 'decimal', 10, array(
             'type' => 'decimal',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('unitsordered', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('backorder', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 2,
             ));
        $this->hasColumn('unitsreceived', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('unitssold', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('unitsshrinkage', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('btw_percentage', 'decimal', 4, array(
             'type' => 'decimal',
             'default' => '0.00',
             'notnull' => true,
             'scale' => false,
             'length' => 4,
             ));
        $this->hasColumn('added_cost', 'float', 6, array(
             'type' => 'float',
             'default' => '0',
             'notnull' => true,
             'length' => 6,
             ));
        $this->hasColumn('box_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('employee', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('stock_owner_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '802',
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('transactiondate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('productid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('externalid', 'string', 25, array(
             'type' => 'string',
             'length' => 25,
             ));
        $this->hasColumn('purchaseorderid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('transactiondescription', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}