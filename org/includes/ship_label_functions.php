<?php
/**
 *
 *
 * @version $Id: ship_label_functions.php,v 1.12 2007-10-04 09:59:18 alex Exp $
 * @copyright $date:
 **/
define("ERROR_CREATE_SHIPPER_QUERY", "Ongeldige create shipper label query: ");
define("MARGIN", 2);
define("ZIPCODE_SIZE_GLS", 7);

/**
 * Function     : GetCheckDigit
 * Get the GLS check digit.
 * Input        : $str_code: the input code to calculate
 * Returns		: The calulated check digit.
 **/
function GetCheckDigit($str_code) {
	$int_check_digit = 0;
	$ary_factor = array(3,1);
	$int_sum = 0;
	
	for ($i = 0; $i < strlen($str_code); $i++) {
		$int_sum += $ary_factor[$i%2] * $str_code[$i];
	}
	
	$int_check_digit = (10 - ($int_sum % 10)) %10;
	return (int) $int_check_digit;
}

/**
 * Function     : MakeGLSlabel
 * Make the GLS shipping label
 * Input        :$int_shipment_id
 *               $str_filename, filename to store it to. 
 * Returns		: The amount of pages in the PDF.
 **/
function MakeGLSlabel($int_shipment_id,
                      $str_filename = FALSE) {
    $int_pagecount = 0;
    if ($int_shipment_id) {
        $flt_weight = 0;
        $ary_boxid = array();
        
        // Create a query to select the shipment
        $sql_shipments = SQL_SHIPMENTS . "WHERE Shipment_ID = $int_shipment_id";
    
        $query = mysql_query($sql_shipments)
           or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
    
        if (mysql_num_rows($query)) {
            while ($objshipment = mysql_fetch_object($query)) {
               $str_shipname = $objshipment->Naam;
               $str_attn = $objshipment->attn;
               $str_shipaddress = "$objshipment->straat $objshipment->huisnummer";
               $str_shipcity = $objshipment->plaats;
               $str_shipZip = trim($objshipment->postcode);
               $str_shipcountry = $objshipment->land_naam;
               $str_ship_iso = $objshipment->iso_code;
               $str_shipcountrycode = $objshipment->land;
               $int_customerid = $objshipment->ContactID;
               $str_companyname = $objshipment->CompanyName;
               $str_address = $objshipment->Address;
               $str_region = $objshipment->Region;
               $str_city = $objshipment->City;
               $str_zipcode = $objshipment->PostalCode;
               $str_country = $objshipment->Country;
               $str_phone = $objshipment->Phone;
               $str_taxID = $objshipment->btw_number;
               $int_adres_titel = $objshipment->adrestitel;
            }
            mysql_free_result($query);   
            
            $sql_orders = "SELECT DISTINCT inventory_transactions.OrderID
                    FROM inventory_transactions 
                    INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
                    WHERE shipmentID = $int_shipment_id";
            $query_orders = mysql_query($sql_orders)
               or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
        
            while ($obj_orders = mysql_fetch_object($query_orders)) {
               
               $sql_inventoryt = "SELECT 
                     UnitPrice, UnitsSold, btw_percentage, added_cost, weight_corr, box_ID 
                    FROM inventory_transactions 
                    INNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID
                    WHERE shipmentID = $int_shipment_id AND OrderID = $obj_orders->OrderID";
               $query_invetory = mysql_query($sql_inventoryt)
                     or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
                
                while ($obj_inventory = mysql_fetch_object($query_invetory)) {
                   $flt_weight += $obj_inventory->weight_corr * $obj_inventory->UnitsSold;
                }
                mysql_free_result($query_invetory);
            }
            mysql_free_result($query_orders); 
        }
        $int_numofbox = count($ary_boxid);
        unset($ary_boxid);
        
        $pdf=new PDF_MC_Table('P','mm', array(80, 150));
        $pdf->Open();
        $pdf->SetMargins(MARGIN, MARGIN, MARGIN);
        $pdf->SetAutoPageBreak(1, 2);
        $sql_box = "SELECT box_ID 
            FROM box 
            WHERE Shipment_ID = $int_shipment_id";
        $query_box = mysql_query($sql_box)
             or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
        
        $int_numofbox = mysql_num_rows($query_box);
        $box = 1;
        $int_rembours_admin = 3; // When rembours we need 2 admin pages (3 pages in total).
        while ($obj_box = mysql_fetch_object($query_box)) {
            do {
                $pdf->AddPage();
                $int_pagecount++; // Increase the pagecounter.
                
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(55,5,"GLS Netherlands",0,1,'L');
                $pdf->SetTextColor(255);
                $pdf->SetDrawColor(255);
                $pdf->Cell(75,5,"GEADRESSEERDE:",0,1,'L',1);
            
                $pdf->SetFont('Arial','B',11);
                $pdf->SetTextColor(0);
                $pdf->SetWidths(array(75));
                $pdf->SetAligns(array('L'));
                $pdf->SetBorders(array(''));
                $pdf->SetHight(5);
                $pdf->Row(array("$str_shipname\nT.a.v. $str_attn\n$str_shipaddress"));
    
                $str_shipZip = str_replace(' ', '', $str_shipZip);			
                $pdf->SetFont('Arial','B',18);
                $pdf->Cell(35,8,"$str_shipZip",0,0,'L',0);
                $pdf->SetFont('Arial','B',14);
                $pdf->Cell(45,7,strtoupper($str_shipcity),0,1,'L',0);
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(35,7,"$str_shipcountrycode $str_shipcountry",0,0,'L',0);
                $pdf->Code128($pdf->GetX()+2.9, $pdf->GetY(), $str_shipZip, 0.4);
                $pdf->Ln(6);
                $pdf->SetTextColor(255);
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(35,5,"AFZENDER:",0,0,'L',1);
                $pdf->Cell(40,5,date("d-m-Y"),0,1,'R',1);
            
                $pdf->Image($_SERVER['DOCUMENT_ROOT'].'/images/IwexLogoBW_contrast.png',
                            58,
                            $pdf->GetY()+1,
                            20);
        
                $pdf->SetTextColor(0);
                $pdf->SetHight(5);
                $pdf->SetFont('Arial','B',11);	
                $pdf->Row(array(IWEX_ADRES_INFO));
                $pdf->SetLineWidth(0.5);
                $pdf->SetDrawColor(0);
                $pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX()+75,$pdf->GetY());
                $flt_amount = GetField("SELECT (Invoice_total + Invoice_BTW) AS amount
                                       FROM invoices
                                       WHERE paymentterm = ".PAYMENTERM_ID_REMBOURS." AND shipmentID = '$int_shipment_id'");
                if ($flt_amount > 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',16);
                    $pdf->Cell(35,5,"REMBOURS:",0,0,'L',0);
                    $pdf->SetFont('Arial','B',12);
                    $pdf->Cell(35,5,"EUR $flt_amount",0,0,'L',0);
                    $pdf->Ln(8);
        
                    $str_docnum = 90000+$obj_box->box_ID;
                    $int_rembours_admin--;
                } else {
                    $pdf->Ln(15);
                    $str_docnum = $obj_box->box_ID;
                    $int_rembours_admin = 0;
                }
                
                $pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX()+75,$pdf->GetY());
                $pdf->Ln(3);
                if ($str_shipcountrycode == 'NL') {
                    $str_ref_1_4 = substr($str_shipZip, 0, 4);
                } else {
                    $str_ref_1_4 = "E$str_ship_iso";
                }
                $str_ref_5_13 = sprintf("%-9d",$int_shipment_id);
                $str_ref_14_20 = sprintf("%07d", $flt_amount*100);
                
                if ($int_rembours_admin) {
                    $pdf->SetFont('Arial','B',16);
                    $pdf->Cell(75,5,"REF: $str_ref_5_13",0,1,'L',0);
                    $pdf->Ln(3);
                    $pdf->Cell(75,5,"Administratiebewijs C$int_rembours_admin",0,0,'L',0);
                    $pdf->Ln(10);
                } else {
                    $pdf->Code128($pdf->GetX()+1, 
                                 $pdf->GetY(), 
                                 $str_ref_1_4.$str_ref_5_13.$str_ref_14_20, 
                                 0.3, 
                                 10);
                    $pdf->Ln(18);
                }
                $pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX()+75,$pdf->GetY());
                $pdf->Ln(6);
                $pdf->SetDrawColor(0);	
                
                $str_gls_code = GLS_ACCOUNT_NUMBER.sprintf("%05d", $str_docnum);
                $str_gls_full_code = $str_gls_code.GetCheckDigit($str_gls_code);
        //		echo "'$str_gls_code".GetCheckDigit($str_gls_code)."'<br>";
                if ($int_rembours_admin) {
                    $pdf->SetFont('Arial','B',16);
                    $pdf->Cell(75,5,"GLS: $str_gls_full_code",0,0,'L',0);
                } else {
                    $pdf->CodeInter2of5($pdf->GetX()+5, 
                                  $pdf->GetY(), 
                                  $str_gls_full_code, 0.6, 25, 2,0);
                    //var_dump($str_gls_code);
                    //var_dump($str_gls_full_code);
                    if ($box==1) {
                        mysql_query("UPDATE shipments 
                            SET Tracking = '$str_gls_full_code'
                            WHERE shipment_ID = '$int_shipment_id'")
                            or die("Error update shipment in ship_label shipid = $int_shipment_id. ". mysql_error());
                    }
					UpdateBox($obj_box->box_ID,
							  $str_gls_full_code,
							  $flt_weight/$int_numofbox);
                }
            } while ($int_rembours_admin && $box==1);
            $box++;
        }
    
        /*$pdf->CodeInter2of5($pdf->GetX()+5, 
                                  $pdf->GetY(), 
                                  '17330115000030', 0.6, 25, 2,0);*/
      
        if ($str_filename) {
            // Store it to a file
            $pdf->Output($str_filename, "F");
        } else {
            // Show it on the screen.
            $pdf->Output();
        }
    
        mysql_free_result($query_box);	
    }
    
    return $int_pagecount;
}

