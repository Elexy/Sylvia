<?php

/**
 * InventoryTransactions form base class.
 *
 * @method InventoryTransactions getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInventoryTransactionsForm extends BaseFormDoctrine
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
      'transactiondescription' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transactionid'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'transactionid', 'required' => false)),
      'podetailsid'            => new sfValidatorInteger(array('required' => false)),
      'orderid'                => new sfValidatorInteger(array('required' => false)),
      'orderdetailsid'         => new sfValidatorInteger(array('required' => false)),
      'shipmentid'             => new sfValidatorInteger(array('required' => false)),
      'unitprice'              => new sfValidatorNumber(array('required' => false)),
      'unitsordered'           => new sfValidatorInteger(array('required' => false)),
      'backorder'              => new sfValidatorInteger(array('required' => false)),
      'unitsreceived'          => new sfValidatorInteger(array('required' => false)),
      'unitssold'              => new sfValidatorInteger(array('required' => false)),
      'unitsshrinkage'         => new sfValidatorInteger(array('required' => false)),
      'dummy'                  => new sfValidatorDateTime(),
      'btw_percentage'         => new sfValidatorNumber(array('required' => false)),
      'added_cost'             => new sfValidatorNumber(array('required' => false)),
      'box_id'                 => new sfValidatorInteger(array('required' => false)),
      'employee'               => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'         => new sfValidatorInteger(array('required' => false)),
      'transactiondate'        => new sfValidatorDateTime(array('required' => false)),
      'productid'              => new sfValidatorInteger(array('required' => false)),
      'description'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'externalid'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'purchaseorderid'        => new sfValidatorInteger(array('required' => false)),
      'transactiondescription' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('inventory_transactions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InventoryTransactions';
  }

}
