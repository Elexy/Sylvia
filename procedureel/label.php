<?php
/**
 *
 *
 * @version $Id: label.php,v 1.41 2007-08-04 20:19:44 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

$int_product_id = isset($_GET["productid"]) ? $_GET["productid"] : FALSE;
$int_location_id = isset($_GET["locationid"]) ? $_GET["locationid"] : FALSE;
$int_adres_id = isset($_GET["adresid"]) ? $_GET["adresid"] : FALSE;
$date = isset($_REQUEST['date']) ? $_REQUEST['date'] : FALSE;

$bl_factuur = isset($_GET['factuur']);
$bl_iwex = isset($_GET['iwex']);
$bl_big = isset($_GET['big']);
$bl_code128 = GetCheckBox('code128', FALSE);
$bl_codeEAN = GetCheckBox('codeEAN', FALSE);
$bl_envelop = isset($_GET['envelop']);
$bl_ready = isset($_GET['ready']);

$str_code = isset($_GET["code"]) ? $_GET["code"] : "";
$str_text = isset($_GET["text"]) ? $_GET["text"] : "";
$str_fontsize = isset($_GET["fontsize"]) ? $_GET["fontsize"] : "7.5";

$sql_get_product_info =  "SELECT Merk, current_product_list.ProductID, ProductName, ProductDescription, EAN, text "
                        ."FROM current_product_list 
						  LEFT JOIN extra_product_text ON current_product_list.ProductID = extra_product_text.ProductID
						  WHERE current_product_list.productID = $int_product_id";
                        
define("MARGIN", 0.02);
define("MAX_STRING_LEN", 32);
define("BIG_STICKER_WIDTH", (60/25.6));
define("BIG_STICKER_HEIGHT", (60/25.6));

function PrintAdres($sql) {
    $db = new DB();
    $qry = $db->query($sql);
    
    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);    
    while ($obj = mysql_fetch_object($qry)) {
        $pdf->AddPage();
        $pdf->Ln(0.03);
        $pdf->SetFont('Arial','B',9);

        $pdf->Cell(2.2,0.12,substr($obj->Naam,0,MAX_STRING_LEN),0,1);
        if (strlen($obj->attn)) $pdf->Cell(2.2,0.12,substr("T.a.v. $obj->attn",0,MAX_STRING_LEN),0,1);
        $pdf->Cell(2.2,0.12,substr("$obj->straat $obj->huisnummer",0,MAX_STRING_LEN),0,1);
        $pdf->Cell(2.2,0.13,substr("$obj->postcode  ".strtoupper($obj->plaats),0,MAX_STRING_LEN),0,1);
        $pdf->Cell(2.2,0.12,substr("$obj->country",0,MAX_STRING_LEN),0,1);

        /*        $pdf->SetWidths(array(2.2));
        $pdf->SetAligns(array('L'));
        $pdf->SetBorders(array(''));
        $pdf->SetHight(0.12);
        $pdf->Row(array("$obj->Naam\nT.a.v. $obj->attn\n$obj->straat $obj->huisnummer\n$obj->postcode  "
                        .strtoupper($obj->plaats)
                        ."\n$obj->country"));
*/
    }
    $pdf->Output();

    mysql_free_result($qry);	
}

