<?php

/**
 * BaseSwitchboardItems
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $itemnumber
 * @property timestamp $dummy
 * @property integer $switchboardid
 * @property string $itemtext
 * @property integer $command
 * @property string $argument
 * 
 * @method integer          getId()            Returns the current record's "id" value
 * @method integer          getItemnumber()    Returns the current record's "itemnumber" value
 * @method timestamp        getDummy()         Returns the current record's "dummy" value
 * @method integer          getSwitchboardid() Returns the current record's "switchboardid" value
 * @method string           getItemtext()      Returns the current record's "itemtext" value
 * @method integer          getCommand()       Returns the current record's "command" value
 * @method string           getArgument()      Returns the current record's "argument" value
 * @method SwitchboardItems setId()            Sets the current record's "id" value
 * @method SwitchboardItems setItemnumber()    Sets the current record's "itemnumber" value
 * @method SwitchboardItems setDummy()         Sets the current record's "dummy" value
 * @method SwitchboardItems setSwitchboardid() Sets the current record's "switchboardid" value
 * @method SwitchboardItems setItemtext()      Sets the current record's "itemtext" value
 * @method SwitchboardItems setCommand()       Sets the current record's "command" value
 * @method SwitchboardItems setArgument()      Sets the current record's "argument" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSwitchboardItems extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('switchboard_items');
        $this->hasColumn('id', 'integer', 20, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             'length' => 20,
             ));
        $this->hasColumn('itemnumber', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 2,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('switchboardid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('itemtext', 'string', 35, array(
             'type' => 'string',
             'length' => 35,
             ));
        $this->hasColumn('command', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             ));
        $this->hasColumn('argument', 'string', 35, array(
             'type' => 'string',
             'length' => 35,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}