<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Events filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseEventsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                 => new sfWidgetFormFilterInput(),
      'description'           => new sfWidgetFormFilterInput(),
      'created'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'            => new sfWidgetFormFilterInput(),
      'modified'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'modified_by'           => new sfWidgetFormFilterInput(),
      'publish_up'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'publish_down'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'link'                  => new sfWidgetFormFilterInput(),
      'image'                 => new sfWidgetFormFilterInput(),
      'reccurtype'            => new sfWidgetFormFilterInput(),
      'reccurtimes'           => new sfWidgetFormFilterInput(),
      'reccurtimesinterval'   => new sfWidgetFormFilterInput(),
      'reccurday'             => new sfWidgetFormFilterInput(),
      'reccurweekdays'        => new sfWidgetFormFilterInput(),
      'reccurweeks'           => new sfWidgetFormFilterInput(),
      'action_performed_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'action_done_by'        => new sfWidgetFormFilterInput(),
      'approved'              => new sfWidgetFormFilterInput(),
      'functionname'          => new sfWidgetFormFilterInput(),
      'cronjob_yn'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'                 => new sfValidatorPass(array('required' => false)),
      'description'           => new sfValidatorPass(array('required' => false)),
      'created'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_by'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'modified'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modified_by'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'publish_up'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'publish_down'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'link'                  => new sfValidatorPass(array('required' => false)),
      'image'                 => new sfValidatorPass(array('required' => false)),
      'reccurtype'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reccurtimes'           => new sfValidatorPass(array('required' => false)),
      'reccurtimesinterval'   => new sfValidatorPass(array('required' => false)),
      'reccurday'             => new sfValidatorPass(array('required' => false)),
      'reccurweekdays'        => new sfValidatorPass(array('required' => false)),
      'reccurweeks'           => new sfValidatorPass(array('required' => false)),
      'action_performed_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'action_done_by'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'approved'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'functionname'          => new sfValidatorPass(array('required' => false)),
      'cronjob_yn'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('events_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'modified'              => 'Date',
      'modified_by'           => 'Number',
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
