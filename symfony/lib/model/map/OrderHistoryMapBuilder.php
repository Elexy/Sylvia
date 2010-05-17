<?php


/**
 * This class adds structure of 'order_history' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:39 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class OrderHistoryMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OrderHistoryMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(OrderHistoryPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(OrderHistoryPeer::TABLE_NAME);
		$tMap->setPhpName('OrderHistory');
		$tMap->setClassname('OrderHistory');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ORDERHISTORYID', 'Orderhistoryid', 'INTEGER', true, 10);

		$tMap->addColumn('ORDERID', 'Orderid', 'INTEGER', true, 8);

		$tMap->addColumn('EMPLOYEE', 'Employee', 'TINYINT', true, 3);

		$tMap->addColumn('OLD_VALUE', 'OldValue', 'VARCHAR', true, 100);

		$tMap->addColumn('NEW_VALUE', 'NewValue', 'VARCHAR', true, 100);

		$tMap->addColumn('DATE_MODIFIED', 'DateModified', 'TIMESTAMP', true, null);

		$tMap->addColumn('FIELDNAME', 'Fieldname', 'VARCHAR', true, 25);

	} // doBuild()

} // OrderHistoryMapBuilder