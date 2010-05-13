<?php
 /*
 * shipment.php
 *
 * @version $Id: backorder.php,v 1.3 2006-07-04 14:28:30 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

// Get all the URL variable we need.
$int_ContactID = isset($_GET["ContactID"]) ? $_GET["ContactID"] : FALSE;

// Print default Iwex HTML header.
printheader (COMPANYNAME . " Backorders", "print");

echo "<BODY><FORM METHOD=\"get\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"backorderform\">\n";

if ($int_ContactID) {
   echo printbackorderlist($int_ContactID);
}
echo "</FORM>\n";

printenddoc();

?>
