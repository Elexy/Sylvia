<?php
 /*
 * shipment.php
 *
 * @version $Id: boxlist.php,v 1.36 2007-09-21 20:12:35 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");
include ("includes/ship_label_functions.php");

define ("ROTATE_ANGLE", 90);
define ("ROTATE_POINT_X", 73);
define ("ROTATE_POINT_Y", 25);

$header = array(); // Array to hold the header.
$tabledata = array(); // Array to hold the table data.
$int_rowcnt = 0; // Array row counter.

// Get all the URL variable we need.
$int_shipmentID = isset($_GET["shipment"]) ? $_GET["shipment"] : FALSE;
$int_box = isset($_GET["box"]) ? $_GET["box"] : FALSE;
$int_max_box = isset($_GET["maxbox"]) ? $_GET["maxbox"] : FALSE;
$str_format = isset($_GET["format"]) ? $_GET["format"] : "html";
$bl_gls =  isset($_GET["gls"]);
$bl_pdf = !strcasecmp($str_format, FORMAT_PDF);

$int_gls_pagecount = 0;
$ary_gls_pages = array();
$int_current_pagecount = 0;
$pdf_cust_page = NULL;
$str_gls_filname = FALSE;

$ary_lang = array();
$ary_head_contacts = array();

if ($bl_pdf) {

    if (!get_box_numbers(&$boxquery, $int_shipmentID)) echo "No box number returned by get_box_numbers";
    $int_max_box=mysql_num_rows($boxquery);
    
    $bl_drop_ship = FALSE;
    $int_cust_id = 0;
    $bl_cust_pdf_loaded = FALSE;
    $qry_rest_cust = $db_iwex->query("SELECT AdressID, Adressen.ContactID, adrestitel, languages.language
                                      FROM shipments
                                      INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
									  LEFT JOIN contacts ON Adressen.ContactID = contacts.ContactID
									  LEFT JOIN languages ON languages.languageID = contacts.languageID 
                                      WHERE Shipment_ID = ".$int_shipmentID."");
    if ($obj_cust = mysql_fetch_object($qry_rest_cust)) {
        $bl_drop_ship = $obj_cust->adrestitel == DB_DROP_SHIP_ADRESTITEL;
        $int_cust_id = $obj_cust->ContactID;
		$ary_lang = $ary_languages["$obj_cust->language"];
		// Get head contacts to find templates from above.
		$ary_head_contacts = GetHeadContacts($int_cust_id, TRUE);
    }
    mysql_free_result($qry_rest_cust);
    
	$str_manco = $ary_lang["delivery_mancoalert"];
    //Instanciation of inherited class
    $pdf=new PakagelistPDF('P','mm','A4');
    $pdf->AddFont('code39');
    $pdf->SetMargins(15,15,15);
    $pdf->Open();
    $pdf->AliasNbPages();
    
    // When GLS shipping include the GLS label in the PDF.
    if ($bl_gls) {
        $str_gls_filname = $GLOBALS["ary_config"]["temp_dir"]."/gls$int_shipmentID.pdf";
        $int_gls_pagecount = MakeGLSlabel($int_shipmentID, $str_gls_filname);
        $int_pagecount = $pdf->setSourceFile($str_gls_filname);
        for ($i = 1; $i <= $int_pagecount; $i++) {
            $ary_gls_pages[$i] = $pdf->ImportPage($i);
        }
    }
	if ($bl_drop_ship || count($ary_head_contacts)) {
		$bl_found = FALSE; // Only import the first one found.
		foreach ($ary_head_contacts as $int_value) {
			$str_cust_filname = $GLOBALS["ary_config"]['customerdocs']."/". 
								CUST_PACKING_LIST_FILE_NAME."$int_value.pdf";
			
			if (!$bl_found && file_exists($str_cust_filname)) {
				$bl_cust_pdf_loaded = $pdf->setSourceFile($str_cust_filname);
				$pdf_cust_page = $pdf->ImportPage(1);
				$bl_found = TRUE;
			}
		}
        
        // When no template found check if there is a template for the own customer.
        $str_cust_filname = $GLOBALS["ary_config"]['customerdocs']."/". 
            CUST_PACKING_LIST_FILE_NAME.$GLOBALS["ary_config"]['own company'].".pdf";
			
        if (!$bl_found && file_exists($str_cust_filname)) {
            $bl_cust_pdf_loaded = $pdf->setSourceFile($str_cust_filname);
            $pdf_cust_page = $pdf->ImportPage(1);
        }
    }

    if ($int_max_box > 1) while ($objbox = mysql_fetch_object($boxquery)) {
        $int_box = $objbox->box_number;
        // Reset row data.
        $tabledata = array(); // Array to hold the table data.
        $int_rowcnt = 0; // Array row counter.

if ($int_shipmentID&&$int_box) {
    // Create a query to make the packinglist.
    $sql_packing_shipment = "SELECT Shipment_ID, Ship_date, Tracking, AdressID,
        adrestitel, Naam as shipname, attn, straat, huisnummer, postcode, plaats, land,
        CompanyName, Address, City, Region, PostalCode, country.country, Paymentterm, contacts.ContactID
        FROM shipments
        INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
        INNER JOIN contacts ON contacts.ContactID = Adressen.ContactID
        INNER JOIN country ON Adressen.land = country.code
        WHERE Shipment_ID = ".$int_shipmentID.";";

//    echo $sql_packing_shipment;
    $packlist_query = mysql_query($sql_packing_shipment)
        or die("Ongeldige select orders query: " .$sql_packing_shipment. mysql_error());
    $obj = mysql_fetch_object($packlist_query);

        $pdf->SetBox($int_box, 
                     $int_max_box,
                     $obj->ContactID,
                     $obj->Shipment_ID,
                     !$bl_gls && !$bl_cust_pdf_loaded);
	    $pdf->AddPage();
        $int_current_pagecount ++;
        
        if ($bl_gls) {
            $pdf->Rotate(ROTATE_ANGLE,
                         ROTATE_POINT_X,
                         ROTATE_POINT_Y);
            $pdf->useTemplate($ary_gls_pages[$int_current_pagecount],10,10);
            $pdf->Rotate(0);
            $pdf->Ln(50);
        } else { 
            // When there is a customer packing list template include that one.
            if ($bl_cust_pdf_loaded) {
                $pdf->useTemplate($pdf_cust_page,0,0);
            }
            $pdf->SetFont('Arial','B',15);
            
            $pdf->SetWidths(array(59.5,30,89.5));
            $pdf->SetAligns(array('L','L','L'));
            $pdf->SetBorders(array('','','',''));
            $pdf->SetHight(7);
    
            $str_shipto = "$obj->shipname\n";
            if ($obj->attn != "") {
                $str_shipto  .= $ary_lang["delivery_attn"] . " $obj->attn\n";
            }
            $str_shipto .= "$obj->straat $obj->huisnummer\n"
                          ."$obj->postcode  $obj->plaats\n"
                          ."$obj->country";
            $pdf->Row(array("",
                            $ary_lang["delivery_custaddr"],
                            $str_shipto));
            $pdf->Ln(6);
        }

        $pdf->SetWidths(array(PAGE_WIDTH/3, PAGE_WIDTH/3, PAGE_WIDTH/3));
		$pdf->SetAligns(array('C','C','C'));
		$pdf->SetBorders(array('F','F','F'));
		$pdf->SetHight(4);
        $pdf->PDFtable(array($ary_lang["delivery"], $ary_lang["delivery_custnum"], $ary_lang["delivery_senddate"]),
                       array(array($int_shipmentID,
                                   $obj->ContactID,
                                   date("j-n-Y",strtotime($obj->Ship_date))
                                   )
                            )
                       );
                       
        $pdf->Ln(5);
        $pdf->SetWidths(array(15,35,15,20,79,15));
		$pdf->SetAligns(array('C','C','R','L','L','R'));
		$pdf->SetBorders(array('F','F','F','F','F','F'));
		$pdf->SetHight(4);
        $header = array($ary_lang["delivery_orderid"], $ary_lang["delivery_ref"], $ary_lang["delivery_productid"],
						$ary_lang["delivery_merk"], $ary_lang["delivery_productid"], $ary_lang["delivery_amount"]);

    
    // Create a query to select the shipmentdetails (inventory transactions.
    $sql_packing_details = "SELECT TransactionID, TransactionDate, inventory_transactions.ProductID, Description, inventory_transactions.box_ID, box_number,
        inventory_transactions.OrderID, TransactionDescription, UnitPrice, sum(UnitsSold) as UnitsSold, sum(UnitsShrinkage) as UnitsShrinkage,
		btw_percentage, Productname, ContactsOrderID, Merk, current_product_list.ExternalID, sku
        FROM inventory_transactions
        INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
        INNER JOIN box ON inventory_transactions.box_ID = box.box_ID
        INNER JOIN orders ON orders.OrderID = inventory_transactions.OrderID
        WHERE ShipmentID = $int_shipmentID AND box_number = $int_box
                AND ContactsOrderID <> '".RMA_CREDIT_TEXT."'
        GROUP BY OrderID, ProductID, box_ID ORDER BY OrderID, ProductID";
    $packlist_det_query = mysql_query($sql_packing_details)
     or die("Ongeldige select orders query: " .$sql_packing_details. mysql_error());

    $int_rowcnt = 0;
    while ($objpackingdet = mysql_fetch_array($packlist_det_query, MYSQL_BOTH)) {
        if ($objpackingdet["UnitsSold"] 
            &&
            $objpackingdet["sku"] != DB_SKU_SOFTBUNDEL) {
               $tabledata[$int_rowcnt++] = array($objpackingdet["OrderID"],
                                                 $objpackingdet["ContactsOrderID"],
                                                 $objpackingdet["ProductID"],
                                                 $objpackingdet["Merk"],
												 $objpackingdet["Productname"],
												 $objpackingdet["UnitsSold"]);
        } else if ($objpackingdet["UnitsShrinkage"]) {
            $tabledata[$int_rowcnt++] = array($objpackingdet["OrderID"],
                                              $objpackingdet["ContactsOrderID"],
                                              $objpackingdet["ProductID"],
                                              $objpackingdet["Merk"],
                                              $objpackingdet["TransactionDescription"]." (".  $objpackingdet["Productname"].")",
                                              $objpackingdet["UnitsShrinkage"]);
        }
    }
    mysql_free_result($packlist_det_query);
        $pdf->PDFtable($header, $tabledata);
        $pdf->Ln(10);
}

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(179,4,$str_manco,0,1,'L');


    } // End while ($objbox = mysql_fetch_object($boxquery))

	// Create a query to select the shipment
    $sql_shipments = SQL_SHIPMENTS . "WHERE Shipment_ID = $int_shipmentID AND Cancel = 0";

    $query = mysql_query($sql_shipments)
       or die("Ongeldige query: " . mysql_error());

    while ($objshipment = mysql_fetch_object($query)) {
        $pdf->SetBox(DELIVERY_NOTE_ID, 
                     DELIVERY_NOTE_ID, 
                     $objshipment->ContactID, 
                     $objshipment->Shipment_ID, 
                     !($bl_gls && $int_max_box == 1) && !$bl_cust_pdf_loaded);
	    $pdf->AddPage();
        $int_current_pagecount++;
        
        if ($bl_gls && $int_max_box ==1) {
            $pdf->Rotate(ROTATE_ANGLE,
                         ROTATE_POINT_X,
                         ROTATE_POINT_Y);
            $pdf->useTemplate($ary_gls_pages[$int_current_pagecount],10,10);
            $pdf->Rotate(0);
            $pdf->Ln(50);
        } else {
            // When there is a customer packing list template include that one.
            if ($bl_cust_pdf_loaded) {
                $pdf->useTemplate($pdf_cust_page,0,0);
            }

            $pdf->SetFont('Arial','',10);
    
            $pdf->SetFont('Arial','B',15);
            
            $pdf->SetWidths(array(49.5,40,89.5));
            $pdf->SetAligns(array('L','L','L'));
            $pdf->SetBorders(array('','','',''));
            $pdf->SetHight(7);
    
            $str_shipto = "$objshipment->Naam\n";
            if ($objshipment->attn != "") {
                $str_shipto  .= $ary_lang["delivery_attn"] . " $objshipment->attn\n";
            }
            $str_shipto .= "$objshipment->straat $objshipment->huisnummer\n"
                          ."$objshipment->postcode  $objshipment->plaats\n"
                          ."$objshipment->land_naam";
            $pdf->Row(array("",
                            $ary_lang["delivery_deliveryaddr"],
                            $str_shipto));
            $pdf->Ln(7);
        }
        
        $pdf->SetWidths(array(PAGE_WIDTH/3, PAGE_WIDTH/3, PAGE_WIDTH/3));
		$pdf->SetAligns(array('C','C','C'));
		$pdf->SetBorders(array('F','F','F'));
		$pdf->SetHight(4);
        $pdf->PDFtable(array($ary_lang["delivery"], $ary_lang["delivery_custnum"], $ary_lang["delivery_senddate"]),
                       array(array($int_shipmentID,
                                   $objshipment->ContactID,
                                   date("j-n-Y",strtotime($objshipment->Ship_date))
                                   )
                            )
                       );
        $pdf->Ln(25);
	   // Store customer ID for later use.
	   $int_customerID = $objshipment->ContactID;
	}
	mysql_free_result($query);
	
	$sql_orders = "SELECT DISTINCT inventory_transactions.OrderID, ContactsOrderID, OrderDate, Comments, rma_yn
			FROM inventory_transactions
			INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
			WHERE shipmentID = $int_shipmentID
                AND ContactsOrderID <> '".RMA_CREDIT_TEXT."'";
	$query_orders = mysql_query($sql_orders)
       or die("Ongeldige query: " . mysql_error());

    while ($obj_orders = mysql_fetch_object($query_orders)) {
        $sql_inventoryt = "SELECT inventory_transactions.ProductID,
			current_product_list.ProductName, inventory_transactions.Description, TransactionDescription,
			inventory_transactions.UnitPrice, sum(UnitsSold) as UnitsSold, Quantity, store_serial_yn,
            inventory_transactions.btw_percentage, added_cost, to_deliver, Merk, sku, sum(UnitsShrinkage) as UnitsShrinkage,
            CustOrderRowID, EAN
			FROM inventory_transactions
            LEFT JOIN order_details ON (order_details.OrderID = inventory_transactions.OrderID
										 AND order_details.OrderDetailsID = inventory_transactions.OrderDetailsID)
	        INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
       		WHERE shipmentID = $int_shipmentID 
                    AND inventory_transactions.OrderID = $obj_orders->OrderID
            GROUP BY order_details.OrderDetailsID, inventory_transactions.ProductID
            ORDER BY order_details.OrderDetailsID, inventory_transactions.TransactionID";
	    $query_invetory = mysql_query($sql_inventoryt)
       	     or die("Ongeldige query: " . mysql_error());
        
        //set the varaible to recognise an rma order
        $bl_rma = isset($obj_orders->rma_yn) ? $obj_orders->rma_yn : FALSE;
        
        if ($bl_rma) {
            $header = array($ary_lang["delivery_id"], $ary_lang["delivery_ean"], $ary_lang["delivery_rmaid"],
			$ary_lang["delivery_merk"], $ary_lang["delivery_name"], $ary_lang["delivery_ref"], '', $ary_lang["delivery_deliverd"]);
            $str_header = "$obj_orders->ContactsOrderID";
        } else {
            $header = array($ary_lang["delivery_id"], $ary_lang["delivery_ean"], $ary_lang["delivery_extid"],
			$ary_lang["delivery_merk"], $ary_lang["delivery_name"], $ary_lang["delivery_orderd"], $ary_lang["delivery_Backorder"],
			$ary_lang["delivery_deliverd"]);
            $str_header = $lang["delivery_orderref"] . " $obj_orders->ContactsOrderID";
        }        
        $str_header .= "           "
                      . $ary_lang["delivery_ourordernum"] . " $obj_orders->OrderID           "
                      . $ary_lang["delivery_orderdate"] . " " . date("j-n-Y",strtotime($obj_orders->OrderDate));

        $pdf->SetWidths(array(11.5, 23, 21, 20, 63.5, 13, 14, 13));
		$pdf->SetAligns(array('R','R','L','L','L','R','R','R'));
		$pdf->SetBorders(array('F','F','F','F','F','F','F','F'));
		$pdf->SetHight(4);
        
		$flt_thisrow_order_cost = 0;
		$int_rowcnt = 0;
		$flt_max_vat = 0;
		$tabledata = array();
		while ($obj_inventory = mysql_fetch_object($query_invetory)) {
			$obj_inventory->to_deliver = $obj_inventory->to_deliver ? $obj_inventory->to_deliver : '-';

            if ($bl_rma) {
                $str_ext_ID_column = GetField("SELECT RMAID FROM RMA_actions WHERE ActionID = $obj_inventory->Description");
                $str_name_column = $obj_inventory->ProductName;
				$str_quantity_column = GetField("SELECT ".($obj_orders->ContactsOrderID == RMA_RETOUR_SUPPLIER_TEXT 
															? "RMA.SupplierID"
															: "RMA.Customer_ID")." FROM RMA_actions 
                        INNER JOIN RMA ON RMA_actions.RMAID = RMA.ID
                        WHERE RMA_actions.ActionID = $obj_inventory->Description");
                $str_to_deliver_column = '';
            } else {
                $str_quantity_column = $obj_inventory->Quantity;
                $str_to_deliver_column = $obj_inventory->to_deliver;
                $str_name_column = $obj_inventory->ProductName;
                $str_ext_ID_column = $obj_inventory->CustOrderRowID;
            }
            
            if ($obj_inventory->UnitsShrinkage) {
                // Part of softbundel
                $str_name_column = "  $obj_inventory->TransactionDescription ($obj_inventory->ProductName)";;
                $int_sold = $obj_inventory->UnitsShrinkage;
                $str_ID_column = "  $obj_inventory->ProductID";
            } else {
                $int_sold = $obj_inventory->UnitsSold;
            }

            $tabledata[$int_rowcnt++] = array($obj_inventory->ProductID,
			         						  $obj_inventory->EAN,
                                              $str_ext_ID_column,
                                              $obj_inventory->Merk,
                                              $str_name_column,
                                              $str_quantity_column,
                                              $str_to_deliver_column,
                                              $int_sold);
		}
        mysql_free_result($query_invetory);
		
        $pdf->PDFtable($header, $tabledata, $str_header);
        // Generate the PDF table.
        $pdf->Ln(3);
    }
    
    $sql_products = "SELECT DISTINCT inventory_transactions.ProductID, current_product_list.ProductName
                     FROM inventory_transactions
                     INNER JOIN current_product_list ON current_product_list.ProductID=inventory_transactions.ProductID
                     WHERE shipmentID = '$int_shipmentID' AND store_serial_yn";
	$query_products = $db_iwex->query($sql_products);

    $header = array($ary_lang["delivery_product"], $ary_lang["delivery_serienum"]);
    $pdf->SetWidths(array(12, 167));
    $pdf->SetAligns(array('R','L'));
    $pdf->SetBorders(array('F','F'));
    $pdf->SetHight(4);
    $tabledata = array();
    
    while ($obj_products = mysql_fetch_object($query_products)) {
        $tabledata[] = array($obj_products->ProductID,
                             implode(", ", GetSerialNumbers($obj_products->ProductID,
                                                            $int_shipmentID)));
    }

    // Only print when there are records.
    if (count($tabledata)) {
        $pdf->Ln(3);
        $pdf->PDFtable($header, $tabledata, $ary_lang["delivery_listserienum"]);
    }
    
    $pdf->Ln(7);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(179,4,$str_manco,0,1,'L');

    $pdf->Output();
    
    // remove file if there is one.
    if ($str_gls_filname) unlink($str_gls_filname);
} // End if bl_pdf

?>
