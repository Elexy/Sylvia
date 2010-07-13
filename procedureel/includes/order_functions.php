<?php
/*
 * order_fuctions.php
 *
 * @version $Id: order_functions.php,v 1.3 2007-07-11 11:51:12 alex Exp $
 * @copyright $date:
 **/


/**
 * Function     : GetOpenOrder
 * Find or when not find make open sales order.
 * Input        : $int_contactid, the id of the contact.
 *				: $str_orderref, customer order referrance.
 *				: $bl_create, true when there should be one created when there is none.
 *				: $int_shipid, the id where the product should be send. 0 for default;
 * Returns      : The order number. 
 **/
Function GetOpenOrder($int_contactid, 
					$str_orderref,
					$bl_create = FALSE,
					$int_shipid = 0,
					$fl_shippingcost = FALSE)
{
	$int_shipid  = $int_shipid ? $int_shipid : GetDefaultShipAdresId($int_contactid);

	if ($fl_shippingcost) {
		$added_cost = " Transportcosts='$fl_shippingcost', 
						manual_transportcosts = '1', 
						Ordercosts = '0', 
						manual_ordercosts = '1', ";
	} else {
		$added_cost = '';
	}
    // When there is no order number insert one.
    if ($bl_create) {
        $sql_insert_ord =  "INSERT orders set ContactID='$int_contactid', "
                          ."ShipID='$int_shipid', "
                          ."OrderDate=".insertDate(date("Y-m-d H:i")).", "
                          ."Price_Level='".GetPriceLevel($int_contactid)."', "
                          ."paymentterm_yn='".GetPaymentTermID($int_contactid)."', "
						  ."ContactsOrderID = '$str_orderref',"
						  ."ShipName = '".GetField("SELECT Naam FROM Adressen WHERE AdresID=$int_shipid")."',"
						  ."Shipaddress = '".GetField("SELECT CONCAT_WS(' ', straat, huisnummer) AS adres FROM Adressen WHERE AdresID=$int_shipid")."',"
						  ."ShipCity = '".GetField("SELECT plaats FROM Adressen WHERE AdresID=$int_shipid")."',"
						  ."ShipPostalCode = '".GetField("SELECT postcode FROM Adressen WHERE AdresID=$int_shipid")."',"
						  ."ShipCountry = '".GetField("SELECT land FROM Adressen WHERE AdresID=$int_shipid")."',"						  
						  .$added_cost
						  ."Btw_YN='1'";
		$sql_insert_ord . "<br><br>";
        $query = mysql_query($sql_insert_ord)
           or die("Invalid create order sql: " . mysql_error());
        $int_order_num = mysql_insert_id();
    }

    return $int_order_num; 
} 

/**
 * Function     : CheckOpenOrderDetails
 * Checks of the openorder has orderdetails
 * Input        : order ID
 * Returns      : true of false. 
 **/
Function CheckOpenOrderDetails($int_order_id)
{
    $qry = "SELECT * FROM order_details WHERE OrderID='$int_order_id'";
    $result = mysql_query($qry) or die("Check open orderdetails failed");
    $num_rows = mysql_num_rows($result);
    if($num_rows) {
        return TRUE;
    }else {
        return FALSE;
    }
}

/**
 * Function     : SetOrderConfirmed
 * Set the type of order confirmation.
 * Input        : $int_order_id, the id of the order.
 *				: $int_confirmed, the confirmation type;
 * Returns      : None. 
 **/
function SetOrderConfirmed($int_order_id, $int_confirmed) {
	$sql_bevestigd = "UPDATE orders SET confirmed_yn = '$int_confirmed' "
			  .", OrderDate=".insertDate(date("Y-m-d H:i"))
			  ." WHERE orders.OrderID =" . $int_order_id;
	$qry_bevestigd = mysql_query($sql_bevestigd)
			 or die("Ongeldige update bevestigd query: 6");			  
}

