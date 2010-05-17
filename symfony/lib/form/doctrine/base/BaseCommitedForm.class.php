<?php

/**
 * Commited form base class.
 *
 * @method Commited getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCommitedForm extends BaseFormDoctrine
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
      'productdescription' => new sfWidgetFormInputText(),
      'quantity'           => new sfWidgetFormInputText(),
      'serialnb'           => new sfWidgetFormInputText(),
      'orderdate'          => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'orderdetailsid'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'orderdetailsid', 'required' => false)),
      'orderid'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'orderid', 'required' => false)),
      'productid'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid', 'required' => false)),
      'unitprice'          => new sfValidatorNumber(array('required' => false)),
      'unitbtw'            => new sfValidatorNumber(array('required' => false)),
      'extended_price'     => new sfValidatorNumber(array('required' => false)),
      'discount'           => new sfValidatorNumber(array('required' => false)),
      'dummy'              => new sfValidatorDateTime(),
      'shipid'             => new sfValidatorInteger(array('required' => false)),
      'btw_percentage'     => new sfValidatorNumber(array('required' => false)),
      'cost_percentage'    => new sfValidatorNumber(array('required' => false)),
      'delivered'          => new sfValidatorInteger(array('required' => false)),
      'productname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'quantity'           => new sfValidatorInteger(array('required' => false)),
      'serialnb'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'orderdate'          => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('commited[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commited';
  }

}
