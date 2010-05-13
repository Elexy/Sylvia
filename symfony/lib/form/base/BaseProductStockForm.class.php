<?php

/**
 * ProductStock form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseProductStockForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_stock_id'      => new sfWidgetFormInputHidden(),
      'product_id'            => new sfWidgetFormInputText(),
      'stock'                 => new sfWidgetFormInputText(),
      'free_stock'            => new sfWidgetFormInputText(),
      'free_stock_calculated' => new sfWidgetFormDateTime(),
      'location_id'           => new sfWidgetFormInputText(),
      'owner_id'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'product_stock_id'      => new sfValidatorPropelChoice(array('model' => 'ProductStock', 'column' => 'product_stock_id', 'required' => false)),
      'product_id'            => new sfValidatorInteger(),
      'stock'                 => new sfValidatorInteger(),
      'free_stock'            => new sfValidatorInteger(),
      'free_stock_calculated' => new sfValidatorDateTime(),
      'location_id'           => new sfValidatorInteger(),
      'owner_id'              => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('product_stock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductStock';
  }


}
