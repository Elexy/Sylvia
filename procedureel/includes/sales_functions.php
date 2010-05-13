<?
// DB id fields defines.
// sample: define('GETRECORDSEARCH','recordsearchvar');

/*
 * Function     : ShowSellThrough
 * Input        : 
 *                int_contactID, The id of the customer
				  int_productID, the id of the product, Optional
				  int_brandID, th brand id
 * Returns      : A complete formatted string that contains the Consignment information.
 */
function ShowSellThrough($formname,
						$arr_exceldata = NULL,
						$arr_excelheader =NULL,
						$int_contactID =NULL,
						$int_productID = NULL,
						$int_brandID = NULL,
						$bl_stat = FALSE) 
{
	$str_return = '';
    $DB_iwex = new DB();
	$productfields = '';
	$contactfields = '';
  
  //see if there is a filter for companyID
  $int_CompanyID = GetSetFormVar("CompanyID", TRUE);
  
	// default for amount of weeks to look back
	$int_weeks = isset($_POST["weeks"]) ? $_POST["weeks"] : SELLTHROUGHWEEKS;
	
	if (!$bl_stat) { //called from products -> or contacts -> statistics?
		if ($int_productID) {
			isset($_POST["contact"]) ? $int_contactID = $_POST["contact"] : $int_contactID = FALSE;
			$check_contactID = $int_contactID ?  " AND orders.ContactID = '$int_contactID'" : "" ;
			
			//$int_productID = (!$int_contactID && isset($_POST["product"])) ? $_POST["product"] : FALSE;
			$check_productID = $int_productID ?  " AND o.ProductID LIKE '%$int_productID%'" : "" ;		
			
			isset($_POST["companyname"]) ? $str_companyname = $_POST["companyname"] : $str_companyname = NULL;
			$check_companyname = $str_companyname ?  " AND co.CompanyName LIKE '%$str_companyname%'" : "" ;
			
			$check_productname = "";
			$check_brandID = "";
			
			$str_return .= " ContactID (like): <INPUT TYPE='TEXT' NAME='contact' SIZE=8 VALUE='$int_contactID'>";
			$str_return .= " Company name (like): <INPUT TYPE='TEXT' NAME='companyname' SIZE=8 VALUE='$str_companyname'>";
			
			$str_grouping = " GROUP BY orders.ContactID ";
			$bl_switch_productID = TRUE;
			
		} else {
      if ($int_CompanyID) {
        $check_contactID = " AND orders.ContactID = '$int_CompanyID'";
      } else {
        $check_contactID =  " AND (orders.ContactID = "
      		  . implode(" OR orders.ContactID = ",
      								   GetBranches($int_contactID, TRUE)).")";
      }

			$str_grouping = " GROUP BY o.ProductID ";
			$int_productID = isset($_POST["product"]) ? $_POST["product"] : FALSE;
			$check_productID = $int_productID ?  " AND o.ProductID LIKE '%$int_productID%'" : "" ;		
					
			isset($_POST["productname"]) ? $str_productname = $_POST["productname"] : $str_productname = NULL;
			$check_productname = $str_productname ?  " AND c.ProductName LIKE '%$str_productname%'" : "" ;
			
			isset($_POST["prodbrand"]) ? $int_brandID = $_POST["prodbrand"] : $int_brandID = NULL;
			$check_brandID = $int_brandID ? " AND c.MerkID = '$int_brandID'" : "" ;	
			
			$check_companyname = "";
			
			$str_return = "Brand: " . makelistbox('SELECT brand_id, name FROM brand order by name',
	                                            'prodbrand',
	                                            'brand_id',
	                                            'name',
												$int_brandID,
												NULL,
												'submit()');
			$str_return .= " ProductID (like): <INPUT TYPE='TEXT' NAME='product' SIZE=8 VALUE='$int_productID'>";
			$str_return .= " Productname (like): <INPUT TYPE='TEXT' NAME='productname' SIZE=8 VALUE='$str_productname'>";		
			
			$bl_switch_productID = FALSE;
		}
	} else { // NOT called from stats! just plain.
		$check_contactID = "" ;

		$str_grouping = " GROUP BY o.ProductID ";
		$int_productID = isset($_POST["product"]) ? $_POST["product"] : FALSE;
		$check_productID = $int_productID ?  " AND o.ProductID LIKE '%$int_productID%'" : "" ;		
				
		isset($_POST["productname"]) ? $str_productname = $_POST["productname"] : $str_productname = NULL;
		$check_productname = $str_productname ?  " AND c.ProductName LIKE '%$str_productname%'" : "" ;
		
		isset($_POST["prodbrand"]) ? $int_brandID = $_POST["prodbrand"] : $int_brandID = NULL;
		$check_brandID = $int_brandID ? " AND c.MerkID = '$int_brandID'" : "" ;	
		
		$check_companyname = "";
		
		$str_return = "Brand: " . makelistbox('SELECT brand_id, name FROM brand order by name',
											'prodbrand',
											'brand_id',
											'name',
											$int_brandID,
											NULL,
											'submit()');
		$str_return .= " ProductID (like): <INPUT TYPE='TEXT' NAME='product' SIZE=8 VALUE='$int_productID'>";
		$str_return .= " Productname (like): <INPUT TYPE='TEXT' NAME='productname' SIZE=8 VALUE='$str_productname'>";		
		
		$bl_switch_productID = FALSE;
		
		// since we are default looking at many articles, we devide the default amount of weeks by 3, to reduce load
		$int_weeks = $int_weeks = isset($_POST["weeks"]) ? $_POST["weeks"] : number_format(SELLTHROUGHWEEKS / 3, 0);
	}	
	$int_weeks = $int_weeks == 0 ? 1 :$int_weeks; 
	$str_return .= " # weeks back : <INPUT TYPE='TEXT' NAME='weeks' SIZE=8 VALUE='$int_weeks'>";
	
	$sql_rotation = "SELECT ";
	if (!$bl_stat) {
		$sql_rotation .=	   "orders.ContactID,
								SUBSTRING(co. CompanyName,1,20) as CompanyName, ";
	}
	$sql_rotation .=	   "o.ProductID, 
							b.name,
							SUBSTRING(c.ProductName, 1, 22) as Name, 						
							SUM(o.Quantity)  as ST
						FROM order_details o
						INNER JOIN orders ON o.OrderID = orders.OrderID
              AND(orders.OrderDate > DATE_ADD(now(),INTERVAL -$int_weeks WEEK)) 							
						INNER JOIN contacts co ON co.ContactID = orders.ContactID
						INNER JOIN current_product_list c ON o.ProductID = c.ProductID
						INNER JOIN brand b ON brand_id = c.MerkID
						WHERE 							
              confirmed_yn
							$check_productID
							$check_productname
							$check_brandID
							$check_contactID
							$check_companyname
						$str_grouping
						ORDER BY c.MerkID, o.ProductID, WEEK(orders.OrderDate)";
    
	$qry_rotation = $DB_iwex->query($sql_rotation);

	// for exporting to excel
	$str_worksheet = "Sell Through";
	
  if ($int_contactID) {
  $str_return .= " Filter on branche " . 
        makelistbox("select CompanyName, ContactID
                      FROM contacts 
                      WHERE (contacts.ContactID = ". implode(" OR contacts.ContactID = ", 
                                           GetBranches($int_contactID,
                                               TRUE)).")
                      ORDER BY CompanyName",
                    'CompanyID',
                    'ContactID',
                    'CompanyName',
                    $int_CompanyID,
                    $formname,
                    'submit()');
  }
  
	$str_return .= "<TABLE>\n";
	$str_return .= "<TR>\n";
	if ($bl_switch_productID) {
		$arr_header[] = "ContactID";
		$str_return .= "<TH>ContactID</TH>";
		$arr_header[] = "Company";
		$str_return .= "<TH>Company</TH>";
		$arr_header[] = " ";
		$str_return .= "<TH> </TH>";
	} else {
		$arr_header[] = "ProductID";
		$str_return .= "<TH>ProductID</TH>";
		$arr_header[] = "Name";
		$str_return .= "<TH>Name</TH>";
		$arr_header[] = "Brand";
		$str_return .= "<TH>Brand</TH>";
	}
	for ($i = 0; $i <=$int_weeks ; $i++) 
	{
		$week = date("W",strtotime("-".$i." week"));
		$arr_header[] = $week;
		$str_return .= "<TH>" . $week . "</TH>";
		// make sure we don't start calculating with undefined values in the array.
		$week_totals[$i] = 0;
	}
	$arr_header[] = "Total";
	$str_return .= "<TH>Total</TH>";
	$arr_header[] = "Average";
	$str_return .= "<TH>Average</TH>";
	$arr_header[] = "Stock";
	$str_return .= "<TH>Stock</TH>";
	$arr_header[] = "Weeks left";
	$str_return .= "<TH>Weeks left</TH>";
	$str_return .= "</TR>\n";
	
	$arr_excelheader = $arr_header;
	
	//set some totals to 0
	$grand_total = 0;
	$grand_average = 0;
	$row =1;
	while ($obj_rotation = mysql_fetch_object($qry_rotation)) {
		$str_return .= "<TR  CLASS='blockbody'>\n";
		if ($bl_switch_productID) {
			$cell[] = $obj_rotation->ContactID;
			$str_return .= "<TD>$obj_rotation->ContactID</a></TD>";
			$cell[] = $obj_rotation->CompanyName;
			$str_return .= "<TD><A TARGET=_new HREF=\"". CONTACTS . "?custid=$obj_rotation->ContactID\">$obj_rotation->CompanyName</a></TD>";
			$cell[] = "";
			$str_return .= "<TD></TD>";
		} else {
			$cell[] = $obj_rotation->ProductID;
			$str_return .= "<TD><A TARGET=_new HREF=\"". PRODUCT_MAINT . "?productid=$obj_rotation->ProductID\">$obj_rotation->ProductID</a></TD>";
			$cell[] = $obj_rotation->name;
			$str_return .= "<TD>$obj_rotation->name</TD>";
			$cell[] = $obj_rotation->Name;
			$str_return .= "<TD>$obj_rotation->Name</TD>";
		}
		$total = 0;
		for ($i = 0; $i <=$int_weeks ; $i++) 
		{
      if ($int_contactID) {
   			if ($int_CompanyID) {
          $checkforcontact = " AND orders.ContactID = $int_CompanyID" ;
        } else { 
          $checkforcontact =  " AND (orders.ContactID = "
                    . implode(" OR orders.ContactID = ",
                      GetBranches($int_contactID, TRUE)).")";
        }      
      } elseif (isset($obj_rotation->ContactID)) {
        $checkforcontact = " AND orders.ContactID = $obj_rotation->ContactID ";   
      } else {
        $checkforcontact = "" ;
      } 
      //echo  $obj_rotation->ContactID . "<BR>";
      //$checkforcontact ;
      $sql_sold_week = "SELECT 					
													SUM(o.Quantity)  as ST
												FROM order_details o
												INNER JOIN orders ON o.OrderID = orders.OrderID 
                          AND (orders.OrderDate > DATE_ADD(now(),INTERVAL -$int_weeks WEEK)) AND
													WEEK(orders.OrderDate) = WEEK(DATE_ADD(now(),INTERVAL -$i WEEK))
                          " . $checkforcontact . "
												INNER JOIN current_product_list c ON o.ProductID = c.ProductID
												WHERE 
                          confirmed_yn                         
													AND o.ProductID = $obj_rotation->ProductID													
													$check_brandID													
												GROUP BY o.ProductID
												ORDER BY o.ProductID";
			$str_return .= "<TD>" . $units = GetField($sql_sold_week);
			$str_return .= "</TD>";
			$cell[$i+3] = $units;
			$week_totals[$i] += $units;
			$total += $units;
		}
		$average = number_format(($total/($int_weeks)),1);
		$cell[$int_weeks+4] = $total;
		$str_return .= "<TD ALIGN=right><B>$total</B></TD>";
		$cell[$int_weeks+5] = $average;
		$str_return .= "<TD ALIGN=right><B>" . $average . "</B></TD>";
		$stock = getfreestock($obj_rotation->ProductID);
		$cell[$int_weeks+6] = $stock;
		$str_return .= "<TD ALIGN=right><B>" . $stock . "</B></TD>";
		$weeks_stock = $average<>0 ? number_format(($stock >=0 ? $stock : 0) / $average,1,',','.') : '-';
		$cell[$int_weeks+7] = $weeks_stock;
		$str_return .= "<TD ALIGN=right><B>" . $weeks_stock . "</B></TD>";
		$str_return .= "</TR>\n";
		$grand_total += $total;
		$arr_exceldata[$row] = $cell;
		$row++;
		unset($cell);
	}
	$row++;
	$str_return .= "<TR CLASS='blockbody'>";
	$str_return .= "<TH COLSPAN=3></TH>";
	foreach ($week_totals as $week_t) {
		$str_return .= "<TH>$week_t</TH>";
	}
	$grand_average = number_format($grand_total / $int_weeks,1);
	$cell[$int_weeks+4] = $grand_total;
	$cell[$int_weeks+5] = $grand_average;
	$str_return .= "<TH>$grand_total</TH><TH>" . $grand_average . "</TH>\n";
	$str_return .= "<TH> </TH><TH></TH>\n";
	$str_return .= "</TR>\n";
	
	$arr_exceldata[$row] = $cell;
	$str_return .= "</TABLE>\n";
	
	return $str_return;
}


