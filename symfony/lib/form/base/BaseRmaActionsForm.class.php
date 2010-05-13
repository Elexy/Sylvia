<?php

/**
 * RmaActions form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaActionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'actionid'   => new sfWidgetFormInputHidden(),
      'rmaid'      => new sfWidgetFormInputText(),
      'actiondate' => new sfWidgetFormDateTime(),
      'actiontime' => new sfWidgetFormDateTime(),
      'subject'    => new sfWidgetFormInputText(),
      'notes'      => new sfWidgetFormTextarea(),
      'employee'   => new sfWidgetFormInputText(),
      'webuser'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'actionid'   => new sfValidatorPropelChoice(array('model' => 'RmaActions', 'column' => 'actionid', 'required' => false)),
      'rmaid'      => new sfValidatorInteger(array('required' => false)),
      'actiondate' => new sfValidatorDateTime(array('required' => false)),
      'actiontime' => new sfValidatorDateTime(array('required' => false)),
      'subject'    => new sfValidatorInteger(array('required' => false)),
      'notes'      => new sfValidatorString(array('required' => false)),
      'employee'   => new sfValidatorInteger(array('required' => false)),
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
