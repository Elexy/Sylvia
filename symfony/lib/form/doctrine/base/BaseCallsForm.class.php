<?php

/**
 * Calls form base class.
 *
 * @method Calls getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCallsForm extends BaseFormDoctrine
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
      'subject'   => new sfWidgetFormInputText(),
      'notes'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'callid'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'callid', 'required' => false)),
      'employee'  => new sfValidatorInteger(array('required' => false)),
      'dummy'     => new sfValidatorDateTime(),
      'contactid' => new sfValidatorInteger(array('required' => false)),
      'calldate'  => new sfValidatorDateTime(array('required' => false)),
      'calltime'  => new sfValidatorDateTime(array('required' => false)),
      'subject'   => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'notes'     => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('calls[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calls';
  }

}
