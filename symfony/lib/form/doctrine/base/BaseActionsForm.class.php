<?php

/**
 * Actions form base class.
 *
 * @method Actions getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseActionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'contactid'       => new sfWidgetFormInputText(),
      'dummy'           => new sfWidgetFormDateTime(),
      'actiondate'      => new sfWidgetFormDateTime(),
      'contactcontents' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'contactid'       => new sfValidatorInteger(array('required' => false)),
      'dummy'           => new sfValidatorDateTime(),
      'actiondate'      => new sfValidatorDateTime(array('required' => false)),
      'contactcontents' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('actions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actions';
  }

}
