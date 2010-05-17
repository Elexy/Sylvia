<?php

/**
 * Orders form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrdersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'               => new sfWidgetFormInputHidden(),
      'contactid'             => new sfWidgetFormInputText(),
      'contactsorderid'       => new sfWidgetFormInputText(),
      'employeeid'            => new sfWidgetFormInputText(),
      'orderdate'             => new sfWidgetFormDateTime(),
      'requireddate'          => new sfWidgetFormDateTime(),
      'shippeddate'           => new sfWidgetFormDateTime(),
      'xp_no'                 => new sfWidgetFormInputText(),
      'mailtable'             => new sfWidgetFormInputText(),
      'shipvia'               => new sfWidgetFormInputText(),
      'shipid'                => new sfWidgetFormInputText(),
      'shipname'              => new sfWidgetFormInputText(),
      'shipaddress'           => new sfWidgetFormInputText(),
      'shipcity'              => new sfWidgetFormInputText(),
      'shipregion'            => new sfWidgetFormInputText(),
      'shippostalcode'        => new sfWidgetFormInputText(),
      'shipcountry'           => new sfWidgetFormInputText(),
      'locked_yn'             => new sfWidgetFormInputText(),
      'comments'              => new sfWidgetFormTextarea(),
      'confirmed_yn'          => new sfWidgetFormInputText(),
      'blockorder'            => new sfWidgetFormInputText(),
      'confirmed_how'         => new sfWidgetFormInputText(),
      'endcustomer_yn'        => new sfWidgetFormInputText(),
      'paymentterm_yn'        => new sfWidgetFormInputText(),
      'trackingnummer'        => new sfWidgetFormInputText(),
      'btw_yn'                => new sfWidgetFormInputText(),
      'price_level'           => new sfWidgetFormInputText(),
      'complete_yn'           => new sfWidgetFormInputText(),
      'transportcosts'        => new sfWidgetFormInputText(),
      'manual_transportcosts' => new sfWidgetFormInputText(),
      'ordercosts'            => new sfWidgetFormInputText(),
      'manual_ordercosts'     => new sfWidgetFormInputText(),
      'employee'              => new sfWidgetFormInputText(),
      'in_one_delivery_yn'    => new sfWidgetFormInputText(),
      'rma_yn'                => new sfWidgetFormInputText(),
      'consignment_order'     => new sfWidgetFormInputText(),
      'administration_order'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderid'               => new sfValidatorPropelChoice(array('model' => 'Orders', 'column' => 'orderid', 'required' => false)),
      'contactid'             => new sfValidatorInteger(array('required' => false)),
      'contactsorderid'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'employeeid'            => new sfValidatorInteger(array('required' => false)),
      'orderdate'             => new sfValidatorDateTime(array('required' => false)),
      'requireddate'          => new sfValidatorDateTime(array('required' => false)),
      'shippeddate'           => new sfValidatorDateTime(array('required' => false)),
      'xp_no'                 => new sfValidatorInteger(array('required' => false)),
      'mailtable'             => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'shipvia'               => new sfValidatorInteger(array('required' => false)),
      'shipid'                => new sfValidatorInteger(),
      'shipname'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipaddress'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcity'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipregion'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shippostalcode'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcountry'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'locked_yn'             => new sfValidatorInteger(),
      'comments'              => new sfValidatorString(array('required' => false)),
      'confirmed_yn'          => new sfValidatorInteger(array('required' => false)),
      'blockorder'            => new sfValidatorInteger(),
      'confirmed_how'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'endcustomer_yn'        => new sfValidatorInteger(),
      'paymentterm_yn'        => new sfValidatorInteger(),
      'trackingnummer'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'btw_yn'                => new sfValidatorInteger(),
      'price_level'           => new sfValidatorInteger(array('required' => false)),
      'complete_yn'           => new sfValidatorInteger(array('required' => false)),
      'transportcosts'        => new sfValidatorNumber(array('required' => false)),
      'manual_transportcosts' => new sfValidatorInteger(),
      'ordercosts'            => new sfValidatorNumber(array('required' => false)),
      'manual_ordercosts'     => new sfValidatorInteger(),
      'employee'              => new sfValidatorInteger(array('required' => false)),
      'in_one_delivery_yn'    => new sfValidatorInteger(array('required' => false)),
      'rma_yn'                => new sfValidatorInteger(),
      'consignment_order'     => new sfValidatorInteger(),
      'administration_order'  => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('orders[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }


}
