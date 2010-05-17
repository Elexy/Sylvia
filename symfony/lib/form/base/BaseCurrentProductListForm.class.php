<?php

/**
 * CurrentProductList form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCurrentProductListForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'              => new sfWidgetFormInputHidden(),
      'categoryid'             => new sfWidgetFormInputText(),
      'subcategoryid'          => new sfWidgetFormInputText(),
      'productname'            => new sfWidgetFormInputText(),
      'productdescription'     => new sfWidgetFormTextarea(),
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
      'old_stock'              => new sfWidgetFormInputText(),
      'last_exp'               => new sfWidgetFormDate(),
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
      'sku'                    => new sfWidgetFormInputText(),
      'old_location_id'        => new sfWidgetFormInputText(),
      'special'                => new sfWidgetFormInputText(),
      'publish'                => new sfWidgetFormInputText(),
      'store_serial_yn'        => new sfWidgetFormInputText(),
      'image'                  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'productid'              => new sfValidatorPropelChoice(array('model' => 'CurrentProductList', 'column' => 'productid', 'required' => false)),
      'categoryid'             => new sfValidatorInteger(array('required' => false)),
      'subcategoryid'          => new sfValidatorInteger(),
      'productname'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'productdescription'     => new sfValidatorString(array('required' => false)),
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
      'old_stock'              => new sfValidatorInteger(array('required' => false)),
      'last_exp'               => new sfValidatorDate(array('required' => false)),
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
      'sku'                    => new sfValidatorInteger(),
      'old_location_id'        => new sfValidatorInteger(array('required' => false)),
      'special'                => new sfValidatorInteger(),
      'publish'                => new sfValidatorInteger(),
      'store_serial_yn'        => new sfValidatorInteger(),
      'image'                  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'CurrentProductList', 'column' => array('ean')))
    );

    $this->widgetSchema->setNameFormat('current_product_list[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrentProductList';
  }


}
