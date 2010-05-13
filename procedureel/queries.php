<?
include ("include.php");

$formname = "Query_form";

$str_query = null;
$str_format = GetSetFormVar('format');

$str_sortfield = GetSetFormVar('sortfield',TRUE);
$str_orderby = GetSetFormVar('orderby',TRUE);
$str_id = GetSetFormVar('id');
$bl_update_query = GetSetFormVar('update_query_var');
$bl_new_query = GetSetFormVar('new_q');
$bl_del_query_var = GetSetFormVar('del_query_var');
$str_new_query = GetSetFormVar('queryfield');
$str_new_query_name = GetSetFormVar('query_name');

//start with empty result
$html_table = '';

if ($bl_new_query) {
	$db_iwex->query("INSERT INTO query SET name='new', statement='SELECT';");
	$str_id = GetField("SELECT ID FROM query WHERE Name='new'");
	echo $str_id;
} else if ($bl_update_query
			&&
			$str_new_query) 
{ 
	$db_iwex->query("UPDATE query SET name='$str_new_query_name', statement='".addslashes($str_new_query)."' WHERE ID='$str_id'");
} else if ($bl_del_query_var) {
	$db_iwex->query("DELETE FROM query WHERE ID='$str_id';");
	$str_id = GetField("SELECT ID FROM query;");
}

if ($str_id) {
	// now get new / updated / old query
	$get_qry_str = 'SELECT DISTINCTROW statement FROM query	WHERE ID = "'. $str_id . '"';
	$str_query = stripslashes(GetField($get_qry_str));

	if ($query_result = MYSQL_QUERY($str_query)) {
		$x=0;
		$html_table =  "<table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\" width=\"100%\">\n";
		///titel van de tabel met gevonden zoekresultaten.
		$html_table .=  "<TR>\n";
		for ($i = 0; $i < mysql_num_fields($query_result); $i++){
			$str_fieldname = mysql_field_name($query_result, $i);
			$html_table .=  "<TH BGCOLOR='#333366'><B>";
				if ($str_fieldname == "image") {
					$html_table .=  $str_fieldname;
				}else if ($str_fieldname != $str_sortfield) {
					//echo make_link($str_keyword, $str_prodbrand, $str_prodcategory, $query_result, $str_fieldname, "ASC");     
					$html_table .=  $str_fieldname. "</A>";
				}else if ($str_fieldname == $str_sortfield) {                
					if ($str_orderby == "ASC") { 
						//echo make_link($str_keyword, $str_prodbrand, $str_prodcategory, $query_result, $str_fieldname, "DESC");
						$html_table .=  "" .$str_fieldname. "</A><IMG SRC=\"/images/down.gif\" height=\"10\" width=\"10\">";
					}else {
						//echo make_link($str_keyword, $str_prodbrand, $str_prodcategory, $query_result, $str_fieldname, "ASC");
						$html_table .=  "" .$str_fieldname. "</A><IMG SRC=\"/images/up.gif\" height=\"10\" width=\"10\">"; 
					}
				}
			$html_table .=  "</B></TH>";
		}
		$html_table .=  "</TR>\n";
		while($row = mysql_fetch_row($query_result)) {
			if (($x%2)==0) { $bgcolor="#FFFFFF"; } else { $bgcolor="#EAEAEA"; }
			$html_table .=  "<TR BGCOLOR=$bgcolor>\n";
			foreach($row as $key => $value) {
				// Right align the number fields;
				if (is_numeric($value)) {
					$align = "ALIGN=\"right\"";
				} else {
					$align = "";
				}
				// get Meta Field info, to cheack name
				$meta = mysql_fetch_field($query_result,$key);
				if (!$meta) { // what if there is no meta info on the field??
				// don't know...
				}  
				if ($meta->name == "ProductID")  {
                    $html_table .= "<td $align><a href=\"". PRODUCT_MAINT . "?productid=$value\">$value</a></td>";
                    $rowID = $value;
                } else if (strtoupper($meta->name) == "CONTACTID")  {
                    $html_table .= "<td $align><a href=\"". CONTACTS . "?custid=$value\">$value</a></td>";
                    $rowID = $value;
                } else if (strtoupper($meta->name) == "ORDERID")  {
                    $html_table .= "<td $align><a href=\"". ORDERS . "?orderID=$value\">$value</a></td>";
                    $rowID = $value;
                } else{
					//if field is productid field hyperlink it to productmanintenance
					$html_table .=  "<TD WIDTH HEIGHT $align>$value</TD>"; 					
				}
		   }
		   $html_table .=  "</TR> \n";
		   $x++;
		}   
		$html_table .=  "	</TABLE>\n";
	} else {
		echo mysql_error();
	}
}

