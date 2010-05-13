<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * InventoryTransactions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseInventoryTransactionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactiondate'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'productid'              => new sfWidgetFormFilterInput(),
      'description'            => new sfWidgetFormFilterInput(),
      'externalid'             => new sfWidgetFormFilterInput(),
      'purchaseorderid'        => new sfWidgetFormFilterInput(),
      'podetailsid'            => new sfWidgetFormFilterInput(),
      'orderid'                => new sfWidgetFormFilterInput(),
      'orderdetailsid'         => new sfWidgetFormFilterInput(),
      'shipmentid'             => new sfWidgetFormFilterInput(),
      'transactiondescription' => new sfWidgetFormFilterInput(),
      'unitprice'              => new sfWidgetFormFilterInput(),
      'unitsordered'           => new sfWidgetFormFilterInput(),
      'backorder'              => new sfWidgetFormFilterInput(),
      'unitsreceived'          => new sfWidgetFormFilterInput(),
      'unitssold'              => new sfWidgetFormFilterInput(),
      'unitsshrinkage'         => new sfWidgetFormFilterInput(),
      'btw_percentage'         => new sfWidgetFormFilterInput(),
      'added_cost'             => new sfWidgetFormFilterInput(),
      'box_id'                 => new sfWidgetFormFilterInput(),
      'employee'               => new sfWidgetFormFilterInput(),
      'stock_owner_id'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'transactiondate'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'productid'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'            => new sfValidatorPass(array('required' => false)),
      'externalid'             => new sfValidatorPass(array('required' => false)),
      'purchaseorderid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'podetailsid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderid'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'orderdetailsid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipmentid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transactiondescription' => new sfValidatorPass(array('required' => false)),
      'unitprice'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unitsordered'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'backorder'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitsreceived'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitssold'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unitsshrinkage'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'btw_percentage'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'added_cost'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'box_id'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employee'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock_owner_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('inventory_transactions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InventoryTransactions';
  }

  public function getFields()
  {
    return array(
      'transactionid'          => 'Number',
      'transactiondate'        => 'Date',
      'productid'              => 'Number',
      'description'            => 'Text',
      'externalid'             => 'Text',
      'purchaseorderid'        => 'Number',
      'podetailsid'            => 'Number',
      'orderid'                => 'Number',
      'orderdetailsid'         => 'Number',
      'shipmentid'             => 'Number',
      'transactiondescription' => 'Text',
      'unitprice'              => 'Number',
      'unitsordered'           => 'Number',
      'backorder'              => 'Number',
      'unitsreceived'          => 'Number',
      'unitssold'              => 'Number',
      'unitsshrinkage'         => 'Number',
      'btw_percentage'         => 'Number',
      'added_cost'             => 'Number',
      'box_id'                 => 'Number',
      'employee'               => 'Number',
      'stock_owner_id'         => 'Number',
    );
  }
}
