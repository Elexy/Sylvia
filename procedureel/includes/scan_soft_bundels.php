<?php

/**
 * scan_soft_bundels.php
 *
 * @version $Id: scan_soft_bundels.php,v 1.5 2006-07-04 14:28:31 iwan Exp $
 * @copyright $date:
 **/

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';


// Get all the URL variable we need.
$bl_submit = isset($_POST["submit"]);
$bl_finished = isset($_POST['finished']);
$int_shipid = isset($_REQUEST['shipid']) ? $_REQUEST['shipid'] : FALSE;
$int_adresid = isset($_POST['adresid']) ? $_POST['adresid'] : FALSE;
//$int_orderdetailsid = isset($_REQUEST['orderdetailsid']) ? $_REQUEST['orderdetailsid'] : FALSE;
$int_productid = isset($_REQUEST['productid']) ? $_REQUEST['productid'] : FALSE;
$int_amount_to_pack = isset($_REQUEST['amount_to_pack']) ? $_REQUEST['amount_to_pack'] : FALSE;
$int_box_no = isset($_REQUEST["box_no"]) ? $_REQUEST["box_no"] : 1;
$int_max_box = isset($_POST["max_box"]) ? $_POST["max_box"] : FALSE;
$int_packed_article = isset($_POST["packed_article"]) ? $_POST["packed_article"] : FALSE;
$int_amount_packed_article = isset($_POST["amount_packed_article"]) ? $_POST["amount_packed_article"] : FALSE;
$int_products_retour = isset($_POST["products_retour"]) ? $_POST["products_retour"] : 0;
$int_last_packed_article = isset($_POST["last_packed_article"]) ? $_POST["last_packed_article"] : 0;

$db_iwex = new DB;

/**
 * Function     : GetTempInventoryIDforProduct
 * Will return the invertory ID.
 * Input        : int_shipmentID: The id of the shipment.
 *                int_orderdetails: The id of the orderdetail.
 *                int_product_id: The id of the product.
 * 				  int_boxnumber: The number of the box in
 * 								 this shipment.
 * Returns      : The boxID. False if no box is found.
 **/
function GetTempInventoryIDforProduct($int_ship_id, 
                                      $int_orderdetails_id, 
                                      $int_product_id,
                                      $int_boxid) {
    global $db_iwex;
    $int_inventoryid = FALSE;
    
    $sql_is_already_in_box = "SELECT TransactionID 
                              FROM temp_inv_transactions
                              WHERE shipmentID = '$int_ship_id' 
                                AND orderdetailsID = '$int_orderdetails_id'
                                AND ProductID = '$int_product_id'
                                AND box_ID = '$int_boxid'";
    $qry_is_already_in_box = $db_iwex->query($sql_is_already_in_box);

    // When there is already one or more of this product in this box.
    if ($obj_is_in_box = mysql_fetch_object($qry_is_already_in_box)) {
        $int_inventoryid = $obj_is_in_box->TransactionID;
    }
    mysql_free_result($qry_is_already_in_box);
    
    return $int_inventoryid;
}

// Print default Iwex HTML header.
printheader (COMPANYNAME . " add soft bundel products", "softbundels", TRUE);

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"softform\"\">\n";

printIwexNav(FALSE);

