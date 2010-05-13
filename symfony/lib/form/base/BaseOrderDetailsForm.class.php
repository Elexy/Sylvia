<?php

/**
 * OrderDetails form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrderDetailsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderdetailsid'     => new sfWidgetFormInputHidden(),
      'orderid'            => new sfWidgetFormInputText(),
      'productid'          => new sfWidgetFormInputText(),
      'productname'        => new sfWidgetFormInputText(),
      'productdescription' => new sfWidgetFormTextarea(),
      'unitprice'          => new sfWidgetFormInputText(),
      'unitcost'           => new sfWidgetFormInputText(),
      'unitbtw'            => new sfWidgetFormInputText(),
      'quantity'           => new sfWidgetFormInputText(),
      'to_deliver'         => new sfWidgetFormInputText(),
      'extended_price'     => new sfWidgetFormInputText(),
      'discount'           => new sfWidgetFormInputText(),
      'serialnb'           => new sfWidgetFormInputText(),
      'contactid'          => new sfWidgetFormInputText(),
      'orderdate'          => new sfWidgetFormDate(),
      'btw_percentage'     => new sfWidgetFormInputText(),
      'cost_percentage'    => new sfWidgetFormInputText(),
      'manual_price'       => new sfWidgetFormInputText(),
      'rma_actionid'       => new sfWidgetFormInputText(),
      'custorderrowid'     => new sfWidgetFormInputText(),
      'stock_owner_id'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderdetailsid'     => new sfValidatorPropelChoice(array('model' => 'OrderDetails', 'column' => 'orderdetailsid', 'required' => false)),
      'orderid'            => new sfValidatorInteger(),
      'productid'          => new sfValidatorInteger(),
      'productname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription' => new sfValidatorString(array('required' => false)),
      'unitprice'          => new sfValidatorNumber(),
      'unitcost'           => new sfValidatorNumber(),
      'unitbtw'            => new sfValidatorNumber(),
      'quantity'           => new sfValidatorNumber(array('required' => false)),
      'to_deliver'         => new sfValidatorInteger(array('required' => false)),
      'extended_price'     => new sfValidatorNumber(),
      'discount'           => new sfValidatorNumber(array('required' => false)),
      'serialnb'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contactid'          => new sfValidatorInteger(array('required' => false)),
      'orderdate'          => new sfValidatorDate(array('required' => false)),
      'btw_percentage'     => new sfValidatorNumber(),
      'cost_percentage'    => new sfValidatorNumber(),
      'manual_price'       => new sfValidatorInteger(),
      'rma_actionid'       => new sfValidatorInteger(array('required' => false)),
      'custorderrowid'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'stock_owner_id'     => new sfValidatorInteger(),
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