/*
 * Function     : ShowAverageSellThrough
 * Input        : 
				  int_productID, the id of the product, Optional
 * Returns      : A complete formatted string that contains the Consignment information.
 */
Function ShowAverageSellThrough($int_productID,
								$int_weeks = 12) 
{
	if ($int_productID) {
		$average = number_format(GetField("SELECT SUM(weeksum) / $int_weeks
										FROM (SELECT 					
											SUM(o.Quantity) as weeksum
										FROM order_details o
										INNER JOIN orders ON o.OrderID = orders.OrderID
										INNER JOIN current_product_list c ON o.ProductID = c.ProductID
										WHERE 
											(orders.OrderDate > DATE_ADD(now(),INTERVAL -$int_weeks WEEK)) 					
											AND	NOT administration_order
											AND NOT rma_yn
											AND o.ProductID = $int_productID
											AND confirmed_yn
										GROUP BY WEEK(orders.OrderDate)) 
									AS order_details"),1);
	}
	return $average;
	
}

/*
 * Function     : WebUser
 * Input        : int_productID, the id of the product, Optional
 * Returns      : 
 */
Function WebUser($int_CompanyID,
                       $str_username,
                       $str_customer_name,
                       $str_email,
                       $int_languageID,
                       $int_id,
                       $bl_access_rma = FALSE,
                       $bl_access_purchase = FALSE,
                       $bl_access_stock = FALSE,
                       $passwd = FALSE)
{
  $returnvar = FALSE;
  if ($int_CompanyID
      &&
      $str_username
      &&
      $str_email)
  {
    $sql = " users SET ContactID='$int_CompanyID', uid='$str_username', CompanyName = '$str_customer_name', ";
    if (!empty($passwd)) {
        $sql .= "pwd='".encrypt($passwd)."', ";
    }
    $sql .= " email='$str_email', languageID='$int_languageID' ,rma='$bl_access_rma', purchase='$bl_access_purchase', stock='$bl_access_stock'";
    if ($int_id) { 
        $sql = "UPDATE" . $sql . "WHERE id = '$int_id'";
    } else {
        $passwd = generate_Password();
        //echo "Het volgende password is gegenereerd: " .$passwd;
        $sql = "INSERT" . $sql. ", pwd='".encrypt($passwd)."'";
    }
    $result = mysql_query($sql) or die($sql . mysql_error());
    $returnvar = "<center>Irene User $str_username successfully";
    if ($int_id) {
        $returnvar .= " updated.</center>";            
    } else {
        $returnvar .= " added.</center>";            
    }
  }
  return $returnvar;
}

?>