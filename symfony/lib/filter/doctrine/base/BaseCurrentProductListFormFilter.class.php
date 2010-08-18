<?php

/**
 * CurrentProductList filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCurrentProductListFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid'             => new sfWidgetFormFilterInput(),
      'subcategoryid'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'purchase_price_foreign' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'purchase_price_home'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'extra_cost'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'margin_correction'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price_discovery'        => new sfWidgetFormFilterInput(),
      'price_discovery_10'     => new sfWidgetFormFilterInput(),
      'price_discovery_100'    => new sfWidgetFormFilterInput(),
      'selling_price'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'selling_price_10'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'selling_price_50'       => new sfWidgetFormFilterInput(),
      'selling_price_100'      => new sfWidgetFormFilterInput(),
      'retail_price_ex'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'btw_class'              => new sfWidgetFormFilterInput(),
      'euproductcode'          => new sfWidgetFormFilterInput(),
      'exp_rating'             => new sfWidgetFormFilterInput(),
      'taric'                  => new sfWidgetFormFilterInput(),
      'ean'                    => new sfWidgetFormFilterInput(),
      'reorder_q'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reorderlevel'           => new sfWidgetFormFilterInput(),
      'leadtime'               => new sfWidgetFormFilterInput(),
      'supplier'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'merk'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'merkid'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pricelist_yn'           => new sfWidgetFormFilterInput(),
      'roadking'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'neptune'                => new sfWidgetFormFilterInput(),
      'outdoor'                => new sfWidgetFormFilterInput(),
      'discontinued_yn'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'externalid'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currency'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'weight_corr'            => new sfWidgetFormFilterInput(),
      'dummy'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'sku'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'old_location_id'        => new sfWidgetFormFilterInput(),
      'special'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'public'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'store_serial_yn'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'productname'            => new sfWidgetFormFilterInput(),
      'productdescription'     => new sfWidgetFormFilterInput(),
      'old_stock'              => new sfWidgetFormFilterInput(),
      'last_exp'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'image'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'categoryid'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subcategoryid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'purchase_price_foreign' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'purchase_price_home'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'extra_cost'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'margin_correction'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'price_discovery'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'price_discovery_10'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'price_discovery_100'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'selling_price'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'selling_price_10'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'selling_price_50'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'selling_price_100'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'retail_price_ex'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'btw_class'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'euproductcode'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'exp_rating'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'taric'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ean'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reorder_q'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reorderlevel'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'leadtime'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'supplier'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'merk'                   => new sfValidatorPass(array('required' => false)),
      'merkid'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pricelist_yn'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'roadking'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'neptune'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'outdoor'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'discontinued_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'externalid'             => new sfValidatorPass(array('required' => false)),
      'currency'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'weight_corr'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'dummy'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'sku'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'old_location_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'special'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'public'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'store_serial_yn'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'productname'            => new sfValidatorPass(array('required' => false)),
      'productdescription'     => new sfValidatorPass(array('required' => false)),
      'old_stock'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_exp'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'image'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('current_product_list_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrentProductList';
  }

  public function getFields()
  {
    return array(
      'productid'              => 'Number',
      'categoryid'             => 'Number',
      'subcategoryid'          => 'Number',
      'purchase_price_foreign' => 'Number',
      'purchase_price_home'    => 'Number',
      'extra_cost'             => 'Number',
      'margin_correction'      => 'Number',
      'price_discovery'        => 'Number',
      'price_discovery_10'     => 'Number',
      'price_discovery_100'    => 'Number',
      'selling_price'          => 'Number',
      'selling_price_10'       => 'Number',
      'selling_price_50'       => 'Number',
      'selling_price_100'      => 'Number',
      'retail_price_ex'        => 'Number',
      'btw_class'              => 'Number',
      'euproductcode'          => 'Number',
      'exp_rating'             => 'Number',
      'taric'                  => 'Number',
      'ean'                    => 'Number',
      'reorder_q'              => 'Number',
      'reorderlevel'           => 'Number',
      'leadtime'               => 'Number',
      'supplier'               => 'Number',
      'merk'                   => 'Text',
      'merkid'                 => 'Number',
      'pricelist_yn'           => 'Number',
      'roadking'               => 'Number',
      'neptune'                => 'Number',
      'outdoor'                => 'Number',
      'discontinued_yn'        => 'Number',
      'externalid'             => 'Text',
      'currency'               => 'Number',
      'weight_corr'            => 'Number',
      'dummy'                  => 'Date',
      'sku'                    => 'Number',
      'old_location_id'        => 'Number',
      'special'                => 'Number',
      'public'                 => 'Number',
      'store_serial_yn'        => 'Number',
      'productname'            => 'Text',
      'productdescription'     => 'Text',
      'old_stock'              => 'Number',
      'last_exp'               => 'Date',
      'image'                  => 'Text',
    );
  }
}
