<?php
/**
 *
 *
 * @version $Id: ups_functions.php,v 1.27 2007-04-11 08:59:15 iwan Exp $
 * @copyright $date:$
 **/

define('UPSFILENAME','/delivery');
define("UPSTRACKINGNUM", "<TrackingNumber>");
define("UPSTRACKINGNUMEND", "</TrackingNumber>");

// UPS Service Codes - EU
define ("UPS_EXPRESS", 7);
define ("UPS_STANDAARD", 11);
define ("UPS_WORLDWIDE_EXPRESS_PLUS", 54);
define ("UPS_EXPRESS_SAVER", 65);

// Pickup Types
define ("DAILY_ PICKUP", 01);
define ("CUSTOMER_COUNTER", 03);
define ("ONE_TIME_PICKUP", 06);
define ("ON_CALL_AIR_PICKCUP", 07);
define ("SUGGESTED_RETAIL_RATES", 11);
define ("LETTER_CENTER", 19);
define ("AIR_SERVICE_CENTER", 20);

// Package Type Codes
define ("UPS_LETTER", 01);
define ("PACKAGE", "02");
define ("UPS_TUBE", 03);
define ("UPS_PAK", 04);
define ("UPS_EXPRESS_BOX", 21);
define ("UPS_25KG_BOX", 24);
define ("UPS_10KG_BOX", 25);

// Weight codes
define ("WEIGHT_KGS", "KGS");
define ("WEIGHT_LBS", "LBS");
define ("UPS_MINIMUM_WEIGHT", 0.1);

/*********************************************************
 * Function     : XMLparseSpecialChar
 * Will create a XML string that is valid. So without
 * quotes and ampersans.
 * Input        : str, the string
 * Returns      : A correct XML string.
 *********************************************************/
function XMLparseSpecialChar($str) {
    $str_return = $str;
    
    $str_return = str_replace("&", "&amp;", $str_return);
    $str_return = str_replace("<", "&lt;", $str_return);
    $str_return = str_replace(">", "&gt;", $str_return);
    $str_return = str_replace("\"", "&quot;", $str_return);
    $str_return = str_replace("'", "&apos;", $str_return);

    return $str_return;
}

/*********************************************************
 * Function     : CreateUPSlabel
 * Will create a XML file in the UPS directory. To be read
 * by UPS WorldShip. Who will create a label for it.
 * Input        : int_shipid; The shipment ID of the label
 * 				: directory: The directory for the file.
 * Returns      : True when succesfull. False otherwise.
 *********************************************************/
