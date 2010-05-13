<?
// This page "catalogus" is for editing the catalogue

$_GLOBAL["str_backdir"] = '../';

include ($_GLOBAL["str_backdir"]."include.php");
include ("catalogus_functions.php");


$str_keyword = GetSetFormVar('keyword',TRUE);
if(strlen($str_keyword) > 50){
    $str_keyword = substr($str_keyword, 0, 50);
}    
$str_format = GetSetFormVar('format',FALSE);
$str_prodbrand = GetSetFormVar('brand',TRUE);
$str_prodcategory = GetSetFormVar('category',TRUE);
$str_pricelist = GetSetFormVar('pricelist',TRUE);
$str_eol = GetSetFormVar('eol',TRUE);
$int_supplierID = GetSetFormVar("SupplierID", TRUE);
$int_catalogus = GetSetFormVar('catalogus',TRUE);
$int_supplierID = GetSetFormVar("SupplierID", TRUE);
$int_contact_id = GetSetFormVar('ContactID');

$wildcard = isset($_POST['adv_search']) ? $src_exact_match : 0;
$operator = isset($_POST['adv_search']) ? $src_alle_velden : 'AND';

if (isset($_GET["sortfield"])){
  //check url on fieldnames
    if (empty($_GET["sortfield"]) ||
            $_GET["sortfield"] === "ID" ||
            $_GET["sortfield"] === "Productnaam" ||
            $_GET["sortfield"] === "RRP" ||
            $_GET["sortfield"] === "Merk"){
        $str_sortfield = GetSetFormVar('sortfield',TRUE);
    } else {
        $str_sortfield = "Productnaam";
    }
}else {
    $str_sortfield = GetSetFormVar('sortfield',TRUE);
}

if(isset($_GET["orderby"])){
  //check url on order by
    if(empty($_GET["orderby"]) ||
            $_GET["orderby"] === "ASC" ||
            $_GET["orderby"] === "DESC"){
        $str_orderby = GetSetFormVar('orderby',TRUE);
    } else {
        $str_orderby = "ASC";
    }
} else {
    $str_orderby = GetSetFormVar('orderby',TRUE);
}

$str_keyword = trim($str_keyword); //spaties links en rechts verwijderen
$str_keyword = preg_replace('/\s+/', ' ', $str_keyword); //dubbele spaties omzetten naar enkele spaties

/**
 * Function     : make_link
 * Will return a string with a link 
 * Input        : $adres_id
 * Returns      : a string with a link
 **/
Function make_link($str_keyword, 
                   $str_prodbrand, 
                   $str_prodcategory, 
                   $resultsearch, 
                   $str_fieldname, 
                   $str_orderby)
{
    $str_link = "<a href=\"".$_SERVER['PHP_SELF']."?keyword=".$str_keyword."&prodbrand=".$str_prodbrand."&prodcategory=".$str_prodcategory."&sortfield=".$str_fieldname."&orderby=".$str_orderby."\" ALT=\"Sorteren op: ".$str_fieldname."\">";
    return $str_link;
}

$price_level = GetPriceLevel($int_contact_id);

$int_units = 1; // Default one peache price                    
if ($price_level==1) {
	//$querysearch .= " Selling_price as 'Inkoop', ";
} else if ($price_level==2) {
	//$querysearch .= " Selling_price_10 as 'Inkoop', ";
    $int_units = 10;
} else if ($price_level==3) {
	//$querysearch .= " Selling_price_50 as 'Inkoop', ";
    $int_units = 50;
} else if ($price_level==4) {
	//$querysearch .= " Selling_price_100 as 'Inkoop', ";
    $int_units = 100;
} else {
	//$querysearch .= " Selling_price as 'Inkoop', ";
} 


if ($str_sortfield) {
            //tabelnamen uit de database
} else {      
    $str_sortfield = 'Productnaam';
    $str_orderby = 'ASC';
}

$querysearch = "SELECT current_product_list.ProductID as 'ID', 
					ProductName as 'Productnaam', ";


