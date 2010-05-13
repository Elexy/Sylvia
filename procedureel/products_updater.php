<?PHP

// Created on 	09/11/2005
// Creaded by 	Iwex
// Programmer	Richard schuit


// --- configuration ---

// csv Directory.
$str_csv_dir = "http://www.mm-s.nl/consoles/nav_consoles.csv";
// Set images - The image name will be named to the model name. But if there is no image into the shop image directory. The image will not bye set!
$int_set_image = 1;
// Image Path
$str_image_path = "../images/products/";
$str_image_thumb_path = $str_image_path . "thumbs/";
// Supplier id
$int_supplier_id = 0;
// Btw CLASS
$int_btw_class = 0;
// Merk id
$int_merk_id = 20;
// Deleting products from the database if the product is not on the csv list.
$int_deleting_products = 0;

// first we Include the functions.
include ("include.php");

$directory = "../images/products";
if ($dir = opendir($directory)) {

	while ($str_file = readdir($dir)) {
		if ($str_file != "." && $str_file != "..") {
			$ary_image[] = explode(".", $str_file);
		}
	}
}

// Now we open the file and reed it. Every line will set into the $path array. then we countering te lines!
$str_path = "";
$ary_filelines = file($str_csv_dir);
$int_line_counter = count($ary_filelines);

// Set de tabelnames into the array tabelheaders. Then we counting the headers.
$ary_tabelheaders = str_replace("\"" ,"", explode(";" ,$ary_filelines[0]));
$int_tabelheader_count = count($ary_tabelheaders);

// Into the loop we seperating the information of each line. Then we set the seperated infomatie into the array  
for ($i = 1 ; $i < $int_line_counter ; $i++)  {

	$str_values = explode(";", $ary_filelines[$i]);

	for ($i_header = 0 ; $i_header < $int_tabelheader_count ; $i_header++) {
		if($i_header == 9 || $i_header == 10) {
			$str_values[$i_header] = str_replace("," ,".", $str_values[$i_header]);
		}
		$ary_info[$i][$ary_tabelheaders[$i_header]] = $str_values[$i_header];
	}
}

$int_infocounter = count($ary_info);
$outputinfo = "<B>Aantal Producten:</B><BR>$int_infocounter products.";

// Update the database
// $ary_tabelheaders[0]  =Category
// $ary_tabelheaders[1]  = Merk
// $ary_tabelheaders[2] = Type
// $ary_tabelheaders[3] = Periode
// $ary_tabelheaders[4] = Type steun
// $ary_tabelheaders[5] = Bestel nummer
// $ary_tabelheaders[6] = Foto
// $ary_tabelheaders[7] = Handleiding
// $ary_tabelheaders[8] = Actief
// $ary_tabelheaders[9] = prijs_I
// $ary_tabelheaders[10] = cons_ex