function CreateUPSlabel($int_shipid, $str_directory) {
	define("ERROR_CREATEUPS_QUERY", "Ongeldige createupslabel query: ");

	$bl_return = FALSE;
    $str_shipid = sprintf("%06s", $int_shipid); // 
    $str_filename = $str_directory.UPSFILENAME.$str_shipid.'.tmp';
    $str_filename_xml = $str_directory.UPSFILENAME.$str_shipid.'.xml';
    $flt_ordercost = 0;
	$flt_productcost = 0;
	$flt_weight = 0;
	$ary_boxid = array();
    
	if ($int_shipid) if (!$file_handle = fopen ($str_filename, "wb")) {
    	echo "Create file '$str_filename' in ups_fuctions failed.\n";
    } else {
    
    	// Create a query to select the shipment
	    $sql_shipments = SQL_SHIPMENTS . "WHERE Shipment_ID = $int_shipid";
	
	    $query = mysql_query($sql_shipments)
	       or die(ERROR_CREATEUPS_QUERY . mysql_error());

		if (mysql_num_rows($query)) {
		
		    while ($objshipment = mysql_fetch_object($query)) {
		       $str_shipname = XMLparseSpecialChar($objshipment->Naam);
		       $str_attn = XMLparseSpecialChar($objshipment->attn);
			   $str_shipaddress = XMLparseSpecialChar("$objshipment->straat $objshipment->huisnummer");
		       $str_shipcity = XMLparseSpecialChar($objshipment->plaats);
		       $str_shipZip = $objshipment->postcode;
			   $str_shipcountry = $objshipment->land;
		       $int_customerid = $objshipment->ContactID;
		       $str_companyname = XMLparseSpecialChar($objshipment->CompanyName);
			   $str_address = XMLparseSpecialChar($objshipment->Address);
			   $str_region = $objshipment->Region;
		       $str_city = XMLparseSpecialChar($objshipment->City);
		       $str_zipcode = $objshipment->PostalCode;
			   $str_country = $objshipment->Country;
			   $str_phone = $objshipment->Phone;
			   $str_taxID = $objshipment->btw_number;
			   $str_upsaccount = $objshipment->UPSaccount;
               $int_adres_titel = $objshipment->adrestitel;
			}
			mysql_free_result($query);   
			
			$sql_orders = "SELECT DISTINCT inventory_transactions.OrderID
					FROM inventory_transactions 
					INNER JOIN orders ON inventory_transactions.OrderID = orders.OrderID
					WHERE shipmentID = $int_shipid";
			$query_orders = mysql_query($sql_orders)
		       or die(ERROR_CREATEUPS_QUERY . mysql_error());
		
		    while ($obj_orders = mysql_fetch_object($query_orders)) {
			   
			   $sql_inventoryt = "SELECT 
					 UnitPrice, UnitsSold, btw_percentage, added_cost, weight_corr, box_ID 
					FROM inventory_transactions 
					INNER JOIN current_product_list ON current_product_list.ProductID = inventory_transactions.ProductID
					WHERE shipmentID = $int_shipid AND OrderID = $obj_orders->OrderID";
			   $query_invetory = mysql_query($sql_inventoryt)
		       	     or die(ERROR_CREATEUPS_QUERY . mysql_error());
			    
				while ($obj_inventory = mysql_fetch_object($query_invetory)) {
				   $flt_ordercost += $obj_inventory->added_cost * $obj_inventory->UnitsSold; // Added costs 
				   $flt_productcost += $obj_inventory->UnitPrice*$obj_inventory->UnitsSold;
				   $ary_boxid[$obj_inventory->box_ID] += $obj_inventory->weight_corr * $obj_inventory->UnitsSold;
				   $flt_weight += $obj_inventory->weight_corr * $obj_inventory->UnitsSold;
				}
				
			    mysql_free_result($query_invetory);
			}
			mysql_free_result($query_orders); 
			
			$str_totalexclvat = sprintf("%.2f", $flt_productcost + $flt_ordercost);
            $flt_weight = ($flt_weight > 0) ? $flt_weight : 0.6;  // When weight is <= 0 set it to .6 kg.
			$str_totalweight = sprintf("%.2f", $flt_weight*0.8);
              
            $int_numofbox = GetField("SELECT count(box_ID) 
                                      FROM box 
                                      WHERE Shipment_ID = $int_shipid");
			unset($ary_boxid);

            $str_ups_xml_template = "<?phpml version=\"1.0\" encoding=\"windows-1252\"?>
<OpenShipments xmlns=\"x-schema:OpenShipments.xdr\">
	<OpenShipment  ProcessStatus=\"\">
		<Receiver>
			<CompanyName>$str_shipname</CompanyName>
			<ContactPerson>$str_attn</ContactPerson>
			<AddressLine1>$str_shipaddress</AddressLine1>
			<AddressLine2></AddressLine2>
			<AddressLine3></AddressLine3>
			<City>$str_shipcity</City>
			<CountryCode>$str_shipcountry</CountryCode>
			<PostalCode>$str_shipZip</PostalCode>
			<StateOrProvince></StateOrProvince>
			<Residential>0</Residential>
			<CustomerIDNumber>$int_customerid</CustomerIDNumber>
			<Phone>$str_phone</Phone>
			<TaxIDNumber>$str_taxID</TaxIDNumber>
			<LocationID></LocationID>
			<UpsAccountNumber>$str_upsaccount</UpsAccountNumber>
			<RecordOwner>Iwex</RecordOwner>
		</Receiver>
		<Shipment>
			<ServiceLevel>ST</ServiceLevel>
			<PackageType>CP</PackageType>
			<NumberOfPackages>$int_numofbox</NumberOfPackages>
			<ShipmentActualWeight>$str_totalweight</ShipmentActualWeight>
			<DescriptionOfGoods>Goods</DescriptionOfGoods>
			<Reference1>Levering $int_shipid</Reference1>
			<Reference2></Reference2>
			<DocumentOnly>0</DocumentOnly>
			<GoodsNotInFreeCirculation>0</GoodsNotInFreeCirculation>
			<BillingOption>PP</BillingOption>
		</Shipment>
	</OpenShipment>
</OpenShipments>";
            
            $bl_return = fwrite($file_handle, $str_ups_xml_template);
        }
        
        fclose($file_handle); // Close the open filepointer.
        
        // When the file is ready rename it to the *.xml name. To make sure
        // the WorldShip doesn't have problems with file write to this file.
        if ($int_adres_titel != 2 && 
            $int_adres_titel != 6 &&
            $int_adres_titel != 7) {
            if (!rename ($str_filename, $str_filename_xml)) {
                echo "Rename file to '$str_filename_xml' in ups_fuctions failed.\n";
            }
        } else {
            $bl_return = FALSE;
            echo "<b>Ship adres is not valid (Postbus or not used etc.)</b>\n";
        }
    } // end if open file for writing failed.
    
    return $bl_return;
}

/*********************************************************
 * Function     : GetUPStrackingNum
 * Get the tracking number from the UPS output file. Will
 * place all the tracking numbers in the box.
 * Input        : int_shipid; The shipment ID of the label
 * 				: directory: The directory for the file.
 * Returns      : The tracking number of box 1. 
 *                NULL otherwise.
 *********************************************************/
function GetUPStrackingNum($int_shipid, $str_directory) {
    $str_tracking = NULL;
    $str_shipid = sprintf("%06s", $int_shipid); // 
    $str_filename = $str_directory.UPSFILENAME.$str_shipid.'.Out';
    $ary_tracking_numbers = array();
    $int_box_cnt = 0;
    
    // Read the config file
    if ($ary_file = file($str_filename)) {
        foreach($ary_file as $str_line)
        {
            $pos = strpos($str_line, UPSTRACKINGNUM);
            if ($pos)
            {   //Line must contain the tracking number.
                $end_pos = strpos($str_line, UPSTRACKINGNUMEND);
                $pos += strlen(UPSTRACKINGNUM);
                $ary_tracking_numbers[$int_box_cnt++] = substr($str_line, $pos, $end_pos - $pos );
            }
        }
        unset($ary_file);
        
        $sql_get_box = $sql_getbox = "SELECT box.box_ID 
                                      FROM box
                                      WHERE Shipment_ID = $int_shipid";
        $qry_get_box = mysql_query($sql_get_box)
            or die("Ongeldig query in GetUPStrackingNum: $sql_get_box<br>". mysql_error());
        
        $int_box_cnt2 = 0;
        while ($obj = mysql_fetch_object($qry_get_box)) {
			UpdateBox($obj_box->box_ID,
					  $ary_tracking_numbers[$int_box_cnt2 ++],
					  0); // Still need to calculate the box weight
        }
        
        if ($int_box_cnt2 != $int_box_cnt2) echo "<h2 align=center class=\"menubar\">Amount of tracking numbers in UPS file is not the same as amount of boxes in the box table for this ($int_shipid) shipment.</h2>";
    
        mysql_free_result($qry_get_box);	
    
        // When there where tracking numbers found insert it in the shipment tracking.
        if ($int_box_cnt) {
            $track_shipment_sql='UPDATE shipments SET
                                 Tracking = "'.$ary_tracking_numbers[0].'"
                                 WHERE shipment_ID = "'.$int_shipid.'"';
            $query_track_shipment = mysql_query($track_shipment_sql);
            
            $str_tracking = $ary_tracking_numbers[0];
        }        
    } else {
        echo "Failed to read $str_filename.\n";
    }
       
    return $str_tracking;
}

/*
 * Class     :Ups
 * Set defaults: Acceslicensenumber, userid, Password  
 * Requirment: GetupsShipping Class or another class written for this class
 * Input          :  $GLOBALS["ary_config"]
 * Returns      : Ups results
 */
 
Class Ups {

	var $ups = "";
	var $xmlreturndata = "";
	var $returndata = "";
	
	/*
	 * Function     : Ups
	 * Set defaults : Acceslicensenumber, userid, Password  
	 * Returns      : Ups results
	 */	
	Function Ups() {
		
		// Required user options
		$this->accesslicensenumber = $GLOBALS["ary_config"]["AccesLicenseNumber"];
		$this->userid = $GLOBALS["ary_config"]["UpsUserid"];
		$this->password = $GLOBALS["ary_config"]["UpsPassword"];

	}

	/*
	 * Function		: XmlCreator
					  This function makes the xml that is needed to send to ups
	 * Input        : $this->ups
	 * Returns      : Ups results
	 */
	Function Xmlcreator() {
	
		$xml = "<?phpml version=\"1.0\"?>
				<AccessRequest xml:lang=\"en-US\">
					<AccessLicenseNumber>$this->accesslicensenumber</AccessLicenseNumber>
					<UserId>$this->userid</UserId>
					<Password>$this->password</Password>
				</AccessRequest>
				<?phpml version=\"1.0\"?>
				<RatingServiceSelectionRequest xml:lang=\"en-US\">
					<Request>
						<TransactionReference>
							<CustomerContext>Iwex Rate Request</CustomerContext>
							<XpciVersion>1.0001</XpciVersion>
						</TransactionReference>
						<RequestAction>Rate</RequestAction>
						<RequestOption>Rate</RequestOption>
					</Request>";
	$xml .= $this->SetXml();
						
	$xml .= 	"</RatingServiceSelectionRequest>";
	
	$ch = @curl_init();
	curl_setopt ($ch, CURLOPT_URL, $GLOBALS["ary_config"]["UpsServer"]); /// set the post-to url (do not include the ?query+string here!)
	curl_setopt ($ch, CURLOPT_HEADER, 0); /// Header control
	curl_setopt ($ch, CURLOPT_POST, 1); /// tell it to make a POST, not a GET
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $xml); /// put the query string here starting with "?"
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); /// This allows the output to be set into a variable
	$this->xmlreturndata = curl_exec ($ch); /// execute the curl session and return the output to a variable
	curl_close ($ch); /// close the curl session	

	return $this->xmlreturndata;
	}

	/*
	 * Function		: Xmlparser
					  This function makes from the returning result an array.
					  If you want to see the array. Set the bl_show_array to True in the function
	 * Input        : $this->xmlreturndata
	 * Returns      : $ary_shipping
	 */
	Function Xmlparser($bl_Show_array = FALSE) {
	
		$this->Xmlcreator();
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $this->xmlreturndata, $vals, $index);
		xml_parser_free($xml_parser);

		$ary_shipping = array();
		$level = array();
		
			foreach ($vals as $xml_elem) {
				if ($xml_elem['type'] == 'open') {
					if (array_key_exists('attributes',$xml_elem)) {
						list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
					} else {
						$level[$xml_elem['level']] = $xml_elem['tag'];
					}
				}
				if ($xml_elem['type'] == 'complete') {
					$start_level = 1;
					$php_stmt = '$ary_shipping';
				
					while($start_level < $xml_elem['level']) {
						$php_stmt .= '[$level['.$start_level.']]';

						$start_level++;
					}
					if(empty($xml_elem['value'])) {
					$xml_elem['value'] = "";
					}
					$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
					eval($php_stmt);
				}
			}
		// Show the array.
		if ($bl_Show_array) {
			echo "<pre>";
			print_r($ary_shipping);
			echo "</pre>";
		}
		$this->ary_shipinfo = $ary_shipping;
	}
	
	/*
	 * Function		: ShowError
					  Creating an string with the error problem and returning it
	 * Input        : $ary_shipping Ups xml file.
	 * Returns      : $ary_shipping
	 */
	Function ShowError() {
		
		$ary_error = $this->ary_shipinfo["RATINGSERVICESELECTIONRESPONSE"]["RESPONSE"]["ERROR"];

		$str_enddata = "<h3>Er is een fout opgetreden!</h3>";
		$str_enddata .= "<b>Error Prioriteit:</b> " . $ary_error["ERRORSEVERITY"] . "<br>";
		$str_enddata .= "<b>Error Code:</b> " . $ary_error["ERRORCODE"] . "<br>";
		$str_enddata .= "<b>Error Description:</b> " . $ary_error["ERRORDESCRIPTION"];
		
		return $str_enddata; 
	}
}

