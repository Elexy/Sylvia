<?php
 /*
 * stock_mutations.php
 *
 * @version $Id: stock_mutations.php,v 1.26 2007-04-19 16:08:37 iwan Exp $
 * @copyright $date:
 **/
 
include ("include.php");

// Get all the URL variable we need.
$int_productID = GetSetFormVar("ProductID");
$bl_add_transaction = GetSetFormVar("add_transaction");
$bl_swap_stock = GetSetFormVar("swap_stock");
$int_corrected = GetSetFormVar("corrected");
$int_stocklevel = GetSetFormVar("stocklevel");
$str_description = GetSetFormVar("tr_description");
$int_shipment = GetSetFormVar("tr_shipment");
$int_stockorder = GetSetFormVar("tr_stockorder");
$str_keyword = GetSetFormVar("stock_keyword");
$int_owner = GetSetFormVar("owner");
$int_contact = GetSetFormVar("ContactID");
$show_stock_value = GetSetFormVar("show_stock_value");

$db_iwex = new DB();

if (isset($_POST['print'])) {
    //Instanciation of inherited class
    $pdf=new IwexPDF('P','mm','A4');
    
    $pdf->SetWidths(array(13,13,25,80,8,8,8,8,15));
    $pdf->SetAligns(array('C','C','L','L','R','R','R','R','C'));
    $pdf->SetBorders(array('F','F','F','F','F','F','F','F','F'));
    $pdf->SetLineWidth(0);
    $pdf->SetHight(4);
    $pdf->SetMargins(15,15,15);
    $pdf->usehead(FALSE); // Don't print the header
    
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);

    
    $qry_stock = $db_iwex->query("SELECT location, ProductID, ExternalID, ProductName,
        Discontinued_yn AS EOL, Pricelist_yn AS List, stock  
		FROM current_product_list
        LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."' 
		LEFT JOIN location ON location_ID = location.ID
        WHERE ".STOCK_COUNT_CONDITION
      ."ORDER BY walk_order, location.ID, ProductID;");
    $headerdata = array();
    for ($i = 0; $i < mysql_num_fields($qry_stock); $i++){
           $headerdata[$i]= mysql_field_name($qry_stock, $i);
    }
    $headerdata[$i++] = 'Calc';
    $headerdata[$i] = 'Getelt';
                                       
    while ($obj = mysql_fetch_object($qry_stock)) {
        $tabledata = array();
        $rowcnt = 0;
        while($row = mysql_fetch_row($qry_stock)) {
            if ($row[0] == "Op bestelling") $row[0] = "Bestel";
            $tabledata[$rowcnt] = $row;
            $tabledata[$rowcnt][count($row)] = get_stock($tabledata[$rowcnt][1]);
            $tabledata[$rowcnt][count($row)+1] = "";
            $rowcnt++;
        }
    
        // Generate the PDF table.
        $pdf->PDFtable($headerdata, $tabledata);
        $pdf->Ln(5);
    }
    
    $pdf->Output();

    mysql_free_result($qry_stock);
    exit;
}
// Print default Iwex HTML header.
printheader (COMPANYNAME . " stock mutations", "jaop");