if ($str_query
	&&
	$str_format == "xls") 
{
	//21 aug 06 inserted the PEAR way of doing it
	$result = mysql_query($str_query)
	or die("Ongeldige query: " . mysql_error());
	
	//name the sheet
	$str_worksheet = GetField("SELECT Name FROM query WHERE ID='$str_id'");
		
//echo $str_query; // debug
	$count = mysql_num_fields($result);

	for ($i = 0; $i < $count; $i++){
		//here we add the header
		$arr_header[] = mysql_field_name($result, $i);
	}

	$DB_iwex = new DB();
	$data_obj = $DB_iwex->query($str_query);

	//leave the header...
	$row = 1;
	while($arr_row = mysql_fetch_row($data_obj)) {
		$arr_data[$row] = $arr_row;
		$row ++;
	}


	include('excelfile.php');

} else if ($str_format == "pdf") {
	//define('FPDF_FONTPATH','font/');
	
	require('includes/html_table2pdf.php');

	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$pdf->WriteHTML($html_table);
	$pdf->Output();
} else {
	// Print default Iwex HTML header.
	printheader ("Query Scherm");

	echo "<BODY ".get_bgcolor().">";     

	printIwexNav();

	echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";

	echo "
	<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
	<tr>
	<td WIDTH='20%' VALIGN='top'>
	<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
		  <tr>
			<td><img src=\"".IMAGES_URL."blockleft.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
			<td class=\"blocktitle\" width=\"100%\" background=\"".IMAGES_URL."blockback.gif\">Producten Zoeken</td>
			<td><img src=\"".IMAGES_URL."blockright.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
		  </tr>
		  <tr> 	
			<td VALIGN='top'width=\"100%\" colspan=\"3\" class=\"blockbody\">
				<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "            <tr>
					   <td WIDTH=\"200\" colspan=\"2\" VALIGN=\"top\">
							Query<br>".makelistbox('SELECT DISTINCTROW Name, ID
													FROM query
													WHERE statement LIKE "select%"
													ORDER BY Name',
													'id',
													'ID',
													'Name',
													$str_id,
													'',
													$formname.'.submit()')."
					   </td>
					</tr>
					<tr>
						<td colspan = \"3\">Uitvoer: 
							<select name=format>
								<option value=screen>Scherm</option>
								<option value=pdf";
	if ($str_format == "pdf") echo " selected";
	echo ">PDF</option>
								<option value=xls";
	if ($str_format == "xls") echo " selected";
	echo ">XLS</option></select>
						</td>
					</tr>\n";
	if (isset($supervisor) && $supervisor) echo "
					<tr>
	                    <td colspan = \"3\">
							<INPUT TYPE='hidden' NAME='new_q'>
	                        <input type=\"button\" value=\"new query\"
								ONCLICK=\"document.$formname.new_q.value=1;
								document.$formname.submit();\">
							</td>
						</tr>\n";
    echo				"<tr>
							<td>
							<INPUT TYPE=\"submit\" VALUE=\"Run\">
						</td>
	                </tr>
					</table>
				</td>
		</tr>
	</table>
	<script TYPE='text/javascript' language='JavaScript'>document.$formname.id.focus();</script>
	</td>
	<td VALIGN='top' WIDTH='80%'>";	
	if ($str_query) {
		echo "<input type='button' value='Show/hide query' onClick='javascript:toggleMenu(\"query_area\")'>
				<A HREF='" . $_SERVER['PHP_SELF'] . "?id=" .$str_id . "'>" 
				. "Query " .$str_id . "</A>";
		echo "<TABLE ID='query_area' style=\"display:none;\">
			  <TR><TD><INPUT TYPE='text' NAME='query_name' 
				VALUE='" . GetField("SELECT name FROM query WHERE ID='$str_id'") . "'></TD></TR>";
		echo "<TR><TD><TEXTAREA COLS='80' ROWS='8' NAME='queryfield'>$str_query</TEXTAREA></TD></TR>";
		echo "<TR><TD><INPUT TYPE='hidden' NAME='update_query_var'>";
		if (isset($supervisor) && $supervisor) 
		{
			echo "<INPUT TYPE='button' VALUE='update query' NAME='update_query'
					ONCLICK=\"document.$formname.update_query_var.value=1;
						document.$formname.submit();\">";
			echo "<INPUT TYPE='hidden' NAME='del_query_var'>
				  <INPUT TYPE='button' VALUE='delete'
					ONCLICK=\"if (confirm('Deze query deleten?')) document.$formname.del_query_var.value=1;
						document.$formname.submit();\">";
		}
		echo "</TD></TR></TABLE>";
		if ($html_table) {
			echo $html_table;
		} else {
			echo "<br>No result from query";
		}
		
	} // end if str_query
	echo " 	</td>\n
			</tr>\n
			</table>\n
			</tr></td>\n
			</table>\n
			</form>\n";

	printenddoc();

}
