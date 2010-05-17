<?php

/**
 * RMAActions form base class.
 *
 * @method RMAActions getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRMAActionsForm extends BaseFormDoctrine
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
      'notes'      => new sfWidgetFormInputText(),
      'webuser'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'actionid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'actionid', 'required' => false)),
      'dummy'      => new sfValidatorDateTime(),
      'employee'   => new sfValidatorInteger(array('required' => false)),
      'rmaid'      => new sfValidatorInteger(array('required' => false)),
      'actiondate' => new sfValidatorDateTime(array('required' => false)),
      'actiontime' => new sfValidatorDateTime(array('required' => false)),
      'subject'    => new sfValidatorInteger(array('required' => false)),
      'notes'      => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'webuser'    => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_actions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMAActions';
  }

}
