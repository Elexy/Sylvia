<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseOrdercostType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ordercost_type');
        $this->hasColumn('ordercostid', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '1'));
        $this->hasColumn('description', 'string', 25, array('type' => 'string', 'fixed' => 1, 'default' => '', 'notnull' => true, 'length' => '25'));
        $this->hasColumn('webordercost', 'float', 2147483647, array('type' => 'float', 'default' => '12.5', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('minweborderamount', 'float', 2147483647, array('type' => 'float', 'default' => '300', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('ordercost', 'float', 2147483647, array('type' => 'float', 'default' => '13.5', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('minorderamount', 'float', 2147483647, array('type' => 'float', 'default' => '400', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('shippingcost', 'float', 2147483647, array('type' => 'float', 'default' => '5', 'notnull' => true, 'length' => '2147483647'));
        $this->hasColumn('realcost', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
    }

}