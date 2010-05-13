<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * OrderMargin filter form base class.
 *
 * @package    filters
 * @subpackage OrderMargin *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseOrderMarginFormFilter extends BaseFormFilterDoctrine
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