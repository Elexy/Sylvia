<?php
// DB id fields defines.



 /*
 * Function     : ShowCallDetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the call information.
 */
function ShowCallDetails($bl_submit, $int_customerID) {

	$str_where_invoices = isset($_GET["where_invoices"]) ? $_GET["where_invoices"] : FALSE;

    $str_return = '';
    $DB_iwex = new DB();
    $sql_calls = "SELECT CallID, CallDate, CallTime, Subject, Notes, employees.FirstName 
                  FROM calls 
                  LEFT JOIN employees ON calls.employee = employees.EmployeeID 
                  WHERE ContactID = '$int_customerID'
                  ORDER BY CallID DESC";
    
    if ($bl_submit 
        && $int_customerID) {
        
		if ($_POST["call_SubjectNew"]) { 
            //When new records have been added, insert these first
            $sql_insert = "INSERT INTO calls SET 
                           ContactID = $int_customerID, 
                           employee = '".$_POST["call_employeeNew"]."', 
                           CallDate = '".$_POST["call_dateNew"]."',
                           Subject = '".$_POST["call_SubjectNew"]."',
                           Notes = '".$_POST["call_notesNew"]."' ";
            $DB_iwex->query($sql_insert);

			if (isset($_POST["int_type_id"])) {
				$int_last_call = $DB_iwex->lastinserted();
				for ($i = 0 ; $i < count($_POST["invoiceid"]) ; $i++) {
					$DB_iwex->query("INSERT INTO invoices_call(invoiceID, callID, typeID, DispuutID) 
									VALUES('" . $_POST["invoiceid"][$i] . "', '$int_last_call','" . $_POST["int_type_id"] . "','" . $_POST["dispuut"] . "' )");
					$DB_iwex->query("UPDATE invoices SET DispuutID ='" . $_POST["dispuut"] . "' WHERE invoiceID = '" . $_POST["invoiceid"][$i] . "'");
				}
			
				// if there is a new dispuut send mailing
				if ($_POST["dispuut"] == DB_INVOICE_OVERDUE_NEW_DISPUUT) {
					$ary_mailtxt = Gettexten("14", 1);
					$str_mailtxt = $ary_mailtxt[1];
					
					$str_fromname = $GLOBALS["ary_config"]["emailname.admin"];
					$str_mail_from = $GLOBALS["ary_config"]["email.admin"];
					$str_subject = $ary_mailtxt[2];
					$str_mailtxt = $_POST["call_notesNew"] . "<BR><BR>" . $str_mailtxt;
	    			$str_mailtxthtml = "<html><body>\n" . $str_mailtxt . "<br></body></html>";
					$str_email_to = $GLOBALS["ary_config"]["dispuut.email"];
		
				// The file will be send with mail to the invoice mail!
					$SMTPMail = new phpmailer();
					$SMTPMail->From     = $str_mail_from;
					$SMTPMail->FromName = $str_fromname;
					if (EXTERNAL_SMTP_SERVER) {
						$SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
						$SMTPMail->Mailer   = "smtp";
					} else { // Use normail PHP mail().
						$SMTPMail->Mailer   = "mail";
					}
					$SMTPMail->Subject  = $str_subject;
					$SMTPMail->Body     = $str_mailtxthtml;
					$SMTPMail->AltBody  = strip_tags($str_mailtxt);
					$SMTPMail->AddAddress($str_email_to);
					$SMTPMail->AddCC($str_mail_from);
					
					$returnvar .= "<table bgcolor='#7FFF00' cellspacing='0' width='100%'><tr><td align='center'>";
					if ($SMTPMail->Send()){
						$returnvar .= "Er is een nieuwe dispuut aanmelding opgestuurd naar: $str_email_to";
					} else {
						$returnvar .= "Het opsturen van de dispuut aanmelding is mislukt: $str_email_to";
					}
					$returnvar .= "</td></tr></table>";
				}
			}
		}		
	} // End update
	if (isset($_GET["int_overdue_type"])) {
		$sql_invoices = $DB_iwex->query(SQL_INVOICES_PAYMENT ." WHERE CustomerID = '" . $_GET["custid"] . "' 
																AND NOT paid_yn " . $str_where_invoices . " ORDER BY InvoiceID ");
		if (isset($_GET["needed_type"])) {
			$returnvar .= "<INPUT TYPE='hidden' NAME='int_type_id' VALUE='" . $_GET["needed_type"] . "'>";
		} else {
			$returnvar .= "<INPUT TYPE='hidden' NAME='int_type_id' VALUE='" . $_GET["int_overdue_type"] . "'>";
		}
		$str_invoiceid = "";
		while ($obj_invoices = $DB_iwex->fetch_object($sql_invoices)) {
			$returnvar .= "<INPUT TYPE='hidden' NAME='invoiceid[]' VALUE='" . $obj_invoices->InvoiceID . "'>";
		}
	}
	
	$call_SubjectNew = isset($_GET["call_SubjectNew"]) ? $_GET["call_SubjectNew"] : FALSE;

	// Get the data.
    $qry_select = $DB_iwex->query($sql_calls);
    if(isset($_GET["sendmail"])) {
		$str_return .= "<INPUT TYPE='hidden' NAME='sendmail' VALUE='" . $_GET["sendmail"] . "'>";
	}
	$str_return .= "<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" class=\"blockbody\">\n";
	$str_return .= "<tr><th>Datum</th><th>Door</th><th>Dispuut</th><th>Onderwerp</th><th>Notes</th></tr>\n";

	// always display a new empty detail record at the bottom
	$str_return .= "<tr>\n";
	$str_return .= "<tr>\n";
	$str_return .= "<td><input size=\"14\" name=\"call_dateNew\" type=\"text\" value=\"".date("Y-m-d H:i")."\"></td>\n";
	$str_return .= '<td>'.makelistbox("SELECT EmployeeID, FirstName FROM employees order by FirstName","call_employeeNew","EmployeeID","FirstName",$GLOBALS["employee_id"]).'</td>'."\n";    
	
	if (isset($_GET["str_dispuut_id"])) {
		 $str_return .= '<td>'. makelistbox("SELECT value, text FROM listbox WHERE category = 14 ORDER BY value", "dispuut", "value", "text", $_GET["str_dispuut_id"]) .'</td>'."\n";   
	} else {
		$str_return.= "<td><input type='hidden' name='dispuut' value='0'>-</td>";
	}
	$str_return .= "<td><input size=\"20\" name=\"call_SubjectNew\" type=\"text\" value=\"$call_SubjectNew\"></td>\n";
	$str_return .= "<td><textarea name=\"call_notesNew\" cols=\"50\" rows=\"2\"></textarea></td>\n";
	$str_return .= "</tr>\n";

	while ($obj = mysql_fetch_object($qry_select)) {

		$qry_dispuut = $DB_iwex->query("SELECT text FROM invoices_call
										LEFT JOIN invoices ON invoices.InvoiceID = invoices_call.invoiceID
										LEFT JOIN listbox ON invoices_call.dispuutID = value
										WHERE callID ='" . $obj->CallID . "' and category = 14 ");
							
		$obj_dispuut_status = mysql_fetch_object($qry_dispuut);
		$str_dispuut_text = isset($obj_dispuut_status->text) ? $obj_dispuut_status->text : FALSE;
		$str_dispuut_id = isset($_GET["str_dispuut_id"]) ? $_GET["str_dispuut_id"] : FALSE;
	    $str_return .= "<tr>\n";
	    $str_return .= "<td>".date("Y-m-d H:i", strtotime($obj->CallDate))."</td>\n";
	    $str_return .= "<td>$obj->FirstName</td>\n";
		$str_return .= '<td>' . $str_dispuut_text . '</td>'."\n";		
	    $str_return .= "<td>$obj->Subject</td>\n";
	    $text = strpos($obj->Notes, "<HTML>") ? $obj->Notes : str_replace("\n", "<br>", $obj->Notes);
	    $str_return .= "<td>$text</td>\n";
	    $str_return .= "</tr>\n";
			
		$DB_iwex->free_result($qry_dispuut);
	}

    mysql_free_result($qry_select);
    
    $str_return .= "</TABLE>\n";
    
    return $str_return;
}

/*
 * Function     : ShowConsignmentDetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the Consignment information.
 */
function ShowConsignmentDetails($int_customerID) {

	$str_return = '';
    $DB_iwex = new DB();
    $sql_consignment = "SELECT  inventory_transactions.ProductID, 
								current_product_list.externalID, 
								ProductName, 
								sum(UnitsSold) as shipped,
								orders.ContactID
					FROM inventory_transactions
					INNER JOIN orders on orders.OrderID = inventory_transactions.OrderID
					INNER JOIN current_product_list on current_product_list.ProductID = inventory_transactions.ProductID 
					WHERE consignment_order AND orders.ContactID='$int_customerID'
					GROUP BY inventory_transactions.ProductID
					ORDER BY inventory_transactions.ProductID";
    
	$qry_consigment = $DB_iwex->query($sql_consignment);
	
	if ($int_customerID) {	
		$str_return .= "<TABLE>\n";
		$str_return .= "<TR>\n";
		$str_return .= "<TH>ProductID</TH>";
		$str_return .= "<TH>externalID</TH>";
		$str_return .= "<TH>ProductName</TH>";
		$str_return .= "<TH>shipped</TH>";
		$str_return .= "<TH>Invoiced</TH>";
		$str_return .= "<TH>customer stock</TH>";
		$str_return .= "</TR>\n";
		while ($obj_consignment = mysql_fetch_object($qry_consigment)) {
			$sold = GetConsignmentSold($obj_consignment->ContactID, $obj_consignment->ProductID);
			$stock = $obj_consignment->shipped - $sold;
			$str_return .= "<TR  CLASS='blockbody'>\n";
			$str_return .= "<TD>$obj_consignment->ProductID</TD>";
			$str_return .= "<TD>$obj_consignment->externalID</TD>";
			$str_return .= "<TD>$obj_consignment->ProductName</TD>";
			$str_return .= "<TD>$obj_consignment->shipped</TD>";
			$str_return .= "<TD>$sold</TD>";
			$str_return .= "<TD><B>$stock</B></TD>";
			$str_return .= "</TR>\n";
		}
		$str_return .= "</TABLE>\n";
	}
	
	return $str_return;
}

/*
 * Function     : GetConsignmentSold
 * Input        :      int_contactID, The id of the customer
 *			int_productID: id the of the  product
 * Returns      : A complete formatted string that contains the Consignment information.
 */
function GetConsignmentSold($int_customerID, $int_productID) {
	$str_return = '';
	if ($int_customerID 
		&& 
		$int_productID) {
		$sql = "SELECT sum(order_details.Quantity)
						FROM order_details  
						INNER JOIN orders ON orders.OrderID = order_details.OrderID   
						INNER JOIN current_product_list on current_product_list.ProductID = order_details.ProductID 
						WHERE orders.administration_order
					        AND orders.ContactsOrderID LIKE 'consignatieverko%'
							AND orders.ContactID='$int_customerID'
							AND order_details.ProductID = '$int_productID' 
						GROUP BY order_details.ProductID;";
		$str_return = GetField($sql);
    }
	return $str_return;
}


/*
 * Function     : branches
 * Input        :      int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the branche information.
 */

function branches($int_contact_id,
				   $formname)
{
    $action = isset($_POST['action']) ? $_POST['action'] : FALSE;
	$int_branche_id = isset($_POST['CompanyID']) ? $_POST['CompanyID'] : FALSE;
	
	$str_start_date = GetSetFormVar("startdate", TRUE, date("Y-m-d"));
	$str_end_date = GetSetFormVar("enddate", TRUE, date("Y-m-d"));

	
	$returnvar = '';
	
	if($int_contact_id)
	{
	    $returnvar = "<TABLE BORDER='0' CELLSPACING='3' CELLPADDING='5' WIDTH='100%' CLASS='back'>
	        <TR>
	            <TD CLASS=featureblock VALIGN=top WIDTH=150 ROWSPAN=2>
	              <TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%'>
	                <TR>
	                    <TD WIDTH='100%' colspan='3'>
	                        <TABLE CELLPADDING='3' BORDER='1' CELLSPACING='0' WIDTH='100%'>
	                            <TR>
	                                <TD WIDTH='100%' CLASS='blockbody'><BR>";
                                
		$returnvar .= "&#149;<a onclick='document.$formname.action.value=\"list_turnover\";document.$formname.submit();'>Omzet</a><BR><BR>";
		$returnvar .= "&#149;<a onclick='document.$formname.action.value=\"list_orders\";document.$formname.submit();'>Order aantal</a><BR><BR>";
		$returnvar .= "&#149;<a onclick='document.$formname.action.value=\"open_orders\";document.$formname.submit();'>Open orders</a><BR><BR>";
		$returnvar .= "&#149;<a onclick='document.$formname.action.value=\"allorders\";document.$formname.submit();'>Alle orders</a><BR><BR>";
		$returnvar .= "&#149;<a onclick='document.$formname.action.value=\"sellthrough\";document.$formname.submit();'>Doorverkoop</a><BR><BR>";
		$returnvar .= "<small>weeknr. : " . date('W') . "<BR>";
		$returnvar .= "datum : " . date('j-M-Y') . "</small><BR>";
                                
        $returnvar .= "                </TABLE>
                    </TD>
                </TR>
              </TABLE>
                <TR>
                  <TD VALIGN=top CELLPADDING='0' CELLSPACING='0'>";
        
		$returnvar .= " van <input type=text size=10 name=startdate value=$str_start_date>" . Add_Calendar("$formname.startdate");
		$returnvar .= " tot <input type=text size=10 name=enddate value=$str_end_date>" . Add_Calendar("$formname.enddate");
		$returnvar .= " Filter op Branche " . makelistbox("select CompanyName, ContactID
										                      FROM contacts 
										                      WHERE (contacts.ContactID = ". implode(" OR contacts.ContactID = ", GetBranches($int_contact_id, TRUE)).")
										                      ORDER BY CompanyName",
										                    'CompanyID',
										                    'ContactID',
										                    'CompanyName',
										                    $int_branche_id,
										                    $formname,
										                    TRUE);
		
      $returnvar .= "<INPUT TYPE='hidden' NAME='action' value='$action'>";
      //construct orderdate restrictions
      $str_orderdate_condition = " AND (
                                   orders.OrderDate >= '$str_start_date 00:00' AND
                                   orders.OrderDate <= '$str_end_date 23:59')";
                                   
      $str_invoicedate_condition = " AND (
                                   invoices.Invoice_date >= '$str_start_date 00:00' AND
                                   invoices.Invoice_date <= '$str_end_date 23:59')";

      $returnvar .= 
        "<table border=0>\n
          <tr>\n
            <td bgcolor=".QOUTE_BGCOLOR.">Onbevestigd</td>\n
            <td bgcolor=".OPENORDER_BGCOLOR.">Bevestigd</td>\n
            <td bgcolor=".PARTSHIP_BGCOLOR.">Deellevering</td>\n
            <td bgcolor=".COMPLETE_BGCOLOR.">Compleet</td>\n        
            <td class=\"rma_ordertext\">RMA order</td>\n			  
          </tr>\n
        </table>\n";
      
        if ($int_branche_id) {
          $sql_select_branch_ids = " contacts.ContactID = '$int_branche_id'";
        } else {
          $sql_select_branch_ids = " (contacts.ContactID = "
            . implode(" OR contacts.ContactID = ",
                         GetBranches($int_contact_id, 
                               TRUE)).")";
        }
      
      if ($action == "list_orders"
          ||
          $action == '')
      { //List number of orders
        $branches = "SELECT DISTINCT
                    contacts.ContactID as id, 
                    contacts.CompanyName as 'Name',                
                    COUNT(orders.orderID) as '# orders'                
                    FROM contacts                
                    LEFT JOIN orders on orders.ContactID = contacts.ContactID $str_orderdate_condition
                    WHERE $sql_select_branch_ids
                    GROUP BY contacts.ContactID
                    ORDER BY '# orders' DESC;";
        $returnvar .= show_table($branches,TRUE);
      } elseif ($action == "list_turnover")
      { //List turnover
        $branches = "SELECT DISTINCT
                    contacts.ContactID as id, 
                    contacts.CompanyName as 'Name',                
                    SUM(Invoice_total) as 'turnover ex.' 
                    FROM contacts 
                    LEFT JOIN invoices on invoices.CustomerID = contacts.ContactID $str_invoicedate_condition
                    WHERE $sql_select_branch_ids
                    GROUP BY contacts.ContactID
                    ORDER BY 'turnover ex.' DESC;";
        $returnvar .= show_table($branches,TRUE);
      } elseif ($action == "openorders")
        { //List openorders
        $openorders = "SELECT 
                    orders.ContactID as id, 
                    contacts.CompanyName as 'Branche',
                    DATE_FORMAT(orders.OrderDate,'%d-%m-%Y') as 'Order Date',
                    orders.orderID as 'orderID'                
                    FROM orders
                    INNER JOIN contacts ON orders.ContactID = contacts.ContactID
                    WHERE $sql_select_branch_ids $str_orderdate_condition AND NOT orders.Complete_yn
                    GROUP BY orders.OrderID;";
        $returnvar .= $order_color_table;
        $returnvar .= show_table($openorders,TRUE);
      } elseif ($action == "allorders")
      { //List all orders
        $allorders = "SELECT 
                    orders.ContactID as id, 
                    contacts.CompanyName as 'Branche',
                    DATE_FORMAT(orders.OrderDate,'%d-%m-%Y') as 'Order Date',
                    orders.orderID as 'orderID'                
                    FROM orders
                    INNER JOIN contacts ON orders.ContactID = contacts.ContactID
                    WHERE $sql_select_branch_ids $str_orderdate_condition                
                    GROUP BY orders.OrderID
                    ORDER BY orders.ContactID, orders.OrderDate DESC;";
        $returnvar .= $order_color_table;
        $returnvar .= show_table($allorders,TRUE);
      } elseif ($action == "sellthrough")
      { //List sellthough of different products
	    $int_company_id = isset($int_branche_id) ? $int_branche_id : $int_contact_id;
        $returnvar .= ShowSellThrough($formname,
									  FALSE,
									  FALSE,
						              $int_company_id,
						              NULL,
						              NULL,
									  NULL,
						              $str_start_date,
						              $str_end_date);
      }

    
    $returnvar .= "      </TD>
                </TR>
              </table>
        </form>";        
	}
	return $returnvar;
}



?>