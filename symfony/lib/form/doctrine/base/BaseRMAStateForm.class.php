<?php

/**
 * RMAState form base class.
 *
 * @package    form
 * @subpackage rma_state
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRMAStateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_id'   => new sfWidgetFormInputHidden(),
      'state_text' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'state_id'   => new sfValidatorDoctrineChoice(array('model' => 'RMAState', 'column' => 'state_id', 'required' => false)),
      'state_text' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_state[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMAState';
  }

}