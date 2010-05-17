<?php

/**
 * ContactsBankAccounts filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactsBankAccountsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contacts_bank_accounts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsBankAccounts';
  }

  public function getFields()
  {
    return array(
      'account_number' => 'Text',
      'contactid'      => 'Number',
    );
  }
}
