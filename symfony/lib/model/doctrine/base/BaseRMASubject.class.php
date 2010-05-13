<?php

/**
 * BaseRMASubject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $subject_id
 * @property string $subject_text
 * 
 * @method integer    getSubjectId()    Returns the current record's "subject_id" value
 * @method string     getSubjectText()  Returns the current record's "subject_text" value
 * @method RMASubject setSubjectId()    Sets the current record's "subject_id" value
 * @method RMASubject setSubjectText()  Sets the current record's "subject_text" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRMASubject extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('RMA_subject');
        $this->hasColumn('subject_id', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 1,
             ));
        $this->hasColumn('subject_text', 'string', 25, array(
             'type' => 'string',
             'default' => '0',
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}