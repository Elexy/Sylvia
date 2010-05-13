<?php

/**
 * BaseMultiArticles
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $multi_id
 * @property timestamp $dummy
 * @property string $product_ids
 * 
 * @method integer       getMultiId()     Returns the current record's "multi_id" value
 * @method timestamp     getDummy()       Returns the current record's "dummy" value
 * @method string        getProductIds()  Returns the current record's "product_ids" value
 * @method MultiArticles setMultiId()     Sets the current record's "multi_id" value
 * @method MultiArticles setDummy()       Sets the current record's "dummy" value
 * @method MultiArticles setProductIds()  Sets the current record's "product_ids" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMultiArticles extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('multi_articles');
        $this->hasColumn('multi_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('product_ids', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}