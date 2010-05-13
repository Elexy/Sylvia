<?php


/**
 * This class adds structure of 'Personen' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:34 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class PersonenMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PersonenMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PersonenPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PersonenPeer::TABLE_NAME);
		$tMap->setPhpName('Personen');
		$tMap->setClassname('Personen');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('PERSOONID', 'Persoonid', 'INTEGER', true, 10);

		$tMap->addColumn('CONTACTID', 'Contactid', 'INTEGER', true, 10);

		$tMap->addColumn('PERSONEN_TYPE_ID', 'PersonenTypeId', 'INTEGER', true, 3);

		$tMap->addColumn('TITEL', 'Titel', 'VARCHAR', false, 30);

		$tMap->addColumn('VOORNAAM', 'Voornaam', 'VARCHAR', false, 30);

		$tMap->addColumn('ACHTERNAAM', 'Achternaam', 'VARCHAR', false, 30);

		$tMap->addColumn('TUSSENVOEGSEL', 'Tussenvoegsel', 'VARCHAR', false, 15);

		$tMap->addColumn('LANGUAGEID', 'Languageid', 'TINYINT', true, 3);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 100);

		$tMap->addColumn('MAILING_YN', 'MailingYn', 'TINYINT', false, 3);

		$tMap->addColumn('TEL', 'Tel', 'VARCHAR', false, 30);

		$tMap->addColumn('FAX', 'Fax', 'VARCHAR', false, 30);

		$tMap->addColumn('AANHEF', 'Aanhef', 'VARCHAR', false, 20);

		$tMap->addColumn('GENDER', 'Gender', 'TINYINT', false, 3);

		$tMap->addColumn('NOTES', 'Notes', 'VARCHAR', false, 255);

		$tMap->addColumn('MOBILE', 'Mobile', 'VARCHAR', false, 30);

	} // doBuild()

} // PersonenMapBuilder
