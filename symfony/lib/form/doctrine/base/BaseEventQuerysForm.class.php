<?php

/**
 * EventQuerys form base class.
 *
 * @method EventQuerys getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEventQuerysForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taskid'  => new sfWidgetFormInputHidden(),
      'queryid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'taskid'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'taskid', 'required' => false)),
      'queryid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'queryid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event_querys[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventQuerys';
  }

}
