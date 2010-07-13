<?php
include ("include.php");
// get nutton input from form
$bl_submit = isset($_POST["Update"]) ? TRUE : FALSE;
$bl_update_stock = isset($_POST["update_stock"]) ? TRUE : FALSE;
$bl_update_all_stock = isset($_POST["update_all_stock"]) ? TRUE : FALSE;
$bl_update_all_prices = isset($_POST["update_all_prices"]) ? TRUE : FALSE;
$bl_copy_products = isset($_POST["copy_product"]) ? TRUE : FALSE;
$productid = isset($_POST["productid"]) ? $_POST["productid"] : FALSE;
$productid = isset($_GET["productid"]) && !isset($_POST["productid"]) ? $_GET["productid"] :  $productid;
$productid = $productid > 1000 ? $productid : FALSE;
$new_product = isset($_POST["new_product"]) ?  $_POST["new_product"] : FALSE;
//initialize and get all the formdata
$prodbrand = isset($_POST["prodbrand"]) ?  $_POST["prodbrand"] : FALSE;
$str_merk = isset($_POST["str_merk"]) ?  $_POST["str_merk"] : FALSE;
$prodname = isset($_POST["prodname"]) ?  RemoveLinefeeds($_POST["prodname"]) : FALSE;
$proddescription = isset($_POST["proddescription"]) ?  $_POST["proddescription"] : FALSE;
$prodextid = isset($_POST["prodextid"]) ?  $_POST["prodextid"] : FALSE;
$prodeu = isset($_POST["prodeu"]) ?  $_POST["prodeu"] : FALSE;
$prodtaric = isset($_POST["prodtaric"]) ?  $_POST["prodtaric"] : FALSE;
$prodean = isset($_POST["prodean"]) ?  $_POST["prodean"] : FALSE;
$prodsupplier = isset($_POST["prodsupplier"]) ?  $_POST["prodsupplier"] : FALSE;
$prodleadtime = isset($_POST["prodleadtime"]) ?  $_POST["prodleadtime"] : FALSE;
$prodcostforeign = isset($_POST["prodcostforeign"]) ?  $_POST["prodcostforeign"] : FALSE;
$prodreorderlevel = isset($_POST["prodreorderlevel"]) ?  $_POST["prodreorderlevel"] : FALSE;
$prodcosthome = isset($_POST["prodcosthome"]) ?  $_POST["prodcosthome"] : FALSE;
$flt_extra_cost = isset($_POST["flt_extra_cost"]) ?  $_POST["flt_extra_cost"] : FALSE;
$prodmargin = isset($_POST["prodmargin"]) ?  $_POST["prodmargin"] : FALSE;
$prod1 = isset($_POST["prod1"]) ?  $_POST["prod1"] : FALSE;
$prodbtwclass = isset($_POST["prodbtwclass"]) ?  $_POST["prodbtwclass"] : FALSE;
$prod10 = isset($_POST["prod10"]) ?  $_POST["prod10"] : FALSE;
$prodsku = isset($_POST["prodsku"]) ?  $_POST["prodsku"] : FALSE;
$prod50 = isset($_POST["prod50"]) ?  $_POST["prod50"] : FALSE;
$prodonhand = isset($_POST["prodonhand"]) ?  $_POST["prodonhand"] : FALSE;
$prod100 = isset($_POST["prod100"]) ?  $_POST["prod100"] : FALSE;
$proddiscontinued = isset($_POST["proddiscontinued"]) ?  $_POST["proddiscontinued"] : FALSE;
$prodRRP = isset($_POST["prodRRP"]) ?  $_POST["prodRRP"] : FALSE;
$prodweightcorr = isset($_POST["prodweightcorr"]) ?  $_POST["prodweightcorr"] : FALSE;
$prodcurrency = isset($_POST["prodcurrency"]) ?  $_POST["prodcurrency"] : FALSE;
$prodloc = isset($_POST["prodloc"]) ?  $_POST["prodloc"] : FALSE;
$prodcategory = isset($_POST["prodcategory"]) ?  $_POST["prodcategory"] : FALSE;
$int_prodowner = isset($_REQUEST["product_ownerid"]) ?  $_REQUEST["product_ownerid"] : OWN_COMPANYID;

$prod_public = GetCheckbox('prod_public');
$prod_special = GetCheckbox('prod_special');

$bl_store_serial = GetCheckbox('store_serial');

//extra product info
$bericht = "";
$extra_prod_info = isset($_POST["extra_prod_info_hide"]) ?  FALSE : FALSE;
$extra_prod_info = isset($_POST["extra_prod_info"]) ?  TRUE : FALSE;
$bl_extra_prod_info_update = GetSetFormVar('extra_prod_info_update');
$bl_extra_prod_info_delelte = GetSetFormVar('extra_prod_info_delelte');

//add value to listbox
$listbox_cat = GetSetFormVar('listbox_cat');
$add_listbox_cat = GetSetFormVar('add_listbox_cat');
$new_value_listbox = GetSetFormVar('new_value_listbox');
$add_value = GetSetFormVar('add_value');
$add_value = isset($_POST['new_value_listbox']) ? TRUE : FALSE;

