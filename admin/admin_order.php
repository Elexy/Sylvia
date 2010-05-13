<?php

/**
 * admin_order.php
 *
 * @version $Id: admin_order.php,v 1.17 2007-03-16 13:27:45 iwan Exp $
 * @copyright $date:
 **/

$_GLOBAL["str_backdir"] = '../';

include ($_GLOBAL["str_backdir"]."include.php");

// Get all the URL variable we need.
$bl_afdruk = isset($_POST["afdruk"]) ? TRUE : FALSE;
$bl_submit = isset($_POST["submit"]) ? TRUE : FALSE;
$bl_new_order = isset($_POST["new_order"]) ? TRUE : FALSE;
$bl_new_order = (isset($_GET["new_order"]) && !isset($_POST["new_order"])) ? TRUE : $bl_new_order;
$int_orderID = isset($_POST["orderID"]) ? $_POST["orderID"] : FALSE;
$int_orderID = (isset($_GET["orderID"]) && !isset($_POST["orderID"])) ? $_GET["orderID"] : $int_orderID;
$int_contactID = isset($_POST["ContactID"]) ? $_POST["ContactID"] : FALSE;
$int_contactID = (isset($_GET["contactID"]) && !isset($_POST["contactID"])) ? $_GET["contactID"] : $int_contactID;
$bl_print = isset($_POST["print"]) ? TRUE : FALSE;
$bl_locked = isset($_POST["locked"]) ? TRUE : FALSE;
$bl_in_one_delvery = isset($_POST["in_one_delvery"]);
$bl_consignment_order = isset($_POST["consignment_order"]);
$bl_locked_hidden = isset($_POST["locked_hidden"]) ? $_POST["locked_hidden"] : FALSE;
$int_factuur = isset($_POST["factuur"]) ? $_POST["factuur"] : INVALID;
$int_update_no = isset($_POST["update_no"]) ? $_POST["update_no"] : 0; // Number of pressed updates.
$int_ordercosts = isset($_POST["Ordercost"]) ? $_POST["Ordercost"] : 0;
$int_xp_no = isset($_REQUEST['xp_no']) ? $_REQUEST['xp_no'] : FALSE; // XeoPort e-mail number
$int_transportcosts = isset($_POST["Transportcost"]) ? $_POST["Transportcost"] : 0;
$bl_manordercosts = isset($_POST["manorder"]);
$bl_mantranscosts = isset($_POST["mantransorder"]);
//$flt_total = isset($_POST["flt_totalcost"]) ? $_POST["flt_totalcost"] : 0;

//search fields
$int_ID = isset($_POST["ID"]) ?$_POST["ID"] : FALSE;
$str_OrderDate = isset($_POST["OrderDate"]) ?$_POST["OrderDate"] : FALSE;
$str_ContactsOrderID = isset($_POST["ContactsOrderID"]) ? $_POST["ContactsOrderID"] : FALSE;
$select_confirmed = isset($_POST["select_confirmed"]) ? $_POST["select_confirmed"] : '';
$select_locked = isset($_POST["select_locked"]) ? $_POST["select_locked"] : '';
$select_complete = isset($_POST["select_complete"]) ? $_POST["select_complete"] : '';

if (!isset($_SESSION["update_no"]))
{
  $_SESSION["update_no"] = INVALID;
}

$int_sesion_update_no = $_SESSION["update_no"]+1;

if (isset($_POST["ContactIDold"]))
{
  $bl_customer_changed = $_POST["ContactIDold"] != $int_contactID;
} else
{
  $bl_customer_changed = FALSE;
}

$flt_ordercost = 0;
$flt_productcost = 0;
$flt_vatamount = 0;
$int_sum_units = 0;
$bgcolor="#FFABA9";

define ('SQL_ORDER_QUERY',
    'SELECT contacts.ContactID, contacts.CompanyName, contacts.Address, contacts.PostalCode'
    . ', contacts.City, contacts.Country, contacts.languageID ,contacts.pricelevel, contacts.Paymentterm,
					 contacts.btw_number, contacts.use_btw'
    . ', contacts.ordercosts AS ordercostYN, contacts.transportcost AS transportcostYN'
    . ', orders.OrderID, orders.Btw_YN, orders.ShipID, orders.ShipName, orders.ShipAddress, orders.ShipCity'
    . ', orders.ShipPostalCode, orders.ShipCountry, orders.ContactsOrderID, orders.Locked_yn, orders.Trackingnummer'
    . ', orders.OrderDate, orders.ShippedDate, orders.confirmed_yn, orders.Price_level, orders.Complete_yn '
    . ', orders.Transportcosts, orders.Ordercosts, orders.manual_transportcosts, orders.manual_ordercosts, orders.Comments, contacts.email'
    . ', invoices.InvoiceID, invoices.Invoice_date, orders.paymentterm_yn, orders.in_one_delivery_yn, orders.consignment_order'
    . ', orders.xp_no, employee, warehouse_customer, orders.administration_order'
    . ', CONCAT_WS(" ", employees.FirstName, employees.middlename, employees.LastName) AS EmployeeName'
    . ', Adressen.straat, Adressen.huisnummer, Adressen.postcode, Adressen.plaats, Adressen.land, orders.rma_yn'
    . ' FROM orders LEFT JOIN contacts ON orders.ContactID = contacts.ContactID'
    . ' LEFT JOIN employees ON orders.employee = employees.EmployeeID'
    . ' LEFT JOIN invoices ON invoices.orderID = orders.OrderID'
    . ' LEFT JOIN Adressen ON contacts.ContactID = Adressen.ContactID AND adrestitel <= 4 '
    . ' WHERE orders.administration_order = 1 AND orders.OrderID =');

// Print default Iwex HTML header.
printheader (COMPANYNAME . " order screen", "orders", !$bl_print);


if ($bl_print)
{
  echo "<body onLoad=\"print();location.replace('".$_SERVER['PHP_SELF']."?orderID=$int_orderID');\">\n";
} else
{
  echo "<body ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"orderform\" onSubmit=\"return checkData()\">\n";
  printIwexNav();
  $int_temp_num = $int_update_no+1;
  ?>
<SCRIPT>
  var dataOK=false
  function checkData (){
  <?
  if ($bl_submit || $bl_new_order || $int_orderID)
  {
    echo "if ((document.orderform.ProductIDNew$int_temp_num.value)
                ||
              (document.orderform.ProductIDNew$int_temp_num.value == '' && document.orderform.ProductnameNew$int_temp_num.value == '')){";
    ?>
    if (document.orderform.ContactsOrderID.value == '') return confirm('A.u.b. een Referentie opgeven!')
    else return true;
  }
  else {
    return false;
  }
  <?
  } else
  {
    echo "return true;\n";
  }
  ?>
}
</SCRIPT>
  <?
  unset ($int_temp_num);
  // Used for calendar function.
  echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
}

