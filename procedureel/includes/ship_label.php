<?php
/**
 *
 *
 * @version $Id: ship_label.php,v 1.5 2005-01-12 11:27:58 iwan Exp $
 * @copyright $date:
 **/
$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';
include 'ship_label_functions.php';

$int_shipment_id = isset($_GET["levering"]) ? $_GET["levering"] : FALSE;

MakeGLSlabel($int_shipment_id);

?>
