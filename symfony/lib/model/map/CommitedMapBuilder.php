<?php


/**
 * This class adds structure of 'commited' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Jun  2 11:52:35 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class CommitedMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CommitedMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(CommitedPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CommitedPeer::TABLE_NAME);
		$tMap->setPhpName('Commited');
		$tMap->setClassname('Commited');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ORDERDETAILSID', 'Orderdetailsid', 'INTEGER', true, 10);

		$tMap->addPrimaryKey('ORDERID', 'Orderid', 'INTEGER', true, 10);

		$tMap->addPrimaryKey('PRODUCTID', 'Productid', 'INTEGER', true, 10);

		$tMap->addColumn('PRODUCTNAME', 'Productname', 'VARCHAR', false, 255);

		$tMap->addColumn('PRODUCTDESCRIPTION', 'Productdescription', 'LONGVARCHAR', false, null);

		$tMap->addColumn('UNITPRICE', 'Unitprice', 'DECIMAL', true, 10);

		$tMap->addColumn('UNITBTW', 'Unitbtw', 'DECIMAL', true, 10);

		$tMap->addColumn('QUANTITY', 'Quantity', 'SMALLINT', false, 6);

		$tMap->addColumn('EXTENDED_PRICE', 'ExtendedPrice', 'DECIMAL', true, 10);

		$tMap->addColumn('DISCOUNT', 'Discount', 'DECIMAL', false, 10);

		$tMap->addColumn('SERIALNB', 'Serialnb', 'VARCHAR', false, 255);

		$tMap->addColumn('SHIPID', 'Shipid', 'INTEGER', false, 8);

		$tMap->addColumn('ORDERDATE', 'Orderdate', 'DATE', false, null);

		$tMap->addColumn('BTW_PERCENTAGE', 'BtwPercentage', 'DECIMAL', true, 10);

		$tMap->addColumn('COST_PERCENTAGE', 'CostPercentage', 'FLOAT', true, null);

		$tMap->addColumn('DELIVERED', 'Delivered', 'SMALLINT', false, 5);

	} // doBuild()

} // CommitedMapBuilder