if ($bl_submit || $bl_new_order || $int_orderID && !$bl_print)
{
  if ($bl_submit && ($_SESSION["update_no"] < $int_update_no))
  {
    $str_OrderDate = $_POST["OrderDate"];
    $bl_confirmed = isset($_POST["confirmed"]) ? $_POST["confirmed"] : 0;
    $bl_complete = isset($_POST["complete"]) ? 1 : 0;
    //               $bl_lock_bl = isset($_POST["locked"]) ? 1 : 0;
    $bl_btw = isset($_POST["vat"]) ? -1 : 0;
    $sql_set_vars = "orders set ContactID='".$int_contactID."',
                              OrderDate=".insertDate($_POST["OrderDate"]).", ShipID='".$_POST["AdresID"]."', 
							  ContactsOrderID='".addslashes($_POST["ContactsOrderID"])."', 
							  confirmed_yn = '".$bl_confirmed."', Price_Level='".$_POST["Price_Level"]."', 
							  paymentterm_yn='".$_POST["Payment_Term"]."', 
							  Btw_YN='$bl_btw', Complete_yn = '".$bl_complete."', Locked_yn = '".$bl_locked."', 
							  manual_ordercosts = '$bl_manordercosts', manual_transportcosts='$bl_mantranscosts', 
							  Comments='".addslashes($_POST["Comments"])."', in_one_delivery_yn = '$bl_in_one_delvery', 
                              xp_no = '$int_xp_no', consignment_order = '$bl_consignment_order', 
                              administration_order = 1 ";
    if ($int_orderID)
    // update the records

    {
    // Only update when the record is not lockded
      if (!GetOrderLock($int_orderID))
      {
        $bgcolor="";

        SetOrderHistory($int_orderID, 'ContactID', $int_contactID);
        SetOrderHistory($int_orderID, 'ContactsOrderID', $_POST["ContactsOrderID"]);
        SetOrderHistory($int_orderID, 'confirmed_yn', $bl_confirmed);
        SetOrderHistory($int_orderID, 'Price_Level', $_POST["Price_Level"]);
        SetOrderHistory($int_orderID, 'paymentterm_yn', $_POST["Payment_Term"]);
        SetOrderHistory($int_orderID, 'Comments', $_POST["Comments"]);

        //echo "update order $int_orderID";
        $updmain_sql = "UPDATE ". $sql_set_vars
            ."WHERE orders.OrderID =" . $int_orderID;
        $rmadetail_update = mysql_query($updmain_sql)
            or die("Ongeldige update query: " .$updmain_sql. mysql_error());

        // When AdresID is set update the fields.
        if (isset($_POST["AdresID"]))
        {
        //Update/copy ship to information.
          $sql_set_shipadres = "SELECT Naam, attn, straat, huisnummer, postcode, plaats, land FROM Adressen WHERE AdresID = '".$_POST["AdresID"]."'";
          $qry_shipadres = $db_iwex->query($sql_set_shipadres)
          ;
          $ship_obj = mysql_fetch_object($qry_shipadres);
          $updmain_sql = "UPDATE orders SET ShipName='$ship_obj->Naam', ShipAddress='$ship_obj->straat $ship_obj->huisnummer', "
              ."ShipCity='$ship_obj->plaats', ShipPostalCode='$ship_obj->postcode', "
              ."ShipCountry='$ship_obj->land' "
              ."WHERE orders.OrderID =" . $int_orderID;
          mysql_free_result($qry_shipadres);

          $rmadetail_update = $db_iwex->query($updmain_sql);
        }
      }
    } else
    {  // when update has been pressed and there is no order yet; run insert query
    //echo "insert new order";
      $insertmain_sql = "INSERT INTO ". $sql_set_vars . ", employee='$employee_id' ";
      $order_insert = mysql_query($insertmain_sql)
          or die("Insert query niet gelukt: " .$insertmain_sql. mysql_error());
      $last_orderid = MYSQL_QUERY('SELECT distinct LAST_INSERT_ID() FROM orders')
          or die('Ongeldige select query: SELECT distinct LAST_INSERT_ID() FROM orders'. mysql_error());
      $orderidobj = mysql_fetch_array($last_orderid, MYSQL_BOTH);
      $int_orderID = $orderidobj[0];
      mysql_free_result($last_orderid);
    }
  }

  if ($int_orderID)
  { // if there is an orderid either last new one or given one
  // Create a query to select the custom and the products to be e-mailed.
    $sql_orders_lst = SQL_ORDER_QUERY . $int_orderID;
    $orders_query = mysql_query($sql_orders_lst)
        or die("Ongeldige select orders query: " .$sql_orders_lst. mysql_error());
    $obj = mysql_fetch_object($orders_query);
  } else
  {
  // Use an invalid order id for the query.
    $obj->ContactID = 0;
  }

  if ($bl_new_order)
  {
    $obj->OrderDate = date("Y-m-d H:i"); //Set current date
    $obj->ContactID = $int_contactID;
    $obj->xp_no = $int_xp_no;
  }

  if ($obj->Locked_yn)
  {
    $bgcolor = LOCKED_BGCOLOR;
  } else
  {
    $bgcolor = "";
  }

  $_SESSION["update_no"] = $int_update_no++;

  echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
  echo "    <TR>\n";
  if ($obj->rma_yn)
  {
    if ($obj->ContactsOrderID == RMA_CREDIT_TEXT)
    {
      $rma_bgcolor = RMACREDITORDER_BGCOLOR;
    } else
    {
      $rma_bgcolor = RMAORDER_BGCOLOR;
    }
    echo "         <TD colspan='4' bgcolor=$rma_bgcolor ALIGN='CENTER'><B>RMA ADMINISTRATION ORDER ID $obj->OrderID</B></TD>\n";
  } else
  {
    echo "         <TD colspan='4' bgcolor='#33FF00'><B>ADMINISTRATION ORDER ID $obj->OrderID</B></TH>\n";
  }
  echo "    </TR>\n";
  echo "    <TR BGCOLOR=\"$bgcolor\">\n";
  echo "         <TD>Company name</TD><TD><INPUT TYPE=\"text\" TABINDEX='10' NAME=\"ContactID\" SIZE=\"3\" CLASS=\"form\" value=\"$obj->ContactID\"><INPUT TYPE=\"hidden\" NAME=\"ContactIDold\" CLASS=\"form\" value=\"$obj->ContactID\"> : ";
  //		  echo "<INPUT TYPE=\"text\" NAME=\"customername\" SIZE=\"30\" CLASS=\"form\" value=\"".$_POST["customername"]."\">";
  echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "orderform.ContactID", "cust", 30, $obj->CompanyName, 11). "
              <INPUT TYPE=\"button\" NAME=\"goto\" CLASS=\"form\" VALUE='Edit' onclick=\"location.replace('/contacts/maintain.php?custid=$obj->ContactID');\" ".
      ShowShortContactInfo($obj->ContactID)."></td>\n";
  if (!$obj->ShipID)
  {
    $obj->ShipID = GetInvoiceAdresId($int_contactID);
  }
  echo "         <TD>Ship Name</TD><TD>".makelistbox("select ContactID, AdresID, CONCAT_WS(', ', Naam, attn, plaats) AS naam from Adressen WHERE ContactID = '$obj->ContactID' ORDER BY adrestitel, naam",'AdresID','AdresID','naam',$obj->ShipID)."</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD>Factuur adres</TD><TD>$obj->straat $obj->huisnummer</TD>\n";
  echo "         <TD>Aflever adres</TD><TD>$obj->ShipAddress</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD></TD><TD>$obj->postcode $obj->plaats</TD>\n";
  echo "         <TD></TD><TD>$obj->ShipPostalCode $obj->ShipCity</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD></TD><TD>$obj->land</TD>\n";
  echo "         <TD></TD><TD>$obj->ShipCountry</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <td>Ingevoerd door:</td><td>$obj->EmployeeName</td><td>Betalingstermijn:</TD><td>\n";
  //Payment term
  // When there is no Payment term set use the one from the contacts field.
  if (!$obj->paymentterm_yn || $bl_customer_changed)
  {
    $obj->paymentterm_yn = $obj->Paymentterm;
  }

  $str_paymentterm = "";
  if ($obj->ContactID) getpaymentterm($obj->ContactID, &$str_paymentterm, "", $obj->languageID);
  // Payment term can only be set in the contact screen.
  echo "$str_paymentterm<input type=hidden name=\"Payment_Term\" value=\"$obj->paymentterm_yn\"></td>";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "		 <td>BTW</td><td><input type=\"checkbox\" name=\"vat\" ";
  if (($obj->Country == COUNTRYCODE
      ||
      $obj->ShipCountry == COUNTRYCODE
      )	&& $obj->use_btw)
  {
    $obj->Btw_YN = -1;
  }	else
  {
    $obj->Btw_YN = 0;
  }
  if ($obj->Btw_YN) echo "checked";
  echo "		 ></td>";
  echo "         <TD>Bevestigd</TD><TD>" . makelistbox("SELECT value, text FROM listbox WHERE category = 2", 'confirmed', 'value', 'text', $obj->confirmed_yn)."</TD>\n";
  echo "    </TR>\n";
  echo "         <TD>Creation date</TD><td><INPUT TYPE=\"text\" NAME=\"OrderDate\" SIZE=\"20\" CLASS=\"form\" value=\"".$obj->OrderDate."\">";
  echo 			Add_Calendar('orderform.OrderDate')."</TD>\n";
  echo "         <td>Locked</td><td><input type=\"checkbox\" name=\"locked\" DISABLED ";
  if ($obj->Locked_yn) echo "checked";
  echo "		 ></td>";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD>Referentie</TD><td><INPUT TYPE=\"text\" NAME=\"ContactsOrderID\" SIZE=\"20\" CLASS=\"form\" value=\"".$obj->ContactsOrderID."\">";
  if ($obj->xp_no)
  {
    echo " <INPUT TYPE=\"button\" NAME=\"show_mail\" VALUE=\"Van email\" onClick=\"window.open('inbox.php?op=3&id=$obj->xp_no','email',".STANDARD_WINDOW.");\">";
  }
  echo "<input type=hidden name=xp_no value='$obj->xp_no'></td>";
  if ($obj->Invoice_date)
  {
    echo "        <TD>Factuur datum</TD><td><font color='red'>$obj->Invoice_date</font></td>";
  } else
  {
    echo "		 <td></td><td></td>";
  }
  echo "    </TR>\n";
  echo "    <TR>\n";
  // When there is no pricelevel set use the one from the contacts field
  if (!$obj->Price_level || $bl_customer_changed)
  {
    $obj->Price_level = $obj->pricelevel;
  }

  echo "         <TD>Pricelevel</TD><td>".makelistbox('SELECT id, Description FROM pricelevel','Price_Level','id','Description',$obj->Price_level)."</td>";
  if ($obj->Invoice_date)
  {
    echo "        <td>Factuur nummer</td><TD><font color='red'><a href='".$_GLOBAL["str_backdir"]."orderbevesting.php?orderID=$int_orderID&format=".FORMAT_PDF."&invoice=1'>$obj->InvoiceID</a></TD>\n";
  } else
  {
    echo "		 <td></td><td></td>";
  }
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD align=\"right\">";
  echo "         <INPUT TYPE=\"hidden\" NAME=\"locked_hidden\" VALUE=\"$obj->Locked_yn\">\n";
  if (!$obj->Locked_yn)
  {
    echo "         <INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\">\n";
  }
  echo "         <INPUT TYPE=\"button\" NAME=\"orderlist\" onClick=\"location.replace('".$_SERVER['PHP_SELF']."');\" VALUE=\"Return to list\"></td>";
  echo "<td><table border=0><tr><th colspan=2>Bevestiging</th></tr>";
  echo "<tr><td><INPUT TYPE=\"button\" NAME=\"orderbevestiging\" onClick=\"window.open('".$_GLOBAL["str_backdir"]."orderbevesting.php?orderID=$int_orderID');\" VALUE=\"E-mail\"></td>\n";
  echo "<td><INPUT TYPE=\"button\" NAME=\"orderbevestigingPDF\" onClick=\"window.open('".$_GLOBAL["str_backdir"]."orderbevesting.php?orderID=$int_orderID&format=pdf');\" VALUE=\"PDF\"></td>\n";
  echo "</table></td>";
  echo "<td colspan=2>\n";

  //disable invoice button if no supervisor admin access
  $invoice_button_tag = $saccess_a ? "ENABLED" : "DISABLED";

  if (!$obj->InvoiceID
      &&
      $obj->confirmed_yn)
  {
    echo " <INPUT TYPE=\"button\" NAME=\"invoice\" $invoice_button_tag onClick=\"if (confirm('Nieuwe Factuur aanmaken?')) window.open('".$_GLOBAL["str_backdir"]."orderbevesting.php?orderID=$int_orderID&format=pdf&color=1&invoice=1','Invoice$obj->CompanyName',".STANDARD_WINDOW.");\" VALUE=\"Factuur PDF\">\n";
    echo " <INPUT TYPE=\"button\" NAME=\"proforma\" onClick=\"window.open('".$_GLOBAL["str_backdir"]."orderbevesting.php?orderID=$int_orderID&format=pdf&color=1&option=3','Proforma$obj->CompanyName',".STANDARD_WINDOW.");\" VALUE=\"Proforma PDF\">\n";
  }
  echo "		 <INPUT TYPE=\"hidden\" NAME=\"update_no\" CLASS=\"form\" value=\"$int_update_no\">";
  echo "         <INPUT TYPE=\"hidden\" NAME=\"orderID\" SIZE=\"20\" CLASS=\"form\" value=\"$int_orderID\"></TD>\n";
  echo "    </TR>\n";
  echo "</TABLE>\n";

  if (!GetOrderLock($int_orderID)
      &&
      (isset($_POST["ProductIDNew$int_sesion_update_no"])
      &&
      $_POST["ProductIDNew$int_sesion_update_no"] <> ADMIN_ORDER_FREETEXT_ARTICLE
      &&
      $_POST["ProductIDNew$int_sesion_update_no"])
      ||
      (isset($_POST["ProductNameNew$int_sesion_update_no"])
      &&
      $_POST["ProductNameNew$int_sesion_update_no"] <> ''
      &&
      $_POST["ProductIDNew$int_sesion_update_no"] == ADMIN_ORDER_FREETEXT_ARTICLE))
  {
  // When order is comfirmed by Iwex and product is added store it in the history.
    if ($obj->confirmed_yn)
    {
      SetOrderHistory($int_orderID,
          "Toegevoegd product ".$_POST["ProductIDNew$int_sesion_update_no"],
          $_POST["ProductIDNew$int_sesion_update_no"],
          0);
      // When web order is change set the user to normal user. Hereby making sure that the new pricing is used.
      if ($obj->employee == DB_WEB_EMPLOYEE)
      {
        SetOrderHistory($int_orderID, 'employee', $GLOBALS["employee_id"]);
        $db_iwex->query("UPDATE orders
                                     SET employee = '".$GLOBALS["employee_id"]."'
                                     WHERE OrderID = '$int_orderID'");
      }
    }
    $int_stock_owner = OWN_COMPANYID;
    if ($obj->warehouse_customer
        &&
        GetField("SELECT product_stock_id
                              FROM product_stock
                              WHERE Product_ID = '".$_POST["ProductIDNew$int_sesion_update_no"]."'
                                    AND
                                    owner_id = '$obj->ContactID'"))
    {
    // When customer has own stock and this products is avaible in his stock list.
    // Default use own stock product.
      $int_stock_owner = $obj->ContactID;
    }
    //When new records have been added, insert these first
    echo $_POST["ProductPriceNew$int_sesion_update_no"]<>0;
    $flt_unitprice = $_POST["ProductPriceNew$int_sesion_update_no"]<>0 ?
        $_POST["ProductPriceNew$int_sesion_update_no"] :
        GetSpecialProductPrice(
          $_POST["ProductIDNew$int_sesion_update_no"],
          $_POST["quantityNew$int_sesion_update_no"],
          $int_stock_owner,
          $str_OrderDate,
          $obj->Price_level,
          $int_contactID
        );
    $flt_extendedprice = $_POST["quantityNew$int_sesion_update_no"] * $flt_unitprice;
    //calculate discount for customer
    $flt_discount = 0;
    //get productname if not _POST["ProductIDNew$int_sesion_update_no"] = ADMIN_ORDER_FREETEXT_ARTICLE
    $prod_name = $_POST["ProductIDNew$int_sesion_update_no"] == ADMIN_ORDER_FREETEXT_ARTICLE ?
        $_POST["ProductNameNew$int_sesion_update_no"] :
        GetField("SELECT ProductName FROM current_product_list WHERE ProductID = '".$_POST["ProductIDNew$int_sesion_update_no"]."'");

    $insertqry = "INSERT INTO order_details SET Quantity='".$_POST["quantityNew$int_sesion_update_no"]."', "
        ." ProductID='".$_POST["ProductIDNew$int_sesion_update_no"]."',"
        ." ProductName='". $prod_name ."',"
        ." UnitPrice='$flt_unitprice',to_deliver='0', " // Administration orders should not be delivered.
        ." manual_price = '".GetCheckBox("manual_priceNew$int_sesion_update_no")."',"
        ." Extended_price='$flt_extendedprice',"
        ." UnitBTW = '".($obj->Btw_YN ? $flt_unitprice*GetBtwClass($_POST["ProductIDNew$int_sesion_update_no"]) :0)."',"
        ." btw_percentage = '".($obj->Btw_YN ? GetBtwClass($_POST["ProductIDNew$int_sesion_update_no"]) : 0)."',"
        ." Discount='$flt_discount',"
        ." OrderID='$int_orderID',"
        ." stock_owner_id = '$int_stock_owner'";
    $querynew = mysql_query($insertqry)
        or die('insert van de order_details niet gelukt: ' .$insertqry.' error:'. mysql_error());
  }

  // if new button has been pressed in main screen do not run query
  if (!$bl_new_order)
  {
  // Create a query to select the orderdetails.
    getorderdetails(&$qry_getorderdetails, $int_orderID);

    while ($obj_update = mysql_fetch_object($qry_getorderdetails))
    {
    // update records
    // but ignore the new line
      if (!GetOrderLock($int_orderID) // No update when locked.
          &&
          (isset($_POST["ProductID".$obj_update->OrderDetailsID])
          ||
          isset($_POST["UnitPrice".$obj_update->OrderDetailsID]))
      )
      {
      // Default stockowner in Iwex.
        $int_stock_owner = OWN_COMPANYID;
        // If some else stock should be used.
        if ($obj_update->ProductID != $_POST["ProductID".$obj_update->OrderDetailsID]
            &&
            $obj->warehouse_customer
            &&
            GetField("SELECT product_stock_id
                                       FROM product_stock
                                       WHERE Product_ID = '".$_POST["ProductID".$obj_update->OrderDetailsID]."'
                                             AND
                                             owner_id = '$obj->ContactID'"))
        {
        // When customer has own stock and this products is avaible in his stock list.
        // Default use own stock product.
          $int_stock_owner = $obj->ContactID;
        } else if (isset($_POST["owner_id".$obj_update->OrderDetailsID]))
          {
            $int_stock_owner = $_POST["owner_id".$obj_update->OrderDetailsID];
          }

        $bl_manprice = 0;
        if (isset($_POST["manual_price".$obj_update->OrderDetailsID]))
        {
          $flt_unitprice = $_POST["UnitPrice".$obj_update->OrderDetailsID];
          $bl_manprice = 1;
        } else
        {
          $flt_unitprice = GetSpecialProductPrice(
              $_POST["ProductID".$obj_update->OrderDetailsID],
              $_POST["quantity".$obj_update->OrderDetailsID],
              $int_stock_owner,
              $str_OrderDate,
              $obj->Price_level,
              $int_contactID
              );
        }
        $flt_extendedprice = $_POST["quantity".$obj_update->OrderDetailsID] * $flt_unitprice;

        //calculate discount for customer
        $flt_orig_price = GetSpecialProductPrice(
            $_POST["ProductID".$obj_update->OrderDetailsID],
            abs($_POST["quantity".$obj_update->OrderDetailsID]),            
            $int_stock_owner,
            date('Y-m-d'),
            1);
        $flt_discount = 1 - ($flt_orig_price != 0.0 ? $flt_unitprice/$flt_orig_price : 1);
        // Check if the product description is filled or the product ID has changed.
        if (!isset($_POST["Productname".$obj_update->OrderDetailsID])
            ||
            ($_POST["Productname".$obj_update->OrderDetailsID] == ""
            ||
            ($_POST["ProductIDlast".$obj_update->OrderDetailsID] != $_POST["ProductID".$obj_update->OrderDetailsID]))
        )
        {
          $str_productname = GetProductName($_POST["ProductID".$obj_update->OrderDetailsID]);
        } else
        {
          $str_productname = $_POST["Productname".$obj_update->OrderDetailsID];
        }

        $qry = "UPDATE order_details SET Quantity='".$_POST["quantity".$obj_update->OrderDetailsID]."', "
            ." to_deliver='0', "
            ." ProductID='".$_POST["ProductID".$obj_update->OrderDetailsID]."', "
            ." UnitPrice='$flt_unitprice', "
            ." ProductName='$str_productname', "
            ." manual_price = $bl_manprice, "
            ." Discount='$flt_discount', "
            ." UnitBTW = '".($obj->Btw_YN ?
            $flt_unitprice*GetBtwClass($_POST["ProductID".$obj_update->OrderDetailsID]) :
            0)."',"
            ." btw_percentage = '".($obj->Btw_YN ?
            GetBtwClass($_POST["ProductID".$obj_update->OrderDetailsID]) :
            0)."',"
            ." Extended_price='$flt_extendedprice', "
            ." stock_owner_id = '$int_stock_owner' "
            ." WHERE OrderDetailsID=".$obj_update->OrderDetailsID;
        $queryres = mysql_query($qry)
            or die("update van de orderdetails niet gelukt: order " .$qry." error:". mysql_error());

        // Check if the record should be deleted (quantity == 0).
        if ($_POST['quantity'.$obj_update->OrderDetailsID] == 0
            ||
            $_POST["ProductID".$obj_update->OrderDetailsID] == 0)
        {
          $qry = 'DELETE FROM order_details WHERE OrderDetailsID='.$obj_update->OrderDetailsID;
          $queryres = mysql_query($qry)
              or die("Verwijderen van orderdetails '$obj->OrderDetailsID' niet gelukt: " .$qry." error:". mysql_error());
        }
      }
    }
    mysql_free_result($qry_getorderdetails);

    if ($obj->ShipID)
    { // only enable addind articles when shipadres is given
      echo '<BR>';
      echo "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"blockbody\">\n";
      echo "<tr>
                      <th>Product ID</th>
                      <th>Besteld</th>
                      <th>Prijs p/s</th>
                      <th>Product</th>
                      <th>Vrij</th>
                      <th>VAT</th>
                      <th>Totaal</th>
                      </tr>\n";
      // always display a new empty detail record at the bottom
      if (!$obj->Locked_yn)
      {
        echo "<tr><td align=\"right\"><input size=\"5\" TABINDEX='1' align='right' name=\"ProductIDNew$int_update_no\" type=\"text\" value=\"" . ADMIN_ORDER_FREETEXT_ARTICLE . "\"
                          onClick=\"if (orderform.ProductIDNew$int_update_no.value=='" . ADMIN_ORDER_FREETEXT_ARTICLE ."') 
                          orderform.ProductIDNew$int_update_no.value=''\"></td>\n"; // ->current_product_list.productID
        echo "<td align=\"right\"><input size=\"4\" TABINDEX='2' align='right' name=\"quantityNew$int_update_no\" type=\"text\" value=\"1\"
                          onFocus=\"if (orderform.quantityNew$int_update_no.value==1) 
                          orderform.quantityNew$int_update_no.value=''\"></td>\n"; // order_details.Quantity
        echo "<td align=\"right\"><input size=\"6\" align='right' name=\"ProductPriceNew$int_update_no\" type=\"text\" value=\"\">"; // ->current_product_list.UnitPrice
        echo "<input type=checkbox name='manual_priceNew$int_update_no' CHECKED>";
        echo "</td>\n";
        echo "<td><input name='ProductNameNew$int_update_no' size=50 class=form tabindex=3  type=text>\n";
        echo GetRecordIdInputField(SQL_SEARCH_PRODUCTS_LIST, "ID", "ProductnameNew$int_update_no", "orderform.ProductIDNew$int_update_no", "product", 20, "", 3). "</td>\n";
        echo "</td>\n";
        echo "<td></td>\n";
        echo "<td align=\"right\"></td></tr>\n";

        // Set cursor on the new table entry.
        echo '<script TYPE="text/javascript" language="JavaScript">document.orderform.ProductIDNew'.$int_update_no.'.focus();</script>';
      }
      $_SESSION["popup_function"] = "LogSpecialPrice"; //set which function to execute in popup.php
      $_SESSION["popup_parm"] = 0; //set What option to use in popup.php
      // Create a query to select the orderdetails.
      getorderdetails(&$qry_getorderdetails, $int_orderID, "ORDER BY OrderDetailsID DESC");

      while ($objorderdet = mysql_fetch_array($qry_getorderdetails, MYSQL_BOTH))
      {
        $rma_string = "";
        if ($objorderdet["rma_actionID"])
        {
          $RMAID = GetField("SELECT RMAID from RMA_actions WHERE actionID='" . $objorderdet["rma_actionID"] . "'");
          $rma_string = " RMA: <A HREF='" . rma . "?rmaid=$RMAID' TARGET='_new'>" . $RMAID . "</A>";
        }
        if (!$obj->Locked_yn)
        {
          echo "<tr";
          if ($objorderdet["Discontinued_yn"])
          { // Old products have a bad product color.
            if ($objorderdet["stock"] > 0)
            {
              echo " bgcolor=\"".EOLPRODUCT_ONSTOCK_BGCOLOR."\"";
            } else
            {
              echo " bgcolor=\"".EOLPRODUCT_BGCOLOR."\"";
            }
          } else if (!$objorderdet["Pricelist_yn"])
            {
              echo " bgcolor=\"".PRODUCT_NOT_ONPRICELIST."\"";
            }
          echo "><td align=\"right\"><input size=\"5\"  align='right' name=\"ProductID".$objorderdet["OrderDetailsID"]."\" type=\"text\" value=\"". $objorderdet["ProductID"]."\">";
          echo "<td align=\"right\"><input size=\"4\" align='right' name=\"quantity".$objorderdet["OrderDetailsID"]."\" type=\"text\" value=\"". $objorderdet["Quantity"]."\"></td>\n"; // order_details.Quantity
          echo "<input name=\"ProductIDlast".$objorderdet["OrderDetailsID"]."\" type=\"hidden\" value=\"". $objorderdet["ProductID"]."\"></td>\n"; // ->current_product_list.productID
          echo "<td align=\"right\"><input size=\"6\" align='right' name=\"UnitPrice".$objorderdet["OrderDetailsID"]."\" type=\"text\" value=\"". $objorderdet["UnitPrice"]."\">"; // ->current_product_list.UnitPrice
          echo '<input type="checkbox" name="manual_price' . $objorderdet["OrderDetailsID"] . '" ';
          if ($objorderdet["manual_price"])
          {
            echo 'CHECKED ';
          }
          echo ">";
          echo "</td>\n";
          echo "<td><input name='Productname".$objorderdet["OrderDetailsID"]."' size=50 class=form value='".$objorderdet["ProductName"]."' type=text>$rma_string</td>\n"; // ->current_product_list.Productname
          echo "<td align=\"right\"><a href=\"". PRODUCT_MAINT . "?productid=".$objorderdet["ProductID"]."\" target=\"_new\">"
              .getfreestock($objorderdet["ProductID"],
              $objorderdet["OrderID"],
              $objorderdet["stock_owner_id"])
              . "</a></td>\n"; // ->order_details.extended_price
          echo "<td align=\"right\">" . $objorderdet["btw_percentage"]*100 . "%</td>\n"; // ->order_details.extended_price
          echo "<td align=\"right\">" . $objorderdet["Extended_price"] . "</td></tr>\n"; // ->order_details.extended_price

        } else
        {
          echo "<tr";
          if ($objorderdet["Discontinued_yn"])
          { // Old products have a bad product color.
            if ($objorderdet["stock"] > 0)
            {
              echo " bgcolor=\"".EOLPRODUCT_ONSTOCK_BGCOLOR."\"";
            } else
            {
              echo " bgcolor=\"".EOLPRODUCT_BGCOLOR."\"";
            }
          } else if (!$objorderdet["Pricelist_yn"])
            {
              echo " bgcolor=\"".PRODUCT_NOT_ONPRICELIST."\"";
            }
          echo "><td align=\"right\">".$objorderdet["ProductID"]."</TD>\n";
          echo "<td align=\"right\">". $objorderdet["Quantity"]."</td>\n"; // order_details.Quantity
          echo "<td align=\"right\">". $objorderdet["UnitPrice"]; // ->current_product_list.UnitPrice
          echo '<input type="checkbox" DISABLED name="manual_price' . $objorderdet["OrderDetailsID"] . '" ';
          if ($objorderdet["manual_price"])
          {
            echo 'CHECKED';
          }
          echo '>';
          echo "</td>\n";
          echo "<td align=\"left\">". $objorderdet["ProductName"] ."$rma_string</td>\n"; // ->current_product_list.Productname
          echo "<td align=\"right\"><a href=\"". PRODUCT_MAINT . "?productid=".$objorderdet["ProductID"]."\" target=\"_new\">"
              .getfreestock($objorderdet["ProductID"],
              $objorderdet["OrderID"],
              $objorderdet["stock_owner_id"])
              . "</a></td>\n"; // ->order_details.extended_price
          echo "<td align=\"right\">" . $objorderdet["btw_percentage"]*100 . "%</td>\n"; // ->order_details.extended_price
          echo "<td align=\"right\">" . $objorderdet["Extended_price"] . "</td></tr>\n"; // ->order_details.extended_price

        }
        $flt_ordercost += $objorderdet["cost_percentage"] * $objorderdet["Quantity"];
        $flt_productcost += $objorderdet["Extended_price"];
        $flt_vatamount += ($objorderdet["cost_percentage"] + $objorderdet["UnitPrice"]) * $objorderdet["Quantity"] * $objorderdet["btw_percentage"];
        $int_sum_units += $objorderdet["Quantity"];
      }
      mysql_free_result($qry_getorderdetails);
    }
  }
  echo "</TABLE>\n";

  $flt_totalcost = $flt_productcost + $flt_ordercost + $flt_vatamount;
  $flt_ordercost = sprintf("%.2f", $flt_ordercost);
  $flt_productcost = sprintf("%.2f", $flt_productcost);
  $flt_totalexclvat = sprintf("%.2f", $flt_productcost + $flt_ordercost);
  $flt_vatamount = sprintf("%.2f", $flt_vatamount);
  $flt_totalcost = sprintf("%.2f", $flt_totalcost);
  //echo "<INPUT TYPE='hidden' NAME='flt_totalcost' VALUE='$flt_totalcost'>";

  echo "<table border=0>";
  if ($obj->ContactID)
  {
    $flt_open_amount = GetOpenInvoiceAmount($obj->ContactID);
    $flt_unbooked_amount = GetUnBookedAmount($obj->ContactID);
    $flt_credit_limit = GetCreditLimit($obj->ContactID);
    $ftl_open_amount = $flt_credit_limit - $flt_open_amount + $flt_unbooked_amount;
    $open_after_order = $ftl_open_amount - $flt_totalcost;
    $flt_overdue_amount = Overdue($obj->ContactID);
    $insufficient_funds = ($open_after_order < 0) || ($flt_overdue_amount > 0);
    $credit_bgcolor = $insufficient_funds ? NOT_PAID_OVERDUE_BGCOLOR : PAID_BGCOLOR;
    // removed because iwan wanted to.
    //if ($insufficient_funds) echo "<script> document.orderform.deliver.disabled=true</script>";
    echo "    </TR>\n<TR  bgcolor='$credit_bgcolor' onClick=\"window.open('invoice_payment.php?ContactID=$obj->ContactID')\"".
        ShowOnMouseOverText("klik om details te zien / emailen").">\n";
    echo "      <td COLSPAN='4'>Crediet limiet: &euro; $flt_credit_limit";
    echo "  Besteedbaar: &euro; ". ToDutchNumber($ftl_open_amount);
    echo "  Over na deze order: ($flt_totalcost) &euro; ". ToDutchNumber($open_after_order);
    echo "  Buiten betalingstermijn: &euro; ". ToDutchNumber($flt_overdue_amount);
    echo "</td>\n</TR>\n<TR>";
  }

  echo "<tr><td>Totaal aantal producten $int_sum_units.</td><td bgcolor=#DD81FB>EOL</td><td bgcolor=#C0E967>EOL on stock</td><td bgcolor=#F785A5>Not on pricelist</td></tr></table>";
  echo "<p><table width = \"100%\" border =\"0\"><tr><td>";
  echo "<table width=\"250\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"cellline\">\n";
  echo "<tr><td>Subtotaal:</td><td align=\"right\"> &euro; $flt_productcost</td></tr>\n";
  echo "<tr><td>Order/verzend kosten:</td><td align=\"right\">&euro; $flt_ordercost</td></tr>\n";
  echo "<tr><td></td><td align=\"right\">+ ------------</td></tr>\n";
  echo "<tr><td>Excl. BTW / VAT:</td><td align=\"right\"> &euro; $flt_totalexclvat</td></tr>\n";
  echo "<tr><td>BTW / VAT:</td><td align=\"right\"> &euro; $flt_vatamount</td></tr>\n";
  echo "<tr><td></td><td align=\"right\">+ ------------</td></tr>\n";
  echo "<tr><td><strong>Totaal:</strong></td><td align=\"right\"><strong> &euro; $flt_totalcost</strong></td></tr></table>";
  $str_comments = isset($obj->Comments) ? $obj->Comments : '';
  echo "</td><td>Remarks:<br><textarea NAME=\"Comments\" rows=\"4\" cols=\"70\" CLASS=\"form\">$str_comments</textarea></td></tr></table></p>\n";

  // Show the order history.
  echo "<table border=0 width=50%>\n<tr><td>Order history</td></tr>\n";
  echo "<tr><td>".PrintOrderHistory($int_orderID)."</td></tr>\n</table>\n";
} else
{
  $rmaid = '';

  $next = isset($_POST['next']) ;
  $priv = isset($_POST['priv']) ;

  $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;

  if (($next||$priv)
      &&
      !$_POST['id'])
  {
    if ($next)
    {
      $startrec += LIMITSIZE;
    } else if ($priv)
      {
        $startrec -= LIMITSIZE;
      }
  }
  //echo "s:$startrec, n:$next, p:$priv";
  // Get data
  $sql = 'SELECT orders.OrderID, orders.ContactID, contacts.CompanyName, orders.OrderDate, orders.ShipID,
                orders.ContactsOrderID, orders.ShippedDate, orders.ShipName, orders.Locked_yn, orders.rma_yn, 
                invoices.InvoiceID 
				FROM orders
                LEFT JOIN contacts ON orders.ContactID = contacts.ContactID
                LEFT JOIN invoices ON orders.OrderID = invoices.OrderID';
  $sqlwhere = " WHERE administration_order = 1 ";
  $sqlwhere.=queryparm('orders.ContactID', $int_contactID, $sqlwhere, 0);
  if (isset($_POST["Companyname"])) $sqlwhere.=queryparm('CompanyName', $_POST["Companyname"], $sqlwhere);
  if (isset($_POST["ID"])) $sqlwhere.=queryparm('orders.OrderID', $_POST["ID"], $sqlwhere);
  if (isset($_POST["ContactsOrderID"])) $sqlwhere.=queryparm('ContactsOrderID', $_POST["ContactsOrderID"], $sqlwhere);
  if (isset($_POST["OrderDate"])) $sqlwhere.=queryparm('OrderDate',$_POST["OrderDate"], $sqlwhere);
  if (isset($_POST["ShippedDate"])) $sqlwhere.=queryparm('ShippedDate',$_POST["ShippedDate"], $sqlwhere);
  if (isset($_POST["select_confirmed"])) $sqlwhere.=queryparm('confirmed_yn',$_POST["select_confirmed"], $sqlwhere);
  if (isset($_POST["select_locked"])) $sqlwhere.=queryparm('Locked_yn',$_POST["select_locked"], $sqlwhere);
  if (isset($_POST["select_complete"])) $sqlwhere.=queryparm('Complete_yn',$_POST["select_complete"], $sqlwhere);
  $sql.= $sqlwhere . ' ORDER BY OrderID DESC';
  $query = mysql_query($sql)
      or die("Ongeldige query: " .$sql. "<br>" . mysql_error());
  $numberofrecords = mysql_Numrows($query);
  mysql_free_result($query);

  $sql .= ' LIMIT ' . $startrec . ',' . LIMITSIZE;
  //        echo $sql;
  $query = mysql_query($sql)
      or die("Ongeldige query: " .$sql. mysql_error());


  echo "<TABLE WIDTH=\"100%\"BORDER=\"1\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
  echo "    <TR>\n";
  echo '         <th colspan="4">Zoektermen</th>',"\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD>Order ID</TD><TD><INPUT TYPE=\"text\" NAME=\"ID\" SIZE=\"20\" CLASS=\"form\" value=\"". $int_ID ."\"></TD>\n";
  echo "         <TD>Company ID/Name</TD><TD><INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_contactID."\">/";
  echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "orderform.ContactID", "cust");
  echo "		  </TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "         <TD>Order Datum</TD><TD><INPUT TYPE=\"text\" NAME=\"OrderDate\" SIZE=\"20\" CLASS=\"form\" value=\"$str_OrderDate\">".Add_Calendar('orderform.OrderDate')."</TD>\n";
  echo "         <TD>Klant kenmerk</TD><TD><INPUT TYPE=\"text\" NAME=\"ContactsOrderID\" SIZE=\"20\" CLASS=\"form\" value=\"$str_ContactsOrderID\"></TD>\n";
  //          echo "         <TD>Verz. Datum</TD><TD><INPUT TYPE=\"text\" NAME=\"ShippedDate\" SIZE=\"20\" CLASS=\"form\" value=\"".$_POST["ShippedDate"]."\">".Add_Calendar('orderform.ShippedDate')."</TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo "      <TD COLSPAN='4'>\n";
  echo "        <TABLE WIDTH=\"100%\"BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\" class=\"blockbody\">\n";
  echo "<TD>Confirmed:" . makelistbox("SELECT value, text FROM listbox WHERE category = 2", 'select_confirmed', 'value', 'text', $select_confirmed)."</TD>\n";
  echo "<TD>Locked:" . makelistbox("SELECT value, text FROM listbox WHERE category = 1", 'select_locked', 'value', 'text', $select_locked)."</TD>\n";
  echo "<TD>Complete:" . makelistbox("SELECT value, text FROM listbox WHERE category = 1", 'select_complete', 'value', 'text', $select_complete)."</TD>\n";
  echo '        </TABLE>';
  echo "      </TD>\n";
  echo "    </TR>\n";
  echo "    <TR>\n";
  echo '	<TD COLSPAN="3" >';

  $pagetotal = $numberofrecords/LIMITSIZE +1;
  $pagenum =($numberofrecords/LIMITSIZE - $startrec/LIMITSIZE) +1;
  echo 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
  echo ' van '. (int)$pagetotal;

  if ($numberofrecords > LIMITSIZE)
  {
    if ($numberofrecords-LIMITSIZE> $startrec)
    {
      echo '		<INPUT TYPE="submit" NAME="next" value="<" CLASS="button">';
    }
    if ($startrec > 0)
      echo '		<INPUT TYPE="submit" NAME="priv" value=">" CLASS="button">';
    echo '		<INPUT TYPE="hidden" NAME="startrec" value="'.$startrec.'">';
  }
  echo "    </TD><TD ALIGN='right'><INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Zoeken\" CLASS=\"button\">\n";
  echo "    <INPUT TYPE=\"submit\" NAME=\"new_order\" VALUE=\"Nieuw\" CLASS=\"button\">";
  echo "</TD>\n";
  echo "    </TR>\n";
  echo "</TABLE>\n";
  echo "<table border=0>\n
					<tr>\n
						<td bgcolor=".QOUTE_BGCOLOR.">Offerte</td>\n
						<td bgcolor=".OPENORDER_BGCOLOR.">Bevestigd</td>\n
						<td bgcolor=".PARTSHIP_BGCOLOR.">Deellevering</td>\n
						<td bgcolor=".COMPLETE_BGCOLOR.">Compleet</td>\n
						<td bgcolor=".OPENWEBORDER_BGCOLOR.">New Weborder</td>\n
						<td class=\"rma_ordertext\">RMA order</td>\n			  
					</tr>\n
				</table>\n";	

  echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
      .'<tr>'
      .'<th>Order ID</th>'
      .'<th>Factuur</th>'
      .'<th>Order Datum</th>'
      .'<th>Bedrijf</th>'
      .'<th>Kenmerk</th>'
      .'</tr>';


  while ($obj = mysql_fetch_object($query))
  {
    $orderstate = get_orderstatus($obj->OrderID);
    if ($orderstate==1)
    {
      $bgcolor=QOUTE_BGCOLOR;
    } else if ($orderstate==2)
      {
        $bgcolor=OPENORDER_BGCOLOR;
      } else if ($orderstate==3)
        {
          $bgcolor=PARTSHIP_BGCOLOR;
        } else if ($orderstate==4)
          {
            $bgcolor=COMPLETE_BGCOLOR;
          } else if ($orderstate==5)
            {
              $bgcolor=OPENWEBORDER_BGCOLOR;
            } else
            {
              $bgcolor='#FFFFFF';
            }
    $str_lineclass =  NULL;
    if ($obj->rma_yn) $str_lineclass = " class=\"rma_ordertext\" ";
    $date = $obj->OrderDate ? strtotime($obj->OrderDate) : NULL;
    echo '<tr bgcolor="'. $bgcolor .'">
						<td'.$str_lineclass.'><a href='.$_SERVER['PHP_SELF'].'?orderID='.$obj->OrderID. ShowShortOrderInfo($obj->OrderID) .'>'.$obj->OrderID.'</a></td>
                        <td'.$str_lineclass.'><a href=\''.$_GLOBAL["str_backdir"].'invoice_payment.php?invoice='.$obj->InvoiceID.'\'>'.$obj->InvoiceID.'</a></td>
						<td'.$str_lineclass.'>'.date(DATEFORMAT_SHORT, $date).'</td>
						<td'.$str_lineclass.'>'.$obj->CompanyName.'</td>
						<td'.$str_lineclass.'>'.$obj->ContactsOrderID.'</td>'."\n".
        '</tr>';
  }

  mysql_free_result($query);

  echo "</TABLE>\n";
}

echo "</FORM>\n";

printenddoc();


?>
