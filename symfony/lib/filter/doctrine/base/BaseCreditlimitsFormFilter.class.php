<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Creditlimits filter form base class.
 *
 * @package    filters
 * @subpackage Creditlimits *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCreditlimitsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'limit_amount'   => new sfWidgetFormFilterInput(),
      'own_limit'      => new sfWidgetFormFilterInput(),
      'currencyid'     => new sfWidgetFormFilterInput(),
      'start_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'end_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormFilterInput(),
      'contactid'      => new sfWidgetFormFilterInput(),
      'modified'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'modified_by'    => new sfWidgetFormFilterInput(),
      'notes'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'limit_amount'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'own_limit'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'currencyid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'end_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_by'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'modified'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modified_by'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('creditlimits_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Creditlimits';
  }

  public function getFields()
  {
    return array(
      'creditlimit_id' => 'Number',
      'limit_amount'   => 'Number',
      'own_limit'      => 'Number',
      'currencyid'     => 'Number',
      'start_date'     => 'Date',
      'end_date'       => 'Date',
      'created'        => 'Date',
      'created_by'     => 'Number',
      'contactid'      => 'Number',
      'modified'       => 'Date',
      'modified_by'    => 'Number',
      'notes'          => 'Text',
    );
  }
}