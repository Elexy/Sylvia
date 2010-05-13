<?php

/**
 * CurrentProductList form base class.
 *
 * @package    form
 * @subpackage current_product_list
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCurrentProductListForm extends BaseFormDoctrine
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
      'productdescription'     => new sfWidgetFormTextarea(),
      'old_stock'              => new sfWidgetFormInputText(),
      'last_exp'               => new sfWidgetFormDate(),
      'image'                  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'productid'              => new sfValidatorDoctrineChoice(array('model' => 'CurrentProductList', 'column' => 'productid', 'required' => false)),
      'categoryid'             => new sfValidatorInteger(array('required' => false)),
      'subcategoryid'          => new sfValidatorInteger(),
      'purchase_price_foreign' => new sfValidatorNumber(),
      'purchase_price_home'    => new sfValidatorNumber(),
      'extra_cost'             => new sfValidatorNumber(),
      'margin_correction'      => new sfValidatorNumber(),
      'price_discovery'        => new sfValidatorNumber(array('required' => false)),
      'price_discovery_10'     => new sfValidatorNumber(array('required' => false)),
      'price_discovery_100'    => new sfValidatorNumber(array('required' => false)),
      'selling_price'          => new sfValidatorNumber(),
      'selling_price_10'       => new sfValidatorNumber(),
      'selling_price_50'       => new sfValidatorNumber(array('required' => false)),
      'selling_price_100'      => new sfValidatorNumber(array('required' => false)),
      'retail_price_ex'        => new sfValidatorNumber(),
      'btw_class'              => new sfValidatorInteger(array('required' => false)),
      'euproductcode'          => new sfValidatorInteger(array('required' => false)),
      'exp_rating'             => new sfValidatorInteger(array('required' => false)),
      'taric'                  => new sfValidatorInteger(array('required' => false)),
      'ean'                    => new sfValidatorInteger(array('required' => false)),
      'reorder_q'              => new sfValidatorInteger(),
      'reorderlevel'           => new sfValidatorInteger(array('required' => false)),
      'leadtime'               => new sfValidatorInteger(array('required' => false)),
      'supplier'               => new sfValidatorInteger(),
      'merk'                   => new sfValidatorString(array('max_length' => 35)),
      'merkid'                 => new sfValidatorInteger(),
      'pricelist_yn'           => new sfValidatorInteger(array('required' => false)),
      'roadking'               => new sfValidatorInteger(),
      'neptune'                => new sfValidatorInteger(array('required' => false)),
      'outdoor'                => new sfValidatorInteger(array('required' => false)),
      'discontinued_yn'        => new sfValidatorInteger(),
      'externalid'             => new sfValidatorString(array('max_length' => 30)),
      'currency'               => new sfValidatorInteger(),
      'weight_corr'            => new sfValidatorNumber(array('required' => false)),
      'dummy'                  => new sfValidatorDateTime(),
      'sku'                    => new sfValidatorInteger(),
      'old_location_id'        => new sfValidatorInteger(array('required' => false)),
      'special'                => new sfValidatorInteger(),
      'public'                 => new sfValidatorInteger(),
      'store_serial_yn'        => new sfValidatorInteger(),
      'productname'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription'     => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'old_stock'              => new sfValidatorInteger(array('required' => false)),
      'last_exp'               => new sfValidatorDate(array('required' => false)),
      'image'                  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('current_product_list[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrentProductList';
  }

}