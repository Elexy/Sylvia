<?
/*
 * /contacts/maintain.php
 *
 * @version $Id: maintain.php,v 1.49 2007-07-29 14:41:19 iwan Exp $
 * @copyright $date:
 **/

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';
include 'contact_functions.php';

$int_cust_id = GetSetFormVar("custid",TRUE, TRUE, "custid");
$int_cust_id_new = GetSetFormVar("custidnew", TRUE);
$bl_update = isset($_POST["update_var"]) ? $_POST["update_var"] : FALSE;
$bl_update = isset($_POST["update"]) ? isset($_POST["update"]) : $bl_update;
$bl_new = isset($_POST["new"]);
if (isset($_POST["calccredit"]) && $_POST["calccredit"]) {
	$bl_calccredit = TRUE;
	$bl_update = TRUE;	
} else {
	$bl_calccredit = FALSE;
}

$str_type_main = GetSetFormVar("maintype",True,'general','maintype');
$str_last_main = GetSetFormVar("lastmain",True);
$str_type_sub = GetSetFormVar("subtype",True,True,'subtype');

$str_type_sub = isset($_POST["str_type_sub"]) ? $_POST["str_type_sub"] : $str_type_sub;
$str_type_main = isset($_POST["str_type_main"]) ? $_POST["str_type_main"] : $str_type_main;

if ($str_last_main !== $str_type_main) $str_type_sub = '';
if (isset($_GET["str_type_sub"])) $str_type_sub = $_GET["str_type_sub"];
//main tabs
$tabs_main = array('general;Algemeen',
                   'crm;Verkoop',
                   'purchase;Inkoop',
                   'irene;Irene',
                   'financial;Financieel',
                   'mail;E-mail',
                   'statistics;Statistiek');
// sub tabs
$tabs_general= array('base;Stamgegevens','calls;Gesprekken','person;Personen','address;Adressen','rma;RMA','options;Options');
$tabs_crm= array('orders;Orders',
                 'shipping;Shipment',
                 'backorder;Backorders',
                 'product_prices;Product prijzen',
                 'special_prices;Speciale prijzen',
                 'omzet;Omzet',
				 'branches;Branches');
$tabs_purchase= array('po;Inkoop','prices;Prijzen');
$tabs_irene= array('users;Users');
$tabs_financial= array('invoices;Facturen','payment;Betalingen','paylink;Boekingen','limits;Crediet limiet');
$tabs_mail = array('sales;Verkoop',
                   'admin;Administratie',
				   'rma;RMA',
                   'info;Algemeen');
$tabs_statistics= array('selltrhough;Sell Through');
$Iframe_Width = '100%';
$Iframe_Height = '700';

$formname = 'customer';

if ($int_cust_id_new 
    && 
    ($int_cust_id_new !== $int_cust_id)) {
    $int_cust_id = $int_cust_id_new;
	$str_type_main = 'general';	
    $bl_update = FALSE;
}
$DB_iwex = new DB();
	

// Print default Iwex HTML header.
printheader (COMPANYNAME . " klanten beheer","n.v.t.", TRUE);

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"$formname\">\n";
echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>";
    
printIwexNav();

$sql_select_customer = "SELECT * FROM contacts ";

