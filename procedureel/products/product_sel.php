<?

$_GLOBAL["str_backdir"] = '../';

include ($_GLOBAL["str_backdir"]."include.php");


$str_category = NULL;

$str_keyword = GetSetFormVar('keyword',TRUE);
$str_format = GetSetFormVar('format',FALSE);
$str_prodbrand = GetSetFormVar('brand',TRUE);
$str_prodcategory = GetSetFormVar('category',TRUE);
$str_pricelist = GetSetFormVar('pricelist',TRUE);
$str_eol = GetSetFormVar('eol',TRUE);
$int_supplierID = GetSetFormVar("SupplierID", TRUE);

$adv_search = GetSetFormVar('adv_search',TRUE);
$src_id = GetSetFormVar('search_id',TRUE);
$src_naam = GetSetFormVar('search_naam',TRUE);
$src_omschr = GetSetFormVar('search_omschr',TRUE);
$search_ex_id = GetSetFormVar('search_ex_id',TRUE);
$search_ean = GetSetFormVar('search_ean',TRUE);
$str_prodsubcategory = GetSetFormVar('prodsubcategory',TRUE);
$update_product_prices = isset($_POST['update_product_prices']) && $_POST['update_product_prices'];
$update_all_stock = isset($_POST['update_all_stock']) && $_POST['update_all_stock'];
$int_contact_id = GetSetFormVar('ContactID');
$int_catalogus = GetSetFormVar('catalogus',TRUE);

$src_exact_match = isset($_POST['search_exact_match']) ? $_POST['search_exact_match'] : 1;
$src_alle_velden = isset($_POST['search_alle_velden']) ? $_POST['search_alle_velden'] : 'OR';

$wildcard = isset($_POST['adv_search']) ? $src_exact_match : 0;
$operator = isset($_POST['adv_search']) ? $src_alle_velden : 'AND';

$str_keyword = trim($str_keyword);
$str_keyword = preg_replace('/\s+/', ' ', $str_keyword); //dubbele spaties omzetten naar enkele spaties

$str_sortfield = GetSetFormVar('sortfield',TRUE);
$str_orderby = GetSetFormVar('orderby',TRUE);

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

if ($str_sortfield)
{
//tabelnamen uit de database
  if($str_sortfield == 1)
  { $str_sortfield = '1+'; }
  if($str_sortfield == 10)
  { $str_sortfield = '10+'; }
  if($str_sortfield == 50)
  { $str_sortfield = '50+'; }
  if($str_sortfield == 100)
  { $str_sortfield = '100+'; }
} else
{      
  $str_sortfield = 'Productnaam';
  $str_orderby = 'ASC';
}
$price_level = GetPriceLevel($int_contact_id);

$int_units = 1; // Default one peache price                    
if ($price_level==1)
{
//$querysearch .= " Selling_price as 'Inkoop', ";
} else if ($price_level==2)
  {
  //$querysearch .= " Selling_price_10 as 'Inkoop', ";
    $int_units = 10;
  } else if ($price_level==3)
    {
    //$querysearch .= " Selling_price_50 as 'Inkoop', ";
      $int_units = 50;
    } else if ($price_level==4)
      {
      //$querysearch .= " Selling_price_100 as 'Inkoop', ";
        $int_units = 100;
      } else
      {
      //$querysearch .= " Selling_price as 'Inkoop', ";
      }

$querysearch="SELECT DISTINCTROW current_product_list.ProductID as 'ID', ExternalID, ProductName as 'Productnaam', "
    . " if(special_price.amount, special_price.amount, default_price.amount) AS 'Price',"
    . " Retail_price_ex*1.19 as 'Adviesprijs', "
    . " Discontinued_yn as 'EOL', location as Loc, Pricelist_yn as 'List', Merk, product_stock.stock, null as 'image' "
    . "FROM current_product_list "
    . " LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."' "     . " "
    . " LEFT JOIN location ON product_stock.location_id = location.ID "
    . " LEFT JOIN catalogusdetails ON catalogusdetails.ProductID = current_product_list.ProductID "
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
                    AND (special_price.end_date >= NOW() || special_price.end_date=0)) ";

//  Check for subcategories
$bl_subcategorie = FALSE;
if($str_prodcategory)
{
  $sql = mysql_query("SELECT * FROM categories WHERE ParentID = $str_prodcategory ");
  if ($obj = mysql_fetch_object($sql))
  {
    $bl_subcategorie = TRUE;
  }
}

if(isset($update_product_prices))
{
  $queryupdatetable = "$querysearch";
}

if($update_all_stock)
{
  update_all_stock();
}

