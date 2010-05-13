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
      'purchaseordernumber'      => new sfWidgetFormInputText(),
      'purchaseorderdescription' => new sfWidgetFormInputText(),
      'supplierid'               => new sfWidgetFormInputText(),
      'employeeid'               => new sfWidgetFormInputText(),
      'orderdate'                => new sfWidgetFormDateTime(),
      'shipcontactid'            => new sfWidgetFormInputText(),
      'ship_adresid'             => new sfWidgetFormInputText(),
      'shipname'                 => new sfWidgetFormInputText(),
      'shipaddress'              => new sfWidgetFormInputText(),
      'shippostalcode'           => new sfWidgetFormInputText(),
      'shipcity'                 => new sfWidgetFormInputText(),
      'shipcountry'              => new sfWidgetFormInputText(),
      'daterequired'             => new sfWidgetFormDateTime(),
      'datepromised'             => new sfWidgetFormDateTime(),
      'shipdate'                 => new sfWidgetFormDateTime(),
      'shippingmethodid'         => new sfWidgetFormInputText(),
      'freightcharge'            => new sfWidgetFormInputText(),
      'order_currency'           => new sfWidgetFormInputText(),
      'btw_yn'                   => new sfWidgetFormInputText(),
      'po_sent'                  => new sfWidgetFormDateTime(),
      'status'                   => new sfWidgetFormInputText(),
      'buyer_contactid'          => new sfWidgetFormInputText(),
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
