<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Creditlimits filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCreditlimitsFormFilter extends BaseFormFilterPropel
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
