<?php

/**
 * Events form base class.
 *
 * @method Events getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEventsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'title'                 => new sfWidgetFormInputText(),
      'description'           => new sfWidgetFormInputText(),
      'created'               => new sfWidgetFormDateTime(),
      'created_by'            => new sfWidgetFormInputText(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'updated_by'            => new sfWidgetFormInputText(),
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
      'id'                    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'title'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'description'           => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'created'               => new sfValidatorDateTime(array('required' => false)),
      'created_by'            => new sfValidatorInteger(array('required' => false)),
      'updated_at'            => new sfValidatorDateTime(array('required' => false)),
      'updated_by'            => new sfValidatorInteger(array('required' => false)),
      'publish_up'            => new sfValidatorDateTime(array('required' => false)),
      'publish_down'          => new sfValidatorDateTime(array('required' => false)),
      'link'                  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'image'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'reccurtype'            => new sfValidatorInteger(array('required' => false)),
      'reccurtimes'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'reccurtimesinterval'   => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'reccurday'             => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'reccurweekdays'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'reccurweeks'           => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'action_performed_date' => new sfValidatorDateTime(array('required' => false)),
      'action_done_by'        => new sfValidatorInteger(array('required' => false)),
      'approved'              => new sfValidatorInteger(array('required' => false)),
      'functionname'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cronjob_yn'            => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('events[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Events';
  }

}
