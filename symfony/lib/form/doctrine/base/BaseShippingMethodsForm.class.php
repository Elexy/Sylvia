<?php

/**
 * ShippingMethods form base class.
 *
 * @method ShippingMethods getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseShippingMethodsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'shippingmethodid' => new sfWidgetFormInputHidden(),
      'shippingmethod'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'shippingmethodid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'shippingmethodid', 'required' => false)),
      'shippingmethod'   => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_methods[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingMethods';
  }

}
