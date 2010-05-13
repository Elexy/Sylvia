<?PHP
include("include.php");

define("EMAIL_SELECTION", 'Email selectie');
define("EXECUTE_SELECTION", 'execute');

$str_page = $_SERVER['PHP_SELF'];
$formname = "invoice_overdue";

$int_cust_id = isset($_POST["ContactID"]) ? $_POST["ContactID"] : FALSE;
$ary_custid = isset($_REQUEST["custid"]) ? $_REQUEST["custid"] : FALSE;
$int_overdue_type = isset($_REQUEST["overdue_type"]) ? $_REQUEST["overdue_type"] : FALSE ;
$str_action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : FALSE;
$int_needed_type = isset($_GET["needed_type"]) ? $_GET["needed_type"] : FALSE;
$int_selection = isset($_GET["selection"]) ? $_GET["selection"] : FALSE;
$bl_UnsetEventid = isset($_REQUEST["UnSetEventid"]) ? $_REQUEST["UnSetEventid"] : FALSE;

if ($int_selection) {
	if (isset($_SESSION['selection']) && $_SESSION['selection'] == $int_selection) {
		$int_selection = "";
	}	
	$_SESSION['selection'] = $int_selection;
	$_SESSION['overdue_type'] = $int_overdue_type;
	
} else if (isset($_SESSION['selection']) && $_SESSION['overdue_type'] == $int_overdue_type){
	$int_selection = $_SESSION['selection'];
} else {
	unset($_SESSION['selection']);
}
//Tab variabeles
$str_type_main = GetSetFormVar("maintype",True,'general','maintype');
$str_last_main = GetSetFormVar("lastmain",True);

$tabs_main = array('general;Betalingstermijn','rembours;Rembours','autoincasso;Automatische Incasso');

printheader ("Beheer Overdue", "Overdue");
echo "<body ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"$formname\">\n";
echo include_javascript();
printIwexNav();

// Used for overlib function.
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

echo "<INPUT TYPE='hidden' NAME='maintype' VALUE='$str_type_main'>";

	if ($ary_custid && $str_action) {
	    $bl_show = FALSE;
		$pdfalloverdue = new FPDF_Protection('P','mm','A4');
		$pdfalloverdue->Open();
	
		foreach($ary_custid As $int_custid => $str_on) {		
			if ($str_action == EMAIL_SELECTION) {
				SendOverduemail($int_custid, $int_overdue_type, $int_needed_type);
			} else if ($str_action == EXECUTE_SELECTION) {
				$db_iwex->query("UPDATE invoices SET overduetypeID = '99' 
								 WHERE CustomerID = $int_custid && overduetypeID = " . DB_INVOICE_OVERDUE_BAILIFF);
				unset($_SESSION['selection']);
				$int_selection = "";
			} else {
				$pdf_file_path = IwexLetters($int_custid, $int_overdue_type, $int_needed_type);
				if ($pdf_file_path) {
					$bl_show = TRUE;
					$int_pagecount = $pdfalloverdue->setSourceFile($pdf_file_path);
								
					for ($i = 1; $i <= $int_pagecount; $i++) {
						$pdfalloverdue->AddPage();
						$ary_gls_pages[$i] = $pdfalloverdue->ImportPage($i);
						$pdfalloverdue->useTemplate($ary_gls_pages[$i],0,0);
					}
				} else {
					echo "Er is geen fax nummer aanwezig van: $int_custid";
				}		
			}
		}
		if ($str_action != EMAIL_SELECTION && $bl_show) {
			$pdfalloverdue->Output($GLOBALS['ary_config']['temp_dir']."/tempalloverdue.pdf" , 'F');
			echo "<SCRIPT LANGUAGE='JavaScript'>
			window.open('printinvoices.php?file=tempalloverdue','Print Overdue','');
			</SCRIPT>";
		}
	}
    echo tab($tabs_main,$str_type_main,"$formname",'maintype'); // main tabs
    echo "<TABLE WIDTH='100%' BORDER='1' CELLPADDING='1' CELLSPACING='0' class='blockbody'>
        	<TR>
           		<th colspan='4'>Search Options</th>
       		</TR>
       		<TR>
       			<TD>Overdue Type:</TD>
       			<TD>" . makelistbox("SELECT value, text
       								 FROM listbox WHERE category = 13 
       								 ORDER BY value", 'overdue_type', 'value', 'text', $int_overdue_type) . "</TD>
       			<TD>Company ID/Name</TD>
       			<TD><INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_cust_id."\" OnChange=\"TempContacts_id.value = ContactID.value\">" .
    				GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "invoiceform.ContactID", "cust");
    echo "	  </TD>       			
       		</TR>
       		<TR>
       		 	<TD Colspan='4' valign='right'><INPUT TYPE='submit' NAME='Update' VALUE='Zoeken' CLASS='button'>";
				if ($int_overdue_type == DB_INVOICE_OVERDUE_FIRST_MAIL 
				|| 
				$int_overdue_type == DB_INVOICE_OVERDUE_SECOND_MAIL) { 
					echo "<INPUT TYPE=\"submit\" NAME=\"action\" VALUE=\"".EMAIL_SELECTION."\" CLASS=\"button\">";
				} else if ($int_overdue_type == DB_INVOICE_OVERDUE_FAX_OR_LETTER) {
					echo "<INPUT TYPE=\"submit\" NAME=\"action\" VALUE=\"Get Fax/Brief\" CLASS=\"button\">";
				} else if ($int_overdue_type == DB_INVOICE_OVERDUE_SIGNATURE_LETTER) {
					echo "<INPUT TYPE=\"submit\" NAME=\"action\" VALUE=\"PrintBrieven\" CLASS=\"button\">";
				}
   echo "		</TD>
       		</TR>
 		  </TABLE>";

