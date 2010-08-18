<?php

/**
 * InvoicesCall form base class.
 *
 * @method InvoicesCall getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInvoicesCallForm extends BaseFormDoctrine
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
      'invoices_call_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'invoices_call_id', 'required' => false)),
      'invoiceid'        => new sfValidatorInteger(array('required' => false)),
      'callid'           => new sfValidatorInteger(array('required' => false)),
      'typeid'           => new sfValidatorInteger(array('required' => false)),
      'dispuutid'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('invoices_call[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvoicesCall';
  }

}
