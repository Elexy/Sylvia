<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RmaActions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaActionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'rmaid'      => new sfWidgetFormFilterInput(),
      'actiondate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'actiontime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'subject'    => new sfWidgetFormFilterInput(),
      'notes'      => new sfWidgetFormFilterInput(),
      'employee'   => new sfWidgetFormFilterInput(),
      'webuser'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'rmaid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'actiondate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'actiontime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'subject'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes'      => new sfValidatorPass(array('required' => false)),
      'employee'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'rmaid'      => 'Number',
      'actiondate' => 'Date',
      'actiontime' => 'Date',
      'subject'    => 'Number',
      'notes'      => 'Text',
      'employee'   => 'Number',
      'webuser'    => 'Text',
    );
  }
}