// Make the where selections
$sql_invoices_overdue = "SELECT InvoiceID, count(InvoiceID) as number_invoices ,invoices.companyName, CustomerID, ShipName, Invoice_date, 
						Invoice_total + Invoice_BTW AS amount, paid_amount, paid_yn,Description, days, paid_date, DispuutID ,overduetypeID, text
						FROM invoices 
						LEFT JOIN paymentterm ON Paymentterm = PaymentTermID
						LEFT JOIN listbox ON overduetypeID = value";

//$sql_invoices_overdue = SQL_INVOICES_PAYMENT;
$sqlwhere = queryparm('CustomerID', $int_cust_id, "", 0);
$sqlwhere.= queryparm('paid_yn', 0, $sqlwhere);
$sqlwhere.= queryparm('category', 13, $sqlwhere);
$sqlwhere.= queryparm('overduetypeID', $int_overdue_type, $sqlwhere);
 
if ($str_type_main == 'general' || !$str_type_main) {
	$sqlwhere .= " && PaymentTermID != ".DB_PAYMENT_TERM_REMBOURS
				." && !incasso";
} else if ($str_type_main == "rembours") {
	$sqlwhere .= " && PaymentTermID = ".DB_PAYMENT_TERM_REMBOURS;
} else if ($str_type_main == "autoincasso") {
	$sqlwhere .= " && incasso";
}

// Create a query to select overdue invoices 
$sql_invoices_overdue .= $sqlwhere . ' GROUP BY CustomerID ORDER BY companyName ASC';
$result_invoices = $db_iwex->query($sql_invoices_overdue);

// Making the tableheader
echo "	<table border=1 cellspacing=0 cellpadding=2 class='blockbody' width='100%'>
		<tr>
		<th rowspan='2'>-</th>
		<th rowspan='2'>CustomerID</th><th rowspan='2'>Customer</th><th rowspan='2'>Invoices</th><th rowspan='2'>Pay Term</th>
		<th>options</th>
		</tr>
		<tr>
		<th>Set type</th>
		</tr>";

