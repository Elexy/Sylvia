<?php

/**
 * Calls filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCallsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee'  => new sfWidgetFormFilterInput(),
      'dummy'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'contactid' => new sfWidgetFormFilterInput(),
      'calldate'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'calltime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'subject'   => new sfWidgetFormFilterInput(),
      'notes'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'employee'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'contactid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'calldate'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'calltime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'subject'   => new sfValidatorPass(array('required' => false)),
      'notes'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('calls_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calls';
  }

  public function getFields()
  {
    return array(
      'callid'    => 'Number',
      'employee'  => 'Number',
      'dummy'     => 'Date',
      'contactid' => 'Number',
      'calldate'  => 'Date',
      'calltime'  => 'Date',
      'subject'   => 'Text',
      'notes'     => 'Text',
    );
  }
}
