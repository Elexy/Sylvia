<?
/**
 *
 *
 * @version $Id: invoice_shipments.php,v 1.48 2007-04-11 08:59:15 iwan Exp $
 * @copyright 2004
 **/

include ("include.php");
//require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/CMailFile.php');
//require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/phpmailer/class.phpmailer.php');

$bl_submit = isset($_POST["submit"]) ? TRUE : FALSE;
$bl_print = isset($_POST["print"]) ? 1 : FALSE;
$bl_print = isset($_GET["print"]) ? 2 : FALSE;
$str_format = isset($_GET["format"]) ? $_GET["format"] : FORMAT_PDF;
$str_format = isset($_POST["format"]) ? $_POST["format"] : $str_format;
$int_shipID = isset($_POST["shipID"]) ? $_POST["shipID"] : FALSE;
$int_shipID = isset($_GET["shipID"]) ? $_GET["shipID"] : $int_shipID;
$str_date = isset($_POST["date"]) ? $_POST["date"] : date("Y-m-d");
$bl_original = isset($_GET["original"]) ? TRUE : FALSE;
$int_cust_id = isset($_POST["custid"]) ? $_POST["custid"] : FALSE;
$int_cust_id = isset($_GET["custid"]) && !$int_cust_id ? $_GET["custid"] : $int_cust_id;
$int_startrec = isset($_POST["startrec"]) ? $_POST["startrec"] : FALSE;
$bl_getinvoices = isset($_POST["GetInvoices"]) ? 1 : FALSE;
$bl_Showinvoice = isset($_POST["Showinvoice"]) ? 1 : FALSE;
$bl_Deletinginvoices = isset($_POST["DeletingInvoices"]) ? 1 : FALSE;

$bl_show_invoices = isset($bl_Show_invoice) ? 1 : FALSE;
$bl_show_iwex_invoices = isset($bl_show_iwex_invoices) ? 1 : FALSE;

