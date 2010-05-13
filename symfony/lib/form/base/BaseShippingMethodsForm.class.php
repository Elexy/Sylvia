<?php

/**
 * ShippingMethods form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseShippingMethodsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shippingmethodid' => new sfWidgetFormInputHidden(),
      'shippingmethod'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'shippingmethodid' => new sfValidatorPropelChoice(array('model' => 'ShippingMethods', 'column' => 'shippingmethodid', 'required' => false)),
      'shippingmethod'   => new sfValidatorString(array('required' => false)),
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
