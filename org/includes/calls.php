<?php

/**
 * calls.php
 *
 * @version $Id: calls.php,v 1.6 2006-07-04 14:28:31 iwan Exp $
 * @copyright  $Date: 2006-07-04 14:28:31 $:
 **/

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';

/*********************************************************
 * Function     : ShowCallDetails
 * Input        : bl_submit, TRUE when the data should be updated
 *                int_contactID, The id of the customer
 * Returns      : A complete formatted string that contains the call information.
 *********************************************************/
function ShowCallDetails($bl_submit, $int_customerID) {
    $str_return = '';
    $DB_iwex = new DB();
    $sql_calls = "SELECT CallDate, CallTime, Subject, Notes, employees.FirstName 
                  FROM calls 
                  LEFT JOIN employees ON calls.employee = employees.EmployeeID 
                  WHERE ContactID = '$int_customerID'
                  ORDER BY CallID DESC";
    
    if ($bl_submit 
        && $int_customerID) {
        
		if ($_POST["call_SubjectNew"]) { 
            //When new records have been added, insert these first
            $sql_insert = "INSERT INTO calls SET 
                           ContactID = $int_customerID, 
                           employee = '".$_POST["call_employeeNew"]."', 
                           CallDate = '".$_POST["call_dateNew"]."',
                           Subject = '".$_POST["call_SubjectNew"]."',
                           Notes = '".$_POST["call_notesNew"]."' ";
            $DB_iwex->query($sql_insert);
        }        
    } // End update

    // Get the data.
    $qry_select = $DB_iwex->query($sql_calls);

    $str_return .= "<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" class=\"blockbody\">\n";
    $str_return .= "<tr><th>Datum</th><th>Door</th><th>Onderwerp</th><th>Notes</th></tr>\n";

    // always display a new empty detail record at the bottom
    $str_return .= "<tr>\n";
    $str_return .= "<tr>\n";
    $str_return .= "<td><input size=\"14\" name=\"call_dateNew\" type=\"text\" value=\"".date("Y-m-d H:i")."\"></td>\n";
    $str_return .= '<td>'.makelistbox("SELECT EmployeeID, FirstName FROM employees order by FirstName","call_employeeNew","EmployeeID","FirstName",$GLOBALS["employee_id"]).'</td>'."\n";    
    $str_return .= "<td><input size=\"20\" name=\"call_SubjectNew\" type=\"text\" value=\"\"></td>\n";
    $str_return .= "<td><textarea name=\"call_notesNew\" cols=\"50\" rows=\"2\"></textarea></td>\n";
    $str_return .= "</tr>\n";
    
    while ($obj = mysql_fetch_object($qry_select)) {
        $str_return .= "<tr>\n";
        $str_return .= "<td>".date("Y-m-d H:i", strtotime($obj->CallDate))."</td>\n";
        $str_return .= "<td>$obj->FirstName</td>\n";
        $str_return .= "<td>$obj->Subject</td>\n";
        $text = strpos($obj->Notes, "<HTML>") ? $obj->Notes : str_replace("\n", "<br>", $obj->Notes);
        $str_return .= "<td>$text</td>\n";
        $str_return .= "</tr>\n";
    }
    mysql_free_result($qry_select);
    
    $str_return .= "</TABLE>\n";
    
    return $str_return;
}

// Get all the URL variable we need.
$bl_submit = isset($_POST["submit"]) ? TRUE : FALSE;
$int_customerID = isset($_POST["customerID"]) ? $_POST["customerID"] : FALSE;
$int_customerID = (isset($_GET["customerID"]) && !isset($_POST["customerID"])) ? $_GET["customerID"] : $int_customerID;
$bl_print = isset($_POST["print"]) ? TRUE : FALSE;

// Print default Iwex HTML header.
printheader (COMPANYNAME . " calls screen", "calls", !$bl_print);

if ($bl_print) {
    echo "<body onLoad=\"print();location.replace('".$_SERVER['PHP_SELF']."?customerID=$int_customerID');\">\n";
} else {
    echo "<body><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"adresform\"\">\n";
	// Used for calendar function.
	echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
}
    
    echo "<INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Update\" CLASS=\"button\">";
    echo " voor klant: ".getcontactname($int_customerID);
    echo "<INPUT TYPE='hidden' NAME='customerID' VALUE='$int_customerID'>";

    echo ShowCallDetails($bl_submit, $int_customerID);	
    
echo "</FORM>\n";

printenddoc();

?>
