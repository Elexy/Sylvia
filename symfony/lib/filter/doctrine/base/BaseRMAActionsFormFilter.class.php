<?php

/**
 * RMAActions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRMAActionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dummy'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'employee'   => new sfWidgetFormFilterInput(),
      'rmaid'      => new sfWidgetFormFilterInput(),
      'actiondate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'actiontime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'subject'    => new sfWidgetFormFilterInput(),
      'notes'      => new sfWidgetFormFilterInput(),
      'webuser'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dummy'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'employee'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rmaid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'actiondate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'actiontime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'subject'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes'      => new sfValidatorPass(array('required' => false)),
      'webuser'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_actions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMAActions';
  }

  public function getFields()
  {
    return array(
      'actionid'   => 'Number',
      'dummy'      => 'Date',
      'employee'   => 'Number',
      'rmaid'      => 'Number',
      'actiondate' => 'Date',
      'actiontime' => 'Date',
      'subject'    => 'Number',
      'notes'      => 'Text',
      'webuser'    => 'Text',
    );
  }
}
