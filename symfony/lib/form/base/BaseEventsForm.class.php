<?php

/**
 * Events form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseEventsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'title'                 => new sfWidgetFormInput(),
      'description'           => new sfWidgetFormInput(),
      'created'               => new sfWidgetFormDateTime(),
      'created_by'            => new sfWidgetFormInput(),
      'modified'              => new sfWidgetFormDateTime(),
      'modified_by'           => new sfWidgetFormInput(),
      'publish_up'            => new sfWidgetFormDateTime(),
      'publish_down'          => new sfWidgetFormDateTime(),
      'link'                  => new sfWidgetFormInput(),
      'image'                 => new sfWidgetFormInput(),
      'reccurtype'            => new sfWidgetFormInput(),
      'reccurtimes'           => new sfWidgetFormInput(),
      'reccurtimesinterval'   => new sfWidgetFormInput(),
      'reccurday'             => new sfWidgetFormInput(),
      'reccurweekdays'        => new sfWidgetFormInput(),
      'reccurweeks'           => new sfWidgetFormInput(),
      'action_performed_date' => new sfWidgetFormDateTime(),
      'action_done_by'        => new sfWidgetFormInput(),
      'approved'              => new sfWidgetFormInput(),
      'functionname'          => new sfWidgetFormInput(),
      'cronjob_yn'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Events', 'column' => 'id', 'required' => false)),
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
