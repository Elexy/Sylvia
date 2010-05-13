<? 

include ("include.php");

// Include the class definition file.
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/class.html2text.php');

$str_option = isset($_POST["option"]) ? $_POST["option"] : FALSE;
$str_option = !$str_option && isset($_GET["option"]) ? $_GET["option"] : $str_option;
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$orderID = isset($_POST["orderID"]) ? $_POST["orderID"] : FALSE;
$orderID = !$orderID && isset($_GET["orderID"]) ? $_GET["orderID"] : $orderID;
$email = isset($_POST["email"]) ? $_POST["email"] : FALSE;
$bericht = isset($_POST["bericht"]) ? $_POST["bericht"] : FALSE;
$submit = isset($_POST["submit"]);
$update = isset($_POST["update"]);

$str_format = isset($_GET["format"]) ? $_GET["format"] : FORMAT_HTML;
$bl_invoice = isset($_GET["invoice"]);
$bl_orig = isset($_GET["original"]);
$str_format = isset($_POST["format"]) ? $_POST["format"] : $str_format;
$bl_color = isset($_REQUEST['color']) ? $_REQUEST['color'] : TRUE;
$int_shipment = isset($_REQUEST['shipment']) ? $_REQUEST['shipment'] : FALSE;

$header = array(); // Array to hold the header.
$tabledata = array(); // Array to hold the table data.
$str_header = "";
$int_invoice = FALSE;
$str_shipdate = "-";

