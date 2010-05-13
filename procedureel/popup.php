<?php
 /*
 * transactions.php
 *
 * @version $Id: popup.php,v 1.9 2006-03-28 06:56:09 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");
include ("products/product_functions.php");

$int_productID = GetSetFormVar("ProductID",TRUE,FALSE,'popup_parm');
$int_Parameter1 = GetSetFormVar("Parameter1",TRUE,FALSE,'popup_parm');

// Print default Iwex HTML header.
printheader ("popup");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"popup\">\n";
// Used for overlib.
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

if ($int_productID) {
    $_SESSION["popup_function"]($int_productID);
} else {
    $_SESSION["popup_function"]($_SESSION["popup_parm"]);
}

echo "</FORM>\n";

printenddoc();

?>
