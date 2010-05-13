<?
include ("include.php");
$rmaid = isset($_POST['rmaid']) ? $_POST['rmaid'] : FALSE;
$rmaid = isset($_GET['rmaid']) && !$rmaid ? $_GET['rmaid'] : $rmaid;
$new_rma = isset($_POST['new_rma']) ? $_POST['new_rma'] : FALSE;
$check = isset($_POST['check']);
$afdruk = isset($_POST['afdruk']) ? $_POST['afdruk'] : FALSE;
$submit = isset($_POST['submit']);
$print = isset($_POST['print']);
$int_SupplierContactID = isset($_POST['SupplierContactID']) ? $_POST['SupplierContactID'] : FALSE;
//form variabeles
$str_Productdescription = isset($_POST['Productdescription']) ? $_POST['Productdescription'] : FALSE;
$str_Productname = isset($_POST['Productname']) ? $_POST['Productname'] : FALSE;
$str_aantal = isset($_POST['aantal']) ? $_POST['aantal'] : FALSE;
$int_contacts_id = isset($_GET['ContactID']) ? $_GET['ContactID'] : FALSE;
$int_contacts_id = isset($_POST['ContactID']) ? $_POST['ContactID'] : $int_contacts_id;
$str_State = isset($_POST['State']) ? $_POST['State'] : FALSE;
$str_Reason = isset($_POST['Reason']) ? $_POST['Reason'] : FALSE;
$int_ProductID = isset($_POST['ProductID']) ? $_POST['ProductID'] : FALSE;
$int_Customer_ID = isset($_POST['Customer_ID']) ? $_POST['Customer_ID'] : FALSE;
$int_SupplierID = isset($_POST['SupplierID']) ? $_POST['SupplierID'] : FALSE;
$str_Date_in = isset($_POST['Date_in']) ? $_POST['Date_in'] : FALSE;
$int_Article_code= isset($_POST['Aticle_code']) ? $_POST['Aticle_code'] : FALSE;
$int_FactuurID = isset($_POST['FactuurID']) ? $_POST['FactuurID'] : FALSE;
$str_Date_done = isset($_POST['Date_done']) ? $_POST['Date_done'] : FALSE;
$int_Product_State = isset($_POST['Product_State']) ? $_POST['Product_State'] : FALSE;
$int_prod_State_ID = isset($_POST['prod_State_ID']) ? $_POST['prod_State_ID'] : FALSE;
$int_cust_State_ID = isset($_POST['cust_State_ID']) ? $_POST['cust_State_ID'] : FALSE;
$int_State_ID = isset($_POST['State_ID']) ? $_POST['State_ID'] : FALSE;
$str_sn = isset($_POST['sn']) ? $_POST['sn'] : FALSE;
$str_company = isset($_POST['Company']) ? $_POST['Company'] : FALSE;
$bln_State_Open = isset($_POST['State_Open']);

