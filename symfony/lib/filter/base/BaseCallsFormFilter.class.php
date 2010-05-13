<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Calls filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCallsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid' => new sfWidgetFormFilterInput(),
      'calldate'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'calltime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'employee'  => new sfWidgetFormFilterInput(),
      'subject'   => new sfWidgetFormFilterInput(),
      'notes'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'calldate'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'calltime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'employee'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'contactid' => 'Number',
      'calldate'  => 'Date',
      'calltime'  => 'Date',
      'employee'  => 'Number',
      'subject'   => 'Text',
      'notes'     => 'Text',
    );
  }
}
