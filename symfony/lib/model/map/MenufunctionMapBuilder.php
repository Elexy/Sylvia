<?php


/**
 * This class adds structure of 'menufunction' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:38 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MenufunctionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MenufunctionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(MenufunctionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(MenufunctionPeer::TABLE_NAME);
		$tMap->setPhpName('Menufunction');
		$tMap->setClassname('Menufunction');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11);

		$tMap->addColumn('MENUCATEGORYID', 'Menucategoryid', 'INTEGER', true, 11);

		$tMap->addColumn('NAME', 'Name', 'CHAR', true, 50);

		$tMap->addColumn('IMAGENAME', 'Imagename', 'CHAR', false, 50);

		$tMap->addColumn('LINK', 'Link', 'CHAR', true, 50);

		$tMap->addColumn('ORDERFLAG', 'Orderflag', 'INTEGER', true, 11);

		$tMap->addColumn('ACCESS_S', 'AccessS', 'INTEGER', true, 11);

		$tMap->addColumn('ACCESS_A', 'AccessA', 'INTEGER', true, 11);

		$tMap->addColumn('ACCESS_V', 'AccessV', 'INTEGER', true, 11);

		$tMap->addColumn('ACCESS_R', 'AccessR', 'INTEGER', true, 11);

		$tMap->addColumn('SETUP_S', 'SetupS', 'INTEGER', true, 11);

		$tMap->addColumn('SETUP_A', 'SetupA', 'INTEGER', true, 11);

		$tMap->addColumn('SETUP_V', 'SetupV', 'INTEGER', true, 11);

		$tMap->addColumn('SETUP_R', 'SetupR', 'INTEGER', true, 11);

		$tMap->addColumn('SUPERVISOR', 'Supervisor', 'INTEGER', true, 11);

		$tMap->addColumn('NONSUPERVISOR', 'Nonsupervisor', 'INTEGER', true, 11);

		$tMap->addColumn('EXTVEND', 'Extvend', 'INTEGER', true, 11);

		$tMap->addColumn('EXTCUST', 'Extcust', 'INTEGER', true, 11);

		$tMap->addColumn('NONEXT', 'Nonext', 'INTEGER', true, 11);

	} // doBuild()

} // MenufunctionMapBuilder