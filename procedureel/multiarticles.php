<?
include ("include.php");
// get posted productID if it's not there get it from URL
if (isset($_POST["TempProductID"])) {
    $TempProductID = $_POST["TempProductID"];
} else if (isset($_GET["ProductID"])) {
    $TempProductID = $_GET["ProductID"];
} else {
    $TempProductID = FALSE;
}
$int_made = isset($_POST["made"]) ? $_POST["made"] : FALSE;  //aantal gemaakt
$bl_add_transaction = isset($_POST["add_transaction"]) ? TRUE : FALSE;  //submit aantal gemaakt
$int_owner = isset($_REQUEST["owner"]) ? $_REQUEST["owner"] : OWN_COMPANYID;
$tr_description = GetSetFormVar("tr_description");
$tr_shipment = GetSetFormVar("tr_shipment");
$tr_stockorder = GetSetFormVar("tr_stockorder");
$tr_stockorder = GetSetFormVar("tr_stockorder");

// Print default Iwex HTML header.
printheader (COMPANYNAME . " Multi Articles");
echo '<BODY '.get_bgcolor().'><div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();

echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"multiform\">\n";

$multiarticle_sql = 'select multi_productID, multi_id, product_ids, aantal, ProductName from multi_articles2 
    left join current_product_list on multi_articles2.product_ids = current_product_list.ProductID'; 

if ($TempProductID) {
    $multiarticle_sql .= ' WHERE multi_id="'.$TempProductID.'"';
}  
$multiarticle_result = mysql_query($multiarticle_sql)
      or die("Ongeldige query: " .$multiarticle_sql. mysql_error());
      
if (!mysql_numrows($multiarticle_result)) {
    $TempProductID = NULL;
}

