<?php

/**
 * InventoryTransactions form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseInventoryTransactionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactionid'          => new sfWidgetFormInputHidden(),
      'transactiondate'        => new sfWidgetFormDateTime(),
      'productid'              => new sfWidgetFormInputText(),
      'description'            => new sfWidgetFormInputText(),
      'externalid'             => new sfWidgetFormInputText(),
      'purchaseorderid'        => new sfWidgetFormInputText(),
      'podetailsid'            => new sfWidgetFormInputText(),
      'orderid'                => new sfWidgetFormInputText(),
      'orderdetailsid'         => new sfWidgetFormInputText(),
      'shipmentid'             => new sfWidgetFormInputText(),
      'transactiondescription' => new sfWidgetFormTextarea(),
      'unitprice'              => new sfWidgetFormInputText(),
      'unitsordered'           => new sfWidgetFormInputText(),
      'backorder'              => new sfWidgetFormInputText(),
      'unitsreceived'          => new sfWidgetFormInputText(),
      'unitssold'              => new sfWidgetFormInputText(),
      'unitsshrinkage'         => new sfWidgetFormInputText(),
      'btw_percentage'         => new sfWidgetFormInputText(),
      'added_cost'             => new sfWidgetFormInputText(),
      'box_id'                 => new sfWidgetFormInputText(),
      'employee'               => new sfWidgetFormInputText(),
      'stock_owner_id'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transactionid'          => new sfValidatorPropelChoice(array('model' => 'InventoryTransactions', 'column' => 'transactionid', 'required' => false)),
      'transactiondate'        => new sfValidatorDateTime(array('required' => false)),
      'productid'              => new sfValidatorInteger(array('required' => false)),
      'description'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'externalid'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'purchaseorderid'        => new sfValidatorInteger(array('required' => false)),
      'podetailsid'            => new sfValidatorInteger(array('required' => false)),
      'orderid'                => new sfValidatorInteger(array('required' => false)),
      'orderdetailsid'         => new sfValidatorInteger(array('required' => false)),
      'shipmentid'             => new sfValidatorInteger(),
      'transactiondescription' => new sfValidatorString(array('required' => false)),
      'unitprice'              => new sfValidatorNumber(array('required' => false)),
      'unitsordered'           => new sfValidatorInteger(array('required' => false)),
      'backorder'              => new sfValidatorInteger(array('required' => false)),
      'unitsreceived'          => new sfValidatorInteger(),
      'unitssold'              => new sfValidatorInteger(array('required' => false)),
      'unitsshrinkage'         => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'         => new sfValidatorNumber(),
      'added_cost'             => new sfValidatorNumber(),
      'box_id'                 => new sfValidatorInteger(array('required' => false)),
      'employee'               => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'         => new sfValidatorInteger(),
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
