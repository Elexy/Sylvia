<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseRMAActions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('RMA_actions');
        $this->hasColumn('actionid', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('dummy', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
        $this->hasColumn('employee', 'integer', 1, array('type' => 'integer', 'unsigned' => '1', 'length' => '1'));
        $this->hasColumn('rmaid', 'integer', 4, array('type' => 'integer', 'length' => '4'));
        $this->hasColumn('actiondate', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('actiontime', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
        $this->hasColumn('subject', 'integer', 1, array('type' => 'integer', 'length' => '1'));
        $this->hasColumn('notes', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
        $this->hasColumn('webuser', 'string', 30, array('type' => 'string', 'length' => '30'));
    }

}