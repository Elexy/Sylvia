<?php
$_GLOBAL["str_backdir"] = '../';

include ($_GLOBAL["str_backdir"]."include.php");

$formname = "sellthrough";

$str_format = GetSetFormVar('format');

// get nutton input from form
$bl_update = isset($_POST["update_var"]) ? $_POST["update_var"] : FALSE;
$bl_update = isset($_POST["Update"]) ? TRUE : $bl_update;

//start with empty result
$html_table = ShowSellThrough($formname, 
							&$arr_data, 
							&$arr_header,
							NULL,
							NULL,
							NULL,
							TRUE);

//print_r($arr_data);

//if excel button was pressed, start excel export
if (GetSetFormVar("button_excel")) {	
	include('../excelfile.php');
	
} else {
	// Print default Iwex HTML header.
	printheader ("Sell through");

	echo "<BODY ".get_bgcolor().">";     
	
	printIwexNav();

	echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
	
	echo "<INPUT TYPE=\"submit\" NAME=\"Update\" CLASS=\"button\" value=\"Update\">&nbsp;";
	echo "<INPUT TYPE=\"submit\" NAME=\"button_excel\" CLASS=\"button\" value=\"Excel\" OnClick='submit();'>&nbsp;";
	if ($html_table) {
		echo $html_table;
	} else {
		echo "<br>No result from query";
	}
		
} 

printenddoc();


