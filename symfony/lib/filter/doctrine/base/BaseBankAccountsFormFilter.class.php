<?php

/**
 * BankAccounts filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBankAccountsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'valuta_id'    => new sfWidgetFormFilterInput(),
      'amount'       => new sfWidgetFormFilterInput(),
      'account_name' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'valuta_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'account_name' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bank_accounts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BankAccounts';
  }

  public function getFields()
  {
    return array(
      'account_id'   => 'Number',
      'valuta_id'    => 'Number',
      'amount'       => 'Number',
      'account_name' => 'Text',
    );
  }
}
