<?php
/**
 *
 * @version $Id: invoice_payment.php,v 1.43 2007-04-18 15:21:58 iwan Exp $
 *
 * @copyright 2004
 **/

include ("include.php");

define("EMAIL_SELECTION", 'Email selectie');

$bl_submit = isset($_POST["submit"]);
$bl_email = isset($_POST["email"]);
$bl_print = isset($_POST["print"]) ? 1 : FALSE;
$bl_print = isset($_GET["print"]) ? 2 : FALSE;
$bl_incasso = isset($_GET["incasso"]);
$str_format = isset($_GET["format"]) ? $_GET["format"] : FORMAT_PDF;
$str_format = isset($_POST["format"]) ? $_POST["format"] : $str_format;
$int_shipID = isset($_POST["shipID"]) ? $_POST["shipID"] : FALSE;
$int_shipID = isset($_GET["shipID"]) ? $_GET["shipID"] : $int_shipID;
$str_order_date = isset($_POST["OrderDate"]) ? $_POST["OrderDate"] : "";
$str_ship_date = isset($_POST["ShipDate"]) ? $_POST["ShipDate"] : "";
$bl_original = isset($_GET["original"]);
$int_invoice_id = isset($_POST["invoice"]) ? $_POST["invoice"] : FALSE;
$int_invoice_id = isset($_GET["invoice"]) && !$int_invoice_id ? $_GET["invoice"] : $int_invoice_id;
$int_cust_id = isset($_REQUEST["ContactID"]) ? $_REQUEST["ContactID"] : FALSE;
$int_cust_id = isset($_GET["ContactID"]) && !$int_cust_id ? $_GET["ContactID"] : $int_cust_id;
$int_startrec = isset($_POST["startrec"]) ? $_POST["startrec"] : FALSE;
$int_paied = isset($_GET["payed"]) ? $_GET["payed"] : INVALID;
$int_paied = isset($_POST["payed"]) ? $_POST["payed"] : $int_paied;
$int_paymenterm = isset($_POST["Payment_Term"]) ? $_POST["Payment_Term"] : FALSE;
//$int_paymenterm = $bl_incasso ? DB_PAYMENT_TERM_AUTOMATIC_INCASSO_ID : $int_paymenterm;
$int_overdue_type = isset($_GET["overdue_type"]) ? $_GET["overdue_type"] : FALSE ;
$bl_zw = GetCheckBox("nocolor") ? 1 : GetCheckBox("nocolor", FALSE);

