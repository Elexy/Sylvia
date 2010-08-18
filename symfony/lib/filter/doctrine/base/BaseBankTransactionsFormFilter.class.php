<?php

/**
 * BankTransactions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBankTransactionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'bank_account_id'      => new sfWidgetFormFilterInput(),
      'amount'               => new sfWidgetFormFilterInput(),
      'other_account_number' => new sfWidgetFormFilterInput(),
      'customerid'           => new sfWidgetFormFilterInput(),
      'transaction_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'name'                 => new sfWidgetFormFilterInput(),
      'description'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'bank_account_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'other_account_number' => new sfValidatorPass(array('required' => false)),
      'customerid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transaction_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'name'                 => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bank_transactions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
      'amount'               => 'Number',
      'other_account_number' => 'Text',
      'customerid'           => 'Number',
      'transaction_date'     => 'Date',
      'name'                 => 'Text',
      'description'          => 'Text',
    );
  }
}
