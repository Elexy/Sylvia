<?php

/**
 * Pricing form base class.
 *
 * @method Pricing getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePricingForm extends BaseFormDoctrine
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
      'updated_at'     => new sfWidgetFormDateTime(),
      'updated_at_by'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'recordid'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'recordid', 'required' => false)),
      'purchase_price' => new sfValidatorNumber(array('required' => false)),
      'amount'         => new sfValidatorNumber(array('required' => false)),
      'currencyid'     => new sfValidatorInteger(array('required' => false)),
      'start_date'     => new sfValidatorDate(array('required' => false)),
      'end_date'       => new sfValidatorDate(array('required' => false)),
      'created'        => new sfValidatorDateTime(array('required' => false)),
      'created_by'     => new sfValidatorInteger(array('required' => false)),
      'contactid'      => new sfValidatorInteger(array('required' => false)),
      'productid'      => new sfValidatorInteger(),
      'price_type'     => new sfValidatorInteger(array('required' => false)),
      'start_number'   => new sfValidatorInteger(array('required' => false)),
      'end_number'     => new sfValidatorInteger(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at_by'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pricing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pricing';
  }

}
