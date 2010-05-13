<?php

/**
 * Paymentterm form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePaymenttermForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'paymenttermid' => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
      'days'          => new sfWidgetFormInputText(),
      'endmonth'      => new sfWidgetFormInputText(),
      'incasso'       => new sfWidgetFormInputText(),
      'id'            => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'paymenttermid' => new sfValidatorInteger(),
      'description'   => new sfValidatorString(array('max_length' => 30)),
      'days'          => new sfValidatorInteger(),
      'endmonth'      => new sfValidatorInteger(),
      'incasso'       => new sfValidatorInteger(),
      'id'            => new sfValidatorPropelChoice(array('model' => 'Paymentterm', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Paymentterm', 'column' => array('paymenttermid')))
    );

    $this->widgetSchema->setNameFormat('paymentterm[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paymentterm';
  }


}
