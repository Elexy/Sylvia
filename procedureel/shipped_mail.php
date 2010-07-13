<?php

include ("include.php");

$datum = isset($_POST['datum']) ? $_POST['datum'] : FALSE;
$olddate = isset($_POST['olddate']) ? $_POST['olddate'] : FALSE;
$submit = isset($_POST['submit']);

// Print default Iwex HTML header.
printheader (COMPANYNAME . " verzend berichten");

echo "<BODY  ".get_bgcolor().">";

printIwexNav();

echo "Deze klanten krijgen een verzend bericht van vandaag:<BR><BR>";
echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n";

?>
<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
  <tr>
    <th>Shipment ID</th>
	<th>Invoice ID</th>
    <th>Contact ID</th>
    <th>ShipName</th>
    <th>Tracking nummer</th>
    <th>Verzenden</th>
  </tr>
<?php

// Check if a specific date is given. If not use current date.
if (!$datum) {
  $datum = date("Y-m-d");
}

// Create a query to select the shipped orders for today
$sql = "SELECT Shipment_ID, AdresID, InvoiceID, Ship_date, contacts.CompanyName, contacts.email,
        Adressen.Naam as ShipName, Tracking, Adressen.postcode, contacts.ContactID, email_send 
        FROM shipments
        INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
        INNER JOIN contacts ON Adressen.ContactID = contacts.ContactID
        WHERE shipments.Ship_date >= '$datum' and shipments.Ship_date <= '$datum 23:59:59'
		ORDER BY CompanyName";		
$query = $db_iwex->query($sql);

