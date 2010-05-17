<?php

/**
 * RmaActions form base class.
 *
 * @package    form
 * @subpackage rma_actions
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRmaActionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'actionid'   => new sfWidgetFormInputHidden(),
      'dummy'      => new sfWidgetFormDateTime(),
      'employee'   => new sfWidgetFormInputText(),
      'rmaid'      => new sfWidgetFormInputText(),
      'actiondate' => new sfWidgetFormDateTime(),
      'actiontime' => new sfWidgetFormDateTime(),
      'subject'    => new sfWidgetFormInputText(),
      'notes'      => new sfWidgetFormTextarea(),
      'webuser'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'actionid'   => new sfValidatorDoctrineChoice(array('model' => 'RmaActions', 'column' => 'actionid', 'required' => false)),
      'dummy'      => new sfValidatorDateTime(),
      'employee'   => new sfValidatorInteger(array('required' => false)),
      'rmaid'      => new sfValidatorInteger(array('required' => false)),
      'actiondate' => new sfValidatorDateTime(array('required' => false)),
      'actiontime' => new sfValidatorDateTime(array('required' => false)),
      'subject'    => new sfValidatorInteger(array('required' => false)),
      'notes'      => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'webuser'    => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_actions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaActions';
  }

}