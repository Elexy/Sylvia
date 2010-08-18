<?php

/**
 * TempInvTransactions form base class.
 *
 * @method TempInvTransactions getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTempInvTransactionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactionid'   => new sfWidgetFormInputHidden(),
      'orderid'         => new sfWidgetFormInputText(),
      'orderdetailsid'  => new sfWidgetFormInputText(),
      'shipmentid'      => new sfWidgetFormInputText(),
      'unitprice'       => new sfWidgetFormInputText(),
      'unitssold'       => new sfWidgetFormInputText(),
      'btw_percentage'  => new sfWidgetFormInputText(),
      'added_cost'      => new sfWidgetFormInputText(),
      'box_id'          => new sfWidgetFormInputText(),
      'employee'        => new sfWidgetFormInputText(),
      'stock_owner_id'  => new sfWidgetFormInputText(),
      'transactiondate' => new sfWidgetFormDateTime(),
      'productid'       => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transactionid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'transactionid', 'required' => false)),
      'orderid'         => new sfValidatorInteger(array('required' => false)),
      'orderdetailsid'  => new sfValidatorInteger(array('required' => false)),
      'shipmentid'      => new sfValidatorInteger(array('required' => false)),
      'unitprice'       => new sfValidatorNumber(array('required' => false)),
      'unitssold'       => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'  => new sfValidatorNumber(array('required' => false)),
      'added_cost'      => new sfValidatorNumber(array('required' => false)),
      'box_id'          => new sfValidatorInteger(array('required' => false)),
      'employee'        => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'  => new sfValidatorInteger(array('required' => false)),
      'transactiondate' => new sfValidatorDateTime(array('required' => false)),
      'productid'       => new sfValidatorInteger(array('required' => false)),
      'description'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('temp_inv_transactions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TempInvTransactions';
  }

}
