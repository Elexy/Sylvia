<?php

/**
 * Orders form base class.
 *
 * @method Orders getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrdersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderid'               => new sfWidgetFormInputHidden(),
      'xp_no'                 => new sfWidgetFormInputText(),
      'shipvia'               => new sfWidgetFormInputText(),
      'shipid'                => new sfWidgetFormInputText(),
      'locked_yn'             => new sfWidgetFormInputText(),
      'dummy'                 => new sfWidgetFormDateTime(),
      'confirmed_yn'          => new sfWidgetFormInputText(),
      'blockorder'            => new sfWidgetFormInputText(),
      'endcustomer_yn'        => new sfWidgetFormInputText(),
      'paymentterm_yn'        => new sfWidgetFormInputText(),
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
      'contactid'             => new sfWidgetFormInputText(),
      'contactsorderid'       => new sfWidgetFormInputText(),
      'employeeid'            => new sfWidgetFormInputText(),
      'orderdate'             => new sfWidgetFormDateTime(),
      'requireddate'          => new sfWidgetFormDateTime(),
      'shippeddate'           => new sfWidgetFormDateTime(),
      'mailtable'             => new sfWidgetFormInputText(),
      'shipname'              => new sfWidgetFormInputText(),
      'shipaddress'           => new sfWidgetFormInputText(),
      'shipcity'              => new sfWidgetFormInputText(),
      'shipregion'            => new sfWidgetFormInputText(),
      'shippostalcode'        => new sfWidgetFormInputText(),
      'shipcountry'           => new sfWidgetFormInputText(),
      'comments'              => new sfWidgetFormInputText(),
      'confirmed_how'         => new sfWidgetFormInputText(),
      'trackingnummer'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderid'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'orderid', 'required' => false)),
      'xp_no'                 => new sfValidatorInteger(array('required' => false)),
      'shipvia'               => new sfValidatorInteger(array('required' => false)),
      'shipid'                => new sfValidatorInteger(array('required' => false)),
      'locked_yn'             => new sfValidatorInteger(array('required' => false)),
      'dummy'                 => new sfValidatorDateTime(),
      'confirmed_yn'          => new sfValidatorInteger(array('required' => false)),
      'blockorder'            => new sfValidatorInteger(array('required' => false)),
      'endcustomer_yn'        => new sfValidatorInteger(),
      'paymentterm_yn'        => new sfValidatorInteger(),
      'btw_yn'                => new sfValidatorInteger(),
      'price_level'           => new sfValidatorInteger(array('required' => false)),
      'complete_yn'           => new sfValidatorInteger(array('required' => false)),
      'transportcosts'        => new sfValidatorNumber(array('required' => false)),
      'manual_transportcosts' => new sfValidatorInteger(array('required' => false)),
      'ordercosts'            => new sfValidatorNumber(array('required' => false)),
      'manual_ordercosts'     => new sfValidatorInteger(array('required' => false)),
      'employee'              => new sfValidatorInteger(array('required' => false)),
      'in_one_delivery_yn'    => new sfValidatorInteger(array('required' => false)),
      'rma_yn'                => new sfValidatorInteger(array('required' => false)),
      'consignment_order'     => new sfValidatorInteger(array('required' => false)),
      'administration_order'  => new sfValidatorInteger(array('required' => false)),
      'contactid'             => new sfValidatorInteger(array('required' => false)),
      'contactsorderid'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'employeeid'            => new sfValidatorInteger(array('required' => false)),
      'orderdate'             => new sfValidatorDateTime(array('required' => false)),
      'requireddate'          => new sfValidatorDateTime(array('required' => false)),
      'shippeddate'           => new sfValidatorDateTime(array('required' => false)),
      'mailtable'             => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'shipname'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipaddress'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcity'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipregion'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shippostalcode'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'shipcountry'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'comments'              => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'confirmed_how'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'trackingnummer'        => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('orders[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }

}
