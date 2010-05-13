<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Actions filter form base class.
 *
 * @package    filters
 * @subpackage Actions *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseActionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'       => new sfWidgetFormFilterInput(),
      'dummy'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'actiondate'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'contactcontents' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'actiondate'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'contactid'       => 'Number',
      'dummy'           => 'Date',
      'actiondate'      => 'Date',
      'contactcontents' => 'Text',
    );
  }
}