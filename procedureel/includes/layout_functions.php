<?

define('THUMBNAIL_SIZE', 30);
define('THUMBS_DIR','thumbs/');

/*********************************************************
 * Function     : makelistbox
 * will return text string for desired listbox
 * Input        : sql: sql to produce list from. Or array.
 *                name: Name of the inputfield in form
 *                idfield: key of lookuptable
 *                displayfield: what to display from lookuptable
 *	       		  bl_enabled
 *				  bl_value_as_id: if you used a array. This wil set the value as id.
 * Returns      : html code containg complete listbox
 *********************************************************/

function makelistbox($sqlstr_array, 
    $name,
    $idfield = '',
    $displayfield = '',
    $default='',
    $formname='',
    $onChange='',
    $bl_disabled=FALSE,
    $bl_value_as_id= FALSE,
    $bl_addEmpty = TRUE) {
  $bl_array = FALSE;
  $edit_this = $bl_disabled ? ' DISABLED ' : '' ;
  $str = "<select name='$name' $edit_this " ;
  $DB_iwex = new DB();
  if ( $onChange ) {
    $str .= "onChange='$onChange'";

  }
  if (is_array($sqlstr_array)) {
    $bl_array = TRUE;
  }
  if($bl_addEmpty) {
    $str .= '><option value="">-</option>'."\n";
  } else {
    $str .= '>'."\n";
  }

  if (!$bl_array) {
    $resultdrop = $DB_iwex->query($sqlstr_array);

    while ($obj = mysql_fetch_object($resultdrop)) {
      $str .= '<option ';
      if ($obj->$idfield==$default) {
        $str .= 'value='.$obj->$idfield.' selected>'.$obj->$displayfield;
      }
      else {
        $str .= 'value='.$obj->$idfield.'>'.$obj->$displayfield;
      }
      $str .= '</option>'."\n";
    } // end while
  } else {
    foreach ($sqlstr_array As $str_id => $str_value) {
      if ($bl_value_as_id) {
        $str_id = $str_value;
      }
      $str .= '<option ';
      if ($str_id==$default) {
        $str .= "value='" . $str_id . "' selected>" . $str_value;
      }
      else {
        $str .= "value='" . $str_id . "'>" . $str_value;
      }
      $str .= '</option>'."\n";
    }
  }

  $str .= '</select>'."\n";


  return $str;
}
/*
 * Function     : makebutton
 * will return a button type button with data content in hidden field
 * Input        : str_name: name of the button
 *                str_button_text : text to display
 *                formname : name of the form
 *				        use_update_var:  use the standard update_var default FALSE,
 *				        bl_disabled: disabled, default FALSE
 * Returns      : html code containg complete button + hidden field
**/

function makebutton($str_name,
    $str_button_text,
    $formname,
    $use_update_var=FALSE,
    $bl_disabled=FALSE,
    $bl_toggle=FALSE) {
  $return_str = "";
  if ($str_name
      && $formname) {
    $str_value = "true";
    if ($bl_toggle
        &&
        GetSetFormVar("$str_name")=='true') {
      $str_button_text = "undo $str_button_text";
      $str_value = "false";
    }

    //enabled ??
    $edit_this = $bl_disabled ? ' DISABLED ' : '' ;

    $return_str = "<input type=hidden name='$str_name' value=''>";
    $return_str .= "<INPUT $edit_this TYPE='button' NAME='button' VALUE='$str_button_text'
				onclick='document.$formname.$str_name.value=\"$str_value\";";
    // use update_var field to update mainscreen ??
    if ($use_update_var) $return_str .= "document.$formname.update_var.value=\"1\";";

    $return_str .= "document.$formname.submit();'>";
  } else {
    $return_str = "button call false: " . $str_name . $formname;
  }
  return $return_str;
}

/*********************************************************
 * Function     : show_table
 * will display the query in a nice new windows
 * Input        : sql: sql to produce list from
 * Returns      : return_string:containing the table, true or false
 *********************************************************/
function show_table($str_sql,
    $bl_count=FALSE,
    $DB_instance=FALSE) {
  global $db_iwex;
  $return_string = "";

  // When DB is defined use that one.
  if ($DB_instance) {
    $result = $DB_instance->query($str_sql);
  } else { // Use the default global defined version.
    $result = $db_iwex->query($str_sql);
  }
  //$resultsearch = mysql_query($sqlstr)
  //    or die("<br>Ongeldige show table query: <br>" .$sqlstr. mysql_error());
  $numbersearch = mysql_Numrows($result);

  if ($numbersearch) {
    if ($bl_count) $return_string .= "$numbersearch records retrieved";
    $return_string .= "<table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\" width=\"100%\">";

    $return_string .= "<tr>\n";
    for ($i = 0; $i < mysql_num_fields($result); $i++) {
      $return_string .= '<th>';
      $return_string .= mysql_field_name($result, $i);
      $return_string .= "</th>";
    }
    $return_string .= "</tr>\n";

    $x=0;
    while($row = mysql_fetch_row($result)) {
      if (($x%2)==0) { $bgcolor=WHITE_LINE_BGCOLOR; } else { $bgcolor=LIGHTBLUE_LINE_BGCOLOR; }
      $return_string .= "<tr bgcolor=$bgcolor>";
      foreach($row as $key => $value) {
        $meta = mysql_fetch_field($result,$key);
        if (!$meta) { // what if there is no meta info on the field??
        }

        // Right align the number fields;
        if (is_numeric($value)) {
          $align = "align=\"right\"";
        } else {
          $align = "";
        }
        //if field is productid field hyperlink it to productmanintenance
        If ($meta->name == "ID") {
          $return_string .=  "<td $align><a target='new' href=\"". PRODUCT_MAINT . "?productid$value\">$value</a></td>";
        } else If ($meta->name == "Tracking"&&$value) {
            $return_string .=  "<td $align>".createtrackinglink($value,'')."</a></td>";
          } else If ($meta->name == "mailingref") {
              $return_string .=  "<td $align><a href=" . $_SERVER['PHP_SELF'] . "?action=edit&mailingref=$value>$value</a></a></td>";
              //remember the mailing ref
              $mailingref = $value;
            } else If ($meta->name == "select") {
                $return_string .=  "<td $align><a href=" . $_SERVER['PHP_SELF'] . "?action=query&mailingref=$mailingref>$value</a></a></td>";
              } else if ($value) {
                  $return_string .=  "<td $align>$value</td>";
                } else {
                  $return_string .=  "<td align=\"center\">-</td>";
                }
      }
      $return_string .= "</tr> \n";
      $x++;
    }
    $return_string .= "</table>";
  } else {
    $return_string = "<p>Geen gegevens.</p>";
  }

  mysql_free_result($result);

  RETURN $return_string;
}

