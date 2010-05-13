<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * RmaActions filter form base class.
 *
 * @package    filters
 * @subpackage RmaActions *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseRmaActionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dummy'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'employee'   => new sfWidgetFormFilterInput(),
      'rmaid'      => new sfWidgetFormFilterInput(),
      'actiondate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'actiontime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'subject'    => new sfWidgetFormFilterInput(),
      'notes'      => new sfWidgetFormFilterInput(),
      'webuser'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dummy'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'employee'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rmaid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'actiondate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'actiontime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'subject'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes'      => new sfValidatorPass(array('required' => false)),
      'webuser'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_actions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaActions';
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