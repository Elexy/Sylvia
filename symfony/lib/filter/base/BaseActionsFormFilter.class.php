<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Actions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseActionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'actiondate'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'contactid'       => new sfWidgetFormFilterInput(),
      'contactcontents' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'actiondate'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'contactid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactcontents' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('actions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actions';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'actiondate'      => 'Date',
      'contactid'       => 'Number',
      'contactcontents' => 'Text',
    );
  }
}
