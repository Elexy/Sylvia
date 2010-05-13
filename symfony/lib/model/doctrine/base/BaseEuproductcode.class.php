<?php

/**
 * BaseEuproductcode
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $euproductcode
 * @property float $taxrate
 * 
 * @method integer       getEuproductcode() Returns the current record's "euproductcode" value
 * @method float         getTaxrate()       Returns the current record's "taxrate" value
 * @method Euproductcode setEuproductcode() Sets the current record's "euproductcode" value
 * @method Euproductcode setTaxrate()       Sets the current record's "taxrate" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEuproductcode extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('euproductcode');
        $this->hasColumn('euproductcode', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('taxrate', 'float', 6, array(
             'type' => 'float',
             'unsigned' => 1,
             'notnull' => true,
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}