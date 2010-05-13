<?
/*
 * purchase_maint.php
 *
 * @version $Id: purchase_maint.php,v 1.31 2006-07-04 14:28:30 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");
// get all the form vars
// integer vars
$int_po_id = isset($_POST["purchaseorderID"]) ? $_POST["purchaseorderID"] : FALSE;
$int_po_id = isset($_GET["purchaseorderID"]) && !$int_po_id ? $_GET["purchaseorderID"] : $int_po_id;
$int_po_supplier = isset($_POST["po_supplier"]) ? $_POST["po_supplier"] : FALSE;
$int_po_emp = isset($_POST["po_emp"]) ? $_POST["po_emp"] : FALSE;
$int_po_shipmethod = isset($_POST["po_shipmethod"]) ? $_POST["po_shipmethod"] : FALSE; 
$int_po_currency = isset($_POST["po_currency"]) ? $_POST["po_currency"] : FALSE; 
$int_status = isset($_POST["status"]) ? $_POST["status"] : FALSE; 
$int_po_buyer = isset($_POST["po_buyer"]) ? $_POST["po_buyer"] : OWN_COMPANYID;
// boolean vars 
$bl_update = isset($_POST["update"]);
$bl_po_btw = isset($_POST["po_btw"]);
$bl_delete = isset($_POST["delete"]);
$bl_new = isset($_GET["new"]);
$bl_sentok = isset($_GET["sent"]);
$bl_override = GetCheckbox('override');
// char vars
$ch_notes = isset($_POST["notes"]) ? $_POST["notes"] : '';
$ch_po_orderdate = isset($_POST["po_orderdate"]) ? $_POST["po_orderdate"] : '';
$ch_po_shipdate = isset($_POST["po_shipdate"]) ? $_POST["po_shipdate"] : '';
$ch_po_shipadres = isset($_POST["po_shipadres"]) ? $_POST["po_shipadres"] : DB_IWEX_MAGAZIJN_CUST_ID;
$ch_PO_sent = isset($_POST["PO_sent"]) ? $_POST["PO_sent"] : '';

//first update the status of the PO
if ($int_po_id) upd_po_status($int_po_id);

// set Db connect
$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " inkooporder beheer", "n.v.t.", !$bl_delete);

if ($bl_new) { // first see if we need to insert a purchase order
    $sql_insert_po = "INSERT INTO purchase_orders SET 						
						buyer_contactID = '$int_po_buyer',
						ship_adresID = '$ch_po_shipadres',
						OrderDate='".date("Y-m-d")."'";
    $result = $DB_iwex->query($sql_insert_po);
    $int_po_id = $DB_iwex->lastinserted();
    echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"po_maint\">\n";
    echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>";
    $bl_new = FALSE;
    printIwexNav();
} else if ($bl_delete) {
    $sql_update = "DELETE FROM purchase_orders WHERE PurchaseOrderID = $int_po_id AND (NOT PO_sent OR isnull(PO_sent))";
    $DB_iwex->query($sql_update);
    $int_po_id = 0;
    echo "<INPUT TYPE=\"button\" NAME=\"list\" onClick=\"location.replace('purchase_sel.php');\" VALUE=\"Return to list\">\n";
    echo "<BODY onLoad=\"location.replace('purchase_sel.php');\"><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"po_maint\">\n";
} else {    
    echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"po_maint\">\n";
    echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>";
    printIwexNav();
}


$sql_select_po = "SELECT purchase_orders.*, statustext FROM purchase_orders
     LEFT JOIN status ON purchase_orders.status = status.statusID ";

if ($bl_update) {
    $sql_data_change = "purchase_orders SET 
        PurchaseOrderDescription = '$ch_notes',
        SupplierID = '$int_po_supplier',
        EmployeeID = '$int_po_emp',
        OrderDate = '$ch_po_orderdate',
        ShipDate = '$ch_po_shipdate',
        ship_adresID = '$ch_po_shipadres',
        ShippingMethodID = '$int_po_shipmethod',
        Order_currency = '$int_po_currency',
        btw_yn = '$bl_po_btw',
        status = '$int_status',
        PO_sent = ".insertDate($ch_PO_sent).",
        buyer_contactID = '$int_po_buyer'";
}
                
// Set cursor on the new entry.		  
echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";

if ($int_po_id) {
    if ($bl_update&&(!$ch_PO_sent||$bl_override)) {
        $sql_update = "UPDATE ". $sql_data_change. " WHERE PurchaseOrderID = $int_po_id";
        $DB_iwex->query($sql_update);
    }
    
    if ($bl_sentok) {
        $sql_sentok = "UPDATE purchase_orders SET po_sent = '".date("Y-m-d H:i")."' WHERE PurchaseOrderID = $int_po_id";
        $DB_iwex->query($sql_sentok);
    }
    
	$sql_select_po .= "WHERE PurchaseOrderID = $int_po_id";

    $qry_po = $DB_iwex->query($sql_select_po);
    
    if ($obj = mysql_fetch_object($qry_po)) {    
        echo "    <TR>\n";
        echo "         <TH colspan='4'>";
        echo " <B>Inkoop Ordernummer $obj->PurchaseOrderID</B><INPUT TYPE='hidden' NAME='purchaseorderID' VALUE='$obj->PurchaseOrderID'></TH>\n";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Buyer</TD><TD>".makelistbox('SELECT ContactID, CompanyName FROM contacts WHERE warehouse_customer = 1 ORDER BY CompanyName;','po_buyer','ContactID','CompanyName',$obj->buyer_contactID)."</td><td></td><td></td>";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Supplier</TD><TD>".makelistbox('SELECT ContactID, CompanyName FROM contacts WHERE Supplier_yn <> 0 ORDER BY CompanyName;','po_supplier','ContactID','CompanyName',$obj->SupplierID)."</td>";
        $obj->EmployeeID = $obj->EmployeeID ? $obj->EmployeeID : $employee_id;
        echo "		   <td>Inkoper</td><td>".makelistbox('SELECT EmployeeID, Firstname FROM employees;','po_emp','EmployeeID','Firstname',$obj->EmployeeID)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Ship Adres</td><td>".makelistbox('SELECT AdresID, Naam FROM Adressen WHERE ContactID = '.OWN_COMPANYID.';','po_shipadres','AdresID','Naam',$obj->ship_adresID)."</td>";
        echo "		   <td>Order Datum</td><td><input type=\"text\" size=\"20\" name=\"po_orderdate\" value=\"".date($obj->OrderDate)."\">";
        echo  Add_Calendar('po_maint.po_orderdate')."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Notities</td><td><textarea name=\"notes\" cols=\"40\" rows=\"1\">$obj->PurchaseOrderDescription</textarea></td>";
        echo "		   <td>status</td><td>".makelistbox('SELECT statusID, statustext FROM status WHERE category=1;','status','statusID','statustext',$obj->status)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Valuta</td><td>".makelistbox('SELECT ValutaID, ValutaName FROM valuta','po_currency','ValutaID','ValutaName',$obj->Order_currency)."</td>";
        echo "		   <td>BTW / VAT</td><td>".MakeCheckbox("po_btw", $obj->btw_yn)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Datum Besteld</td><td>";
        if (!$bl_override || $obj->PO_sent) {
            echo $obj->PO_sent."<INPUT TYPE='hidden' NAME='PO_sent' VALUE='$obj->PO_sent'>";
        } else {
            echo "<INPUT TYPE='text' NAME='PO_sent' VALUE='$obj->PO_sent'> ";
            echo Add_Calendar('po_maint.PO_sent');
        }
        echo "</td>";
        echo "		   <td>Verzend methode</td><td>".makelistbox('SELECT ShippingMethodID, ShippingMethod FROM shipping_methods','po_shipmethod','ShippingMethodID','ShippingMethod',$obj->ShippingMethodID)."</td>";
        echo "    </TR>\n";
        echo "    <TR>\n<td colspan='4'>";
        echo "          override".MakeCheckbox('override',$bl_override)."<INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\">\n";
        echo "          <INPUT TYPE=\"button\" NAME=\"list\" onClick=\"location.replace('purchase_sel.php');\" VALUE=\"Return\">\n";
        if ($bl_override||!$obj->PO_sent) echo "          <INPUT TYPE=\"submit\" NAME=\"delete\" VALUE=\"delete\" CLASS=\"button\">\n";
        if ($bl_override||$obj->ship_adresID&&$obj->EmployeeID&&$obj->SupplierID&&$obj->ShippingMethodID) {
            echo "Send: <INPUT TYPE=\"button\" NAME=\"send\" onClick=\"location.replace('purchase_report.php?poID=$obj->PurchaseOrderID&format=asci&print_bo=true');\" VALUE=\"text\">\n";
            echo "<INPUT TYPE=\"button\" NAME=\"send\" onClick=\"location.replace('purchase_report.php?poID=$obj->PurchaseOrderID&format=html&print_bo=true');\" VALUE=\"html\"> ";
            echo "<INPUT TYPE=\"button\" NAME=\"sendpdf\" onClick=\"location.replace('purchase_report.php?poID=$obj->PurchaseOrderID&format=pdf&send=1&print_bo=true');";
            echo "\" VALUE=\"Send PDF\">\n";
            echo "<INPUT TYPE=\"button\" NAME=\"Showpdf\" onClick=\"window.open('purchase_report.php?poID=$obj->PurchaseOrderID&format=pdf','POpdf','scrollbars=1, toolbar=0,menubar=0,resizable=1,dependent=0,status=0,width=800,height=600,left=25,top=25');";
            echo "\" VALUE=\"Show PDF\">\n";
        }
        if (!($int_po_buyer == OWN_COMPANYID)) {
            echo "<INPUT TYPE=\"button\" NAME=\"buyer_update\" onClick=\"location.replace('purchase_report.php?poID=$obj->PurchaseOrderID&format=html&print_bo=false&buyer=true');\" VALUE=\"Update Owner\"> ";
        } 
        echo "</TD>\n</TR>\n";
        echo "</table>";
        // Place cursor in the field.
        echo '<script TYPE="text/javascript" language="JavaScript">document.po_maint.po_supplier.focus();</script>';

        echo ShowPoDetails($bl_update, $int_po_id,!$obj->PO_sent||$bl_override, $int_po_supplier, $int_po_currency);
    }
    mysql_free_result($qry_po);
}

echo "</FORM>";
printenddoc();

?>