$querysearch .=	"Retail_price_ex as 'RRP', 
					Merk ";

$querysearch .= ", catalogusdetails.ProductID as Catalogus, stock, pricelist_yn as List, Discontinued_yn as EOL, null as Image 
			 FROM current_product_list
			  INNER JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."' "     . " " 
            . " LEFT JOIN location ON product_stock.location_id = location.ID "
            . " LEFT JOIN pricing default_price ON (current_product_list.ProductID = default_price.ProductID
                    AND (default_price.ContactID=0)
                    AND default_price.price_type='" . PRICING_TYPE_SALE . "' 
                    AND (default_price.start_number <= '$int_units' || default_price.start_number=0)
                    AND (default_price.end_number >= '$int_units' || default_price.end_number=0)
                    AND (default_price.start_date <= NOW() || default_price.start_date=0) 
                    AND (default_price.end_date >= NOW() || default_price.end_date=0))
                LEFT JOIN pricing special_price ON (current_product_list.ProductID = special_price.ProductID
                    AND (special_price.ContactID='$int_contact_id')
                    AND special_price.price_type='" . PRICING_TYPE_SALE . "' 
                    AND (special_price.start_number <= '1')
                    AND (special_price.end_number >= '1' || special_price.end_number=0)
                    AND (special_price.start_date <= NOW() || special_price.start_date=0) 
                    AND (special_price.end_date >= NOW() || special_price.end_date=0)) 
			 LEFT JOIN catalogusdetails ON catalogusdetails.ProductID = current_product_list.ProductID AND CatalogusID = '$int_catalogus'
			 WHERE (current_product_list.ProductID like '%"
			 	.str_replace(' ',"%' and current_product_list.ProductID like '%", $str_keyword)."%' or"
	      . 	" ProductName like '%".str_replace(' ',"%' and ProductName like '%", $str_keyword)."%' or"
              . " Productdescription like '%".str_replace(' ',"%' and Productdescription like '%", $str_keyword). "%' or "
	      . 	" ExternalID like '%$str_keyword%'OR "
              . " EAN ='".$str_keyword."') ";
             
$querysearch .= queryparm('MerkID', $str_prodbrand, $querysearch, $wildcard, $operator) ;
$querysearch .= queryparm('CategoryID', $str_prodcategory, $querysearch, $wildcard, $operator) ;
if ($str_eol != INVALID) $querysearch .= queryparm('Discontinued_yn', $str_eol, $querysearch, $wildcard, $operator) ;
$querysearch .= queryparm('Pricelist_yn', $str_pricelist, $querysearch, $wildcard, $operator) ; 
if ($int_supplierID) $querysearch .= queryparm('Supplier', $int_supplierID, $querysearch, FALSE);

$querysearch .= " order by '$str_sortfield' $str_orderby";

// Delete catalog
if (isset($_POST['delete']))
{
	DeleteCatalog ($int_catalogus);
}

printheader ("Catalogus aanpassen");

// Print default Iwex HTML header.
echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" id=\"productform\" >\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();

echo "<TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
      <TR>
        <TD WIDTH='20%' VALIGN='top'>
        <TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
              <TR>
                <TD><img src=\"".IMAGES_URL."blockleft.gif\" width=\"3\" height=\"25\" alt=\"\"></TD>
                <TD class=\"blocktitle\" width=\"100%\" background=\"".IMAGES_URL."blockback.gif\">Catalogus Aanpassen</TD>
                <TD><img src=\"".IMAGES_URL."blockright.gif\" width=\"3\" height=\"25\" alt=\"\"></TD>
              </TR>
              <TR> 	
                <TD VALIGN='top'width=\"100%\" colspan=\"3\" class=\"blockbody\">
                    <TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
                        <TR>
                            <TD WIDTH='300'>
                                 Zoeken in: ID, Naam en Omschrijving<BR><input type=\"text\" name=\"keyword\" value=\"$str_keyword\"> <BR>
                                (% voor alle artikelen) <BR><BR>
                           </TD>
                        </TR>
						<TR>
                           <TD WIDTH='200' VALIGN='top'>
                                catalogus<BR>".makelistbox("SELECT CatalogusID, catalogusdesc 
															FROM catalogus",
			   											   "catalogus",
					 									   "CatalogusID",
				  										   "catalogusdesc",
				   											$int_catalogus);
                      echo "</td>
                        </tr>";
      echo "            <tr>
                           <td WIDTH=\"200\" colspan=\"2\" VALIGN=\"top\">
                                merk<br>".makelistbox('SELECT DISTINCTROW brand_id, name FROM brand INNER JOIN current_product_list ON brand_id=MerkID order by name','brand','brand_id','name',$str_prodbrand)."
                           </td>
                        </tr>
                        <tr>
                           <td WIDTH=\"100\" colspan=\"2\" VALIGN=\"top\">
                                categorie<br>".
			  							   makelistbox('SELECT IF(cat2.CategoryID,
																   cat2.CategoryID,
															       categories.CategoryID) AS CategoryID, 
					  										   CONCAT_WS("->",
																		 categories.CategoryName,
																		 cat2.CategoryName) AS CategoryName
														 FROM categories 
														 LEFT JOIN categories cat2 ON categories.CategoryID = cat2.ParentID
														ORDER BY CategoryName',
                                                        'category',
                                                        'CategoryID',
                                                        'CategoryName',
														$str_prodcategory)."
							</td>
                        </tr>
                        </tr>
                        <tr>
                           <td WIDTH=\"100\" colspan=\"2\" VALIGN=\"top\">
                                Pricelist
                                <select name=pricelist>
                                    <option value=''>-</option>
                                    <option value='1'";
						if ($str_pricelist == "1") echo " selected";
						echo ">YES</option>
														<option value=0";
						if ($str_pricelist == "0") echo " selected";
						echo ">NO</option></select>
                           </td>
                        </tr>
						<tr>
                           <td WIDTH=\"100\" VALIGN=\"top\">
                                End Of Life
                                <select name=eol>
                                    <option value='".INVALID."'>-</option>
                                    <option value='1'";
						if ($str_eol == "1") echo " selected";
						echo ">YES</option>
														<option value=0";
						if ($str_eol == "0") echo " selected";
						echo ">NO</option></select>
                           </td>
                        </tr>
                        <tr>
                            <TD colspan = \"3\">Leverancier "
                            . makelistbox('SELECT SUBSTRING(CompanyName,1,10) AS CompanyName, ContactID FROM contacts WHERE Supplier_yn<>0 ORDER BY CompanyName','SupplierID','ContactID','CompanyName',$int_supplierID,TRUE) . "</TD>
                        </tr>";
                        
                    if ($int_contact_id) {
                        echo "<tr>
                            <td colspan = \"3\"> <B>Prijzen voor <a href='".CONTACTS."?custid=$int_contact_id' "
                              .ShowShortContactInfo($int_contact_id)
                              ."target=_new>$int_contact_id</a></b></td>
                        </tr>";
                    }
                    echo "
						<TR>
                            <TD colspan = '3'>
                                <input type=\"submit\" name=\"submit\" value=\"Zoeken\">
								<input type=\"submit\" name=\"aanpassen\" value=\"Aanpassen\">
							<input type=\"submit\" name=\"delete\" value=\"Verwijder catalogus\" 
								onClick=\"return confirm('Weet u het zeker dat u deze catalogus wilt verwijderen?')\">
							<input type=\"button\" name=\"new\" value=\"Nieuwe catalogus\" 
							onClick=\"location.replace('".CATALOGADD."');\">
							</td>
						</TR>
						<tr><td colspan = '3'>
							<a href='javascript:void()' onclick=\"if (markAllRows('productform')) return false;\">Selecteer alles</a>
							<a href='javascript:void()' onclick=\"if (unMarkAllRows('productform')) return false;\">Selecteer niets</a>
							</td>
						</tr>"; 
                    
						// Update catalogue
                    if (isset($_POST['aanpassen']))
                        {
                        $resultsearch = $db_iwex->query($querysearch);
                
                        while($obj = mysql_fetch_object($resultsearch)) {
                                ChangeProductToCatalog($obj->ID, 
                                                       $int_catalogus,
													   isset($_POST["catalogus$obj->ID"]) && $_POST["catalogus$obj->ID"]);
						}
                        mysql_free_result($resultsearch);
                    }
                    echo "</TABLE>
                    </TD>
            </TR>
        </TABLE>
        </TD>
        <TD VALIGN='top' WIDTH='80%'>";	