$i_overdues = 0;
$int_customers_done = 0;
// Looping the results from the db
while ($obj_invoices = mysql_fetch_object($result_invoices)) {
	
	$i_overdues++;	
	$int_invoices_done = 0;
	$str_invoice_table = "";
	$bl_show = TRUE;
    $int_invoices_total = 0;
	// select the invoices from de customer.
	$result_invoice_cust = $db_iwex->query("SELECT InvoiceID, overduetypeID, DispuutID FROM invoices
											WHERE CustomerID = '" .  $obj_invoices->CustomerID . "'
											AND paid_yn != 1
											AND overduetypeID > 0
											ORDER BY overduetypeID desc");
	while ($obj_invoice_cust = $db_iwex->fetch_object($result_invoice_cust)) {
		$int_overdue_type_id = isset($obj_invoice_cust->overduetypeID) ? $obj_invoice_cust->overduetypeID : 0;
		$int_dispuut_type_id = isset($obj_invoice_cust->DispuutID) ? $obj_invoice_cust->DispuutID : FALSE;
		$int_empty = TRUE;
		$ary_type_id = FALSE;
		$ary_alltype_id = array();
		$ary_all_type_name = array();
		$int_invoices_total++;
		$ary_types = array();

		if ($obj_invoice_cust->overduetypeID > $int_overdue_type && $bl_show) {
			$bl_show = FALSE;
			$i_overdues--;	
		}
		
		// Loop into the invoice_call table.. related to the invoiceID
		$type_result = $db_iwex->query("SELECT callID, invoices_call.invoiceID, typeID, text, invoices_call.DispuutID FROM invoices_call
										LEFT JOIN listbox ON typeID = value
										WHERE invoiceID = '" .  $obj_invoice_cust->InvoiceID . "'
										AND category = 13 GROUP BY typeID ORDER BY invoices_call_ID desc ");
										
		while ($obj_type = $db_iwex->fetch_object($type_result)) {
			// Set an array to insert all calls related to the invoiceID. the first one is the last!
			$ary_alltype_id[] = $obj_type->typeID;
			$ary_alltype_name[] = $obj_type->text;
			
			// check if the type id is the same as the type id selected and if there is no dispuut.
			if ($obj_type->typeID == $int_overdue_type) {
				$int_invoices_done++;
				$int_empty = FALSE;
				$ary_type_id[] =  $obj_type->typeID;
			}
		}
		$db_iwex->free_result($type_result);
		
		// Creating results of the invoices from the selected customer.
		if ($int_selection == $i_overdues) {
			$sql_where_link = " AND invoiceID = $obj_invoice_cust->InvoiceID ";
			
			if (isset($ary_alltype_name)) {
				$str_invoice_table .= "<TR><TD>" . $obj_invoice_cust->InvoiceID . "</TD><TD>" . $ary_alltype_name[0] . "</TD>";
			} else {
				$str_invoice_table .= "<TR><TD>" . $obj_invoice_cust->InvoiceID . "</TD><TD></TD>";
			}
			if (isset($ary_type_id)) {
				if ($int_overdue_type == $ary_type_id[0]) {
					$str_invoice_table .= "<TD>Done</TD><TD>";
				} else {
					$str_invoice_table .= "<TD>Not Done</TD><TD>";
				}
			} else {
				$str_invoice_table .= "<TD>Not Done</TD><TD>";
			}
			// Check for options to show. and set the link.
			$result_overduetypes = $db_iwex->query("SELECT value, text 
													FROM listbox WHERE category = 13 and value < $int_overdue_type
													ORDER BY value");
													
			while ($obj_overdue_types = mysql_fetch_object($result_overduetypes)) {
				$show_type = TRUE;
				if(isset($ary_alltype_id)) {
					foreach ($ary_alltype_id As $int_types) {
						if ($obj_overdue_types->value == $int_types) {
							$show_type = FALSE;
						}
					}
				}
				if($show_type) {
					$ary_types[] = $obj_overdue_types->value;
					$ary_types_name[] = $obj_overdue_types->text;
					$str_invoice_table .= " - " . $obj_overdue_types->text;
				}
			}
			
			$db_iwex->free_result($result_overduetypes);
			if ($int_dispuut_type_id == DB_INVOICE_OVERDUE_NO_DISPUUT || $int_dispuut_type_id == DB_INVOICE_OVERDUE_END_DISPUUT) {
				$str_invoice_table .= "</TD><TD><A HREF='contacts/maintain.php?int_overdue_type=" . $int_overdue_type 
					. "&str_dispuut_id=1&str_type_sub=calls&str_type_main=general&call_SubjectNew=Invoice: " 
					. $obj_invoice_cust->InvoiceID 
					. "&custid=" . $obj_invoices->CustomerID 
					. "&where_invoices=$sql_where_link' TARGET='new'>Set Dispuut</A>";
			} else {
				$str_invoice_table .= "</TD><TD><A HREF='contacts/maintain.php?int_overdue_type=" . $int_overdue_type 
					. "&str_dispuut_id=3&str_type_sub=calls&str_type_main=general&custid="
					. $obj_invoices->CustomerID 
					."&where_invoices=$sql_where_link' TARGET='new''>UnSet Dispuut</A> -
					<A HREF='contacts/maintain.php?int_overdue_type=" 
					. $int_overdue_type 
					. "&str_dispuut_id=2&str_type_sub=calls&str_type_main=general&custid=" 
					. $obj_invoices->CustomerID 
					. "&where_invoices=$sql_where_link' TARGET='new'>Extra dispuut call</A></TD></TR>";
			}
		}
	}
	$db_iwex->free_result($result_invoice_cust);
	
	$str_invoice_table .= "<tr><td colspan='3'></td><td>";
	foreach ($ary_types as $int_id => $int_type_id) {
		if($int_type_id == DB_INVOICE_OVERDUE_SECOND_MAIL || $int_type_id == DB_INVOICE_OVERDUE_FIRST_MAIL) {	
			$str_invoice_table .= "- <A HREF='$str_page?custid[" . $obj_invoices->CustomerID . "]=" . $obj_invoices->CustomerID . "&action=" . EMAIL_SELECTION . "&overdue_type=$int_overdue_type&needed_type=" . $int_type_id . "'
									 onClick=\"return confirm('Weet u zeker dat u de actie $ary_types_name[$int_id] wilt uitvoeren op CustomerID  " . $obj_invoices->CustomerID ."?')\">" . $ary_types_name[$int_id] . "</a> ";
		} else if ($int_type_id == DB_INVOICE_OVERDUE_TELEPHONE_CALL || $int_type_id == DB_INVOICE_OVERDUE_BAILIFF) {
			$str_invoice_table .= "- <A HREF='contacts/maintain.php?int_overdue_type=$int_overdue_type&action=ok&needed_type="
			. $int_type_id 
			. "&str_type_sub=calls&str_type_main=general&custid="
			. $obj_invoices->CustomerID ."'
									onClick=\"return confirm('Weet u zeker dat u de actie $ary_types_name[$int_id] wilt uitvoeren op CustomerID  " . $obj_invoices->CustomerID ."?')\">" . $ary_types_name[$int_id] . "</a> ";
		} else {
			$str_invoice_table .= "- <A HREF='$str_page?custid[" . $obj_invoices->CustomerID . "]=" . $obj_invoices->CustomerID . "&action=ok&overdue_type=$int_overdue_type&needed_type=" 
			. $int_type_id . "'
									 onClick=\"return confirm('Weet u zeker dat u de actie $ary_types_name[$int_id] wilt uitvoeren op CustomerID  " .$obj_invoices->CustomerID ."?')\">" . $ary_types_name[$int_id] . "</a> ";	
		}
	}
	$str_invoice_table .= "</td><td></td></tr>";
	if($bl_show) {	
		echo "	<tr "
				  .ShowOnMouseOverText(str_replace(array("\n","\t"), "", ShowOpenInvoices($obj_invoices->CustomerID,
																			  TRUE)),
									   "WIDTH, 800")
				.">";	
		if ($int_overdue_type) {
			echo "	<td><a href = '" . $_SERVER['PHP_SELF'] . "?overdue_type=$int_overdue_type&selection=$i_overdues'>$i_overdues</a></td>";
			//echo "	<td><a href = '" . $_SERVER['PHP_SELF'] . "?overdue_type=$int_overdue_type&selection=$i_overdues' onclick='document.$formname.submit();'>$i_overdues</a></td>";
		} else {
			echo "<td>$i_overdues</td>";
		}
		echo "  <td><a href='invoice_payment.php?ContactID=" . $obj_invoices->CustomerID . "' TARGET='_blank'>" . $obj_invoices->CustomerID . "</A></td>
				<td>" . $obj_invoices->companyName . "</td>
				<td>" . $int_invoices_total . " - " . $int_invoices_done . "</td>
				<td>" . $obj_invoices->Description . "</td>";
			
		// Check for overduetype options
		if($int_overdue_type && $int_invoices_total > $int_invoices_done) {
			if ($int_overdue_type == DB_INVOICE_OVERDUE_TELEPHONE_CALL) {
				echo "	<td><A HREF='contacts/maintain.php?int_overdue_type=$int_overdue_type&
						call_SubjectNew=Telefoon Call&str_type_sub=calls&str_type_main=general&custid=" . $obj_invoices->CustomerID ."' TARGET='new'>Set call</A></td>";
			} else if ($int_overdue_type == DB_INVOICE_OVERDUE_BAILIFF) {
				echo "	<td><A HREF='contacts/maintain.php?int_overdue_type=$int_overdue_type&
						call_SubjectNew=Deurwaarde&str_type_sub=calls&str_type_main=general&custid=" .$obj_invoices->CustomerID ."' TARGET='new'>Set call</A>
						<A HREF='$str_page?custid[" . $obj_invoices->CustomerID . "]=" . $obj_invoices->CustomerID . "&
								 action=". EXECUTE_SELECTION ."&overdue_type=$int_overdue_type' onClick=\"return confirm('Weet u zeker dat u " .$obj_invoices->CustomerID ." wilt beindigen?')\">Beinig</A>
						</td>";
			} else {
				echo "<td>" . MakeCheckBox("custid[" . $obj_invoices->CustomerID . "]", '') . "</td>";
				}
		} else if (!$int_overdue_type) {
			echo "<td>Select Overduetype</td>";	
		} else {
			echo "<td>All Done";
			    if ($int_overdue_type == DB_INVOICE_OVERDUE_BAILIFF) {
				echo " <A HREF='$str_page?custid[" . $obj_invoices->CustomerID . "]=" . $obj_invoices->CustomerID . "&
							   action=". EXECUTE_SELECTION ."&overdue_type=$int_overdue_type' onClick=\"return confirm('Weet u zeker dat u " .$obj_invoices->CustomerID ." wilt beindigen?')\">Beinig</A>";
			    }
			echo "</td>";
		}
		echo "</tr>";
	
		if ($int_selection == $i_overdues) {
			echo "<tr><td> >>> </td>";
			echo "<td colspan='6'><TABLE width='100%' class='blockbody' border='0' cellspacing='0' cellpadding='0'>";
			echo "<tr><th>Invoiceid</th><th>Last Type</th><th>action</th><th>Types to do</th><th>Dispuut options</th></tr>";
			echo $str_invoice_table;
			echo "</TABLE></td></tr>";
		}
		if ($int_invoices_total == $int_invoices_done && $int_overdue_type) {
			$int_customers_done++;
		}
	}
}
echo "</table>";
echo "</form>";

if ($str_type_main == 'general' || !$str_type_main) {
	// update events.
	$result_event_desc = $db_iwex->query("SELECT id, title from events WHERE link LIKE '%overdue_type=$int_overdue_type%'");
	$obj_event_desc = mysql_fetch_object($result_event_desc);
	$db_iwex->free_result($result_event_desc);

	$ary_event_desc = explode(" ", $obj_event_desc->title);
	foreach ($ary_event_desc As $int_value => $str_event_desc_num) {
		if(is_numeric($str_event_desc_num)) {
			$int_number_value = $int_value;
		}
	}
	$str_new_desc = str_replace($ary_event_desc[$int_number_value] ,$i_overdues - $int_customers_done, $obj_event_desc->title);

	if ($i_overdues - $int_customers_done > 0) {
			$db_iwex->query("UPDATE events SET title = '$str_new_desc', action_performed_date = '" . date(DATEFORMAT_LONG) . "', action_done_by ='" . $GLOBALS["employee_id"] . "' 
							 WHERE id = '" . $obj_event_desc->id . "'");
	} else {
			$db_iwex->query("UPDATE events SET title = '$str_new_desc', action_performed_date = '0000-00-00 00:00:00', action_done_by ='" . $GLOBALS["employee_id"] . "' 
						 WHERE id = '" . $obj_event_desc->id . "'");
	}
}
printenddoc();
?>