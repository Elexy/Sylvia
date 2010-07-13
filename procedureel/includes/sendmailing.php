<?php
/**
 * @version $Id: sendmailing.php,v 1.3 2007-05-14 09:59:42 iwan Exp $
 * @copyright $date:
 **/


$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';


//$bl_showlist = GetCheckbox('showlist') ? GetCheckbox('showlist') : 0;
$bl_send = isset($_POST['send']) ? $_POST['send'] : FALSE ;
$int_mailingref = isset($_REQUEST['ref']) ? $_REQUEST['ref'] : FALSE;
$bl_status = isset($_REQUEST['status']) ? $_REQUEST['status'] : FALSE;

// Print default Iwex HTML header.
printheader ("Iwex send mailing screen", "mailing", FALSE);

echo "<BODY>";

echo "<FORM NAME='mailform' METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n";
echo "<input type='hidden' name='ref' value='$int_mailingref'>";

$DB_mailing = new DB($GLOBALS["ary_config"]["hostname.mailing"],
					 $GLOBALS["ary_config"]["database.mailing"],
					 $GLOBALS["ary_config"]["username.mailing"],
					 $GLOBALS["ary_config"]["password.mailing"]);

    if ($bl_status) {
		echo 'Dit is het resultaat van deze mailing:';
	} else {
		echo 'De volgende klanten krijgen allemaal een prijslijst mailing:';
	}
	echo '<BR><BR>
    <table width="100%" border="1" cellspacing="0" cellpadding="2">
       <tr>
         <th>Contact ID</th>
         <th>Name</th>
         <th>E-mail adres</th>';
	if ($bl_status) {
		echo "<th>Verzonden</th>";
	} else {
		echo "<th>Verzend</th>";
	}
    echo "\n</tr>";

     // Create a query to select the customers to be e-mailed.
     $sql = "SELECT mailingID, ContactID, Name, email, send_date
			 FROM mailing_results
			 WHERE mailingref = '$int_mailingref'";
	 if (!$bl_status) $sql .= " AND ISNULL(send_date)";

     //echo "Dit is de sql code <br><i>$sql<BR></i>";

     $query = $DB_mailing->query($sql);

     // Test if the test mail need to be send.

	 $qry_mailing = $DB_mailing->query("SELECT * FROM mailing WHERE mailingref = '$int_mailingref'");
	
	$str_subject = "";
	$str_body = "";
	$str_fromname ="";
	$str_fromemail = "";
	if ($obj_mailing = mysql_fetch_object($qry_mailing)) {
		$str_subject = $obj_mailing->subject;
		$str_body = $obj_mailing->body;
		$str_fromname = $obj_mailing->fromname;
		$str_fromemail = $obj_mailing->fromemail;
	}
	 
    // Check if this query is ok to be e-mailed.
    if ($bl_send 
	    &&
		$str_subject) {

       while ($obj = mysql_fetch_object($query)) {
			 $bl_result = FALSE;
			 $str_userid = "";
			 $str_password = "";
			 
			 if (isset($_POST["row$obj->mailingID"])) {
				// Get the user ID and e-mail.
				$qry_userpwd = $db_iwex->query("SELECT uid, pwd 
												FROM users 
												WHERE email = '$obj->email' 
												  AND ContactID = '$obj->ContactID'");
				if ($obj_userpwd = mysql_fetch_object($qry_userpwd)) {
					$str_userid = $obj_userpwd->uid;
					$str_password = $obj_userpwd->pwd;
					mysql_free_result($qry_userpwd);
				} else {
					$str_contactname = getcontactname($obj->ContactID);
					$str_userid = preg_replace("/[.\s]/",
											   "",
			  								   $str_contactname) 
								 ."_"
								 .substr($obj->email,
										 0,
										 stripos($obj->email, '@'));
					echo WebUser($obj->ContactID,
							$str_userid,
							$str_contactname,
							$obj->email,
							DB_LANGUAGE_ID_DUTCH,
							&$int_id,
							TRUE, //RMA
							TRUE, //PURCHASE
							FALSE,//STOCK
							&$str_password);
				}
				
				$msg = str_replace(DB_NEWUSER_NAME, $str_userid, $str_body);
				$msg = str_replace(DB_NEWUSER_PASSWORD, $str_password, $msg);
				$msg = str_replace(DB_DEALERLOGIN, $GLOBALS["ary_config"]["dealersitelink"] , $msg);
				
				if(EXTERNAL_MAILING_SMTP_SERVER) {
	                //send mail with external SMTP server
	                $SMTPMail = new phpmailer();
	                $SMTPMail->From     = $str_fromemail;
	                $SMTPMail->FromName = $str_fromname;
	                $SMTPMail->Host     = EXTERNAL_MAILING_SMTP_SERVER;
	                $SMTPMail->Mailer   = "smtp";
	                if (EXTERNAL_MAILING_SMTP_SERVER_USER) {
	                    $SMTPMail->SMTPAuth = TRUE;
	                    $SMTPMail->Username = EXTERNAL_MAILING_SMTP_SERVER_USER;
	                    $SMTPMail->Password = EXTERNAL_MAILING_SMTP_SERVER_PASSWORD;
	                }
	                $SMTPMail->Subject  = $str_subject;
					$SMTPMail->Body     = $msg;
					$SMTPMail->AltBody  = strip_tags($msg);
	                $SMTPMail->AddAddress($obj->email);
	                $bl_result = $SMTPMail->Send();
	            } else {
	                //send mail with PHP build-in mail() command
	                $bl_result = mail("$obj->email",
	                                  $str_subject,
	                                  $msg,
	                                  "From: $str_fromname <$str_fromemail>\nContent-type: text/html");
	            }
             }
             if ($bl_result) {
                   $sendok = "Ok";
				   $DB_mailing->query("UPDATE mailing_results 
									   SET send_date = NOW() 
									   WHERE mailingID = '$obj->mailingID'");
			 } else {
			   $sendok = "<b>Failed or not send.</b>";
			 }
			echo "<tr>\n<td>$obj->ContactID</td><td>$obj->Name</td><td>$obj->email</td><td>$sendok</td>\n</tr>";
       }
     } else {
			echo "show list";
            while ($obj = mysql_fetch_object($query)) {
                echo "<tr>\n<td>$obj->ContactID</td><td>$obj->Name</td><td>$obj->email</td>";
                if ($bl_status) {
					echo "<td>$obj->send_date</td>";
				} else {
					echo "<td><input type=\"checkbox\" name=\"row$obj->mailingID\" checked></td>";
				}
				echo "\n</tr>";
            }
    }
	echo "</table>\n";
     echo "<TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\" WIDTH=\"100%\">\n";
     echo "<TR>\n";
     echo "<TD>Onderwerp: $str_subject</TD>\n";
     echo "<TD>From: $str_fromname <$str_fromemail></TD>\n";
     if (!$bl_status) echo "<TD><INPUT TYPE=\"submit\" NAME=\"send\" VALUE=\"Verzend!\" CLASS=\"button\" onclick='document.mailform.send.value = confirm(\"Email will be send. Are U SURE?\") ? \"1\" : \"0\"'></TD>\n";
     echo "</TR>\n";
     echo "<TR>\n";
     echo "<TD COLSPAN=\"3\">$str_body</TD>\n";
     echo "</TR>\n";
     echo "</TABLE>\n";
     echo "</FORM>\n";

echo "</body></html>";

?>
