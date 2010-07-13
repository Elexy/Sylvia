<?php

include ("include.php");
    
$year = isset($_REQUEST['year']) ? $_REQUEST['year'] : FALSE;
$month = isset($_REQUEST['month']) ? $_REQUEST['month'] : FALSE;
$submit = isset($_REQUEST['submit']);

// Check if a specific date is given. If not use current date.
if (!$year || !$month) {
  $year = date("Y");
  $month = date("m");
}
if (!$submit) { 
	// Print default Iwex HTML header.
	printheader (COMPANYNAME . " CBS aangifte");
	?>
	<BODY>
	<?php
	printIwexNav();

	echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n";
	echo "<p>Geef het jaar en de maand op waar over verslag moet worden gegeven.</p>";
	echo "<TABLE BORDER=\"1\" CELLPADDING=\"5\" CELLSPACING=\"0\">\n";
	echo "<TR>\n";
	echo "<TH>Jaar</TH>\n";
	echo "<TH>Maand</TH>\n";
	echo "</TR>\n";
	echo "<TR>\n";
	echo "<TD><INPUT TYPE=\"text\" NAME=\"year\" SIZE=\"4\" CLASS=\"form\" value=" . $year .  "></TD>\n";
	echo "<TD><INPUT TYPE=\"text\" NAME=\"month\" SIZE=\"4\" CLASS=\"form\" value=". $month . "></TD>\n";
	echo "</TR>\n";
	echo "<TR>\n";
	echo "<TD><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Genereer\" CLASS=\"button\"></TD>\n";
	echo "<TD><INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\"></TD>\n";
	echo "</TR>\n";
	echo "</TABLE>\n";
	echo "</FORM>\n";
} else {
  
  header('Content-Type: txt');
   header("Content-Disposition: attachment; filename=cbsdata".date("Ym", mktime (0,0,0, $month, 1, $year )).".txt");
  // Print Voorlooprecord.
  if (date("G") >= 10) {
     $currenttime = date("YmdGis");
  } else {
     $currenttime = date("Ymd0Gis");
  }
  printf("9801%12s%6s%-40s%6sver02%s%15s%13s\n", 
		  IWEX_VAT_NUMBER,
		  date("Ym", mktime (0,0,0, $month, 1, $year )),
		  COMPANYNAME,
		  ' ',
		  $currenttime,
		  TELEPHONE,
		  " ");

  // Print data records

  // Create a query to select the fields for the CBS import rows.
  $sql = 'SELECT `inventory_transactions`.`TransactionDate` , `inventory_transactions`.`PurchaseOrderID` ,'
        . ' `current_product_list`.`ProductName` , `inventory_transactions`.`Description` , `valuta`.`ValutaName` ,'
        . ' `inventory_transactions`.`UnitPrice` , `inventory_transactions`.`UnitsReceived` , '
        . '`inventory_transactions`.`UnitPrice` * `inventory_transactions`.`UnitsReceived` AS \'totaal\', '
        . '`current_product_list`.`weight_corr` * `inventory_transactions`.`UnitsReceived` AS \'weight\', '
        . '`inventory_transactions`.`PurchaseOrderID` , `contacts`.`CompanyName` , `contacts`.`btw_number` , '
        . '`contacts`.`Country` , `current_product_list`.`euproductcode` , `current_product_list`.`Taric` '
        . ' FROM ( valuta'
        . ' INNER JOIN ( ( `purchase_orders` '
        . ' LEFT JOIN contacts ON `purchase_orders`.`SupplierID` = `contacts`.`ContactID` )'
        . ' INNER JOIN `inventory_transactions` ON `purchase_orders`.`PurchaseOrderID` = `inventory_transactions`.`PurchaseOrderID` ) ON `valuta`.`ValutaID` = `purchase_orders`.`Order_currency` )'
        . ' INNER JOIN current_product_list ON `inventory_transactions`.`ProductID` = `current_product_list`.`ProductID` '
        . ' WHERE `inventory_transactions`.`TransactionDate` >= "' . date("Y-m-d", mktime (0,0,0, $month, 1, $year ))
        . ' " AND `inventory_transactions`.`TransactionDate` < "'. date("Y-m-d", mktime (0,0,0, $month + 1, 1, $year ))
        . ' " AND `inventory_transactions`.`ProductID` != \'991664\' '
		. '   AND `inventory_transactions`.`ProductID` != \'992533\' AND `contacts`.`Country` <> '
        . '  "NL" AND `inventory_transactions`.`UnitsReceived` != "0"';
  $query = $db_iwex->query($sql)
     or die("Ongeldige query: " . mysql_error());
  $rownum = 1;
  while ($obj = mysql_fetch_object($query)) {
    $totaalsign = $obj->totaal >= 0 ? "+" : "-";
    printf("%6s6%12s%05d   %2s 3000001%08d%2d+%10d%s%10d%s%10d%s%10d%10d    000E      \n",
        date("Ym", mktime (0,0,0, $month, 1, $year )), IWEX_VAT_NUMBER, $rownum++, $obj->Country, $obj->euproductcode,
        $obj->Taric, ceil(abs($obj->weight)), $totaalsign, abs(round($obj->UnitsReceived)), $totaalsign, abs(round($obj->totaal)),
        $totaalsign, abs(round($obj->totaal *1.1)), $obj->PurchaseOrderID  );
  }

  // Create a query to select the fields for the CBS export rows.
  $sql = 'SELECT `inventory_transactions`.`TransactionDate` , `inventory_transactions`.`ProductID` ,
         `current_product_list`.`ProductName` , `inventory_transactions`.`Description` ,
         `inventory_transactions`.`UnitPrice` , `inventory_transactions`.`UnitsSold` , 
         `inventory_transactions`.`UnitPrice` * `inventory_transactions`.`UnitsSold` AS "totaal", 
         `current_product_list`.`weight_corr` * `inventory_transactions`.`UnitsSold` AS "weight", 
         `inventory_transactions`.`OrderID` , `contacts`.`CompanyName` , `contacts`.`btw_number` , 
         `contacts`.`Country` , `current_product_list`.`euproductcode` , `current_product_list`.`Taric` 
          FROM inventory_transactions
          INNER JOIN `orders` ON orders.OrderID = inventory_transactions.OrderID
          LEFT JOIN contacts ON `orders`.`ContactID` = `contacts`.`ContactID`
          INNER JOIN current_product_list ON `inventory_transactions`.`ProductID` = `current_product_list`.`ProductID`
          WHERE `inventory_transactions`.`TransactionDate` >= "' . date("Y-m-d", mktime (0,0,0, $month, 1, $year ))
        . ' " AND `inventory_transactions`.`TransactionDate` < "'. date("Y-m-d", mktime (0,0,0, $month + 1, 1, $year ))
        . ' " AND `contacts`.`Country` <> "NL" AND `inventory_transactions`.`UnitsSold` != "0"';
  $query = $db_iwex->query($sql);
  $rownum = 1;
  while ($obj = mysql_fetch_object($query)) {
    $totaalsign = $obj->totaal >= 0 ? "+" : "-";
    printf("%6s7%12s%05d   %2s 3000001%8d%2d+%10d%s%10d%s%10d%s%10d%10d    000E      \n",
        date("Ym", mktime (0,0,0, $month, 1, $year )), IWEX_VAT_NUMBER, $rownum++, $obj->Country, $obj->euproductcode,
        $obj->Taric, ceil(abs($obj->weight)), $totaalsign, abs(round($obj->UnitsSold)), $totaalsign, abs(round($obj->totaal)),
        $totaalsign, abs(round($obj->totaal *1.1)), $obj->OrderID  );
  }


// Print Afsluitrecord
  echo "9899";
  for ($i=0; $i<111; $i++) echo " ";
  echo "\n";
  
  // Set update date
  $db_iwex->query("UPDATE events 
                   SET action_performed_date = NOW(),
                   action_done_by = '$employee_id'
                   WHERE id = 1");
}

if (!$submit) {
	echo "</pre>";
	printenddoc();
}

?>