if($adv_search)
{
//advance search
//$querysearch .=" WHERE (";
  if(!empty($src_id))       $querysearch .= queryparm('current_product_list.ProductID', $src_id, $querysearch, $src_exact_match, $src_alle_velden) ;
  if(!empty($src_naam))     $querysearch .= queryparm('ProductName', $src_naam, $querysearch, $src_exact_match, $src_alle_velden) ;
  if(!empty($src_omschr))   $querysearch .= queryparm('Productdescription', $src_omschr, $querysearch, $src_exact_match, $src_alle_velden) ;
  if(!empty($search_ex_id)) $querysearch .= queryparm('ExternalID', $search_ex_id, $querysearch, $src_exact_match, $src_alle_velden) ;
  if(!empty($search_ean))   $querysearch .= queryparm('EAN', $search_ean, $querysearch, $src_exact_match, $src_alle_velden) ;
  if ($int_supplierID)      $querysearch .= queryparm('Supplier', $int_supplierID, $querysearch, FALSE);

//                  . "ProductID like '%"
//                     .str_replace(' ',"%' ".$src_alle_woorden." ProductID like '%", $src_id)."%' ".$src_alle_velden.""
//                  . " ProductName like '%"
//                     .str_replace(' ',"%' ".$src_alle_woorden." ProductName like '%", $src_naam)."%' ".$src_alle_velden.""
//                  . " Productdescription like '%"
//                     .str_replace(' ',"%' ".$src_alle_woorden." Productdescription like '%", $src_omschr). "%' ".$src_alle_velden.""
//                  . " ExternalID like '%".$search_ex_id."%' ".$src_alle_velden.""
//                  . " EAN ='".$search_ean."'"
//                  . ") ";
}else
{
//normal/quick search
  $querysearch .= "\n WHERE (current_product_list.ProductID like '%"
      .str_replace(' ',"%' AND current_product_list.ProductID like '%", $str_keyword)."%' OR"
      . " ProductName like '%".str_replace(' ',"%' AND ProductName like '%", $str_keyword)."%' OR"
      . " Productdescription like '%".str_replace(' ',"%' AND Productdescription like '%", $str_keyword). "%' OR "
      . " ExternalID like '%".$str_keyword."%' OR "
      . " EAN ='".$str_keyword."') ";
}

$querysearch .= queryparm('MerkID', $str_prodbrand, $querysearch, $wildcard, $operator) ;
$querysearch .= queryparm('CategoryID', $str_prodcategory, $querysearch, $wildcard, $operator) ;
$querysearch .= queryparm('SubcategoryID', $str_prodsubcategory, $querysearch, 0);       
if ($str_eol != INVALID) $querysearch .= queryparm('Discontinued_yn', $str_eol, $querysearch, $wildcard, $operator) ;
$querysearch .= queryparm('Pricelist_yn', $str_pricelist, $querysearch, $wildcard, $operator) ;         
if ($int_supplierID)      $querysearch .= queryparm('Supplier', $int_supplierID, $querysearch, FALSE);
if ($int_catalogus) $querysearch .= queryparm('CatalogusID', $int_catalogus, $querysearch, FALSE);


//$querysearch .= " GROUP BY product_stock.Product_ID";

$querysearch .= " order by $str_sortfield $str_orderby";
//echo $querysearch;

