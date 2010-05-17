<?php

/**
 * BaseBranches
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $branchecontactid
 * @property integer $maincontactid
 * 
 * @method integer  getBranchecontactid() Returns the current record's "branchecontactid" value
 * @method integer  getMaincontactid()    Returns the current record's "maincontactid" value
 * @method Branches setBranchecontactid() Sets the current record's "branchecontactid" value
 * @method Branches setMaincontactid()    Sets the current record's "maincontactid" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBranches extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('branches');
        $this->hasColumn('branchecontactid', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('maincontactid', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}