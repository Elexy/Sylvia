<?php

/**
 * ProductStock filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProductStockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'stock'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'free_stock'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'free_stock_calculated' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'location_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'owner_id'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'product_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'free_stock'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'free_stock_calculated' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'location_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'owner_id'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('product_stock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductStock';
  }

  public function getFields()
  {
    return array(
      'product_stock_id'      => 'Number',
      'product_id'            => 'Number',
      'stock'                 => 'Number',
      'free_stock'            => 'Number',
      'free_stock_calculated' => 'Date',
      'location_id'           => 'Number',
      'owner_id'              => 'Number',
    );
  }
}
