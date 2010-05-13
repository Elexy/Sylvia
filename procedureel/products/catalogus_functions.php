<?php

/**
 * Function     : AddProductToCatalog
 * Will add CatalogusID and ProductID into table "Catalogusdetails
 * Input        : $int_ProductID, $int_CatalogusID
 * Returns	: none
 **/
function ChangeProductToCatalog($int_Productid,
						        $int_CatalogusID,
								$bl_add) {
	global $db_iwex;
	// Check if this record is already listed in the catalog
	if (CheckProductCatalog ($int_Productid,
						     $int_CatalogusID)) {
		if (!$bl_add) {
			// If so delete it.
			//echo "delete $int_Productid";
			$db_iwex->query("DELETE FROM catalogusdetails 
							 WHERE CatalogusID = '$int_CatalogusID' AND ProductID = '$int_Productid'");
		}
	} else if ($bl_add) {
		// If not insert it.
		//echo "insert $int_Productid";
		$db_iwex->query("INSERT INTO catalogusdetails 
						 SET CatalogusID = '$int_CatalogusID', ProductID = '$int_Productid'");
						
	}
}

/**
 * Function     : CheckProductCatalog
 * Will check if a record is already listed in the catalog
 * Input        : $int_ProductID, $int_CatalogusID
 * Returns      : true when field is filled, false when field is empty
 **/
function CheckProductCatalog($int_Productid,
							 $int_CatalogusID) {
	global $db_iwex;
	// Check if this record is already listed in the catalog
	Return GetField("SELECT ContactID 
					 FROM catalogus 
					 INNER JOIN catalogusdetails ON catalogus.CatalogusID = catalogusdetails.CatalogusID 
					 WHERE ProductID = '$int_Productid'
						   AND catalogus.CatalogusID = '$int_CatalogusID'"); 
}

/**
 * Function     : CreateCatalog
 * Will create a catalog
 * Input        :  $int_ContactID, $str_desc
 * Returns      : The new catalogID
 **/ 
function CreateCatalog ($int_contactID,
						$str_desc){
	global $db_iwex;
	$db_iwex->query("INSERT INTO catalogus SET catalogusdesc = '$str_desc', ContactID = $int_contactID");
	return $db_iwex->lastinserted();
}

/**
 * Function     : DeleteCatalog
 * Will delete the catalog
 * Input        :  $int_CatalogID
 * Returns      : none
 **/ 
function DeleteCatalog ($int_catalogID){
	global $db_iwex;
	// Delete all records that are in the catalog
	$db_iwex->query("DELETE FROM catalogusdetails 
					 WHERE catalogusdetails.CatalogusID = $int_catalogID");

	// Delete the catalog
	$db_iwex->query("DELETE FROM catalogus 
					 WHERE catalogus.CatalogusID = $int_catalogID");

}

?>