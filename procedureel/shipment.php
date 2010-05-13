<?php
 /*
 * shipment.php
 *
 * @version $Id: shipment.php,v 1.170 2007-10-04 10:20:51 alex Exp $
 * @copyright $date:
 **/


include ("include.php");
include ("includes/ship_label_functions.php");

// Get all the URL variable we need.
$bl_submitnew = isset($_GET["submitnew"]) ? TRUE : FALSE;
$bl_submit = isset($_POST["add"]) ? TRUE : FALSE;
$bl_newshipment = isset($_POST["newshipment"]) ? TRUE : FALSE;
$bl_printpackinglist = isset($_POST["printpackinglist"]) ? TRUE : FALSE;
$bl_printupslabel = isset($_POST["makeupslabel"]);
$bl_allowupslabel = isset($_POST["allowupslabel"]);
$bl_printdhllabel = isset($_POST["makedhllabel"]);
$bl_allowdhllabel = isset($_POST["allowdhllabel"]);
$bl_allowglslabel = isset($_POST["allowglslabel"]);
$bl_getupstracking = isset($_POST["gettracking"]) ? TRUE : FALSE;
$bl_showcomplete = isset($_POST["showcomplete"]) ? TRUE : FALSE;
$bl_filter = isset($_POST["filter"]);
$bl_use_stock = GetCheckBox("use_stock");
$bl_delete_shipment = isset($_POST["delete_shipment"]) ? TRUE : FALSE;
$int_shipmentID = isset($_POST["shipmentID"]) ? $_POST["shipmentID"] : FALSE;
$int_shipmentID = isset($_GET["shipmentID"]) && !$int_shipmentID ? $_GET["shipmentID"] : $int_shipmentID;
$int_orderdetailsID = isset($_POST["orderdetailsID"]) ? $_POST["orderdetailsID"] : FALSE;
$int_addressID = isset($_POST["formadresid"]) ? $_POST["formadresid"] : FALSE;
$int_packed_article = isset($_POST["packed_article"]) ? $_POST["packed_article"] : FALSE;
$int_amount_packed_article = isset($_POST["amount_packed_article"]) ? $_POST["amount_packed_article"] : FALSE;
$int_products_retour = isset($_POST["products_retour"]) ? $_POST["products_retour"] : 0;
$int_last_packed_article = isset($_POST["last_packed_article"]) ? $_POST["last_packed_article"] : 0;
$int_box_no = isset($_REQUEST["box_no"]) ? $_REQUEST["box_no"] : 1;
$ch_tracking = isset($_POST["tracking"]) ? $_POST["tracking"] : FALSE;
$str_date = isset($_POST["date"]) ? $_POST["date"] : date("Y-m-d");
$int_max_box = isset($_POST["max_box"]) ? $_POST["max_box"] : FALSE;
$bl_change_box = GetCheckBox('change_box');
$str_show_no_stock = GetSetFormVar("show_no_stock");
$bl_grant_shipment = FALSE;

$bl_shipmentdone = false;
$bl_allpaid = FALSE;
$bl_clear_tracking = FALSE;
$str_javascript_onload = "";


define('SHIPMENT_FORM', 'shipmentform');

$formname = SHIPMENT_FORM;

if (stristr ($int_shipmentID,'sh'))
{
  $packing =true;
  $int_shipmentID = substr($int_shipmentID,2);
} elseif (stristr ($int_shipmentID,'ad'))
{
  $packing =true;
  $int_shipmentID = substr($int_shipmentID,2);
} else
{
  $packing =false;
}


// The popup javascript
$str_javascript_gls_popup = "window.open('boxlist.php?shipment=$int_shipmentID&format=pdf&gls=1','Boxlist$int_shipmentID','toolbar=0,menubar=0,resizable=0,dependent=0,status=0,width=800,height=500,left=25,top=25')";
$str_javascript_shipment_list_popup = "window.open('boxlist.php?shipment=$int_shipmentID&format=pdf','Boxlist$int_shipmentID','toolbar=0,menubar=0,resizable=0,dependent=0,status=0,width=800,height=500,left=25,top=25')";

$str_temp = $int_packed_article ? strtoupper($int_packed_article) : strtoupper($ch_tracking);
switch ($str_temp)
{
  case SHIPMENT_READY:
    $bl_shipmentdone = true;
    break;
  case SHIPMENT_CLEAR_TRACKING:
    $bl_clear_tracking = true;
    $ch_tracking = '' ; //clear tracking because it wasn't a trackingnumber
    break;
  case SHIPMENT_REOPEN:
    $bl_shipmentdone = false;
    $track_shipment_sql='UPDATE shipments SET
						     Ship_date = NULL
						     WHERE shipment_ID = "'.$int_shipmentID.'" AND isnull(InvoiceID)';
    //   echo $track_shipment_sql;
    $query_track_shipment = mysql_query($track_shipment_sql);
    $packing=true; // restart packing
    $ch_tracking = '' ; //clear tracking because it wasn't a trackingnumber
    break;
  case SHIPMENT_MAKE_SHIPLIST:
    $ch_tracking = FALSE;
    // Only possible to print shiplist when not a packed article is given. But when shipment ready.
    $str_javascript_onload = $int_packed_article ? "" : $str_javascript_shipment_list_popup;
    break;
  case SHIPMENT_RETURN_TO_LIST:
    $str_javascript_onload = "location.replace('".$_SERVER['PHP_SELF']."')";
    $ch_tracking = FALSE;
    break;
  case SHIPMENT_MAKE_UPS:
    $bl_printupslabel = $bl_allowupslabel;
    $ch_tracking = FALSE;
    break;
  case SHIPMENT_MAKE_DHL:
    $bl_printdhllabel = $bl_allowdhllabel;
    $ch_tracking = FALSE;
    break;
  case SHIPMENT_MAKE_GLS:
    $str_javascript_onload = $bl_allowglslabel ? $str_javascript_gls_popup : "";
    $ch_tracking = FALSE;
    break;
} 


// temporary button for changeover period only.

if (isset($_POST["updorders"]))
{
  $sql_shipments = "SELECT Distinctrow OrderID FROM
      orders";
  //   echo $sql_shipments;
  $query_order = mysql_query($sql_shipments)
      or die("Ongeldige query: " .$sql_shipments. mysql_error());
  While ($obj = mysql_fetch_object($query_order))
  {
    upd_orderstatus($obj->OrderID);
  }
  mysql_free_result($query_order);
}

$RMA_openordersSQL  = "SELECT
    OrderDetailsID, orders.OrderID, order_details.ProductID, order_details.ProductName, orders.OrderDate,
    order_details.ProductDescription, UnitPrice, orders.ShipID, orders.ContactsOrderID,
    UnitBTW, Quantity, Extended_price, Discount, SerialNB, orders.ContactID, orders.ContactsOrderID,
    btw_percentage, cost_percentage, to_deliver, manual_price, stock, ExternalID, store_serial_yn,
    Adressen.AdresID, Adressen.Naam AS Shipname, contacts.CompanyName, location, 
    order_details.rma_actionID, orders.rma_yn, RMA_actions.RMAID
    FROM order_details
    INNER JOIN RMA_actions ON order_details.rma_actionID = RMA_actions.ActionID 
    INNER JOIN orders ON orders.orderID = order_details.OrderID 
			AND (orders.RequiredDate <= date(NOW()) OR ISNULL(orders.RequiredDate))
    INNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID
    INNER JOIN contacts ON contacts.ContactID = orders.ContactID
    LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = ".DB_IWEX_RMA_CUST_ID."
    LEFT JOIN location ON location_ID = location.ID
    LEFT JOIN Adressen ON Adressen.AdresID = orders.ShipID ";

// Print default Iwex HTML header.
printheader (COMPANYNAME . " shipment screen", "shipments", !$bl_printpackinglist);

if ($bl_printpackinglist)
{      // update start_date to now()
  $finish_shipment_sql='UPDATE shipments SET
       Start_date = '.insertDate(date("Y-m-d H:i:s")).'
       WHERE shipment_ID = "'.$int_shipmentID.'"';
  $query_finish_shipment = mysql_query($finish_shipment_sql);
  echo "<body onLoad=\"print();location.replace('".$_SERVER['PHP_SELF']."');\">\n";
} else
{
  echo "<BODY ".get_bgcolor()." "
      .($str_javascript_onload ? "onLoad = \"$str_javascript_onload\"" : "")
      . "><FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='".SHIPMENT_FORM."'>\n";
  // Used for calendar function.
  echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
}

