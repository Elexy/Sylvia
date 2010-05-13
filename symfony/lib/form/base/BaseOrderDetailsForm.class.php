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
      'orderid'            => new sfWidgetFormInput(),
      'productid'          => new sfWidgetFormInput(),
      'productname'        => new sfWidgetFormInput(),
      'productdescription' => new sfWidgetFormTextarea(),
      'unitprice'          => new sfWidgetFormInput(),
      'unitcost'           => new sfWidgetFormInput(),
      'unitbtw'            => new sfWidgetFormInput(),
      'quantity'           => new sfWidgetFormInput(),
      'to_deliver'         => new sfWidgetFormInput(),
      'extended_price'     => new sfWidgetFormInput(),
      'discount'           => new sfWidgetFormInput(),
      'serialnb'           => new sfWidgetFormInput(),
      'contactid'          => new sfWidgetFormInput(),
      'orderdate'          => new sfWidgetFormDate(),
      'btw_percentage'     => new sfWidgetFormInput(),
      'cost_percentage'    => new sfWidgetFormInput(),
      'manual_price'       => new sfWidgetFormInput(),
      'rma_actionid'       => new sfWidgetFormInput(),
      'custorderrowid'     => new sfWidgetFormInput(),
      'stock_owner_id'     => new sfWidgetFormInput(),
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
