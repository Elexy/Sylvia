<?php

/**
 * Commited form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCommitedForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderdetailsid'     => new sfWidgetFormInputHidden(),
      'orderid'            => new sfWidgetFormInputHidden(),
      'productid'          => new sfWidgetFormInputHidden(),
      'productname'        => new sfWidgetFormInputText(),
      'productdescription' => new sfWidgetFormTextarea(),
      'unitprice'          => new sfWidgetFormInputText(),
      'unitbtw'            => new sfWidgetFormInputText(),
      'quantity'           => new sfWidgetFormInputText(),
      'extended_price'     => new sfWidgetFormInputText(),
      'discount'           => new sfWidgetFormInputText(),
      'serialnb'           => new sfWidgetFormInputText(),
      'shipid'             => new sfWidgetFormInputText(),
      'orderdate'          => new sfWidgetFormDate(),
      'btw_percentage'     => new sfWidgetFormInputText(),
      'cost_percentage'    => new sfWidgetFormInputText(),
      'delivered'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderdetailsid'     => new sfValidatorPropelChoice(array('model' => 'Commited', 'column' => 'orderdetailsid', 'required' => false)),
      'orderid'            => new sfValidatorPropelChoice(array('model' => 'Commited', 'column' => 'orderid', 'required' => false)),
      'productid'          => new sfValidatorPropelChoice(array('model' => 'Commited', 'column' => 'productid', 'required' => false)),
      'productname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription' => new sfValidatorString(array('required' => false)),
      'unitprice'          => new sfValidatorNumber(),
      'unitbtw'            => new sfValidatorNumber(),
      'quantity'           => new sfValidatorInteger(array('required' => false)),
      'extended_price'     => new sfValidatorNumber(),
      'discount'           => new sfValidatorNumber(array('required' => false)),
      'serialnb'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shipid'             => new sfValidatorInteger(array('required' => false)),
      'orderdate'          => new sfValidatorDate(array('required' => false)),
      'btw_percentage'     => new sfValidatorNumber(),
      'cost_percentage'    => new sfValidatorNumber(),
      'delivered'          => new sfValidatorInteger(array('required' => false)),
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
