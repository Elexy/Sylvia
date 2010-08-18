<?php

/**
 * TempInvTransactions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTempInvTransactionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'         => new sfWidgetFormFilterInput(),
      'orderdetailsid'  => new sfWidgetFormFilterInput(),
      'shipmentid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unitprice'       => new sfWidgetFormFilterInput(),
      'unitssold'       => new sfWidgetFormFilterInput(),
      'btw_percentage'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'added_cost'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'box_id'          => new sfWidgetFormFilterInput(),
      'employee'        => new sfWidgetFormFilterInput(),
      'stock_owner_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'transactiondate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'productid'       => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'orderid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdetailsid'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipmentid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitprice'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unitssold'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_percentage'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'added_cost'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'box_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employee'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_owner_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transactiondate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'productid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('temp_inv_transactions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TempInvTransactions';
  }

  public function getFields()
  {
    return array(
      'transactionid'   => 'Number',
      'orderid'         => 'Number',
      'orderdetailsid'  => 'Number',
      'shipmentid'      => 'Number',
      'unitprice'       => 'Number',
      'unitssold'       => 'Number',
      'btw_percentage'  => 'Number',
      'added_cost'      => 'Number',
      'box_id'          => 'Number',
      'employee'        => 'Number',
      'stock_owner_id'  => 'Number',
      'transactiondate' => 'Date',
      'productid'       => 'Number',
      'description'     => 'Text',
    );
  }
}