if ($bl_update) {
    $sql_data_change = "contacts SET ";
	$sql_data_change .= isset($_POST["customername"]) ?  "CompanyName = '".$_POST["customername"]."', " : false ; 
    $sql_data_change .= isset($_POST["country"]) ? "Country = '".$_POST["country"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["languageID"]) ? "languageID = '".$_POST["languageID"]."', " : false ;
    $sql_data_change .= isset($_POST["website"]) ? "website = '".$_POST["website"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["btw_number"]) ? "btw_number = '".$_POST["btw_number"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["phone"]) ? "Phone = '".$_POST["phone"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["fax"]) ? "Fax = '".$_POST["fax"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["kvk_number"]) ? "kvk_number = '".$_POST["kvk_number"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["email"]) ? "email = '".$_POST["email"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["notes"]) ? "Notes = '".$_POST["notes"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["paymentterm_margin"]) ? "Paymentterm_margin = '".$_POST["paymentterm_margin"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["upsaccount"]) ? "UPSaccount = '".$_POST["upsaccount"]."', " : FALSE;
    $sql_data_change .= isset($_POST["bankinfo"]) ? "Bankinfo =  '".$_POST["bankinfo"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "mailing = ".GetCheckbox("mailing").", " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "Dealer_yn = ".GetCheckbox("dealer").", " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "Supplier_yn = ".GetCheckbox("leverancier").", " : FALSE ;
    $sql_data_change .= isset($_POST["pricelevel"]) ? "pricelevel = '".$_POST["pricelevel"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["Payment_Term"]) ? "Paymentterm = '".$_POST["Payment_Term"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "ordercosts = '".GetCheckBox('ordercosts')."', " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "transportcost = '".GetCheckBox('transportcost')."', " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "warehouse_customer = '".GetCheckBox('warehouse_customer')."', " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "consignment = '".GetCheckBox('consignment')."', " : FALSE ;
    $sql_data_change .= isset($_POST["options"]) ? "use_btw = '".GetCheckBox('use_btw')."', " : FALSE ;

    $sql_data_change .= isset($_POST["ordercostid"]) ? "ordercost_type_id = '".$_POST["ordercostid"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["invoice_option"]) ? "invoice_option = '".$_POST["invoice_option"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["invoice_copies"]) ? "invoice_copies = '".$_POST["invoice_copies"]."', " : FALSE ;
    $sql_data_change .= isset($_POST["invoice_copies_iwex"]) ? "invoice_copies_iwex = '".$_POST["invoice_copies_iwex"]."', " : FALSE ;
	$sql_data_change .= isset($_POST["options"]) ? "confirm_delivery = '".GetCheckBox('confirm_delivery')."', " : FALSE ;
    $sql_data_change .= "ContactID = $int_cust_id ";
    //echo $sql_data_change;
}

if ($bl_new) {
	$int_cust_id = create_contact();
}

echo "<INPUT TYPE='hidden' NAME='maintype' VALUE='$str_type_main'>";
echo "<INPUT TYPE='hidden' NAME='subtype' VALUE='$str_type_sub'>";

echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
echo "    <TR>\n";
echo "         <TH>Klant nummer : <INPUT TYPE='text' NAME='custidnew' VALUE='' SIZE=\"5\"
	onchange=\"document.$formname.submit();\"></TH>\n";
echo "<TH>Zoek naam ".GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "CustomerID", "customernametemp", "customer.custidnew", "cust")."</TH><TH>";
echo " postcode of adres ".GetRecordIdInputField(SQL_SEARCH_CUSTOMER_ADRES_LIST, 
                                                 "CustomerID", 
                                                 "customeradrestmp", 
                                                 "customer.custidnew", 
                                                 "custadres",
                                                 10)."</TH>\n"; 
echo "<TH><INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\">
	  <INPUT TYPE=\"hidden\" NAME=\"update_var\" VALUE=\"0\">
	  <INPUT TYPE=\"submit\" NAME=\"new\" VALUE=\"Nieuwe klant\" CLASS=\"button\" onClick=\"return confirm('Echt een nieuwe klant aanmaken?')\"></TH>\n";    
echo "    </TR>\n";
echo "</table>";

echo "<script TYPE='text/javascript' language='JavaScript'>
        document.customer.custidnew.focus();
        </script>";
        
if ($bl_update) {
    $sql_update = "UPDATE ". $sql_data_change. " WHERE ContactID = $int_cust_id";
    $DB_iwex->query($sql_update);
}

$sql_select_customer .= "WHERE ContactID = '$int_cust_id'";
//echo $sql_select_customer;
$qry_customers = $DB_iwex->query($sql_select_customer);
if ($obj = mysql_fetch_object($qry_customers)) {
    echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
	echo "    <TR>\n";
	echo "         <TH>ContactID: <B>" . $obj->ContactID . "</B>
					<INPUT TYPE='hidden' NAME='custid' VALUE='$int_cust_id'>
					<INPUT TYPE='hidden' NAME='lastmain' VALUE='$str_type_main'></TH>
					<TH>Company name: " . $obj->CompanyName . "</TH>\n";
	echo "    </TR>\n";
	echo "</table>";
	echo tab($tabs_main,$str_type_main,'customer','maintype'); // main tabs
	// main tab general
        If ($str_type_main == 'general' || !$str_type_main) {

        echo tab($tabs_general,$str_type_sub,'customer','subtype'); //General tabs
		if ($str_type_sub == 'calls') {
            echo ShowCallDetails($bl_update, $int_cust_id);
        } else if ($str_type_sub == 'base' || !$str_type_sub) {
            echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
            echo "    <TR>\n";
            echo "         <TD>Company name</TD><TD><INPUT TYPE=\"text\" NAME=\"customername\" SIZE=\"30\" CLASS=\"form\" value=\"$obj->CompanyName\"></td>";
            echo "         <td></td><td></td>";
            echo "    </TR>\n<TR>\n";
            echo "		   <td>Telefoon</td><td><input type=\"text\" size=\"25\" name=\"phone\" value=\"$obj->Phone\"></td>";
			echo "		   <td>BTW nummer</td><td><input type=\"text\" size=\"25\" name=\"btw_number\" value=\"$obj->btw_number\"> ".CheckBTWlink($obj->Country, $obj->btw_number, "check")." of <a href='".EU_TAX_WEBSITE_URL."' target='_new'>zelf</td>";
            echo "    </TR>\n<TR>\n";
            echo "		   <td>Fax</td><td><input type=\"text\" size=\"25\" name=\"fax\" value=\"$obj->Fax\"></td>";
            echo "		   <td>KVK nummer</td><td><input type=\"text\" size=\"25\" name=\"kvk_number\" value=\"$obj->kvk_number\"> ".CheckKVKlink($obj->kvk_number)."</td>";
            echo "    </TR>\n<TR>\n";
            echo "		   <td>E-mail</td><td><input type=\"text\" size=\"25\" name=\"email\" value=\"$obj->email\"> <a href='mailto:$obj->email'>E-mail</a></td>";
            echo "		   <td>UPS account</td><td><input type=\"text\" size=\"8\" name=\"upsaccount\" value=\"$obj->UPSaccount\">";
            $_SESSION["popup_parm"] = $int_cust_id; //set What option to use in popup.php
			echo "			<INPUT TYPE=\"button\" NAME='packing' VALUE='Pakbon upload' onclick=\"window.open('" . upload_popup . "?type=".CUST_PACKING_LIST."','upload popup','toolbar=0,menubar=0,resizable=0,scrollbars=0,status=0,width=400,height=200,left=60,top=25')\"></td>";
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
			echo "<TR><TD>Language:</TD><TD>" .  makelistbox("SELECT languageID, language FROM languages ",  "languageID","languageID", "language", $obj->languageID) . "</TD></TR>";
            echo "         <TD>Pricelevel</TD><td>".makelistbox('SELECT id, Description FROM pricelevel','pricelevel','id','Description',$obj->pricelevel)
                 .makelistbox('SELECT PaymentTermID, Description 
							   FROM paymentterm ','Payment_Term','PaymentTermID','Description',$obj->Paymentterm)."</td>";
            echo "    </TR>\n<TR>\n";
            echo "		   <td>Notities</td><td><textarea name=\"notes\" cols=\"40\" rows=\"3\">$obj->Notes</textarea></td>";
			echo "         <td>Betalings termijn marge<br>Allow shipment</TD>
                           <TD><input type=\"text\" size=\"2\" name=\"paymentterm_margin\" value=\"$obj->Paymentterm_margin\"><br>"
                           . grant_shipment($int_cust_id, TRUE, $bl_update,FALSE,$GLOBALS["waccess_a"])."</td>";		
            $flt_open_amount = GetOpenInvoiceAmount($int_cust_id);
            $flt_unbooked_amount = GetUnBookedAmount($int_cust_id);
			$flt_credit_limit = GetCreditLimit($int_cust_id);
            $credit_bgcolor = ($flt_credit_limit - $flt_open_amount + $flt_unbooked_amount) >= 0 ? PAID_BGCOLOR : NOT_PAID_OVERDUE_BGCOLOR;
		    echo "    </TR>\n<TR  bgcolor='$credit_bgcolor'>\n";
            echo "      <td>Crediet limiet</td><td>&euro; $flt_credit_limit";

            if ($credit_bgcolor == PAID_BGCOLOR) echo " Max. nog te besteden &euro; ".ToDutchNumber($flt_credit_limit - $flt_open_amount + $flt_unbooked_amount);
            echo "</td>\n";
            echo "      <td>Totaal openstaand:</td><td>&euro; ".ToDutchNumber($flt_open_amount)."\n";
            echo "      Totaal ongeboekt: &euro; ".ToDutchNumber($flt_unbooked_amount)."</td>\n";
            echo " </td>\n</TR>\n";
            echo "</table>";

        } else if ($str_type_sub == 'person') {
            echo ShowPersonDetails($bl_update, $int_cust_id);
        } else if ($str_type_sub == 'address') {
            echo ShowAdresDetails($bl_update, $int_cust_id);
        } else if ($str_type_sub == 'rma') {
            echo iframe("rma.php?ContactID=$obj->ContactID",'RMA',$Iframe_Width,$Iframe_Height);         
		} else if ($str_type_sub == 'options') {
            echo "<TABLE BORDER=\"1\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
            echo "    <TR>\n<td>Mailing</td><td>".MakeCheckbox("mailing", $obj->mailing)."</td>\n</TR>";
            echo "    <TR>\n<td>Dealer</td><td>".MakeCheckbox("dealer", $obj->Dealer_yn)."</td>\n</TR>";
            echo "    <TR>\n<td>Leverancier</td><td>".MakeCheckbox("leverancier", $obj->Supplier_yn)."</td>\n</TR>";
            echo "    <TR>\n<td>Warehouse Customer</td><td>".MakeCheckbox("warehouse_customer", $obj->warehouse_customer)."</td>\n</TR>";
            echo "    <TR>\n<td>Consignment</td><td>".MakeCheckbox("consignment", $obj->consignment)."</td>\n</TR>";
            echo "    <TR>\n<td>Factuur met BTW</td><td>".MakeCheckbox("use_btw", $obj->use_btw)."</td>\n</TR>";
			echo "	  <TR>\n<TD>Order Verzend kosten schema</td><td>".makelistbox("SELECT OrderCostID, Description, 
                        CONCAT(Description , '/WOC-' , WeborderCost , ':' , MinWebOrderAmount, '/OC-' , OrderCost, ':', MinOrderAmount , '/SC-' , ShippingCost) as display
                                              FROM ordercost_type
                                              ORDER BY Description",
                                              'ordercostid',
                                              'OrderCostID',
                                              'display',
                                              $obj->ordercost_type_id)."</td>\n</TR>";
            echo "	<TR>\n<td>Factuur opties:</td><td>";
			echo	checkbox(DB_INVOICE_OPTION_LISTBOX, $obj->invoice_option);
			echo "	</td>\n</TR>";
            echo "	<TR>\n<td>Aantal klant facturen per post:</td><td><INPUT TYPE='text' NAME='invoice_copies' VALUE='".$obj->invoice_copies."' SIZE='1'></TR>";
			echo "	<TR>\n<td>Aantal facturen ".COMPANYNAME.":</td><td><INPUT TYPE='text' NAME='invoice_copies_iwex' VALUE='".$obj->invoice_copies_iwex."' SIZE='1'></TR>";
            echo "  <TR>\n<td>Levering Bevestingen:</td><td>".MakeCheckbox("confirm_delivery",$obj->confirm_delivery)."</td>\n</TR>";
			echo  " <TR>\n<TD>VAT</td><td>".MakeCheckBox('VAT', $obj->VAT)."</td>\n</TR>";
		   
/*			echo "	  <TR>\n<TD>Order kosten</td><td>".MakeCheckBox('ordercosts', $obj->ordercosts)."</td>\n</TR>";
            echo "	  <TR>\n<TD>Verzend kosten buitenland</td><td>".MakeCheckBox('transportcost', $obj->transportcost)."</td>\n</TR>";*/
			echo "</table>";
            echo "<input type=hidden name=options value=1>";
			echo "Consignment details: ";
			echo ShowConsignmentDetails($int_cust_id);
		}
	} else if ($str_type_main == 'crm') {  // Maintab CRM
        echo tab($tabs_crm,$str_type_sub,'customer','subtype'); //crm tabs
        
        if ($str_type_sub == 'orders' || !$str_type_sub) {
            echo iframe("order.php?contactID=$obj->ContactID",'orders',$Iframe_Width,$Iframe_Height); 
        } else if ($str_type_sub == 'shipping') {
            echo iframe("shiplist.php?contactID=$obj->ContactID",'Shipping',$Iframe_Width,$Iframe_Height);         
		} else if ($str_type_sub == 'backorder') {
            echo iframe("backorder.php?ContactID=$obj->ContactID",'Shipping',$Iframe_Width,$Iframe_Height);         
		} else if ($str_type_sub == 'product_prices') {
            echo iframe("products/product_sel.php?ContactID=$obj->ContactID",'Shipping',$Iframe_Width,$Iframe_Height);         
		} else if ($str_type_sub == 'special_prices') {
			echo pricing_sales($int_cust_id, NULL, $bl_update, $formname, 1) ;
        } else if ($str_type_sub == 'omzet') {
			echo print_turnover_graph($int_cust_id) ;
        } else if ($str_type_sub == 'branches') {
			echo branches($int_cust_id, $formname) ;
        }
    } else if ($str_type_main == 'purchase') {  // Maintab CRM
        echo tab($tabs_purchase,$str_type_sub,'customer','subtype'); //crm tabs    		
		if ($str_type_sub == 'po' || !$str_type_sub) {
            echo iframe("purchase_sel.php?contactID=$obj->ContactID",'Inkooporders',$Iframe_Width,$Iframe_Height); 
        } else if ($str_type_sub == 'prices') {
			echo pricing_purchasing($int_cust_id, NULL, $bl_update, $formname, 2) ;
        }			
    } else if ($str_type_main == 'irene') {  // main IRENE
        echo tab($tabs_irene,$str_type_sub,'customer','subtype'); //irene tabs
        if ($str_type_sub == 'users' || !$str_type_sub) {
            echo iframe("admin/admin_extern.php?contactID=".$obj->ContactID,'webusers',$Iframe_Width,$Iframe_Height); 
		}
    } else if ($str_type_main == 'financial') {  // main FINANCIAL
        echo tab($tabs_financial,$str_type_sub,'customer','subtype'); //financial tabs
        if ($str_type_sub == 'invoices' || !$str_type_sub) {
            echo iframe("invoice_payment.php?ContactID=".$obj->ContactID,'Payments',$Iframe_Width,$Iframe_Height); 
		} else if ($str_type_sub == 'paylink') {
            print_payment_details($obj->ContactID); 
		} else if ($str_type_sub == 'payment') {
            echo iframe("bank_transactions_maint.php?ContactID=".$obj->ContactID,'Payments',$Iframe_Width,$Iframe_Height); 
		} else if ($str_type_sub == 'limits') {
            echo EditCreditLimits($obj->ContactID, $bl_update, $formname); 
		} 
    } else if ($str_type_main == 'mail') {  // Maintab Mail
        echo tab($tabs_mail,$str_type_sub,'customer','subtype'); //crm tabs    		
		if ($str_type_sub == 'sales' || !$str_type_sub) {
            echo iframe("inbox.php?tbmail=sales&contactID=$obj->ContactID",'Verkoop mail',$Iframe_Width,$Iframe_Height); 
        } else if ($str_type_sub == 'admin') {
            echo iframe("inbox.php?tbmail=admin&contactID=$obj->ContactID",'Admin mail',$Iframe_Width,$Iframe_Height);         
        } else if ($str_type_sub == 'info') {
            echo iframe("inbox.php?tbmail=info&contactID=$obj->ContactID",'Algemene mail',$Iframe_Width,$Iframe_Height);         
        } else if ($str_type_sub == 'rma') {
            echo iframe("inbox.php?tbmail=rma&contactID=$obj->ContactID",'RMA mail',$Iframe_Width,$Iframe_Height);         
        }
    } else if ($str_type_main == 'statistics') {  // Maintab Statistics
        echo tab($tabs_statistics,$str_type_sub,'statistics','subtype'); //statistics tabs    		
		if ($str_type_sub == 'sellthrough' || !$str_type_sub) {
			echo ShowSellThrough($formname, NULL, NULL, $obj->ContactID);
		}
	}
}
mysql_free_result($qry_customers);
echo "</FORM>";
printenddoc();

?>