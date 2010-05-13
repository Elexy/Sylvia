<?php
 /*
 * stock_mutations.php
 *
 * @version $Id: stock_mut.php,v 1.4 2007-04-19 16:08:37 iwan Exp $
 * @copyright $date:
 **/
$_GLOBAL["str_backdir"] = '../';
 
include ("../include.php");

// Get all the URL variable we need.
$int_productID = GetSetFormVar("ProductID");
$int_corrected = GetSetFormVar("corrected");
$bl_add_transaction = GetSetFormVar("add_transaction");

if ($bl_add_transaction&&$int_corrected&&$int_productID) { //if user has typed number of units made and pressed submit      // first add negative transactions in the transaction database
    $Employee = GetField("SELECT FirstName FROM employees WHERE EmployeeID = '" . $GLOBALS["employee_id"] ."'");
    $sql = 'INSERT INTO inventory_transactions ' // construct main article positive insert
       . 'SET transactiondate = "'.date('Y-m-d'). '" , ProductID = '.$int_productID
       . ' , TransactionDescription = "Correction PPC: '.$Employee.'", '
       . ' UnitsReceived = '.$int_corrected;
    $result = $db_iwex->query($sql);
    // now add combi articles to the static field in product record
    $sql_product = 'UPDATE product_stock 
        SET stock = (stock+'.$int_corrected.'),
			free_stock = (free_stock+'.$int_stocklevel.')
        WHERE Product_ID = '.$int_productID;
    $product_result = $db_iwex->query($sql_product);
}

printheader ("Iwex Producten Onderhoud", 'maint', FALSE);

echo "<BODY><FORM METHOD=\"POST\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"stock_mutations\">\n";
if ($int_productID) {
    echo '<TABLE BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody" WIDTH="100%"'."\n";
    echo "         <TR>\n";
    echo "             <Th ALIGN=\"right\" >Stock (calc): </Th><Th align=left>"
                       .GetField("SELECT stock FROM product_stock WHERE Product_ID = $int_productID AND owner_id = ".OWN_COMPANYID)
                       ." (".get_stock($int_productID).")</Th>\n";
    echo "         </TR>\n";
    echo '<TR valign="top">'."\n";
    echo '    <td align="right" class="cellline">Naam: </td><td>'.GetProductName($int_productID).'</TD>'."\n";
    echo '</TR>'."\n";
    echo '<TR valign="top">'."\n";
    echo '    <td align="right" class="cellline">aantal gecorrigeerd: </td><td><INPUT TYPE="text" NAME="corrected" SIZE="20" CLASS="form">'."\n";
    echo '    <INPUT TYPE="submit" NAME="add_transaction" VALUE="Invoeren" CLASS="button"></TD>'."\n";
    echo '</TR>'."\n";
    echo '<TR valign="top">'."\n";
    $str_trdesc = date('m-d') == '12-31' ? 'Balance correction' : 'Ad hoc';
    echo '    <td align="right" class="cellline">Omschrijving: </td><td><INPUT TYPE="text" NAME="tr_description" SIZE="30" CLASS="form" VALUE="'.$str_trdesc.'">'."\n";
    echo '</TR>'."\n";
    echo '</table>'."\n"; 
}
echo "<a href='". PRODUCT_MAINT . "?productid=$int_productID'>&lt;-terug</a>";
echo " ProductID: <INPUT TYPE='text' NAME='ProductID' VALUE='$int_productID' size=6>";
echo "<INPUT TYPE='submit' NAME='submit' VALUE='Search'>";
echo "</FORM>\n";

printenddoc();
?>
