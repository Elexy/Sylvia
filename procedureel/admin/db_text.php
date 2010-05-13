<?
$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';

$formname = "text_form";

$str_query = null;

$int_id = GetSetFormVar('id');
$int_id = !$int_id ? $_POST["textid"] : $int_id;
$int_catid = GetSetFormVar('categoryid');
$bl_update = GetSetFormVar('update');
$str_description = GetSetFormVar('subject');
$int_categoryID = GetSetFormVar('categoryID');
$int_languageID = GetSetFormVar('languageID');
$str_text = GetSetFormVar('text');
$bl_new = GetSetFormVar('new');
$bl_new = isset($_POST["new"]) ? $_POST["new"] : FALSE;
$bl_newcat = GetSetFormVar('newcat');
$bl_newcategory = isset($_POST["newcategory"]) ? $_POST["newcategory"] : FALSE;
$str_newcat = isset($_POST["newcat"]) ? $_POST["newcat"] : FALSE;
//start with empty result
$html_table = '';

if ($str_newcat && $bl_update) {
	if (GetField("SELECT text_categoryID FROM text_categories WHERE name = '$str_newcat'")) {
		$str_alert = "Category <b>$str_newcat</b> bestaan al<BR><BR>";
	} else {
		$str_alert = "Category <b>$str_newcat</b> inserted<BR><BR>";
		$db_iwex->query("INSERT INTO text_categories SET name='$str_newcat'");
	}
}

if ($bl_new) {
    $db_iwex->query("INSERT INTO text SET subject='new', text='niets';");
	$int_id = GetField("SELECT textID FROM text WHERE subject='new'");
} else if ($bl_update
			&&
			$str_description) { 
	$db_iwex->query("UPDATE text 
                     SET subject='$str_description',
						 categoryID = '$int_categoryID',
						 languageID = '$int_languageID',
						 text='$str_text' 
                     WHERE textID='$int_id'");
}

$str_boxheader = "Text zoeken";
if ($bl_newcategory) {
	$str_boxheader = "Creating a new category";
}

	// Print default Iwex HTML header.
	printheader ("Text Scherm");

	echo "<BODY ".get_bgcolor().">";     

	printIwexNav();

	echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='$formname'>\n";
	echo "<INPUT TYPE='hidden' NAME='textid' VALUE='$int_id'";

	echo "
	<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
	<tr>
	<td WIDTH='20%' VALIGN='top'>
	<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
		  <tr>
			<td><img src=\"".IMAGES_URL."blockleft.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
			<td class=\"blocktitle\" width=\"100%\" background=\"".IMAGES_URL."blockback.gif\">$str_boxheader</td>
			<td><img src=\"".IMAGES_URL."blockright.gif\" width=\"3\" height=\"25\" alt=\"\"></td>
		  </tr>
		  <tr> 	
			<td VALIGN='top'width=\"100%\" colspan=\"3\" class=\"blockbody\">
				<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "            <tr>
					   <td WIDTH=\"200\" colspan=\"2\" VALIGN=\"top\">";
						echo $str_alert;
						if (!$bl_newcategory) {
							echo "Texten<br>".makelistbox('SELECT text_categoryID, name
																FROM text_categories
																ORDER BY name',
																'categoryid',
																'text_categoryID',
																'name',
																$int_catid,
																'',
																$formname.'.submit()');
						if ($int_catid) {
								echo "Languages<br>".makelistbox("SELECT textID, subject, language
															FROM text
															LEFT JOIN languages ON languages.languageID = text.languageID
															WHERE categoryID = '$int_catid'
															ORDER BY subject",
															'id',
															'textID',
															'language',
															$int_id,
															'',
															$formname.'.submit()');
						}
						} else {
							echo "<INPUT TYPE='text' NAME='newcat'>";
						}
	echo "	   </td>
					</tr>";
	if (isset($supervisor) && $supervisor) {
        echo "			<tr>
	                    <td colspan = \"3\">
							<INPUT TYPE='submit' NAME='newcategory' VALUE='Nieuwe Category'>

	                        <input type='submit' NAME='new' value='New text'>
							</td>
						</tr>
                        <tr>
							<td>
							<INPUT TYPE=\"submit\" name='update' VALUE=\"Update\">
						</td>
	                </tr>\n";
    }
	echo "			</table>
				</td>
		</tr>
	</table>
	<script TYPE='text/javascript' language='JavaScript'>document.$formname.id.focus();</script>
	</td>
	<td VALIGN='top' WIDTH='80%'>";	
    if ($int_id) {
        $str_query = GetField("SELECT text FROM text WHERE textID='$int_id'");
		$int_categoryid = GetField("SELECT categoryID FROM text WHERE textID = $int_id");
		$int_languageid = GetField("SELECT languageID FROM text WHERE textID = $int_id");
    }
	if ($str_query) {
        echo AddEditorScript('text_description');
       echo "<BR><BR>
			 Category:" . makelistbox('SELECT text_categoryID, name
									   FROM text_categories',
									  'categoryID',
									  'text_categoryID',
									  'name',
									   $int_categoryid
									 ) .
       		"Language:" . makelistbox('SELECT languageID, language
									   FROM languages',
									  'languageID',
									  'languageID',
									  'language',
									   $int_languageid
									 ). "<BR><BR>";
        echo "Subject: <input type='text' size=40 name='subject' value='".GetField("SELECT subject FROM text WHERE textID='$int_id'")."'><BR><BR>";
		echo "<TEXTAREA COLS='80' ROWS='40' id=\"text_description\" NAME='text'>$str_query</TEXTAREA>";
		echo "<INPUT TYPE='hidden' NAME='update_query_var'>";
	} // end if str_query
	echo " 	</td>\n
			</tr>\n
			</table>\n
			</tr></td>\n
			</table>\n
			</form>\n";

	printenddoc();

?>
