<?php

/**
 * BankAccounts form base class.
 *
 * @package    form
 * @subpackage bank_accounts
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBankAccountsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'   => new sfWidgetFormInputHidden(),
      'valuta_id'    => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
      'account_name' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'account_id'   => new sfValidatorDoctrineChoice(array('model' => 'BankAccounts', 'column' => 'account_id', 'required' => false)),
      'valuta_id'    => new sfValidatorInteger(array('required' => false)),
      'amount'       => new sfValidatorNumber(array('required' => false)),
      'account_name' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bank_accounts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BankAccounts';
  }

}