if(isset($_GET["listbox_cat"]) || 
    isset($_POST["extra_prod_info_delelte"]) ||
    isset($_POST["add_listbox_cat"]) || 
    isset($_POST["new_value_listbox"]) || 
    isset($_POST["add_value"]) || 
    isset($_POST["extra_prod_info_update"]))
{
    //show extra info
    $extra_prod_info = TRUE;
}
//values from form
$int_best_syst_id = GetSetFormVar('best_syst_id');
$int_proc_speed = GetSetFormVar('proc_speed');
$int_proc_type = GetSetFormVar('proc_type');
$int_resolutiex = GetSetFormVar('resolutiex');
$int_resolutiey = GetSetFormVar('resolutiey');
$int_kleuren = GetSetFormVar('kleuren');
$int_afm_x = GetSetFormVar('afm_x');
$int_afm_y = GetSetFormVar('afm_y');
$int_afm_z = GetSetFormVar('afm_z');
$int_netto_gewicht = GetSetFormVar('gewicht');
$bl_backlite = GetCheckbox('backlite');
$bl_irood = GetCheckbox('irood');
$bl_wlan = GetCheckbox('wlan');
$bl_gsm_grprs = GetCheckbox('gsm_gprs');
$bl_bluetooth = GetCheckbox('bluetooth');
$txt_type_aansluiting = GetSetFormVar('type_aansluiting');
$int_accu_type = GetSetFormVar('accu_type');
$int_accu_duur = GetSetFormVar('accu_duur');
$int_accu_grootte = GetSetFormVar('accu_size');
$txt_geheugen_type = GetSetFormVar('geheugen_type');
$int_geheugen_intern = GetSetFormVar('geheugen_intern');

// end of main form variables now the optional Multiarticle form vars
$multiaantalnew = isset($_POST["multiaantalnew"]) ?  $_POST["multiaantalnew"] : FALSE;
$multiproductidnew = isset($_POST["multiproductidnew"]) ?  $_POST["multiproductidnew"] : FALSE;
$bl_browserCE = GetBrowserOS("Windows CE");


$flt_extra_cost = isset($_POST['prod_extra_cost']) ? $_POST['prod_extra_cost'] : 0;

//check forms on enter only update:
// if ($_SERVER['REQUEST_METHOD'] == "POST" &&
//                                             !isset($_POST["extra_prod_info_hide"]) &&
//                                             !isset($_POST["extra_prod_info"]) &&
//                                             !isset($_POST["add_value"]) &&
//                                             !isset($_POST["extra_prod_info_deleltesubmit"]) &&
//                                             !isset($_POST["extra_prod_info"]) &&
//                                             !isset($_POST["update_stock"]) &&
//                                             !isset($_POST["update_all_stock"]) &&
//                                             !isset($_POST["update_all_prices"]) &&
//                                             !isset($_POST["copy_product"]) &&
//                                             !isset($_POST["new_product"])
//    )
// {
//     $bl_submit = TRUE;    
//     echo "w0000t";
// }



// Print default Iwex HTML header.
printheader (COMPANYNAME . " Producten Onderhoud", 'PRODmaint', $bl_browserCE);

?><script language="javascript">
function setfocus()
{
document.productmaintform.new_value_listbox.focus();
}
</script><?php

if ($listbox_cat) {
    ?><BODY ONLOAD="setfocus();"><?php
}else {
    echo "<BODY ".get_bgcolor().">";
}
echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='productmaintform'>\n";
//echo include_javascript();

printIwexNav();

// Set EAN to null if null or copy of product.
$prodean = ($prodean == '' || !$prodean || $bl_copy_products) ? 'NULL' : "'".$prodean."'";
$str_merk = GetProductMerk($prodbrand);
    
$sql_product = "current_product_list SET
    merkID = '$prodbrand',
    Merk = '$str_merk',
    ProductName = '$prodname',
    Productdescription = '$proddescription',
    ExternalID = '$prodextid',
    euproductcode = '$prodeu',
    Taric = '$prodtaric',
    EAN = $prodean,
    Supplier = '$prodsupplier',
    LeadTime= '$prodleadtime',
    purchase_price_foreign = '$prodcostforeign',
    ReorderLevel = '$prodreorderlevel',
    Purchase_price_home = '$prodcosthome',
    extra_cost = '$flt_extra_cost ',
    Margin_correction = '$prodmargin',
    Selling_price = '$prod1',
    Btw_class = '$prodbtwclass',
    Selling_price_10 = '$prod10',
    sku = '$prodsku',
    Selling_price_50 = '$prod50',
    Pricelist_yn = '$prodonhand',
    Selling_price_100 = '$prod100',
    Discontinued_yn = '$proddiscontinued',
    Retail_price_ex = '$prodRRP',
    weight_corr = '$prodweightcorr',
    currency = '$prodcurrency',
    CategoryID = '$prodcategory',
    store_serial_yn = '$bl_store_serial',
    public = '$prod_public',
	special = '$prod_special' ";
    
