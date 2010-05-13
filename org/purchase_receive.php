<?
/*
 * purchase_maint.php
 *
 * @version $Id: purchase_receive.php,v 1.2 2006-07-04 14:28:30 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");
// get all the form vars
// integer vars
$int_supplier = isset($_REQUEST["supplier"]) ? $_REQUEST["supplier"] : FALSE;
// boolean vars 
$bl_update = isset($_POST["update"]);
$bl_override = GetCheckbox('override');
// char vars

// set Db connect
$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " producten ontvangst");

    
echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"po_maint\">\n";
echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>";

printIwexNav();


// Set cursor on the new entry.		  
echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";

if ($int_supplier) {
    echo "override".MakeCheckbox('override',$bl_override)."<INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\">\n";
    echo "<INPUT TYPE=\"button\" NAME=\"list\" onClick=\"location.replace('purchase_sel.php');\" VALUE=\"Return\">\n";
    echo "<input type=hidden name='supplier' value='$int_supplier'>";
    echo ShowPoDetails($bl_update, FALSE, $bl_override, $int_supplier);    
} else {
    echo "Geen supplier ID given";
}

echo "</FORM>";
printenddoc();

?>
