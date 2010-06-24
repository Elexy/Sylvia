<?php

/**
 * Function     : ShowProductDetails
 * Get the productdetails
 * Input        :  $bl_update : upadet or not
 $int_productid: duh....
 $formname : name of the calling form
 * Returns      : true
 **/

function ShowProductDetails($bl_update, 
    $int_productid,
    $formname) {
  $returnvar='';
  $_GLOBAL["str_backdir"] = '../';

  if ($int_productid) {
    global $db_iwex;

    if (edit_button()) {
      $edit_this = FALSE;
    } else {
      $edit_this = " DISABLED ";
    }
    if ($bl_update && edit_button()) {

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
      //buttons
      $make_EAN = isset($_POST["makeEAN"]) ?  $_POST["makeEAN"] : FALSE;

      // really make ean NULL because it's a unique value in the DB
      if (!$prodean) $prodean = "NULL";

      if ($make_EAN) $prodean = GetNewEANcode();

      // Set EAN to null if null or copy of product.
      //$prodean = ($prodean == '' || !$prodean || $bl_copy_products) ? 'NULL' : "'".$prodean."'";
      $str_merk = GetProductMerk($prodbrand);

      $sql_product = "current_product_list SET ";
      $sql_product .= $prodbrand ?  "merkID = '$prodbrand', " : false ;
      $sql_product .= $str_merk ? "Merk = '$str_merk', " : false ;
      $sql_product .= $prodname ? "ProductName = '$prodname', " : false ;
      $sql_product .= $proddescription ? "Productdescription = '$proddescription', " : false ;
      $sql_product .= $prodextid ? "ExternalID = '$prodextid', " : false ;
      $sql_product .= $prodeu ? "euproductcode = '$prodeu', " : false ;
      $sql_product .= $prodtaric ? "Taric = '$prodtaric', " : false ;
      $sql_product .= $prodsupplier ? "Supplier = '$prodsupplier', " : false;
      $sql_product .= "EAN = $prodean ";

      // Set Producthistory when the product is changed.
      SetProductHistory($int_productid, "Merk", $str_merk);
      SetProductHistory($int_productid, "ProductName", $prodname);
      SetProductHistory($int_productid, "Productdescription", $proddescription);
      SetProductHistory($int_productid, "ExternalID", $prodextid);
      SetProductHistory($int_productid, "euproductcode", $prodeu);
      SetProductHistory($int_productid, "Taric", $prodtaric);
      SetProductHistory($int_productid, "EAN", $prodean);
      SetProductHistory($int_productid, "Supplier", $prodsupplier);

      if ($prodbrand||$str_merk||$prodname||$proddescription||$prodextid||$prodtaric||$prodean) {
        $updateproduct_sql = "UPDATE ". $sql_product . "WHERE ProductID = $int_productid";

        if(!$updateproduct_query = $db_iwex->query($updateproduct_sql)) echo "Update productdetails unsuccesful";
      }
    }

    // get product from tabel current_product_list
    $productmain_sql = "SELECT *
          FROM current_product_list
          WHERE ProductID = '$int_productid'";

    $productdetail_query = $db_iwex->query($productmain_sql);
    if ($obj = mysql_fetch_object($productdetail_query)) {
      if (edit_button()) {
        $edit_this = FALSE;
      } else {
        $edit_this = " DISABLED ";
      }

      $returnvar =  "    <TABLE BORDER=\"0\" CELLPADDING=\"1\" WIDTH=\"100%\" CELLSPACING=\"0\" class=\"blockbody\">\n";
      $returnvar .=  "         <TR>\n<TH ALIGN='left'>" . edit_button("waccess_v", $formname) . "
                                     <INPUT TYPE=\"button\" NAME=\"Print_Label\" VALUE=\"Print Label\" 
                                        onClick=\"window.open('" . $_GLOBAL["str_backdir"] . "label.php?productid=$int_productid','Product_$int_productid','toolbar=0,location=1,menubar=0,resizable=1,scrollbars=1,dependent=0,status=0,width=500,height=300,left=25,top=25');\"</TH>
                                     <TH COLSPAN='2'>Basis gegevens</TH></TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>Merk: </TD><TD>".
          makelistbox('SELECT brand_id, name FROM brand order by name',
          'prodbrand',
          'brand_id',
          'name',
          $obj->MerkID,
          '','',$edit_this)
          ."</TD>\n";
      $returnvar .=  "             <TD ROWSPAN='8'>".ShowImage($int_productid,350)."</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>Description: </TD><TD><textarea $edit_this NAME=\"prodname\" rows=\"5\" cols=\"40\" CLASS=\"form\">$obj->ProductName</textarea></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>Catalog text: </TD><TD><textarea $edit_this NAME=\"proddescription\" rows=\"7\" cols=\"40\" CLASS=\"form\">$obj->Productdescription</textarea></TD>";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>External ID: </TD><TD><input $edit_this type=\"text\" SIZE=\"50\"  NAME=\"prodextid\" CLASS=\"form\" value=\"$obj->ExternalID\"></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>EU code: </TD><TD><input $edit_this type=\"text\" SIZE=\"50\"  NAME=\"prodeu\" CLASS=\"form\" value=\"$obj->euproductcode\"></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>Taric code: </TD><TD><input $edit_this type=\"text\" SIZE=\"50\"  NAME=\"prodtaric\" CLASS=\"form\" value=\"$obj->Taric\"></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $int_ean = GetEANcode($int_productid);
      $returnvar .=  "             <TD>EAN code: </TD><TD><input $edit_this type=\"text\" SIZE=\"15\"  NAME=\"prodean\" CLASS=\"form\" value=\"$obj->EAN\">";
      if (!$int_ean && IWEX_EAN_CODE_BEGIN) $returnvar .=  "<INPUT TYPE='hidden' NAME='makeEAN' VALUE='0'>
											<INPUT $edit_this TYPE='button' NAME='EAN_button' VALUE='EAN code maken'
											onclick='document.$formname.makeEAN.value=\"TRUE\";
													document.$formname.update_var.value=\"1\";
													document.$formname.submit();'>";
      $returnvar .=  "</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD>Supplier: </TD><TD>".
          makelistbox('SELECT ContactID, CompanyName FROM contacts WHERE Supplier_yn<>0 ORDER by CompanyName',
          'prodsupplier',
          'ContactID',
          'CompanyName',
          $obj->Supplier,
          '','',$edit_this).
          "</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "<TR><td colspan=2><p><b>Preview</b></P>$obj->Productdescription</td></tr>\n";
    }
    $returnvar .=  "     </table>";
  }
  return $returnvar;
}    

/**
 * Function     : ShowProductPArms
 * show several parameters of the product.
 * Input        : $bl_update : upadet or not
 $int_productid: duh....
 $formname : name of the calling form
 * Returns      : formatted string if it worked, otherwise ''
 **/
