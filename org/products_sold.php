<?php
 /*
 * shiplist.php
 *
 * @version $Id: products_sold.php,v 1.7 2005-07-15 12:09:34 alex Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
$int_ProductID = isset($_POST["ProductID"]) ? $_POST["ProductID"] : FALSE;
$int_ProductID = isset($_GET["ProductID"]) ?  isset($_POST["ProductID"]) ? $int_ProductID : $_GET["ProductID"]: $int_ProductID;
$bl_all = isset($_POST["sold"]) ? TRUE : FALSE;
$int_ContactID = isset($_POST["ContactID"]) ? $_POST["ContactID"] : FALSE;

$open_orderdet_sql = SQL_openorderdetails. " 
    WHERE ";
if ($bl_all)
{
    if ($int_ContactID)  $open_orderdet_sql .= " (orders.Confirmed_yn = '1' OR orders.Confirmed_yn = '-1') AND contacts.ContactID = " . $int_ContactID . " AND";
} else {
    $open_orderdet_sql .= " to_deliver > '0' AND " . openordedetails_condition . "AND";
}
$open_orderdet_sql .= "
    order_details.ProductID= '$int_ProductID' 
    ORDER BY order_details.OrderDate;"; 

// Print default Iwex HTML header.
printheader ("Verkochte Artikelen", "print");

echo "<BODY><FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"sold_to_form\">\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
echo "<tr><td colspan=4><INPUT TYPE=submit NAME='sold' VALUE='ook reeds geleverd'> AAN (KlantID) 
        <INPUT TYPE=text NAME='ContactID'>".GetRecordId(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "ContactID", "sold_to_form.ContactID",null,"0.6")."
        <INPUT TYPE=hidden NAME='ProductID' VALUE=".$int_ProductID.">
        </td></tr>";

$openorderdetails_query = mysql_query($open_orderdet_sql)
    or die("Ongeldige openorderdetails query: " .$open_orderdet_sql. mysql_error());
if (mysql_num_rows($openorderdetails_query)) {        
    echo "<tr><th>OrderID</th><th>Order datum</th><th>Klant</th><th>Besteld</th><th>Open</th></tr>";
    while ($obj_opendet = mysql_fetch_array($openorderdetails_query)) {
        echo "<tr><td align=\"center\" class=\"cellline\" WIDTH='8%'><A HREF='order.php?orderID=".$obj_opendet["OrderID"]."'> ".$obj_opendet["OrderID"]."</A></td>\n"; 
        echo "<td align=\"center\" class=\"cellline\">".$obj_opendet["OrderDate"]."</td>\n";
        echo "<td class=\"cellline\">".$obj_opendet["CompanyName"]."</td>\n"; // ->current_product_list.Productname
        echo "<td align=\"center\" class=\"cellline\">". $obj_opendet["Quantity"]."</td>\n"; // order_details.Quantity
        $obj_opendet["to_deliver"] = $obj_opendet["to_deliver"] ? $obj_opendet["to_deliver"]  : '-';
        echo "<td align=\"center\" class=\"cellline\"><b>". $obj_opendet["to_deliver"]."</b></td>\n"; // order_details.Quantity
        echo "</TR>\n";
    }
} else {
    echo "Geen openstaande orders op dit artikel!";
}

mysql_free_result($openorderdetails_query);

echo "</TABLE>\n";
echo "</FORM>\n";

printenddoc();

?>