if (($TempProductID)&&!($bl_add_transaction&&$int_made)) { //if user has pressed submit button show result
      echo '<TABLE BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody">'."\n";
      echo '<TR valign="top">'."\n";

      echo '<th colspan="4">hoofdartikel: '.$TempProductID
		  .' eigenaar '.GetField('SELECT CompanyName FROM contacts WHERE ContactID = '.$int_owner).'</th>'."\n";
      echo '<input type = "hidden" name="TempProductID" value="'.$TempProductID.'">';
      echo '<input type = "hidden" name="owner" value="'.$int_owner.'">';
      echo '</TR>'."\n";
      echo '<TR valign="top">'."\n";
      echo '<th>ProductID</th><th>Naam</th><th>aantal</th><th>Fysieke Stock</th>';
      echo '</TR>'."\n";
	  $buttonstatus = "";
	  $int_stock = 0;
      While ($obj = mysql_fetch_object($multiarticle_result)) {
		$int_stock = Get_stock($obj->product_ids,$int_owner);
		if ($int_stock < 0) $buttonstatus = "DISABLED";
            echo '<TR valign="top">'."\n";
            echo '    	<td align="right" class="cellline">'.$obj->product_ids.'</td>
						<td>'.$obj->ProductName.'</td>
						<td>'.$obj->aantal.'</td>'
						."\n<td align='right' ".($int_stock <= 0 ? "bgcolor='red'" : "").">$int_stock</td>"
						."\n";
            echo '</TR>'."\n";
      }
      echo '<TR valign="top">'."\n";
      echo '    <td colspan="3" align="right" class="cellline">aantal gemaakt: <INPUT TYPE="text" NAME="made" SIZE="20" CLASS="form">'."\n";
      echo '    <INPUT TYPE="submit" NAME="add_transaction" '.$buttonstatus.' VALUE="Invoeren" ></TD>'."\n";
      echo '</TR>'."\n";
      echo '<TR valign="top">'."\n";
      echo '    <td colspan="3" align="right" class="cellline">Omschrijving: <INPUT TYPE="text" NAME="tr_description" SIZE="30" CLASS="form" VALUE="'.$TempProductID.'">'."\n";
      echo '</TR>'."\n";
      echo '<TR valign="top">'."\n";
      echo '    <td colspan="3" align="right" class="cellline">Levering (order): <INPUT TYPE="text" NAME="tr_shipment" SIZE="30" CLASS="form">'."\n";
      echo '</TR>'."\n";
      echo '<TR valign="top">'."\n";
      echo '    <td colspan="3" align="right" class="cellline">Interne Opdracht: <INPUT TYPE="text" NAME="tr_stockorder" SIZE="30" CLASS="form">'."\n";
      echo '</TR>'."\n";
      echo '</table>'."\n";
} else {
	Echo 'Eigenaar'.makelistbox('SELECT ContactID, CompanyName FROM contacts WHERE warehouse_customer = 1 ORDER BY CompanyName;',
								 'owner',
								 'ContactID',
								 'CompanyName',
								 $int_owner)
		 .'<BR>';
    Echo 'Product ID:<INPUT TYPE="text" NAME="TempProductID" VALUE="" CLASS="button">'."\n";
    // Echo 'Zoek multi Article'.makelistbox(,'TempProduct','ProductID','Productname',$TempProductID);
    Echo GetRecordId('select ProductID, Productname from current_product_list WHERE (Productname LIKE "%'.GETRECORDSEARCH.'%" OR ProductID LIKE "%'.GETRECORDSEARCH.'%") AND sku<>1 AND Discontinued_yn=0 ORDER BY Productname'
        , "ProductID", "multiform.TempProductID", "multiform.TempProductID"). "\n";
    Echo '<INPUT TYPE="submit" NAME="submit" VALUE="Maken" $buttonstatus CLASS="button">'."\n";
}
if ($bl_add_transaction
	&&
	$int_made
	&&
	$TempProductID) { //if user has typed number of units made and pressed submit  
    //First check if there is enouh stock
	$enough_stock = TRUE;
	while ($obj = mysql_fetch_object($multiarticle_result)) {
		//First check if there is enouh stock
		if (Get_stock($obj->product_ids,$int_owner) < $int_made*$obj->aantal) {
			echo "<BR>ERROR: You need " . $int_made*$obj->aantal . " x " . $obj->product_ids ." and Stock = " . Get_stock($obj->product_ids,$int_owner);
			$enough_stock = FALSE;
		}
	}
	$multiarticle_result = mysql_query($multiarticle_sql)
      or die("Ongeldige query: " .$multiarticle_sql. mysql_error());
	if ($enough_stock) {
		while ($obj = mysql_fetch_object($multiarticle_result)) {
			// first add negative transactions in the transaction database
	        $addneg_sql_transaction = 'INSERT INTO inventory_transactions 
	            SET transactiondate = "'.date("Y-m-d"). ' 00-00" , ProductID = '.$obj->product_ids . '
	            , TransactionDescription = "'.$tr_description.'"
	            , UnitsSold = '.$int_made*$obj->aantal.' , OrderID = "'.$tr_shipment.'", stock_owner_id = "'.$int_owner.'"
	            , PurchaseOrderID = "'.$tr_stockorder.'", employee = "'.$GLOBALS["employee_id"].'" ';

	        $addneg_transaction_result = $db_iwex->query($addneg_sql_transaction);
	        //now update the Current_product_list static 'stock ' field
	        $addneg_sql_product = 'UPDATE product_stock 
	            SET stock = (stock-'.$int_made*$obj->aantal.")
	            WHERE Product_ID = '$obj->product_ids'
					  AND
					  owner_id = '$int_owner'" ;
	        $addneg_product_result = $db_iwex->query($addneg_sql_product);
	        //echo -1*$made*$obj->aantal .' x '.$obj->product_ids.'<br>';
		} 
		$addpos_sql = 'INSERT INTO inventory_transactions ' // construct main article positive insert
	           . 'SET transactiondate = "'.date('Y-m-d'). '" , ProductID = '.$TempProductID
	           . ' , TransactionDescription = "ad hoc", OrderID = "'.$tr_shipment.'"'
	           . ', UnitsReceived = '.$int_made.', PurchaseOrderID = "'.$tr_stockorder.'", stock_owner_id = "'.$int_owner.'"'
			   . ', employee = "'.$GLOBALS["employee_id"].'" ';
	    $addpos_result = $db_iwex->query($addpos_sql);
	    // now add combi articles to the static field in product record
	    $addpo_sql_product = 'UPDATE product_stock 
	            SET stock = (stock+'.$int_made.')
	            WHERE Product_ID = '.$TempProductID.' AND owner_id = '.$int_owner;
	    $addpos_product_result = $db_iwex->query($addpo_sql_product);
    } else {
		echo "<br>No transaction made, please correct the issues above";
	}
	//echo '+'.$made.' x '.$TempProductID.'<br>';
 }
 // get todays multiarticles
 $today_sql = 'select distinct transactiondate, inventory_transactions.ProductID, current_product_list.ProductName, '
      .'sum(UnitsSold) as UnitsSold, sum(UnitsReceived) as UnitsReceived, OrderID, PurchaseOrderID, stock '
      .'from inventory_transactions '
      .'left join current_product_list on inventory_transactions.ProductID=current_product_list.productID '
      ."LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '$int_owner' "
      .'where transactiondate = "'.date('Y-m-d').'*"'
      .'group by inventory_transactions.ProductID '
      .'order by inventory_transactions.ProductID';

 $today_result = mysql_query($today_sql)
      or die("Ongeldige query (dag transacties): " .$today_sql. mysql_error());
 echo '<br><br>';
 // print todays transactions
 echo '<TABLE BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody">'."\n";
 echo '<TR valign="top">'."\n";
 echo '<th colspan="6">Transacties van: '.date('d-M-Y').'</th>'."\n";
 echo '</TR>'."\n";
 echo '<TR valign="top">'."\n";
 echo '<th>ProductID</th><th>Naam</th><th>-</th><th>+</th><th>static Stock</th><th>calc stock</th>';
 echo '</TR>'."\n";
 While ($obj = mysql_fetch_object($today_result))
 {
      echo "<TR valign='top'>\n";
      echo "   <td align='right' class='cellline'><A HREF='". PRODUCT_MAINT . "?productid=$obj->ProductID'>$obj->ProductID</A></td>";
      echo "    <td>$obj->ProductName</td>";
      if ($obj->UnitsSold>0) {
          echo '    <td align="right">'.$obj->UnitsSold.'</td>';
          echo '    <td></td>';
      } else {
          echo '    <td></td>';
          echo '    <td align="right">'.$obj->UnitsReceived.'</td>';
      }
      echo '    <td align="right">'.$obj->stock.'</td>';
      echo '    <td align="right">'.get_stock($obj->ProductID).'</td>'."\n";
      echo '</TR>'."\n";
 }
 echo '</table>'."\n";

 echo "</FORM>\n";

printenddoc();
?>