/*********************************************************
 * Function     : MakeCheckbox
 * Will create a checkbox
 * Input        : name: The name of the checkbox
 *                checked: TRUE when checkbox is checked
 *                enabled: TRUE when this box can be used.
 *                text: Onmouse over text.
 * Returns      : checkbox string.
 *********************************************************/
function MakeCheckbox($str_name, 
    $bl_checked,
    $bl_enabled = TRUE,
    $text=FALSE,
    $formname='',
    $auto_submit=FALSE) {
  $str_return = "<input type=\"checkbox\" name=\"$str_name\"";
  if ($bl_checked) $str_return .=" checked ";
  if (!$bl_enabled) $str_return .=" DISABLED ";
  if ($text) $str_return .= ShowOnMouseOverText($text);
  if ($formname && $auto_submit) $str_return .= "onclick=\"document.$formname.submit();\"";
  $str_return .=">";

  return $str_return;
}

/*********************************************************
 * Function     : GetCheckbox
 * Get the result of a checkbox
 * Input        : name: The name of the checkbox
 *                POST: TRUE when form methode is POST,
 *                     FALSE for GET.
 * Returns      : TRUE, when checkbox is cecked.
 *********************************************************/
function GetCheckbox($str_name, $bl_post = TRUE) {
  $bl_return = FALSE;
  if ($bl_post) {
    $bl_return = isset($_POST[$str_name]) && $_POST[$str_name] == 'on';
  } else {
    $bl_return = isset($_GET[$str_name]) && $_GET[$str_name] == 'on';
  }

  return (int) $bl_return;
}

/*********************************************************
 * Function     : MakeProductState_rowcolor
 * Make the correct bgcolor for this product.
 * Input        : bl_discont: is the product discontinued.
 *                int_stock: current stock.
 *                bl_pricelist: is the product on the pricelist
 * Returns      : The bgcollor int the right color.
 *********************************************************/
function MakeProductState_rowcolor($bl_discont, $int_stock, $bl_pricelist) {
  $str_return = "";
  if ($bl_discont) { // Old products have a bad product collor.
    if ($int_stock > 0) {
      $str_return = " bgcolor=\"".EOLPRODUCT_ONSTOCK_BGCOLOR."\"";
    } else {
      $str_return = " bgcolor=\"".EOLPRODUCT_BGCOLOR."\"";
    }
  } else if (!$bl_pricelist) {
      $str_return = " bgcolor=\"".PRODUCT_NOT_ONPRICELIST."\"";
    }

  return  $str_return;
}

/*********************************************************
 * Function     : print_turnover_graph
 * return a string containing a graph of the turnover.
 * Input        : ContactID; optional, to get turnover of just this customer
 * Returns      : formatted String
 *********************************************************/
function print_turnover_graph($ContactID=FALSE) {
  global $db_iwex;
  $flt_sum = 0;
  $flt_sum_last = 0;
  $flt_sum_last_total = 0;
  $values = FALSE;
  $contact_condition = FALSE;

  $current_yr = date("Y");
  $year = array($current_yr-2,$current_yr-1,$current_yr);
  $month = array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");

  //var_dump($month);
  if ($ContactID) {
    $ary_own_branch = GetBranches($ContactID);
    $ary_own_branch[] = $ContactID;
    if (count($ary_own_branch) > 1) echo "Omzet van dochters meegenomen in grafiek!";
    $contact_condition = " AND (CustomerID = ". implode(" OR CustomerID = ", $ary_own_branch).")";
  } else {
    $ary_own_branch = GetBranches(OWN_COMPANYID);
    if (count($ary_own_branch) > 0) {
      echo "Omzet van dochters <b>NIET</b> meegenomen in grafiek!";
      $contact_condition = " AND CustomerID != ". implode(" AND CustomerID != ", $ary_own_branch);
    }
  }

  foreach ($year as $yr) {
    ${'sql'.$yr} = "SELECT months.month as m, DATE_FORMAT(Invoice_date,'%b') as month,
        DATE_FORMAT(Invoice_date,'%c') as month_nr, Sum(invoices.Invoice_total) AS total_ex, 
        Sum(invoices.Invoice_BTW) AS total_btw, Sum(Invoice_total+Invoice_BTW) AS total
        FROM months 
        LEFT JOIN invoices on months.month = DATE_FORMAT(invoices.Invoice_date,'%c') 
            AND invoices.Invoice_date >= '".$yr."-01-01' And 
            invoices.Invoice_date <= '".$yr."-12-31'
        $contact_condition
        GROUP BY months.month 
        Order by months.month;";

    //echo ${'sql'.$yr};
    $result = $db_iwex->query(${'sql'.$yr});
    if ($result) {
      while ($obj = mysql_fetch_object($result)) {
        $obj->total_ex = $obj->total_ex ? $obj->total_ex : 0;
        if (isset($values[$obj->m])) {
          $separator = ";";
          $values[$obj->m] .= $separator . $obj->total_ex ;
        } else {
          $values[$obj->m] = $obj->total_ex;
        }
        //calculate total of current year
        if ($yr==$current_yr) $flt_sum += $obj->total_ex;
        //        if ($yr==$current_yr-1 && ($obj->month_nr < date("m"))) $flt_sum_last += $obj->total_ex;
        if ($yr==$current_yr-1 ) $flt_sum_last_total += $obj->total_ex;
      }
    } else {
      echo $year . ": no data";
    }
  }
  //last year to date (now)
  $last_year = $current_yr-1;
  // without btw
  $sql_lastyear = "SELECT Sum(invoices.Invoice_total) AS total_ex
        FROM invoices
        WHERE invoices.Invoice_date >= '".$last_year."-01-01' And 
            invoices.Invoice_date <= '$last_year-".date("m-d")."'
      $contact_condition;";
  $flt_sum_last = GetField($sql_lastyear);
  // with btw
  $sql_lastyear_btw = "SELECT Sum(invoices.Invoice_total+invoices.Invoice_BTW) AS total
        FROM invoices
        WHERE invoices.Invoice_date >= '".$last_year."-01-01' And 
            invoices.Invoice_date <= '$last_year-".date("m-d")."'
      $contact_condition;";
  $flt_sum_last_btw = GetField($sql_lastyear_btw);
  // last year total ex btw
  $sql_lastyear_total = "SELECT Sum(invoices.Invoice_total) AS total_ex
        FROM invoices
        WHERE invoices.Invoice_date >= '".$last_year."-01-01' And 
            invoices.Invoice_date <= '$last_year-12-31'
      $contact_condition;";
  $flt_sum_last_total = GetField($sql_lastyear_total);
  // incl btw
  $sql_lastyear_total_btw = "SELECT Sum(invoices.Invoice_total+invoices.Invoice_BTW) AS total
        FROM invoices
        WHERE invoices.Invoice_date >= '".$last_year."-01-01' And 
            invoices.Invoice_date <= '$last_year-12-31'
      $contact_condition;";
  $flt_sum_last_total_btw = GetField($sql_lastyear_total_btw);

  if ($values) {
  // now start the graph
    $graph = new BAR_GRAPH("hBar");
    $graph->values = implode(" , ", $values);
    $graph->labels = implode(" , ", $month);
    $graph->showValues = 2;
    $graph->barWidth = 10;
    $graph->absValuesSize = 9;
    $graph->absValuesPrefix = "&euro ";
    $graph->legend = implode(" , ", $year);
    $graph->charts = 2;
    echo $graph->create();
    if ($flt_sum_last) $turnover_growth = (($flt_sum / $flt_sum_last) - 1)*100;
    $expected_turnover = $flt_sum_last_total * (1 + ($turnover_growth / 100));
    $expected_turnover_btw = $flt_sum_last_total_btw * (1 + ($turnover_growth / 100));
    echo "<TABLE>";
    echo "<TR>\n<TD></TD><TH>" . ($current_yr - 1) . "</TH><TH>" . ($current_yr) . "</TH><TH>groei %</TH></TR>";
    echo "<TR><TH>year-to-date excl. BTW</TH><TD ALIGN='right'> &euro; ".ToDutchNumber($flt_sum_last)."</TD>";
    echo "<TD ALIGN='right'>&euro; ".ToDutchNumber($flt_sum)."</TD>";
    echo "<TD ALIGN='right'>" . (ToDutchNumber($turnover_growth)) . " %</TD></TR>\n";
    echo "<TR><TH>Totaal excl. BTW</TH><TD ALIGN='right'> &euro; ".ToDutchNumber($flt_sum_last_total)."</TD>";
    echo "<TD ALIGN='right'>&euro; " . (ToDutchNumber($expected_turnover)) . "</TD><TD></TD></TR>";
    echo "<TR><TH>Totaal incl. BTW</TH><TD ALIGN='right'> &euro; ".ToDutchNumber($flt_sum_last_total_btw)."</TD>";
    echo "<TD ALIGN='right'>&euro; " . (ToDutchNumber($expected_turnover_btw)) . "</TD><TD></TD></TR>";
    echo "</TABLE>";
  } else {
    echo "Geen omzet gegevens....";
  }
}


