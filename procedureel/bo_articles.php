<?php
 /*
 * bo_articles.php
 *
 * @version $Id: bo_articles.php,v 1.15 2006-07-04 14:28:30 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
$int_contactID = isset($_GET["contactID"]) ? $_GET["contactID"] : FALSE;
$bl_submit = isset($_POST["submit"]) ? TRUE : FALSE;

$open_articles_sql = "SELECT
    order_details.ProductID, sum(to_deliver) as to_deliver, CompanyName, product_stock.stock, last_exp, exp_rating, merk, 
	sum(Quantity) as Quantity, current_product_list.ProductName, count(order_details.OrderID) as OrderIDs, ExternalID   
    FROM order_details
	INNER JOIN current_product_list ON current_product_list.ProductID = order_details.ProductID
	INNER JOIN orders ON orders.orderID = order_details.OrderID
	INNER JOIN contacts ON contacts.ContactID = orders.ContactID
	LEFT JOIN product_stock ON current_product_list.ProductID = product_stock.Product_ID
	WHERE to_deliver > 0 AND " . openordedetails_condition;
if ($int_contactID) {
	$open_articles_sql .= "AND ContactID = '$int_contactID' ";
//	while ($obj_openarticle = mysql_fetch_array($open_articles_query)) {
//
//	}
//	mysql_free_result($open_articles_query);
}
$open_articles_sql .= " GROUP BY order_details.ProductID
							ORDER BY merk, order_details.ProductID;";

// Print default Iwex HTML header.
printheader (COMPANYNAME . " Openstaande Artikelen -> klanten", "print");

if ($bl_submit) { //when user has pressed submit, update the database
    $open_articles_result = mysql_query($open_articles_sql)
     	or die("Ongeldige open articles query: " .$open_articles_sql. mysql_error());	
    while ($obj_openarticle = mysql_fetch_object($open_articles_result)) {
    	if ($_POST["last_exp".$obj_openarticle->ProductID] != $_POST["prev_last_exp".$obj_openarticle->ProductID]||
			$_POST["exp_rating".$obj_openarticle->ProductID] != $_POST["prev_exp_rating".$obj_openarticle->ProductID]) {
			if (!$_POST["last_exp".$obj_openarticle->ProductID]) {
				$_POST["last_exp".$obj_openarticle->ProductID] = date("Y-m-d");
			}
			$upd_product_sql = "UPDATE current_product_list SET last_exp = '".$_POST['last_exp'.$obj_openarticle->ProductID]."',
				exp_rating = '".$_POST["exp_rating$obj_openarticle->ProductID"]."'
				WHERE ProductID = $obj_openarticle->ProductID;";
			//echo "wordt:".$_POST["last_exp".$obj_openarticle->ProductID];
			//echo "was:".$_POST["prev_last_exp".$obj_openarticle->ProductID].'<BR>';
			$query_upd_product = mysql_query($upd_product_sql)
				or die ("Ongeldige update product query: " .$upd_product_sql. mysql_error());
		}
        if (isset($_POST["product$obj_openarticle->ProductID"]) && $_POST["product$obj_openarticle->ProductID"]) {
            OrderProduct($obj_openarticle->ProductID, 
                         $_POST["product$obj_openarticle->ProductID"]);
        }
	}
}

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"bo_articlesform\">\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";

$open_articles_query = mysql_query($open_articles_sql)
 	or die("Ongeldige open articles query: " .$open_articles_sql. mysql_error());

// first print a nice filtering table
echo "<tr>\n";
echo '<TH colspan="11">selecteren</TH>'."\n";
echo "</TR>\n";
echo "<tr>\n";
echo '<td class="cellline" colspan="2" align="left"><small>'.mysql_num_rows($open_articles_query).' Artikelen</small></TD>'."\n";
echo '<td class="cellline" colspan="8" align="right"><INPUT TYPE="submit" NAME="submit" CLASS="form" value="submit"></TD>'."\n";
echo "</TR>\n";

// table header
echo "<tr><th>ID</th><th>External</th><th>Merk</th><th>Naam</th><th>besteld</th><th>uitleveren</th><th>stock</th>";
echo "<th>Bestel</th><th>Verwacht</th><th>%</th></tr>\n";
while ($obj_openarticle = mysql_fetch_array($open_articles_query)) {
    if ($int_contactID) {
		echo "<tr><th colspan='3' align=\"center\"><b>".$obj_openarticle["CompanyName"]."</b></th>\n";
	}
    printpo_bo($obj_openarticle['ProductID'],&$on_order);
	echo "<TR>\n";
	echo "<td align=\"center\" class=\"cellline\"><A HREF='". PRODUCT_MAINT . "?productid=".$obj_openarticle['ProductID']."' target=_new>".$obj_openarticle["ProductID"]."</A></td>\n"; // ->current_product_list.productID
    echo "<td class=\"cellline\">".$obj_openarticle["ExternalID"]."</td>\n"; // ->current_product_list.merk
	echo "<td class=\"cellline\">".$obj_openarticle["merk"]."</td>\n"; // ->current_product_list.merk
	echo "<td class=\"cellline\" width=350>".$obj_openarticle["ProductName"]."</td>\n"; // ->current_product_list.Productname
    echo "<td align=\"right\" class=\"cellline\">". $obj_openarticle["Quantity"]."</td>\n"; // order_details.Quantity
//    echo "<td align=\"right\" class=\"cellline\">". $obj_openarticle["OrderIDs"]."</td>\n"; // order_details.Quantity
	echo "<td align=\"right\" class=\"cellline\"><b><a href='javascript:void()' onclick= \"window.open('products_sold.php?ProductID=".$obj_openarticle["ProductID"]."','Producten verkocht','toolbar=0,menubar=0,scrollbars=1,resizable=1,dependent=0,status=0,width=800,height=500,left=25,top=25')\">"
         .$obj_openarticle["to_deliver"]."</a></b></td>\n"; // order_details.Quantity
	echo "<td align=\"right\" class=\"cellline\">". $obj_openarticle["stock"]."</td>\n"; // order_details.Quantity
	echo "<td align=\"right\" class=\"cellline\">".$on_order
        ."<input type=text align=right size=2 name='product"
        .$obj_openarticle["ProductID"]
        ."'></td>\n"; // order_details.Quantity
	echo "<td WIDTH='100' align=\"center\" class=\"cellline\"><input type=\"hidden\" name=\"prev_last_exp".$obj_openarticle["ProductID"]."\" value='". $obj_openarticle["last_exp"]."'>\n"; // ->productID
	$obj_openarticle["stock"] > 0 ? $obj_openarticle["last_exp"] = date("Y-m-d") : $obj_openarticle["last_exp"];
	echo "<INPUT TYPE='text' SIZE='8' NAME='last_exp".$obj_openarticle["ProductID"]."' VALUE='".$obj_openarticle["last_exp"]."'>".Add_Calendar('bo_articlesform.last_exp'.$obj_openarticle["ProductID"].'')."</TD>\n";
    echo "<td align=\"center\" class=\"cellline\"><input name=\"prev_exp_rating".$obj_openarticle["ProductID"]."\" type=\"hidden\" value=\"".$obj_openarticle["exp_rating"]."\">\n"; // ->current_product_list.productID
	echo makelistbox('SELECT value, text FROM listbox WHERE category = 3','exp_rating'.$obj_openarticle["ProductID"],'value','text',$obj_openarticle["exp_rating"])."</td>\n";
	echo "</TR>\n";
}
mysql_free_result($open_articles_query);


echo "</TABLE>\n";
echo "</FORM>\n";

printenddoc();

?>
