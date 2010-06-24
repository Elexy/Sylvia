<?php

include ("include.php");
// Include the class definition file.
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/class.html2text.php');

// integer vars
$int_po_id = GetSetFormVar('poID',FALSE);

// String vars
$str_format = isset($_GET["format"]) ? $_GET["format"] : FORMAT_ASCI;
$str_format = isset($_POST["format"]) ? $_POST["format"] : $str_format;
$str_subject = GetSetFormVar('subject',FALSE);
$str_bericht = GetSetFormVar('bericht',FALSE);
$str_email = GetSetFormVar('email',FALSE);

// boolean vars 
$bl_submit = isset($_POST["submit"]);
$bl_update = isset($_POST["update"]);
$bl_cancel = isset($_POST["cancel"]);
$bl_print_bo = isset($_POST["print_bo"]);
$bl_print_bo = isset($_GET["print_bo"]) && !$bl_print_bo ? $_GET["print_bo"] : $bl_print_bo;
$bl_send_pdf =  isset($_GET["send"]) || (isset($_POST["send"]) && $_POST["send"] == '1');
$bl_buyer = isset($_GET["buyer"]) ? TRUE : FALSE;

define("PURCHASE_ORDER_CONDITIONS",
	   "In case no signed agreement concerning purchasing conditions exists with you (the supplier), our general distribution conditions apply to this");

// set Db connect
$DB_iwex = new DB();

$break = "\n";
if ($str_format == FORMAT_HTML
	||
	$str_format == FORMAT_PDF) {
    $break = "<br>";
}

// Print default Iwex HTML header.
if ($str_format != FORMAT_PDF || $bl_send_pdf) {
    printemailheader(COMPANYNAME . " inkooporder e-mail","",!$bl_submit);
    
    // Check if it is ok to be e-mailed.
    if ($bl_submit) {
        $name = $GLOBALS["ary_config"]["emailname.purchase"];
        $myemail = $GLOBALS["ary_config"]["email.purchase"];
        $mailtxt = stripslashes($str_bericht);
        echo 'format:*'.$str_format.'*<br>';
        if ($str_format == FORMAT_HTML
			||
			$str_format == FORMAT_PDF) {
            $mail_type = "Content-type: text/html";
        } else {
            $mail_type = "";
            $emailheader = '';
        }
		$str_error = "";
        if ($bl_send_pdf) {
			$h2t =& new html2text($mailtxt );
			$mailtxt = $emailheader . "<body>\n"."$mailtxt"."</body></html>";

			// Create new mail class
			$SMTPMail = new phpmailer();
			$SMTPMail->From     = $myemail;
			$SMTPMail->FromName = $name;
			$SMTPMail->AddReplyTo($myemail);
			$elements = preg_split("/[,;]+/", $str_email);
			for ($i = 0; $i < count($elements); $i++) {
				$SMTPMail->AddAddress($elements[$i]);
			}
			$SMTPMail->AddCC($myemail);
			if (!$SMTPMail->AddAttachment($ary_config['temp_dir']."/PO$int_po_id.pdf",
									 "PO$int_po_id.pdf",
									 "base64",
									 "application/pdf")) {
				echo "Adding attachement PO$int_po_id.pdf failed ".$SMTPMail->ErrorInfo;
			}
		    //Send e-mail
			if (EXTERNAL_SMTP_SERVER) {
				$SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
				$SMTPMail->Mailer   = "smtp";
			} else { // Use normail PHP mail().
				$SMTPMail->Mailer   = "mail";
			}
			$SMTPMail->Subject  = $str_subject;
			$SMTPMail->Body     = $mailtxt;
			$SMTPMail->AltBody  = $h2t->get_text();
			$bl_mailresult = $SMTPMail->Send();										
			$str_error = $SMTPMail->ErrorInfo;
            // Delete the temp file.
            unlink($ary_config['temp_dir']."/PO$int_po_id.pdf");

            //$bl_mailresult = FALSE;
        } else {
        echo 'format:*'.$str_format.'*<br>';
        echo 'emailheader:*'.$emailheader.'*<br>';
        echo 'mailtext:*'.$mailtxt.'*';
            $bl_mailresult = mail($str_email, 
                                  $str_subject, 
                                  $mailtxt,
                                  "From: \"$name\" <$myemail>\nCc:" . $GLOBALS["ary_config"]["email.purchase"] . "\n$mail_type");
        }
        if ($bl_mailresult) {
          $sendok = "Ok";
          echo "<BODY onLoad=\"location.replace('purchase_maint.php?purchaseorderID=".$int_po_id."&sent=ok')\">";
        } else {
          $sendok = "<b>Failed $str_error</b>";
        }
    } else if (($bl_update)) {
        $mailtxt = stripslashes($$str_bericht);
    }
    
    if ($bl_cancel) { // return to purchase _maint
        echo "<BODY onLoad=\"location.replace('purchase_maint.php?purchaseorderID=".$int_po_id."')\">";
    } else {
        echo '<BODY>';
    }
    echo "<h3>De volgende Inkooporder zal worden verstuurd:</h3><hr>";
    echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">$break";
}


