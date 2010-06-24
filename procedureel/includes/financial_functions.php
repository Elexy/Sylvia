<?php

/**
 * Function     : Overdue
 * Get amount overdue from invoices
 * Input        : $int_contact_id, the contact ID. When false all data is returned.
 *              : $bl_use_payment_margin, when true the payment margin for this customer is used.
 *                  else no margin is used. Default is TRUE
 * Returns      : Float containing the overdue amount or False if nothing overdue
 **/
Function Overdue($int_contact_id = FALSE,
    $bl_use_payment_margin = TRUE,
    $int_InvoiceID = FALSE) {
  global $db_iwex;
  $flt_returnvar= FALSE;

  $sql_overdue = "SELECT sum(Invoice_total + Invoice_BTW - paid_amount) AS overdue
                     FROM invoices 
                     LEFT JOIN paymentterm ON Paymentterm = PaymentTermID 
                     WHERE ";
  $sql_overdue .= $int_contact_id ? " CustomerID = $int_contact_id AND " : "";
  $sql_overdue .= $int_InvoiceID ? " InvoiceID = $int_InvoiceID AND " : "";
  $sql_overdue .=  " NOT paid_yn AND (to_days(curdate()) -
					   IF(endmonth, 
						  TO_DAYS(DATE_ADD(CONCAT(YEAR(Invoice_date),
												  '-',
												  MONTH(Invoice_date),
												  '-01'),
										   INTERVAL 1 MONTH) - INTERVAL 1 DAY),
					   	  to_days(Invoice_date)) > (days + ";
  $sql_overdue .= $bl_use_payment_margin && $int_contact_id ?
      GetField("SELECT Paymentterm_margin
                                  FROM contacts 
                                  WHERE ContactID = $int_contact_id") : "0";
  $sql_overdue .= " ) AND (Invoice_total+Invoice_BTW-paid_amount > ".DB_INVOICE_MARGIN."
                             OR
                             Invoice_total+Invoice_BTW-paid_amount < ".DB_INVOICE_MARGIN."))";

  //echo $sql_overdue;
  $query_overdue = $db_iwex->query($sql_overdue);

  if ($obj_overdue = mysql_fetch_object($query_overdue)) $flt_returnvar = $obj_overdue->overdue ;

  mysql_free_result($query_overdue);

  return $flt_returnvar;
}

/**
 * Function     : grant_shipment
 * will show / facilitate Granting of shipment for a cusomer
 * Input        : ContactID, The ID of the custoIF(endmonth,
 TO_DAYS(DATE_ADD(CONCAT(YEAR(Invoice_date),
 '-',
 MONTH(Invoice_date),
 '-01'),
 INTERVAL 1 MONTH) - INTERVAL 1 DAY),
 to_days(Invoice_date))mer
 view=true or false show the checkbox / get status
 update=true or false
 * Returns      :updatebale echo-able string
 **/
Function grant_shipment($int_contact_id, 
    $bl_checkbox=TRUE,
    $bl_update=FALSE,
    $bl_shipped=FALSE,
    $enabled=TRUE) {
  global $db_iwex;
  $return_var = FALSE;
  $bl_checkbox_checked = GetCheckbox("grant_shipment");

  if ($int_contact_id) {
  // make the value found the default return value
    $sql_grant = "SELECT grant_shipment FROM allow WHERE ContactID = $int_contact_id";
    $return_var = $bl_grant = GetField($sql_grant);
    if ($bl_update) {
      if ($bl_grant) {
        if ($bl_checkbox_checked) {
          $sql_upd = "UPDATE allow SET grant_shipment = 1 WHERE ContactID = $int_contact_id";
          $db_iwex->query($sql_upd);
        } else if (!$bl_checkbox_checked
              ||
              $bl_shipped) {
            $sql_upd = "DELETE FROM allow WHERE ContactID = '$int_contact_id'";
            $db_iwex->query($sql_upd);
          }
      } else if ($bl_checkbox_checked) {
          $sql_upd = "INSERT INTO allow SET grant_shipment = 1, ContactID = $int_contact_id";
          $db_iwex->query($sql_upd);
        }
    }
    if ($bl_checkbox) {
      $return_var = MakeCheckbox("grant_shipment", $bl_checkbox_checked, $enabled);
    }
  } else {
    $sql_grant = "SELECT grant_shipment FROM allow
					INNER JOIN contacts ON contacts.ContactID = grant.ContactID";
    $return_var = "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
    $return_var .= "<TR>\n";
    $return_var .= "<TH>Company Name</TH><TH>Shipment granted</TH>";
    //$bl_edit = edit_button ();
    while ($obj = mysql_fetch_object($sql_grant)) {
    //if ($bl_edit) {
    //	$return_var .= "<TD COLSPAN='2'><A HREF='../contacts/maintain.php?custid=$obj->ContactID'>$obj->CompanyName</A></TD>
    //					<TD>$obj->grant</TD>";
    //	$return_var .= " </td>\n</TR>\n";
    //} else {
      $return_var .= "<TD COLSPAN='2'><A HREF='../contacts/maintain.php?custid=$obj->ContactID'>$obj->CompanyName</A></TD>
								<TD>$obj->grant</TD>";
      $return_var .= " </td>\n</TR>\n";
    //}
    }
    $return_var .= "</TR>\n";
    $return_var .= "</TABLE>\n";
  }
  Return $return_var;
}

