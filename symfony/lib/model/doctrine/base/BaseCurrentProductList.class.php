<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseCurrentProductList extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('current_product_list');
        $this->hasColumn('productid', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('categoryid', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'length' => '1'));
        $this->hasColumn('subcategoryid', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('purchase_price_foreign', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('purchase_price_home', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('extra_cost', 'decimal', 6, array('type' => 'decimal', 'default' => '0.0000', 'notnull' => true, 'scale' => false, 'length' => '6'));
        $this->hasColumn('margin_correction', 'decimal', 6, array('type' => 'decimal', 'default' => '1.0000', 'notnull' => true, 'scale' => false, 'length' => '6'));
        $this->hasColumn('price_discovery', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'scale' => false, 'length' => '10'));
        $this->hasColumn('price_discovery_10', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'scale' => false, 'length' => '10'));
        $this->hasColumn('price_discovery_100', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'scale' => false, 'length' => '10'));
        $this->hasColumn('selling_price', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('selling_price_10', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('selling_price_50', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'scale' => false, 'length' => '10'));
        $this->hasColumn('selling_price_100', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'scale' => false, 'length' => '10'));
        $this->hasColumn('retail_price_ex', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('btw_class', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'length' => '1'));
        $this->hasColumn('euproductcode', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'length' => '4'));
        $this->hasColumn('exp_rating', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'length' => '1'));
        $this->hasColumn('taric', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'length' => '4'));
        $this->hasColumn('ean', 'integer', 8, array('type' => 'integer', 'unsigned' => '1', 'length' => '8'));
        $this->hasColumn('reorder_q', 'integer', 2, array('type' => 'integer', 'unsigned' => '1', 'default' => '1', 'notnull' => true, 'length' => '2'));
        $this->hasColumn('reorderlevel', 'integer', 2, array('type' => 'integer', 'unsigned' => '1', 'length' => '2'));
        $this->hasColumn('leadtime', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'length' => '1'));
        $this->hasColumn('supplier', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('merk', 'string', 35, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '35'));
        $this->hasColumn('merkid', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('pricelist_yn', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'length' => '4'));
        $this->hasColumn('roadking', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('neptune', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'length' => '1'));
        $this->hasColumn('outdoor', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'length' => '1'));
        $this->hasColumn('discontinued_yn', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('externalid', 'string', 30, array('type' => 'string', 'default' => '0', 'notnull' => true, 'length' => '30'));
        $this->hasColumn('currency', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'default' => '2', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('weight_corr', 'decimal', 10, array('type' => 'decimal', 'scale' => false, 'length' => '10'));
        $this->hasColumn('dummy', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
        $this->hasColumn('sku', 'integer', 1, array('type' => 'integer', 'default' => '1', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('old_location_id', 'integer', 2, array('type' => 'integer', 'unsigned' => '1', 'length' => '2'));
        $this->hasColumn('special', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('public', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('store_serial_yn', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('productname', 'string', 255, array('type' => 'string', 'length' => '255'));
        $this->hasColumn('productdescription', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
        $this->hasColumn('old_stock', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('last_exp', 'date', 25, array('type' => 'date', 'length' => '25'));
        $this->hasColumn('image', 'string', 10, array('type' => 'string', 'length' => '10'));
    }

}