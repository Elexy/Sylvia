<? 
/**
 * Help.php
 *
 * Will display help information for every file in the application.
 * @version $Id: help.php,v 1.3 2005-05-19 12:21:59 iwan Exp $
 * @copyright  $Date: 2005-05-19 12:21:59 $:
 **/

include ("include.php");

$str_filename = GetSetFormVar("file", TRUE);
$bl_edit = GetSetFormVar("edit");
$str_text = isset($_POST["text"]) ? $_POST["text"] : FALSE;
$str_title = isset($_POST["title"]) ? $_POST["title"] : FALSE;
$bl_submit = isset($_POST["submit"]);

$sql = "SELECT help_text.title, text_Dutch, FirstName, change_date
        FROM help_text
        LEFT JOIN employees ON last_changed_by = EmployeeID
        WHERE file = '$str_filename'";

$qry = $db_iwex->query($sql);
if (strlen($str_text) > 10 && $str_title) {
    $sql_update = " help_text
                   SET title = '$str_title',
                       text_Dutch = '$str_text', 
                       last_changed_by = ' $employee_id',
                       change_date = NOW() ";
    if (mysql_num_rows($qry)) {
        // Records are there update
        $db_iwex->query("UPDATE $sql_update WHERE file = '$str_filename'");
    } else {
        // No records found insert
        $db_iwex->query("INSERT INTO $sql_update, file = '$str_filename'");
    }
} else if ($bl_submit) {
    $bl_edit = TRUE;
}

// Get update fields.
$qry = $db_iwex->query($sql);

$date = "";
$str_name = "";

while ($obj = mysql_fetch_object($qry))
{
    $str_title = $str_title ? $str_title : $obj->title;
    $str_text = $str_text ? $str_text : $obj->text_Dutch;
    $str_name = $obj->FirstName;
    $date = $obj->change_date;
}
mysql_free_result($qry);

// Print default Iwex HTML header.
printheader ("Help: ");

echo "<BODY ".get_bgcolor().">";     
echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"helpform\">\n";

//echo "$bl_edit || $str_title || $str_text";

if ($bl_edit || strlen($str_text) <= 10 || strlen($str_title) < 3) {
    //echo $_SERVER["HTTP_USER_AGENT"];
    echo AddEditorScript('helptext');
    
    echo "<h1>Title: <input type=text  size=\"50\" name=title value='$str_title'>";
    echo " <input type=submit name=submit value=Update></h1>";
    echo "<TEXTAREA NAME=\"text\" id=\"helptext\" style=\"WIDTH: 100%;height: 300pt;\" CLASS=\"form\">";
    echo "$str_text";
    echo "</TEXTAREA>";
    if ($date) echo "Pagina laatste keer aangepast op $date door $str_name.";
} else {
    echo "<table border=0><tr><td width=100%><h1>$str_title</h1></td>";
    echo "<td><input type=submit name=edit value=Edit></td></tr></table>";    
    echo "<p>$str_text</p>\n";
    echo "Pagina laatste keer aangepast op $date door $str_name.";
}

echo "</FORM>\n"; 

printenddoc();

?>
