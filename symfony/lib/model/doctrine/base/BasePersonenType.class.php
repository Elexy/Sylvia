<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasePersonenType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Personen_type');
        $this->hasColumn('personen_type_id', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('desctription', 'string', 15, array('type' => 'string', 'default' => '0', 'notnull' => true, 'length' => '15'));
    }

}