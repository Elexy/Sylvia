<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasePoDetails extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('po_details');
        $this->hasColumn('podetailsid', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('poid', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'length' => '4'));
        $this->hasColumn('productid', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('unitprice', 'decimal', 10, array('type' => 'decimal', 'default' => '0.0000', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('to_deliver', 'integer', 4, array('type' => 'integer', 'default' => '0', 'length' => '4'));
        $this->hasColumn('tax_percentage', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'notnull' => true, 'scale' => false, 'length' => '10'));
        $this->hasColumn('added_cost', 'float', 2147483647, array('type' => 'float', 'default' => '0', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('podate', 'date', 25, array('type' => 'date', 'length' => '25'));
        $this->hasColumn('quantity', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('last_exp', 'date', 25, array('type' => 'date', 'length' => '25'));
        $this->hasColumn('comments', 'string', 50, array('type' => 'string', 'length' => '50'));
    }

}