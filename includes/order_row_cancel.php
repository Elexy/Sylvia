<?php

/**
 * order_row_cancel.php
 *
 * @version $Id: order_row_cancel.php,v 1.5 2006-07-04 14:28:31 iwan Exp $
 * @copyright  $Date: 2006-07-04 14:28:31 $:
 **/

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';

// Get all the URL variable we need.
$bl_submit = isset($_POST["submit"]);
$int_customerID = isset($_REQUEST["customerID"]) ? $_REQUEST["customerID"] : FALSE;
$int_orderdetailID = isset($_REQUEST["orderdetailid"]) ? $_REQUEST["orderdetailid"] : FALSE;

$DB_iwex = new DB();
$sql_row = "SELECT order_details.Quantity, order_details.ProductID, order_details.OrderID,"
            . ' to_deliver, orders.ContactID, '
            . ' current_product_list.ProductName'
            . ' FROM order_details'
            . ' LEFT JOIN current_product_list ON order_details.ProductID = current_product_list.ProductID '
            . ' INNER JOIN orders ON order_details.OrderID = orders.OrderID'
            . " WHERE order_details.OrderDetailsID = '$int_orderdetailID'";

if ($bl_submit && $_POST["notesNew"]) {
    $qry_row = $DB_iwex->query($sql_row);

    if ($obj = mysql_fetch_object($qry_row)) {
        if (isset($_POST["todeliver"]) 
            && 
            $obj->ContactID == $int_customerID
            &&
            $_POST["todeliver"] != $_POST["old_to_deliver"]) {
            $sql_update = "UPDATE order_details SET 
                           to_deliver = '".$_POST["todeliver"]."'
                           WHERE order_details.OrderDetailsID = '$int_orderdetailID'";
            $DB_iwex->query($sql_update);
            // Update the order status.
            upd_orderstatus($obj->OrderID);
            SetOrderHistory($obj->OrderID, 
                            $_POST["subject"], 
                            $_POST["todeliver"] . "<br>".$_POST["notesNew"],
                            0,
                            $_POST["old_to_deliver"]);
            echo "<SCRIPT>window.close();\n</SCRIPT>";
        }
    }
} else if ($bl_submit && !$_POST["notesNew"])  {
    echo "<h2>Gespreks verslag moet ingevuld zijn!</h2>";
}

$qry_row = $DB_iwex->query($sql_row);
 
// Print default Iwex HTML header.
printheader (COMPANYNAME . " order detail change screen", "lockedchange");

    echo "<body><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"adresform\"\">\n";
	// Used for calendar function.
	echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';


    if ($obj = mysql_fetch_object($qry_row)) {
        echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
    
        echo "<tr><td><b>Onderwerp</b></td><td><input size=\"50\" name=\"subject\" type=\"text\" value=\"Backorder changed $obj->ProductID\"></td></tr>\n";
        echo "<tr><td>Gespreks/e-mail verslag:</td><td><textarea name=\"notesNew\" cols=\"50\" rows=\"2\"></textarea></td></tr>\n";
        echo "</table>";
        
        echo "<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" class=\"blockbody\">\n";
        echo "<tr><th>ProductID</th><th>Name</th><th>Besteld</th><th>Te Leveren</th></tr>\n";
        echo "<tr><td align=center>$obj->ProductID</td><td>$obj->ProductName</td><td align=right>$obj->Quantity</td>";
        echo "<td align=right><input type=text align=right size=3 name=todeliver value='$obj->to_deliver'></td></td>\n";
        echo "<input type=hidden name=old_to_deliver value='$obj->to_deliver'>";
    }
    mysql_free_result($qry_row);
    
    echo "</table>";
    
    echo "<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\">";
    echo " Voor klant: ".getcontactname($int_customerID);
    echo "<INPUT TYPE='hidden' NAME='customerID' VALUE='$int_customerID'>";
    echo "<INPUT TYPE=hidden name=orderdetailid VALUE='$int_orderdetailID'>";
    
echo "</FORM>\n";

printenddoc();

?>
