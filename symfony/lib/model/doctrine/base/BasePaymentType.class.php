<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasePaymentType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('payment_type');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('dummy', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
        $this->hasColumn('payment_name', 'string', 50, array('type' => 'string', 'length' => '50'));
    }

}