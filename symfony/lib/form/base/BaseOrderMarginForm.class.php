<?php

/**
 * OrderMargin form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrderMarginForm extends BaseFormPropel
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
      'id'             => new sfValidatorPropelChoice(array('model' => 'OrderMargin', 'column' => 'id', 'required' => false)),
      'orderid'        => new sfValidatorInteger(),
      'sales_value'    => new sfValidatorNumber(),
      'purchase_value' => new sfValidatorNumber(),
      'shipping_cost'  => new sfValidatorNumber(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'OrderMargin', 'column' => array('orderid')))
    );

    $this->widgetSchema->setNameFormat('order_margin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderMargin';
  }


}
