<?php

/**
 * ContactsBankAccounts form base class.
 *
 * @package    form
 * @subpackage contacts_bank_accounts
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseContactsBankAccountsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_number' => new sfWidgetFormInputHidden(),
      'contactid'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'account_number' => new sfValidatorDoctrineChoice(array('model' => 'ContactsBankAccounts', 'column' => 'account_number', 'required' => false)),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contacts_bank_accounts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsBankAccounts';
  }

}