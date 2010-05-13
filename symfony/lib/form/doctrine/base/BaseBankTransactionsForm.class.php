<?php

/**
 * BankTransactions form base class.
 *
 * @method BankTransactions getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBankTransactionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transaction_id'       => new sfWidgetFormInputHidden(),
      'bank_account_id'      => new sfWidgetFormInputText(),
      'amount'               => new sfWidgetFormInputText(),
      'other_account_number' => new sfWidgetFormInputText(),
      'customerid'           => new sfWidgetFormInputText(),
      'transaction_date'     => new sfWidgetFormDate(),
      'name'                 => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'transaction_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'transaction_id', 'required' => false)),
      'bank_account_id'      => new sfValidatorInteger(array('required' => false)),
      'amount'               => new sfValidatorNumber(array('required' => false)),
      'other_account_number' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'customerid'           => new sfValidatorInteger(array('required' => false)),
      'transaction_date'     => new sfValidatorDate(array('required' => false)),
      'name'                 => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'description'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bank_transactions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BankTransactions';
  }

}
