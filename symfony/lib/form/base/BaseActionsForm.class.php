<?php

/**
 * Actions form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseActionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'actiondate'      => new sfWidgetFormDateTime(),
      'contactid'       => new sfWidgetFormInput(),
      'contactcontents' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Actions', 'column' => 'id', 'required' => false)),
      'actiondate'      => new sfValidatorDateTime(array('required' => false)),
      'contactid'       => new sfValidatorInteger(array('required' => false)),
      'contactcontents' => new sfValidatorString(array('required' => false)),
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