// Check if this query is ok to be e-mailed.
if ($submit) {
  $mailcnt = 0;
  while ($obj = mysql_fetch_object($query)) {
    //Select ordered products
    //getorderdetails(&$orderquery, $obj->OrderID);
    getshipmentdetails(&$shipquery, $obj->Shipment_ID);
    $mailtxt = $emailheader;
    $mailtxt .= "<body>\nBeste inkoop van ". $obj->CompanyName . ",<br><br>\n"
        . "Op ". date("d-m-Y", strtotime($datum)) . " is de volgende zending naar ";
    // Check if shipto adress is the same as customer.
    if (!strcmp($obj->CompanyName, $obj->ShipName)) {
        $mailtxt .= "u";
    } else {
        $mailtxt .= $obj->ShipName;
    }
    $mailtxt .= " verzonden:<br><br>\n"
        . "<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">\n"
        . "<tr><th>Aantal</th><th>Product ID</th><th>Product</th><th>Note</th><th>Box #</th></tr>";
    // TransactionID, TransactionDate, inventory_transactions.ProductID, Description, inventory_transactions.box_ID, box_number,
    //        OrderID, TransactionDescription, UnitPrice, sum(UnitsSold) as UnitsSold, btw_percentage, Productname
    // Write order details to e-mail message.
    while ($objshipdet = mysql_fetch_array($shipquery, MYSQL_BOTH)) {
      $mailtxt .= 
            "<tr><td align=right>" . ($objshipdet["UnitsSold"]+ $objshipdet["UnitsShrinkage"]) . "</td>" // inventory_transactions.unitssold
          . "<td align=right>" . $objshipdet["ProductID"] . "</td>" // ->current_product_list.productID
          . "<td>" . $objshipdet["Productname"] . "</td><td>"; // ->current_product_list.Productname
      if ($objshipdet["UnitsShrinkage"]) {
      	$mailtxt .=  $objshipdet["TransactionDescription"];
      } else if (is_numeric($objshipdet["Description"])) {
          $mailtxt .= "RMA $rmaID";
      } else if ($objshipdet["sku"] == DB_SKU_SOFTBUNDEL) {
        $mailtxt .= "Bundel";      
      } 
      $mailtxt .= "</td><td align=right>" . $objshipdet["box_number"] . "</td></tr>\n"; // ->inventory_transactions.box_number
    }
    $mailtxt = $mailtxt . "</table>\n<br>Tracking = ";
    $mailtxt .= createtrackinglink($obj->Tracking, $obj->postcode);
    $mailtxt .= $emailsignature . "<br>Afdeling logistiek\n</body></html>";
    //call function that returns a string containing complete backorder list
    $mailtxt .= printbackorderlist($obj->ContactID,
                                   FALSE,
                                   $obj->AdresID);
    $name = $GLOBALS["ary_config"]["emailname.logistical"];
    $myemail = $GLOBALS["ary_config"]["email.logistical"]; 
//    echo $mailtxt;
    if (isset($_POST['check'.$obj->Shipment_ID]) 
			   &&
			   $_POST['check'.$obj->Shipment_ID] == 'on')
    {
         $str_cc_email = $GLOBALS["ary_config"]["email.logistical"] . ($obj->adres_email ? ", $obj->adres_email" : "");
		 $str_email = GetLogisticsEmail($obj->ContactID);
         if (mail($str_email, 
		 		  SHIP_CONFIRMATION_NL." voor " . $obj->ShipName, 
		 		  $mailtxt,
		 		  "From: $name <$myemail>\nCc:$str_cc_email\nContent-type: text/html")) {
           $sendok = "Ok to $str_email";
           mysql_query("UPDATE shipments SET email_send = 1 WHERE Shipment_ID =$obj->Shipment_ID");
         } else {
           $sendok = "<b>Mislukt</b>";
         }
    } else {
        $sendok = "Niet verzonden";
    }
    echo "<tr>\n<td>$obj->Shipment_ID</td><td>$obj->InvoiceID</td><td>$obj->CompanyName</td><td>$obj->ShipName</td><td>" . createtrackinglink($obj->Tracking, $obj->postcode) . "</td><td>$sendok</td>\n</tr>";
    mysql_free_result($shipquery);
  }
} else {
     if ($olddate==$datum) {
          while ($obj = mysql_fetch_object($query)) {
		  	   // Check if the variable exist and is changed.
			   if (isset($_POST["tracking".$obj->Shipment_ID])
			   	   &&
				   $_POST["tracking".$obj->Shipment_ID] != $_POST["lasttracking".$obj->Shipment_ID]) {
	               $qry = 'update shipments set Tracking="'.$_POST["tracking".$obj->Shipment_ID].'" where Shipment_ID='.$_POST["veld".$obj->Shipment_ID];
	               $queryres = mysql_query($qry)
	                  or die("update van trackingnummer niet gelukt: " . $qry . $obj->Shipment_ID . ' : ' . mysql_error());
		  	   }
          }
          mysql_free_result($query);
          $query = mysql_query($sql)
               or die("Ongeldige query: " . mysql_error());
     }
     while ($obj = mysql_fetch_object($query)) {
	 	  // If the record is not invoiced show light red.
		  if ($obj->InvoiceID) { $bgcolor="#DDFFE1"; } else { $bgcolor="#FFABA9"; };
          echo '<tr bgcolor="'. $bgcolor .'">';
		  echo '<td>'.$obj->Shipment_ID.'<input name="veld'.$obj->Shipment_ID.'" type="hidden" value="'.$obj->Shipment_ID.'"></td><td>' . $obj->InvoiceID . '</td><td>'.$obj->CompanyName.'</td><td>'.$obj->ShipName.'</td>';
          echo '<td><input size="25" name="tracking'. $obj->Shipment_ID.'" type="text" value="'.$obj->Tracking.'"><input type="hidden" name="lasttracking'. $obj->Shipment_ID.'" value="'.$obj->Tracking.'">';
		  if ($obj->Tracking) {
		      echo createtrackinglinktxt($obj->Tracking, $obj->postcode, 'find');
		  }
		  echo '</TD>';
          echo '<td><input type="checkbox" name="check' . $obj->Shipment_ID . '" ';
          if (($olddate<>$datum
              ||
              GetCheckBox('check'.$obj->Shipment_ID))
              &&
              !$obj->email_send)
          {
             echo 'CHECKED';
          }
          echo '></TD></tr>';
          echo "\n";
    }
  }
    
mysql_free_result($query);

?>
</table>
<?php
        



echo "<TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\">\n";
echo "<TR>\n";
echo "<TD>Dag van de verzending (Y-m-d)<INPUT TYPE=\"text\" NAME=\"datum\" SIZE=\"20\" CLASS=\"form\" value=". $datum . "></TD>\n";
echo "<TD></TD>\n";
echo "</TR>\n";
echo "<TR>\n";
echo "<TD COLSPAN=\"2\"><INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\">";
if ($GLOBALS["ary_config"]["dhl_enabled"]) {
	echo ' <INPUT TYPE="button" VALUE="Print DHL lijst" onclick="';
	echo "window.open('includes/ship_rapport.php?date=$datum&shipper=DHL','DHLrapport','toolbar=0,menubar=0,resizable=0,dependent=0,status=0,width=700,height=500,left=25,top=25')";
	echo "\">";
}
echo "</TD>\n";
echo "<TD COLSPAN=\"2\"><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Verzend\" CLASS=\"button\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"olddate\" SIZE=\"20\" CLASS=\"form\" value=";
// When submitted update should not update the database.
if (!$submit) { 
    echo $datum;
}
echo "></TD>\n</TR>\n";
echo "</TABLE>\n";
echo "</FORM>\n";

printenddoc();
?>
