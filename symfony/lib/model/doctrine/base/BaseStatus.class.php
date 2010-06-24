<?php

/**
 * BaseStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $statusid
 * @property string $statustext
 * @property integer $category
 * 
 * @method integer getStatusid()   Returns the current record's "statusid" value
 * @method string  getStatustext() Returns the current record's "statustext" value
 * @method integer getCategory()   Returns the current record's "category" value
 * @method Status  setStatusid()   Sets the current record's "statusid" value
 * @method Status  setStatustext() Sets the current record's "statustext" value
 * @method Status  setCategory()   Sets the current record's "category" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStatus extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('status');
        $this->hasColumn('statusid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('statustext', 'string', 40, array(
             'type' => 'string',
             'default' => '0',
             'length' => 40,
             ));
        $this->hasColumn('category', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}