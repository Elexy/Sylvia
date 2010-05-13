<?php

/**
 * store_serial_number.php
 *
 * @version $Id: store_serial_number.php,v 1.12 2006-08-18 12:01:01 iwan Exp $
 * @copyright $date:
 **/

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';


// Get all the URL variable we need.
$bl_submit = isset($_POST["submit"]);
$bl_correct = GetCheckBox('correct');
$int_transid = isset($_POST["transid"]) ? $_POST["transid"] : FALSE;
$int_transid = !$int_transid && isset($_GET["transid"]) ? $_GET["transid"] : $int_transid;
$bl_close = isset($_GET["close"]) ? $_GET["close"] : TRUE;

/**
 * Function     : SerialNumbers
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_transaction_id, The id of the transaction
 *				  bl_auto_close, when true windows closes when finished.
 * Returns      : A complete formatted string that contains the call information.
 **/
function SerialNumbers($bl_update, 
                       $int_transaction_id,
					   $bl_auto_close,
                       $bl_override) {
    $str_return = '';
    $DB_iwex = new DB();
    // When the transaction id in negative use the temp. inventory table.
    if ($int_transaction_id > 0) {
        $int_total_pr = abs(GetField("SELECT UnitsSold 
                                      FROM inventory_transactions
                                      WHERE TransactionID = '$int_transaction_id'"));
    } else {
        $int_total_pr = abs(GetField("SELECT UnitsSold 
                                      FROM temp_inv_transactions
                                      WHERE TransactionID = '".($int_transaction_id*-1)."'"));
    }
    //$int_product_id = GetField('SELECT ProductID WHERE TransactionID = '.$int_transaction_id);
    
    $sql_calls = "SELECT Serial, SerialRecordID 
                  FROM Serialnumbers
                  WHERE Inventory_transactionID = '$int_transaction_id'
                  ORDER BY SerialRecordID DESC";
    $int_number = isset($_POST["number"]) ? $_POST["number"] : FALSE;
    $int_number_last = isset($_POST["number_last"]) ? $_POST["number_last"] : FALSE;
    $int_diff_numbers = 0;
    $int_product_id = GetField("SELECT ProductID
                                FROM current_product_list
                                WHERE ProductID = '$int_number' 
                                OR EAN = '$int_number'");
    if ($int_product_id) {
        echo "<h2>Serie nummer $int_number niet juist, EAN of product ID</h2>".MakeBeep(FALSE);
        $int_number = 0;
    } 
    if ($int_transaction_id 
        &&
        $int_number) { 
        // Test if there must be a range filled in.
        if ($int_number_last) {
            $int_diff_numbers = $int_number_last - $int_number +1;
            // Get the data.
            $qry_select = $DB_iwex->query($sql_calls);
            $int_current_rows = mysql_num_rows($qry_select);
            echo "$int_current_rows $int_total_pr $int_diff_numbers";
            if ($int_current_rows < $int_total_pr
                &&
                ($int_total_pr - $int_current_rows) <= $int_diff_numbers
                ) {
                for ($int_cnt = $int_number; 
                     $int_cnt <= $int_number_last
                     &&
                     ($int_current_rows +$int_cnt-$int_number) < $int_total_pr; 
                     $int_cnt++) {
                    $sql_insert = "INSERT INTO Serialnumbers SET 
                                   Inventory_transactionID = $int_transaction_id, 
                                   Serial = '$int_cnt'";
                    if ($DB_iwex->query($sql_insert,
										FALSE)) {
                        echo MakeBeep(TRUE);
                    } else {
                        echo MakeBeep(FALSE);
                    }
                }
            }
        } else { // Store one number
            //When new records have been added, insert these first
            $sql_insert = "INSERT INTO Serialnumbers SET 
                           Inventory_transactionID = $int_transaction_id, 
                           Serial = '$int_number'";
            if ($DB_iwex->query($sql_insert,
								FALSE)) {
				echo MakeBeep(TRUE);
			} else {
				echo MakeBeep(FALSE);
			}
        }
    }
    if ($bl_override && $bl_update) {
        $qry_select = $DB_iwex->query($sql_calls);
		
        while ($obj = mysql_fetch_object($qry_select)) {
            if (isset($_POST["number$obj->SerialRecordID"]) && $_POST["number$obj->SerialRecordID"]) {
                $sql_update = "UPDATE Serialnumbers SET 
                               Serial = '".$_POST["number$obj->SerialRecordID"]."'
                               WHERE SerialRecordID = $obj->SerialRecordID";
                $DB_iwex->query($sql_update);
            }
			if (GetCheckBox("delete$obj->SerialRecordID")) {
				$sql_delete = "DELETE FROM Serialnumbers WHERE SerialRecordID = $obj->SerialRecordID";
				$DB_iwex->query($sql_delete);
			}
        }
    } // End update

    // Get the data.
    $qry_select = $DB_iwex->query($sql_calls);
    $int_current_rows = mysql_num_rows($qry_select);
    if ($int_current_rows >= $int_total_pr
		&&
		$bl_auto_close
        &&
        !$bl_override) {
        $str_return .= '<script TYPE="text/javascript" language="JavaScript">close();</script>';
    }
    $str_return .= "<p>Er moeten $int_total_pr serie nummers worden ingevoerd. Nog "
                .($int_total_pr - $int_current_rows). " te gaan.</p>";
    $str_return .= "<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" class=\"blockbody\">\n";
    $str_return .= "<tr><th>Num.</th><th>Serialnumber</th></tr>\n";

    // Display a new empty detail record when needed
	if ($int_current_rows <> $int_total_pr) {
		$str_return .= "<tr>\n";
		$str_return .= "<td></td>\n";
		$str_return .= "<td><input size=\"20\" name=\"number\" type=\"text\" value=\"\">\n"; 
        if (abs($int_total_pr-$int_current_rows != 1)) {
            $str_return .= "<br>tot en met<br>\n<input size=\"20\" name=\"number_last\" type=\"text\" value=\"\">\n";
        }
        // Set cursor on the input field.		  
        $str_return .= '<script TYPE="text/javascript" language="JavaScript">document.serialform.number.focus();</script>';
		$str_return .= "</td></tr>\n";
	}
    
    while ($obj = mysql_fetch_object($qry_select)) {
        $str_return .= "<tr>\n";
        $str_return .= "<td align=right>$int_current_rows</td>\n";
        if ($bl_override) {
            $str_return .= "<td><input size=\"20\" name=\"number$obj->SerialRecordID\" type=\"text\" value=\"$obj->Serial\">"
						. '<input type="checkbox" NAME="delete'.$obj->SerialRecordID
						.'" onClick="return confirm(\'Weet je zeker dat je dit record wilt verwijderen?\')">(del)'
						."</td>\n";
        } else {
            $str_return .= "<td>$obj->Serial</td>\n";
        }
        $str_return .= "</tr>\n";
		$int_current_rows--;
    }
    mysql_free_result($qry_select);
    
    $str_return .= "</TABLE>\n";
    
    return $str_return;
}
 

// Print default Iwex HTML header.
printheader ("Iwex add serieel nummer screen", "serial", FALSE);

echo "<body><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"serialform\"\">\n";
   
if ($int_transid) {
    echo SerialNumbers($bl_submit,
                       $int_transid,
					   $bl_close,
                       $bl_correct);	
    echo "<INPUT TYPE='hidden' NAME='transid' VALUE='$int_transid'>";
    echo "<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\">";
    echo " Override ".MakeCheckBox('correct',
								   $bl_correct);
} else {
    echo "<h2>Geen transactie opgegeven.</h2>";
}
echo "</FORM>\n";

printenddoc();

?>
