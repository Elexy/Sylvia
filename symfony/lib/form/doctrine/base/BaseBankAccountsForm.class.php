<?php

/**
 * BankAccounts form base class.
 *
 * @method BankAccounts getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBankAccountsForm extends BaseFormDoctrine
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
      'account_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'account_id', 'required' => false)),
      'valuta_id'    => new sfValidatorInteger(array('required' => false)),
      'amount'       => new sfValidatorNumber(array('required' => false)),
      'account_name' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bank_accounts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BankAccounts';
  }

}
