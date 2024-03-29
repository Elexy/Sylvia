<?php

/**
 * BaseOrders
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $orderid
 * @property integer $xp_no
 * @property integer $shipvia
 * @property integer $shipid
 * @property integer $locked_yn
 * @property timestamp $dummy
 * @property integer $confirmed_yn
 * @property integer $blockorder
 * @property integer $endcustomer_yn
 * @property integer $paymentterm_yn
 * @property integer $btw_yn
 * @property integer $price_level
 * @property integer $complete_yn
 * @property decimal $transportcosts
 * @property integer $manual_transportcosts
 * @property decimal $ordercosts
 * @property integer $manual_ordercosts
 * @property integer $employee
 * @property integer $in_one_delivery_yn
 * @property integer $rma_yn
 * @property integer $consignment_order
 * @property integer $administration_order
 * @property integer $contactid
 * @property string $contactsorderid
 * @property integer $employeeid
 * @property timestamp $orderdate
 * @property timestamp $requireddate
 * @property timestamp $shippeddate
 * @property string $mailtable
 * @property string $shipname
 * @property string $shipaddress
 * @property string $shipcity
 * @property string $shipregion
 * @property string $shippostalcode
 * @property string $shipcountry
 * @property string $comments
 * @property string $confirmed_how
 * @property string $trackingnummer
 * 
 * @method integer   getOrderid()               Returns the current record's "orderid" value
 * @method integer   getXpNo()                  Returns the current record's "xp_no" value
 * @method integer   getShipvia()               Returns the current record's "shipvia" value
 * @method integer   getShipid()                Returns the current record's "shipid" value
 * @method integer   getLockedYn()              Returns the current record's "locked_yn" value
 * @method timestamp getDummy()                 Returns the current record's "dummy" value
 * @method integer   getConfirmedYn()           Returns the current record's "confirmed_yn" value
 * @method integer   getBlockorder()            Returns the current record's "blockorder" value
 * @method integer   getEndcustomerYn()         Returns the current record's "endcustomer_yn" value
 * @method integer   getPaymenttermYn()         Returns the current record's "paymentterm_yn" value
 * @method integer   getBtwYn()                 Returns the current record's "btw_yn" value
 * @method integer   getPriceLevel()            Returns the current record's "price_level" value
 * @method integer   getCompleteYn()            Returns the current record's "complete_yn" value
 * @method decimal   getTransportcosts()        Returns the current record's "transportcosts" value
 * @method integer   getManualTransportcosts()  Returns the current record's "manual_transportcosts" value
 * @method decimal   getOrdercosts()            Returns the current record's "ordercosts" value
 * @method integer   getManualOrdercosts()      Returns the current record's "manual_ordercosts" value
 * @method integer   getEmployee()              Returns the current record's "employee" value
 * @method integer   getInOneDeliveryYn()       Returns the current record's "in_one_delivery_yn" value
 * @method integer   getRmaYn()                 Returns the current record's "rma_yn" value
 * @method integer   getConsignmentOrder()      Returns the current record's "consignment_order" value
 * @method integer   getAdministrationOrder()   Returns the current record's "administration_order" value
 * @method integer   getContactid()             Returns the current record's "contactid" value
 * @method string    getContactsorderid()       Returns the current record's "contactsorderid" value
 * @method integer   getEmployeeid()            Returns the current record's "employeeid" value
 * @method timestamp getOrderdate()             Returns the current record's "orderdate" value
 * @method timestamp getRequireddate()          Returns the current record's "requireddate" value
 * @method timestamp getShippeddate()           Returns the current record's "shippeddate" value
 * @method string    getMailtable()             Returns the current record's "mailtable" value
 * @method string    getShipname()              Returns the current record's "shipname" value
 * @method string    getShipaddress()           Returns the current record's "shipaddress" value
 * @method string    getShipcity()              Returns the current record's "shipcity" value
 * @method string    getShipregion()            Returns the current record's "shipregion" value
 * @method string    getShippostalcode()        Returns the current record's "shippostalcode" value
 * @method string    getShipcountry()           Returns the current record's "shipcountry" value
 * @method string    getComments()              Returns the current record's "comments" value
 * @method string    getConfirmedHow()          Returns the current record's "confirmed_how" value
 * @method string    getTrackingnummer()        Returns the current record's "trackingnummer" value
 * @method Orders    setOrderid()               Sets the current record's "orderid" value
 * @method Orders    setXpNo()                  Sets the current record's "xp_no" value
 * @method Orders    setShipvia()               Sets the current record's "shipvia" value
 * @method Orders    setShipid()                Sets the current record's "shipid" value
 * @method Orders    setLockedYn()              Sets the current record's "locked_yn" value
 * @method Orders    setDummy()                 Sets the current record's "dummy" value
 * @method Orders    setConfirmedYn()           Sets the current record's "confirmed_yn" value
 * @method Orders    setBlockorder()            Sets the current record's "blockorder" value
 * @method Orders    setEndcustomerYn()         Sets the current record's "endcustomer_yn" value
 * @method Orders    setPaymenttermYn()         Sets the current record's "paymentterm_yn" value
 * @method Orders    setBtwYn()                 Sets the current record's "btw_yn" value
 * @method Orders    setPriceLevel()            Sets the current record's "price_level" value
 * @method Orders    setCompleteYn()            Sets the current record's "complete_yn" value
 * @method Orders    setTransportcosts()        Sets the current record's "transportcosts" value
 * @method Orders    setManualTransportcosts()  Sets the current record's "manual_transportcosts" value
 * @method Orders    setOrdercosts()            Sets the current record's "ordercosts" value
 * @method Orders    setManualOrdercosts()      Sets the current record's "manual_ordercosts" value
 * @method Orders    setEmployee()              Sets the current record's "employee" value
 * @method Orders    setInOneDeliveryYn()       Sets the current record's "in_one_delivery_yn" value
 * @method Orders    setRmaYn()                 Sets the current record's "rma_yn" value
 * @method Orders    setConsignmentOrder()      Sets the current record's "consignment_order" value
 * @method Orders    setAdministrationOrder()   Sets the current record's "administration_order" value
 * @method Orders    setContactid()             Sets the current record's "contactid" value
 * @method Orders    setContactsorderid()       Sets the current record's "contactsorderid" value
 * @method Orders    setEmployeeid()            Sets the current record's "employeeid" value
 * @method Orders    setOrderdate()             Sets the current record's "orderdate" value
 * @method Orders    setRequireddate()          Sets the current record's "requireddate" value
 * @method Orders    setShippeddate()           Sets the current record's "shippeddate" value
 * @method Orders    setMailtable()             Sets the current record's "mailtable" value
 * @method Orders    setShipname()              Sets the current record's "shipname" value
 * @method Orders    setShipaddress()           Sets the current record's "shipaddress" value
 * @method Orders    setShipcity()              Sets the current record's "shipcity" value
 * @method Orders    setShipregion()            Sets the current record's "shipregion" value
 * @method Orders    setShippostalcode()        Sets the current record's "shippostalcode" value
 * @method Orders    setShipcountry()           Sets the current record's "shipcountry" value
 * @method Orders    setComments()              Sets the current record's "comments" value
 * @method Orders    setConfirmedHow()          Sets the current record's "confirmed_how" value
 * @method Orders    setTrackingnummer()        Sets the current record's "trackingnummer" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrders extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('orders');
        $this->hasColumn('orderid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('xp_no', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('shipvia', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('shipid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('locked_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('confirmed_yn', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('blockorder', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('endcustomer_yn', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('paymentterm_yn', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('btw_yn', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('price_level', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('complete_yn', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('transportcosts', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('manual_transportcosts', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('ordercosts', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('manual_ordercosts', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('employee', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('in_one_delivery_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('rma_yn', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('consignment_order', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('administration_order', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('contactid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('contactsorderid', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('employeeid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('orderdate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('requireddate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('shippeddate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('mailtable', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));
        $this->hasColumn('shipname', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shipaddress', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shipcity', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shipregion', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shippostalcode', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shipcountry', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('comments', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
        $this->hasColumn('confirmed_how', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('trackingnummer', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}