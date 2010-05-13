<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * InvoicesCall filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseInvoicesCallFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'invoiceid'        => new sfWidgetFormFilterInput(),
      'callid'           => new sfWidgetFormFilterInput(),
      'typeid'           => new sfWidgetFormFilterInput(),
      'dispuutid'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'invoiceid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'callid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typeid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dispuutid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('invoices_call_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvoicesCall';
  }

  public function getFields()
  {
    return array(
      'invoices_call_id' => 'Number',
      'invoiceid'        => 'Number',
      'callid'           => 'Number',
      'typeid'           => 'Number',
      'dispuutid'        => 'Number',
    );
  }
}
