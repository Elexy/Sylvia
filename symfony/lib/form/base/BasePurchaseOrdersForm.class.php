<?php

/**
 * PurchaseOrders form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePurchaseOrdersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'purchaseorderid'          => new sfWidgetFormInputHidden(),
      'purchaseordernumber'      => new sfWidgetFormInput(),
      'purchaseorderdescription' => new sfWidgetFormInput(),
      'supplierid'               => new sfWidgetFormInput(),
      'employeeid'               => new sfWidgetFormInput(),
      'orderdate'                => new sfWidgetFormDateTime(),
      'shipcontactid'            => new sfWidgetFormInput(),
      'ship_adresid'             => new sfWidgetFormInput(),
      'shipname'                 => new sfWidgetFormInput(),
      'shipaddress'              => new sfWidgetFormInput(),
      'shippostalcode'           => new sfWidgetFormInput(),
      'shipcity'                 => new sfWidgetFormInput(),
      'shipcountry'              => new sfWidgetFormInput(),
      'daterequired'             => new sfWidgetFormDateTime(),
      'datepromised'             => new sfWidgetFormDateTime(),
      'shipdate'                 => new sfWidgetFormDateTime(),
      'shippingmethodid'         => new sfWidgetFormInput(),
      'freightcharge'            => new sfWidgetFormInput(),
      'order_currency'           => new sfWidgetFormInput(),
      'btw_yn'                   => new sfWidgetFormInput(),
      'po_sent'                  => new sfWidgetFormDateTime(),
      'status'                   => new sfWidgetFormInput(),
      'buyer_contactid'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'purchaseorderid'          => new sfValidatorPropelChoice(array('model' => 'PurchaseOrders', 'column' => 'purchaseorderid', 'required' => false)),
      'purchaseordernumber'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'purchaseorderdescription' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'supplierid'               => new sfValidatorInteger(array('required' => false)),
      'employeeid'               => new sfValidatorInteger(array('required' => false)),
      'orderdate'                => new sfValidatorDateTime(array('required' => false)),
      'shipcontactid'            => new sfValidatorInteger(array('required' => false)),
      'ship_adresid'             => new sfValidatorInteger(array('required' => false)),
      'shipname'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipaddress'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shippostalcode'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcity'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcountry'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'daterequired'             => new sfValidatorDateTime(array('required' => false)),
      'datepromised'             => new sfValidatorDateTime(array('required' => false)),
      'shipdate'                 => new sfValidatorDateTime(array('required' => false)),
      'shippingmethodid'         => new sfValidatorInteger(array('required' => false)),
      'freightcharge'            => new sfValidatorInteger(array('required' => false)),
      'order_currency'           => new sfValidatorInteger(array('required' => false)),
      'btw_yn'                   => new sfValidatorInteger(array('required' => false)),
      'po_sent'                  => new sfValidatorDateTime(array('required' => false)),
      'status'                   => new sfValidatorInteger(array('required' => false)),
      'buyer_contactid'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('purchase_orders[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PurchaseOrders';
  }


}
