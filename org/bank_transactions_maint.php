<?
/*
 * bank_transactions_maint.php
 *
 * @version $Id: bank_transactions_maint.php,v 1.47 2007-06-07 06:54:22 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

$int_trans_id = isset($_POST["transactionid"]) ? $_POST["transactionid"] : FALSE;
$int_startrec = isset($_POST["startrec"]) ? $_POST["startrec"] : 0;
$int_account_id = isset($_POST["accountid"]) ? $_POST["accountid"] : FALSE;
$int_customer_id = isset($_REQUEST["ContactID"]) ? $_REQUEST["ContactID"] : FALSE;
$int_account_num = isset($_POST["account_num"]) ? $_POST["account_num"] : FALSE;

$str_trans_date = isset($_POST["trans_date"]) ? $_POST["trans_date"] : "";
$str_name = isset($_POST["name"]) ? $_POST["name"] : "";
$str_amount = isset($_POST["amount"]) ? $_POST["amount"] : "";
$str_description = isset($_POST["description"]) ? $_POST["description"] : "";

//$int_cust_id = isset($_GET["custid"]) && !$int_cust_id ? $_GET["custid"] : $int_cust_id;
$bl_update = isset($_POST["Update"]);
$bl_override = GetCheckbox('override');
$bl_toboek = isset($_POST["select_toboek"]) ? $_POST["select_toboek"] : '';

$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " rekeningen beheer");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" enctype=\"multipart/form-data\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"accountform\">\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();

$sql_select_transactions = "SELECT bank_transactions.*, bank_accounts.account_name, sum(link_amount) AS sum_amount
                            FROM bank_transactions
                            LEFT JOIN bank_accounts ON bank_account_id = account_id
                            LEFT JOIN payments_link ON payments_link.BankTransactionId = bank_transactions.transaction_id";

    if (isset($_POST['next'])
        ||
        isset($_POST['priv'])) {
        if (isset($_POST['next'])) {
           $int_startrec += LIMITSIZE;
        } else if (isset($_POST['priv'])) {
           $int_startrec -= LIMITSIZE;
        }
    }
    //echo "s:$int_startrec, n:$next, p:$priv";

   	// Create a query to select the shipments for this date.
    $sqlwhere =queryparm('bank_account_id', $int_account_id, "", 0);
    //$str_trans_date = $str_trans_date != "" ? "'$str_trans_date'" : $str_trans_date;
    $sqlwhere.=queryparm('transaction_date', $str_trans_date, $sqlwhere, 0);
    $sqlwhere.=queryparm('name',$str_name, $sqlwhere);
    $sqlwhere.=queryparm('amount',$str_amount, $sqlwhere);
    $sqlwhere.=queryparm('CustomerID',$int_customer_id, $sqlwhere, 0);
    $sqlwhere.=queryparm('other_account_number', $int_account_num, $sqlwhere);
    $sqlwhere.=queryparm('description', $str_description, $sqlwhere);
    $sqlwhere .= ' GROUP BY transaction_id';
    if ($bl_toboek != '') {
		$sqlwhere .= ' HAVING ';
		if ($bl_toboek) $sqlwhere .= 'NOT ';
	    $sqlwhere .= '(bank_transactions.amount <= (sum_amount + '. DB_INVOICE_MARGIN
                    .') AND bank_transactions.amount >= (sum_amount - '. DB_INVOICE_MARGIN. '))';
		if ($bl_toboek) $sqlwhere .=' OR ISNULL(sum_amount)';
	}
    $sql_select_transactions .= $sqlwhere . ' ORDER BY transaction_date DESC, name';
    
    $query = $DB_iwex->query($sql_select_transactions);

    $numberofrecords = mysql_Numrows($query);
    mysql_free_result($query);	
    
    $sql_select_transactions .= ' LIMIT ' . $int_startrec . ',' . LIMITSIZE;
    
    $query = $DB_iwex->query($sql_select_transactions);

    if ($bl_update) {
        // Check of data needs to be inserted.
        while ($objshipment = mysql_fetch_object($query)) {
            $int_contactID = FALSE;
            if (isset($_POST["ContactID$objshipment->transaction_id"])) {
                $int_contactID = $objshipment->other_account_number ? GetContactId_account($objshipment->other_account_number) : 0;
                $int_contactID = $_POST["ContactID$objshipment->transaction_id"] 
                                 ? $_POST["ContactID$objshipment->transaction_id"] 
                                 : $int_contactID ;
                
                $sql_data_change = "bank_transactions SET 
                                    CustomerID = '".$int_contactID."'";
                if ($bl_override && isset($_POST["amount$objshipment->transaction_id"])) {
                    $sql_data_change .= ", bank_account_id = '".$_POST['accountid'.$objshipment->transaction_id]
                                       ."', transaction_date = '".$_POST['date'.$objshipment->transaction_id]
                                       ."', amount = '".$_POST["amount$objshipment->transaction_id"]
                                       ."', description = '".$_POST["description$objshipment->transaction_id"]."'";
                }
                $sql_update = "UPDATE ". $sql_data_change. " WHERE transaction_id = $objshipment->transaction_id";
                //echo $sql_update_podetails.'<br>';
                $DB_iwex->query($sql_update);

                // Check if the record should be deleted.
            }

            if (GetCheckBox("addaccount$objshipment->transaction_id")) {
                $int_contactID = $int_contactID ? $int_contactID : $objshipment->CustomerID;
                $DB_iwex->query("INSERT INTO contacts_bank_accounts 
                                 SET account_number = '$objshipment->other_account_number',
                                     ContactID = $int_contactID");
            }

			if ($bl_override 
				&&
				GetCheckBox('delete'.$objshipment->transaction_id)) {
				$sql_delete = 'DELETE FROM bank_transactions WHERE transaction_id = '.$objshipment->transaction_id;
				$DB_iwex->query($sql_delete);
			}
        }
        mysql_free_result($query);

        if (isset($_POST["dateNew"]) && $_POST["dateNew"] != ""
            &&
            isset($_POST["amountNew"]) && $_POST["amountNew"] != "") {
            $int_contactID = GetContactId_account($_POST["acountNew"]);
            $int_contactID = $int_contactID ? $int_contactID : $_POST["ContactIDNew"];
            
            $insertqry = "INSERT INTO bank_transactions SET 
                bank_account_id = '".$_POST["accountidNew"]."', 
                transaction_date = '".$_POST["dateNew"]."', 
                name = '".$_POST["nameNew"]."', 
                amount = '".$_POST["amountNew"]."', 
                description = '".$_POST["DescriptionNew"]."', 
                other_account_number = '".$_POST["acountNew"]."',
                CustomerID = '".$int_contactID."'";
               $querynew =  $DB_iwex->query($insertqry);
        }
        
        if (!$_FILES['userfile']['error']) {
		
			// Get filetype from the file.
			$filetype = explode(".", $_FILES['userfile']['name']);
	
			if ($filetype[1] == "csv") {

				// Dump the file into a variable
				$handle = fopen ($_FILES['userfile']['tmp_name'], "r");
				$contents = fread ($handle, filesize ($_FILES['userfile']['tmp_name']));
				fclose($handle);
				
				// Get the data in a array.
				$array_file = CSVsplit($contents);
				$int_count = count($array_file);
    
				// Is it an ING Bank file?
				if (str_replace(".",
								"",
								$array_file[0]) == BANK) {

					// ING Bank file    
					$int_field_on_row = 6;
					//var_dump($array_file);
					echo "ING bank import\n";
					
					for ($i = 0; $i < $int_count/$int_field_on_row; $i++) {
						// When money is added tot the account insert it.
						if 	($array_file[$i*$int_field_on_row+2] == "Bij"
							&&
							!strncmp(str_replace(".",
												 "",
												 $array_file[$i*$int_field_on_row+0]),
									 BANK,
									 strlen(BANK_ACCOUNT_ID))
							) {
							$flt_amount = str_replace(",", ".", str_replace(".", "", $array_file[$i*$int_field_on_row+3]));
							$insertqry = "INSERT INTO bank_transactions SET 
							bank_account_id = '" . BANK_ACCOUNT_ID . "', 
							transaction_date = '".preg_replace("/(\d+)-(\d+)-(\d+)/i", "$3-$2-$1", $array_file[$i*$int_field_on_row+1])."', 
														name = '', 
														amount = '$flt_amount', 
														description = '".addslashes($array_file[$i*$int_field_on_row+5])."', 
														other_account_number = '".str_replace(".",
														"",	$array_file[$i*$int_field_on_row+4])."'";
							$querynew =  $DB_iwex->query($insertqry,
														 FALSE);
						}
					}            
				} else {

					// Postbank file    
					$int_field_on_row = 12;
					
					/*echo "Postbank<pre>";
					var_dump($array_file);
					echo "</pre>";*/
					for ($i = 0; $i < $int_count/$int_field_on_row; $i++) {
	
						// When money is added tot the account insert it.
						if ($array_file[$i*$int_field_on_row+8] == 'B'
							 &&
							 ($array_file[$i*$int_field_on_row+0] == GIRO  
							  ||
							  $array_file[$i*$int_field_on_row+0] == substr (GIRO, 1))) { // There is a bug in the CSVsplit function. Missed the first caracter on a new line.
							
							$insertqry = "INSERT INTO bank_transactions SET	
													bank_account_id = '".GIRO_ACCOUNT_ID."', 
													transaction_date = '".$array_file[$i*$int_field_on_row+1]."', 
													name = '".$array_file[$i*$int_field_on_row+5]."', 
													amount = '".$array_file[$i*$int_field_on_row+7]."', 
													description = '".addslashes($array_file[$i*$int_field_on_row+10])."', 
													other_account_number = '".$array_file[$i*$int_field_on_row+4]."'";
	
							$querynew =  $DB_iwex->query($insertqry);
						}
					}
				}
			} else {

				// Set the uploaded file into the array ar_file. Each element of the array corresponds to a line in the file.  
				$ar_file = file($_FILES['userfile']['tmp_name']);
	
				// This function set de transaction infomration into an array.
				$ary_transactions = swiftmt940split($ar_file);
	
				//Set the information of the transactions into the database
				for ($i = 0 ; $i < count($ary_transactions) ; $i++) {
				
					if ($ary_transactions[$i]["account"] == GIRO) {
						$int_accountid = GIRO_ACCOUNT_ID;
					} else if ($ary_transactions[$i]["account"] == BANK) {
						$int_accountid = BANK_ACCOUNT_ID;
					} else {
						$int_accountid = "";
					}
	
					// If accountnumber exist.. Get customerid else customerid is empty!
					if ($ary_transactions[$i]["accountnumber"]) {
						$customerid = GetContactId_account($ary_transactions[$i]["accountnumber"]);
					} else {
						$customerid = "";
					}
					// ckecking for Debit
					if ($ary_transactions[$i]["credit_debit"] == "C") {
						// Dump the information into the database bank_transactions
						$insertqry = "	INSERT INTO bank_transactions SET 
										bank_account_id = '" . $int_accountid . "',
										transaction_date = '" . $ary_transactions[$i]["date"] . "',
										name = '". preg_replace('/(\w+ \w+)/','${1}', $ary_transactions[$i]["description"])."', 
										amount = '" . $ary_transactions[$i]["price"] . "',
										description = '" . $ary_transactions[$i]["description"] . "', 
										other_account_number = '" . $ary_transactions[$i]["accountnumber"] . "',
										CustomerID = '" . $customerid . "' ";
													
						$querynew =  $DB_iwex->query($insertqry);
					}
				}
			}
        }
        $query = $DB_iwex->query($sql_select_transactions); 
    }    

    //echo $sql_select_transactions;    
    echo "<TABLE WIDTH=\"100%\"BORDER=\"1\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "    <TR>\n";
    echo '         <th colspan="4">Zoektermen</th>',"\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "         <TD>Bank account</TD><TD>".makelistbox("SELECT account_name, account_id FROM bank_accounts", 
                                                          'accountid', 
                                                          'account_id', 
                                                          'account_name', 
                                                          $int_account_id)."</TD>\n";
    echo "         <TD>Datum(Y-m-d)</td><td><INPUT TYPE=\"text\" NAME=\"trans_date\" SIZE=\"20\" CLASS=\"form\" value=". $str_trans_date . ">".Add_Calendar('accountform.trans_date');
    echo "		  </TD>\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "         <TD>Naam</TD><TD><INPUT TYPE=\"text\" NAME=\"name\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_name."\"></TD>\n";
    echo "         <TD>Description</TD><TD><INPUT TYPE=\"text\" NAME=\"description\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_description."\"></TD>\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "         <TD>Company ID/Name</TD><TD><INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_customer_id."\">/";
	echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "accountform.ContactID", "cust");
    echo "		  </TD>\n";
    echo "         <TD>Rekening nummer</TD><TD><INPUT TYPE=\"text\" NAME=\"account_num\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_account_num."\"></TD>\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "         <TD>Nog te boeken: " . makelistbox("SELECT value, text FROM listbox WHERE category = 1", 'select_toboek', 'value', 'text', $bl_toboek)."</TD>\n";
    echo "         <td colspan=3></td>";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo '	<TD>';
    
    $pagetotal = $numberofrecords/LIMITSIZE +1;
    $pagenum =($numberofrecords/LIMITSIZE - $int_startrec/LIMITSIZE) +1;
    echo 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
    echo ' van '. (int)$pagetotal;
    
    if ($numberofrecords > LIMITSIZE) {
        if ($numberofrecords-LIMITSIZE> $int_startrec) {		
            echo '		<INPUT TYPE="submit" NAME="next" value="<" CLASS="button">';
        }
        if ($int_startrec > 0)
            echo '		<INPUT TYPE="submit" NAME="priv" value=">" CLASS="button">';
        echo '		<INPUT TYPE="hidden" NAME="startrec" value="'.$int_startrec.'">';
    }
    echo "    <td>Override".MakeCheckbox('override',$bl_override)."</TD><TD  COLSPAN='2' ALIGN='right'>";
    echo '<input type="hidden" name="MAX_FILE_SIZE" value="1000000">Upload dit bestand: <input name="userfile" type="file">';
    echo "<INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Update\" CLASS=\"button\">\n";
    echo "<INPUT TYPE=\"submit\" NAME=\"Search\" VALUE=\"Zoeken\" CLASS=\"button\">";
    echo "</TD>\n";
    echo "    </TR>\n";
    echo "</TABLE>\n";
       
