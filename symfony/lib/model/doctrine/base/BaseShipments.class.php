<?php

/**
 * BaseShipments
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $shipment_id
 * @property integer $adressid
 * @property integer $invoiceid
 * @property string $tracking
 * @property timestamp $dummy
 * @property integer $cancel
 * @property integer $email_send
 * @property timestamp $start_date
 * @property timestamp $ship_date
 * 
 * @method integer   getShipmentId()  Returns the current record's "shipment_id" value
 * @method integer   getAdressid()    Returns the current record's "adressid" value
 * @method integer   getInvoiceid()   Returns the current record's "invoiceid" value
 * @method string    getTracking()    Returns the current record's "tracking" value
 * @method timestamp getDummy()       Returns the current record's "dummy" value
 * @method integer   getCancel()      Returns the current record's "cancel" value
 * @method integer   getEmailSend()   Returns the current record's "email_send" value
 * @method timestamp getStartDate()   Returns the current record's "start_date" value
 * @method timestamp getShipDate()    Returns the current record's "ship_date" value
 * @method Shipments setShipmentId()  Sets the current record's "shipment_id" value
 * @method Shipments setAdressid()    Sets the current record's "adressid" value
 * @method Shipments setInvoiceid()   Sets the current record's "invoiceid" value
 * @method Shipments setTracking()    Sets the current record's "tracking" value
 * @method Shipments setDummy()       Sets the current record's "dummy" value
 * @method Shipments setCancel()      Sets the current record's "cancel" value
 * @method Shipments setEmailSend()   Sets the current record's "email_send" value
 * @method Shipments setStartDate()   Sets the current record's "start_date" value
 * @method Shipments setShipDate()    Sets the current record's "ship_date" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseShipments extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('shipments');
        $this->hasColumn('shipment_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('adressid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('invoiceid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('tracking', 'string', 50, array(
             'type' => 'string',
             'default' => '0',
             'length' => 50,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('cancel', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('email_send', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('start_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('ship_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}