<?php

/**
 * OrderMargin filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrderMarginFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sales_value'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'purchase_value' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'shipping_cost'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'orderid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sales_value'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'purchase_value' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'shipping_cost'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('order_margin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