?>
<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
  <tr>
    <th>Bank account</th>
    <th>Date</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Account Number</th>
    <th>Customer</th>
  </tr>
<?
    $int_accountid_new = isset($_POST["accountidNew"]) ? $_POST["accountidNew"] : BANK_ACCOUNT_ID;
    $str_date = isset($_POST["dateNew"]) && $_POST["dateNew"] != "" ? $_POST["dateNew"] : date("Y-m-d");
    echo "<tr><td>".makelistbox("SELECT account_name, account_id FROM bank_accounts", 
                           'accountidNew', 
                           'account_id', 'account_name', 
                           $int_accountid_new) ."</td>"
        ."<TD><INPUT TYPE=\"text\" NAME=\"dateNew\" SIZE=\"10\" CLASS=\"form\" VALUE=\"$str_date\">".Add_Calendar('accountform.dateNew')."
        <td><INPUT TYPE=\"text\" NAME=\"nameNew\" SIZE=\"10\" CLASS=\"form\"></td>
        <td><INPUT TYPE=\"text\" NAME=\"amountNew\" SIZE=\"6\" CLASS=\"form\"></td>
        <td><INPUT TYPE=\"text\" NAME=\"DescriptionNew\" SIZE=\"10\" CLASS=\"form\"></td>
        <td><INPUT TYPE=\"text\" NAME=\"acountNew\" SIZE=\"10\" CLASS=\"form\"></td>
        <td align=right><INPUT TYPE=\"text\" NAME=\"ContactIDNew\" SIZE=\"4\" CLASS=\"form\">"
        ."<INPUT TYPE=\"text\" NAME=\"customernameNew\" SIZE=\"10\" CLASS=\"form\"\">"
        .GetRecordId(SQL_SEARCH_CUSTOMER_LIST, 
                   "ContactID", 
                   "customernameNew", 
                   "accountform.ContactIDNew", 
                   "cust").'</td>'
        ."\n".'</tr>';

    while ($objshipment = mysql_fetch_object($query)) {
	    if ($objshipment->amount <= $objshipment->sum_amount + DB_INVOICE_MARGIN
            &&
            $objshipment->amount >= $objshipment->sum_amount - DB_INVOICE_MARGIN) { 
            $bgcolor=PAID_BGCOLOR;
        } else { 
            $bgcolor=NOT_PAID_NOT_OVERDUE_BGCOLOR; 
        };
        if ($bl_override && !((float) $objshipment->sum_amount)) {
            echo "<tr bgcolor='$bgcolor'><td>"
                .makelistbox("SELECT account_name, account_id FROM bank_accounts", 
                             'accountid'.$objshipment->transaction_id, 
                             'account_id', 'account_name', 
                             $objshipment->bank_account_id)."</td>"
                ."<td><INPUT TYPE=\"text\" NAME=\"date$objshipment->transaction_id\" SIZE=\"10\" CLASS=\"form\" VALUE=\"$objshipment->transaction_date\">".Add_Calendar("accountform.date$objshipment->transaction_id").'</td>'
                .'<td>'.$objshipment->name.'</td>'
                ."<td align=right><INPUT TYPE=\"text\" align='right' NAME=\"amount$objshipment->transaction_id\" value='$objshipment->amount'></td>"
                ."<td><INPUT TYPE=\"text\" NAME=\"description$objshipment->transaction_id\" value='$objshipment->description'>"
                .' <input type="checkbox" NAME="delete'.$objshipment->transaction_id.'" onClick="return confirm(\'Weet je zeker dat je dit record wilt verwijderen?\')">(del)'
                .'</td>';
        } else {
            echo "<tr bgcolor='$bgcolor'><td>$objshipment->account_name</td>"
                .'<td>'.$objshipment->transaction_date.'</td>'
                .'<td>'.$objshipment->name.'</td>'
                ."<td align=right>$objshipment->amount</td>"
                .'<td>'.$objshipment->description.'</td>';
        }
        echo '<td align=right>';
        if ($objshipment->other_account_number
            &&
            !GetContactId_account($objshipment->other_account_number, TRUE)
            &&
            $objshipment->CustomerID) {
            echo MakeCheckbox("addaccount$objshipment->transaction_id",
                              FALSE,
                              TRUE,
                              "Bewaar rekening nummer voor deze ($objshipment->CustomerID) klant.");
        } 
        echo " $objshipment->other_account_number</td><td align=right>";
        if ($objshipment->CustomerID
            &&
             !($bl_override
               && 
               $objshipment->sum_amount == 0)
            ) {
			echo "(".number_format(($objshipment->amount - $objshipment->sum_amount), 2, ".", "").") ";
            echo "<a href='".CONTACTS."?custid=$objshipment->CustomerID' "
                 .ShowShortContactInfo($objshipment->CustomerID, "LEFT")
                 ."target=_new>$objshipment->CustomerID</a>";
        } else {
            echo "<INPUT TYPE=\"text\" NAME=\"ContactID$objshipment->transaction_id\" SIZE=\"4\" CLASS=\"form\" value=\"".$objshipment->CustomerID."\">"
            ."<INPUT TYPE=\"text\" NAME=\"customername$objshipment->transaction_id\" SIZE=\"10\" CLASS=\"form\"\" VALUE=\"$objshipment->name\"
               onFocus=\"if (accountform.customername$objshipment->transaction_id.value != '') accountform.customername$objshipment->transaction_id.value = ''\">"
            .GetRecordId(SQL_SEARCH_CUSTOMER_LIST, 
                                   "ContactID", 
                                   "customername$objshipment->transaction_id", 
                                   "accountform.ContactID$objshipment->transaction_id", 
                                   "cust");
        }
        echo " <INPUT TYPE=\"button\" NAME=\"checkin\" CLASS=\"form\" VALUE='Boek' 
                onclick=\"window.open('bank_trans_to_invoice.php?custid=$objshipment->CustomerID&transactionid=$objshipment->transaction_id&amount=$objshipment->amount&trans_date=$objshipment->transaction_date&description=".addslashes($objshipment->description)."'";
        echo ",'book_transactions', 'menubar=yes,directories=no,toolbar=yes,resizable=yes,width=700, height=600, scrollbars=yes')\">";
        echo "</td>\n".'</tr>';
        echo "\n";
    }
	mysql_free_result($query); 
	
	echo '</table>';
	  
echo "</FORM>";
printenddoc();

?>
