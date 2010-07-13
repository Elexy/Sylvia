<?php
$_GLOBAL["str_backdir"] = '../';

include ("../include.php");
// get nutton input from form
$bl_submit = isset($_POST["submit"]) ? TRUE : FALSE;
$productid = isset($_POST["productid"]) ? $_POST["productid"] : FALSE;
$productid = isset($_GET["productid"]) && !isset($_POST["productid"]) ? $_GET["productid"] :  $productid;
$productid = isset($_POST["productidnew"]) && $_POST["productidnew"] && isset($_POST["zoek"]) ? $_POST["productidnew"] : $productid;
$productid = $productid > 1000 ? $productid : FALSE;
$new_product = isset($_POST["new_product"]) ?  $_POST["new_product"] : FALSE;
//initialize and get all the formdata
$prodean = isset($_POST["prodean"]) ?  $_POST["prodean"] : FALSE;
$prodsku = isset($_POST["prodsku"]) ?  $_POST["prodsku"] : FALSE;
$prodsupplier = isset($_POST["prodsupplier"]) ?  $_POST["prodsupplier"] : FALSE;
$proddiscontinued = isset($_POST["proddiscontinued"]) ?  $_POST["proddiscontinued"] : FALSE;
$prodweightcorr = isset($_POST["prodweightcorr"]) ?  $_POST["prodweightcorr"] : FALSE;
$prodloc = isset($_POST["prodloc"]) ?  $_POST["prodloc"] : FALSE;
$prodlocid = isset($_POST["prodlocid"]) ?  $_POST["prodlocid"] : FALSE;
$bl_update_stock = isset($_GET["update_stock"]);


// end of main form variables now the optional Multiarticle form vars
$multiaantalnew = isset($_POST["multiaantalnew"]) ?  $_POST["multiaantalnew"] : FALSE;
$multiproductidnew = isset($_POST["multiproductidnew"]) ?  $_POST["multiproductidnew"] : FALSE;

// Print default Iwex HTML header.
printheader (COMPANYNAME . " Producten Onderhoud", 'maint', FALSE);

echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"productmaintform\">\n";

// Set EAN to null if null or copy of product.
$prodean = ($prodean == '' || !$prodean) ? 'NULL' : "'".$prodean."'";

// Get product loc. ID when it is set.
if ($prodlocid) {
    $prodloc = GetField("SELECT ID FROM location WHERE ID = '$prodlocid' OR location = '$prodlocid'");
}

$sql_product = "current_product_list SET
    EAN = $prodean,
    sku = '$prodsku',
    weight_corr = '$prodweightcorr'";

if ($bl_update_stock&&$productid)  // if a productid is given but submit is not pressed
{
    update_all_stock($productid);
}

// if new button has been pressed in main screen do not run query
if ($productid&&$bl_submit)   // If user has submitted changes
{
    // get product from tabel current_product_list
    $updateproduct_sql = "UPDATE ". $sql_product . "WHERE ProductID = $productid";
    $updateproduct_query = $db_iwex->query($updateproduct_sql);
    $db_iwex->query("UPDATE product_stock
                     SET location_id = '$prodloc'
                     WHERE Product_ID = $productid");
}
    
if ($productid)  // if a productid is given 
{
    $actual_stock = get_stock($productid);
    // get product from tabel current_product_list
    $productmain_sql = "SELECT ProductID, EAN, sku, weight_corr, location_id, 
      ProductName, ProductName, stock, CompanyName, Discontinued_yn, Purchase_price_home
      FROM current_product_list
      LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID AND owner_id = '".OWN_COMPANYID."'
      LEFT JOIN location ON location_ID = ID
      LEFT JOIN contacts ON Supplier = ContactID
      WHERE productid = '$productid' OR EAN = '$productid'";
    $productdetail_query = mysql_query($productmain_sql)
       or die("Ongeldige select details query: " .$productmain_sql. mysql_error());
    $obj = mysql_fetch_object($productdetail_query);

    echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "    <TR>\n";
    echo "         <TH colspan=2>";
    echo "<input type=\"hidden\"  NAME=\"productid\" CLASS=\"form\" value=\"$obj->ProductID\">Product ID $obj->ProductID</TH>\n";
    echo "    </TR>\n";
    echo "    <TR>\n";
    echo "             <TD ALIGN=\"right\" >Naam: </TD><TD>$obj->ProductName</TD>\n";
    echo "         </TR>\n";
    echo "    <TR>\n";
    echo "             <TD ALIGN=\"right\" >EAN code: </TD><TD><input type=\"text\" SIZE=\"15\"  NAME=\"prodean\" CLASS=\"form\" value=\"$obj->EAN\"></TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Supplier: </TD><TD>$obj->CompanyName</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Last Stock (calc): </TD><TD><A href='"
            .$_SERVER['PHP_SELF']."?productid=$obj->ProductID&update_stock=1'>"
            .($obj->stock ? "$obj->stock" : "Set")
            ."</a>"
            ." ($actual_stock) "
            .($obj->Discontinued_yn ? "EOL" : "<a href='stock_mut.php?ProductID=$obj->ProductID'>Corr</a>")
            ."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >SKU: </TD><TD>"
                      .makelistbox('SELECT value,text FROM listbox WHERE category=4;','prodsku','value','text',$obj->sku)
                      ."</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Weight: </TD><TD><input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodweightcorr\" CLASS=\"form\" value=\"$obj->weight_corr\"> kg (&euro; $obj->Purchase_price_home)</TD>\n";
    echo "         </TR>\n";
    echo "         <TR>\n";
    echo "             <TD ALIGN=\"right\" >Locatie: </TD>";
        echo "<TD>".makelistbox('SELECT ID, location FROM location','prodloc','ID','location',$obj->location_id)
        ."<input ALIGN=\"right\" type=\"text\" SIZE=\"5\"  NAME=\"prodlocid\" CLASS=\"form\" value=\"\"></td>\n"; 
    echo "         </TR>\n";
    echo "         </table>";
    echo "     </TD>\n";
    echo "     </TR>\n";
    echo "     <TR>\n";
    echo "          <TD colspan='2' ALIGN=\"right\">\n";
    echo "          <input type=\"submit\" NAME=\"submit\" CLASS=\"form\" value=\"Update\">\n";
//    echo "<a href=\"".$_SERVER['PHP_SELF']."\">Terug</a>";
    if ($obj->sku<>1) {
        echo "          <input type=\"button\" NAME=\"make_multi\" onClick=\"location.replace('../multiarticles.php?ProductID=$obj->ProductID');\" value=\"Maken\">\n";
    }
//    echo "          <input type=\"submit\" NAME=\"update_all_prices\" CLASS=\"form\" value=\"update all prices\">\n";
    echo "          <input type=\"hidden\" NAME=\"calc_stock\" CLASS=\"form\" value=\"".$actual_stock."\"></TD>\n";
    echo "     </TR>\n";
    echo "</table>";
} 
    echo "Product ID <input type=\"text\" NAME=\"productidnew\" CLASS=\"form\" SIZE=\"6\" value=\"\">";
    echo "<input type=\"submit\" NAME=\"zoek\" CLASS=\"form\" value=\"show\">\n";
    echo '<script TYPE="text/javascript" language="JavaScript">document.productmaintform.productidnew.focus();</script>';

echo "</FORM>\n";
printenddoc();
?>
