<?php

/**
 * ShippingMethods form base class.
 *
 * @package    form
 * @subpackage shipping_methods
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseShippingMethodsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'shippingmethodid' => new sfWidgetFormInputHidden(),
      'shippingmethod'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'shippingmethodid' => new sfValidatorDoctrineChoice(array('model' => 'ShippingMethods', 'column' => 'shippingmethodid', 'required' => false)),
      'shippingmethod'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_methods[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingMethods';
  }

}