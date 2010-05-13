<?
/*
 * dealer_request_response.php
 *
 * @version $Id: dealer_request_response.php,v 1.31 2007-08-23 10:43:45 iwan Exp $
 * @copyright $date:
 **/

include ("include.php");

$int_webcust_ID = isset($_POST["webID"]) ? $_POST["webID"] : FALSE;
$int_webcust_ID = (isset($_GET["webID"]) && !isset($_POST["webID"])) ? $_GET["webID"] : $int_webcust_ID;
$bl_update = isset($_POST["update"]) ? TRUE : FALSE;
$bl_ok = isset($_POST["ok"]) ? TRUE : FALSE;
$bl_email = isset($_POST["e_mail"]) ? TRUE : FALSE;
$bl_delete = isset($_POST["delete"]) ? TRUE : FALSE;

// Close the DB from common.php
mysql_close();

$DB_web = new DB($GLOBALS["ary_config"]["hostname.mambo"],
				 $GLOBALS["ary_config"]["database.mambo"],
				 $GLOBALS["ary_config"]["username.mambo"],
				 $GLOBALS["ary_config"]["password.mambo"]);
/* web structure. 
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `ContactID` int(8) unsigned NOT NULL auto_increment,
  `CompanyName` varchar(50) default NULL,
  `ContactFirstName` varchar(35) default NULL,
  `ContactTussenvoegs` varchar(25) default NULL,
  `ContactName` varchar(50) default NULL,
  `ContactTitle` varchar(15) default NULL,
  `Address` varchar(50) default NULL,
  `City` varchar(50) default NULL,
  `Region` varchar(50) default NULL,
  `PostalCode` varchar(10) default NULL,
  `Country` char(2) default NULL,
  `languageID` tinyint(3) unsigned NOT NULL default '1',
  `Phone` varchar(20) default NULL,
  `Fax` varchar(20) default NULL,
  `MobilePhone` varchar(20) default NULL,
  `email` varchar(100) default NULL,
  `website` varchar(35) default NULL,
  `kvk_number` varchar(35) default NULL,
  `use_btw` tinyint(1) unsigned NOT NULL default '1',
  `btw_number` varchar(35) default NULL,
  `Bankinfo` varchar(25) default NULL,
  `Paymentterm` tinyint(2) default '4',
  `Paymentterm_margin` tinyint(2) default '3',
  `UPSaccount` varchar(10) default NULL,
  `conditions_OK_yn` tinytext,
  `mailing` tinytext,
  `Dealer_yn` tinytext,
  `Auto_yn` tinytext,
  `Watersport_yn` tinytext,
  `Foto_yn` tinytext,
  `Supplier_yn` tinytext,
  `ContactTypeID` mediumint(8) unsigned default NULL,
  `Aanhef` varchar(15) default NULL,
  `PhoneExtention` varchar(10) default NULL,
  `Notes` longtext,
  PRIMARY KEY  (`ContactID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 */
				 
//$DB_web = new DB("192.168.1.1", "test", "firstfind", "HoHo86gaan");
$DB_postcode  = new DB($GLOBALS["ary_config"]["hostname.postcode"], 
					   $GLOBALS["ary_config"]["database.postcode"], 
					   $GLOBALS["ary_config"]["username.postcode"], 
					   $GLOBALS["ary_config"]["password.postcode"]);
$DB_iwex = new DB();

// Print default Iwex HTML header.
printheader (COMPANYNAME . " nieuwe klant antwoord");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"newcustomer\">\n";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

printIwexNav();

$sql_select_customer = "SELECT ContactID, CompanyName, ContactFirstName, ContactTussenvoegs, 
						ContactName, ContactTitle, Address, PostalCode, City, 
						Country, website, btw_number, Phone, Fax, kvk_number, 
						email, Notes, Dealer_yn, languageID
						FROM contacts ";

if (isset($_POST["customername"])) $sql_data_change = "contacts SET 
        CompanyName = '".$_POST["customername"]."', 
        ContactFirstName = '".$_POST["firstname"]."', 
        ContactTussenvoegs = '".$_POST["middelname"]."', 
        ContactName = '".$_POST["lastname"]."',
        ContactTitle = '".$_POST["geslacht"]."', 
        Address = '".$_POST["addres"]."',
        PostalCode = '".$_POST["postcode"]."', 
        City = '".$_POST["city"]."',
        Country = '".$_POST["country"]."', 
        website = '".$_POST["website"]."', 
        btw_number = '".$_POST["btw_number"]."', 
        Phone = '".$_POST["phone"]."', 
        Fax = '".$_POST["fax"]."', 
        kvk_number = '".$_POST["kvk_number"]."', 
        email = '".$_POST["email"]."',
		languageID = '".$_POST["languageID"]."',
        Notes = '".$_POST["notes"]."' ";
                        
