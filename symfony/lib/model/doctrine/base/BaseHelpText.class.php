<?php

/**
 * BaseHelpText
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $file
 * @property string $title
 * @property string $text_dutch
 * @property integer $last_changed_by
 * @property timestamp $change_date
 * 
 * @method integer   getId()              Returns the current record's "id" value
 * @method string    getFile()            Returns the current record's "file" value
 * @method string    getTitle()           Returns the current record's "title" value
 * @method string    getTextDutch()       Returns the current record's "text_dutch" value
 * @method integer   getLastChangedBy()   Returns the current record's "last_changed_by" value
 * @method timestamp getChangeDate()      Returns the current record's "change_date" value
 * @method HelpText  setId()              Sets the current record's "id" value
 * @method HelpText  setFile()            Sets the current record's "file" value
 * @method HelpText  setTitle()           Sets the current record's "title" value
 * @method HelpText  setTextDutch()       Sets the current record's "text_dutch" value
 * @method HelpText  setLastChangedBy()   Sets the current record's "last_changed_by" value
 * @method HelpText  setChangeDate()      Sets the current record's "change_date" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHelpText extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('help_text');
        $this->hasColumn('id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 2,
             ));
        $this->hasColumn('file', 'string', 30, array(
             'type' => 'string',
             'default' => '0',
             'notnull' => true,
             'length' => 30,
             ));
        $this->hasColumn('title', 'string', 100, array(
             'type' => 'string',
             'default' => '0',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('text_dutch', 'string', 6, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 6,
             ));
        $this->hasColumn('last_changed_by', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('change_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}