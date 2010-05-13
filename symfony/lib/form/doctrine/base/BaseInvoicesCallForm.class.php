<?php

/**
 * InvoicesCall form base class.
 *
 * @package    form
 * @subpackage invoices_call
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInvoicesCallForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'invoices_call_id' => new sfWidgetFormInputHidden(),
      'invoiceid'        => new sfWidgetFormInputText(),
      'callid'           => new sfWidgetFormInputText(),
      'typeid'           => new sfWidgetFormInputText(),
      'dispuutid'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'invoices_call_id' => new sfValidatorDoctrineChoice(array('model' => 'InvoicesCall', 'column' => 'invoices_call_id', 'required' => false)),
      'invoiceid'        => new sfValidatorInteger(),
      'callid'           => new sfValidatorInteger(),
      'typeid'           => new sfValidatorInteger(),
      'dispuutid'        => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('invoices_call[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvoicesCall';
  }

}