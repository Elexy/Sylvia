<?php

/**
 * Calls form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCallsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'callid'    => new sfWidgetFormInputHidden(),
      'contactid' => new sfWidgetFormInputText(),
      'calldate'  => new sfWidgetFormDateTime(),
      'calltime'  => new sfWidgetFormDateTime(),
      'employee'  => new sfWidgetFormInputText(),
      'subject'   => new sfWidgetFormTextarea(),
      'notes'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'callid'    => new sfValidatorPropelChoice(array('model' => 'Calls', 'column' => 'callid', 'required' => false)),
      'contactid' => new sfValidatorInteger(array('required' => false)),
      'calldate'  => new sfValidatorDateTime(array('required' => false)),
      'calltime'  => new sfValidatorDateTime(array('required' => false)),
      'employee'  => new sfValidatorInteger(array('required' => false)),
      'subject'   => new sfValidatorString(array('required' => false)),
      'notes'     => new sfValidatorString(array('required' => false)),
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
