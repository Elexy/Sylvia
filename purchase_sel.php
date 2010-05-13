<?php

/**
 * purchase.php
 *
 * @version $Id: purchase_sel.php,v 1.19 2006-07-04 14:28:30 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
// boolean vars
$bl_print = isset($_POST["print"]) ? TRUE : FALSE;
$bl_submit = isset($_POST["submit"]) ? TRUE : FALSE;
$bl_next = isset($_POST["next"]) ? TRUE : FALSE;
$bl_priv = isset($_POST["priv"]) ? TRUE : FALSE;
$bl_update_status = isset($_POST["update_status"]) ? TRUE : FALSE;
// int vars
$int_contactID = GetSetFormVar("contactID");
$int_poID = isset($_POST["poID"]) ? $_POST["poID"] : FALSE;
$int_status = isset($_POST["status"]) ? $_POST["status"] : FALSE;
$int_buyer = isset($_POST["buyer_contactID"]) ? $_POST["buyer_contactID"] : FALSE;
// character vars
$int_companyname = isset($_POST["companyname"]) ? $_POST["companyname"] : FALSE;
$int_orderdate = isset($_POST["orderdate"]) ? $_POST["orderdate"] : FALSE;

if ($int_contactID) {
    $_SESSION['contactID'] = $int_contactID;
} else {
    if ($int_contactID === '0') {
        $int_contactID = FALSE;
        unset($_SESSION['contactID']);
    } else {
        $int_contactID = isset($_SESSION['contactID']) ? $_SESSION['contactID'] : FALSE;
    }
}


// Print default Iwex HTML header.
printheader (COMPANYNAME . " purchase order selection screen", "orders", !$int_poID);

echo "<body ".get_bgcolor()."";
if ($int_poID) {
    echo " OnLoad='location.replace(\"purchase_maint.php?purchaseorderID=$int_poID\");'";
}
echo "><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"orderform\" onSubmit=\"return checkData()\">\n";
printIwexNav();

// Check which which records page need to be displayed.	
$startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;

if ($bl_next  || $bl_priv) {
    if ($bl_next) {
       $startrec += LIMITSIZE;
    } else if ($bl_priv) {
       $startrec -= LIMITSIZE;
    }
} else {
    $startrec = 0;
}
//echo "s:$startrec, n:$next, p:$priv";
// Get data
$sql = 'SELECT PurchaseOrderID, CompanyName, ContactID, OrderDate, status, PO_sent FROM purchase_orders 
        LEFT JOIN contacts ON purchase_orders.SupplierID = contacts.ContactID';
$sqlwhere = "";
$sqlwhere.=queryparm('PurchaseOrderID', $int_poID, $sqlwhere, 0);
$sqlwhere.=queryparm('CompanyName', $int_companyname, $sqlwhere);
$sqlwhere.=queryparm('OrderDate',$int_orderdate, $sqlwhere);
$sqlwhere.=queryparm('ContactID',$int_contactID, $sqlwhere, 0);
$sqlwhere.=queryparm('buyer_contactID',$int_buyer, $sqlwhere, 0);
$sqlwhere.=queryparm('status',$int_status, $sqlwhere);
$sql.= $sqlwhere . ' ORDER BY PurchaseOrderID DESC';

$query = mysql_query($sql)
or die("Ongeldige query: " .$sql. "<br>" . mysql_error());
$numberofrecords = mysql_Numrows($query);
mysql_free_result($query);	

$sql .= ' LIMIT ' . $startrec . ',' . LIMITSIZE;
$query = mysql_query($sql)
or die("Ongeldige query: " .$sql. mysql_error());

echo "<TABLE WIDTH=\"100%\"BORDER=\"1\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
echo "    <TR>\n";
echo '         <th colspan="4">Zoektermen</th>',"\n";
echo "    </TR>\n";
echo "    <TR>\n";
echo "         <TD>Buyer</TD><TD>".makelistbox('SELECT ContactID, CompanyName FROM contacts WHERE warehouse_customer = 1 ORDER BY CompanyName;','buyer_contactID','ContactID','CompanyName', '$obj->buyer_contactID')."</td><td></td><td></td>";       
echo "         <TD></TD><TD></TD>\n";
echo "    </TR>\n";
echo "    <TR>\n";
echo "         <TD>Purchase Order ID</TD><TD><INPUT TYPE=\"text\" NAME=\"poID\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_poID."\"></TD>\n";
echo "         <TD>Company ID/Name</TD><TD><INPUT TYPE=\"text\" NAME=\"contactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_contactID."\" OnChange=\"TempContacts_id.value = ContactID.value\">";
echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "contactID", "customername", "orderform.contactID", "cust");
if ($int_contactID) echo "		  <A HREF='purchase_receive.php?supplier=$int_contactID'>Openstaand</A>";
echo "         <small> (0 for all)</small></TD>\n";
echo "    </TR>\n";
echo "    <TR>\n";
echo "         <TD>Order Datum</TD><TD><INPUT TYPE=\"text\" NAME=\"orderdate\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_orderdate."\">".Add_Calendar('orderform.OrderDate')."</TD>\n";
echo "         <TD>Status</TD><TD>".makelistbox('SELECT statusID, statustext FROM status WHERE category=1;','status','statusID','statustext',$int_status)."</TD>\n";
echo "    </TR>\n";
echo "    <TR>\n";
echo '	<TD COLSPAN="3" >';
echo "<table border=0><tr>\n"
		  	  ."<td bgcolor=".OPENORDER_BGCOLOR.">Sent</td>"
		 	  ."<td bgcolor=".PARTSHIP_BGCOLOR.">Deellevering</td>"
			  ."<td bgcolor=".COMPLETE_BGCOLOR.">Compleet</td>\n</tr></table>";	

$pagetotal = $numberofrecords/LIMITSIZE +1;
$pagenum =($numberofrecords/LIMITSIZE - $startrec/LIMITSIZE) +1;
echo 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
echo ' van '. (int)$pagetotal;

if ($numberofrecords > LIMITSIZE) {
    if ($numberofrecords-LIMITSIZE> $startrec) {		
    echo '		<INPUT TYPE="submit" NAME="next" value="<" CLASS="button">';
    }
    if ($startrec > 0)
    echo '		<INPUT TYPE="submit" NAME="priv" value=">" CLASS="button">';
    echo '		<INPUT TYPE="hidden" NAME="startrec" value="'.$startrec.'">';
}
echo "    </TD><TD ALIGN='right'><INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Zoeken\" CLASS=\"button\">\n";
echo "    <INPUT TYPE=\"button\" NAME=\"new\" onClick=\"location.replace('purchase_maint.php?new=1');\" VALUE=\"Nieuw\">\n";
echo "</TD>\n";
echo "    </TR>\n";
echo "</TABLE>\n";
echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
    <tr>
       <th>supplier</th>
       <th>PO ID</th>
       <th>Order aangemaakt</th>
       <th>Order verzonden</th>
    </tr>';
while ($obj = mysql_fetch_object($query)) {
   $po_state = ($obj->status);
    if ($po_state==1) {
        $bgcolor=OPENORDER_BGCOLOR;
    } else if ($po_state==2) {
        $bgcolor=PARTSHIP_BGCOLOR;
    } else if ($po_state==3) {
        $bgcolor=COMPLETE_BGCOLOR;
    } else if (!$po_state) {
        $bgcolor=QOUTE_BGCOLOR;
    } else {
        $bgcolor='#FFFFFF';
    }
    echo '<tr>';
    echo '<td BGCOLOR='.$bgcolor.'>'.$obj->CompanyName.'</td>';
    echo '<td BGCOLOR='.$bgcolor.'><a href=purchase_maint.php?purchaseorderID='.$obj->PurchaseOrderID.'>'.$obj->PurchaseOrderID.'</a></td>';
    echo '<td BGCOLOR='.$bgcolor.'>';
    if ($obj->OrderDate) {
        echo date(DATEFORMAT_SHORT, strtotime($obj->OrderDate)).'</td>';
    } else {
        echo '</td>';
    }
    echo '<td BGCOLOR='.$bgcolor.'>';
    if ($obj->PO_sent) {
        echo date(DATEFORMAT_SHORT, strtotime($obj->PO_sent)).'</td>';
    } else {
        echo '</td>';
    }
    echo '</tr>';
}

mysql_free_result($query);

echo "</TABLE>\n";
echo "</FORM>\n";

printenddoc();


?>