$formname = "rmaform";
// Print default Iwex HTML header.
printheader (COMPANYNAME . " RMA", "print", !$afdruk);

     if ($afdruk) {
         echo "<body onLoad=\"print();location.replace('".$_SERVER['PHP_SELF']."?rmaid=$rmaid');\">\n";
     } else {
         echo "<BODY ".get_bgcolor().">\n<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"$formname\">\n";
	 	 printIwexNav();
		 echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
     }
	 
     if ($submit
         ||$new_rma
         ||
         $rmaid && !$print) {
          if ($submit)
          {
               if ($rmaid)
               // when update has been pressed for insert; run update query
               {
                    $updmain_sql = "update RMA set contacts_id='".$_POST['ContactID']."', "
                              ."ProductID='".$_POST['ProductID']."', aantal='".$_POST['aantal']."', Customer_ID='".$_POST['Customer_ID']."', "
                              ."SupplierID='".$_POST['SupplierID']."', Date_in=" . insertDate($_POST['Date_in'])
     						 .", SN='".$_POST['sn']."', Reason='".$_POST['Reason']."', ";
     			   // Reset date field when needded
     			   $updmain_sql .= "Date_done=" . insertDate($_POST['Date_done']);

                    $updmain_sql .= " , Additional_items='".$_POST['Additional_items']."', "
                              ."FactuurID='".$_POST['FactuurID']."', State='".$_POST['State_ID']."', product_state='".$_POST['Product_State']."', "
     						 ."product_customer='".$_POST['cust_State_ID']."', product_location='".$_POST['prod_State_ID']."' where ID = '$rmaid';";
                    $rmadetail_update = mysql_query($updmain_sql)
                         or die("Ongeldige update query: " .$updmain_sql. mysql_error());
               } else {  // when update has been pressed and rmaid is available ; run insert query
                    $insertmain_sql = "INSERT INTO RMA set contacts_id='".$_POST['ContactID']."', "
                              ."ProductID='".$_POST['ProductID']."', aantal='".$_POST['aantal']."', Customer_ID='".$_POST['Customer_ID']."', "
                              ."SupplierID='".$_POST['SupplierID']."', Date_in=".insertDate($_POST['Date_in']).", SN='".$_POST['sn']."', Reason='".$_POST['Reason']."', "
                              ."Date_done=".insertDate($_POST['Date_done']).", Additional_items='".$_POST['Additional_items']."', "
                              ."FactuurID='".$_POST['FactuurID']."', State='".$_POST['State_ID']."', product_state='".$_POST['Product_State']."', product_customer='".$_POST['cust_State_ID']."', "
     						 ."product_location='".$_POST['prod_State_ID']."'";
                    $rmadetail_insert = mysql_query($insertmain_sql)
                         or die("Insert query niet gelukt: " .$insertmain_sql. mysql_error());
     	           $last_rmaid = MYSQL_QUERY('SELECT distinct LAST_INSERT_ID() FROM RMA')
                         or die('Ongeldige select query: SELECT distinct LAST_INSERT_ID() FROM RMA'. mysql_error());
                    $rmaidobj = mysql_fetch_array($last_rmaid,MYSQL_BOTH);
                    $rmaid = $rmaidobj[0];
              }
          }

          if ($rmaid) { // if there is a rmaid either last new one or given one
               $detailmain_sql = 'SELECT RMA.ID, RMA.aantal, RMA.contacts_id, RMA.State, RMA.ProductID,'
               .'RMA.Customer_ID, RMA.SupplierID, RMA.Date_in, RMA.SN, current_product_list.Productname, '
               .'RMA.Reason, RMA.Date_done, RMA.Additional_items, RMA.FactuurID, RMA.product_state,'
     		   .'RMA.product_customer, RMA.product_location '
               .'FROM RMA '
			   .'left join current_product_list on RMA.ProductID = current_product_list.ProductID '
               .'WHERE RMA.ID = '.$rmaid;
               $rmadetail_query = mysql_query($detailmain_sql)
                    or die("Ongeldige select details query: " .$detailmain_sql. mysql_error());
               $obj = mysql_fetch_object($rmadetail_query);
          }

     	 if ($new_rma) {
     	 	 $obj->Date_in = date("Y-m-d"); //Set current date
     	 }

          echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
          echo "    <TR>\n";
          echo "         <TH colspan='4'><B>RMA ID $obj->ID</B></TH>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Datum Melding</TD><TD><INPUT TYPE=\"text\" NAME=\"Date_in\" SIZE=\"20\" CLASS=\"form\" value=\"".$obj->Date_in."\">";
		  echo 			Add_Calendar('rmaform.Date_in')."</TD>\n";
          echo "         <TD>Customer_ID</TD><TD><INPUT TYPE=\"text\" NAME=\"Customer_ID\" SIZE=\"20\" CLASS=\"form\" value=\"".$obj->Customer_ID."\"></TD>";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>CompanyName</TD><TD>".makelistbox('select ContactID, Companyname from contacts ORDER BY Companyname','ContactID','ContactID','Companyname',$obj->contacts_id)."</TD>\n";
          echo "         <TD>FactuurID
			      <A HREF='" . SHOW_INVOICE . "?invoice=" . $obj->FactuurID . "'>$obj->FactuurID</A></TD><TD>"; //get listbox with invoices onwhich this product exists for this customer
          echo "<INPUT TYPE=\"text\" NAME=\"FactuurID\" value=\"$obj->FactuurID\"SIZE=\"6\" CLASS=\"form\">";

          if (!$new_rma&&$obj->contacts_id) {  // if new button has been pressed in main screen do not run query
               //get listbox with invoices on which this product exists for this customer

     		   $str = '<select name="tempinvoice"';
               $str .= 'onChange="FactuurID.value = tempinvoice.value">';

               $str .= "\n";
               $str .= '<option value=>--Leeg--</option>'."\n";
               $sqlstr = 'SELECT DISTINCT InvoiceID , Invoice_date '
                         .'FROM invoices '
                         .'INNER  JOIN orders ON invoices.orderID = orders.OrderID '
                         .'RIGHT  JOIN order_details ON order_details.OrderID = orders.OrderID '
                         .'WHERE order_details.ProductID='.$obj->ProductID.' AND orders.ContactID='
                         .$obj->contacts_id;

               $resultdrop = MYSQL_QUERY($sqlstr)
                      or die("Ongeldige query in functie: " .$sqlstr. ' Mysql error: '. mysql_error());

                while ($objtemp = mysql_fetch_object($resultdrop))
                  {
                       if ($objtemp->InvoiceID==$obj->FactuurID)
                       {
                         $str .= '<option value='.$objtemp->InvoiceID.' selected>'.$objtemp->InvoiceID;
                       }
                       else
                       {
                         $str .= '<option value='.$objtemp->InvoiceID.'>'.$objtemp->InvoiceID;
                       }
     				  $str .= ' [' . date('Y-m-d', strtotime($objtemp->Invoice_date)) .']</option>'."\n";

                  } // end while
               mysql_free_result($resultdrop);

               $str .= '</select>'."\n";

     		   $str .= '<select name="tempinvoicenew"';
               $str .= 'onChange="FactuurID.value = tempinvoicenew.value">\n';

               $str .= '<option value=>--Leeg--</option>'."\n";
               $sqlstr = 'SELECT DISTINCT InvoiceID , Invoice_date '
                         .'FROM invoices '
                         .'INNER JOIN inventory_transactions ON inventory_transactions.ShipmentID = invoices.ShipmentID '
                         .'WHERE inventory_transactions.ProductID='.$obj->ProductID.' AND invoices.CustomerID='
                         .$obj->contacts_id;

               $resultdrop = MYSQL_QUERY($sqlstr)
                      or die("Ongeldige query in functie: " .$sqlstr. ' Mysql error: '. mysql_error());

                while ($objtemp = mysql_fetch_object($resultdrop))
                  {
                       if ($objtemp->InvoiceID==$obj->FactuurID)
                       {
                         $str .= '<option value='.$objtemp->InvoiceID.' selected>'.$objtemp->InvoiceID;
                       }
                       else
                       {
                         $str .= '<option value='.$objtemp->InvoiceID.'>'.$objtemp->InvoiceID;
                       }
     				  $str .= ' [' . date('Y-m-d', strtotime($objtemp->Invoice_date)) .']</option>'."\n";

                  } // end while
               mysql_free_result($resultdrop);   

               $str .= '</select>'."\n";
               echo ' Of ' . $str;
          } else // New RMA
     	 {
     		echo '>';
     	 }

          echo "</TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Artikel</TD><TD><INPUT TYPE=\"text\" NAME=\"ProductID\" SIZE=\"6\" CLASS=\"form\" value=\"".$obj->ProductID."\">";
     	  // If number of products is 0 set it to 1. Because 0 doesn't make sence.
     	  if ($obj->aantal == 0) {
     	      $obj->aantal = 1;
     	  }					
		  echo " aantal <INPUT TYPE=\"text\" NAME=\"aantal\" SIZE=\"2\" CLASS=\"form\" value=\"". $obj->aantal. "\"></td>";
		  echo "    <td>Zoek product</td><td><INPUT TYPE=\"text\" NAME=\"ProductSearch\" SIZE=\"10\" CLASS=\"form\" value=\"".$_POST['ProductSearch']."\">";
		  echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "ProductSearch", "rmaform.ProductID");
          echo "         </TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Artikel naam</TD><TD colspan=\"3\">$obj->Productname</TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Serienummer</TD><TD><INPUT TYPE=\"text\" NAME=\"sn\" SIZE=\"25\" CLASS=\"form\" value=\"".$obj->SN."\">";
          echo " <a href='".docroot."/includes/find_serial_numbers.php?number=$obj->SN' target=new>check</a></TD>\n";
          echo "         <TD>Aditional items</TD><TD><INPUT TYPE=\"text\" size=\"50\" CLASS=\"form\" name=\"Additional_items\"value=\"$obj->Additional_items\"></TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Reason</TD><TD colspan='3'><textarea NAME=\"Reason\" rows=\"5\" cols=\"80\" CLASS=\"form\">$obj->Reason</textarea></TD>\n";
          echo "    </TR>\n";
		  echo "    <TR>\n";
		  echo "         <TD>Guarantee type</TD><TD>".makelistbox('SELECT id, state FROM RMA_product_state ORDER BY state','Product_State','id','state', $obj->product_state)."</TD>\n";
		  echo "    </TR>\n";
		  echo "    <TR>\n";
          echo "         <TD>Product state</TD><TD>".makelistbox('select State_ID, State_text from RMA_product_location order by State_text','prod_State_ID','State_ID','State_text',$obj->product_location == 0 ? 1 : $obj->product_location)."</TD>\n";
          echo "         <TD>State</TD><TD>".makelistbox('select State_ID, State_text from RMA_state order by State_text','State_ID','State_ID','State_text',$obj->State)."</TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Customer prod. state</TD><TD>".makelistbox('select State_ID, State_text from RMA_product_customer order by State_text','cust_State_ID','State_ID','State_text',$obj->product_customer == 0 ? 1 : $obj->product_customer)."</TD>\n";
          echo "         <TD>Supplier ID</TD><TD><INPUT TYPE=\"text\" NAME=\"SupplierID\" SIZE=\"20\" CLASS=\"form\" value=\"".$obj->SupplierID."\"></TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Datum klaar</TD><TD colspan='3'><INPUT TYPE=\"text\" NAME=\"Date_done\" SIZE=\"20\" CLASS=\"form\" value=\"".$obj->Date_done."\">";
 		  echo Add_Calendar('rmaform.Date_done')."</TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD COLSPAN=\"6\" align=\"right\">";
          echo "         <INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\">\n";
          echo "         <INPUT TYPE=\"button\" NAME=\"RMALIST\" onClick=\"location.replace('rma.php');\" VALUE=\"Return to list\">\n";
          echo "         <INPUT TYPE=\"submit\" NAME=\"print\" VALUE=\"Print\" CLASS=\"button\">";
          echo "         <INPUT TYPE=\"hidden\" NAME=\"rmaid\" SIZE=\"20\" CLASS=\"form\" value=\"$rmaid\"></TD>\n";
          echo "    </TR>\n";
          echo "</TABLE>\n";

         if ((isset($_POST["subjectnew"]) && $_POST["subjectnew"])
             || 
             (isset($_POST["Reasonnew"]) && $_POST["Reasonnew"])) { //When new detail records have been added, insert these first
            $insertqry = 'INSERT INTO RMA_actions set RMAID='.$rmaid.', ActionDate="'.date("Y-m-d H:i").'" , Subject='.$_POST["subjectnew"].' ,Notes= "'.$_POST["Reasonnew"].'" ,employee='.$_POST["employeenew"];
            $querynew = mysql_query($insertqry)
              or die('insert van de RMA actie niet gelukt: ' .$insertqry.' error:'. mysql_error());
			$inserted_RMA_actionID = mysql_insert_id();
			if ($_POST["subjectnew"] == SHIP_RMA_ACTION) {
				CreateRMA_Order($int_ProductID, $str_aantal, $int_contacts_id, $inserted_RMA_actionID);               
			} else if ($_POST["subjectnew"] == CREDIT_RMA_ACTION) {
                CreateRMA_Order($int_ProductID, 
                                -$str_aantal, 
                                $int_contacts_id, 
                                $inserted_RMA_actionID,
                                RMA_CREDIT_TEXT,
                                GetProductPrice($int_ProductID,
                                                $str_aantal,
                                                GetPriceLevel($int_contacts_id)
                                                ),
                                TRUE
                                );  
            } else if ($_POST["subjectnew"] == SUPPLIER_RMA_ACTION) {
				CreateRMA_Order($int_ProductID,
								$str_aantal,
								GetSupplier($int_ProductID),
								$inserted_RMA_actionID,
								RMA_RETOUR_SUPPLIER_TEXT);
			}
          }
          //now select all the deatailrecords of this rmaid
          $action_sql = 'SELECT ActionID , RMAID , ActionDate , Subject , Notes, employee, webuser '
             . ' FROM RMA_actions ' 
             . ' WHERE RMAID='.$rmaid.' ORDER BY ActionDate';
          echo '<BR>';
          echo '<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" class="blockbody">'."\n";
          echo '<TR>'."\n";
          echo '<th >Datum</th><th>Onderwerp</th><th>notes</th><th>Del</th>',"\n";
          echo '</TR>'."\n";
          if (!$new_rma) {  // if new button has been pressed in main screen do not run query
               $rma_action_result = mysql_query($action_sql)
                  or die("Ongeldige query: " .$action_sql. mysql_error());
              while ($obj_action = mysql_fetch_object($rma_action_result)) {
                    // update records when there are diferences with last pass
                    // but ignore the new line
					$int_rma_orderdetail_record = GetField("SELECT OrderDetailsID
                            FROM order_details WHERE RMA_actionID = '$obj_action->ActionID'");
     		        //echo 'int_rma_orderdetail_record '.$int_rma_orderdetail_record.'<br>';
					$int_rma_not_shipped = GetField("SELECT to_deliver
                            FROM order_details WHERE RMA_actionID = '$obj_action->ActionID'");
					//echo 'int_rma_not_shipped '.$int_rma_not_shipped.'<br>';
                    if ((isset($_POST["subject".$obj_action->ActionID]) 
                       || 
                       isset($_POST["Reason".$obj_action->ActionID]))
                       &&
                       ($int_rma_not_shipped||!$int_rma_orderdetail_record)) {
                        $qry = 'UPDATE RMA_actions set Subject="'.$_POST["subject".$obj_action->ActionID].'" ,Notes= "'.$_POST["Reason".$obj_action->ActionID].'" ,employee= "'.$_POST["employee".$obj_action->ActionID].'"'
                            .' WHERE ActionID='.$obj_action->ActionID;
                        $queryres = mysql_query($qry)
                            or die("update van de RMA acties niet gelukt: order " .$qry." error:". mysql_error());
						// Check if the record should be deleted.
						if (GetCheckBox('delete'.$obj_action->ActionID)
							&&
							($int_rma_not_shipped||!$int_rma_orderdetail_record)) {
	                        $qry = 'DELETE FROM RMA_actions WHERE ActionID='.$obj_action->ActionID;
	                        $queryres = mysql_query($qry)
	                            or die("Verwijderen van RMA acties '$obj_action->ActionID' niet gelukt: " .$qry." error:". mysql_error());
							GetOpenRMAOrder(FALSE,
                                             $int_contacts_id,
                                             $obj_action->ActionID,
                                             TRUE);	
							GetOpenRMAOrder(FALSE,
                                             $int_contacts_id,
                                             $obj_action->ActionID,
                                             TRUE,
                                             RMA_CREDIT_TEXT);	
							GetOpenRMAOrder(FALSE,
											GetSupplier($int_ProductID),
											$obj_action->ActionID,
											TRUE,
											RMA_RETOUR_SUPPLIER_TEXT);
						} 
                        // add Orderdetails record if neccesary only if there are not shipped
                        if ($_POST['subject'.$obj_action->ActionID] == SHIP_RMA_ACTION
							&&
							$_POST['last_subject'.$obj_action->ActionID] != SHIP_RMA_ACTION
                            ) {
                            CreateRMA_Order($int_ProductID,$str_aantal, $int_contacts_id,$obj_action->ActionID);  
						}
                        // delete the order_detaisl record if nescesary
                        if ($_POST['subject'.$obj_action->ActionID] != SHIP_RMA_ACTION
                             &&
                             $_POST['last_subject'.$obj_action->ActionID] == SHIP_RMA_ACTION
                             ) {
                             GetOpenRMAOrder(FALSE,
                                             $int_contacts_id,
                                             $obj_action->ActionID,
                                             TRUE);											 
                        }
						// add Orderdetails record if neccesary only if there are not shipped
                        if ($_POST['subject'.$obj_action->ActionID] == SUPPLIER_RMA_ACTION
							&&
							$_POST['last_subject'.$obj_action->ActionID] != SUPPLIER_RMA_ACTION
                            ) {
                            CreateRMA_Order($int_ProductID,
											$str_aantal,
									 		GetSupplier($int_ProductID),
											$obj_action->ActionID,
											RMA_RETOUR_SUPPLIER_TEXT);
						}
                        // delete the order_detaisl record if nescesary
                        if ($_POST['subject'.$obj_action->ActionID] != SUPPLIER_RMA_ACTION
                             &&
                             $_POST['last_subject'.$obj_action->ActionID] == SUPPLIER_RMA_ACTION
                             ) {
                             GetOpenRMAOrder(FALSE,
                                             GetSupplier($int_ProductID),
                                             $obj_action->ActionID,
                                             TRUE,
											 RMA_RETOUR_SUPPLIER_TEXT);
                        } else                         
                        // add Orderdetails record if neccesary only if there are not shipped
                        if ($_POST['subject'.$obj_action->ActionID] == CREDIT_RMA_ACTION
							&&
							$_POST['last_subject'.$obj_action->ActionID] != CREDIT_RMA_ACTION
                            ) {
                            CreateRMA_Order($int_ProductID, 
											-$str_aantal, 
											$int_contacts_id, 
											$obj_action->ActionID,
											RMA_CREDIT_TEXT,
											GetProductPrice($int_ProductID,
															$str_aantal,
															GetPriceLevel($int_contacts_id)
															),
                                            TRUE
											);  
						}
                        // delete the order_detaisl record if nescesary
                        if ($_POST['subject'.$obj_action->ActionID] != CREDIT_RMA_ACTION
                             &&
                             $_POST['last_subject'.$obj_action->ActionID] == CREDIT_RMA_ACTION
                             ) {
                             GetOpenRMAOrder(FALSE,
                                             $int_contacts_id,
                                             $obj_action->ActionID,
                                             TRUE,
                                             RMA_CREDIT_TEXT);											 
                        }                         
                    } 	  
               }
               $query = mysql_query($action_sql)
                   or die("Ongeldige query: " .$action_sql. mysql_error());
               while ($obj_action = mysql_fetch_object($query)) {
          	     echo '<TR valign="top">'."\n";
                    echo '    <td align="right" class="cellline"';
                    if ($obj_action->Subject==SHIP_RMA_ACTION) echo " rowspan=2";
                    echo '>'.date(DATEFORMAT, strtotime($obj_action->ActionDate))."\n";
                    echo '    <br>door'.makelistbox("SELECT EmployeeID, CONCAT_WS(' ', FirstName, LastName) AS name
													FROM employees
													ORDER BY FirstName",
													"employee$obj_action->ActionID",
													"EmployeeID",
													"name",
													$obj_action->employee).'<br>'."\n";
					echo "$obj_action->webuser</td>\n";
                    echo '    <td align="right" class="cellline">'.makelistbox("SELECT Subject_ID, Subject_text FROM RMA_subject order by Subject_text","subject$obj_action->ActionID","Subject_ID","Subject_text",$obj_action->Subject);
                    echo '            <input type="hidden" name="last_subject'.$obj_action->ActionID.'" value="'.$obj_action->Subject.'"></TD>'."\n";
                    echo '    <td class="cellline"><textarea NAME="Reason'.$obj_action->ActionID.'" rows="2" cols="70" CLASS="form">'.$obj_action->Notes.'</textarea></td>'."\n";
                    echo '    <td class="cellline"><input type="checkbox" NAME="delete'.$obj_action->ActionID.'" onClick="return confirm(\'Weet je zeker dat je dit record wilt verwijderen?\')"></td>'."\n";
                    echo '</TR>'."\n";
                    if ($obj_action->Subject==SHIP_RMA_ACTION
                        ||
                        $obj_action->Subject==CREDIT_RMA_ACTION
						||
						$obj_action->Subject==SUPPLIER_RMA_ACTION) {
                        echo "<TR valign=\"top\">\n<TD colspan='3'>";
                        echo ShowRMA_action_Basket($int_contacts_id,$obj_action->ActionID);
					    echo "</TD>\n</TR>\n";
                    }
                }
            }
            mysql_free_result($query);
          // always display a new empty detail record at the bottom
          echo '<tr><th colspan="4" align="left">Leeg record om nieuwe akties toe te voegen</th></tr>'."\n";
          echo '<TR valign="top">'."\n";
          echo '    <td align="right" class="cellline">'.date(DATEFORMAT)."\n";
		  echo '    <br>door'.makelistbox("SELECT EmployeeID, CONCAT_WS(' ', FirstName, LastName) AS name FROM employees order by FirstName","employeenew","EmployeeID","name", $employee_id).'</TD>'."\n";
          echo '    <td align="right" class="cellline">'.makelistbox("SELECT Subject_ID, Subject_text FROM RMA_subject order by Subject_text","subjectnew","Subject_ID","Subject_text").'</TD>'."\n";
          echo '    <td class="cellline"><textarea NAME="Reasonnew" rows="2" cols="70" CLASS="form"></textarea></td><td></td>'."\n";
          echo '</TR>'."\n";
          echo "</TABLE>\n";
    }  else if ($print)  { // Function used for printing.
         $detailmain_sql = 'SELECT RMA.ID, RMA.aantal, RMA.contacts_id, RMA.State, RMA.ProductID, '
                    .'RMA.Customer_ID, RMA.SupplierID, RMA.Date_in, RMA.SN, '
                    .'RMA.Reason, RMA.Date_done, RMA.Additional_items, RMA.FactuurID, '
                    .'RMA_state.State_text, CompanyName, ProductName, contacts.email, Personen.email AS pemail, '
     		  	    .'RMA_product_customer.State_text AS prCusTxt, RMA_product_location.State_text AS prLocTxt '
                    .'FROM RMA '
                    .'left join RMA_state on RMA_state.State_id=RMA.State '
                    .'left join RMA_product_customer on RMA_product_customer.State_id=RMA.product_customer '
                    .'left join RMA_product_location on RMA_product_location.State_id=RMA.product_location '
                    .'left join contacts on RMA.contacts_id = contacts.ContactID '
                    .'left join current_product_list on RMA.ProductID = current_product_list.ProductID '
                    .'LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID AND Personen_type_ID = 2 '
                    .'WHERE RMA.ID = '.$rmaid;
         $rmadetail_query = mysql_query($detailmain_sql)
               or die("Ongeldige query: " .$detailmain_sql. mysql_error());

         if ($obj = mysql_fetch_object($rmadetail_query)) {
     /*          echo '<script language="JavaScript">'."\n";
               echo 'window.print();'."\n";
               echo 'history.back();'."\n";
               echo '</script>'."\n";
     */
     		  if (!isset($_POST['email'])) {
     			    $email = $obj->pemail ? $obj->pemail : $obj->email;
     		  } else {
                  $email = $_POST['email'];
              }

     		  $mailtxt = "<table width='100%' border='0'><tr><td width='110'><img src='http://iwex.serveftp.org/images/" . LOGOSMALL . "' width=75 alt='".COMPANYNAME. " logo' border=0></td>";
     		  $mailtxt .= "<td align=\"center\">RMA<br><img src=\"http://iwex.serveftp.org/phptools/barcode.php?barcode=$obj->ID&height=50&width=200&text=1\" alt=\"$obj->ID\"></td>\n";
     		  $mailtxt .= "<td width=\"30%\"></td><td align=\"center\">Klant<br><img src=\"http://iwex.serveftp.org/phptools/barcode.php?barcode=$obj->contacts_id&height=50&text=1\" alt=\"$obj->contacts_id\"></td></tr></table>\n";
     		  $mailtxt .= "<TABLE WIDTH='100%' BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TH colspan='4' align=\"left\"><B>RMA ID ".$obj->ID."</B></TH>\n";
               $mailtxt .= "    </TR>\n";
     /*
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <td align=\"right\">RMA :</td><td><DIV class=\"barcode39\">*".$obj->ID."*</div></td>\n";
               $mailtxt .= "         <td align=\"right\">Klant nr :</td><td><DIV style=\"FONT: 10pt 'Code 39'\">".$obj->contacts_id."</B></td>\n";
               $mailtxt .= "    </TR>\n";
     */
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Product lokatie: </TD><TD>".$obj->prLocTxt."</TD>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Klant product status: </TD><TD>".$obj->prCusTxt."</TD>\n";
               $mailtxt .= "    </TR>\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Klant:</TD><TD>".$obj->CompanyName."</TD>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Factuurnummer:</TD><TD>".$obj->FactuurID."</TD>\n";
               $mailtxt .= "    </TR>\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Artikel:</TD><TD>".$obj->ProductID." : ".$obj->ProductName."</TD>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Aantal:</TD><TD>".$obj->aantal."</TD>\n";
               $mailtxt .= "    </TR>\n";
          	   $mailtxt .= "    <TR>\n";
           	   $mailtxt .= "         <TD ALIGN=\"right\">Aditional items:</TD><TD colspan='2'>$obj->Additional_items</TD>\n";
          	   $mailtxt .= "    </TR>\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Serienummer:</TD><TD>". ($obj->SN ? "<img src=\"http://iwex.serveftp.org/phptools/barcode.php?barcode=$obj->SN&height=25&width=350&text=1\" alt=\"$obj->SN\">" : "")."</TD>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Status:</TD><TD>".$obj->State_text."</TD>\n";
               $mailtxt .= "    </TR>\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Datum in:</TD><TD>".$obj->Date_in."</TD>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Datum klaar:</TD><TD>".$obj->Date_done."</TD>\n";
               $mailtxt .= "    </TR>\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Klant Kenmerk:</TD><TD>".$obj->Customer_ID."</TD>";
               $mailtxt .= "         <TD ALIGN=\"right\">Fabrikant Kenmerk:</TD><TD>".$obj->SupplierID."</TD>\n";
               $mailtxt .= "    </TR>\n";
               $mailtxt .= "    <TR>\n";
               $mailtxt .= "         <TD ALIGN=\"right\">Klacht:</TD><TD colspan='3'>".$obj->Reason."</TD>\n";
               $mailtxt .= "    </TR>\n";
               $mailtxt .= "</TABLE>\n";
          }
           $action_sql = 'SELECT ActionID , RMAID , ActionDate, Subject , Notes, Subject_text '
               .'FROM RMA_actions '
               .'inner join RMA_subject on RMA_actions.Subject = RMA_subject.Subject_ID '
               ." WHERE RMAID='$rmaid' "
               ."ORDER BY ActionDate";
           $rma_action_result = mysql_query($action_sql)
               or die("Ongeldige query: " .$action_sql. mysql_error());

           if ($obj = mysql_fetch_object($rma_action_result)) {
               $query = mysql_query($action_sql)
                   or die("Ongeldige query: " .$action_sql. mysql_error());
               $mailtxt .= '<BR>';
               $mailtxt .= '<TABLE WIDTH="100%" BORDER="0" CELLPADDING="2" CELLSPACING="0" class="blockbody">'."\n";
               $mailtxt .= '<TR>'."\n";
               $mailtxt .= '<th >Datum</th><th>Onderwerp</th><th>notes</th>'."\n";
               $mailtxt .= '</TR>'."\n";
               while ($obj = mysql_fetch_object($query)) {
          	       $mailtxt .= '<TR valign="top">'."\n";
                    $mailtxt .= '    <td class="cellline">'. date(DATEFORMAT, strtotime($obj->ActionDate)).'</td>'."\n";
                    $mailtxt .= '    <td class="cellline">'.$obj->Subject_text.'</TD>'."\n";
                    $mailtxt .= '    <td class="cellline" width="70%">'.$obj->Notes.'</td>'."\n";
                    $mailtxt .= '</TR>'."\n";
               }
               $mailtxt .= "</TABLE>\n";
           }
           else
           {
               $mailtxt .= '<BR>';
               $mailtxt .= '<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="0" class="blockbody">'."\n";
               $mailtxt .= '<TR>'."\n";
               $mailtxt .= '<th >Datum</th><th>Onderwerp</th><th>notes</th>'."\n";
               $mailtxt .= '</TR>'."\n";
               $mailtxt .= '    <td class="cellline" colspan="3">Geen data</td>'."\n";
               $mailtxt .= '</TR>'."\n";
               $mailtxt .= "</TABLE>\n";
           }

     	  $mailtxt .= "<h3>Mocht bij onderzoek blijken dat het product niet stuk is of buiten de garantie valt dan zullen wij &euro;"
		  			. " 20,- onderzoeks en verzend kosten in rekening brengen.</h3>\n"
					. "<p>" . COMPANYNAME . " RMA<br>" . ADDRESS . "<br>" . ZIPCODE . " " . CITY . "<BR>Tel. ".TELEPHONE."<br>Fax. ". FAX ."</p>";
     	
     	  echo "$mailtxt";
     	 if (!$afdruk) {
     	  echo "<hr><INPUT TYPE=\"hidden\" NAME=\"rmaid\" SIZE=\"20\" CLASS=\"form\" value=\"$rmaid\">";
     	  echo "<INPUT TYPE=\"hidden\" NAME=\"print\" SIZE=\"20\" CLASS=\"form\" value=\"$print\">";
     	  echo "<TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\">\n";
     	  echo "<TR>\n";
     	  echo "<TD COLSPAN=\"1\"><INPUT TYPE=\"submit\" NAME=\"afdruk\" VALUE=\"Print\" CLASS=\"button\"></TD>\n";
     	  echo "<TD VALIGN=\"top\"><INPUT TYPE=\"hidden\" NAME=\"subject\" VALUE=\"RMA aanvraag nummer $rmaid\"></td>";
		  echo "<TD COLSPAN=\"1\"><INPUT TYPE=\"submit\" NAME=\"edit\" VALUE=\"Bewerk\" CLASS=\"button\"></TD>\n";
     	  if (!isset($_POST['verzendmaar'])) {
     		    echo "<TD COLSPAN=\"1\"><INPUT TYPE=\"submit\" NAME=\"verzendmaar\" VALUE=\"Verzend\" CLASS=\"button\"></TD>\n";
     			echo "<TD>Aan:</td><td><input type=\"text\" NAME=\"email\" size=\"20\" CLASS=\"form\" value=\"$email\">";
     			echo "</TD>\n";
     		} else {
    			$name = $GLOBALS["ary_config"]["emailname.rma"];
    			$myemail = $GLOBALS["ary_config"]["email.rma"];
				
     			$mailtxt = "A.u.b. uit printen en samen met kopie aankoop factuur bij uw RMA goederen aan ons sturen.<hr>" . $mailtxt;
     		    $mailtxt = $emailheader . "<body>\n" . $mailtxt . "<br></body></html>";
         		if (mail($email, 
                         "Uw " . COMPANYNAME . " RMA nummer $rmaid",
                         $mailtxt,
                         "From: $name <$myemail>\nCc:" . $GLOBALS["ary_config"]["email.rma"] . "\nContent-type: text/html")){
           			$sendok = "Ok";
     		    } else {
           			$sendok = "<b>Failed</b>";
        			}
     			echo "<td width=\"300\">Email verzend status: $sendok</td>";
     		}
     		echo "<td width=\"100%\" align=\"right\"><INPUT TYPE=\"button\" NAME=\"RMALIST\" onClick=\"location.replace('rma.php');\" VALUE=\"Return to list\">";
     		echo "</TR>\n";
     		echo "</TABLE>\n";
     	  }
     }
     else
     {
     	// Create a query to select the RMA 's for these criteria.
     	// Check which which records page need to be displayed.	
        $next = isset($_POST['next']) ;
        $priv = isset($_POST['priv']) ;
        
        $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;
        
        if ($next || $priv) {
            if ($next) {
               $startrec -= LIMITSIZE;
            } else if ($priv) {
               $startrec += LIMITSIZE;
            }
        } 
     	//echo "s:$startrec, n:$next, p:$priv";
     	// Get data
     	$sql = 'SELECT current_product_list.Productdescription, current_product_list.Productname, RMA.ID, RMA.aantal, RMA.contacts_id, '
     		.'contacts.CompanyName, RMA.State, RMA.ProductID, RMA.Customer_ID, RMA.SupplierID, RMA.Date_in, RMA.SN, '
     		.'RMA.Reason, RMA.Date_done, RMA.Additional_items, RMA.Aticle_code, RMA.aantal, '
     		.'RMA.FactuurID, RMA_state.State_text AS rma_State_text, RMA.Date_done, RMA_state.State_ID, '
			.'RMA.product_state, '
     		.'RMA.product_location, RMA.product_customer, '
     		.'RMA_product_location.State_ID, RMA_product_location.State_text, '
     		.'RMA_product_customer.State_ID, RMA_product_customer.State_text '
            .', current_product_list.Supplier '
     		.'FROM RMA '
			.'LEFT JOIN RMA_product_state ON RMA.product_state = RMA_product_state.id '
     		.'LEFT JOIN RMA_state ON RMA.State = RMA_state.State_ID '
     		.'LEFT JOIN RMA_product_location ON RMA.product_location = RMA_product_location.State_ID '
     		.'LEFT JOIN RMA_product_customer ON RMA.product_customer = RMA_product_customer.State_ID '
     		.'LEFT JOIN current_product_list ON RMA.ProductID = current_product_list.ProductID '
     		.'LEFT JOIN contacts ON RMA.contacts_id = contacts.ContactID ';

		    if ($bln_State_Open) {
			$str_not = TRUE;
			$str_State = '9';
	     	} else {
			$str_not = FALSE;
	     	}

			$sqlwhere = "";
     		$sqlwhere.=queryparm('Productdescription',$str_Productdescription,$sqlwhere);
     		$sqlwhere.=queryparm('Productname',$str_Productname,$sqlwhere);
     		$sqlwhere.=queryparm('aantal',$str_aantal,$sqlwhere);
     		$sqlwhere.=queryparm('contacts_id',$int_contacts_id,$sqlwhere,0);
            $sqlwhere.=queryparm('CompanyName',$str_company,$sqlwhere);
     		$sqlwhere.=queryparm('RMA.State',$str_State,$sqlwhere, '','AND',0);
     		$sqlwhere.=queryparm('Reason',$str_Reason,$sqlwhere);
     		$sqlwhere.=queryparm('RMA.ProductID',$int_ProductID,$sqlwhere);
     		$sqlwhere.=queryparm('Customer_ID',$int_Customer_ID,$sqlwhere);
     		$sqlwhere.=queryparm('SupplierID',$int_SupplierID,$sqlwhere);
            $sqlwhere.=queryparm('Supplier',$int_SupplierContactID, $sqlwhere);
     		$sqlwhere.=queryparm('Date_in',$str_Date_in,$sqlwhere);
            $sqlwhere.=queryparm('SN',$str_sn,$sqlwhere);
     		$sqlwhere.=queryparm('Aticle_code',$int_Article_code,$sqlwhere);
     		$sqlwhere.=queryparm('FactuurID',$int_FactuurID,$sqlwhere);
			$sqlwhere.=queryparm('Product_state',$int_Product_State,$sqlwhere);
     		$sqlwhere.=queryparm('Date_done',$str_Date_done,$sqlwhere);
     		$sqlwhere.=queryparm('RMA_product_location.State_ID',$int_prod_State_ID,$sqlwhere);
     		$sqlwhere.=queryparm('RMA_product_customer.State_ID',$int_cust_State_ID,$sqlwhere);
     		$sqlwhere.=queryparm('RMA.State',$int_State_ID,$sqlwhere);

		 $sql.= $sqlwhere . ' ORDER BY RMA.ID DESC';
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
          echo "         <TD>RMA ID</TD><TD><INPUT TYPE=\"text\" NAME=\"rmaid\" SIZE=\"20\" CLASS=\"form\" value=\"".$rmaid."\"></TD>\n";
          echo "         <TD>Company ID/Name</TD><TD><INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_contacts_id."\" OnChange=\"TempContacts_id.value = ContactID.value\">/";
     	  // removed workaround now it's fixed in the listbox function
          //echo preg_replace ("/<select name/", "<select OnChange=\"ContactID.value = TempContacts_id.value\" name",
     	  echo makelistbox('select ContactID, Companyname from contacts ORDER BY Companyname',
                           'TempContacts_id',
                           'ContactID',
                           'Companyname',
                           $int_contacts_id,
                           $formname,
                           "ContactID.value = TempContacts_id.value");
     	 echo "		    </TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Datum Melding</TD><TD><INPUT TYPE=\"text\" NAME=\"Date_in\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_Date_in."\">".Add_Calendar('rmaform.Date_in')."</TD>\n";
          echo "         <TD>Customer_ID</TD><TD><INPUT TYPE=\"text\" NAME=\"Customer_ID\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_Customer_ID."\">";
     	 echo "             Factuur nr: <INPUT TYPE=\"text\" NAME=\"FactuurID\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_FactuurID."\"></TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Leverancier</TD><TD>". makelistbox('SELECT CompanyName, ContactID FROM contacts WHERE Supplier_yn<>0 ORDER BY CompanyName',
                                                                'SupplierContactID',
                                                                'ContactID',
                                                                'CompanyName',
                                                                $int_SupplierContactID, 
                                                                TRUE) . "</td>\n";

          echo "         <TD>Artikel nr</TD><TD><INPUT TYPE=\"text\" NAME=\"ProductID\" SIZE=\"20\" CLASS=\"form\" value=\"$int_ProductID\">$str_Productname";
		  echo "</TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Aantal</TD><TD><INPUT TYPE=\"text\" NAME=\"aantal\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_aantal."\"></TD>\n";
          echo "         <TD>Artikel</TD><TD>";
		  echo "<INPUT TYPE=\"text\" NAME=\"ProductSearch\" SIZE=\"20\" CLASS=\"form\" value=\"".$_POST['ProductSearch']."\">";
		  echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "ProductSearch", "rmaform.ProductID");
     	  echo "		</TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>State_text</TD><TD>".makelistbox('select State_ID, State_text from RMA_state order by State_text','State_ID','State_ID','State_text',$int_State_ID)."</TD>\n";
          echo "         <TD>Productdescription</TD><TD><INPUT TYPE=\"text\" NAME=\"Productdescription\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_Productdescription."\"></TD>\n";
          echo "    </TR>\n";
          echo "    <TR>\n";
          echo "         <TD>Product state</TD><TD>".makelistbox('select State_ID, State_text from RMA_product_location order by State_text','prod_State_ID','State_ID','State_text',$int_prod_State_ID)."</TD>\n";
          echo "         <TD>Customer pr. state</TD><TD>".makelistbox('select State_ID, State_text from RMA_product_customer order by State_text','cust_State_ID','State_ID','State_text',$int_cust_State_ID)."</TD>\n";
          echo "    </TR>\n";
          echo "         <TD>Supplier ID</TD><TD><INPUT TYPE=\"text\" NAME=\"SupplierID\" SIZE=\"20\" CLASS=\"form\" value=\"".$int_SupplierID."\"></TD>\n";
          echo "         <TD>Serienummer</TD><TD><INPUT TYPE=\"text\" NAME=\"sn\" SIZE=\"20\" CLASS=\"form\" value=\"".$str_sn."\"></TD>\n";
          echo "    <TR>\n";
		  echo "    </TR>\n";
          echo "         <TD>Alleen openstaand?</TD><TD>" .  MakeCheckbox("State_Open", $bln_State_Open) . "</TD>\n";
          echo "    <TR>\n";
          echo '	<TD COLSPAN="3" >';

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
          echo "    </TD><TD ALIGN='right'><INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Zoeken\" CLASS=\"button\">\n";
          echo "    <INPUT TYPE=\"submit\" NAME=\"new_rma\" VALUE=\"Nieuw\" CLASS=\"button\"></TD>\n";
          echo "    </TR>\n";
          echo "</TABLE>\n";
		  // Set cursor on the rma id field.		  
		  echo '<script TYPE="text/javascript" language="JavaScript">document.rmaform.rmaid.focus();</script>';

          echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">'."\n"
                 .'<tr>'
                   .'<th>RMA ID</th>'
                   .'<th>Datum</th>'
                   .'<th>Bedrijf</th>'
                   .'<th>Artikel</th>'
                   .'<th>#</th>'
                   .'<th>State</th>'
                   .'<th>sn.</th>'
                 .'</tr>';


          while ($obj = mysql_fetch_object($query)) {
               echo '<tr>'."\n"
                    .'<td><a href=rma.php?rmaid='.$obj->ID.'>'.$obj->ID.'</a></td>'
                    .'<td>'.$obj->Date_in.'</td>'
                    .'<td>'.$obj->CompanyName.'</td>'
                    .'<td>'.$obj->Productname.'</td>'
                    .'<td>'.$obj->aantal.'</td>'
                    .'<td>'.$obj->rma_State_text.'</td>'
                    .'<td>'.$obj->SN.'</td>'
                   ."\n".'</tr>';
          }

     	 mysql_free_result($query);
     	
     	 echo "</TABLE>\n";
     }

     //mysql_free_result($query);


     ?>
     </table>
     <?

     echo "</FORM>\n";

printenddoc();
?>
