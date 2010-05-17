<?php

/**
 * OrderHistory filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrderHistoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'employee'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'old_value'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'new_value'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date_updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fieldname'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'orderid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employee'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'old_value'       => new sfValidatorPass(array('required' => false)),
      'new_value'       => new sfValidatorPass(array('required' => false)),
      'date_updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fieldname'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderHistory';
  }

  public function getFields()
  {
    return array(
      'orderhistoryid'  => 'Number',
      'orderid'         => 'Number',
      'employee'        => 'Number',
      'old_value'       => 'Text',
      'new_value'       => 'Text',
      'date_updated_at' => 'Date',
      'fieldname'       => 'Text',
    );
  }
}
