<?
// DB id fields defines.
define('GETRECORDSEARCH','recordsearchvar');
define('DB_INVOICE_MARGIN', 0.01); // Maxim error + and - of the printed and invoice in the DB.
define('DB_INVOICE_PRECISION', 2); // DB invoice precision, 2 digits behind the comma.
define('OWN_COMPANYID', $GLOBALS["ary_config"]["own company"]); // ID of the company that is running this wonderful software
define('DB_IWEX_RMA_CUST_ID', 2); // ID of the IWEX RMA user
define('DB_IWEX_MAGAZIJN_CUST_ID', $GLOBALS["ary_config"]["warehouse address"]); // ID of the IWEX Magazijn address
define('FOB', $GLOBALS["ary_config"]["FOB"]); // Asume FOB prices for various statistics
define('SELLTHROUGHWEEKS', $GLOBALS["ary_config"]["sellthrough_weeks"]); // Asume FOB prices for various statistics

define ('PAYMENTERM_ID_REMBOURS', 3);
define ('PAYMENTERM_ID_UPFRONT', 4);
define ('PAYMENT_ACCOUNT_ID_SYLVIA', 13);
define ('SHIP_RMA_ACTION','4');
define ('CREDIT_RMA_ACTION','17');
define ('SUPPLIER_RMA_ACTION','8');

// DB fields_text_languages Field ID defines
define ('DB_FIELDS_TEXT_ID_PAYMENTERM', 1);

define ('DB_LANGUAGE_ID_DUTCH', 1);
define ('DB_LANGUAGE_ID_ENGLISH', 2);
define ('DB_LANGUAGE_ID_GERMAN', 3);

define ('VISIT_ADDRESS_TYPE','1');
define ('INVOICE_ADDRESS_TYPE','2');
define ('SHIP_ADDRESS_TYPE','3');
define ('ONLY_ADDRESS_TYPE','4');
define ('HOME_SHIP_ADDRESS_TYPE','5');
define ('POSTBOX_ADDRESS_TYPE','6');
define ('CANCELLED_ADDRESS_TYPE','7');
define ('DROP_SHIP_ADDRESS_TYPE','8');
define ('RMA_SHIP_ADDRESS_TYPE','5');

define ('DB_CUST_REPLACE_VAR', 'varCustomer');
define ('DB_EMPLOYEE_REPLACE_VAR', '_varEmployee_');
define ('DB_PAYMENTTERMDAYS_REPLACE_VAR', '_varPaymentermDays_');
define ('DB_INVOICETABLE_REPLACE_VAR', '_varInvoiceTable_');
define ('DB_COMFIRM_TYPE_VAR', '_varComfirmType_');
define ('DB_CUSTOM_ORDER_REF_VAR', '_varCustorderID_');
define ('DB_ORDER_DETAILS_TABLE_VAR', '_varOrderdetails_');
define ('DB_PAYMENT_TERM_VAR', '_varPaymentTerm_');
define ('DB_SHIP_TO_ADRES_VAR', '_varShipTo_');
define ('DB_CREDIT_TEXT_VAR', '_varCreditText_');
define ('DB_ONLINE_ORDER_VAR', '_varOnlineOrderText_');

define ('DB_LETTER_DATE_VAR', '_varletterdateText_');
define ('DB_LETTER_TO_ADRES_VAR', '_varletterTo_');
define ('DB_LETTER_TOTAL_VAR', '_varlettertotal_');
define ('DB_LETTER_TOTAL_AND_INTREST_VAR', '_varlettertotalandintrest_');
define ('DB_LETTER_TOTALINVOICES_VAR', '_varlettertotalinvoices_');
define ('DB_LETTER_REFNUM_VAR', '_varletterrefNum_');
define ('DB_LETTER_LETTERDATE_VAR', '_varletterletterdateText_');
define ('DB_STRING_BREAK', '_varstringbreak_');

define ('DB_NEWUSER_NAME', '_varnewusername_');
define ('DB_NEWUSER_PASSWORD', '_varnewuserpass_');


define ('DB_DEALERLOGIN', '_vardealerlogin_');

define ('DB_COMPANYNAME', '_varcompanyname_');
define ('DB_ADDRESS', '_varaddress_');
define ('DB_ZIPCODE', '_varzipcode_');
define ('DB_CITY', '_varcity_');
define ('DB_TELEPHONE', '_vartelephone_');
define ('DB_FAXNUMBER_VAR', '_varfaxnumber_');
define ('DB_FAXNUMBER_CUSTOMER_VAR', '_varfaxnumbercustomer_');
define ('DB_WEBSITE', '_varwebsite_');

// Shipment Acception defines
define ('DB_ACCEPTIONLINK', "_acceptionlink_");
define ('DB_ACCEPTION_CODE', "_acceptioncode_");
define ('DB_SHIPMENT_ID', "_shipmentid_");

define ('ONLINE_ARTICLE_LINK', "<A HREF='http://iwex.serveftp.org/prijslijst/product_view.php?productid=");

define ('DB_ADDRESS_DELIVERY', 3);
define ('DB_ADDRESS_ONE_AND_ONLY', 4);

define ('DB_WEB_EMPLOYEE', 6);
define ('DB_LISTBOX_BEST_SYST', 8);
define ('DB_LISTBOX_PROCESSOR', 6);
define ('DB_LISTBOX_ACCU', 7);
define ('DB_SKU_MULTI_ARTICLE', 0);
define ('DB_SKU_PHYSICAL_ARTICLE', 1);
define ('DB_SKU_SOFTBUNDEL', 2);
define ('DB_SKU_ADMINISTRATION', 3);
define ('DB_DROP_SHIP_ADRESTITEL', 8);
define ('DB_PAYMENT_TERM_AUTOMATIC_INCASSO_ID', 5);
define ('DB_PAYMENT_TERM_REMBOURS', 3);
define ('DB_PAYMENT_TERM_14_DAYS', 2);

define ('PRICING_TYPE_PURCHASING', 2);
define ('PRICING_TYPE_SALE', 1);

define('DB_INVOICE_OPTION_LISTBOX', 12);
define('DB_PER_POST', 0);
define('DB_PER_EMAIL', 1);
define('DB_PER_POST_EN_EMAIL', 2);

define('DB_CONFIRMED_IWEX_LISTBOX', 1);
define('DB_CONFIRMED_CUSTOMER_LISTBOX', 2);
define('DB_CONFIRMED_CANCELED_LISTBOX', 4);

define('DB_PERSONE_TYPE_ADMIN', 5);
define('DB_PERSONE_TYPE_DEB_ADMIN', 9);
define('DB_PERSONE_TYPE_LOGISTICS', 6);
define('DB_PERSONE_TYPE_SALES', 4);
define('DB_PERSONE_TYPE_RMA', 2);
define('DB_PERSONE_TYPE_DISCONTINUED', 8);
define('DB_PERSONE_TYPE_PURCHASE', 3);
define('DB_PERSONE_TYPE_DEFAULT', 1);

// Task defines
define("DB_TASK_OPTION_DAY", 1);
define("DB_TASK_OPTION_WEEK", 2);
define("DB_TASK_OPTION_MONTH", 3);
define("DB_TASK_OPTION_YEAR", 5);

// Overdue defines
define ('DB_INVOICE_OVERDUE_FIRST_MAIL', 1);
define ('DB_INVOICE_OVERDUE_SECOND_MAIL', 2);
define ('DB_INVOICE_OVERDUE_TELEPHONE_CALL', 3);
define ('DB_INVOICE_OVERDUE_FAX_OR_LETTER', 4);
define ('DB_INVOICE_OVERDUE_SIGNATURE_LETTER', 5);
define ('DB_INVOICE_OVERDUE_BAILIFF', 6);

// Dispuut defines
define ('DB_INVOICE_OVERDUE_NO_DISPUUT', 0);
define ('DB_INVOICE_OVERDUE_NEW_DISPUUT', 1);
define ('DB_INVOICE_OVERDUE_DISPUUT', 2);
define ('DB_INVOICE_OVERDUE_END_DISPUUT', 3);

// currency defines
define ('DB_CURRENCY_DEFAULT', $GLOBALS["ary_config"]["default currency"]);

// emailtext defines
define ('DB_EMAIL_NEWACCOUNT', 12);

define("ERROR_INSTER_QUERY", "Ongeldige insert order invoice query: ");
define("SELECT_INVOICE_ID", "SELECT InvoiceID FROM invoices WHERE orderID = ");

define("DB_MAIL_TEXT_INVOICE", 7);
define("CPU_HEAVY_LIMIT", 20); // to limit cpu heavy stuff to smaller lists

$arr_image_extension = array(1 => 'jpg', 2 => 'gif', 3 => 'png');

define ('ONLINE_ORDER_STRING',"http://iwex.serveftp.org/prijslijst/order.php?orderID=");