$sql_product_extra_info = " Best_syst_ID = '$int_best_syst_id',
    Processor_snelheid = '$int_proc_speed',
    Processor_type = '$int_proc_type',
    ResolutieX = '$int_resolutiex',
    ResolutieY = '$int_resolutiey',
    Kleuren = '$int_kleuren',
    AfmetingX = '$int_afm_x',
    AfmetingY = '$int_afm_y',
    AfmetingZ = '$int_afm_z',
    Gewicht = '$int_netto_gewicht',
    Backlite_yn = '$bl_backlite',
    Infrarood_yn = '$bl_irood',
    Bluetooth_yn = '$bl_bluetooth',
    WLAN_yn = '$bl_wlan',
    GSM_GPRS_yn = '$bl_gsm_grprs',
    Type_aansluiting = '$txt_type_aansluiting',
    Accu_type_id = '$int_accu_type',
    Accu_duur = '$int_accu_duur',
    Accu_size = '$int_accu_grootte',
    Geheugen_slot = '$txt_geheugen_type',
    Geheugen_int = '$int_geheugen_intern' ";


if ($new_product) {
    $insertproduct_sql = "INSERT INTO current_product_list SET ProductName = 'Nieuw'";
    
    $isertproduct_query = $db_iwex->query($insertproduct_sql);

    $last_productid = $db_iwex->query('SELECT distinct LAST_INSERT_ID() FROM current_product_list');
    $productobj = mysql_fetch_array($last_productid,MYSQL_BOTH);
        
    $last_productid = $productid;
    $productid = $productobj[0];
    mysql_free_result($last_productid);

    $db_iwex->query("INSERT INTO product_stock SET Product_ID = '$productid'");
} 

if ($bl_copy_products) {
    $insertproduct_sql = "INSERT INTO ". $sql_product;
    
    $isertproduct_query = $db_iwex->query($insertproduct_sql);

    $last_productid =  $db_iwex->query('SELECT distinct LAST_INSERT_ID() FROM current_product_list');
    $productobj = mysql_fetch_array($last_productid,MYSQL_BOTH);
    $last_productid = $productid;
    $productid = $productobj[0];

    mysql_free_result($last_productid);
    
    $db_iwex->query("INSERT INTO product_stock SET Product_ID = '$productid'");
    
    $productmulti_sql = "SELECT aantal, Multi_productID, Product_ids, Multi_ID, ProductName
        FROM multi_articles2
        INNER JOIN current_product_list ON multi_articles2.Product_ids=current_product_list.ProductID
        WHERE Multi_ID = '$last_productid';";

    $multi_result = mysql_query($productmulti_sql)
      or die("Ongeldige multi article query: " .$$productmulti_sql. mysql_error());
    while ($objmulti_result = mysql_fetch_object($multi_result)) {
        // update records when there are diferences with last pass
        // but ignore the new line
       if (isset($_POST["multiaantal".$objmulti_result->Multi_productID])
           ||
           isset($_POST["multiproductid".$objmulti_result->Multi_productID]))
       {
             $qry = 'INSERT multi_articles2 set Aantal="'.$_POST["multiaantal".$objmulti_result->Multi_productID].'"'
                .',Product_ids= "'.$_POST["multiproductid".$objmulti_result->Multi_productID]
                .'", Multi_ID = '. $productid;
             $queryres = mysql_query($qry)
                or die("Insert van de multi articels niet gelukt: order " .$qry." error:". mysql_error());

        }
    }
    mysql_free_result($multi_result);
}

