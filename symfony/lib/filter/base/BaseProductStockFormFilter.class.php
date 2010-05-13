<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ProductStock filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseProductStockFormFilter extends BaseFormFilterPropel
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
