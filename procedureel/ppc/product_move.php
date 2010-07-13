<?php
$_GLOBAL["str_backdir"] = '../';

include ("../include.php");
// get nutton input from form
$productid = isset($_POST["productid"]) ? $_POST["productid"] : FALSE;
$product_id_old = $productid;
$productid = isset($_GET["productid"]) && !isset($_POST["productid"]) ? $_GET["productid"] :  $productid;
$productidnew = isset($_POST["productidnew"]) && $_POST["productidnew"] ? $_POST["productidnew"] : FALSE;
$new_product = isset($_POST["new_product"]) ?  $_POST["new_product"] : FALSE;
$int_owner = isset($_REQUEST["owner"]) ? $_REQUEST["owner"] : OWN_COMPANYID;

//initialize and get all the formdata
$prodloc = isset($_POST["prodloc"]) ?  $_POST["prodloc"] : FALSE;
$prodlocid = FALSE;

// Print default Iwex HTML header.
printheader ("Iwex Producten verplaatsen", 'maint', FALSE);

echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"productmoveform\">\n";

// Get product loc. ID when it is set.
if ($productidnew) {
    // Test if the field is a location id.
    if ($int_prod_loc_id = GetField("SELECT ID FROM location WHERE ID = '$productidnew' OR location = '$productidnew'")) {
        $prodloc = $int_prod_loc_id ? $int_prod_loc_id : $prodloc;
        $productid = $product_id_old;
    } else { // It is a product id
        $productid = $productidnew;
        $prodloc = FALSE; // This is the old one so clear it no update.
		$int_owner = OWN_COMPANYID;
    }
}

// if new button has been pressed in main screen do not run query
if ($productid && $prodloc)   // If user has submitted changes
{
	SetProductHistory($productid,
				  "location_id",
				  "Owner $int_owner, Location: $prodloc",
				  FALSE,
				  "Owner $int_owner, Location: ".
				  GetField("SELECT location_id
							FROM product_stock 
							WHERE Product_ID  = '$productid' 
								  AND
								  owner_id = '$int_owner'"));

    $sql_product = "product_stock SET
        location_id = '$prodloc' ";
    // get product from tabel current_product_list
    $updateproduct_sql = "UPDATE ". $sql_product . "WHERE Product_ID = $productid AND owner_id = $int_owner";
    
    $updateproduct_query = $db_iwex->query($updateproduct_sql);
    echo "Nieuwe locatie in de DB geplaatst.<br>";
    echo MakeBeep(TRUE);
}
    
if ($productid)  // if a productid is given 
{
    $actual_stock = get_stock($productid);
    // get product from tabel current_product_list
    $productmain_sql = "SELECT ProductID, location_ID, 
      ProductName, ProductName, stock
      FROM current_product_list
      LEFT JOIN product_stock ON product_stock.Product_ID = current_product_list.ProductID AND owner_id = $int_owner
      LEFT JOIN location ON location_ID = ID
      WHERE current_product_list.ProductID = '$productid' OR EAN = '$productid'";
    $productdetail_query = $db_iwex->query($productmain_sql);
    $obj = mysql_fetch_object($productdetail_query);

    
	echo "<input type=\"hidden\"  NAME=\"productid\" CLASS=\"form\" value=\"$obj->ProductID\">Eigenaar $int_owner ";
//	if (OtherProductOwner($obj->ProductID)) {
		echo preg_replace ("/<select name/", "<select OnChange=\"location.replace('".$_SERVER['PHP_SELF']."?productid=$obj->ProductID&owner='+owner.value)\" name",
									makelistbox("SELECT owner_id, SUBSTRING(CONCAT_WS(', ', stock, CompanyName), 1, 20) AS stockowner
												 FROM product_stock
												 INNER JOIN contacts ON owner_id = ContactID
												 WHERE Product_ID = '$obj->ProductID'
												 ORDER BY CompanyName",
												 'owner',
												 'owner_id',
												 'stockowner',
												 $int_owner,
                                                 '',
												 '',
												 !OtherProductOwner($obj->ProductID)));
//	} else {
//		echo GetField("SELECT CompanyName FROM contacts WHERE ContactID = $int_owner"); //Default owner
//	}
    echo "<br>Product ID: $obj->ProductID<br>";
    echo "Naam: $obj->ProductName<br>\n";
    echo "Locatie: ";
    echo makelistbox('SELECT ID, location FROM location','prodloc','ID','location',$obj->location_ID)
        ."<br>\n"; 
//    echo "<input type=\"submit\" NAME=\"submit\" CLASS=\"form\" value=\"Update\"><br>\n";
}
    echo "Product ID <input type=\"text\" NAME=\"productidnew\" CLASS=\"form\" SIZE=\"6\" value=\"\" onChange='javascript:document.productmoveform.submit()'>";
    echo "<input type=\"submit\" NAME=\"submit\" CLASS=\"form\" value=\"submit\">\n";
    echo '<script TYPE="text/javascript" language="JavaScript">document.productmoveform.productidnew.focus();</script>';

echo "</FORM>\n";
printenddoc();
?>
