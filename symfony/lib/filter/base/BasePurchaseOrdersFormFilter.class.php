<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PurchaseOrders filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePurchaseOrdersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'purchaseordernumber'      => new sfWidgetFormFilterInput(),
      'purchaseorderdescription' => new sfWidgetFormFilterInput(),
      'supplierid'               => new sfWidgetFormFilterInput(),
      'employeeid'               => new sfWidgetFormFilterInput(),
      'orderdate'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'shipcontactid'            => new sfWidgetFormFilterInput(),
      'ship_adresid'             => new sfWidgetFormFilterInput(),
      'shipname'                 => new sfWidgetFormFilterInput(),
      'shipaddress'              => new sfWidgetFormFilterInput(),
      'shippostalcode'           => new sfWidgetFormFilterInput(),
      'shipcity'                 => new sfWidgetFormFilterInput(),
      'shipcountry'              => new sfWidgetFormFilterInput(),
      'daterequired'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'datepromised'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'shipdate'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'shippingmethodid'         => new sfWidgetFormFilterInput(),
      'freightcharge'            => new sfWidgetFormFilterInput(),
      'order_currency'           => new sfWidgetFormFilterInput(),
      'btw_yn'                   => new sfWidgetFormFilterInput(),
      'po_sent'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'status'                   => new sfWidgetFormFilterInput(),
      'buyer_contactid'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'purchaseordernumber'      => new sfValidatorPass(array('required' => false)),
      'purchaseorderdescription' => new sfValidatorPass(array('required' => false)),
      'supplierid'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employeeid'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdate'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'shipcontactid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ship_adresid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipname'                 => new sfValidatorPass(array('required' => false)),
      'shipaddress'              => new sfValidatorPass(array('required' => false)),
      'shippostalcode'           => new sfValidatorPass(array('required' => false)),
      'shipcity'                 => new sfValidatorPass(array('required' => false)),
      'shipcountry'              => new sfValidatorPass(array('required' => false)),
      'daterequired'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'datepromised'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'shipdate'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'shippingmethodid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'freightcharge'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'order_currency'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_yn'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'po_sent'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'status'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'buyer_contactid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('purchase_orders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'purchaseordernumber'      => 'Text',
      'purchaseorderdescription' => 'Text',
      'supplierid'               => 'Number',
      'employeeid'               => 'Number',
      'orderdate'                => 'Date',
      'shipcontactid'            => 'Number',
      'ship_adresid'             => 'Number',
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
      'order_currency'           => 'Number',
      'btw_yn'                   => 'Number',
      'po_sent'                  => 'Date',
      'status'                   => 'Number',
      'buyer_contactid'          => 'Number',
    );
  }
}
