<?php

/**
 * ShippingMethods filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseShippingMethodsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'shippingmethod'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'shippingmethod'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipping_methods_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShippingMethods';
  }

  public function getFields()
  {
    return array(
      'shippingmethodid' => 'Number',
      'shippingmethod'   => 'Text',
    );
  }
}
