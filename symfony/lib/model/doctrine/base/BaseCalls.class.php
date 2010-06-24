<?php

/**
 * BaseCalls
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $callid
 * @property integer $employee
 * @property timestamp $dummy
 * @property integer $contactid
 * @property timestamp $calldate
 * @property timestamp $calltime
 * @property string $subject
 * @property string $notes
 * 
 * @method integer   getCallid()    Returns the current record's "callid" value
 * @method integer   getEmployee()  Returns the current record's "employee" value
 * @method timestamp getDummy()     Returns the current record's "dummy" value
 * @method integer   getContactid() Returns the current record's "contactid" value
 * @method timestamp getCalldate()  Returns the current record's "calldate" value
 * @method timestamp getCalltime()  Returns the current record's "calltime" value
 * @method string    getSubject()   Returns the current record's "subject" value
 * @method string    getNotes()     Returns the current record's "notes" value
 * @method Calls     setCallid()    Sets the current record's "callid" value
 * @method Calls     setEmployee()  Sets the current record's "employee" value
 * @method Calls     setDummy()     Sets the current record's "dummy" value
 * @method Calls     setContactid() Sets the current record's "contactid" value
 * @method Calls     setCalldate()  Sets the current record's "calldate" value
 * @method Calls     setCalltime()  Sets the current record's "calltime" value
 * @method Calls     setSubject()   Sets the current record's "subject" value
 * @method Calls     setNotes()     Sets the current record's "notes" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCalls extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('calls');
        $this->hasColumn('callid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('employee', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('contactid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('calldate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('calltime', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('subject', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
        $this->hasColumn('notes', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}