/**
 * Function     : Credit_Status
 * Get status of credit for customer
 * Input        : $ContactID, of coustomer to research
 $flt_totalcost, cost of current order.
 * Returns      : 0, if bad, amount if good.
 **/
Function Credit_Status($ContactID, 
    $flt_totalcost=0,
    &$open_after_order,
    &$flt_overdue_amount,
    &$flt_credit_limit,
    &$flt_credit_amount) {
  $returnvar = 0;
  if ($ContactID) {
    $flt_open_amount = GetOpenInvoiceAmount($ContactID);
    $flt_unbooked_amount = GetUnBookedAmount($ContactID);
    $flt_credit_amount = CurrentCreditAmount($ContactID);
    $flt_credit_limit = CurrentCreditLimit($ContactID);
    $ftl_open_amount = $flt_credit_limit - $flt_open_amount + $flt_unbooked_amount;
    $open_after_order = $ftl_open_amount - $flt_totalcost;
    $flt_overdue_amount = Overdue($ContactID, FALSE);
    $insufficient_funds = ($open_after_order < 0) || ($flt_overdue_amount > 0);
    if (!$insufficient_funds) $returnvar = $open_after_order;
  }
  return $returnvar;
}        

/**
 * Function     : print_payment_details
 * Print a table with all transactions payments linked to the invoices.
 * Input        : CustomerID: The id of the customer.
 * Returns      : true
 **/
Function print_payment_details($int_custid) {
  $db_iwex = new DB;
  // Check which which records page need to be displayed.
  $next = isset($_POST['next']) ;
  $priv = isset($_POST['priv']) ;

  $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;

  if (($next||$priv)) {
    if ($next) {
      $startrec -= LIMITSIZE;
    } else if ($priv) {
        $startrec += LIMITSIZE;
      }
  }
  //echo "s:$startrec, n:$next, p:$priv";

  $transaction_sql = "SELECT bank_transactions.*, bank_accounts.account_name, sum(link_amount) AS link_amount,
                        invoices.InvoiceID, invoices.Invoice_total + invoices.Invoice_BTW as inv_total,
                        invoices.Invoice_date
                        FROM payments_link
                        LEFT JOIN bank_transactions ON payments_link.BankTransactionId = bank_transactions.transaction_id
                        LEFT JOIN bank_accounts ON bank_account_id = account_id
                        LEFT JOIN invoices ON invoices.InvoiceID = payments_link.InvoiceID 
                        WHERE invoices.CustomerID ='$int_custid'
                        GROUP BY InvoiceID, payments_link.BankTransactionId
                        ORDER BY InvoiceID DESC";


  $transaction_result = $db_iwex->query($transaction_sql);
  $numberofrecords = mysql_Numrows($transaction_result);
  $sql = $transaction_sql . ' LIMIT ' . $startrec . ',' . LIMITSIZE;
  //        echo $sql;
  $transaction_result = $db_iwex->query($sql);

  echo "Customer : $int_custid, ".GetField("SELECT CompanyName FROM contacts WHERE ContactID ='$int_custid'");
  // print payments links
  echo '<br><TABLE WIDTH="100%" BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody">'."\n";
  $pagetotal = $numberofrecords/LIMITSIZE +1;
  $pagenum =($numberofrecords/LIMITSIZE - $startrec/LIMITSIZE) +1;
  echo 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
  echo ' van '. (int)$pagetotal;

  if ($numberofrecords > LIMITSIZE) {
    if ($numberofrecords-LIMITSIZE> $startrec) {
      echo '		<INPUT TYPE="submit" NAME="priv" value="<" CLASS="button">';
    }
    if ($startrec > 0) {
      echo '		<INPUT TYPE="submit" NAME="next" value=">" CLASS="button">';
    }
    echo '		<INPUT TYPE="hidden" NAME="startrec" value="'.$startrec.'">';
  }

  echo '<TR valign="top">'."\n";
  echo ' <tr>
           <th>Invoice</th>
           <th>Bank account</th>
           <th>Date</th>
           <th>Description</th>
           <th>Bank amount</th>
           <th>Date</th>
           <th>Invoiced Amount</th>
           <th>Amount paid to invoice</th>';
  echo '</TR>'."\n";
  $int_last_invoice = FALSE;
  $int_count = 0;

  While ($obj = mysql_fetch_object($transaction_result)) {
    if ($int_last_invoice != $obj->InvoiceID) $int_count++;
    $int_last_invoice = $obj->InvoiceID;

    if (($int_count%2)==0 ) {
      $bgcolor=WHITE_LINE_BGCOLOR;
    } else {
      $bgcolor=BLUE_LINE_BGCOLOR;
    }

    echo "<TR bgcolor=$bgcolor valign='top'>\n";
    echo "    <td align=right><a href='".INVOICE_PAYMENT."?invoice=$obj->InvoiceID&color=on";
    echo "' target=_new>$obj->InvoiceID</a></td>";    echo '    <td>'.$obj->account_name.'</td>';
    echo "    <td align=center><a href='javascript:void()' onclick=\"window.open('".BANK_TRANS_TO_INVOICE."?custid=$obj->CustomerID&transactionid=$obj->transaction_id&trans_date=$obj->transaction_date&description=$obj->description'";
    echo ",'book_transactions', 'menubar=yes,directories=no,toolbar=yes,resizable=yes,width=700, height=600, scrollbars=yes')\">".date("d-M-y",strtotime($obj->transaction_date)).'</a></td>';
    echo '    <td>'.$obj->description.'</td>';
    echo '    <td align=right>'.$obj->amount.'</td>';
    echo '    <td align=center>'.date("d-M-y",strtotime($obj->Invoice_date)).'</td>';
    echo '    <td align=right>'.$obj->inv_total.'</td>';
    echo '    <td align=right>'.$obj->link_amount.'</td>';
    echo '</TR>'."\n";
  }
  echo '</table>'."\n";

  return TRUE;
}

