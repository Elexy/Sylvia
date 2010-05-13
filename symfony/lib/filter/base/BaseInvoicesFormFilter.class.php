<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Invoices filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseInvoicesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
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
      'employeeid'      => new sfWidgetFormFilterInput(),
      'orderid'         => new sfWidgetFormFilterInput(),
      'shipmentid'      => new sfWidgetFormFilterInput(),
      'orderdate'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'requireddate'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'shippeddate'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'companynameship' => new sfWidgetFormFilterInput(),
      'invoice_total'   => new sfWidgetFormFilterInput(),
      'invoice_btw'     => new sfWidgetFormFilterInput(),
      'btw'             => new sfWidgetFormFilterInput(),
      'paid_yn'         => new sfWidgetFormFilterInput(),
      'paid_amount'     => new sfWidgetFormFilterInput(),
      'paid_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'payment_type'    => new sfWidgetFormFilterInput(),
      'invoice_date'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'paymentterm'     => new sfWidgetFormFilterInput(),
      'vat_number'      => new sfWidgetFormFilterInput(),
      'dispuutid'       => new sfWidgetFormFilterInput(),
      'overduetypeid'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
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
      'employeeid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipmentid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdate'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'requireddate'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'shippeddate'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'companynameship' => new sfValidatorPass(array('required' => false)),
      'invoice_total'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'invoice_btw'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'btw'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paid_yn'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paid_amount'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'paid_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'payment_type'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoice_date'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'paymentterm'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vat_number'      => new sfValidatorPass(array('required' => false)),
      'dispuutid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'overduetypeid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('invoices_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoices';
  }

  public function getFields()
  {
    return array(
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
      'employeeid'      => 'Number',
      'invoiceid'       => 'Number',
      'orderid'         => 'Number',
      'shipmentid'      => 'Number',
      'orderdate'       => 'Date',
      'requireddate'    => 'Date',
      'shippeddate'     => 'Date',
      'companynameship' => 'Text',
      'invoice_total'   => 'Number',
      'invoice_btw'     => 'Number',
      'btw'             => 'Number',
      'paid_yn'         => 'Number',
      'paid_amount'     => 'Number',
      'paid_date'       => 'Date',
      'payment_type'    => 'Number',
      'invoice_date'    => 'Date',
      'paymentterm'     => 'Number',
      'vat_number'      => 'Text',
      'dispuutid'       => 'Number',
      'overduetypeid'   => 'Number',
    );
  }
}
