<?php

/**
 * BaseGuestbook
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property timestamp $entrydate
 * @property string $comment
 * 
 * @method integer   getId()        Returns the current record's "id" value
 * @method string    getName()      Returns the current record's "name" value
 * @method timestamp getEntrydate() Returns the current record's "entrydate" value
 * @method string    getComment()   Returns the current record's "comment" value
 * @method Guestbook setId()        Sets the current record's "id" value
 * @method Guestbook setName()      Sets the current record's "name" value
 * @method Guestbook setEntrydate() Sets the current record's "entrydate" value
 * @method Guestbook setComment()   Sets the current record's "comment" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGuestbook extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('guestbook');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('entrydate', 'timestamp', 25, array(
             'type' => 'timestamp',
             'default' => '0000-00-00 00:00:00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('comment', 'string', 6, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}