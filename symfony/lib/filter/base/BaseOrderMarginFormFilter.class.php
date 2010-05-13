<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * OrderMargin filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrderMarginFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'        => new sfWidgetFormFilterInput(),
      'sales_value'    => new sfWidgetFormFilterInput(),
      'purchase_value' => new sfWidgetFormFilterInput(),
      'shipping_cost'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'orderid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sales_value'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'purchase_value' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'shipping_cost'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('order_margin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderMargin';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'orderid'        => 'Number',
      'sales_value'    => 'Number',
      'purchase_value' => 'Number',
      'shipping_cost'  => 'Number',
    );
  }
}
