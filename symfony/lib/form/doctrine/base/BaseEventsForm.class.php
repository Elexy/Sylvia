<?php

/**
 * Events form base class.
 *
 * @package    form
 * @subpackage events
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEventsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'title'                 => new sfWidgetFormInputText(),
      'description'           => new sfWidgetFormInputText(),
      'created'               => new sfWidgetFormDateTime(),
      'created_by'            => new sfWidgetFormInputText(),
      'modified'              => new sfWidgetFormDateTime(),
      'modified_by'           => new sfWidgetFormInputText(),
      'publish_up'            => new sfWidgetFormDateTime(),
      'publish_down'          => new sfWidgetFormDateTime(),
      'link'                  => new sfWidgetFormInputText(),
      'image'                 => new sfWidgetFormInputText(),
      'reccurtype'            => new sfWidgetFormInputText(),
      'reccurtimes'           => new sfWidgetFormInputText(),
      'reccurtimesinterval'   => new sfWidgetFormInputText(),
      'reccurday'             => new sfWidgetFormInputText(),
      'reccurweekdays'        => new sfWidgetFormInputText(),
      'reccurweeks'           => new sfWidgetFormInputText(),
      'action_performed_date' => new sfWidgetFormDateTime(),
      'action_done_by'        => new sfWidgetFormInputText(),
      'approved'              => new sfWidgetFormInputText(),
      'functionname'          => new sfWidgetFormInputText(),
      'cronjob_yn'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorDoctrineChoice(array('model' => 'Events', 'column' => 'id', 'required' => false)),
      'title'                 => new sfValidatorString(array('max_length' => 100)),
      'description'           => new sfValidatorString(array('max_length' => 120)),
      'created'               => new sfValidatorDateTime(),
      'created_by'            => new sfValidatorInteger(),
      'modified'              => new sfValidatorDateTime(),
      'modified_by'           => new sfValidatorInteger(),
      'publish_up'            => new sfValidatorDateTime(),
      'publish_down'          => new sfValidatorDateTime(),
      'link'                  => new sfValidatorString(array('max_length' => 50)),
      'image'                 => new sfValidatorString(array('max_length' => 50)),
      'reccurtype'            => new sfValidatorInteger(),
      'reccurtimes'           => new sfValidatorString(array('max_length' => 255)),
      'reccurtimesinterval'   => new sfValidatorString(array('max_length' => 7)),
      'reccurday'             => new sfValidatorString(array('max_length' => 4)),
      'reccurweekdays'        => new sfValidatorString(array('max_length' => 20)),
      'reccurweeks'           => new sfValidatorString(array('max_length' => 10)),
      'action_performed_date' => new sfValidatorDateTime(),
      'action_done_by'        => new sfValidatorInteger(),
      'approved'              => new sfValidatorInteger(),
      'functionname'          => new sfValidatorString(array('max_length' => 255)),
      'cronjob_yn'            => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('events[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Events';
  }

}