<?php

/**
 * Invoices filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInvoicesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employeeid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orderid'         => new sfWidgetFormFilterInput(),
      'shipmentid'      => new sfWidgetFormFilterInput(),
      'invoice_total'   => new sfWidgetFormFilterInput(),
      'invoice_btw'     => new sfWidgetFormFilterInput(),
      'paid_yn'         => new sfWidgetFormFilterInput(),
      'paid_amount'     => new sfWidgetFormFilterInput(),
      'dummy'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'payment_type'    => new sfWidgetFormFilterInput(),
      'paymentterm'     => new sfWidgetFormFilterInput(),
      'vat_number'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dispuutid'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'overduetypeid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'shipname'        => new sfWidgetFormFilterInput(),
      'shipaddress'     => new sfWidgetFormFilterInput(),
      'shipcity'        => new sfWidgetFormFilterInput(),
      'shipregion'      => new sfWidgetFormFilterInput(),
      'shippostalcode'  => new sfWidgetFormFilterInput(),
      'shipcountry'     => new sfWidgetFormFilterInput(),
      'customerid'      => new sfWidgetFormFilterInput(),
      'companyname'     => new sfWidgetFormFilterInput(),
      'address'         => new sfWidgetFormFilterInput(),
      'city'            => new sfWidgetFormFilterInput(),
      'region'          => new sfWidgetFormFilterInput(),
      'postalcode'      => new sfWidgetFormFilterInput(),
      'country'         => new sfWidgetFormFilterInput(),
      'orderdate'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'requireddate'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'shippeddate'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'companynameship' => new sfWidgetFormFilterInput(),
      'btw'             => new sfWidgetFormFilterInput(),
      'paid_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'invoice_date'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'employeeid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipmentid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoice_total'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'invoice_btw'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'paid_yn'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paid_amount'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dummy'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'payment_type'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paymentterm'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vat_number'      => new sfValidatorPass(array('required' => false)),
      'dispuutid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'overduetypeid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipname'        => new sfValidatorPass(array('required' => false)),
      'shipaddress'     => new sfValidatorPass(array('required' => false)),
      'shipcity'        => new sfValidatorPass(array('required' => false)),
      'shipregion'      => new sfValidatorPass(array('required' => false)),
      'shippostalcode'  => new sfValidatorPass(array('required' => false)),
      'shipcountry'     => new sfValidatorPass(array('required' => false)),
      'customerid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'companyname'     => new sfValidatorPass(array('required' => false)),
      'address'         => new sfValidatorPass(array('required' => false)),
      'city'            => new sfValidatorPass(array('required' => false)),
      'region'          => new sfValidatorPass(array('required' => false)),
      'postalcode'      => new sfValidatorPass(array('required' => false)),
      'country'         => new sfValidatorPass(array('required' => false)),
      'orderdate'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'requireddate'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shippeddate'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'companynameship' => new sfValidatorPass(array('required' => false)),
      'btw'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paid_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'invoice_date'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('invoices_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoices';
  }

  public function getFields()
  {
    return array(
      'employeeid'      => 'Number',
      'invoiceid'       => 'Number',
      'orderid'         => 'Number',
      'shipmentid'      => 'Number',
      'invoice_total'   => 'Number',
      'invoice_btw'     => 'Number',
      'paid_yn'         => 'Number',
      'paid_amount'     => 'Number',
      'dummy'           => 'Date',
      'payment_type'    => 'Number',
      'paymentterm'     => 'Number',
      'vat_number'      => 'Text',
      'dispuutid'       => 'Number',
      'overduetypeid'   => 'Number',
      'shipname'        => 'Text',
      'shipaddress'     => 'Text',
      'shipcity'        => 'Text',
      'shipregion'      => 'Text',
      'shippostalcode'  => 'Text',
      'shipcountry'     => 'Text',
      'customerid'      => 'Number',
      'companyname'     => 'Text',
      'address'         => 'Text',
      'city'            => 'Text',
      'region'          => 'Text',
      'postalcode'      => 'Text',
      'country'         => 'Text',
      'orderdate'       => 'Date',
      'requireddate'    => 'Date',
      'shippeddate'     => 'Date',
      'companynameship' => 'Text',
      'btw'             => 'Number',
      'paid_date'       => 'Date',
      'invoice_date'    => 'Date',
    );
  }
}
