<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Calls filter form base class.
 *
 * @package    filters
 * @subpackage Calls *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCallsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee'  => new sfWidgetFormFilterInput(),
      'dummy'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'contactid' => new sfWidgetFormFilterInput(),
      'calldate'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'calltime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'subject'   => new sfWidgetFormFilterInput(),
      'notes'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'employee'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'contactid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'calldate'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'calltime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'subject'   => new sfValidatorPass(array('required' => false)),
      'notes'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('calls_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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