if ($bl_ok) {
    // Insert record in the Iwex database.
    if ($int_id_newcust = GetField("SELECT ContactID FROM contacts WHERE CompanyName = '".$_POST["customername"]."'")) {
       echo "Insert failed. Customer is already found with ID $int_id_newcust";
       $bl_update = TRUE;
	} else {
	    $sql_insert = "INSERT ". $sql_data_change . ", Dealer_yn = '-1', mailing='-1' " ;
	    $DB_iwex->query($sql_insert);
	    $qry_last_contact = $DB_iwex->query('SELECT distinct LAST_INSERT_ID() FROM contacts');
	    $obj = mysql_fetch_array($qry_last_contact, MYSQL_BOTH);
	    $int_last_contactID = $obj[0];
	    mysql_free_result($qry_last_contact);
	    $sql_insert_adres = "INSERT Adressen SET 
	                        ContactID = $int_last_contactID, 
	                        Naam = '".$_POST["customername"]."',
	                        attn = '".$_POST["firstname"];
	    if ($_POST["middelname"] != "") $sql_insert_adres .= " ".$_POST["middelname"];
	    $str_adres = $_POST["addres"];
	    $str_housenumber = GetHouseNumber(&$str_adres);
	    $sql_insert_adres .= " ".$_POST["lastname"]."',
	                        straat = '$str_adres', 
	                        huisnummer = '$str_housenumber', 
	                        postcode = '".$_POST["postcode"]."',
	                        plaats = '".$_POST["city"]."',
	                        land = '".$_POST["country"]."'";
	    $DB_iwex->query($sql_insert_adres);
	    $sql_insert_person ="INSERT Personen SET 
	                        ContactID = $int_last_contactID, 
	                        voornaam = '".$_POST["firstname"]."',
	                        tussenvoegsel = '".$_POST["middelname"]."', 
	                        achternaam = '".$_POST["lastname"]."',
	                        email = '".$_POST["email"]."',
	                        tel = '".$_POST["phone"]."', 
	                        fax = '".$_POST["fax"]."', 
	                        aanhef = '".$_POST["geslacht"]."',
	                        gender = ";
	    if (!strcasecmp($_POST["geslacht"], "man") || !strcasecmp($_POST["geslacht"], "heer")) {
	        $sql_insert_person .= '1';
	    } else {
	        $sql_insert_person .= '2';
	    }
	    $DB_iwex->query($sql_insert_person);
	    
	    // Get the e-mail string from the 
      $ary_text = Gettexten(1, $_POST["languageID"]);
	    $str_mailtxt = "Geachte ".$_POST["geslacht"];
	    if ($_POST["middelname"] != "") $str_mailtxt .= " ".$_POST["middelname"];
	    $str_mailtxt .= " ".$_POST["lastname"].",\n\n". $ary_text[1];
	    
	    $name = $GLOBALS["ary_config"]["emailname.sales"];
	    $myemail = $GLOBALS["ary_config"]["email.sales"];

		if(EXTERNAL_MAILING_SMTP_SERVER) {
			//send mail with external SMTP server
			$SMTPMail = new phpmailer();
			$SMTPMail->From     = $myemail;
			$SMTPMail->FromName = $name;
			$SMTPMail->Host     = EXTERNAL_MAILING_SMTP_SERVER;
			$SMTPMail->Mailer   = "smtp";
			if (EXTERNAL_MAILING_SMTP_SERVER_USER) {
				$SMTPMail->SMTPAuth = TRUE;
				$SMTPMail->Username = EXTERNAL_MAILING_SMTP_SERVER_USER;
				$SMTPMail->Password = EXTERNAL_MAILING_SMTP_SERVER_PASSWORD;
			}
			$SMTPMail->Subject  = "Welkom bij " . COMPANYNAME;
			$SMTPMail->Body     = "$emailheader<body>$str_mailtxt<br></body></html>";
			$SMTPMail->AltBody  = strip_tags($str_mailtxt);
			$SMTPMail->AddAddress($_POST["email"]);
			$SMTPMail->AddCC($myemail);
			$bl_result = $SMTPMail->Send();
			//echo "send using phpmailer result = '$bl_result'";
		} else {
			//send mail with PHP build-in mail() command
			$bl_result = mail($_POST["email"], 
							  "Welkom bij " . COMPANYNAME, 
							  $str_mailtxt,
							  "From: $name <$myemail>\nCc:" . $GLOBALS["ary_config"]["email.sales"] . "\n");
			//echo "send using mail result = '$bl_result'";
		}
		
	    if ($bl_result) {
	         $bl_delete = TRUE;
	    }
		
      if ($message = WebUser($int_last_contactID,
                       $_POST["customername"] . "_" . $_POST["firstname"],
                       $_POST["customername"],
                       $_POST["email"],
                       $_POST["languageID"],
                       FALSE,
                       TRUE,
                       TRUE,
                       FALSE,
                       &$passwd)) {
      echo $message;
	  
	  if ($msg = MailWebUser($_POST["customername"] . "_" . $_POST["firstname"], 
		  					 $passwd,
		   					 $_POST["languageID"],
		   					 $_POST["email"],
		    				 &$str_subject))
      {
        echo "<br>Email is verstuurd, deze ziet er als volgt uit:<br><br>";
		echo "<br>To: " .$_POST["email"];
        echo "<br>Subject:" . $str_subject;
        echo "<br><pre>$msg</pre>";
      } else {
        echo "mail niet gelukt";
      }
    } else {
      echo "user update / create not succesfull, geen emailadres opgegeven";
    }
	}
}

