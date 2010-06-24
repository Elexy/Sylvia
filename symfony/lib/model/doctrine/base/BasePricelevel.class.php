<?php

/**
 * BasePricelevel
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $level
 * @property string $description
 * 
 * @method integer    getId()          Returns the current record's "id" value
 * @method integer    getLevel()       Returns the current record's "level" value
 * @method string     getDescription() Returns the current record's "description" value
 * @method Pricelevel setId()          Sets the current record's "id" value
 * @method Pricelevel setLevel()       Sets the current record's "level" value
 * @method Pricelevel setDescription() Sets the current record's "description" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePricelevel extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pricelevel');
        $this->hasColumn('id', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 1,
             ));
        $this->hasColumn('level', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('description', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}