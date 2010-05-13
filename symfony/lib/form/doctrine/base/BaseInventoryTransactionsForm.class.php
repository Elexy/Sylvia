<?php

/**
 * InventoryTransactions form base class.
 *
 * @package    form
 * @subpackage inventory_transactions
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInventoryTransactionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactionid'          => new sfWidgetFormInputHidden(),
      'podetailsid'            => new sfWidgetFormInputText(),
      'orderid'                => new sfWidgetFormInputText(),
      'orderdetailsid'         => new sfWidgetFormInputText(),
      'shipmentid'             => new sfWidgetFormInputText(),
      'unitprice'              => new sfWidgetFormInputText(),
      'unitsordered'           => new sfWidgetFormInputText(),
      'backorder'              => new sfWidgetFormInputText(),
      'unitsreceived'          => new sfWidgetFormInputText(),
      'unitssold'              => new sfWidgetFormInputText(),
      'unitsshrinkage'         => new sfWidgetFormInputText(),
      'dummy'                  => new sfWidgetFormDateTime(),
      'btw_percentage'         => new sfWidgetFormInputText(),
      'added_cost'             => new sfWidgetFormInputText(),
      'box_id'                 => new sfWidgetFormInputText(),
      'employee'               => new sfWidgetFormInputText(),
      'stock_owner_id'         => new sfWidgetFormInputText(),
      'transactiondate'        => new sfWidgetFormDateTime(),
      'productid'              => new sfWidgetFormInputText(),
      'description'            => new sfWidgetFormInputText(),
      'externalid'             => new sfWidgetFormInputText(),
      'purchaseorderid'        => new sfWidgetFormInputText(),
      'transactiondescription' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'transactionid'          => new sfValidatorDoctrineChoice(array('model' => 'InventoryTransactions', 'column' => 'transactionid', 'required' => false)),
      'podetailsid'            => new sfValidatorInteger(array('required' => false)),
      'orderid'                => new sfValidatorInteger(array('required' => false)),
      'orderdetailsid'         => new sfValidatorInteger(array('required' => false)),
      'shipmentid'             => new sfValidatorInteger(),
      'unitprice'              => new sfValidatorNumber(array('required' => false)),
      'unitsordered'           => new sfValidatorInteger(array('required' => false)),
      'backorder'              => new sfValidatorInteger(array('required' => false)),
      'unitsreceived'          => new sfValidatorInteger(),
      'unitssold'              => new sfValidatorInteger(array('required' => false)),
      'unitsshrinkage'         => new sfValidatorInteger(array('required' => false)),
      'dummy'                  => new sfValidatorDateTime(),
      'btw_percentage'         => new sfValidatorNumber(),
      'added_cost'             => new sfValidatorNumber(),
      'box_id'                 => new sfValidatorInteger(array('required' => false)),
      'employee'               => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'         => new sfValidatorInteger(),
      'transactiondate'        => new sfValidatorDateTime(array('required' => false)),
      'productid'              => new sfValidatorInteger(array('required' => false)),
      'description'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'externalid'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'purchaseorderid'        => new sfValidatorInteger(array('required' => false)),
      'transactiondescription' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('inventory_transactions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InventoryTransactions';
  }

}