<?php

/**
 * ProductStock form base class.
 *
 * @method ProductStock getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProductStockForm extends BaseFormDoctrine
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
      'product_stock_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'product_stock_id', 'required' => false)),
      'product_id'            => new sfValidatorInteger(array('required' => false)),
      'stock'                 => new sfValidatorInteger(array('required' => false)),
      'free_stock'            => new sfValidatorInteger(array('required' => false)),
      'free_stock_calculated' => new sfValidatorDateTime(array('required' => false)),
      'location_id'           => new sfValidatorInteger(array('required' => false)),
      'owner_id'              => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_stock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductStock';
  }

}
