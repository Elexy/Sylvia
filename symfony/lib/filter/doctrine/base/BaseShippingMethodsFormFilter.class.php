<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ShippingMethods filter form base class.
 *
 * @package    filters
 * @subpackage ShippingMethods *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseShippingMethodsFormFilter extends BaseFormFilterDoctrine
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