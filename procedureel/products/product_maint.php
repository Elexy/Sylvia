<?
 
$_GLOBAL["str_backdir"] = '../';

global $db_iwex;

include ($_GLOBAL["str_backdir"]."include.php");
include 'product_functions.php';

// get nutton input from form
$bl_update = isset($_POST["update_var"]) ? $_POST["update_var"] : FALSE;
$bl_update = isset($_POST["Update"]) ? TRUE : $bl_update;
$bl_copy_products = isset($_POST["copy_product"]) ? TRUE : FALSE;

$productid = isset($_POST["productid"]) ? $_POST["productid"] : FALSE;
$productid = isset($_GET["productid"]) && !isset($_POST["productid"]) ? $_GET["productid"] :  $productid;
$productid = $productid > 1000 ? $productid : FALSE;
$productid_new = GetSetFormVar("productid_new",TRUE);

$new_product = isset($_POST["new_product"]) ?  $_POST["new_product"] : FALSE;
$int_prodowner = isset($_REQUEST["product_ownerid"]) ?  $_REQUEST["product_ownerid"] : OWN_COMPANYID;

//Tab variabeles
$str_type_main = GetSetFormVar("maintype",True,'general','maintype');
$str_last_main = GetSetFormVar("lastmain",True);
$str_type_sub = GetSetFormVar("subtype",True,FALSE,'subtype');

if ($str_last_main !== $str_type_main) $str_type_sub = '';

if ($productid_new 
    && 
    ($productid_new !== $productid)) {
    $productid = $productid_new;
	$str_type_main = 'general';	
	$str_type_sub = false;
    $bl_update = FALSE;
}

$flt_extra_cost = isset($_POST['prod_extra_cost']) ? $_POST['prod_extra_cost'] : 0;

//main tabs
$tabs_main = array('general;Basisgegevens','sales;Verkoop','purchase;Inkoop','stock;Voorraad');
// sub tabs
$tabs_general= array('base;Basis','parm;Specificaties','extra;Extra Specs','extratext;Extra Text', 'multi;Combinations','image;Foto','relations;Relaties');
$tabs_sales= array('orders;Orders','pricing;Prijzen','ship;Leveringen','stat;Statistiek');
$tabs_purchase= array('po;Inkooporders','pricingpu;Prijzen','hist;Historie','stat;Statistiek');
$tabs_stock = array('transactions;Transacties');

$Iframe_Width = '100%';
$Iframe_Height = '420';

$formname = 'product_maint';

if ($str_type_main == '') $str_type_main = FALSE;

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
    echo "<SCRIPT>alert('New product = ".copy_product($productid)."')</SCRIPT>";
}


// Print default Iwex HTML header.
printheader (COMPANYNAME . " Producten Onderhoud", 'PRODmaint', TRUE);

echo "<BODY ".get_bgcolor().">";
echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>";
echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
echo include_javascript();

printIwexNav();

