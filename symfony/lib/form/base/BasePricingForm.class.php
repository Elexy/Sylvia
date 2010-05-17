<?php

/**
 * Pricing form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePricingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'recordid'       => new sfWidgetFormInputHidden(),
      'purchase_price' => new sfWidgetFormInputText(),
      'amount'         => new sfWidgetFormInputText(),
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
      'recordid'       => new sfValidatorPropelChoice(array('model' => 'Pricing', 'column' => 'recordid', 'required' => false)),
      'purchase_price' => new sfValidatorNumber(),
      'amount'         => new sfValidatorNumber(),
      'currencyid'     => new sfValidatorInteger(),
      'start_date'     => new sfValidatorDate(),
      'end_date'       => new sfValidatorDate(),
      'created'        => new sfValidatorDateTime(),
      'created_by'     => new sfValidatorInteger(),
      'contactid'      => new sfValidatorInteger(),
      'productid'      => new sfValidatorInteger(),
      'price_type'     => new sfValidatorInteger(),
      'start_number'   => new sfValidatorInteger(),
      'end_number'     => new sfValidatorInteger(),
      'modified'       => new sfValidatorDateTime(),
      'modified_by'    => new sfValidatorInteger(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Pricing', 'column' => array('recordid')))
    );

    $this->widgetSchema->setNameFormat('pricing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pricing';
  }


}
