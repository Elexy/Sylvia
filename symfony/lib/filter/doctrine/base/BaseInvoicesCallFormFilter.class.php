<?php

/**
 * InvoicesCall filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInvoicesCallFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'invoiceid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'callid'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeid'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dispuutid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'invoiceid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'callid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typeid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dispuutid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('invoices_call_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
