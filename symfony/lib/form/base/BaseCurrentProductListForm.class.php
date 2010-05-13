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
      'categoryid'             => new sfWidgetFormInput(),
      'subcategoryid'          => new sfWidgetFormInput(),
      'productname'            => new sfWidgetFormInput(),
      'productdescription'     => new sfWidgetFormTextarea(),
      'purchase_price_foreign' => new sfWidgetFormInput(),
      'purchase_price_home'    => new sfWidgetFormInput(),
      'extra_cost'             => new sfWidgetFormInput(),
      'margin_correction'      => new sfWidgetFormInput(),
      'price_discovery'        => new sfWidgetFormInput(),
      'price_discovery_10'     => new sfWidgetFormInput(),
      'price_discovery_100'    => new sfWidgetFormInput(),
      'selling_price'          => new sfWidgetFormInput(),
      'selling_price_10'       => new sfWidgetFormInput(),
      'selling_price_50'       => new sfWidgetFormInput(),
      'selling_price_100'      => new sfWidgetFormInput(),
      'retail_price_ex'        => new sfWidgetFormInput(),
      'btw_class'              => new sfWidgetFormInput(),
      'euproductcode'          => new sfWidgetFormInput(),
      'old_stock'              => new sfWidgetFormInput(),
      'last_exp'               => new sfWidgetFormDate(),
      'exp_rating'             => new sfWidgetFormInput(),
      'taric'                  => new sfWidgetFormInput(),
      'ean'                    => new sfWidgetFormInput(),
      'reorder_q'              => new sfWidgetFormInput(),
      'reorderlevel'           => new sfWidgetFormInput(),
      'leadtime'               => new sfWidgetFormInput(),
      'supplier'               => new sfWidgetFormInput(),
      'merk'                   => new sfWidgetFormInput(),
      'merkid'                 => new sfWidgetFormInput(),
      'pricelist_yn'           => new sfWidgetFormInput(),
      'roadking'               => new sfWidgetFormInput(),
      'neptune'                => new sfWidgetFormInput(),
      'outdoor'                => new sfWidgetFormInput(),
      'discontinued_yn'        => new sfWidgetFormInput(),
      'externalid'             => new sfWidgetFormInput(),
      'currency'               => new sfWidgetFormInput(),
      'weight_corr'            => new sfWidgetFormInput(),
      'sku'                    => new sfWidgetFormInput(),
      'old_location_id'        => new sfWidgetFormInput(),
      'special'                => new sfWidgetFormInput(),
      'publish'                => new sfWidgetFormInput(),
      'store_serial_yn'        => new sfWidgetFormInput(),
      'image'                  => new sfWidgetFormInput(),
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
