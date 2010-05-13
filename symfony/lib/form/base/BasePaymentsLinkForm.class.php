<?php

/**
 * PaymentsLink form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePaymentsLinkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'link_id'           => new sfWidgetFormInputHidden(),
      'banktransactionid' => new sfWidgetFormInput(),
      'invoiceid'         => new sfWidgetFormInput(),
      'link_amount'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'link_id'           => new sfValidatorPropelChoice(array('model' => 'PaymentsLink', 'column' => 'link_id', 'required' => false)),
      'banktransactionid' => new sfValidatorInteger(),
      'invoiceid'         => new sfValidatorInteger(array('required' => false)),
      'link_amount'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'PaymentsLink', 'column' => array('link_id')))
    );

    $this->widgetSchema->setNameFormat('payments_link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentsLink';
  }


}