/**
 * Function     : MakeDHLlabel
 * Make the DHL shipping label
 * Input        :$int_shipment_id
 *               $str_filename, filename to store it to. 
 *                        When not given screen is used.
 * Returns		: The amount of pages in the PDF.
 **/
function MakeDHLlabel($int_shipment_id,
                      $str_filename = FALSE) {
    $int_pagecount = 0;
	$str_file = "";
	
    if ($int_shipment_id) {
        $flt_weight = 0;
        $ary_boxid = array();
        
        // Create a query to select the shipment
        $sql_shipments = SQL_SHIPMENTS . "WHERE Shipment_ID = $int_shipment_id";
    
        $query = mysql_query($sql_shipments)
           or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
    
        if (mysql_num_rows($query)) {
            if ($objshipment = mysql_fetch_object($query)) {
               $str_shipname = strtoupper($objshipment->Naam);
               $str_attn = strtoupper($objshipment->attn);
               $str_shipstreet = strtoupper($objshipment->straat);
			   $str_shipstreet_num = strtoupper($objshipment->huisnummer);
               $str_shipcity = strtoupper($objshipment->plaats);
               $str_shipZip = strtoupper(trim($objshipment->postcode));
               $str_shipcountry = strtoupper($objshipment->land_naam);
			   $str_ship_country_code = $objshipment->land;
			   if ($objshipment->land == 'NL'
							   ||
							   $objshipment->land == 'BE'
							   ||
							   $objshipment->land == 'LU') {
				  $str_tsr_code = '01';	// TSR code 01 fore benelux and 02 for other.
				  $str_cpt_code = '39'; // CPT code 39
				  $bl_benelux = TRUE;
			   } else { 
				  $str_tsr_code = '02'; // TSR code 01 fore benelux and 02 for other.
				  $str_cpt_code = '50';	// CPT code 50 for outsite benelux
				  $bl_benelux = FALSE;
			   }
               $str_shipcountrycode = $objshipment->land;
               $int_customerid = $objshipment->ContactID;
               $str_companyname = $objshipment->CompanyName;
               $str_address = $objshipment->Address;
               $str_region = $objshipment->Region;
               $str_city = $objshipment->City;
               $str_zipcode = $objshipment->PostalCode;
               $str_country = $objshipment->Country;
               $str_phone = $objshipment->Phone;
               $str_taxID = $objshipment->btw_number;
               $int_adres_titel = $objshipment->adrestitel;
			   $date_shipdate = $objshipment->Ship_date;
            }
            mysql_free_result($query);   
            
            $sql_orders = "SELECT DISTINCT inventory_transactions.OrderID
                    FROM inventory_transactions 
                    INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
                    WHERE shipmentID = $int_shipment_id";
            $query_orders = mysql_query($sql_orders)
               or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
        
            while ($obj_orders = mysql_fetch_object($query_orders)) {
               
               $sql_inventoryt = "SELECT 
                     UnitPrice, UnitsSold, btw_percentage, added_cost, weight_corr, box_ID 
                    FROM inventory_transactions 
                    INNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID
                    WHERE shipmentID = $int_shipment_id AND OrderID = $obj_orders->OrderID";
               $query_invetory = mysql_query($sql_inventoryt)
                     or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
                
                while ($obj_inventory = mysql_fetch_object($query_invetory)) {
                   $flt_weight += $obj_inventory->weight_corr * $obj_inventory->UnitsSold;
                }
                mysql_free_result($query_invetory);
            }
            mysql_free_result($query_orders); 
        }
        $int_numofbox = count($ary_boxid);
        unset($ary_boxid);
        
        $pdf=new PDF_MC_Table('P','mm', array(80, 150));
        $pdf->Open();
        $pdf->SetMargins(MARGIN, MARGIN, MARGIN);
        $pdf->SetAutoPageBreak(1, 2);
        $sql_box = "SELECT box_ID 
            FROM box 
            WHERE Shipment_ID = $int_shipment_id";
        $query_box = mysql_query($sql_box)
             or die(ERROR_CREATE_SHIPPER_QUERY . mysql_error());
        
        $int_numofbox = mysql_num_rows($query_box);
        $box = 1;
		$int_rembours_admin = 1; // When rembours we need 0 admin pages (1 pages in total).
        while ($obj_box = mysql_fetch_object($query_box)) {
            $int_pagecount++; // Increase the pagecounter.
			do {
				$str_shipZip = str_replace(' ', '', $str_shipZip);
				$str_box_indentifier = sprintf("%08d",$GLOBALS["ary_config"]["dhlaccountnumber"]).sprintf("%06d",$obj_box->box_ID);
				
				$flt_amount = GetField("SELECT (Invoice_total + Invoice_BTW) AS amount
                                       FROM invoices
                                       WHERE paymentterm = ".PAYMENTERM_ID_REMBOURS." AND shipmentID = '$int_shipment_id'");

				if ($flt_amount > 0) {
                    $int_rembours_admin--;
                } else {
                    $int_rembours_admin = 0;
                }

// V3.1
$str_file .= "~DGR:DHLLOGO,02108,034,R0RFCM07KF8H07KF807LFgJ0SFCL07KF8H07KF807LFgJ0SFC
L07KF8H07KF807LFgI01TF8K07KF8H0LF807LFgI01UFK0LFI0LF01LFCgI01UFK0LFI0LF0
1LFCgI07UFCJ0LFH03LF01LFCgI07UFCI03KFCH03KFC03LF8gI07UFCI03KFCH03KFC03LF
8gI0VFCI03KFCH07KFC03LF8gI0VFEI07KF8H07KF80LFEgJ0VFEI07KF8H07KF80LFEgI03
VFEI07KF801LF80LFEgI03VFEH01KFEH01KFE01LFCgI03VFEH01KFEH01KFE01LFCgI07VF
EH01KFEH03KFE01LFCgI07VFEH03KFCH03KFC07LFgJ07VFEH03KFCH03KFC07LFgU03KFEH
03KFCH0LFC07LFgV07JFEH0UFH0LFEgV07JFEH0UFH0LFEgV07JFEH0UFH0LFEgM07JFCH01
KFC01TFE03LF8gM07JFCH01KFC01TFE03LF8gM07KF801KFC01TFE03LF8gM07KF803KFH07
TF807LFgN07KF803KFH07TF807LFgM01KFEH03KFH07TF807LFgM01KFEH0KFEH0UF01LFCg
M01KFEH0KFEH0UF01LFCgM03KFEH0KFEH0UF01LFCgM03KFC01KF803TFC03LF8gM03KFC01
KF803TFC03LF8gM0LFC01KF803TFC03LF8gM0LFCiG0LFCiG0LFiG01KFEiG01KFEiG01KFE
hP0PF87SFC03KFEH03KFC01SFC1MFCPF87SFC03KFEH03KFC01SFC1MFCPF87SFC03KFEH03
KFC01SFC1MFCQ0TF803KFCH03KFC07SFCg0TF803KFCH03KFC07SFCg0SFEH0LFCH0LFH0TF
8Y03SFEH0LFI0LFH0TF8Y03SFEH0LFI0LFH0TF8O0OF03SFC01LFH01KFEH0SFE0NFCOF03S
FC01KFEH01KFEH0SFE0NFCOF03SFC01KFEH01KFEH0SFE0NFCOF07SFH07KFEH07KF803SFC
0NFCP07RFEH07KF8H07KF8H0SFCg07RFEH07KF8H07KF8H0SFCY01SF8H0LF8H0LFI0SFQ0N
F81RFCI0LFI0LFI0SF1OFCNF81RFCI0LFI0LFI0SF1OFCNF83QFEI03LFH03KFCI07QFE1OF
CNF83PFEJ03KFCH03KFCI01QFE1OFCNF83PFEJ03KFCH03KFCI01QFE1OFClV0

zpl2 Zebra printers
^XA^MCY^XZ
^XA
^LRN^FWN^CFD,24^LH0,0
^CI0^PR2^MNY^MTD^MMT^MD0^PON^PMN
^XZ
^XA

^FO010,030^XGDHLLOGO,1,1^FS                                     DHL LOGO

^FO20,21^XG819295E3,1,1^FS              					


^FO27,110^GB776,3,2^FS                                          LINE 1
^FO20,216^GB776,3,2^FS						LINE 2
^FO20,431^GB776,3,2^FS						LINE 3
^FO20,590^GB776,3,2^FS						LINE 4
^FO21,760^GB776,3,2^FS                                          LINE 5
^FO20,1030^GB776,3,2^FS                                          LINE 6 
^FO20,1160^GB776,3,2^FS                                         LINE 7
^FO20,1420^GB776,3,2^FS                                         LINE 8


^FO20,216^GB36,11,10^FS						HOOK UPPER LEFT
^FO20,216^GB11,36,10^FS						HOOK UPPER LEFT
^FO760,216^GB36,11,10^FS					HOOK UPPER RIGHT
^FO785,216^GB11,36,10^FS					HOOK UPPER RIGHT
^FO20,421^GB36,11,10^FS						HOOK LEFT UNDER
^FO20,396^GB11,26,10^FS						HOOK LEFT UNDER
^FO760,421^GB36,11,10^FS					HOOK RIGHT UNDER
^FO785,396^GB11,26,10^FS					HOOK RIGHT UNDER



^A0N,20,40^FO300,55^CI0^FDv3.1^FS                   VAR SPECIFICATIE VERSIE
^A0N,50,40^FO400,55^CI0^FDEUROPLUS^FS                   VAR PRODUCT

^A0N,22,22^FO35,119^CI0^FDFROM:^FS                              TEXT FROM
^A0N,22,42^FO500,149^CI0^FDCUSTOMER LOGO^FS                     LOGO CUSTOMER
^A0N,22,22^FO34,602^CI0^FDShipment number^FS                    TEXT SHIPMENT NUMBER
^A0N,22,22^FO35,235^CI0^FDTO:^FS				TEXT TO
^A0N,22,22^FO34,628^CI0^FDCustomer number^FS                    TEXT CUSTOMER NUMBER
^A0N,40,22^FO640,449^CI0^FDTIME^FS                              TEXT TIME
^A0N,40,22^FO494,449^CI0^FDDAY^FS                               TEXT DAY
^A0N,22,22^FO34,654^CI0^FDShipment date^FS			TEXT SHIPMENT DATE
^A0N,40,22^FO53,456^CI0^FR^FDHANDLING^FS                        TEXT HANDLING
^A0N,50,40^FO680,55^CI0^FDCMR^FS                                TEXT CMR

^A0N,22,22^FO100,119^CI0^FD".COMPANYNAME."^FS                       VAR SENDERS NAME
^A0N,22,22^FO100,144^CI0^FD".ADDRESS."^FS            VAR SENDERS STREET AND HOUSENUMBER
^A0N,22,22^FO100,169^CI0^FD".ZIPCODE." ".CITY."^FS                   VAR SENDERS POSTCOE AND CITY
^A0N,22,22^FO100,195^CI0^FDNEDERLAND^FS                 	VAR SENDERS COUNTRYCODE 

^A0N,28,28^FO95,231^CI0^FD$str_shipname^FS                      VAR DELIVERY NAAM
^A0N,28,28^FO95,261^CI0^FDTel. $str_phone^FS      VAR phone CONTACTPERSON
^A0N,28,28^FO95,291^CI0^FDAtt $str_attn^FS      VAR DELIVERY CONTACTPERSON
^A0N,28,28^FO95,325^CI0^FD$str_shipstreet $str_shipstreet_num^FS       VAR DELIVERY STREET AND HOUSENUMBER 
^A0N,36,36^FO95,360^CI0^FD$str_shipZip $str_shipcity^FS                        VAR DELIVERY POSTCODE AND CITY
^A0N,36,36^FO95,392^CI0^FD$str_shipcountry^FS                          VAR DELIVERY COUNTRYCODE


^FO21,440^GB420,140,140^FS                                      BLACK BOX
^A0N,65,45^FO59,519^CI0^FR^FD".($flt_amount > 0 ? "COD": "")."^FS                             VAR SHIPMENT OPTION
^A0N,65,45^FO640,519^CI0^FD^FS                             VAR TIME OPTION
^A0N,65,45^FO494,519^CI0^FD^FS                                  VAR DAY


^A0N,22,22^FO240,603^CI0^FD$int_shipment_id^FS                         VAR ORDERNUMBER
^A0N,22,22^FO240,628^CI0^FD".$GLOBALS["ary_config"]["dhlaccountnumber"]."^FS                          VAR CUSTOMER NUMBER
^A0N,62,62^FO659,639^CI0^FD$int_pagecount/$int_numofbox^FS                               VAR AMOUNT OF COLLO/PALLET
^A0N,22,22^FO240,654^CI0^FD".date("Y-m-d")."^FS                        VAR SHIPMENT DATE

^A0N,22,22^FO34,680^CI0^FDORIGIN:^FS                              TEXT ORIGIN CODE
^A0N,22,22^FO240,680^CI0^FD^FS                            VAR ORIGIN CODE

^A0N,22,22^FO34,706^CI0^FDGOODS DESCRIPTON:^FS                    TEXT GOODS DESCRIPTION
^A0N,22,22^FO240,706^CI0^FD^FS                    VAR GOODS DESCRIPTION

^A0N,22,22^FO34,732^CI0^FDSHIPMENT WEIGHT:^FS                    TEXT GOODS DESCRIPTION
^A0N,22,22^FO240,732^CI0^FD".floor($flt_weight/$int_numofbox)."^FS                    VAR GOODS DESCRIPTION

^A0N,22,22^FO470,732^CI0^FDCUSTOM VALUE:^FS                    TEXT CUSTOMS VALUE
^A0N,22,22^FO670,732^CI0^FD^FS                    VAR CUSTOMS VALUE

^BY2,,^FO50,770^B7N,6,5,,33,N^FH^FDUNH+".$str_box_indentifier
."+IFTMIN:D:96B:UN+DHL3.1/IWEX'BGM+787+$int_shipment_id+9'DTM+186:"
.date("Ymd"). ":102'TSR+"
.($flt_amount > 0 ?
	"ZCD:153+Z01+$str_tsr_code'MOA+22:".number_format($flt_amount, 2, ',', '').":EUR'" :
	"++$str_tsr_code'")
."TOD+Z02++CPT:::$str_cpt_code'NAD+OS+".$GLOBALS["ary_config"]["dhlaccountnumber"]."'NAD+CN+++$str_shipname+$str_shipstreet"
.($str_shipstreet_num ? ":$str_shipstreet_num" : ""). "+$str_shipcity++$str_shipZip+$str_ship_country_code'GID+0+1'MEA+WT++KGM:".($flt_weight/$int_numofbox < 1 ? "1" : floor($flt_weight/$int_numofbox)). "'PCI+ZZ1+JVGL$str_box_indentifier'UNT+".($flt_amount > 0 ? "12": "11")."+$str_box_indentifier^FS

^A0N,65,22^FO34,1040^CI0^FDNone^FS                   VAR FREE TEXT

^BY3^FO47,1175^BCN,200,N,N,N^FD>:2L$str_ship_country_code$str_shipZip+>50400000". ($flt_amount > 0 ? "2" : "0")."^FS          VAR ROUTING BARCODE
^A0N,28,28^FO244,1390^CI0^FD(2L)$str_ship_country_code$str_shipZip+0400000". ($flt_amount > 0 ? "2" : "0")."^FS             VAR TEXT UNDER ROUTING BARCODE

^BY3^FO180,1440^BCN,200,N,N,N^FD>:JVGL>5".$str_box_indentifier."^FS       VAR LICENCE PLATE
^A0N,28,28^FO287,1650^CI0^FD(J)VGL".$str_box_indentifier."^FS               VAR TEXT UNDER LICENCE PLATE

^PQ~*QUANT,8~,0,1,Y						PRINT QUANTITY
^XZ";

				$str_tracking = $bl_benelux ? "DHL $int_shipment_id" : "JVGL$str_box_indentifier";
				if ($box==1) {
					mysql_query("UPDATE shipments 
						SET Tracking = '$str_tracking'
						WHERE shipment_ID = '$int_shipment_id'")
						or die("Error update shipment in ship_label shipid = $int_shipment_id. ". mysql_error());
				}
				UpdateBox($obj_box->box_ID,
						  'JVGL$str_box_indentifier', 
						  $flt_weight/$int_numofbox);
            } while ($int_rembours_admin && $box==1);
            $box++;
        }
    
        if ($str_filename) {
            // When printing to http port use curl.
              if (stripos($str_filename, "http") !== FALSE) {
                require_once($_SERVER['DOCUMENT_ROOT']."/printipp/PrintIPP.php");
                
                $ipp = new PrintIPP();
                $ary_url = parse_url($str_filename);
                $ipp->setPort($ary_url['port']);
                $ipp->setHost($ary_url['host']);
                $ipp->setPrinterURI($ary_url['path']);
                $ipp->setBinary();
                $ipp->setData($str_file); // This only works when CUPS printer driver is RAW.
                $ipp->printJob();
                $ipp->printDebug();
              } else 
            // Store it to a file
			//`mode com3: BAUD=9600 PARITY=N data=8 stop=1 xon=off`;
            if (!$file_handle = fopen ($str_filename, "wb")) {
				echo "Create file '$str_filename' in CreateDHLlabel failed.\n";
			} else {
				if (!($int_error = fwrite($file_handle, $str_file))) echo "Write failed in '$str_filename', error $int_error.";
				fclose($file_handle);
			}
        } else {
            // Show it on the screen.
            echo "<pre>$str_file</pre>";
        }
    
        mysql_free_result($query_box);	
    }
    
    return $int_pagecount;
}

/**
 * Function     : MakeDayReport
 * Make DHL report
 * Input        : $date, the date of the shipment
 *				: $forwarder, the forwarder to print
 * Returns		: HTML rapport string .
 **/
function MakeDayReport($date,
						$str_forwarder = "") {
	global $db_iwex;
	$srt_return = "";
	
	$sql_select_all = "SELECT Adressen.naam, shipments.Tracking, Adressen.postcode,
						      Adressen.land, contacts.ContactID, COUNT(box_ID) AS packages ";
	$sql_select= "FROM shipments
				  INNER JOIN Adressen ON Adressen.AdresID = shipments.AdressID
				  INNER JOIN contacts ON Adressen.ContactID = contacts.ContactID
				  INNER JOIN box ON shipments.Shipment_ID = box.Shipment_ID
				  WHERE shipments.Ship_date >= '$date' and shipments.Ship_date <= '$date 23:59:59'";
	$sql_select .= $str_forwarder == 'DHL' ? " AND shipments.Tracking LIKE 'DHL %'" : "";
	$srt_return = show_table($sql_select_all
							.$sql_select
							." GROUP BY shipments.Shipment_ID
							   ORDER BY land, postcode");
	$srt_return .= "<p>Total number of packages ".GetField("SELECT COUNT(box_ID) ".$sql_select)."</p>";
	
	return $srt_return;
}
?>
