<?php

/**
 * BaseContactsBankAccounts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $account_number
 * @property integer $contactid
 * 
 * @method string               getAccountNumber()  Returns the current record's "account_number" value
 * @method integer              getContactid()      Returns the current record's "contactid" value
 * @method ContactsBankAccounts setAccountNumber()  Sets the current record's "account_number" value
 * @method ContactsBankAccounts setContactid()      Sets the current record's "contactid" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContactsBankAccounts extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contacts_bank_accounts');
        $this->hasColumn('account_number', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'primary' => true,
             'length' => 25,
             ));
        $this->hasColumn('contactid', 'integer', 4, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}