if ($str_keyword||$str_prodbrand||$str_prodcategory) {
	//echo $querysearch;
    $resultsearch = $db_iwex->query($querysearch);
    $numbersearch = mysql_Numrows($resultsearch);

    $x=0;
    if ($numbersearch > 0) {
    ?>

    <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 CLASS="blockbody" WIDTH="100%">
    <?

    echo "<TR>\n";
    for ($i = 0; $i < mysql_num_fields($resultsearch); $i++){
        
        $str_fieldname = mysql_field_name($resultsearch, $i);
        echo "<TH CLASS=\"menubar\"><B>";
            
            if($str_fieldname == "Image" ){ 
                echo $str_fieldname;
            }else if ($str_fieldname != $str_sortfield) {
                echo make_link($str_keyword,
                               $str_prodbrand,
                               $str_prodcategory,
                               $resultsearch,
                               $str_fieldname,
                               "ASC");     
                echo $str_fieldname. "</A>";
                
            }else if ($str_fieldname == $str_sortfield) {    
                        
                if ($str_orderby == "ASC") { 
                    echo make_link($str_keyword,
                                   $str_prodbrand,
                                   $str_prodcategory,
                                   $resultsearch,
                                   $str_fieldname,
                                   "DESC");
                    echo "" .$str_fieldname. "</A><IMG SRC=\"/images/down.gif\" height=\"10\" width=\"10\">";
                    
                }else {
                    echo make_link($str_keyword,
                                   $str_prodbrand,
                                   $str_prodcategory,
                                   $resultsearch,
                                   $str_fieldname,
                                   "ASC");
                    echo "" .$str_fieldname. "</A><IMG SRC=\"/images/up.gif\" height=\"10\" width=\"10\">"; 
                    
                }
            }
        echo "</B></TH>";
    }
    echo "</TR>\n";

    while($row = mysql_fetch_row($resultsearch)) {

      if (($x%2)==0) { $bgcolor="#FFFFFF"; } else { $bgcolor="#EAEAEA"; }
      ?>
         <TR bgcolor="<? echo $bgcolor; ?>">
      <?
      foreach($row as $key => $value) {
        // Right align the number fields;
        if ($key >=3 && is_numeric($value)) {
          $align = "align=\"right\"";
        } else {
          $align = "";
        }
        // get Meta Field info, to check name
        $meta = mysql_fetch_field($resultsearch,$key);
        if (!$meta) { // what if there is no meta info on the field??
        }
        //if field is productid field hyperlink it to productmaintenance
        If ($meta->name == "ID")  {
            echo "<TD $align><a target='_new' href=\"product_maint.php?productid=$value\">$value</a></TD>";
            $rowID = $value;
        } else If ($meta->name == "Image")  {
            echo "<TD $align>".ShowImage($rowID,$size=THUMBNAIL_SIZE)."</TD>";
        } else If ($meta->name == "Vrij")  {
            echo "<TD align=right>".ShowStock($rowID)."</TD>";
        } else If ($meta->name == 'Catalogus') {
            echo "<TD>".MakeCheckBox("catalogus$rowID", $value)."</TD>";
        } else {
            echo "<TD $align>$value</TD>";
        }    
      }
      echo "</TR> \n";
      $x++;
    }
    echo "</TABLE>    
        </TD>
    </TR>
    </TABLE>";
    } else {
        echo "<CENTER><H2>Geen producten gevonden.</H2><BR>Probeer een andere zoekopdracht.</CENTER>";
    }

	echo "</form>";
}
    printenddoc();
?>
