<?
/*
 * bank_trans_to_invoice.php
 *
 * @version $Id: bank_trans_to_invoice.php,v 1.26 2007-03-08 11:24:23 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

$int_trans_id = isset($_GET["transactionid"]) ? $_GET["transactionid"] : FALSE;
$int_startrec = isset($_GET["startrec"]) ? $_GET["startrec"] : FALSE;

$str_trans_date = isset($_GET["trans_date"]) ? $_GET["trans_date"] : "";
$str_amount = isset($_GET["amount"]) ? $_GET["amount"] : "";

$str_description = isset($_GET["description"]) ? $_GET["description"] : "";

$int_cust_id = isset($_GET["custid"]) ? $_GET["custid"] : FALSE;
$int_extra_invoice = isset($_GET["invoiceidextra"]) ? $_GET["invoiceidextra"] : FALSE;

$bl_update = isset($_GET["Update"]);
$bl_deselect = isset($_GET["deselect"]);

$bl_override = GetCheckbox('override', FALSE);

$flt_bank_amount = 0;
$flt_link_sum = 0;

$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " betaling inboeken op facturen");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"GET\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"accountform\">\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

$sql_select_transactions = "SELECT invoices.companyName, invoices.InvoiceID, invoices.Invoice_total, invoices.CustomerID,
                            invoices.Invoice_BTW, invoices.paid_yn, invoices.paid_amount, invoices.paid_date,
                            invoices.Invoice_date, BankTransactionId, link_ID, sum(link_amount) AS link_amount, bank_account_id,
                            paymentterm.days, bank_transactions.amount AS bankamount
                            FROM invoices
                            LEFT JOIN payments_link ON invoices.InvoiceID = payments_link.InvoiceID 
                                                       AND BankTransactionId = $int_trans_id
                            LEFT JOIN bank_transactions ON payments_link.BankTransactionId = bank_transactions.transaction_id
                            LEFT JOIN paymentterm ON Paymentterm = PaymentTermID
                            LEFT JOIN branches ON invoices.CustomerID = branches.BrancheContactID
                            WHERE ";
$sql_select_transactions .= $int_cust_id ? 
                            "(invoices.CustomerID = '$int_cust_id' 
                             OR
                             branches.MainContactID = '$int_cust_id')" :
                            "incasso ";
$sql_select_transactions .= " AND NOT paid_yn OR BankTransactionId = $int_trans_id ";
$sql_select_transactions .= $int_extra_invoice && $bl_override ? // Show also already paid invoices that should be listed.
							" OR invoices.InvoiceID = '$int_extra_invoice'" 
							: "";
$sql_select_transactions .= " GROUP BY InvoiceID";

//    echo $sql_select_transactions;
    $query = $DB_iwex->query($sql_select_transactions);

    if ($bl_update && $waccess_a) {
        // Check if the sum of to be payed is less or equal to the money that was payed.
        $flt_sum_to_book = 0;
        while ($objshipment = mysql_fetch_object($query)) {
            if (isset($_GET["boek$objshipment->InvoiceID"])) {
                $flt_sum_to_book += $_GET["boek$objshipment->InvoiceID"];
            }
            $flt_bank_amount = $objshipment->bankamount ? $objshipment->bankamount : $flt_bank_amount;
            $flt_link_sum += $objshipment->link_amount;
        }
        
        // Only use str_amount when the bank amount can't be found.
        $str_amount = $flt_bank_amount ? $flt_bank_amount : $str_amount;
       
      	mysql_free_result($query);

        if (($flt_sum_to_book <= (round($str_amount, DB_INVOICE_PRECISION) - round($flt_link_sum, DB_INVOICE_PRECISION))+0.005)
            ||
            $bl_override) {
            $query = $DB_iwex->query($sql_select_transactions);

            // Check of data needs to be inserted.
            while ($objshipment = mysql_fetch_object($query)) {
                if (isset($_GET["boek$objshipment->InvoiceID"])
                    && GetCheckBox("toboek$objshipment->InvoiceID", 0)
                    && ($bl_override
                        ||
                        ($_GET["boek$objshipment->InvoiceID"] != 0
                        && 
                        !$objshipment->paid_yn))
                    ) {
                    $flt_total = round($objshipment->Invoice_total + $objshipment->Invoice_BTW, DB_INVOICE_PRECISION);
                    $bl_payed = ($flt_total >= $objshipment->paid_amount + $_GET["boek$objshipment->InvoiceID"] - DB_INVOICE_MARGIN)
                                 && 
                                ($flt_total <= $objshipment->paid_amount + $_GET["boek$objshipment->InvoiceID"] + DB_INVOICE_MARGIN)
                                 ? 1 : 0;
                    $flt_amount_to_add = (($flt_total - $objshipment->paid_amount - $_GET["boek$objshipment->InvoiceID"]) < 0 
                                           &&
                                           !$bl_override)
                                         ? ($flt_total - $objshipment->paid_amount)
                                         : $_GET["boek$objshipment->InvoiceID"];
                    $flt_amount_to_add = round($flt_amount_to_add, DB_INVOICE_PRECISION);

                    $sql_update_invoice = "UPDATE invoices SET 
                                           paid_yn = $bl_payed,
                                           paid_amount = paid_amount + $flt_amount_to_add,
                                           paid_date = '$str_trans_date',
                                           payment_type = '".PAYMENT_ACCOUNT_ID_SYLVIA."'
                                           WHERE InvoiceID = $objshipment->InvoiceID";
                    $DB_iwex->query($sql_update_invoice);
                    $sql_insert_transactions_links = "INSERT INTO payments_link SET 
                                                      BankTransactionID = $int_trans_id, 
                                                      InvoiceID = $objshipment->InvoiceID,
                                                      link_amount = $flt_amount_to_add";
                    $DB_iwex->query($sql_insert_transactions_links);

                } 
            }
            mysql_free_result($query);
        } else {
            echo "<h2>Som van de te boeken bedragen is $flt_sum_to_book waar het bedrag maar $str_amount is waarvan reeds $flt_link_sum al was bijgeboekt.</h2>";
        } 
    
        $query = $DB_iwex->query($sql_select_transactions);        
    }    
    
    $str_cust_name ="";
    $flt_link_sum = 0;
    while ($objshipment = mysql_fetch_object($query)) {
        $flt_link_sum += $objshipment->link_amount;
        $flt_bank_amount = $objshipment->bankamount ? $objshipment->bankamount : $flt_bank_amount;
        $str_cust_name = $objshipment->companyName;
    }
  	mysql_free_result($query);

    echo "\n<table width='100%'><tr>\n";
    echo "<td width=8%>Klant:</td><td><a href=customer_maint.php?custid=$int_cust_id target=_new>$str_cust_name</a></td>";
    echo "<td align=right>";
    if ($waccess_a) {
        echo "<input type='checkbox' name='override' "
             .($bl_override ? "CHECKED" : "")
             ." onChange='javascript:this.form.submit()'> Override";
    }
    echo "</td></tr>\n";
    echo "<tr><td>Kenmerk:</td><td colspan=2>$str_description</td>\n";

    echo "</tr></table>\n<p>";

    if ($flt_bank_amount) {
        $str_amount = round($flt_bank_amount - $flt_link_sum, DB_INVOICE_PRECISION);
        echo "Van de $flt_bank_amount is reeds $flt_link_sum geboekt. Nog $str_amount te boeken. ";
    } else {
        echo "Er zal $str_amount euro worden ingeboekt. ";
    }
    
    if ((!$flt_bank_amount
        ||
        ($str_amount)
        ||
        $bl_override)
        && 
        $waccess_a) {
		echo "Ook factuur nr. <input type=text name='invoiceidextra' value='$int_extra_invoice'> ";
        echo "<INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Update\" CLASS=\"button\"> <INPUT TYPE='submit' NAME='deselect' VALUE='Deselect' CLASS='button'>\n";
    }
    echo "</p>";
    echo "<INPUT TYPE=\"hidden\" NAME=\"amount\" VALUE=\"$str_amount\">\n";
    echo "<INPUT TYPE=\"hidden\" NAME=\"transactionid\" VALUE=\"$int_trans_id\">\n";
    echo "<INPUT TYPE=\"hidden\" NAME=\"custid\" VALUE=\"$int_cust_id\">\n";
    echo "<INPUT TYPE=\"hidden\" NAME=\"trans_date\" VALUE=\"$str_trans_date\">\n";
    echo "<INPUT TYPE=\"hidden\" NAME=\"description\" VALUE=\"$str_description\">\n";
        
    $flt_amount_left = $str_amount;
?>
<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
  <tr>
    <th>Betaald</th>
    <th>Factuur</th>
    <th>Bedrag</th>    
    <th>Reeds betaald</th>
    <th>Factuur datum</th>
    <th>Betaal datum</th>
  </tr>
<?
    $query = $DB_iwex->query($sql_select_transactions);
    
    $flt_link_sum = 0;
    $bl_calculate = TRUE;
    while ($objshipment = mysql_fetch_object($query)) {
	    $bgcolor = GetInvoiceColor($objshipment->InvoiceID,
								   $objshipment->paid_yn,
								   $objshipment->CustomerID,
								   TRUE);
        $flt_total = $objshipment->Invoice_total + $objshipment->Invoice_BTW - $objshipment->paid_amount;
        echo "<tr>\n";
        
        if($flt_total <= 0) {
            // When invoice is a credit use the total credit.
            $flt_to_pay = $flt_total;
        } else if ($flt_amount_left > 0) {
            // When there is money left to pay, pay the whole invoice when it is enough. Else pay what is left.
            $flt_to_pay = $flt_amount_left > $flt_total ? $flt_total : $flt_amount_left;
        } else {
            // No money anymore to pay.
            $flt_to_pay = 0;
        }
        
        $flt_to_pay = $str_amount && $bl_calculate ? round($flt_to_pay, DB_INVOICE_PRECISION) : "0.00";
        
        $flt_to_use = !$bl_update || GetCheckBox("toboek$objshipment->InvoiceID",0) ? $flt_to_pay : "0.00";
		
		if ($bl_deselect) {
			echo "<td><input type='text' name='boek$objshipment->InvoiceID' value='0.00' SIZE='10' align=right 
					   onfocus='this.value=\"\"'>";
        	echo MakeCheckBox("toboek$objshipment->InvoiceID","",
            	              $bl_override || !$objshipment->paid_yn);	
		} else {
			echo "<td><input type='text' name='boek$objshipment->InvoiceID' value='$flt_to_use' SIZE=\"10\" align=right>";
        	echo MakeCheckBox("toboek$objshipment->InvoiceID", 
        	                  !$bl_update && $flt_to_pay <> 0 
        	                    || GetCheckBox("toboek$objshipment->InvoiceID",
        	                                   0),
            	              $bl_override || !$objshipment->paid_yn);
		} 
        echo "</td>";
        echo "<td bgcolor='$bgcolor' align=right><b><a href='invoice_payment.php?invoice=$objshipment->InvoiceID";
        echo "&color=on' ".ShowShortContactInfo($objshipment->CustomerID, "");
        echo " target=_new>$objshipment->InvoiceID</a></b></td>"
            .'<td align=right>'. sprintf("%.2f",$objshipment->Invoice_total + $objshipment->Invoice_BTW).'</td>'
            .'<td align=right>';
        if (GetField("SELECT link_ID 
                      FROM payments_link 
                      WHERE InvoiceID = '$objshipment->InvoiceID' AND BankTransactionID = '$int_trans_id'")) {
            echo "($objshipment->link_amount) =&gt; ";
        }
        echo "$objshipment->paid_amount</td><td>$objshipment->Invoice_date</td>"
            .'<td>'.$objshipment->paid_date.'</td>'
            ."\n".'</tr>';
        echo "\n";
        
        if (!$bl_update || GetCheckBox("toboek$objshipment->InvoiceID", 0)) { 
            $flt_link_sum += $objshipment->link_amount;
            // When the money left was less then the invoice set money left to 0. Else substract the amount payed.
            $flt_amount_left -= $flt_total > $flt_amount_left ? $flt_amount_left : $flt_total;
            // Stop when the value is 0.
            $bl_calculate = $flt_amount_left && $bl_calculate;
        }
//        echo "flt_link_sum = $flt_link_sum<br>flt_amount_left = $flt_amount_left<br>bl_calculate = $bl_calculate<br>";
    }
	mysql_free_result($query); 	  

    echo "</table>";
    
    if ($str_amount) {
        echo "<h2>Bedrag over ". ToDutchNumber($str_amount)." euro!</h2>";
    }
echo "</FORM>";
printenddoc();

?>