/*********************************************************
 * Function     : print_margin_graph
 * return a string containing a graph of the margin.
 * Input        : ContactID; optional, to get margin of just this customer
 * Returns      : formatted String
 *********************************************************/
function print_margin_graph($ContactID=FALSE) {
  global $db_iwex;
  $flt_sum = 0;
  $flt_sum_last = 0;
  $flt_sum_last_total = 0;
  $values = FALSE;
  $contact_condition = FALSE;

  $current_yr = date("Y");
  $year = array($current_yr-1,$current_yr);
  $month = array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");

  //var_dump($month);
  if ($ContactID) {
    $ary_own_branch = GetBranches($ContactID);
    $ary_own_branch[] = $ContactID;
    if (count($ary_own_branch) > 1) echo "Marge van dochters meegenomen in grafiek!";
    $invoice_contact_condition = " AND (invoices.CustomerID = ". implode(" OR invoices.CustomerID = ", $ary_own_branch).")";
    $order_contact_condition = " AND (orders.ContactID = ". implode(" OR orders.ContactID = ", $ary_own_branch).")";
  } else {
    $ary_own_branch = GetBranches(OWN_COMPANYID);
    if (count($ary_own_branch) > 0) {
      echo "Marge van dochters <b>NIET</b> meegenomen in grafiek!";
      $invoice_contact_condition = " AND invoices.CustomerID != ". implode(" AND invoices.CustomerID != ", $ary_own_branch);
      $order_contact_condition = " AND orders.ContactID != ". implode(" AND orders.ContactID != ", $ary_own_branch);
    }
  }

  foreach ($year as $yr) {
    ${'sql'.$yr} = "SELECT
						months.month as m,
						DATE_FORMAT(orders.orderdate,'%b') as month,
						MONTH(orders.orderdate) as month_nr,
						ROUND(sum((UnitsSold)*(order_details.UnitPrice+cost_percentage-UnitCost)),2) as marge
					FROM months
					LEFT JOIN orders ON MONTH(orders.OrderDate) = months.month
						AND confirmed_yn
						AND NOT rma_yn
						AND YEAR(orders.OrderDate) = '$yr'
        $order_contact_condition
					LEFT JOIN order_details ON orders.OrderID = order_details.OrderID
						AND UnitCost
						AND (Quantity-to_deliver)
					LEFT JOIN contacts ON contacts.ContactID = orders.ContactID					
					LEFT JOIN inventory_transactions ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID
					GROUP BY m
					ORDER BY m";

    //echo "<br><br>" . ${'sql'.$yr};
    $result = $db_iwex->query(${'sql'.$yr});
    if ($result) {
      while ($obj = mysql_fetch_object($result)) {
        $obj->marge = $obj->marge ? $obj->marge : 0;
        if (isset($values[$obj->m])) {
          $separator = ";";
          $values[$obj->m] .= $separator . $obj->marge ;
        } else {
          $values[$obj->m] = $obj->marge;
        }
        //calculate total of current year
        if ($yr==$current_yr) $flt_sum += $obj->marge;
        // if it's last year, then add to last year
        if ($yr==$current_yr-1 ) $flt_sum_last_total += $obj->marge;
      }
    } else {
      echo $year . ": no data";
    }
  }

  //last year to date (now)
  $last_year = $current_yr-1;
  // without btw
  $sql_lastyear = "SELECT
						ROUND(sum((Quantity-to_deliver)*(UnitPrice+cost_percentage-UnitCost)),2) as marge
						FROM order_details
						INNER JOIN orders on orders.OrderID = order_details.OrderID
						WHERE order_details.stock_owner_id=802 
							AND UnitCost
							AND confirmed_yn
							AND NOT administration_order
							AND NOT rma_yn
							AND orders.OrderDate >= '".$last_year."-01-01' 
							AND orders.OrderDate <= '$last_year-".date("m-d")."'
							AND (Quantity-to_deliver)
      $order_contact_condition;";
  $flt_sum_last = GetField($sql_lastyear);

  //echo "<BR><BR><pre>" . print_r($values) . "</pre>";
  if ($values) {
  // now start the graph
    $graph = new BAR_GRAPH("hBar");
    $graph->values = implode(" , ", $values);
    $graph->labels = implode(" , ", $month);
    $graph->showValues = 2;
    $graph->absValuesSize = 9;
    $graph->absValuesPrefix = "&euro ";
    $graph->percValuesDecimals = 2;
    $graph->barWidth = 8;
    $graph->barLength = 1.5;
    //$graph->barBorder = "1px solid red";
    $graph->legend = implode(" , ", $year);
    //$graph->charts = 2;
    echo $graph->create();
    if ($flt_sum_last) $margin_growth = (($flt_sum / $flt_sum_last) - 1)*100;
    $expected_margin = $flt_sum_last_total * (1 + ($margin_growth / 100));
    echo "<TABLE>";
    echo "<TR>\n<TD></TD><TH>" . ($current_yr - 1) . "</TH><TH>" . ($current_yr) . "</TH><TH>groei %</TH></TR>";
    echo "<TR><TH>year-to-date excl. BTW</TH><TD ALIGN='right'> &euro; ".ToDutchNumber($flt_sum_last)."</TD>";
    echo "<TD ALIGN='right'>&euro; ".ToDutchNumber($flt_sum)."</TD>";
    echo "<TD ALIGN='right'>" . (ToDutchNumber($margin_growth)) . " %</TD></TR>\n";
    echo "<TR><TH>Totaal excl. BTW</TH><TD ALIGN='right'> &euro; ".ToDutchNumber($flt_sum_last_total)."</TD>";
    echo "<TD ALIGN='right'>&euro; " . (ToDutchNumber($expected_margin)) . "</TD><TD></TD></TR>";
    echo "</TABLE>";
  } else {
    echo "Geen omzet gegevens....";
  }
}

