<?php

/**
 * OrderMargin form base class.
 *
 * @package    form
 * @subpackage order_margin
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrderMarginForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'orderid'        => new sfWidgetFormInputText(),
      'sales_value'    => new sfWidgetFormInputText(),
      'purchase_value' => new sfWidgetFormInputText(),
      'shipping_cost'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'OrderMargin', 'column' => 'id', 'required' => false)),
      'orderid'        => new sfValidatorInteger(),
      'sales_value'    => new sfValidatorNumber(),
      'purchase_value' => new sfValidatorNumber(),
      'shipping_cost'  => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('order_margin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderMargin';
  }

}