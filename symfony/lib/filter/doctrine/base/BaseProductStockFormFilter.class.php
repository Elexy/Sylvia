<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ProductStock filter form base class.
 *
 * @package    filters
 * @subpackage ProductStock *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseProductStockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'            => new sfWidgetFormFilterInput(),
      'stock'                 => new sfWidgetFormFilterInput(),
      'free_stock'            => new sfWidgetFormFilterInput(),
      'free_stock_calculated' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'location_id'           => new sfWidgetFormFilterInput(),
      'owner_id'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'product_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'free_stock'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'free_stock_calculated' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'location_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'owner_id'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('product_stock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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