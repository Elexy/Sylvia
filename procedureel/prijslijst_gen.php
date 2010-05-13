<?
$format = isset($_GET['format']) && $_GET['format'] ? $_GET['format'] : FALSE;
$keyword = isset($_GET['keyword']) && $_GET['keyword'] ? $_GET['keyword'] : FALSE;
$long = isset($_GET['long']) && $_GET['long'] ? $_GET['long'] : FALSE;

define('XLS_SEPRATOR', "\t");
define('CSV_SEPRATOR', ",");

include ("common.php");

$data = "";

function makecsvfield($str, $seprator = ',', $int_strlenght = 250) {
        # important to escape any quotes to preserve them in the data.
        $str = str_replace("\n", " ", $str); 
        $str = str_replace("\r", " ", $str); 
        $str = str_replace('"', "'", $str);

		if ($int_strlenght) {
			$str = substr($str, 0, $int_strlenght); // Maximum string lengt 250
		}
        
        # needed to encapsulate data in quotes because some data might be multi line.
        # the good news is that numbers remain numbers in Excel even though quoted.
        $return_value = '"' . $str . '"'.$seprator;
    return $return_value;
}

if (isset($_GET['sortfield'])) {
    $sortfield = $_GET['sortfield'];
} else {
    $sortfield = 'Productnaam';
}

// Get the type of pricelist for the amount of units. For example the 10 for the 10+ prices. 
$int_amount_of_list = isset($_GET['units']) ? isset($_GET['units']) : FALSE;

// Get the price for a specific customer.
$int_contactID = isset($_GET["contactID"]) ? $_GET["contactID"] : FALSE;

$querysearch="select productID as 'ID', ProductName as 'Productnaam', ProductDescription as Omschrijving, "
		  .($int_amount_of_list || $int_contactID 
				? " Selling_price AS 'Prijs',  " 
				: " Selling_price AS 'Prijs_1', Selling_price_10 AS 'Prijs_10', Selling_price_50 AS"
          		 ." 'Prijs_50', Selling_price_100 AS 'Prijs_100', ")
		  . " Retail_price_ex as 'RRP', Merk, "
          . " ExternalID AS Supp_code, Pricelist_yn AS Stock, EAN, CategoryName AS Category "
          . " FROM current_product_list "
          . " LEFT JOIN categories ON current_product_list.CategoryID = categories.CategoryID"
          . " WHERE Pricelist_yn =1"
          . " ORDER by '$sortfield'";
          