$int_product_add = 0;
$int_product_upd = 0;
$int_product_del = 0;
//var_dump($info);
for ($line = 1 ; $line <= $int_infocounter ; $line++) {

	// Set date and time
	$date = date("Y-m-d:H:i:s");

	// Check to see if the product merk already exist.
	$brand_result = $db_iwex->query("SELECT name FROM brand WHERE brand_id = '" . $int_merk_id . "'");
	$obj_brand = mysql_fetch_object($brand_result);
	$int_brandID = isset($obj_brand->name) ? $obj_brand->name : FALSE;
	
	// Check to see if the Merk already exist.
	$brand_auto_result = $db_iwex->query("SELECT brand_id FROM brand WHERE name = '" . $ary_info[$line][$ary_tabelheaders[1]] . "'");
	$obj_auto_brand = mysql_fetch_object($brand_auto_result);
	$int_auto_brandID = isset($obj_auto_brand->brand_id) ? $obj_auto_brand->brand_id : FALSE;
	if (!$int_auto_brandID) {			
		$db_iwex->query("INSERT INTO brand(name) VALUES('" . $ary_info[$line][$ary_tabelheaders[1]] . "')");
	}

	// Check to see if the product category already exist.
	$categories_result = $db_iwex->query("SELECT CategoryID FROM categories WHERE CategoryName = '" . $ary_info[$line][$ary_tabelheaders[0]] . "'");
	$obj_categories = mysql_fetch_object($categories_result);
	$int_CategoryID = isset($obj_categories->CategoryID) ? $obj_categories->CategoryID : FALSE;

	// If the caregorie not exist.		
	if (!$int_CategoryID) {			
		$db_iwex->query("INSERT INTO categories(CategoryName, public) VALUES('" . $ary_info[$line][$ary_tabelheaders[0]] . "', '1')");
	}

	$catid_result = $db_iwex->query("SELECT CategoryID FROM categories
								     WHERE CategoryName = '" . $ary_info[$line][$ary_tabelheaders[0]] . "'");
	$obj_catid = mysql_fetch_object($catid_result);

	// Check to see if the product Subcategorie category already exist.
	$subcat_result = $db_iwex->query("SELECT ParentID FROM categories WHERE CategoryName = '" . $ary_info[$line][$ary_tabelheaders[4]] . "'");
	$obj_subcat = mysql_fetch_object($subcat_result);
	$int_subcat = isset($obj_subcat->ParentID) ? $obj_subcat->ParentID : FALSE;
	// If the Subcaregorie not exist.		
	if (!$int_subcat) {			
		$db_iwex->query("INSERT INTO categories(ParentID,  CategoryName) VALUES('" . $obj_catid->CategoryID . "', '" . $ary_info[$line][$ary_tabelheaders[4]] . "')");
	}
	
	// select id's from the database.
	$brandid_result = $db_iwex->query("SELECT brand_ID FROM brand 
									   WHERE name = '" . $ary_info[$line][$ary_tabelheaders[1]] . "'");
	$obj_brandid = mysql_fetch_object($brandid_result);
	$subcatid_result = $db_iwex->query("SELECT CategoryID FROM categories 
									    WHERE CategoryName = '" . $ary_info[$line][$ary_tabelheaders[4]] . "'");
	$obj_subcatid = mysql_fetch_object($subcatid_result);


	$int_pricelist =  $ary_info[$line][$ary_tabelheaders[8]] == "ja" ? 1 : 0;	

	// check to see if the product already exist.
	$product_result = $db_iwex->query("SELECT ProductID, ProductName, Productdescription 
									   FROM current_product_list WHERE ExternalID = '" . $ary_info[$line][$ary_tabelheaders[5]] . "' 
									   and merkID = '" . $int_merk_id . "'");
	$obj_products = mysql_fetch_object($product_result);

	// Set prices and margin_correction
	$int_Margin_correction = $ary_info[$line][$ary_tabelheaders[10]] / $ary_info[$line][$ary_tabelheaders[9]] / 1.20;
	
	$int_ProductID = isset($obj_products->ProductID) ? $obj_products->ProductID : FALSE;
	$str_ProductName = isset($obj_products->ProductName) ? $obj_products->ProductName : FALSE;
	$str_Productdescription = isset($obj_products->Productdescription) ? $obj_products->Productdescription : FALSE;
	// If the product already exist we will updating the product.
	if ($int_ProductID) {

		
		// Set text for the product name and description.
		$bl_set_merk = TRUE;
		if(ereg($ary_info[$line][$ary_tabelheaders[1]], $str_ProductName)) {
			$bl_set_merk = FALSE;
		}
		$bl_set_description = TRUE;
		if(ereg($ary_info[$line][$ary_tabelheaders[2]], $str_Productdescription)) {
			$bl_set_description = FALSE;
		}		

		if ($bl_set_merk) {
			$str_product_name = $str_ProductName . " ";
			$str_product_name .= " - " . $ary_info[$line][$ary_tabelheaders[1]];
		} else {
			$str_product_name = $str_ProductName;
		}
		
		if ($bl_set_description) {
			$str_product_description = $str_Productdescription;
			$str_product_description .= "<BR>" . $ary_info[$line][$ary_tabelheaders[1]] . " " . $ary_info[$line][$ary_tabelheaders[2]] . " " . $ary_info[$line][$ary_tabelheaders[3]] . " " . $ary_info[$line][$ary_tabelheaders[4]];
		} else {
			$str_product_description = $str_Productdescription;
		}
		
		// Update the article.
		$bl_upd_result = $db_iwex->query("UPDATE current_product_list SET
										CategoryID = '" . $int_subcat . "',
										SubcategoryID = '" . $obj_subcatid->CategoryID . "',
										ProductName  = '" .  $str_product_name . "',
										Productdescription  = '" . $str_product_description . "',
										Purchase_price_home = '" . $ary_info[$line][$ary_tabelheaders[9]] . "',
										Margin_correction = '" . $int_Margin_correction . "',
										Btw_class = '" . $int_btw_class . "',
										Supplier = '" . $int_supplier_id . "',
										Merk  = '" . $int_brandID ."',
										MerkID = '" . $int_merk_id . "',
										Pricelist_yn = '" . $int_pricelist . "'
										WHERE ProductID = '" . $int_ProductID . "'
										");	
		if ($bl_upd_result) {
			$int_product_upd++;
		}
	} else {
		// Set text for the product name and description.
		$str_product_name = "Navigatieconsole " . $ary_info[$line][$ary_tabelheaders[4]] . " voor de: " . $ary_info[$line][$ary_tabelheaders[1]];
		$str_product_description = $ary_info[$line][$ary_tabelheaders[1]] . " " . $ary_info[$line][$ary_tabelheaders[2]] . " " . $ary_info[$line][$ary_tabelheaders[3]] . " " . $ary_info[$line][$ary_tabelheaders[4]];
		// Greating the article
		$bl_add_result = $db_iwex->query("INSERT INTO current_product_list
									(CategoryID, SubcategoryID, ProductName, Productdescription, Purchase_price_home, Margin_correction,
									 Btw_class, Supplier, Merk, MerkID, Pricelist_yn, ExternalID) VALUES
									('" . $int_subcat . "',
									 '" . $obj_subcatid->CategoryID . "',
									 '" . $str_product_name . "',
									 '" . $str_product_description . "',
									 '" . $ary_info[$line][$ary_tabelheaders[9]] . "',	
									 '" . $int_Margin_correction . "',										 
									 '" . $int_btw_class . "',
									 '" . $int_supplier_id . "',
									 '" . $int_brandID . "',
									 '" . $int_merk_id . "',
									 '" . $int_pricelist . "',
									 '" . $ary_info[$line][$ary_tabelheaders[5]] . "')");
	
		if($bl_add_result) {
			$int_product_add++;
		}
	}

	// Set cars
	$str_product =  $ary_info[$line][$ary_tabelheaders[1]] . " " . $ary_info[$line][$ary_tabelheaders[2]];
	$str_product_description = $ary_info[$line][$ary_tabelheaders[1]] . " " . $ary_info[$line][$ary_tabelheaders[2]] . " " . $ary_info[$line][$ary_tabelheaders[3]] . " " . $ary_info[$line][$ary_tabelheaders[4]];
	$auto_result = $db_iwex->query("SELECT ProductID, ProductName, Merk FROM current_product_list 
									WHERE ProductName = '" . $str_product . "' 
									and Merk = '" . $ary_info[$line][$ary_tabelheaders[1]] . "'");
	$obj_auto = mysql_fetch_object($auto_result);
	$int_auto = isset($obj_auto->ProductID) ? $obj_auto->ProductID : FALSE;
	// If the Subcaregorie not exist.		
	if (!$int_auto) {		
		$db_iwex->query("INSERT INTO current_product_list(ProductName, Productdescription, Merk, MerkID, ExternalID) 
						 VALUES('" . $str_product . "','" . $str_product_description . "','" . $ary_info[$line][$ary_tabelheaders[1]] . "','" . $obj_brandid->brand_ID . "', '" . $ary_info[$line][$ary_tabelheaders[5]] . "')");
	}

	if (!$int_ProductID) {
		$product_result = $db_iwex->query("SELECT ProductID FROM current_product_list WHERE ExternalID = '" . $ary_info[$line][$ary_tabelheaders[5]] . "' and merkID = '" . $int_merk_id . "'");
		$obj_products = mysql_fetch_object($product_result);
		$int_ProductID = isset($obj_products->ProductID) ? $obj_products->ProductID : FALSE;
	}
	
	// Update all prices
	UpdateAllPrices($int_ProductID);
	
	// Make relations between the products
	$products_result = $db_iwex->query("SELECT ProductID, ProductID_Main, ProductID_Acc FROM current_product_list
										LEFT JOIN associated_products ON current_product_list.ProductID = ProductID_Main
										WHERE Merkid != '" . $int_merk_id . "' and ProductName = '" . $str_product . "' ");
	// Set defaults before we go into the loop
	$int_productid_now = FALSE;
	$bl_set = TRUE;
	$ary_update = FALSE;
	
	while ($obj_external_products = mysql_fetch_object($products_result)) {

		// Check for true or false values.
		$int_check_ProductID = isset($obj_external_products->ProductID) ? $obj_external_products->ProductID : FALSE;
		$int_external_ProductID_Main = isset($obj_external_products->ProductID_Main) ? $obj_external_products->ProductID_Main : FALSE;
		$int_external_ProductID_Acc = isset($obj_external_products->ProductID_Acc) ? $obj_external_products->ProductID_Acc : FALSE;
		
		// check to see if the product id is changed. If it is we set the $bl_set to True.
		if ($int_productid_now != $int_check_ProductID) {
			$int_productid_now = $int_check_ProductID;
			$bl_set = TRUE;	
		}	
		// Check to see if there is an relation between the products.
		if ($int_external_ProductID_Acc == $int_ProductID) {
			$bl_set = FALSE;
		}
		// Set the array update for each productid that is related with the value true for: need to be related or false allready related.
		$ary_update[$int_check_ProductID] = $bl_set;
	}

	// Make the relation into the associated_ products table.
	if ($ary_update) {
		foreach ($ary_update As $int_check_ProductID => $bl_set) {
			if ($bl_set) {
				$db_iwex->query("INSERT INTO associated_products(ProductID_Main, ProductID_Acc) VALUES('$int_check_ProductID', '$int_ProductID') ");
			}
		}
	}


	// Set products images
	if ($int_set_image) {	
		$str_product_image = "";
		$bl_image_find = FALSE;

		$product_result = $db_iwex->query("SELECT ProductID FROM current_product_list WHERE ExternalID = '" . $ary_info[$line][$ary_tabelheaders[5]] . "'");
		While ($obj_products = mysql_fetch_object($product_result)) {
			$int_ProductID = isset($obj_products->ProductID) ? $obj_products->ProductID : FALSE;

			// check to see if the image exist into the image
			for ($i = 0 ; $i < count($ary_image) ; $i++) {
				if($ary_image[$i][0] == $int_ProductID) {
					$str_product_image = $ary_image[$i][0];
					$bl_image_find = TRUE;
				}
			}
				
			if (!$bl_image_find) {
				$image_name = $int_ProductID;
				$image_link = $ary_info[$line][$ary_tabelheaders[6]];
				$image = new Getimage($image_name, $str_image_path, $image_link);
				$image->makeimagethumb($str_image_thumb_path, 30);
				$str_product_image = $image->imagename(); 
			}
					
			$db_iwex->query("UPDATE current_product_list SET image = '" . $str_product_image . "'
							 WHERE ProductID = $int_ProductID ");
		}
	}	
}
if ($int_deleting_products) {

	$outputinfo .= "<BR><B>Verwijderde producten</B><BR>";
	$ary_products_result = mysql_query("SELECT ExternalID FROM current_product_list WHERE Supplier = $int_supplier_id ");
	while ($row = mysql_fetch_array($ary_products_result)) {
	$end = 0;
	$i = 1;
		while ($i <= $int_infocounter && $end != 1) {
			$deleting = TRUE;
			if ($row['ExternalID'] == $ary_info[$i][$ary_tabelheaders[5]]) {
				$deleting = FALSE;
				$end = 1;
			}
			$i++;
		}
		if ($deleting == TRUE) {
			$bl_del_result = $db_iwex->query("DELETE FROM current_product_list 
											  WHERE ExternalID = '" . $row['ExternalID'] . "'");

			$outputinfo .= $row['ExternalID'] . " > Is verwijderd van de database<BR>";
			
			if ($bl_del_result) {
				$int_product_del++;
			}
		}
	}
$outputinfo .= "<BR>$int_product_del";
}

$outputinfo .= "<BR><B>Toegevoegde producten</B><BR>$int_product_add";
$outputinfo .= "<BR><B>Upgedate producten</B><BR>$int_product_upd";



echo $outputinfo;

Class Getimage {

	// Path of the needed image.
	var $obj_image_path;
	var $obj_image_name;
	var $obj_image_type;
	var $obj_original_image;
	var $obj_image_width;
	var $obj_image_height;
	// needed fo the nieuw image
	var $obj_new_name;
	var $obj_create_image;

	function Getimage ($imagename, $str_image_path, $image_link, $image_width = False) {
		
		$this->obj_image_path = $str_image_path;	
		if ($image_link) {
			$str_image_name = basename($image_link);
			$str_image_ary = explode(".", $str_image_name);
	
			$this->obj_image_name = $str_image_ary[0];
			$this->obj_image_type = $str_image_ary[1];
		}
		
		if ($imagename) {
			$this->obj_new_name = $imagename;
		} else {
			$this->obj_new_name = $this->obj_image_name;
		}

		$this->Setimage($image_link);
		$this->makeimage($image_width);
	}
	function Setimage ($image_link) {
	
		if($this->obj_image_type == "jpg") {
			$this->obj_original_image = @imagecreatefromjpeg($image_link);
		} else if ($this->obj_image_type == "gif") {
			$this->obj_original_image = @imagecreatefromgif($image_link);		
		} else if ($this->obj_image_type == "png") {
			$this->obj_original_image = @imagecreatefrompng($image_link);
		}
		
		if($this->obj_original_image) {
			$this->obj_image_width = imagesx($this->obj_original_image);
			$this->obj_image_height = imagesy($this->obj_original_image);
			
			$this->obj_create_image = True;
		} else {
			$this->obj_create_image = False;
		}
	}
	function makeimage($image_width) {
	
		if ($this->obj_create_image) {
		
			if($image_width) {
				$percent = $this->obj_image_width / $image_width;
				$int_width = $this->obj_image_width / $percent;
				$int_height = $this->obj_image_height / $percent;
			} else {
				$int_width = $this->obj_image_width;
				$int_height = $this->obj_image_height;
			}
		
			$newimage = imagecreatetruecolor($int_width, $int_height);
			imagecopyresized($newimage,$this->obj_original_image,0,0,0,0,$int_width, $int_height,$this->obj_image_width,$this->obj_image_height);	
			imagejpeg($newimage, $this->obj_image_path . $this->obj_new_name . ".jpg", 100);
		}
	}
	function makeimagethumb ($str_image_thumb_path, $int_thumbsize) {
	
		if($this->obj_create_image) {
			if($this->obj_image_width < $this->obj_image_height) {
				$percent = $this->obj_image_width / $int_thumbsize;
			} else {
				$percent = $this->obj_image_height / $int_thumbsize;
			}
				
			$widthnew = $this->obj_image_width / $percent;
			$heightnew = $this->obj_image_height / $percent;
		
			$newimage = imagecreatetruecolor($widthnew, $heightnew);
			imagecopyresized($newimage, $this->obj_original_image,0,0,0,0,$widthnew,$heightnew,$this->obj_image_width,$this->obj_image_height);
			imagejpeg($newimage, $str_image_thumb_path . $this->obj_new_name . ".jpg", 100);	
		}
	}
	function imagename() {
		if($this->obj_create_image) {
			return $this->obj_new_name;
		} else {
			return FALSE;
		}
	}
	
}

?>