function ShowProductParms($bl_update, 
    $int_productid,
    $formname,
    $int_prodowner) {
  global $waccess_v; // Write acces stock

  $returnvar='';

  if ($int_productid) {
    global $db_iwex;

    // get buttons
    $bl_update_stock = isset($_POST["update_stock"]) ? TRUE : FALSE;
    $update_product_prices = isset($_POST["update_product_prices"]) ? TRUE : FALSE;

    if ($bl_update
        &&
        edit_button()
        &&
        isset($_POST["prodleadtime"])) {
    //initialize and get all the formdata
      $prodleadtime = isset($_POST["prodleadtime"]) ?  $_POST["prodleadtime"] : FALSE;
      $prodcostforeign = isset($_POST["prodcostforeign"]) ?  $_POST["prodcostforeign"] : FALSE;
      $prodreorderlevel = isset($_POST["prodreorderlevel"]) ?  $_POST["prodreorderlevel"] : FALSE;
      $prodcosthome = isset($_POST["prodcosthome"]) ?  $_POST["prodcosthome"] : FALSE;
      $prod_extra_cost = isset($_POST["prod_extra_cost"]) ?  $_POST["prod_extra_cost"] : FALSE;
      $prodmargin = isset($_POST["prodmargin"]) ?  $_POST["prodmargin"] : FALSE;
      $prod1 = isset($_POST["prod1"]) ?  $_POST["prod1"] : FALSE;
      $prodbtwclass = isset($_POST["prodbtwclass"]) ?  $_POST["prodbtwclass"] : FALSE;
      $prodsku = isset($_POST["prodsku"]) ?  $_POST["prodsku"] : FALSE;
      $prodonhand = isset($_POST["prodonhand"]) ?  $_POST["prodonhand"] : FALSE;
      $proddiscontinued = isset($_POST["proddiscontinued"]) ?  $_POST["proddiscontinued"] : FALSE;
      $prodRRP = isset($_POST["prodRRP"]) ?  $_POST["prodRRP"] : FALSE;
      $prodweightcorr = isset($_POST["prodweightcorr"]) ?  $_POST["prodweightcorr"] : FALSE;
      $prodcurrency = isset($_POST["prodcurrency"]) ?  $_POST["prodcurrency"] : FALSE;
      $prodloc = isset($_POST["prodloc"]) ?  $_POST["prodloc"] : FALSE;
      $prodcategory = isset($_POST["prodcategory"]) ?  $_POST["prodcategory"] : FALSE;
      $minorderquanty = isset($_POST["min_order_quanty"]) ?  $_POST["min_order_quanty"] : FALSE;
      $prod_public = GetCheckbox('prod_public');
      $prod_special = getCheckbox('prod_special');
      $bl_store_serial = GetCheckbox('store_serial');

      $sql_product = "current_product_list SET ";
      $sql_product .= $prodleadtime !== FALSE ? "LeadTime= '$prodleadtime', " : "" ;
      $sql_product .= $prodcostforeign !== FALSE ? "purchase_price_foreign = '$prodcostforeign', " : "" ;
      $sql_product .= $prodreorderlevel !== FALSE ? "ReorderLevel = '$prodreorderlevel', " : "" ;
      $sql_product .= $prodcosthome !== FALSE ? "Purchase_price_home = '$prodcosthome', " : "" ;
      $sql_product .= $prod_extra_cost !== FALSE ? "extra_cost = '$prod_extra_cost ', " : "" ;
      $sql_product .= $prodmargin !== FALSE ? "Margin_correction = '$prodmargin', " : "" ;
      $sql_product .= $prod1 !== FALSE ? "Selling_price = '$prod1', " : "" ;
      $sql_product .= $prodbtwclass !== FALSE ? "Btw_class = '$prodbtwclass', " : "" ;
      $sql_product .= $prod10 !== FALSE ? "Selling_price_10 = '$prod10', " : "" ;
      $sql_product .= $prodsku !== FALSE ? "sku = '$prodsku', " : "" ;
      $sql_product .= $prod50 !== FALSE ? "Selling_price_50 = '$prod50', " : "" ;
      $sql_product .= $prodonhand !== FALSE ? "Pricelist_yn = '$prodonhand', " : "" ;
      $sql_product .= $prod100 !== FALSE ? "Selling_price_100 = '$prod100', " : "" ;
      $sql_product .= $proddiscontinued !== FALSE ? " Discontinued_yn = '$proddiscontinued', " : "" ;
      $sql_product .= $prodRRP !== FALSE ? "Retail_price_ex = '$prodRRP', " : "" ;
      $sql_product .= $prodweightcorr !== FALSE ? "weight_corr = '$prodweightcorr', " : "" ;
      $sql_product .= $prodcurrency !== FALSE ? "currency = '$prodcurrency', " : "" ;
      $sql_product .= $prodcategory !== FALSE ? "CategoryID = '$prodcategory', " : "" ;
      $sql_product .= $minorderquanty !== FALSE ? "Reorder_q = '$minorderquanty', " : "" ;
      $sql_product .= $bl_store_serial !== FALSE ? "store_serial_yn = '$bl_store_serial', " : "" ;
      $sql_product .= $prod_public !== FALSE ? "public = '$prod_public', " : "" ;
      $sql_product .= $prod_special !== FALSE ? "special = '$prod_special' " : "" ;

      // Set Producthistory when the product is changed.
      SetProductHistory($int_productid, "LeadTime", $prodleadtime);
      SetProductHistory($int_productid, "ReorderLevel", $prodreorderlevel);
      SetProductHistory($int_productid, "Btw_class", $prodbtwclass);
      SetProductHistory($int_productid, "sku", $prodsku);
      SetProductHistory($int_productid, "Pricelist_yn", $prodonhand);
      SetProductHistory($int_productid, "Discontinued_yn", $proddiscontinued);
      SetProductHistory($int_productid, "weight_corr", $prodweightcorr);
      SetProductHistory($int_productid,
          "location_id",
          "Owner $int_prodowner, Location: $prodloc",
          FALSE,
          "Owner $int_prodowner, Location: ".
          GetField("SELECT location_id
										FROM product_stock 
										WHERE Product_ID  = '$int_productid' 
											  AND
											  owner_id = '$int_prodowner'"));
      SetProductHistory($int_productid, "CategoryID", $prodcategory);
      SetProductHistory($int_productid, "store_serial_yn", $bl_store_serial);
      SetProductHistory($int_productid, "purchase_price_foreign", $prodcostforeign);
      SetProductHistory($int_productid, "currency", $prodcurrency);
      SetProductHistory($int_productid, "Purchase_price_home", $prodcosthome);
      SetProductHistory($int_productid, "extra_cost", $prod_extra_cost);
      SetProductHistory($int_productid, "Margin_correction", $prodmargin);
      SetProductHistory($int_productid, "Selling_price", $prod1);
      SetProductHistory($int_productid, "Selling_price_10", $prod10);
      SetProductHistory($int_productid, "Selling_price_50", $prod50);
      SetProductHistory($int_productid, "Selling_price_100", $prod100);
      SetProductHistory($int_productid, "Retail_price_ex", $prodRRP);
      SetProductHistory($int_productid, "Reorder_q", $minorderquanty);
      SetProductHistory($int_productid, "public", $prod_public);
      SetProductHistory($int_productid, "special", $prod_special);


      if (strlen($sql_product) > 30) //check if the sql string was filled
      {
        $updateproduct_sql = "UPDATE ". $sql_product . "WHERE ProductID = $int_productid";

        if (!$updateproduct_query = $db_iwex->query($updateproduct_sql)) echo "Update productDetails failed";
      }
      //update product location
      $updateproduct_query = $db_iwex->query($updateproduct_sql);
      $db_iwex->query("UPDATE product_stock
							 SET location_id = '$prodloc'
							 WHERE Product_ID = $int_productid
								   AND owner_id = '$int_prodowner'");
    }

    if ($bl_update_stock)  // if a productid is given and update stock has been pressed
    {
      update_all_stock($int_productid, $int_prodowner);
    }
    if ($update_product_prices) // when updating with de price update button
    {
      UpdateAllPrices($int_productid);
    }

    // get product from tabel current_product_list
    $actual_stock = get_stock($int_productid, $int_prodowner);

    // get product from tabel current_product_list
    $productmain_sql = "SELECT *, SUM(product_stock.stock) AS sumStock
          FROM current_product_list
          LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '$int_prodowner'
          LEFT JOIN location ON product_stock.location_id = location.ID
          WHERE ProductID = '$int_productid'
          GROUP BY owner_id";

    $productdetail_query = $db_iwex->query($productmain_sql);

    if (edit_button()) {
      $edit_this = FALSE;
    } else {
      $edit_this = " DISABLED ";
    }

    if ($obj = mysql_fetch_object($productdetail_query)) {
      $returnvar =  "    <TABLE BORDER=\"0\" CELLPADDING=\"1\" WIDTH=\"100%\" CELLSPACING=\"0\" class=\"blockbody\">\n";
      $returnvar .=  "        <TR>\n<TH ALIGN='left'>" . edit_button("waccess_v", $formname) . "
                                    <INPUT TYPE=\"submit\" NAME=\"update_stock\" CLASS=\"form\" value=\"update stock\">";
      if ($waccess_v) {
        $returnvar .= " <INPUT $edit_this TYPE=\"submit\" NAME=\"update_product_prices\" CLASS=\"form\" value=\"update prices\"
					   onClick=\"return confirm('Weet u zeker dat u de prijzen van dit artikel wilt updaten?')\">";
      }
      $returnvar .= "</TH><TH COLSPAN='3'>Product Parameters</TH></TR>\n";

      //hide extra info with a javascript
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Leadtime: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"prodleadtime\" CLASS=\"form\" value=\"$obj->LeadTime\"></TD>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Cost at origin: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"prodcostforeign\" CLASS=\"form\" value=\"$obj->purchase_price_foreign\"></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Reorderlevel: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodreorderlevel\" CLASS=\"form\" value=\"$obj->ReorderLevel\"></TD>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Currency: </TD><TD>".makelistbox('SELECT ValutaID, ValutaName FROM valuta ORDER by ValutaName',
          'prodcurrency',
          'ValutaID',
          'ValutaName',
          $obj->currency,
          '','',
          $edit_this)."</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Last / free / calculated Stock: </TD><TD>";

      // When there are product for other customers show the selection box.
      if (OtherProductOwner($obj->ProductID)) {
        $returnvar .=  preg_replace ("/<select name/", "<select OnChange=\"location.replace('".$_SERVER['PHP_SELF']."?productid=$obj->ProductID&product_ownerid='+product_ownerid.value)\" name",
            makelistbox("SELECT owner_id, SUBSTRING(CONCAT_WS(', ', stock, CompanyName), 1, 20) AS stockowner
												 FROM product_stock
												 INNER JOIN contacts ON owner_id = ContactID
												 WHERE Product_ID = '$obj->ProductID'
												 ORDER BY stock",
            'product_ownerid',
            'owner_id',
            'stockowner',
            $int_prodowner,
            '',
            ''));
      } else {
        $returnvar .= $obj->stock;
      }
      $returnvar .=  " / ".getfreestock($obj->ProductID,
          0,
          $int_prodowner)." / $actual_stock</TD>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Cost at warehouse: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodcosthome\" CLASS=\"form\" value=\"$obj->Purchase_price_home\">+";
      $returnvar .=  "				    <input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"prod_extra_cost\" CLASS=\"form\" value=\"$obj->extra_cost\">\n";
      $returnvar .=  " = ". ToDutchNumber(GetProductCost($int_productid, 1));
      $returnvar .=  "         </TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >BTW percentage: </TD><TD>" .
                                          makelistbox('SELECT Btw_class,BTWpercentage FROM btwtabel;',
                                          'prodbtwclass',
                                          'Btw_class',
                                          'BTWpercentage',
                                          $obj->Btw_class,
                                          '','',
                                          $edit_this, false, false);
      $returnvar .=  "             <TD ALIGN=\"right\" >Margin Correction: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodmargin\" CLASS=\"form\" value=\"$obj->Margin_correction\"></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\">SKU: </TD><TD $edit_this>".makelistbox('SELECT value,text FROM listbox WHERE category=4;',
          'prodsku',
          'value',
          'text',
          $obj->sku,
          '','',
          $edit_this)."</TD>\n";
      $returnvar .=  "             <TD\" ></TD><TD></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR".MakeProductState_rowcolor($obj->Discontinued_yn, $obj->stock, $obj->Pricelist_yn).">\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Pricelist: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodonhand\" CLASS=\"form\" value=\"$obj->Pricelist_yn\"></TD>\n";
      $returnvar .=  "             <TD></TD><TD></TD>\n";
      $returnvar .=  "         <TR".MakeProductState_rowcolor($obj->Discontinued_yn, $obj->stock, $obj->Pricelist_yn).">\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Discontinued: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"proddiscontinued\" CLASS=\"form\" value=\"$obj->Discontinued_yn\"></TD>\n";
      $returnvar .=  "             <TD></TD><TD></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Weight: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodweightcorr\" CLASS=\"form\" value=\"$obj->weight_corr\"> kg</TD>\n";
      $returnvar .=  "             <TD></TD><TD></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Locatie: </TD>";
      $returnvar .=  "			 <TD>".makelistbox('SELECT ID, location FROM location ORDER BY CAST(location AS DECIMAL)','prodloc','ID','location',
          $obj->location_id,
          '','',
          $edit_this)."</td>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >RRP: </TD><TD><input $edit_this ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodRRP\" CLASS=\"form\" value=\"$obj->Retail_price_ex\"></TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\" >Category: </TD><TD>".
          makelistbox('SELECT IF(cat2.CategoryID,
																   cat2.CategoryID,
															       categories.CategoryID) AS CategoryID, CONCAT_WS("->",
																	  categories.CategoryName,
																	  cat2.CategoryName) AS CategoryName
														 FROM categories 
														 LEFT JOIN categories cat2 ON categories.CategoryID = cat2.ParentID
														ORDER by CategoryName',
          'prodcategory',
          'CategoryID',
          'CategoryName',
          $obj->CategoryID,
          '','',
          $edit_this)."</TD>\n";

      $returnvar .=  "             <TD ALIGN=\"right\" >Public:</TD><TD>".MakeCheckbox('prod_public',$obj->public,edit_button())."</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "		<TR>
										<TD ALIGN=\"right\" >Min order quanty: </TD>
										<TD><input $edit_this ALIGN='right' type='text' SIZE='5'  NAME='min_order_quanty' CLASS='form' value='$obj->Reorder_q'></TD>";
      $returnvar .=  "			<TD ALIGN=\"right\">Special:</TD><TD>".MakeCheckbox('prod_special',$obj->special,edit_button())."</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         <TR>\n";
      $returnvar .=  "             <TD ALIGN=\"right\">Serial num.:</TD><TD>".MakeCheckbox('store_serial',$obj->store_serial_yn,edit_button())."</TD>\n";
      $returnvar .=  "         </TR>\n";
      $returnvar .=  "         </table>";
    }
  }
  return $returnvar;
}

/**
 * Function     : ShowExtraInfo
 * show several parameters of the product.
 * Input        :  $bl_update : upadet or not
 $int_productid: duh....
 $formname : name of the calling form
 * Returns      : formatted string if it worked, otherwise ''
 **/

function ShowExtraInfo($bl_update, 
    $int_productid,
    $formname) {
  $returnvar='';

  if ($int_productid) {
    global $db_iwex;
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
        isset($_POST["extra_prod_info_update"])) {
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

    if ($bl_update) {
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

      //EXTRA PRODUCT INFO update
      if($bl_update) {
        if($int_productid && $int_best_syst_id && $int_proc_type) {
        //if exists product id: update
          if(check_extra_info($productid)) {
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
    }

    // get product from tabel current_product_list
    $sql_extra_info = "SELECT *
            FROM current_product_list
            INNER JOIN extra_product_info ON current_product_list.ProductID = extra_product_info.ProductID
            WHERE extra_product_info.ProductID = '$int_productid';";
    $query_extra_info = mysql_query($sql_extra_info) or die("Ongeldige select extra info query: " .$sql_extra_info. "<BR>" .mysql_error());
    $obj_extra_info = mysql_fetch_object($query_extra_info);

    //get rights
    $saccess_s = $GLOBALS['saccess_s'];
    $supervisor = $GLOBALS['supervisor'];

    echo("<table border='0' width='100%' cellspacing='2' class=\"blockbody\" cellpadding='1'>");
    echo "     <TR><TH COLSPAN=\"2\">" . edit_button("waccess_v", $formname) . " Extra product info</TH></TR>\n";
    echo "     <TR><TD COLSPAN=\"2\"><CENTER><H2>$bericht</CENTER></H2><BR></TD></TR>\n"; //insert a break
    //create a text field to add a new value to the listbox
    if (edit_button()) {
      if ($listbox_cat) {
        echo "<TR><TD COLSPAN=\"2\">Geef de nieuwe waarde voor de text box: <INPUT TYPE=\"text\" NAME=\"new_value_listbox\" CLASS=\"form\" SIZE=\"30\">\n";
        echo "<INPUT TYPE=\"submit\" NAME=\"add_value\" CLASS=\"form\" value=\"Toevoegen\">\n";
        echo "<INPUT TYPE=\"hidden\" NAME=\"add_listbox_cat\" value=\"$listbox_cat\">\n";
        echo "</TD></TR>\n";
        echo "<TR><TD COLSPAN=\"2\"><BR></TD></TR>\n"; //insert a break
      }
      //add new listbox
      if ($add_value) {
        echo "<TR><TD COLSPAN=\"2\">\n";
        echo add_listbox_cat($add_listbox_cat, $new_value_listbox);
        echo "</TD></TR>\n";
        echo "<TR><TD COLSPAN=\"2\"><BR></TD></TR>\n"; //insert a break
      }

      echo "         <TR>\n";
      echo "             <TD WIDTH=\"25%\">Besturingssysteem: </TD>
                               <TD>".makelistbox('SELECT value,text FROM listbox WHERE category='.DB_LISTBOX_BEST_SYST.';','best_syst_id','value','text',$obj_extra_info->Best_syst_ID)."";
      if($saccess_s || $supervisor) {
      //rechten ==> sales -> setup
        echo "         <A HREF=".$_SERVER["PHP_SELF"]."?productid=$int_productid&listbox_cat=".DB_LISTBOX_BEST_SYST.">Add value ...</A></TD>\n";
      }
      echo "         </TR>\n";
      echo "         <TR>\n";
      echo "             <TD>Processor type: </TD>
                               <TD>".makelistbox('SELECT value,text FROM listbox WHERE category='.DB_LISTBOX_PROCESSOR.';','proc_type','value','text',$obj_extra_info->Processor_type)."";
      if($saccess_s || $supervisor) {
        echo "         <A HREF=".$_SERVER["PHP_SELF"]."?productid=$int_productid&listbox_cat=".DB_LISTBOX_PROCESSOR.">Add value ...</A></TD>\n";
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
                                   <input type=\"text\" SIZE=\"4\"  NAME=\"afm_y\" CLASS=\"
								   \" value=\"$obj_extra_info->AfmetingY\">x\n
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
      if($saccess_s || $supervisor) {
        echo  "        <A HREF=".$_SERVER["PHP_SELF"]."?productid=$int_productid&listbox_cat=".DB_LISTBOX_ACCU.">Add value ...</A></TD>\n";
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
      if(check_extra_info($int_productid)) {
        echo "<INPUT TYPE=\"hidden\" NAME=\"extra_prod_info_update\" value=\"\">\n";
        echo "<INPUT TYPE=\"button\" value=\"Update extra info\" onclick='document.productmaintform.extra_prod_info_update.value=\"TRUE\";document.productmaintform.submit();'>\n";
        if($saccess_s || $supervisor) {
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
    }
  }
}

Function ShowExtraText($bl_update, 
    $int_productid,
    $formname) {
  $returnvar='';

  if ($int_productid) {
    global $db_iwex;

    $bericht = "";
    $extra_prod_text_update = "";

    //get extra text  from tabel extra_product_text
    $sql_extra_text = "SELECT text, ProductID FROM extra_product_text WHERE ProductID = '$int_productid';";
    $query_extra_text = mysql_query($sql_extra_text) or die("Ongeldige select extra info query: " .$sql_extra_text. "<BR>" .mysql_error());
    if($obj_extra_text = mysql_fetch_object($query_extra_text)) {

      $str_text = $obj_extra_text->text;
      $str_exist = true;

    } else {
      $str_text = "";
      $str_exist = false;
    }
    if (edit_button()) {
      $edit_this = FALSE;
    } else {
      $edit_this = " DISABLED ";
    }

    //Set or update product id
    if($bl_update and !$edit_this) {

      $extra_text = isset($_POST["extra_text"]) ?  $_POST["extra_text"] : FALSE;
      $extra_text_exist = isset($_POST["extra_text_exist"]) ?  $_POST["extra_text_exist"] : FALSE;

      if($str_exist) {
        $query = "UPDATE extra_product_text SET text = '$extra_text' WHERE Productid = '$int_productid' ";
        $str_text = $extra_text;
      } else {
        $str_text = $extra_text;
        $query = " INSERT INTO extra_product_text(ProductID, text) VALUES('$int_productid', '$extra_text') ";
      }
      mysql_query($query) or die (mysql_error());
      $bericht = '<LI>Het formulier is geupdate.';
    }

    //get rights
    $saccess_s = $GLOBALS['saccess_s'];
    $supervisor = $GLOBALS['supervisor'];

    //create the form
    echo"<table border='0' width='100%' cellspacing='2' class=\"blockbody\" cellpadding='1'>";
    echo "     <TR><TH COLSPAN=\"2\">" . edit_button("waccess_v", $formname) . " Extra product Text</TH></TR>\n";
    echo "     <TR><TD COLSPAN=\"2\"><CENTER>$bericht</CENTER><BR></TD></TR>\n"; //insert a break

    $str_returnvar = "	<TR>
							<TD>Extra Text:</TD>
							<TD><textarea $edit_this NAME=\"extra_text\" rows=\"5\" cols=\"40\" CLASS=\"form\">$str_text</textarea></TD>
							</TR>
							<INPUT TYPE=\"hidden\" NAME=\"extra_text_exist\" value='$str_exist'>\n
							<INPUT TYPE=\"hidden\" NAME=\"extra_text_update\" value=''>\n
							</TABLE>";
  }
  return $str_returnvar;
}


/**
 * Function     : ShowProductImage
 * show the images of the product
 * Input        :  $int_productid: duh....
 * Returns      : formatted string if it worked, otherwise ''
 **/

function ShowProductImage($int_productid) {
  $returnvar = '';

  $js_upload_img = "onclick=\"window.open('" . upload_popup . "?Filename=$int_productid','upload popup','toolbar=0,menubar=0,resizable=0,scrollbars=0,status=0,width=400,height=200,left=60,top=25')\"";

  if ($int_productid) {
    echo ShowImage($int_productid);
    echo "<INPUT TYPE=\"button\" NAME=\"image\" VALUE='Image' $js_upload_img>";
  }
  return $returnvar;
}

/**
 * Function     : Copy_product
 * Copy a product to a new number
 * Input        : $int_productid: duh....
 * Returns      : true if it worked
 **/

function Copy_product($int_productid) {
  if ($int_productid) {
    global $db_iwex;

    $str_fields = " merkID, Merk, ProductName, Productdescription, ExternalID, euproductcode,
            Taric, Supplier, LeadTime, purchase_price_foreign, ReorderLevel,
            Purchase_price_home, extra_cost, Margin_correction, Selling_price, Btw_class,
            Selling_price_10, sku, Selling_price_50, Pricelist_yn, Selling_price_100,
            Discontinued_yn, Retail_price_ex, weight_corr, currency, CategoryID, 
            store_serial_yn, public ";

    $insertproduct_sql = "INSERT INTO current_product_list (" .
        $str_fields . ") (SELECT " . $str_fields . " FROM current_product_list
                              WHERE ProductID='$int_productid');";

    $isertproduct_query = $db_iwex->query($insertproduct_sql);

    $last_productid =  $db_iwex->query('SELECT distinct LAST_INSERT_ID() FROM current_product_list');
    $productobj = mysql_fetch_array($last_productid,MYSQL_BOTH);
    $last_productid = $int_productid;
    $new_productid = $productobj[0];

    //mysql_free_result($last_productid);

    $db_iwex->query("INSERT INTO product_stock SET Product_ID = '$new_productid'");

    $db_iwex->query("INSERT INTO multi_articles2 (aantal, Product_ids, Multi_ID)
            (SELECT aantal, Product_ids, '$new_productid' FROM multi_articles2 WHERE Multi_ID = '$last_productid')");
  }
  return $new_productid;
}


/**
 * Function     : Create_product
 * Copy a product to a new number
 * Input        :  none....
 * Returns      : true if it worked
 **/
function Create_Product() {
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
}

/**
 * Function     : Show_Sold
 * Shows on which orders the product has been sold
 * Input        : $int_ContactID: duh....
 *		  $bl_all: backorders or all, default only backorders
 *		  $int_ProductID
 * Returns      : formatted string or false
 **/

function Show_Sold($int_ProductID, $int_ContactID = FALSE) {

  global $db_iwex;

  $retrunvar = FALSE;
  $_GLOBAL["str_backdir"] = '../';

  $bl_all = isset($_POST["sold"]) ? TRUE : FALSE;
  $bl_all = isset($_POST["open"]) ? FALSE : $bl_all;
  $ary_ship_addresses = isset($_POST["ary_addressid"]) ? $_POST["ary_addressid"] : FALSE;

  if($ary_ship_addresses && isset($_POST["new_shipment"])) {
    foreach ($ary_ship_addresses AS $int_addressID => $str_value) {
      if (!check_open_shipment($int_addressID)) {
        $db_iwex->query("INSERT INTO shipments
    	    				 SET Start_date = NULL, Ship_date = NULL, AdressID = '" .$int_addressID. "'");
      }
    }
  }

  $button_value_text = "NAME='sold' VALUE='ook reeds geleverd'";

  if ($int_ProductID) {
    $open_orderdet_sql = SQL_openorderdetails. "
			WHERE ";
    if ($bl_all) {
      $button_value_text = "NAME='open' VALUE='Alleen openstaand'";
      if ($int_ContactID)  $open_orderdet_sql .= " (orders.Confirmed_yn = '1' OR orders.Confirmed_yn = '-1') AND contacts.ContactID = " . $int_ContactID . " AND";
    } else {
      $open_orderdet_sql .= " to_deliver > '0' AND " . openordedetails_condition . "AND";
    }
    $open_orderdet_sql .= "
			order_details.ProductID= '$int_ProductID' 
			ORDER BY TO_DAYS(orders.Orderdate) DESC;"; 

    $returnvar =  "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
    $returnvar .=  "<tr><td colspan=4><INPUT TYPE=submit $button_value_text> AAN (KlantID)
				<INPUT TYPE=text NAME='ContactID'>".GetRecordId(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "ContactID", "sold_to_form.ContactID",null,"0.6")."
				<INPUT TYPE=hidden NAME='ProductID' VALUE=".$int_ProductID.">
				</td></tr>";

    $openorderdetails_query = mysql_query($open_orderdet_sql)
        or die("Ongeldige openorderdetails query: " .$open_orderdet_sql. mysql_error());
    if (mysql_num_rows($openorderdetails_query)) {
      $returnvar .=  "<tr><th>OrderID</th><th>Order datum</th><th>Klant</th><th>Aflever adres</th><th>Besteld</th><th>Open</th><th>-</th></tr>";
      while ($obj_opendet = mysql_fetch_array($openorderdetails_query)) {
        $returnvar .=  "<tr><td align=\"center\" class=\"cellline\" WIDTH='8%'><A HREF='" . orders . "?orderID=".$obj_opendet["OrderID"]."'> ".$obj_opendet["OrderID"]."</A></td>\n";
        $returnvar .=  "<td align=\"center\" class=\"cellline\">".$obj_opendet["OrderDate"]."</td>\n";
        $returnvar .=  "<td class=\"cellline\">".$obj_opendet["CompanyName"]."</td>\n"; // ->current_product_list.Productname
        $returnvar .=  "<td class=\"cellline\">".$obj_opendet["Shipname"]."</td>\n";
        $returnvar .=  "<td align=\"center\" class=\"cellline\">". $obj_opendet["Quantity"]."</td>\n"; // order_details.Quantity
        $obj_opendet["to_deliver"] = $obj_opendet["to_deliver"] ? $obj_opendet["to_deliver"]  : '-';
        $returnvar .=  "<td align=\"center\" class=\"cellline\"><b>". $obj_opendet["to_deliver"]."</b></td>\n"; // order_details.Quantity
        $int_adresid = Getfield("SELECT orders.ShipID
										 FROM orders 
										 WHERE administration_order=0 AND orders.OrderID =" .$obj_opendet["OrderID"]);
        if (!check_open_shipment($obj_opendet["ShipID"])) {
          $returnvar .=  "<td align=\"center\" class=\"cellline\"><b>".
              MakeCheckbox("ary_addressid[$int_adresid]", FALSE) ."</b>
									</td>";
        } else {
          $returnvar .=  "<td align=\"center\" class=\"cellline\"><b></b></td>";
        }
        $returnvar .=  "</TR>\n";
      }
    } else {
      $returnvar .=  "Geen openstaande orders op dit artikel!";
    }
    mysql_free_result($openorderdetails_query);
    $returnvar .= "<TR><TD><INPUT TYPE='submit' NAME='new_shipment' VALUE='Leveren'></TD></TR>";
    $returnvar .=  "</TABLE>\n";
    $returnvar .=  "</FORM>\n";
  }
  return $returnvar;
}

/**
 * Function     : Show_Purchased
 * Shows on which Purchase orders the product has been or is being bought
 * Input        :  $int_ProductID
 * Returns      : formatted string or false
 **/

function Show_Purchased($int_ProductID) {
  global $db_iwex;
  $_GLOBAL["str_backdir"] = '../';

  $returnvar = FALSE;

  $bl_all = isset($_POST["done"]) ? TRUE : FALSE;
  $bl_all = isset($_POST["open"]) ? FALSE : $bl_all;

  // Check which which records page need to be displayed.
  $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;

  if ($bl_next  || $bl_priv) {
    if ($bl_next) {
      $startrec += LIMITSIZE;
    } else if ($bl_priv) {
        $startrec -= LIMITSIZE;
      }
  } else {
    $startrec = 0;
  }

  $button_value_text = "NAME='done' VALUE='ook reeds geleverd'";

  if ($int_ProductID) {
  // Get data
    $sql = "SELECT PurchaseOrderID, CompanyName, ContactID, OrderDate, status, PO_sent
				FROM purchase_orders 
				INNER JOIN po_details ON purchase_orders.PurchaseOrderID = po_details.poID   
				INNER JOIN current_product_list ON po_details.productID = current_product_list.ProductID
				LEFT JOIN contacts ON purchase_orders.SupplierID = contacts.ContactID
				WHERE po_details.productID = '$int_ProductID'
				ORDER BY PurchaseOrderID DESC";

    $query = $db_iwex->query($sql);
    $numberofrecords = mysql_Numrows($query);
    mysql_free_result($query);

    $sql .= ' LIMIT ' . $startrec . ',' . LIMITSIZE;
    $query = $db_iwex->query($sql);

    $returnvar = "   <TABLE><TR>\n";
    $returnvar .= '	<TD COLSPAN="3" >';
    $returnvar .= "<table border=0><tr>\n"
        ."<td bgcolor=".OPENORDER_BGCOLOR.">Sent</td>"
        ."<td bgcolor=".PARTSHIP_BGCOLOR.">Deellevering</td>"
        ."<td bgcolor=".COMPLETE_BGCOLOR.">Compleet</td>\n</tr></table>";

    $pagetotal = $numberofrecords/LIMITSIZE +1;
    $pagenum =($numberofrecords/LIMITSIZE - $startrec/LIMITSIZE) +1;
    $returnvar .= 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
    $returnvar .= ' van '. (int)$pagetotal;

    if ($numberofrecords > LIMITSIZE) {
      if ($numberofrecords-LIMITSIZE> $startrec) {
        $returnvar .= '		<INPUT TYPE="submit" NAME="next" value="<" CLASS="button">';
      }
      if ($startrec > 0)
        $returnvar .= '		<INPUT TYPE="submit" NAME="priv" value=">" CLASS="button">';
      $returnvar .= '		<INPUT TYPE="hidden" NAME="startrec" value="'.$startrec.'">';
    }
    $returnvar .= "    </TD><TD ALIGN='right'><INPUT TYPE=\"submit\" NAME=\"Update\" VALUE=\"Zoeken\" CLASS=\"button\">\n";
    $returnvar .= "    <INPUT TYPE=\"button\" NAME=\"new\" onClick=\"location.replace('purchase_maint.php?new=1');\" VALUE=\"Nieuw\">\n";
    $returnvar .= "</TD>\n";
    $returnvar .= "    </TR>\n";
    $returnvar .= "</TABLE>\n";
    $returnvar .= '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">
			<tr>
			   <th>supplier</th>
			   <th>PO ID</th>
			   <th>Order aangemaakt</th>
			   <th>Order verzonden</th>
			</tr>';
    while ($obj = mysql_fetch_object($query)) {
      $po_state = ($obj->status);
      if ($po_state==1) {
        $bgcolor=OPENORDER_BGCOLOR;
      } else if ($po_state==2) {
          $bgcolor=PARTSHIP_BGCOLOR;
        } else if ($po_state==3) {
            $bgcolor=COMPLETE_BGCOLOR;
          } else if (!$po_state) {
              $bgcolor=QOUTE_BGCOLOR;
            } else {
              $bgcolor='#FFFFFF';
            }
      $returnvar .= '<tr>';
      $returnvar .= '<td BGCOLOR='.$bgcolor.'>'.$obj->CompanyName.'</td>';
      $returnvar .= '<td BGCOLOR='.$bgcolor.'><a href='.purchase_maint.'?purchaseorderID='.$obj->PurchaseOrderID.'>'.$obj->PurchaseOrderID.'</a></td>';
      $returnvar .= '<td BGCOLOR='.$bgcolor.'>';
      if ($obj->OrderDate) {
        $returnvar .= date(DATEFORMAT_SHORT, strtotime($obj->OrderDate)).'</td>';
      } else {
        $returnvar .= '</td>';
      }
      $returnvar .= '<td BGCOLOR='.$bgcolor.'>';
      if ($obj->PO_sent) {
        $returnvar .= date(DATEFORMAT_SHORT, strtotime($obj->PO_sent)).'</td>';
      } else {
        $returnvar .= '</td>';
      }
      $returnvar .= '</tr>';
    }

    mysql_free_result($query);

    $returnvar .= "</TABLE>\n";
  }
  return $returnvar;
}

/**
 * Function     : Show_Multi
 * Shows first which articles are included in this article (if any) and also in which soft bundels or mulitarticles this product is used
 * Input        : $int_ProductID:...Duh
 * Returns      : formatted string or false
 **/

function Show_Multi($int_ProductID, 
    $bl_update,
    $formname) {
  global $db_iwex;

  // get the input from the fields
  $multiaantalnew = isset($_POST["multiaantalnew"]) ?  $_POST["multiaantalnew"] : FALSE;
  $multiproductidnew = isset($_POST["multiproductidnew"]) ?  $_POST["multiproductidnew"] : FALSE;

  $retrunvar = FALSE;
  if ($int_ProductID) {
    if ($bl_update)   // If user has submitted changes
    {
      if ($multiaantalnew&&$multiproductidnew) { //When new detail records have been added, insert these first
        $insertqry = 'INSERT INTO multi_articles2 set Multi_ID = "'.$int_ProductID.'", Aantal='.$multiaantalnew.', product_ids="'.$multiproductidnew.'" ';
        $querynew = $db_iwex->query($insertqry)
            or die('insert van de multi articles niet gelukt: ' .$insertqry.' error:'. mysql_error());
      }

      $productmulti_sql = MULTI_ARTICLE_SQL."'$int_ProductID';";

      $multi_result = $db_iwex->query($productmulti_sql)
          or die("Ongeldige multi article query: " .$$productmulti_sql. mysql_error());
      while ($objmulti_result = mysql_fetch_object($multi_result)) {
      // update records when there are diferences with last pass
      // but ignore the new line
        if (isset($_POST["multiaantal".$objmulti_result->Multi_productID])||isset($_POST["multiproductid".$objmulti_result->Multi_productID])) {
        // Check if the record should be deleted.
          if (!$_POST["multiaantal".$objmulti_result->Multi_productID]) {
            $qry = 'DELETE FROM multi_articles2 WHERE Multi_productID='.$objmulti_result->Multi_productID;
            $queryres = $db_iwex->query($qry)
                or die("Verwijderen van RMA acties '$obj->ActionID' niet gelukt: " .$qry." error:". mysql_error());
          } else {
            $qry = 'UPDATE multi_articles2 set Aantal="'.$_POST["multiaantal".$objmulti_result->Multi_productID].'"'
                .',Product_ids= "'.$_POST["multiproductid".$objmulti_result->Multi_productID].'"'
                .' WHERE Multi_productID='.$objmulti_result->Multi_productID;
            $queryres = $db_iwex->query($qry)
                or die("update van de RMA acties niet gelukt: order " .$qry." error:". mysql_error());

          }
        }
      }
      mysql_free_result($multi_result);
    }
    // get multi article parts
    $productmulti_sql = MULTI_ARTICLE_SQL . $int_ProductID ;

    $productmulti_query = $db_iwex->query($productmulti_sql)
        or die("Ongeldige select details query: " .$productmulti_sql. mysql_error());
    $returnvar =  "         <TABLE BORDER=\"0\" WIDTH=\"100%\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    $returnvar .=  "         <TR>\n";
    $returnvar .=  "             <TH COLSPAN=\"7\" >Heeft de volgende onderdelen:</TH>\n";
    $returnvar .=  "         </TR>\n";
    $returnvar .=  "         <TR>\n";
    $returnvar .=  "             <TH>#</TH><TH>Article ID</TH><TH>Articlename</TH><TH>Stock</TH><TH>Vrij</TH><th>Cost</th><th>Image</th>\n";
    $returnvar .=  "         </TR>\n";
    // always display new record for adding
    $returnvar .=  "          <TR><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"1\" NAME=\"multiaantalnew\" CLASS=\"form\" ></TD>
                           <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"multiproductidnew\" CLASS=\"form\" 
                           onFocus=\"if ($formname.multiaantalnew.value!=1) $formname.multiaantalnew.value='1'\">"
        .GetRecordId(SQL_SEARCH_PRODUCTS_LIST, "ID", 'multiproductidnew', "$formname.multiproductidnew").
        "</TD><TD></TD><td></td></TR>\n";

    $flt_productcost = 0;
    $flt_weight 	 = 0;
    $flt_retailprice = 0;
    if (mysql_num_rows($productmulti_query)) {
      while ($objmulti = mysql_fetch_object($productmulti_query)) {
        $returnvar .=  "<TR>\n";
        $returnvar .=  "    <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"1\" NAME=\"multiaantal".$objmulti->Multi_productID."\" CLASS=\"form\" value=\"$objmulti->aantal\"></TD>
                                    <TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\" NAME=\"multiproductid".$objmulti->Multi_productID."\" CLASS=\"form\" value=\"$objmulti->Product_ids\"></TD><TD>$objmulti->ProductName</TD>
                                    <TD align=\"right\"><a ".ShowOnMouseOverText("details van dit artikel") ." href='".$_SERVER['PHP_SELF']."?productid=$objmulti->Product_ids' target='_new'>".get_stock($objmulti->Product_ids)."</a></td>
                                    <TD align=\"right\"><A ".ShowOnMouseOverText("(Openstaande) verkooporders") ." href='".products_sold."?ProductID=$objmulti->Product_ids' target='_new'>".getfreestock($objmulti->Product_ids)."</a></td>
                                    <td align=\"right\">".ToDutchNumber(GetProductCost($objmulti->Product_ids, $objmulti->aantal))."</td>
                                    <td>".ShowImage($objmulti->Product_ids,30)."</td>\n";
        $returnvar .=  "</TR>\n";
        $flt_productcost += GetProductCost($objmulti->Product_ids, $objmulti->aantal) * $objmulti->aantal;
        $flt_weight += $objmulti->aantal * $objmulti->weight_corr;
        $flt_retailprice += $objmulti->aantal * $objmulti->Retail_price_ex;
      }
      mysql_free_result($productmulti_query);
    } else {
      $returnvar .=  "<TR><TD COLSPAN='6' ALIGN='center'>Geen data</TD></TR>\n";
    }
    // print the cost of the bundle
    $flt_productcost = sprintf("%.2f", $flt_productcost);
    $flt_price_home = GetField("SELECT Purchase_price_home FROM current_product_list WHERE ProductID = $int_ProductID");
    $bgcolor = $flt_price_home < $flt_productcost ? NOT_PAID_OVERDUE_BGCOLOR : '';

    $returnvar .=  "<TR BGCOLOR='$bgcolor'><TD COLSPAN='3' ALIGN=right>Warehouse cost = <b>&euro; $flt_price_home</b></td>
                        <TD COLSPAN='4' ALIGN=right>Total product cost = <b>&euro; $flt_productcost</b>, $flt_weight kg, RRP &euro; "
        .ToDutchNumber($flt_retailprice)."</TD></TR>";
    $returnvar .=  "</table>";

    $returnvar .= "<BR>";
    //start printing the parent articles
    $parents_sql = "SELECT Multi_ID, ProductName
            FROM multi_articles2
            LEFT JOIN current_product_list ON current_product_list.ProductID = multi_articles2.Multi_ID
            WHERE multi_articles2.Product_ids = '$int_ProductID'";

    $returnvar .=  "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\" class=\"blockbody\">\n";
    $returnvar .=  "<tr><th COLSPAN='3'>Onderdeel van:</th></tr>";
    $parent_query = $db_iwex->query($parents_sql);
    if (mysql_num_rows($parent_query)) {
      $returnvar .=  "<tr><th>ProductID</th><th>Product Naam</th><th>Vrij</th><th>Image</th></tr>";
      while ($obj_opendet = mysql_fetch_object($parent_query)) {
        $returnvar .=  "<tr>\n";
        $returnvar .= "<td><a target='_new' href='". PRODUCT_MAINT . "?productid=$obj_opendet->Multi_ID'>$obj_opendet->Multi_ID</a></td>\n";
        $returnvar .= "<td>$obj_opendet->ProductName</td>\n";
        $returnvar .= "<td>".getfreestock($obj_opendet->Multi_ID)."</td>\n";
        $returnvar .= "<td>" . ShowImage($obj_opendet->Multi_ID,30) . "</td>\n";
        $returnvar .=  "</TR>\n";
      }
      mysql_free_result($parent_query);
    } else {
      $returnvar .=  "<TR>\n<TD COLSPAN='3'>Dit artikel is nergens onderdeel van</TD>\n</TR>\n";
    }
    $returnvar .=  "</TABLE>\n";
  }
  return $returnvar;
}

/*********************************************************
 * Function     : print_inventory_transactions
 * print a table with all inventory transactions for the given product
 * Input        : ProductID: The id of the product.
 * Returns      : true
 *********************************************************/
Function print_inventory_transactions($int_ProductID) {   // get inventory_transactions
// Check which which records page need to be displayed.	
  $next = isset($_POST['next']) ;
  $priv = isset($_POST['priv']) ;

  $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;

  if (($next||$priv)&&$int_ProductID) {
    if ($next) {
      $startrec -= LIMITSIZE;
    } else if ($priv) {
        $startrec += LIMITSIZE;
      }
  }
  //echo "s:$startrec, n:$next, p:$priv";

  $transaction_sql = 'select transactiondate, TransactionDescription, Description, inventory_transactions.OrderID,
    inventory_transactions.orderdetailsID, inventory_transactions.shipmentID, inventory_transactions.PurchaseOrderID, 
    UnitsOrdered, Backorder, UnitsReceived, UnitsSold, UnitsShrinkage, RMAID, inventory_transactions.stock_owner_id,
	FirstName
    FROM inventory_transactions
    LEFT JOIN order_details ON inventory_transactions.orderdetailsID = order_details.OrderDetailsID 
        AND NOT (order_details.RMA_actionID=0 OR order_details.RMA_actionID IS NULL)
    LEFT JOIN RMA_actions on order_details.RMA_actionID = RMA_actions.actionID
	LEFT JOIN employees ON EmployeeID = inventory_transactions.employee
    WHERE inventory_transactions.ProductID = '.$int_ProductID.'
    ORDER BY transactiondate DESC';

  $transaction_result = mysql_query($transaction_sql)
      or die("Ongeldige transaction query (dag transacties): " .$transaction_sql. mysql_error());
  $numberofrecords = mysql_Numrows($transaction_result);
  $sql = $transaction_sql . ' LIMIT ' . $startrec . ',' . LIMITSIZE;
  //        echo $sql;
  $transaction_result = mysql_query($sql)
      or die("Ongeldige transaction query (dag transacties): " .$transaction_sql. mysql_error());

  echo "Product ID : $int_ProductID<br>";
  // print todays transactions
  echo '<TABLE WIDTH="100%" BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody">'."\n";
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

  echo '<TR valign="top">'."\n";
  echo '<th>Date</th>
        <th>Employee</th>
		<th>Description</th>
        <th>OrderID</th>
        <th>OrderDetailID</th>
        <th>Shipment</th>
        <th>PO ID</th>
        <th>Received</th>
        <th>Sold</th>
        <th>Shrinkage</th>
        <th>RMA ID</th>
        <th>Order</th>
        <th>BO</th>
        <th>Owner</th>';
  echo '</TR>'."\n";
  While ($obj = mysql_fetch_object($transaction_result)) {
    echo '<TR valign="top">'."\n";
    echo '    <td>'.date("d-M-y",strtotime($obj->transactiondate)).'</td>';
    echo '    <td>'.$obj->FirstName.'</td>';
    echo '    <td>'.$obj->TransactionDescription.'</td>';
    echo '    <td>'. ($obj->OrderID ? '<A TARGET=new HREF="'.orders.'?orderID='.$obj->OrderID.'">'.$obj->OrderID.'</A>':'-') .'</td>';
    echo '    <td>'.$obj->orderdetailsID.'</td>';
    echo '    <td>'. ($obj->shipmentID ? '<A TARGET=new  HREF="'.shipment.'?shipmentID='.$obj->shipmentID.'">'.$obj->shipmentID.'</A>' : '-') .'</td>';
    echo '    <td>'.($obj->PurchaseOrderID ? "<a target=_new href='".purchase_maint."?purchaseorderID=$obj->PurchaseOrderID'>$obj->PurchaseOrderID</a>": "-").'</td>';
    echo '    <td>'.$obj->UnitsReceived.'</td>';
    echo '    <td>'.$obj->UnitsSold.'</td>';
    echo '    <td>'.$obj->UnitsShrinkage.'</td>';
    echo '    <td>'.($obj->RMAID ? '<A TARGET=new HREF="'.rma.'?rmaid='.$obj->RMAID.'">'.$obj->RMAID.'</a>' : '-') . '</td>';
    echo '    <td>'.$obj->UnitsOrdered.'</td>';
    echo '    <td>'.$obj->Backorder.'</td>';
    echo "    <td><a href='".contacts."?custid=$obj->stock_owner_id' "
        .ShowShortContactInfo($obj->stock_owner_id)
        ."target=_new>$obj->stock_owner_id</a></td>\n";
    echo '</TR>'."\n";
  }
  echo '</table>'."\n";

  return TRUE;
}

?>
