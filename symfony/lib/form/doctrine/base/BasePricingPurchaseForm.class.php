<?php

/**
 * PricingPurchase form base class.
 *
 * @package    form
 * @subpackage pricing_purchase
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricingPurchaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'recordid'       => new sfWidgetFormInputHidden(),
      'purchase_price' => new sfWidgetFormInputText(),
      'currencyid'     => new sfWidgetFormInputText(),
      'start_date'     => new sfWidgetFormDate(),
      'end_date'       => new sfWidgetFormDate(),
      'created'        => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormInputText(),
      'contactid'      => new sfWidgetFormInputText(),
      'productid'      => new sfWidgetFormInputText(),
      'price_type'     => new sfWidgetFormInputText(),
      'start_number'   => new sfWidgetFormInputText(),
      'end_number'     => new sfWidgetFormInputText(),
      'modified'       => new sfWidgetFormDateTime(),
      'modified_by'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'recordid'       => new sfValidatorDoctrineChoice(array('model' => 'PricingPurchase', 'column' => 'recordid', 'required' => false)),
      'purchase_price' => new sfValidatorNumber(),
      'currencyid'     => new sfValidatorInteger(),
      'start_date'     => new sfValidatorDate(),
      'end_date'       => new sfValidatorDate(),
      'created'        => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorInteger(),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
      'productid'      => new sfValidatorInteger(array('required' => false)),
      'price_type'     => new sfValidatorInteger(),
      'start_number'   => new sfValidatorInteger(),
      'end_number'     => new sfValidatorInteger(),
      'modified'       => new sfValidatorDateTime(),
      'modified_by'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('pricing_purchase[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricingPurchase';
  }

}