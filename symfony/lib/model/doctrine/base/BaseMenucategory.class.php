<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseMenucategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('menucategory');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('name', 'string', 50, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '50'));
        $this->hasColumn('orderflag', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('menu', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('access_s', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('access_a', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('access_v', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('access_r', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('setup_s', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('setup_a', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('setup_v', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('setup_r', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('supervisor', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('nonsupervisor', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('extvend', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('extcust', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('nonext', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('companyid', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'notnull' => true, 'length' => '1'));
        $this->hasColumn('description', 'blob', 2147483647, array('type' => 'blob', 'length' => '2147483647'));
    }

}