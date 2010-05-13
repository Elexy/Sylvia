<?

/**
 * Function     : pricing_sales
 * will show / facilitate update of special pricing
 * Input        : ContactID, The ID of the customer,  nothing for all
 ProductID, ID of the product no default
 start_date: Date the price starts, 0 for always
 end_date: Date the price stops, 0 for never
 update=true or false
 higher_contactID = contact id of the mother firm.
 * Returns      :updatebale echo-able string
 **/
Function pricing_sales($int_contact_id, 
    $int_productID,
    $bl_update,
    $formname,
    $int_higher_contactID = FALSE) {
  global $db_iwex;
  $return_var = FALSE;
  // get the staus of the edit_button
  $bl_edit_prices = edit_button();
  //get the status of the show_old button
  $bl_show = GetSetFormVar('show_old', TRUE, TRUE);

  // set query stuff for showing old prices or not
  if ($bl_show) {
    $str_old = "";
  } else {
    $str_old = "AND (DATEDIFF(end_date,NOW()) >=-1 OR end_date = '0000-00-00') ";
  }

  if ($int_productID || $int_contact_id) {
  // what if a contactID is given
    $condition = '';
    $int_higher_contactID = FALSE;
    $higher_level_pricing = FALSE;
    $update_condition = FALSE;
    if ($int_contact_id) {
      $int_higher_contactID = GetField("SELECT MainContactID FROM branches WHERE BrancheContactID = '$int_contact_id'");
      if ($int_higher_contactID) $higher_level_pricing = "OR pricing.ContactID = '$int_higher_contactID'";
      $condition = " WHERE ((pricing.ContactID = '$int_contact_id' $higher_level_pricing) $str_old)";
      $update_condition = " WHERE (pricing.ContactID = '$int_contact_id')";
      $column = "Product"; //in case of contactID show products
      $descr_column = "ProductName";
      $table = "current_product_list";
      $search_list = SQL_SEARCH_PRODUCTS_LIST;
      $str_where = "ContactID = $int_contact_id";
    } else if ($int_productID) {
        $condition = " WHERE current_product_list.ProductID = '$int_productID' $str_old";
        $column = "Contact"; //in case of ProductID show Contacts
        $descr_column = "CompanyName";
        $table = "contacts";
        $search_list = SQL_SEARCH_CUSTOMER_LIST;
        $str_where = "productID= '$int_productID'";
      }
    $pricing_sql_base = "SELECT pricing.*, ValutaName ,pricing.productID as ProductID, ProductName, CompanyName,
										  created, emcreat.FirstName AS CreatBy, 
										  CONCAT_WS(' ', emcreat.FirstName, emcreat.middlename, emcreat.LastName) AS CreatByfull, 
										  modified, emmodby.FirstName AS ChangedBy,
										  CONCAT_WS(' ', emmodby.FirstName, emmodby.middlename, emmodby.LastName) AS ModByfull
					    FROM pricing 
						INNER JOIN current_product_list ON pricing.productID = current_product_list.ProductID
						LEFT JOIN contacts ON pricing.ContactID = contacts.ContactID
						LEFT JOIN employees emcreat ON emcreat.EmployeeID =  created_by
			 			LEFT JOIN employees emmodby ON emmodby.EmployeeID =  modified_by
						LEFT JOIN valuta ON pricing.currencyid = ValutaID";
    $pricing_sql = $pricing_sql_base . "$condition  ORDER BY " . $column . "ID ASC, start_date DESC, start_number ASC,  amount ASC;";
    $update_pricing_sql = $pricing_sql_base . "$update_condition ORDER BY " . $column . "ID ASC, start_date DESC, start_number ASC,  amount ASC;";
    //echo $pricing_sql;
    if ($bl_update) {
      $str_id_new = isset($_POST[$column."IDnew"]) ? $_POST[$column."IDnew"] : FALSE;
      // first check if we have a new record to submit
      if ($str_id_new === '0'
          ||
          $str_id_new <> '') {
        $str_id_new = $str_id_new == ALL_INPUT_WILDCARD ? '0' : $str_id_new; // Make possible to select * for all.
        echo ${"is_".$column."ID"} = GetField("SELECT ".$column."ID FROM $table WHERE ".$column."ID='$str_id_new'");
        if (${"is_".$column."ID"}
            ||
            $str_id_new === '0') {
          if ($_POST["amount_new"]) {
            $amount = $_POST["amount_new"];
          } else {
            $amount = FALSE;
            if ($_POST["margin_new"]) {
              $amount = CalculateSalesPriceWithMargin($int_productID ? $int_productID : $_POST["ProductIDnew"],
                  $_POST["start_number_new"] ? $_POST["start_number_new"] : 1,
                  $_POST["margin_new"],
                  $_POST["start_date_new"],
                  $_POST["currency_new"]);
            }
            if (!$amount) {
              $amount = GetSpecialProductPrice(
                $int_productID ? $int_productID : $_POST["ProductIDnew"],
                1,
                $int_contact_id,
                date_create(),
                PRICING_TYPE_SALE,
                OWN_COMPANYID );
            }
          }
					/*
					$sql_insert = "INSERT INTO pricing SET
						amount = '$amount',";
					if ($int_contact_id) {
						$sql_insert .= "ContactID = '$int_contact_id', 
										productID = '$str_id_new',";
					} else if ($int_productID) {
						$sql_insert .= "ContactID = '$str_id_new', 
										productID = '$int_productID', ";
					}
					$start_nr = $_POST["start_number_new"] ? $_POST["start_number_new"] : 1;
					$sql_insert .= "start_number = '" . $start_nr . "', ";
					$sql_insert .= "end_number = '" . $_POST["end_number_new"] . "', ";
					$sql_insert .= "start_date = '" . $_POST["start_date_new"] . "', ";
					$sql_insert .= "created_by = '" . $GLOBALS["employee_id"] . "', ";
					$sql_insert .= "created = '" . date(DATEFORMAT_LONG) . "' ";
			//echo $sql_insert;
					$db_iwex->query($sql_insert);
					$just_inserted =  $db_iwex->lastinserted();
					 */
          $just_inserted = update_price($int_productID ? $int_productID : $str_id_new,
              $amount,
              $_POST["currency_new"],
              $_POST["start_date_new"],
              $_POST["end_date_new"],
              $_POST["start_number_new"] ? $_POST["start_number_new"] : 1,
              $_POST["end_number_new"],
              $int_contact_id ? $int_contact_id : $str_id_new);
        } else {
          echo strtoupper($_POST[$column."IDnew"]) . " not a valid $column ID<BR>";
        }
      }
      $sql_upd = 'Select';
      // now update all fields that have their updaterecordID set
      if ($qry_prices = $db_iwex->query($update_pricing_sql)) {
        while ($obj = mysql_fetch_object($qry_prices)) {
          if (isset($_POST[$column."ID$obj->recordID"])
              &&
              (!$_POST["delete".$obj->recordID]
              &&
              (
              $_POST["update".$obj->recordID]==='1'
              ||
              $_POST["start_date".$obj->recordID]<>$_POST["laststart_date".$obj->recordID]
              ||
              $_POST["end_date".$obj->recordID]<>$_POST["lastend_date".$obj->recordID]
              ||
              $_POST["currency$obj->recordID"]<>$_POST["lastcurrency$obj->recordID"]
              )
          )
          ) {
          //echo "currency: " . $_POST["currency$obj->recordID"];
            $amount = FALSE;
            if ($_POST["margin$obj->recordID"]
                &&
                $_POST["margin$obj->recordID"] != $_POST["lastmargin".$obj->recordID]) {
              $amount = CalculateSalesPriceWithMargin($int_productID ? $int_productID : $_POST["ProductIDnew"],
                  $_POST["start_number$obj->recordID"],
                  $_POST["margin$obj->recordID"],
                  $_POST["start_date$obj->recordID"],
                  $_POST["currency$obj->recordID"]);
            }
            if (!$amount) {
              $amount = $_POST["amount$obj->recordID"];
            }
            $just_inserted = update_price($int_productID ? $int_productID : $_POST["ProductID$obj->recordID"],
                $amount,
                $_POST["currency$obj->recordID"],
                $_POST["start_date".$obj->recordID],
                $_POST["end_date".$obj->recordID],
                $_POST["start_number$obj->recordID"],
                $_POST["end_number$obj->recordID"],
                $int_contact_id ? $int_contact_id : $_POST["ContactID$obj->recordID"]);
						/*
						$sql_upd = "UPDATE pricing SET 
							amount = '". $_POST["amount$obj->recordID"] . "',";
						if ($int_contact_id) {
							$sql_upd .= "ContactID = '$int_contact_id', 
											productID = '". $_POST["ProductID$obj->recordID"] . "',";
						} else if ($int_productID) {
							$sql_upd .= "ContactID = '". $_POST["ContactID$obj->recordID"] . "',  
											productID = '$int_productID',";
						}
						$sql_upd .= "							
							start_date = '". $_POST["start_date$obj->recordID"] . "',
							end_date = '". $_POST["end_date$obj->recordID"] . "',
							start_number = '". $_POST["start_number$obj->recordID"] . "',
							end_number = '". $_POST["end_number$obj->recordID"] . "',
							currencyid = '". $_POST["currency$obj->recordID"] . "',
							modified = '" . date(DATEFORMAT_LONG) . "',
							modified_by = '" .  $GLOBALS["employee_id"] . "'
							WHERE recordID = '$obj->recordID'";
						$db_iwex->query($sql_upd);
						 */
          } else if (isset($_POST["delete".$obj->recordID])
                &&
                $_POST["delete".$obj->recordID]) {
              $sql_upd = "DELETE FROM pricing WHERE recordID = '$obj->recordID'";
              if ($sql_upd) $db_iwex->query($sql_upd);
            }
          $sql_upd = '';
        }
        mysql_free_result($qry_prices);
      }
    }
    // start the displaying of the table
    $str_button_disable = "DISABLED";
    if (isset ($GLOBALS["waccess_s"])) $str_button_disable = "";

    // show table to explain the colors
    if ($int_contact_id) {
      $return_var .= "<table border=0>\n
					<tr>\n
						<td bgcolor=".QOUTE_BGCOLOR.">Own Special Pricing</td>\n
						<td bgcolor=".OPENORDER_BGCOLOR.">
						<A HREF='" . CONTACTS . "?custid=$int_higher_contactID' TARGET='_new' "
          .ShowShortContactInfo($int_contact_id)
          .">Special Prices from Higher level</A></td>\n
					</tr>\n
				</table>\n";
    }
    //show control buttons
    // edit toggle button
    $return_var .= edit_button ('waccess_s', $formname);
    // show old values toggle button
    $return_var .= button('show_old',
        $bl_show,
        'Show Old',
        'Hide Old',
        $formname,
        !$bl_edit_prices);
    // now start the table
    $return_var .= "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
    $return_var .= "<TR>\n";
    $return_var .= "<TH>" . $column . "ID</TH>";
    $return_var .= "<TH>$descr_column</TH>
						<TH>sales price</TH>
						<TH>Currency</TH>
						<TH WIDTH='60'>%</TH>
						<TH WIDTH=90>start date</TH>
						<TH WIDTH=90>end date</TH>
						<TH>Creaded By</TH>
						<TH>Modified By</TH>
						<TH>min number</TH>
						<TH>max number</TH>
						<TH>Option</TH>
						<TH>Catalog</TH>";
    $return_var .= "</TR>";

    //set edit enabler
    if (!$bl_edit_prices) {
      $edit_str = "DISABLED" ;
    } else {
      $edit_str = "";
      // first a new one, but only if we are editing
      $return_var .= "<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='" . $column . "IDnew'></TD><TD>";
      $return_var .= GetRecordIdInputField($search_list, "ID", $column."New", $formname . "." . $column . "IDnew", "$column", 10, "", 3)."</TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='8' NAME='amount_new'></TD>
						<TD>".makelistbox('SELECT ValutaID, ValutaName FROM valuta ORDER by ValutaName',
          "currency_new",
          'ValutaID',
          'ValutaName',
          DB_CURRENCY_DEFAULT,
          FALSE,
          FALSE,
          $edit_str)."</TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='margin_new'></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='10' NAME='start_date_new'>"
          . Add_Calendar($formname.".start_date_new") . "</TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='10' NAME='end_date_new'>"
          . Add_Calendar($formname.".end_date_new") . "</TD>
						<TD></TD>
						<TD></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='start_number_new'></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='end_number_new'></TD>
						<TD></TD>";
      $return_var .= "</TR>\n";
    }
    //then edit existing ones
    $qry_prices = $db_iwex->query($pricing_sql);
    while ($obj = mysql_fetch_object($qry_prices)) {
    // change color and behaviour based on own pricing or Higher level related contact- pricing
      if ($obj->ContactID == $int_higher_contactID
          &&
          $obj->ContactID) {
        $str_bgcolor = "BGCOLOR='".OPENORDER_BGCOLOR."'";
        $str_edit = "DISABLED";
      } else {
      // color the old stuff different
        if ($obj->end_date=='0000-00-00'
            ||
            strtotime($obj->end_date) >= strtotime(date('Y-m-d'))) {	// current stuff
          $str_bgcolor = "BGCOLOR='".QOUTE_BGCOLOR."'";
          $str_edit = "";
          $check_date = date("Y-m-d");
        } else { //old stuff
          $str_bgcolor = "BGCOLOR='".OTHER_BGCOLOR."'";
          $str_edit = "";
          $check_date = $obj->start_date;
        }
      }
      //if we are looking at sales pricing calculate margin
      $margin = CalcProductMargin($obj->ProductID,
          $obj->amount,
          ($obj->start_number > 1 ? $obj->start_number : 1),
          $check_date) . " %"; //check against the end date

      // make sure the disabled state from the edit button is also respected
      $str_edit || $edit_str ? $str_edit = "DISABLED" : $str_edit = "";

      //if  the date of the price is endless or later than today show the delete button
      // future development: this should check whether this price has ever been used, if so, delete does not appear!
      if (($obj->end_date=='0000-00-00'
          ||
          strtotime($obj->end_date) >= strtotime(date('Y-m-d')))
          &&
          !$str_edit) {
        $str_del = "<INPUT TYPE='hidden' NAME='delete".$obj->recordID."'>
					<IMG SRC=".IMAGES_URL."delete.png WIDTH='10' 
					onclick=\"document.$formname.delete".$obj->recordID.".value='1';
					document.$formname.update_var.value='1';
					document.$formname.submit()\"
					onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">";
        $str_edit = "";
        // enable catalog checkbox
        $enable_checkbox = TRUE;
      } else {
      // empty the delet string
        $str_del = "";
        // disable editing if it's an old price!
        $str_edit = "DISABLED";
        // also disable catalog checkbox
        $enable_checkbox = FALSE;
      }

      //first column ProductID or ContactID
      $return_var .= "<TR $str_bgcolor><TD><INPUT $str_edit TYPE='text'
									SIZE='4' 
									NAME='" . $column."ID" . $obj->recordID . "' 
									VALUE='" . $obj->{$column."ID"} . "'
									onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">
          $str_del";
      $return_var .= "</TD><TD>". $obj->$descr_column . "</TD>";
      $return_var .= "<TD><INPUT $str_edit TYPE='text' SIZE='8' NAME='amount".$obj->recordID."' VALUE='". $obj->amount ."'
							onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\"></TD>
				<TD>".makelistbox('SELECT ValutaID, ValutaName FROM valuta ORDER by ValutaName',
          "currency$obj->recordID",
          'ValutaID',
          'ValutaName',
          $obj->currencyid,
          FALSE,
          FALSE,
          $str_edit)."
					<INPUT TYPE='hidden' SIZE='10' NAME='lastcurrency".$obj->recordID."' VALUE='$obj->currencyid'></TD>
				<TD" . ShowOnMouseOverText("Margin calculation date: $check_date") . ">
					<INPUT $str_edit TYPE='text' SIZE='5' NAME='margin".$obj->recordID."' VALUE='$margin' onfocus=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='lastmargin".$obj->recordID."' VALUE='$margin'>
				</TD>	
				<TD><INPUT $str_edit TYPE='text' SIZE='10' NAME='start_date".$obj->recordID."' VALUE='$obj->start_date'
					onfocus=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='laststart_date".$obj->recordID."' VALUE='$obj->start_date'>
          ". Add_Calendar($formname.".start_date".$obj->recordID) . "</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='10' NAME='end_date".$obj->recordID."' VALUE='$obj->end_date'
					onfocus=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='lastend_date".$obj->recordID."' VALUE='$obj->end_date'>
          ". Add_Calendar($formname.".end_date".$obj->recordID) . "</TD></TD>
				<TD ".ShowOnMouseOverText("$obj->CreatByfull<br>$obj->created").">$obj->CreatBy</TD>
				<TD ".ShowOnMouseOverText("$obj->ModByfull<br>$obj->modified").">$obj->ChangedBy</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='4' NAME='start_number".$obj->recordID."' VALUE='$obj->start_number'
						onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">
				</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='4' NAME='end_number".$obj->recordID."' VALUE='$obj->end_number'
						onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT $str_edit TYPE='hidden' NAME='update" . $obj->recordID . "'>
				</TD>";
      $str_insert_link = "";
      if ($obj->end_date == '0000-00-00') {
        $str_insert_link = "<INPUT $str_edit TYPE='button' VALUE='new price'
						onclick=\"document.$formname.update_var.value='1';
						if(new_date=prompt('date?', '" . date("Y-m-d") . "'))
						{
							// set this date to yesterday
							ary_date = new_date.match('(\.{4})-(\.{2})-(\.{2})'); //('\d+-\d+-\d+');
							date_given = new Date(ary_date[1],ary_date[2],ary_date[3]);
							yesterdayDate = date_given.getDate() -1 ;
							date_given.setDate( yesterdayDate );
							str_yestterday = date_given.getFullYear();
							str_yestterday += '-';
							str_yestterday += date_given.getMonth();
							str_yestterday += '-';
							str_yestterday += date_given.getDate();
							// fill in new values
							//document.$formname.end_date".$obj->recordID.".value = str_yestterday;							
							//document.$formname.update" . $obj->recordID . ".value='1';
							//document.$formname.str_recordID.value='" . $obj->recordID . "';
							document.$formname." . $column . "IDnew.value=document.$formname." . $column."ID" . $obj->recordID . ".value;
							document.$formname.amount_new.value=document.$formname.amount".$obj->recordID.".value;
							document.$formname.start_date_new.value=new_date;								
							document.$formname.start_number_new.value=document.$formname.start_number".$obj->recordID.".value;
							document.$formname.end_number_new.value=document.$formname.end_number".$obj->recordID.".value;
							document.$formname.submit();
						};\">";
      }
      $return_var .= "<TD>$str_insert_link&nbsp;</TD>";
      // now show if this is in the catalog
      $return_var .= "<TD>" . MakeCheckbox("in_catalog".$obj->recordID,
          catalog($obj->ContactID, $obj->ProductID, "in_catalog".$obj->recordID, FALSE),
          $enable_checkbox,
          FALSE,
          $formname,
          $auto_submit=TRUE) . "</TD>";
      $return_var .= "</TR>\n";
    }
    $return_var .= " </td>\n</TR>\n";
    $return_var .= "</table>";
    mysql_free_result($qry_prices);
  }
  Return $return_var;
}