/**
 * Function     : GetShipAdres
 * Find or when not find make a new ship adres.
 * Input        : $int_contactid, the id of the contact.
 *				: $str_name, Company name
 *				: $str_contact, Contact person to send to
 *				: $str_street,
 *				: $str_house_number,
 *				: $str_zipcode,
 *				: $str_city
 *				: $str_country
 *				: $bl_create, true when there should be one created when there is none.
 * Returns      : The ship id. FALSE when none 
 **/
Function GetShipAdres($int_contactid, 
					  $str_name,
					  $str_contact,
					  $str_street,
					  $str_house_number,
					  $str_zipcode,
					  $str_city,
					  $str_country,
					  $bl_create = FALSE)
{
	$sql_shipID = "SELECT AdresID
		    		  FROM Adressen
		    		  WHERE ContactID = '$int_contactid'
						AND Naam = '$str_name'
						AND attn = '$str_contact'
						AND straat = '$str_street'
						AND huisnummer = '$str_house_number'
						AND postcode = '$str_zipcode'
						AND land = '" . substr($str_country, 0, 2) . "'
						AND (adrestitel = '" . SHIP_ADDRESS_TYPE . "' OR
							adrestitel = '" . ONLY_ADDRESS_TYPE . "' OR
							adrestitel = '" . HOME_SHIP_ADDRESS_TYPE . "' OR
							adrestitel = '" . DROP_SHIP_ADDRESS_TYPE . "')";							
							
    $int_ship_id = GetField($sql_shipID);
	
    // When there is no order number insert one.
    if (!$int_ship_id && $bl_create) {
        $sql_insert_ship =  "INSERT Adressen SET 
								adrestitel = ".SHIP_ADDRESS_TYPE.",
								ContactID = '$int_contactid',
								Naam = '$str_name',
								attn = '$str_contact',
								straat = '$str_street',
								huisnummer = '$str_house_number',
								postcode = '$str_zipcode',
								plaats = '$str_city',
								land = '$str_country'";
        $query = mysql_query($sql_insert_ship) or die("Invalid sql: " . mysql_error());
        $int_ship_id = mysql_insert_id();
    }

    return $int_ship_id; 
}

/**
 * Class	    : OrderInfo
 * Storrage class for the information we need to make an order.
 **/
class OrderInfo {
	var $int_orderid = 0,
		$int_Main_ContactID = 0,
		$int_ShipID= 0,
        $int_Price_Level = 0,
		$str_ContactsOrderID = '',
		$fl_shippingcost = 0,
		
		$str_ShipName = '',
		$str_ShipContactPerson = '',
		$str_Shipaddress ='',
		$str_ShipHouseNumber = '',
		$str_ShipCity = '',
		$str_ShipPostalCode ='',
		$str_ShipCountry = 'NL',
		$str_ShipOtherID ='',
		
		$str_BillName = '',
		$str_BillContactPerson = '',
		$str_Billaddress ='',
		$str_BillHouseNumber = '',
		$str_BillCity = '',
		$str_BillPostalCode ='',
		$str_BillCountry = 'NL',
		$str_BillOtherID ='',		
		
		$date_RequiredDate = NULL,
		$bl_in_one_delivery_yn = FALSE;

	/**
	 * Class constructor
	 **/
	function OrderInfo() {
		$this->int_Main_ContactID = 0;
		$this->int_ShipID= 0;
        $this->int_Price_Level = 0;
		$this->str_ContactsOrderID = '';
		$this->fl_shippingcost = 0;
		
		$this->str_ShipName = '';
		$this->str_Shipaddress ='';
		$this->str_ShipCity = '';
		$this->str_ShipPostalCode ='';
		$this->str_ShipCountry = 'NL';
		$this->str_ShipOtherID = '';
		
		$this->str_BillName = '';
		$this->str_Billaddress ='';
		$this->str_BillCity = '';
		$this->str_BillPostalCode ='';
		$this->str_BillCountry = 'NL';		
		$this->str_BillOtherID = '';
	}
	
