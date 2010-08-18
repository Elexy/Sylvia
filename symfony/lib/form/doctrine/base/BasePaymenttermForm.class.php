<?php

/**
 * Paymentterm form base class.
 *
 * @method Paymentterm getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePaymenttermForm extends BaseFormDoctrine
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
      'paymenttermid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'paymenttermid', 'required' => false)),
      'description'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'days'          => new sfValidatorInteger(array('required' => false)),
      'endmonth'      => new sfValidatorInteger(array('required' => false)),
      'incasso'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('paymentterm[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paymentterm';
  }

}
