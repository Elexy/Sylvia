<?
include ("include.php");
// get nutton input from form
$bl_submit = GetSetFormVar("submit");
$productid = GetSetFormVar("productid",TRUE);
$str_type = GetSetFormVar("type",True,True,'type');

$formname='productmaintform';
// Print default Iwex HTML header.
printheader ("Productrelaties", 'PRODmaint', TRUE);

echo "<BODY ".get_bgcolor().">";

echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
echo "<INPUT TYPE='hidden' NAME='productid' VALUE='$productid'>";
echo "<INPUT TYPE='hidden' NAME='type' VALUE='$str_type'>";

//set correct DB
$DB_iwex = new DB();

printIwexNav();
//get some productdata
$productmain_sql = "SELECT * FROM current_product_list WHERE productid = '$productid';";
$query = $DB_iwex->query($productmain_sql);
$obj = mysql_fetch_object($query);

//first create general table structure
echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\">\n";
echo "    <TR>\n";
echo "      <TD WIDTH='400' VALIGN=top>\n";
echo "          <TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\">\n";
echo create_row(1,"Product ID:", $obj->ProductID, "", "",0);
echo create_row(1,"Productnaam:", $obj->ProductName, "", "",1);
echo create_row(1,"Merk:", GetProductMerk($obj->MerkID), "", "",0);
echo create_row(1,"Fabrikant ID:", $obj->ExternalID, "", "",1);
echo "              <TR>\n";
echo "                <TD COLSPAN='2'>\n";
echo ShowImage($obj->ProductID,"400");
echo "                </TD>\n";
echo "              </TR>\n";
echo "              <TR>\n";
echo "                <TD COLSPAN='2'>\n";
echo "                 <INPUT TYPE='button' VALUE='Return' onclick=\"location.replace('". PRODUCT_MAINT . "?productid=$productid');\">";
echo "                </TD>\n";
echo "              </TR>\n";echo "          </TABLE>\n";
echo "      </TD>\n";
echo "      <TD VALIGN=top>\n";
echo "          <TABLE WIDTH=\"100%\" BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\">\n";
echo "              <TR>\n";
echo "                <TD>\n";
$Iframe_Width = '100%';
$Iframe_Height = '350';
$tabs= array('device;Devices..','equal;Other..','other;Alternatives');
echo tab($tabs,$str_type,$formname,'type');

echo "                </TD>\n";
echo "              </TR>\n";
If ($str_type == 'device' || !$str_type) {
    echo create_row(1,"Compatible Devices (PDA, Smartphone, etc.", "", "", "",0);
    echo "              <TR>\n";
    echo "                <TD COLSPAN='2'>\n";
    echo "                  <IFRAME SRC='product_relations.php?ProductID=$productid&Function=product_relations&parm1=device' 
                            TITLE='Compatible Devices' WIDTH='$Iframe_Width' HEIGHT='$Iframe_Height' FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0>                            <!-- Alternate content for non-supporting browsers -->
                            <H2>Start using Firfox or something else that supports Iframes</H2>
                            </IFRAME>"; 
    echo "                </TD>\n";
    echo "              </TR>\n";
} else if ($str_type == 'equal') {
    echo create_row(1,"Compatible with articles (no devices)", "", "", "",0);
    echo "              <TR>\n";
    echo "                <TD>\n";
    echo "                  <IFRAME SRC='product_relations.php?ProductID=$productid&Function=product_relations&parm1=acces' 
                                TITLE='Compatible with...' WIDTH='$Iframe_Width' HEIGHT='$Iframe_Height' FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0>                            <!-- Alternate content for non-supporting browsers -->
                            <H2>Start using Firfox or something else that supports Iframes</H2>
                            </IFRAME>"; 
    echo "                </TD>\n";
    echo "              </TR>\n";
} else if ($str_type == 'other') {
    echo create_row(1,"Alternative Products", "", "", "",0);
    echo "              <TR>\n";
    echo "                <TD>\n";
    echo "                  <IFRAME SRC='product_relations.php?ProductID=$productid&Function=product_relations&parm1=other' 
                                TITLE='Related to...' WIDTH='$Iframe_Width' HEIGHT='$Iframe_Height' FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0>                            <!-- Alternate content for non-supporting browsers -->
                            <H2>Start using Firfox or something else that supports Iframes</H2>
                            </IFRAME>"; 
    echo "                </TD>\n";
    echo "              </TR>\n";
}
echo "          </TABLE>\n";
echo "      </TD>\n";
echo "    </TR>\n";
echo "</TABLE>\n";
echo "</FORM>\n";
printenddoc();
?>
