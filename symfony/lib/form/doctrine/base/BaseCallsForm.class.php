<?php

/**
 * Calls form base class.
 *
 * @package    form
 * @subpackage calls
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCallsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'callid'    => new sfWidgetFormInputHidden(),
      'employee'  => new sfWidgetFormInputText(),
      'dummy'     => new sfWidgetFormDateTime(),
      'contactid' => new sfWidgetFormInputText(),
      'calldate'  => new sfWidgetFormDateTime(),
      'calltime'  => new sfWidgetFormDateTime(),
      'subject'   => new sfWidgetFormTextarea(),
      'notes'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'callid'    => new sfValidatorDoctrineChoice(array('model' => 'Calls', 'column' => 'callid', 'required' => false)),
      'employee'  => new sfValidatorInteger(array('required' => false)),
      'dummy'     => new sfValidatorDateTime(),
      'contactid' => new sfValidatorInteger(array('required' => false)),
      'calldate'  => new sfValidatorDateTime(array('required' => false)),
      'calltime'  => new sfValidatorDateTime(array('required' => false)),
      'subject'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'notes'     => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('calls[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calls';
  }

}