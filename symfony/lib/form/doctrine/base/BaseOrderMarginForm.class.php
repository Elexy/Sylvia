<?php

/**
 * OrderMargin form base class.
 *
 * @method OrderMargin getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrderMarginForm extends BaseFormDoctrine
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
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'orderid'        => new sfValidatorInteger(array('required' => false)),
      'sales_value'    => new sfValidatorNumber(array('required' => false)),
      'purchase_value' => new sfValidatorNumber(array('required' => false)),
      'shipping_cost'  => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_margin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderMargin';
  }

}