// Check if this is ok tobe invoice.
if ($int_invoice_id) {
	PrintInvoiceID($int_invoice_id, $bl_original, $str_format, $bl_print, !$bl_zw);
} else {

    // Print default Iwex HTML header.
    printheader (COMPANYNAME . " invoice screen", "invoices", !$bl_print||!$bl_ext_print);

    echo "<body ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"invoiceform\">\n";
  	// Used for calendar function.
   	echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

	printIwexNav();

    // Check which which records page need to be displayed.	
    if (isset($_POST['next'])
        ||
        isset($_POST['priv'])) {
        if (isset($_POST['next'])) {
           $int_startrec += LIMITSIZE;
        } else if (isset($_POST['priv'])) {
           $int_startrec -= LIMITSIZE;
        }
    } else {
        $int_startrec = 0;
    }
    //echo "s:$int_startrec, n:$next, p:$priv";

   	// Create a query to select the payments
    $sql_invoices = SQL_INVOICES_PAYMENT;
    $sqlwhere =queryparm('CustomerID', $int_cust_id, "", 0);
    $sqlwhere.=queryparm('InvoiceID', $int_invoice_id, $sqlwhere);
    $sqlwhere.=queryparm('OrderDate',$str_order_date, $sqlwhere);
    $sqlwhere.=queryparm('ShippedDate',$str_ship_date, $sqlwhere);
	$sqlwhere.=queryparm('overduetypeID',$int_overdue_type, $sqlwhere);
    if ($bl_incasso) {
        // Set update date
        $db_iwex->query("UPDATE events 
                         SET action_performed_date = NOW(),
                         action_done_by = '$employee_id'
                         WHERE id = 3");
        $int_paied = 0; // Set paid to false.
		$sqlwhere.=queryparm('incasso','1', $sqlwhere);
	}
    $str_payed = $int_paied == INVALID ? "" : $int_paied;
    $sqlwhere.=queryparm('paid_yn', $str_payed, $sqlwhere);
    $sqlwhere.=queryparm('paymentterm',$int_paymenterm, $sqlwhere);
    $sql_invoices .= $sqlwhere . ' ORDER BY InvoiceID DESC';
	
    $query = mysql_query($sql_invoices)
       or die("Ongeldige query: " . mysql_error());

    $numberofrecords = mysql_Numrows($query);
    mysql_free_result($query);	
    
    $sql_invoices .= ' LIMIT ' . $int_startrec . ',' . LIMITSIZE;
    
    //        echo $sql;
    $query = mysql_query($sql_invoices)
    or die("Ongeldige query: " .$sql_invoices. mysql_error());
   
    // now get the totals of the selection
    $sql_totals = "SELECT sum(Invoice_total + Invoice_BTW - paid_amount) AS open_all
                     FROM invoices 
                     LEFT JOIN paymentterm ON Paymentterm = PaymentTermID ";
    !$sqlwhere ? $sqlwhere_extra = " WHERE " : $sqlwhere_extra = $sqlwhere . " AND ";
    $sql_totals .=   $sqlwhere_extra . " NOT paid_yn ";
    
    $query_totals = mysql_query($sql_totals)
       or die("Ongeldige query: " . $sql_totals . ' : ' . mysql_error());
       
    if ($obj_totals = mysql_fetch_object($query_totals)) $flt_open_amount = $obj_totals->open_all ;
    
    mysql_free_result($query_totals);
       
    $flt_overdue_amount = Overdue($int_cust_id, TRUE);

    echo "<TABLE WIDTH=\"100%\"BORDER=\"1\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "    <TR>\n";
    echo '         <th colspan="4">Zoektermen</th>',"\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "         <TD>Invoice ID</TD><TD><INPUT TYPE=\"text\" NAME=\"invoice\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_invoice_id."\"></TD>\n";
    echo "         <TD>Company ID/Name</TD><TD><INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_cust_id."\" OnChange=\"TempContacts_id.value = ContactID.value\">/";
    echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "invoiceform.ContactID", "cust");
    echo "		  </TD>\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "         <TD>Order Datum</TD><TD><INPUT TYPE=\"text\" NAME=\"OrderDate\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_order_date."\">".Add_Calendar('invoiceform.OrderDate')."</TD>\n";
    echo "         <TD>Ship Datum</TD><TD><INPUT TYPE=\"text\" NAME=\"ShipDate\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_ship_date."\">".Add_Calendar('invoiceform.ShipDate')."</TD>\n";
    echo "    </TR>\n";
    echo "    <tr>\n";
    echo "      <td>";
    echo "Betaald</TD>";
    echo '<td><select name="payed"><option value='.INVALID.'>-</option>
        <option value=1';
    if ($int_paied && $int_paied != INVALID) echo ' selected';
    echo '>Ja</option>
        <option value=0';
    if (!$int_paied) echo ' selected';
    echo '>Nee</option>
        </select></td>';
    echo "    <TD>Betalingsvorm</td><td>"
         .makelistbox('SELECT PaymentTermID, Description FROM paymentterm','Payment_Term','PaymentTermID','Description',$int_paymenterm)."</td>";
	echo "    </TR>\n";
    echo "    <TR>\n";
    echo "     <td>".MakeCheckBox("nocolor", $bl_zw)." Zwart wit</td>";
    echo '     <TD><input TYPE="radio" NAME="format" VALUE="html"';
    if ($str_format == FORMAT_HTML) echo " CHECKED";
    echo '>scherm';
    echo '<input TYPE="radio" NAME="format" VALUE="pdf"';
    if ($str_format == FORMAT_PDF) echo " CHECKED";
    echo '>PDF</td><td></td><td>Openstaand: <b>'.ToDutchNumber($flt_open_amount).'</b>, Te laat: <b>'.ToDutchNumber($flt_overdue_amount).'</b></td>';    
    echo "    <TR>\n";
    echo '	<TD COLSPAN="3" >';
    
    $pagetotal = $numberofrecords/LIMITSIZE +1;
    $pagenum =($numberofrecords/LIMITSIZE - $int_startrec/LIMITSIZE) +1;
    echo 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
    echo ' van '. (int)$pagetotal;
    
    if ($numberofrecords > LIMITSIZE) {
        if ($numberofrecords-LIMITSIZE> $int_startrec) {		
            echo '		<INPUT TYPE="submit" NAME="next" value="<" CLASS="button">';
        }
        if ($int_startrec > 0)
            echo '		<INPUT TYPE="submit" NAME="priv" value=">" CLASS="button">';
        echo '		<INPUT TYPE="hidden" NAME="startrec" value="'.$int_startrec.'">';
    }
    echo "    </TD><TD ALIGN='right'>";
    echo "<INPUT TYPE=\"button\" NAME=\"overdue\" VALUE=\"PDF overzicht te laat\" CLASS=\"button\" onClick=\"location='invoice_payment_pdf.php?overdue=1'\"> ";
    echo "<INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Zoeken\" CLASS=\"button\">\n";


	if ($int_cust_id) {
        echo "<INPUT TYPE=\"button\" NAME=\"email\" VALUE=\"E-mailen\" CLASS=\"button\"
               onClick=\"window.open('"
               .INVOICE_PAYMENT_EMAIL."?custid=$int_cust_id','email_invoices_due',"
               .STANDARD_WINDOW.")\">";
    } 
    echo "</TD>\n";
    echo "    </TR>\n";
    echo "</TABLE>\n";

    // Set cursor to default location		  
    echo '<script TYPE="text/javascript" language="JavaScript">document.invoiceform.invoice.focus();</script>';
       
?>
<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
  <tr>
    <th>Invoice ID</th>
    <th>Customer</th>
    <th>ShipName</th>
    <th>Date</th>
    <th>Amount</th>
    <th>Paid amount</th>
    <th>Paid date</th>
    <th>Rente</th>
  </tr>
<?php
	$int_num = 0;
	$ary_overdue_customers = array();
    while ($objshipment = mysql_fetch_object($query)) {
		$int_type_id = FALSE;
		$str_type = FALSE;

	    if (!$objshipment->paid_yn) { 
			if ($objshipment->dayslate > 0) { 
                // When outside the paymentterm;
                if ($objshipment->DispuutID == DB_INVOICE_OVERDUE_DISPUUT) {
                	$bgcolor=NOT_PAID_DISPUUT_BGCOLOR;
            	} else {
            		$bgcolor=NOT_PAID_OVERDUE_BGCOLOR;
            	}
            } else {
                $bgcolor=NOT_PAID_NOT_OVERDUE_BGCOLOR;
            }
            $int_days = round((strtotime("now")-strtotime($objshipment->Invoice_date))/(60*60*24));
            $str_days = "($int_days - $objshipment->days = ".(int) $objshipment->dayslate.")";
            $bgcolor_paid = "";
        } else { 
            $bgcolor=PAID_BGCOLOR;
            $str_days = "(".((int) $objshipment->dayslate + $objshipment->days).")";
            if ($objshipment->dayslate > 0) { 
                // When outside the paymentterm;
                $bgcolor_paid = PAID_OVERDUE_BGCOLOR;
            } else {
                $bgcolor_paid = PAID_BGCOLOR;
            }
        }
        echo "<tr>\n"
            ."<td bgcolor='$bgcolor' align=right><b><a href='".$_SERVER['PHP_SELF']."?invoice=$objshipment->InvoiceID";
        if ($bl_zw) {
            echo "&nocolor=on";
        }
        
        
        echo "'>$objshipment->InvoiceID</a></b></td>"
            .'<td><a href='.contacts.'?custid='.$objshipment->CustomerID.'>'.$objshipment->companyName.'</a></td>'
            .'<td>'.$objshipment->ShipName.'</td>'
            .'<td>'.$objshipment->Invoice_date.'</td>'
            .'<td align=right>'.$objshipment->amount.'</td>'
            .'<td align=right>'.$objshipment->paid_amount.'</td>'
            ."<td bgcolor='$bgcolor_paid'>$objshipment->paid_date $str_days</td>"
			."<td align=right bgcolor='$bgcolor_paid'>".ToDutchNumber($objshipment->intrest)."</td>"
            ."\n".'</tr>';
        echo "\n";
    }
	mysql_free_result($query); 
	
	echo '</table>';
echo "</FORM>\n";

    printenddoc();
}
?>
