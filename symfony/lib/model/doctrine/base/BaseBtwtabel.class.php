<?php

/**
 * BaseBtwtabel
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $btw_class
 * @property integer $btwpercentage
 * 
 * @method integer  getBtwClass()      Returns the current record's "btw_class" value
 * @method integer  getBtwpercentage() Returns the current record's "btwpercentage" value
 * @method Btwtabel setBtwClass()      Sets the current record's "btw_class" value
 * @method Btwtabel setBtwpercentage() Sets the current record's "btwpercentage" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBtwtabel extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('btwtabel');
        $this->hasColumn('btw_class', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 1,
             ));
        $this->hasColumn('btwpercentage', 'integer', 1, array(
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