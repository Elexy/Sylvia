<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * BankTransactions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBankTransactionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'bank_account_id'      => new sfWidgetFormFilterInput(),
      'transaction_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'name'                 => new sfWidgetFormFilterInput(),
      'amount'               => new sfWidgetFormFilterInput(),
      'description'          => new sfWidgetFormFilterInput(),
      'other_account_number' => new sfWidgetFormFilterInput(),
      'customerid'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'bank_account_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transaction_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'name'                 => new sfValidatorPass(array('required' => false)),
      'amount'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'description'          => new sfValidatorPass(array('required' => false)),
      'other_account_number' => new sfValidatorPass(array('required' => false)),
      'customerid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('bank_transactions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BankTransactions';
  }

  public function getFields()
  {
    return array(
      'transaction_id'       => 'Number',
      'bank_account_id'      => 'Number',
      'transaction_date'     => 'Date',
      'name'                 => 'Text',
      'amount'               => 'Number',
      'description'          => 'Text',
      'other_account_number' => 'Text',
      'customerid'           => 'Number',
    );
  }
}
