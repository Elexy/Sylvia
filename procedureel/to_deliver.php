<?php
 /*
 * shipment.php
 *
 * @version $Id: to_deliver.php,v 1.19 2007-03-14 13:24:38 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
$int_adresID = isset($_GET["adres"]) ? $_GET["adres"] : FALSE;

// Print default Iwex HTML header.
printheader (COMPANYNAME . " to_deliver", "print", TRUE);

echo "<BODY><FORM METHOD=\"get\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"to_deliverform\">\n";

if ($int_adresID) {
    // Create a query to make the packinglist.
    $sql_packing_shipment = "SELECT ShipID, Naam as shipname, CompanyName, orders.ContactID,
        Address, City, PostalCode, straat, huisnummer, plaats, Country
        FROM order_details
        INNER JOIN orders ON order_details.OrderID = orders.OrderID
        INNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID
        INNER JOIN contacts ON contacts.ContactID = orders.ContactID
        INNER JOIN Adressen ON Adressen.AdresID = orders.ShipID
        WHERE to_deliver > 0 AND orders.ShipID = $int_adresID 
							 AND (orders.RequiredDate <= date(NOW()) OR ISNULL(orders.RequiredDate)) 
							 AND " . openordedetails_condition;

    //echo $sql_packing_shipment;
    $packlist_query = mysql_query($sql_packing_shipment)
     or die("Ongeldige select orders query: " .$sql_packing_shipment. mysql_error());
    if ($obj = mysql_fetch_object($packlist_query)) {
	    echo '<table width="100%" border="0">';
	    echo "</td></tr>";
	    echo "<tr><td><img src='http://iwex.serveftp.org/images/" . LOGOSMALL . "' alt='".COMPANYNAME." logo' border=0></td>";
	    echo "<td><big><big><b>Openstaande artikelen </b></big></big></td><td colspan=\"2\" align=\"center\">";
	    echo "</tr></table>\n";
	    echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
	    echo "    <TR>\n";
	    echo "         <TH colspan='4'><B>geen Shipment ID</B></TH>\n";
	    echo "    </TR>\n";
	    echo "    <TR>\n";
	    echo "         <TD>Factuur</TD><TD>$obj->CompanyName</TD>\n";
	    echo "         <TD>Verzend</TD><TD>$obj->shipname</TD>\n";
	    echo "    </TR>\n";
	    echo "    <TR>\n";
	    echo "         <TD>Adres</TD><TD>$obj->Address</TD>\n";
	    echo "         <TD>Adres</TD><TD>$obj->straat $obj->huisnummer</TD>\n";
	    echo "    </TR>\n";
	    echo "    <TR>\n";
	    echo "         <TD></TD><TD>$obj->City</TD>\n";
	    echo "         <TD></TD><TD>$obj->PostalCode $obj->plaats</TD>\n";
	    echo "    </TR>\n";
	    echo "    <TR>\n";
	    echo "         <TD></TD><TD>$obj->Country</TD>\n";
	    echo "         <TD></TD><TD></TD>\n";
	    echo "</TABLE>\n";
	
	    echo '<BR>';
	    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	    echo "<tr><th>OrderID</th><th>ref.</th><th>order date</th><th>Product ID</th><th>Product</th>";
	    echo "<th>besteld</th><th>te leveren</th><th>Voorraad</th></tr>\n";
	
	    // Create a query to select the orderdetails.
	    $sql_packing_details = SQL_openorderdetails." WHERE order_details.to_deliver > 0
	      AND orders.ShipID=".$int_adresID. " 
		  AND (orders.RequiredDate <= date(NOW()) OR ISNULL(orders.RequiredDate))
		  AND " . openordedetails_condition;"
	      ORDER BY ProductID;";
	//    echo $sql_packing_details;
	    $packlist_det_query = mysql_query($sql_packing_details)
	     or die("Ongeldige select orders query: " .$sql_packing_details. mysql_error());
	
	    while ($objpackingdet = mysql_fetch_array($packlist_det_query, MYSQL_BOTH)) {
		    echo "<tr><td align=\"center\" class=\"cellline\"><small><A HREF='order.php?orderID=".$objpackingdet['OrderID']."'>".$objpackingdet['OrderID']."</A></small></td>\n";
		    if ($objpackingdet["rma_yn"]) {
				$rmaID = Getfield('SELECT RMAID from RMA_actions WHERE ActionID = '.$objpackingdet["rma_actionID"]);
				echo "<td align=\"center\" class=\"cellline\"><small><A HREF='rma.php?rmaid=".$rmaID."' target='_new'>RMA ". $rmaID."</a></small></td>\n" ;// ->order_details.Productdescription
			} else {
				echo "<td align=\"center\" class=\"cellline\"><small>". $objpackingdet["ContactsOrderID"]."</small></td>\n" ;// ->order_details.Productdescription
		    }
			echo "<td align=\"center\" class=\"cellline\"><small>". $objpackingdet["OrderDate"]."</small></td>\n" ;// ->orders.OrderDate
		    echo "<td align=\"center\" class=\"cellline\"><A HREF='". PRODUCT_MAINT . "?productid=".$objpackingdet["ProductID"]."'>".$objpackingdet["ProductID"]."</A></td>\n"; // ->current_product_list.productID
		    echo "<td class=\"cellline\">".$objpackingdet["ProductName"]."</td>\n"; // ->current_product_list.Productname
		    echo "<td align=\"center\" class=\"cellline\"><b>". $objpackingdet["Quantity"]."</b></td>\n"; // order_details.Quantity
		    echo "<td align=\"center\" class=\"cellline\"><big><b>". $objpackingdet["to_deliver"]."</b></big></td>\n"; // order_details.Quantity
		    echo "<td align=\"center\" class=\"cellline\">". get_stock($objpackingdet["ProductID"],
		                                                               $objpackingdet["stock_owner_id"])."</td>\n"; // order_details.Quantity
	    }
	    mysql_free_result($packlist_det_query);
	    echo "</TABLE>\n";
		echo "<INPUT TYPE=\"button\" NAME=\"new_shipment\" onClick=\"location.replace('shipment.php?submitnew=true&newadresid=".$int_adresID."');\" value=\"Leveren\">\n";
		echo "<INPUT TYPE=\"button\" NAME=\"cancel\" onClick=\"location.replace('shipment.php');\" value=\"Cancel\">\n";
		echo "</FORM>\n";
	} else {
		echo "<h2>No orders to be shipped found</h2>"; 
	}
}

printenddoc();

?>