/*
 * Class     :  GetupsShipping
 * Requirment:  Ups Class
 * Input     :	$shipTo_City
				$shipTo_Postcode
				$shipTo_Countrycode
				$PackageWeight
 * Returns   :  Ups Shipping prijs
 */
Class GetupsShipping extends Ups {
	var $ary_shipinfo;
	var $int_package_number;

	/*
	 * Function		: GetupsShipping
	 *				  Set defaults for the xml file
	 */
	Function GetupsShipping() {
		global $db_iwex;
		$this->Ups();
		


		$this->ups["Shipment"]["Shipper"]["Address"]["PostalCode"] = $GLOBALS["ary_config"]["zipcode"];
		$this->ups["Shipment"]["Shipper"]["Address"]["City"] = $GLOBALS["ary_config"]["city"];
		$this->ups["Shipment"]["Shipper"]["Address"]["CountryCode"] = $GLOBALS["ary_config"]["countrycode"];

		$this->ups["PickupType"]["Code"] = "";
		$this->ups["Shipment"]["Service"]["Code"] = UPS_STANDAARD;
		$this->ups["Shipment"]["Package"]["PackagingType"]["Code"] = PACKAGE;
	}

	/*
	 * Function		: Shipment
	 *				  Set shipping information
	 * Input        : $shipTo_City
	 *				  $shipTo_Postcode
	 *				  $shipTo_Countrycode
	 *				  $PackageWeight
	 */
	Function Shipment( 	$shipTo_City = FALSE,
						$shipTo_Postcode = FALSE,
						$shipTo_Countrycode = FALSE,
						$package_weight = FALSE,
						$bl_residential = FALSE,
						$bl_ShipperNumber = FALSE,
						$PickupType = FALSE,
						$shipFrom_Postcode = FALSE,
						$shipFrom_City = FALSE,
						$shipFrom_Countrycode = FALSE,
						$service_code = FALSE,
						$PackagingType_Code = FALSE,
						$UnitOfMeasurement_Code = FALSE,
						$Dimensions_Length = FALSE,
						$Dimensions_Width = FALSE,
						$Dimensions_Height = FALSE,
						$PackageWeight_Code = FALSE
					) {

		if ($package_weight > 30) {
			$this->int_package_number = $package_weight / 10;
			$package_weight = $package_weight / $this->int_package_number;
		} else {
			$this->int_package_number = 1;
			if ($package_weight < UPS_MINIMUM_WEIGHT) {
				$package_weight = UPS_MINIMUM_WEIGHT;
			}
		}	
		if ($bl_ShipperNumber) {
		$this->ups["Shipment"]["Shipper"]["ShipperNumber"] = $GLOBALS["ary_config"]["UpsShipperNumber"];
		} else {
		$this->ups["Shipment"]["Shipper"]["ShipperNumber"] = $bl_ShipperNumber;
		}
					
		$this->ups["PickupType"]["Code"] = $PickupType;
		$this->ups["Shipment"]["ShipTo"]["Address"]["City"] = $shipTo_City;
		$this->ups["Shipment"]["ShipTo"]["Address"]["PostalCode"] = $shipTo_Postcode;
		$this->ups["Shipment"]["ShipTo"]["Address"]["CountryCode"] = $shipTo_Countrycode;
		$this->ups["Shipment"]["ShipTo"]["Address"]["ResidentialAddressIndicator"] = $bl_residential;
		$this->ups["Shipment"]["ShipFrom"]["Address"]["City"] =  $shipFrom_City;
		$this->ups["Shipment"]["ShipFrom"]["Address"]["PostalCode"] =  $shipFrom_Postcode;
		$this->ups["Shipment"]["ShipFrom"]["Address"]["CountryCode"] = $shipFrom_Countrycode;

		if($service_code) {
			$this->ups["Shipment"]["Service"]["Code"] = $service_code;
		}
		if($PackagingType_Code) {
			$this->ups["Shipment"]["Package"]["PackagingType"]["Code"] = $PackagingType_Code;
		}

		$this->ups["Shipment"]["Package"]["Dimensions"]["UnitOfMeasurement"]["Code"] = $UnitOfMeasurement_Code;
		$this->ups["Shipment"]["Package"]["Dimensions"]["Length"] = $Dimensions_Length;
		$this->ups["Shipment"]["Package"]["Dimensions"]["Width"] = $Dimensions_Width;
		$this->ups["Shipment"]["Package"]["Dimensions"]["Height"] = $Dimensions_Height;
		$this->ups["Shipment"]["Package"]["PackageWeight"]["UnitOfMeasurement"]["Code"] = $PackageWeight_Code;
		$this->ups["Shipment"]["Package"]["PackageWeight"]["Weight"] = $package_weight;
		
		$this->Xmlparser();
	}
	
	/*
	 * Function		: SetXml
	 *				  Creating a ShipmentXml
	 * Input        : $this->ups
	 */
	function SetXml() {

		$xml = "";
		if($this->ups["PickupType"]["Code"]) {
		$xml .= 		"<PickupType>
							<Code>" . $this->ups["PickupType"]["Code"] . "</Code>
						</PickupType>";

		}	
		$xml .=		"<Shipment>
						<Shipper>
							<ShipperNumber>" . $this->ups["Shipment"]["Shipper"]["ShipperNumber"] . "</ShipperNumber>
							<Address>
								<City>" . $this->ups["Shipment"]["Shipper"]["Address"]["City"] . "</City>
								<PostalCode>" . $this->ups["Shipment"]["Shipper"]["Address"]["PostalCode"] . "</PostalCode>
								<CountryCode>" . $this->ups["Shipment"]["Shipper"]["Address"]["CountryCode"] ."</CountryCode>
								</Address>
							</Shipper>
							<ShipTo>
								<Address>
									<City>" . $this->ups["Shipment"]["ShipTo"]["Address"]["City"] . "</City>
									<PostalCode>" . $this->ups["Shipment"]["ShipTo"]["Address"]["PostalCode"] . "</PostalCode>
									<CountryCode>" . $this->ups["Shipment"]["ShipTo"]["Address"]["CountryCode"] . "</CountryCode>
									<ResidentialAddressIndicator>" . $this->ups["Shipment"]["ShipTo"]["Address"]["ResidentialAddressIndicator"] . "</ResidentialAddressIndicator>
								</Address>
							</ShipTo>";
		if($this->ups["Shipment"]["ShipFrom"]["Address"]["CountryCode"]) {
		$xml .=				"<ShipFrom>
								<Address>
									<City>" . $this->ups["Shipment"]["ShipFrom"]["Address"]["City"] . "</City>
									<PostalCode>" . $this->ups["Shipment"]["ShipFrom"]["Address"]["PostalCode"] . "</PostalCode>
									<CountryCode>" . $this->ups["Shipment"]["ShipFrom"]["Address"]["CountryCode"] . "</CountryCode>
								</Address>
							</ShipFrom>";
		}						
		$xml .=				"<Service>
								<Code>" . $this->ups["Shipment"]["Service"]["Code"] . "</Code>
							</Service>";
		for($i = 0 ; $i < $this->int_package_number ; $i++) {
			$xml .= "			<Package>
									<PackagingType>
										<Code>" . $this->ups["Shipment"]["Package"]["PackagingType"]["Code"] . "</Code>
									</PackagingType>";
			if($this->ups["Shipment"]["Package"]["Dimensions"]["Length"] || $this->ups["Shipment"]["Package"]["Dimensions"]["Width"] || $this->ups["Shipment"]["Package"]["Dimensions"]["Height"]) {
			$xml .=					"<Dimensions>
										<Length>" . $this->ups["Shipment"]["Package"]["Dimensions"]["Length"] . "</Length>
										<Width>" . $this->ups["Shipment"]["Package"]["Dimensions"]["Width"] . "</Width>
										<Height>" . $this->ups["Shipment"]["Package"]["Dimensions"]["Height"] . "</Height>
									</Dimensions>";
			}
			$xml .=					"<PackageWeight>
										<UnitOfMeasurement>
											<Code>" . $this->ups["Shipment"]["Package"]["PackageWeight"]["UnitOfMeasurement"]["Code"] . "</Code>
										</UnitOfMeasurement>
										<Weight>" . $this->ups["Shipment"]["Package"]["PackageWeight"]["Weight"] . "</Weight>
									</PackageWeight>
								</Package>";
		}								
		$xml .=			"</Shipment>";

	
		return $xml;
	}
	
	/*
	 * Function		: Result
	 *				  Returning ship information
	 * Output		: $flt_amount is amout in EURO
	 * Returns		: TRUE when succesfull, FALSE otherwise.
	 */
	Function Rate($flt_amount) {
		
		if (isset($this->ary_shipinfo["RATINGSERVICESELECTIONRESPONSE"]["RATEDSHIPMENT"])) {
			$root = $this->ary_shipinfo["RATINGSERVICESELECTIONRESPONSE"]["RATEDSHIPMENT"];
		} else {
			echo "No data received from UPS";
			$root = FALSE;
		}
			
		//$ary_enddata["currencycode"] = $root["TOTALCHARGES"]["CURRENCYCODE"];
		$flt_amount = $root["TOTALCHARGES"]["MONETARYVALUE"];
		return $this->ary_shipinfo["RATINGSERVICESELECTIONRESPONSE"]["RESPONSE"]["RESPONSESTATUSDESCRIPTION"] != "Failure";
	}
}

?>
