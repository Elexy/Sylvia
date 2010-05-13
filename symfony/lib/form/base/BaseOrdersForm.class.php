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
      'contactid'             => new sfWidgetFormInput(),
      'contactsorderid'       => new sfWidgetFormInput(),
      'employeeid'            => new sfWidgetFormInput(),
      'orderdate'             => new sfWidgetFormDateTime(),
      'requireddate'          => new sfWidgetFormDateTime(),
      'shippeddate'           => new sfWidgetFormDateTime(),
      'xp_no'                 => new sfWidgetFormInput(),
      'mailtable'             => new sfWidgetFormInput(),
      'shipvia'               => new sfWidgetFormInput(),
      'shipid'                => new sfWidgetFormInput(),
      'shipname'              => new sfWidgetFormInput(),
      'shipaddress'           => new sfWidgetFormInput(),
      'shipcity'              => new sfWidgetFormInput(),
      'shipregion'            => new sfWidgetFormInput(),
      'shippostalcode'        => new sfWidgetFormInput(),
      'shipcountry'           => new sfWidgetFormInput(),
      'locked_yn'             => new sfWidgetFormInput(),
      'comments'              => new sfWidgetFormTextarea(),
      'confirmed_yn'          => new sfWidgetFormInput(),
      'blockorder'            => new sfWidgetFormInput(),
      'confirmed_how'         => new sfWidgetFormInput(),
      'endcustomer_yn'        => new sfWidgetFormInput(),
      'paymentterm_yn'        => new sfWidgetFormInput(),
      'trackingnummer'        => new sfWidgetFormInput(),
      'btw_yn'                => new sfWidgetFormInput(),
      'price_level'           => new sfWidgetFormInput(),
      'complete_yn'           => new sfWidgetFormInput(),
      'transportcosts'        => new sfWidgetFormInput(),
      'manual_transportcosts' => new sfWidgetFormInput(),
      'ordercosts'            => new sfWidgetFormInput(),
      'manual_ordercosts'     => new sfWidgetFormInput(),
      'employee'              => new sfWidgetFormInput(),
      'in_one_delivery_yn'    => new sfWidgetFormInput(),
      'rma_yn'                => new sfWidgetFormInput(),
      'consignment_order'     => new sfWidgetFormInput(),
      'administration_order'  => new sfWidgetFormInput(),
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
