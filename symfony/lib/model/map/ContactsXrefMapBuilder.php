<?php


/**
 * This class adds structure of 'contacts_xref' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:36 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ContactsXrefMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ContactsXrefMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ContactsXrefPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ContactsXrefPeer::TABLE_NAME);
		$tMap->setPhpName('ContactsXref');
		$tMap->setClassname('ContactsXref');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('CONTACTID', 'Contactid', 'INTEGER', false, 8);

		$tMap->addColumn('OTHERID', 'Otherid', 'INTEGER', false, 8);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, 10);

	} // doBuild()

} // ContactsXrefMapBuilder