// if new button has been pressed in main screen do not run query
if ($productid&&$bl_submit)   // If user has submitted changes
{
    // get product from tabel current_product_list
    $updateproduct_sql = "UPDATE ". $sql_product . "WHERE ProductID = $productid";

    if (!$bl_copy_products) {
        $updateproduct_query = $db_iwex->query($updateproduct_sql);
        $db_iwex->query("UPDATE product_stock 
                         SET location_id = '$prodloc'
                         WHERE Product_ID = $productid
                               AND owner_id = '$int_prodowner'");
    }

    if ($multiaantalnew&&$multiproductidnew) { //When new detail records have been added, insert these first
       $insertqry = 'INSERT INTO multi_articles2 set Multi_ID = "'.$productid.'", Aantal='.$multiaantalnew.', product_ids="'.$multiproductidnew.'" ';
       $querynew = mysql_query($insertqry)
          or die('insert van de multi articles niet gelukt: ' .$insertqry.' error:'. mysql_error());
    }

    $productmulti_sql = MULTI_ARTICLE_SQL."'$productid';";

    $multi_result = mysql_query($productmulti_sql)
      or die("Ongeldige multi article query: " .$$productmulti_sql. mysql_error());
    while ($objmulti_result = mysql_fetch_object($multi_result)) {
        // update records when there are diferences with last pass
        // but ignore the new line
       if (isset($_POST["multiaantal".$objmulti_result->Multi_productID])||isset($_POST["multiproductid".$objmulti_result->Multi_productID]))
       {
             // Check if the record should be deleted.
             if (!$_POST["multiaantal".$objmulti_result->Multi_productID]) {
                 $qry = 'DELETE FROM multi_articles2 WHERE Multi_productID='.$objmulti_result->Multi_productID;
                 $queryres = mysql_query($qry)
                    or die("Verwijderen van RMA acties '$obj->ActionID' niet gelukt: " .$qry." error:". mysql_error());
             } else {
             $qry = 'UPDATE multi_articles2 set Aantal="'.$_POST["multiaantal".$objmulti_result->Multi_productID].'"'
                .',Product_ids= "'.$_POST["multiproductid".$objmulti_result->Multi_productID].'"'
                .' WHERE Multi_productID='.$objmulti_result->Multi_productID;
             $queryres = mysql_query($qry)
                or die("update van de RMA acties niet gelukt: order " .$qry." error:". mysql_error());

             }
        }
    }
    mysql_free_result($multi_result);
}

//EXTRA PRODUCT INFO update
if($bl_extra_prod_info_update){
    if($productid && $int_best_syst_id && $int_proc_type){
        //if exists product id: update
        if(check_extra_info($productid)){
            $query = "UPDATE extra_product_info SET" .$sql_product_extra_info. "WHERE ProductID = '$productid'";
            $bericht = "Extra product info geupdate.";
        //else insert
        }else {
            $query = "INSERT INTO extra_product_info SET ProductID = '$productid'," .$sql_product_extra_info;
            $bericht = "Product informatie toegevoegd.";
        }
        mysql_query($query) or die($query."<BR><BR>".mysql_error());
    }else {
        $bericht = "Error! Controleer of alle waardes zijn ingevuld.";
    }
}else if ($bl_extra_prod_info_delelte && $supervisor) { //delete the extra product info if the user is a supervisor
    $qry_delete = "DELETE FROM extra_product_info WHERE ProductID = '$productid'";
    mysql_query($qry_delete) or die($qry_delete."<BR><BR>".mysql_error());
    $bericht = "Extra info van product id: $productid is succesvol verwijderd.";
}
if ($bl_update_stock)  // if a productid is given but submit is not pressed
{
    update_all_stock($productid, $int_prodowner);
}

if ($bl_update_all_stock)  // if a productid is given but submit is not pressed
{
    update_all_stock();
}

/* if ($bl_update_all_prices)  // if a productid is given but submit is not pressed
{
    $selectpriceupdqry = "SELECT statement from query WHERE Name='Prijsupd_a';";
    $priceupdqry_result = mysql_query($selectpriceupdqry)
       or die("Ongeldige select details query: " .$selectpriceupdqry. mysql_error());
    $objprice = mysql_fetch_object($priceupdqry_result);

    $updateprice_sql = $objprice->statement;
//    echo "<p>$updateprice_sql</p>";
    mysql_free_result($priceupdqry_result);
    
    echo show_table($updateprice_sql);
}*/

if ($productid)  // if a productid is given 
{
    $actual_stock = get_stock($productid, $int_prodowner);

    // get product from tabel current_product_list
    $productmain_sql = "SELECT *, SUM(product_stock.stock) AS sumStock
      FROM current_product_list
      LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '$int_prodowner'
      LEFT JOIN location ON product_stock.location_id = location.ID
      WHERE ProductID = '$productid'
      GROUP BY owner_id";
    $productdetail_query = $db_iwex->query($productmain_sql);
    $obj = mysql_fetch_object($productdetail_query);

    echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "    <TR>\n";
    if (!$bl_browserCE) {
        echo "         <TH colspan='2'>";
    } else {
        echo "         <TH>";
    }
    echo "<input type=\"hidden\"  NAME=\"productid\" CLASS=\"form\" value=\"$obj->ProductID\"><B>Product ID $obj->ProductID</B> --> Calculated Stock: ".$actual_stock."</TH>\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "     <TD VALIGN=\"top\"><TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "         <TR>\n";
    echo "             <TD>Merk: </TD><TD>".makelistbox('SELECT brand_id, name FROM brand order by name','prodbrand','brand_id','name',$obj->MerkID)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Description: </TD><TD><textarea NAME=\"prodname\" rows=\"5\" cols=\"40\" CLASS=\"form\">$obj->ProductName</textarea></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Catalog text: </TD><TD><textarea NAME=\"proddescription\" rows=\"7\" cols=\"40\" CLASS=\"form\">$obj->Productdescription</textarea></TD>";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>External ID: </TD><TD><input type=\"text\" SIZE=\"50\"  NAME=\"prodextid\" CLASS=\"form\" value=\"$obj->ExternalID\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>EU code: </TD><TD><input type=\"text\" SIZE=\"50\"  NAME=\"prodeu\" CLASS=\"form\" value=\"$obj->euproductcode\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Taric code: </TD><TD><input type=\"text\" SIZE=\"50\"  NAME=\"prodtaric\" CLASS=\"form\" value=\"$obj->Taric\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>EAN code: </TD><TD><input type=\"text\" SIZE=\"15\"  NAME=\"prodean\" CLASS=\"form\" value=\"$obj->EAN\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Supplier: </TD><TD>".makelistbox('SELECT ContactID, CompanyName FROM contacts WHERE Supplier_yn<>0 ORDER by CompanyName','prodsupplier','ContactID','CompanyName',$obj->Supplier)."</TD>\n";
    echo "         </TR>\n";
    echo "         </table>";
    if (!$bl_browserCE) {
        echo "     </TD>\n";
        echo "     <TD WIDTH='100%' VALIGN='top'>\n";
    }
    //hide extra info with a javascript
    echo("<input type='button' value='Show/hide extra info' style='width:100pt;height:15pt;' onClick='toggleMenu(\"extrainfo\")'>");
    echo("<input type='button' value='prijs info' style='width:100pt;height:15pt;' onClick='toggleMenu(\"prijsinfo\")'>");
    echo " <table border='0' width='100%' cellspacing='2' class=\"blockbody\" cellpadding='1' style='display:block;' id='prijsinfo'>";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Leadtime: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"prodleadtime\" CLASS=\"form\" value=\"$obj->LeadTime\"></TD>\n";
    echo "             <TD ALIGN=\"right\" >Cost at origin: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"prodcostforeign\" CLASS=\"form\" value=\"$obj->purchase_price_foreign\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Reorderlevel: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodreorderlevel\" CLASS=\"form\" value=\"$obj->ReorderLevel\"></TD>\n";
    echo "             <TD ALIGN=\"right\" >Currency: </TD><TD>".makelistbox('SELECT ValutaID, ValutaName FROM valuta ORDER by ValutaName','prodcurrency','ValutaID','ValutaName',$obj->currency)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Last (free) Stock: </TD><TD>";
    // When there are product for other customers show the selection box.
    if (GetField("SELECT Product_ID
                 FROM product_stock
                 WHERE Product_ID = '$obj->ProductID'
                       AND owner_id <> '".OWN_COMPANYID."'")) {
         echo preg_replace ("/<select name/", "<select OnChange=\"location.replace('".$_SERVER['PHP_SELF']."?productid=$obj->ProductID&product_ownerid='+product_ownerid.value)\" name",
                            makelistbox("SELECT owner_id, SUBSTRING(CONCAT_WS(', ', stock, CompanyName), 1, 20) AS stockowner
                                         FROM product_stock
                                         INNER JOIN contacts ON owner_id = ContactID
                                         WHERE Product_ID = '$obj->ProductID'
                                         ORDER BY stock",
                                         'product_ownerid',
                                         'owner_id',
                                         'stockowner',
                                         $int_prodowner));
    } else {
        echo $obj->stock;
    }
    echo "(".getfreestock($obj->ProductID,
                          0,
                          $int_prodowner).")</TD>\n";
    echo "             <TD ALIGN=\"right\" >Cost at warehouse: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodcosthome\" CLASS=\"form\" value=\"$obj->Purchase_price_home\">+";
    echo "				    <input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"prod_extra_cost\" CLASS=\"form\" value=\"$obj->extra_cost\"></TD>\n";
    echo "         </TR>\n";
    echo "         </TR>\n";
    echo "             <TD ALIGN=\"right\" >BTW Class: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodbtwclass\" CLASS=\"form\" value=\"$obj->Btw_class\"></TD>\n";
    echo "             <TD ALIGN=\"right\" >Margin Correction: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodmargin\" CLASS=\"form\" value=\"$obj->Margin_correction\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >SKU: </TD><TD>".makelistbox('SELECT value,text FROM listbox WHERE category=4;','prodsku','value','text',$obj->sku)."</TD>\n";
    echo "             <TD ALIGN=\"right\" >1+ : </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prod1\" CLASS=\"form\" value=\"$obj->Selling_price\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR".MakeProductState_rowcolor($obj->Discontinued_yn, $obj->stock, $obj->Pricelist_yn).">\n";
    echo "             <TD ALIGN=\"right\" >Pricelist: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodonhand\" CLASS=\"form\" value=\"$obj->Pricelist_yn\"></TD>\n";
    echo "             <TD ALIGN=\"right\" >10+: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prod10\" CLASS=\"form\" value=\"$obj->Selling_price_10\"></TD>\n";
    echo "         <TR".MakeProductState_rowcolor($obj->Discontinued_yn, $obj->stock, $obj->Pricelist_yn).">\n";
    echo "             <TD ALIGN=\"right\" >Discontinued: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"proddiscontinued\" CLASS=\"form\" value=\"$obj->Discontinued_yn\"></TD>\n";
    echo "             <TD ALIGN=\"right\" >50+: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prod50\" CLASS=\"form\" value=\"$obj->Selling_price_50\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Weight: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodweightcorr\" CLASS=\"form\" value=\"$obj->weight_corr\"> kg</TD>\n";
    echo "             <TD ALIGN=\"right\" >100+: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prod100\" CLASS=\"form\" value=\"$obj->Selling_price_100\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Locatie: </TD>";
    echo "<TD>".makelistbox('SELECT ID, location FROM location','prodloc','ID','location',$obj->location_id)."</td>\n"; 
    echo "             <TD ALIGN=\"right\" >RRP: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodRRP\" CLASS=\"form\" value=\"$obj->Retail_price_ex\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Category: </TD><TD>".makelistbox('SELECT CategoryID, CategoryName FROM categories ORDER by CategoryName','prodcategory','CategoryID','CategoryName',$obj->CategoryID)."</TD>\n";
    echo "             <TD ALIGN=\"right\" >Public:</TD><TD>".MakeCheckbox('prod_public',$obj->public)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\">Serial number.:</TD><TD>".MakeCheckbox('store_serial',$obj->store_serial_yn)."</TD>\n";
    echo "             <TD ALIGN=\"right\">Special:</TD><TD>".MakeCheckbox('prod_special',$obj->special)."</TD>\n";
    echo "         </TR>\n";
    echo "         </table>";

    if ($obj->sku<>1) {
        // get multi article parts
        $productmulti_sql = MULTI_ARTICLE_SQL . $productid ;
            
        $productmulti_query = mysql_query($productmulti_sql)
           or die("Ongeldige select details query: " .$productmulti_sql. mysql_error());
        echo "         <TABLE BORDER=\"0\" WIDTH=\"100%\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
        echo "         <TR>\n";
        echo "             <TH COLSPAN=\"6\" >Multi Article Parts</TH>\n";
        echo "         </TR>\n";
        echo "         <TR>\n";
        echo "             <TH>#</TH><TH>Article ID</TH><TH>Articlename</TH><TH>Stock</TH><TH>Vrij</TH><th>Cost</th>\n";
        echo "         </TR>\n";
        // always display new record for adding
        echo "             <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"1\" NAME=\"multiaantalnew\" CLASS=\"form\" ></TD>
                           <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"multiproductidnew\" CLASS=\"form\" >"
                           .GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", 'multiproductidnew', 'productmaintform.multiproductidnew').
                           "</TD><TD></TD><td></td>\n";

        $flt_productcost = 0;
        while ($objmulti = mysql_fetch_object($productmulti_query)) {
            echo "         <TR>\n";
            echo "             <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"1\" NAME=\"multiaantal".$objmulti->Multi_productID."\" CLASS=\"form\" value=\"$objmulti->aantal\"></TD>
                                <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"multiproductid".$objmulti->Multi_productID."\" CLASS=\"form\" value=\"$objmulti->Product_ids\">"
                                .GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", 'multiproductid'.$objmulti->Multi_productID, 'productmaintform.multiproductid'.$objmulti->Multi_productID).
                                "</TD><TD>$objmulti->ProductName</TD>
                                <TD align=\"right\"><a href='".$_SERVER['PHP_SELF']."?productid=$objmulti->Product_ids' target='_new'>".get_stock($objmulti->Product_ids)."</a></td>
                                <TD align=\"right\"><A href='products_sold.php?ProductID=$objmulti->Product_ids' target='_new'>".getfreestock($objmulti->Product_ids)."</a></td>
                                <td align=\"right\">$objmulti->Purchase_price_home</td>\n";
            echo "         </TR>\n";
            $flt_productcost += $objmulti->aantal * $objmulti->Purchase_price_home;
        }
        echo "         </table>";
        
        $flt_productcost = sprintf("%.2f", $flt_productcost);
        echo "<DIV ALIGN=right>Total product cost = <b>&euro; $flt_productcost</b></div>";
    }
    
    // get product from tabel current_product_list
    $sql_extra_info = "SELECT *
    FROM current_product_list
    INNER JOIN extra_product_info ON current_product_list.ProductID = extra_product_info.ProductID
    WHERE extra_product_info.ProductID = '$productid';";
    $query_extra_info = mysql_query($sql_extra_info) or die("Ongeldige select extra info query: " .$sql_extra_info. "<BR>" .mysql_error());
    $obj_extra_info = mysql_fetch_object($query_extra_info);
        
    echo("<table border='0' width='100%' cellspacing='2' class=\"blockbody\" cellpadding='1' style='display:none;' id='extrainfo'>");
    echo "     <TR><TH COLSPAN=\"2\">Extra product info</TH></TR>\n";
    echo "     <TR><TD COLSPAN=\"2\"><CENTER><H2>$bericht</CENTER></H2><BR></TD></TR>\n"; //insert a break
  //create a text field to add a new value to the listbox
    if ($listbox_cat){
        echo "<TR><TD COLSPAN=\"2\">Geef de nieuwe waarde voor de text box: <INPUT TYPE=\"text\" NAME=\"new_value_listbox\" CLASS=\"form\" SIZE=\"30\">\n";
        echo "<INPUT TYPE=\"submit\" NAME=\"add_value\" CLASS=\"form\" value=\"Toevoegen\">\n";
        echo "<INPUT TYPE=\"hidden\" NAME=\"add_listbox_cat\" value=\"$listbox_cat\">\n";
        echo "</TD></TR>\n";
        echo "<TR><TD COLSPAN=\"2\"><BR></TD></TR>\n"; //insert a break
    }
  //add new listbox
    if ($add_value){
        echo "<TR><TD COLSPAN=\"2\">\n";
        echo add_listbox_cat($add_listbox_cat, $new_value_listbox);
        echo "</TD></TR>\n";
        echo "<TR><TD COLSPAN=\"2\"><BR></TD></TR>\n"; //insert a break
    }

    echo "         <TR>\n";
    echo "             <TD WIDTH=\"25%\">Besturingssysteem: </TD>
                       <TD>".makelistbox('SELECT value,text FROM listbox WHERE category='.DB_LISTBOX_BEST_SYST.';','best_syst_id','value','text',$obj_extra_info->Best_syst_ID)."";
    if($saccess_s || $supervisor){
      //rechten ==> sales -> setup
        echo "         <A HREF=".$_SERVER["PHP_SELF"]."?productid=$productid&listbox_cat=".DB_LISTBOX_BEST_SYST.">Add value ...</A></TD>\n";
    }
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Processor type: </TD>
                       <TD>".makelistbox('SELECT value,text FROM listbox WHERE category='.DB_LISTBOX_PROCESSOR.';','proc_type','value','text',$obj_extra_info->Processor_type)."";
    if($saccess_s || $supervisor){
        echo "         <A HREF=".$_SERVER["PHP_SELF"]."?productid=$productid&listbox_cat=".DB_LISTBOX_PROCESSOR.">Add value ...</A></TD>\n";
    }
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Processor snelheid (mHz): </TD>
                       <TD><input type=\"text\" SIZE=\"10\" NAME=\"proc_speed\" CLASS=\"form\" value=\"$obj_extra_info->Processor_snelheid\"></TD>";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Resolutie X,Y (pixels): </TD>
                       <TD><input type=\"text\" SIZE=\"4\"  NAME=\"resolutiex\" CLASS=\"form\" value=\"$obj_extra_info->ResolutieX\">x\n
                           <input type=\"text\" SIZE=\"4\"  NAME=\"resolutiey\" CLASS=\"form\" value=\"$obj_extra_info->ResolutieY\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Kleuren (int): </TD>
                       <TD><input type=\"text\" SIZE=\"10\"  NAME=\"kleuren\" CLASS=\"form\" value=\"$obj_extra_info->Kleuren\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Afmeting L,B,H (mm): </TD>
                       <TD><input type=\"text\" SIZE=\"4\"  NAME=\"afm_x\" CLASS=\"form\" value=\"$obj_extra_info->AfmetingX\">x\n
                           <input type=\"text\" SIZE=\"4\"  NAME=\"afm_y\" CLASS=\"form\" value=\"$obj_extra_info->AfmetingY\">x\n
                           <input type=\"text\" SIZE=\"4\"  NAME=\"afm_z\" CLASS=\"form\" value=\"$obj_extra_info->AfmetingZ\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Netto gewicht (gram): </TD>
                       <TD><input type=\"text\" SIZE=\"10\"  NAME=\"gewicht\" CLASS=\"form\" value=\"$obj_extra_info->Gewicht\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Backlite: </TD><TD>".MakeCheckbox('backlite', $obj_extra_info->Backlite_yn)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Infrarood: </TD><TD>".MakeCheckbox('irood', $obj_extra_info->Infrarood_yn)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>WLAN: </TD><TD>".MakeCheckbox('wlan', $obj_extra_info->WLAN_yn)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>GSM/GPRS: </TD><TD>".MakeCheckbox('gsm_gprs', $obj_extra_info->GSM_GPRS_yn)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Bluetooth: </TD><TD>".MakeCheckbox('bluetooth', $obj_extra_info->Bluetooth_yn)."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Type aansluiting (txt): </TD>
                       <TD><input type=\"text\" NAME=\"type_aansluiting\" SIZE=\"30\" CLASS=\"form\" value=\"$obj_extra_info->Type_aansluiting\">\n       
                       </TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Accu type: </TD>
                       <TD>".makelistbox('SELECT value,text FROM listbox WHERE category='.DB_LISTBOX_ACCU.';','accu_type','value','text',$obj_extra_info->Accu_type_id)."";
    if($saccess_s || $supervisor){
        echo  "        <A HREF=".$_SERVER["PHP_SELF"]."?productid=$productid&listbox_cat=".DB_LISTBOX_ACCU.">Add value ...</A></TD>\n";
    }
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Accu duur (uur): </TD>
                       <TD><input type=\"text\" NAME=\"accu_duur\" SIZE=\"10\" CLASS=\"form\" value=\"$obj_extra_info->Accu_duur\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Accu grootte (mAh): </TD>
                       <TD><input type=\"text\" NAME=\"accu_size\" SIZE=\"10\" CLASS=\"form\" value=\"$obj_extra_info->Accu_size\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Geheugen type (txt): </TD>
                       <TD><input type=\"text\" NAME=\"geheugen_type\" CLASS=\"form\" value=\"$obj_extra_info->Geheugen_slot\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD>Geheugen intern (MB): </TD>
                       <TD><input type=\"text\" NAME=\"geheugen_intern\" CLASS=\"form\" value=\"$obj_extra_info->Geheugen_int\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR><TD><BR></TD></TR>\n"; //insert a break
    echo "         <TR>\n";
    echo "             <TD COLSPAN=\"2\" ALIGN=\"center\">\n";
    if(check_extra_info($productid)){
        echo "<INPUT TYPE=\"hidden\" NAME=\"extra_prod_info_update\" value=\"\">\n";
        echo "<INPUT TYPE=\"button\" value=\"Update extra info\" onclick='document.productmaintform.extra_prod_info_update.value=\"TRUE\";document.productmaintform.submit();'>\n";
        if($saccess_s || $supervisor){
      //alleen met supervisor of setup sales rechten mag men deleten
            echo "<INPUT TYPE=\"hidden\" NAME=\"extra_prod_info_delelte\" VALUE=''>\n";
            echo "<INPUT TYPE=\"button\" value=\"Delete extra info\" 
             onclick='document.productmaintform.extra_prod_info_delelte.value=\"TRUE\";return confirm(\"Alle extra informatie zal worden verwijderd. Akkoord?\")';document.productmaintform.submit();\">\n";
        }
    }else {
        echo "  <INPUT TYPE=\"hidden\" NAME=\"extra_prod_info_update\" value=''>\n";
        echo "  <INPUT TYPE=\"button\" value=\"Insert extra info\" onclick='document.productmaintform.extra_prod_info_update.value=\"TRUE\";document.productmaintform.submit();'>\n";
    }
    echo "         </TD></TR>\n";
    echo "         <TR><TD><BR></TD></TR>\n"; //insert a break
    echo "    </TABLE>\n";
    
    
    echo "     </TD>\n";
    echo "     </TR>\n";
    echo "     <TR>\n";
    $_SESSION["popup_function"] = "print_inventory_transactions"; //set which function to execute in popup.php
    $_SESSION["popup_parm"] = $obj->ProductID; //set What option to use in popup.php
    echo "          <TD colspan='2' ALIGN=\"right\">\n";
    echo "          <INPUT TYPE=\"button\" NAME=\"productlist\" onClick=\"location.replace('Products.php');\" VALUE=\"Return to list\">\n";
    echo "          <INPUT TYPE=\"submit\" NAME=\"Update\" CLASS=\"form\" value=\"Update\">\n";
    echo "          <INPUT TYPE=\"button\" NAME=\"image\" VALUE='Image' ".js_upload_img.">";
    echo "          <INPUT TYPE=\"button\" NAME=\"relations\" VALUE='associations' onclick=\"location.replace('product_association.php?productid=$productid');\">";
    echo "          <INPUT TYPE=\"submit\" NAME=\"update_stock\" CLASS=\"form\" value=\"update stock\">\n";
    echo "          <INPUT TYPE=\"submit\" NAME=\"update_all_stock\" CLASS=\"form\" value=\"update all stock\">\n";
    echo "          <INPUT TYPE=\"submit\" NAME=\"new_product\" CLASS=\"form\" value=\"new\">\n";
    echo "          <INPUT TYPE=\"submit\" NAME=\"copy_product\" CLASS=\"form\" value=\"Copy\">\n";
    echo "          <INPUT TYPE=\"button\" NAME=\"Print_Label\" VALUE=\"Print Label\" onClick=\"window.open('label.php?productid=$productid','Product_$productid','toolbar=0,location=1,menubar=0,resizable=1,scrollbars=1,dependent=0,status=0,width=500,height=300,left=25,top=25');\">\n";
    echo "          <INPUT TYPE=\"button\" NAME=\"sold_to\" CLASS=\"form\" value=\"Verkocht aan...\"
        onclick= \"window.open('products_sold.php?ProductID=".$obj->ProductID."','Producten verkocht','toolbar=0,menubar=0,scrollbars=1,resizable=1,dependent=0,status=0,width=800,height=500,left=25,top=25')\">\n";
    echo "          <input type=\"button\" NAME=\"transactions\" CLASS=\"form\" value=\"Transacties\"
        onclick= \"window.open('popup.php?ProductID=$obj->ProductID','popup','toolbar=0,menubar=0,scrollbars=1,resizable=1,dependent=0,status=0,width=800,height=500,left=25,top=25')\">\n";
        
    if ($obj->sku<>1) {
        echo "          <input type=\"button\" NAME=\"make_multi\" onClick=\"location.replace('multiarticles.php?ProductID=$obj->ProductID');\" value=\"Maken\">\n";

//    echo "          <input type=\"submit\" NAME=\"update_all_prices\" CLASS=\"form\" value=\"update all prices\">\n";
    echo "          <input type=\"hidden\" NAME=\"productid\" CLASS=\"form\" value=\"$productid\"></TD>\n";
    echo "          <input type=\"hidden\" NAME=\"calc_stock\" CLASS=\"form\" value=\"".$actual_stock."\"></TD>\n";
    echo "     </TR>\n";
    echo "</table>";
    }
    /*if(!$extra_prod_info && GetField('SELECT CategoryID FROM current_product_list WHERE ProductID = '.$productid.'') == '3') {
        //echo "      </TR><TR><TD ALIGN=\"left\">\n";
        echo "      <BR><INPUT TYPE=\"submit\" WIDTH=\"35\" NAME=\"extra_prod_info\" CLASS=\"form\" value=\"Laat extra info zien > > >\">\n";
        //echo "      </TD>\n";
    }else if($extra_prod_info){  //show extra prod info
        echo "      <BR><INPUT TYPE=\"submit\" WIDTH=\"35\" NAME=\"extra_prod_info_hide\" CLASS=\"form\" value=\"Verberg extra info < < <\">\n";
    }*/
    echo "<table border=0 WIDTH=\"100%\" class=\"blockbody\"><tr>"
        ."<td VALIGN=top>".ShowImage($obj->ProductID,30)
        ."</td><td VALIGN=top>".FormatDescription($obj->Productdescription)
        ."</td><td VALIGN=top>".ShowImage($obj->ProductID)."</td></tr></table>"
        ."</TD></TR></TABLE>";
} else {
    echo "Product ID <input type=\"text\" NAME=\"productid\" CLASS=\"form\" SIZE=\"6\"> naam ".GetRecordIdInputField(SQL_SEARCH_PRODUCTS_LIST, "ID", "productnamesearch", "productmaintform.productid", "product", 20). "\n<br>";
    echo "<input type=\"submit\" NAME=\"zoek\" CLASS=\"form\" value=\"show\">\n";
}
    
echo "</FORM>\n";
printenddoc();
?>