/**
 * Function     : pricing_purchasing
 * will show / facilitate update of special pricing
 * Input        : ContactID, The ID of the customer,  nothing for all
 ProductID, ID of the product no default
 start_date: Date the price starts, 0 for always
 end_date: Date the price stops, 0 for never
 update=true or false
 higher_contactID = contact id of the mother firm.
 * Returns      :updatebale echo-able string
 **/
Function pricing_purchasing($int_contact_id, 
    $int_productID,
    $bl_update,
    $formname,
    $int_higher_contactID = FALSE) //, $date_start, $date_end, $int_type)
{
  global $db_iwex;
  $return_var = FALSE;
  // get the staus of the edit_button
  $bl_edit_prices = edit_button();
  //get the status of the show_old button
  $bl_show = GetSetFormVar('show_old', TRUE, TRUE);

  // set query stuff for showing old prices or not
  if ($bl_show) {
    $str_old = "";
  } else {
    $str_old = "AND (DATEDIFF(end_date,NOW()) >= 0 OR end_date = '0000-00-00') ";
  }

  if ($int_productID || $int_contact_id) {
  // what if a contactID is given
    $condition = '';
    $int_higher_contactID = FALSE;
    $higher_level_pricing = FALSE;
    $update_condition = FALSE;
    if ($int_contact_id) {
      $int_higher_contactID = GetField("SELECT MainContactID FROM branches WHERE BrancheContactID = '$int_contact_id'");
      // if there is a higher level pricing, include it in the query
      if ($int_higher_contactID) $higher_level_pricing = "OR pricing_purchase.ContactID = '$int_higher_contactID'";
      $condition = " WHERE ((pricing_purchase.ContactID = '$int_contact_id' $higher_level_pricing) $str_old)";
      $update_condition = " WHERE (pricing_purchase.ContactID = '$int_contact_id')";
      $column = "Product"; //in case of contactID show products
      $descr_column = "ProductName";
      $table = "current_product_list";
      $search_list = SQL_SEARCH_PRODUCTS_LIST;
      $str_where = "ContactID = $int_contact_id";
    } else if ($int_productID) {
        $condition = " WHERE current_product_list.ProductID = '$int_productID' $str_old";
        $column = "Contact"; //in case of ProductID show Contacts
        $descr_column = "CompanyName";
        $table = "contacts";
        $search_list = SQL_SEARCH_CUSTOMER_LIST;
        $str_where = "productID= '$int_productID'";
      }
    $pricing_sql_base = "SELECT pricing_purchase.*, ValutaName ,pricing_purchase.productID as ProductID, ProductName, CompanyName,
										  created, emcreat.FirstName AS CreatBy, modified ,emmodby.FirstName AS ChangedBy
					    FROM pricing_purchase 
						INNER JOIN current_product_list ON pricing_purchase.productID = current_product_list.ProductID
						LEFT JOIN contacts ON pricing_purchase.ContactID = contacts.ContactID
						LEFT JOIN employees emcreat ON emcreat.EmployeeID =  created_by
			 			LEFT JOIN employees emmodby ON emmodby.EmployeeID =  modified_by
						LEFT JOIN valuta ON pricing_purchase.currencyid = ValutaID";
    $pricing_sql = $pricing_sql_base . "$condition ORDER BY " . $column . "ID ASC, start_date DESC, start_number ASC, purchase_price ASC;";
    $update_pricing_sql = $pricing_sql_base . "$update_condition ORDER BY " . $column . "ID ASC, start_date DESC, start_number ASC, purchase_price ASC;";
    //echo $pricing_sql;
    if ($bl_update) {
      $str_id_new = isset($_POST[$column."IDnew"]) ? $_POST[$column."IDnew"] : FALSE;
      // first check if we have a new record to submit
      if ($str_id_new === '0'
          ||
          $str_id_new <> '') {
        $str_id_new = $str_id_new == ALL_INPUT_WILDCARD ? '0' : $str_id_new; // Make possible to select * for all.
        ${"is_".$column."ID"} = GetField("SELECT ".$column."ID FROM $table WHERE ".$column."ID='$str_id_new'");
        if (${"is_".$column."ID"}
            ||
            $str_id_new === '0') {
          if ($_POST["amount_new"]) {
            $amount = $_POST["amount_new"];
          } else {
            $amount = GetProductPrice(
              $int_productID ? $int_productID : $_POST["ProductIDnew"],
              1,
              $int_contact_id,
              date('Y-m-d'),
              $int_price_type
              );
          }
          $sql_insert = "INSERT INTO pricing_purchase SET
						purchase_price = '$amount',";
          if ($int_contact_id) {
            $sql_insert .= "ContactID = '$int_contact_id',
										productID = '$str_id_new',";
          } else if ($int_productID) {
              $sql_insert .= "ContactID = '$str_id_new',
										productID = '$int_productID',";
            }
          $start_nr = $_POST["start_number_new"] ? $_POST["start_number_new"] : 1;
          $sql_insert .= "start_number = '" . $start_nr . "', ";
          $sql_insert .= "end_number = '" . $_POST["end_number_new"] . "',";
          $sql_insert .= "start_date = '" . $_POST["start_date_new"] . "',";
          $sql_insert .= "created_by = '" . $GLOBALS["employee_id"] . "',";
          $sql_insert .= "created = '" . date(DATEFORMAT_LONG) . "'";
          //echo $sql_insert;
          $db_iwex->query($sql_insert);
          $just_inserted =  $db_iwex->lastinserted();
        } else {
          echo strtoupper($_POST[$column."IDnew"]) . " not a valid $column ID<BR>";
        }
      }
      $sql_upd = 'Select';
      // now update all fields that have their updaterecordID set
      if ($qry_prices = $db_iwex->query($update_pricing_sql)) {
        while ($obj = mysql_fetch_object($qry_prices)) {
          if (isset($_POST[$column."ID$obj->recordID"])
              &&
              (!$_POST["delete".$obj->recordID]
              &&
              (
              $_POST["update".$obj->recordID]==='1'
              ||
              $_POST["start_date".$obj->recordID]<>$_POST["laststart_date".$obj->recordID]
              ||
              $_POST["end_date".$obj->recordID]<>$_POST["lastend_date".$obj->recordID]
              ||
              $_POST["currency$obj->recordID"]<>$_POST["lastcurrency$obj->recordID"]
              )
          )
          ) {
            $sql_upd = "UPDATE pricing_purchase SET
							purchase_price = '". $_POST["amount$obj->recordID"] . "',";
            if ($int_contact_id) {
              $sql_upd .= "ContactID = '$int_contact_id',
											productID = '". $_POST["ProductID$obj->recordID"] . "',";
            } else if ($int_productID) {
                $sql_upd .= "ContactID = '". $_POST["ContactID$obj->recordID"] . "',
											productID = '$int_productID',";
              }
            $sql_upd .= "
							start_date = '". $_POST["start_date$obj->recordID"] . "',
							end_date = '". $_POST["end_date$obj->recordID"] . "',
							start_number = '". $_POST["start_number$obj->recordID"] . "',
							end_number = '". $_POST["end_number$obj->recordID"] . "',
							currencyid = '". $_POST["currency$obj->recordID"] . "',
							modified = '" . date(DATEFORMAT_LONG) . "',
							modified_by = '" .  $GLOBALS["employee_id"] . "'
							WHERE recordID = '$obj->recordID'";
            $db_iwex->query($sql_upd);
          } else if (isset($_POST["delete".$obj->recordID])
                &&
                $_POST["delete".$obj->recordID]) {
            // delete the price record
              $sql_upd = "DELETE FROM pricing_purchase WHERE recordID = '$obj->recordID'";
              if ($sql_upd) $db_iwex->query($sql_upd);
            // make previous record open ended

            }
          $sql_upd = '';
        }
        mysql_free_result($qry_prices);
      }
    }
    // start the displaying of the table
    $str_button_disable = "DISABLED";
    if (isset ($GLOBALS["waccess_s"])) $str_button_disable = "";

    // show table to explain the colors
    if ($int_contact_id) {
      $return_var .= "<table border=0>\n
					<tr>\n
						<td bgcolor=".QOUTE_BGCOLOR.">Own Special Pricing</td>\n
						<td bgcolor=".OPENORDER_BGCOLOR.">
						<A HREF='" . CONTACTS . "?custid=$int_higher_contactID' TARGET='_new' "
          .ShowShortContactInfo($int_contact_id)
          .">Special Prices from Higher level</A></td>\n
					</tr>\n
				</table>\n";
    }
    //show control buttons
    // edit toggle button
    $return_var .= edit_button ('waccess_s', $formname);
    // show old values toggle button
    $return_var .= button('show_old',
        $bl_show,
        'Show Old',
        'Hide Old',
        $formname,
        !$bl_edit_prices);
    // now start the table
    $return_var .= "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
    $return_var .= "<TR>\n";
    $return_var .= "<TH>" . $column . "ID</TH>";
    $return_var .= "<TH>$descr_column</TH>
						<TH>purchase price</TH>
						<TH>Currency</TH>
						<TH WIDTH=90>start date</TH>
						<TH WIDTH=90>end date</TH>
						<TH>Creaded By</TH>
						<TH>Modified By</TH>
						<TH>min number</TH>
						<TH>max number</TH>
						<TH>Option</TH>";
    $return_var .= "</TR>";

    //set edit enabler
    if (!$bl_edit_prices) {
      $edit_str = "DISABLED" ;
    } else {
      $edit_str = "";
      // first a new one, but only if we are editing
      $return_var .= "<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='" . $column . "IDnew'></TD><TD>";
      $return_var .= GetRecordIdInputField($search_list, "ID", $column."New", $formname . "." . $column . "IDnew", "$column", 10, "", 3)."</TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='8' NAME='amount_new'></TD>
						<TD></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='10' NAME='start_date_new'></TD>
						<TD></TD>
						<TD></TD>
						<TD></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='start_number_new'></TD>
						<TD><INPUT $edit_str TYPE='text' SIZE='4' NAME='end_number_new'></TD>";
      $return_var .= "</TR>\n";
    }
    //then edit existing ones
    $qry_prices = $db_iwex->query($pricing_sql);
    while ($obj = mysql_fetch_object($qry_prices)) {
    // change color and behaviour based on own pricing or Higher level related contact- pricing
      $str_del = "";
      if ($obj->ContactID == $int_higher_contactID
          &&
          $obj->ContactID) {
        $str_bgcolor = "BGCOLOR='".OPENORDER_BGCOLOR."'";
        $str_edit = "DISABLED";
      } else {
        if ($obj->end_date=='0000-00-00'
            ||
            strtotime($obj->end_date) >= strtotime(date('Y-m-d'))) {
          $str_bgcolor = "BGCOLOR='".QOUTE_BGCOLOR."'";
          if (!$edit_str) {// only if we are editing current stuff show the delete image
            $str_del = "<INPUT TYPE='hidden' NAME='delete".$obj->recordID."'>
							<IMG SRC=".IMAGES_URL."delete.png WIDTH='10' 
							onclick=\"document.$formname.delete".$obj->recordID.".value='1';
							document.$formname.update_var.value='1';
							document.$formname.submit()\"
							onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">";
          }
          $str_edit = "";
        } else {
          $str_bgcolor = "BGCOLOR='".OTHER_BGCOLOR."'";
          $str_edit = "";
        }
      }
      // make sure the disabled state from the edit button is also respected
      $str_edit || $edit_str ? $str_edit = "DISABLED" : $str_edit = "";

      // enable catalog checkbox
      $enable_checkbox = TRUE;


      //first column ProductID or ContactID
      $return_var .= "<TR $str_bgcolor><TD><INPUT $str_edit TYPE='text'
									SIZE='4' 
									NAME='" . $column."ID" . $obj->recordID . "' 
									VALUE='" . $obj->{$column."ID"} . "'
									onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">
          $str_del";
      $return_var .= "</TD><TD>". $obj->$descr_column . "</TD>";
      $return_var .= "<TD><INPUT $str_edit TYPE='text' SIZE='8' NAME='amount".$obj->recordID."' VALUE='".$obj->purchase_price."'
							onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\"></TD>
				<TD>".makelistbox('SELECT ValutaID, ValutaName FROM valuta ORDER by ValutaName',
          "currency$obj->recordID",
          'ValutaID',
          'ValutaName',
          $obj->currencyid,
          FALSE,
          FALSE,
          $str_edit)."
					<INPUT TYPE='hidden' SIZE='10' NAME='lastcurrency".$obj->recordID."' VALUE='$obj->currencyid'></TD>	
				<TD><INPUT $str_edit TYPE='text' SIZE='10' NAME='start_date".$obj->recordID."' VALUE='$obj->start_date'
					onfocus=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='laststart_date".$obj->recordID."' VALUE='$obj->start_date'>
          ". Add_Calendar($formname.".start_date".$obj->recordID) . "</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='10' NAME='end_date".$obj->recordID."' VALUE='$obj->end_date'
					onfocus=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT TYPE='hidden' SIZE='10' NAME='lastend_date".$obj->recordID."' VALUE='$obj->end_date'>
          ". Add_Calendar($formname.".end_date".$obj->recordID) . "</TD></TD>
				<TD>$obj->CreatBy</TD>
				<TD>$obj->ChangedBy</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='4' NAME='start_number".$obj->recordID."' VALUE='$obj->start_number'
						onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">
				</TD>
				<TD><INPUT $str_edit TYPE='text' SIZE='4' NAME='end_number".$obj->recordID."' VALUE='$obj->end_number'
						onchange=\"document.$formname.update" . $obj->recordID . ".value='1';\">
					<INPUT $str_edit TYPE='hidden' NAME='update" . $obj->recordID . "'>
				</TD>";
      $str_insert_link = "";
      if ($obj->end_date == '0000-00-00') {
        $str_insert_link = "<INPUT $str_edit TYPE='button' VALUE='new price'
						onclick=\"document.$formname.update_var.value='1';
						if(new_date=prompt('date?', '" . date("Y-m-d") . "'))
						{
							// set this date to yesterday
							ary_date = new_date.match('(\.{4})-(\.{2})-(\.{2})'); //('\d+-\d+-\d+');
							date_given = new Date(ary_date[1],ary_date[2],ary_date[3]);
							yesterdayDate = date_given.getDate() -1 ;
							date_given.setDate( yesterdayDate );
							str_yestterday = date_given.getFullYear();
							str_yestterday += '-';
							str_yestterday += date_given.getMonth();
							str_yestterday += '-';
							str_yestterday += date_given.getDate();
							// fill in new values
							document.$formname.end_date".$obj->recordID.".value = str_yestterday;							
							document.$formname.update" . $obj->recordID . ".value='1';
							//document.$formname.str_recordID.value='" . $obj->recordID . "';
							document.$formname." . $column . "IDnew.value=document.$formname." . $column."ID" . $obj->recordID . ".value;
							document.$formname.amount_new.value=document.$formname.amount".$obj->recordID.".value;
							document.$formname.start_date_new.value=new_date;								
							document.$formname.start_number_new.value=document.$formname.start_number".$obj->recordID.".value;
							document.$formname.end_number_new.value=document.$formname.end_number".$obj->recordID.".value;
							document.$formname.submit();
						};\">";
      }
      $return_var .= "<TD>$str_insert_link&nbsp;</TD>";
      $return_var .= "</TR>\n";
    }
    $return_var .= " </td>\n</TR>\n";
    $return_var .= "</table>";
    mysql_free_result($qry_prices);
  }
  Return $return_var;
}


