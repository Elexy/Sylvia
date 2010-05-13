<?php

/**
 * ContactsBankAccounts form base class.
 *
 * @method ContactsBankAccounts getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactsBankAccountsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_number' => new sfWidgetFormInputHidden(),
      'contactid'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'account_number' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'account_number', 'required' => false)),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contacts_bank_accounts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsBankAccounts';
  }

}
