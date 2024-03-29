<?php

/**
 * BaseInvoices
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $employeeid
 * @property integer $invoiceid
 * @property integer $orderid
 * @property integer $shipmentid
 * @property decimal $invoice_total
 * @property decimal $invoice_btw
 * @property integer $paid_yn
 * @property decimal $paid_amount
 * @property timestamp $dummy
 * @property integer $payment_type
 * @property integer $paymentterm
 * @property string $vat_number
 * @property integer $dispuutid
 * @property integer $overduetypeid
 * @property string $shipname
 * @property string $shipaddress
 * @property string $shipcity
 * @property string $shipregion
 * @property string $shippostalcode
 * @property string $shipcountry
 * @property integer $customerid
 * @property string $companyname
 * @property string $address
 * @property string $city
 * @property string $region
 * @property string $postalcode
 * @property string $country
 * @property timestamp $orderdate
 * @property timestamp $requireddate
 * @property timestamp $shippeddate
 * @property string $companynameship
 * @property integer $btw
 * @property date $paid_date
 * @property date $invoice_date
 * 
 * @method integer   getEmployeeid()      Returns the current record's "employeeid" value
 * @method integer   getInvoiceid()       Returns the current record's "invoiceid" value
 * @method integer   getOrderid()         Returns the current record's "orderid" value
 * @method integer   getShipmentid()      Returns the current record's "shipmentid" value
 * @method decimal   getInvoiceTotal()    Returns the current record's "invoice_total" value
 * @method decimal   getInvoiceBtw()      Returns the current record's "invoice_btw" value
 * @method integer   getPaidYn()          Returns the current record's "paid_yn" value
 * @method decimal   getPaidAmount()      Returns the current record's "paid_amount" value
 * @method timestamp getDummy()           Returns the current record's "dummy" value
 * @method integer   getPaymentType()     Returns the current record's "payment_type" value
 * @method integer   getPaymentterm()     Returns the current record's "paymentterm" value
 * @method string    getVatNumber()       Returns the current record's "vat_number" value
 * @method integer   getDispuutid()       Returns the current record's "dispuutid" value
 * @method integer   getOverduetypeid()   Returns the current record's "overduetypeid" value
 * @method string    getShipname()        Returns the current record's "shipname" value
 * @method string    getShipaddress()     Returns the current record's "shipaddress" value
 * @method string    getShipcity()        Returns the current record's "shipcity" value
 * @method string    getShipregion()      Returns the current record's "shipregion" value
 * @method string    getShippostalcode()  Returns the current record's "shippostalcode" value
 * @method string    getShipcountry()     Returns the current record's "shipcountry" value
 * @method integer   getCustomerid()      Returns the current record's "customerid" value
 * @method string    getCompanyname()     Returns the current record's "companyname" value
 * @method string    getAddress()         Returns the current record's "address" value
 * @method string    getCity()            Returns the current record's "city" value
 * @method string    getRegion()          Returns the current record's "region" value
 * @method string    getPostalcode()      Returns the current record's "postalcode" value
 * @method string    getCountry()         Returns the current record's "country" value
 * @method timestamp getOrderdate()       Returns the current record's "orderdate" value
 * @method timestamp getRequireddate()    Returns the current record's "requireddate" value
 * @method timestamp getShippeddate()     Returns the current record's "shippeddate" value
 * @method string    getCompanynameship() Returns the current record's "companynameship" value
 * @method integer   getBtw()             Returns the current record's "btw" value
 * @method date      getPaidDate()        Returns the current record's "paid_date" value
 * @method date      getInvoiceDate()     Returns the current record's "invoice_date" value
 * @method Invoices  setEmployeeid()      Sets the current record's "employeeid" value
 * @method Invoices  setInvoiceid()       Sets the current record's "invoiceid" value
 * @method Invoices  setOrderid()         Sets the current record's "orderid" value
 * @method Invoices  setShipmentid()      Sets the current record's "shipmentid" value
 * @method Invoices  setInvoiceTotal()    Sets the current record's "invoice_total" value
 * @method Invoices  setInvoiceBtw()      Sets the current record's "invoice_btw" value
 * @method Invoices  setPaidYn()          Sets the current record's "paid_yn" value
 * @method Invoices  setPaidAmount()      Sets the current record's "paid_amount" value
 * @method Invoices  setDummy()           Sets the current record's "dummy" value
 * @method Invoices  setPaymentType()     Sets the current record's "payment_type" value
 * @method Invoices  setPaymentterm()     Sets the current record's "paymentterm" value
 * @method Invoices  setVatNumber()       Sets the current record's "vat_number" value
 * @method Invoices  setDispuutid()       Sets the current record's "dispuutid" value
 * @method Invoices  setOverduetypeid()   Sets the current record's "overduetypeid" value
 * @method Invoices  setShipname()        Sets the current record's "shipname" value
 * @method Invoices  setShipaddress()     Sets the current record's "shipaddress" value
 * @method Invoices  setShipcity()        Sets the current record's "shipcity" value
 * @method Invoices  setShipregion()      Sets the current record's "shipregion" value
 * @method Invoices  setShippostalcode()  Sets the current record's "shippostalcode" value
 * @method Invoices  setShipcountry()     Sets the current record's "shipcountry" value
 * @method Invoices  setCustomerid()      Sets the current record's "customerid" value
 * @method Invoices  setCompanyname()     Sets the current record's "companyname" value
 * @method Invoices  setAddress()         Sets the current record's "address" value
 * @method Invoices  setCity()            Sets the current record's "city" value
 * @method Invoices  setRegion()          Sets the current record's "region" value
 * @method Invoices  setPostalcode()      Sets the current record's "postalcode" value
 * @method Invoices  setCountry()         Sets the current record's "country" value
 * @method Invoices  setOrderdate()       Sets the current record's "orderdate" value
 * @method Invoices  setRequireddate()    Sets the current record's "requireddate" value
 * @method Invoices  setShippeddate()     Sets the current record's "shippeddate" value
 * @method Invoices  setCompanynameship() Sets the current record's "companynameship" value
 * @method Invoices  setBtw()             Sets the current record's "btw" value
 * @method Invoices  setPaidDate()        Sets the current record's "paid_date" value
 * @method Invoices  setInvoiceDate()     Sets the current record's "invoice_date" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvoices extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('invoices');
        $this->hasColumn('employeeid', 'integer', 2, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('invoiceid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('orderid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('shipmentid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('invoice_total', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('invoice_btw', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('paid_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('paid_amount', 'decimal', 10, array(
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
        $this->hasColumn('payment_type', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('paymentterm', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('vat_number', 'string', 15, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 15,
             ));
        $this->hasColumn('dispuutid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('overduetypeid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('shipname', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('shipaddress', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shipcity', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('shipregion', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('shippostalcode', 'string', 15, array(
             'type' => 'string',
             'length' => 15,
             ));
        $this->hasColumn('shipcountry', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('customerid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('companyname', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('address', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('city', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('region', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('postalcode', 'string', 15, array(
             'type' => 'string',
             'length' => 15,
             ));
        $this->hasColumn('country', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
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
        $this->hasColumn('companynameship', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('btw', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('paid_date', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('invoice_date', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}