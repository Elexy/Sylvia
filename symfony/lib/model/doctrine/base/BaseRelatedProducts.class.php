<?php

/**
 * BaseRelatedProducts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $productid1
 * @property integer $productid2
 * 
 * @method integer         getProductid1() Returns the current record's "productid1" value
 * @method integer         getProductid2() Returns the current record's "productid2" value
 * @method RelatedProducts setProductid1() Sets the current record's "productid1" value
 * @method RelatedProducts setProductid2() Sets the current record's "productid2" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRelatedProducts extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('related_products');
        $this->hasColumn('productid1', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('productid2', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}