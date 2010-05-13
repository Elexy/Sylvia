<?PHP

/*
 * Function     : SetOverdueType
 * Set an overdue type to invoices if the invoice is overdue!
 * Input        :
 * Returns      :
*/
Function SetOverdueTypes() {
	global $db_iwex;
	$str_date_now = date("Y-m-d");
	
	$sql_invoices = SQL_INVOICES_PAYMENT;
	$sql_invoices .= " WHERE not paid_yn AND overduetypeID != 99 AND DispuutID != '" . DB_INVOICE_OVERDUE_DISPUUT . "'
						OR (paid_yn AND overduetypeID)";
	$str_results = $db_iwex->query($sql_invoices);
	$ary_update_events = array();
	$ary_update_events_num = array();
	while ($objshipment = mysql_fetch_object($str_results)) {
		$int_dispuut_days = 0;
		$ary_dispuut_calls = array();
		$str_dispuut_end_time = "";
		$str_dispuut_begin_time = "";

		// Get the last inserted type
		$lastoptie_result = $db_iwex->query("SELECT DispuutID, overduetypeID
											 FROM invoices 
											 WHERE invoiceID = '$objshipment->InvoiceID'");
		$obj_lastoptie = mysql_fetch_object($lastoptie_result);
		$int_lasttypeid = isset($obj_lastoptie->overduetypeID) ? $obj_lastoptie->overduetypeID : FALSE;
		$int_lastdispuutid = isset($obj_lastoptie->DispuutID) ? $obj_lastoptie->DispuutID : FALSE;

		// Check overdue type end date and begin date if there is an overdue end type.
		// First we get the history from the database table invoices_call and calls.
		// because it is orderd by callID we will get first the "end dispuut" than "dispuut status" and than "no dispuut". 
		if ($int_lastdispuutid == DB_INVOICE_OVERDUE_END_DISPUUT) { 
			$dispuut_result = $db_iwex->query("SELECT invoices_call.callID, CallDate, DispuutID FROM invoices_call
											   LEFT JOIN calls ON invoices_call.callID = calls.callID
											   WHERE invoiceID = '". $objshipment->InvoiceID . "'
											   ORDER BY callID desc");

			// First we set the numbers of dispuut history calls to zero. Than we loop the results from the database.
			while ($obj_dispuut_time = mysql_fetch_object($dispuut_result)) {
				// Now if the dispuutID is an end dispuut we set the dispuut_end_time. 
				// And because it will only set if it's not set it can not be overwrited if there is an another dispuut end ID. 
				if ($obj_dispuut_time->DispuutID == DB_INVOICE_OVERDUE_END_DISPUUT) {
					$str_dispuut_end_time = $obj_dispuut_time->CallDate;
				// This if will alwase be skiped the first time because the dispuut status will be set in the array $ary_dispuut_calls.
				// So to get the first beginning dispuut date we need the last inserted time into the array.
				} else if ($obj_dispuut_time->DispuutID == DB_INVOICE_OVERDUE_NEW_DISPUUT) {
					$str_dispuut_begin_time = $obj_dispuut_time->CallDate;
				// If the status is dispuut we will set all the dipuut times into a array. the last one will be the begin time
				}
				// Get extra day's
				if ($str_dispuut_begin_time && $str_dispuut_end_time) {
					$int_dispuut_days = Getdays($str_dispuut_end_time, $str_dispuut_begin_time);
				}
			}
		}
		$int_overdue_days = $objshipment->dayslate - $int_dispuut_days;
		
		if ($int_overdue_days > 0 && !$objshipment->paid_yn && $objshipment->amount > 0) {
				
			$int_update_events = FALSE;
			// check to see what option must be set
			if ($int_overdue_days >= FIRST_MAIL_OVERDUE_DAYS && $int_overdue_days < SECOND_MAIL_OVERDUE_DAYS) {
				$str_type = DB_INVOICE_OVERDUE_FIRST_MAIL; 
				$int_update_events = 5;
			} else if ($int_overdue_days >= SECOND_MAIL_OVERDUE_DAYS && $int_overdue_days < TELEPHONE_CALL_OVERDUE_DAYS) {
				$str_type = DB_INVOICE_OVERDUE_SECOND_MAIL;
				$int_update_event = 6;
			} else if ($int_overdue_days >= TELEPHONE_CALL_OVERDUE_DAYS && $int_overdue_days < FAX_OR_LETTER_OVERDUE_DAYS) {
				$str_type = DB_INVOICE_OVERDUE_TELEPHONE_CALL; 
				$int_update_event = 7;
			} else if ($int_overdue_days >= FAX_OR_LETTER_OVERDUE_DAYS && $int_overdue_days <  SIGNATURE_LETTER_OVERDUE_DAYS) {
				$str_type = DB_INVOICE_OVERDUE_FAX_OR_LETTER;
				$int_update_event = 8; 
			} else if ($int_overdue_days >=  SIGNATURE_LETTER_OVERDUE_DAYS && $int_overdue_days <= BAILIFF_OVERDUE_DAYS) {
				$str_type = DB_INVOICE_OVERDUE_SIGNATURE_LETTER;
				$int_update_event = 9;
			} else if ($int_overdue_days > BAILIFF_OVERDUE_DAYS) {
				$str_type = DB_INVOICE_OVERDUE_BAILIFF;
				$int_update_event = 10;
			}
	
			if ($str_type != $int_lasttypeid) {
				$ary_update_events["$int_update_event"] = TRUE;
				if ($ary_update_events_num["$int_update_event"] > 0) {
					$ary_update_events_num["$int_update_event"]++;
				} else {
					$ary_update_events_num["$int_update_event"] = 1;
				}
				$db_iwex->query("UPDATE invoices SET overduetypeID = '$str_type'
								 WHERE InvoiceID = '" . $objshipment->InvoiceID . "'");
			}	
		} else {
			$db_iwex->query("UPDATE invoices SET overduetypeID = 0 WHERE InvoiceID = $objshipment->InvoiceID");
		}
	}
	foreach ($ary_update_events AS $int_event_id => $bl_event_set) {
		if ($bl_event_set) {
			$result_event_desc = $db_iwex->query("SELECT id, title from events WHERE ID = '$int_event_id'");
			$obj_event_desc = mysql_fetch_object($result_event_desc);
			$db_iwex->free_result($result_event_desc);
	
			$ary_event_desc = explode(" ", $obj_event_desc->title);
			foreach ($ary_event_desc As $int_value => $str_event_desc_num) {
				if(is_numeric($str_event_desc_num)) {
					$int_number_value = $int_value;
				}
			}
			$str_new_desc = str_replace($ary_event_desc[$int_number_value] ,$ary_event_desc[$int_number_value] + $ary_update_events_num["$int_event_id"], $obj_event_desc->title);
			$db_iwex->query("UPDATE events SET title = '$str_new_desc', action_performed_date = '$str_date_now', action_done_by ='".DB_WEB_EMPLOYEE. "' 
					 		 WHERE id = '" . $obj_event_desc->id . "'");
		}
	}
}

?>