// Check if Purchase order ID is given.
if ($int_po_id&&!$bl_submit&&!$bl_update) {
    // Create a query to select the customer and the products to be e-mailed.
    $sql_po = "SELECT purchase_orders.*, 
        buyers.CompanyName as Buyer, buyers.ContactID as Buyer_ID, buyers.email as buyer_email,
        seller.CompanyName as Seller, CONCAT_WS(' ', sellers.straat, sellers.huisnummer) as Seller_Address, 
        sellers.postcode AS sellers_PostalCode, sellers.plaats AS sellers_City, sellers_country.country AS sellers_Country,
        seller.email AS sellers_email, Adressen.*, country.country, valuta.*, language,
        shipping_methods.ShippingMethod 
        FROM purchase_orders 
        INNER JOIN contacts seller ON purchase_orders.SupplierID = seller.ContactID 
        LEFT JOIN Adressen sellers ON purchase_orders.SupplierID = sellers.ContactID AND sellers.adrestitel = 1
		LEFT JOIN languages ON languages.languageID = seller.languageID
        LEFT JOIN Adressen ON purchase_orders.ship_adresID = Adressen.AdresID
		LEFT JOIN country ON Adressen.land = country.code
		LEFT JOIN country sellers_country ON sellers.land = sellers_country.code
        LEFT JOIN contacts buyers on purchase_orders.buyer_contactID = buyers.ContactID 
        LEFT JOIN valuta ON purchase_orders.Order_currency = valuta.ValutaID
        LEFT JOIN shipping_methods ON purchase_orders.ShippingMethodID = shipping_methods.ShippingMethodID
        WHERE PurchaseOrderID =".$int_po_id;
//echo $sql_po;
	$query_po = mysql_query($sql_po)
  	   or die("Ongeldige query: " .$sql_po.' : '. mysql_error());
	
	$obj_po = mysql_fetch_object($query_po);
    if ($bl_buyer) {
        $mailtxt = "Beste ". $obj_po->Buyer . ",$break $break"
            . "Hierbij stuur ik u een update voor inkooporder: " . $obj_po->PurchaseOrderID. ".$break $break";		    
    } else {
        $mailtxt = "Dear salesdepartment of ". $obj_po->Seller . ",$break $break"
            . "Hereby I send you a new Purchase Order with our reference: " . $obj_po->PurchaseOrderID. ".$break $break";
    }
    
	$ary_lang = $ary_languages[$obj_po->language];
	
    if ($obj_po->ship_adresID) {
        $str_shiptxt = $obj_po->Naam."$break"
            .$obj_po->straat." ".$obj_po->huisnummer."$break"
            .$obj_po->postcode." ".$obj_po->plaats."$break"
            .$obj_po->country."$break";
		$str_shiptxt_pdf = "$obj_po->Naam\n"
			."$obj_po->straat $obj_po->huisnummer\n"
			."$obj_po->postcode $obj_po->plaats\n"
            .$obj_po->country;
    } else {
        $str_shiptxt = $obj_po->ShipName."$break"
            .$obj_po->ShipAddress."$break"
            .$obj_po->ShipPostalCode." ".$obj_po->ShipCity."$break"
            .$obj_po->ShipCountry."$break";
		$str_shiptxt_pdf = "$obj_po->ShipName\n"
            .$obj_po->ShipAddress."\n"
            .$obj_po->ShipPostalCode." ".$obj_po->ShipCity."\n"
            .$obj_po->ShipCountry;
    }
    
    if ($str_format == FORMAT_PDF) {
	    //Instanciation of inherited class
	    $pdf=new PurchaseOrderPDF('P','mm','A4');
        $pdf->SetProtection(array('print')); // Only allow printing of the document.
        $pdf->SetMargins(15,20,15);
        $pdf->SetColor(TRUE);
        
        $pdf->SetFootTxt("from purchase order $int_po_id");
        $pdf->SetDeliveryCond("All prices in $obj_po->ValutaNameLong.");

	    $pdf->Open();
	    $pdf->AliasNbPages();
	    $pdf->AddPage();
   	    $pdf->SetFont('Arial','',10);
	
        $pdf->Ln(5);
		
        $pdf->SetWidths(array(30,59.5,30,59.5));
		$pdf->SetAligns(array('L','L','L','L'));
		$pdf->SetBorders(array('','','','',''));
		$pdf->SetHight(5);
        
        $pdf->Row(array("Supplier:\nLeverancier:",
                        "$obj_po->Seller\n$obj_po->Seller_Address\n$obj_po->sellers_PostalCode  $obj_po->sellers_City\n$obj_po->sellers_Country",
                        "Ship to:\nAfleveradres:",
                        $str_shiptxt_pdf));
        $pdf->Ln(5);

        $pdf->SetWidths(array(30,30,30,89));
		$pdf->SetAligns(array('C','C','C','C'));
		$pdf->SetBorders(array('F','F','F','F'));
		$pdf->SetHight(4);
        $str_podate = $obj_po->OrderDate ? date("j-n-Y",strtotime($obj_po->OrderDate)) : "";
        $pdf->PDFtable(array('Order ID',
                             "Supplier",
                             "Order date",
                             "Forwarder"),
                       array(array($int_po_id,
                                   $obj_po->ContactID,
                                   $str_podate,
                                   $obj_po->ShippingMethod)
                            )
                       );
        unset($str_podate);
        $pdf->Ln(5);

        $pdf->SetWidths(array(25,  12, 50, 47, 15, 15, 15));
        $pdf->SetAligns(array('L','R','L','L','R','R','R'));
        $pdf->SetBorders(array('F','F','F','F','F','F','F'));
        $pdf->SetHight(4);
        $header = array('Product ID', 'Iwex ID', 'Name', 'Notes', 'Units', 'Price', 'Total');
    } 
    
    $sql_po_details = SQL_PO_DETAIL_QUERY . " WHERE poID = '$int_po_id' ORDER BY ProductID";
    $qry_select_podetails = $DB_iwex->query($sql_po_details);
       
    // Write order details to e-mail message.
    $int_rowcnt = 0;
    $flt_total_amount = 0;
    $tabledata = array(); // Clear table data.
    $title = FALSE;
    while ($obj_podetail = mysql_fetch_object($qry_select_podetails)) {
        if ($str_format == FORMAT_PDF) {
            $flt_total_amount += $obj_podetail->quantity * $obj_podetail->unitprice;
            $tabledata[$int_rowcnt++] = array($obj_podetail->ExternalID,
                                              $obj_podetail->productID,
                                              $obj_podetail->ProductName,
                                              $obj_podetail->comments,
                                              $obj_podetail->quantity,
                                              sprintf("%.2f", $obj_podetail->unitprice),
                                              sprintf("%.2f", $obj_podetail->quantity * $obj_podetail->unitprice));
        } else if ($str_format == FORMAT_ASCI) {
            $mailtxt .= wordwrap($obj_podetail->quantity . " x " . $obj_podetail->ProductName . 
                  " (" .  $obj_podetail->productID . " / " .  $obj_podetail->ExternalID . ") ". $obj_podetail->comments."   ", 75, "$break  "); 
            $mailtxt .= "unitprice - " . $obj_po->ValutaName . " " . $obj_podetail->unitprice . "$break"; 
            $mailtxt .= "Expected delivery: $break$break"; 
        } else if ($str_format == FORMAT_HTML
					||
					$str_format == FORMAT_PDF) {
            if (!$title) {
                $mailtxt .="<table width=\"100%\" border=\"0\">\n";
                $mailtxt .= "<tr><th>Product</th><th>Name</th><th>Notes</th><th align=right># Ordered</th>";
                if ($bl_buyer) {
                    $mailtxt .= "<th align=right>Received</th>";
                } else {
                    $mailtxt .= "<th>price</th></tr>";
                }
            }
            $mailtxt .= "<tr VALIGN=top><td>$obj_podetail->ExternalID</td>
                <td>$obj_podetail->ProductName</td>
                <td>$obj_podetail->comments</td>
                <td align=right><b>$obj_podetail->quantity</b></td>";
                if ($bl_buyer) {
                    if ($InventoryPODetails = ShowInventoryPODetails(FALSE, $obj_podetail->podetailsID, FALSE,'','values')) {
                        //print_r($InventoryPODetails);
                        $mailtxt .= "<td><table width=\"100%\" cellpadding='0' cellspacing='0' border=\"0\"><tr>\n";
                        foreach($InventoryPODetails as $Transaction) {
                            $mailtxt .= "<td>" . date("d-M-Y",strtotime($Transaction["TransactionDate"])) . "</td>";
                            $mailtxt .= "<td>" . $Transaction["UnitsReceived"] . "</td></tr>\n";
                        }
                        $mailtxt .= "</table></td>";
                    } else {
                        $mailtxt .= "<td align=right>0</td>";
                    }
                } else {
                    $mailtxt .= "<td align=right>$obj_po->ValutaName $obj_podetail->unitprice</td>";
                }
                $mailtxt .= "</tr>\n";
            $title = TRUE;
        }
    }
    if ($str_format == FORMAT_HTML) $mailtxt .="</table>\n<br>\n";
    $mailtxt .= "Ship To address :$break\n" . $str_shiptxt;
	$mailtxt .= "$break\n";
	$mailtxt .= "Shipping method: ".$obj_po->ShippingMethod."$break\n";
	$mailtxt .= "$break\n";
	$mailtxt .= "We kindly ask you to confirm this purchaseorder.".$break."Please reply to this email with expected date of delivery for all products.$break";
    $mailtxt .= "\n".PURCHASE_ORDER_CONDITIONS." purchaseorder\n";
	
	mysql_free_result($query_po);
  
    $mailtxt .= $break."With best regards,".
                $break. COMPANYNAME . " Purchasing Department".
                $break.$GLOBALS["ary_config"]["email.purchase"].
                $break."T " . TELEPHONE  .
                $break."F " . FAX;
    
    if ($bl_print_bo) {
        $str_format_po = $str_format == FORMAT_PDF ? FORMAT_HTML : $str_format;
        $mailtxt .= $break . "\n" . print_backorder_Purchase($obj_po->SupplierID, $obj_po->PurchaseOrderID, $str_format_po, $obj_po->Buyer_ID);
    }
    
    // set some stuuf before we cannot get to it anymore
    $str_email = $obj_po->sellers_email;
    $str_subject = "Purchase Order " . $obj_po->PurchaseOrderID;
    
	mysql_free_result($qry_select_podetails);
    
    if ($str_format == FORMAT_PDF) {
        $pdf->PDFtable($header, $tabledata);
        $pdf->Ln(3);
        
        // When there is not enough room for the amount box add a new page.
    	if($pdf->GetY()+5>$pdf->PageBreakTrigger) {
    		$pdf->AddPage($pdf->CurOrientation);
   		}
   		//print comments
        $int_y = $pdf->GetY();
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(70,
                         5,
                         $obj_po->PurchaseOrderDescription,
                         0,
                         'L');
        
        //$pdf->Cell(70,5,"$obj_po->PurchaseOrderDescription");
        
        $pdf->SetDrawColor(0);
        $pdf->SetLineWidth(0.7);
   	    $pdf->SetFont('Arial','B',10);	
        
        $pdf->SetY($int_y);
        $pdf->SetX(-76);  	
        $pdf->Cell(40,5,"Total:",'LTB',0,'L');
        $pdf->Cell(20,5,"$obj_po->ValutaName ".sprintf("%.2f", $flt_total_amount),'TBR',2,'R');
		$pdf->Ln(7);
   	    $pdf->SetFont('Arial','',8);
		$pdf->Cell(179,4,PURCHASE_ORDER_CONDITIONS,0,1,'L');
		
	    if ($bl_send_pdf) {
            $pdf->Output($ary_config['temp_dir']."/PO$int_po_id.pdf" , 'F');
        } else {
            $pdf->Output();
        }
    }
}

