<?php

/**
 * getrecords.php
 * Get the requested record set
 *
 * @version $Id: getrecords.php,v 1.17 2006-07-04 14:28:30 iwan Exp $
 * @copyright 2004
 **/

include ("include.php");

$bl_auto_set = isset($_GET["autoset"]) ? $_GET["autoset"] : TRUE;
$bl_submit = GetSetFormVar("submit");
$bl_auto_submit = isset($_GET["autosubmit"]) ? $_GET["autosubmit"] : FALSE;

$int_customerID = isset($_SESSION["current_order_customerID"]) ? $_SESSION["current_order_customerID"] : NULL;

// Print default Iwex HTML header.
printheader (COMPANYNAME . " select record", "GetRecords");

echo "<BODY ><FORM METHOD=\"get\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"selectform\">\n";

$string_no = $_GET["string_no"];
$str_auto_submit = "";

if (isset($_SESSION["str_getrecordsql$string_no"])) {

	   $str_sql = $_SESSION["str_getrecordsql$string_no"];
	   echo "Zoek: <INPUT TYPE=\"text\" NAME=\"docsearch\" SIZE=\"20\" CLASS=\"form\" value=\"".$_GET["docsearch"]."\">";
	   echo "<INPUT TYPE=\"hidden\" NAME=\"docvar\" SIZE=\"20\" CLASS=\"form\" value=\"".$_GET["docvar"]."\">";
	   echo "<INPUT TYPE=\"hidden\" NAME=\"string_no\" CLASS=\"form\" value=\"$string_no\">\n";
	   echo "<INPUT TYPE=\"hidden\" NAME=\"autoset\" CLASS=\"form\" value=\"$bl_auto_set\">\n";
	   
	   $str_sql = preg_replace("/".GETRECORDSEARCH."/", $_GET["docsearch"], $str_sql);
       $resultsearch = MYSQL_QUERY($str_sql)
	   	   or die("<br>Ongeldige query: " .$str_sql. "<br>mysql error" . mysql_error());
       $numbersearch = mysql_Numrows($resultsearch);
       if ($bl_submit) {
        $returnvar = '';
        while($obj = mysql_fetch_array($resultsearch)) {
            $Checkname = "Check".$obj->ProductID;
            if ($Checkname && GetCheckbox($Checkname)) {
                $returnvar .= $obj->ProductID;
            }
        }
        echo $returnvar;
        //onClick=\"top.opener.document.". $_GET["docvar"] .".value = '$value';window.close();\"
       }  
	   
       echo '<table border=1 cellspacing=0 cellpadding=2 class="blockbody" width="100%">';
       echo "<tr>\n";
	   
	   $int_record_id_ofset = 0;
       $int_numoffields = mysql_num_fields($resultsearch);
       for ($i = 0; $i < $int_numoffields; $i++){
           echo '<th class="menubar" >';
			if (mysql_field_name($resultsearch, $i) == "stock") {
				echo mysql_field_name($resultsearch, $i) . "/ Free" ;
			} else {
				echo mysql_field_name($resultsearch, $i);
			}
		   if (mysql_field_name($resultsearch, $i) == $_SESSION["str_getrecord_id$string_no"]) {
		       $int_record_id_ofset = $i;
		   }
           echo '</th>';
       }
       echo "</tr>\n";

	   $int_rowcnt = 0;
       $bl_one_record_id = FALSE;
       $int_last_record_id = INVALID;
		if ($bl_auto_submit) {
			$str_doc = explode('.',$_GET["docvar"]);
			if ($str_doc[0] == 'customer') 
				$str_auto_submit = "if(top.opener.document.".$str_doc[0].".update_var)top.opener.document.".$str_doc[0].".update_var.value='1';
									top.opener.document.".$str_doc[0].".submit();";
		}
	   
       while($row = mysql_fetch_row($resultsearch)) {

         if (($int_rowcnt%2)==0) { $bgcolor="#FFFFFF"; } else { $bgcolor="#EAEAEA"; }
           echo "<tr bgcolor=\"$bgcolor\">";

		 $i =0;	
         $productID = '';
         foreach($row as $key => $value) {
           // Right align the number fields;
           if (is_numeric($value)||!$value) {
             $align = "align=\"right\"";
           } else {
             $align = "";
           }
		   echo "<td $align>";
           $meta = mysql_fetch_field($resultsearch,$key);
		   if ($i++ == $int_record_id_ofset) {
               if ($int_last_record_id == INVALID) {
                   $int_last_record_id = $value;
                   $bl_one_record_id = TRUE;
               } else if ($int_last_record_id != $value) {
                   $bl_one_record_id = FALSE;
               }
		       echo  "<a href=\"javascript:void(0)\" onClick=\"top.opener.document.". $_GET["docvar"] .".value = '$value';$str_auto_submit window.close();\">$value</a>";
               $productID = $value;
		   } else {
				if ($meta->name == "*") {
					echo "<INPUT TYPE='checkbox' NAME='Check$productID' 
                    onclick=\"top.opener.document.". $_GET["docvar"] .".value = top.opener.document.". $_GET["docvar"] .".value + ',$productID'\";>";
				} else {
					if ($meta->name == "stock") {
						echo "<FONT SIZE='1' COLOR='#FF0000'>$value</FONT> / ";
					} else {
						echo $value;
					}
				}
				// heavierstuff only when the number is below 20
				if ($numbersearch <= CPU_HEAVY_LIMIT){
					If ($meta->name == "stock")  {
						echo getfreestock($productID);
					} else if ($meta->name == "margin"
								&&
								$int_customerID) { //only get margin when customerID is given
						echo "<SMALL>" . GetMargin($productID, $int_customerID) . "</SMALL>"; 
					} else if ($meta->name == "price") {
						echo GetSpecialProductPrice(
              $productID,
	            1,
              $int_customerID,
              date_create());
					}
				}
		   }
		   echo "</td>";
		   $int_rowcnt++;
         }
         echo "</tr> \n";
       }
       
       if ($bl_one_record_id && $bl_auto_set) {
           echo "<SCRIPT>
                 top.opener.document.". $_GET["docvar"] .".value = '$int_last_record_id';
                 $str_auto_submit
				 window.close();\n</SCRIPT>";
       }
       echo "</table>";
} else {
	echo "SQL Select string is onbekend";
}

echo "</FORM>\n";

printenddoc();
?>
