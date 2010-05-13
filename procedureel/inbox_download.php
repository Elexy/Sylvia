<?php

include 'include.php';

/* the new line delimiter of your field xp_body_text field in mysql */
$return_sql = "\r\r";
/* the new line delimiter of your mail program */
$return_file = "\n";

$id = GetSetFormVar("id");

// Print default Iwex HTML header.
//printheader ("Get E-mail kopy");

//echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n"; // start form to remember parameters , they will be submitted 

//printIwexNav();

$xeoport = new DB($GLOBALS["ary_config"]["hostname"],
                  $GLOBALS["ary_config"]["maildatabase"], 
                  $GLOBALS["ary_config"]["username"],
                  $GLOBALS["ary_config"]["password"]); 
                  
$sql_result = $xeoport->query("SELECT * 
                               FROM `".$_SESSION['MAILTABEL']."`
                               WHERE xp_nr='$id'");

/*__________________ construct mail-file ___________________________*/

$mail_raw_object = mysql_fetch_object($sql_result);
$mail_raw_text = $mail_raw_object->xp_header_raw . $mail_raw_object->xp_body_raw;
$mail_raw_text = str_replace("$return_sql", "$return_file", $mail_raw_text);

/*if ($mail_raw_text) {
    $str_file_loc = $_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path']."/".MAIL_TEMP_DIR;
	chdir($str_file_loc);
	$mail_handle = fopen("$id.".MAIL_EXTENSION, "wb");
	$mail_written_ok = fwrite($mail_handle, $mail_raw_text);
	fclose($mail_handle);
}
echo "Get your outlook mailfile <a href='".docroot."/".MAIL_TEMP_DIR."/$id.".MAIL_EXTENSION."'>here</a>.";
*/
    header("Content-type: application/vnd.ms-outlook");

    # replace excelfile.xls with whatever you want the filename to default to
    header("Content-Disposition: attachment; filename=$id.".MAIL_EXTENSION);
    header("Pragma: no-cache");
    header("Expires: 0");

    echo $mail_raw_text;
?>