if ($bl_delete) {
    // Delete record from web.
    $DB_web->query("DELETE FROM contacts WHERE ContactID = $int_webcust_ID");
    $int_webcust_ID = FALSE;
}
                        
if (!$int_webcust_ID) {
    ?>
    <TABLE BORDER="1" CELLPADDING="1" CELLSPACING="0" class="blockbody" width="100%">
    <tr>
      <th>Bedrijfsnaam</th>
      <th>Naam</th>
      <th>Dealer</th>
      <th>Land</th>
      <th>Notes</th>
    </tr>
    <?
    
    $qry_customers = $DB_web->query($sql_select_customer. "ORDER BY ContactID DESC");
    while ($obj = mysql_fetch_object($qry_customers)) {
      echo "<tr>\n\t";
      echo "<td>$obj->CompanyName</td><td><a href='".$_SERVER['PHP_SELF']."?webID=$obj->ContactID'>$obj->ContactName</a></td><td>";
      if ($obj->Dealer_yn) echo "Ja"; else echo "Nee";
      echo "</td><td>$obj->Country</td><td>$obj->Notes</td>\n</tr>\n";
    }
    
} else {
    if ($bl_update) {
        $sql_update = "UPDATE ". $sql_data_change. " WHERE ContactID = $int_webcust_ID";
        $DB_web->query($sql_update);
    }

	$sql_select_customer .= "WHERE ContactID = $int_webcust_ID";

    $qry_customers = $DB_web->query($sql_select_customer);
        if ($obj = mysql_fetch_object($qry_customers)) {
    
        echo "<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" class=\"blockbody\" width=\"100%\">\n";
        echo "    <TR>\n";
        echo "         <TH colspan='2'>";
        if ($obj->Dealer_yn) echo "Dealer aanvraag";
        echo " <B>ID $obj->ContactID</B><INPUT TYPE='hidden' NAME='webID' VALUE='$obj->ContactID'></TH>\n";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Company name</TD><TD><INPUT TYPE=\"text\" NAME=\"customername\" SIZE=\"30\" CLASS=\"form\" value=\"$obj->CompanyName\">";
        echo " Test of deze al in de " . COMPANYNAME . " database voorkomt.". GetRecordId(SQL_SEARCH_CUSTOMER_AND_SHIPADRES_LIST, "Companyname", "customername", "newcustomer.customername", "cust", 0.6, 0);
        echo "</td>";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Voornaam</TD><TD><input type=\"text\" size=\"25\" name=\"firstname\" value='$obj->ContactFirstName'></TD>\n";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Tussenvoegsel</TD><TD><input type=\"text\" size=\"25\" name=\"middelname\" value='$obj->ContactTussenvoegs'></TD>\n";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Achternaam</TD><TD><input type=\"text\" size=\"25\" name=\"lastname\" value='$obj->ContactName'></TD>\n";
        echo "    </TR>\n<TR>\n";
        echo "         <TD>Geslacht</TD><td><input type=\"radio\" name=\"geslacht\" value=\"Heer\" ";
        if (!strcasecmp($obj->ContactTitle, "man") || !strcasecmp($obj->ContactTitle, "heer")) echo "CHECKED";
        echo ">De heer<input type=\"radio\" name=\"geslacht\" value=\"mevrouw\" ";
        if (strcasecmp($obj->ContactTitle,"man") && strcasecmp($obj->ContactTitle, "heer")) echo "CHECKED";
        echo ">Mevrouw</td>";
		$qry_street = $DB_postcode->query("SELECT CONCAT_WS(', ', straatnaam, huisnummer_start, huisnummer_end) AS straat
										  FROM straatnaam
										  WHERE postcode = '".str_replace(' ', '', $obj->PostalCode)."'");
		$str_street = '';
		if ($objstreet = mysql_fetch_object($qry_street)) {
			$str_street = $objstreet->straat;
		}
		mysql_free_result($qry_street);
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Adres</td><td><input type=\"text\" size=\"25\" name=\"addres\" value=\"$obj->Address\"> $str_street</td>";
        echo "    </TR>\n<TR>\n";
		$qry_street = $DB_postcode->query("SELECT plaats, postbus
										  FROM plaatsnaam
										  WHERE postcode = '".substr($obj->PostalCode, 0, 4)."'");
		$str_street = '';
		$str_postbus = '';
		if ($objstreet = mysql_fetch_object($qry_street)) {
			$str_street = $objstreet->plaats;
			$str_postbus = $objstreet->postbus ? ' is een postbus!' : '';
		}
		mysql_free_result($qry_street);		
        echo "		   <td>Postcode / Plaats</td><td><input type=\"text\" size=\"6\" name=\"postcode\" value=\"$obj->PostalCode\">/<input type=\"text\" size=\"50\" name=\"city\" value=\"$obj->City\"> $str_street $str_postbus</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Telefoon</td><td><input type=\"text\" size=\"25\" name=\"phone\" value=\"$obj->Phone\"></td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Fax</td><td><input type=\"text\" size=\"25\" name=\"fax\" value=\"$obj->Fax\"></td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>E-mail</td><td><input type=\"text\" size=\"25\" name=\"email\" value=\"$obj->email\"> <a href='mailto:$obj->email'>E-mail</a></td>";
        echo "    </TR>\n<TR>\n";
        if (strpos ($obj->website, "http") === false) {
            $str_website = "http://$obj->website";
        } else {
           $str_website = $obj->website; 
        }
        echo "		   <td>Website</td><td><input type=\"text\" size=\"25\" name=\"website\" value=\"$obj->website\"> <a href='$str_website' target='_new'>Link</a></td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>BTW nummer</td><td><input type=\"text\" size=\"25\" name=\"btw_number\" value=\"$obj->btw_number\"> ".CheckBTWlink($obj->Country, $obj->btw_number, "check")." of <a href='http://www.europa.eu.int/comm/taxation_customs/vies/nl/vieshome.htm' target='_new'>zelf</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>KVK nummer</td><td><input type=\"text\" size=\"25\" name=\"kvk_number\" value=\"$obj->kvk_number\"> ".CheckKVKlink($obj->kvk_number)."</td>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Land</td><td>".makelistbox('SELECT code, country FROM country ORDER BY country','country','code','country',$obj->Country)."</td>";
		echo "<TR><TD>Language:</TD><TD>" .  makelistbox("SELECT languageID, language FROM languages ",  "languageID","languageID", "language", $obj->languageID) . "</TD></TR>";
        echo "    </TR>\n<TR>\n";
        echo "		   <td>Notities</td><td><textarea name=\"notes\" cols=\"50\" rows=\"5\">$obj->Notes</textarea></td>";
        echo "    </TR>\n<TR>\n";
        echo "			<td colspan='2'>";
        echo "<INPUT TYPE=\"submit\" NAME=\"update\" VALUE=\"Update\" CLASS=\"button\">";
        echo "<INPUT TYPE=\"submit\" NAME=\"ok\" VALUE=\"Copy, Mail en delete\" CLASS=\"button\">";
        echo "<INPUT TYPE=\"submit\" NAME=\"delete\" VALUE=\"Delete\" CLASS=\"button\" onClick=\"return confirm('Weet je zeker dat je dit record wilt verwijderen?')\">";
        echo "<INPUT TYPE=\"button\" NAME=\"rerturnlist\" onClick=\"location.replace('".$_SERVER['PHP_SELF']."');\" VALUE=\"Return to list\">";
        echo "    </td>\n</TR>\n";
        echo "</table></FORM>";
    }
    mysql_free_result($qry_customers);
}

printenddoc();

?>
