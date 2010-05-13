<? 

include ("include.php");

$int_custid = GetSetFormVar('custid',FALSE);
$str_email = GetSetFormVar("email", FALSE);
$str_subject = GetSetFormVar("subject", FALSE);
$bericht = isset($_POST["bericht"]) ? $_POST["bericht"] : FALSE;
$submit = isset($_POST["submit"]);

$iwex_db = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " betalings herinnering", "payment_mail", FALSE);

echo '<BODY>';

printIwexNav();

echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='paymentmail'>\n";

// Check if order ID is given.
if ($int_custid
    && 
	!$submit
	)
{
	$int_languageID = GetField("SELECT languageID FROM contacts WHERE ContactID = '$int_custid' ");

	//Select text to be e-mailed.
	$ary_mailtxt = Gettexten("3", 
							 $int_languageID);
	$mailtxt = $ary_mailtxt[1];
	$str_subject = $ary_mailtxt[0];
    
	$mailtxt =  preg_replace("/".DB_CUST_REPLACE_VAR."/", 
							 getcontactname($int_custid),
							 $mailtxt);
	
	$str_mail_table = ShowOpenInvoices($int_custid);
	
	$mailtxt =  preg_replace(DB_INVOICETABLE_REPLACE_VAR, 
							 $str_mail_table,
							 $mailtxt);

    $str_employee = GetField(GET_EMPLOYEE_NAME. $employee_id);

	$mailtxt =  preg_replace(DB_EMPLOYEE_REPLACE_VAR, 
							 $str_employee,
							 $mailtxt);			
							 
	if (!$str_email) {
	    $qry = $iwex_db->query("SELECT contacts.email, Personen.email AS pemail
							    FROM contacts 
							    LEFT JOIN Personen ON contacts.ContactID = Personen.ContactID 
                                    AND (Personen_type_ID = 5 
                                         OR
                                         Personen_type_ID = 9)
							    WHERE contacts.ContactID = '$int_custid' 
                                ORDER BY Personen_type_ID = 9 DESC");
		if ($obj = mysql_fetch_object($qry)) {
			$str_email = $obj->pemail ? $obj->pemail : $obj->email;
			mysql_free_result($qry);
		}
	}
	
    $mailtxt .= printbankinfo($ary_languages[GetField("SELECT language FROM languages WHERE languageID = $int_languageID")]);
}

// Check if it is ok to be e-mailed.
if ($submit) {
    $name = $GLOBALS["ary_config"]["emailname.admin"];
    $myemail = $GLOBALS["ary_config"]["email.admin"];
	
    $bericht = stripslashes($bericht);
    $mailtxt = $emailheader . "<body>\n" . $bericht . "<br></body></html>";
    
    // The file will be send with mail to the invoice mail!
    $SMTPMail = new PHPMailer();
    $SMTPMail->From     = $myemail;
    $SMTPMail->FromName = $name;
    if (EXTERNAL_SMTP_SERVER) {
        $SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
        $SMTPMail->Mailer   = "smtp";
    } else { // Use normail PHP mail().
        $SMTPMail->Mailer   = "mail";
    }
    $str_asci_body = strip_tags($bericht);
    $SMTPMail->Body     = $mailtxt;
    $SMTPMail->AltBody  = $str_asci_body;
	$elements = preg_split("/[,;]+/", $str_email);
	for ($i = 0; $i < count($elements); $i++) {
		$SMTPMail->AddAddress($elements[$i]);
	}
    $SMTPMail->AddCC($myemail, $name) ;
    $SMTPMail->Subject  = $str_subject;
    //echo "<pre>$str_asci_body</pre>";
    
    if ($SMTPMail->Send()) {
    //if (mail($str_email, $str_subject, $mailtxt,"From: $name <$myemail>\n
	//											 Cc:" . $GLOBALS["ary_config"]["email.admin"] . "\n
	//											 Content-type: text/html")){
      $sendok = "Ok";
      $sql_insert = "INSERT INTO calls SET 
                           ContactID = $int_custid, 
                           employee = '$employee_id', 
                           CallDate = '".date("Y-m-d H:i")."',
                           Subject = '$str_subject',
                           Notes = '".addslashes("Email verzonden aan: $str_email<hr>".$mailtxt)."'";
       $iwex_db->query($sql_insert);
    } else {
      $sendok = "<b>Failed</b>";
    }
}

if (!$submit) echo AddEditorScript('bericht');

echo "<TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\" width='100%'>\n";
	echo "<TR>\n";
if (!$submit) {
	echo "<TD><input type=hidden name=custid value='$int_custid'><INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\"Verzend\" CLASS=\"button\"></TD>\n";
	echo "<TD width='100%'>Email: <input type=text NAME=\"email\" SIZE=25 CLASS=\"form\" value='$str_email'></TD>\n";
	echo "</TR>\n";
	echo "<TR>\n";
	echo "<TD>Onderwerp</TD>\n";
	echo "<TD><INPUT TYPE=\"text\" NAME=\"subject\" VALUE=\"$str_subject\" size=40></td>\n";
	echo "</tr><tr>";
	echo "<td colspan=2><TEXTAREA NAME=\"bericht\" id=\"bericht\" ROWS=40 COLS=80 style=\"WIDTH: 100%;\" CLASS=\"form\">";
	echo $mailtxt;
	echo "</TEXTAREA></TD>\n";
} else {
	echo "<td>Email verzend status </td><td>$sendok</td>";
}
echo "</TR>\n";
echo "</TABLE>\n"; 
echo "</FORM>\n"; 

printenddoc();
?>
