<?php

/**
 * Actions form base class.
 *
 * @package    form
 * @subpackage actions
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseActionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'contactid'       => new sfWidgetFormInputText(),
      'dummy'           => new sfWidgetFormDateTime(),
      'actiondate'      => new sfWidgetFormDateTime(),
      'contactcontents' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => 'Actions', 'column' => 'id', 'required' => false)),
      'contactid'       => new sfValidatorInteger(array('required' => false)),
      'dummy'           => new sfValidatorDateTime(),
      'actiondate'      => new sfValidatorDateTime(array('required' => false)),
      'contactcontents' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('actions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actions';
  }

}