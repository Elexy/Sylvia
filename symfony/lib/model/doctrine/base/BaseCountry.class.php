<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseCountry extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('country');
        $this->hasColumn('code', 'string', 2, array('type' => 'string', 'fixed' => 1, 'primary' => true, 'length' => '2'));
        $this->hasColumn('country', 'string', 50, array('type' => 'string', 'default' => '0', 'notnull' => true, 'length' => '50'));
        $this->hasColumn('eu_country', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'default' => '0', 'length' => '1'));
        $this->hasColumn('iso_code', 'string', 3, array('type' => 'string', 'fixed' => 1, 'length' => '3'));
        $this->hasColumn('zipcode_format', 'string', 10, array('type' => 'string', 'length' => '10'));
    }

}