if ($int_shipid) {
    $sql_multi = "SELECT aantal, Product_ids, ProductName, location, ExternalID, stock, Purchase_price_home, store_serial_yn
            FROM multi_articles2
            LEFT JOIN current_product_list ON multi_articles2.Product_ids=current_product_list.ProductID
            LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."'         
            LEFT JOIN location ON location_ID = location.ID
            WHERE Multi_ID = '$int_productid'";
    $qry_multilist = $db_iwex->query($sql_multi);
    $ary_multi = array();
    while ($ary_row = mysql_fetch_array($qry_multilist, MYSQL_BOTH))
    {
        $ary_multi[$ary_row["Product_ids"]] = $ary_row;
    }
    mysql_free_result($qry_multilist);

    // Store the sum of products and the sum of the parts in this soft bundel
    $int_num_products_in_bundel = 0;
    $flt_total_product_cost_in_bundel = 0;
    foreach ($ary_multi as $ary_parts) {
        $int_num_products_in_bundel += $ary_parts["aantal"];
        $flt_total_product_cost_in_bundel += $ary_parts["Purchase_price_home"];
    }
    
    // When finished check if the product count is x times the products listed in the ary_multi.
    if ($bl_finished) {
        // get inventory transactions for this shipment
        $ship_sql = "SELECT TransactionID, temp_inv_transactions.ProductID, 
            OrderID, sum(UnitsSold) as UnitsSold
            FROM temp_inv_transactions
            WHERE ShipmentID = '".$int_shipid."'
            GROUP BY OrderID, ProductID";
        $shipquery = $db_iwex->query($ship_sql);
        while ($objinventory = mysql_fetch_object($shipquery)) {
            if (isset($ary_multi[$objinventory->ProductID])) {
                $ary_multi[$objinventory->ProductID]['new_amount'] = $objinventory->UnitsSold;
            }
        }
        mysql_free_result($shipquery);

        $int_multiplyer = INVALID;
        $bl_result_ok = TRUE;
        foreach ($ary_multi as $ary_parts) {
            if (!isset($ary_parts['new_amount'])) {
                // When new_amount is not set products are not listed.
                $bl_result_ok = FALSE;
                break; // foreach loop
            } else if ($int_multiplyer == INVALID) {
                $int_multiplyer = $ary_parts['new_amount'] / $ary_parts['aantal'];
            } else {
                $bl_result_ok = $int_multiplyer == $ary_parts['new_amount'] / $ary_parts['aantal'];
                // When one of the products fails break the loop.
                if (!$bl_result_ok) break;
            }
        }
        
        //echo "Multi = '$int_multiplyer' result='$bl_result_ok'<br>";
        // Get products to deliver.
        $orderdetail_sql = SQL_openorderdetails . " WHERE order_details.to_deliver <> 0
                  AND " . openordedetails_condition . " AND orders.ShipID= '$int_adresid' AND (rma_yn <> 1 or isnull(rma_yn)) 
                  AND order_details.ProductID = '$int_productid'";
        $orderdetail_query = $db_iwex->query($orderdetail_sql);
        $int_to_deliver = 0;
        if ($obj_packed_orderdetail = mysql_fetch_object($orderdetail_query)) {
            $int_to_deliver = $obj_packed_orderdetail->to_deliver;
        
            // When all the products have the same multiplyer
            if ($bl_result_ok 
                && 
                $int_multiplyer <= $int_to_deliver
                &&
                $int_multiplyer > 0) {
                
                // Now insert the soft bundel main article in the inventory_transactions
                $packed_sql="INSERT INTO inventory_transactions SET
                    TransactionDate = now(),
                    ProductID = ".$obj_packed_orderdetail->ProductID.",
                    ExternalID = '".$obj_packed_orderdetail->ExternalID."',
                    OrderID = '".$obj_packed_orderdetail->OrderID."',
                    orderdetailsID = '".$obj_packed_orderdetail->OrderDetailsID."',
                    shipmentID =".$int_shipid.",
                    TransactionDescription = 'shipment',
                    UnitPrice = '".$obj_packed_orderdetail->UnitPrice."',
                    UnitsSold = ".$int_multiplyer.",
                    UnitsShrinkage = 0,
                    btw_percentage = '".$obj_packed_orderdetail->btw_percentage."', 
                    added_cost = '".$obj_packed_orderdetail->cost_percentage."',
                    stock_owner_id = '$obj_packed_orderdetail->stock_owner_id'";
                    
            
                if ($db_iwex->query($packed_sql)) {
                    //update current product list stock field
                    update_all_stock($obj_packed_orderdetail->ProductID);
                
                    // now subtract the packed articles from the to_deliver field in the order
                    $db_iwex->query("UPDATE order_details, orders
                        SET to_deliver = to_deliver - ".$int_multiplyer."
                        WHERE ProductID = ".$obj_packed_orderdetail->ProductID." 
                            AND order_details.OrderDetailsID = ".$obj_packed_orderdetail->OrderDetailsID);
                    
                    // Set the possible new order status.
                    upd_orderstatus($obj_packed_orderdetail->OrderID);
                    
                    // get inventory transactions for this shipment
                    $ship_sql = "SELECT temp_inv_transactions.*
                        FROM temp_inv_transactions
                        WHERE ShipmentID = '".$int_shipid."'";
                    //echo $inventory_sql;
                    $shipquery = $db_iwex->query($ship_sql);
                    while ($objinventory = mysql_fetch_object($shipquery)) {
                        $packed_sql="INSERT INTO inventory_transactions SET
                                    TransactionDate = '$objinventory->TransactionDate',
                                    ProductID = ".$objinventory->ProductID.",
                                    OrderID = '".$objinventory->OrderID."',
                                    orderdetailsID = '".$objinventory->orderdetailsID."',
                                    shipmentID =".$int_shipid.",
                                    TransactionDescription = 'Part of bundel $int_productid',
                                    UnitPrice = '".$objinventory->UnitPrice."',
                                    UnitsSold = 0,
                                    UnitsShrinkage = '$objinventory->UnitsSold',
                                    btw_percentage = '".$objinventory->btw_percentage."', 
                                    added_cost = '".$objinventory->added_cost."',
                                    box_ID = '".$objinventory->box_ID."',
                                    stock_owner_id = '$objinventory->stock_owner_id'";
                                    $int_last_box_id = $objinventory->box_ID;
                        $db_iwex->query($packed_sql);
                        // Get the new transaction id just inserted
                        $int_new_transaction_id = $db_iwex->lastinserted();
                        // Remove the temp record.
                        $db_iwex->query("DELETE FROM temp_inv_transactions WHERE TransactionID = '$objinventory->TransactionID'");
                        // When there are serial numbers stored set the new inventory transaction id to it.
                        $db_iwex->query("UPDATE Serialnumbers 
                                         SET Inventory_transactionID = '$int_new_transaction_id' 
                                         WHERE Inventory_transactionID = '-$objinventory->TransactionID'");
                        //update current product list stock field
                        update_all_stock($objinventory->ProductID);
                    }
                    mysql_free_result($shipquery);

                    echo "<script TYPE='text/javascript' language='JavaScript'>
                          location.replace('".docroot."/shipment.php?shipmentID=sh$int_shipid&box_no=$int_box_no');
                          </script>";                          
                }
            } else if ($bl_result_ok && $int_multiplyer == 0) {
                echo "<script TYPE='text/javascript' language='JavaScript'>
                          location.replace('".docroot."/shipment.php?shipmentID=sh$int_shipid&box_no=$int_box_no');
                          </script>";   
            } else {
                echo "<h2>Not all product are in equal amount</h2>";
            }
            mysql_free_result($orderdetail_query);
        }
    }
    
    if (!$int_max_box) {
        $ary_boxes = array();
        if (get_box_numbers(&$ary_boxes, $int_shipid)) {
            $int_max_box = mysql_numrows($ary_boxes); // Count the amount of boxes for this shipment.
            // Set the box number to the last one. Because this is the most likely box that is used to fill up.
            $int_box_no = $int_max_box;
            mysql_free_result($ary_boxes);
        } 
        if (!$int_box_no) {
            $int_max_box = 1; // Default box 1 is used.
            $int_box_no = 1;
        } 
    }
    
    if ($bl_submit || $int_packed_article) { // if user has packed an article update it to temp_inventory_transactions
        // Check if there should be products placed back to the warehouse.
        //echo "Retour $int_products_retour<br>\n";
        if ($int_products_retour) {
            if ($int_packed_article == $int_last_packed_article) {
                // Ok now remove the amount to place back.
                if ($int_products_retour >= $int_amount_packed_article) {
                    $int_products_retour -= $int_amount_packed_article;
                    if ($int_products_retour) {
                        echo "<h2 align=center class=\"menubar\">Ok, nog $int_products_retour van artikel $int_packed_article terug leggen</h2>"; 
                    } 
                    echo MakeBeep(TRUE);
                } else {
                    echo "<h2 align=center class=\"menubar\">Te veel van artikel ($int_packed_article) terug gepakt.<br>Moeten er $int_products_retour terug naar de voorraad.!!</h2>";
                    echo MakeBeep(FALSE);
                }
            } else {
                echo "<h2 align=center class=\"menubar\">Verkeerde product ($int_packed_article) terug gepakt.<br>Moet een $int_last_packed_article zijn!!</h2>";
                $int_packed_article = $int_last_packed_article;
                echo MakeBeep(FALSE);
            }
        } else {
            // Get the product ID, can also be an EAN code that is scanned.
            $int_part_product_id = Getfield("SELECT ProductID 
                                        FROM current_product_list 
                                        WHERE ProductID = '$int_packed_article'
                                              OR
                                              EAN = '$int_packed_article'");
            // When this product is part of $int_productid
            if (isset($ary_multi[$int_part_product_id])) {
                $orderdetail_sql = SQL_openorderdetails . " WHERE order_details.to_deliver <> 0
                  AND " . openordedetails_condition . " AND orders.ShipID= '$int_adresid' AND (rma_yn <> 1 or isnull(rma_yn)) 
                  AND order_details.ProductID = '$int_productid'";
                //echo "sql = $orderdetail_sql<br>";
                $orderdetail_query = $db_iwex->query($orderdetail_sql);      
                if ($obj_packed_orderdetail = mysql_fetch_object($orderdetail_query)) {
                    $int_boxID =GetBoxID($int_shipid, $int_box_no, TRUE);
                    $int_transactionID = GetTempInventoryIDforProduct($int_shipid, 
                                                                      $obj_packed_orderdetail->OrderDetailsID,
                                                                      $int_part_product_id,
                                                                      $int_boxID);
    
                    if ($int_transactionID) {
                        // When there is already one or more of this product in this box.
                        $packed_sql= 'UPDATE temp_inv_transactions SET
                                      UnitsSold = UnitsSold + '.$int_amount_packed_article.'
                                      WHERE TransactionID = '.$int_transactionID;
                                      
                        $query_packed_ok = $db_iwex->query($packed_sql);
                    } else {
                        // now insert the packed article in the inventory_transactions
                        $packed_sql="INSERT INTO temp_inv_transactions SET
                            TransactionDate = now(),
                            ProductID = ".$int_part_product_id.",
                            OrderID = '".$obj_packed_orderdetail->OrderID."',
                            orderdetailsID = '".$obj_packed_orderdetail->OrderDetailsID."',
                            shipmentID =".$int_shipid.",
                            UnitPrice = '".$obj_packed_orderdetail->UnitPrice / $flt_total_product_cost_in_bundel * $ary_multi[$int_part_product_id]['Purchase_price_home'] ."',
                            UnitsSold = ".$int_amount_packed_article.",
                            btw_percentage = '".$obj_packed_orderdetail->btw_percentage."', 
                            added_cost = '".$obj_packed_orderdetail->cost_percentage."',
                            box_ID = '".$int_boxID."',
                            stock_owner_id = '$obj_packed_orderdetail->stock_owner_id'";
                    
                        $query_packed_ok = $db_iwex->query($packed_sql);
                        $int_transactionID = GetTempInventoryIDforProduct($int_shipid, 
                                                                      $obj_packed_orderdetail->OrderDetailsID,
                                                                      $int_part_product_id,
                                                                      $int_boxID);
                    }
                    mysql_free_result($orderdetail_query);
                
                    // When succesfull clear the inserted artikel name and amount of units.
                    $int_packed_article = "";
                    $int_max_box = $int_box_no > $int_max_box ? $int_box_no : $int_max_box;
                    echo MakeBeep(TRUE);
                    if ($ary_multi[$int_part_product_id]['store_serial_yn']) {
                        echo "<script TYPE='text/javascript' language='JavaScript'>
                        var timerID;
                        
                        function showserial() {
                            window.open('".docroot."/includes/store_serial_number.php?transid=-$int_transactionID','serial','toolbar=0,menubar=0,resizable=1,scrollbars=1,status=0,width=200,height=300,left=25,top=25,alwaysRaised=1');
                            clearInterval(timerID);
                        }
                        timerID = setInterval('showserial()',500)</script>
                        <embed src=\"".docroot."/includes/serial.wav\" autostart=true hidden=true name=\"serial_sound\">";
                    }
                } else {
                    echo MakeBeep(FALSE);
                    echo "No products found for $int_productid part search for $int_part_product_id";
                    $int_products_retour = $int_amount_packed_article;
                }
            } else {
                    echo MakeBeep(FALSE);
                    $int_products_retour = $int_amount_packed_article;
            }
                        
            
/*            if (box($int_addressID, 
                    $int_shipmentID, 
                    $int_packed_article,
                    $int_amount_packed_article, 
                    $int_box_no, 
                    !$saccess_v, // When false products can also be removed from a box when already put in.
                    &$int_products_retour)) {
                $int_packed_article = "";
                $int_max_box = $int_box_no > $int_max_box ? $int_box_no : $int_max_box;
            } */
        }
        echo "<INPUT TYPE=\"hidden\" NAME=\"products_retour\" CLASS=\"form\" value=\"".$int_products_retour."\">\n";
        echo "<INPUT TYPE=\"hidden\" NAME=\"last_packed_article\" CLASS=\"form\" value=\"".$int_packed_article."\">\n";
        echo "<INPUT TYPE=\"hidden\" NAME=\"amount_to_pack\" CLASS=\"form\" value=\"".$int_amount_to_pack."\">\n";
        
        $int_amount_packed_article = 0;
    }
  
    echo "<INPUT TYPE='hidden' NAME='shipid' VALUE='$int_shipid'>";
//    echo "<INPUT TYPE='hidden' NAME='orderdetailsid' VALUE='$int_orderdetailsid'>";
    echo "<INPUT TYPE='hidden' NAME='productid' VALUE='$int_productid'>";
    
    // get the supplied shipmentID
    $shipment_sql = SQL_SHIPMENTS . "
        WHERE shipment_ID = '$int_shipid'
        ORDER BY Shipment_ID Desc;";
    $shipmentdetail_query = $db_iwex->query($shipment_sql);
    $objshipment = mysql_fetch_object($shipmentdetail_query);

    if ($objshipment->InvoiceID) { $bgcolor="#FFABA9"; } else { $bgcolor=""; };
    echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" >\n";
    echo "    <TR>\n";
    echo "         <TH colspan='2'><B>Shipment ID $objshipment->Shipment_ID</B></TH>\n";
    echo "    </TR>\n";
    echo "     <TD WIDTH='50%'>\n";
    echo "      <TABLE WIDTH='100%' BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "         <TR>\n";
    echo "             <TH colspan='2'><B>Ship To Adress ".$objshipment->AdresID."<input type=hidden name=adresid value='$objshipment->AdresID'></B></TH>\n";
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
    echo "      </table>";
    echo "     </TD>\n";
    echo "     </TR><TR>\n";
    echo "          <TD>\n";

    if (!$objshipment->InvoiceID && !$int_products_retour) {
        echo "          ProductID: <INPUT TYPE=\"text\" NAME=\"packed_article\" CLASS=\"form\"' tabindex=1>\n";
        echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "packed_article", "softform.packed_article");

		// When the amount is not set, set it to default 1
		$int_amount_packed_article = $int_amount_packed_article ? $int_amount_packed_article : 1;
        echo " x <INPUT TYPE=\"text\" size=\"1\" NAME=\"amount_packed_article\" tabindex=2 align=right value='".$int_amount_packed_article."' CLASS=\"form\">\n";
        echo " Box ".ChoseNumberBox("box_no", $int_max_box, $int_box_no, TRUE, 3);
        echo " <INPUT TYPE=\"submit\" NAME=\"add\" tabindex=4 CLASS=\"form\" value=\"add\"></td><td>\n";
		// Set cursor on the artikel name field.		  
		echo '<script TYPE="text/javascript" language="JavaScript">document.softform.packed_article.focus();</script>';
    }
    echo "<INPUT TYPE=\"submit\" NAME=\"finished\" VALUE=\"Klaar\">\n";
    echo "     </td></TR>\n";
    echo "</table>";
    
    // Test if there are not to much products in the shipment
    if ($int_products_retour) {
        echo "Terug te leggen productID: <INPUT TYPE=\"text\" NAME=\"packed_article\" CLASS=\"form\"' TABINDEX=2>\n";
        echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "packed_article", "softform.packed_article");
		// When the amount is not set, set it to default 1.
		$int_amount_packed_article = $int_amount_packed_article ? $int_amount_packed_article : 1;
        echo "           x <INPUT TYPE=\"text\" size=\"1\" NAME=\"amount_packed_article\" value='".$int_amount_packed_article."' CLASS=\"form\">\n";
        echo "          <INPUT TYPE=\"submit\" NAME=\"add\" CLASS=\"form\" value=\"Terug\">\n";
    } else {
        // get product from tabel current_product_list
        $orderdetail_sql = SQL_openorderdetails . " WHERE order_details.to_deliver <> 0
          AND " . openordedetails_condition . " AND orders.ShipID= '$objshipment->AdresID' AND (rma_yn <> 1 or isnull(rma_yn)) 
          AND order_details.ProductID = '$int_productid'";

        $orderdetail_query = $db_iwex->query($orderdetail_sql);
        //echo $orderdetail_sql;
        
        echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n";
        echo '  <TD VALIGN="top" width="50%">'."\n";
        echo '      <table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
            .'          <tr>'
            ."              <td colspan=9 bgcolor=red align=center><b>Producten die bij product $int_productid horen</b></td>"
            .'          </tr>'
            .'          <tr>'
            .'              <th><SMALL>besteld</SMALL></th>'
            .'              <th><SMALL>Voorraad</SMALL></th>'
            .'              <th>ProductID</th>'
            .'              <th>Productnaam</th>'
            .'              <th>#</th>'
            .'          </tr>';
    
    
        if ($objorderdetail = mysql_fetch_object($orderdetail_query)) {
            foreach ($ary_multi as $ary_parts) {
                echo '          <tr>'."\n"
                    .'              <td align="right"><SMALL>'.$objorderdetail->Quantity * $ary_parts["aantal"].'</SMALL></td>'
                    .'              <td align="right"><SMALL>'.$ary_parts["stock"].'<SMALL></td>'
                    .'              <td><A HREF="order.php?orderID='.$objorderdetail->OrderID.' target=_new">'.$ary_parts["Product_ids"].'</A></td>'
                    .'              <td>'.$ary_parts["ProductName"].'</td>'
                    .'              <td align="right"><b>'.($objorderdetail->to_deliver * $ary_parts["aantal"] -
                    // Substract the products that are already in the temp table.
                    GetField("SELECT sum(UnitsSold) AS UnitsSold 
                              FROM temp_inv_transactions
                              WHERE ProductID = '".$ary_parts["Product_ids"]."' 
                                  AND  orderdetailsID = '$objorderdetail->OrderDetailsID'"))
                    .'</b></td>'
                   ."\n".'      </tr>';
            }
        }
        mysql_free_result($orderdetail_query);
        
        echo '      </TABLE>'."\n";
        echo '  </TD>'."\n";
        echo '  <TD VALIGN="top" width="50%">'."\n";
    
    
        // get inventory transactions for this shipment
        $ship_sql = "SELECT TransactionID, TransactionDate, temp_inv_transactions.ProductID, Description, 
            temp_inv_transactions.box_ID, box_number, OrderID, UnitPrice, sum(UnitsSold) as UnitsSold, btw_percentage, 
            Productname, OrderID, weight_corr, store_serial_yn
            FROM temp_inv_transactions
            INNER JOIN current_product_list ON current_product_list.ProductID = temp_inv_transactions.ProductID
            INNER JOIN box ON temp_inv_transactions.box_ID = box.box_ID
            WHERE ShipmentID = '".$int_shipid."'
            GROUP BY OrderID, ProductID, box_ID ORDER BY box_number";
        //echo $inventory_sql;
        $shipquery = $db_iwex->query($ship_sql);
    
        echo '<table  border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
            .'  <tr>'
            ."      <td colspan=5 bgcolor=red align=center><b>Producten die reeds ingepakt zijn voor product $int_productid</b></td>"
            .'  </tr>'
            .'  <tr>'
            .'      <th>order</th>'
            .'      <th>#</th>'
            .'      <th>ProductID</th>'
            .'      <th>Productnaam</th>'
            .'      <th>Box</th>'
            .'</tr>';
    
        $int_sum_of_products = 0;
        $flt_weight_of_shipment = 0;
        while ($objinventory = mysql_fetch_object($shipquery)) {
            echo "<tr>\n
				<TD><A HREF='order.php?orderID=$objinventory->OrderID'>$objinventory->OrderID</A></TD>\n
				<td align=right><b>$objinventory->UnitsSold</b></td>\n";
            echo "		<td align=right>$objinventory->ProductID</td>\n";
            echo "		<td>$objinventory->Productname";
            if ($objinventory->store_serial_yn) {
                echo " <a href='".docroot."/includes/store_serial_number.php?transid=-$objinventory->TransactionID&close=0' target='_new'>(SN)</a>";
            }
            echo "\n</td><td align=right>";
            echo $objinventory->box_number;
            echo "</td>\n</tr>\n";
        }
        mysql_free_result($shipquery);
        echo "</table><input type=hidden name=max_box value=$int_max_box>";
    }
} else {
    echo "<h2>Geen gegevens meegegeven.</h2>";
}
echo "</FORM>\n";

printenddoc();

?>
