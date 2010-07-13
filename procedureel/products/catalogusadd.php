<?php
$_GLOBAL["str_backdir"] = '../';

include ($_GLOBAL["str_backdir"]."include.php");
include ("catalogus_functions.php");

$str_desc = GetSetFormVar('catalogusdesc', FALSE);
$int_branches = GetSetFormVar('branche');
$int_contactID = GetSetFormVar("ContactID");

printheader ("Catalogus aanmaken");

// Print default Iwex HTML header.
echo "<BODY><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"catalogcreate\">\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();
echo "<TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
      <TR>
        <TD WIDTH='30%' VALIGN='top'>
        <TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <TR>
                <TD><img src=\"".IMAGES_URL."blockleft.gif\" width=\"3\" height=\"25\" alt=\"\"></TD>
                <TD class=\"blocktitle\" width=\"100%\" background=\"".IMAGES_URL."blockback.gif\">Catalogus Aanmaken</TD>
                <TD><img src=\"".IMAGES_URL."blockright.gif\" width=\"3\" height=\"25\" alt=\"\"></TD>
              </TR>
              <TR> 	
                <TD VALIGN='top' class=\"blockbody\" colspan='3'>
                    <TABLE border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
                        <TR>
                            <TD>";
                            // adds catalog with a new name to the table catalogus
								if (isset($_POST['invoeren']) 
									&& 
									$int_contactID
									&&
									$_POST['catalogusdesc']) {
									$bl_inserted = CreateCatalog($int_contactID,
																$_POST['catalogusdesc']);
									if($bl_inserted) {
											echo "<br>Catalogus Aangemaakt<br>";
									}
								}

                                echo "Voer een omschrijving in voor de te maken catalogus.<BR>
								 	  <input type=\"text\" size=40 name=\"catalogusdesc\" value=\"$str_desc\"> <BR>
                                
                           </TD>
                        </TR>
						<tr>
							<TD>Company ID<INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"4\" CLASS=\"form\" value=\"".$int_contactID."\"><Br>Name ";
		  					echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "catalogcreate.ContactID", "cust");
		  echo "		    </TD>
				       </tr>
						<TR>
                            <TD>
                                <input type=\"submit\" name=\"invoeren\" value=\"Invoeren\">
				  			</td>
						</TR>
				  		<TR>
                            <TD WIDTH='300'>
								<a href=".CATALOG.">Terug &lt;&lt;&lt;</a><BR>
                            </TD>
                        </TR>		
				    </table>
			   </td>
			   </tr>
			</table>
				  <Td>".show_table("SELECT CatalogusID AS CatID, catalogus.ContactID, contacts.CompanyName, catalogusdesc AS Naam 
				  					FROM catalogus
				  					LEFT JOIN contacts ON catalogus.ContactID = contacts.ContactID")."
			</td>	  
		</tr>
				  
		</table>";
echo "</FORM>\n";
		  

printenddoc();

?>