/*********************************************************
 * Function     : ShowImage
 * display an image out of the default image dir or display a placeholder if there is none.
 * Input        : ProductID, size
 *                int_extension_type, type of the extension.
 * Returns      : formatted String
 *********************************************************/
function ShowImage($int_productID,$size='', $int_extension_type = false) {
  global $arr_image_extension;
  $returnvar = '';

  $js_upload_img = "onclick=\"window.open('" . upload_popup . "?Filename=$int_productID','upload popup','toolbar=0,menubar=0,resizable=0,scrollbars=0,status=0,width=400,height=200,left=60,top=25')\"";

  $str_thumb_ext = FALSE;
  $str_file_ext = FALSE;

  $int_arr_type = $int_extension_type ? $int_extension_type : GetField("SELECT image FROM current_product_list WHERE ProductID = '$int_productID'");

  if ($int_arr_type) {
    $fullname = img_root.$int_productID.'.'.$arr_image_extension[$int_arr_type];
    $thumb_fullname = img_root.THUMBS_DIR.$int_productID.'.'.$arr_image_extension[$int_arr_type];

    if (file_exists($fullname)) {
      $str_file_ext = $arr_image_extension[$int_arr_type];
      if (file_exists($thumb_fullname)) {
        $str_thumb_ext = $arr_image_extension[$int_arr_type];
      } else {
        if (thumb ( $fullname, img_root.THUMBS_DIR, 30)) $str_thumb_ext = $arr_image_extension[$int_arr_type];
      }
    } else if (!$int_extension_type) {
      // now update the table it's not there
        update_image_link($int_productID, $arr_image_extension[$int_arr_type], FALSE);
      }
  } else foreach($arr_image_extension as $extension) {
      $fullname = img_root.$int_productID.'.'.$extension;
      $thumb_fullname = img_root.THUMBS_DIR.$int_productID.'.'.$extension;
      $str_thumb_ext = '';
      $str_file_ext = '';
      if (file_exists($fullname)) {
        $str_file_ext = $extension;
        // update the table it's there
        update_image_link($int_productID, $extension, TRUE);
        if (file_exists($thumb_fullname)) {
          $str_thumb_ext = $extension;
        } else {
          if (thumb ( $fullname, img_root.THUMBS_DIR, $size=30, $pre_name="" )) $str_thumb_ext = $extension;
        }
        break;
      }
    }

  if ($size <= THUMBNAIL_SIZE*2 && $size) {
    if ($str_thumb_ext) {
      $returnvar = "<a href=\"".PRODUCTS_IMAGES_URL."$int_productID.$str_file_ext\" target='_new'><img src=\"".PRODUCTS_IMAGES_URL.THUMBS_DIR."$int_productID.$str_thumb_ext\" width=\"$size\" alt=\"$int_productID\" border=0></a>";
    } else {
      $returnvar = "<img src=\"".PRODUCTS_IMAGES_URL.THUMBS_DIR."nothing.jpg\" width=\"$size\" alt=\"$int_productID\" ".$js_upload_img.">";
    }
  } else {
    $width = "";
    if ($size) $width = "WIDTH='$size'";
    if ($str_file_ext) {
      $returnvar = "<a href=\"".PRODUCTS_IMAGES_URL."$int_productID.$str_file_ext\" target='_new'><img src=\"".PRODUCTS_IMAGES_URL."$int_productID.$str_file_ext\" $width alt=\"$int_productID\" border=0></a>";
    } else {
      $returnvar = "<img src=\"".PRODUCTS_IMAGES_URL."nothing.jpg\" $width alt=\"$int_productID\" ".$js_upload_img.">";
    }
  }

  return $returnvar;
}

/*********************************************************
 * Function     : ShowStock
 * display the politically correct stock
 * Input        : Integer
 * Returns      : corrected stock
 *********************************************************/
function ShowStock($int_ProductID) {
  $int_freestock = getfreestock($int_ProductID);

  //make sure it's not negative
  $int_freestock = $int_freestock < 0 ? 0 : $int_freestock;

  // don't show anything over the 'max_stock_show'
  if($int_freestock > max_stock_show) {
    $int_freestock = max_stock_show;
  } else {
    $int_freestock = $int_freestock;
  }

  return $int_freestock;
}

/**
 * Function     : FormatDescription
 * display the profile
 * Input        :
 * Returns      : string containing profile
 **/
Function FormatDescription($str_description) {
  $return_var = '';

  if ($str_description) {
    $return_var = str_replace('src="/images/', 'src="'.IMAGES_URL, $str_description);
  }

  Return $return_var;
}

/**
 * Function     : AddEditorScript
 * Add the javascript for the HTML edtior
 * Input        : $str_textareaName
 *		$bl_toggle allow toggle-ing default TRUE, if False always advanced
 * Returns      : string containing the script
 **/
