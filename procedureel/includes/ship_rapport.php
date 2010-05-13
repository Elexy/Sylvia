<?php
/**
 *
 *
 * @version $Id: ship_rapport.php,v 1.1 2006-12-06 08:27:51 iwan Exp $
 * @copyright $date:
 **/
$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';
include 'ship_label_functions.php';

$str_shipper = isset($_GET["shipper"]) ? $_GET["shipper"] : "";
$date = isset($_GET["date"]) ? $_GET["date"] : date("Y-m-d");

	// Print default Iwex HTML header.
	printheader (COMPANYNAME . " shipment report screen", "shipment list", TRUE);
	
    echo "<body ".get_bgcolor()." onLoad=\"print();close()\">\n"; //Print page and close

	echo "<img src='" . IMAGES_URL . LOGOSMALL . "' width=75 alt='" . COMPANYNAME . "logo' border=0><H2>Shipment report of $date</H2><p>";

	echo MakeDayReport($date,
					   $str_shipper);

	echo "</p><p>Picked up by (Name):</p><p>&nbsp;</p><p>&nbsp;</p><p>Signature:</p>";
	
	printenddoc();

?>