if ($bl_submitnew&&!check_open_shipment($_GET["newadresid"]))
{   // insert new record in shipments
  $newshipment_sql = 'INSERT INTO shipments
        SET
        Start_date = NULL,
        Ship_date = NULL ,
        AdressID = '.$_GET["newadresid"];
  $insert_shipment_query = mysql_query($newshipment_sql)
      or die("Ongeldige select details query: " .$newshipment_sql. mysql_error());
  $bl_submitnew = false; //we only add it once
}


if ($int_shipmentID&&!$bl_printpackinglist)  // if a shipmentid is given but submit or print is not pressed yet

{
  echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
  printIwexNav(FALSE);

  if (!$int_max_box)
  {
    $ary_boxes = array();
    if (get_box_numbers(&$ary_boxes, $int_shipmentID))
    {
      $int_max_box = mysql_numrows($ary_boxes); // Count the amount of boxes for this shipment.
      // Set the box number to the last one. Because this is the most likely box that is used to fill up.
      $int_box_no = $int_max_box;
      mysql_free_result($ary_boxes);
    }
    if (!$int_box_no)
    {
      $int_max_box = 1; // Default box 1 is used.
      $int_box_no = 1;
    }
  }


  if ($bl_submit&&!$bl_shipmentdone&&!$ch_tracking)
  { // if user has packed an article update it to inventory_transactions
  // Check if there should be products placed back to the warehouse.
  //echo "Retour $int_products_retour<br>\n";
    if ($int_products_retour)
    {
      if ($int_packed_article == $int_last_packed_article)
      {
      // Ok now remove the amount to place back.
        if ($int_products_retour >= $int_amount_packed_article)
        {
          $int_products_retour -= $int_amount_packed_article;
          if ($int_products_retour)
          {
            echo "<h2 align=center class=\"menubar\">Ok, nog $int_products_retour van artikel $int_packed_article terug leggen</h2>";
          }
          echo MakeBeep(TRUE);
        } else
        {
          echo "<h2 align=center class=\"menubar\">Te veel van artikel ($int_packed_article) terug gepakt.<br>Moeten er $int_products_retour terug naar de voorraad.!!</h2>";
          echo MakeBeep(FALSE);
        }
      } else
      {
        echo "<h2 align=center class=\"menubar\">Verkeerde product ($int_packed_article) terug gepakt.<br>Moet een $int_last_packed_article zijn!!</h2>";
        $int_packed_article = $int_last_packed_article;
        echo MakeBeep(FALSE);
      }
    } else
    {
    // When succesfull clear the inserted artikel name and amount of units.
      if (box($int_addressID,
      $int_shipmentID,
      $int_packed_article,
      $int_amount_packed_article,
      $int_box_no,
      !$saccess_v, // When false products can also be removed from a box when already put in.
      &$int_products_retour))
      {
        $int_packed_article = "";
        $int_max_box = $int_box_no > $int_max_box ? $int_box_no : $int_max_box;
      }
    }
    echo "<INPUT TYPE=\"hidden\" NAME=\"products_retour\" CLASS=\"form\" value=\"".$int_products_retour."\">\n";
    echo "<INPUT TYPE=\"hidden\" NAME=\"last_packed_article\" CLASS=\"form\" value=\"".$int_packed_article."\">\n";
    $int_amount_packed_article = 0;
    $packing =true;
  } else if ($bl_shipmentdone)
    { //if user has scanned the 'klaar' barcode

      $finish_shipment_sql='UPDATE shipments SET
       Ship_date = '.insertDate(date("Y-m-d H:m:s")).'
       WHERE shipment_ID = "'.$int_shipmentID.'"';
      $query_finish_shipment = mysql_query($finish_shipment_sql);
      // now delete this contactID from  the temporary granting table if its there
      $int_contact_id = Getfield("SELECT ContactID FROM shipments
								INNER JOIN Adressen on Adressen.adresID=shipments.AdressID
								WHERE Shipment_ID='$int_shipmentID'");

      // Set error befor Alow shipment ones is deleted.
      $int_allowshipment = GetField("SELECT grant_shipment FROM allow WHERE ContactID = $int_contact_id");
      //echo "<br>deleted 'Allow Shipment' for: " . $int_contact_id;

      // grant_shipment($int_contact_id, FALSE, TRUE, TRUE); Now done when invoice made.

      if (getfield("SELECT confirm_delivery FROM contacts WHERE ContactID = '$int_contact_id'"))
      {
        $str_confirmcode = Makecode(8);
        if (!Getfield("SELECT confirmcode FROM shipments_confirmcode WHERE shipmentID = '$int_shipmentID'"))
        {
          $str_text = 13;
          $db_iwex->query("INSERT INTO shipments_confirmcode(shipmentID, confirmcode)
								VALUES('$int_shipmentID' ,'$str_confirmcode')");
        } else
        {
          $str_text = 14;
          $db_iwex->query("UPDATE shipments_confirmcode SET confirmcode = '$str_confirmcode'
								 WHERE shipmentID ='$int_shipmentID' ");
          $db_iwex->query("UPDATE shipments
								 SET shipment_confirmed = '0'
								 WHERE Shipment_ID ='$int_shipmentID' ");
        }

        // Select the mail address from the contact.
        $str_mailaddress = Getfield("SELECT email FROM contacts WHERE ContactID = '$int_contact_id'");

        // Select mailtext from the database.
        $result_text = $db_iwex->query("SELECT NLtext ,Description FROM text WHERE ID = $str_text");
        $obj_text = mysql_fetch_object($result_text);

        // Set mail options.
        $str_fromname = $GLOBALS["ary_config"]["emailname.logistical"];
        $str_mail_from = $GLOBALS["ary_config"]["email.logistical"];
        $str_subject = $obj_text->Description;
        $str_mailtxt = $obj_text->NLtext;
        $str_mailtxthtml = "<html><body>\n" . $str_mailtxt . "<br></body></html>";
        $str_email_to = $str_mailaddress;

        // Set acception link into the mailtext.
        $str_mailtxt = str_replace(DB_ACCEPTIONLINK,
            "<A HREF='".$GLOBALS["ary_config"]["dealersitelink"]."/shipmentaccept.php?ship=$int_shipmentID' TARGET='_new'>
							 Accept Shipment</A>",
            $str_mailtxt);

        $str_mailtxt = str_replace(DB_SHIPMENT_ID ,$int_shipmentID, $str_mailtxt);
        $str_mailtxt = str_replace(DB_ACCEPTION_CODE ,$str_confirmcode, $str_mailtxt);

        Getshipmentpdf($int_shipmentID, "pdf");

        // The file will be send with mail to the invoice mail!
        $SMTPMail = new phpmailer();
        $SMTPMail->From     = $str_mail_from;
        $SMTPMail->FromName = $str_fromname;
        if (EXTERNAL_SMTP_SERVER)
        {
          $SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
          $SMTPMail->Mailer   = "smtp";
        } else
        { // Use normail PHP mail().
          $SMTPMail->Mailer   = "mail";
        }
        $SMTPMail->Subject  = $str_subject;
        $SMTPMail->Body     = $str_mailtxthtml;
        $SMTPMail->AltBody  = strip_tags($str_mailtxt);
        $elements = preg_split("/[,;]+/", $str_email_to);
        for ($i = 0; $i < count($elements); $i++)
        {
          $SMTPMail->AddAddress($elements[$i]);
        }
        $SMTPMail->AddCC($str_mail_from);
        $SMTPMail->AddEmbeddedImage($GLOBALS['ary_config']['temp_dir']."/shipmentmail.pdf",
            "Invoice",
            "shipmentmail.pdf");
      }


    } else if ($ch_tracking || $bl_clear_tracking)
      { //if user has scanned the tracking barcode
        $track_shipment_sql='UPDATE shipments SET
       Tracking = "'.$ch_tracking.'"
       WHERE shipment_ID = "'.$int_shipmentID.'"';
        //       echo $track_shipment_sql;

        $query_track_shipment = mysql_query($track_shipment_sql);
      } else if ($bl_printupslabel)
        { // If user would like to print the UPS label.
          if (!CreateUPSlabel($int_shipmentID, $ary_config['ups_xml_dir']))
          {
            echo "<h2 align=center class=\"menubar\">UPS label printen niet gelukt!</h2>";
          } else
          {
            $bl_found = FALSE;
            for ($int_cnt = 0; $int_cnt < 4 && !$bl_found; $int_cnt++)
            {
              sleep(5); // Waith 5 seconds for UPS worldship to proces the file.
              $str_upstrack = GetUPStrackingNum($int_shipmentID, $ary_config['ups_xml_dir']);
              if ( $str_upstrack == NULL)
              {
                echo ($int_cnt+1)*5 ." sec.<br>";
              } else
              {
                $bl_found = TRUE;
              }
            }
            unset ($bl_found);
          }
        } else if ($bl_getupstracking)
          { // If user like to know the tracking number of the UPS label.
            if (GetUPStrackingNum($int_shipmentID, $ary_config['ups_xml_dir']) == NULL)
            {
              echo "<h2 align=center class=\"menubar\">Geen UPS tracking number gevonden!</h2>";
            }
          } else if ($bl_printdhllabel)
            { // If user would like to print the DHL label.
              if (!MakeDHLlabel($int_shipmentID,
              $ary_config['dhl_printer_url']))
              {
                echo "<h2 align=center class=\"menubar\">DHL label printen niet gelukt!</h2>";
              }
            }

  // get the supplied shipmentID
  $shipment_sql = SQL_SHIPMENTS . "
        WHERE shipment_ID = '$int_shipmentID'
        ORDER BY Shipment_ID Desc;";
  //echo $shipment_sql;
  $no_stock_condition = $str_show_no_stock != 'true' ? "" : " AND stock > '0' ";

  $shipmentdetail_query = mysql_query($shipment_sql)
      or die("Ongeldige select details query: " .$shipment_sql. mysql_error());
  $objshipment = mysql_fetch_object($shipmentdetail_query);
  $orderdetail_sql = SQL_openorderdetails . " WHERE order_details.to_deliver <> 0
      AND " . openordedetails_condition . " 
	  AND orders.ShipID= '$objshipment->AdresID' 
	  AND (orders.RequiredDate <= date(NOW()) OR ISNULL(orders.RequiredDate))
	  AND (rma_yn <> 1 or isnull(rma_yn)) 
      $no_stock_condition
      ORDER BY stock DESC, ProductID;";
  //echo $orderdetail_sql;
  $orderdetail_RMA_sql = $RMA_openordersSQL . "
        WHERE order_details.to_deliver <> 0 AND " . openordedetails_condition . " 
        AND orders.ShipID= '$objshipment->AdresID' AND rma_yn = '1' 
        ORDER BY ProductID;";

  // Shipment information header.
  if ($objshipment->InvoiceID)
  { $bgcolor="#FFABA9"; } else
  { $bgcolor=""; };
  echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" >\n";
  echo "    <TR>\n";
  echo "         <TH colspan='2'><B>Shipment ID $objshipment->Shipment_ID</B></TH>\n";
  echo "    </TR>\n";
  echo "     <TD WIDTH='50%'>\n";
  echo "      <TABLE WIDTH='100%' BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
  echo "         <TR>\n";
  echo "             <TH colspan='2'><B>Ship To Adress ".$objshipment->AdresID."</B></TH>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  echo "             <TD ALIGN='RIGHT'>Naam: </TD><TD>".$objshipment->Naam."</TD>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  echo "             <TD ALIGN='RIGHT'>T.a.v. : </TD><TD>".$objshipment->attn."</TD>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  echo "             <TD ALIGN='RIGHT'>Adres: </TD><TD>".$objshipment->straat." ".$objshipment->huisnummer."</TD>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  echo "             <TD ALIGN='RIGHT'>PC + Plaats : </TD><TD>".$objshipment->postcode."  ".$objshipment->plaats."</TD>\n";
  echo "         </TR>\n";
  echo "      </table>";
  echo "     </TD>\n";
  echo "     <TD VALIGN='top' WIDTH='50%'>\n";
  echo "      <TABLE WIDTH='100%' BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
  echo "         <TR>\n";
  echo "             <TH colspan='2'>Shipment Data </TH>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  echo "             <TD ALIGN='RIGHT'>Date Printed: </TD><TD>".$objshipment->Start_date."</TD>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  echo "             <TD ALIGN='RIGHT'>Date Shipped : </TD><TD>".$objshipment->Ship_date."</TD>\n";
  echo "         </TR>\n";
  echo "         <TR>\n";
  $factuur_separate = GetInvoiceAdresId($objshipment->ContactID) != $objshipment->AdresID;
  $flt_creditline = CurrentCreditAmount($objshipment->ContactID);
  $flt_overdue_amount = Overdue($objshipment->ContactID, TRUE);
  $bgcolor = CurrentCreditAmount($objshipment->ContactID) > 0 ? FALSE : NOT_PAID_OVERDUE_BGCOLOR;
  $flt_credit_limit = GetCreditLimit($objshipment->ContactID);
  $ftl_open_amount = CurrentCreditAmount($objshipment->ContactID) > 0;
  $insufficient_funds = ($ftl_open_amount <= 0) || ($flt_overdue_amount > 0);
  $bgcolor = $insufficient_funds ? NOT_PAID_OVERDUE_BGCOLOR : FALSE;
  $bgcolor = ($objshipment->Paymentterm == PAYMENTERM_ID_UPFRONT) ? OPENWEBORDER_BGCOLOR : $bgcolor;

  if ($str_grant = Grant_shipment($objshipment->ContactID, FALSE))
  {
    $bgcolor = ALLOW_EXEPTION_COLOR;
    $bl_grant_shipment = TRUE;
  //echo "shipments allowed $str_grant $objshipment->ContactID";
  }
  if ($objshipment->Ship_date
      && !$objshipment->InvoiceID
      && !$factuur_separate
      && $objshipment->Paymentterm != PAYMENTERM_ID_UPFRONT
      && GetDeliveryValue($int_shipmentID) <= $flt_creditline)
  {
    echo "             <TD BGCOLOR=\"$bgcolor\" ALIGN='RIGHT'><A onclick=
        \"window.open('invoice_shipments.php?shipID=$objshipment->Shipment_ID&print=true&original=1','factuurklant','toolbar=0,menubar=0,resizable=0,dependent=0,status=0,width=800,height=500,left=25,top=25')\" HREF=''>
        Factureren </A></TD><TD BGCOLOR=\"$bgcolor\">".$objshipment->InvoiceID."</TD>\n";
  } else if ($objshipment->InvoiceID)
    {
      echo "             <TD BGCOLOR=\"$bgcolor\" ALIGN='RIGHT'>InvoiceID: </TD><TD BGCOLOR=\"$bgcolor\"><A HREF=\"invoice_shipments.php?shipID=".$objshipment->Shipment_ID."\">".$objshipment->InvoiceID."</A></TD>\n";
    } else if ($objshipment->Paymentterm == PAYMENTERM_ID_UPFRONT)
      {
        echo "           <TD BGCOLOR=".NOT_PAID_OVERDUE_BGCOLOR." ALIGN='RIGHT'>Klaarzetten en wachten op vooruit betaling:";
        if ($bl_allpaid = Orderpaidcheck($objshipment->ContactID,
        $int_shipmentID,
        &$int_all_order_total))
        {
          echo "<BR>De controlle heeft ondervonden dat er &euro; $int_all_order_total overgemaakt is voor de orders.";
        }

        echo " </TD>
				<TD BGCOLOR=".NOT_PAID_OVERDUE_BGCOLOR.">";
        echo "<A onclick=
        \"window.open('".$_GLOBAL["str_backdir"].ORDERCOMFIRM."?shipment=$int_shipmentID','factuurklant','toolbar=0,menubar=0,resizable=0,dependent=0,status=0,width=800,height=500,left=25,top=25')\">
        Proforma</A></TD>\n";
      } else if ($factuur_separate
            && GetDeliveryValue($int_shipmentID) <= $flt_creditline
            && !$flt_overdue_amount)
        {
          echo "             <TD BGCOLOR=\"$bgcolor\" ALIGN='RIGHT'>Factuur apart versturen</TD><TD BGCOLOR=\"$bgcolor\"></TD>\n";
        } /*removed by alex 5-7-05
                    else if ($flt_creditline <= 0
                ||
                $flt_overdue_amount > 0) {
        echo "<td colspan=2 BGCOLOR=".NOT_PAID_OVERDUE_BGCOLOR.">Over kredietlimiet (&euro; $flt_creditline) en/of buiten betalingstermijn (&euro; $flt_overdue_amount)</td>";
    } */else
        {
          echo "<td colspan=2 ></td>";
        }
  echo "         </TR>\n";
  echo "         <TR>\n";
  $track_link = createtrackinglink($objshipment->Tracking, $objshipment->postcode);
  if (strpos($track_link, "DHL"))
  {
    $track_link .= " <INPUT TYPE=\"hidden\" NAME=\"allowdhllabel\" value=\"1\">\n" .
        " <INPUT TYPE=\"submit\" NAME=\"makedhllabel\" CLASS=\"form\" value=\"Get Label(s)\">\n";
  }
  echo "             <TD ALIGN='RIGHT'>tracking: </TD><TD>".$track_link." </TD>\n";
  echo "         </TR>\n";
  echo "      </table>";
  echo "     </TD>\n";
  echo "     <TR>\n";
  echo "          <TD>\n";

  if ($packing&&!$objshipment->InvoiceID && !$int_products_retour)
  {
    echo "          ProductID: <INPUT TYPE=\"text\" NAME=\"packed_article\" CLASS=\"form\"' tabindex=1>\n";
    echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "packed_article", SHIPMENT_FORM.".packed_article");

    // When the amount is not set, set it to default 1.
    $int_amount_packed_article = $int_amount_packed_article ? $int_amount_packed_article : 1;
    echo " x <INPUT TYPE=\"text\" size=\"1\" NAME=\"amount_packed_article\" tabindex=2 align=right value='".$int_amount_packed_article."' CLASS=\"form\">\n";
    echo " Box ".ChoseNumberBox("box_no", $int_max_box, $int_box_no, TRUE, 3);
    echo " <INPUT TYPE=\"submit\" NAME=\"add\" tabindex=4 CLASS=\"form\" value=\"add\"></td><td>\n";
    // Set cursor on the artikel name field.
    echo '<script TYPE="text/javascript" language="JavaScript">document.'.SHIPMENT_FORM.'.packed_article.focus();</script>';
  } else if ($objshipment->Ship_date)
    {
      echo "          tracking: <INPUT TYPE=\"text\" size='15' NAME=\"tracking\" CLASS=\"form\" VALUE='$ch_tracking'>\n";
      echo '<script TYPE="text/javascript" language="JavaScript">document.'.SHIPMENT_FORM.'.tracking.focus();</script>';
      echo "          <INPUT TYPE=\"submit\" NAME=\"submittracking\" CLASS=\"form\" value=\"submit\"> ";
      if (!$objshipment->Tracking
          &&
          $GLOBALS["ary_config"]["ups_enabled"])
      {
        echo "<INPUT TYPE=\"submit\" NAME=\"gettracking\" CLASS=\"form\" value=\"GET UPS\">";
      }
      echo " Waarde is &euro; ".ToDutchNumber(GetDeliveryValue($int_shipmentID));
      echo "</td><td ALIGN=\"right\">\n";
      echo '<INPUT TYPE="button" VALUE="Leveringsbon" onclick="';
      echo $str_javascript_shipment_list_popup;
      echo '">';

      if (!$objshipment->Tracking
          && $objshipment->adrestitel != 2
          && $objshipment->adrestitel != 7
          && $objshipment->adrestitel != 6
          && !$objshipment->postbus
          && ($objshipment->Paymentterm != PAYMENTERM_ID_UPFRONT
          ||
          ($objshipment->Paymentterm == PAYMENTERM_ID_UPFRONT
          && ($objshipment->InvoiceID
          ||
          $bl_allpaid
          ||
          $bl_grant_shipment))
          )
          && ($objshipment->Paymentterm != PAYMENTERM_ID_REMBOURS
          ||
          $objshipment->Paymentterm == PAYMENTERM_ID_REMBOURS && $objshipment->InvoiceID)
      )
      {

        if ($objshipment->Paymentterm == PAYMENTERM_ID_REMBOURS)
        {
          echo " <b>Rembours!</b> ";
          if ($GLOBALS["ary_config"]["gls_enabled"])
          {
            echo ' <INPUT TYPE="button" VALUE="GLS" onclick="';
            echo "window.open('includes/ship_label.php?levering=$int_shipmentID','gls$int_shipmentID','toolbar=0,menubar=0,resizable=0,dependent=0,status=0,width=800,height=500,left=25,top=25')";
            echo '">';
          }
          if ($GLOBALS["ary_config"]["dhl_enabled"]) echo " <INPUT TYPE=\"submit\" NAME=\"makedhllabel\" CLASS=\"form\" value=\"DHL\">\n";
        } else if (!$objshipment->InvoiceID
              &&
              GetDeliveryValue($int_shipmentID) >= CurrentCreditAmount($objshipment->ContactID)
              &&
              !$bl_grant_shipment)
          {
            echo " <b>Over krediet limiet!</b> ";
          } else if ($str_shipment_error = shipmentvalidation($int_shipmentID))
            {
              echo "<BR>" . $str_shipment_error;
            } else if (getfield("SELECT confirm_delivery FROM contacts WHERE ContactID = '$objshipment->ContactID'")
                  &&
                  !getfield("SELECT shipment_confirmed FROM shipments WHERE Shipment_ID = '$int_shipmentID'"))
              {
                echo "Wacht op een bevesting van de klant";
              } else
              {
                if ($GLOBALS["ary_config"]["gls_enabled"])
                {
                  echo "<INPUT TYPE=\"hidden\" NAME=\"allowglslabel\" value=\"1\">\n";
                  echo ' <INPUT TYPE="button" VALUE="Levb GLS" ';
                  echo $str_javascript_gls_popup;
                  echo '">';
                }
                if ($GLOBALS["ary_config"]["ups_enabled"])
                {
                  echo "<INPUT TYPE=\"hidden\" NAME=\"allowupslabel\" value=\"1\">\n";
                  echo " <INPUT TYPE=\"submit\" NAME=\"makeupslabel\" CLASS=\"form\" value=\"UPS\">\n";
                }
                if ($GLOBALS["ary_config"]["dhl_enabled"])
                {
                  echo "<INPUT TYPE=\"hidden\" NAME=\"allowdhllabel\" value=\"1\">\n";
                  echo " <INPUT TYPE=\"submit\" NAME=\"makedhllabel\" CLASS=\"form\" value=\"DHL\">\n";
                }
              }
      } else if (!$objshipment->Tracking
            &&
            $objshipment->Paymentterm == PAYMENTERM_ID_REMBOURS)
        {
          echo " <b>Rembours! Make invoice first</b> ";
        }
    }
  echo "          <INPUT TYPE=\"hidden\" NAME=\"formadresid\" CLASS=\"form\" value=\"".$objshipment->AdresID."\">\n";
  echo "          <INPUT TYPE=\"hidden\" NAME=\"shipmentID\" CLASS=\"form\" value=\"".$int_shipmentID."\">\n";
  if (!$objshipment->Ship_date && !$int_products_retour)
  {
    echo "          <INPUT TYPE=\"submit\" NAME=\"printpackinglist\" CLASS=\"form\" value=\"Paklijst\">\n";
  }
  if (!$int_products_retour) echo "          <INPUT TYPE=\"button\" NAME=\"productlist\" onClick=\"location.replace('".$_SERVER['PHP_SELF']."');\" VALUE=\"Return to list\">\n";
  echo "     </td></TR>\n";
  echo "</table>";
  // legenda
  echo "<table border=0>\n
		<tr>\n";
  echo "<td bgcolor=".QOUTE_BGCOLOR.">Op Vooraad</td>\n";
  echo "<td bgcolor=".OPENWEBORDER_BGCOLOR.">Verkoopmelding!</td>\n";
  //echo "<td bgcolor=".PARTSHIP_BGCOLOR.">Deellevering</td>\n";
  //echo "<td bgcolor=".COMPLETE_BGCOLOR.">Compleet</td>\n";
  //echo "<td bgcolor=".OPENWEBORDER_BGCOLOR.">New Weborder</td>\n";
  echo "<td  bgcolor=" . RMAORDER_BGCOLOR . ">RMA order</td>\n";
  echo "<td>". makebutton("show_no_stock",
      "hide no stock",
      $formname) . "</td>\n";
  echo "</tr>\n
		</table>\n";

  if ($int_products_retour)
  {
    echo "Terug te leggen productID: <INPUT TYPE=\"text\" NAME=\"packed_article\" CLASS=\"form\"' TABINDEX=2>\n";
    echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "packed_article", SHIPMENT_FORM.".packed_article");
    // When the amount is not set, set it to default 1.
    $int_amount_packed_article = $int_amount_packed_article ? $int_amount_packed_article : 1;
    echo "           x <INPUT TYPE=\"text\" size=\"1\" NAME=\"amount_packed_article\" value='".$int_amount_packed_article."' CLASS=\"form\">\n";
    echo "          <INPUT TYPE=\"submit\" NAME=\"add\" CLASS=\"form\" value=\"Terug\">\n";
  }  else
  {
  // get product from tabel current_product_list
    $orderdetail_query = mysql_query($orderdetail_sql)
        or die("Ongeldige orderdetail table query: " .$orderdetail_sql. mysql_error());
    //echo $orderdetail_sql;

    $orderdetail_RMA_query = mysql_query($orderdetail_RMA_sql)
        or die("Ongeldige orderdetail RMA query: " .$orderdetail_sql. mysql_error());
    //echo $orderdetail_RMA_sql;

    echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n";
    echo '  <TD VALIGN="top" width="50%">'."\n";
    echo '      <table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
        .'          <tr>'
        .'              <th colspan="9">Orderlines for this ship adress</th>'
        .'          </tr>';

    $rma_count=0;
    $bl_rma_credit = FALSE;
    $bl_rma_retour = FALSE;
    while ($obj_RMA_query = mysql_fetch_object($orderdetail_RMA_query))
    {
      $rmaID = Getfield('SELECT RMAID from RMA_actions WHERE ActionID = '.$obj_RMA_query->rma_actionID);
      if (!$rma_count)
      {
        echo '       <tr>'
            .'              <th colspan="9">RMA to send to this ship adress</th>'
            .'          </tr>'
            .'          <tr>'
            .'              <th><SMALL> </SMALL></th>'
            .'              <th><SMALL> </SMALL></th>'
            .'              <th>Scannen</th>'
            .'              <th>Product</th>'
            .'              <th>Productnaam</th>'
            .'              <th>#</th>'
            .'          </tr>';
      }
      if ($obj_RMA_query->ContactsOrderID == RMA_CREDIT_TEXT)
      {
        $rma_bgcolor = RMACREDITORDER_BGCOLOR;
        $rma_text = 'Credit';
        $bl_rma_credit = TRUE;
      } else
      {
        $rma_bgcolor = RMAORDER_BGCOLOR;
        $rma_text = 'Retour';
        $bl_rma_retour = TRUE;
      }
      echo "          <tr bgcolor=$rma_bgcolor>\n"
          ."              <td align='right'><SMALL>$rma_text</SMALL></td>"
          .'              <td align="right"><SMALL> <SMALL></td>'
          .'              <td><A HREF="rma.php?rmaid='.$rmaID.'">'.$rmaID.'</A></td>'
          .'              <td><A HREF="'.PRODUCT_MAINT.'?productid='.$obj_RMA_query->ProductID.'">'.$obj_RMA_query->ProductID.'</a></td>'
          .'              <td>'.$obj_RMA_query->ProductName.'</td>'
          .'              <td align="right"><b>'.$obj_RMA_query->to_deliver.'</b></td>'
          ."\n".'      </tr>';
      $rma_count+=1;
    }
    if ($bl_rma_retour) echo "<tr bgcolor=".RMAORDER_BGCOLOR."><td colspan=6>Deze pakken/scannen en in de doos doen.</td></tr>\n";
    if ($bl_rma_credit) echo "<tr bgcolor=".RMACREDITORDER_BGCOLOR."><td colspan=6>Deze mogen zo worden toegevoegd.</td></tr>\n";

    // Left detail box with the product for the shipment.
    echo '          <tr>'
        .'              <th><SMALL>ordered</SMALL></th>'
        .'              <th><SMALL>stock</SMALL></th>'
        .'              <th><SMALL>order</SMALL></th>'
        .'              <th><SMALL>ID</SMALL></th>'
        .'              <th><SMALL>name</SMALL></th>'
        .'              <th>#</th>'
        .'          </tr>';

    while ($objorderdetail = mysql_fetch_object($orderdetail_query))
    {
      $stock_bgcolor = $objorderdetail->stock > 0 || $objorderdetail->sku == DB_SKU_ADMINISTRATION ? BGCOLOR_GREEN : '';
      $message_text = '';
      if (strlen($objorderdetail->Comments)>2)
      {
        $stock_bgcolor = OPENWEBORDER_BGCOLOR;
        $message_text = $objorderdetail->Comments . " : ";
      }
      if ($objorderdetail->in_one_delivery_yn)
      {
        $stock_bgcolor = shiptogether($objorderdetail->OrderID) ? BGCOLOR_GREEN : '';
      }

      echo "          <tr bgcolor='$stock_bgcolor'>\n"
          .'              <td align="right">'.$message_text.'<SMALL>'.$objorderdetail->Quantity.'</SMALL></td>'
          .'              <td align="right"><SMALL>'.$objorderdetail->stock.'<SMALL></td>'
          .'              <td><A HREF="order.php?orderID='.$objorderdetail->OrderID.'">'.$objorderdetail->OrderID.'</A></td>'
          .'              <td><A HREF="'.PRODUCT_MAINT.'?productid='.$objorderdetail->ProductID.'">'.$objorderdetail->ProductID.'</A></td>'
          .'              <td>'.$objorderdetail->ProductName.'</td>'
          .'              <td align="right"><b>'.$objorderdetail->to_deliver.'</b></td>'
          ."\n".'      </tr>';
    }

    echo '      </TABLE>'."\n";
    echo '  </TD>'."\n";
    echo '  <TD VALIGN="top" width="50%">'."\n";

    // If box change is set set the new box id's.
    if ($bl_change_box && !$objshipment->Tracking)
    {
      getshipmentdetails(&$shipquery, $int_shipmentID);
      while ($objinventory = mysql_fetch_object($shipquery))
      {
        if (isset($_POST["box_no$objinventory->TransactionID"])
            && $_POST["box_no$objinventory->TransactionID"]
            && $_POST["box_no$objinventory->TransactionID"] != $objinventory->box_number)
        {
          $int_box_id = GetBoxID($int_shipmentID, $_POST["box_no$objinventory->TransactionID"], TRUE);
          // if a new box is added increase max_box counter
          if ($int_max_box < $_POST["box_no$objinventory->TransactionID"])
          {
            $int_max_box = $_POST["box_no$objinventory->TransactionID"];
          }
          mysql_query("UPDATE inventory_transactions
                             SET box_ID = '$int_box_id'
                             WHERE TransactionID = '$objinventory->TransactionID'");
        }
      }
      // Remove empty boxes if there are some.
      $qry_remove_empty_box = mysql_query("SELECT DISTINCT box.box_ID, box_number, inventory_transactions.box_ID AS invbox
                                FROM box 
                                LEFT JOIN inventory_transactions ON box.box_ID = inventory_transactions.box_ID
                                WHERE box.Shipment_ID = $int_shipmentID");
      while ($objemptybox = mysql_fetch_object($qry_remove_empty_box))
      {
        if (!$objemptybox->invbox)
        {
          mysql_query("DELETE FROM box WHERE box_ID = $objemptybox->box_ID");
        }
      }
      mysql_free_result($qry_remove_empty_box);
    }

    // get inventory transactions for this shipment
    getshipmentdetails(&$shipquery, $int_shipmentID);

    // showing a right detail box with the inserted products into the shipment.
    echo '<table  border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
        .'  <tr>'
        .'      <th colspan="5">Articles In this Shipment</th>'
        .'  </tr>'
        .'  <tr>'
        .'      <th><small>order</small></th>'
        .'      <th><small>#</small></th>'
        .'      <th><small>ID</small></th>'
        .'      <th><small>name</small></th>'
        .'      <th><small>box</small></th>'
        .'</tr>';

    $int_sum_of_products = 0;
    $flt_weight_of_shipment = 0;
    while ($objinventory = mysql_fetch_object($shipquery))
    {
    //see if it's an RMA orderline that was shipped.
      $rma_id = $objinventory->Description ? getfield("SELECT RMAID FROM RMA_actions WHERE ActionID = '$objinventory->Description'") : FALSE;
      echo "<tr";
      if ($objinventory->UnitsShrinkage)
      {
        echo " class='softpart'";
      }
      echo ">\n
				<TD><A HREF='order.php?orderID=$objinventory->OrderID'>$objinventory->OrderID</A></TD>\n
				<td align=right><b>".($objinventory->UnitsSold+$objinventory->UnitsShrinkage)."</b></td>\n";
      if ($rma_id)
      { //change productID for rma shipped things
        if (RMA_CREDIT_TEXT == getfield("SELECT ContactsOrderID
                                         FROM orders
                                         WHERE OrderID = $objinventory->OrderID"))
        {
          $rma_bgcolor = RMACREDITORDER_BGCOLOR;
        } else
        {
          $rma_bgcolor = RMAORDER_BGCOLOR;
        }
        echo "		<td align=right bgcolor=$rma_bgcolor><a href='rma.php?rmaid=$rma_id' target='_new'>RMA $rma_id</a></td>\n";
      } else
      {
        echo "		<td align=right><A HREF='product_maint.php?productid=$objinventory->ProductID'>$objinventory->ProductID</td>\n";
      }
      echo "		<td>$objinventory->Productname";
      if ($objinventory->store_serial_yn)
      {
        echo " <a href='includes/store_serial_number.php?transid=$objinventory->TransactionID&close=0' target='_new'>(SN)</a>";
      }
      echo "\n</td><td align=right>";
      if ($bl_change_box && !$objshipment->Tracking)
      {
        echo ChoseNumberBox("box_no$objinventory->TransactionID", $int_max_box, $objinventory->box_number, TRUE);
      } else
      {
        echo $objinventory->box_number;
      }
      echo "</td>\n</tr>\n";

      // Set max box to the highest box number.
      $int_max_box = $objinventory->box_number > $int_max_box ? $objinventory->box_number : $int_max_box;

      $int_sum_of_products += $objinventory->UnitsSold;
      $flt_weight_of_shipment += $objinventory->weight_corr * $objinventory->UnitsSold;
    }
    $int_temp_product_bundel = GetField("SELECT order_details.ProductID
                                         FROM temp_inv_transactions
                                         INNER JOIN order_details ON order_details.OrderDetailsID = temp_inv_transactions.orderdetailsID
                                         WHERE shipmentID=$int_shipmentID");
    if ($int_temp_product_bundel )
    {
      echo "<TR><td COLSPAN=\"5\" bgcolor=red>Er staan <a href='includes/scan_soft_bundels.php?shipid=$int_shipmentID&productid=$int_temp_product_bundel'>producten</a> bij soft bundels!</td></tr>\n";
    }
    if ($int_sum_of_products)
    {
      echo "<TR><td COLSPAN=\"3\">Sum of products is $int_sum_of_products.</td>\n";
      echo "<td align=right>$flt_weight_of_shipment kg, Boxchange</td>";
      echo '<TD ALIGN="right">';
      echo "<input type=hidden name=max_box value=$int_max_box>";
      if (!$objshipment->Tracking) echo MakeCheckBox('change_box', $bl_change_box);
      echo "</TD></TR>";
    }
    echo "      </table>";
    echo "     </TD>\n";
  } // Products retour
} elseif (!$bl_newshipment&&!$bl_printpackinglist)
{
  $shipment_sql=SQL_SHIPMENTS ;
  if ($str_date)
  {
    $shipment_sql .= " WHERE ((Ship_date > '$str_date 00:00:00' AND Ship_date < '$str_date 23:59:59') OR ISNULL(Ship_date))";
  }
  $shipment_sql.=" AND Cancel = 0 ORDER BY Start_date = '', InvoiceID, Ship_date, CompanyName Asc, Start_date;";
  //echo $shipment_sql;
  $shipment_query = mysql_query($shipment_sql)
      or die("Ongeldige query shipment: " .$shipment_sql. "<br>" . mysql_error());
  $numberofrecords = mysql_Numrows($shipment_query);
  //first delete the  records marked delete
  if ($bl_delete_shipment)
  {
    while ($objshipment = mysql_fetch_object($shipment_query))
    {
      if ($_POST["delete_$objshipment->Shipment_ID"]=='on' && shipment_empty($objshipment->Shipment_ID))
      {
        $del_shipment_sql='UPDATE shipments SET
                    cancel = 1
                    WHERE shipment_ID = "'.$objshipment->Shipment_ID.'" AND isnull(InvoiceID)';
        $query_del_shipment = mysql_query($del_shipment_sql);
      }
    }
    mysql_free_result($shipment_query);

    // Get new result without the removed records.
    $shipment_query = mysql_query($shipment_sql)
        or die("Ongeldige query shipment: " .$shipment_sql. "<br>" . mysql_error());
  }
  echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
  printIwexNav();
  echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
      .'<tr>'
      .'<td colspan="7" align="right">'
      .' Scan shipmentID: <INPUT TYPE="text" NAME="shipmentID" CLASS="form">'
      .'<INPUT TYPE="submit" NAME="submit" CLASS="form" value="submit">'."\n"
      .'Shipdate (Y-m-d)<INPUT TYPE="text" NAME="date" SIZE="20" CLASS="form" value='.$str_date.'>'."\n"
      .Add_Calendar(SHIPMENT_FORM.'.date')
      .'<INPUT TYPE="submit" NAME="newshipment" CLASS="form" value="new">'."\n"
      .'<INPUT TYPE="submit" NAME="delete_shipment" CLASS="form" value="delete"'."\n";
  echo "</TD>\n</TR>\n";
  echo "<TR>\n<TD COLSPAN='7'>\n";
  //legend
  echo "<table border=0>\n
		<tr>\n";
  echo "<td bgcolor=".ALLOW_EXEPTION_COLOR.">Eenmalige Toestemming</td>\n";
  echo "<td bgcolor=".NOT_PAID_OVERDUE_BGCOLOR.">Betalings achterstand</td>\n";
  //echo "<td bgcolor=".PARTSHIP_BGCOLOR.">Deellevering</td>\n";
  echo "<td bgcolor=".OPENWEBORDER_BGCOLOR.">Vooruit betalen</td>\n";
  echo "<td bgcolor=".ORDERPAYED_BGCOLOR.">Betaald</td>\n";
  //echo "<td bgcolor=".OPENWEBORDER_BGCOLOR.">New Weborder</td>\n";
  echo "<td>>Niets aan de hand<</td>\n";
  echo "</tr>\n
		</table>\n";
  echo  "</td>\n</tr>\n"
      .'<tr>'."\n"
      .'<th>Shipment ID</th>'."\n"
      .'<th>ShipNaam</th>'."\n"
      .'<th>Klant</th>'."\n"
      .'<th>Start (print) Date</th>'."\n"
      .'<th>Ship Date</th>'."\n"
      .'<th>Invoiced</th>'."\n"
      .'<th>Tracking #</th>'."\n"
      .'<th><SMALL>DEL</SMALL></th>'."\n"
      .'</tr>'."\n";

  // Set cursor in the scan field.
  echo '<script TYPE="text/javascript" language="JavaScript">document.'.SHIPMENT_FORM.'.shipmentID.focus();</script>';
  $ary_adres_id = array();
  $str_lookout = "";
  while ($objshipment = mysql_fetch_object($shipment_query))
  {

    $bl_exist = FALSE;
    foreach ($ary_adres_id As $int_key => $int_adres_id)
    {
      if ($int_adres_id == $objshipment->AdresID && !$ary_shipdate[$int_key])
      {
        $str_lookout .=  "Shipadress from: " . $objshipment->Naam . " is already existing into the list! " .
            $objshipment->Shipment_ID . " = " . $ary_shipment_id[$int_key] . "<BR>";
        $bl_exist = TRUE;
      }
    }
    if (!$bl_exist)
    {
      $ary_adres_id[] = $objshipment->AdresID;
      $ary_shipment_id[] = $objshipment->Shipment_ID;
      $ary_shipdate[] = $objshipment->Ship_date;
    }
    $credit_bgcolor = CurrentCreditAmount($objshipment->ContactID) > 0 ? FALSE : NOT_PAID_OVERDUE_BGCOLOR;

    $flt_credit_limit = GetCreditLimit($objshipment->ContactID);
    $ftl_open_amount = CurrentCreditAmount($objshipment->ContactID) > 0;
    $flt_overdue_amount = Overdue($objshipment->ContactID, TRUE);
    $insufficient_funds = ($ftl_open_amount <= 0) || ($flt_overdue_amount > 0);
    $credit_bgcolor = $insufficient_funds ? NOT_PAID_OVERDUE_BGCOLOR : FALSE;

    if ($objshipment->Paymentterm == PAYMENTERM_ID_UPFRONT)
    {
    //$bl_allpaid = Orderpaidcheck($objshipment->ContactID, $objshipment->AdresID, &$int_all_order_total);  seems like 2nd argument should be shipmentID
      $bl_allpaid = Orderpaidcheck($objshipment->ContactID, $objshipment->Shipment_ID, &$int_all_order_total);
      $credit_bgcolor = $bl_allpaid ? ORDERPAYED_BGCOLOR : OPENWEBORDER_BGCOLOR;
    }

    if (Grant_shipment($objshipment->ContactID,FALSE)) $credit_bgcolor = ALLOW_EXEPTION_COLOR;

    if ($credit_bgcolor)
    {
      echo "<tr bgcolor=$credit_bgcolor>\n";
    } else
    {
      echo '<tr>'."\n";
    }
    echo '<td><a href=shipment.php?shipmentID='.$objshipment->Shipment_ID.'>'.$objshipment->Shipment_ID.'</a></td>'
        .'<td><b>'.$objshipment->Naam.'</b></td>'
        .'<td>'.$objshipment->CompanyName.'</td>'
        .'<td>'.$objshipment->Start_date.'</td>'
        .'<td>'.$objshipment->Ship_date.'</td>'
        .'<td>'.$objshipment->InvoiceID.'</td>'
        .'<td>'.createtrackinglink($objshipment->Tracking, $objshipment->postcode).'</td>'
        .'<td>';
    if (shipment_empty($objshipment->Shipment_ID))
    {
      echo '<INPUT TYPE="checkbox" NAME="delete_'.$objshipment->Shipment_ID.'" onClick="return confirm(\'Weet je zeker dat je dit record wilt verwijderen?\')">';
    }
    echo '</td>'
        ."\n".'</tr>';
  }
  mysql_free_result($shipment_query);

  if ($str_lookout)
  {
    Show_popup("printmessage.php?message=$str_lookout", "Merge",100, 800, "menubar=no, status=no,titlebar=no, toolbar=no");
  }

  echo ScreenRenewInterval(SHIPMENT_FORM, 120);
}
if ($bl_newshipment&&!$bl_printpackinglist)
{
  echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
  printIwexNav();
  echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
  echo "    <TR>\n";
  echo "      <TH colspan='4'><B>Select shipment adres for new shipment</B></TH>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "      <TD>Customer: </TD><TD><INPUT TYPE=\"text\" NAME=\"search_cust\" CLASS=\"form\" VALUE='".$_POST['search_cust']."'></TD>\n";
  echo "      <TD>Use Stock: </TD><TD>".MakeCheckBox("use_stock", $bl_use_stock || !$bl_filter)."</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "      <TD>Product : </TD><TD><INPUT TYPE=\"text\" NAME=\"search_prod\" CLASS=\"form\" VALUE='".$_POST['search_prod']."'></TD>\n";
  //    echo "      <TD>---: </TD><TD><INPUT TYPE=\"text\" NAME=\"search_cust\" CLASS=\"form\" VALUE='".$_POST['search_cust']."'></TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "      <TD colspan='4' ALIGN=\"right\">\n";
  echo "      <INPUT TYPE=\"submit\" NAME=\"filter\" CLASS=\"form\" value=\"filter\">\n";
  echo "      <INPUT TYPE=\"hidden\" NAME=\"shipmentID\" CLASS=\"form\" value=\"".$int_shipmentID."\">\n";
  echo "      <input type=\"hidden\" NAME=\"newshipment\" CLASS=\"form\" value=\"true\">\n";
  echo "      <INPUT TYPE=\"button\" NAME=\"productlist\" onClick=\"location.replace('".$_SERVER['PHP_SELF']."');\" VALUE=\"Return to list\">\n";
  echo "     </TR>\n";
  echo "</table>";
  // get the filtered adresses
  $to_deliver_orders_sql = SQL_openorderdetails . "
        WHERE to_deliver <> 0 AND " . openordedetails_condition . "
        AND (order_details.ProductID like '%" .$_POST['search_prod']. "%' OR order_details.ProductName like '%" .$_POST['search_prod']. "%' OR
         order_details.Productdescription like '%" .$_POST['search_prod']. "%' OR Merk like '%" .$_POST['search_prod']. "%'
         OR ExternalID like '%" .$_POST['search_prod']. "%')
        AND (contacts.ContactID like '%" .$_POST['search_cust']. "%' OR contacts.CompanyName like '%" .$_POST['search_cust']. "%'
        OR orders.ShipID like '%" .$_POST['search_cust']. "%' OR Adressen.Naam like '%" .$_POST['search_cust']. "%')";
  //     echo $to_deliver_orders_sql;
  if ($bl_use_stock
      ||
      !$bl_filter)
  {
    $to_deliver_orders_sql .= "AND stock > 0 ";
  }
  $to_deliver_orders_sql .= "GROUP BY orders.ContactID, orders.ShipID
        ORDER BY OrderDate, contacts.CompanyName ";
  //    echo $to_deliver_orders_sql;
  $deliver_query = mysql_query($to_deliver_orders_sql)
      or die("Ongeldige to_deliver_orders_sql query: " .$to_deliver_orders_sql. mysql_error());

  echo '<table  border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
      .'  <tr>'
      .'      <th colspan="6">filtered customers for filtered article</th>'
      .'  </tr>'
      .'  <tr>'
      .'      <th>Order ID</th>'
      .'      <th>Date</th>'
      .'      <th>Adres ID</th>'
      .'      <th>Shipname</th>'
      .'      <th>Customer ID</th>'
      .'      <th>Customer Name</th>'
      .'</tr>';

  while ($objdeliver_query = mysql_fetch_object($deliver_query))
  {
    if (!check_open_shipment($objdeliver_query->AdresID))
    {
      echo '<tr>'."\n"
          ."<td>$objdeliver_query->OrderID</td>"
          ."<td>".date("Y-m-d",strtotime($objdeliver_query->OrderDate))."</td>"
          .'<td><A HREF="to_deliver.php?adres='.$objdeliver_query->ShipID.'">'.$objdeliver_query->ShipID.'</A></td>'
          .'<td>'.$objdeliver_query->Shipname.'</td>'
          .'<td>'.$objdeliver_query->ContactID.'</td>'
          .'<td>'.$objdeliver_query->CompanyName.'</td>'
          ."\n".'</tr>';
    }
  }
  echo "      </table>";
  echo "     </TD>\n";

}

if ($int_shipmentID&&$bl_printpackinglist)
{
// Create a query to make the packinglist.
  $sql_packing_shipment = "SELECT Shipment_ID, Ship_date, Tracking, AdressID,
        adrestitel, Naam as shipname, attn, straat, huisnummer, postcode, plaats, land,
        CompanyName, Address, City, Region, PostalCode, Country, Paymentterm 
        FROM shipments
        INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
        INNER JOIN contacts ON contacts.ContactID = Adressen.ContactID
        WHERE Shipment_ID = ".$int_shipmentID." AND AdressID = ".$int_addressID;
  //." AND stock > 0 ";

  //    echo $sql_packing_shipment;
  $packlist_query = mysql_query($sql_packing_shipment)
      or die("Ongeldige select orders query: " .$sql_packing_shipment. mysql_error());
  $obj = mysql_fetch_object($packlist_query);

  echo '<table width="100%" border="0">';
  echo "<tr><td><big><big><b>Inpaklijst</b></big></big></td><td colspan=\"2\" align=\"center\">";
  /*  if ($obj->paymentterm_yn == 4) {
    echo "<big><b>Wachten met factuur op vooruit betaling!</b></big>";
    } */
  echo "</td></tr>";
  echo "<tr><td><img src='" . IMAGES_URL . LOGOSMALL . "' width=75 alt='" . COMPANYNAME . "logo' border=0></td>";
  echo "<td align=\"center\">Shipment <br><img src=\"includes/barcode.php?barcode=sh$obj->Shipment_ID&height=50&&width=250text=1\" alt=\"sh$obj->Shipment_ID\"></td>\n";
  echo "<td align=\"center\">Aflever adres<br><img src=\"includes/barcode.php?barcode=$obj->AdressID&height=50&text=1\" alt=\"ad$obj->AdressID\"></td>\n";
  echo "</tr></table>\n";
  echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
  echo "    <TR>\n";
  echo "         <TH colspan='4'><B>Shipment ID $obj->Shipment_ID</B></TH>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD>Company name</TD><TD>$obj->CompanyName</TD>\n";
  echo "         <TD>Ship Name</TD><TD>$obj->shipname</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD>Adres</TD><TD>$obj->Address</TD>\n";
  echo "         <TD>Adres</TD><TD>$obj->straat $obj->huisnummer</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD></TD><TD>$obj->PostalCode $obj->City</TD>\n";
  echo "         <TD></TD><TD>$obj->postcode $obj->plaats</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD></TD><TD>$obj->Country</TD>\n";
  echo "         <TD></TD><TD>$obj->land</TD>\n";
  echo "    </TR>\n";
  echo "         <TD>----</TD><td>----</TD>\n";
  echo "    	 <td>Ship date</td><TD>$obj->Ship_date</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "		 <td>Betalingstermijn</td><td>".makelistbox('SELECT PaymentTermID, Description FROM paymentterm','Payment_Term','PaymentTermID','Description',$obj->Paymentterm)."</td>";
  echo "    </TR>\n";
  echo "</TABLE>\n";
  echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
  echo "<tr><th>Locatie</th><th>Product ID</th><th>Extern ID</th><th>order date</th><th>Product</th>";
  echo "<th>Stock</th><th>Aantal</th><th>Gepakt</th></tr>\n";

  // Create a query to select the orderdetails.
  $sql_packing_details = SQL_openorderdetails . "
        WHERE to_deliver <> 0 AND 
			".openordedetails_condition." 
			AND ShipID = ".$int_addressID." 
			AND (rma_yn <> 1 or isnull(rma_yn))
			AND stock > 0
        ORDER BY stock <= 0, walk_order, location.ID, order_details.ProductID;";
  $packlist_det_query = mysql_query($sql_packing_details)
      or die("Ongeldige select orders query: " .$sql_packing_details. mysql_error());

  while ($objpackingdet = mysql_fetch_array($packlist_det_query, MYSQL_BOTH))
  {

    if (!$objpackingdet["in_one_delivery_yn"] ||
        $objpackingdet["in_one_delivery_yn"] && shiptogether($objpackingdet["OrderID"]))
    {
      if ($objpackingdet["sku"] == DB_SKU_MULTI_ARTICLE
          ||
          $objpackingdet["sku"] == DB_SKU_PHYSICAL_ARTICLE)
      {
        echo "<tr><td align=\"center\" class=\"cellline\">".$objpackingdet["location"]."</td>\n"; // ->current_product_list.location
        echo "<td align=\"center\" class=\"cellline\">".$objpackingdet["ProductID"]."</td>\n"; // ->current_product_list.productID
        echo "<td align=\"center\" class=\"cellline\"><small>".$objpackingdet["ExternalID"]."</small></td>\n";
        echo "<td align=\"center\" class=\"cellline\"><small>". date("d-M-Y",strtotime($objpackingdet["OrderDate"]))."</small></td>\n" ;// ->order_details.Productdescription
        echo "<td class=\"cellline\">".$objpackingdet["ProductName"]."</td>\n"; // ->current_product_list.Productname
        echo "<td align=\"center\" class=\"cellline\"><small>" . $objpackingdet["stock"] . "</small></td>\n";
        echo "<td align=\"center\" class=\"cellline\"><big><b>". $objpackingdet["to_deliver"]."</b></big></td>\n"; // order_details.Quantity
        echo "<td align=\"center\" class=\"cellline\"><input type=\"text\" size=\"5\" name=\"ingepakt\"></td></tr>\n"; // ->order_details.extended_price
      } else if ($objpackingdet["sku"] == DB_SKU_SOFTBUNDEL)
        { // Soft bundel
          $int_muti_todeliver = $objpackingdet["to_deliver"];
          echo "<tr><td colspan=2 align=\"center\" class=\"cellline\">"
              ."<img src=\"includes/barcode.php?barcode=".
              $objpackingdet["ProductID"]."&height=25\" alt='".$objpackingdet["ProductID"]."'></td>\n";
          //            echo "<td align=\"center\" class=\"cellline\">".$objpackingdet["ProductID"]."</td>\n"; // ->current_product_list.productID
          echo "<td align=\"center\" class=\"cellline\"></td>\n";
          echo "<td align=\"center\" class=\"cellline\"><small>". date("d-M-Y",strtotime($objpackingdet["OrderDate"]))."</small></td>\n" ;// ->order_details.Productdescription
          echo "<td class=\"cellline\">".$objpackingdet["ProductName"]."</td>\n"; // ->current_product_list.Productname
          echo "<td align=\"center\" class=\"cellline\">" . $objpackingdet["stock"] . "</td>\n";
          echo "<td align=\"center\" class=\"cellline\"><big><b>". $objpackingdet["to_deliver"]."</b></big></td>\n"; // order_details.Quantity
          echo "<td align=\"center\" class=\"cellline\"></td></tr>\n"; // ->order_details.extended_price
          $sql_multi = "SELECT aantal, Product_ids, ProductName, location, ExternalID, stock
					FROM multi_articles2
					LEFT JOIN current_product_list ON multi_articles2.Product_ids = current_product_list.ProductID
					LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."'
					LEFT JOIN location ON location_ID = location.ID
					WHERE Multi_ID = '".$objpackingdet["ProductID"]."'
					ORDER BY walk_order, location.ID, Product_ids";
          $qry_multilist = mysql_query($sql_multi)
              or die("Ongeldige select multie products orders query: $sql_multi<br>". mysql_error());
          while ($objmultidet = mysql_fetch_array($qry_multilist, MYSQL_BOTH))
          {
            echo "<tr><td align=\"right\" class=\"cellline\"><u>".$objmultidet["location"]."</u></td>\n"; // ->current_product_list.location
            echo "<td align=\"center\" class=\"cellline\"><u>".$objmultidet["Product_ids"]."</u></td>\n"; // ->current_product_list.productID
            echo "<td align=\"center\" class=\"cellline\"><small>".$objmultidet["ExternalID"]."</small></td>\n";
            echo "<td align=\"right\" class=\"cellline\"><small>/\\ ".$objpackingdet["ProductID"]." /\\</small></td>\n" ;// ->order_details.Productdescription
            echo "<td class=\"cellline\">".$objmultidet["ProductName"]."</td>\n"; // ->current_product_list.Productname
            echo "<td align=\"center\" class=\"cellline\"><small>" . $objmultidet["stock"] . "</small></td>\n";
            echo "<td align=\"right\" class=\"cellline\"><big><u><b>". $int_muti_todeliver*$objmultidet["aantal"]."</b></u></big></td>\n"; // order_details.Quantity
            echo "<td align=\"center\" class=\"cellline\"><input type=\"text\" size=\"5\" name=\"ingepakt\"></td></tr>\n"; // ->order_details.extended_price
          }
          mysql_free_result($qry_multilist);
        }
    }
  }
  mysql_free_result($packlist_det_query);
  echo "</TABLE>\n";
  // RMA paicking items
  echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
  echo "<tr><th colspan='6' ALIGN='center'>RMA artikelen</th></tr>\n";
  echo "<tr><th>Locatie</th><th>RMA ID</th><th>RMA order datum</th><th>Product</th><th>Aantal</th><th>Gepakt</th></tr>\n";
  echo "<br>";
  // Create a query to select the orderdetails.
  $sql_packing_details = $RMA_openordersSQL . "
        WHERE to_deliver <> 0 AND ".openordedetails_condition." AND ShipID = ".$int_addressID." AND rma_yn = 1 
        ORDER BY walk_order, location.ID, order_details.ProductID;";
  $packlist_det_query = mysql_query($sql_packing_details)
      or die("Ongeldige select orders query: " .$sql_packing_details. mysql_error());

  while ($objpackingdet = mysql_fetch_array($packlist_det_query, MYSQL_BOTH))
  {
    $rma_id = getfield("SELECT RMAID FROM RMA_actions WHERE ActionID = '$objpackingdet[rma_actionID]'");
    echo "<tr><td align=\"center\" class=\"cellline\">RMA stelling</td>\n"; // ->current_product_list.location
    echo "<td align=\"center\" class=\"cellline\">".$rma_id."</td>\n"; // ->current_product_list.RMA ID
    echo "<td align=\"center\" class=\"cellline\"><small>". date("d-M-Y",strtotime($objpackingdet["OrderDate"]))."</small></td>\n" ;// ->order_details.Productdescription
    echo "<td class=\"cellline\">".$objpackingdet["ProductName"]."</td>\n"; // ->current_product_list.Productname
    echo "<td class=\"cellline\">".$objpackingdet["to_deliver"]."</td>\n"; // ->current_product_list.Productname
    echo "<td align=\"center\" class=\"cellline\"><input type=\"text\" size=\"5\" name=\"ingepakt\"></td></tr>\n"; // ->order_details.extended_price
  }
  mysql_free_result($packlist_det_query);
  echo "</TABLE>\n";

  // now display the boxes to fill in the one who packed.
  echo "<table align=\"right\"><tr><td>Ingepacked</td><td><input type=\"text\" size=\"5\" name=\"ingepakt2\"></td>";
  echo "<td>Checked</td><td><input type=\"text\" size=\"5\" name=\"Checked2\"></td></tr></table>";
}
echo "</TABLE>\n";

echo "</FORM>\n";
printenddoc();

?>
