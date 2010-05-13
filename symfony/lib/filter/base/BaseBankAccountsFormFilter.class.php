<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * BankAccounts filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBankAccountsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'   => new sfWidgetFormFilterInput(),
      'account_name' => new sfWidgetFormFilterInput(),
      'valuta_id'    => new sfWidgetFormFilterInput(),
      'amount'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'account_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'account_name' => new sfValidatorPass(array('required' => false)),
      'valuta_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('bank_accounts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'account_name' => 'Text',
      'valuta_id'    => 'Number',
      'amount'       => 'Number',
      'id'           => 'Number',
    );
  }
}
