<?php
 /*
 * purchase_list.php
 *
 * @version $Id: purchase_list.php,v 1.42 2007-10-10 10:02:22 alex Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
// int vars
$int_MerkID = isset($_POST["merkID"]) ? $_POST["merkID"] : FALSE;
$int_MerkID = isset($_GET["merkID"]) && !$int_MerkID ? $_GET["merkID"] : $int_MerkID;
$int_SupplierID = isset($_POST["SupplierID"]) ? $_POST["SupplierID"] : FALSE;
$int_SupplierID = isset($_GET["SupplierID"]) && !$int_SupplierID ? $_GET["SupplierID"] : $int_SupplierID;
$int_weeks = isset($_POST["weeks"]) ? $_POST["weeks"] : 12;
//boolean vars
$bl_submit = isset($_POST["submit"]);
$bl_order = isset($_POST["order"]);


// when there is no brand given, don't just get the whole list, get nothing in stead.
//if (!$int_MerkID) $int_MerkID = "-";

// Print default Iwex HTML header.
printheader (COMPANYNAME . " to_deliver");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"to_deliverform\">\n";

printIwexNav();

// Create a query to make the list.
$sql_purchase_list = "(SELECT order_details.ProductID, ExternalID, merk, current_product_list.ProductName, product_stock.stock, 
    SUM(to_deliver) as to_deliver, ReorderLevel, Merk,  current_product_list.sku
    FROM current_product_list  
    INNER JOIN order_details ON current_product_list.ProductID = order_details.ProductID
    INNER JOIN orders ON orders.OrderID = order_details.OrderID " .
    		" AND (orders.Confirmed_yn = '1' OR orders.Confirmed_yn = '-1') " .
        	" AND (NOT Complete_yn OR Complete_yn IS NULL)" .
        	" AND NOT orders.rma_yn 
    LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."'
    WHERE " .
    		"(Discontinued_yn = 0 OR to_deliver) " .
    		"AND (to_deliver > stock OR stock < ReorderLevel OR isnull(stock))  "; 
    if ($int_MerkID) {
        $sql_purchase_list .= "AND MerkID = '" . $int_MerkID . "' " ;
    }
    if ($int_SupplierID) {
        $sql_purchase_list .= "AND Supplier = '" . $int_SupplierID . "' " ;
    }    
    $sql_purchase_list .= "GROUP BY order_details.ProductID) UNION (
    SELECT ProductID, ExternalID, merk, ProductName, product_stock.stock, '0', ReorderLevel, Merk,  sku
    FROM current_product_list
    LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."'
    WHERE Discontinued_yn = 0 AND (stock < ReorderLevel OR isnull(stock))"; 
    if ($int_MerkID) {
        $sql_purchase_list .= "AND MerkID = '" . $int_MerkID . "' " ;
    }
    if ($int_SupplierID) {
        $sql_purchase_list .= "AND Supplier = '" . $int_SupplierID . "' " ;
    }
    $sql_purchase_list .= "GROUP BY ProductID) 
        ORDER BY ProductID, to_deliver DESC;";
//echo $sql_purchase_list;
$purchase_list_query = $db_iwex->query($sql_purchase_list);

// this is all to make a purchase order happen 
if ($bl_order) {
    $last_ID = 0;
    while ($obj_purchaselist = mysql_fetch_array($purchase_list_query, MYSQL_BOTH)) {
        if ($obj_purchaselist["sku"] == 1) {
            if ($_POST['order'.$obj_purchaselist["ProductID"]]
                &&
                $obj_purchaselist['ProductID'] <> $last_ID) {
                OrderProduct($obj_purchaselist["ProductID"], 
                             $_POST['order'.$obj_purchaselist["ProductID"]]);
            }
        } else {
            if (getparts(&$result_parts,$obj_purchaselist["ProductID"])) {
                While ($obj_parts = (mysql_fetch_object($result_parts))) {
                    if (isset($_POST['order'.$obj_purchaselist["ProductID"].$obj_parts->Product_ids]) 
                        &&
                        $_POST['order'.$obj_purchaselist["ProductID"].$obj_parts->Product_ids]) {
                        OrderProduct($obj_parts->Product_ids, 
                                     $_POST['order'.$obj_purchaselist["ProductID"].$obj_parts->Product_ids]);
                    }
                }
                mysql_free_result($result_parts);
            }
        }
        $last_ID = $obj_purchaselist['ProductID'];
    }
    mysql_free_result($purchase_list_query);
    
    $purchase_list_query = $db_iwex->query($sql_purchase_list);
}

echo "Filter op Merk " . makelistbox('SELECT brand_id, name FROM brand ORDER BY name','merkID','brand_id','name',$int_MerkID,TRUE) . "\n";
echo "EN op Leverancier " . makelistbox('SELECT CompanyName, ContactID FROM contacts WHERE Supplier_yn<>0 ORDER BY CompanyName','SupplierID','ContactID','CompanyName',$int_SupplierID,TRUE) . 
    "<INPUT TYPE='submit' NAME='submit' VALUE=submit>";
echo " Average week sales: <INPUT TYPE='text' SIZE='3' NAME='weeks' VALUE='$int_weeks'>\n";
echo " <INPUT TYPE='submit' NAME='order' VALUE='Bestel'>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
echo "<tr><th>ProductID</th><th>ExternalID</th><th>Merk</th><th>Name</th><th>avg</th><th>Stock</th><th>Sold</th><th>Min</th><th>On order</th><th>Bestel</th></TR>";

$found = mysql_num_rows($purchase_list_query);
$last_ID=0;
$skipped=0;
while ($obj_purchaselist = mysql_fetch_array($purchase_list_query, MYSQL_BOTH)) 
{
	if ($obj_purchaselist['ProductID'] <> $last_ID)
	{
		$amount_on_order = printpo_bo($obj_purchaselist['ProductID'], &$on_order);
	    if ($amount_on_order >= ($obj_purchaselist["ReorderLevel"] - $obj_purchaselist["stock"] - $obj_purchaselist["to_deliver"]))            
	    {
	        $style = "cellline";
	    } else {
	        $style = "celllinered";
	    }
	    $_SESSION["popup_function"] = "print_inventory_transactions"; //set which function to execute in popup.php
	    //$_SESSION["popup_parm"] = $obj_purchaselist['ProductID']; //set What option to use in popup.php
	    echo "<tr><td class='$style'><small><A HREF='". PRODUCT_MAINT . "?productid=".$obj_purchaselist['ProductID']."' TARGET=new>".$obj_purchaselist['ProductID']."</A></small></td>\n";
	    echo "<td class='$style'><small>". $obj_purchaselist["ExternalID"]."</small></td>\n" ;// ->order_details.Productdescription
	    echo "<td class='$style'><small>". $obj_purchaselist["Merk"]."</small></td>\n" ;// ->order_details.Productdescription
	    echo "<td class='$style'>
	            <A HREF='popup.php?ProductID=".$obj_purchaselist['ProductID']."' TARGET='_new'>". $obj_purchaselist["ProductName"]."</A>
	            </small></td>\n" ;// ->order_details.Productdescription
				
				
		echo "<td class='$style'><small>" . round(ShowAverageSellThrough($obj_purchaselist['ProductID'], $int_weeks)) ."</small></td>\n" ;
	    echo "<td class='$style'><small>". $obj_purchaselist["stock"]."</small></td>\n" ;// ->orders.OrderDate
	    echo "<td class='$style'><small><A HREF='products_sold.php?ProductID=".$obj_purchaselist['ProductID']."' TARGET=new>" . $obj_purchaselist["to_deliver"]."</A></small></td>\n"; // ->current_product_list.productID
	    echo "<td class='$style'><small>".$obj_purchaselist["ReorderLevel"]."</small></td>\n"; // ->current_product_list.Productname
	    echo "<td class='$style'><small><center>$on_order </center></small></td>\n";
	    // now see if the out of stock part is SKU     
	    if ($obj_purchaselist["sku"] == 1) {
	        echo "<td class='$style'>";
	        if ($obj_purchaselist['ProductID']<>$last_ID) {
	            echo "<input type=text value='' size=5 name='order".$obj_purchaselist['ProductID']."'>";
	        }
	        echo "</td>\n"; 
	    } else {
	        echo "<td class=\"cellline\"></td>\n";
	        if (getparts(&$result_parts,$obj_purchaselist["ProductID"])) {
	            While ($obj_parts = (mysql_fetch_object($result_parts))) {
	                if ((($obj_parts->stock < $obj_purchaselist["ReorderLevel"])
	                    ||
	                    ($obj_parts->stock < $obj_purchaselist["to_deliver"]))
	                    ||
	                    ($obj_parts->stock < $obj_parts->ReorderLevel)) 
	                    {
	                    $amount_on_order = printpo_bo($obj_parts->Product_ids, &$on_order);
	                    if ($amount_on_order >= ($obj_parts->ReorderLevel - $obj_parts->stock - $obj_purchaselist["to_deliver"]))            
	                    {
	                        $style = "cellline";
	                    } else {
	                        $style = "celllinered";
	                    }
	                    echo "<tr>" .
	                    	 "<td class=\"cellline\" ALIGN=right><small><A HREF='". PRODUCT_MAINT . "?productid=".$obj_parts->Product_ids."' TARGET=new>".$obj_parts->Product_ids."</A></small></td>\n";
	                    echo "<td class=$style><small>". $obj_parts->ExternalID."</small></td>\n" ;// ->order_details.Productdescription
	                    echo "<td class=$style><small>". $obj_parts->Merk."</small></td>\n" ;// ->order_details.Productdescription
	                    echo "<td class=$style><small><A HREF='popup.php?ProductID=".$obj_parts->Product_ids."' TARGET='_new'>
	                        ". $obj_parts->ProductName."</A></small></td>\n" ;// ->order_details.Productdescription
	                    echo "<td class='$style'><small>" . round(ShowAverageSellThrough($obj_parts->stock, $int_weeks)) ."</small></td>\n" ;
	                    echo "<td class=$style><small>". $obj_parts->stock."</small></td>\n" ;// ->orders.OrderDate
	                    echo "<td class=$style><small><A HREF='products_sold?ProductID=".$obj_purchaselist["ProductID"]."' TARGET=new>" . $obj_purchaselist["to_deliver"]."</A></small></td>\n"; // ->current_product_list.productID
	                    echo "<td class=$style><small>".$obj_parts->ReorderLevel."</small></td>\n"; // ->current_product_list.Productname
	                    echo "<td class=$style><small><center>$on_order</center></small></td>\n";
	                    echo "<td class=$style><input type=text value='' size=5 name='order".$obj_purchaselist["ProductID"].$obj_parts->Product_ids."'></td>\n"; 
	                }
	            }
	        }
	        mysql_free_result($result_parts);
	    }
	}
    $last_ID = $obj_purchaselist['ProductID'];
}
mysql_free_result($purchase_list_query);
echo "</TABLE>\n";
echo $found . " artikelen gevonden en " . $skipped . " skipped ";
echo "</FORM>\n";

printenddoc();

?>
