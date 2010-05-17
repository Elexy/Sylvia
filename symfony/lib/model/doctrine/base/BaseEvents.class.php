<?php

/**
 * BaseEvents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property timestamp $created
 * @property integer $created_by
 * @property timestamp $updated_at
 * @property integer $updated_by
 * @property timestamp $publish_up
 * @property timestamp $publish_down
 * @property string $link
 * @property string $image
 * @property integer $reccurtype
 * @property string $reccurtimes
 * @property string $reccurtimesinterval
 * @property string $reccurday
 * @property string $reccurweekdays
 * @property string $reccurweeks
 * @property timestamp $action_performed_date
 * @property integer $action_done_by
 * @property integer $approved
 * @property string $functionname
 * @property integer $cronjob_yn
 * 
 * @method integer   getId()                    Returns the current record's "id" value
 * @method string    getTitle()                 Returns the current record's "title" value
 * @method string    getDescription()           Returns the current record's "description" value
 * @method timestamp getCreated()               Returns the current record's "created" value
 * @method integer   getCreatedBy()             Returns the current record's "created_by" value
 * @method timestamp getUpdatedAt()             Returns the current record's "updated_at" value
 * @method integer   getUpdatedBy()             Returns the current record's "updated_by" value
 * @method timestamp getPublishUp()             Returns the current record's "publish_up" value
 * @method timestamp getPublishDown()           Returns the current record's "publish_down" value
 * @method string    getLink()                  Returns the current record's "link" value
 * @method string    getImage()                 Returns the current record's "image" value
 * @method integer   getReccurtype()            Returns the current record's "reccurtype" value
 * @method string    getReccurtimes()           Returns the current record's "reccurtimes" value
 * @method string    getReccurtimesinterval()   Returns the current record's "reccurtimesinterval" value
 * @method string    getReccurday()             Returns the current record's "reccurday" value
 * @method string    getReccurweekdays()        Returns the current record's "reccurweekdays" value
 * @method string    getReccurweeks()           Returns the current record's "reccurweeks" value
 * @method timestamp getActionPerformedDate()   Returns the current record's "action_performed_date" value
 * @method integer   getActionDoneBy()          Returns the current record's "action_done_by" value
 * @method integer   getApproved()              Returns the current record's "approved" value
 * @method string    getFunctionname()          Returns the current record's "functionname" value
 * @method integer   getCronjobYn()             Returns the current record's "cronjob_yn" value
 * @method Events    setId()                    Sets the current record's "id" value
 * @method Events    setTitle()                 Sets the current record's "title" value
 * @method Events    setDescription()           Sets the current record's "description" value
 * @method Events    setCreated()               Sets the current record's "created" value
 * @method Events    setCreatedBy()             Sets the current record's "created_by" value
 * @method Events    setUpdatedAt()             Sets the current record's "updated_at" value
 * @method Events    setUpdatedBy()             Sets the current record's "updated_by" value
 * @method Events    setPublishUp()             Sets the current record's "publish_up" value
 * @method Events    setPublishDown()           Sets the current record's "publish_down" value
 * @method Events    setLink()                  Sets the current record's "link" value
 * @method Events    setImage()                 Sets the current record's "image" value
 * @method Events    setReccurtype()            Sets the current record's "reccurtype" value
 * @method Events    setReccurtimes()           Sets the current record's "reccurtimes" value
 * @method Events    setReccurtimesinterval()   Sets the current record's "reccurtimesinterval" value
 * @method Events    setReccurday()             Sets the current record's "reccurday" value
 * @method Events    setReccurweekdays()        Sets the current record's "reccurweekdays" value
 * @method Events    setReccurweeks()           Sets the current record's "reccurweeks" value
 * @method Events    setActionPerformedDate()   Sets the current record's "action_performed_date" value
 * @method Events    setActionDoneBy()          Sets the current record's "action_done_by" value
 * @method Events    setApproved()              Sets the current record's "approved" value
 * @method Events    setFunctionname()          Sets the current record's "functionname" value
 * @method Events    setCronjobYn()             Sets the current record's "cronjob_yn" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('events');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('title', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('description', 'string', 120, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 120,
             ));
        $this->hasColumn('created', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('created_by', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('updated_by', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('publish_up', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('publish_down', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('link', 'string', 50, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('image', 'string', 50, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('reccurtype', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('reccurtimes', 'string', 255, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('reccurtimesinterval', 'string', 7, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 7,
             ));
        $this->hasColumn('reccurday', 'string', 4, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('reccurweekdays', 'string', 20, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('reccurweeks', 'string', 10, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 10,
             ));
        $this->hasColumn('action_performed_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('action_done_by', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('approved', 'integer', 1, array(
             'type' => 'integer',
             'default' => '1',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('functionname', 'string', 255, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('cronjob_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}