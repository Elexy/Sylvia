<?php

/**
 * InvoicesCall form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseInvoicesCallForm extends BaseFormPropel
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
      'invoices_call_id' => new sfValidatorPropelChoice(array('model' => 'InvoicesCall', 'column' => 'invoices_call_id', 'required' => false)),
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
