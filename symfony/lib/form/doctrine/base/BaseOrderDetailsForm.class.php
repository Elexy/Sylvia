<?php

/**
 * OrderDetails form base class.
 *
 * @package    form
 * @subpackage order_details
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrderDetailsForm extends BaseFormDoctrine
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
      'productdescription' => new sfWidgetFormTextarea(),
      'discount'           => new sfWidgetFormInputText(),
      'serialnb'           => new sfWidgetFormInputText(),
      'orderdate'          => new sfWidgetFormDate(),
      'custorderrowid'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderdetailsid'     => new sfValidatorDoctrineChoice(array('model' => 'OrderDetails', 'column' => 'orderdetailsid', 'required' => false)),
      'orderid'            => new sfValidatorInteger(),
      'productid'          => new sfValidatorInteger(),
      'unitprice'          => new sfValidatorNumber(),
      'unitcost'           => new sfValidatorNumber(),
      'unitbtw'            => new sfValidatorNumber(),
      'quantity'           => new sfValidatorNumber(array('required' => false)),
      'to_deliver'         => new sfValidatorInteger(array('required' => false)),
      'extended_price'     => new sfValidatorNumber(),
      'dummy'              => new sfValidatorDateTime(),
      'contactid'          => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'     => new sfValidatorNumber(),
      'cost_percentage'    => new sfValidatorNumber(),
      'manual_price'       => new sfValidatorInteger(),
      'rma_actionid'       => new sfValidatorInteger(array('required' => false)),
      'stock_owner_id'     => new sfValidatorInteger(),
      'productname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'discount'           => new sfValidatorNumber(array('required' => false)),
      'serialnb'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orderdate'          => new sfValidatorDate(array('required' => false)),
      'custorderrowid'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_details[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderDetails';
  }

}