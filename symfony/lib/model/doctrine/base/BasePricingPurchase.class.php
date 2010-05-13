<?php

/**
 * BasePricingPurchase
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $recordid
 * @property decimal $purchase_price
 * @property integer $currencyid
 * @property date $start_date
 * @property date $end_date
 * @property timestamp $created
 * @property integer $created_by
 * @property integer $contactid
 * @property integer $productid
 * @property integer $price_type
 * @property integer $start_number
 * @property integer $end_number
 * @property timestamp $updated_at
 * @property integer $updated_at_by
 * 
 * @method integer         getRecordid()       Returns the current record's "recordid" value
 * @method decimal         getPurchasePrice()  Returns the current record's "purchase_price" value
 * @method integer         getCurrencyid()     Returns the current record's "currencyid" value
 * @method date            getStartDate()      Returns the current record's "start_date" value
 * @method date            getEndDate()        Returns the current record's "end_date" value
 * @method timestamp       getCreated()        Returns the current record's "created" value
 * @method integer         getCreatedBy()      Returns the current record's "created_by" value
 * @method integer         getContactid()      Returns the current record's "contactid" value
 * @method integer         getProductid()      Returns the current record's "productid" value
 * @method integer         getPriceType()      Returns the current record's "price_type" value
 * @method integer         getStartNumber()    Returns the current record's "start_number" value
 * @method integer         getEndNumber()      Returns the current record's "end_number" value
 * @method timestamp       getUpdatedAt()      Returns the current record's "updated_at" value
 * @method integer         getUpdatedAtBy()    Returns the current record's "updated_at_by" value
 * @method PricingPurchase setRecordid()       Sets the current record's "recordid" value
 * @method PricingPurchase setPurchasePrice()  Sets the current record's "purchase_price" value
 * @method PricingPurchase setCurrencyid()     Sets the current record's "currencyid" value
 * @method PricingPurchase setStartDate()      Sets the current record's "start_date" value
 * @method PricingPurchase setEndDate()        Sets the current record's "end_date" value
 * @method PricingPurchase setCreated()        Sets the current record's "created" value
 * @method PricingPurchase setCreatedBy()      Sets the current record's "created_by" value
 * @method PricingPurchase setContactid()      Sets the current record's "contactid" value
 * @method PricingPurchase setProductid()      Sets the current record's "productid" value
 * @method PricingPurchase setPriceType()      Sets the current record's "price_type" value
 * @method PricingPurchase setStartNumber()    Sets the current record's "start_number" value
 * @method PricingPurchase setEndNumber()      Sets the current record's "end_number" value
 * @method PricingPurchase setUpdatedAt()      Sets the current record's "updated_at" value
 * @method PricingPurchase setUpdatedAtBy()    Sets the current record's "updated_at_by" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePricingPurchase extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pricing_purchase');
        $this->hasColumn('recordid', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('purchase_price', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'notnull' => true,
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('currencyid', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '2',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('start_date', 'date', 25, array(
             'type' => 'date',
             'default' => '0000-00-00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('end_date', 'date', 25, array(
             'type' => 'date',
             'default' => '0000-00-00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('created', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('created_by', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('contactid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'length' => 4,
             ));
        $this->hasColumn('productid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('price_type', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '1',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('start_number', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '1',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('end_number', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('updated_at_by', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}