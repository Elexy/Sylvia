<?php


/**
 * This class adds structure of 'genuser' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:37 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class GenuserMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.GenuserMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(GenuserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GenuserPeer::TABLE_NAME);
		$tMap->setPhpName('Genuser');
		$tMap->setClassname('Genuser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'DOUBLE', true, null);

		$tMap->addColumn('UID', 'Uid', 'VARCHAR', true, 50);

		$tMap->addColumn('PWD', 'Pwd', 'VARCHAR', false, 64);

		$tMap->addColumn('RACCESS_S', 'RaccessS', 'INTEGER', true, 11);

		$tMap->addColumn('RACCESS_A', 'RaccessA', 'INTEGER', true, 11);

		$tMap->addColumn('RACCESS_V', 'RaccessV', 'INTEGER', true, 11);

		$tMap->addColumn('RACCESS_R', 'RaccessR', 'INTEGER', true, 11);

		$tMap->addColumn('WACCESS_S', 'WaccessS', 'INTEGER', true, 11);

		$tMap->addColumn('WACCESS_A', 'WaccessA', 'INTEGER', true, 11);

		$tMap->addColumn('WACCESS_V', 'WaccessV', 'INTEGER', true, 11);

		$tMap->addColumn('WACCESS_R', 'WaccessR', 'INTEGER', true, 11);

		$tMap->addColumn('SACCESS_S', 'SaccessS', 'INTEGER', true, 11);

		$tMap->addColumn('SACCESS_A', 'SaccessA', 'INTEGER', true, 11);

		$tMap->addColumn('SACCESS_V', 'SaccessV', 'INTEGER', true, 11);

		$tMap->addColumn('SACCESS_R', 'SaccessR', 'INTEGER', true, 11);

		$tMap->addColumn('SUPERVISOR', 'Supervisor', 'INTEGER', true, 11);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', true, 100);

		$tMap->addColumn('LOGON_ATTEMPTS', 'LogonAttempts', 'TINYINT', true, 4);

		$tMap->addColumn('ACTIVE', 'Active', 'INTEGER', true, 11);

		$tMap->addColumn('STYLESHEETID', 'Stylesheetid', 'INTEGER', true, 11);

		$tMap->addColumn('DEFLANGUAGE', 'Deflanguage', 'INTEGER', true, 11);

		$tMap->addColumn('CONTACTID', 'Contactid', 'INTEGER', true, 8);

		$tMap->addColumn('EMPLOYEE_ID', 'EmployeeId', 'TINYINT', false, 3);

	} // doBuild()

} // GenuserMapBuilder
