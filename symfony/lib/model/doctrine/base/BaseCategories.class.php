<?php

/**
 * BaseCategories
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $categoryid
 * @property integer $parentid
 * @property integer $public
 * @property string $categoryname
 * 
 * @method integer    getCategoryid()   Returns the current record's "categoryid" value
 * @method integer    getParentid()     Returns the current record's "parentid" value
 * @method integer    getPublic()       Returns the current record's "public" value
 * @method string     getCategoryname() Returns the current record's "categoryname" value
 * @method Categories setCategoryid()   Sets the current record's "categoryid" value
 * @method Categories setParentid()     Sets the current record's "parentid" value
 * @method Categories setPublic()       Sets the current record's "public" value
 * @method Categories setCategoryname() Sets the current record's "categoryname" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCategories extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('categories');
        $this->hasColumn('categoryid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('parentid', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('public', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('categoryname', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}