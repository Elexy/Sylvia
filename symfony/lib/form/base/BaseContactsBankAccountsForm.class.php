<?php

/**
 * ContactsBankAccounts form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseContactsBankAccountsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_number' => new sfWidgetFormInputHidden(),
      'contactid'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'account_number' => new sfValidatorPropelChoice(array('model' => 'ContactsBankAccounts', 'column' => 'account_number', 'required' => false)),
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
