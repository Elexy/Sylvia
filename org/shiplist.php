<?php
 /*
 * shiplist.php
 *
 * @version $Id: shiplist.php,v 1.10 2006-07-04 14:28:30 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
$int_orderid = isset($_GET["orderid"]) ? $_GET["orderid"] : FALSE;
$int_contactID = isset($_POST["contactID"]) ? $_POST["contactID"] : FALSE;
$int_contactID = (isset($_GET["contactID"]) && !isset($_POST["contactID"])) ? $_GET["contactID"] : $int_contactID;
$bl_unlimit = isset($_POST["unlimit"]) ? TRUE : FALSE;

$openorders_sql = "SELECT OrderID, contacts.ContactID, OrderDate, ContactsOrderID, CompanyName
    FROM orders 
	INNER JOIN contacts ON orders.ContactID = contacts.ContactID
	WHERE orders.contactID = '$int_contactID' ";
if ($int_orderid) $openorders_sql .= " AND orders.OrderID = '$int_orderid' ";
$openorders_sql .= " ORDER BY orders.OrderID DESC";
if (!$int_orderid&&!$bl_unlimit) $openorders_sql .= " LIMIT 0,20;";

//echo $openorders_sql;

// Print default Iwex HTML header.
printheader (COMPANYNAME . " Backorders", "print");

echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"leveringenform\">\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";

$openorders_query = mysql_query($openorders_sql)
 or die("Ongeldige open orders query: " .$openorders_sql. mysql_error());

if (!($int_orderid&&$bl_unlimit)) {
    echo "<INPUT TYPE=\"submit\" NAME=\"unlimit\" VALUE=\"unlimit\">\n";
    echo "<INPUT TYPE=\"hidden\" NAME=\"contactID\" VALUE=\"$int_contactID\">\n";
} 
 
while ($obj_openorder = mysql_fetch_array($openorders_query)) {
    echo "<tr><th colspan='3' align=\"center\"><b>".$obj_openorder["CompanyName"]."</b></th>\n";
	echo "<tr><th colspan='3' align=\"center\"><b>Leveringen op Order: ".$obj_openorder["OrderID"];
    echo " met kenmerk: ". $obj_openorder["ContactsOrderID"];
    echo " van (datum / tijd): ".$obj_openorder["OrderDate"]."</b></th>\n";
    $open_orderdet_sql="SELECT ContactsOrderID, order_details.ProductID, ProductName,
        order_details.Quantity, order_details.to_deliver
        FROM order_details
        INNER JOIN orders ON order_details.OrderID = orders.OrderID
        WHERE orders.OrderID = '".$obj_openorder["OrderID"]."' 
        GROUP BY order_details.ProductID";
    $openorderdetails_query = mysql_query($open_orderdet_sql)
        or die("Ongeldige openorderdetails query: " .$open_orderdet_sql. mysql_error());
	if (mysql_num_rows($openorderdetails_query)) {        
		echo "<tr><td colspan = '3'>\n";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
        echo "<tr><th>ID</th><th>Naam</th><th>Besteld</th><th>Backorder</th></tr>";
        while ($obj_opendet = mysql_fetch_array($openorderdetails_query)) {
            echo "<tr><td align=\"center\" class=\"cellline\" WIDTH='8%'><b>".$obj_opendet["ProductID"]."</b></td>\n"; // ->current_product_list.productID
            echo "<td class=\"cellline\"><b>".$obj_opendet["ProductName"]."</b></td>\n"; // ->current_product_list.Productname
            echo "<td align=\"center\" class=\"cellline\"><b>". $obj_opendet["Quantity"]."</b></td>\n"; // order_details.Quantity
            $obj_opendet["to_deliver"] = $obj_opendet["to_deliver"] ? $obj_opendet["to_deliver"]  : '-';
			echo "<td align=\"center\" class=\"cellline\"><b>". $obj_opendet["to_deliver"]."</b></td>\n"; // order_details.Quantity
            echo "<TD></TD><TD></TD></TR>\n";
            if ($obj_opendet["to_deliver"]<$obj_opendet["Quantity"]) {
            	$delivered_sql = "SELECT ProductID, shipments.Shipment_ID, SUM(UnitsSold) AS UnitsSold, Ship_date, 
					shipments.Tracking, postcode, box_number 
                    FROM inventory_transactions
                    INNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID
                    INNER JOIN Adressen ON shipments.AdressID=Adressen.AdresID
                    INNER JOIN box ON inventory_transactions.box_ID = box.box_ID
                    WHERE OrderID = '".$obj_openorder["OrderID"]."' AND ProductID = " . $obj_opendet["ProductID"] . " 
					GROUP BY shipments.Shipment_ID, ProductID;";
                $delivered_query = mysql_query($delivered_sql)
                    or die("Ongeldige delivered query: " .$delivered_sql. mysql_error());
        		echo "<tr><td class='cellline' ALIGN='right'>-->></td><td class='cellline' colspan = '3'>\n";
        		echo "<table ALIGN='right' width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
                while ($obj_delivered = mysql_fetch_array($delivered_query)) {
                    echo "<tr>\n";
					echo "<td class='celldetail' WIDTH='10%'><A HREF='shipment.php?shipmentID=".$obj_delivered["Shipment_ID"]."'>Levering ".$obj_delivered["Shipment_ID"]."</A></td>\n"; // ->current_product_list.Productname
                    echo "<td class='celldetail' WIDTH='20%'>Datum ". $obj_delivered["Ship_date"]."</td>\n"; // order_details.Quantity
                    echo "<td class='celldetail' WIDTH='8%'>Doos ". $obj_delivered["box_number"]."</td>\n"; // order_details.Quantity
                    echo "<td class='celldetail' WIDTH='8%'>". $obj_delivered["UnitsSold"]."</td>\n"; // order_details.Quantity
                    echo "<td class='celldetail' ALIGN='right' WIDTH='20%'>". createtrackinglink($obj_delivered["Tracking"], $obj_delivered["postcode"])."</td>\n"; // order_details.Quantity
                }	echo "</tr>\n";
                mysql_free_result($delivered_query);
                echo "</tr></table>";
            }
       	}
    }
    echo "</tr></table>";
    mysql_free_result($openorderdetails_query);
}
mysql_free_result($openorders_query);


echo "</TABLE>\n";
echo "</FORM>\n";

printenddoc();

?>