if ($int_shipment)
{
  PDFshipmentDetailsInvoice($int_shipment,
      $bl_orig,
      $bl_color,
      $bl_orig,
      TRUE); // Proforma
} else
{

// Set the correct text to use.
  if ($str_option == ORDER_OFFERTE)
  {
    $str_text_used = "offerte";
  } else
  {
    $str_text_used = "orderbevestiging";
  }

  if ($str_format == FORMAT_HTML)
  {
  // Print default Iwex HTML header.
    printemailheader(COMPANYNAME . " bevestings/offerte e-mail");
    //printheader (COMPANYNAME . " bevestings/offerte e-mail", "orderbevestiging", FALSE);
    echo '<BODY>';
    if ($submit)
    {
      printIwexNav();
      echo "<h3>De volgende $str_text_used is verzonden:</h3><hr>";
    } else
    {
      echo "<h3>De volgende $str_text_used zal worden verzonden:</h3><hr>";
    }
    echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n";
  }

  // Check if order ID is given.
  if ($orderID
      &&
      !$submit
      &&
      !$update
  )
  {
  // Create a query to select the customer and the products to be e-mailed.
    $sql = 'SELECT contacts.ContactID, contacts.CompanyName, contacts.languageID ,language, orders.OrderID,
			orders.Btw_YN, 
            orders.ShipName, orders.ContactsOrderID, contacts.email, contacts.btw_number,
            Shipaddress, ShipPostalCode, ShipCity, ShipCountry, OrderDate, ShippedDate
            FROM contacts 
            inner join orders ON contacts.ContactID = orders.ContactID
			LEFT JOIN languages ON languages.languageID = contacts.languageID
            WHERE orders.OrderID =' . $orderID;

    $query = $db_iwex->query($sql) or  die (mysql_error());

    $obj = mysql_fetch_object($query);

    $ary_lang = $ary_languages[$obj->language];
    $int_languageID = $obj->languageID;

    //Select ordered products
    getorderdetails(&$orderquery, $orderID);

    switch ($str_format)
    {
      case FORMAT_HTML:
      //Select text to be e-mailed.
        $ary_mailtxt = Gettexten("2", $obj->languageID);
        $mailtxt = $ary_mailtxt[1];
        $str_subject = $ary_mailtxt[0];

        $mailtxt =  preg_replace("/".DB_CUST_REPLACE_VAR."/",
            $obj->CompanyName,
            $mailtxt);

        $mailtxt =  preg_replace(DB_COMFIRM_TYPE_VAR,
            $str_text_used,
            $mailtxt);

        $mailtxt =  preg_replace(DB_CUSTOM_ORDER_REF_VAR,
            $obj->ContactsOrderID,
            $mailtxt);

        $str_employee = GetField(GET_EMPLOYEE_NAME . $GLOBALS["employee_id"]);

        $mailtxt =  preg_replace(DB_EMPLOYEE_REPLACE_VAR,
            $str_employee,
            $mailtxt);

        $mailtxt =  preg_replace(DB_ONLINE_ORDER_VAR,
            "<A HREF='" . ONLINE_ORDER_STRING . $orderID . "'>$orderID</A>",
            $mailtxt);
        if ($str_option == ORDER_OFFERTE)
        {
          $subject = $ary_lang["order_subject1"].$ary_lang["order_subject3"]." $obj->ContactsOrderID ("
              .$ary_lang["order_subject1"]." $orderID)";
        } else
        {
          $subject = $ary_lang["order_subject2"].$ary_lang["order_subject3"]." $obj->ContactsOrderID ("
              .$ary_lang["order_subject2"]." $orderID)";
        }

        $BTWused = $obj->Btw_YN;

        if (!$email)
        {
          $email = $obj->email;
        }

        $str_order_details = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n"
            . "<tr><th>".$ary_lang["order_html_amount"]."</th><th>".$ary_lang["order_html_productid"]."</th>
			<th>".$ary_lang["order_html_price"]."</th><th>".$ary_lang["order_html_product"]."</th>
			<th>".$ary_lang["order_html_deliverydate"]."</th><th>".$ary_lang["order_html_total"]."</th></tr>";

        break; // End HTML case
      case FORMAT_PDF:
      //Instanciation of inherited class
        $pdf=new InvoicePDF('P','mm','A4');
        $pdf->SetProtection(array('print'));
        $pdf->SetMargins(15,20,15);
        $pdf->SetColor($bl_color);
        if ($str_option == ORDER_PROFORMA)
        {
          $pdf->SetProformaInvoice(TRUE);
        } else if ($str_option == ORDER_OFFERTE)
          {
            $pdf->SetOfferte(TRUE);
          } else if ($bl_invoice)
            {
              $int_invoice = GetField("SELECT InvoiceID FROM invoices WHERE orderID = $orderID");
              if ($int_invoice)
              {
                $pdf->SetCopyInvoice(!$bl_orig);
              } else
              {
              // Create an invoice
                $int_invoice = InsertInvoiceOrder($orderID);
              }
              $pdf->SetFootTxt(str_replace("X","$int_invoice", $ary_lang["invoice_footer"]) . $obj->CompanyName);
            } else
            { // When this is not an invoice use orderconfirmation.
              $pdf->SetOrderComfirm(TRUE);
            }
        $pdf->Open();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',10);
        $pdf->Ln(5);

        $pdf->SetWidths(array(30,59.5,30,59.5));
        $pdf->SetAligns(array('L','L','L','L'));
        $pdf->SetBorders(array('','','','',''));
        $pdf->SetHight(5);

        if ($int_invoice)
        { // Invoice data from the invoice table
          $sql_invoice = " SELECT invoices.*, btw_number, days
                             FROM invoices
                             INNER JOIN contacts ON invoices.CustomerID = contacts.ContactID 
                             LEFT JOIN paymentterm ON invoices.Paymentterm = PaymentTermID
                             WHERE invoices.InvoiceID = $int_invoice";

          $qry_inv = $db_iwex->query($sql_invoice);
          if ($objinv = mysql_fetch_object($qry_inv))
          {
            $str_shipto = "$objinv->ShipName\n";
            $str_shipto .= "$objinv->ShipAddress\n"
                ."$objinv->ShipPostalCode  $objinv->ShipCity\n"
                ."$objinv->ShipCountry";
            $pdf->Row(array($ary_lang["order_address"],
                "$objinv->companyName\n$objinv->Address\n$objinv->PostalCode  $objinv->City\n$objinv->Country",
                $ary_lang["order_delivery"],
                $str_shipto));
            $str_vat_number = $objinv->vat_number ? $objinv->vat_number : $objinv->btw_number;
            $time_date = strtotime($objinv->Invoice_date);
            $str_shipdate = $obj->ShippedDate ? date("j-n-Y", strtotime($obj->ShippedDate)) : NULL;
            $int_payment_term = $objinv->payment_type;
          }
          mysql_free_result($qry_inv);

        } else
        { // Proforma or order comfirm from the order table.
          $int_invoice_adres_id = GetInvoiceAdresId($obj->ContactID);

          $qry_inv_adres = $db_iwex->query("SELECT * FROM Adressen
                                              LEFT JOIN country ON land = code 
                                              WHERE AdresID = $int_invoice_adres_id");
          while ($objshipment = mysql_fetch_object($qry_inv_adres))
          {
            $str_companyname = $objshipment->Naam;
            if ($objshipment->attn != "")
            {
              $str_companyname .= "\nT.a.v. ".$objshipment->attn;
            }
            $str_address = $objshipment->straat ." ".$objshipment->huisnummer;
            $str_region = "";
            $str_city = $objshipment->plaats;
            $str_zipcode = $objshipment->postcode;
            $str_country = $objshipment->country;
          }

          mysql_free_result($qry_inv_adres);

          $str_shipto = "$obj->ShipName\n$obj->Shipaddress\n$obj->ShipPostalCode  $obj->ShipCity\n"
              ."$obj->ShipCountry";
          $pdf->Row(array($ary_lang["order_address"],
              "$str_companyname\n$str_address\n$str_zipcode  $str_city\n$str_country",
              $ary_lang["order_delivery_address"],
              $str_shipto));
          $str_vat_number = $obj->btw_number;
          $time_date = strtotime($obj->OrderDate);
        }
        $pdf->Ln(5);

        $pdf->SetWidths(array(29.833,29.833,29.833,29.833,29.833,29.833));
        $pdf->SetAligns(array('C','C','C','C','C','C'));
        $pdf->SetBorders(array('F','F','F','F','F','F'));
        $pdf->SetHight(4);

        if ($str_option == ORDER_PROFORMA)
        {
          $str_order_ref_id = $ary_lang["order_proformaid"];
          $str_order_ref = "PF".$orderID."R".rand(1, 99); // Generate a random nummber to make the proforma more unique.
        } else if ($str_option == ORDER_OFFERTE)
          {
            $str_order_ref_id = $ary_lang["order_offerte"];
            $str_order_ref = $orderID."O".rand(1, 99); // Generate a random nummber to make the offerte more unique.
          } else if ($int_invoice)
            {
              $str_order_ref_id = $ary_lang["order_invoicenum"];
              $str_order_ref = $int_invoice; // Generate a random nummber to make the offerte more unique.
            } else
            {
              $str_order_ref_id = $ary_lang["order_id"];
              $str_order_ref = $orderID;
            }
        // Use vat number from invoices. When that isn't there use the one from contacts.
        $pdf->PDFtable(array($str_order_ref_id, $ary_lang["order_date"], $ary_lang["order_delivery"],
            $ary_lang["order_custnumbers"], $ary_lang["order_vatnumber"], $ary_lang["order_senddate"]),
            array(array($str_order_ref,
            date("j-n-Y", $time_date),
            "-",
            $obj->ContactID,
            $str_vat_number,
            $str_shipdate)
            )
        );
        unset($str_shipdate);
        $pdf->Ln(5);

        $pdf->SetWidths(array(12,86,17,20,15,19,10));
        $pdf->SetAligns(array('R','L','L','R','R','R','R'));
        $pdf->SetBorders(array('F','F','F','F','F','F','F'));
        $pdf->SetHight(4);
        $header = array($ary_lang["order_id"], $ary_lang["order_name"], $ary_lang["order_merk"], $ary_lang["order_orderd"],
            $ary_lang["order_amount"], $ary_lang["order_total"], $ary_lang["order_vat"]);
        if ($int_invoice)
        {
          $str_header = $ary_lang["order_ref1"] ." $obj->ContactsOrderID";
        } else
        {
          $str_header = $ary_lang["order_ref2"] ." $obj->ContactsOrderID";
        }

        break; // End PDF casE
      default:
        echo "Wrong format case";
        break;
    }
    mysql_free_result($query);

    $ordercost = 0;
    $productcost = 0;
    $vatamount = 0;
    // Write order details to e-mail message.
    while ($objorderdet = mysql_fetch_array($orderquery, MYSQL_BOTH))
    {
      if ($str_format == FORMAT_HTML)
      {
        $str_order_details .= "<tr><td align=\"right\">" . $objorderdet["Quantity"] . "</td>"; // order_details.Quantity
        $str_order_details .= "<td align=\"right\">"
            . ONLINE_ARTICLE_LINK . $objorderdet["productID"] . "'>"
            . $objorderdet["productID"] . "</a></td>"; // ->current_product_list.productID
        $str_order_details .= "<td align=\"right\">" . $objorderdet["UnitPrice"] . "</td>"; // ->current_product_list.UnitPrice
        $str_order_details .= "<td>" . $objorderdet["ProductName"] . "</td>"; // ->current_product_list.Productname
        $str_order_details  .= "<td WIDTH='80' align='center'>".date("d-M-Y",
            strtotime(GetDeliveryDate($objorderdet["productID"],
            $orderID,
            $objorderdet["stock_owner_id"])
            )
            )."</td>\n";
        $str_order_details .= "<td align=\"right\">" . $objorderdet["Extended_price"] . "</td></tr>\n"; // ->order_details.extended_price
      } else if ($str_format == FORMAT_PDF)
        {
          if ($objorderdet["rma_actionID"])
          {
            $int_rma_id = GetField("SELECT RMAID from RMA_actions WHERE actionID='" . $objorderdet["rma_actionID"] . "'");
            $str_rma_ref = " Van RMA $int_rma_id";
            $str_cust_ref = GetField("SELECT Customer_ID
                                          FROM RMA_actions 
                                          INNER JOIN RMA ON ID = RMAID
                                          WHERE actionID='" . $objorderdet["rma_actionID"] . "'");
            $str_rma_ref .= $str_cust_ref ? ", ".$ary_lang["order_refrma"]." = '$str_cust_ref'" : "";
          } else
          {
            $str_rma_ref = "";
          }

          $tabledata[] = array($objorderdet["productID"],
              $objorderdet["ProductName"].$str_rma_ref,
              $objorderdet["Merk"],
              $objorderdet["Quantity"],
              ToDutchNumber($objorderdet["UnitPrice"]),
              ToDutchNumber($objorderdet["Extended_price"]),
              ($objorderdet["btw_percentage"]*100)."%" );
        }
      $ordercost += $objorderdet["cost_percentage"] * $objorderdet["Quantity"];
      $productcost += $objorderdet["Extended_price"];
      $vatamount += ($objorderdet["cost_percentage"] + $objorderdet["UnitPrice"]) * $objorderdet["Quantity"] * $objorderdet["btw_percentage"];
    }

    //	$vattotal = $BTWused ? $ $ordercost * 0.19 + $vatamount : 0;
    $ordercost = sprintf("%.2f", $ordercost);
    $productcost = sprintf("%.2f", $productcost);
    $totalexclvat = sprintf("%.2f", $productcost + $ordercost);
    $vatamount = sprintf("%.2f", $vatamount);
    $totalcost = $productcost + $ordercost + $vatamount;
    $totalcost = sprintf("%.2f", $totalcost);

    if ($bl_invoice)
    {
      $str_pterm = GetPaymentTermInvoice($int_invoice,
          &$int_payment_term_id,
          &$bl_incasso);
    } else
    {
      getpaymentterm($obj->ContactID, &$str_pterm, &$int_pterm, $int_languageID);
    }

    if ($str_format == FORMAT_HTML)
    {
      $str_order_details .= "</table><br>\n";
      $str_order_details .= "<table width=\"250\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
      $str_order_details .= "<tr><td>".$ary_lang["order_subtotal"]."</td><td align=\"right\"> &euro; $productcost</td></tr>\n";
      $str_order_details .= "<tr><td>".$ary_lang["order_order_costs"]."</td><td align=\"right\">&euro; $ordercost</td></tr>\n";
      $str_order_details .= "<tr><td></td><td></td></tr>\n";
      $str_order_details .= "<tr><td>".$ary_lang["order_total_vatex"]."</td><td align=\"right\"> &euro; $totalexclvat</td></tr>\n";
      $str_order_details .= "<tr><td>".$ary_lang["order_total_vat"]."</td><td align=\"right\"> &euro; $vatamount</td></tr>\n";
      $str_order_details .= "<tr><td></td><td></td></tr>\n";
      $str_order_details .= "<tr><td><strong>".$ary_lang["order_total"]."</strong></td><td align=\"right\"><strong> &euro;
          $totalcost</strong></td></tr></table>\n";

      $mailtxt =  preg_replace(DB_ORDER_DETAILS_TABLE_VAR,
          $str_order_details,
          $mailtxt);

      $mailtxt =  preg_replace(DB_PAYMENT_TERM_VAR,
          $str_pterm,
          $mailtxt);
      $str_creditterm = '';
        /*$flt_open_amount = GetOpenInvoiceAmount($obj->ContactID);
        $flt_unbooked_amount = GetUnBookedAmount($obj->ContactID);
        $flt_credit_amount = CurrentCreditAmount($obj->ContactID);
        $flt_credit_limit = CurrentCreditLimit($obj->ContactID);
        $ftl_open_amount = $flt_credit_limit - $flt_open_amount + $flt_unbooked_amount;
        $open_after_order = $ftl_open_amount - $totalcost;
        $sqlwhere = "WHERE CustomerID = '$obj->ContactID'";
        $flt_overdue_amount = Overdue();
        $insufficient_funds = ($open_after_order < 0) || ($flt_overdue_amount > 0);*/
      $insufficient_credit = !Credit_Status($obj->ContactID,
          $totalcost,
          &$open_after_order,
          &$flt_overdue_amount,
          &$flt_credit_limit,
          &$flt_credit_amount);
      $payment_term = GetPaymentTerm($obj->ContactID,&$str_paymentterm, TRUE, $int_languageID);

      if ($int_pterm == PAYMENTERM_ID_UPFRONT && $str_option != 2)
      {
        $str_creditterm .= "<p style='color: rgb(255, 255, 255); background-color: rgb(255, 0, 0);'>" .
            $ary_lang["order_creditterm1"] . ADMINISTRATION_TAG;
      } else if (Overdue($obj->ContactID) > DB_INVOICE_MARGIN
            &&
            $str_option != ORDER_OFFERTE)
        {
          $str_creditterm .= "<p style='color: rgb(255, 255, 255); background-color: rgb(255, 0, 0);'>" .
              $ary_lang["order_creditterm2"];
          if ($open_after_order < 0)
          {
            $str_creditterm .= $ary_lang["order_creditterm3"] . ToDutchNumber($flt_credit_limit);
            $str_creditterm .= $ary_lang["order_creditterm4"] . ToDutchNumber($open_after_order)."<br>";
          }
          if ($flt_overdue_amount)
          {
            $str_creditterm .= str_replace("X" , $str_paymentterm, $ary_lang["order_creditterm5"]) .
                ToDutchNumber($flt_overdue_amount)."!<br>";
          }
          $str_creditterm .= $ary_lang["order_creditterm6"] . ADMINISTRATION_TAG . "</p>\n";
        }

      $mailtxt =  preg_replace(DB_CREDIT_TEXT_VAR,
          $str_creditterm,
          $mailtxt);

      $str_ship_to_adres = "$obj->ShipName<br>\n$obj->Shipaddress<br>\n$obj->ShipPostalCode  $obj->ShipCity<br>";
      $mailtxt =  preg_replace(DB_SHIP_TO_ADRES_VAR,
          $str_ship_to_adres,
          $mailtxt);

      $mailtxt .= "<p>".printbankinfo($ary_lang)."</p>";

      if ($flt_credit_limit * (1-CREDITLIMIT_THRESHOLD) > $flt_credit_amount)
      {
        $mailtxt .= "<p>".PrintCreditStatus($obj->ContactID)."</p>";
      }

      $mailtxt .= printbackorderlist($obj->ContactID, $obj->OrderID);
    } else if ($str_format == FORMAT_PDF)
      {
        $pdf->PDFtable($header, $tabledata, $str_header);

        if ($int_invoice) CompareTotalAmountWithInvoice($int_invoice, $totalcost);

        $ordercost = ToDutchNumber($ordercost);
        $productcost = ToDutchNumber($productcost);
        $totalexclvat = ToDutchNumber($totalexclvat);
        $vatamount = ToDutchNumber($vatamount);
        $totalcost = ToDutchNumber($totalcost);

        $pdf->Ln(5);
        // When there is not enough room for the amount box add a new page.
        if($pdf->GetY()+4*5>$pdf->PageBreakTrigger)
        {
          $pdf->AddPage($pdf->CurOrientation);
        }
        //$pdf->SetDrawColor(0);
        $pdf->SetFillColor(200,74,19);
        $pdf->SetDrawColor(244,113,20);
        $pdf->SetLineWidth(0.1);
        $pdf->SetFont('Arial','B',10);

        $pdf->Cell(100,
            10,
            $ary_lang["order_paymentterm"] ." $str_pterm",
            1,
            0,
            'L');

        $pdf->SetFont('Arial','',10);

        $pdf->SetX(-76);

        $pdf->Cell(40,5,$ary_lang["order_subtotal"],'LT',0,'L');
        $pdf->Cell(20,5," $productcost",'RT',2,'R');
        $pdf->SetX(-76);
        $pdf->Cell(40,5,$ary_lang["order_order_costs"],'L',0,'L');
        $pdf->Cell(20,5," $ordercost",'R',2,'R');
        $pdf->SetX(-76);
        $pdf->Cell(40,5,"",'L',0,'L');
        $pdf->Cell(20,5,"+ ------------",'R',2,'R');
        $pdf->SetX(-76);

        $pdf->Cell(40,5,$ary_lang["order_total_vatex"],'L',0,'L');
        $pdf->Cell(20,5," $totalexclvat",'R',2,'R');
        $pdf->SetX(-76);
        $pdf->Cell(40,5,$ary_lang["order_total_vat"],'L',0,'L');
        $pdf->Cell(20,5," $vatamount",'R',2,'R');
        $pdf->SetX(-76);
        $pdf->Cell(40,5,"",'L',0,'L');
        $pdf->Cell(20,5,"+ ------------",'R',2,'R');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(-76);
        $pdf->Cell(40,5,$ary_lang["order_total"],'LB',0,'L');
        $pdf->Cell(20,5," $totalcost",'BR',2,'R');

        $pdf->Output();
      }

    mysql_free_result($orderquery);
  }

  // Check if it is ok to be e-mailed.
  if ($submit)
  {
    $name = $GLOBALS["ary_config"]["emailname.sales"];
    $myemail = $GLOBALS["ary_config"]["email.sales"];

    $bericht = stripslashes($bericht);
    $h2t = new html2text($bericht);

    $mailtxt = $emailheader . "<body>\n" . $bericht . "<br></body></html>";

    // Create new mail class
    $SMTPMail = new phpmailer();
    $SMTPMail->From     = $myemail;
    $SMTPMail->FromName = $name;
    if (EXTERNAL_SMTP_SERVER)
    {
      $SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
      $SMTPMail->Mailer   = "smtp";
    } else
    { // Use normail PHP mail().
      $SMTPMail->Mailer   = "mail";
    }
    $SMTPMail->Subject  = $subject;
    $SMTPMail->Body     = $mailtxt;
    $SMTPMail->AltBody  = $h2t->get_text();
    $elements = preg_split("/[,;]+/", $email);
    for ($i = 0; $i < count($elements); $i++)
    {
      $SMTPMail->AddAddress($elements[$i]);
    }
    $SMTPMail->AddCC($myemail);
    $bl_mailcheck = $SMTPMail->Send();
/*
    if (mail($email,
             $subject,
             $mailtxt,
             "From: $name <$myemail>\nCc:" . $GLOBALS["ary_config"]["email.sales"] . "\nContent-type: text/html")) {
*/
    if ($bl_mailcheck)
    {
      $sendok = "Ok";
      SetOrderHistory($orderID, "$str_text_used verzonden", $email, 0);
    } else
    {
      $sendok = "<b>Failed</b>";
    }

    unset($SMTPMail);
  } else if (($update))
    {
      $mailtxt = stripslashes($bericht);
    }

  if ($str_format == FORMAT_HTML)
  {
    echo "$mailtxt <hr>";

    echo "<TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\" width='100%'>\n";
    echo "<TR>\n";
    if (!$submit)
    {
    //echo $_SERVER["HTTP_USER_AGENT"];
      echo AddEditorScript('bericht');
      echo "<TD><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Verzend\" CLASS=\"button\"></TD>\n";
      echo "<TD width='100%'><INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\"></TD>\n";
      echo "</TR>\n";
      echo "<TR>\n";
      echo "<TD VALIGN=\"top\"><INPUT TYPE=\"hidden\" NAME=\"subject\" VALUE=\"$subject\">";
      echo "Email:</TD>\n";
      echo "<TD><input type=text NAME=\"email\" SIZE=25 CLASS=\"form\" value='$email'></td>\n";
      echo "</tr><tr>";
      echo "<td colspan=2><TEXTAREA NAME=\"bericht\" id=\"bericht\" ROWS=40 COLS=80 style=\"WIDTH: 100%;\" CLASS=\"form\">";
      echo $mailtxt;
      echo "</TEXTAREA></TD>\n";
      echo "<input type=hidden name=option value='$str_option'>";
      echo "<input type=hidden name=orderID value='$orderID'>";
    } else
    {
      echo "<td>Email verzend status </td><td>$sendok</td>";
    }
    echo "</TR>\n";
    echo "</TABLE>\n";
    echo "</FORM>\n";

    printenddoc();
  }

} // end 
?>
