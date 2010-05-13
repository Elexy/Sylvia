<?php

/**
 * TempInvTransactions form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTempInvTransactionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'transactionid'   => new sfWidgetFormInputHidden(),
      'transactiondate' => new sfWidgetFormDateTime(),
      'productid'       => new sfWidgetFormInput(),
      'description'     => new sfWidgetFormInput(),
      'orderid'         => new sfWidgetFormInput(),
      'orderdetailsid'  => new sfWidgetFormInput(),
      'shipmentid'      => new sfWidgetFormInput(),
      'unitprice'       => new sfWidgetFormInput(),
      'unitssold'       => new sfWidgetFormInput(),
      'btw_percentage'  => new sfWidgetFormInput(),
      'added_cost'      => new sfWidgetFormInput(),
      'box_id'          => new sfWidgetFormInput(),
      'employee'        => new sfWidgetFormInput(),
      'stock_owner_id'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'transactionid'   => new sfValidatorPropelChoice(array('model' => 'TempInvTransactions', 'column' => 'transactionid', 'required' => false)),
      'transactiondate' => new sfValidatorDateTime(array('required' => false)),
      'productid'       => new sfValidatorInteger(array('required' => false)),
      'description'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orderid'         => new sfValidatorInteger(array('required' => false)),
      'orderdetailsid'  => new sfValidatorInteger(array('required' => false)),
      'shipmentid'      => new sfValidatorInteger(),
      'unitprice'       => new sfValidatorNumber(array('required' => false)),
      'unitssold'       => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'  => new sfValidatorNumber(),
      'added_cost'      => new sfValidatorNumber(),
      'box_id'          => new sfValidatorInteger(array('required' => false)),
      'employee'        => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'  => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('temp_inv_transactions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TempInvTransactions';
  }


}