	/**
	* Function	: printvars
	* Returns the current variables in the class
	**/
	function printvars() {
		return "
		Order id $this->int_orderid
		Contact ID $this->int_Main_ContactID
		cost: $this->fl_shippingcost
		Ship ID $this->int_ShipID
        Price level $this->int_Price_Level
		$this->str_ContactsOrderID
		$this->str_ShipName
		T.a.v. $this->str_ShipContactPerson
		$this->str_Shipaddress
		$this->str_ShipHouseNumber
		$this->str_ShipCity 
		$this->str_ShipCountry
		$this->str_ShipPostalCode
		$this->str_ShipOtherID
		
		$this->str_BillName
		$this->str_Billaddress
		$this->str_BillCity
		$this->str_BillPostalCode
		$this->str_BillCountry
		$this->str_BillOtherID
		
		$this->date_RequiredDate
		$this->bl_in_one_delivery_yn
		";
	}

	/**
	* Function	: AddOrder
	* Creates an order for the current class.
	**/
	function AddOrder() {
		//first check if there is a billing address
		if ($this->str_BillOtherID) { //then make this order for a 'branche' customer of the Head ContactID.
			$ary_branchecontacts = GetBranches($this->int_Main_ContactID, TRUE);
	//print "<PRE>array branches for : $this->int_Main_ContactID"; 
	//print_r($ary_branchecontacts);
	//print "</PRE>\n";
			// walk through the array to find the web user ID
			$int_webcontactID = FALSE;
			foreach($ary_branchecontacts as $key => $contact) {
				$branche_sql = "SELECT ContactID FROM contacts_xref WHERE ContactID = '$contact' AND OtherID = '$this->str_BillOtherID'";
				if ($int_webcontactID = GetField($branche_sql)) {					
					break;
				} 				
			}
			//echo " found : " . $int_webcontactID . " to be existing contact";
			if (!$int_webcontactID) {
				// create a contact as a child of this one
				$this->int_Main_ContactID = MakeBranche($this->int_Main_ContactID,
														$this->str_BillOtherID,
														$this->str_BillContactPerson);				
				//echo "new contact: " . $this->int_Main_ContactID . "created<br>";
			} else {
				// asign the found one to the class contactID
				$this->int_Main_ContactID = $int_webcontactID;
			}
		} else {
			$this->int_Main_ContactID = GetField("SELECT ContactID FROM contacts WHERE ContactID = $this->int_Main_ContactID");
		}
		
		if (!$this->int_orderid 
			&& 
			$this->int_Main_ContactID) 
		{
			$this->int_invoice_address = GetInvoiceAdres($this->int_Main_ContactID,
																$this->str_BillName,
																$this->str_BillContactPerson,
																$this->str_Billaddress,
																$this->str_BillHouseNumber,
																$this->str_BillPostalCode,
																$this->str_BillCity,
																$this->str_BillCountry,
																TRUE);
			$this->int_ShipID = GetShipAdres($this->int_Main_ContactID,
											$this->str_ShipName,
											$this->str_ShipContactPerson,
											$this->str_Shipaddress,
											$this->str_ShipHouseNumber,
											$this->str_ShipPostalCode,
											$this->str_ShipCity,
											$this->str_ShipCountry,
											TRUE);			
			$this->int_orderid = GetOpenOrder($this->int_Main_ContactID,
											  $this->str_ContactsOrderID,
											  TRUE,
											  $this->int_ShipID,
											  $this->fl_shippingcost);
//echo "shippingcost: " . $this->fl_shippingcost;
			if ($this->int_orderid) {
				$sql_update_order = "UPDATE orders SET "
								   ."RequiredDate = ".insertDate($this->date_RequiredDate)
								   .", in_one_delivery_yn = '$this->bl_in_one_delivery_yn' "
								   ." WHERE OrderID = '$this->int_orderid'";
				$query = mysql_query($sql_update_order)
					or die("Invalid sql: " . mysql_error());
			} else {
				echo "No order created in AddOrder";
			}
		}
		
		return $this->int_orderid;
	}

