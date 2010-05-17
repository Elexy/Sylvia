<?php

/**
 * BaseRMAActions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $actionid
 * @property timestamp $dummy
 * @property integer $employee
 * @property integer $rmaid
 * @property timestamp $actiondate
 * @property timestamp $actiontime
 * @property integer $subject
 * @property string $notes
 * @property string $webuser
 * 
 * @method integer    getActionid()   Returns the current record's "actionid" value
 * @method timestamp  getDummy()      Returns the current record's "dummy" value
 * @method integer    getEmployee()   Returns the current record's "employee" value
 * @method integer    getRmaid()      Returns the current record's "rmaid" value
 * @method timestamp  getActiondate() Returns the current record's "actiondate" value
 * @method timestamp  getActiontime() Returns the current record's "actiontime" value
 * @method integer    getSubject()    Returns the current record's "subject" value
 * @method string     getNotes()      Returns the current record's "notes" value
 * @method string     getWebuser()    Returns the current record's "webuser" value
 * @method RMAActions setActionid()   Sets the current record's "actionid" value
 * @method RMAActions setDummy()      Sets the current record's "dummy" value
 * @method RMAActions setEmployee()   Sets the current record's "employee" value
 * @method RMAActions setRmaid()      Sets the current record's "rmaid" value
 * @method RMAActions setActiondate() Sets the current record's "actiondate" value
 * @method RMAActions setActiontime() Sets the current record's "actiontime" value
 * @method RMAActions setSubject()    Sets the current record's "subject" value
 * @method RMAActions setNotes()      Sets the current record's "notes" value
 * @method RMAActions setWebuser()    Sets the current record's "webuser" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRMAActions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('RMA_actions');
        $this->hasColumn('actionid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('employee', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('rmaid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('actiondate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('actiontime', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('subject', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('notes', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
        $this->hasColumn('webuser', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}