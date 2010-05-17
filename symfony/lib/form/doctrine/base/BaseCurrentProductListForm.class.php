<?php

/**
 * CurrentProductList form base class.
 *
 * @method CurrentProductList getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCurrentProductListForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'              => new sfWidgetFormInputHidden(),
      'categoryid'             => new sfWidgetFormInputText(),
      'subcategoryid'          => new sfWidgetFormInputText(),
      'purchase_price_foreign' => new sfWidgetFormInputText(),
      'purchase_price_home'    => new sfWidgetFormInputText(),
      'extra_cost'             => new sfWidgetFormInputText(),
      'margin_correction'      => new sfWidgetFormInputText(),
      'price_discovery'        => new sfWidgetFormInputText(),
      'price_discovery_10'     => new sfWidgetFormInputText(),
      'price_discovery_100'    => new sfWidgetFormInputText(),
      'selling_price'          => new sfWidgetFormInputText(),
      'selling_price_10'       => new sfWidgetFormInputText(),
      'selling_price_50'       => new sfWidgetFormInputText(),
      'selling_price_100'      => new sfWidgetFormInputText(),
      'retail_price_ex'        => new sfWidgetFormInputText(),
      'btw_class'              => new sfWidgetFormInputText(),
      'euproductcode'          => new sfWidgetFormInputText(),
      'exp_rating'             => new sfWidgetFormInputText(),
      'taric'                  => new sfWidgetFormInputText(),
      'ean'                    => new sfWidgetFormInputText(),
      'reorder_q'              => new sfWidgetFormInputText(),
      'reorderlevel'           => new sfWidgetFormInputText(),
      'leadtime'               => new sfWidgetFormInputText(),
      'supplier'               => new sfWidgetFormInputText(),
      'merk'                   => new sfWidgetFormInputText(),
      'merkid'                 => new sfWidgetFormInputText(),
      'pricelist_yn'           => new sfWidgetFormInputText(),
      'roadking'               => new sfWidgetFormInputText(),
      'neptune'                => new sfWidgetFormInputText(),
      'outdoor'                => new sfWidgetFormInputText(),
      'discontinued_yn'        => new sfWidgetFormInputText(),
      'externalid'             => new sfWidgetFormInputText(),
      'currency'               => new sfWidgetFormInputText(),
      'weight_corr'            => new sfWidgetFormInputText(),
      'dummy'                  => new sfWidgetFormDateTime(),
      'sku'                    => new sfWidgetFormInputText(),
      'old_location_id'        => new sfWidgetFormInputText(),
      'special'                => new sfWidgetFormInputText(),
      'public'                 => new sfWidgetFormInputText(),
      'store_serial_yn'        => new sfWidgetFormInputText(),
      'productname'            => new sfWidgetFormInputText(),
      'productdescription'     => new sfWidgetFormInputText(),
      'old_stock'              => new sfWidgetFormInputText(),
      'last_exp'               => new sfWidgetFormDate(),
      'image'                  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'productid'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'productid', 'required' => false)),
      'categoryid'             => new sfValidatorInteger(array('required' => false)),
      'subcategoryid'          => new sfValidatorInteger(array('required' => false)),
      'purchase_price_foreign' => new sfValidatorNumber(array('required' => false)),
      'purchase_price_home'    => new sfValidatorNumber(array('required' => false)),
      'extra_cost'             => new sfValidatorNumber(array('required' => false)),
      'margin_correction'      => new sfValidatorNumber(array('required' => false)),
      'price_discovery'        => new sfValidatorNumber(array('required' => false)),
      'price_discovery_10'     => new sfValidatorNumber(array('required' => false)),
      'price_discovery_100'    => new sfValidatorNumber(array('required' => false)),
      'selling_price'          => new sfValidatorNumber(array('required' => false)),
      'selling_price_10'       => new sfValidatorNumber(array('required' => false)),
      'selling_price_50'       => new sfValidatorNumber(array('required' => false)),
      'selling_price_100'      => new sfValidatorNumber(array('required' => false)),
      'retail_price_ex'        => new sfValidatorNumber(array('required' => false)),
      'btw_class'              => new sfValidatorInteger(array('required' => false)),
      'euproductcode'          => new sfValidatorInteger(array('required' => false)),
      'exp_rating'             => new sfValidatorInteger(array('required' => false)),
      'taric'                  => new sfValidatorInteger(array('required' => false)),
      'ean'                    => new sfValidatorInteger(array('required' => false)),
      'reorder_q'              => new sfValidatorInteger(array('required' => false)),
      'reorderlevel'           => new sfValidatorInteger(array('required' => false)),
      'leadtime'               => new sfValidatorInteger(array('required' => false)),
      'supplier'               => new sfValidatorInteger(array('required' => false)),
      'merk'                   => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'merkid'                 => new sfValidatorInteger(array('required' => false)),
      'pricelist_yn'           => new sfValidatorInteger(array('required' => false)),
      'roadking'               => new sfValidatorInteger(array('required' => false)),
      'neptune'                => new sfValidatorInteger(array('required' => false)),
      'outdoor'                => new sfValidatorInteger(array('required' => false)),
      'discontinued_yn'        => new sfValidatorInteger(array('required' => false)),
      'externalid'             => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'currency'               => new sfValidatorInteger(array('required' => false)),
      'weight_corr'            => new sfValidatorNumber(array('required' => false)),
      'dummy'                  => new sfValidatorDateTime(),
      'sku'                    => new sfValidatorInteger(array('required' => false)),
      'old_location_id'        => new sfValidatorInteger(array('required' => false)),
      'special'                => new sfValidatorInteger(array('required' => false)),
      'public'                 => new sfValidatorInteger(array('required' => false)),
      'store_serial_yn'        => new sfValidatorInteger(array('required' => false)),
      'productname'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription'     => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'old_stock'              => new sfValidatorInteger(array('required' => false)),
      'last_exp'               => new sfValidatorDate(array('required' => false)),
      'image'                  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('current_product_list[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrentProductList';
  }

}
