<?php

/**
 * RMAProductCustomer filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRMAProductCustomerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'state_text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_product_customer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMAProductCustomer';
  }

  public function getFields()
  {
    return array(
      'state_id'   => 'Number',
      'state_text' => 'Text',
    );
  }
}
