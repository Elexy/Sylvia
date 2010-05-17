<?php

/**
 * PricingPurchase form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePricingPurchaseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'recordid'       => new sfWidgetFormInputHidden(),
      'purchase_price' => new sfWidgetFormInput(),
      'currencyid'     => new sfWidgetFormInput(),
      'start_date'     => new sfWidgetFormDate(),
      'end_date'       => new sfWidgetFormDate(),
      'created'        => new sfWidgetFormDateTime(),
      'created_by'     => new sfWidgetFormInput(),
      'contactid'      => new sfWidgetFormInput(),
      'productid'      => new sfWidgetFormInput(),
      'price_type'     => new sfWidgetFormInput(),
      'start_number'   => new sfWidgetFormInput(),
      'end_number'     => new sfWidgetFormInput(),
      'modified'       => new sfWidgetFormDateTime(),
      'modified_by'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'recordid'       => new sfValidatorPropelChoice(array('model' => 'PricingPurchase', 'column' => 'recordid', 'required' => false)),
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