define ('SQL_SEARCH_PRODUCTS_LIST',"SELECT DISTINCTROW productID as 'ID', ProductName AS 'Productnaam', Merk, 
				Discontinued_yn AS EOL, product_stock.stock as stock, NULL as price, NULL as margin
                FROM current_product_list
				LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID
                WHERE (productID like '%".GETRECORDSEARCH."%' or ProductName like '%".GETRECORDSEARCH."%' or
                Productdescription like '%".GETRECORDSEARCH."%' or Merk like '%".GETRECORDSEARCH."%')
                OR ExternalID LIKE '%".GETRECORDSEARCH."%' OR EAN = '".GETRECORDSEARCH."' ORDER BY Productnaam");

define ('SQL_SEARCH_CUSTOMER_LIST', "SELECT contacts.ContactID, Companyname, voornaam, achternaam, Personen.email AS pemail, contacts.email AS cemail"
    ." FROM contacts LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID"
    ." WHERE Companyname LIKE '%".GETRECORDSEARCH."%' OR voornaam LIKE '%".GETRECORDSEARCH."%'"
    ." OR achternaam LIKE '%".GETRECORDSEARCH."%' OR Personen.email LIKE '%".GETRECORDSEARCH."%'"
    ." OR contacts.email LIKE '%".GETRECORDSEARCH."%' ORDER BY Companyname");

define ('SQL_SEARCH_CUSTOMER_AND_SHIPADRES_LIST', "SELECT contacts.ContactID, Companyname, Naam AS AdresName, voornaam, achternaam, Personen.email AS pemail, contacts.email AS cemail"
    ." FROM contacts LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID"
    ." INNER JOIN Adressen ON Adressen.ContactID = contacts.ContactID"
    ." INNER JOIN Adrestitels ON Adressen.adrestitel = Adrestitels.titelID"
    ." WHERE Naam LIKE '%".GETRECORDSEARCH."%' OR postcode LIKE '%".GETRECORDSEARCH."%'"
    ." OR Companyname LIKE '%".GETRECORDSEARCH."%' OR voornaam LIKE '%".GETRECORDSEARCH."%'"
    ." OR achternaam LIKE '%".GETRECORDSEARCH."%' OR Personen.email LIKE '%".GETRECORDSEARCH."%'"
    ." OR contacts.email LIKE '%".GETRECORDSEARCH."%' ORDER BY Companyname");

define ('SQL_SEARCH_CUSTOMER_ADRES_LIST', "SELECT contacts.ContactID, Companyname, Naam, "
    ." CONCAT_WS(' ', straat, huisnummer) AS Straat, postcode, plaats, titel"
    ." FROM contacts"
    ." INNER JOIN Adressen ON Adressen.ContactID = contacts.ContactID"
    ." INNER JOIN Adrestitels ON Adressen.adrestitel = Adrestitels.titelID"
    ." WHERE Companyname LIKE '%".GETRECORDSEARCH."%' OR Naam LIKE '%".GETRECORDSEARCH."%'"
    ." OR Straat LIKE '%".GETRECORDSEARCH."%' OR postcode LIKE '%".GETRECORDSEARCH."%' OR plaats LIKE '%".GETRECORDSEARCH."%'"
    ." OR titel LIKE '%".GETRECORDSEARCH."%' ORDER BY Companyname");

define ('SQL_SHIPMENTS',"SELECT DISTINCTROW Shipment_ID, Start_date, Ship_date, InvoiceID, Tracking, CompanyName, Paymentterm,
        Address, City, Region, PostalCode, contacts.Country, languageID ,AdressID, btw_number, Phone, UPSaccount,
		AdresID, contacts.ContactID, adrestitel, Naam, attn, straat, huisnummer, postcode, postbus, 
        plaats, land, country.country AS land_naam, iso_code
        FROM shipments
        INNER JOIN Adressen ON shipments.AdressID=Adressen.AdresID
        LEFT JOIN contacts ON Adressen.ContactID=contacts.ContactID
        INNER JOIN country ON Adressen.land = country.code ");

define ('SQL_ORDERS',"SELECT DISTINCTROW Trackingnummer, CompanyName, paymentterm_yn,
        Address, City, Region, PostalCode, contacts.Country, ShipID, btw_number, Phone, UPSaccount,
		AdresID, contacts.ContactID, adrestitel, Naam, attn, straat, huisnummer, postcode, postbus, 
        plaats, land, country.country AS land_naam, iso_code, Paymentterm
        FROM orders
        INNER JOIN Adressen ON orders.ShipID=Adressen.AdresID
        LEFT JOIN contacts ON Adressen.ContactID=contacts.ContactID
        INNER JOIN country ON Adressen.land = country.code ");

define ('SQL_SHIPMENTS_CONSIGNMENTS',"SELECT DISTINCTROW Shipment_ID, Start_date, Ship_date, InvoiceID, Tracking, CompanyName, Paymentterm,
        Address, City, Region, PostalCode, contacts.Country, AdressID, btw_number, Phone, UPSaccount,
		AdresID, contacts.ContactID, adrestitel, Naam, attn, straat, huisnummer, postcode, postbus, 
        plaats, land, country.country AS land_naam, iso_code, orders.consignment_order
        FROM shipments
        INNER JOIN Adressen ON shipments.AdressID=Adressen.AdresID
        LEFT JOIN contacts ON Adressen.ContactID=contacts.ContactID
        INNER JOIN country ON Adressen.land = country.code 
        INNER JOIN inventory_transactions ON shipments.Shipment_ID=inventory_transactions.shipmentID
        INNER JOIN orders on inventory_transactions.OrderID=orders.OrderID ");        

define ('SQL_openorderdetails',"SELECT
        OrderDetailsID, orders.OrderID, order_details.ProductID, order_details.ProductName, orders.OrderDate,
        order_details.ProductDescription, UnitPrice, orders.ShipID, orders.ContactsOrderID, orders.Comments,
        orders.in_one_delivery_yn,
        UnitBTW, Quantity, Extended_price, Discount, SerialNB, orders.ContactID, 
        btw_percentage, cost_percentage, to_deliver, manual_price, product_stock.stock, ExternalID, store_serial_yn,
        Adressen.AdresID, Adressen.Naam AS Shipname, contacts.CompanyName, location, 
        order_details.rma_actionID, orders.rma_yn, sku, order_details.stock_owner_id, orders.consignment_order
        FROM order_details
        INNER JOIN orders ON orders.orderID = order_details.OrderID
        INNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID
        INNER JOIN contacts ON contacts.ContactID = orders.ContactID
        LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID 
                                   AND 
                                   order_details.stock_owner_id = product_stock.owner_id
        LEFT JOIN location ON product_stock.location_id = location.ID
        LEFT JOIN Adressen ON Adressen.AdresID = orders.ShipID");

define ('SQL_open_rma_ship_details',"SELECT
        OrderDetailsID, order_details.ProductID, order_details.ProductName, order_details.ProductDescription, 
        Quantity, to_deliver
        FROM order_details        
        LEFT JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID");

define('SQL_INVOICES_PAYMENT',  "SELECT InvoiceID, invoices.companyName, CustomerID, ShipName, Invoice_date, 
								 Invoice_total + Invoice_BTW AS amount, paid_amount, paid_yn, days, 
								 paid_date, DispuutID, overduetypeID,
								 TO_DAYS(IF(paid_yn,
								 			paid_date,
								 			NOW()))*1.0 - TO_DAYS(IF(endmonth, 
																 DATE_ADD(CONCAT(YEAR(Invoice_date),
																				 '-',
																				 MONTH(Invoice_date),
																				 '-01'),
																		  INTERVAL 1 MONTH) - INTERVAL 1 DAY,
																 Invoice_date))*1.0 - days AS dayslate,
								 IF((TO_DAYS(IF(paid_yn,
								 			    paid_date,
								 			    NOW())) - IF(endmonth, 
														 TO_DAYS(DATE_ADD(CONCAT(YEAR(Invoice_date),
																				 '-',
																				 MONTH(Invoice_date),
																				 '-01'),
																		  INTERVAL 1 MONTH) - INTERVAL 1 DAY),
														 to_days(Invoice_date))) > days, 
								 (TO_DAYS(IF(paid_yn,
								 			 paid_date,
								 			 NOW())) - TO_DAYS(Invoice_date))/".MONTH_INTREST_RATE."*12/365/100*(Invoice_total + Invoice_BTW),
								 	0) AS intrest
		FROM invoices 
		LEFT JOIN paymentterm ON Paymentterm = PaymentTermID ");


define ('SQL_ADRESSEN_QUERY', 'SELECT *  FROM Adressen LEFT JOIN country ON code = land ');
define ('SQL_PERSONS_QUERY', 'SELECT * FROM Personen ');
define ('GET_TITELS', "SELECT TitelID, titel FROM Adrestitels ORDER BY titel");
define ('GET_COUNTRYS', 'SELECT code, country FROM country ORDER BY country');
define ('GET_PERSON_TYPES', "SELECT Personen_type_ID, Desctription FROM Personen_type ORDER BY Desctription");
define ('GET_GENDER', "SELECT id, Gender FROM Gender");
define ('MULTI_ARTICLE_SQL',"SELECT aantal, Multi_productID, Product_ids, Multi_ID, ProductName, 
									Purchase_price_home, sku, Retail_price_ex, weight_corr
            FROM multi_articles2
            LEFT JOIN current_product_list ON multi_articles2.Product_ids=current_product_list.ProductID
            WHERE Multi_ID = ");
define ('FREESTOCK_ORDER_CONDITION',"(orders.Confirmed_yn = '1' OR orders.Confirmed_yn = '-1' OR orders.Confirmed_yn = '2' OR orders.Confirmed_yn = '3')");
define ('GET_EMPLOYEE_NAME',  "SELECT CONCAT_WS(' ', employees.FirstName, employees.middlename, employees.LastName) AS EmployeeName
							  FROM employees
							  WHERE EmployeeID = ");
define ('STOCK_QUERY_CONDITION',"
        FROM current_product_list
        LEFT JOIN inventory_transactions ON inventory_transactions.ProductID = current_product_list.ProductID
        LEFT JOIN orders ON inventory_transactions.OrderID = orders.OrderID 
        WHERE (rma_yn <> 1 or rma_yn is Null)");

define ('STOCK_COUNT_CONDITION', "NOT Discontinued_yn AND (sku=1 OR sku=0)
                                  OR Pricelist_yn AND Discontinued_yn AND location_ID
                                  OR stock AND (sku=1 OR sku=0)");

define ('openordedetails_condition'," orders.Confirmed_yn = '1' AND (NOT Complete_yn OR Complete_yn IS NULL)");

class DB
{
  var $link = NULL;
  var $db;

  function DB($host = 0,
      $db   = 0,
      $user = 0,
      $pass = 0)
  {
    $host = $host ? $host : $GLOBALS["ary_config"]["hostname"];
    $this->db   = $db   ? $db   : $GLOBALS["ary_config"]["database"];
    $user = $user ? $user : $GLOBALS["ary_config"]["username"];
    $pass = $pass ? $pass : $GLOBALS["ary_config"]["password"];
    $this->link = mysql_connect($host, $user, $pass);
    mysql_select_db($this->db, $this->link);
    echo mysql_error();
  //       register_shutdown_function($this->close);
  }

  function query($query,
      $bl_debug = TRUE)
  {
    mysql_select_db($this->db, $this->link);
    if ($bl_debug)
    {
      $result = mysql_query($query, $this->link)
          or die("Ongeldige query! <br><b><pre>$query</pre></b><br>".mysql_error());
    } else
    {
      $result = mysql_query($query, $this->link);
    }
    return $result;
  }

  function fetch_object($results)
  {
    $obj = mysql_fetch_object($results);
    return $obj;
  }

  function free_result($results)
  {
    mysql_free_result($results);
  }

  function close()
  {
    mysql_close($this->link);
  }

  function lastinserted()
  {
    return mysql_insert_id();
  }
}


/*********************************************************
 * Function     : queryparm
 * will return a complete where clause for SQl query
 * Input        : field: fieldname intabel
 *                value: the value to check on
 *                whereclause: reeds aanwezige where clausule
 * Returns      : Bijgewerkte where clausule
 *********************************************************/
Function queryparm($field, $value, $whereclause=' ', $whildcard = 1, $operator= 'AND', $bl_eqeal = TRUE) //fieldname, value,
//place in where clause 1=first 2=somewhere in middle

{
  $bln_add_oper = true;

  $where = strpos($whereclause, 'WHERE');
  //add '%' when no operators are in search string
  if (stristr ($value, '[<>]'))
  {
  //               echo 'For ereg: ' . $value . '<br>';
    $value = preg_replace ("/([<>]) *(\d-\d-\d)*/", "$1 \" $2", $value);
    //               echo $value.'<br>';
    $pre = '';
    $aft = '"';
  }
  else
  {
    if ($whildcard)
    {
      $pre = ($bl_eqeal ? " " : " NOT ") . "LIKE '%";
      $aft = "%'";
    } else
    {
      $pre = ($bl_eqeal ? " " : " !"). "= '";
      $aft = "'";
    }
  }

  if (strlen($field)&&strlen($value))
  {
    if (!$where)
    {
      $parm = ' WHERE '.$field.$pre.$value.$aft;
    }
    else
    {
    // Test if there is an opperator at the end.
      if (is_int(strpos($whereclause, 'AND'))
          ||
          is_int(strpos($whereclause, 'OR')))
      {
        $int_endPos = strlen($whereclause) -6 ;
        if (is_int(strpos($whereclause, 'AND', $int_endPos))
            ||
            is_int(strpos($whereclause, 'OR', $int_endPos)))
        {
          $bln_add_oper = false;
        }
      }

      // If there is already an opperator at the end remove the current one.
      if (!$bln_add_oper)
      {
        $operator = "";
      }
      $parm = ' '. $operator. ' ' .$field.$pre.$value.$aft;
    }
  } else
  {
    $parm = '';
  }
  return $parm;
}


/**
 * Function     : checkEmail
 * Return NULL if the emailadress is invalid.
 * Input        : email
 * Returns      : a valid emailadress
 **/
function checkEmail($email)
{
  if(ereg( "^[_a-zA-Z0-9-]+(\\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\\.[a-zA-Z0-9-]+)+$", $email))
  {
    return true;
  } else
  {
    return false;
  }
}

/**
 * Function     : generate_Password
 * Return returns a string
 * Input        : none
 * Returns      : passwd (random: 2 UPPER, 4 LOWER, 2 numbers)
 **/
function generate_Password ()
{
  $passwd = "";
  $aant_Hl = 2;
  $aant_Kl = 4;
  $aant_Gt = 2;
  $size = 0;

  while ($size!=8)
  {
    $rand = rand(0,2);
    //print($rand. "\n");
    if ($aant_Hl !=0 && $rand ==0)
    {
      $aant_Hl = $aant_Hl-1;
      $size = $size+1;
      $c = chr(mt_rand(65,90));
      if (eregi("^[A-Z]$", $c)) $passwd = $passwd.$c;
    }
    elseif ($aant_Kl !=0 && $rand ==1)
    {
      $aant_Kl = $aant_Kl-1;
      $size = $size+1;
      $c = chr(mt_rand (97,122));
      if (eregi("^[a-z]$", $c)) $passwd = $passwd.$c;
    }
    elseif ($aant_Gt !=0 && $rand ==2)
    {
      $aant_Gt = $aant_Gt-1;
      $size = $size+1;
      $c = chr(mt_rand (48,57));
      if (eregi("^[0-9]$", $c)) $passwd = $passwd.$c;
    }
  }
  return($passwd);
}	


/*********************************************************
 * Function     : insertDate
 * Return NULL if the date is empty. 
 * Input        : Mysql date 
 * Returns      : a string to be insterted in the sqlquery
 *********************************************************/
function insertDate($mysqlDate)
{
  if ($mysqlDate == 0)
  {
    return 'NULL';
  } else
  {
    return "'$mysqlDate'";
  }
}

/*********************************************************
 * Function     : GetRecordIdInputField
 * Will return the id of the table to find.
 * Input        : sqlstr: SQL string to search on
 *                recordid: the id to return
 *                form_field_name: Name of the input field
 * 				  document_set_var : the varible to update
 * 				  string_no: number or name of the search 
 *				            string to use. When there are more 
 * 						    then one.
 *                int_size: The size of the input text
 *                str_value: the value of the field.
 *                int_tabindex: tabindex value.
 *                size: number to increase the default size
 *                auto_set: if only one field is returned return this one automaticly when true.
 * Returns      : The string to include in the HTML
 *********************************************************/
Function GetRecordIdInputField($sqlstr, 
    $recordid,
    $form_field_name,
    $document_set_var,
    $string_no = "1",
    $int_size=30,
    $str_value="",
    $int_tabindex = 0,
    $size=1,
    $autoset=1,
    $autosubmit=1)
{
  $str_return = "<INPUT TYPE=\"text\" NAME=\"$form_field_name\" SIZE=\"$int_size\" CLASS=\"form\"\" VALUE=\"$str_value\" ";
  if ($int_tabindex)
  {
    $str_return .= "TABINDEX=\"$int_tabindex\" ";
  }
  $width = $size*850;
  $height = $size*600;
  if ($autosubmit) $str_autosubmit = "&autosubmit=1";
  $str_return .= "onChange=\"window.open('".docroot."/getrecords.php?docvar=$document_set_var&docsearch=' + $form_field_name.value + '&string_no=$string_no&autoset=$autoset$str_autosubmit'";
  $str_return .= ",'select_records','menubar=yes,directories=no,toolbar=yes,resizable=yes,width=".$width.",height=".$height.",scrollbars=yes');\"> \n";
  $str_return .= GetRecordId($sqlstr, $recordid, $form_field_name, $document_set_var, $string_no, $size, $autoset);

  return $str_return;
}

/*********************************************************
 * Function     : GetRecordId
 * Will return the id of the table to find.
 * Input        : sqlstr: SQL string to search on
 *                recordid: the id to return
                  document_search_string: form variable that contains string to search on
 * 				  document_set_var : the varible to update
 * 				  string_no: number or name of the search 
 *						string to use. When there are more 
 * 						then one.
 *                size: number to increase the default size
 *                auto_select: if only one field is returned return this one automaticly when true.
 * Returns      : The string to include in the HTML
 *********************************************************/
Function GetRecordId($sqlstr, $recordid, 
    $document_search_string,
    $document_set_var,
    $string_no = "1",
    $size="1",
    $auto_select = '1')
{
// Store sql string
  $_SESSION["str_getrecordsql$string_no"] = $sqlstr;

  // Store  record id
  $_SESSION["str_getrecord_id$string_no"] = $recordid;

  $width = $size*850;
  $height = $size*600;
  $str_return = "<input type='button' ID='searchbutton' onClick=\"window.open('".docroot."/getrecords.php?docvar=$document_set_var&docsearch=' + $document_search_string.value + '&string_no=$string_no&autoset=$auto_select'";
  $str_return .= ",'select_records','menubar=yes,directories=no,toolbar=yes,resizable=yes,width=".$width.",height=".$height.",scrollbars=yes')\"";
  $str_return .= "onmouseover=\"return overlib('Druk hier om het op te zoeken.');\" onmouseout=\"return nd();\" value='?'>";

  return $str_return;
}

/*********************************************************
 * Function     : update_all_stock
 * will update all stock fields according to the calculated stock
 * unless you specify a productID then it will update just that one.
 * Input        : ProductID
 *                CustomerID, owner stock to update.
 * Returns      : true if it worked.
 *********************************************************/
function update_all_stock($int_productID=0,
    $int_owner_id = OWN_COMPANYID)
{
  global $db_iwex;

  $all_products_sql="SELECT ProductID
          FROM current_product_list WHERE ";
  $result = TRUE;
  if ($int_productID)
  {
    $all_products_sql .= " ProductID = $int_productID ";
  } else
  {
    $all_products_sql .= " (Discontinued_yn = 0 OR Pricelist_yn) ";
  }
  $all_products_result = $db_iwex->query($all_products_sql);
  if (!$all_products_result)
  {
    echo "Ongeldige select details query: " .$all_products_sql. mysql_error();
    $result = false;
  }
  $tracker = array();
  while ($obj = mysql_fetch_object($all_products_result))
  {
  // Check if there is a record in the product_stock table
    $existSql = "SELECT product_stock_id
                          FROM product_stock
                          WHERE Product_ID = '$obj->ProductID'
                                AND owner_id = '$int_owner_id'";
    $exists = GetField($existSql);
    if ($exists)
    {
      $updatestock_sql = "UPDATE product_stock SET
                stock = '".get_stock($obj->ProductID, $int_owner_id)."' ,
                free_stock_calculated = '" . date('Y-m-d H:i:s') . "'
                WHERE Product_ID = '".$obj->ProductID."' AND owner_id = '$int_owner_id'";
      $updatestock_query = $db_iwex->query($updatestock_sql);
      if (!$updatestock_query)
      {
        echo "Ongeldige select details query: " .$updatestock_sql. mysql_error();
        $result = false;
      }
      $tracker[$obj->ProductID] = 'existing';
    }
    else
    { // No record insert one.
      $int_current_stock = get_stock($obj->ProductID, $int_owner_id);
      $db_iwex->query("INSERT INTO product_stock SET
                                stock = '$int_current_stock',
                                Product_ID = '$obj->ProductID',
								free_stock = '$int_current_stock',
                                owner_id = '$int_owner_id'");
      $tracker[$obj->ProductID] = 'new';
    }

  }
  //do cleanup, remove all records from the product_stock table that are no longer needed
  $cleanup_sql = "SELECT Product_ID
                  FROM product_stock
                  WHERE owner_id = '$int_owner_id'";
  $all_product_stock_records = $db_iwex->query($cleanup_sql);

  $removeArray = array();
  while ($allStock = mysql_fetch_array($all_product_stock_records, MYSQL_ASSOC))
  {
    if(!array_key_exists( $allStock['Product_ID'], $tracker)) $removeArray[] = $allStock['Product_ID'];
  }
  if($removeArray)
  {
    $cleanupSql = "DELETE FROM product_stock
                        WHERE Product_ID in (" . implode(',', $removeArray ) . ")";
    $db_iwex->query($cleanupSql);
  }
  return $result;

}

/*********************************************************
 * Function     : GetBuyPrice
 * Will return the purchaseprice of product
 * Input        : productid: The id of the product.
 * 					units: how many units of the product
 *					str_date: for which date is the price
 *					int_currencyid: currecy of the buyprice
 *		output:
 *					Message : debug info
 * Returns      : float of with the buying price of the product.
 *********************************************************/
Function GetBuyPrice($int_product_id, 
    $int_stuks,
    $str_date=FALSE,
    $int_currencyid = DB_CURRENCY_DEFAULT,
    $str_message)
{
  $flt_costprice = 0;
  if($int_product_id
      &&
      $int_stuks)
  {
  //first check if the SKU is a multi or a softbundle
    $int_sku = GetField("SELECT sku FROM current_product_list WHERE ProductID = '$int_product_id'" );

    $flt_costprice = 0;
    $str_message = '';

    if ($int_sku == 0
        ||
        $int_sku == 2)
    {
    // now get the parts
      if(getparts(&$result_parts,
      $int_product_id,
      $int_companyID = OWN_COMPANYID))
      { //for all parts, get purchaseprice
        While ($obj_parts = (mysql_fetch_object($result_parts)))
        {
          $flt_costprice_part = GetProductCost($obj_parts->Product_ids,
              $int_stuks * $obj_parts->Aantal,
              $str_date,
              $int_currencyid = DB_CURRENCY_DEFAULT,
              $int_supplier = OWN_COMPANYID);
          $flt_costprice += $flt_costprice_part * $obj_parts->Aantal;
        }
      } else
      { //no parts found but it is multi or soft
        echo "no parts found for $int_product_id";
      }
    } else
    { //not a multi or softbundle
      $flt_costprice = GetSpecialProductPrice(
          $int_product_id,
          $int_stuks,
          OWN_COMPANYID,
          $str_date,
          PRICING_TYPE_PURCHASING,
          '',
          $int_currencyid);
      $str_message .= "lowest part $int_product_id ";
    }
  } else
  {
    $str_message = "Not all parameters are given prodcut id = $int_product_id, number of products = $int_stuks\n";
  }

  return $flt_costprice;
}

/*********************************************************
 * Function     : GetProductPrice
 * Will return the price of product
 * Input        : productid: The id of the product.
 * 				  units: how many units of the product
 *                pricelevel: The price lever to use.
 *                stockowner: Price from this stock owner
 *		type: 1 sales 2 purchasing
 * 		int_contactId: for whom is this price
 *		str_date: for which date is the price
 * Returns      : float of with the price of the product.
 *********************************************************/
Function GetProductPrice(
    $int_product_id,
    $int_stuks,
    $int_pricelevel = 1,
    $int_stock_owner = OWN_COMPANYID,
    $int_type = PRICING_TYPE_SALE,
    $int_contactID='',
    $str_date=FALSE,
    $int_currencyid = DB_CURRENCY_DEFAULT
)
{
//	$flt_price = 0;
//	if (!$str_date
//		||
//		$str_date == '0000-00-00'
//		) {
//		$str_date = "'".date("Y-m-d")."'";
//    } else {
//        $str_date = "'".$str_date."'";
//    }
//
//    // When it is not own stock set the price to 0.
//    if ($int_stock_owner != OWN_COMPANYID) return 0;
//
//    $price_sql = "SELECT Selling_price, Selling_price_10, Selling_price_50, Selling_price_100, Purchase_price_home
//				FROM current_product_list WHERE ProductID = '$int_product_id'";
//
//    $qry_price = mysql_query($price_sql)
//          or die("Ongeldig GetProductPrice query: " .$price_sql. mysql_error());
//    $obj = mysql_fetch_object($qry_price);
//    $int_cust_id = 0;
//	if ($int_type == PRICING_TYPE_SALE) // sales price
//	{
//		if (is_null($obj->Selling_price)) {
//		   $flt_price = NULL;
//		 } else {
//		   switch ($int_pricelevel) {
//			  case 1:
//				/*if ($int_stuks<10) {
//					$flt_price = $obj->Selling_price;
//				} else if ($int_stuks<50) {
//					$flt_price = $obj->Selling_price_10;
//				} else if ($int_stuks<100) {
//					$flt_price = $obj->Selling_price_50;
//				} else {
//					$flt_price = $obj->Selling_price_100;
//				}*/
//                $flt_price = GetSpecialProductPrice($int_product_id,
//                                                    $int_stuks,
//                                                    0,
//                                                    $str_date,
//                                                    $int_type,
//                                                    &$int_cust_id);
//				break;
//			  case 2:
//				//$flt_price = $obj->Selling_price_10;
//                $flt_price = GetSpecialProductPrice($int_product_id,
//                                                    10,
//                                                    0,
//                                                    $str_date,
//                                                    $int_type,
//                                                    &$int_cust_id);
//				break;
//			  case 3:
//				//$flt_price = $obj->Selling_price_50;
//                $flt_price = GetSpecialProductPrice($int_product_id,
//                                                    50,
//                                                    0,
//                                                    $str_date,
//                                                    $int_type,
//                                                    &$int_cust_id);
//				break;
//			  case 4:
//				//$flt_price = $obj->Selling_price_100;
//                $flt_price = GetSpecialProductPrice($int_product_id,
//                                                    100,
//                                                    0,
//                                                    $str_date,
//                                                    $int_type,
//                                                    &$int_cust_id);
//				break;
//			  default:
//				$flt_price = NULL;
//				break;
//		   }
//           //echo "int_pricelevel $int_pricelevel price is $flt_price, $int_product_id, $int_stuks <Br>";
//		}
//	}
//  else if ($int_type == PRICING_TYPE_PURCHASING) // purchase price
//	{
//		$flt_price = $obj->Purchase_price_home;
//	} else {
//		echo "<H2>Function GetProductPrice called with incorrect price type ($int_type)</H2>";
//		return FALSE;
//	}
//
//	mysql_free_result($qry_price);
//	//echo 'price: ' . $flt_price;
  $special_price = GetSpecialProductPrice($int_product_id,
      $int_stuks,
      $int_contactID,
      $str_date,
      $int_type,
      &$int_cust_id,
      $int_currencyid);
  //    echo "<br>$int_product_id, Special Price:$special_price flt_price = $flt_price inkoop = ".(int)($int_type == PRICING_TYPE_PURCHASING)." ";
  //    $flt_price = $special_price > 0
  //				 &&
  //				 ($int_cust_id == $int_contactID
  //                  ||
  //                  $int_type == PRICING_TYPE_PURCHASING)
  //                 ? $special_price : $flt_price;
  //

  echo "old function use GetSpecialProductprice, stacktrace:<pre>";
  debug_print_backtrace();
  echo "<pre>";
  return $special_price;
}

/*********************************************************
 * Function     : GetSpecialProductPrice
 * Will return a predefined  price of product for the given contact
 * return the lowest when buying (2) and the highest when selling(1)
 *
 *    @param   $int_productid
 *    @param   $int_stuks
 *    @param   $int_contactID='' 0 when not special, else customer id when this price is special for this customer.
 *    @param   $str_date
 *    @param   $int_type = PRICING_TYPE_SALE,
 *    @param   $int_stock_owner = OWN_COMPANYID
 *    @param   $int_currencyid = DB_CURRENCY_DEFAULT
 *
 *   @return      : float of with the price of the product.
 *  *********************************************************/

Function GetSpecialProductPrice(
    $int_productid,
    $int_units,
    $int_contactID,
    $str_date,
    $int_type=PRICING_TYPE_SALE,
    $int_customer = FALSE,
    $int_currencyid = DB_CURRENCY_DEFAULT)
{
  global $db_iwex;

  $flt_price = FALSE;
  $flt_price_default = FALSE;

  //first make sure we have a date
  if (!$str_date
      ||
      $str_date == '0000-00-00'
  )
  {
  // when no date given, do today
    $str_date = "'".date("Y-m-d")."'";
  } else
  {
  //otherwise qoute the date
    $str_date = "'".$str_date."'";
  }

  if ($int_type == PRICING_TYPE_PURCHASING)
  {
    $price_kind = 'purchase_price';
    $sql_cust_select = "";
    $str_order = "$price_kind ASC";
    $numbers = '';
    $table = 'pricing_purchase';
  } else
  {
    $price_kind = 'amount';
    $sql_cust_select = "AND (ContactID='$int_contactID' OR ContactID=0)";
    $str_order = "ContactID DESC;";
    $numbers = " AND (start_number <= '$int_units' || isnull(start_number) || start_number=0)
                     AND (end_number >= '$int_units' || isnull(end_number) || end_number=0)";
    $table = 'pricing';
  }

  $price_sql_default = "SELECT $price_kind, ContactID, currencyid FROM $table
						  WHERE ProductID = '$int_productid' 
      $sql_cust_select
 					  	  AND (start_date <= $str_date || isnull(start_date) || start_date=0) 
                      	  AND (end_date >= $str_date || isnull(end_date) || end_date=0)
      $numbers ";

  $price_sql = $price_sql_default . " ORDER BY " . $str_order;
  //echo "<pre>$price_sql</pre>";
  $qry_desc = $db_iwex->query($price_sql);

  $int_cur_price_id = FALSE;
  if ($array = mysql_fetch_array($qry_desc))
  {
  //var_dump($array);
    $flt_price = $array[0];
    $int_customer = $int_contactID == $array[1] ? $array[1] : FALSE;
    $int_cur_price_id = $array[2];
  }
  // now compare the default curreny with the one for the found price.
  if($int_cur_price_id
      &&
      $int_cur_price_id != $int_currencyid)
  {
    //echo "Currency in the special price: $int_cur_price_id does not match the default currency $int_currencyid";
    $flt_currencyrate = getfield("SELECT ValutaXrate FROM valuta WHERE ValutaID = '$int_currencyid' ");
    $flt_currencyrate_new = getfield("SELECT ValutaXrate FROM valuta WHERE ValutaID = '$int_cur_price_id' ");
    //echo "($int_productid: $flt_price * exchangerate: " . $flt_currencyrate_new . ") <BR>"; // show xchange rate
    $flt_price = $flt_price/$flt_currencyrate*$flt_currencyrate_new;
  }

  mysql_free_result($qry_desc);

  // Get prices from the companies main prices.
  $ary_head_ids = GetHeadContacts($int_contactID);
  //var_dump($ary_head_ids);
  if ($ary_head_ids && !$int_customer) foreach ($ary_head_ids as $cust_id)
    {
    //echo "Head ID van $int_contactID = $cust_id <br>";
      $int_head_id = FALSE;
      $flt_head_price = GetSpecialProductPrice($int_productid,
          $int_units,
          $cust_id,
          $str_date,
          $int_type,
          &$int_head_id,
          $int_currencyid);
      //echo "$int_head_id ? $flt_head_price : $flt_price;<br>";
      // Only use the price when the price is valid for one its head prices.
      if ($int_head_id)
      {
        $flt_price = $flt_head_price;
        $int_customer = $int_contactID;
      }
    }
  return $flt_price ;
}

/*********************************************************
 * Function     : GetProductDescription
 * Will return description of the product
 * Input        : productid: The id of the product.
 * Returns      : String with the product description.
 *********************************************************/
Function GetProductDescription($int_product_id)
{
  $str_description = "";

  $description_sql = "SELECT Productdescription"
      . " FROM current_product_list WHERE ProductID = '$int_product_id'";

  $qry_desc = mysql_query($description_sql)
      or die("Ongeldig GetProductDescription query: " .$description_sql. mysql_error());
  $obj = mysql_fetch_object($qry_desc);

  $str_description = $obj->Productdescription;

  mysql_free_result($qry_desc);

  return $str_description;
}

/*********************************************************
 * Function     : GetProductName
 * Will return name of the product
 * Input        : productid: The id of the product.
 * Returns      : String with the product name.
 *********************************************************/
Function GetProductName($int_product_id)
{
  $str_description = "";

  $description_sql = "SELECT ProductName"
      . " FROM current_product_list WHERE ProductID = '$int_product_id'";

  $qry_desc = mysql_query($description_sql)
      or die("Ongeldig GetProductName query: " .$description_sql. mysql_error());
  $obj = mysql_fetch_object($qry_desc);

  $str_description = $obj->ProductName;

  mysql_free_result($qry_desc);

  return $str_description;
}

/*********************************************************
 * Function     : GetProductMerk
 * Will return Merk of the product
 * Input        : int_brand_id: The id of the brand.
 * Returns      : String with the product Merk.
 *********************************************************/
Function GetProductMerk($int_brand_id)
{
  $str_description = "";

  if ($int_brand_id)
  {
    $description_sql = "SELECT name FROM brand WHERE brand_id = '$int_brand_id'";
    $qry_desc = mysql_query($description_sql)
        or die("Ongeldig GetProductMerk query: " .$description_sql. mysql_error());
    $obj = mysql_fetch_object($qry_desc);

    $str_description = $obj->name;

    mysql_free_result($qry_desc);
  }
  return $str_description;
}

/*********************************************************
 * Function     : GetProductExternalID
 * Will return external ID of the product
 * Input        : productid: The id of the product.
 * Returns      : String with the external id name.
 *********************************************************/
Function GetProductExternalID($int_product_id)
{
  return GetField("SELECT ExternalID
                    FROM current_product_list
                    WHERE ProductID = '$int_product_id'");;
}

/*********************************************************
 * Function     : GetDefaultShipAdresId
 * Will return the default ship adresId of this customer
 * Input        : customerid: The id of the customer.
 * Returns      : ID of the adres.
 *********************************************************/
Function GetDefaultShipAdresId($int_custid)
{
  $int_adres_id = 0;

  if ($int_custid)
  {
    $sql_adres = "SELECT AdresID
		    		  FROM Adressen
		    		  WHERE ContactID = $int_custid AND NOT (adrestitel = 2 OR adrestitel = 7)
					  ORDER BY adrestitel = 3 desc, adrestitel = 1 desc, adrestitel = 4 desc, adrestitel asc";

    $qry_adr = mysql_query($sql_adres)
        or die("Ongeldig GetDefaultShpAdresId query: " .$sql_adres. mysql_error());
    $obj = mysql_fetch_object($qry_adr);

    $int_adres_id = $obj->AdresID;

    mysql_free_result($qry_adr);
  }
  return $int_adres_id;
}

/*********************************************************
 * Function     : GetOrderLock
 * Will return if the order is locked
 * Input        : orderid: The id of the order.
 * Returns      : True when locked, false otherwise.
 *********************************************************/
Function GetOrderLock($int_order_id)
{
  $bl_lock = TRUE;

  if ($int_order_id)
  {
    $sql_adres = "SELECT Locked_yn
		    		  FROM orders
		    		  WHERE OrderID = $int_order_id";

    $qry_adr = mysql_query($sql_adres)
        or die("Ongeldig GetOrderLock query: " .$sql_adres. mysql_error());
    $obj = mysql_fetch_object($qry_adr);

    $bl_lock = $obj->Locked_yn;

    mysql_free_result($qry_adr);
  }
  return $bl_lock;
}

/**
 * Function     : GetOrderCost
 * Will return the ordercost for this customer
 * Input        : int_order_id: The id of the order.
 *                flt_amount, the amount of the order excl. VAT
 *                bl_weborder, when this is a web order.
 * Output       : flt_ordercost, the order cost to be calculated
 *                flt_shippingcost, the shipping cost te be calculated
 * Returns      : True when output is valid. False otherwise.
 **/
Function GetOrderCost($int_order_id,
    $flt_amount,
    $bl_weborder,
    $flt_ordercost,
    $flt_shippingcost,
    $bl_realcost=FALSE)
{
    /* alter table `iwex`.`contacts` ,add column `ordercost_type_id` tinyint (2) UNSIGNED  DEFAULT '1' NOT NULL after `transportcost`
    */
  global $db_iwex;
  $db_iwex = new DB();
  $bl_result = FALSE;
  $flt_ordercost = DEF_ORDERCOST_OTHER;
  $flt_shippingcost = DEF_TRANSCOST;

  $qyr = $db_iwex->query("SELECT `WebOrderCost`, `MinWebOrderAmount`, `OrderCost`, `MinOrderAmount`, `ShippingCost`,
                                   `RealCost`
                            FROM orders
                            INNER JOIN contacts ON orders.ContactID = contacts.ContactID
                            INNER JOIN ordercost_type ON OrderCostID = ordercost_type_id
                            WHERE OrderID = '$int_order_id'");

  if ($obj = mysql_fetch_object($qyr))
  {
    $flt_shippingcost = $obj->ShippingCost;

    if ($bl_weborder)
    {
      $flt_ordercost = $flt_amount < $obj->MinWebOrderAmount ? $obj->WebOrderCost : 0;
    } else
    {
      $flt_ordercost = $flt_amount < $obj->MinOrderAmount ? $obj->OrderCost : 0;
    }

    $bl_result = TRUE;
  }
  $sql = "SELECT plaats, postcode, land, sum(weight_corr*Quantity) AS weight,
                                        Prive_adres
                                 FROM order_details
                                 INNER JOIN orders ON order_details.OrderID = orders.OrderID
                                 INNER JOIN Adressen ON orders.ShipID = Adressen.AdresID
                                 LEFT JOIN current_product_list ON order_details.ProductID = current_product_list.ProductID
                                 LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID
                                 WHERE order_details.OrderID = '$int_order_id'
                                 GROUP BY order_details.OrderID;";
  $qry_cost = $db_iwex->query($sql);
  if ($obj_cost = mysql_fetch_object($qry_cost))
  {
    if ($obj->RealCost
        ||
        $bl_realcost)
    {
      if ($GLOBALS["ary_config"]['ups_enabled'])
      {
        $ups = new GetupsShipping();
        $ups->Shipment($obj_cost->plaats,
            $obj_cost->postcode,
            $obj_cost->land,
            $obj_cost->weight*1.2, // Extra packing and air margin
            $obj_cost->Prive_adres);

        if ($ups->Rate(&$flt_amount))
        {
          $flt_shippingcost = $flt_amount;
        } else
        {
          echo $ups->ShowError() . "<h2>Default ".DEF_TRANSCOST." euro shipping cost will be calculated</h2>";
          $flt_shippingcost = DEF_TRANSCOST; // Default shipment cost
        }
        unset($ups);
      } else
      {
        echo "Weight calculation disabled";
        $flt_shippingcost = DEF_TRANSCOST; // Default shipment cost
      }
    }  else if ($obj_cost->land == 'NL')
      {
        $flt_shippingcost = 0; // No shipping cost within the netherlands.
      }
    mysql_free_result($qry_cost);
  }

  mysql_free_result($qyr);

  return $bl_result;
}

/*********************************************************
 * Function     : SetOrderCost
 * Will set the correct order cost for the order detail
 * records
 * Input        : int orderID: The id of the order.
 * 				: bool order: True, when it needs to be set
 * 				: bool transport: True, when it needs to be set
 * Returns      : Total price of the order excl VAT.
 *********************************************************/
Function SetOrderCost($int_order_id, $flt_order = 13.50, $bl_man_order = 0, $flt_transport = 5, $bl_man_trans = 0)
{
  if ($int_order_id)
  { //
    $productcost = 0;
    $ordercost = 0;
    $flt_default_ordercost = 0;
    $flt_default_shipcost = 0;
    $bl_BTW = FALSE;
    $bl_in_NL = FALSE;
    $bl_man_order = $bl_man_order ? TRUE : FALSE;
    $bl_man_trans = $bl_man_trans ? TRUE : FALSE;
    $bl_webuser_order = FALSE;

    //    	echo "order id $int_order_id, order cost $flt_order, bl_man $bl_man_order, flt_trans $flt_transport, man $bl_man_trans";

    getorderdetails(&$qyr_orderdetals, $int_order_id);

    // Get the total product cost.
    while ($objorderdet = mysql_fetch_array($qyr_orderdetals, MYSQL_BOTH))
    {
      if ($objorderdet["Extended_price"] > 0)
      {
        $productcost += $objorderdet["Extended_price"];
      }

      $bl_BTW = $objorderdet["Btw_YN"];
      $bl_webuser_order = $objorderdet["employee"] == DB_WEB_EMPLOYEE;
    }

    mysql_free_result($qyr_orderdetals);

    GetOrderCost($int_order_id,
        $productcost,
        $bl_webuser_order,
        &$flt_default_ordercost,
        &$flt_default_shipcost);

    if (!$bl_man_order)
    {
      $flt_order = $flt_default_ordercost;
    }

    if (!$bl_man_trans)
    {
      $flt_transport = $flt_default_shipcost;
    }

    SetOrderHistory($int_order_id, 'Ordercosts', sprintf("%.2f",$flt_order));
    SetOrderHistory($int_order_id, 'Transportcosts', sprintf("%.2f",$flt_transport));

    $updmain_sql = "UPDATE orders SET Ordercosts='$flt_order', Transportcosts='$flt_transport'"
        .", manual_ordercosts = '$bl_man_order', manual_transportcosts='$bl_man_trans'"
        ." WHERE OrderID = " . $int_order_id;
    $rmadetail_update = mysql_query($updmain_sql)
        or die("Ongeldige update query: " .$updmain_sql. mysql_error());

    $ordercost += $flt_order + $flt_transport;

    //Update records.
    getorderdetails(&$qyr_orderdetals, $int_order_id);

    // Get the total product cost.
    while ($objorderdet = mysql_fetch_array($qyr_orderdetals, MYSQL_BOTH))
    {
    // Credits and products for 0 euro should not have shipping cost.
      if ($objorderdet["Extended_price"] > 0)
      {
        $cost_per_unit = (float) $ordercost / $productcost * $objorderdet["UnitPrice"];
      } else
      {
        $cost_per_unit = 0;
      }
      $btw_perce = $bl_BTW ? GetBtwClass($objorderdet["ProductID"]) : 0;
      $btw_value = (float)$btw_perce * $objorderdet["UnitPrice"];

      $qry = "UPDATE order_details SET cost_percentage='$cost_per_unit', "
          ." UnitBTW='$btw_value', btw_percentage='$btw_perce'"
          ." WHERE OrderDetailsID=".$objorderdet["OrderDetailsID"];
      $queryres = mysql_query($qry)
          or die("update van de orderdetails niet gelukt: order " .$qry." error:". mysql_error());

    }
    mysql_free_result($qyr_orderdetals);
  } else
  {
    echo "function SetOrderCost called without parameter";
  }
  return $productcost;
}

/**
 * Function     : SetOrderHistory
 * Wil set a new field in the order history table. When
 * the new value is different from the old one.
 * Input        : int_order_id: The order id.
 *                str_field_name: The name of the field in orders
 *                str_new_value: The new value
 *                bl_db_field: 1, When it is a database field
 *                str_old_value: When it is no database field use this one.
 * Returns      : True when data is inserted.
 **/
Function SetOrderHistory($int_order_id,
    $str_field_name,
    $str_new_value,
    $bl_db_field = TRUE,
    $str_old_value = '')
{
  global $db_iwex;
  $bl_result = FALSE;

  if ($str_field_name
      &&
      $int_order_id)
  {
    if ($bl_db_field)
    {
      $str_old_value = GetField("SELECT $str_field_name
                                       FROM orders 
                                       WHERE OrderID = '$int_order_id'");
    }
    //echo "$str_old_value != $str_new_value<br>";
    if ($str_old_value != $str_new_value)
    {
      $str_new_value = $str_new_value == '' ? "-" : addslashes($str_new_value);
      $str_old_value = addslashes($str_old_value);

      $db_iwex->query("INSERT INTO order_history
                             SET OrderID = '$int_order_id', 
                                 employee = '".$GLOBALS["employee_id"]."',
                                 old_value = '$str_old_value',
                                 new_value = '$str_new_value',
                                 date_modified = NOW(),
                                 FieldName = '$str_field_name'");
      $bl_result = TRUE;
    }
  }

  return $bl_result;
}

/**
 * Function     : SetProductHistory
 * Wil set a new field in the order history table. When
 * the new value is different from the old one.
 * Input        : int_product_id: The product id.
 *                str_field_name: The name of the field in current product list
 *                str_new_value: The new value
 *                bl_db_field: 1, When it is a database field
 *                str_old_value: When it is no database field use this one.
 * Returns      : True when data is inserted.
 **/
Function SetProductHistory($int_product_id,
    $str_field_name,
    $str_new_value,
    $bl_db_field = TRUE,
    $str_old_value = '')
{
  global $db_iwex;
  $bl_result = FALSE;

  if ($str_field_name
      &&
      $int_product_id)
  {
    if ($bl_db_field)
    {
      $str_old_value = GetField("SELECT $str_field_name
											FROM current_product_list 
											WHERE ProductID  = '$int_product_id'");
    }
    if(empty($str_old_value))
    {
      $str_old_value = 0;
    }
    //echo "$str_old_value != $str_new_value<br>";
    if ($str_old_value != $str_new_value)
    {
      $str_new_value = $str_new_value == '' ? "-" : addslashes($str_new_value);
      $str_old_value = addslashes($str_old_value);

      $db_iwex->query("INSERT INTO product_history
                             SET ProductID = '$int_product_id', 
                                 employee = '".$GLOBALS["employee_id"]."',
                                 old_value = '$str_old_value',
                                 new_value = '$str_new_value',
                                 date_modified = NOW(),
                                 FieldName = '$str_field_name'");
      $bl_result = TRUE;
    }
  }

  return $bl_result;
}

/**
 * Function     : LogSpecialPrice
 * Log a query why this is a special price?
 * Input        : invalid: must have a parameter for popup.php
 * Returns      : true
 **/
Function LogSpecialPrice($int_invalid)
{
  global $db_iwex;

  $int_order_detail_id = isset($_REQUEST['orderdetailid']) ? $_REQUEST['orderdetailid'] : FALSE;
  $flt_price = isset($_REQUEST['newprice']) ? $_REQUEST['newprice'] : FALSE;
  $str_pricefield = isset($_REQUEST['pricefield']) ? $_REQUEST['pricefield'] : FALSE;
  $str_checked = isset($_REQUEST['checked']) ? $_REQUEST['checked'] : FALSE;
  $flt_price = $str_checked ? 'Auto' : $flt_price;

  $sql_row = "SELECT order_details.Quantity, order_details.ProductID, order_details.OrderID,"
      . ' UnitPrice, orders.ContactID, '
      . ' current_product_list.ProductName'
      . ' FROM order_details'
      . ' LEFT JOIN current_product_list ON order_details.ProductID = current_product_list.ProductID '
      . ' INNER JOIN orders ON order_details.OrderID = orders.OrderID'
      . " WHERE order_details.OrderDetailsID = '$int_order_detail_id'";

  if (isset($_POST["notesNew"]) && $_POST["notesNew"])
  {
    $qry_row = $db_iwex->query($sql_row);

    if ($obj = mysql_fetch_object($qry_row))
    {
      if ($flt_price !== FALSE)
      {
        SetOrderHistory($obj->OrderID,
            ($str_checked ? 'Auto' : 'Manual')." price",
            "&euro; $flt_price",
            0,
            "Product $obj->ProductID. Reason:<br>".$_POST["notesNew"]);
        echo "<SCRIPT>window.close();\n</SCRIPT>";
      }
    }
    mysql_free_result($qry_row);
  } else if (isset($_POST['submit']))
    {
      echo "<h2>Reden moet ingevuld zijn!</h2>";
    }

  echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";

  echo "<tr><td>Nieuwe prijs is:</td><td><input type=text name=newprice size=\"6\" value='$flt_price' onChange=\"top.opener.document.$str_pricefield.value=this.value\"></td></tr>\n";
  echo "<tr><td>Gespreks/e-mail verslag/reden speciale prijs:</td><td><textarea name=\"notesNew\" cols=\"50\" rows=\"2\"></textarea></td></tr>\n";
  echo "</table>";
  echo "<input type=hidden name=orderdetailid value='$int_order_detail_id'>\n";
  echo "<input type=hidden name=pricefield value='$str_pricefield'>\n";
  echo "<input type=hidden name=checked value='$str_checked'>\n";

  echo "<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\">";
}


/**
 * Function     : UpdateAllPrices
 * Updating the prices and edit the history
 * Input        : productid
 * Returns      :array of updated Products ids.
 **/
function UpdateAllPrices($int_product_id = FALSE)
{

  global $db_iwex;

  // Array of updated products.
  $updatedid = false;

  if($int_product_id)
  {
    $all_prod_id = $db_iwex->query("select ProductID, Margin_correction from current_product_list where ProductID = '$int_product_id' ");
  } else
  {
    $all_prod_id = $db_iwex->query("SELECT ProductID, Margin_correction from current_product_list
										WHERE Pricelist_yn OR Discontinued_yn = FALSE");
  }

  while($all_prod = mysql_fetch_array($all_prod_id))
  {
    $product_id = $all_prod["ProductID"];

    // Select old prices from the database
    $results_prices_old = $db_iwex->query("SELECT Purchase_price_home, Retail_price_ex, Selling_price, Selling_price_10, Selling_price_50, Selling_price_100, Price_discovery  FROM `current_product_list`
												where ProductID = '$product_id' ");
    $prices_old = mysql_fetch_array($results_prices_old);
    $prodcosthomeold = $prices_old["Purchase_price_home"];
    $Retailpriceexold = $prices_old["Retail_price_ex"];
    $Sellingpriceold = $prices_old["Selling_price"];
    $Sellingprice10old = $prices_old["Selling_price_10"];
    $Sellingprice50old = $prices_old["Selling_price_50"];
    $Sellingprice100old = $prices_old["Selling_price_100"];
    $Pricediscoveryold = $prices_old["Price_discovery"];

    // Updating the prices
    $db_iwex->query("update current_product_list, valuta set Purchase_price_home = Purchase_price_foreign*valuta.ValutaXrate*1.04 where ProductID = '$product_id' and currency = valuta.ValutaID and currency <> 2 and Purchase_price_foreign <> 0 ");
    $db_iwex->query("update current_product_list set 	Retail_price_ex = (Purchase_price_home+extra_cost)*Margin_correction*1.85,
															Selling_price = (Purchase_price_home+extra_cost)*Margin_correction*1.30,
															Selling_price_10 = (Purchase_price_home+extra_cost)*Margin_correction*1.20,
															Selling_price_50 = (Purchase_price_home+extra_cost)*Margin_correction*1.15,
															Selling_price_100 = (Purchase_price_home+extra_cost)*Margin_correction*1.10
															where ProductID = '$product_id' and Margin_correction<>0 ");
    $db_iwex->query("update current_product_list set 	Retail_price_ex = (Purchase_price_home+extra_cost)*Margin_correction*2.35,
															Selling_price = (Purchase_price_home+extra_cost)*Margin_correction*1.50
															where ProductID = '$product_id' and Margin_correction<>0 and Purchase_price_home<15 ");
    $db_iwex->query("update current_product_list set 	Selling_price_10 = (Purchase_price_home+extra_cost)*Margin_correction*1.30,
															Selling_price_50 = (Purchase_price_home+extra_cost)*Margin_correction*1.25,
															Selling_price_100 = (Purchase_price_home+extra_cost)*Margin_correction*1.20
															where ProductID = '$product_id' and Margin_correction<>0 and Purchase_price_home<15 and Merk <>'HR Richter' ");
    $db_iwex->query("update current_product_list set 	Price_discovery = (Purchase_price_home+extra_cost)*Margin_correction*1.60 where ProductID = '$product_id' and Margin_correction<>0 ");
    $db_iwex->query("update current_product_list set 	Price_discovery = (Purchase_price_home+extra_cost)*Margin_correction*1.90 where ProductID = '$product_id' and Margin_correction<>0 and Purchase_price_home<15 ");

    // Select the new prices from the database
    $results_prices_new = $db_iwex->query("SELECT Purchase_price_home, Retail_price_ex, Selling_price, Selling_price_10, Selling_price_50, Selling_price_100, Price_discovery  FROM `current_product_list`
											where ProductID = '$product_id' "); 
    $prices_new = mysql_fetch_array($results_prices_new);
    $prodcosthomenew = $prices_new["Purchase_price_home"];
    $Retailpriceexnew = $prices_new["Retail_price_ex"];
    $Sellingpricenew = $prices_new["Selling_price"];
    $Sellingprice10new = $prices_new["Selling_price_10"];
    $Sellingprice50new = $prices_new["Selling_price_50"];
    $Sellingprice100new = $prices_new["Selling_price_100"];
    $Pricediscoverynew = $prices_new["Price_discovery"];

    // check if the product already exist in the pricing table
    $results_pricing_prices = $db_iwex->query("SELECT recordID, amount, start_date, end_date, productID, price_type, start_number, end_number
                                                   FROM pricing 
												   WHERE ProductID = '$product_id' AND NOT ContactID 
                                                   ORDER BY recordID desc");
    // Set insert variabels for inserting.
    $bl_insert_price_1 = TRUE;
    $bl_insert_price_10 = TRUE;
    $bl_insert_price_50 = TRUE;
    $bl_insert_price_100 = TRUE;
    // set variabels for updating.
    $bl_update_price_1 = FALSE;
    $bl_update_price_10 = FALSE;
    $bl_update_price_50 = FALSE;
    $bl_update_price_100 = FALSE;
    echo $all_prod->Margin_correction;
    if ($all_prod["Margin_correction"] > 0)
    {
      while($obj_pricings = mysql_fetch_object($results_pricing_prices))
      {
        $bl_update = FALSE;
        $bl_update_price = FALSE;
        // Filter the default prices from the results If exist disable a new insert.
        if ($obj_pricings->start_number == 100  && $bl_insert_price_100)
        {
          $bl_insert_price_100 = FALSE;
          if ($obj_pricings->amount != $prices_new["Selling_price_100"])
          {
            if ($obj_pricings->start_date == date("Y-m-d"))
            {
              $bl_update_price = $prices_new["Selling_price_100"];
            } else
            {
              $bl_update_price_100 = TRUE;
              $bl_update = TRUE;
            }
          }
        } else if ($obj_pricings->start_number == 50 && $bl_insert_price_50)
          {
            $bl_insert_price_50 = FALSE;
            if ($obj_pricings->amount != $prices_new["Selling_price_50"])
            {
              if ($obj_pricings->start_date == date("Y-m-d"))
              {
                $bl_update_price = $prices_new["Selling_price_50"];
              } else
              {
                $bl_update_price_50 = TRUE;
                $bl_update = TRUE;
              }
            }
          }  else if ($obj_pricings->start_number == 10  && $bl_insert_price_10)
            {
              $bl_insert_price_10 = FALSE;
              if ($obj_pricings->amount != $prices_new["Selling_price_10"])
              {
                if ($obj_pricings->start_date == date("Y-m-d"))
                {
                  $bl_update_price = $prices_new["Selling_price_10"];
                } else
                {
                  $bl_update_price_10 = TRUE;
                  $bl_update = TRUE;
                }
              }
            }  else if ($obj_pricings->start_number == 1  && $bl_insert_price_1)
              {
                $bl_insert_price_1 = FALSE;
                if ($obj_pricings->amount != $prices_new["Selling_price"])
                {
                  if ($obj_pricings->start_date == date("Y-m-d"))
                  {
                    $bl_update_price = $prices_new["Selling_price"];
                  } else
                  {
                    $bl_update_price_1 = TRUE;
                    $bl_update = TRUE;
                  }
                }
              }

        // If the price is set end date from the old one.
        if ($bl_update)
        {
          $db_iwex->query("update pricing SET
									 end_date = '(DATE_ADD(CURRENT_DATE(), INTERVAL -1 DAY))',
									 modified = '" . date(DATEFORMAT_LONG) ."', 
									 modified_by = '" . $GLOBALS["employee_id"] . "'
									 WHERE recordID = '" . $obj_pricings->recordID . "' and start_number = '" . $obj_pricings->start_number . "'");	
        }
        if ($bl_update_price)
        {
          $db_iwex->query("update pricing
									 SET amount = '$bl_update_price', 
									 	 modified = '" . date(DATEFORMAT_LONG) ."', 
									 	 modified_by = '" . $GLOBALS["employee_id"] . "'
									 WHERE recordID = '" . $obj_pricings->recordID . "' and start_number = '" . $obj_pricings->start_number . "'");	
        }
      }
      $db_iwex->free_result($results_pricing_prices);
      if ($bl_insert_price_1 || $bl_update_price_1)
      {
        $db_iwex->query("INSERT INTO pricing(amount, start_date, productID, price_type, created, created_by ,start_number, end_number)
									 VALUES('" . $prices_new["Selling_price"] . "','" 
            . date("Y-m-d") . "','" . $product_id . "','1','"
            . date(DATEFORMAT_LONG) ."','"
            . $GLOBALS["employee_id"] ."','1','9')");
      }
      if ($bl_insert_price_10 || $bl_update_price_10)
      {
        $db_iwex->query("INSERT INTO pricing(amount, start_date, productID, price_type, created, created_by ,start_number, end_number)
									 VALUES('" . $prices_new["Selling_price_10"] . "','" 
            . date("Y-m-d") . "','"
            . $product_id . "','1','"
            . date(DATEFORMAT_LONG) ."','"
            . $GLOBALS["employee_id"] ."','10','49')");
      }
      if ($bl_insert_price_50 || $bl_update_price_50)
      {
        $db_iwex->query("INSERT INTO pricing(amount, start_date, productID, price_type, created, created_by, start_number, end_number)
								 VALUES('" . $prices_new["Selling_price_50"] . "','" 
            . date("Y-m-d") . "','"
            . $product_id . "','1','"
            . date(DATEFORMAT_LONG) ."','"
            . $GLOBALS["employee_id"] ."','50','99')");
      }
      if ($bl_insert_price_100 || $bl_update_price_100)
      {
        $db_iwex->query("INSERT INTO pricing(amount, start_date, productID, price_type, created, created_by, start_number, end_number)
								 VALUES('" . $prices_new["Selling_price_100"] . "','" 
            . date("Y-m-d") . "','" . $product_id . "','1','"
            . date(DATEFORMAT_LONG) ."','"
            . $GLOBALS["employee_id"] ."','100','0')");
      }
    }

    // At last updating the Product history
    $bl_ok_1 = SetProductHistory($product_id, "Purchase_price_home", $prodcosthomenew, FALSE, $prodcosthomeold);
    $bl_ok_2 = SetProductHistory($product_id, "Retail_price_ex", $Retailpriceexnew, FALSE, $Retailpriceexold);
    $bl_ok_3 = SetProductHistory($product_id, "Selling_price", $Sellingpricenew, FALSE, $Sellingpriceold);
    $bl_ok_4 = SetProductHistory($product_id, "Selling_price_10", $Sellingprice10new, FALSE, $Sellingprice10old);
    $bl_ok_5 = SetProductHistory($product_id, "Selling_price_50", $Sellingprice50new, FALSE, $Sellingprice50old);
    $bl_ok_6 = SetProductHistory($product_id, "Selling_price_100", $Sellingprice100new, FALSE, $Sellingprice100old);
    $bl_ok_7 = SetProductHistory($product_id, "Price_discovery", $Pricediscoverynew, FALSE, $Pricediscoveryold);

    if($bl_ok_1 || $bl_ok_2 || $bl_ok_3 || $bl_ok_5 || $bl_ok_6 || $bl_ok_7)
    {
      $updatedid[] = $product_id;
    }
    mysql_free_result($results_prices_old);
    mysql_free_result($results_prices_new);
  }
  mysql_free_result($all_prod_id);

  return $updatedid;
}

/**
 * Function     : creating_product_table
 * Showing a result tabel
 * Input        : $querysearch: search string
 : $str_keyword: searching word
 : $str_prodbrand:
 : $str_prodcategory: Productcaregorie
 : $str_sortfield: Field for sort the results
 : $str_orderby:
 * Returns     : Html table string
 **/

function creating_product_table($querysearch, $str_keyword, $str_prodbrand, $str_prodcategory, $str_sortfield, $str_orderby)
{
  global $db_iwex;

  $resultsearch = $db_iwex->query($querysearch);
  $int_numbersearch = mysql_numrows($resultsearch);

  $x=0;

  $str_return = "<table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\" width=\"100%\">\n";

  ///titel van de tabel met gevonden zoekresultaten.

  $str_return .= "<TR>\n";
  $int_number_of_fields = mysql_num_fields($resultsearch);
  for ($i = 0; $i < $int_number_of_fields; $i++)
  {
    $str_fieldname = mysql_field_name($resultsearch, $i);
    $str_return .= "<TH CLASS=\"menubar\"><B>";
    if ($str_fieldname == "image")
    {
      $str_return .= $str_fieldname;
    }else if ($str_fieldname != $str_sortfield)
      {
        $str_return .= make_link($str_keyword, $str_prodbrand, $str_prodcategory, $resultsearch, $str_fieldname, "ASC");
        $str_return .= $str_fieldname. "</A>";
      }else if ($str_fieldname == $str_sortfield)
        {
          if ($str_orderby == "ASC")
          {
            $str_return .= make_link($str_keyword, $str_prodbrand, $str_prodcategory, $resultsearch, $str_fieldname, "DESC");
            $str_return .= "" .$str_fieldname. "</A><IMG SRC=\"/images/down.gif\" height=\"10\" width=\"10\">";
          }else
          {
            $str_return .= make_link($str_keyword, $str_prodbrand, $str_prodcategory, $resultsearch, $str_fieldname, "ASC");
            $str_return .= "" .$str_fieldname. "</A><IMG SRC=\"/images/up.gif\" height=\"10\" width=\"10\">";
          }
        }
    $str_return .= "</B></TH>";
  }
  $str_return .= "</TR>\n";

  while($row = mysql_fetch_row($resultsearch))
  {

    if (($x%2)==0)
    {
      $bgcolor="#FFFFFF";
    } else
    {
      $bgcolor="#EAEAEA";
    }
    $str_return .= "<tr bgcolor=$bgcolor>\n";
    foreach($row as $key => $value)
    {
    // Right align the number fields;
      if (is_numeric($value))
      {
        $align = "align=\"right\"";
      } else
      {
        $align = "";
      }
      // get Meta Field info, to cheack name
      $meta = mysql_fetch_field($resultsearch,$key);
      if (!$meta)
      { // what if there is no meta info on the field??
      // don't know...
      }
      //if field is productid field hyperlink it to productmanintenance
      If ($meta->name == "ID")
      {
        $str_return .= "<td $align><a href=\"". PRODUCT_MAINT . "?productid=$value\">$value</a></td>";
        $rowID = $value;
      } else If ($meta->name == "image")
        {
          $str_return .= "<td $align>".ShowImage($rowID,$size=30)."</td>";
        } else If ($meta->name == "stock")
          {
          // When there are more than 10 rows use current stock. Because of the calculation time for free stock.
            $str_return .= "<td $align>".($int_numbersearch > 10 ? "<i>$value</i>" : getfreestock($rowID))."</td>";
          }else
          {
            $str_return .= "<td $align>$value</td>";
          }
    }
    $str_return .= "</tr> \n";
    $x++;
  }

  $str_return .= "</table>\n";

  return $str_return;
}

/**
 * Function     : PrintOrderHistory
 * Show the current history
 * Input        : int_order_id: The order id.
 * Returns      : The HTML output of the history.
 **/
Function PrintOrderHistory($int_order_id)
{
  global $db_iwex;
  $str_return = '';

  if ($int_order_id)
  {
    $str_return = show_table("SELECT date_modified AS Datum, FirstName AS Naam, FieldName AS Veldnaam,
                                  CONCAT_WS(' => ', old_value, new_value) AS Verandering
                                  FROM order_history
                                  LEFT JOIN employees ON employee = EmployeeID
                                  WHERE OrderID = '$int_order_id'");
  }

  return $str_return;
}

/**
 * Function     : PrintProductsHistory
 * Show the current history
 * Input        : int_order_id: The order id.
 * Returns      : The HTML output of the history.
 **/
Function PrintProductsHistory($int_products_id)
{
  global $db_iwex;
  $str_return = '';

  if ($int_products_id)
  {
    $str_return = show_table("SELECT date_modified AS Datum,
								 		 CONCAT_WS(' ', FirstName, middlename, LastName) AS Naam,
										 FieldName AS Veldnaam, 
                                  CONCAT_WS(' => ', old_value, new_value) AS Verandering
                                  FROM product_history
                                  LEFT JOIN employees ON employee = EmployeeID
                                  WHERE ProductID = '$int_products_id' order by datum desc");
  }

  return $str_return;
}

/*********************************************************
 * Function     : GetBtwClass
 * Will return the BTW percentege of the product
 * Input        : productid: The id of the product.
 * Returns      : float with the VAT percentage (0.19 for 19%).
 *********************************************************/
Function GetBtwClass($int_product_id)
{
  $flt_btw_pers = 0;

  $description_sql = "SELECT BTWpercentage"
      . " FROM current_product_list"
      . " INNER JOIN btwtabel ON current_product_list.Btw_class = btwtabel.Btw_class WHERE ProductID = '$int_product_id'";

  $flt_btw_pers = (float) GetField($description_sql) / 100;

  return $flt_btw_pers;
}

/*********************************************************
 * Function     : GetBoxID
 * Will return the Box ID. If there is none one is created.
 * Input        : int_shipmentID: The id of the shipment.
 * 				  int_boxnumber: The number of the box in
 * 								 this shipment.
 *                new, when a new box needs to be made.
 * Returns      : The boxID. False if no box is found.
 *********************************************************/
Function GetBoxID($int_shipmentID, $int_boxnumber, $bl_new = FALSE)
{
  global $db_iwex;
  $int_boxID = FALSE;

  $sql_getbox = "SELECT box.box_ID FROM box
				WHERE Shipment_ID = '$int_shipmentID' AND box_number = '$int_boxnumber'";
  $qry_getbox = $db_iwex->query($sql_getbox);
  if ($obj = mysql_fetch_object($qry_getbox))
  {
    $int_boxID = $obj->box_ID;
  }
  mysql_free_result($qry_getbox);

  // When there is no BOX number for this record add one when requested.
  if ($bl_new && !$int_boxID)
  {
    $sql_addbox = "INSERT INTO box SET box_number = $int_boxnumber, Shipment_ID = $int_shipmentID;";
    $qry_addbox = mysql_query($sql_addbox)
        or die("Ongeldig query: $qry_addbox<br>". mysql_error());
    if ($qry_addbox)
    {
      $int_boxID = mysql_insert_id();
    }
  }

  return $int_boxID;
}

/*********************************************************
 * Function     : GetField
 * Will return the result of the field
 * Input        : sql, the sql string
 * Returns      : The first field of the result.
 *********************************************************/
Function GetField($sql, $db=FALSE)
{
  $result = FALSE;
  if (!$db) $db = new DB();

  if ($qry = $db->query($sql))
    if ($array = mysql_fetch_array($qry))
    {
      $result = $array[0];
      mysql_free_result($qry);
    }

  return $result;
}

/*********************************************************
 * Function     : GetInventoryIDforProduct
 * Will return the invertory ID.
 * Input        : int_shipmentID: The id of the shipment.
 *                int_orderdetails: The id of the orderdetail.
 * 				  int_boxnumber: The number of the box in
 * 								 this shipment.
 * Returns      : The TransactionID. False if no box is found.
 *********************************************************/
function GetInventoryIDforProduct($int_ship_id, $int_orderdetails_id, $int_boxid)
{
  global $db_iwex;
  $int_inventoryid = FALSE;

  $sql_is_already_in_box = 'SELECT TransactionID
                              FROM inventory_transactions
                              WHERE shipmentID = "'.$int_ship_id.'" 
                                AND orderdetailsID = "'.$int_orderdetails_id.'"
                                AND box_ID = "'.$int_boxid.'"';
  $qry_is_already_in_box = $db_iwex->query($sql_is_already_in_box);

  // When there is already one or more of this product in this box.
  if ($obj_is_in_box = mysql_fetch_object($qry_is_already_in_box))
  {
    $int_inventoryid = $obj_is_in_box->TransactionID;
  }
  mysql_free_result($qry_is_already_in_box);

  return $int_inventoryid;
}

/*********************************************************
 * Function     : box
 * will move quantities of products from orderdetails into inventory transactions
 * Input        : int_adresID: id of the adres the box is being shipped to
 *                int_shipmentID: ID of shipment
 *                int_packed_productid: The id of the product put in the box.
 *                int_amount_packed: amount of products packed
 * 				  int_boxnumber: number of the box where the products is placed in.
 *                bl_out: true if you want it shipped out, false if you also want stuff to go back in stock.
 * Output       : int_remainig: number of products that could not be placed on the delivery.
 *                              Will only contain a value when return value is false.
 * Returns      : true if it worked.
 *********************************************************/
Function box($int_adresID, 
    $int_shipmentID,
    $int_packed_productid,
    $int_amount_packed,
    $boxnumber,
    $bl_out=true,
    $int_remainig)
{
  global $GLOBALS, $db_iwex;

  $result = FALSE;
  $int_transactionID = FALSE;
  $int_amount_remaining = $int_amount_packed;
  $int_remainig = 0;
  $bl_positive_amount = $int_amount_packed >= 0;

  // When there is an invoice don't update the records.
  if ($int_invoiceID = GetInvoiceID($int_shipmentID))
  {
    $int_amount_packed = 0;
    $int_remainig = $int_amount_packed;
    echo "<h2 align=center class=\"menubar\">Delivery $int_shipmentID already has an invoice number $int_invoiceID! Products not added to the delivery.</h2>";
    echo "<embed src=\"includes/wrong.wav\" autostart=true hidden=true name=\"wrong_sound\">";
    return FALSE;
  }

  // Check if the shipment is canceld.
  if (GetField("SELECT Cancel FROM shipments WHERE Shipment_ID = '$int_shipmentID'"))
  {
    $int_amount_packed = 0;
    $int_remainig = $int_amount_packed;
    echo "<h2 align=center class=\"menubar\">Delivery $int_shipmentID is canceled! Products not added to the delivery.</h2>";
    echo "<embed src=\"includes/wrong.wav\" autostart=true hidden=true name=\"wrong_sound\">";
    return FALSE;
  }

  $productID_true = Getfield("SELECT ProductID FROM current_product_list WHERE ProductID = '$int_packed_productid'");
  $EAN_true = FALSE;
  $ship_rma_true = FALSE;
  if (!$productID_true)
  {
    $EAN_true = Getfield("SELECT ProductID FROM current_product_list WHERE EAN = '$int_packed_productid'");
    if (!$EAN_true)
    {
      $rma_orderdetails = $db_iwex->query("SELECT OrderDetailsID FROM orders
							INNER JOIN order_details ON orders.OrderID = order_details.OrderID
							INNER JOIN RMA_actions ON order_details.rma_actionID = RMA_actions.ActionID
							WHERE rma_yn = '1' AND RMA_actions.RMAID = '$int_packed_productid'
							AND Complete_yn<>1 AND to_deliver <> 0 AND shipID='$int_adresID'");
      if (mysql_numrows($rma_orderdetails) > 1)
      {
        $ship_rma_true = false;
        echo " More than one order to ship for the RMA, please check open orders";
      } else
      {
		        /*The getfield only gives back one value, the first it finds, we need to
		         * know if there were more than one.*/
        $ship_rma_true = Getfield("SELECT OrderDetailsID FROM orders
						INNER JOIN order_details ON orders.OrderID = order_details.OrderID
						INNER JOIN RMA_actions ON order_details.rma_actionID = RMA_actions.ActionID
						WHERE rma_yn = '1' AND RMA_actions.RMAID = '$int_packed_productid'
						AND Complete_yn<>1 AND to_deliver <> 0 AND shipID='$int_adresID'");
      }
      if ($ship_rma_true)
      {
        $int_amount_remaining = Getfield("SELECT order_details.to_deliver FROM orders
							INNER JOIN order_details ON orders.OrderID = order_details.OrderID
							INNER JOIN RMA_actions ON order_details.rma_actionID = RMA_actions.ActionID
							WHERE rma_yn = '1' AND RMA_actions.RMAID = '$int_packed_productid'
							AND Complete_yn<>1 AND to_deliver <> 0 ");
        $int_amount_packed = $int_amount_remaining;
      }
    }
  }
  // negative number of units means upkacking the box
  if (!$bl_positive_amount
      &&
      !$bl_out
      &&
      !$ship_rma_true)
  {

    $int_out_product = $EAN_true ? $EAN_true : $productID_true;
    return box_unpack($int_adresID,
    $int_shipmentID,
    $int_out_product,
    $int_amount_packed,
    $boxnumber,
    &$int_remainig);
  }
  // first select all details about the first (oldest orderdate) packed product from order
  if ($int_adresID
      &&
      $int_shipmentID
      &&
      ($productID_true
      ||$EAN_true
      ||$ship_rma_true)
      &&
      $int_amount_packed)
  { // now we start transferring it in the box
    while ($int_amount_remaining)
    {
      $packed_orderdetail_sql = SQL_openorderdetails;
      if ($productID_true) $packed_orderdetail_sql .= " WHERE order_details.ProductID = '$productID_true'
                                                                AND NOT rma_yn AND ";
      else if ($EAN_true) $packed_orderdetail_sql .= " WHERE order_details.ProductID = '$EAN_true'
                                                                AND NOT rma_yn AND ";
        else if ($ship_rma_true) $packed_orderdetail_sql .= " WHERE OrderDetailsID = '$ship_rma_true' AND ";
      if ($bl_out)
      {
        if ($bl_positive_amount)
        {
          $packed_orderdetail_sql .= "order_details.to_deliver > 0 ";
        } else
        {
          $packed_orderdetail_sql .= "order_details.to_deliver < 0 ";
        }
      } else
      {
        $packed_orderdetail_sql .= "order_details.to_deliver <> 0 ";
      }
      $packed_orderdetail_sql .= " AND (orders.Confirmed_yn = 1 OR orders.Confirmed_yn = '-1')
			    AND orders.ShipID=".$int_adresID."
				AND (orders.RequiredDate <= date(NOW()) OR ISNULL(orders.RequiredDate))
				ORDER BY Orderdate";
      // When there is a credit use that one first.
      $packed_orderdetail_query = mysql_query($packed_orderdetail_sql)
          or die("Ongeldige select details query: " .$packed_orderdetail_sql. mysql_error());

      $found_records = mysql_num_rows ($packed_orderdetail_query);
      if ($found_records)
      {  // Check if there is stock.
        $int_boxID =GetBoxID($int_shipmentID, $boxnumber, TRUE);
        $obj_packed_orderdetail = mysql_fetch_object($packed_orderdetail_query);
        //echo $packed_orderdetail_sql;

        // because packed article can be EAN or RMA code aswel change it to the coresponding ProdustID
        $int_packed_productid = $obj_packed_orderdetail->ProductID;

        // Check if there is enough stock to be shipped out.
        if (!$obj_packed_orderdetail->sku == DB_SKU_ADMINISTRATION // don't check stock for administration articles
            &&
            !$ship_rma_true     // Don't check the stock for RMA returns
            &&
            $obj_packed_orderdetail->$obj_packed_orderdetail->stock < $int_amount_remaining)
        {
          echo "<h1>Er is niet genoeg voorraad ($obj_packed_orderdetail->stock), eerst aapassen!</h1>";
          echo "<h1 align=center class=\"menubar\">Van product $int_packed_productid  er $int_amount_remaining TERUG LEGGEN!</h1>";
          $int_remainig = $int_amount_remaining;
          $int_amount_remaining = 0;
          echo MakeBeep(FALSE);
          return FALSE;
        }

        if ($obj_packed_orderdetail->sku == DB_SKU_SOFTBUNDEL
            &&
            !$ship_rma_true)
        {
          echo "<script TYPE='text/javascript' language='JavaScript'>
                        location.replace('includes/scan_soft_bundels.php?shipid=$int_shipmentID&box_no=$boxnumber&productid=$int_packed_productid&amount_to_pack=$int_amount_remaining');
                        </script>";
          return TRUE; // Exit the box function because scan_soft_bundels takes over.
        }

        if ($obj_packed_orderdetail->to_deliver >= $int_amount_remaining)
        {
          $int_to_deliver = $int_amount_remaining;
        } else
        {
          $int_to_deliver = $obj_packed_orderdetail->to_deliver;
        }

        $int_transactionID = GetInventoryIDforProduct($int_shipmentID,
            $obj_packed_orderdetail->OrderDetailsID,
            $int_boxID);

        if ($int_transactionID)
        {
        // When there is already one or more of this product in this box.
          $packed_sql= 'UPDATE inventory_transactions SET
                                  UnitsSold = UnitsSold + '.$int_to_deliver.'
                                  WHERE TransactionID = '.$int_transactionID;

          $query_packed_ok = mysql_query($packed_sql);
        } else
        {
        // now insert the packed article in the inventory_transactions
          $packed_sql="INSERT INTO inventory_transactions set
                        TransactionDate = now(),
                        ProductID = ".$obj_packed_orderdetail->ProductID.",
                        Description = '".$obj_packed_orderdetail->rma_actionID."',
                        ExternalID = '".$obj_packed_orderdetail->ExternalID."',
                        PurchaseOrderID = NULL,
                        OrderID = '".$obj_packed_orderdetail->OrderID."',
                        orderdetailsID = '".$obj_packed_orderdetail->OrderDetailsID."',
                        shipmentID =".$int_shipmentID.",
                        TransactionDescription = 'shipment',
                        UnitPrice = '".$obj_packed_orderdetail->UnitPrice."',
                        UnitsSold = ".$int_to_deliver.",
                        UnitsShrinkage = 0,
                        btw_percentage = '".$obj_packed_orderdetail->btw_percentage."', 
                        added_cost = '".$obj_packed_orderdetail->cost_percentage."',
                        box_ID = '".$int_boxID."',
                        stock_owner_id = '$obj_packed_orderdetail->stock_owner_id',
                        employee = '".$GLOBALS["employee_id"]."'";

          $query_packed_ok = $db_iwex->query($packed_sql);
          $int_transactionID = GetInventoryIDforProduct($int_shipmentID,
              $obj_packed_orderdetail->OrderDetailsID,
              $int_boxID);
        }

        if ($query_packed_ok)
        {

        // now subtract the packed articles from the to_deliver field in the order
          $update_packed_sql="UPDATE order_details, orders
                        SET to_deliver = to_deliver - ".$int_to_deliver."
                        WHERE ProductID = ".$int_packed_productid." AND order_details.OrderDetailsID = ".$obj_packed_orderdetail->OrderDetailsID;

          //echo $update_packed_sql;
          $query_update_packed = mysql_query($update_packed_sql);

          if (!$ship_rma_true)
          {
          //update current product list stock field
            $db_iwex->query("UPDATE product_stock
												SET stock = stock - $int_to_deliver
												WHERE Product_ID = '$obj_packed_orderdetail->ProductID'
												AND
												owner_id = '$obj_packed_orderdetail->stock_owner_id'");
								/*update_all_stock($obj_packed_orderdetail->ProductID,
								$obj_packed_orderdetail->stock_owner_id);*/
          }

          if (!$query_update_packed)
          { //now update orderdetails record, subtract amount packed
            echo 'update van de orderdetails niet gelukt: ' .$update_packed_sql.' error:'. mysql_error();
            $result = FALSE;  // packing = ok but orderdetailsupdate failed
            // here we should reverse the inventory_transaction insert
            $int_transactionID = GetInventoryIDforProduct($int_shipmentID,
                $obj_packed_orderdetail->OrderDetailsID,
                $int_boxID);
            $packed_failed_sql= 'UPDATE inventory_transactions SET
                                      UnitsSold = UnitsSold - '.$int_to_deliver.'
                                      WHERE TransactionID = '.$int_transactionID;

            $db_iwex->query($packed_failed_sql);
            $db_iwex->query("UPDATE product_stock
											SET stock = stock + $int_to_deliver
											WHERE Product_ID = '$obj_packed_orderdetail->ProductID'
												  AND
												  owner_id = '$obj_packed_orderdetail->stock_owner_id'");
          } else
          {
            $int_amount_remaining -= $int_to_deliver;

            //When the serial number must be stored ask for it.
            if ($obj_packed_orderdetail->store_serial_yn)
            {
              echo "<script TYPE='text/javascript' language='JavaScript'>
                            var timerID$int_transactionID;
                            
                            function showserial$int_transactionID() {
                                window.open('includes/store_serial_number.php?transid=$int_transactionID','serial$int_transactionID','toolbar=0,menubar=0,resizable=1,scrollbars=1,status=0,width=200,height=300,left=25,top=25,alwaysRaised=1');
                                clearInterval(timerID$int_transactionID);
                            }
                            timerID$int_transactionID = setInterval('showserial$int_transactionID()',500)</script>
							<embed src=\"includes/serial.wav\" autostart=true hidden=true name=\"serial_sound\">";
            }

            if (upd_orderstatus($obj_packed_orderdetail->OrderID))
            {
            //Update order to open/locked/complete depending on the to_deliver fields
              $result = TRUE;
            } else
            {
              echo 'locken van de order mislukt';
            }
          }
        } else
        {
          echo 'insert/update van de inventory_transactions niet gelukt: error:'. mysql_error();
        }
      } else
      {
        if (!$bl_positive_amount && $bl_out)
        {
          echo "<h1>Sorry, u heeft geen voorraad supervisor rechten om producten uit de doos te halen!</h1>";
        }
        echo "<h1 align=center class=\"menubar\"> Van product $int_packed_productid zijn/is er ".($int_amount_packed - $int_amount_remaining)." juist en $int_amount_remaining te veel.<BR>
                <big>$int_amount_remaining</big> stuks UIT DE DOOS HALEN EN TERUG LEGGEN!</h1>";
        $int_remainig = $int_amount_remaining;
        $int_amount_remaining = 0;
        $result = FALSE;
      }
      mysql_free_result($packed_orderdetail_query);
    }
  } else if (!$int_adresID||!$int_shipmentID)
    { // if any of the arguments is not supplied
      echo '<h2 align=center class=\"menubar\">productID or AdressID not correct </h2>';
      $result = FALSE;
    } else if (!($productID_true&&$EAN_true&&$ship_rma_true))
      { //productID or EAN id out of range
        echo '<h2 align=center class=\"menubar\">productID, EAN id or RMA ID out of range:'.$int_packed_productid.'</h2>';
        $result = FALSE;
      }

  echo MakeBeep($result);

  return $result;
}


/*********************************************************
 * Function     : box_unpack
 * Will remove products from a box.
 * Input        : int_adresID: id of the adres the box is being shipped to
 *                int_shipmentID: ID of shipment
 *                int_packed_productid: The id of the product put in the box.
 *                int_amount_packed: amount of products packed
 * 				  int_boxnumber: number of the box where the products is placed in.
 * Output       : int_remainig: number of products that could not be placed on the delivery.
 *                              Will only contain a value when return value is false.
 * Returns      : true if it worked.
 *********************************************************/
Function box_unpack($int_adresID, 
    $int_shipmentID,
    $int_packed_productid,
    $int_amount_packed,
    $boxnumber,
    $int_remainig)
{
  global $GLOBALS, $db_iwex;

  $result = FALSE;
  $int_transactionID = FALSE;
  $int_amount_remaining = $int_amount_packed;
  $int_remainig = 0;
  $int_remove_id = FALSE;
  $bl_remove_from_box = FALSE;

  // When there is an invoice don't update the records.
  if ($int_amount_packed >= 0)
  {
    $int_remainig = $int_amount_packed;
    echo "<h2 align=center class=\"menubar\"box_unpack called with a positive number</h2>";
    echo "<embed src=\"includes/wrong.wav\" autostart=true hidden=true name=\"wrong_sound\">";
    return FALSE;
  }

  // first select all details about the first (oldest orderdate) packed product from order
  if ($int_adresID
      &&
      $int_shipmentID
      &&
      $int_amount_packed)
  {
    while ($int_amount_remaining)
    {
      $packed_orderdetail_sql = "SELECT TransactionID, order_details.ProductID, order_details.OrderDetailsID,
                                           order_details.OrderID, order_details.orderdetailsID, UnitsSold, sku, inventory_transactions.stock_owner_id,
                                           store_serial_yn ";
      $packed_orderdetail_sql .= "FROM inventory_transactions
                                            INNER JOIN order_details ON order_details.OrderDetailsID = inventory_transactions.OrderDetailsID
                                            INNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID
                                            WHERE shipmentID = '$int_shipmentID' 
                                            AND inventory_transactions.ProductID = '$int_packed_productid'
                                            AND box_ID = '".GetBoxID($int_shipmentID, $boxnumber)."'";
      $packed_orderdetail_sql;
      $packed_orderdetail_query =$db_iwex->query($packed_orderdetail_sql);

      $found_records = mysql_num_rows ($packed_orderdetail_query);

      if ($found_records)
      {
        $int_boxID =GetBoxID($int_shipmentID, $boxnumber);
        $obj_packed_orderdetail = mysql_fetch_object($packed_orderdetail_query);
        //echo $packed_orderdetail_sql;

        if ($obj_packed_orderdetail->sku == DB_SKU_SOFTBUNDEL)
        {
          echo "<script TYPE='text/javascript' language='JavaScript'>
                            location.replace('includes/scan_soft_bundels.php?shipid=$int_shipmentID&box_no=$boxnumber&productid=$int_packed_productid&amount_to_pack=$int_amount_remaining');
                            </script>";
          return TRUE; // Exit the box function because scan_soft_bundels takes over.
        }

        if ($obj_packed_orderdetail->UnitsSold > $int_amount_remaining)
        {
          $int_to_deliver = $int_amount_remaining;
        } else
        {
          $int_to_deliver = $obj_packed_orderdetail->UnitsSold;
        }
        $int_transactionID = $obj_packed_orderdetail->TransactionID;

        if ($int_transactionID)
        {
          if ($obj_packed_orderdetail->UnitsSold == -$int_amount_remaining)
          {
            $packed_sql= "DELETE FROM inventory_transactions
                                          WHERE UnitsSold = ".-$int_amount_remaining." AND TransactionID = $int_transactionID";
          } else
          {
          // When there is already one or more of this product in this box.
            $packed_sql= 'UPDATE inventory_transactions SET
                                          UnitsSold = UnitsSold + '.$int_to_deliver.'
                                          WHERE TransactionID = '.$int_transactionID;
          }
          //echo "$packed_sql, units_sold = $obj_packed_orderdetail->UnitsSold, remaining = $int_amount_remaining";
          $query_packed_ok = $db_iwex->query($packed_sql);
        }

        if ($query_packed_ok)
        {
        // now subtract the packed articles from the to_deliver field in the order
          $update_packed_sql="UPDATE order_details, orders
                            SET to_deliver = to_deliver - ".$int_to_deliver."
                            WHERE ProductID = ".$int_packed_productid." AND order_details.OrderDetailsID = "
              .$obj_packed_orderdetail->OrderDetailsID;
          //echo $update_packed_sql;
          $query_update_packed = $db_iwex->query($update_packed_sql);

          //update current product list stock field
          $db_iwex->query("UPDATE product_stock
                                         SET stock = stock - ".$int_to_deliver."
                                         WHERE Product_ID = '$int_packed_productid'
                                               AND
                                               owner_id = '$obj_packed_orderdetail->stock_owner_id'");

          if ($query_update_packed)
          {
            $int_amount_remaining -= $int_to_deliver;

            //When the serial number is stored ask for it.
            if ($obj_packed_orderdetail->store_serial_yn)
            {
              echo "<script TYPE='text/javascript' language='JavaScript'>
                                var timerID$int_transactionID;
                                
                                function showserial$int_transactionID() {
                                    window.open('includes/store_serial_number.php?transid=$int_transactionID&close=0','serial$int_transactionID','toolbar=0,menubar=0,resizable=1,scrollbars=1,status=0,width=200,height=300,left=25,top=25,alwaysRaised=1');
                                    clearInterval(timerID$int_transactionID);
                                }
                                timerID$int_transactionID = setInterval('showserial$int_transactionID()',500)</script>
                                <embed src=\"includes/serial.wav\" autostart=true hidden=true name=\"serial_sound\">";
            }

            if (upd_orderstatus($obj_packed_orderdetail->OrderID))
            {
            //Update order to open/locked/complete depending on the to_deliver fields
              $result = TRUE;
            } else
            {
              echo 'locken van de order mislukt';
            }
          }
        } else
        {
          echo 'insert/update van de inventory_transactions niet gelukt: error:'. mysql_error();
        }
      } else
      {
        echo "<h1 align=center class=\"menubar\">Van product $int_packed_productid zijn/is er ".($int_amount_packed - $int_amount_remaining)." juist en $int_amount_remaining te veel.<BR>
                <big>$int_amount_remaining</big> stuks TERUG IN DE DOOS LEGGEN!</h1>";
        $int_remainig = $int_amount_remaining;
        $int_amount_remaining = 0;
        $result = FALSE;
      }
      mysql_free_result($packed_orderdetail_query);
    }
  } else if (!$int_adresID||!$int_shipmentID)
    { // if any of the arguments is not supplied
      echo '<h2 align=center class=\"menubar\">productID or AdressID not correct </h2>';
      $result = FALSE;
    } else if (!($productID_true&&$EAN_true&&$ship_rma_true))
      { //productID or EAN id out of range
        echo '<h2 align=center class=\"menubar\">productID, EAN id or RMA ID out of range:'.$int_packed_productid.'</h2>';
        $result = FALSE;
      }

  echo MakeBeep($result);

  return $result;
}

/*********************************************************
 * Function     : GetInvoiceID
 * Will return the invoice ID of the given delivery.
 * Input        : int_deliveryID: The id of the delivery.
 * Returns      : int of the Delivery ID. FALSE otherwise.
 *********************************************************/
Function GetInvoiceID($int_deliveryID)
{
  $int_invoice = FALSE;

  $sql_getinvoice = "SELECT InvoiceID FROM invoices WHERE shipmentID = '$int_deliveryID'";
  $qry_invoice_number = mysql_query($sql_getinvoice)
      or die("Ongeldig GetInvoiceID query: $sql_getinvoice<br>". mysql_error());
  $obj = mysql_fetch_object($qry_invoice_number);

  $int_invoice = isset($obj->InvoiceID) ? $obj->InvoiceID : FALSE;

  mysql_free_result($qry_invoice_number);

  return $int_invoice;
}

/*********************************************************
 * Function     : GetInvoiceDate
 * Will return the invoice date of the given invoice.
 * Input        : int_invoiceID: The id of the invoice.
 * Returns      : date of the invoice. NULL otherwise.
 *********************************************************/
Function GetInvoiceDate($int_invoiceID)
{
  $date_invoice = NULL;

  $sql_getinvoice = "SELECT Invoice_Date FROM invoices WHERE InvoiceID = '$int_invoiceID'";
  $qry_invoice_number = mysql_query($sql_getinvoice)
      or die("Ongeldig Getinvoice date query: $sql_getinvoice<br>". mysql_error());
  $obj = mysql_fetch_object($qry_invoice_number);

  $date_invoice = $obj->Invoice_Date;

  mysql_free_result($qry_invoice_number);

  return $date_invoice;
}

/*********************************************************
 * Function     : GetInvoiceAmount
 * Will return the invoice total amount incl. VAT of the
 * given invoice.
 * Input        : int_invoiceID: The id of the invoice.
 * Returns      : Sum of the total invoice.
 *********************************************************/
Function GetInvoiceAmount($int_invoiceID)
{
  $flt_amount = 0;

  $sql_getinvoice = "SELECT (Invoice_total + Invoice_BTW) as total FROM invoices WHERE InvoiceID = '$int_invoiceID'";
  $qry_invoice_number = mysql_query($sql_getinvoice)
      or die("Ongeldig Getinvoice Amount query: $sql_getinvoice<br>". mysql_error());
  $obj = mysql_fetch_object($qry_invoice_number);

  $flt_amount = $obj->total;

  mysql_free_result($qry_invoice_number);

  return $flt_amount;
}

/*********************************************************
 * Function     : CompareTotalAmountWithInvoice
 * Check the amount with the amount in the database
 * Input        : int_invoiceID: The id of the customer.
 * Output       : flt_amount: the amount to compare with incl. VAT
 * Returns      : True when ok, falso otherwise.
 *********************************************************/
Function CompareTotalAmountWithInvoice($int_invoiceID, 
    $flt_amount)
{
  $flt_dbinvoiceamount = GetInvoiceAmount($int_invoiceID);
  if ($flt_dbinvoiceamount < $flt_amount-DB_INVOICE_MARGIN
      ||
      $flt_dbinvoiceamount > $flt_amount+DB_INVOICE_MARGIN)
  {
    echo "<h1 align=center class=\"menubar\">Factuur $int_invoiceID<br>Berekende factuur bedrag (&euro; $flt_amount) is ongelijk aan bedrag in de database: (&euro; $flt_dbinvoiceamount).</h1>";
    echo "<embed src=\"includes/wrong.wav\" autostart=true hidden=true name=\"wrong_sound\">";
    return FALSE;
  } else
  {
    return TRUE;
  }
}

/*********************************************************
 * Function     : GetPaymentTermInvoice
 * Will return the paymentTerm condition of the invoice.
 * Input        : int_invoiceID: The id of the customer.
 * Output       : int_paymenterm_id: the DB field id of the
 *                the paymenterm.
 *                bl_autoincasso
 * Returns      : The payment term string. NULL otherwise.
 *********************************************************/
Function GetPaymentTermInvoice($int_invoiceID, 
    $int_paymenterm_id,
    $bl_autoincasso)
{
  $str_paymentterm = NULL;
  $bl_autoincasso = FALSE;

  $sql_getpayment = "SELECT PaymentTermID, text, incasso
			FROM invoices 
			INNER JOIN paymentterm ON invoices.Paymentterm = paymentterm.PaymentTermID
			INNER JOIN contacts ON contacts.ContactID = invoices.CustomerID
			INNER JOIN fields_text_languages ON fieldID = PaymentTermID 
											 AND fields_text_languages.categoryID = ".DB_FIELDS_TEXT_ID_PAYMENTERM."
											 AND fields_text_languages.languageID = contacts.languageID
			WHERE InvoiceID = $int_invoiceID";

  $qry_paymentterm = mysql_query($sql_getpayment)
      or die("Ongeldig GetPaymentTermInvoice query: $sql_getpayment<br>". mysql_error());
  $obj = mysql_fetch_object($qry_paymentterm);

  $str_paymentterm = $obj->text;
  $int_paymenterm_id = $obj->PaymentTermID;
  $bl_autoincasso = $obj->incasso;

  mysql_free_result($qry_paymentterm);

  return $str_paymentterm;
}

/*********************************************************
 * Function     : GetInvoiceAdresId
 * Will return the adres id where the invoice shobe 
 * send to.
 * Input        : int_customer_id: The id of the customer.
 * Returns      : The adres ID of the invoice
 *********************************************************/
function GetInvoiceAdresId($int_customer_id)
{
// Select the invoice adres. First factuur adres, second Bezoekadres, third Enig adres else follow the list except 7 not used anymore.
  $sql_invoice_adres_id = "SELECT AdresID
		                     FROM Adressen 
		                     WHERE ContactID = '$int_customer_id' AND adrestitel <> 7
		                     ORDER BY adrestitel = 2 desc, adrestitel = 1 desc, adrestitel = 4 desc, adrestitel asc";
  return GetField($sql_invoice_adres_id);
}

/**
 * Function     : GetInvoiceAdres
 * Will return the invoice adres to be used.
 * send to.
 * Input        : int_customer_id: The id of the customer.
 *				: $str_name, Company name
 *				: $str_contact, Contact person to send to
 *				: $str_street,
 *				: $str_house_number,
 *				: $str_zipcode,
 *				: $str_city
 *				: $str_country
 *				: $bl_create, true when there should be one created when there is none.
 * Returns      : The adres where the invoice should be send to
 **/
function GetInvoiceAdres($int_customer_id,
    $str_name,
    $str_contact,
    $str_street,
    $str_house_number,
    $str_zipcode,
    $str_city,
    $str_country,
    $bl_create = FALSE)
{
  global $db_iwex;

  $str_adres = "";
  $int_invoice_adres_id = FALSE;
  if ($int_customer_id)
  {
    $int_invoice_adres_id = GetInvoiceAdresId($int_customer_id);
    // When there is no invoice address number insert one.
    if (!$int_invoice_adres_id
        &&
        $bl_create)
    {
      $sql_insert_inv_adr =  "INSERT Adressen SET
									adrestitel = ".INVOICE_ADDRESS_TYPE.",
									ContactID = '$int_customer_id',
									Naam = '$str_name',
									attn = '$str_contact',
									straat = '$str_street',
									huisnummer = '$str_house_number',
									postcode = '$str_zipcode',
									plaats = '$str_city',
									land = '$str_country'";
      $query = mysql_query($sql_insert_inv_adr) or die("Invalid sql: " . mysql_error());
      $int_invoice_adres_id = mysql_insert_id();
    }

    $query = $db_iwex->query("SELECT * FROM Adressen LEFT JOIN country ON land = code WHERE AdresID = $int_invoice_adres_id");

    while ($objshipment = mysql_fetch_object($query))
    {
      $str_adres = $objshipment->Naam;
      if ($objshipment->attn != "")
      {
        $str_adres .= "\nT.a.v. ".$objshipment->attn;
      }
      $str_adres .= "\n$objshipment->straat $objshipment->huisnummer";
      $str_adres .= "\n$objshipment->postcode  $objshipment->plaats";
      $str_adres .= "\n$objshipment->country";
    }
    mysql_free_result($query);
  }
}

/*********************************************************
 * Function     : InsertInvoiceDelivery
 * Insert the Invoice of the Deliver in the invoice table.
 * Input        : int_deliveryID, Id of the delivery
 * Returns		: The invoice number. FALSE otherwise.
 * *******************************************************/
Function InsertInvoiceDelivery($int_deliveryID)
{
  global $employee_id;

  $int_invoiceID = FALSE;
  $flt_productcost = 0;
  $flt_vatamount = 0;
  $sql_insert_invoice = "";
  $flt_ordercost = 0;
  $flt_productcost = 0;
  $flt_vatamount = 0;

  $int_invoiceID = GetInvoiceID($int_deliveryID);
  // When there is no INVOICE id insert a new one.
  if (!$int_invoiceID)
  {

  // Create a query to select the shipment
    $sql_shipments = SQL_SHIPMENTS . "WHERE Shipment_ID = $int_deliveryID";

    $query = mysql_query($sql_shipments)
        or die(ERROR_INSTER_QUERY . mysql_error());

    if (mysql_num_rows($query))
    {

      while ($objshipment = mysql_fetch_object($query))
      {
        $str_shipname = $objshipment->Naam;
        if ($objshipment->attn != "")
        {
          $str_shipname .= "\nT.a.v. ".$objshipment->attn;
        }
        $str_shipaddress = "$objshipment->straat $objshipment->huisnummer";
        $str_shipcity = $objshipment->plaats;
        $str_shipZip = $objshipment->postcode;
        $str_shipcountry = $objshipment->land_naam;
        $int_customerid = $objshipment->ContactID;

        $date_shipdate = $objshipment->Ship_date;
        $int_paymenterm = $objshipment->Paymentterm;
        $str_vat_number = $objshipment->btw_number;
      }
      mysql_free_result($query);

      // Remove the allow shipments from the table.
      grant_shipment($int_customerid, FALSE, TRUE, TRUE);

      $int_invoice_adres_id = GetInvoiceAdresId($int_customerid);

      $query = mysql_query("SELECT * FROM Adressen LEFT JOIN country ON land = code WHERE AdresID = $int_invoice_adres_id")
          or die(ERROR_INSTER_QUERY . mysql_error());

      while ($objshipment = mysql_fetch_object($query))
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
      mysql_free_result($query);
      // 26 jun 05 AK added the WHERE CLAUSE  to filter out the consignment orderdetails
      $sql_orders = "SELECT DISTINCT inventory_transactions.OrderID
					FROM inventory_transactions 
					INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
                    WHERE shipmentID = $int_deliveryID AND NOT orders.consignment_order";
      $query_orders = mysql_query($sql_orders)
          or die(ERROR_INSTER_QUERY . $sql_orders . ' -> ' . mysql_error());

      while ($obj_orders = mysql_fetch_object($query_orders))
      {

        $sql_inventoryt = "SELECT
					 UnitPrice, UnitsSold, btw_percentage, added_cost 
					FROM inventory_transactions 
					INNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID
					WHERE shipmentID = $int_deliveryID AND OrderID = $obj_orders->OrderID";
        $query_invetory = mysql_query($sql_inventoryt)
            or die(ERROR_INSTER_QUERY . mysql_error());

        while ($obj_inventory = mysql_fetch_object($query_invetory))
        {
          $flt_ordercost += $obj_inventory->added_cost * $obj_inventory->UnitsSold; // Added costs
          $flt_productcost += $obj_inventory->UnitPrice*$obj_inventory->UnitsSold;
          $flt_vatamount += ($obj_inventory->added_cost + $obj_inventory->UnitPrice) * $obj_inventory->UnitsSold * $obj_inventory->btw_percentage;
        }

        mysql_free_result($query_invetory);
      }
      mysql_free_result($query_orders);

      $str_totalexclvat = sprintf("%.2f", $flt_productcost + $flt_ordercost);
      $str_vatamount = sprintf("%.2f", $flt_vatamount);

      // When payment term is upfront print within 14 days.
      if ($int_paymenterm == 4) $int_paymenterm = 2;

      $sql_insert_invoice = "INSERT INTO invoices SET
				  ShipName = '$str_shipname',
				  ShipAddress = '$str_shipaddress',
				  ShipCity = '$str_shipcity',
				  ShipPostalCode = '$str_shipZip',
				  ShipCountry = '$str_shipcountry',
				  CustomerID = $int_customerid,
                  EmployeeID = '$employee_id',
				  companyName = '$str_companyname',
				  Address = '$str_address',
				  City = '$str_city',
				  Region = '$str_region',
				  PostalCode = '$str_zipcode',
				  Country = '$str_country',
				  shipmentID = $int_deliveryID,
				  ShippedDate = '$date_shipdate',
				  Invoice_total = '$str_totalexclvat',
				  Invoice_BTW = '$str_vatamount',
                  paymentterm = $int_paymenterm,
                  vat_number = '$str_vat_number',
				  Invoice_date = CURDATE()";
      // When the invoice is 0 set it to be paid direct.
      if (($str_totalexclvat + $str_vatamount) == 0)
      {
        $sql_insert_invoice .= ", paid_yn = 1,
                                        paid_amount = 0,
                                        paid_date = CURDATE(),
                                        payment_type = ".PAYMENT_ACCOUNT_ID_SYLVIA;
      }

      if (!$date_shipdate)
      {
        echo "<h2>InsertInvoiceDelivery called without a shipdate in the delivery.</h2>";
        return FALSE;
      }

      $qry_insert_invoice = mysql_query($sql_insert_invoice);
      if ($qry_insert_invoice)
      {
        $int_invoiceID = GetInvoiceID($int_deliveryID);

        $sql_update_shipment = "UPDATE shipments SET InvoiceID = $int_invoiceID WHERE Shipment_ID = $int_deliveryID";
        if (!$qry_update_shipment = mysql_query($sql_update_shipment))
        {
          echo "Update van de levering $int_deliveryID met de invoice $int_invoiceID niet gelukt:<br> $sql_update_shipment <br>error:". mysql_error();
        }
      } else
      {
        echo "Insert van de Invoice van levering $int_deliveryID niet gelukt:<br> $sql_insert_invoice <br>error:". mysql_error();
      }
    } else
    {
      echo "<b>InsertInvoiceDelivery called with an ID ($int_deliveryID) that has now records</b>";
      return FALSE;
    }
  }

  return $int_invoiceID;
}

/*********************************************************
 * Function     : InsertInvoiceOrder
 * Insert the Invoice of the order in the invoice table.
 * Input        : int_orderID, Id of the order
 * Returns		: The invoice number. FALSE otherwise.
 * *******************************************************/
Function InsertInvoiceOrder($int_orderID)
{
  global $db_iwex, $employee_id;

  $int_invoiceID = FALSE;
  $flt_productcost = 0;
  $flt_vatamount = 0;
  $sql_insert_invoice = "";
  $flt_ordercost = 0;
  $flt_productcost = 0;
  $flt_vatamount = 0;
  $query = NULL;
  $int_customerid = FALSE;

  $int_invoiceID = GetField(SELECT_INVOICE_ID.$int_orderID);
  // When there is no INVOICE id insert a new one.
  if (!$int_invoiceID)
  {

  // Create a query to select the order detail
    $sql_orders = SQL_ORDERS . "WHERE OrderID = $int_orderID";

    $query = $db_iwex->query($sql_orders);

    if (mysql_num_rows($query))
    {
      while ($objshipment = mysql_fetch_object($query))
      {
        $str_shipname = $objshipment->Naam;
        if ($objshipment->attn != "")
        {
          $str_shipname .= "\nT.a.v. ".$objshipment->attn;
        }
        $str_shipaddress = "$objshipment->straat $objshipment->huisnummer";
        $str_shipcity = $objshipment->plaats;
        $str_shipZip = $objshipment->postcode;
        $str_shipcountry = $objshipment->land_naam;
        $int_customerid = $objshipment->ContactID;

        $date_shipdate = "";
        $int_paymenterm = $objshipment->Paymentterm;
        $str_vat_number = $objshipment->btw_number;
      }
      mysql_free_result($query);

      $int_invoice_adres_id = GetInvoiceAdresId($int_customerid);

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

      $sql_inventoryt = "SELECT
                UnitPrice, Quantity AS UnitsSold, btw_percentage, cost_percentage AS added_cost
                FROM order_details 
                WHERE OrderID = $int_orderID";
      $query_invetory = mysql_query($sql_inventoryt)
          or die(ERROR_INSTER_QUERY . mysql_error());

      while ($obj_inventory = mysql_fetch_object($query_invetory))
      {
        $flt_ordercost += $obj_inventory->added_cost * $obj_inventory->UnitsSold; // Added costs
        $flt_productcost += $obj_inventory->UnitPrice*$obj_inventory->UnitsSold;
        $flt_vatamount += ($obj_inventory->added_cost + $obj_inventory->UnitPrice) * $obj_inventory->UnitsSold * $obj_inventory->btw_percentage;
      }

      mysql_free_result($query_invetory);

      $str_totalexclvat = sprintf("%.2f", $flt_productcost + $flt_ordercost);
      $str_vatamount = sprintf("%.2f", $flt_vatamount);

      // When payment term is upfront print within 14 days.
      if ($int_paymenterm == 4) $int_paymenterm = 2;

      $sql_insert_invoice = "INSERT INTO invoices SET
				  ShipName = '$str_shipname',
				  ShipAddress = '$str_shipaddress',
				  ShipCity = '$str_shipcity',
				  ShipPostalCode = '$str_shipZip',
				  ShipCountry = '$str_shipcountry',
				  CustomerID = $int_customerid,
                  EmployeeID = '$employee_id',
				  companyName = '$str_companyname',
				  Address = '$str_address',
				  City = '$str_city',
				  Region = '$str_region',
				  PostalCode = '$str_zipcode',
				  Country = '$str_country',
				  orderID = $int_orderID,
				  ShippedDate = '',
				  Invoice_total = '$str_totalexclvat',
				  Invoice_BTW = '$str_vatamount',
                  paymentterm = $int_paymenterm,
                  vat_number = '$str_vat_number',
				  Invoice_date = CURDATE()";
      // When the invoice is 0 set it to be paid direct.
      if (($str_totalexclvat + $str_vatamount) == 0)
      {
        $sql_insert_invoice .= ", paid_yn = 1,
                                        paid_amount = 0,
                                        paid_date = CURDATE(),
                                        payment_type = ".PAYMENT_ACCOUNT_ID_SYLVIA;
      }

      $qry_insert_invoice = mysql_query($sql_insert_invoice);
      if ($qry_insert_invoice)
      {
        upd_orderstatus($int_orderID);
        $int_invoiceID = GetField(SELECT_INVOICE_ID.$int_orderID);
      } else
      {
        echo "Insert van de Invoice van order $int_orderID niet gelukt:<br> $sql_insert_invoice <br>error:". mysql_error();
      }
    } else
    {
      echo "<b>InsertInvoiceOrder called with an OrderID ($int_orderID) that has no order detail records</b>";
      return FALSE;
    }
  }

  return $int_invoiceID;
}

/**
 * Function     : GetDeliveryValue
 * Will return the value of this delivery incl. VAT.
 * Input        : DeliveryID
 * Output       : Totalproductcost, value excl VAT
 *                Vatamount, VAT amount
 * Returns      : The value in euro
 **/
Function GetDeliveryValue($int_delivery, 
    $flt_totalproductcost = 0,
    $flt_vatamount = 0,
    $bl_include_unpacked = TRUE)
{
  global $db_iwex;

  $flt_totalproductcost = 0;
  $flt_vatamount = 0;

  if ($int_delivery)
  {
    $sql_inventoryt = "SELECT UnitPrice, UnitsSold, btw_percentage, added_cost
          FROM inventory_transactions 
          WHERE shipmentID = $int_delivery";
    $query_invetory = $db_iwex->query($sql_inventoryt);

    while ($obj_inventory = mysql_fetch_object($query_invetory))
    {
      $flt_totalproductcost += ($obj_inventory->UnitPrice + $obj_inventory->added_cost)*$obj_inventory->UnitsSold;
      $flt_vatamount += ($obj_inventory->added_cost + $obj_inventory->UnitPrice) * $obj_inventory->UnitsSold * $obj_inventory->btw_percentage;
    }

    mysql_free_result($query_invetory);

    if ($bl_include_unpacked)
    {
      $sql_packing_details = SQL_openorderdetails . "
                                  WHERE to_deliver <> 0 AND 
                            			".openordedetails_condition." 
                            			AND ShipID = ".GetField("SELECT AdressID FROM shipments WHERE Shipment_ID = '$int_delivery'")." 
                            			AND (rma_yn <> 1 or isnull(rma_yn))
                            			AND stock > 0
                                    ORDER BY stock <= 0, walk_order, location.ID, order_details.ProductID;";
      $query_openorders = $db_iwex->query($sql_packing_details);

      while ($obj_openorders = mysql_fetch_object($query_openorders))
      {
        $flt_totalproductcost += ($obj_openorders->UnitPrice + $obj_openorders->cost_percentage)*$obj_openorders->Quantity;
        $flt_vatamount += ($obj_openorders->cost_percentage + $obj_openorders->UnitPrice) * $obj_openorders->Quantity * $obj_openorders->btw_percentage;
      }

      mysql_free_result($query_openorders);
    }
  }
  return $flt_totalproductcost + $flt_vatamount;
}

/*********************************************************
 * Function     : getorderdetails
 * Will create the default Iwex header and look and feel
 * Input        : OrderID
 * Returns      : mysql_query result and TRUE if ok.
 *********************************************************/
function getorderdetails($queryres, $orderid, $orderby = "")
{
  global $db_iwex;
  if ($orderid != NULL)
  {
    $orderquery = 'SELECT OrderDetailsID, order_details.Quantity, order_details.ProductID, order_details.OrderID,'
        . ' orders.OrderDate, order_details.ProductDescription, orders.ShipCountry, orders.Btw_YN, '
        . ' order_details.UnitPrice, order_details.UnitCost, current_product_list.productID, to_deliver, orders.ContactID, '
        . ' order_details.SerialNB, order_details.UnitBTW, order_details.cost_percentage, order_details.Extended_price, '
        . ' order_details.btw_percentage, order_details.OrderDetailsID, order_details.manual_price, order_details.rma_actionID, '
        . ' current_product_list.sku, order_details.ProductName, product_stock.stock,'
        . ' current_product_list.Discontinued_yn, current_product_list.Pricelist_yn, Selling_price,'
        . ' last_exp, exp_rating, employee, current_product_list.Merk, stock_owner_id, CustOrderRowID '
        . ' FROM ( order_details'
        . ' INNER JOIN orders ON order_details.OrderID = orders.OrderID'
        . ' LEFT JOIN current_product_list ON order_details.ProductID = current_product_list.ProductID )'
        . ' LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '.OWN_COMPANYID
        . ' WHERE order_details.OrderID = ' . $orderid;
    $orderquery .= " $orderby";

    $queryres = $db_iwex->query($orderquery);
    return TRUE;
  } else
  {
    echo "Function getorderdetails called without a parameter";
    return NULL;
  }
}

/*********************************************************
 * Function     : getopenorders
 * get all open orders from given customer
 * Input        : ContactID
 * Returns      : mysql_query result and TRUE if ok.
 *********************************************************/
function getopenorders($queryres, $Contactid)
{
  global $db_iwex;
  if ($Contactid != NULL)
  {
    $orderquery = 'SELECT order_details.Quantity, order_details.ProductID, order_details.OrderID,'
        . ' orders.OrderDate, order_details.Productdescription, orders.ShipCountry, orders.Btw_YN, '
        . ' order_details.UnitPrice, current_product_list.productID, to_deliver, '
        . ' order_details.SerialNB, order_details.UnitBTW, order_details.cost_percentage, order_details.Extended_price, '
        . ' order_details.btw_percentage, order_details.OrderDetailsID, order_details.manual_price, '
        . ' current_product_list.sku, current_product_list.ProductName, product_stock.stock,'
        . ' current_product_list.Discontinued_yn, current_product_list.Pricelist_yn'
        . ' FROM ( order_details'
        . ' INNER JOIN current_product_list ON order_details.ProductID = current_product_list.ProductID )'
        . ' INNER JOIN orders ON order_details.OrderID = orders.OrderID'
        . " LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."'"
        . ' WHERE orders.OrderID = ' . $orderid . ' AND to_deliver > 0;';

    $queryres = $db_iwex->query($orderquery);
    return TRUE;
  } else
  {
    echo "Function getopenorders called without a parameter";
    return NULL;
  }
}

/*********************************************************
 * Function     : getshipmentdetails
 * Get the shipment detail infomation.
 * Input        : int_shipment_id, Id of the delivery
 * Output		: shipm_query array.
 * Returns		: True if ok. NULL otherwise.
 * *******************************************************/
Function getshipmentdetails($qry_shipquery, $int_shipmentID)
{
  global $db_iwex;
  if ($int_shipmentID != NULL)
  {
  // get inventory transactions for this shipment
    $ship_sql = "SELECT TransactionID, TransactionDate, inventory_transactions.ProductID, Description, inventory_transactions.box_ID, box_number,
            OrderID, TransactionDescription, UnitPrice, sum(UnitsSold) AS  UnitsSold, 
            sum(UnitsShrinkage) AS UnitsShrinkage, btw_percentage, Productname, OrderID, weight_corr, store_serial_yn,
            sku
            FROM inventory_transactions
            INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
            LEFT JOIN box ON inventory_transactions.box_ID = box.box_ID
            WHERE ShipmentID =".$int_shipmentID."
            GROUP BY OrderID, ProductID, box_ID ORDER BY box_number";
    //echo $inventory_sql;
    $qry_shipquery = $db_iwex->query($ship_sql);
    return TRUE;
  } else
  {
    echo "Function getshipmentdetails called without a parameter";
    return NULL;
  }
}
/*********************************************************
 * Function     : get_box_numbers
 * Get all the boxnumbers of this shipment
 * Input        : int_deliveryID
 * Returns		: Array of the box numbers
 * *******************************************************/
Function get_box_numbers($qry_boxquery, $int_shipmentID)
{
  global $db_iwex;
  if ($int_shipmentID != NULL)
  {
  // get inventory transactions for this shipment
    $box_sql = "SELECT box_number
            FROM box
            WHERE Shipment_ID =".$int_shipmentID."
            GROUP BY box_number ORDER BY box_number";
    //echo 'box_sql: '.$box_sql;
    $qry_boxquery = $db_iwex->query($box_sql);
    return TRUE;
  } else
  {
    echo "Function get_box_numbers called without a parameter";
    return NULL;
  }
}

/*********************************************************
 * Function     : check_shipment
 * check if there are shipments for this order
 * Input        : int_orderID
 * Returns		: true or NULL
 * *******************************************************/
Function check_shipment($int_orderID)
{
  $bl_return_var = NULL;
  if ($int_orderID != NULL)
  {
  // get inventory transactions for this shipment
    $sql_orders = "SELECT OrderID
			FROM inventory_transactions
			WHERE OrderID = $int_orderID
            GROUP BY OrderID";
    $query_orders = mysql_query($sql_orders)
        or die("Ongeldige query check shipment: " . mysql_error());
    while ($obj_orders = mysql_fetch_object($query_orders))
    {
      return TRUE;
    }
  } else
  {
    echo "Function check_shipment called without a parameter";
  }
}

/********************************************************
 * Function     : check_shipment
 * check if there are shipments for this order
 * Input        : adresID
 * Returns		: ShipmentID or NULL
 * *******************************************************/
Function check_open_shipment($int_adresID)
{
  $bl_return_var = NULL;
  if ($int_adresID != NULL)
  {
  // get inventory transactions for this shipment
    $sql_opens_shipments = "SELECT Shipment_ID
			FROM shipments
			WHERE ((Start_date > '0000-00-00 00:00:00' OR isnull(Start_date)) AND isnull(shipments.ship_date) AND cancel = 0)
         AND AdressID = $int_adresID
         GROUP BY Shipment_ID";
    $query_open_shipments = mysql_query($sql_opens_shipments)
        or die("Ongeldige query check shipment: " . $sql_opens_shipments . mysql_error());
    while ($obj_open_shiments = mysql_fetch_object($query_open_shipments))
    {
      $bl_return_var =  $obj_open_shiments->Shipment_ID;
    }
  } else
  {
    echo "Function check_open_shipment called without a parameter";
  }
  return $bl_return_var;
}

/********************************************************
 * Function     : shipment_empty
 * check if there are articles in a shipment
 * Input        : shipmentID
 * Returns		: True or False
 * *******************************************************/
Function shipment_empty($int_shipmentID)
{
  $bl_return_var = FALSE;
  if ($int_shipmentID != NULL)
  {
  // get inventory transactions for this shipment
    $bl_return_var = !(GetField("SELECT productID
                                      FROM inventory_transactions
                                      WHERE shipmentID=$int_shipmentID")
        ||
        GetField("SELECT productID
                                      FROM temp_inv_transactions
                                      WHERE shipmentID=$int_shipmentID")); 
  } else
  {
    echo "Function shipment_empty called without a parameter";
  }
  return $bl_return_var;
}

/*********************************************************
 * Function     : upd_orderstatus
 * when an article from an order is shipped update the status that specific order
 * Input        : int_orderID
 * Returns		: true or false
 * *******************************************************/
Function upd_orderstatus($int_orderID)
{
  $bl_return_var = FALSE;
  if ($int_orderID)
  {
    $sql_order = "SELECT order_details.OrderID, sum(Quantity) as sum_Quantity,
					         sum(to_deliver) as sum_to_deliver, administration_order
			FROM order_details
			INNER JOIN orders ON orders.OrderID = order_details.OrderID
            WHERE order_details.OrderID = $int_orderID AND ProductID <> 0
            GROUP BY order_details.OrderID;";
    //        echo $sql_order;
    $query_order = mysql_query($sql_order)
        or die("Ongeldige query: " .$sql_order. mysql_error());
    $obj = mysql_fetch_object($query_order);
    if ($obj
        &&
        !$obj->administration_order)
    { //when there are still to_deliver items don't complete
      if ($obj->sum_Quantity == $obj->sum_to_deliver)
      { // when nothing has been delivered...
      // lock Order record
        $sql_lockorder = "UPDATE orders SET
                    Locked_yn = '0'
        			WHERE OrderID = $int_orderID ";
        SetOrderHistory($int_orderID, 'Locked_yn', 0);
        if ($query_lockorder = mysql_query($sql_lockorder))
        {
          $bl_return_var = TRUE;
        //echo "order UNlocked";
        } else
        {
          echo "Ongeldige query: " . $sql_lockorder . mysql_error();
        }
      } else if ($obj->sum_to_deliver==0)
        { //when all has been delivered
          $sql_completeorder = "UPDATE orders SET
                   Complete_yn = '1', Locked_yn = '1'
       			   WHERE OrderID = $int_orderID ";

          SetOrderHistory($int_orderID, 'Complete_yn', 1);
          SetOrderHistory($int_orderID, 'Locked_yn', 1);

          if ($query_completeorder = mysql_query($sql_completeorder))
          {
            $bl_return_var = TRUE;
          //                    echo "order complete";
          } else
          {
            echo "Ongeldige query: " . $sql_completeorder . mysql_error();
          }
        } else if ($obj->sum_Quantity != $obj->sum_to_deliver)
          { // when something has been delivered...
          // lock Order record
            $sql_lockorder = "UPDATE orders SET
                    Complete_yn = '0', Locked_yn = '1'
        			WHERE OrderID = $int_orderID ";
            SetOrderHistory($int_orderID, 'Locked_yn', 1);
            SetOrderHistory($int_orderID, 'Complete_yn', 0);

            if ($query_lockorder = mysql_query($sql_lockorder))
            {
              $bl_return_var = TRUE;
            //                    echo "order locked";
            } else
            {
              echo "Ongeldige query: " . $sql_lockorder . mysql_error();
            }
          }
    } else if (GetField("SELECT InvoiceID
							FROM invoices 
							WHERE orderID = '$int_orderID'"))
      {
        $sql_completeorder = "UPDATE orders SET
           Complete_yn = '1', Locked_yn = '1'
           WHERE OrderID = $int_orderID ";
        SetOrderHistory($int_orderID, 'Complete_yn', 1);
        SetOrderHistory($int_orderID, 'Locked_yn', 1);

        if ($query_completeorder = mysql_query($sql_completeorder))
        {
          $bl_return_var = TRUE;
        //                    echo "order complete";
        } else
        {
          echo "Ongeldige query: " . $sql_completeorder . mysql_error();
        }
      }
  } else
  {
    echo "Function upd_orderstatus called without a parameter";
  }
  return $bl_return_var;
}

/*********************************************************
 * Function     : get_orderstatus
 * get status of order:
 * using confirmed_yn, complete_yn and locked_yn
 * Input        : int_orderID
 * Returns		: 1 = Qoute, 2=Confirmed order, 3=partially delivered, 4=complete
 * *******************************************************/
Function get_orderstatus($int_orderID)
{
  $orderstate = NULL;
  if ($int_orderID != NULL)
  {
  // get details from order
    $sql_order = "SELECT Locked_yn, confirmed_yn, Complete_yn FROM orders
			WHERE OrderID = $int_orderID ";
    //        echo $sql_order;
    $query_order = mysql_query($sql_order)
        or die("Ongeldige query: " .$sql_order. mysql_error());
    while ($obj = mysql_fetch_object($query_order))
    {
      $conf = false;
      $lock = false;
      $done = false;
      if ($obj->confirmed_yn <> 0)
      {
        $conf = true;
      }
      if ($obj->Locked_yn <> 0)
      {
        $lock = true;
      }
      if ($obj->Complete_yn <> 0)
      {
        $done = true;
      }

      if (!$conf&&!$lock&&!$done)
      {
        $orderstate = 1;
      } else if ($conf&&!$lock&&!$done)
        {
          if ($obj->confirmed_yn==2)
          {
            $orderstate = 5;
          } else if ($obj->confirmed_yn==1)
            {
              $orderstate = 2;
            }
        } else if ($conf&&$lock&&!$done)
          {
            $orderstate = 3;
          } else if ($conf&&$lock&&$done)
            {
              $orderstate = 4;
            } else
            {
            //                echo "Orderstatus is ongeldig van order: " . $int_orderID;
              $orderstate = NULL;
            }
    }
  } else
  {
    echo "Function get_orderstatus called without a parameter";
  }
  return $orderstate;
}

/********************************************************
 * Function     : adjust_exp_date
 * adjust Expected Date for articles to now+14 days when it's < today
 * Input        : ProductID
 * Returns		: Date ('Y-m-d'), false
 * *******************************************************/
Function adjust_exp_date($int_ProductID)
{
  $bl_return_var = False;
  if ($int_ProductID)
  {
  // get expected date from Current product list
    $sql_expected = "SELECT last_exp
			FROM current_product_list
			WHERE ProductID='$int_ProductID'";
    $query_expected = mysql_query($sql_expected)
        or die("Ongeldige query expected: " . $sql_expected . mysql_error());
    while ($obj_expected = mysql_fetch_object($query_expected))
    {
      if ($obj_expected->last_exp < date('Y-m-d',now))
      {
        $bl_return_var = date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+14, date("Y")));
        echo 'adjusted' . $int_ProductID;
      } else
      {
        $bl_return_var = $obj_expected->last_exp;
        echo 'not adjusted';
      }
      $bl_return_var =  FALSE;
    }
  } else
  {
    echo "Function adjust_exp_date called without a parameter";
  }
  return $bl_return_var;
}

/*********************************************************
 * Function     : getpaymentterm
 * Will return the payment term of the given ContactID
 * Input        : ContactID, LanguageID
 * Returns      : True or False, string with Paymentterm, Integer with paymentterm .
 *********************************************************/
function getpaymentterm($int_ContactID, $str_pterm='', $int_pterm='', $int_languageID)
{
  $bl_return_var = False;
  if ($int_ContactID)
  {
    $paymentterm_sql = "SELECT Paymentterm, text
			 FROM contacts
             INNER JOIN paymentterm ON paymentterm.PaymentTermID = contacts.Paymentterm
			 LEFT JOIN fields_text_languages ON fieldID = PaymentTermID
                        AND fields_text_languages.categoryID = ".DB_FIELDS_TEXT_ID_PAYMENTERM."
                        AND fields_text_languages.languageID = '$int_languageID'
             WHERE ContactID = '$int_ContactID'";

    $query_pterm = mysql_query($paymentterm_sql)
        or die("Invalid orderdetailsquery: " . $paymentterm_sql . "->" . mysql_error());
    if ($obj_pterm = mysql_fetch_object($query_pterm))
    {
      $str_pterm = $obj_pterm->text;
      $int_pterm = $obj_pterm->Paymentterm;
      $bl_return_var = TRUE;
    }
    mysql_free_result($query_pterm);
  } else
  {
    echo "Function getpaymentterm called without a parameter";
    $bl_return_var = FALSE;
  }
  return $bl_return_var;
}

/*********************************************************
 * Function     : getcontactname
 * Will return the name of the ContactID
 * Input        : ContactID
 * Returns      : the contactname
 *********************************************************/
function getcontactname($int_ContactID)
{
  $str_return = False;
  if ($int_ContactID)
  {
    $sql = 'SELECT CompanyName
             FROM contacts
             WHERE ContactID = ' . $int_ContactID;

    $query = mysql_query($sql)
        or die("Invalid getcontactname: " . $sql . "->" . mysql_error());
    if ($obj = mysql_fetch_object($query))
    {
      $str_return = $obj->CompanyName;
    }
    mysql_free_result($query);
  } else
  {
    echo "Function getcontactname called without a parameter";
  }
  return $str_return;
}

/*********************************************************
 * Function     : GetContactId_account
 * Will return the ContactID from there bankaccount number
 * Input        : $int_bank_account
 *                $bl_return_invalid: True invalid is returned.
 * Returns      : The id of the contact.
 *********************************************************/
function GetContactId_account($int_bank_account,
    $bl_return_invalid = FALSE)
{
  global $db_iwex;
  $int_contact_id = FALSE;
  if ($int_bank_account)
  {
    $sql = "SELECT ContactID
                FROM contacts_bank_accounts
                WHERE account_number = '$int_bank_account'";

    $query = $db_iwex->query($sql);
    if ($obj = mysql_fetch_object($query))
    {
      $int_contact_id = $obj->ContactID;
    }
    mysql_free_result($query);
  } else
  {
    echo "Function GetContactId_account called without a parameter";
  }

  if (!$bl_return_invalid)
  {
    $int_contact_id = $int_contact_id <> INVALID ? $int_contact_id : FALSE;
  }
  return $int_contact_id;
}

/*********************************************************
 * Function     : get_stock
 * Will return the current stock of a product based on the inventory transctions.
 * Input        : productID: to get just the stock of this specific product
 *                ownerID: Stock owner to get.
 * Returns      : Integer of amount in stock
 *********************************************************/
Function get_stock($productid,
    $int_owner_id = OWN_COMPANYID)
{
  global $db_iwex;

  //set the default
  $stock_return = 0;

  $stock_sql = "SELECT DISTINCTROW current_product_list.ProductID,
        Sum(IF(isnull(UnitsReceived),0,UnitsReceived)-IF(isnull(UnitsSold),0,UnitsSold)-IF(isnull(UnitsShrinkage),0,UnitsShrinkage)) AS Stock,
        Sum(IF(isnull(UnitsOrdered),0,UnitsOrdered)-IF(isnull(UnitsReceived),0,UnitsReceived)) AS on_order, sku "  
      . STOCK_QUERY_CONDITION . // get all the inventory transactions without the RMA ones
      " AND current_product_list.ProductID = '$productid'
        AND stock_owner_id = '$int_owner_id'
        GROUP BY current_product_list.ProductID;"; 
  //echo  $stock_sql;
  $stock_result = $db_iwex->query($stock_sql);
  $obj = mysql_fetch_object($stock_result);
  if (!$obj)
  {
    $stock_return = 0;
  } else
  {
    $stock_return = $obj->Stock;
  }
  if (GetField("SELECT sku FROM current_product_list WHERE ProductID = '$productid'") == DB_SKU_SOFTBUNDEL)
  {
    $part_stock_sql = "SELECT Product_ids
                           FROM multi_articles2 
                           WHERE Multi_ID = '$productid';";
    //echo $part_stock_sql;
    $part_stock_result = $db_iwex->query($part_stock_sql);
    $int_n = 1;
    $int_min = 0;
    while ($part_obj = mysql_fetch_object($part_stock_result))
    {
      ${'freestock_part'.$int_n} = get_stock($part_obj->Product_ids,
          $int_owner_id);
      //echo 'get_stock: '.$part_obj->Product_ids . ' ' . ${'freestock_part'.$int_n} . '<br>';
      // the first time just use the found value
      if ($int_n ==1)
      {
        $stock_return = ${'freestock_part'.$int_n};
      } else
      {
      // now test if the value is smaller then use this one as the smallest
        if (${'freestock_part'.$int_n}<$stock_return) $stock_return = ${'freestock_part'.$int_n};
      }
      //echo 'get_stock: freestock_part'.$int_n .' '.${'freestock_part'.$int_n}.'<br>';
      $int_n += 1;
    }
    mysql_free_result($part_stock_result);
  }

  mysql_free_result($stock_result);

  return $stock_return;
}


/*********************************************************
 * Function     : getfreestock
 * Will return the freely available stock condition.
 * purely for customer purposes so we'll hide anything below 0
 * also exclude the given OrderID
 * Input        : ProductID: The id of the product.
 * 		        : order_id: The id of the order that should 
 *				            should not be used in the calculation.
 *                Stock_onwer: The owner id of the stock.
 * Returns      : positive Integer of the free stock
 *********************************************************/
Function getfreestock($int_ProductID,
    $int_order_id = 0,
    $int_owner_id = OWN_COMPANYID)
{
  global $db_iwex;

  //echo '<br>FS1: checking '.$int_ProductID.'<br>';
  // init vars
  $int_freestock = 0;
  $sql_order_date_check = '';
  if ($int_ProductID)
  {
    if (GetField("SELECT sku FROM current_product_list WHERE ProductID = '$int_ProductID'") == DB_SKU_SOFTBUNDEL)
    {
      $part_stock_sql = "SELECT Product_ids
                               FROM multi_articles2 
                               WHERE Multi_ID = '$int_ProductID';";
      //echo $part_stock_sql;
      $part_stock_result = $db_iwex->query($part_stock_sql);
      $int_n = 1;
      $int_min = 0;
      while ($part_obj = mysql_fetch_object($part_stock_result))
      {
        ${'freestock_part'.$int_n} = getfreestock($part_obj->Product_ids,
            $int_order_id,
            $int_owner_id);
        //echo 'get_stock: '.$part_obj->Product_ids . ' ' . ${'freestock_part'.$int_n} . '<br>';
        // the first time just use the found value
        if ($int_n ==1)
        {
          $int_freestock = ${'freestock_part'.$int_n};
        } else
        {
        // now test if the value is smaller then use this one as the smallest
          if (${'freestock_part'.$int_n} < $int_freestock) $int_freestock = ${'freestock_part'.$int_n};
        }
        //echo 'get_stock: freestock_part'.$int_n .' '.${'freestock_part'.$int_n}.'<br>';
        $int_n += 1;
      }
      mysql_free_result($part_stock_result);

    } else
    {
      $physical_stock = get_stock($int_ProductID, $int_owner_id);

      //first get the commited articles where this is the ordered article
      //echo 'FS2 stock'.$int_ProductID . ':'.$physical_stock.'<br>';
      $sql_getcommited = "SELECT SUM(to_deliver) as commited
                FROM order_details  
                INNER JOIN orders ON order_details.OrderID = orders.OrderID
                INNER JOIN current_product_list ON order_details.ProductID = current_product_list.ProductID
                WHERE " . openordedetails_condition . " 
                    AND order_details.to_deliver > '0' 
                    AND order_details.ProductID= '$int_ProductID'";

      if ($int_order_id)
      {
        $sql_order_date_check = " AND orders.OrderDate < '".GetField("SELECT OrderDate
                                                                              FROM orders 
                                                                              WHERE OrderID = $int_order_id")
            . "'";
        $sql_getcommited .= $sql_order_date_check;
      }
      //echo $sql_getcommited;
      $qry_getcommited  = $db_iwex->query($sql_getcommited);
      $obj = mysql_fetch_object($qry_getcommited);
      $int_commited = $obj->commited;
      //echo 'FS4: commited: '.$int_commited.'<br>';
      // now add the committed articles where this is a part of an ordered article
      $sql_getcommited_multi = "SELECT sum(order_details.to_deliver) as commited
                FROM multi_articles2 
                INNER JOIN order_details ON multi_articles2.Multi_ID = order_details.ProductID
                INNER JOIN orders ON order_details.OrderID = orders.OrderID AND ".FREESTOCK_ORDER_CONDITION."
                WHERE Product_ids= '$int_ProductID' AND order_details.to_deliver > '0'" . $sql_order_date_check;
      //echo $sql_getcommited;
      $qry_getcommited_multi  = $db_iwex->query($sql_getcommited_multi);
      $obj_multi = mysql_fetch_object($qry_getcommited_multi);
      $int_commited += $obj_multi->commited;

      mysql_free_result($qry_getcommited_multi);
      //echo 'FS4+multi: commited: '.$int_commited.'<br>';
      // now subtract the combined commited units from the phisical stock
      $int_freestock = $physical_stock - $int_commited;

      // now subtract the combined commited units from the phisical stock
      $int_freestock = $physical_stock - $int_commited;
      mysql_free_result($qry_getcommited);
    }
  } else
  {
    echo "-";
  //exit;
  }
  //echo 'FS5: free stock'.$int_ProductID . ':'.$int_freestock.'<br>';

  if (!$int_order_id)
  { // When this is not the free stock for a specific order update the table.
    $db_iwex->query("UPDATE product_stock
						 SET free_stock = '$int_freestock',
							 free_stock_calculated = NOW()
						 WHERE Product_ID = '$int_ProductID'
						   AND owner_id = ' $int_owner_id'");	
  }
  return $int_freestock;
}

/*********************************************************
 * Function     : getparts
 * to lookup the parts of a sku = 0 product
 * Input        : queryres: will contain the array
                     ProductID: The id of the product.
                     CompanyID: The id of the stock owner.
 * Returns      : an array of ProductID, amount
 *********************************************************/
Function getparts($queryres,
    $int_ProductID,
    $int_companyID = OWN_COMPANYID)
{
  $returnvalue = FALSE;
  // init vars
  if ($int_ProductID)
  {
    $sql_parts = "SELECT multi_articles2.Product_ids, current_product_list.ProductName, multi_articles2.Aantal,
            current_product_list.Merk, product_stock.stock, current_product_list.ReorderLevel, current_product_list.ExternalID
            FROM multi_articles2
            INNER JOIN current_product_list ON multi_articles2.Product_ids = current_product_list.ProductID
            LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '$int_companyID'
            WHERE Multi_ID = $int_ProductID ORDER BY multi_articles2.Product_ids";                    
    $queryres = mysql_query($sql_parts)
        or die("Invalid sql_parts: " . mysql_error());
    $returnvalue = TRUE;
  } else
  {
    echo "Function getparts called without a parameter";
  }
  return $returnvalue;
}

/*********************************************************
 * Function     : inventory_transaction
 * to insert / add an inventory transaction + update the article stock field
 * Input        :  ProductID: The id of the product.
 * Returns      : true if it worked
*********************************************************/
Function inventory_transaction(
    $dt_TransactionDate,
    $int_ProductID,
    $ch_Description,
    $ch_ExternalID,
    $int_PurchaseOrderID,
    $int_podetailsID,
    $int_OrderID,
    $int_orderdetailsID,
    $int_shipmentID,
    $ch_TransactionDescription,
    $flt_UnitPrice,
    $UnitsReceived,
    $int_UnitsSold,
    $int_UnitsShrinkage,
    $flt_btw_percentage,
    $flt_added_cost,
    $int_box_ID,
    $int_employee_id,
    $stock_owner = OWN_COMPANYID)
{
  global $db_iwex;
  $returnvar = FALSE;

  if ($int_ProductID)
  {
  // now insert the packed article in the inventory_transactions
    $insert_sql="INSERT INTO inventory_transactions set
            TransactionDate = '".$dt_TransactionDate."',
            ProductID = '".$int_ProductID."',
            Description = '".$ch_Description."',
            ExternalID = '".$ch_ExternalID."',
            PurchaseOrderID = '".$int_PurchaseOrderID."',
            podetailsID = '".$int_podetailsID."',
            OrderID = '".$int_OrderID."',
            orderdetailsID = '".$int_orderdetailsID."',
            shipmentID ='".$int_shipmentID."',
            TransactionDescription = '".$int_shipmentID."',
            UnitPrice = '".$flt_UnitPrice."',
            UnitsReceived = '".$UnitsReceived."',
            UnitsSold = '".$int_UnitsSold."',
            UnitsShrinkage = '".$int_UnitsShrinkage."', 
            btw_percentage = '".$flt_btw_percentage."', 
            added_cost = '".$flt_added_cost."',
            box_ID = '".$int_box_ID."',
            employee='".$int_employee_id."',
            stock_owner_id = '$stock_owner'";
    //echo $insert_sql;
    $query_insert_ok = $db_iwex->query($insert_sql);
    if ($query_insert_ok)
    {
    //update current product list stock field
      update_all_stock($int_ProductID,
          $stock_owner);
      echo get_stock($int_ProductID,
      $stock_owner);
      $returnvar = TRUE;
    } else
    {
      echo "insert into inventory_transaction failed";
    }
  } else
  {
    echo "Function inventory_transaction called without ProductID";
    $returnvar = FALSE;
  }
  Return $returnvar;
}

/**
 * Function     : GetPriceLevel
 * Will return the customers pricelevel condition.
 * Input        : int_customerID: The id of the customer.
 * Returns      : The pricelevel id.
 **/
Function GetPriceLevel($int_customerID)
{
  if ($int_customerID)
  {
    return GetField("SELECT pricelevel FROM contacts
                         WHERE ContactID = '$int_customerID'");
  } else
  {
    Return '1';
  }
}

/**
 * Function     : GetDeliveryDate
 * Will give the current expected product delivery date.
 * Input        : $int_productid, Product id
 *                $int_order_id, current order.
 *                $int_stock_owner, owner of the stock
 * Returns      : The expected delivery date.
 **/
function GetDeliveryDate($int_productid, 
    $int_order_id = 0,
    $int_stock_owner = OWN_COMPANYID)
{
  $str_return_date = "Onbekend";

  if ($int_productid)
  {
    $db_iwex = new DB();
    $sql_adres = "SELECT LeadTime, last_exp
		    		  FROM current_product_list
		    		  WHERE ProductID = $int_productid";

    $qry_adr = $db_iwex->query($sql_adres);

    $obj = mysql_fetch_object($qry_adr);

    $obj->LeadTime = $obj->LeadTime > 0 ? $obj->LeadTime : 14;

    if (getfreestock($int_productid, $int_order_id, $int_stock_owner) > 0)
    {
      $obj->last_exp = date("Y-m-d");
    } else if ($obj->last_exp < date("Y-m-d"))
      {
        $obj->last_exp = date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d") + $obj->LeadTime, date("Y")));
      }

    $str_return_date = $obj->last_exp;

    mysql_free_result($qry_adr);
  }

  return $str_return_date;
}

/**
 * Function     : CreateRMA_Order
 * Will add the products to an order.
 * Input        : $int_productid, Product id to add
 *                $int_amount, number of products to add
 * Returns      : None.
 **/
function CreateRMA_Order($int_productid,
    $int_amount,
    $int_ContactID,
    $RMAactionID,
    $str_order_refrma = RMA_RETOUR_TEXT,
    $flt_price = 0,
    $bl_credit=FALSE)
{
  $int_order_id = GetOpenRMAOrder(TRUE,
      $int_ContactID,
      $RMAactionID,
      FALSE,
      $str_order_refrma,
      $bl_credit);
  //echo "Order product $int_productid * $int_amount on order $int_order_id with description $str_order_refrma <br>";

  $flt_unitprice = 0;
  $str_korting = 0;
  $flt_extendedprice = 0;

  if ($int_order_id)
  {
    $int_order_detail_id = GetField("SELECT OrderDetailsID
                              FROM order_details
                              WHERE ProductID='$int_productid'
                                AND RMA_actionID = '$RMAactionID'");
    $bl_BTW = GetField("SELECT Btw_YN
                            FROM orders 
                            WHERE OrderID = $int_order_id");
    $btw_perce = $bl_BTW ? GetBtwClass($int_productid) : 0;
    $btw_value = (float) $btw_perce * $flt_price;
    echo "VAT $bl_BTW, $btw_perce, $btw_value";

    if ($int_order_detail_id)
    {
      $sql_orderdetail =  "UPDATE order_details SET Quantity= $int_amount, "
          ." to_deliver= $int_amount, "
          ." Extended_price= '$flt_price', "
          ." UnitBTW = '$btw_value', "
          ." btw_percentage = '$btw_perce',"
          ." manual_price = 1"
          ." WHERE RMA_actionID = '$RMAactionID'";
    } else
    {
      $int_to_deliver_amount = $bl_credit ? 0 : $int_amount;
      $sql_orderdetail = "INSERT INTO order_details SET Quantity='$int_amount', "
          ." ProductID='$int_productid',"
          ." ProductName='".GetProductName($int_productid)."',"
          ." UnitPrice= '$flt_price',"
          ." UnitBTW = '$btw_value', "
          ." btw_percentage = '$btw_perce',"
          ." to_deliver='$int_to_deliver_amount', "
          ." Discount='0',"
          ." Extended_price='".$flt_price*$int_amount."',"
          ." OrderID='$int_order_id',"
          ." RMA_actionID = '$RMAactionID', "
          ." manual_price = 1";
    //echo $sql_orderdetail.'<br>';
    }
    $query = mysql_query($sql_orderdetail)
        or die("Invalid sql createrma order: $sql_orderdetail" . mysql_error());
    // Now update the order date and time with the current time. To make sure that this order doesn't age.
    $sql_update_order = "UPDATE orders SET OrderDate=".insertDate(date("Y-m-d H:i"))
        ." WHERE OrderID = '$int_order_id'";
    $query = mysql_query($sql_update_order);
  } else
  {
    echo "Order aanmaken/opzoeken mislukt<br>";
  }
}

/**
 * Function     : GetSupplier
 * Find the supplier
 * Input        : $product id, the id of the product
 * Returns      : The supplier
 **/
Function GetSupplier($int_productid)
{
  return GetField("SELECT Supplier FROM current_product_list WHERE ProductID = $int_productid");
}

/**
 * Function     : GetOpenOrder
 * Find or when not find make open order.
 * Input        : $bl_create, true when there should be one created when there is none.
 * Returns      : The order number.
 **/
Function GetOpenRMAOrder($bl_create = FALSE,
    $int_contactID,
    $int_RMAactionID,
    $bl_delete=FALSE,
    $str_order_ref = RMA_RETOUR_TEXT,
    $bl_credit=FALSE)
{
  $int_RMAID = Getfield("SELECT RMAID from RMA_actions WHERE ActionID = '$int_RMAactionID'");
  $int_order_num = GetField("SELECT OrderID
            FROM orders 
            WHERE ContactID = '$int_contactID' 
                AND rma_yn = 1 
                AND administration_order = '$bl_credit'
				AND Locked_yn = '0'
				AND Complete_yn = '0'
				AND ContactsOrderID = '$str_order_ref'
            ORDER BY OrderID DESC");
  //echo $int_order_num;
  // When there is no order number insert one.
  if (!$int_order_num && $bl_create)
  {
    $int_shipid = GetDefaultShipAdresId($int_contactID);
    $int_ship_id = GetDefaultShipAdresId($int_contactID);
    $sql_insert_ord =  "INSERT orders set ContactID='".$int_contactID."', "
        ."OrderDate=".insertDate(date("Y-m-d H:i")).", "
        ."ShipID='".$int_ship_id."', "
        ."Price_Level= ".GetPriceLevel($int_contactID).", "
        ."paymentterm_yn='2', "
        ."Btw_YN='".(GetField("SELECT land FROM Adressen WHERE AdresID = $int_ship_id") == 'NL')."', "
        ."rma_yn = 1, "
        ."administration_order = '$bl_credit', "
        ."confirmed_yn = '1', "
        ."Locked_yn = '0', "
        ."manual_ordercosts = 1, Ordercosts = 0, " // Set default order cost for RMA orders to 0.
        ."ShipName = '".GetField("SELECT Naam FROM Adressen WHERE AdresID=$int_shipid")."',"
        ."Shipaddress = '".GetField("SELECT CONCAT_WS(' ', straat, huisnummer) AS adres FROM Adressen WHERE AdresID=$int_shipid")."',"
        ."ShipCity = '".GetField("SELECT plaats FROM Adressen WHERE AdresID=$int_shipid")."',"
        ."ShipPostalCode = '".GetField("SELECT postcode FROM Adressen WHERE AdresID=$int_shipid")."',"
        ."ShipCountry = '".GetField("SELECT land FROM Adressen WHERE AdresID=$int_shipid")."',"
        ."ContactsOrderID = '$str_order_ref';";
    //echo "insert qeury = '$sql_insert_ord'<br>";
    $query = mysql_query($sql_insert_ord)
        or die("Invalid sql_insert_ord: " . $sql_insert_ord. ' ' . mysql_error());
    $int_order_num = mysql_insert_id();
    echo "a new Order: $int_order_num is created for rma ".$int_RMAID." <br>";
  }

  // When there is order number and delete is true....
  if ($int_RMAactionID
      &&
      $bl_delete)
  {
        /*$sql_del_ord =  "DELETE FROM orders 
            WHERE ContactID='$int_contactID' AND
            rmaID = '$int_RMAID' ;";
        $query = mysql_query($sql_del_ord)
           ;//or die("Invalid sql: " . mysql_error());
        echo "Order $int_order_num is deleted for RMA ".$int_RMAID." <br>";*/
  // now delete the details
    $int_orderdetailsid = GetField("SELECT OrderDetailsID
            FROM order_details 
            INNER JOIN orders ON order_details.OrderID = orders.OrderID
            WHERE rma_actionID = '$int_RMAactionID'
                AND rma_yn = 1 
				AND Locked_yn = '0'
				AND Complete_yn = '0'");
    if ($int_orderdetailsid)
    {
      $sql_del_detail =  "DELETE FROM order_details
                WHERE OrderDetailsID = '$int_orderdetailsid'";
      $query = mysql_query($sql_del_detail)
          or die("Invalid sql_del_detail: " . mysql_error());
      echo "Orderdetails in order $int_order_num (detail $int_orderdetailsid) are deleted for RMAaction "
          .$int_RMAactionID.":".$sql_del_detail." <br>";
    } else
    {
      echo "<H2>Orderdetails niet gevonden of al uitgeleverd. KIJK NA OF DE CREDIT ER NOG STEED IS!!</H2>";
      $int_order_num = FALSE;
    }
  }

  return $int_order_num;
} 

/**
 * Function     : ShowRMA_action_Basket
 * Show the basket of this RMA action.
 * Returns      : The HTML string.
 **/
Function ShowRMA_action_Basket($int_contactID,$int_RMAactionID)
{
    /*$int_order_id = $int_order_num = GetField("SELECT OrderID 
            FROM order_details
            WHERE rma_actionID = '$int_RMAactionID'");*/
  $db_iwex = new DB();

  $sql_RMA_orderdetails = "SELECT orders.OrderID, administration_order
            FROM order_details
            INNER JOIN orders ON order_details.OrderID = orders.OrderID
            WHERE rma_actionID = '$int_RMAactionID'";
  //echo $sql_RMA_orderdetails;
  $qry = $db_iwex->query($sql_RMA_orderdetails);

  while($obj_order = mysql_fetch_object($qry))
  {
    $qry_result = NULL;
    $str_return = "Geen producten klaargezet.";
    if ($obj_order->OrderID)
    {
      if (getorderdetails(&$qry_result,$obj_order->OrderID))
      {
        $str_return = "<table border=0 cellspacing=0 cellpadding=2>\n";
        while($obj = mysql_fetch_object($qry_result))
        {
        // first create the tag depending on whether it's an admin order or not
          $order_link = $obj_order->administration_order ?
              "admin/admin_order" :
              "order" ;
          //just show the orderdetail that belongs to this RMAaction
          if ($obj->rma_actionID == $int_RMAactionID)
          {
            if ($obj->to_deliver<$obj->Quantity)
            {
              $delivered_sql = "SELECT inventory_transactions.ProductID, shipments.Shipment_ID, SUM(inventory_transactions.UnitsSold) AS UnitsSold, Ship_date,
                                shipments.Tracking, postcode, box_number 
                                FROM inventory_transactions
                                INNER JOIN shipments ON inventory_transactions.shipmentID = shipments.Shipment_ID
                                INNER JOIN Adressen ON shipments.AdressID=Adressen.AdresID
                                INNER JOIN box ON inventory_transactions.box_ID = box.box_ID
                                INNER JOIn order_details on order_details.OrderDetailsID = inventory_transactions.orderdetailsID
                                WHERE order_details.RMA_actionID = '$int_RMAactionID'  
                                GROUP BY shipments.Shipment_ID, ProductID;";
              $delivered_query = mysql_query($delivered_sql)
                  or die("Ongeldige delivered query: " .$delivered_sql. mysql_error());
              while ($obj_delivered = mysql_fetch_array($delivered_query))
              {
                $str_return .= "<tr><td>Verzonden op <a href=$order_link.php?orderID=$obj_order->OrderID target='_new'>order $obj_order->OrderID </a>
                                                met <a href=shipment.php?shipmentID=".$obj_delivered["Shipment_ID"]." target='_new'>Levering ".$obj_delivered["Shipment_ID"]."</a>";
                $str_return .= " Datum ". $obj_delivered["Ship_date"];
                $str_return .= " Doos ". $obj_delivered["box_number"];
                $str_return .=  "Tracking: ". createtrackinglink($obj_delivered["Tracking"], $obj_delivered["postcode"])."</td></tr>\n";
              }
              mysql_free_result($delivered_query);
            } else
            {
              $str_return .= "<tr><td>Klaargezet voor levering op <a href=$order_link.php?orderID=$obj_order->OrderID target='_new'>order $obj_order->OrderID </a>: $obj->ProductID</td><td> x </td><td align=right>$obj->Quantity</td></tr>\n";
            }
          }
        }
        mysql_free_result($qry_result);
      }
    }
  }
  $str_return .= "</table>\n";
  RETURN $str_return;
}

/**
 * Function     : GetNewOrders
 * Will return the New orders needing confirmation
 * Input        : Format menu, when True JScookmenu is returned.
 * Returns      : hyperlinked string containg the ordernumbers and customers
 **/
function GetNewOrders($bl_menu = FALSE)
{
  global $_GLOBAL, $raccess_s;
  $str_return = "";

  // When customer has no sales acces.
  if (!$raccess_s) return $str_return;

  $db_iwex = new DB();
  $sql_ord = "SELECT OrderID, CompanyName
                    FROM orders 
                    INNER JOIN contacts ON orders.ContactID = contacts.ContactID
                    WHERE Confirmed_yn='2' ORDER BY orderdate;";
  //echo $sql_ord;

  $qry = $db_iwex->query($sql_ord);
  if ($bl_menu)
  {
    if ($int_no_records = mysql_num_rows($qry))
    {
      $str_return = ",\n\t\t['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/credits.png\"/>',' <b>$int_no_records</b> online bestelling".($int_no_records > 1 ? "en" : "")."',null,null,'Online order'";
      while ($obj_order = mysql_fetch_object($qry))
      {
        $str_return .= ",\n\t\t\t['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/edit.png\"/>','$obj_order->CompanyName','".docroot."/order.php?orderID=$obj_order->OrderID',null,'$obj_order->CompanyName']";
      }
      $str_return .= "\n\t\t],\n_cmSplit";
    }
  } else
  {
    $str_return .= "<table >\n<tr>\n";
    $str_return .= "<th colspan=2 class='blocktitle'>nieuwe onbevestigde orders</th>\n</tr>\n";
    if (mysql_num_rows($qry))
    {
      while ($obj_order = mysql_fetch_object($qry))
      {
        $str_return .= "<tr>\n<td class=\"cellinedetail\"><a href='order.php?orderID=$obj_order->OrderID'>$obj_order->OrderID</a></td>
                                <td class=\"cellinedetail\">$obj_order->CompanyName</td>\n</tr>\n"; 
      }
    } else
    {
      $str_return .= "<tr><td colspan=2 class=\"blockbody\">Geen online orders</td></tr>\n";
    }
    $str_return .= "</table>\n";
  }

  mysql_free_result($qry);

  return $str_return;
}

/**
 * Function     : GetShipOrders
 * Will return the orders needing shipment
 * Input        : Format menu, when True JScookmenu is returned.
 * Returns      : hyperlinked string containg the ordernumbers and customers
 **/
function GetShipOrders($bl_menu = FALSE)
{
  global $_GLOBAL, $raccess_s;
  $str_return = "";

  // When customer has no sales acces.
  if (!$raccess_s) return $str_return;

  $db_iwex = new DB();
  // Select orders to be shipped that don't have a shipment ID.
  $sql_ord = "SELECT DISTINCTROW orders.OrderID, CompanyName, CONCAT_WS(', ', ShipName, Shipaddress, ShipCity) AS ShipTo
                    FROM orders 
                    INNER JOIN contacts ON orders.ContactID = contacts.ContactID
					INNER JOIN order_details ON orders.OrderID = order_details.OrderID
					LEFT JOIN shipments ON shipments.AdressID = orders.ShipID 
						AND (Start_date > '0000-00-00 00:00:00' OR isnull(Start_date)) 
						AND isnull(shipments.ship_date) 
						AND cancel = 0
                    WHERE (RequiredDate<=date(now()) OR ISNULL(orders.RequiredDate))
						AND Confirmed_yn = 1
						AND NOT Locked_yn
						AND NOT Complete_yn
						AND NOT administration_order
						AND NOT rma_yn
						AND orders.OrderDate > '2006-06-01'
						AND (NOT shipments.Shipment_ID OR ISNULL(shipments.Shipment_ID))						
					ORDER BY orders.orderdate;";
  //echo $sql_ord;

  $qry = $db_iwex->query($sql_ord);
  if ($bl_menu)
  {
    if ($int_no_records = mysql_num_rows($qry))
    {
      $str_return = ",\n\t\t['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/credits.png\"/>',' <b>$int_no_records</b> Shiporder".($int_no_records > 1 ? "s" : "")."',null,null,'order te shippen'";
      while ($obj_order = mysql_fetch_object($qry))
      {
      //if (!check_open_shipment($obj->ShipID)) {
        $str_return .= ",\n\t\t\t['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/edit.png\"/>','$obj_order->CompanyName to $obj_order->ShipTo','".docroot."/order.php?orderID=$obj_order->OrderID',null,'$obj_order->CompanyName']";
      //}
      }
      $str_return .= "\n\t\t],\n_cmSplit";
    }
  } else
  {
    $str_return .= "<table >\n<tr>\n";
    $str_return .= "<th colspan=2 class='blocktitle'>Te shippen orders</th>\n</tr>\n";
    if (mysql_num_rows($qry))
    {
      while ($obj_order = mysql_fetch_object($qry))
      {
        $str_return .= "<tr>\n<td class=\"cellinedetail\"><a href='order.php?orderID=$obj_order->OrderID'>$obj_order->OrderID</a></td>
                                <td class=\"cellinedetail\">$obj_order->CompanyName</td>\n</tr>\n"; 
      }
    } else
    {
      $str_return .= "<tr><td colspan=2 class=\"blockbody\">Geen orders te shippen</td></tr>\n";
    }
    $str_return .= "</table>\n";
  }

  mysql_free_result($qry);

  return $str_return;
}

/**
 * Function     : GetSpecialMenus
 * Will return JScookmenu format menus for events that
 * are pending to be done.
 * Input        : None.
 * Returns      : hyperlinked string containg menu items
 **/
function GetSpecialMenus()
{
  global $_GLOBAL, $waccess_a;
  $str_return = "";

  // When customer has no admininstration acces.
  if (!$waccess_a) return $str_return;

  $db_iwex = new DB();
  $sql_ord = "SELECT title, link, image
                    FROM events
                    WHERE (reccurtype = 1 AND reccurday = WEEKDAY(NOW()) AND WEEK(action_performed_date) <> WEEK(NOW())
                          OR
                          reccurtype = 2 AND WEEK(NOW()) <> WEEK(action_performed_date)
                          OR
                          reccurtype = 3 AND MONTH(NOW()) <> MONTH(action_performed_date)
                          OR
                          reccurtype = 4 AND QUARTER(NOW()) <> QUARTER(action_performed_date)
                          OR
                          reccurtype = 5 AND YEAR(NOW()) <> YEAR(action_performed_date))
                          OR
                          reccurtype = 7 AND reccurweekdays = WEEKDAY(NOW())
                          OR
                          reccurtype = 6 AND action_performed_date <= NOW() AND action_performed_date > 0
                          AND NOT
                          Cronjob_yn
						  ORDER BY id";
  //echo $sql_ord;

  $qry = $db_iwex->query($sql_ord);
  if ($int_no_records = mysql_num_rows($qry))
  {
    $str_return = ",\n\t\t['<img src=\"".$_GLOBAL["str_backdir"]."js/ThemeOffice/warning.png\"/>',' Taken',null,null,'Online order'";
    while ($obj_order = mysql_fetch_object($qry))
    {
      $str_return .= ",\n\t\t\t['<img src=\"".$_GLOBAL["str_backdir"].
          "js/ThemeOffice/$obj_order->image\"/>','$obj_order->title','"
          .docroot."/$obj_order->link',null,'$obj_order->title']";
    }
    $str_return .= "\n\t\t],\n_cmSplit";
  }

  mysql_free_result($qry);

  return $str_return;
}

/**
 * Function     : reset_login_attempts
 * Description  : sets login attempts to 0 (null)
 * Input        : $user
 **/
Function reset_login_attempts($user)
{
  $sql_reset_login_attempts = "UPDATE users SET login_attempts = '0' WHERE uid = '$user'";
  mysql_query($sql_reset_login_attempts) or die("Ongeldige update query: ". mysql_error());
}

/**
 * Function     : reset_login_attempts
 * Description  : sets login attempts to 0 (null)
 * Input        : $user
 **/
Function add_listbox_cat($listbox_cat_id, $new_value)
{
  $str_return = "";
  $new_value = trim($new_value);
  if ($new_value)
  {
  //oude waardes opvragen:
    $qry = "SELECT text, value, comments FROM listbox WHERE category = '$listbox_cat_id'";
    $result = mysql_query($qry) or die($qry." ".mysql_error());
    $count = mysql_num_rows($result);
    $count = $count +1;
    while($row = mysql_fetch_array($result))
    {
      if($row["text"] == $new_value)
      {
        $str_return = "<CENTER><H2>Deze waarde bestaat al. Misschien heeft u refresh gedaan?</H2></CENTER>\n";
        return $str_return;
        mysql_free_result($result);
        exit;
      }
      $comment = $row["comments"];
    }
    mysql_free_result($result);

    //add to datebase
    $sql = "INSERT INTO listbox SET value = '$count', text = '$new_value', category = '$listbox_cat_id', comments = '$comment'";
    mysql_query($sql) or die("Ongeldige update query: ". mysql_error());
    $str_return = "<CENTER><H2>Nieuwe waarde is toegevoegd.</H2></CENTER>\n";
  }else
  {
    $str_return = "<CENTER><H2>Error! Geen waarde ingevoerd?</H2></CENTER>\n";
  }
  return $str_return;
}

/**
 * Function     : check_extra_info
 * Will return true if there is extra product info
 * Input        : $prod_id
 * Returns      : true of false
 **/
Function check_extra_info($prod_id)
{
  $bl_return = FALSE;
  $qry = "SELECT ProductID FROM extra_product_info WHERE ProductID = '$prod_id'";
  $result = mysql_query($qry) or die($qry ." ". mysql_error());
  if(mysql_num_rows($result))
  {
    $bl_return = TRUE;
  }
  return $bl_return;
}

/*
 * Function     :  get_relations
 * return an array with all related products for this type
 * Input        : ProductID: The id of the product, Type is type of relation.
 * Returns      : array, or false
*/
Function get_relations($int_ProductID,$type)
{
  $sql ='';
  $DB_iwex = new DB();
  $returnvar = FALSE;
  if ($int_ProductID && $type)
  {

    $productstuff = " ProductID, Productname, MerkID ";
    if ($type == 'device')
    {
      $device_condition = 'AND ' . Device_Category_Condition;
      $sql = "Select ".$productstuff."  FROM associated_products
                INNER JOIN current_product_list ON associated_products.ProductID_Main = current_product_list.ProductID
                WHERE ProductID_Acc = '" . $int_ProductID . "'
                AND ".Device_Category_Condition.";";                     
    }
    if ($type == 'acces')
    {
      $device_condition = '';
      $sql = "Select ".$productstuff."
                FROM associated_products 
                INNER JOIN current_product_list ON associated_products.ProductID_Acc = current_product_list.ProductID
                WHERE (ProductID_Main = '" . $int_ProductID . "' OR ProductID_Acc = '" . $int_ProductID . "')
                AND NOT (current_product_list.CategoryID = 3 OR current_product_list.CategoryID = 9)
                UNION
                SELECT ".$productstuff." 
                FROM associated_products
                INNER JOIN current_product_list ON associated_products.ProductID_Main = current_product_list.ProductID
                WHERE (ProductID_Main = '" . $int_ProductID . "' OR ProductID_Acc = '" . $int_ProductID . "')
                AND NOT (CategoryID = 3 OR CategoryID = 9);";  
    }
    if ($type == 'other')
    {
      $device_condition = '';
      $sql = "SELECT ".$productstuff." FROM related_products
                    INNER JOIN current_product_list ON related_products.ProductID1 = current_product_list.ProductID
                    WHERE ProductID1 = '" . $int_ProductID . "' OR ProductID2 = '" . $int_ProductID . "'
                    UNION
                    SELECT ".$productstuff." FROM related_products 
                    INNER JOIN current_product_list ON related_products.ProductID2 = current_product_list.ProductID
                    WHERE ProductID1 = '" . $int_ProductID . "' OR ProductID2 = '" . $int_ProductID . "';";  
    }
    if ($sql)
    {
    //get the data
      $query = $DB_iwex->query($sql);
      //echo $sql;
      $str = '';
      While ($obj = mysql_fetch_object($query))
      {
        if ($str) $str .= ',';
        $str .= $obj->ProductID;
      }
      $returnvar = explode(',',$str);
      //var_dump($returnvar);
      mysql_free_result($query);
    }
  }
  Return $returnvar;
}

/**
 * Function     : update_image_link
 * updates exeistance of image and extension in the current_product_list table
 * Input        : ProductID ,
 *                extension - string (jpg,gif,png etc, lookup in listbox table)
 *                          - integer if already looked up listbox table
 * Returns      : true
 **/
Function update_image_link($int_productID, $mix_ext, $present=TRUE)
{
  $returnvar = FALSE;
  if ($int_productID)
  {
    $DB_iwex = new DB();
    $int_ext = $mix_ext;
    if (!is_numeric($mix_ext)) $int_ext = GetField("SELECT value FROM listbox WHERE text='$mix_ext' AND category='10'");
    if ($present)
    {
      $sql = "UPDATE current_product_list SET image = '$int_ext' WHERE ProductID='$int_productID'";
    } else
    {
      $sql = "UPDATE current_product_list SET image = '' WHERE ProductID='$int_productID'";
    }
    if ($DB_iwex->query($sql)) $returnvar = TRUE;
  }

  return $returnvar;
}

/**
 * Function     : ShowShortContactInfo
 * Shows when the mouse is over the field some small contact information.
 * Input        : ContactID, The ID of the contact.
 * Returns      : text
 **/
Function ShowShortContactInfo($int_contact_id, $str_options = "STICKY, MOUSEOFF")
{
  global $db_iwex;
  $str_name = "";
  $str_phone = "";
  $str_fax = "";
  $str_email = "";

  $qry_result = $db_iwex->query("SELECT CompanyName, Phone, Fax, email
                                   FROM contacts
                                   WHERE ContactID = '$int_contact_id'");
  if ($obj = mysql_fetch_object($qry_result))
  {
    $str_name = $obj->CompanyName;
    $str_phone = "<a href=callto:".strip_characters($obj->Phone, array(' ')).">$obj->Phone</a>";
    $str_fax = $obj->Fax;
    $str_email = "<a href=mailto:$obj->email>$obj->email</a>";
  }
  mysql_free_result($qry_result);

  return ShowOnMouseOverText("$str_name<br>Tel: $str_phone<br>Fax: $str_fax<br>E-mail: $str_email",
  $str_options);
}

/**
 * Function     : ShowShortOrderInfo
 * Shows when the mouse is over the field some small contact information.
 * Input        : OrderID, The ID of the contact.
 * Returns      : text
 **/
Function ShowShortOrderInfo($int_Order_id)
{
  global $db_iwex;
  $str_product_id = "";
  $str_product_name = "";
  $str_product_quantity = "";

  $qry_result = $db_iwex->query("SELECT ProductID, ProductName, Quantity
                                   FROM order_details
                                   WHERE OrderID = '$int_Order_id'");
  $returning = "<table width=\'610\' border=\'0\'><tr><td width=\'80\'>Product ID</td><td width=\'500\'>Product</td><td width=\'30\' align=right>Aantal</td></tr>";
  while ($obj = mysql_fetch_object($qry_result))
  {
    $returning .= "<tr><td valign=\'top\'>$obj->ProductID</td><td valign=\'top\'>$obj->ProductName</td><td valign=\'top\' align=right>$obj->Quantity</td></tr>";
  }
  $returning .= "<table>";
  mysql_free_result($qry_result);

  return ShowOnMouseOverText("$returning");
}

/**
 * Function     : edit_button
 * Will show a toggle button and set the $edit_var accordingly, if rights sufficient.
 * Input        : rights_var : the globals right to check
 *		Formname: name of the calling form
 * Returns      :button or none if no rights
 **/

Function edit_button ($rights_var='', $formname='')
{
//default is view
  $edit_var = isset($_POST["edit_var"]) ? $_POST["edit_var"] : 'view';
  //see if the edit_var has been changed
  $bl_edit = (isset($_POST["edit_var"]) && $_POST["edit_var"] == 'edit') ? TRUE : FALSE ;
  // check rights
  $rights = isset($GLOBALS[$rights_var]) && $GLOBALS[$rights_var];
  $toggle_edit = '';

  if ($rights_var && $formname)
  {
    if ($rights)
    {
      $toggle_edit = "<INPUT TYPE='hidden' NAME='edit_var' VALUE='$edit_var'>";
      if ($bl_edit)
      {
        $toggle_edit .= "<INPUT TYPE='button' NAME='view_prices' VALUE='view'
					onclick=\"document.$formname.edit_var.value='view';
					document.$formname.submit();\">";
      } else
      {
        $toggle_edit .= "<INPUT TYPE='button' NAME='edit_prices' VALUE='edit'
					onclick=\"document.$formname.edit_var.value='edit';
					document.$formname.submit();\">";
      }
    }
  } else
  {
    $toggle_edit = $bl_edit;
  }
  return $toggle_edit;
}

/**
 * Function     : check_consignment_status
 * Will check consignment status of contactID
 * Input        : ContactID
 * Returns      :true or false
 **/
Function check_consignment_status($int_contactID)
{
  $returnvar = FALSE;

  if ($int_contactID)
  {
    $returnvar = GetField("SELECT consignment FROM contacts WHERE ContactID = '$int_contactID'");
  }
  return $returnvar;
}

/**
 * Function     : GetAdresFromZip
 * Will return an string with the adres.
 * Input        : NL zipcode
 * Output       : street and city
 * Returns      : String with an formatted adres
 **/
Function GetAdresFromZip($str_zipcode, $str_street = "", $qry_city = "" )
{
  $DB_postcode  = new DB($GLOBALS["ary_config"]["hostname.postcode"],
      $GLOBALS["ary_config"]["database.postcode"],
      $GLOBALS["ary_config"]["username.postcode"],
      $GLOBALS["ary_config"]["password.postcode"]);

  $str_street = GetField("SELECT CONCAT_WS(', ', straatnaam, huisnummer_start, huisnummer_end) AS straat
                            FROM straatnaam
                            WHERE postcode = '".str_replace(' ', '', $str_zipcode)."'",
      $DB_postcode);
  $qry_city = GetField("SELECT plaats
                          FROM plaatsnaam
                          WHERE postcode = '".substr($str_zipcode, 0, 4)."'",
      $DB_postcode);
  return "$str_street<br>$str_zipcode  $qry_city";
}

/**
 * Function     : calculate_ean13_checksum
 * Will return the EAN checksum.
 * Input        : EAN code
 * Returns      : checksum
 **/
function calculate_ean13_checksum($ean)
{
  $ean_array = array_reverse(preg_split('//', $ean, -1, PREG_SPLIT_NO_EMPTY));
  $oddsum = 0;
  $evensum = 0;

  for($i=0; $i<12; $i+=2)
  {
    $oddsum  += $ean_array[$i];
    $evensum += $ean_array[$i+1];
  //echo $ean_array[$i].$ean_array[$i+1];
  }
  $check_a  = $evensum + 3 * $oddsum;
  $check_b  = ceil($check_a/10)*10;
  $checksum = $check_b - $check_a;

  //echo "ean = '$ean', checksum = $checksum<br>";

  return $checksum;
}

/**
 * Function     : GetNewEANcode
 * Will return a new free EAN code
 * Returns      : EAN code
 **/
function GetNewEANcode()
{
  global $db_iwex;
  $array_ean = array();

  $qry = $db_iwex->query("SELECT EAN FROM current_product_list
                            WHERE EAN like '".substr(IWEX_EAN_CODE_BEGIN,0,(EAN_CODE_SIZE_NO_CHECKSUM-3))."%'");
  while ($obj = mysql_fetch_object($qry))
  {
    array_push($array_ean, substr($obj->EAN, 0, EAN_CODE_SIZE_NO_CHECKSUM));
  }
  sort($array_ean);

  echo "<pre>";
  print_r($array_ean);
  echo "</pre>";

  $int_ean_last = IWEX_EAN_CODE_BEGIN;

  $last_key = FALSE;
  foreach ($array_ean as $value)
  {
  // if the next number in the array iss more than 1 away there is a space we can use for this one
  // filling in the blanks or adding on the end.
    if ($value - $int_ean_last== 1 ) $int_ean_last = $value;
  }

  //echo "LASTean = $int_ean_last";
  return ($int_ean_last +1) . calculate_ean13_checksum($int_ean_last +1);
}

/**
 * Function     : GetEANcode
 * Will return the EAN code for given product.
 * Input        : int_product_id, the product id
 *                bl_create, when true create one when there is none
 * Returns      : EAN code
 **/
Function GetEANcode($int_product_id, $bl_create = FALSE)
{
  global $db_iwex;
  $int_ean = GetField("SELECT EAN FROM current_product_list
                         WHERE ProductID = '$int_product_id'");

  $int_ean = strlen($int_ean) == EAN_CODE_SIZE_NO_CHECKSUM ? '0'.$int_ean : $int_ean;
  if ($int_ean)
  {
    $int_checksum = calculate_ean13_checksum(substr($int_ean, 0, EAN_CODE_SIZE_NO_CHECKSUM));
    if ($int_ean[EAN_CODE_SIZE_NO_CHECKSUM] != $int_checksum)
    {
      echo "<h2>Invalid EAN code ($int_ean). Failed on the checksum. Must be $int_checksum.</h2>";
      echo MakeBeep(FALSE);
      $int_ean = FALSE;
    }
  } else if ($bl_create)
    {
      $int_ean = GetNewEANcode();
      $db_iwex->query("UPDATE current_product_list SET EAN = '$int_ean' WHERE ProductID = '$int_product_id'");
    }

  return $int_ean;
}

/**
 * Function     : GetMargin
 * Will return the Gros Margin for the given product and customer
 * Input        : int_product_id, the product id
 *                	  int_ContactID, customer
 * Returns    : float with margin
 **/
Function GetMargin($int_product_id, $int_contactID)
{
  $purchase_price = GetProductPrice($int_product_id,$int_contactID,'',OWN_COMPANYID,2);
  $sales_price = GetProductPrice($int_product_id,$int_contactID,'',OWN_COMPANYID,1);

  $fl_margin = $sales_price - $purchase_price;

  return $fl_margin;
}

/**
 * Function     : GetPriclevelUnits
 * Will tell you what number belongs to the pricelevel.
 * Input        : Pricelevel
 * Returns      : integer of number of units
 **/
Function GetPriclevelUnits($price_level)
{
  $int_units = 1;
  if ($price_level==1)
  {
  //$querysearch .= " Selling_price as 'Inkoop', ";
  } else if ($price_level==2)
    {
    //$querysearch .= " Selling_price_10 as 'Inkoop', ";
      $int_units = 10;
    } else if ($price_level==3)
      {
      //$querysearch .= " Selling_price_50 as 'Inkoop', ";
        $int_units = 50;
      } else if ($price_level==4)
        {
        //$querysearch .= " Selling_price_100 as 'Inkoop', ";
          $int_units = 100;
        } else
        {
        //$querysearch .= " Selling_price as 'Inkoop', ";
        }
  return $int_units;
}

/*
 * Function     :  GetBranches
 * Will get the brach information of this customer.
 * input        :  int_contact_id
 * Returns      :  array with id of the branches
 */
function GetBranches($int_contact_id,
    $bl_include_main = FALSE)
{
  global $db_iwex;

  $array_return = array();

  // Add the main contact ID to the array list.
  if ($bl_include_main) $array_return[] = $int_contact_id;

  $sql_get_branches = "SELECT BrancheContactID
						 FROM branches
						 WHERE MainContactID = '$int_contact_id'";
  $qry = $db_iwex->query($sql_get_branches);

  if ($qry)
  {
    while ($row = mysql_fetch_array($qry,
    MYSQL_NUM))
    {
      $array_return[] = $row[0];

      $array_return = array_merge($array_return, GetBranches($row[0]));
    }
  }

  return $array_return;
}

/*
 * Function     :  MakeBranche
 * Will make a branche for this customer.
 * input        :  int_contact_id
 *		 int_other_id another ID to identify the contactID
 * Returns      :  int with BrancheID
 */
function MakeBranche($int_contact_id,
    $int_other_id = FALSE,
    $str_Name = '')
{
  global $db_iwex;

  $array_return = FALSE;

  if ($int_contact_id)
  {
    $int_new_contact = create_contact($str_Name);
    $sql_make_branche = "INSERT INTO branches
							 SET 
							 	MainContactID = '$int_contact_id',
								BrancheContactID = '$int_new_contact'";
    $qry = $db_iwex->query($sql_make_branche);
    if ($int_other_id)
    {
      $sql_make_Cxref = "INSERT INTO contacts_xref
								SET 
							 	ContactID = '$int_new_contact',
								OtherID = '$int_other_id'";
      $qry = $db_iwex->query($sql_make_Cxref);
    }
  }
  return $int_new_contact;
}


/*
 * Function     :  GetHeadContacts
 * Will get the companies above this customer.
 * input        :  int_contact_id
 * Returns      :  array with id of the upper contacts.
 */
function GetHeadContacts($int_contact_id,
    $bl_include_main = FALSE)
{
  global $db_iwex;

  $array_return = array();

  // Add the main contact ID to the array list.
  if ($bl_include_main) $array_return[] = $int_contact_id;

  $sql_get_branches = "SELECT MainContactID
						 FROM branches
						 WHERE BrancheContactID = '$int_contact_id'";
  $qry = $db_iwex->query($sql_get_branches);

  if ($qry)
  {
    while ($row = mysql_fetch_array($qry,
    MYSQL_NUM))
    {
      $array_return[] = $row[0];

      $array_return = array_merge($array_return,
          GetHeadContacts($row[0]));
    }
  }
  return $array_return;
}

/*
 * Function     :  Getproductqty
 * Returning a qty number related on the min qty.
 * input        :  $int_productID = ID of the product
				   $int_quantity = quantity fill in for the product.
				   $int_type = SALE or PURCHASE
				   $int_contactID = The contactID for the product.
 * Returns      :  int with the recalculation of qty ($int_quantity = 0 return min quantity)
 */
function Getproductqty($int_productID, $int_quantity, $int_type, $int_contactID = 0)
{
  global $db_iwex;

  // set the date for this day.
  $str_date = date("Y-m-d");

  // Check if the cust need to be set into the query.
  if ($int_type == PRICING_TYPE_SALE)
  {
    $sql_cust_select = "AND (ContactID='$int_contactID' OR ContactID=0)";
  } else
  {
    $sql_cust_select = "";
  }

  // Get the results from the db.
  if ($int_type == PRICING_TYPE_SALE)
  {
    $int_minqly = Getfield("SELECT Reorder_q FROM current_product_list WHERE ProductID = '$int_productID'");
  } else
  {
    $result_qty = $db_iwex->query("SELECT start_number FROM pricing
									WHERE ProductID = '$int_productID' 
        $sql_cust_select
									AND (start_date <= '$str_date' || isnull(start_date) || start_date=0) 
									AND (end_date >= '$str_date' || isnull(end_date) || end_date=0)
									AND price_type='$int_type'
									ORDER BY start_number ASC
									LIMIT 1 ");
    $obj_qty = mysql_fetch_object($result_qty);
    $int_minqly = $obj_qty->start_number;

  }

  // If the min qty number is more than 1 the product can be only selling from that quantity.
  if ($int_minqly > 1)
  {
    if ($int_quantity < $int_minqly)
    {
      $int_quantity = $int_minqly;
    } else if ($int_type == PRICING_TYPE_SALE)
      {
        $int_recount_check = $int_quantity / $int_minqly;
        if (is_float($int_recount_check))
        {
          $int_quantity = round($int_recount_check) * $int_minqly;
        }
      }
  }
  Return $int_quantity;
}

/*
 * Function     :  shipmentvalidation
 * input        :  $int_shipmentID = ID of the shipment
 * Returns      :  Error string or false if there is no error)
 */
function shipmentvalidation ($int_shipmentID)
{
  global $db_iwex;
  global $int_allowshipment;

  $str_error = FALSE;

  // Get the shiment query
  $ship_sql = "SELECT TransactionID, inventory_transactions.ProductID, UnitsSold,
						UnitsShrinkage, store_serial_yn, sku
	             FROM inventory_transactions
	             INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
	             WHERE ShipmentID =".$int_shipmentID;
  //echo $inventory_sql;
  $shipquery = $db_iwex->query($ship_sql);

  while ($obj_shipdetails = mysql_fetch_object($shipquery))
  {
    $int_product_quantity = $obj_shipdetails->UnitsSold+$obj_shipdetails->UnitsShrinkage;
    if (isset($ary_product_quantity[$obj_shipdetails->ProductID]))
    {
      $ary_product_quantity[$obj_shipdetails->ProductID] += $int_product_quantity;
    } else
    {
      $ary_product_quantity[$obj_shipdetails->ProductID] = $int_product_quantity;
    }

    // If the product needs serials. Get them from the database.
    if ($obj_shipdetails->store_serial_yn)
    {
      $result_serials = $db_iwex->query("SELECT Serial, SerialRecordID
											   FROM Serialnumbers
											   WHERE Inventory_transactionID = '$obj_shipdetails->TransactionID'
											   ORDER BY SerialRecordID DESC");
      while ($obj_serials = mysql_fetch_object($result_serials))
      {

      // check for dublicated serial numbers.
        if (isset($ary_serial[$obj_shipdetails->ProductID]))
        {
          foreach($ary_serial[$obj_shipdetails->ProductID] As $str_serial)
          {
            if ($obj_serials->Serial == $str_serial)
            {
              $str_error .= "Serienummer <b>" . $obj_serials->Serial . " </b> van product $obj_shipdetails->ProductID is dublicated<BR>";
            }
          }
        }
        $ary_serial[$obj_shipdetails->ProductID][] = $obj_serials->Serial;
      }

      $int_quantityofserials = isset($ary_serial[$obj_shipdetails->ProductID]) ?
          count($ary_serial[$obj_shipdetails->ProductID]) : 0;

      if ($int_quantityofserials < $ary_product_quantity[$obj_shipdetails->ProductID])
      {
        $str_error .= "Product " . $obj_shipdetails->ProductID . " mist<b> " . ($int_product_quantity- $int_quantityofserials)
            . " </b>serial nummer(s)!<BR>";
      } else if ($int_quantityofserials > $ary_product_quantity[$obj_shipdetails->ProductID])
        {
          $str_error .= "Product " . $obj_shipdetails->ProductID . "
							   heeft<b> " . ($int_quantityofserials - $int_product_quantity)  . " </b>serial nummer(s) te veel!<BR>";
        }
    }
  }

  $result_shipinfo = $db_iwex->query("SELECT adrestitel ,contacts.ContactID, contacts.Country, kvk_number, Paymentterm_margin
										FROM shipments 
										LEFT JOIN Adressen ON shipments.AdressID = Adressen.AdresID
										LEFT JOIN contacts ON Adressen.ContactID = contacts.ContactID 
										WHERE Shipment_ID = '$int_shipmentID'");
  $obj_shipinfo = mysql_fetch_object($result_shipinfo);

  // KVK check
  //if ($str_kvkerror = KVKvalidation($obj_shipinfo->kvk_number, $obj_shipinfo->Country)) {
  //	$str_error .= $str_kvkerror . "<BR>";
  //}

  // Check invoice overdues
  $int_overdue_days = 0;

	/*
	$sql_invoices = SQL_INVOICES_PAYMENT;
	$sql_invoices .= " WHERE CustomerID = '$obj_shipinfo->ContactID'
					   AND overduetypeID
					   AND NOT paid_yn ";
	$result_invoices = $db_iwex->query($sql_invoices);

	while ($obj_overdueresults = mysql_fetch_object($result_invoices)) {
		$int_days = $obj_overdueresults->dayslate - $obj_shipinfo->Paymentterm_margin;

		if ($int_overdue_days < $int_days && $int_days > 0) {
			$int_overdue_days = $int_days;
		}
	}

	if ($int_overdue_days > 0) {
		$str_error .= "De klant heeft invoices over zijn betalingstermijn van max <B>$int_overdue_days</B> dagen!!<BR>";
	}
	*/

  // checking address
  //if ($obj_shipinfo->adrestitel != DB_ADDRESS_ONE_AND_ONLY
  //	&&
  //	$obj_shipinfo->adrestitel != DB_ADDRESS_DELIVERY) {
  //$str_error .= "Het afleveradress is geen afleveraddress";
  //}


  Return $str_error;
}

/**
 * Function     : OtherProductOwner
 * show several parameters of the product.
 * Input        : $int_productid: Product ID.
 * Returns      : True when others own also the product next to default.
 **/
function OtherProductOwner($int_productid)
{
  return GetField("SELECT Product_ID
					  FROM product_stock
					  WHERE Product_ID = '$int_productid'
						    AND owner_id <> '".OWN_COMPANYID."'");
}

/*
 * Function     :  shiptogether
 * input        :  $int_orderID = ID of the order
 * Returns      :  Returning FALSE if it can not be shipping together.
 */
function shiptogether($int_orderID)
{
  global $db_iwex;

  // Get all products from the database related to the order.
  $bl_check = TRUE;
  $result_orderdetails = $db_iwex->query("SELECT orders.OrderID, orders.Orderdate, ShipID, stock, to_deliver, Quantity, ProductID
											FROM order_details
					 						LEFT JOIN product_stock ON product_stock.Product_ID = order_details.ProductID
											LEFT JOIN orders ON orders.OrderID = order_details.OrderID
											WHERE order_details.OrderID = '$int_orderID' ");
  while ($obj_orderdetails = mysql_fetch_object($result_orderdetails))
  {
  // Set stock from the product.
    $int_stock = $obj_orderdetails->stock;
    // Get other orders in this shipment that are older then this one and also have the same product.
    $result_quantity = $db_iwex->query("SELECT to_deliver FROM order_details
											LEFT JOIN orders ON order_details.OrderID = orders.OrderID
											WHERE ShipID = '$obj_orderdetails->ShipID'
											AND orders.Orderdate <= '$obj_orderdetails->Orderdate'
											AND ProductID = '$obj_orderdetails->ProductID' 
											AND order_details.OrderID != $obj_orderdetails->OrderID");
    while ($obj_quantity = mysql_fetch_object($result_quantity))
    {
    // If there is a order with the same product recount the quantity.
      $int_stock -= $obj_quantity->to_deliver;
    }
    // check if there is not enough stock.
    if ($obj_orderdetails->to_deliver > $int_stock)
    {
      $bl_check = FALSE;
    }
  }
  Return $bl_check;
}

/*
 * Function     :  Gettexten
 * input        :  int_textid, the text id to find
 *				   int_languageid, the language to use
 * Returns      :  Returning FALSE if it can not be shipping together.
 */
Function Gettexten($int_textid,
    $int_languageid)
{
  global $db_iwex;

  $result_text = $db_iwex->query("SELECT text, subject FROM text
									WHERE categoryID = '" . $int_textid . "'
									AND languageID = '" . $int_languageid . "'
								  ");
  $obj_text = mysql_fetch_object($result_text);
  $ary_text[0] = $obj_text->subject;

  // Set defaults replaces
  $str_text = $obj_text->text;
  $str_text = str_replace(DB_COMPANYNAME, $GLOBALS["ary_config"]["companyname"] , $str_text);
  $str_text = str_replace(DB_ADDRESS, $GLOBALS["ary_config"]["address"] , $str_text);
  $str_text = str_replace(DB_ZIPCODE, $GLOBALS["ary_config"]["zipcode"] , $str_text);
  $str_text = str_replace(DB_CITY, $GLOBALS["ary_config"]["city"] , $str_text);
  $str_text = str_replace(DB_TELEPHONE, $GLOBALS["ary_config"]["telephone"] , $str_text);
  $str_text = str_replace(DB_FAXNUMBER_VAR, $GLOBALS["ary_config"]["fax"] , $str_text);
  $str_text = str_replace(DB_WEBSITE, $GLOBALS["ary_config"]["website"] , $str_text);

  $ary_text[1] = $str_text;
  return $ary_text;
}

/*
 * Function     :  Updateblockorder
 * input        :  $int_productID = ID of the product
 * Returns      :  Returning TRUE if everyting go right.
 */

function Updateblockorder($int_contactID, 
    $int_productID,
    $int_newquantity,
    $int_orderdetailsID = FALSE,
    $bl_confirmed_old = FALSE,
    $bl_comfirmed = FALSE)
{

  global $db_iwex;

  if ($bl_confirmed_old < $bl_comfirmed)
  {
    $int_oldquantity = 0;
  } else
  {
  // Get the old quantity from the order details.
    if ($int_orderdetailsID)
    {
      $int_oldquantity = getfield("SELECT Quantity FROM order_details
										 WHERE OrderDetailsID = '$int_orderdetailsID' ");
    } else
    {
      $int_oldquantity = 0;
    }
  }
  $int_amountdiff = $int_oldquantity - $int_newquantity;

  //if ($int_amountdiff > 0) {
  //	$str_order = "DESC";
  //} else {
  //	$str_order = "ASC";
  //}

  // check if there is a blockorder with the article in it.
  $result_blockprod = $db_iwex->query("SELECT orders.orderID, OrderDetailsID, Quantity, to_deliver, Locked_yn, Complete_yn
										 FROM order_details
										 LEFT JOIN orders ON order_details.OrderID = orders.OrderID
										 WHERE blockorder = 1
										 AND orders.ContactID = '$int_contactID'
										 AND ProductID = '$int_productID'
										 AND NOT Complete_yn
										 ORDER BY orders.OrderDate ASC ");

  while ($obj_blockprod = mysql_fetch_object($result_blockprod))
  {
  // When the confirm is set from confirm to not confirmed.
    if ($bl_confirmed_old > $bl_comfirmed)
    {
    // Calculating the returning stock
      $int_newblockqty = $obj_blockprod->to_deliver + $int_oldquantity;
      // If the newstock is highter then the blockstock.
      if ($int_newblockqty > $obj_blockprod->Quantity)
      {
      // Set the rest.
        $int_newquantity = $int_newblockqty - $obj_blockprod->Quantity;
        //  Set the max returning stock.
        $int_newblockqty = $obj_blockprod->Quantity;
      }
    } else
    {
    // Calculting free_result($results)the new blockstock
      $int_newblockqty = $obj_blockprod->to_deliver + $int_amountdiff;

      if ($int_newblockqty > $obj_blockprod->Quantity)
      {
        $int_amountdiff = $int_newblockqty - $obj_blockprod->Quantity;
        $int_newblockqty = $obj_blockprod->Quantity;
      } else if ($int_newblockqty < 0)
        {
          $int_amountdiff = $int_newblockqty;
          $int_newblockqty = 0;
        } else
        {
          $int_newblockqty = $obj_blockprod->to_deliver + $int_amountdiff;
          $int_amountdiff = 0;
        }
    }

    // If there is a difference update the blockorder!
    if ($int_newblockqty != $obj_blockprod->to_deliver)
    {
      $db_iwex->query("UPDATE order_details
							 SET to_deliver = '$int_newblockqty'
							 WHERE OrderDetailsID ='$obj_blockprod->OrderDetailsID' ");

      $bl_completed = 1;
      $bl_locked = 0;
      // Blockorder empty. Set Completed or uncompleted.
      $result_blockorder = $db_iwex->query("SELECT to_deliver, Quantity
												  FROM order_details
												  WHERE OrderDetailsID ='$obj_blockprod->OrderDetailsID' ");
      while ($obj_blockorder = mysql_fetch_object($result_blockorder))
      {
        if ($obj_blockorder->to_deliver > 0)
        {
          $bl_completed = 0;
        }
        if ($obj_blockorder->to_deliver < $obj_blockorder->Quantity)
        {
          $bl_locked = 1;
        }
      }
      $db_iwex->free_result($result_blockorder);

      //echo $bl_locked . " - " . $obj_blockorder->Locked_yn . "<BR>";
      // update blockorder if needed!
      if ($bl_completed != $obj_blockprod->Complete_yn
          ||
          $bl_locked != $obj_blockprod->Locked_yn)
      {
        $db_iwex->query("UPDATE orders
								 SET Complete_yn = '$bl_completed',
									 Locked_yn = '$bl_locked'
								 WHERE orderID = '$obj_blockprod->orderID' ");
      }
    }
  }
  $db_iwex->free_result($result_blockprod);
}

/*
 * Function     :  GetLogisticsEmail
 * Wil get the correct e-mail adress of the logistics department.
 * input        :  $int_customer_id, The ID of the customer
 * Returns      :  The e-mail adres of the logistics department.
 */
function GetLogisticsEmail($int_customer_id)
{
  global $db_iwex;
  $str_email = FALSE;

  $qry = $db_iwex->query("SELECT contacts.email, Personen.email AS pemail
							FROM contacts 
							LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID 
								AND (Personen.Personen_type_ID = ".DB_PERSONE_TYPE_LOGISTICS."
									 OR Personen.Personen_type_ID = ".DB_PERSONE_TYPE_PURCHASE."
									 OR Personen.Personen_type_ID = ".DB_PERSONE_TYPE_DEFAULT.")
							WHERE contacts.ContactID = '$int_customer_id' 
							ORDER BY Personen_type_ID = ".DB_PERSONE_TYPE_LOGISTICS." DESC, 
									 Personen_type_ID = ".DB_PERSONE_TYPE_PURCHASE." DESC, 
									 Personen_type_ID = ".DB_PERSONE_TYPE_DEFAULT." DESC
									 ");
  if ($obj = mysql_fetch_object($qry))
  {
    $str_email = $obj->pemail ? $obj->pemail : $obj->email;
    mysql_free_result($qry);
  }
  return $str_email;
}

/**
 * Function     : UpdateBox
 * Update the box information
 * Input        : box_id, the id of box.
 *				  tracking, the tracking number of this box.
 *				  weight, the weight of this box.
 * Returns		: TRUE when succesfull
 **/
function UpdateBox($int_box_id,
    $str_tracking,
    $flt_weight)
{
  global $db_iwex;

  $db_iwex->query("UPDATE box
					 SET tracking  = '$str_tracking',
						 weight_kg = '$flt_weight'
					 WHERE box_ID = '$int_box_id'");
  return TRUE;
}

/*
 * Function     : GetPaymentTermID
 * Will return the paymentTerm condition.
 * Input        : int_customerID: The id of the customer.
 * Returns      : The payment id. NULL otherwise.
 */
Function GetPaymentTermID($int_customerID, $str_paymentterm="")
{
  $int_paymentterm = NULL;

  $sql_getpayment = "SELECT PaymentTermID, Description FROM contacts
			INNER JOIN paymentterm ON Paymentterm = PaymentTermID 
			WHERE ContactID = $int_customerID";
  $qry_paymentterm = mysql_query($sql_getpayment)
      or die("Ongeldig GetPaymentTermID query:");
  $obj = mysql_fetch_object($qry_paymentterm);

  $str_paymentterm = $obj->Description;

  $int_paymentterm = $obj->PaymentTermID;

  mysql_free_result($qry_paymentterm);

  return $int_paymentterm;
}

/*
 * Function     : create_contact
 * Will create a new contact, and return the ID.
 * Input        : Name
 * Returns      : ContactID integer
 */
Function create_contact($str_name = "new", 
    $str_country = "NL")
{
  global $DB_iwex;

  $DB_iwex->query("INSERT INTO contacts SET CompanyName = '$str_name', Country ='$str_country'");

  return $DB_iwex->lastinserted();

}

/**
 * Function     : ShowExpectedInfo
 *  when the mouse is over the field some Shows information about the expected quantities.
 * Input        : int_productID, The ID of the product
 *		  int_max quantity maximum
 * Returns      : text
 **/
Function ShowExpectedInfo($int_product_id,
    $int_max)
{
  $returnvar = '';
  if($int_product_id)
  {
    global $db_iwex;
    $sql = "SELECT to_deliver,
											last_exp	
										FROM po_details
										WHERE to_deliver
										  AND productID = '$int_product_id'
										ORDER BY last_exp ASC";
    $qry_result = $db_iwex->query($sql);
    $returnvar = "<table width=\'610\' border=\'0\'><tr><td width=\'40\'>#</td><td width=\'300\'>Date</td></tr>";
    while ($obj = mysql_fetch_object($qry_result))
    {
      $returnvar .= "<tr><td valign=\'top\'>$obj->to_deliver</td><td valign=\'top\'>$obj->last_exp</td></tr>";
    }
    $returnvar .= "<table>";
    mysql_free_result($qry_result);

  }
  return ShowOnMouseOverText("$returnvar");

}


/**
 * Function     : getlanguage
 * get language text for languageID
 * Input        : int_languageID, The ID of the language
 * Returns      : text
 **/
Function getlanguage($int_language_id)
{
  if($int_language_id)
  {
    return GetField("SELECT language FROM languages
						 WHERE languageID = '$int_language_id'");
  } else
  {
    return FALSE;
  }
}

/**
 * Function     : getcontactlanguage
 * get language text for contactID
 * Input        : int_contactID, The ID of the contact
 * Returns      : text
 **/
Function getcontactlanguage($int_contact_id)
{
  if($int_contact_id)
  {
    $int_lang = GetField("SELECT languageID FROM contacts WHERE contactID = '$int_contact_id'");
    return getlanguage($int_lang);
  } else
  {
    return FALSE;
  }
}
?>