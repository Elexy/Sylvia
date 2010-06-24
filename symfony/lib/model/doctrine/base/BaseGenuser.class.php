<?php

/**
 * BaseGenuser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property float $id
 * @property string $uid
 * @property integer $raccess_s
 * @property integer $raccess_a
 * @property integer $raccess_v
 * @property integer $raccess_r
 * @property integer $waccess_s
 * @property integer $waccess_a
 * @property integer $waccess_v
 * @property integer $waccess_r
 * @property integer $saccess_s
 * @property integer $saccess_a
 * @property integer $saccess_v
 * @property integer $saccess_r
 * @property integer $supervisor
 * @property string $email
 * @property integer $logon_attempts
 * @property integer $active
 * @property integer $stylesheetid
 * @property integer $deflanguage
 * @property integer $contactid
 * @property integer $employee_id
 * @property string $pwd
 * 
 * @method float   getId()             Returns the current record's "id" value
 * @method string  getUid()            Returns the current record's "uid" value
 * @method integer getRaccessS()       Returns the current record's "raccess_s" value
 * @method integer getRaccessA()       Returns the current record's "raccess_a" value
 * @method integer getRaccessV()       Returns the current record's "raccess_v" value
 * @method integer getRaccessR()       Returns the current record's "raccess_r" value
 * @method integer getWaccessS()       Returns the current record's "waccess_s" value
 * @method integer getWaccessA()       Returns the current record's "waccess_a" value
 * @method integer getWaccessV()       Returns the current record's "waccess_v" value
 * @method integer getWaccessR()       Returns the current record's "waccess_r" value
 * @method integer getSaccessS()       Returns the current record's "saccess_s" value
 * @method integer getSaccessA()       Returns the current record's "saccess_a" value
 * @method integer getSaccessV()       Returns the current record's "saccess_v" value
 * @method integer getSaccessR()       Returns the current record's "saccess_r" value
 * @method integer getSupervisor()     Returns the current record's "supervisor" value
 * @method string  getEmail()          Returns the current record's "email" value
 * @method integer getLogonAttempts()  Returns the current record's "logon_attempts" value
 * @method integer getActive()         Returns the current record's "active" value
 * @method integer getStylesheetid()   Returns the current record's "stylesheetid" value
 * @method integer getDeflanguage()    Returns the current record's "deflanguage" value
 * @method integer getContactid()      Returns the current record's "contactid" value
 * @method integer getEmployeeId()     Returns the current record's "employee_id" value
 * @method string  getPwd()            Returns the current record's "pwd" value
 * @method Genuser setId()             Sets the current record's "id" value
 * @method Genuser setUid()            Sets the current record's "uid" value
 * @method Genuser setRaccessS()       Sets the current record's "raccess_s" value
 * @method Genuser setRaccessA()       Sets the current record's "raccess_a" value
 * @method Genuser setRaccessV()       Sets the current record's "raccess_v" value
 * @method Genuser setRaccessR()       Sets the current record's "raccess_r" value
 * @method Genuser setWaccessS()       Sets the current record's "waccess_s" value
 * @method Genuser setWaccessA()       Sets the current record's "waccess_a" value
 * @method Genuser setWaccessV()       Sets the current record's "waccess_v" value
 * @method Genuser setWaccessR()       Sets the current record's "waccess_r" value
 * @method Genuser setSaccessS()       Sets the current record's "saccess_s" value
 * @method Genuser setSaccessA()       Sets the current record's "saccess_a" value
 * @method Genuser setSaccessV()       Sets the current record's "saccess_v" value
 * @method Genuser setSaccessR()       Sets the current record's "saccess_r" value
 * @method Genuser setSupervisor()     Sets the current record's "supervisor" value
 * @method Genuser setEmail()          Sets the current record's "email" value
 * @method Genuser setLogonAttempts()  Sets the current record's "logon_attempts" value
 * @method Genuser setActive()         Sets the current record's "active" value
 * @method Genuser setStylesheetid()   Sets the current record's "stylesheetid" value
 * @method Genuser setDeflanguage()    Sets the current record's "deflanguage" value
 * @method Genuser setContactid()      Sets the current record's "contactid" value
 * @method Genuser setEmployeeId()     Sets the current record's "employee_id" value
 * @method Genuser setPwd()            Sets the current record's "pwd" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGenuser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('genuser');
        $this->hasColumn('id', 'float', 6, array(
             'type' => 'float',
             'primary' => true,
             'autoincrement' => true,
             'length' => 6,
             ));
        $this->hasColumn('uid', 'string', 50, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('raccess_s', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('raccess_a', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('raccess_v', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('raccess_r', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('waccess_s', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('waccess_a', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('waccess_v', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('waccess_r', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('saccess_s', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('saccess_a', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('saccess_v', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('saccess_r', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('supervisor', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('logon_attempts', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('active', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('stylesheetid', 'integer', 4, array(
             'type' => 'integer',
             'default' => '1',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('deflanguage', 'integer', 4, array(
             'type' => 'integer',
             'default' => '1',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('contactid', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('employee_id', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('pwd', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}