if ($str_format != FORMAT_PDF || $bl_send_pdf) {
    echo "<PRE>$mailtxt</PRE><HR>";
    if ($bl_buyer) $str_email = $obj_po->buyer_email;
    echo "<TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\">\n";
        echo "<TR>\n";
    if (!$bl_submit) {
        echo "<TD><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Verzend\" CLASS=\"button\"></TD>\n";
        echo "<TD><INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\"></TD>\n";
        echo "<TD><INPUT TYPE=\"submit\" NAME=\"cancel\" VALUE=\"Cancel\" CLASS=\"button\"></TD>\n";
        echo "Print backorders ".MakeCheckbox('print_bo', $bl_print_bo);
        echo "</TR>\n";
        echo "<TR>\n";
        echo "<TD VALIGN=\"top\"><INPUT TYPE=\"hidden\" NAME=\"subject\" VALUE=\"$str_subject\">";
        echo "<INPUT TYPE=\"hidden\" NAME=\"poID\" VALUE=\"$int_po_id\">";
        echo "<INPUT TYPE=\"hidden\" NAME=\"format\" VALUE=\"$str_format\">";
        echo "<INPUT TYPE=\"hidden\" NAME=\"send\" VALUE=\"$bl_send_pdf\">";
        echo "Bericht:</TD>\n";
        echo "<TD colspan=2><TEXTAREA NAME=\"email\" COLS=\"80\" ROWS=\"1\" CLASS=\"form\">";
        echo $str_email;
        echo "</TEXTAREA><br>\n";
        echo "<TEXTAREA NAME=\"bericht\" COLS=\"80\" ROWS=\"25\" CLASS=\"form\">";
        echo $mailtxt;
        echo "</TEXTAREA></TD>\n";
    } else {
        echo "<td>Email verzend status </td><td>$sendok</td>";
    }
    echo "</TR>\n";
    echo "</TABLE>\n"; 
    echo "</FORM>\n"; 
    
    printenddoc();
}   
?>