/**
 * Function     : GetOpenInvoiceAmount
 * Wil show the total open amount for a customer.
 * Input        : ContactID, The ID of the customer.
 * Returns      : Amount unpaid in Euros
 **/
Function GetOpenInvoiceAmount($int_contact_id, 
    $int_exclude_shipmentID = FALSE) {
  $exclude_shipment = '';
  if ($int_exclude_shipmentID) $exclude_shipment = " AND shipmentID <> $int_exclude_shipmentID";
  return GetField("SELECT sum(Invoice_total + Invoice_BTW - paid_amount) AS open_all
                     FROM invoices
                     WHERE NOT paid_yn AND CustomerID = '$int_contact_id'
  $exclude_shipment;");

}

/**
 * Function     : GetUnBookedAmount
 * Wil show the total amount already payed but not booked on an invoice
 * Input        : ContactID, The ID of the customer.
 * Returns      : Amount unbooked in Euros
 **/
Function GetUnBookedAmount($int_contact_id) {
  global $db_iwex;
  $flt_sum = 0;
  // Not booked records.
  $qry_trans = $db_iwex->query("SELECT bank_transactions.amount, sum(link_amount) AS sum_amount
                                 FROM bank_transactions
                                 LEFT JOIN payments_link ON payments_link.BankTransactionId = bank_transactions.transaction_id
                                 WHERE CustomerID = '$int_contact_id'
                                 GROUP BY transaction_id
                                 HAVING NOT (bank_transactions.amount <= (sum_amount + ". DB_INVOICE_MARGIN .")
                                             AND bank_transactions.amount >= (sum_amount - ". DB_INVOICE_MARGIN ."))
                                        OR sum_amount IS NULL");
  while ($obj = mysql_fetch_object($qry_trans)) {
    $flt_sum += $obj->amount - $obj->sum_amount;
  }

  mysql_free_result($qry_trans);

  return $flt_sum;
}

/**
 * Function     : GetCreditLimit
 * Will get the credit limit of this customer an a date.
 * Input        : CustomerID
 *              : Date limit request date. now when not given
 * Returns    	: float with credit limit
 **/
function GetCreditLimit($int_contact_id,
    $str_date = FALSE) {
  if (!$str_date) {
    $str_date = "'".date("Y-m-d")."'";
  } else {
    $str_date = "'".$str_date."'";
  }

  //return GetField("SELECT Creditlimit FROM contacts WHERE ContactID = $int_contact_id");
  return GetField("SELECT limit_amount FROM creditlimits
					  WHERE ContactID = '$int_contact_id' 
 					  	  AND (start_date <= $str_date || isnull(start_date) || start_date=0) 
                      	  AND (end_date >= $str_date || isnull(end_date) || end_date=0)");
}

/**
 * Function     : CurrentCreditLimit
 * Wil show the current credit limit for this customer.
 * Input        : ContactID, The ID of the customer.
 * Returns      : Amount of the credit limit.
 **/
Function CurrentCreditLimit($int_contact_id) {
  return GetCreditLimit($int_contact_id);
}

/**
 * Function     : CurrentCreditAmount
 * Wil show the total amount of credit left for this customer.
 * Input        : ContactID, The ID of the customer.
 * Returns      : Amount of credit left.
 **/
Function CurrentCreditAmount($int_contact_id) {
  return CurrentCreditLimit($int_contact_id)
      - GetOpenInvoiceAmount($int_contact_id)
      + GetUnBookedAmount($int_contact_id);
}

/**
 * Function     : save_order_margin
 * Wil save the margin of a given order in the table order_margin.
 * Input        : OrderID, ID of the order.
 *		CostValue, Cost value of the order
 *		SalesValue, Sales value of the order
 *		ShippingCost, Shipping cost of the initial complete order.
 * Returns      : True if the inset / update worked, False if it didn't.
 **/

Function save_order_margin($int_OrderID,
    $flt_CostValue,
    $flt_SalesValue,
    $Shipping_Cost,
    $order_lock,
    $bl_delete = FALSE) {
  $return_value = false;
  global $db_iwex;
  //echo $int_OrderID . '*' .  $flt_CostValue .'*'. $flt_SalesValue . "*". $Shipping_Cost;
  if ($int_OrderID &&
      $flt_CostValue &&
      $flt_SalesValue) {
  // do we already have a record with this OrderID?
    if (GetField("SELECT OrderID FROM order_margin WHERE OrderID = '$int_OrderID'")) {
      if ($bl_delete) {
        echo "order margin record deleted";
        if ($db_iwex->query("DELETE FROM order_margin
								WHERE OrderID = '$int_OrderID'")) $return_value = true;
      } else {
        if (!$order_lock) {
          echo "update";
          if ($db_iwex->query("UPDATE order_margin SET
									Sales_Value = '$flt_SalesValue',
									Purchase_Value = '$flt_CostValue',
									Shipping_Cost = '$Shipping_Cost' 
									WHERE OrderID = '$int_OrderID'")) $return_value = true;
        } else {
          echo "Order alread locked";
        }
      }
    } else if (!$bl_delete) { // if not ther yet, insert it.
        echo "insert";
        if ($db_iwex->query("INSERT INTO order_margin SET
							Sales_Value = '$flt_SalesValue',
							Purchase_Value = '$flt_CostValue',
							Shipping_Cost = '$Shipping_Cost', 
							OrderID = '$int_OrderID'")) $return_value = true;
      }
  }
  return $return_value;
}

/**
 * Function     : CalcOrderMargin
 * Will return the Gros Margin for the given order
 * Input        : OrderID, orderdate
 * Returns    : float with margin
 **/
Function CalcOrderMargin($int_OrderID,
    $str_orderdate) {
  global $db_iwex;
  $flt_margin = 0;
  $qyr_orderdetals = FALSE;

  $stock_owner = OWN_COMPANYID;

  if ($int_OrderID) {
    getorderdetails(&$qyr_orderdetals, $int_OrderID);
    while ($objorderdet = mysql_fetch_object($qyr_orderdetals)) {
      $flt_margin +=  ($objorderdet->UnitPrice - GetProductCost($objorderdet->ProductID,
          $objorderdet->Quantity,
          $str_orderdate)
          + $objorderdet->cost_percentage)
          * $objorderdet->Quantity;
    }
  }
  return $flt_margin;
}

/**
 * Function     : CalcOrderCost
 * Will return the Purchase Value for the given order
 * Input        : OrderID, order_date
 * Returns    : float with Purchase Value
 **/
Function CalcOrderCost($int_OrderID,
    $str_date) {
  global $db_iwex;
  $flt_cost = 0;
  $qyr_orderdetals = FALSE;

  $stock_owner = OWN_COMPANYID;

  if ($int_OrderID) {
    getorderdetails(&$qyr_orderdetals, $int_OrderID);
    while ($objorderdet = mysql_fetch_object($qyr_orderdetals)) {
      $flt_cost +=  GetProductCost($objorderdet->ProductID,
          $objorderdet->Quantity,
          $str_date)
          * $objorderdet->Quantity;
    }
  }
  return $flt_cost;
}

/**
 * Function     : CalcOrderValue
 * Will return the Sales Value for the given order
 * Input        : OrderID
 * Returns    : float with Sales Value
 **/
Function CalcOrderValue($int_OrderID) {
  global $db_iwex;
  $flt_value = 0;
  $qyr_orderdetals = FALSE;

  if ($int_OrderID) {
    getorderdetails(&$qyr_orderdetals, $int_OrderID);
    while ($objorderdet = mysql_fetch_object($qyr_orderdetals)) {
      $flt_value +=  $objorderdet->Extended_price;
    }
  }
  return $flt_value;
}

/**
 * Function     : CalcProductMargin
 * Will return the difference in % of the  purchase price
 * Input        : int_productID
 *		flt_price
 *		: number
 *		:str_date
 *		 int_currencyid
 * Returns    : float with %
 **/
Function CalcProductMargin($int_ProductID,
    $flt_price,
    $int_number=1,
    $str_date=FALSE,
    $int_currencyid = DB_CURRENCY_DEFAULT) {
  global $db_iwex;
  $flt_value = 0;
  $qry = FALSE;

  if ($int_ProductID
      &&
      $flt_price) {
    if ($Purchase_price = GetProductCost($int_ProductID,
    $int_number,
    $str_date,
    $int_currencyid)) {
      $flt_value =  ToDutchNumber((($flt_price / $Purchase_price) - 1) * 100);
    } else {
      $flt_value = 0;
    }
  }
  return $flt_value;
}

/**
 * Function  : GetProductCost
 * Will return the product cost. That is buy price, shipping, import etc.
 * Input     : int_productID
 *			  int_number
 *			  str_date
 *			  int_currency_id
 *			  int_supplier
 * Returns    : Cost price in
 **/
Function GetProductCost($int_ProductID,
    $int_number,
    $str_date=FALSE,
    $int_currencyid = DB_CURRENCY_DEFAULT,
    $int_supplier = OWN_COMPANYID) {
  global $db_iwex;
  $flt_value = 0;

  if ($int_ProductID) {
    $int_owner_result = 0;
    $flt_buy_price = GetBuyPrice($int_ProductID,
        $int_number,
        $str_date,
        $int_currencyid,
        &$str_message);
    $qry = $db_iwex->query("SELECT Supplier, extra_cost, euproductcode, eu_country
								FROM current_product_list 
								INNER JOIN contacts ON ContactID = Supplier
								INNER JOIN country ON country.code = contacts.Country
								WHERE ProductID = '$int_ProductID'");

    if ($objorderdet = mysql_fetch_object($qry)) {
      //echo "supplier: " . $objorderdet->Supplier;
      if(is_null($objorderdet->Supplier)) {
        echo "product has no supplier, cannot calculate final buying price<br>";
      } else {
        $flt_value = $flt_buy_price + $objorderdet->extra_cost;
        $flt_rate = GetField("SELECT taxrate FROM euproductcode WHERE EUproductCode = '$objorderdet->euproductcode'");
        $flt_value = $flt_rate && !$objorderdet->eu_country ? $flt_value*(1+$flt_rate /100) : $flt_value;
      //echo " $str_message Buy price = $flt_buy_price Extra cost = $objorderdet->extra_cost import = " . (!$objorderdet->eu_country ? $flt_rate : 0) . " % <BR>";
      }
    }
    mysql_free_result($qry);

  }
  return $flt_value;
}

/**
 * Function     : GetSelfCreditLimit
 * Will calculation the invoiced amount of the last 12 months.
 * With a maximum of 15000,- euro.
 * Only invoices that where paid within the paymenterm + 60 days
 * are allowed to be used in the calculation of the credit limit.
 * Input        : CustomerID
 * Returns    	: float with credit limit
 **/
function GetSelfCreditLimit($int_contact_id) {
  $flt_result= GetField("SELECT SUM(Invoice_total + Invoice_BTW)
						   FROM invoices
						   LEFT JOIN paymentterm ON Paymentterm = PaymentTermID 
						   WHERE CustomerID = $int_contact_id
							   AND paid_yn 
							   AND paid_date > Invoice_date
							   AND to_days(paid_date) - IF(endmonth, 
														  TO_DAYS(DATE_ADD(CONCAT(YEAR(Invoice_date),
																				  '-',
																				  MONTH(Invoice_date),
																				  '-01'),
																		   INTERVAL 1 MONTH) - INTERVAL 1 DAY),
														  to_days(Invoice_date)) <= days +60
							   AND Invoice_date > DATE_SUB(NOW(), INTERVAL 1 YEAR)");
  return $flt_result > MAX_SELF_CHECK_CREDIT_LIMIT ? MAX_SELF_CHECK_CREDIT_LIMIT : $flt_result;
}

/**
 * Function     : Orderpaidcheck
 * Will calculation the total of the orders related on the shipment.
 * Input        : int_contact_ID
 *				  int_shipment_ID
 * Returns    	: True if all is paid
 **/
function Orderpaidcheck($int_contactID, $int_shipmentID, &$int_all_order_total) {

  global $db_iwex;

  $bl_all_paid = FALSE;

  $int_delivery_value = round(GetDeliveryValue($int_shipmentID),2);
  $int_all_order_total = round(GetUnBookedAmount($int_contactID) - GetOpenInvoiceAmount($int_contactID, $int_shipmentID),2);
  //echo "<br>" . $int_contactID . ": " . $int_all_order_total . " levering:  " . $int_delivery_value;
  $bl_all_paid = ($int_all_order_total+DB_INVOICE_MARGIN >= ($int_delivery_value)) || ShipmentPaid($int_shipmentID);
  Return $bl_all_paid;
}

/**
 * Function     : ShipmentPaid
 * is this shipemtn paid?
 * Input        :  int_shipment_ID
 * Returns    	: True if all is paid
 **/
function ShipmentPaid($int_shipmentID) {

  global $db_iwex;

  $bl_paid = FALSE;

  if ($int_shipmentID) {
    $bl_paid = GetField("SELECT paid_yn FROM invoices WHERE shipmentID = '$int_shipmentID'");
  }
  Return $bl_paid;
}

/**
 * Function : EditCreditLimits
 * will show / facilitate update of the credit limit.
 * Input:ContactID, The ID of the customer
 update=true or false
 formname: name of the form to use
 * Returns :updatebale echo-able string
 **/
Function EditCreditLimits($int_contact_id, 
    $bl_update,
    $formname) {
	/* update old database to new table
	INSERT INTO creditlimits (
	ContactID,
	limit_amount
	)
	SELECT ContactID, CreditLimit
	FROM contacts 
	WHERE CreditLimit != 0 AND  !ISNULL(CreditLimit) AND Paymentterm != 3 AND Paymentterm != 4
	
	*/

  global $db_iwex;

  $bl_edit_limit = edit_button();

  if ($int_contact_id) {
  // what if a contactID is given
    $update_condition = FALSE;
    $condition = '';

    if ($int_contact_id) {
      $condition = " WHERE creditlimits.ContactID = '$int_contact_id'";
    }
    $sql_base = "SELECT creditlimits.*, ValutaName, CompanyName,
							 created, emcreat.FirstName AS CreatBy, modified, emmodby.FirstName AS ChangedBy
					    FROM creditlimits 
						LEFT JOIN contacts ON creditlimits.ContactID = contacts.ContactID
						LEFT JOIN employees emcreat ON emcreat.EmployeeID =  created_by
			 			LEFT JOIN employees emmodby ON emmodby.EmployeeID =  modified_by
						LEFT JOIN valuta ON creditlimits.currencyid = ValutaID ";
    //echo $sql_base;
    $limit_sql = $sql_base . "$condition ORDER BY start_date DESC, limit_amount ASC;";

    if ($bl_update) {
      $str_id_new = isset($_POST["IDnew"]) ? $_POST["IDnew"] : FALSE;
      if ($str_id_new === '0'
          ||
          $str_id_new <> ''
          ||
          (isset($_POST["start_date_new"]) && $_POST["start_date_new"]) ) {
        $str_id_new = $str_id_new == ALL_INPUT_WILDCARD ? '0' : $str_id_new; // Make possible to select * for all.
        $int_id_new = GetField("SELECT CreditLimit_ID
									    FROM creditlimits
										WHERE CreditLimit_ID = '$str_id_new'");
        if ($_POST["amount_new"]
            &&
            $_POST["amount_new"] != '*') {
          $amount = $_POST["amount_new"];
        } else {
          $amount = GetSelfCreditLimit($int_contact_id);
        }
        $sql_insert = "INSERT INTO creditlimits SET
					limit_amount = '$amount',";
        if ($int_contact_id) {
          $sql_insert .= "ContactID = '$int_contact_id', ";
        }
        $sql_insert .= "start_date = '" . $_POST["start_date_new"] . "',";
        $sql_insert .= "end_date = '" . $_POST["end_date_new"] . "',";
        $sql_insert .= "created_by = '" . $GLOBALS["employee_id"] . "',";
        $sql_insert .= "created = '" . date(DATEFORMAT_LONG) . "'";
        //echo $sql_insert;
        $db_iwex->query($sql_insert);
        $just_inserted =  $db_iwex->lastinserted();
      }
      $sql_upd = 'Select';
      if ($qry_prices = $db_iwex->query($limit_sql)) {
        while ($obj = mysql_fetch_object($qry_prices)) {
          if (isset($_POST["ID$obj->CreditLimit_ID"])
              &&
              !$_POST["delete".$obj->CreditLimit_ID]
              &&
              $_POST["update".$obj->CreditLimit_ID]==='1') {
            $sql_upd = "UPDATE creditlimits SET
							limit_amount = '". $_POST["amount$obj->CreditLimit_ID"] . "',";
            if ($int_contact_id) {
              $sql_upd .= "ContactID = '$int_contact_id', ";
            }
            $sql_upd .= "
							start_date = '". $_POST["start_date$obj->CreditLimit_ID"] . "',
							end_date = '". $_POST["end_date$obj->CreditLimit_ID"] . "',
							currencyid = '". $_POST["currency$obj->CreditLimit_ID"] . "',
							notes = '". $_POST["notes$obj->CreditLimit_ID"] . "',
							modified = '" . date(DATEFORMAT_LONG) . "',
							modified_by = '" .  $GLOBALS["employee_id"] . "'
							WHERE CreditLimit_ID = '$obj->CreditLimit_ID'";
            $db_iwex->query($sql_upd);
          } else if (isset($_POST["delete".$obj->CreditLimit_ID])
                &&
                $_POST["delete".$obj->CreditLimit_ID]) {
              $sql_upd = "DELETE FROM creditlimits WHERE CreditLimit_ID = '$obj->CreditLimit_ID'";
              if ($sql_upd) $db_iwex->query($sql_upd);
            }
          $sql_upd = '';
        }
        mysql_free_result($qry_prices);
      }
    }

    //echo $limit_sql;
    $return_var = edit_button ('waccess_s', $formname);
    // now start the table
    $return_var .= "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
    $return_var .= "<TR>\n";
    $return_var .= "<TH>ID
			<INPUT TYPE='hidden' NAME='str_CreditLimit_ID'></TH>";
    $return_var .= "<TH>Amount</TH>
						<TH>Currency</TH>
						<TH WIDTH=90>start date</TH>
						<TH WIDTH=90>end date</TH>
						<TH>Notes</TH>
						<TH>Creaded By</TH>
						<TH>Modified By</TH>
						<TH>Option</TH>";
    $return_var .= "</TR>";

    //set edit enabler
    if (!$bl_edit_limit) {
      $edit_str = "DISABLED" ;
    } else {
      $edit_str = "";
      // first a new one, but only if we are editing
      $return_var .= "<TD><INPUT ". ($int_contact_id ? "hidden" : "")." TYPE='text' SIZE='4' NAME='IDnew'></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='8' NAME='amount_new'></TD>
						<TD></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='10' NAME='start_date_new'> "
          .Add_Calendar($formname.".start_date_new")."</TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='10' NAME='end_date_new'> "
          .Add_Calendar($formname.".end_date_new")."</TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='30' NAME='notes_new'></TD>
						<TD></TD>
						<TD></TD>
						<TD></TD>";
      $return_var .= "</TR>\n";
    }
    //then edit existing ones
    $qry_limits = $db_iwex->query($limit_sql);
    while ($obj = mysql_fetch_object($qry_limits)) {
    // make sure the disabled state from the edit button is also respected
      $edit_str ? $str_edit = "DISABLED" : $str_edit = "";

      //if  the date of the price is endless or later than today show the delete button
      // future development: this should check whether this price has ever been used, if so, delete does not appear!
      if (($obj->end_date=='0000-00-00'
          ||
          strtotime($obj->end_date) >= strtotime(date('Y-m-d')))
          &&
          !$str_edit) {
        $str_del = "<INPUT TYPE='hidden' NAME='delete".$obj->CreditLimit_ID."'>
					<IMG SRC=".IMAGES_URL."delete.png WIDTH='10' 
					onclick=\"document.$formname.delete".$obj->CreditLimit_ID.".value='1';
					document.$formname.update_var.value='1';
					document.$formname.submit()\"
					onchange=\"document.$formname.update" . $obj->CreditLimit_ID . ".value='1';\">";
        $str_edit = "";
      } else {
      // empty the delet string
        $str_del = "";
        // disable editing if it's an old price!
        $str_edit = "DISABLED";
      }

      //first column ProductID or ContactID
      $return_var .= "<TR><TD><INPUT $str_edit TYPE='text'
									SIZE='4' 
									NAME='contactID" . $obj->CreditLimit_ID . "' 
									VALUE='" . $obj->ContactID . "'
									onchange=\"document.$formname.update" . $obj->CreditLimit_ID . ".value='1';\">
          $str_del";
      $return_var .= "</TD>";
      $return_var .= "<TD><INPUT $str_edit TYPE='text' SIZE='8' NAME='amount".$obj->CreditLimit_ID."' VALUE='$obj->limit_amount' onchange=\"document.$formname.update" . $obj->CreditLimit_ID . ".value='1';\"></TD>
				<TD>".makelistbox('SELECT ValutaID, ValutaName FROM valuta ORDER by ValutaName',
          "currency$obj->CreditLimit_ID",
          'ValutaID',
          'ValutaName',
          $obj->currencyid,
          FALSE,
          FALSE,
          $str_edit)."</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='10' NAME='start_date".$obj->CreditLimit_ID."' VALUE='$obj->start_date'
					onfocus=\"document.$formname.update" . $obj->CreditLimit_ID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='laststart_date".$obj->CreditLimit_ID."' VALUE='$obj->start_date'>
          ". Add_Calendar($formname.".start_date".$obj->CreditLimit_ID) . "</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='10' NAME='end_date".$obj->CreditLimit_ID."' VALUE='$obj->end_date'
					onfocus=\"document.$formname.update" . $obj->CreditLimit_ID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='lastend_date".$obj->CreditLimit_ID."' VALUE='$obj->end_date'>
          ". Add_Calendar($formname.".end_date".$obj->CreditLimit_ID) . "</TD></TD>
				<td><INPUT $str_edit TYPE='text' SIZE='30' NAME='notes$obj->CreditLimit_ID' VALUE='$obj->notes' onchange=\"document.$formname.update$obj->CreditLimit_ID.value='1';\"></td>
				<TD>$obj->CreatBy</TD>
				<TD>$obj->ChangedBy
					<INPUT $str_edit TYPE='hidden' NAME='update" . $obj->CreditLimit_ID . "'>
					<INPUT $str_edit TYPE='hidden' NAME='ID$obj->CreditLimit_ID' value='$obj->CreditLimit_ID'>
				</TD>";
      $str_insert_link = "";
      if ($obj->end_date == '0000-00-00') {
        $str_insert_link = "<INPUT $str_edit TYPE='button' VALUE='New limit'
						onclick=\"document.$formname.update" . $obj->CreditLimit_ID . ".value='1';
						if(new_date=prompt('Ingangs datum?', '" . date("Y-m-d") . "'))
						{
							document.$formname.IDnew.value=document.$formname.ID" . $obj->CreditLimit_ID . ".value;
							document.$formname.amount_new.value=prompt('Hoogte limiet? (* voor zelf beoordeling)', '*');
							document.$formname.start_date_new.value=new_date;
							ary_date = new_date.match('(\.{4})-(\.{2})-(\.{2})'); //('\d+-\d+-\d+');

							date_given = new Date(ary_date[1],ary_date[2],ary_date[3]);
							yesterdayDate = date_given.getDate() -1 ;
							date_given.setDate( yesterdayDate );
							str_yestterday = date_given.getFullYear();
							str_yestterday += '-';
							str_yestterday += date_given.getMonth();
							str_yestterday += '-';
							str_yestterday += date_given.getDate();
							//prompt('date yesterday', str_yestterday + new_date + ary_date);
							
							document.$formname.end_date$obj->CreditLimit_ID.value = str_yestterday;
							document.$formname.update_var.value=1;
							document.$formname.submit();
						};\">";
      }
      $return_var .= "<TD>$str_insert_link&nbsp;</TD>";
      // now show if this is in the catalog
      $return_var .= "</TR>\n";
    }
    $return_var .= " </td>\n</TR>\n";
    $return_var .= "</table>";
    mysql_free_result($qry_limits);
  }

  Return $return_var;
}

/**
 * Function     : ShowOpenInvoices
 * Get a list of open invoices
 * Input        : $int_contact_id, the contact ID.
 *				  $bl_show_intrest, show the interst table default not.
 * Returns      : HTML string with the data
 **/
Function ShowOpenInvoices($int_contact_id,
    $bl_show_intrest = FALSE) {
  global $db_iwex;

  $flt_open_amount = 0;
  $flt_paid_amount = 0;
  $flt_intrest_amount = 0;

  if ($int_contact_id) {
  // Create a query to select the customers payment detail.
    $sql_invoices = SQL_INVOICES_PAYMENT ." WHERE CustomerID = '$int_contact_id' AND NOT paid_yn
												ORDER BY InvoiceID";

    $query = $db_iwex->query($sql_invoices);
    $str_return_result = "<table border=1 cellspacing=0 cellpadding=2 class=blockbody width=100%>\n<tr>"
        ."<th colspan=2>Factuur</th>"
        ."<th>Verstuurd aan</th>"
        ."<th>Datum</th>"
        ."<th>Bedrag</th>"
        ."<th>Betaald</th>"
        .($bl_show_intrest ? "<th>Rente</th>" : "")
        ."</tr>\n";
    while ($obj_invoices = mysql_fetch_object($query)) {
      $bgcolor = GetInvoiceColor($obj_invoices->InvoiceID,
          $obj_invoices->paid_yn,
          $obj_invoices->CustomerID,
          FALSE);

      $flt_open_amount += $obj_invoices->amount;
      $flt_paid_amount += $obj_invoices->paid_amount;
      $flt_intrest_amount += $obj_invoices->intrest;

      $str_return_result .= "<tr>\n"
          ."<td colspan=2 bgcolor=$bgcolor style=background-color:$bgcolor; align=center><b>$obj_invoices->InvoiceID</b></td>"
          .'<td>'.$obj_invoices->ShipName.'</td>'
          .'<td align=center>'.$obj_invoices->Invoice_date.'</td>'
          .'<td align=right>'.ToDutchNumber($obj_invoices->amount).'</td>'
          .'<td align=right>'.ToDutchNumber($obj_invoices->paid_amount).'</td>'
          .($bl_show_intrest ? "<td align=right>".ToDutchNumber($obj_invoices->intrest). "</td>" : "")
          ."\n".'</tr>';
    }
    $str_return_result .= "<tr><td align=center style=background-color:".NOT_PAID_NOT_OVERDUE_BGCOLOR.";>OK</td>"
        ."<td align=center style=background-color:".NOT_PAID_OVERDUE_BGCOLOR.";>Te laat</td>"
        ."<td align=right colspan=2><b>Totaal</b></td><td align=right>"
        .ToDutchNumber($flt_open_amount)."</td><td align=right>"
        .ToDutchNumber($flt_paid_amount)."</td>"
        .($bl_show_intrest ? "<td align=right>".ToDutchNumber($flt_intrest_amount). "</td>" : "")
        ."<tr>\n";

    mysql_free_result($query);
    $str_return_result .= "</table>\n\n";
  } else {
    $str_return_result = "No customer ID given";
  }

  return $str_return_result;
}
?>