Function AddEditorScript($str_textareaName,
    $bl_toggle = TRUE) {
  $return_var = "";
  if ($str_textareaName) {
    $bl_advanced = GetSetFormVar('advanced', TRUE, TRUE) == 'advanced';
    if (!$bl_advanced
        &&
        $bl_toggle) {
      $return_var .= "<INPUT TYPE=\"submit\" NAME=\"advanced\" VALUE=\"advanced\" CLASS=\"button\">\n";
    } else {
    //only show button if you can toggle
      if ($bl_toggle) $return_var .= "<INPUT TYPE=\"submit\" NAME=\"advanced\" VALUE=\"simple\" CLASS=\"button\">\n";
      $return_var .= "
  			<script language=\"javascript\" type=\"text/javascript\" src=\"/tinymce/jscripts/tiny_mce/tiny_mce.js\"></script>
  				<script language=\"javascript\" type=\"text/javascript\">
  				tinyMCE.init({
  					theme_advanced_buttons2 : \"forecolor,backcolor,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,code,hr,removeformat,visualaid,separator,sub,sup,separator,charmap\",
  					theme_advanced_buttons3 : \"\",
  					theme_advanced_toolbar_location : \"top\",
					table_inline_editing : \"true\",
  					width : \"100%\",
  					height : \"400\",
  					mode : \"textareas\",
					valid_elements : \"\"
						+\"a[accesskey|charset|class|coords|dir<ltr?rtl|href|hreflang|id|lang|name\"
						  +\"|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rel|rev\"
						  +\"|shape<circle?default?poly?rect|style|tabindex|title|target|type],\"
						+\"abbr[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"acronym[class|dir<ltr?rtl|id|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"address[class|align|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"applet[align<bottom?left?middle?right?top|alt|archive|class|code|codebase\"
						  +\"|height|hspace|id|name|object|style|title|vspace|width],\"
						+\"area[accesskey|alt|class|coords|dir<ltr?rtl|href|id|lang|nohref<nohref\"
						  +\"|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup\"
						  +\"|shape<circle?default?poly?rect|style|tabindex|title|target],\"
						+\"base[href|target],\"
						+\"basefont[color|face|id|size],\"
						+\"bdo[class|dir<ltr?rtl|id|lang|style|title],\"
						+\"big[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"blockquote[dir|style|cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick\"
						  +\"|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout\"
						  +\"|onmouseover|onmouseup|style|title],\"
						+\"body[alink|background|bgcolor|class|dir<ltr?rtl|id|lang|link|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onload|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|onunload|style|title|text|vlink],\"
						+\"br[class|clear<all?left?none?right|id|style|title],\"
						+\"button[accesskey|class|dir<ltr?rtl|disabled<disabled|id|lang|name|onblur\"
						  +\"|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown\"
						  +\"|onmousemove|onmouseout|onmouseover|onmouseup|style|tabindex|title|type\"
						  +\"|value],\"
						+\"caption[align<bottom?left?right?top|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"center[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"cite[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"code[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"col[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id\"
						  +\"|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown\"
						  +\"|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title\"
						  +\"|valign<baseline?bottom?middle?top|width],\"
						+\"colgroup[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl\"
						  +\"|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown\"
						  +\"|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title\"
						  +\"|valign<baseline?bottom?middle?top|width],\"
						+\"dd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"del[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"dfn[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"dir[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"div[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"dl[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"dt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"em/i[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"fieldset[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"font[class|color|dir<ltr?rtl|face|id|lang|size|style|title],\"
						+\"form[accept|accept-charset|action|class|dir<ltr?rtl|enctype|id|lang\"
						  +\"|method<get?post|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onreset|onsubmit\"
						  +\"|style|title|target],\"
						+\"frame[class|frameborder|id|longdesc|marginheight|marginwidth|name\"
						  +\"|noresize<noresize|scrolling<auto?no?yes|src|style|title],\"
						+\"frameset[class|cols|id|onload|onunload|rows|style|title],\"
						+\"h1[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"h2[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"h3[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"h4[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"h5[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"h6[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"head[dir<ltr?rtl|lang|profile],\"
						+\"hr[align<center?left?right|class|dir<ltr?rtl|id|lang|noshade<noshade|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|size|style|title|width],\"
						+\"html[dir<ltr?rtl|lang|version],\"
						+\"iframe[align<bottom?left?middle?right?top|class|frameborder|height|id\"
						  +\"|longdesc|marginheight|marginwidth|name|scrolling<auto?no?yes|src|style\"
						  +\"|title|width],\"
						+\"img[align<bottom?left?middle?right?top|alt|border|class|dir<ltr?rtl|height\"
						  +\"|hspace|id|ismap<ismap|lang|longdesc|name|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|src|style|title|usemap|vspace|width],\"
						+\"input[accept|accesskey|align<bottom?left?middle?right?top|alt\"
						  +\"|checked<checked|class|dir<ltr?rtl|disabled<disabled|id|ismap<ismap|lang\"
						  +\"|maxlength|name|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onselect\"
						  +\"|readonly<readonly|size|src|style|tabindex|title\"
						  +\"|type<button?checkbox?file?hidden?image?password?radio?reset?submit?text\"
						  +\"|usemap|value],\"
						+\"ins[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"isindex[class|dir<ltr?rtl|id|lang|prompt|style|title],\"
						+\"kbd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"label[accesskey|class|dir<ltr?rtl|for|id|lang|onblur|onclick|ondblclick\"
						  +\"|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout\"
						  +\"|onmouseover|onmouseup|style|title],\"
						+\"legend[align<bottom?left?right?top|accesskey|class|dir<ltr?rtl|id|lang\"
						  +\"|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"li[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|type\"
						  +\"|value],\"
						+\"link[charset|class|dir<ltr?rtl|href|hreflang|id|lang|media|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|rel|rev|style|title|target|type],\"
						+\"map[class|dir<ltr?rtl|id|lang|name|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"menu[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"meta[content|dir<ltr?rtl|http-equiv|lang|name|scheme],\"
						+\"noframes[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"noscript[class|dir<ltr?rtl|id|lang|style|title],\"
						+\"object[align<bottom?left?middle?right?top|archive|border|class|classid\"
						  +\"|codebase|codetype|data|declare|dir<ltr?rtl|height|hspace|id|lang|name\"
						  +\"|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|standby|style|tabindex|title|type|usemap\"
						  +\"|vspace|width],\"
						+\"ol[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|start|style|title|type],\"
						+\"optgroup[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"option[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick|ondblclick\"
						  +\"|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout\"
						  +\"|onmouseover|onmouseup|selected<selected|style|title|value],\"
						+\"p[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"param[id|name|type|value|valuetype<DATA?OBJECT?REF],\"
						+\"pre/listing/plaintext/xmp[align|class|dir<ltr?rtl|id|lang|onclick|ondblclick\"
						  +\"|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout\"
						  +\"|onmouseover|onmouseup|style|title|width],\"
						+\"q[cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"s[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"samp[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"script[charset|defer|language|src|type],\"
						+\"select[class|dir<ltr?rtl|disabled<disabled|id|lang|multiple<multiple|name\"
						  +\"|onblur|onchange|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|size|style\"
						  +\"|tabindex|title],\"
						+\"small[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"span[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"strike[class|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title],\"
						+\"strong/b[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"style[dir<ltr?rtl|lang|media|title|type],\"
						+\"sub[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"sup[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title],\"
						+\"table[align<center?left?right|bgcolor|border|cellpadding|cellspacing|class\"
						  +\"|dir<ltr?rtl|frame|height|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rules\"
						  +\"|style|summary|title|width],\"
						+\"tbody[align<center?char?justify?left?right|char|class|charoff|dir<ltr?rtl|id\"
						  +\"|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown\"
						  +\"|onmousemove|onmouseout|onmouseover|onmouseup|style|title\"
						  +\"|valign<baseline?bottom?middle?top],\"
						+\"td[abbr|align<center?char?justify?left?right|axis|bgcolor|char|charoff|class\"
						  +\"|colspan|dir<ltr?rtl|headers|height|id|lang|nowrap<nowrap|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup\"
						  +\"|style|title|valign<baseline?bottom?middle?top|width],\"
						+\"textarea[accesskey|class|cols|dir<ltr?rtl|disabled<disabled|id|lang|name\"
						  +\"|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onselect\"
						  +\"|readonly<readonly|rows|style|tabindex|title],\"
						+\"tfoot[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id\"
						  +\"|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown\"
						  +\"|onmousemove|onmouseout|onmouseover|onmouseup|style|title\"
						  +\"|valign<baseline?bottom?middle?top],\"
						+\"th[abbr|align<center?char?justify?left?right|axis|bgcolor|char|charoff|class\"
						  +\"|colspan|dir<ltr?rtl|headers|height|id|lang|nowrap<nowrap|onclick\"
						  +\"|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove\"
						  +\"|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup\"
						  +\"|style|title|valign<baseline?bottom?middle?top|width],\"
						+\"thead[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id\"
						  +\"|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown\"
						  +\"|onmousemove|onmouseout|onmouseover|onmouseup|style|title\"
						  +\"|valign<baseline?bottom?middle?top],\"
						+\"title[dir<ltr?rtl|lang],\"
						+\"tr[abbr|align<center?char?justify?left?right|bgcolor|char|charoff|class\"
						  +\"|rowspan|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title|valign<baseline?bottom?middle?top],\"
						+\"tt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"u[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup\"
						  +\"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],\"
						+\"ul[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown\"
						  +\"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover\"
						  +\"|onmouseup|style|title|type],\"
						+\"var[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress\"
						  +\"|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style\"
						  +\"|title]\"
  				}); </script>";
    }
  }
  Return $return_var;
}

/**
 * Function     : ScreenRenewInterval
 * Add the javascript that will renew the screen
 * Input        : $str_formname, the form name
 *                $int_sec, the refresh time is seconds.
 * Returns      : string containing the script
 **/
Function ScreenRenewInterval($str_formname,
    $int_sec) {
  return "<script TYPE='text/javascript' language='JavaScript'>
		var mailtimerID;
		
		function refreshform() {
			document.$str_formname.submit();
		}
		
		mailtimerID = setTimeout('refreshform()',1000*$int_sec);
		</script>";
}

/**
 * Function     : ChoseNumberBox
 * will return text string for desired listbox
 * Input        : name: Name of the inputfield in form
 *                max_num: Last number in the list.
 *                selected: number to select must be <= max_num
 *                bl_new: When true a new number is shown.
 *                tabindex, tabindex to use, default none.
 * Returns      : html code containg complete listbox
 **/
function ChoseNumberBox($str_name,
    $int_max_num,
    $int_selected,
    $bl_new = FALSE,
    $int_tabindex = FALSE) {
  if ($int_max_num < 1 || $int_max_num < $int_selected) {
    return "ChoseNumberBox called with max = $int_max_num and selected $int_selected. Which is invalid.";
  }

  $str = '<select name="'.$str_name.'"';
  if ($int_tabindex) $str .= " tabindex=$int_tabindex";
  $str .=">\n";
  //$str .= '<option value="">-</option>'."\n";

  for ($i = 1; $i<=$int_max_num; $i++) {
    $str .= '<option ';
    if ($i == $int_selected) {
      $str .= "value='$i' selected>$i";
    }
    else {
      $str .= "value='$i'>$i";
    }
    $str .= "</option>\n";
  } // end for

  if ($bl_new) {
    $str .= "<option value='$i'>+$i</option>\n";
  }

  $str .= "</select>\n";
  return $str;
}

/*
 * Function     : create_row
 * creates a row with productinfo: name >> value1 >> value2 >> value3
 * Input        : name (title), prod_x, prod_y, prod_z (values), bg (background color), achtervoegsel
 * Returns      : echos
 */
function create_row($size, $name, $prod_x, $prod_y, $prod_z, $bg='1', $achtervoegsel="") {
  $str_return = "";
  if($bg == 1) {
    $str_return = "<TR BGCOLOR=\"#FFFFFF\">\n";
  }else {
    $str_return = "<TR BGCOLOR=\"#D0D4EE\">\n";
  }
  $str_return .= "    <TD VALIGN=\"top\"><B>".$name."</B></TD>\n";
  if($size>=1) {
    $str_return .= "    <TD VALIGN=\"top\">".$prod_x." ".$achtervoegsel."</TD>\n";
  }
  if($size>=2) {
    $str_return .= "<TD VALIGN=\"top\">".$prod_y." ".$achtervoegsel."</TD>\n";
  }
  if($size>=3) {
    $str_return .= "<TD VALIGN=\"top\">".$prod_z." ".$achtervoegsel."</TD>\n";
  }
  $str_return .= "</TR>\n";
  return $str_return;

}

/*
 * Function     :  product_relations
 * print a table with all inventory transactions for the given product
 * Input        : ProductID: The id of the product.
 * Returns      : true
 */
Function product_relations($int_ProductID,$type) {
  $sql ='';
  $DB_iwex = new DB();
  $device_condition = '';
  $related_products = get_relations($int_ProductID,$type);

  if ($related_products) {
  //get the data
  //$query = $DB_iwex->query($sql);
  //echo $sql;

    echo '<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">'."\n";
    echo '<TR valign="top">'."\n";
    echo '<TR valign="top">'."\n";
    echo "    <TH class='cellinedetailplain'>ID</TH>";
    echo "    <TH class='cellinedetailplain'>Name</TH>";
    echo "    <TH class='cellinedetailplain'>Brand</TH>";
    echo "    <TH class='cellinedetailplain'>Img</TH>";
    echo "    <TH class='cellinedetailplain'>Del.</TH>";
    echo '</TR>'."\n";
    $str_exclude = "";
    foreach ($related_products as $relatedID) {
      if (!($relatedID == $int_ProductID) && $relatedID ) {
        echo '<TR valign="top">'."\n";
        echo "    <TD class='cellinedetailplain' WIDTH='50'>
                            <A HREF='". PRODUCT_MAINT . "?productid$relatedID' TARGET='_parent'>" . $relatedID . "</td>";
        echo "    <TD class='cellinedetailplain' WIDTH='300'>
                            <A HREF='".$_SERVER['HTTP_REFERER']."&productid=$relatedID' TARGET='_parent'>"
            . GetField('SELECT ProductName FROM current_product_list WHERE ProductID = '.$relatedID.'') . "</A></td>";
        echo "    <TD class=cellinedetailplain>". GetProductMerk(GetField('SELECT MerkID FROM current_product_list WHERE ProductID = '.$relatedID.'')) ."</td>";
        echo "    <TD class='cellinedetailplain'>". ShowImage($relatedID,'20') ."</TD>";
        echo "    <TD class='cellinedetailplain'><IMG SRC=".IMAGES_URL."delete.png WIDTH='10'
                            onclick=\"location.replace('".$_SERVER['PHP_SELF']."?parm1=$type&del=$type&delID=".$relatedID."')\"'
                            ></A></TD>";
        echo '</TR>'."\n";
      }
      if ($str_exclude) $str_exclude .= " AND ";
      $str_exclude .= " ProductID <> '$relatedID'";
    }
    if ($type == 'device') $device_condition = 'AND ' . Device_Category_Condition;
    if ($str_exclude) $str_exclude = " AND ( " . $str_exclude . " ) ";
    $Search_products = "SELECT productID as 'ID', ProductName AS 'Productnaam', Merk, Discontinued_yn AS EOL, NULL as '*'
            FROM current_product_list
            where (productID like '%".GETRECORDSEARCH."%' or ProductName like '%".GETRECORDSEARCH."%' or
            Productdescription like '%".GETRECORDSEARCH."%' or Merk like '%".GETRECORDSEARCH."%'
            OR ExternalID LIKE '%".GETRECORDSEARCH."%' OR EAN = '".GETRECORDSEARCH."')
            ".$device_condition . $str_exclude . " 
            ORDER BY 'Productnaam'";
    echo '<TR>'."\n";
    echo "<TD>&nbsp</TD>\n";
    echo '</TR>'."\n";
    echo '<TR valign="top">'."\n";
    echo "    <TH class='cellinedetailplain'>new ID</TH>";
    echo "    <TH class='cellinedetailplain'>Search</TH>";
    echo "    <TH class='cellinedetailplain'>Copy</TH>";
    echo "    <TH COLSPAN='2'</TH>";
    echo '</TR>'."\n";
    echo '<TR valign="top">'."\n";
    echo "    <TD class='cellinedetailplain'><INPUT TYPE='text' NAME='ProductIDNew' SIZE='8'></td>";
    echo "    <TD class='cellinedetailplain'>". GetRecordIdInputField($Search_products,
        "ID",
        "ProductnameNew",
        "Relation_$type.ProductIDNew",
        $type,
        20,
        "",
        3). "\n";
    echo " <INPUT TYPE='submit' NAME='submit' VALUE='Add'>&nbsp<INPUT TYPE='submit' NAME='del_all' VALUE='DEL all'></TD>";
    echo " <TD class='cellinedetailplain'><INPUT TYPE='text' NAME='copyfromID' SIZE='8'>\n";
    echo " <INPUT TYPE='hidden' NAME='copyfromtype' SIZE='8' VALUE='$type'></TD>\n";
    echo "    <TD COLSPAN='2' class='cellinedetailplain'></TD>";
    echo '</TR>'."\n";
    echo '</table>'."\n";

    return TRUE;
  } else {
    return False;
  }
}

/* Function     :  tab
 *
 * return a fully formatted string with tabs
 * Input        : an array with value:text combinations for the Tabs 
 * Returns      : String or empty string
 */
Function tab($tab_array,$selected,$formname,$getname='type') {
  $returnvar = "";
  if ($tab_array && is_array($tab_array)) {
    $tab_size = " HEIGHT='22'";
    $tab_unselect = " BACKGROUND='".IMAGES_URL."tab_white_middle.jpg' $tab_size";
    $tab_select = " BACKGROUND='".IMAGES_URL."tab_blue_middle.jpg' $tab_size";
    $returnvar  .=  "<TABLE BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\">\n";
    $returnvar  .=  " <TR>\n";
    foreach ($tab_array as $tab) {
      $combo = explode(';',$tab);
      $tab_value = $combo[0];
      $tab_text = $combo[1];
      if ($selected == '') $selected = $tab_value;
      ${$tab_value.'_style'} = $tab_unselect;
      $color = "white";
      if ($selected == $tab_value) {
        ${$tab_value.'_style'} = $tab_select;
        $color = "blue";
      }
      $returnvar  .=  "<TD><img src='".IMAGES_URL."tab_".$color."_left.jpg'></TD>
							 <TD ${$tab_value.'_style'}' 
							 onclick=\"document.$formname.$getname.value='$tab_value';document.$formname.submit();\"> &nbsp;  
          $tab_text &nbsp;</TD>
							 <TD><img src='".IMAGES_URL."tab_".$color."_right.jpg'></TD>\n";
    //$returnvar  .=  "     <TD ${$tab_value.'_style'}'> &emsp; &emsp; $getname=$tab_value'>$tab_text</A></TD>\n";
    }
    $returnvar  .=  "     <TD>&nbsp;</TD>";
    $returnvar  .=  " </TR>\n";
    $returnvar  .=  "</TABLE>\n";
  }
  return $returnvar;
}

/*
 * Function     : ShowOnMouseOverText
 * Shows a text when mouse is above the linl.
 * Needs overlib to work. (See printheader)
 * Input        : The text to be shown.
 *                overlib option, see http://www.bosrup.com/web/overlib/?Command_Reference
 * Returns      : String to place in the <a href='' ..>
 */
function ShowOnMouseOverText($str_text, $str_param = '') {
  if ($str_param) $str_param = ", $str_param";
  return " onmouseover=\"return overlib('$str_text' $str_param);\" onmouseout=\"return nd();\" ";
}

/*
 * Function     : RemoveLinefeeds
 * Remove any line feeds in the text.
 * Input        : The string to change
 * Returns      : String without any linefeeds
 */
function RemoveLinefeeds($str_text) {
  $str_text = str_replace("\n", " ", $str_text);
  $str_text = str_replace("\r", " ", $str_text);
  return $str_text;
}

/*
 * Function     : iframe
 * return an iframe with content
 * Input        : content url, name of the frame
 * Returns      : String
 */
function iframe($str_url,$name,$Iframe_Width = '100%',$Iframe_Height = '350') {
  $_GLOBAL["str_backdir"] = '../';
  $name_id = "NAME='ifrm' id='ifrm'";
  $ret_var = '';
  if ($str_url) {
    $ret_var = "<IFRAME SRC='" . $_GLOBAL["str_backdir"] . "$str_url'
            TITLE='$name' WIDTH='$Iframe_Width' HEIGHT='$Iframe_Height' $name_id FRAMEBORDER='0'�MARGINWIDTH='0' MARGINHEIGHT='0'>
            <!-- Alternate content for non-supporting browsers -->
            <H2>Start using Firefox or something else that supports Iframes</H2>
            </IFRAME>";
  }
  return $ret_var;
}

/*
 * Function     : GetHouseNumber
 * Will get the housenumber from an adress
 * Input/output : The adres. Will output the adres without the number
 * Returns      : String with the housenumber
 */
function GetHouseNumber($str_adres) {
  $str_housenumber = ltrim(preg_replace ("/\D+(\s\d+.*)+/", '${1}', $str_adres));
  $str_adres =  preg_replace ("/(\D+)(\s\d+.*)/", '${1}', $str_adres);
  // When nothing matched empty the housenumber.
  if (!strcmp($str_housenumber, $str_adres)) {
    $str_housenumber = "";
  }
  return $str_housenumber;
}

Function include_javascript() {
  echo "
        <script language=\"javascript1.2\" type=\"text/javascript\">
        function toggleMenu(id) {
            if(document.getElementById(id).style.display == 'none') {
                document.getElementById(id).style.display = 'block';
                cookie = replaceChars(getCookie('menu'),id,\"1\");
                setCookie(\"menu\",cookie);
            }else {
                document.getElementById(id).style.display = 'none';
                cookie = replaceChars(getCookie('menu'),id,\"0\");
                setCookie(\"menu\",cookie);
            }
        }
        
        function replaceChars(cookie,id, what) {
            before = cookie.slice(id, 1);
            id = parseInt(id)+1;
            after = cookie.slice(id, 7);
            return \"M\" + before + what + after;
        }
        
        function setCookie(name, value) {
            document.cookie = name + \"=\" + escape(value) + \"; expires=Fri, 31 Dec 2010 23:59:59 GMT; path=/; domain=iwex.serveftp.net;\"
        }
        
        
        function getCookie(id) {
            var prefix = id + \"=\";
            var begin = document.cookie.indexOf(\"; \" + prefix);
            if (begin == -1) {
                begin = document.cookie.indexOf(prefix);
                if (begin != 0) {
                    return false;
                    }
                }
            else {
                begin += 2;
                }
            var end = document.cookie.indexOf(\";\", begin);
            if (end == -1) {
                end = document.cookie.length;
                }
            return unescape(document.cookie.substring(begin + prefix.length, end));
            }
        </script>";
}

/*
 * Function     : checkbox
 * Input/output : 	$int_category: The category number from the database listbox.
			$str_selected: The selected value.
			$break: extra optie to seperat each line bijv: <BR>
			
 * Return:  HTML radio select box
 */
Function checkbox($int_catagory, $str_selected, $break = False) {
  global $db_iwex;
  $str_output = False;

  if(!$break) {
    $break = "";
  }

  $qry = "SELECT value, text FROM listbox WHERE category = $int_catagory";
  $ary_options = $db_iwex->query($qry);

  while ($row_options = mysql_fetch_array($ary_options)) {
    if ($row_options['value'] == $str_selected) {
      $str_output .= "<input type=radio name='invoice_option' value= '" .$row_options['value'] . "' CHECKED>" . $row_options['text'] . " <font color='#FF0000'><i>Selected</i></font>$break";
    } else {
      $str_output .= "<input type=radio name='invoice_option' value='" .$row_options['value'] . "'>" . $row_options['text'] . "$break";
    }
  }
  return $str_output;
}

/*
 * Function     : Show_Phonenumber
 * Input/output : 	$str_number			
 * Return:  formatted string
 */
Function Show_Phonenumber($str_number) {
  $returnvar = '';
  if ($str_number) {
    $returnvar = "<a href='callto:$str_number' "
        .ShowOnMouseOverText('Klik hier om direct te bellen met VoipBuster.\nWel je callto vinkje aanzetten in Voipbuster.')
        .">$str_number</a>";
  }
  return $returnvar;
}

/*
 * Function     : 	Show_popup
 * Input/output : 	$str_page: string of the page.
					$str_pagename: Name of the page.
					$int_height: Height of the popup.
					$int_witdth: Width of the popup.
					$str_options: venster options.
 * Return:  		nothing
 */
Function Show_popup($str_pages, $str_pagename, $int_height = FALSE, $int_width = FALSE, $str_options = FALSE) {
  echo "<SCRIPT LANGUAGE='JavaScript'>
        	window.open('$str_pages','$str_pagename','height=$int_height,width=$int_width, ,$str_options');
       	  </SCRIPT>";
}

/*
 * Function     : 	table
 * Input/output : 	$str_menu_title: string with menu title.
 *			$int_type:: 1 for start, 2 for end.
 * Return:  		
 */
Function table($str_title, $int_type) {
  $returnvar = '';
  if ($str_title
      &&
      $int_type) {
    if ($int_type==1) {
      $returnvar = "<table border='0' cellspacing='0' cellpadding='0' width='100%'><tr>
			 <td class='blocktitle_left'>&nbsp;</td>
			 <td class='blocktitle' width='100%'>Menu</td>
			 <td class='blocktitle_right'>&nbsp;</td>";
    } else if ($int_type==2) {
        $returnvar = "</table>";
      }
  }
  return $returnvar;
}

?>