if ($str_format == "xls")
{

//21 aug 06 inserted the PEAR way of doing it
  $result = mysql_query($querysearch)
      or die("Ongeldige query: " . mysql_error());


  $count = mysql_num_fields($result);

  for ($i = 0; $i < $count; $i++)
  {
  //here we add the header
    $arr_header[] = mysql_field_name($result, $i);
  }

  $DB_iwex = new DB();
  $data_obj = $DB_iwex->query($querysearch);

  //leave the header...
  $row = 1;
  while($arr_row = mysql_fetch_row($data_obj))
  {
    $arr_data[$row] = $arr_row;
    $row ++;
  }

  include($_GLOBAL["str_backdir"] . 'excelfile.php');

}  // end if format = xls
else if ($str_format == "pdf")
  {
  //Instanciation of inherited class
    $pdf=new IwexPDF('P','mm','A4');
    $pdf->SetWidths(array(12,30,60,11,11,11,11,11,11,5,15,11));
    $pdf->SetAligns(array('L','L','L','R','R','R','R','R','R','R','L','R'));
    $pdf->SetBorders(array('F','F','F','F','F','F','F','F','F','F','F','F'));
    $pdf->SetLineWidth(0);
    $pdf->SetHight(3);

    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);

    $resultsearch = MYSQL_QUERY($querysearch)
        or die("Ongeldige query: " . mysql_error());

    $headerdata = array();
    for ($i = 0; $i < mysql_num_fields($resultsearch); $i++)
    {
      $headerdata[$i]= mysql_field_name($resultsearch, $i);
    }
    $tabledata = array();
    $rowcnt = 0;
    while($row = mysql_fetch_row($resultsearch))
    {
      $tabledata[$rowcnt++] = $row;
    }

    // Generate the PDF table.
    $pdf->PDFtable($headerdata, $tabledata);
    $pdf->Output();

    mysql_free_result($resultsearch);
  } else // end if format = pdf

  {
  // Print default Iwex HTML header.
    printheader (COMPANYNAME . " product informatie");

    echo "<BODY ".get_bgcolor().">";

    printIwexNav();
    echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

    echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"productform\">\n";

    echo "<input type=hidden name='ContactID' value='$int_contact_id'>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
      <tr>
        <td WIDTH='20%' VALIGN='top'>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
              <tr>
                <td><img src=\"".IMAGES_URL."blockleft.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
                <td class=\"blocktitle\" width=\"100%\" background=\"".IMAGES_URL."blockback.gif\">Producten Zoeken</td>
                <td><img src=\"".IMAGES_URL."blockright.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
              </tr>
              <tr> 	
                <td VALIGN='top'width=\"100%\" colspan=\"3\" class=\"blockbody\">
                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
    if($adv_search)
    {
      echo "        <tr>
                            <td width='100'>
                                Product ID:
                            </td>
                            <td width='200'>
                                <INPUT type=\"text\" name=\"search_id\" size=\"6\" value=\"".$search_id."\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Productnaam:
                            </td>
                            <td>
                                <INPUT type=\"text\" name=\"search_naam\" size=\"10\" value=\"".$search_naam."\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Omschrijving:
                            </td>
                            <td>
                                <INPUT type=\"text\" name=\"search_omschr\" size=\"10\" value=\"".$search_omschr."\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                External id:
                            </td>
                            <td>
                                <INPUT type=\"text\" name=\"search_ex_id\" size=\"10\" value=\"".$search_ex_id."\">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                EAN:
                            </td>
                            <td>
                                <INPUT type=\"text\" name=\"search_ean\" size=\"10\" value=\"".$search_ean."\">
                            </td>
                        </tr>                                                
                        <tr>
                            <td colspan=\"2\">
                                Zoeken op <SELECT NAME=\"search_alle_velden\">";
      echo "                           <OPTION VALUE=\"AND\"";
      if($src_alle_velden == 'AND')
      {
        echo " SELECTED";
      }
      echo "                           >alle</OPTION>
                                           <OPTION VALUE=\"OR\"";
      if($src_alle_velden == 'OR')
      {
        echo " SELECTED";
      }
      echo "                           >enkele</OPTION>
                                       </SELECT> velden.
                            </td>
                        </tr>  
                        <tr>
                            <td colspan=\"2\">
                                Match:
                                      <SELECT NAME=\"search_exact_match\">";
      echo "                           <OPTION VALUE=0";
      if(!$src_exact_match)
      {
        echo " SELECTED";
      }
      echo "                           >exact</OPTION>
                                           <OPTION VALUE=1";
      if($src_exact_match)
      {
        echo " SELECTED";
      }
      echo "                           >gedeeltelijk</OPTION>
                                       </SELECT>
                            </td>
                        </tr>                        
                                             
                        <tr>
                            <td colspan=\"2\">
                                <A HREF=\"".$_SERVER['PHP_SELF']."?adv_search=\"><< Normaal zoeken</A><br><br>
                           </td>
                        </tr>";    

    }else
    {
      echo "        <tr>
                            <td WIDTH=\"300\" colspan=\"2\">
                                 Zoeken in: ID, Naam en Omschrijving<br><input type=\"text\" name=\"keyword\" value=\"$str_keyword\"> <br>
                                (% voor alle artikelen) <br>";
      //werkt nog niet helemaal flex
      // <A HREF=\"".$_SERVER['PHP_SELF']."?adv_search=true\">>> Uitgebreid zoeken</A><br><br>
      echo "</td>
                        </tr>";
    }
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
                        </tr>";
    if ($bl_subcategorie)
    {
      echo "
							<tr>
							   <td width='100' valign='top'>
								SubCategorie<BR>".makelistbox("SELECT CategoryID, CategoryName FROM categories WHERE ParentID = '" .$str_prodcategory. "' ORDER by CategoryName","prodsubcategory","CategoryID","CategoryName",$str_prodsubcategory, false)."
							   </td>
							</tr>";
    }
    echo "
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
                        </tr>                        <tr>
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
                            <td colspan = \"3\">Uitvoer: 
                                <select name=format>
                                    <option value=screen>Scherm</option>
                                    <option value=pdf";
    if ($str_format == "pdf") echo " selected";
    echo ">PDF</option>
                                    <option value=xls";
    if ($str_format == "xls") echo " selected";
    echo ">XLS</option></select>
                            </td>
                        </tr>
                        <tr>
                            <TD colspan = \"3\">Leverancier "
        . makelistbox('SELECT SUBSTRING(CompanyName,1,10) AS CompanyName, ContactID FROM contacts WHERE Supplier_yn<>0 ORDER BY CompanyName','SupplierID','ContactID','CompanyName',$int_supplierID,TRUE) . "</TD>
                        </tr>
						<TR>
                           <TD WIDTH='200' VALIGN='top'>
                                catalogus
								<a href='".CATALOG."?ContactID=$int_contact_id'>aanpassen</a><BR>"
        .makelistbox("SELECT CatalogusID, catalogusdesc
															FROM catalogus" .($int_contact_id ? 
        " WHERE ContactID = $int_contact_id" :
        ""),
        "catalogus",
        "CatalogusID",
        "catalogusdesc",
        $int_catalogus,
        'this.form.submit()')."
                        	</td>
						</tr>
                        <tr>
                            <td colspan = \"3\">
                                <input type=\"submit\" name=\"submit\" value=\"Zoek\">";
    //<input type=\"submit\" name=\"bestel\" value=\"Bestel\">";
    if ($int_contact_id)
    {
      echo " <B>Prijzen voor <a href='".CONTACTS."?custid=$int_contact_id' "
          .ShowShortContactInfo($int_contact_id)
          ."target=_new>$int_contact_id</a></b>";
    }
    echo "</td>
                        </tr>\n";
    echo "<tr>
                            <td colspan = \"3\">
                                <hr>
                                Alle prijzen in euro's (&euro;) excl. BTW. Prijswijzigingen voorbehouden. <br>Onze
                                <a href='Leveringsvoorwaarden.pdf'><img src='".IMAGES_URL."pdficon.gif' alt='PDF file' height='15' border='0'> 
                                leveringsvoorwaarden</a> zijn van kracht.
                            </td>
                        </tr>
                        </table>
                    </td>
            </tr>
        </table>
		<script TYPE='text/javascript' language='JavaScript'>document.productform.keyword.focus();</script>";
    if($waccess_v)
    {
      echo "
			<br>
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
        <tr>
          <td><img src=\"".IMAGES_URL."blockleft.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
          <td class=\"blocktitle\" width=\"100%\" background=\"".IMAGES_URL."blockback.gif\">Producten Wijzingen</td>
          <td><img src=\"".IMAGES_URL."blockright.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
        </tr>
				<tr>
					<td VALIGN='top'width=\"100%\" colspan=\"3\" class=\"blockbody\">
						<table>
              <tr>
                <td>
                  Voor het bijwerken van de artikel prijzen. Alleen de artikelen die niet Discontinued zijn en welken op de prijslijsten voorkomen zullen worden bijgewerkt.
                  <br><br>\n
                  <INPUT TYPE=\"submit\" NAME=\"update_product_prices\" CLASS=\"form\" value=\"update prices\"
                  onClick=\"return confirm('Weet u zeker dat u de prijzen van alle artikel wilt updaten?')\">
                </td>
              </tr>
              <tr>
                <td>Update all stock and free stock <br>";
      echo "      <INPUT TYPE=\"submit\" NAME=\"update_all_stock\" CLASS=\"form\" value=\"update all stock\">\n";
      echo "    </td>
              </tr>
						</table>
					</td>
				</tr>
			</table>";
    }
    echo "</td><td VALIGN='top' WIDTH='80%'>";

    if ($str_keyword||$str_prodbrand||$str_prodcategory||$int_catalogus)
    {

    // Creating a results table for the Products
      echo (creating_product_table($querysearch, $str_keyword, $str_prodbrand, $str_prodcategory, $str_sortfield, $str_orderby));

      // Creating a results table for the updated Products
      if($update_product_prices)
      {

        $allupdatedproducts = UpdateAllPrices();
        if($allupdatedproducts != false)
        {

          foreach($allupdatedproducts As $productid)
          {
            $queryupdatetable .= queryparm('ProductID', $productid, $queryupdatetable, 0, "OR") ;
          }
          echo (creating_product_table($queryupdatetable, $str_keyword, $str_prodbrand, $str_prodcategory, $str_sortfield, $str_orderby));
        }
      }

      echo"</td>\n
    </tr>\n
</table>\n";

    } // end if submit



    echo "
     </tr></td>\n
     </table>\n
	 </form>\n";

    printenddoc();
} // end if no excelfile
