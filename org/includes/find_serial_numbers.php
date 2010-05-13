<?php

/**
 * store_serial_number.php
 *
 * @version $Id: find_serial_numbers.php,v 1.5 2007-06-01 14:43:19 iwan Exp $
 * @copyright $date:
 **/

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';

// Get all the URL variable we need.
$bl_submit = isset($_POST["submit"]);
$bl_close = isset($_GET["close"]) ? $_GET["close"] : TRUE;
$str_serial = isset($_REQUEST["number"]) ? $_REQUEST["number"] : FALSE;
$int_productid = isset($_REQUEST["productid"]) ? $_REQUEST["productid"] : '';
$int_customerid = isset($_REQUEST["ContactID"]) ? $_REQUEST["ContactID"] : '';

/**
 * Function     : FindSerialNumbers
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_transaction_id, The id of the transaction
 *				  bl_auto_close, when true windows closes when finished.
 * Returns      : A complete formatted string that contains the call information.
 **/
function FindSerialNumbers($str_serialnum,
                           $int_product_id = '',
                           $int_customer_id = '') {
    global $_GLOBAL;
    $str_return = '';
    $DB_iwex = new DB();
    $str_serialnum = trim($str_serialnum);
    if (!$str_serialnum
        &&
        $int_product_id == ''
        &&
        $int_customer_id == '') {
        return ""; // Notthing to do.
    }
    $sql_serials = "SELECT transactiondate, Serial, 
                    inventory_transactions.OrderID, inventory_transactions.orderdetailsID, 
                    inventory_transactions.shipmentID, inventory_transactions.PurchaseOrderID, 
                    RMAID, inventory_transactions.stock_owner_id,
                    inventory_transactions.ProductID, orders.ContactID, order_details.ProductName, InvoiceID
                    FROM Serialnumbers
                    LEFT JOIN inventory_transactions ON inventory_transactions.TransactionID = Inventory_transactionID
                    LEFT JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID 
                    LEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID 
                    LEFT JOIN RMA_actions on order_details.RMA_actionID = RMA_actions.actionID
					LEFT JOIN invoices ON inventory_transactions.shipmentID = invoices.shipmentID";
    $sql_where  = queryparm('Serial', $str_serialnum);
    $sql_where .= queryparm('inventory_transactions.ProductID', $int_product_id, $sql_where, 0);
    $sql_where .= queryparm('orders.ContactID', $int_customer_id, $sql_where, 0);
    $sql_serials .= $sql_where . " ORDER BY SerialRecordID DESC";
    //echo $sql_serials;
    $qry_select = $DB_iwex->query($sql_serials);

    // Check which which records page need to be displayed.	
    $next = isset($_POST['next']) ;
    $priv = isset($_POST['priv']) ;
    
    $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;
    
    if ($next||$priv) {
        if ($next) {
           $startrec -= LIMITSIZE;
        } else if ($priv) {
           $startrec += LIMITSIZE;
        }
    } 
    
    $transaction_result = $DB_iwex->query($sql_serials);
    $numberofrecords = mysql_numrows($transaction_result);
    $sql = $sql_serials . ' LIMIT ' . $startrec . ',' . LIMITSIZE;
    //        echo $sql;
    $transaction_result = $DB_iwex->query($sql);

    // print todays transactions
    $str_return .= '<TABLE WIDTH="100%" BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody">'."\n";
    $pagetotal = $numberofrecords/LIMITSIZE +1;
    $pagenum =($numberofrecords/LIMITSIZE - $startrec/LIMITSIZE) +1;
    $str_return .= 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
    $str_return .= ' van '. (int)$pagetotal;
    
    if ($numberofrecords > LIMITSIZE) {
        if ($numberofrecords-LIMITSIZE> $startrec) {		
            $str_return .= '		<INPUT TYPE="submit" NAME="priv" value="<" CLASS="button">';
        }
        if ($startrec > 0) {
            $str_return .= '		<INPUT TYPE="submit" NAME="next" value=">" CLASS="button">';
        }
        $str_return .= '		<INPUT TYPE="hidden" NAME="startrec" value="'.$startrec.'">';
    }
      
    $str_return .= '<TR valign="top">'."\n";
    $str_return .= '<th>Date</th>
        <th>Serial</th>
        <th>Product ID</th>
        <th>Product name</th>
		<th>OrderID</th>
        <th>Invoice</th>
		<th>Shipment</th>
        <th>PO ID</th>
        <th>RMA ID</th>
        <th>Owner</th>';
    $str_return .= '</TR>'."\n";
    While ($obj = mysql_fetch_object($transaction_result))
    {
        $str_return .= '<TR valign="top">'."\n";
        $str_return .= '    <td>'.date("d-M-y",strtotime($obj->transactiondate)).'</td>';
        $str_return .= '    <td>'.$obj->Serial.'</td>';
        $str_return .= '    <td>'.$obj->ProductID.'</td>';
        $str_return .= '    <td>'.$obj->ProductName.'</td>';
		$str_return .= '    <td>'. ($obj->OrderID ? '<A TARGET=new HREF="'.$_GLOBAL["str_backdir"].'order.php?orderID='.$obj->OrderID.'" '
				.ShowShortContactInfo($obj->ContactID).'>'.$obj->OrderID.'</A>':'-') ."</td>";
		$str_return .= '    <td>'. ($obj->InvoiceID ? '<A TARGET=new HREF="'.INVOICE_PAYMENT.'?invoice='.$obj->InvoiceID.'">'.$obj->InvoiceID.'</A>':'-') ."</td>";
		$str_return .= '    <td>'. ($obj->shipmentID ? '<A TARGET=new  HREF="'.$_GLOBAL["str_backdir"].'shipment.php?shipmentID='.$obj->shipmentID.'">'.$obj->shipmentID.'</A>' : '-') .'</td>';
        $str_return .= '    <td>'.($obj->PurchaseOrderID ? "<a target=_new href='".$_GLOBAL["str_backdir"]."purchase_maint.php?purchaseorderID=$obj->PurchaseOrderID'>$obj->PurchaseOrderID</a>": "-").'</td>';
        $str_return .= '    <td>'.($obj->RMAID ? '<A TARGET=new HREF="'.$_GLOBAL["str_backdir"].'rma.php?rmaid='.$obj->RMAID.'">'.$obj->RMAID.'</a>' : '-') . '</td>';
        $str_return .= "    <td><a href='customer_maint.php?custid=$obj->stock_owner_id' "
                     .ShowShortContactInfo($obj->stock_owner_id)
                     ."target=_new>$obj->stock_owner_id</a></td>\n";
        $str_return .= '</TR>'."\n";
    }
    $str_return .= '</table>'."\n";
    
    $sql_rma_serial = "SELECT ID, SN, RMA.ProductID, current_product_list.ProductName, Customer_ID, Date_in, Notes
                       FROM RMA
                       LEFT JOIN RMA_actions ON RMAID = ID 
                       LEFT JOIN current_product_list ON RMA.ProductID = current_product_list.ProductID ";
    $sql_where  = queryparm('SN', $str_serialnum);
    $sql_where .= queryparm('RMA.ProductID', $int_product_id, $sql_where, 0);
    $sql_where .= queryparm('Customer_ID', $int_customer_id, $sql_where, 0);
    $sql_where .= queryparm('Notes', $str_serialnum, $sql_where, 1, 'OR');

    $sql_rma = $sql_rma_serial . $sql_where;
    $transaction_result_rma = $DB_iwex->query($sql_rma);

    // print todays transactions
    $str_return .= '<p><TABLE WIDTH="100%" BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody">'."\n";
      
    $str_return .= '<TR valign="top">'."\n";
    $str_return .= '<th>Date</th>
        <th>Serial</th>
        <th>Product ID</th>
        <th>Product name</th>
        <th>RMA ID</th>
        <th>Notes</th>';
    $str_return .= '</TR>'."\n";
    While ($obj = mysql_fetch_object($transaction_result_rma))
    {
        $str_return .= '<TR valign="top">'."\n";
        $str_return .= '    <td>'.date("d-M-y",strtotime($obj->Date_in)).'</td>';
        $str_return .= '    <td>'.$obj->SN.'</td>';
        $str_return .= '    <td>'.$obj->ProductID.'</td>';
        $str_return .= '    <td>'.$obj->ProductName.'</td>';
        $str_return .= '    <td>'.($obj->ID ? '<A TARGET=new HREF="'.$_GLOBAL["str_backdir"].'rma.php?rmaid='.$obj->ID.'">'.$obj->ID.'</a>' : '-') . '</td>';
        $str_return .= '    <td>'.$obj->Notes.'</td>';
        $str_return .= '</TR>'."\n";
    }
    $str_return .= '</TABLE></p>'."\n";
    
    return $str_return;
}
 

// Print default Iwex HTML header.
printheader (COMPANYNAME . " show serial numbers screen", "serial");

echo "<body ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"serialform\"\">\n";
// Used for overlib
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
printIwexNav();   
echo "<TABLE \"BORDER=\"1\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
echo "    <TR>\n";
echo '         <th colspan="2">Zoektermen</th>',"\n";
echo "    </TR>\n";   
    echo "<td>Serial number to look for:</td><td> <INPUT TYPE='text' NAME='number' VALUE='$str_serial'></td></tr>\n";
    echo "<tr><td>Product ID to look for:</td><td>";
    echo GetRecordIdInputField(SQL_SEARCH_PRODUCTS_LIST,
                               "ID",
                               "productid",
                               "serialform.productid",
                               "product",
                               15,
                               $int_productid)."</td></tr>";
    echo "<tr><td>Customer id to look for: </td><td><INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_customerid."\">/";
	echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "serialform.ContactID", "cust");
    echo "</td></tr></table><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\"><br> ";
    echo FindSerialNumbers($str_serial, $int_productid, $int_customerid);

echo "</FORM>\n";

printenddoc();

?>