if ($format == "xls") {
    $result = $db_iwex->query($querysearch);

    $str_filename = $ary_config['day_price_dir'].'/iwex_pricing.xls';
    if (!$file_handle = fopen ($str_filename, "wb")) {
        echo "Create file 'iwex_pricing.xls' in prijslijst_gen csv failed.\n";
    } else {
        //    echo $querysearch; // debug
        $int_count = mysql_num_fields($result);
        
        for ($i = 0; $i < $int_count; $i++){
            $data .= '"'.mysql_field_name($result, $i).'"'."\t";
        }
        $data .= "\n";
        
        while($obj = mysql_fetch_object($result)) {
            $line = makecsvfield($obj->ID, XLS_SEPRATOR);
            $line .= makecsvfield($obj->Productnaam, XLS_SEPRATOR);
            $line .= makecsvfield($obj->Omschrijving, XLS_SEPRATOR);
			if ($int_contactID) {
				$line .= makecsvfield(GetProductPrice($obj->ID,
									  				  1,
													  OWN_COMPANYID,
													  PRICING_TYPE_SALE,
													  $int_contactID),
									  XLS_SEPRATOR);
			} else if ($int_amount_of_list) {
				$line .= makecsvfield(GetProductPrice($obj->ID,  1), XLS_SEPRATOR);
			} else {
				$line .= makecsvfield(GetProductPrice($obj->ID,  1), XLS_SEPRATOR);
				$line .= makecsvfield(GetProductPrice($obj->ID, 10), XLS_SEPRATOR);
				$line .= makecsvfield(GetProductPrice($obj->ID, 50), XLS_SEPRATOR);
				$line .= makecsvfield(GetProductPrice($obj->ID,100), XLS_SEPRATOR);
			}
            $line .= makecsvfield($obj->RRP, XLS_SEPRATOR);
            $line .= makecsvfield($obj->Merk, XLS_SEPRATOR);
            $line .= makecsvfield($obj->Supp_code, XLS_SEPRATOR);
            $stock = (int) getfreestock($obj->ID);
            $stock = $stock < 0 ? "0" : $stock;
            $stock = $stock > 50 ? "50+" : $stock;
            $line .= makecsvfield($stock, XLS_SEPRATOR);
            $str_ean = strlen($obj->EAN) == 12 ? '0'.$obj->EAN : $obj->EAN;
            $line .= makecsvfield($str_ean, XLS_SEPRATOR);
            $line .= makecsvfield($obj->Category, XLS_SEPRATOR);
            $line .= substr($line, 0, strlen($line) - 1);
    //                echo $line."<br>";
            $data .= trim($line)."\n";
        }
    
        # Nice to let someone know that the search came up empty.
        # Otherwise only the column name headers will be output to cvs file.
        if ($data == "") {
            $data = "\nno matching records found\n";
        } else {
            fwrite($file_handle, $data);
        }
        fclose($file_handle);
    }
}  // end if format = xls
else if ($format == "csv") 	 {
	$result = $db_iwex->query($querysearch);
	if($long) {	
		$str_filename = $ary_config['day_price_dir'].'/iwex_pricing_long.csv';
	} else {
		$str_filename = $ary_config['day_price_dir'].'/iwex_pricing.csv';
	}
    if (!$file_handle = fopen ($str_filename, "wb")) {
        echo "Create file 'iwex_pricing.csv' in prijslijst_gen csv failed.\n";
    } else {
        //    echo $querysearch; // debug
        $int_count = mysql_num_fields($result);
        
        for ($i = 0; $i < $int_count; $i++){
            $data .= '"'.mysql_field_name($result, $i).'"'.",";
        }
        $data = substr($data, 0, strlen($data) - 1)."\n";

		if($long) {			
			while($obj = mysql_fetch_object($result)) {
				$line = makecsvfield($obj->ID);
				$line .= makecsvfield($obj->Productnaam, CSV_SEPRATOR, FALSE);
				$line .= makecsvfield($obj->Omschrijving, CSV_SEPRATOR, FALSE);
				if ($int_contactID) {
					$line .= makecsvfield(GetProductPrice($obj->ID,
														  1,
														  OWN_COMPANYID,
														  PRICING_TYPE_SALE,
														  $int_contactID),
										  CSV_SEPRATOR,
										  FALSE);
				} else if ($int_amount_of_list) {
					$line .= makecsvfield(GetProductPrice($obj->ID,
														  1),
										  CSV_SEPRATOR,
										  FALSE);
				} else {
					$line .= makecsvfield(GetProductPrice($obj->ID,  1), CSV_SEPRATOR, FALSE);
					$line .= makecsvfield(GetProductPrice($obj->ID, 10), CSV_SEPRATOR, FALSE);
					$line .= makecsvfield(GetProductPrice($obj->ID, 50), CSV_SEPRATOR, FALSE);
					$line .= makecsvfield(GetProductPrice($obj->ID,100), CSV_SEPRATOR, FALSE);
				}
				$line .= makecsvfield($obj->RRP, CSV_SEPRATOR, FALSE);
				$line .= makecsvfield($obj->Merk, CSV_SEPRATOR, FALSE);
				$line .= makecsvfield($obj->Supp_code, CSV_SEPRATOR, FALSE);
				$stock = (int) getfreestock($obj->ID);
				$stock = $stock < 0 ? "0" : $stock;
				$stock = $stock > 50 ? "50+" : $stock;
				$line .= makecsvfield($stock, CSV_SEPRATOR, FALSE);
				$str_ean = strlen($obj->EAN) == 12 ? '0'.$obj->EAN : $obj->EAN;
				$line .= makecsvfield($str_ean, CSV_SEPRATOR, FALSE);
				$line .= makecsvfield($obj->Category, CSV_SEPRATOR, FALSE);            
				// echo "'$stock' -> $line<br>";
				$data .= substr($line, 0, strlen($line) - 1)."\n";
			} 
		} else {
			while($obj = mysql_fetch_object($result)) {
				$line = makecsvfield($obj->ID);
				$line .= makecsvfield($obj->Productnaam);
				$line .= makecsvfield($obj->Omschrijving);
				if ($int_contactID) {
					$line .= makecsvfield(GetProductPrice($obj->ID,
														  1,
														  OWN_COMPANYID,
														  PRICING_TYPE_SALE,
														  $int_contactID));
				} else if ($int_amount_of_list) {
					$line .= makecsvfield(GetProductPrice($obj->ID,
														  1));
				} else {
					$line .= makecsvfield(GetProductPrice($obj->ID,  1));
					$line .= makecsvfield(GetProductPrice($obj->ID, 10));
					$line .= makecsvfield(GetProductPrice($obj->ID, 50));
					$line .= makecsvfield(GetProductPrice($obj->ID,100));
				}
				$line .= makecsvfield($obj->RRP);
				$line .= makecsvfield($obj->Merk);
				$line .= makecsvfield($obj->Supp_code);
				$stock = (int) getfreestock($obj->ID);
				$stock = $stock < 0 ? "0" : $stock;
				$stock = $stock > 50 ? "50+" : $stock;
				$line .= makecsvfield($stock);
				$str_ean = strlen($obj->EAN) == 12 ? '0'.$obj->EAN : $obj->EAN;
				$line .= makecsvfield($str_ean);
				$line .= makecsvfield($obj->Category);            
				// echo "'$stock' -> $line<br>";
				$data .= substr($line, 0, strlen($line) - 1)."\n";			
			}
		}

    
        # Nice to let someone know that the search came up empty.
        # Otherwise only the column name headers will be output to cvs file.
        if ($data == "") {
            $data = "\nno matching records found\n";
        } else {
            fwrite($file_handle, $data);
        }
        fclose($file_handle);
    }
} 
?>
