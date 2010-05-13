<?php


/**
 * This class adds structure of 'product_history' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:40 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ProductHistoryMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProductHistoryMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ProductHistoryPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ProductHistoryPeer::TABLE_NAME);
		$tMap->setPhpName('ProductHistory');
		$tMap->setClassname('ProductHistory');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('PRODUCTHISTORYID', 'Producthistoryid', 'INTEGER', true, 10);

		$tMap->addColumn('PRODUCTID', 'Productid', 'INTEGER', true, 8);

		$tMap->addColumn('EMPLOYEE', 'Employee', 'TINYINT', true, 3);

		$tMap->addColumn('OLD_VALUE', 'OldValue', 'VARCHAR', true, 100);

		$tMap->addColumn('NEW_VALUE', 'NewValue', 'VARCHAR', true, 100);

		$tMap->addColumn('DATE_MODIFIED', 'DateModified', 'TIMESTAMP', true, null);

		$tMap->addColumn('FIELDNAME', 'Fieldname', 'VARCHAR', true, 25);

	} // doBuild()

} // ProductHistoryMapBuilder
