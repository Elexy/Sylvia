<?php

/**
 * Paymentterm form base class.
 *
 * @package    form
 * @subpackage paymentterm
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePaymenttermForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'paymenttermid' => new sfWidgetFormInputHidden(),
      'description'   => new sfWidgetFormInputText(),
      'days'          => new sfWidgetFormInputText(),
      'endmonth'      => new sfWidgetFormInputText(),
      'incasso'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'paymenttermid' => new sfValidatorDoctrineChoice(array('model' => 'Paymentterm', 'column' => 'paymenttermid', 'required' => false)),
      'description'   => new sfValidatorString(array('max_length' => 30)),
      'days'          => new sfValidatorInteger(),
      'endmonth'      => new sfValidatorInteger(),
      'incasso'       => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('paymentterm[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paymentterm';
  }

}