if ($productid)  // if a productid is given 
{
    //$actual_stock = get_stock($productid, $int_prodowner);

    // get product from tabel current_product_list
    $productmain_sql = "SELECT *, SUM(product_stock.stock) AS sumStock
      FROM current_product_list
      LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID 
      LEFT JOIN location ON product_stock.location_id = location.ID
      WHERE ProductID = '$productid'
      GROUP BY owner_id";
    $productdetail_query = $db_iwex->query($productmain_sql);
    $obj = mysql_fetch_object($productdetail_query);
    
    echo "<INPUT TYPE='hidden' NAME='maintype' VALUE='$str_type_main'>";
    echo "<INPUT TYPE='hidden' NAME='subtype' VALUE='$str_type_sub'>";
    echo "<INPUT TYPE=\"hidden\" NAME=\"update_var\" VALUE=\"0\">";
    echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\">\n";
    echo "    <TR>\n";
    echo "    <TH>$obj->ProductID of Nieuw ProductID: <input type=\"text\"  SIZE='7' NAME=\"productid_new\" CLASS=\"form\" value=''>
				<input type=\"hidden\"  SIZE='7' NAME=\"productid\" CLASS=\"form\" value=\"$obj->ProductID\"></TH>
              <TH>".$obj->ProductName."</TH>";
    echo "        <TH><INPUT TYPE=\"submit\" NAME=\"Update\" CLASS=\"button\" value=\"Update\">";
    echo "		<INPUT TYPE='hidden' NAME='lastmain' VALUE='$str_type_main'>\n";
	echo "      <INPUT TYPE=\"button\" NAME=\"productlist\" CLASS='button' 
			onClick=\"location.replace('product_sel.php');\" VALUE=\"Return\">\n";
    if ($GLOBALS['waccess_v']) {
        echo "<INPUT TYPE=\"submit\" NAME=\"copy_product\" CLASS=\"button\" value=\"Copy\"
               onClick=\"return confirm('Dit artikel Kopieren?')\">\n";
        echo "<INPUT TYPE=\"submit\" NAME=\"new_product\" CLASS=\"button\" value=\"Nieuw\"
               onClick=\"return confirm('Echt een nieuw artikel aanmaken?')\">\n";
    }
    echo "</TH>\n";
    				
    echo "    </TR>\n";
    echo "</TABLE>\n";
    
    echo tab($tabs_main,$str_type_main,"$formname",'maintype'); // main tabs
	// main tab general
    If ($str_type_main == 'general' || !$str_type_main) { 
        echo tab($tabs_general,$str_type_sub,"$formname",'subtype'); //General tabs
		if ($str_type_sub == 'base' || !$str_type_sub) {
            echo "<TR>\n" . ShowProductDetails($bl_update, $productid, $formname) . "</TR>\n";
        } else if ($str_type_sub == 'parm') {
            echo "</TR>\n" . ShowProductParms($bl_update, $productid, $formname, $int_prodowner) . "</TR>\n";
        } else if ($str_type_sub == 'extra') {
            echo "</TR>\n" . ShowExtraInfo($bl_update, $productid, $formname, $int_prodowner) . "</TR>\n";
		} else if ($str_type_sub == 'extratext') {
			echo "</TR>\n" . ShowExtraText($bl_update, $productid, $formname, $int_prodowner) . "</TR>\n";
		} else if ($str_type_sub == 'image') {
            echo ShowProductImage($productid);
        } else if ($str_type_sub == 'multi') {
            echo Show_Multi($productid, $bl_update,$formname);
        } else if ($str_type_sub == 'relations') {
            echo iframe("product_association.php?productid=$productid",'relations',$Iframe_Width,$Iframe_Height); 
        }
    } else If ($str_type_main == 'sales') { 
		echo tab($tabs_sales,$str_type_sub,"$formname",'subtype'); //General tabs
		if ($str_type_sub == 'orders' || !$str_type_sub) {
            echo "<TR>\n" . Show_Sold($productid) . "</TR>\n";
		} else if ($str_type_sub == 'pricing' || !$str_type_sub) {
            echo  pricing_sales(0, 
                          $productid, 
                          $bl_update, 
                          $formname
                          );
        } elseif ($str_type_sub == 'stat' || !$str_type_sub) {
            echo ShowSellThrough($formname, NULL, NULL, NULL,$productid);
		}
	} else If ($str_type_main == 'purchase') { 
		echo tab($tabs_purchase,$str_type_sub,"$formname",'subtype'); //General tabs
		if ($str_type_sub == 'po' || !$str_type_sub) {
            echo "<TR>\n" . Show_Purchased($productid) . "</TR>\n";
		} else if ($str_type_sub == 'pricingpu' || !$str_type_sub) {
            echo  pricing_purchasing(0, 
                          $productid, 
                          $bl_update, 
                          $formname
                          );
        }
	} else If ($str_type_main == 'stock') { 
		echo tab($tabs_stock,$str_type_sub,"$formname",'subtype'); //General tabs
		if ($str_type_sub == 'transactions' || !$str_type_sub) {
            echo "<TR>\n" . print_inventory_transactions($productid) . "</TR>\n";
		}
	}
    echo "     </TD>\n";
    echo "     </TR>\n";
   echo "</table>";    
} else {
    echo "Product ID <input type=\"text\" NAME=\"productid_new\" CLASS=\"form\" SIZE=\"6\"> naam ".GetRecordIdInputField(SQL_SEARCH_PRODUCTS_LIST, "ID", "productnamesearch", "productmaintform.productid", "product", 20). "\n<br>";
    echo "<input type=\"submit\" NAME=\"zoek\" CLASS=\"form\" value=\"show\">\n";
}
echo "</FORM>\n";

// Show Product history
echo  "<table border=0 width=50%>\n<tr><td>Product history</td></tr>\n";	
echo  "<tr><td>".PrintProductsHistory($productid)."</td></tr>\n</table>\n";

printenddoc();
?>
