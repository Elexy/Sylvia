<?php

/**
 * RMAProductCustomer form base class.
 *
 * @method RMAProductCustomer getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRMAProductCustomerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_id'   => new sfWidgetFormInputHidden(),
      'state_text' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'state_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'state_id', 'required' => false)),
      'state_text' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_product_customer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMAProductCustomer';
  }

}
