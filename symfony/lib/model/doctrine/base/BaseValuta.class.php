<?php

/**
 * BaseValuta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $valutaid
 * @property string $valutaname
 * @property string $valutanamelong
 * @property decimal $valutaxrate
 * @property date $valutadate
 * @property timestamp $dummy
 * 
 * @method integer   getValutaid()       Returns the current record's "valutaid" value
 * @method string    getValutaname()     Returns the current record's "valutaname" value
 * @method string    getValutanamelong() Returns the current record's "valutanamelong" value
 * @method decimal   getValutaxrate()    Returns the current record's "valutaxrate" value
 * @method date      getValutadate()     Returns the current record's "valutadate" value
 * @method timestamp getDummy()          Returns the current record's "dummy" value
 * @method Valuta    setValutaid()       Sets the current record's "valutaid" value
 * @method Valuta    setValutaname()     Sets the current record's "valutaname" value
 * @method Valuta    setValutanamelong() Sets the current record's "valutanamelong" value
 * @method Valuta    setValutaxrate()    Sets the current record's "valutaxrate" value
 * @method Valuta    setValutadate()     Sets the current record's "valutadate" value
 * @method Valuta    setDummy()          Sets the current record's "dummy" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseValuta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('valuta');
        $this->hasColumn('valutaid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('valutaname', 'string', 3, array(
             'type' => 'string',
             'fixed' => 1,
             'default' => '',
             'notnull' => true,
             'length' => 3,
             ));
        $this->hasColumn('valutanamelong', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'length' => 25,
             ));
        $this->hasColumn('valutaxrate', 'decimal', 7, array(
             'type' => 'decimal',
             'default' => '0.00000',
             'notnull' => true,
             'scale' => false,
             'length' => 7,
             ));
        $this->hasColumn('valutadate', 'date', 25, array(
             'type' => 'date',
             'default' => '0000-00-00',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('dummy', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}