<?php

/**
 * Pricing filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePricingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'purchase_price' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currencyid'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'start_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'end_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contactid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'productid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'start_number'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end_number'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at_by'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'purchase_price' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currencyid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'end_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'start_number'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'end_number'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('pricing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pricing';
  }

  public function getFields()
  {
    return array(
      'recordid'       => 'Number',
      'purchase_price' => 'Number',
      'amount'         => 'Number',
      'currencyid'     => 'Number',
      'start_date'     => 'Date',
      'end_date'       => 'Date',
      'created'        => 'Date',
      'created_by'     => 'Number',
      'contactid'      => 'Number',
      'productid'      => 'Number',
      'price_type'     => 'Number',
      'start_number'   => 'Number',
      'end_number'     => 'Number',
      'updated_at'     => 'Date',
      'updated_at_by'  => 'Number',
    );
  }
}