if ($bl_big
    &&
    $int_product_id) {
    
    $qry_getproduct = mysql_query($sql_get_product_info)
    	or die("Ongeldig product query: $sql_get_product_info<br>". mysql_error());
    $obj = mysql_fetch_object($qry_getproduct);

    $pdf=new PDF_MC_Table('P','in', array(BIG_STICKER_WIDTH, BIG_STICKER_HEIGHT));
    $pdf->Open();
    $pdf->SetMargins(MARGIN*3,MARGIN,0);
    $pdf->SetAutoPageBreak(1, 0.05);
    $pdf->AddPage();
    if ($obj->EAN) { // When there is an EAN code print it else print the product ID
        $pdf->SetFont('Arial','B',$str_fontsize);
        $pdf->SetWidths(array(BIG_STICKER_WIDTH - 2*MARGIN));
        $pdf->SetAligns(array('L'));
        $pdf->SetBorders(array(''));
        $pdf->SetHight(0.15*$str_fontsize/10);
        $str_to_print = "$obj->Merk: $obj->ProductName $obj->text";
        $int_length = strlen($str_to_print);
        $flt_length = $pdf->GetStringWidth($str_to_print);
        $flt_max_string_length = 8.5*(BIG_STICKER_WIDTH-2*MARGIN);
        $int_new_length = $flt_length < $flt_max_string_length 
                            ? $int_length 
                            : $int_length*$flt_max_string_length/$flt_length;
        $pdf->Row(array(substr($str_to_print, 0, $int_new_length)));
//        $pdf->Cell(2.1,0.2,"$obj->ProductName",0);
        $pdf->Ln(0.01);
 
		if (GetCheckBox("weee", FALSE)) {
			$pdf->Image($_SERVER['DOCUMENT_ROOT'].'/images/weeelogo.png', 0.12, 1.5, 0.5);
			$pdf->Image($_SERVER['DOCUMENT_ROOT'].'/images/greenpoint.png', 0.67, 1.7, 0.4);
		} else {
			$pdf->Image($_SERVER['DOCUMENT_ROOT'].'/images/keomoBW.png', 0.10, 1.6, 1);
		}
        
        $pdf->CodeEAN(1.2, 1.5, $obj->EAN, 0.01, 16/25.6, 8);
    } else {
        echo "Geen EAN code aanwezig!";
    }
    
    $pdf->Output();

    mysql_free_result($qry_getproduct);	
} else if ($int_product_id) {
    $qry_getproduct = mysql_query($sql_get_product_info)
    	or die("Ongeldig product query: $sql_get_product_info<br>". mysql_error());
    $obj = mysql_fetch_object($qry_getproduct);

    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);
    $pdf->AddPage();
    if ($obj->EAN) { // When there is an EAN code print it else print the product ID
        $pdf->SetFont('Arial','B',8);
        $pdf->SetWidths(array(2.2));
        $pdf->SetAligns(array('L'));
        $pdf->SetBorders(array(''));
        $pdf->SetHight(0.11);
        $str_to_print = "$obj->Merk: $obj->ProductName";
        $int_length = strlen($str_to_print);
        $flt_length = $pdf->GetStringWidth($str_to_print);
        $flt_max_string_length = 2*2.17;
        $int_new_length = $flt_length < $flt_max_string_length 
                            ? $int_length 
                            : $int_length*$flt_max_string_length/$flt_length;
        $pdf->Row(array(substr($str_to_print, 0, $int_new_length)));
//        $pdf->Cell(2.1,0.2,"$obj->ProductName",0);
        $pdf->Ln(0.01);
        $pdf->CodeEAN($pdf->GetX()+0.1, $pdf->GetY(), $obj->EAN, 0.01, 0.59-$pdf->GetY(), 7);
    } else {
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0.55,0.2,"$obj->ProductID",0);
        $pdf->Code128($pdf->GetX()+.28, $pdf->GetY(), $obj->ProductID, 0.018, 0.19);
        $pdf->Ln(0.21);
        $pdf->SetFont('Arial','B',8);
    
        $pdf->SetWidths(array(2.2));
        $pdf->SetAligns(array('L'));
        $pdf->SetBorders(array(''));
        $pdf->SetHight(0.11);
        $pdf->Row(array("$obj->Merk: $obj->ProductName"));
    }

    $pdf->Output();

    mysql_free_result($qry_getproduct);	
} else if ($int_location_id) {
    $sql_get_location = "SELECT * FROM location ";
    if ($int_location_id != '%'
        &&
        $int_location_id != '*') {
        $sql_get_location .= "WHERE ID = '$int_location_id'";
    } else {
		$sql_get_location .= "ORDER BY CAST(location AS DECIMAL)";
	}
    
    $qry_getproduct = mysql_query($sql_get_location)
    	or die("Ongeldig location query: $sql_get_location<br>". mysql_error());
    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);    
    while ($obj = mysql_fetch_object($qry_getproduct)) {
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,0.2,"$obj->location",0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1, $pdf->GetY(), $obj->ID, 0.037, 0.4);
        $pdf->SetFont('Arial','B',6);
    }
    $pdf->Output();

    mysql_free_result($qry_getbox);	

} else if ($bl_ready) {
    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);    
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_READY,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1, 
					 $pdf->GetY(),
					 SHIPMENT_READY,
					 0.037,
					 0.4);
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_REOPEN,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1,
					 $pdf->GetY(),
					 SHIPMENT_REOPEN,
					 0.037,
					 0.4);
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_MAKE_SHIPLIST,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1,
					 $pdf->GetY(),
					 SHIPMENT_MAKE_SHIPLIST,
					 0.037,
					 0.4);
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_RETURN_TO_LIST,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1,
					 $pdf->GetY(),
					 SHIPMENT_RETURN_TO_LIST,
					 0.037,
					 0.4);
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_MAKE_UPS,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1,
					 $pdf->GetY(),
					 SHIPMENT_MAKE_UPS,
					 0.037,
					 0.4);
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_MAKE_DHL,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1,
					 $pdf->GetY(),
					 SHIPMENT_MAKE_DHL,
					 0.037,
					 0.4);
        $pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
        $pdf->Cell(0.55,
				   0.2,
				   SHIPMENT_MAKE_GLS,
				   0);
        $pdf->Ln(0.2);
        $pdf->Code39($pdf->GetX()+.1,
					 $pdf->GetY(),
					 SHIPMENT_MAKE_GLS,
					 0.037,
					 0.4);
    $pdf->Output();
} else if ($int_adres_id) {
    PrintAdres(SQL_ADRESSEN_QUERY . "WHERE AdresID = '$int_adres_id'");
} else if ($bl_factuur) {

    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);
    $pdf->AddPage();
    $pdf->Ln(0.15);
    $pdf->Image($_SERVER['DOCUMENT_ROOT']. "/images/" . LOGOCONTRAST,0.05, 0.03, 0.7);
    $pdf->SetFont('Arial','B',20);

    $pdf->SetX(0.8);
    $pdf->Cell(0.55,0.2,"Facturen",0);
    $pdf->Ln(0.35);
            
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(2,0.15,"T.a.v. de crediteurenadministratie",0);
    
    $pdf->Output();
    
} else if ($bl_iwex || $bl_envelop) {

    if ($bl_iwex) {
        $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    } else {
        $pdf=new PDF_MC_Table('P','in', array(220/25.6, 110/25.6));    
    }
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);
    $pdf->AddPage();
    $pdf->Ln(0.05);
    $pdf->Image($_SERVER['DOCUMENT_ROOT']. "/images/" . LOGOCONTRAST, 1.65, 0.03, 0.5);
    $pdf->SetFont('Arial','B',7.5);

    $pdf->SetWidths(array(2.2));
    $pdf->SetAligns(array('L'));
    $pdf->SetBorders(array(''));
    $pdf->SetHight(0.12);
    $pdf->Row(array(IWEX_ADRES_INFO."\n".IWEX_PHONE_INFO."\n".IWEX_WEBSITE));
    
    $pdf->Output();
    
} else if ($str_code != "") {

    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);
    $pdf->AddPage();
    $pdf->Ln(0.05);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0.55,0.2, $str_code,0);
    $pdf->Ln(0.25);
    $pdf->Code39($pdf->GetX()+.1, $pdf->GetY(), $str_code, 0.037, 0.4);


    $pdf->Output();    
} else if ($str_text != "") {

    $pdf=new PDF_MC_Table('P','in', array(2.25, .75));
    $pdf->Open();
    $pdf->SetMargins(MARGIN,MARGIN,MARGIN);
    $pdf->SetAutoPageBreak(1, 0.05);
    $pdf->AddPage();
    $pdf->Ln(0.05);

    $pdf->SetFont('Arial','B', $str_fontsize);

    $pdf->SetWidths(array(2.2));
    $pdf->SetAligns(array('C'));
    $pdf->SetBorders(array(''));
    $pdf->SetHight($str_fontsize / 60);
    $str_text = stripslashes($str_text);
    if ($bl_code128) {
        $pdf->Code128($pdf->GetX()+0.1, $pdf->GetY(), $str_text, 0.016, 0.4);
        $pdf->Ln(0.35);
        $pdf->Row(array("$str_text"));
    } else if ($bl_codeEAN) {
        $pdf->CodeEAN($pdf->GetX()+0.1, $pdf->GetY(), $str_text, 0.015, 0.5);
        $pdf->Ln(0.35);
    } else {
        $pdf->Row(array("$str_text"));
    }
    $pdf->Output();    
} else if ($date) {
    PrintAdres("SELECT count(contacts.ContactID), Naam, attn, straat, huisnummer, postcode, plaats, country.country
                FROM contacts
                INNER JOIN orders ON orders.ContactID = contacts.ContactID  AND OrderDate >= '$date'
                INNER JOIN Adressen ON Adressen.ContactID = contacts.ContactID AND adrestitel <> 7 AND adrestitel <> 8 AND adrestitel <> 5 
                LEFT JOIN country ON code = land
                GROUP BY contacts.ContactID
                ORDER BY Naam");
} else {
	// Print default Iwex HTML header.
	printheader (COMPANYNAME . " label printen");

	echo "<BODY ".get_bgcolor()."><FORM METHOD=\"get\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"labelform\">\n";
	echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
	
	printIwexNav();

    echo "Geen product of locatie nummer opgegeven.<br>";
    
    echo "\n<br>Geef product nummer <INPUT TYPE=\"text\" size=\"6\" CLASS=\"form\" name=\"productid\">";
	echo GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", "labelform.productid", "labelform.productid"); // ->current_product_list.Productname
    echo "\n<br><br>Geef locatie id <INPUT TYPE=\"text\" size=\"3\" CLASS=\"form\" name=\"locationid\">";
    echo preg_replace ("/<select name/", "<select OnChange=\"locationid.value = locationidlist.value;\" name", makelistbox('SELECT ID, location FROM location','locationidlist','ID','location', 0)); 
    echo " % voor alles.<br><input type='submit' name='submit' value='Print'>";
    echo " <input type='submit' name='big' value='Print groot label'> ".MakeCheckBox("weee", TRUE)." Use WEEE logo <br><br>\n";
    echo "<input type='submit' name='factuur' value='Factuur stickers'> "
        ."<input type='submit' name='iwex' value='Iwex adres stickers'> "
        ."<input type='submit' name='ready' value='Klaar label'> "
        ."<input type='submit' name='envelop' value='DL envelop stickers'>";
    echo "<br><br>Text <textarea cols='20' rows='3' CLASS=\"form\" name=\"text\"></textarea> font grote <INPUT TYPE=\"text\" size=\"3\" CLASS=\"form\" name=\"fontsize\" value=$str_fontsize>";
    echo " Code128 ".MakeCheckBox('code128', $bl_code128);
    echo " CodeEAN ".MakeCheckBox('codeEAN', $bl_codeEAN);
    echo "<br><br>Klanten adressen die een order hebben na <INPUT TYPE=\"text\" size=\"10\" CLASS=\"form\" name=\"date\"> ";
    echo Add_Calendar('labelform.date');
    echo "</form>\n";
    
    // Set cursor to default location		  
    echo '<script TYPE="text/javascript" language="JavaScript">document.labelform.productid.focus();</script>';

    printenddoc();
}
?>
