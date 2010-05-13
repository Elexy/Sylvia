<?php

/**
 * BaseBankTransactions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $transaction_id
 * @property integer $bank_account_id
 * @property decimal $amount
 * @property string $other_account_number
 * @property integer $customerid
 * @property date $transaction_date
 * @property string $name
 * @property string $description
 * 
 * @method integer          getTransactionId()        Returns the current record's "transaction_id" value
 * @method integer          getBankAccountId()        Returns the current record's "bank_account_id" value
 * @method decimal          getAmount()               Returns the current record's "amount" value
 * @method string           getOtherAccountNumber()   Returns the current record's "other_account_number" value
 * @method integer          getCustomerid()           Returns the current record's "customerid" value
 * @method date             getTransactionDate()      Returns the current record's "transaction_date" value
 * @method string           getName()                 Returns the current record's "name" value
 * @method string           getDescription()          Returns the current record's "description" value
 * @method BankTransactions setTransactionId()        Sets the current record's "transaction_id" value
 * @method BankTransactions setBankAccountId()        Sets the current record's "bank_account_id" value
 * @method BankTransactions setAmount()               Sets the current record's "amount" value
 * @method BankTransactions setOtherAccountNumber()   Sets the current record's "other_account_number" value
 * @method BankTransactions setCustomerid()           Sets the current record's "customerid" value
 * @method BankTransactions setTransactionDate()      Sets the current record's "transaction_date" value
 * @method BankTransactions setName()                 Sets the current record's "name" value
 * @method BankTransactions setDescription()          Sets the current record's "description" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBankTransactions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bank_transactions');
        $this->hasColumn('transaction_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('bank_account_id', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('amount', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => 10,
             ));
        $this->hasColumn('other_account_number', 'string', 25, array(
             'type' => 'string',
             'default' => '0',
             'length' => 25,
             ));
        $this->hasColumn('customerid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 4,
             ));
        $this->hasColumn('transaction_date', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('name', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('description', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}