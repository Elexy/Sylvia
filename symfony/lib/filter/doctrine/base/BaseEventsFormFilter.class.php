<?php

/**
 * Events filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEventsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_by'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'publish_up'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'publish_down'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'link'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reccurtype'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reccurtimes'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reccurtimesinterval'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reccurday'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reccurweekdays'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reccurweeks'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action_performed_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'action_done_by'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'approved'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'functionname'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cronjob_yn'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'                 => new sfValidatorPass(array('required' => false)),
      'description'           => new sfValidatorPass(array('required' => false)),
      'created'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_by'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'publish_up'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'publish_down'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'link'                  => new sfValidatorPass(array('required' => false)),
      'image'                 => new sfValidatorPass(array('required' => false)),
      'reccurtype'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reccurtimes'           => new sfValidatorPass(array('required' => false)),
      'reccurtimesinterval'   => new sfValidatorPass(array('required' => false)),
      'reccurday'             => new sfValidatorPass(array('required' => false)),
      'reccurweekdays'        => new sfValidatorPass(array('required' => false)),
      'reccurweeks'           => new sfValidatorPass(array('required' => false)),
      'action_performed_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'action_done_by'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'approved'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'functionname'          => new sfValidatorPass(array('required' => false)),
      'cronjob_yn'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('events_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Events';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'title'                 => 'Text',
      'description'           => 'Text',
      'created'               => 'Date',
      'created_by'            => 'Number',
      'updated_at'            => 'Date',
      'updated_by'            => 'Number',
      'publish_up'            => 'Date',
      'publish_down'          => 'Date',
      'link'                  => 'Text',
      'image'                 => 'Text',
      'reccurtype'            => 'Number',
      'reccurtimes'           => 'Text',
      'reccurtimesinterval'   => 'Text',
      'reccurday'             => 'Text',
      'reccurweekdays'        => 'Text',
      'reccurweeks'           => 'Text',
      'action_performed_date' => 'Date',
      'action_done_by'        => 'Number',
      'approved'              => 'Number',
      'functionname'          => 'Text',
      'cronjob_yn'            => 'Number',
    );
  }
}
