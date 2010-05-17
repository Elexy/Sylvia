<?php

/**
 * OrderDetails form base class.
 *
 * @method OrderDetails getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrderDetailsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderdetailsid'     => new sfWidgetFormInputHidden(),
      'orderid'            => new sfWidgetFormInputText(),
      'productid'          => new sfWidgetFormInputText(),
      'unitprice'          => new sfWidgetFormInputText(),
      'unitcost'           => new sfWidgetFormInputText(),
      'unitbtw'            => new sfWidgetFormInputText(),
      'quantity'           => new sfWidgetFormInputText(),
      'to_deliver'         => new sfWidgetFormInputText(),
      'extended_price'     => new sfWidgetFormInputText(),
      'dummy'              => new sfWidgetFormDateTime(),
      'contactid'          => new sfWidgetFormInputText(),
      'btw_percentage'     => new sfWidgetFormInputText(),
      'cost_percentage'    => new sfWidgetFormInputText(),
      'manual_price'       => new sfWidgetFormInputText(),
      'rma_actionid'       => new sfWidgetFormInputText(),
      'stock_owner_id'     => new sfWidgetFormInputText(),
      'productname'        => new sfWidgetFormInputText(),
      'productdescription' => new sfWidgetFormInputText(),
      'discount'           => new sfWidgetFormInputText(),
      'serialnb'           => new sfWidgetFormInputText(),
      'orderdate'          => new sfWidgetFormDate(),
      'custorderrowid'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderdetailsid'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'orderdetailsid', 'required' => false)),
      'orderid'            => new sfValidatorInteger(array('required' => false)),
      'productid'          => new sfValidatorInteger(array('required' => false)),
      'unitprice'          => new sfValidatorNumber(array('required' => false)),
      'unitcost'           => new sfValidatorNumber(array('required' => false)),
      'unitbtw'            => new sfValidatorNumber(array('required' => false)),
      'quantity'           => new sfValidatorNumber(array('required' => false)),
      'to_deliver'         => new sfValidatorInteger(array('required' => false)),
      'extended_price'     => new sfValidatorNumber(array('required' => false)),
      'dummy'              => new sfValidatorDateTime(),
      'contactid'          => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'     => new sfValidatorNumber(array('required' => false)),
      'cost_percentage'    => new sfValidatorNumber(array('required' => false)),
      'manual_price'       => new sfValidatorInteger(array('required' => false)),
      'rma_actionid'       => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'     => new sfValidatorInteger(array('required' => false)),
      'productname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'discount'           => new sfValidatorNumber(array('required' => false)),
      'serialnb'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orderdate'          => new sfValidatorDate(array('required' => false)),
      'custorderrowid'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_details[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderDetails';
  }

}
