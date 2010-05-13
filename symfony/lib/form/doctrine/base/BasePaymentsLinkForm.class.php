<?php

/**
 * PaymentsLink form base class.
 *
 * @package    form
 * @subpackage payments_link
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePaymentsLinkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'link_id'           => new sfWidgetFormInputHidden(),
      'banktransactionid' => new sfWidgetFormInputText(),
      'invoiceid'         => new sfWidgetFormInputText(),
      'link_amount'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'link_id'           => new sfValidatorDoctrineChoice(array('model' => 'PaymentsLink', 'column' => 'link_id', 'required' => false)),
      'banktransactionid' => new sfValidatorInteger(),
      'invoiceid'         => new sfValidatorInteger(array('required' => false)),
      'link_amount'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('payments_link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentsLink';
  }

}