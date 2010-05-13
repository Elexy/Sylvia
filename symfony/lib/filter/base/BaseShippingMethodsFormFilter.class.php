<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ShippingMethods filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseShippingMethodsFormFilter extends BaseFormFilterPropel
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
