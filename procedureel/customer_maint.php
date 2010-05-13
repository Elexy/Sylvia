<?
/*
 * dealer_request_response.php
 *
 * @version $Id: customer_maint.php,v 1.22 2007-07-29 14:41:19 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

$int_cust_id = isset($_POST["custid"]) ? $_POST["custid"] : FALSE;
$int_cust_id = isset($_GET["custid"]) && !$int_cust_id ? $_GET["custid"] : $int_cust_id;

$int_cust_id_new = isset($_POST["custidnew"]) && $_POST["custidnew"] !='' ? $_POST["custidnew"] : FALSE;

$bl_update = isset($_POST["update"]);
$bl_new = isset($_POST["new"]);

if ($int_cust_id_new 
    && 
    ($int_cust_id_new != $int_cust_id)) {
    $int_cust_id = $int_cust_id_new;
    $bl_update = FALSE;
}

$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " klanten beheer");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"customer\">\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();

$sql_select_customer = "SELECT * FROM contacts ";

if ($bl_update) {
    $sql_data_change = "contacts SET 
        CompanyName = '".$_POST["customername"]."', 
        Country = '".$_POST["country"]."', 
        website = '".$_POST["website"]."', 
        btw_number = '".$_POST["btw_number"]."', 
        Phone = '".$_POST["phone"]."', 
        Fax = '".$_POST["fax"]."', 
        kvk_number = '".$_POST["kvk_number"]."', 
        email = '".$_POST["email"]."', 
        Notes = '".$_POST["notes"]."',
        UPSaccount = '".$_POST["upsaccount"]."',
        Bankinfo =  '".$_POST["bankinfo"]."',
        mailing = ".GetCheckbox("mailing").",
        Dealer_yn = ".GetCheckbox("dealer").",
        Supplier_yn = ".GetCheckbox("leverancier").",
        pricelevel = '".$_POST["pricelevel"]."',
        Paymentterm = '".$_POST["Payment_Term"]."',
        ordercosts = '".GetCheckBox('ordercosts')."',
        transportcost = '".GetCheckBox('transportcost')."',
        warehouse_customer = '".GetCheckBox('warehouse_customer')."',
        CreditLimit = '".$_POST["creditlimit"]."'";
}

if ($bl_new) {
    $DB_iwex->query("INSERT INTO contacts SET CompanyName = 'new', Country ='NL'");
    $int_cust_id = $DB_iwex->lastinserted();
}

echo "Klant nummer : <INPUT TYPE='text' NAME='custidnew' VALUE='' SIZE=\"5\">  ";
echo "Zoek naam ".GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "CustomerID", "customernametemp", "customer.custidnew", "cust"); 
echo " postcode of adres ".GetRecordIdInputField(SQL_SEARCH_CUSTOMER_ADRES_LIST, 
                                                 "CustomerID", 
                                                 "customeradrestmp", 
                                                 "customer.custidnew", 
                                                 "custadres",
                                                 10); 
// Set cursor on the new entry.		  
echo '<script TYPE="text/javascript" language="JavaScript">document.customer.custid.focus();</script>';
      
if ($int_cust_id) { 
    if ($bl_update) {
        $sql_update = "UPDATE ". $sql_data_change. " WHERE ContactID = $int_cust_id";
        $DB_iwex->query($sql_update);
    }

	$sql_select_customer .= "WHERE ContactID = '$int_cust_id'";

    $qry_customers = $DB_iwex->query($sql_select_customer);
        if ($obj = mysql_fetch_object($qry_customers)) {
    
        echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
        echo "    <TR>\n";
        echo "         <TH colspan='4'>";
        echo " <B>ID $obj->ContactID</B><INPUT TYPE='hidden' NAME='custid' VALUE='$obj->ContactID'></TH>\n";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Company name</TD><TD><INPUT TYPE=\"text\" NAME=\"customername\" SIZE=\"30\" CLASS=\"form\" value=\"$obj->CompanyName\"></td>";
        echo "         <td>Mailing ".MakeCheckbox("mailing", $obj->mailing)."</td><td>Dealer "
             .MakeCheckbox("dealer", $obj->Dealer_yn)." Leverancier ".MakeCheckbox("leverancier", $obj->Supplier_yn)."
             Warehouse Customer ".MakeCheckbox("warehouse_customer", $obj->warehouse_customer)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Telefoon</td><td><input type=\"text\" size=\"25\" name=\"phone\" value=\"$obj->Phone\"></td>";
		echo "		   <td>BTW nummer</td><td><input type=\"text\" size=\"25\" name=\"btw_number\" value=\"$obj->btw_number\"> "
				.CheckBTWlink($obj->Country, $obj->btw_number, "check")
				." of <a href='".EU_TAX_WEBSITE_URL."' target='_new'>zelf</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Fax</td><td><input type=\"text\" size=\"25\" name=\"fax\" value=\"$obj->Fax\"></td>";
        echo "		   <td>KVK nummer</td><td><input type=\"text\" size=\"25\" name=\"kvk_number\" value=\"$obj->kvk_number\"> ".CheckKVKlink($obj->kvk_number)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>E-mail</td><td><input type=\"text\" size=\"25\" name=\"email\" value=\"$obj->email\"> <a href='mailto:$obj->email'>E-mail</a></td>";
         echo "		   <td>UPS account</td><td><input type=\"text\" size=\"8\" name=\"upsaccount\" value=\"$obj->UPSaccount\"></td>";
       echo "    </TR>\n<TR>\n";
        if (strpos ($obj->website, "http") === false) {
            $str_website = "http://$obj->website";
        } else {
           $str_website = $obj->website; 
        }
        echo "		   <td>Website</td><td><input type=\"text\" size=\"25\" name=\"website\" value=\"$obj->website\"> <a href='$str_website' target='_new'>Link</a></td>";
        echo "		   <td>Bankrek. num.</td><td><input type=\"text\" size=\"25\" name=\"bankinfo\" value=\"$obj->Bankinfo\"></td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Land</td><td>".makelistbox('SELECT code, country FROM country ORDER BY country','country','code','country',$obj->Country)."</td>";
        echo "         <TD>Pricelevel</TD><td>".makelistbox('SELECT id, Description FROM pricelevel','pricelevel','id','Description',$obj->pricelevel)
             .makelistbox('SELECT PaymentTermID, Description FROM paymentterm','Payment_Term','PaymentTermID','Description',$obj->Paymentterm)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Notities</td><td><textarea name=\"notes\" cols=\"40\" rows=\"3\">$obj->Notes</textarea></td>";
        echo "		   <td>Order kosten ".MakeCheckBox('ordercosts', $obj->ordercosts)
                     ."</td><td>Verzend kosten buitenland ".MakeCheckBox('transportcost', $obj->transportcost)."</td>";
        $flt_open_amount = GetOpenInvoiceAmount($int_cust_id);
        $flt_unbooked_amount = GetUnBookedAmount($int_cust_id);
        $credit_bgcolor = ($obj->CreditLimit - $flt_open_amount + $flt_unbooked_amount) >= 0 ? PAID_BGCOLOR : NOT_PAID_OVERDUE_BGCOLOR;
        echo "    </TR>\n<TR  bgcolor='$credit_bgcolor'>\n";
        echo "      <td>Crediet limiet</td><td>&euro; <input type=\"text\" size=\"8\" name=\"creditlimit\" value=\"$obj->CreditLimit\">";
        if ($credit_bgcolor == PAID_BGCOLOR) echo " Max. nog te besteden &euro; ".ToDutchNumber($obj->CreditLimit - $flt_open_amount + $flt_unbooked_amount);
        echo "</td>\n";
        echo "      <td>Totaal openstaand:</td><td>&euro; ".ToDutchNumber($flt_open_amount)."\n";
        echo "      Totaal ongeboekt: &euro; ".ToDutchNumber($flt_unbooked_amount)."</td>\n";
        echo "    </TR>\n<TR>\n";
        echo "			<td colspan='4'>";
        echo "<INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\">\n";
        echo "<INPUT TYPE='button' NAME='calls' VALUE='Gesprekken' onClick=\"window.open('includes/calls.php?customerID=$int_cust_id'";
        echo ",'show_calls','menubar=yes,directories=no,toolbar=no,resizable=yes,width=850,height=450,scrollbars=yes');\">\n";

        echo "<INPUT TYPE=\"button\" NAME=\"list\" onClick=\"location.replace('".$_SERVER['PHP_SELF']."');\" VALUE=\"Return\">\n";
        echo "<INPUT TYPE=\"button\" NAME=\"shipments\" VALUE=\"Leveringen\" onClick=\"window.open('shiplist.php?contactID=$obj->ContactID','Leveringen',".STANDARD_WINDOW.");\">\n";
        echo "<INPUT TYPE=\"button\" NAME=\"orders\" VALUE=\"Orders\" onClick=\"window.open('order.php?contactID=$obj->ContactID','Orders',".STANDARD_WINDOW.");\">\n";
        echo "<INPUT TYPE=\"button\" NAME=\"new_order\" VALUE=\"Nieuwe order\" onClick=\"window.open('order.php?contactID=$obj->ContactID&new_order=1','Orders',".STANDARD_WINDOW.");\">\n";
        echo "<INPUT TYPE=\"button\" NAME=\"backorders\" onClick=\"window.open('backorder.php?ContactID=$obj->ContactID','Backorders$obj->CompanyName','scrollbars=1, toolbar=0,menubar=0,resizable=1,dependent=0,status=0,width=800,height=500,left=25,top=25');\" VALUE=\"backorders\">\n";
        echo "<INPUT TYPE=\"button\" NAME=\"invoices\" VALUE=\"Betalingen\" onClick=\"window.open('invoice_payment.php?ContactID=$obj->ContactID','Betalingen',".STANDARD_WINDOW.");\">\n";
		echo "<INPUT TYPE=\"button\" NAME=\"invoices\" VALUE=\"Webusers\" onClick=\"window.open('admin/admin_extern.php?contactID=$obj->ContactID','Webusers',".STANDARD_WINDOW.");\">\n";
        echo "<INPUT TYPE=\"submit\" NAME=\"new\" VALUE=\"Nieuwe klant\" CLASS=\"button\" onClick=\"return confirm('Echt een nieuwe klant aanmaken?')\">\n";
        $_SESSION["popup_function"] = "print_payment_details"; //set which function to execute in popup.php
        $_SESSION["popup_parm"] = $int_cust_id; //set What option to use in popup.php
        echo "<input type=\"button\" NAME=\"transactions\" CLASS=\"form\" value=\"Facturen boekingen\"
        onclick= \"window.open('popup.php','popup','toolbar=0,menubar=0,scrollbars=1,resizable=1,dependent=0,status=0,width=800,height=500,left=25,top=25')\">\n";
        echo " <INPUT TYPE=\"button\" NAME='packing' VALUE='Pakbon upload' onclick=\"window.open('upload_popup.php?type=".CUST_PACKING_LIST."','upload popup','toolbar=0,menubar=0,resizable=0,scrollbars=0,status=0,width=400,height=200,left=60,top=25')\">";
        echo " </td>\n</TR>\n";
        echo "</table>";
        
        echo "<br>";
        echo ShowAdresDetails($bl_update, $int_cust_id);
        echo "<br>";
        echo ShowPersonDetails($bl_update, $int_cust_id);
    }
    mysql_free_result($qry_customers);
} else {
    echo "<br><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"submit\" CLASS=\"button\">";
    echo " <INPUT TYPE=\"submit\" NAME=\"new\" VALUE=\"Nieuw\" CLASS=\"button\" onClick=\"return confirm('Echt een nieuwe klant aanmaken?')\">\n";

}
echo "</FORM>";
printenddoc();

?>
