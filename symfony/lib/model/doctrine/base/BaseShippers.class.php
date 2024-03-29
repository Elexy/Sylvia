<?php

/**
 * BaseShippers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $shipperid
 * @property string $companyname
 * @property string $phone
 * 
 * @method integer  getShipperid()   Returns the current record's "shipperid" value
 * @method string   getCompanyname() Returns the current record's "companyname" value
 * @method string   getPhone()       Returns the current record's "phone" value
 * @method Shippers setShipperid()   Sets the current record's "shipperid" value
 * @method Shippers setCompanyname() Sets the current record's "companyname" value
 * @method Shippers setPhone()       Sets the current record's "phone" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseShippers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('shippers');
        $this->hasColumn('shipperid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('companyname', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('phone', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}