<?php

/**
 * PurchaseOrders filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePurchaseOrdersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ship_adresid'             => new sfWidgetFormFilterInput(),
      'order_currency'           => new sfWidgetFormFilterInput(),
      'dummy'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'status'                   => new sfWidgetFormFilterInput(),
      'buyer_contactid'          => new sfWidgetFormFilterInput(),
      'purchaseordernumber'      => new sfWidgetFormFilterInput(),
      'purchaseorderdescription' => new sfWidgetFormFilterInput(),
      'supplierid'               => new sfWidgetFormFilterInput(),
      'employeeid'               => new sfWidgetFormFilterInput(),
      'orderdate'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'shipcontactid'            => new sfWidgetFormFilterInput(),
      'shipname'                 => new sfWidgetFormFilterInput(),
      'shipaddress'              => new sfWidgetFormFilterInput(),
      'shippostalcode'           => new sfWidgetFormFilterInput(),
      'shipcity'                 => new sfWidgetFormFilterInput(),
      'shipcountry'              => new sfWidgetFormFilterInput(),
      'daterequired'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datepromised'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'shipdate'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'shippingmethodid'         => new sfWidgetFormFilterInput(),
      'freightcharge'            => new sfWidgetFormFilterInput(),
      'btw_yn'                   => new sfWidgetFormFilterInput(),
      'po_sent'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'ship_adresid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'order_currency'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'buyer_contactid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'purchaseordernumber'      => new sfValidatorPass(array('required' => false)),
      'purchaseorderdescription' => new sfValidatorPass(array('required' => false)),
      'supplierid'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employeeid'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdate'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shipcontactid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipname'                 => new sfValidatorPass(array('required' => false)),
      'shipaddress'              => new sfValidatorPass(array('required' => false)),
      'shippostalcode'           => new sfValidatorPass(array('required' => false)),
      'shipcity'                 => new sfValidatorPass(array('required' => false)),
      'shipcountry'              => new sfValidatorPass(array('required' => false)),
      'daterequired'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'datepromised'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shipdate'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shippingmethodid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'freightcharge'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_yn'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'po_sent'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('purchase_orders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PurchaseOrders';
  }

  public function getFields()
  {
    return array(
      'purchaseorderid'          => 'Number',
      'ship_adresid'             => 'Number',
      'order_currency'           => 'Number',
      'dummy'                    => 'Date',
      'status'                   => 'Number',
      'buyer_contactid'          => 'Number',
      'purchaseordernumber'      => 'Text',
      'purchaseorderdescription' => 'Text',
      'supplierid'               => 'Number',
      'employeeid'               => 'Number',
      'orderdate'                => 'Date',
      'shipcontactid'            => 'Number',
      'shipname'                 => 'Text',
      'shipaddress'              => 'Text',
      'shippostalcode'           => 'Text',
      'shipcity'                 => 'Text',
      'shipcountry'              => 'Text',
      'daterequired'             => 'Date',
      'datepromised'             => 'Date',
      'shipdate'                 => 'Date',
      'shippingmethodid'         => 'Number',
      'freightcharge'            => 'Number',
      'btw_yn'                   => 'Number',
      'po_sent'                  => 'Date',
    );
  }
}
