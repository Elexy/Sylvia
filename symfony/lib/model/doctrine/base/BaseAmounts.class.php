<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseAmounts extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('amounts');
        $this->hasColumn('id', 'integer', 1, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '1'));
        $this->hasColumn('value', 'decimal', 10, array('type' => 'decimal', 'default' => '0.00', 'scale' => false, 'length' => '10'));
        $this->hasColumn('description', 'string', 25, array('type' => 'string', 'length' => '25'));
    }

}