/**
 * Function     : catalog
 * Will insert/delete/update the catalogdetails
 * Input        : ContactID, The ID of the customer,  nothing for all
 *		 ProductID, ID of the product no default
 *		$bl_create: want to create it?
 * Returns      : True if succeded
 **/

Function catalog($int_ContactID,
    $int_ProductID,
    $str_varname,
    $bl_edit) {
  $return_var = FALSE;
  if ($int_ContactID
      &&
      $int_ProductID) {
  //first check if this product is in it's catalog
    $int_existing_catalogID = Get_Catalog($int_ContactID,
        $int_ProductID);
    $set = GetCheckbox($str_varname);
    if ($int_existing_catalogID) {
      $return_var = TRUE;
    } else if ($bl_edit
          &&
          ($set
          ||
          $set === 0)) { // if product is not in catalog and we want to add it
      // is there even a catalog?
        $int_catalogID_not_product = Get_Catalog($int_ContactID);
        //first see if there even is a catalog
        if ($int_catalogID_not_product) //if there is a catalog use it
        {
          $int_catalogID = $int_catalogID_not_product;
        } else { //if not we need to create one
          $int_catalogID = create_catalog($int_ContactID) ;
        }
        // now that we have a catalog, add the product to it
        if (addto_catalog($int_ProductID,$int_catalogID, $set)) {
          $return_var = TRUE;
        }
      }
  }
  return $return_var;
}


