<?php
 /*
 * stock_mutations.php
 *
 * @version $Id: sync_webshop.php,v 1.2 2007-06-20 15:23:46 alex Exp $
 * @copyright $date:
 **/
 
$_GLOBAL["str_backdir"] = '../';
include $_GLOBAL["str_backdir"].'include.php';

$db_iwex = new DB();
$formname = "syncwebshop";

// Print default Iwex HTML header.
printheader (COMPANYNAME . " sync webshop", "jaop");

for ($i = 1; $i <= 10; $i++) {
	if ($_REQUEST["sync_products$i"]) {
		$db_host = $GLOBALS["ary_config"]["webshop_dbhost$i"];
		$db_user = $GLOBALS["ary_config"]["webshop_dbuser$i"];
		$db_pwd = $GLOBALS["ary_config"]["webshop_dbpwd$i"];
		$db_table = $GLOBALS["ary_config"]["webshop_dbtable$i"];
		if ($db_host
			&&
			$db_user
			&&
			$db_pwd
			&&
			$db_table) 
		{
			//set db connection for webshop
			$db_shop = new DB($db_host,
			   			  $db_table, 
						  $db_user,
						  $db_pwd);
			//get products to be in this webshop
			$publish = isset($GLOBALS["ary_config"]["webshop_publicidentifier$i"]) ? $GLOBALS["ary_config"]["webshop_publicidentifier$i"] : "public" ;
			$our_products = "SELECT 
								ProductID*123 as ID
							FROM iwex.current_product_list
							INNER JOIN iwex.listbox ON listbox.category = '10' AND
								iwex.listbox.value = iwex.current_product_list.image
							INNER JOIN iwex.product_stock ON iwex.product_stock.Product_ID = iwex.current_product_list.ProductID
								AND owner_id = " . OWN_COMPANYID . "
							WHERE iwex.current_product_list.$publish=1
								AND NOT Discontinued_yn;";
			$products = $db_iwex->query($our_products);
			$products_sql = "SELECT product_id 
								  FROM jos_vm_product ";
			$where_clause = FALSE;
			$not = FALSE;
			while ($obj=mysql_fetch_object($products)) {
				// create sql statment to read all products from external shop
				// add OR statement if it's not the first time
				$or = $where_clause ? " OR " : "";				
				$where_clause .= "$or product_id = '$obj->ID' ";
			}
			//add it all up for update
			$update_products_sql = $products_sql . " WHERE " . $where_clause;
			$update_result = $db_shop->query($update_products_sql);
			$ary_update = mysql_fetch_object($update_result);
			//add it all up for new
			$new_products_sql = $products_sql . "WHERE NOT (" . $where_clause . ");";
			$new_result = $db_shop->query($new_products_sql);
			$ary_new = mysql_fetch_object($new_result);
			
			// look for the ones we need to delete
			// just get all products form the webshop
			$all_shopproducts_sql = $products_sql;
			$all_shopresult = $db_shop->query($all_shopproducts_sql);
			print_r($ary_shopall = mysql_fetch_array($all_shopresult));
			//now get all our own products
			$all_internalproducts_sql = $our_products;
			$all_internalresult = $db_shop->query($all_internalproducts_sql);
			$ary_internal = mysql_fetch_array($all_internalresult);
			// print the difference
			print_r($ary_del = array_diff($ary_shopall, $ary_internal));
		}
	} else {
		echo " no action";
	}
}



echo "<BODY ".get_bgcolor()."><FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=$formname>\n";
// Used for overlib function.
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();
echo "<table>";
for ($i = 1; $i <= 10; $i++) {
	if (isset($GLOBALS["ary_config"]["webshop_name$i"])) {
		$name = ($GLOBALS["ary_config"]["webshop_name$i"]) ;
	} else {
		break;
	}
	echo "<tr><th>$name</th>";
	echo "<td>";
	echo makebutton("sync_products$i",
					"Sync Products", 
					$formname,
					FALSE,
					FALSE);
	echo "</td>";
	echo "<td>";
	echo makebutton("get_orders$i",
					"get_orders", 
					$formname,
					FALSE,
					FALSE);
	echo "</td></tr>";
}
echo "</table>";
echo "</FORM>\n";

printenddoc();
?>
