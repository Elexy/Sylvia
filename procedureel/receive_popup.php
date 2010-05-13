<?php
 /*
 * receive_popup.php
 *
 * @version $Id: receive_popup.php,v 1.9 2005-03-29 15:19:47 alex Exp $
 * @copyright $date:
 **/

include ("include.php");
// get all the form vars
// integer vars
$int_podetailsID = isset($_POST["podetailsID"]) ? $_POST["podetailsID"] : FALSE;
$int_podetailsID = isset($_GET["podetailsID"]) && !$int_podetailsID ? $_GET["podetailsID"] : $int_podetailsID;
$int_received_amount = isset($_POST["received_amount"]) ? $_POST["received_amount"] : FALSE;
// boolean vars 
$bl_submit = isset($_POST["submit"]);

// set Db connect
$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader ("receive products","",FALSE);

echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"receive_form\">\n";

$int_buyer_contactID = getfield("
    SELECT buyer_contactID FROM purchase_orders
    INNER JOIN po_details on purchase_orders.PurchaseOrderID = po_details.poID
    WHERE po_details.podetailsID = '$int_podetailsID'");
$int_buyer_contactID ? $int_buyer_contactID : OWN_COMPANYID;

$sql_po_details = SQL_PO_DETAIL_QUERY . " WHERE podetailsID = '$int_podetailsID';";
//echo $sql_po_details;
// Get the data.
$qry_select_po_details = $DB_iwex->query($sql_po_details);
$obj_po_detail = mysql_fetch_object($qry_select_po_details);

if ($int_received_amount > $obj_po_detail->to_deliver) $int_received_amount = $obj_po_detail->to_deliver;

if ($int_received_amount&&$obj_po_detail)
{   
  if (inventory_transaction(
    date("Y-m-d"),
    $obj_po_detail->productID,
    NULL,
    $obj_po_detail->ExternalID,
    $obj_po_detail->poID,
    $obj_po_detail->podetailsID,
    NULL,
    NULL,
    NULL,
    NULL,
    $obj_po_detail->unitprice,
    $int_received_amount,
    NULL,
    NULL,
    $obj_po_detail->tax_percentage,
    $obj_po_detail->added_cost,
    NULL,
    $employee_id,
    $int_buyer_contactID))
  {
    $sql_update_to_deliver = "UPDATE po_details SET
                to_deliver =  to_deliver-'$int_received_amount'
                WHERE podetailsID = '$int_podetailsID'";
    //echo $sql_update_podetails.'<br>';
    if($DB_iwex->query($sql_update_to_deliver))
    {
      echo "<script type='text/javascript'>window.close();</script>";
    }
  } else
  {
    echo "there is a problem with the inventory_transaction function";
  }
}

mysql_free_result($qry_select_po_details);
// Get the data.
$qry_select_po_details = $DB_iwex->query($sql_po_details);

if ($obj_po_detail = mysql_fetch_object($qry_select_po_details))
{
  echo "stock: " . getfreestock($obj_po_detail->productID,0,$int_buyer_contactID) . "<br>";
  echo "Naam: $obj_po_detail->ProductName<br>\n";
  echo "ID: $obj_po_detail->productID <br>\n";
  echo "External ID: ".$obj_po_detail->ExternalID."<br>\n";
  echo "comments: ".$obj_po_detail->comments."<br><br>\n";
  echo "Ontvangen aantal max($obj_po_detail->to_deliver) :<INPUT TYPE=text NAME=received_amount><br>\n";
  echo "<INPUT TYPE=submit NAME=submit VALUE=submit>
        <INPUT TYPE=hidden NAME=podetailsID VALUE=$int_podetailsID><br>\n";
  // Set cursor in the input box
  echo "<script TYPE='text/javascript' language='JavaScript'>document.receive_form.received_amount.focus();</script>";
}

echo "</FORM>\n";

printenddoc();

?>
