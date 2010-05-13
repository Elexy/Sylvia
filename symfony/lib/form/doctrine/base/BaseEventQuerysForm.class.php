<?php

/**
 * EventQuerys form base class.
 *
 * @package    form
 * @subpackage event_querys
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEventQuerysForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taskid'  => new sfWidgetFormInputHidden(),
      'queryid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'taskid'  => new sfValidatorDoctrineChoice(array('model' => 'EventQuerys', 'column' => 'taskid', 'required' => false)),
      'queryid' => new sfValidatorDoctrineChoice(array('model' => 'EventQuerys', 'column' => 'queryid', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event_querys[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventQuerys';
  }

}