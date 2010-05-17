<?php


/**
 * This class adds structure of 'paymentterm' table to 'propel' DatabaseMap object.
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
class PaymenttermMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PaymenttermMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PaymenttermPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PaymenttermPeer::TABLE_NAME);
		$tMap->setPhpName('Paymentterm');
		$tMap->setClassname('Paymentterm');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('PAYMENTTERMID', 'Paymenttermid', 'TINYINT', true, 3);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 30);

		$tMap->addColumn('DAYS', 'Days', 'TINYINT', true, 3);

		$tMap->addColumn('ENDMONTH', 'Endmonth', 'TINYINT', true, 3);

		$tMap->addColumn('INCASSO', 'Incasso', 'TINYINT', true, 1);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

	} // doBuild()

} // PaymenttermMapBuilder