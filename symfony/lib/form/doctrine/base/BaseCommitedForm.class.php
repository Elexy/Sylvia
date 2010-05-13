<?php

/**
 * Commited form base class.
 *
 * @package    form
 * @subpackage commited
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCommitedForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderdetailsid'     => new sfWidgetFormInputHidden(),
      'orderid'            => new sfWidgetFormInputHidden(),
      'productid'          => new sfWidgetFormInputHidden(),
      'unitprice'          => new sfWidgetFormInputText(),
      'unitbtw'            => new sfWidgetFormInputText(),
      'extended_price'     => new sfWidgetFormInputText(),
      'discount'           => new sfWidgetFormInputText(),
      'dummy'              => new sfWidgetFormDateTime(),
      'shipid'             => new sfWidgetFormInputText(),
      'btw_percentage'     => new sfWidgetFormInputText(),
      'cost_percentage'    => new sfWidgetFormInputText(),
      'delivered'          => new sfWidgetFormInputText(),
      'productname'        => new sfWidgetFormInputText(),
      'productdescription' => new sfWidgetFormTextarea(),
      'quantity'           => new sfWidgetFormInputText(),
      'serialnb'           => new sfWidgetFormInputText(),
      'orderdate'          => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'orderdetailsid'     => new sfValidatorDoctrineChoice(array('model' => 'Commited', 'column' => 'orderdetailsid', 'required' => false)),
      'orderid'            => new sfValidatorDoctrineChoice(array('model' => 'Commited', 'column' => 'orderid', 'required' => false)),
      'productid'          => new sfValidatorDoctrineChoice(array('model' => 'Commited', 'column' => 'productid', 'required' => false)),
      'unitprice'          => new sfValidatorNumber(),
      'unitbtw'            => new sfValidatorNumber(),
      'extended_price'     => new sfValidatorNumber(),
      'discount'           => new sfValidatorNumber(array('required' => false)),
      'dummy'              => new sfValidatorDateTime(),
      'shipid'             => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'     => new sfValidatorNumber(),
      'cost_percentage'    => new sfValidatorNumber(),
      'delivered'          => new sfValidatorInteger(array('required' => false)),
      'productname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'quantity'           => new sfValidatorInteger(array('required' => false)),
      'serialnb'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orderdate'          => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('commited[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commited';
  }

}