/**
 * Function     : get_catalog
 * Will return de catalogID
 * Input        : ContactID
 *		 ProductID
 * Returns      : Catalog ID if succeded, otherwise FALSE
 **/
Function Get_Catalog($int_ContactID,
    $int_ProductID=FALSE) {
  $int_catalogus = FALSE;
  if ($int_ContactID) {
    if($int_ProductID) {
      $sql = "SELECT catalogus.CatalogusID FROM catalogusdetails
					LEFT JOIN catalogus ON catalogus.CatalogusID = catalogusdetails.CatalogusID				
					WHERE catalogus.ContactID = '$int_ContactID'						
						AND ProductID = '$int_ProductID'";
    } else {
      $sql = "SELECT catalogus.CatalogusID FROM catalogus
					WHERE catalogus.ContactID = '$int_ContactID'";
    }
    //echo $sql . "<BR>";
    $int_catalogus = GetField($sql);

  }
  return $int_catalogus;
}

/**
 * Function     : addto_catalog
 * Will add a product to the catalog
 * Input        : ContactID, The ID of the customer,  nothing for all
 *		 ProductID, ID of the product no defaul
 * Returns      : True if succeded
 **/
Function addto_catalog($int_ProductID,
    $int_catalogID,
    $bl_set) {
  global $db_iwex;

  if ($int_ProductID
      &&
      $int_catalogID
      &&
      $bl_set) {
    $return_var = FALSE;
    if ($set) {
      if ($db_iwex->query("INSERT INTO catalogusdetails
						SET ProductID = '$int_ProductID', CatalogusID = '$int_catalogID'")) $return_var = TRUE;
      echo  "INSERT INTO catalogusdetails
						SET ProductID = '$int_ProductID', CatalogusID = '$int_catalogID'";
    } else {
      if ($db_iwex->query("DELETE FROM catalogusdetails
						WHERE ProductID = '$int_ProductID' AND CatalogusID = '$int_catalogID'")) $return_var = TRUE;
      echo  "DELETE FROM catalogusdetails
						WHERE ProductID = '$int_ProductID' AND CatalogusID = '$int_catalogID'";
    }
  }
  return $return_var;
}

/**
 * Function     : create_catalog
 * Will add a catalog for this ContactID
 * Input        : ContactID, The ID of the customer,  nothing for all
 * Returns      : catalogID if succeded
 **/
Function create_catalog($int_ContactID) {
  global $db_iwex;

  if ($int_ContactID) {
    $return_var = FALSE;
    if ($db_iwex->query("INSERT INTO catalogus SET ContactID = '$int_ContactID'")) {
      $return_var = $db_iwex->query("SELECT distinct LAST_INSERT_ID() FROM catalogus");
    }
  }
  return $return_var;
}

/**
 * Function     : SalesPriceUsedInOrder
 * Will check if this priced is used in an order.
 * Input        : RecordID of the price
 * Returns      : The orderID where used. False otherwise
 **/
Function SalesPriceUsedInOrder($int_record_id) {
  return GetField("SELECT orders.OrderID
					 FROM order_details
					 INNER JOIN orders ON orders.OrderID = order_details.OrderID
					 INNER JOIN pricing ON pricing.ProductID = order_details.ProductID
									       AND (order_details.Quantity >= pricing.start_number OR pricing.start_number = 0)
										   AND (order_details.Quantity <= pricing.end_number OR pricing.end_number = 0)
										   AND (pricing.ContactID = orders.ContactID OR pricing.ContactID = 0)
									       AND (orders.OrderDate >= pricing.start_date OR pricing.start_date = 0)
									       AND (orders.OrderDate <= pricing.end_date OR pricing.end_date = 0)
										   AND (order_details.Quantity <= pricing.end_number OR pricing.end_number = 0)
					 WHERE recordID = $int_record_id");
}

/**
 * Function     : EndOldSalesPrice
 * Will end this record by adding the salesdate.
 * Input        : RecordID of the price
 * Returns      : result of the query.
 **/
function EndOldSalesPrice($str_start_date,
    $int_price_recored_id) {
  global $db_iwex;
  $str_update_old="UPDATE pricing
						SET end_date = DATE_ADD(".($str_start_date && $str_start_date != "0000-00-00" ? "'$str_start_date'" : "NOW()").", INTERVAL -1 DAY),
							modified_by = '" . $GLOBALS["employee_id"] . "',
							modified = NOW()
						WHERE recordID = $int_price_recored_id";
  echo "<h2>Let op er is een oude price vervallen!</h2>";
  return 	$db_iwex->query($str_update_old);
}

/**
 * Function     : update_price
 * Will set the new price to the pricing table.
 * Input        : product_id, id of the product
 *				  amount, the new amount
 *				  currencyid, the id of the currencyid
 *				  start_date, date from which this price is valid.
 *				  end_date, date untill this price is valid
 *				  min_quantity, the min_quantity for which this price is valid
 *				  max_quantity, the max_quantity for which this price is valid
 * 				  ContactID, The ID of the customer,  nothing for all
 * Returns : The ID of the updated or new price record.
 **/
Function update_price($int_productID,
    $flt_amount,
    $int_currency_id,
    $start_date,
    $end_date = FALSE,
    $min_quantity = 1,
    $max_quantity = 0,
    $int_contact_id = FALSE) {
  global $db_iwex;
  //echo " update_price curr: " . $int_currency_id;
  // Check if there is a record that can be updated.
  $int_current_price = GetField("SELECT recordID
								   FROM pricing
								   WHERE productID = '$int_productID'
										AND currencyid = '$int_currency_id'
										AND start_number = '$min_quantity'
										AND end_number = '$max_quantity'
										AND start_date = '$start_date'
										AND (end_date >= NOW() OR end_date = '0000-00-00')
										AND ContactID = $int_contact_id");
  // When there is an old price that matches it.
  $str_sql = "SELECT recordID
				FROM pricing 
				WHERE ProductID = '$int_productID' 
					AND currencyid = '$int_currency_id'
					AND ContactID='$int_contact_id'
					AND (start_date <= '$start_date' || isnull(start_date) || start_date=0) 
					AND (end_date >= ".($end_date && $end_date != "0000-00-00" ? "'$end_date'" : "NOW()")." || isnull(end_date) || end_date=0)
					AND (start_number <= '$min_quantity' || isnull(start_number) || start_number=0)
					AND (".($max_quantity ? "end_number >= '$max_quantity' ||" : "")." isnull(end_number) || end_number=0)";
  $int_record_id = GetField($str_sql);

  $bl_record_used = $int_current_price ? SalesPriceUsedInOrder($int_current_price) : FALSE;

  // When there is an other record that also matches this new price set it valid to the today -1 day.
  if ($int_record_id != $int_current_price
      &&
      $int_record_id
  ) {
    EndOldSalesPrice($start_date, $int_record_id);
  }

  if ($bl_record_used) {
    EndOldSalesPrice($start_date, $int_current_price);
    $int_current_price = FALSE;
  }

  if (!$int_current_price) { // Create a new record.
    $sql = "INSERT INTO";
    // New records are started today when false or 0;
    $start_date = !$start_date || $start_date == "0000-00-00" ? date(DATEFORMAT_LONG) : $start_date;
    $sql_where = ", created_by = '" . $GLOBALS["employee_id"] . "', created = '".date(DATEFORMAT_LONG) . "'";
  } else {
    $sql = "UPDATE";
    $sql_where = ", modified_by = '" . $GLOBALS["employee_id"] . "', modified = '".date(DATEFORMAT_LONG) . "'
					  WHERE recordID = $int_current_price";

  }
  $sql .= " pricing SET amount = '$flt_amount',
 						  currencyid = '$int_currency_id',
						  ContactID = '$int_contact_id', 
						  productID = '$int_productID', 
						  start_number = '$min_quantity',
						  end_number = '$max_quantity', 
						  start_date = '$start_date' ";
  if ($end_date) $sql .= ", end_date = '$end_date'";

  //echo $sql.$sql_where;
  $db_iwex->query($sql.$sql_where);

  return $int_current_price ? $int_current_price : $db_iwex->lastinserted();
}

/**
 * Function     : CalculateSalesPriceWithMargin
 * Will return the salesprice based on margin over the purchase_price
 * Input        : int_productID
 * Returns    : sales price
 **/
Function CalculateSalesPriceWithMargin($int_productID,
    $int_number_of_units,
    $flt_margin,
    $str_start_date = FALSE,
    $int_currency_id = DB_CURRENCY_DEFAULT) {
  $amount = FALSE;
  $purchase_price = GetProductCost($int_productID,
      $int_number_of_units,
      $str_start_date,
      $int_currency_id);

  // Margin = ($flt_price / $Purchase_price) - 1
  // margin * purchase_price = $flt_price - purchase_price
  // margin * purchase_price + purchase_price = flt_price
  if ($purchase_price) { // Only calculate margin when there is a purchase_price
    $amount = str_replace("%", "", $flt_margin)/100 * $purchase_price + $purchase_price;
  //echo "$amount = ".str_replace("%", "", $_POST["margin_new"])." * $purchase_price + $purchase_price";
  } else {
    echo "Price of product $int_productID can not be calculate. No purchase price.";
  }

  return $amount;
}
?>