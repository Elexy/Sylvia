<?php

/**
 * BankTransactions form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBankTransactionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'transaction_id'       => new sfWidgetFormInputHidden(),
      'bank_account_id'      => new sfWidgetFormInput(),
      'transaction_date'     => new sfWidgetFormDate(),
      'name'                 => new sfWidgetFormInput(),
      'amount'               => new sfWidgetFormInput(),
      'description'          => new sfWidgetFormInput(),
      'other_account_number' => new sfWidgetFormInput(),
      'customerid'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'transaction_id'       => new sfValidatorPropelChoice(array('model' => 'BankTransactions', 'column' => 'transaction_id', 'required' => false)),
      'bank_account_id'      => new sfValidatorInteger(array('required' => false)),
      'transaction_date'     => new sfValidatorDate(array('required' => false)),
      'name'                 => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'amount'               => new sfValidatorNumber(array('required' => false)),
      'description'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'other_account_number' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'customerid'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'BankTransactions', 'column' => array('transaction_date', 'description', 'amount', 'other_account_number')))
    );

    $this->widgetSchema->setNameFormat('bank_transactions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BankTransactions';
  }


}
