<?php

/**
 * BankAccounts form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBankAccountsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'   => new sfWidgetFormInputText(),
      'account_name' => new sfWidgetFormInputText(),
      'valuta_id'    => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
      'id'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'account_id'   => new sfValidatorInteger(),
      'account_name' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'valuta_id'    => new sfValidatorInteger(array('required' => false)),
      'amount'       => new sfValidatorNumber(array('required' => false)),
      'id'           => new sfValidatorPropelChoice(array('model' => 'BankAccounts', 'column' => 'id', 'required' => false)),
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
