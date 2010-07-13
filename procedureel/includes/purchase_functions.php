<?php
// DB id fields defines.
// sample: define('GETRECORDSEARCH','recordsearchvar');

define ('SQL_SEARCH_PO_LIST', "SELECT PurchaseOrderID "
    ." FROM purchase_orders "
    ." WHERE PurchaseOrderID LIKE '%".GETRECORDSEARCH."%' ");

define ('SQL_PO_DETAIL_QUERY', 'SELECT po_details.*, current_product_list.ProductName, current_product_list.ExternalID 
        FROM  po_details
        LEFT JOIN current_product_list ON po_details.ProductID = current_product_list.ProductID');
define ('SQL_INVENTORY_PO_DETAIL_QUERY', 'SELECT inventory_transactions.*, 
        CONCAT_WS(" ", employees.FirstName, employees.middlename, employees.LastName) AS EmployeeName
        FROM  inventory_transactions
        LEFT JOIN current_product_list ON inventory_transactions.ProductID = current_product_list.ProductID
        LEFT JOIN employees ON inventory_transactions.employee = employees.EmployeeID');


/*********************************************************
 * Function     : getpurchaseprice
 * Will return the lowest price between the one last paid 
 * and the Purchase_price.
 * Input        : ProductID: The id of the product.
 * Returns      : decimal value of the price
 *********************************************************/
Function getpurchaseprice(	$int_ProductID,
    $int_number='1')
{
// init vars
  global $db_iwex;

  if ($int_ProductID)
  {
    $price = 0;
    /*    @param   $int_productid
 *    @param   $int_stuks
 *    @param   $int_contactID='' 0 when not special, else customer id when this price is special for this customer.
 *    @param   $str_date
 *    @param   $int_type = PRICING_TYPE_SALE,
 *    @param   $int_stock_owner = OWN_COMPANYID
 *    @param   $int_currencyid = DB_CURRENCY_DEFAULT
*/

    $purchase_price = GetSpecialProductPrice(
        $int_ProductID,
        $int_number,
        0,
        date("Y-m-d"),
        PRICING_TYPE_PURCHASING);

    $sql_getlastprice = "SELECT UnitPrice
			FROM po_details
            WHERE po_details.ProductID = '$int_ProductID' 
            ORDER BY UnitPrice ASC LIMIT 1";
    $last_price = $db_iwex->query($sql_getlastprice);
    $obj_last_price = $db_iwex->fetch_object($last_price);
    $last_price = isset($obj_last_price->UnitPrice) ? $obj_last_price->UnitPrice : FALSE;

    if ($purchase_price||$last_price)
    {
      $price = ($purchase_price < $last_price) && $last_price
          ? $purchase_price : $last_price;
    }
  } else
  {
    echo "Functie getpurchaseprice aangeroepen zonder ProductID";
  }
  return $price;
} 

/*********************************************************
 * Function     : getpo_bo
 * to lookup if products are already on order
 * Input        : queryres: will contain the array
                     ProductID: The id of the product.
                     bl_sum: to sum the result or leave it separate
 * Returns      : an array of poID, podate and to_deliver amount 
 *********************************************************/
Function getpo_bo($queryres,$int_ProductID,$bl_sum)
{
  $returnvalue = FALSE;
  // init vars
  if ($int_ProductID)
  {
    $sql_po_bo = "SELECT po_details.poID, po_details.podate, po_details.ProductID, current_product_list.ProductName,
                        PO_sent, ";
    if ($bl_sum)
    {
      $sql_po_bo .= "sum(po_details.to_deliver) as to_deliver";
    } else
    {
      $sql_po_bo .= "po_details.to_deliver";
    }
    $sql_po_bo .= "  FROM po_details
            INNER JOIN purchase_orders ON po_details.poID = purchase_orders.PurchaseOrderID
            LEFT JOIN current_product_list ON po_details.ProductID = current_product_list.ProductID
            WHERE po_details.ProductID = $int_ProductID AND to_deliver";
    if ($bl_sum) $sql_po_bo .= " GROUP BY po_details.to_deliver";
    $sql_po_bo .= " ORDER BY po_details.poID";
    //echo $sql_po_bo;
    $queryres = mysql_query($sql_po_bo)
        or die("Invalid sql_po_bo: " . mysql_error());
    if (mysql_num_rows($queryres)) $returnvalue = TRUE;
  } else
  {
    echo "Function getpo_bo called without a parameter";
  }
  return $returnvalue;
} 

/*********************************************************
 * Function     : printpo_bo
 * to lookup if products are already on order and print them (uses getpo_bo)
 * Input        : ProductID: The id of the product.
 * Returns      : returns the string containing the po numbers with amount to_deliver
 *********************************************************/
Function printpo_bo($int_ProductID,&$string = NULL)
{
  $to_deliver_string = '-';
  $total_in_bo = 0;
  if (getpo_bo(&$po_boresult,$int_ProductID,FALSE))
  {
    $to_deliver_string = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
    while ($obj = (mysql_fetch_object($po_boresult)))
    {
      if ($obj->PO_sent)
      {
        $bgcolor = "#00FF00";
        $total_in_bo += $obj->to_deliver;
      } else
      {
        $bgcolor = "#FF0000";
      }
      $to_deliver_string .= "<TR>\n<TD class=\"celllinesmall\">" . $obj->to_deliver . "x</TD>
            <TD class=\"celllinesmall\" BGCOLOR='$bgcolor'>PO: <A HREF=purchase_maint.php?purchaseorderID=$obj->poID TARGET=new>" . $obj->poID . "</A></TD>\n</TR>\n";
    }
    $to_deliver_string .= "</table>\n";
  }
  $string = $to_deliver_string;
  Return $total_in_bo;
}

/*********************************************************
 * Function     : print_backorder_Purchase
 * to lookup all products that are already on order
 * Input        : ProductID: The id of the product.
 * Returns      : returns the string containing the po numbers with amount to_deliver
 *********************************************************/
Function print_backorder_Purchase($int_supplierID, $int_current_poID='', $ch_format='html', $buyer=OWN_COMAPNYID)
{
  $str_return = '';
  // Create a query to make the backorderlist.
  $sql_po_backorder = "SELECT po_details.poID, po_details.ProductID, po_details.quantity, po_details.to_deliver, po_details.unitprice,
        current_product_list.ProductName, current_product_list.ExternalID, purchase_orders.OrderDate, purchase_orders.buyer_contactID
        FROM po_details
        INNER JOIN purchase_orders ON po_details.poID = purchase_orders.PurchaseOrderID
        INNER JOIN current_product_list ON current_product_list.ProductID = po_details.ProductID
        WHERE to_deliver > 0 AND purchase_orders.SupplierID = '$int_supplierID' AND po_details.poID <> '$int_current_poID'
            AND purchase_orders.buyer_contactID = '$buyer'
        ORDER BY purchase_orders.PurchaseOrderID, po_details.ProductID";

  //echo $sql_po_backorder;
  $query_po_backorder = mysql_query($sql_po_backorder)
      or die("Ongeldige sql_purchase_list query: " .$sql_po_backorder. mysql_error());
  $last_poID = 0;
  $bl_title = FALSE;
  while ($obj = (mysql_fetch_object($query_po_backorder)))
  {
    if ($ch_format==FORMAT_ASCI)
    {
      if (!$bl_title) $str_return .= "\n-------------------\nBackorderlist\n-------------------";
      if (!($last_poID == $obj->poID)) $str_return .= "\n# PO " . $obj->poID . " #\n";
      $str_return .= $obj->ExternalID . " (" . $obj->ProductID . ") x " .
          $obj->to_deliver . " price: " . $obj->unitprice . "\n";
    } else if ($ch_format==FORMAT_HTML)
      {
        if (!$bl_title) $str_return .= "<table width=\"100%\" border=\"0\">\n
                    <tr>\n
                    <td colspan=6><b>Backorderlist</b></td>
                    </tr>\n
                    <tr><th>PO number</th><th>date</th><th>Product</th><th>Name</th><th>Ordered</th><th>Backorder</th></tr>";
        $str_return .= "<tr><td>$obj->poID</td><td>".date("d-m-Y",strtotime($obj->OrderDate))."</td><td>$obj->ExternalID</td><td>$obj->ProductName</td><td><small>$obj->quantity</small></td><td><b>$obj->to_deliver</b></td></tr>";
      }
    $last_poID = $obj->poID;
    $bl_title = TRUE;
  }
  if ($ch_format == FORMAT_HTML) $str_return .= "</table>";
  return $str_return;
}

/*********************************************************
 * Function     : upd_po_status
 * when an article from an order is shipped update the status that specific order
 * Input        : int_poID
 * Returns		: true or false
 * *******************************************************/
Function upd_po_status($int_poID)
{
  $bl_return_var = FALSE;
  if ($int_poID)
  {
    $sql_porder = "SELECT podetailsID, poID, sum(quantity) as quantity, sum(to_deliver) as to_deliver FROM
            po_details
            WHERE poID = '$int_poID' 
            GROUP BY poID;";
    //echo $sql_porder;
    $query_porder = mysql_query($sql_porder)
        or die("Ongeldige query: " .$sql_porder. mysql_error());
    if ($obj = mysql_fetch_object($query_porder))
    { //when there are still to_deliver items don't complete
      if ($obj->quantity == $obj->to_deliver&&$obj->quantity)
      { // when nothing has been delivered...but has been ordered - open
      // do not lock Order record
        $sql_lockpo = "UPDATE purchase_orders SET
                    status = '1'
        			WHERE PurchaseOrderID = $int_poID ";
        if ($query_lockpo = mysql_query($sql_lockpo))
        {
          $bl_return_var = TRUE;
        //                    echo "order UNlocked";
        } else
        {
          echo "Ongeldige query: " . $sql_lockpo . mysql_error();
        }
      } else if ($obj->to_deliver==0)
        { //when all has been delivered colsed
          $sql_completepo = "UPDATE purchase_orders SET
                   status = '3'
       			   WHERE PurchaseOrderID = $int_poID ";
          if ($query_completepo = mysql_query($sql_completepo))
          {
            $bl_return_var = TRUE;
          //                    echo "order complete";
          } else
          {
            echo "Ongeldige query: " . $sql_completepo . mysql_error();
          }
        } else if ($obj->quantity > $obj->to_deliver)
          { // when something has been delivered... partial
          // lock Order record
            $sql_lockpo = "UPDATE purchase_orders SET
                    status = '2'
        			WHERE PurchaseOrderID = $int_poID ";
            if ($query_lockpo = mysql_query($sql_lockpo))
            {
              $bl_return_var = TRUE;
            //                    echo "order locked";
            } else
            {
              echo "Ongeldige query: " . $sql_lockpo . mysql_error();
            }
          } else
          {
          // make other status
            $sql_lockpo = "UPDATE purchase_orders SET
                    status = '4'
        			WHERE PurchaseOrderID = $int_poID ";
            if ($query_lockpo = mysql_query($sql_lockpo))
            {
              $bl_return_var = TRUE;
            //                    echo "order UNlocked";
            } else
            {
              echo "Ongeldige query: " . $sql_lockpo . mysql_error();
            }
          }
    } else
    {

      $sql_completepo = "UPDATE purchase_orders SET
           status = '1'
           WHERE PurchaseOrderID = $int_poID ";
      if ($query_completepo = mysql_query($sql_completepo))
      {
        $bl_return_var = TRUE;
      //                    echo "order complete";
      } else
      {
        echo "Ongeldige query: " . $upd_po_status . mysql_error();
      }
    }
  } else
  {
    echo "Function upd_po_status called without a parameter";
  }
  return $bl_return_var;
}

/*********************************************************
 * Function     : GetOpenPo
 * Find or when not find make an open purchase order.
 * Input        : $int_supplier, the supplier id
 * Returns      : The purchase order number. 
 *********************************************************/
Function GetOpenPo($int_supplier)
{
  $int_po_num = FALSE;
  // init vars
  if ($int_supplier)
  {
    $int_po_num = GetField("SELECT PurchaseOrderID
                FROM purchase_orders 
                WHERE SupplierID = $int_supplier AND PO_sent IS NULL AND status = 1
                ORDER BY PurchaseOrderID DESC");
    echo "PO number is $int_po_num for supplier $int_supplier<br>";

    // When there is no PO number insert one.
    if (!$int_po_num)
    {
      $sql_insert_po = "INSERT INTO purchase_orders
                              SET PurchaseOrderDescription = 'Generated PO', 
                                    OrderDate = '".date("Y-m-d")."',
                                    SupplierID = $int_supplier";
      $query = mysql_query($sql_insert_po)
          or die("Invalid sql openpo: " . mysql_error());
      $int_po_num = mysql_insert_id();
    }
  } else
  {
    echo "Function GetOpenPo called without a parameter.<br>";
  }
  return $int_po_num;
} 

/*********************************************************
 * Function     : OrderProduct
 * Will add the products to an order.
 * Input        : $int_productid, Product id to add
 *                $int_amount, number of products to add
 * Returns      : None. 
 *********************************************************/
function OrderProduct($int_productid,
    $int_amount)
{

  $int_supplier = GetSupplier($int_productid);
  //echo "Order product $int_amount x $int_productid<br>";
  if ($int_supplier)
  {
    $int_po_id = GetOpenPo($int_supplier);
    if ($int_po_id)
    {
      $sql_insert_podetail = "INSERT INTO po_details SET
                        poID = '$int_po_id',
                        productID =  '$int_productid',
                        unitprice =  '".getpurchaseprice($int_productid)."',
                        quantity =  '$int_amount',
                        to_deliver =  '$int_amount'";
      $query = mysql_query($sql_insert_podetail)
          or die("Invalid sql orderproduct: " . mysql_error());
    } else
    {
      echo "Geen PO nummer to insert<br>";
    }
  } else
  {
    echo "<h2>Geen supplier id voor product $int_productid</h2>";
  }
}

/*********************************************************
 * Function     : ShowPoDetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_poID, The id of the purchaseorder
 *                bl_edit, edit or not
 *                int_supplier_id, id of the supplier
 * Returns      : A complete formatted string that contains the person information.
 *********************************************************/
function ShowPoDetails($bl_submit, 
    $int_poID,
    $bl_edit,
    $int_supplier_id = FALSE,
    $int_currencyid = FALSE)
{
  $str_return = '';
  $DB_iwex = new DB();
  $all_open_POs = FALSE;
  if ($int_supplier_id
      &&
      !$int_poID) $all_open_POs = TRUE;
  if ($all_open_POs)
  {
    $sql_po_details = SQL_PO_DETAIL_QUERY
        ." INNER JOIN purchase_orders ON PurchaseOrderID = poID"
        ." WHERE SupplierID = '$int_supplier_id' AND to_deliver ORDER BY last_exp ASC, poID ASC, podetailsID ASC";
  } else
  {
    $sql_po_details = SQL_PO_DETAIL_QUERY . " WHERE poID = '$int_poID' ORDER BY podetailsID DESC";
  }
  if ($bl_submit)
  {

  // Create a query to select the adresses.
    $qry_select_podetails = $DB_iwex->query($sql_po_details);

    while ($obj_update = mysql_fetch_object($qry_select_podetails))
    {
      if (isset($_POST["quantity$obj_update->podetailsID"])
          &&
          $_POST["quantity$obj_update->podetailsID"]
          &&
          $bl_edit)
      {

      // Quantity check
        $int_updquantity = Getproductqty($_POST["productID$obj_update->podetailsID"],
            $_POST["quantity$obj_update->podetailsID"],
            PRICING_TYPE_PURCHASING);
        $int_updtodeliver = Getproductqty($_POST["productID$obj_update->podetailsID"],
            $_POST["to_deliver$obj_update->podetailsID"],
            PRICING_TYPE_PURCHASING);

        $sql_update_podetails = "UPDATE po_details SET
                productID =  '".$_POST["productID$obj_update->podetailsID"]."',
                unitprice =  '".$_POST["unitprice$obj_update->podetailsID"]."',
                quantity =  '".$int_updquantity."',
                to_deliver =  '".$int_updtodeliver."',
                tax_percentage =  '".$_POST["tax_percentage$obj_update->podetailsID"]."',
                added_cost =  '".$_POST["added_cost$obj_update->podetailsID"]."',
                last_exp = ".insertDate($_POST["last_exp$obj_update->podetailsID"]).",
                comments = '".$_POST["comments$obj_update->podetailsID"]."'
                WHERE podetailsID = '".$obj_update->podetailsID."'";
        //echo $sql_update_podetails.'<br>';
        $DB_iwex->query($sql_update_podetails);
      } else if (isset($_POST["quantity$obj_update->podetailsID"])
            &&
            $_POST["quantity$obj_update->podetailsID"]==0
            &&
            $bl_edit)
        {
          $sql_del_podetail = "DELETE FROM po_details
                    WHERE podetailsID = '".$obj_update->podetailsID."'";
          //echo $sql_del_podetail.'<br>';
          $DB_iwex->query($sql_del_podetail);
        } else
        {
        // first update the PO details record
          $sql_update_lastexp = "UPDATE po_details SET
					last_exp =  '".$_POST["last_exp$obj_update->podetailsID"]."'
					WHERE podetailsID = '".$obj_update->podetailsID."'";
          //echo $sql_update_lastexp.'<br>';
          $DB_iwex->query($sql_update_lastexp);
          if (($_POST["last_exp$obj_update->podetailsID"] <> "0000-00-00"
              &&
              strtotime($_POST["last_exp$obj_update->podetailsID"]) < strtotime($earliest_date[$obj_update->productID]))
              ||
              (!isset($earliest_date[$obj_update->productID])
              ||
              $earliest_date[$obj_update->productID] == "0000-00-00"))
          {
            $date = $_POST["last_exp$obj_update->podetailsID"];
          } else
          {
            $date = $earliest_date[$obj_update->productID];
          }
          $earliest_date[$obj_update->productID] = $date;

        }
    }
    //echo "<PRE>";
    //print_r($earliest_date);
    //echo "</PRE>";
    // update current_product_list with earliest date
    foreach($earliest_date as $prod_ID => $date)
    {
      $sql_update = "UPDATE current_product_list SET
							last_exp =  '$date'
							WHERE ProductID = '$prod_ID'";							
      "<br>";
      $DB_iwex->query($sql_update);
    }
    mysql_free_result($qry_select_podetails);

    if (isset($_POST["productIDNew"])
        &&
        $_POST["productIDNew"])
    {
      !$_POST["quantityNew"] ? $_POST["quantityNew"]=1 : FALSE ;

      // Quantity check
      $int_recalquantity = Getproductqty($_POST["productIDNew"],
          $_POST["quantityNew"],
          PRICING_TYPE_PURCHASING);

      //When new records have been added, insert these first
      $sql_insert_podetail = "INSERT INTO po_details SET
                poID = '$int_poID',
                productID =  '".$_POST["productIDNew"]."',
                comments =  '".$_POST["commentsNew"]."',
                unitprice =  '" . GetSpecialProductPrice(
          $_POST["productIDNew"],
          $_POST["quantityNew"],
          $int_supplier_id,
          date_create(),
          PRICING_TYPE_PURCHASING,
          OWN_COMPANYID,
          $int_currencyid) . "',
                quantity =  '".$int_recalquantity."',
                to_deliver =  '".$int_recalquantity."'";
      $DB_iwex->query($sql_insert_podetail);
    }
  } // End update


  //echo '<br><br>'.$sql_po_details;
  // Get the data.
  $qry_select_po_details = $DB_iwex->query($sql_po_details);

  $str_return .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\" class=\"blockbody\">\n";
  $str_return .= "<tr>\n";
  if ($all_open_POs) $str_return .= "<th>PO ID</th>\n";
  $str_return .= "<th>ID</th><th>External ID</th><th>Naam</th><th>notes</th><th>Besteld</th><th>Openstaand</th><th>Prijs</th><th>Min qty</th>";
  $str_return .= "<th>Subtotaal</th><th>btw%</th><th>cost</th><th>Expected</th>\n</tr>";
  // <th>invoice</th><th>delivered</th>\n</tr>";

  if ($bl_edit)
  {  // always display a new empty detail record at the bottom
    $str_return .= "<tr>\n";
    if ($all_open_POs) $str_return .= "<td></td>\n";
    $str_return .= "<td><input size=\"5\" name=\"productIDNew\" type=\"text\"></td>\n";
    $str_return .= "<td COLSPAN=2>"
        .GetRecordIdInputField(SQL_SEARCH_PRODUCTS_LIST, "ID", "Productsearch", "po_maint.productIDNew", "Product", 50, "", 3)."</TD>";
    $str_return .= "<td><input size=\"5\" name=\"commentsNew\" type=\"text\"></td>\n";
    $str_return .= "<td><input size=\"5\" name=\"quantityNew\" type=\"text\"></td>\n";
    $str_return .= "<td></td>\n";
    $str_return .= "<td><input size=\"5\" name=\"unitpriceNew\" type=\"text\"></td>\n";
    $str_return .= "<td></td>\n";
    $str_return .= "<td></td>\n";
    $str_return .= "<td></td>\n";
    $str_return .= "</tr>\n";
  }
  while ($obj_po_detail = mysql_fetch_object($qry_select_po_details))
  {

    $int_minquantity = Getproductqty($obj_po_detail->productID,
        0,
        PRICING_TYPE_PURCHASING);

    $str_return .= "<tr>\n";
    if ($all_open_POs) $str_return .= "<td>".($obj_po_detail->poID ?
          "<a target=_new href='purchase_maint.php?purchaseorderID=$obj_po_detail->poID'>$obj_po_detail->poID</a>"
          : "-")
          ."</td>\n";
    if ($bl_edit)
    {
      $str_return .= "<td class=\"cellinesmall\"><input name=\"podetailsID\" type=\"hidden\" value=\"$obj_po_detail->podetailsID\">\n";
      $str_return .= "<input size=\"5\" name=\"productID$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->productID\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\">$obj_po_detail->ExternalID</td>\n";
      $str_return .= "<td class=\"cellinesmall\">$obj_po_detail->ProductName</td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"6\" name=\"comments$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->comments\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"6\" name=\"quantity$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->quantity\" onchange=\"to_deliver$obj_po_detail->podetailsID.value = quantity$obj_po_detail->podetailsID.value\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"6\" name=\"to_deliver$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->to_deliver\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"8\" name=\"unitprice$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->unitprice\"></td>\n";
      $str_return .= "<td>$int_minquantity</td>\n";
      $str_return .= "<td class=\"cellinesmall\">".$obj_po_detail->quantity*$obj_po_detail->unitprice."</td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"5\" name=\"tax_percentage$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->tax_percentage\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"5\" name=\"added_cost$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->added_cost\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"8\" name=\"last_exp$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->last_exp\">".Add_Calendar('po_maint.last_exp'.$obj_po_detail->podetailsID)."</td>\n";
    //$str_return .= "<td class=\"cellinesmall\"><input size=\"8\" name=\"delivery_date$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->delivery_date\"></td>\n";
    } else
    {
      $str_return .= "<td class=\"cellinesmall\"><A HREF='". PRODUCT_MAINT . "?productid=$obj_po_detail->productID' TARGET=new>$obj_po_detail->productID</A></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><A HREF='". PRODUCT_MAINT . "?productid=$obj_po_detail->productID' TARGET=new>$obj_po_detail->ExternalID</A></td>\n";
      $str_return .= "<td class=\"cellinesmall\">$obj_po_detail->ProductName" . ShowImage($obj_po_detail->productID,30) . "</td>\n";
      $str_return .= "<td class=\"cellinesmall\">$obj_po_detail->comments</td>\n";
      $str_return .= "<td class=\"cellinesmall\" ALIGN=right>$obj_po_detail->quantity</td>\n";
      $str_return .= "<td class=\"cellinesmall\" ALIGN=right>$obj_po_detail->to_deliver";
      $str_return .= "<input size=\"8\" name=\"receive$obj_po_detail->podetailsID\" type=\"button\" value=\"+\"
                onClick=\"window.open('receive_popup.php?podetailsID=$obj_po_detail->podetailsID','Receive_$obj_po_detail->productID','toolbar=0,menubar=0,resizable=0,scrollbars=0,dependent=0,status=0,width=300,height=200,left=25,top=25');\">";
      $str_return .= "</td>\n";
      $str_return .= "<td class=\"cellinesmall\" ALIGN=right>".ToDutchNumber($obj_po_detail->unitprice)."</td>\n";
      $str_return .= "<td class=\"cellinesmall\" ALIGN=right>".ToDutchNumber($obj_po_detail->quantity*$obj_po_detail->unitprice)."</td>\n";
      $str_return .= "<td class=\"cellinesmall\" ALIGN=right>$obj_po_detail->tax_percentage</td>\n";
      $str_return .= "<td class=\"cellinesmall\" ALIGN=right>$obj_po_detail->added_cost</td>\n";
      //$str_return .= "<td class=\"cellinesmall\"><input size=\"7\" name=\"invoice$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->invoice\"></td>\n";
      $str_return .= "<td class=\"cellinesmall\"><input size=\"8\" name=\"last_exp$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->last_exp\">".Add_Calendar('po_maint.last_exp'.$obj_po_detail->podetailsID)."</td>\n";
    //$str_return .= "<td class=\"cellinesmall\"><input size=\"8\" name=\"delivery_date$obj_po_detail->podetailsID\" type=\"text\" value=\"$obj_po_detail->delivery_date\"></td>\n";
    }
    $str_return .= "</tr>\n";
    $str_return .= "<tr>\n<TD COLSPAN=12>";
    $str_return .= ShowInventoryPODetails($bl_submit, $obj_po_detail->podetailsID, $bl_edit);
    $str_return .= "</TD>\n</tr>\n";
  }

  $str_return .= "</TABLE>\n";

  mysql_free_result($qry_select_po_details);

  return $str_return;
}



?>