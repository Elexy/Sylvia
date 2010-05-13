<?php

/**
 * Invoices form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseInvoicesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipname'        => new sfWidgetFormInputText(),
      'shipaddress'     => new sfWidgetFormInputText(),
      'shipcity'        => new sfWidgetFormInputText(),
      'shipregion'      => new sfWidgetFormInputText(),
      'shippostalcode'  => new sfWidgetFormInputText(),
      'shipcountry'     => new sfWidgetFormInputText(),
      'customerid'      => new sfWidgetFormInputText(),
      'companyname'     => new sfWidgetFormInputText(),
      'address'         => new sfWidgetFormInputText(),
      'city'            => new sfWidgetFormInputText(),
      'region'          => new sfWidgetFormInputText(),
      'postalcode'      => new sfWidgetFormInputText(),
      'country'         => new sfWidgetFormInputText(),
      'employeeid'      => new sfWidgetFormInputText(),
      'invoiceid'       => new sfWidgetFormInputHidden(),
      'orderid'         => new sfWidgetFormInputText(),
      'shipmentid'      => new sfWidgetFormInputText(),
      'orderdate'       => new sfWidgetFormDateTime(),
      'requireddate'    => new sfWidgetFormDateTime(),
      'shippeddate'     => new sfWidgetFormDateTime(),
      'companynameship' => new sfWidgetFormInputText(),
      'invoice_total'   => new sfWidgetFormInputText(),
      'invoice_btw'     => new sfWidgetFormInputText(),
      'btw'             => new sfWidgetFormInputText(),
      'paid_yn'         => new sfWidgetFormInputText(),
      'paid_amount'     => new sfWidgetFormInputText(),
      'paid_date'       => new sfWidgetFormDate(),
      'payment_type'    => new sfWidgetFormInputText(),
      'invoice_date'    => new sfWidgetFormDate(),
      'paymentterm'     => new sfWidgetFormInputText(),
      'vat_number'      => new sfWidgetFormInputText(),
      'dispuutid'       => new sfWidgetFormInputText(),
      'overduetypeid'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'shipname'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'shipaddress'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcity'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipregion'      => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'shippostalcode'  => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'shipcountry'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'customerid'      => new sfValidatorInteger(array('required' => false)),
      'companyname'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'address'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'city'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'region'          => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'postalcode'      => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'country'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'employeeid'      => new sfValidatorInteger(),
      'invoiceid'       => new sfValidatorPropelChoice(array('model' => 'Invoices', 'column' => 'invoiceid', 'required' => false)),
      'orderid'         => new sfValidatorInteger(array('required' => false)),
      'shipmentid'      => new sfValidatorInteger(array('required' => false)),
      'orderdate'       => new sfValidatorDateTime(array('required' => false)),
      'requireddate'    => new sfValidatorDateTime(array('required' => false)),
      'shippeddate'     => new sfValidatorDateTime(array('required' => false)),
      'companynameship' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'invoice_total'   => new sfValidatorNumber(array('required' => false)),
      'invoice_btw'     => new sfValidatorNumber(array('required' => false)),
      'btw'             => new sfValidatorInteger(array('required' => false)),
      'paid_yn'         => new sfValidatorInteger(array('required' => false)),
      'paid_amount'     => new sfValidatorNumber(array('required' => false)),
      'paid_date'       => new sfValidatorDate(array('required' => false)),
      'payment_type'    => new sfValidatorInteger(array('required' => false)),
      'invoice_date'    => new sfValidatorDate(array('required' => false)),
      'paymentterm'     => new sfValidatorInteger(array('required' => false)),
      'vat_number'      => new sfValidatorString(array('max_length' => 15)),
      'dispuutid'       => new sfValidatorInteger(),
      'overduetypeid'   => new sfValidatorInteger(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Invoices', 'column' => array('shipmentid')))
    );

    $this->widgetSchema->setNameFormat('invoices[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoices';
  }


}
