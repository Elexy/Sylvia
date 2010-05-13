<?
/* 
*  This include file contains all the filenames of the project.
* Please keep them per directory, on alfabetical order.
*/
//general File stuff
define('docroot','http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$GLOBALS["ary_config"]['http_docroot']);
define('img_root',$_SERVER['DOCUMENT_ROOT'].'/images/products/'); // the default directory where images can be found
define('IMAGES_URL', '/images/');
define('PRODUCTS_IMAGES_URL', IMAGES_URL.'products/');
define ("production",$GLOBALS["ary_config"]['server_url']);

define("FILE_XEOPORT", $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/xeoport/index.php');

// root
Define ("backorder" , docroot . "/backorder.php");
Define ("orders" , docroot . "/order.php");
Define ("ORDERS" , docroot . "/order.php");
Define ("purchase_maint" , docroot . "/purchase_maint.php");
Define ("rma" , docroot . "/rma.php");
Define ("shipment" , docroot . "/shipment.php");
Define ("upload_popup" , docroot . "/includes/upload_popup.php");
Define ("SHOW_INVOICE", docroot . "/invoice_payment.php");
Define ("FILE_INBOX", docroot . "/inbox.php");
Define ("ORDERCOMFIRM", docroot . "/orderbevesting.php");

//contacts
Define ("contact_functions" , docroot . "/contacts/contact_functions.php");
Define ("contacts" , docroot . "/contacts/maintain.php");
Define ("CONTACTS" , docroot . "/contacts/maintain.php");

//products
Define ("product_functions" , docroot . "/products/product_functions.php");
Define ("PRODUCT_MAINT" , docroot . "/products/product_maint.php");
Define ("product_sel" , docroot . "/products/product_sel.php");
Define ("PRODUCT_SEL" , docroot . "/products/product_sel.php");
Define ("products_sold" , docroot . "/products/products_sold.php");
Define ("CATALOG" , docroot . "/products/catalogus.php");
Define ("CATALOGADD" , docroot . "/products/catalogusadd.php");

//financial
Define ("INVOICE_PAYMENT_EMAIL" , docroot . "/invoice_payment_email.php");
Define ("BANK_TRANS_TO_INVOICE" , docroot . "/bank_trans_to_invoice.php");
Define ("INVOICE_PAYMENT" , docroot . "/invoice_payment.php");

//Mailing
Define ("SEND_SELECTED_MAILING" , docroot . "/includes/sendmailing.php");
Define ("MAILING" , docroot . "/prijslijstmail.php");


?>