if ($bl_add_transaction
    &&
    $int_corrected
    &&
    $int_productID
    &&
    $int_owner) { //if user has typed number of units made and pressed submit      // first add negative transactions in the transaction database
    $Employee = GetField("SELECT FirstName FROM employees WHERE EmployeeID = '" . $GLOBALS["employee_id"] ."'");
    $sql = 'INSERT INTO inventory_transactions ' // construct main article positive insert
       . 'SET transactiondate = "'.date('Y-m-d'). '" , ProductID = '.$int_productID
       . ' , TransactionDescription = "Correction: '.$Employee."\n$str_description\", OrderID = '".$int_shipment."'"
       . ', UnitsReceived = '.$int_corrected.', PurchaseOrderID = "'.$int_stockorder.'",'
       . " stock_owner_id = '$int_owner', employee = '".$GLOBALS["employee_id"]."' ";
    $result = $db_iwex->query($sql);
    
    // now add combi articles to the static field in product record
    if (GetField("SELECT Product_ID 
				  FROM product_stock
				  WHERE Product_ID = '$int_productID' AND owner_id = $int_owner")) { // Update record
		$sql_product = 'UPDATE product_stock 
	        SET stock = (stock+'.$int_corrected.'),
				free_stock = (free_stock+'.$int_corrected.'),
				free_stock_calculated = NOW()
	        WHERE Product_ID = '.$int_productID." AND owner_id = $int_owner";
	} else { // Add record
		$sql_product = "INSERT INTO product_stock 
						SET stock = '$int_corrected', 
							free_stock = '$int_corrected', 
							Product_ID = '$int_productID',
							owner_id = '$int_owner'";
	}
	$product_result = $db_iwex->query($sql_product);

    echo 'Received -> '.$int_corrected.' x '.$int_productID.'<br>';
}

if ($bl_swap_stock
    &&
    $int_stocklevel
    &&
    $int_productID
    &&
    $int_owner) { //if user has typed number of units made and pressed submit      // first add negative transactions in the transaction database
    $Employee = GetField("SELECT FirstName FROM employees WHERE EmployeeID = '" . $GLOBALS["employee_id"] ."'");
    $sql = 'INSERT INTO inventory_transactions ' // construct main article positive insert
       . 'SET transactiondate = "'.date('Y-m-d'). '" , ProductID = '.$int_productID
       . ' , TransactionDescription = "Swapped -> '.$int_stocklevel.' x '.$int_productID.' to '.$int_contact.' and -'.$int_stocklevel.' x '.$int_productID.' from '.$int_owner.' by: '.$Employee."\n$str_description\", OrderID = '".$int_shipment."'"
       . ', UnitsReceived = '.$int_stocklevel.', PurchaseOrderID = "'.$int_stockorder.'",'
       . " stock_owner_id = '$int_contact'";
    $result = $db_iwex->query($sql);
    
    // now add combi articles to the static field in product record
    $sql_product_plus = 'UPDATE product_stock 
			SET stock = (stock+'.$int_stocklevel.'),
				free_stock = (free_stock+'.$int_stocklevel.'),
				free_stock_calculated = NOW()
        WHERE Product_ID = '.$int_productID." AND owner_id = $int_contact";
    $product_result_plus = $db_iwex->query($sql_product_plus);
	$sql_product_minus = 'UPDATE product_stock 
			SET stock = (stock-'.$int_stocklevel.'),
				free_stock = (free_stock-'.$int_stocklevel.'),
				free_stock_calculated = NOW()
        WHERE Product_ID = '.$int_productID." AND owner_id = $int_owner";
    $product_result_minus = $db_iwex->query($sql_product_minus);
    echo 'Swapped -> '.$int_stocklevel.' x '.$int_productID.' to '.$int_contact.' and -'.$int_stocklevel.' x '.$int_productID.' from '.$int_owner.'<br>';
}

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"stock_mutations\">\n";
// Used for overlib function.
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();
echo "ProductID: <INPUT TYPE='text' NAME='ProductID' VALUE='$int_productID'>";
echo " or Name is LIKE: <INPUT TYPE='text' NAME='stock_keyword' VALUE='$str_keyword'>";
echo " Owner: "."<INPUT TYPE=\"text\" NAME=\"owner\" SIZE=\"3\" CLASS=\"form\" value=\"$int_owner\"> : ";
//		  echo "<INPUT TYPE=\"text\" NAME=\"customername\" SIZE=\"30\" CLASS=\"form\" value=\"".$_POST["customername"]."\">";
		  echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "stock_mutations.owner", "cust", 10);
