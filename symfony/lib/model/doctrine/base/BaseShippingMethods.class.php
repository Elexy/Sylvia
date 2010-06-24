<?php

/**
 * BaseShippingMethods
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $shippingmethodid
 * @property string $shippingmethod
 * 
 * @method integer         getShippingmethodid() Returns the current record's "shippingmethodid" value
 * @method string          getShippingmethod()   Returns the current record's "shippingmethod" value
 * @method ShippingMethods setShippingmethodid() Sets the current record's "shippingmethodid" value
 * @method ShippingMethods setShippingmethod()   Sets the current record's "shippingmethod" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseShippingMethods extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('shipping_methods');
        $this->hasColumn('shippingmethodid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('shippingmethod', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}