// Check if this is ok tobe invoice.
if ($int_shipID) {
	PrintInvoice($int_shipID, $bl_original, $str_format, $bl_print, FALSE);
	
} else {
    // Print default Iwex HTML header.
    printheader (COMPANYNAME . " invoice screen", "invoices", !$bl_print||!$bl_ext_print);
	
    echo "<body ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"invoiceform\">\n";
  	// Used for calendar function.
   	echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

	printIwexNav();
    if ($int_cust_id) {
        $str_date = "";
    }

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

   	// Create a query to select the shipments for this date.
    $sql_shipments_long = SQL_SHIPMENTS .
	 	"LEFT JOIN inventory_transactions ON shipments.Shipment_ID=inventory_transactions.shipmentID
         LEFT JOIN orders on inventory_transactions.OrderID=orders.OrderID
         WHERE ((Ship_Date >= '$str_date' AND Ship_Date <= '$str_date 23:59:59') 
		 OR 
		 (Ship_Date AND (NOT InvoiceID OR ISNULL(InvoiceID)) )
         OR contacts.ContactID = '$int_cust_id'
		 ) AND Cancel = 0 AND NOT orders.consignment_order
         ORDER BY CompanyName, ShipmentID DESC ";
//echo  $sql_shipments;
    $query = $db_iwex->query($sql_shipments_long);

    $numberofrecords = mysql_Numrows($query);
    mysql_free_result($query);	
    
    $sql_shipments = $sql_shipments_long . ' LIMIT ' . $int_startrec . ',' . LIMITSIZE;

	if ($bl_Deletinginvoices) {
		unlink($GLOBALS['ary_config']['temp_dir']."/tempallinvoices.pdf.");
		unlink($GLOBALS['ary_config']['temp_dir']."/tempallinvoicesiwex.pdf");
		
		unlink($GLOBALS['ary_config']['temp_dir']."/tempinvoice.pdf.");
		unlink($GLOBALS['ary_config']['temp_dir']."/tempinvoiceiwex.pdf");
	}

	if ($bl_getinvoices) {
		$int_shipment_count = 0;
		$bl_show_invoices = FALSE;
		$bl_show_iwex_invoices = FALSE;
		
		$query_long = $db_iwex->query($sql_shipments_long);
		while ($objshipmentsend = mysql_fetch_object($query_long)) {
		
			// if there is no InvoiceID Make the invoices
			if (!$objshipmentsend->InvoiceID) { 
				$bl_show_iwex_invoices = TRUE;
				
				// Select the invoice adres from the database.
				$int_invoice_adres_id = GetInvoiceAdresId($objshipmentsend->ContactID);
				$str_email = GetField("SELECT email FROM Adressen WHERE AdresID = '$int_invoice_adres_id'");
                
				// Select the invoice send option and the numbers of copies from the database.
				$options = $db_iwex->query("SELECT invoice_option, invoice_copies, invoice_copies_iwex FROM contacts
											WHERE ContactID = '" . $objshipmentsend->ContactID . "'");
	
				$objoption = mysql_fetch_object($options);
		
				// Check to see if there is an invoice email adres.
				if(!$str_email) {
					$objoption->invoice_option = DB_PER_POST;
				}
	
                // Get the numbers of invoices. And spit it up!
                if($objoption->invoice_option == DB_PER_POST) {
                    $int_invoices = $objoption->invoice_copies;
                } else if($objoption->invoice_option == DB_PER_POST_EN_EMAIL) {
                    $int_invoices = $objoption->invoice_copies;
                    $int_invoicesmail = 1;
                } else {
                    $int_invoicesmail = 1;
                    $int_invoices = 0; 
                }

                // Creating a pdf invoice file for the customer if the option is per post or post and mail.
				if ($objoption->invoice_option == DB_PER_POST || $objoption->invoice_option == DB_PER_POST_EN_EMAIL) {
					$bl_show_invoices = TRUE;
					
					// new file
					$pdfinvoice = new FPDF_Protection('P','mm','A4');
					$pdfinvoice->Open();
					// If this is not the first Ship. include the tempallinvoice.pdf
					if ($int_shipment_count > 0) {
						$int_pagecount = $pdfinvoice->setSourceFile($GLOBALS['ary_config']['temp_dir']."/tempallinvoices.pdf");
						for ($i = 1; $i <= $int_pagecount ; $i++) {
							$pdfinvoice->AddPage();
							$ary_gls_pages[$i] = $pdfinvoice->ImportPage($i);
							$pdfinvoice->useTemplate($ary_gls_pages[$i],0,0);
						}
					}
					// insert the new created pdf
					for ($i_copies_invoices = 1 ; $i_copies_invoices <= $int_invoices; $i_copies_invoices++) {
						PrintInvoice($objshipmentsend->Shipment_ID, FALSE, "pdf", 0, FALSE, TRUE, "tempinvoice", FALSE);
						$int_pagecount = $pdfinvoice->setSourceFile($GLOBALS['ary_config']['temp_dir']."/tempinvoice.pdf");
								
						for ($i = 1; $i <= $int_pagecount; $i++) {
							$pdfinvoice->AddPage();
							$ary_gls_pages[$i] = $pdfinvoice->ImportPage($i);
							$pdfinvoice->useTemplate($ary_gls_pages[$i],0,0);
						}
					}
                    // write file for including if there are more ships or for printing.
                    $pdfinvoice->Output($GLOBALS['ary_config']['temp_dir']."/tempallinvoices.pdf" , 'F');
					
					unset($pdfinvoice);
				}

				// Send a email to the customer if he want a invoice by mail or mail and post.
				if (($objoption->invoice_option == DB_PER_EMAIL 
					 ||
					 $objoption->invoice_option == DB_PER_POST_EN_EMAIL) 
					 && 
					 $str_email) {

					$ary_text = Gettexten(DB_MAIL_TEXT_INVOICE, $objshipmentsend->languageID);
					$str_mailtxt = $ary_text[1];

					$name = $GLOBALS["ary_config"]["emailname.admin"];
					$myemail = $GLOBALS["ary_config"]["email.admin"];
					$str_cc_email = $GLOBALS["ary_config"]["email.admin"];
                    $str_onderwerp = $ary_text[0];
                    $str_mailtxt =  preg_replace("/".DB_CUST_REPLACE_VAR."/", 
                                                 $objshipmentsend->CompanyName,
                                                 $str_mailtxt);
					$str_mailtxt = $str_mailtxt.$emailsignature;
					
					// Creating the pdf file and insert the number of invoices the customer want.!
					// If the option is Per post and mail.. the original invoice will be send wilt post.
					// If the option is mail only one original invoice will be send the other are copy invoices.
                    $int_ship_invoice_id = PrintInvoice($objshipmentsend->Shipment_ID,
														FALSE,
														"pdf",
														0,
														TRUE, // Collor
														TRUE, // Write temp file
														"Invoice$objshipmentsend->Shipment_ID",
														TRUE); // Protection is on.

					// The file will be mailt to the invoice mail!
                    $SMTPMail = new phpmailer();
                    $SMTPMail->From     = $myemail;
                    $SMTPMail->FromName = $name;
                    if (EXTERNAL_SMTP_SERVER) {
                        $SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
                        $SMTPMail->Mailer   = "smtp";
                    } else { // Use normail PHP mail().
                        $SMTPMail->Mailer   = "mail";
                    }
                    $SMTPMail->Subject  = $str_onderwerp;
                    $SMTPMail->Body     = $str_mailtxt;
                    $SMTPMail->AltBody  = strip_tags($str_mailtxt);
					$elements = preg_split("/[,;]+/", $str_email);
					for ($i = 0; $i < count($elements); $i++) {
						$SMTPMail->AddAddress($elements[$i]);
					}
                    $SMTPMail->AddCC($str_cc_email);
                    $SMTPMail->AddAttachment($GLOBALS['ary_config']['temp_dir']."/Invoice$objshipmentsend->Shipment_ID.pdf",
												"Iwex_".$int_ship_invoice_id."_shipment_$objshipmentsend->Shipment_ID.pdf",
                                                "base64",
									 			"application/pdf");
                    $bl_mailcheck = $SMTPMail->Send();
                    unset($SMTPMail);
                    
					// Delete the temp file.
					unlink($GLOBALS['ary_config']['temp_dir']."/Invoice$objshipmentsend->Shipment_ID.pdf");
					
					// If the mail is not send an error will be displaying on the screen.
					if($bl_mailcheck) {
                        echo "De factuur $int_ship_invoice_id van levering $objshipmentsend->Shipment_ID is verzonden per email aan $str_email<br>";
                    } else {
						echo "<h2>Verzenden van de factuur $int_ship_invoice_id van levering $objshipmentsend->Shipment_ID is mislukt per email</h2><br>"; 
					}
				}
				
				// Creating the pdf file for iwex and insert the number of invoices that iwex want.!
				$pdfinvoiceiwex = new FPDF_Protection('P','mm','A4');
				$pdfinvoiceiwex->Open();
				// If this is not the first Ship. include the tempallinvoiceiwex.pdf
				if ($int_shipment_count > 0) {
						$int_pagecountiwex = $pdfinvoiceiwex->setSourceFile($GLOBALS['ary_config']['temp_dir']."/tempallinvoicesiwex.pdf");
						for ($i = 1; $i <= $int_pagecountiwex ; $i++) {
							$pdfinvoiceiwex->AddPage();
							$ary_gls_pages[$i] = $pdfinvoiceiwex->ImportPage($i);
							$pdfinvoiceiwex->useTemplate($ary_gls_pages[$i],0,0);
						}
				}	

				// insert the new created pdf
				for ($i_copies_iwex = 1 ; $i_copies_iwex <= $objoption->invoice_copies_iwex ; $i_copies_iwex++) {			
					PrintInvoice($objshipmentsend->Shipment_ID, TRUE, "pdf", 0, FALSE, TRUE, "tempinvoiceiwex", FALSE);
					$int_pagecountiwex = $pdfinvoiceiwex->setSourceFile($GLOBALS['ary_config']['temp_dir']."/tempinvoiceiwex.pdf");
					for ($i = 1; $i <= $int_pagecountiwex ; $i++) {
						$pdfinvoiceiwex->AddPage();
						$ary_gls_pages[$i] = $pdfinvoiceiwex->ImportPage($i);
						$pdfinvoiceiwex->useTemplate($ary_gls_pages[$i],0,0);
					}
				}
				
				// write file for including if there are more ships or for printing.
				$pdfinvoiceiwex->Output($GLOBALS['ary_config']['temp_dir']."/tempallinvoicesiwex.pdf" , 'F');
				
				unset($pdfinvoiceiwex);
				
				$int_shipment_count++;
			}
		}

        mysql_free_result($query_long);
        
        $query = $db_iwex->query($sql_shipments);
	}
	
	// Showing the file with all invoices to be send with the post
    if($bl_show_invoices || $bl_Showinvoice) {
        echo "<SCRIPT LANGUAGE='JavaScript'>
        window.open('printinvoices.php?file=tempallinvoices','Print Invoices','');
       </SCRIPT>";
    }
    if($bl_show_iwex_invoices || $bl_Showinvoice) {			
    // Showing a  separaded file with all invoice for iwex!
    echo "<SCRIPT LANGUAGE='JavaScript'>
    window.open('printinvoices.php?file=tempallinvoicesiwex','Print Invoices Iwex','');
    </SCRIPT>";
    }
	
	$ary_math[] = "tempallinvoices.pdf"; 
	//$ary_math[] = "tempallinvoiceiwex.pdf"; 
	$files = new Getfiles($GLOBALS['ary_config']['temp_dir']);
	$filesfind = $files->Findfiles($ary_math);
    
    //        echo $sql;
    $query = mysql_query($sql_shipments)
    or die("Ongeldige query: " .$sql_shipments. mysql_error());
       
    echo "<table border=1 cellspacing=0 cellpadding=2 class='blockbody' width='100%'>\n";
	echo "<TR>\n";
	echo "<TD>Dag van de verzending (Y-m-d)<INPUT TYPE=\"text\" NAME=\"date\" SIZE=\"20\" CLASS=\"form\" value=". $str_date . ">".Add_Calendar('invoiceform.date')."</TD>\n";
	echo "</TR>\n";
	echo "<TR>\n";
    echo "<td>Klant id <INPUT TYPE=\"text\" NAME=\"custid\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_cust_id."\"> / ";
    echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "invoiceform.custid", "cust");    
	echo "</td></TR>\n";
	echo "<TR>\n";
	echo "<TD>";
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

    echo "<INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\"> ";
    echo "<INPUT TYPE=\"submit\" NAME=\"GetInvoices\" VALUE=\"GetInvoices\" CLASS=\"button\"> ";
	if ($filesfind) {
		echo "<INPUT TYPE=\"submit\" NAME=\"Showinvoice\" VALUE=\"ShowInvoice\" CLASS=\"button\"> ";
	    echo "<INPUT TYPE=\"submit\" NAME=\"DeletingInvoices\" VALUE=\"DeletingInvoices\" CLASS=\"button\">";
	}
    echo "</TD>\n";
	echo "<INPUT TYPE=\"hidden\" NAME=\"olddate\" SIZE=\"20\" CLASS=\"form\" value=";
	// When submitted update should not update the database.
	if (!$bl_submit) { 
	    echo $str_date;
	}
	echo "></TD>\n</TR>\n";
    echo "</TABLE>\n"; 
       
?>
<input TYPE="radio" NAME="format" VALUE="html"
<?
 if ($str_format == FORMAT_HTML) echo " CHECKED";
?>
> scherm
<input TYPE="radio" NAME="format" VALUE="pdf"
<?
  if ($str_format == FORMAT_PDF) echo " CHECKED";
?>
> PDF
<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
  <tr>
    <th>Shimpment ID</th>
    <th>Customer</th>
    <th>ShipName</th>
    <th>Tracking nummer</th>
    <th>Invoice</th>
    <th>Date</th>
  </tr>
<?

    while ($objshipment = mysql_fetch_object($query)) {
	   if ($objshipment->InvoiceID) { 
            $bgcolor="#DDFFE1"; 
       } else { 
            $bgcolor="#FFABA9"; 
       }
       echo '<tr bgcolor="'. $bgcolor .'">'."\n"
            .'<td><a href=shipment.php?shipmentID='.$objshipment->Shipment_ID.'>Shipment</a>'
			.', <a href='.$_SERVER['PHP_SELF'].'?shipID='.$objshipment->Shipment_ID.'&format='.$str_format.'>invoice '.$objshipment->Shipment_ID.'</a></td>'
            .'<td><a href=customer_maint.php?custid='.$objshipment->ContactID.'>'.$objshipment->CompanyName.'</a></td>'
            .'<td>'.$objshipment->Naam.'</td>'
            .'<td>'.createtrackinglink($objshipment->Tracking, $objshipment->postcode).'</td>'
            .'<td><a href='.$_SERVER['PHP_SELF'].'?shipID='.$objshipment->Shipment_ID.'&original=true&format='.$str_format.'>'.GetInvoiceID($objshipment->Shipment_ID).'</a></td>'
            .'<td>'.date(DATEFORMAT_SHORT, strtotime($objshipment->Ship_date)).'</td>'
            ."\n".'</tr>';

          echo "\n";
    }
	mysql_free_result($query); 
	
	echo '</table>';
	
    echo "</FORM>\n";

    printenddoc();
}
?>
