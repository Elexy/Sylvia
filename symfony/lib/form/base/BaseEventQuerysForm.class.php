<?php

/**
 * EventQuerys form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseEventQuerysForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'taskid'  => new sfWidgetFormInputHidden(),
      'queryid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'taskid'  => new sfValidatorPropelChoice(array('model' => 'EventQuerys', 'column' => 'taskid', 'required' => false)),
      'queryid' => new sfValidatorPropelChoice(array('model' => 'EventQuerys', 'column' => 'queryid', 'required' => false)),
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