	/**
	* Function	: AddProduct
	* Addes products to this order class.
	* Input		: $int_product_id, The Product ID or EAN of the product to order.
	*			: $int_number_of_products, number of products to order.
	*			: $str_cust_row_id, customer row id.
	* Return	: True when succesfull. False otherwise.
	**/
	function AddProduct($int_product_id,
                        $int_number_of_products,
						$flt_price,
                        $str_cust_row_id = FALSE) {
		$bl_return_value = FALSE;		
		if ($this->int_orderid && $this->int_Main_ContactID) {
			$bl_return_value = SalesOrderProduct($int_product_id,
											$int_number_of_products,
											$flt_price,
											$this->int_Main_ContactID,
											$this->str_ContactsOrderID,
											$this->int_ShipID,
											NULL,
											$this->int_orderid,
											$this->fl_shippingcost);
		}
	
		return $bl_return_value;
	}

	/**
	* Function	: Comfirm
	* Comfirms the order for the current class.
	* Input		: $int_type, The confirmation type. Default is customer comfirmed.
	**/
	function Comfirm($int_type = 2) {
		if ($this->int_orderid) SetOrderConfirmed($this->int_orderid, $int_type);
	}
}


/**
 * Function     : OrderProduct
 * Will add the products to an order.
 * Input        : $int_productid, Product id to add
 *                $int_amount, number of products to add
 *				: $int_contact_id, the id of the contact.
 *				: $str_cust_order_id, Customer order id.
 *				: $int_ship_id, the id where the product should be send. 0 for default;
 *              : $str_cust_row_id, the order row ref. of the customer.
 * Returns      : True when successfull. 
 **/
function SalesOrderProduct($int_productid,
                      $int_amount,
					  $flt_price = NULL,
					  $int_contact_id,
					  $str_cust_order_id = DEFAULT_BASKET_REF,
					  $int_ship_id = 0,
                      $int_owner_id = OWN_COMPANYID,
					  $int_order_id,
					  $flt_added_cost = 0) {
	// Get a valid Iwex product ID.
	$sql_product = "SELECT ProductID 
								FROM current_product_list 
								WHERE ProductID = '$int_productid'
								   OR EAN = '$int_productid'";
	$int_productid = Getfield($sql_product);

	if (!$int_productid) {
		// No valid product ID found.
		return FALSE;
	}
	
	if ($flt_price) {
		$manual_price = TRUE;
	} else {
		$manual_price = FALSE;
	}
	
    // Get the latested order if none create one.
    /*$int_order_id = GetOpenOrder($int_contact_id, 
								$str_cust_order_id, 
								TRUE, 
								$int_ship_id);*/
    //echo "Order product $int_productid * $int_amount on order $int_order_id";              

    $flt_extendedprice = $int_amount * $flt_price;

    if ($int_order_id) {
		$sql_orderdetail = "INSERT INTO order_details SET Quantity='$int_amount', "
						  ." ProductID='$int_productid',"
						  ." ProductName='".GetProductName($int_productid)."',"
						  ." UnitPrice=' $flt_price',"
						  ." to_deliver='$int_amount', "
						  ." Discount='$str_korting',"
						  ." Extended_price='$flt_extendedprice',"
						  ." OrderID='$int_order_id',"
						  ." stock_owner_id = '$int_owner_id',"
						  ." manual_price='$manual_price'";
		$query = mysql_query($sql_orderdetail)
                    or die("Invalid sql: " . mysql_error());
        // Now update the order date and time with the current time. To make sure that this order doesn't age.
        $sql_update_order = "UPDATE orders SET OrderDate=".insertDate(date("Y-m-d H:i"))
                           ." WHERE OrderID = '$int_order_id'";
        $query = mysql_query($sql_update_order);
		SetOrderCost($int_order_id, 0, 1, $flt_added_cost, 1);
    } else {
        echo "Orderregel aanmaken/opzoeken mislukt<br>";
    }
	
	return TRUE;
}

?>