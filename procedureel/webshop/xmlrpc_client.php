<?

$_GLOBAL["str_backdir"] = '../';
include $_GLOBAL["str_backdir"].'include.php';
include($_GLOBAL["str_backdir"] . "lib/xmlrpc.inc");
include($_GLOBAL["str_backdir"] . "lib/xmlrpcs.inc");
include($_GLOBAL["str_backdir"] . "lib/xmlrpc_wrappers.inc");


//set the local db
$DB_iwex = new DB();
$formname = "getweborders";

// Print default Iwex HTML header.
printheader (COMPANYNAME . " orders ophalen van de webshop","n.v.t.", TRUE);

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"$formname\">\n";
echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>";
    
printIwexNav();


//here, find out which order was the last one
$ary_branches = GetBranches($GLOBALS["ary_config"]["webshop_contactID1"], TRUE);
$contact_condition = " (ContactID = ". implode(" OR ContactID = ", $ary_branches).")";
$sql_contact_condition = "SELECT 
								max(CAST(ContactsOrderID AS UNSIGNED)) 
							   FROM orders 
							   WHERE $contact_condition;";
$int_lastshoporder = GetField($sql_contact_condition);
//echo "<p>last ordernumber: " . $int_lastshoporder . "</P>";


//set the message
//$m = new xmlrpcmsg('get_saleorders', array(new xmlrpcval($int_lastshoporder, "int")));
//$c = new xmlrpc_client("/erp-synchro.php", "hpserver", 80);
//$m = new xmlrpcmsg('get_saleorders', array(new xmlrpcval($int_lastshoporder, "int")));
//$c = new xmlrpc_client("/shop2/help/erp-synchro.php", "192.168.0.5", 80);
$m = new xmlrpcmsg('get_saleorders', array(new xmlrpcval($int_lastshoporder, "int")));
$c = new xmlrpc_client("/help/erp-synchro.php", "www.shop2.nl", 80);
$r = $c->send($m);
if (!$r->faultCode()) {	
	//convert the response to values
	$v = $r->value();
	// decode the values into a PHP array
	$ary_orders = php_xmlrpc_decode($v);   
	//print "<PRE>"; 
	//print_r($ary_orders);
	//print "</PRE>\n";
	foreach($ary_orders as $order_id => $order ) { //run through the array
		//first create the add_order class
		$cls_orderdet = new OrderInfo();
		foreach($order as $key => $value) {			
			$cls_orderdet->int_Main_ContactID = $GLOBALS["ary_config"]["webshop_contactID1"];
			if ($key == "id") { //orderid from the webshop
				$cls_orderdet->str_ContactsOrderID = $value;
			} else if ($key == "note") {//order notes
				// no method yet to add order notes: maybe something like:
				//$cls_orderdet->str_Comments = $value;
			} else if ($key == "shippingcost") {//shipment costs
				// get shipping cost from weborder
				$cls_orderdet->fl_shippingcost = $value;
			} else if ($key == "delivery") { //delivery address
				foreach ($value as $field => $field_content) {
					switch($field) {
						case "name":
							$cls_orderdet->str_ShipName = $field_content;
							$cls_orderdet->str_ShipContactPerson = $field_content;
							break;
						case "address":
							$cls_orderdet->str_Shipaddress = $field_content;
							break;
						case "city":
							$cls_orderdet->str_ShipCity = $field_content;
							break;
						case "country":
							$cls_orderdet->str_ShipCountry = $field_content;
							break;
						case "country":
							$cls_orderdet->str_ShipCountry = $field_content;
							break;							
						case "zip":
							$cls_orderdet->str_ShipPostalCode = $field_content;
							break;
						case "esale_id":
							$cls_orderdet->str_ShipOtherID = $field_content;
							break;
					}
				}
			} else if ($key == "billing") {	//billing address
				foreach ($value as $field => $field_content) {
					switch($field) {
						case "name":
							$cls_orderdet->str_BillName = $field_content;
							$cls_orderdet->str_BillContactPerson = $field_content;
							break;
						case "address":
							$cls_orderdet->str_Billaddress = $field_content;
							break;
						case "city":
							$cls_orderdet->str_BillCity = $field_content;
							break;
						case "country":
							$cls_orderdet->str_BillCountry = $field_content;
							break;
						case "country":
							$cls_orderdet->str_BillCountry = $field_content;
							break;							
						case "zip":
							$cls_orderdet->str_BillPostalCode = $field_content;
							break;
						case "esale_id":
							$cls_orderdet->str_BillOtherID = $field_content;
							break;
					}
				}	
			}
		}
	//	echo $cls_orderdet->printvars();
		$int_order_id = $cls_orderdet->AddOrder();
		echo "<BR>orderid " . $int_order_id . " " . $cls_orderdet->str_ContactsOrderID;
		foreach($order as $key => $value) {			
			if ($int_order_id
				&&
				$key == "lines") { //order details
				// now loop through the lines
				foreach ($value as $line => $ary_fields) {
					foreach ($ary_fields as $field => $value) {
						switch($field) {
							case "product_id":
								$int_product = $value/123;
								break;
							case "product_qty":
								$int_qoata = $value;
								break;
							case "price":
								$fl_price = $value;
								break;
						}													
					}
					if (!$cls_orderdet->AddProduct($int_product, $int_qoata, $fl_price)) {
						//echo "<br>Product '$int_product' niet $int_qoata x toegevoegd aan order $cls_orderdet->str_ContactsOrderID.\n";
					}
				}
			}
		}						
	}
} else {
	print "Fault <BR>";
	print "Code: " . htmlentities($r->faultCode()) . "<BR>Reason: '" . htmlentities($r->faultString()) . "'<BR>";
}  
?>