echo "<br><INPUT TYPE='submit' NAME='submit' VALUE='Search'>";
echo " <INPUT TYPE='submit' NAME='print' VALUE='Print voorraad'> ";
echo "Show Stock Value: " . MakeCheckbox('show_stock_value','');
if ($show_stock_value) {
	echo '<table><tr><th colspan=2>Stock value in &euro;</th></tr>';
	
	$qry_value = $db_iwex->query("SELECT CompanyName, sum(stock * Purchase_price_home) AS amount
						          FROM current_product_list
						          LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID 
								  LEFT JOIN contacts ON ContactID = owner_id
						          WHERE ".STOCK_COUNT_CONDITION."
								  GROUP BY owner_id");
	$flt_total = 0;
	while ($obj_value = mysql_fetch_object($qry_value))
    {
		echo "<tr><td>$obj_value->CompanyName</td><td align=right>".ToDutchNumber($obj_value->amount)."</td></tr>\n";
		$flt_total += $obj_value->amount > 0 ? $obj_value->amount : 0;
	}
	echo "<tr><td align=right><strong>Totaal</strong></td><td align=right>".ToDutchNumber($flt_total)."</td></tr>\n";
	echo "</table>";
}

//if ($int_productID) 
//{
    // get inventory transactions
    $today_sql = 'SELECT distinct transactiondate, current_product_list.ProductID, current_product_list.ProductName, 
      Sum(IF(isnull(UnitsReceived),0,UnitsReceived)) as UnitsReceived,
      Sum(IF(isnull(UnitsSold),0,UnitsSold)) as UnitsSold, 
      Sum(IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) as Corrections, stock_owner_id,
      inventory_transactions.OrderID, inventory_transactions.PurchaseOrderID, count(UnitsReceived) as count' 
      . STOCK_QUERY_CONDITION // get all the inventory transactions without the RMA ones 
      ;
    if ($int_productID||$str_keyword) $today_sql .= ' AND (';
    if ($int_productID) $today_sql .= ' current_product_list.ProductID LIKE \'%' . $int_productID . '%\'';
    if ($int_productID&&$str_keyword) $today_sql .= ' AND ';
    if ($str_keyword) $today_sql .= ' current_product_list.ProductName LIKE \'%' . $str_keyword . '%\'';
    if ($int_productID||$str_keyword) $today_sql .= ' ) ';
    if ($int_owner) $today_sql .= " AND stock_owner_id = '$int_owner'";
    $today_sql .= ' group by inventory_transactions.ProductID, stock_owner_id 
      order by inventory_transactions.ProductID';
      
if ($int_productID||$str_keyword) {
    //echo "'<br>$today_sql<br>";
    $today_result = $db_iwex->query($today_sql);
    
    echo '<br><br>';
    // print todays transactions
    echo '<TABLE BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody" WIDTH="100%"'."\n";
    echo '<TR valign="top">'."\n";
    echo '<th colspan="10">Transaction status on: '.date('d-M-Y').'</th>'."\n";
    echo '</TR>'."\n";
    echo '<TR valign="top">'."\n";
    echo '<th>ProductID</th>
            <th>Naam</th>
            <th>-</th>
            <th>+</th>
            <th>(-)</th>
            <th><small>Check</small></th>
            <th>static Stock</th>
            <th>calc stock</th>
            <th>owner</th>
            <th>Transactions</th>';
    echo '</TR>'."\n";
    While ($obj = mysql_fetch_object($today_result))
    {
      echo '<TR valign="top">'."\n";
      echo '<td align="right" class="cellline"><A HREF="'.$_SERVER['PHP_SELF']."?ProductID=$obj->ProductID&owner=$obj->stock_owner_id\">$obj->ProductID</A></td>\n";
      echo "<td><A HREF='". PRODUCT_MAINT . "?productid=$obj->ProductID'>$obj->ProductName</A></td>\n";
      if ($obj->UnitsSold>0) {
          $Sold = $obj->UnitsSold;          
          $negative_sold = 0;
      } else {
          $Sold = '';
          $negative_sold = $obj->UnitsSold;
      }
      if ($obj->UnitsReceived>0) {
          $Received = $obj->UnitsReceived;
          $negative_received = 0;
      } else {
          $Received = '';
          $negative_received = $obj->UnitsReceived;
      }
      $Sold = $Sold + $negative_received;
      $Received = $Received + $negative_sold;
      echo "<td align=\"right\">". $Sold ."</td>\n";
      echo "<td align=\"right\">". $Received ."</td>\n";
      echo "<td align=\"right\">". $obj->Corrections ."</td>\n";
      echo "<td align=\"right\"><small>". ($Received - $Sold - $obj->Corrections) ."</small></td>\n";
      echo '<td align="right">'.GetField("SELECT stock 
      					  FROM product_stock 
      					  WHERE Product_ID = '$obj->ProductID' 
      					        AND 
      					        owner_id = '$obj->stock_owner_id'").'</td>'."\n";
      echo '<td align="right">'.get_stock($obj->ProductID, $obj->stock_owner_id).'</td>'."\n";
      echo "    <td align=\"right\"><a href='customer_maint.php?custid=$obj->stock_owner_id' "
                 .ShowShortContactInfo($obj->stock_owner_id)
                 ."target=_new>$obj->stock_owner_id</a></td>\n";
      $_SESSION["popup_function"] = "print_inventory_transactions"; //set which function to execute in popup.php
      echo "<td align=right><a href='javascript:void()'
          onclick= \"window.open('popup.php?ProductID=$obj->ProductID','popup','toolbar=0,menubar=0,scrollbars=1,resizable=1,dependent=0,status=0,width=800,height=500,left=25,top=25')\">$obj->count</a></td>\n";
      echo '</TR>'."\n";
    }
    if (MYSQL_NUM_ROWS($today_result)<=1 && $int_owner) {
        echo '<TR valign="top">'."\n";
        echo '    <td align="right" class="cellline">aantal gecorrigeerd: </td><td colspan="8"><INPUT TYPE="text" NAME="corrected" SIZE="20" CLASS="form">'."\n";
        echo '    <INPUT TYPE="submit" NAME="add_transaction" VALUE="Invoeren" CLASS="button"></TR>'."\n";
        echo '<TR valign="top">'."\n";
        echo '    <td align="right" class="cellline">voorraad swap: </td><td colspan="8">'."\n";
		echo "    ".makelistbox('select ContactID, Companyname from contacts ORDER BY Companyname','ContactID','ContactID','Companyname',$obj->contacts_id)."\n";
		echo '    <INPUT TYPE="text" NAME="stocklevel" SIZE="20" CLASS="form">'."\n";
        echo '    <INPUT TYPE="submit" NAME="swap_stock" VALUE="Invoeren" CLASS="button"></TR>'."\n";
        echo '<TR valign="top">'."\n";
        $str_trdesc = date('m-d') == '12-31' ? 'Balance correction' : 'Ad hoc';
        echo '    <td align="right" class="cellline">Omschrijving: </td><td colspan="8"><INPUT TYPE="text" NAME="tr_description" SIZE="30" CLASS="form" VALUE="'.$str_trdesc.'">'."\n";
        echo '</TR>'."\n";
        echo '<TR valign="top">'."\n";
        echo '    <td align="right" class="cellline">Levering (order): </td><td colspan="8"><INPUT TYPE="text" NAME="tr_shipment" SIZE="30" CLASS="form" VALUE="'.$int_shipment.'">'."\n";
        echo '</TR>'."\n";
        echo '<TR valign="top">'."\n";
        echo '    <td align="right" class="cellline">Interne Order id: </td><td colspan="8"><INPUT TYPE="text" NAME="tr_stockorder" SIZE="30" CLASS="form" VALUE="'.$int_stockorder.'">'."\n";
        echo '</TR>'."\n";
    }
    echo '</table>'."\n"; 
}

echo "</FORM>\n";

printenddoc();
?>
