<?php
/* Copyright (C) 2004  Marco Avidano
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * See http://www.gnu.org/licenses/gpl.html for the complete text of the license.
 */
 
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");
@set_time_limit(0);
define('EMAIL_REMOVE_TEXT','verwijder dit!');
define('EMAIL_STATUS_ONGELEZEN', 1);
define('EMAIL_STATUS_GELEZEN', 2);
define('EMAIL_STATUS_BEANTWOORD', 3);
define('EMAIL_STATUS_DOORGESTUURD', 4);
define('EMAIL_STATUS_VERWERKT', 5);
define('EMAIL_STATUS_DISABELD', 6);
define('EMAIL_STATUS_ALREADY_DISABELD', 7);
define('EMAIL_STATUS_NOT_IN_THE_LIST', 8);

include ("include.php");
// Include the class definition file.
require($_SERVER['DOCUMENT_ROOT'].$GLOBALS["ary_config"]['file_root_path'].'/includes/class.html2text.php');

// Set defaults
$DEFAULT_COLORSET="BLUE"; //GREY,VIOLET,GREEN,BLUE,BROWN
$DEFAULT_FONTSIZE=10; //integer from 7 to 16
$DEFAULT_CHARSET="english-iso-8859-1"; //see README_CHARSET
$DEFAULT_MAIL_PER_PAGE=10;

if(!isset($_SESSION['COLORS'])) $_SESSION['COLORS']=$DEFAULT_COLORSET;
if(!isset($_SESSION['FONTSIZE'])) $_SESSION['FONTSIZE']=$DEFAULT_FONTSIZE;
if(!isset($_SESSION['CHARSET'])) $_SESSION['CHARSET']=$DEFAULT_CHARSET;

$str_tbmail = isset($_GET['tbmail']) ? $_GET['tbmail'] : FALSE;

$bl_getnewmail = FALSE;

// Set mail table form the mail information!
if ($str_tbmail) {
    if ($str_tbmail == $uname) { // When user e-mail is used use that name
    	$_SESSION['MAILTABEL'] = $str_tbmail;
    	$_SESSION['EMAIL'] = "$str_tbmail@".DEFAULT_DOMAIN;
        $_SESSION['COLORS'] = 'BROWN';
        $_SESSION['USE_CC'] = isset($_GET['use_cc']) ? $_GET['use_cc'] : TRUE;
        $bl_getnewmail = TRUE;
    } else { // Else get it from the config file
    	$_SESSION['MAILTABEL'] = $GLOBALS["ary_config"]["tabel." . $str_tbmail];
    	$_SESSION['EMAIL'] = $GLOBALS["ary_config"]["email." . $str_tbmail];
        $_SESSION['COLORS'] = $GLOBALS["ary_config"]["color." . $str_tbmail];
        $_SESSION['USE_CC'] = TRUE;
		$_SESSION['FROM'] = $GLOBALS["ary_config"]["from." . $str_tbmail];;
    }
} else if (!isset($_SESSION['MAILTABEL'])) {
	$_SESSION['MAILTABEL'] = $GLOBALS["ary_config"]["tabel.default"];
	$_SESSION['EMAIL'] = $GLOBALS["ary_config"]["email.default"];
    $_SESSION['USE_CC'] = TRUE;
}

if(isset($_GET['colorset'])) $_SESSION['COLORS']=$_GET['colorset'];
$COLORS=$_SESSION['COLORS'];
if(isset($_GET['fontsize'])) $_SESSION['FONTSIZE']=$_GET['fontsize'];
if(isset($_POST['charset'])) $_SESSION['CHARSET']=$_POST['charset'];
if(!isset($_SESSION['MPP'])) $_SESSION['MPP']=$DEFAULT_MAIL_PER_PAGE;

// Print default Iwex HTML header.
printheader ("Inbox ".$_SESSION['EMAIL'], 'Inbox');

echo include_javascript();
if ($bl_getnewmail) {
    echo "\n<script language=\"javascript1.2\" type=\"text/javascript\">window.open('http://".FILE_XEOPORT."?emailaccount=$str_tbmail".($supervisor ? '' : "&delete=1")."','upload popup','toolbar=0,menubar=0,resizable=0,scrollbars=0,status=0,width=400,height=400,left=60,top=25'); </script>\n";
}

echo '    <style type="text/css"><!--
          BODY,TABLE,TR,TD,INPUT,TEXTAREA,OPTION,SELECT { font-family:tahoma,sans-serif;
          font-size:'.$_SESSION["FONTSIZE"].'pt;color:#333333;text-decoration:none; }          
          A:HOVER { text-decoration:underline; }
         --></style>';
echo "<BODY ".get_bgcolor().">\n";
//<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"inboxform\">
printIwexNav();

// Used for calendar function.
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';


$SECTION_RIGHT="Today is ".date("D, jS M Y"); 
if (isset($_REQUEST['op']) && $_REQUEST['op'] && isset($_SESSION[MESSAGES])) {
	$SECTION_RIGHT="You are <u>".$_SESSION['EMAIL']."</u> | $SECTION_RIGHT";
}
$SECTION_LEFT=array(
 "0"=>"Login",
 "1"=>"Check Login",
 "2"=>"Inbox - ",//.count($_SESSION[MESSAGES][CONTENT])." message".((count($_SESSION[MESSAGES][CONTENT])>1)?"s":""),
 "3"=>"Read message",
 "4"=>"Compose new mail",
 "5"=>"Delete messages",
 "6"=>"Send message",
 "999"=>"Credits"
);

/*if(!$_SESSION[COLORS]) $_SESSION[COLORS]=$DEFAULT_COLORSET;
if(!$_SESSION[FONTSIZE]) $_SESSION[FONTSIZE]=$DEFAULT_FONTSIZE;
if(!$_SESSION[CHARSET]) $_SESSION[CHARSET]=$DEFAULT_CHARSET;

if(isset($_GET['colorset'])) $_SESSION[COLORS]=$_GET['colorset'];
if(isset($_GET['fontsize'])) $_SESSION[FONTSIZE]=$_GET['fontsize'];
if(isset($_POST['charset'])) $_SESSION[CHARSET]=$_POST['charset'];*/

$WIZ=$_SERVER[SCRIPT_NAME];
//if($_REQUEST[op]==1 && $_POST[username]) setcookie("username", $_POST[username]);
//if($_REQUEST[op]==1 && $_POST[email]) setcookie("email", $_POST[email]);
//if((!$_SESSION[AUTH] && $_REQUEST[op]>1 && $_REQUEST[op]<100) || !$_REQUEST[op]) $_REQUEST[op]=0;
//if(!$_SESSION[MPP]) $_SESSION[MPP]=$DEFAULT_MAIL_PER_PAGE;
$BOUNDARY="----------NamekoWebmailBoundary";
$LEGAL_CHARS="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789._@-";
$SOCK="";
?>
<table cellspacing="0" cellpadding="0" width="100%" height="90%" border="0" bgcolor="<?php$COLORSET[$COLORS]['MEDIUM']?>">
 <tr valign="top" height="100%">
  <td colspan="2">
   <table height="100%" cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="<?php$COLORSET[$COLORS]['LIGHT']?>">
<?php

// get static values from config.txt
$xeoport = new DB($GLOBALS["ary_config"]["hostname"],
            $GLOBALS["ary_config"]["maildatabase"], 
            $GLOBALS["ary_config"]["username"],
            $GLOBALS["ary_config"]["password"]); 

$iwex = new DB($GLOBALS["ary_config"]["hostname"],
            $GLOBALS["ary_config"]["database"], 
            $GLOBALS["ary_config"]["username"],
            $GLOBALS["ary_config"]["password"]); 
            
$sender = $_SESSION['EMAIL'];

// Deleting all the selections into the del box.
if (isset($_POST["delall"]) && isset($_POST["del"])) {
  	foreach ($_POST["del"] AS $del_key => $del_number) {
		$xeoport->query("UPDATE " . $_SESSION['MAILTABEL'] 
					. " SET cancel = !cancel 
									|| 
									cancel IS NULL 
						WHERE xp_nr = '".$del_key."'");
	}
}


switch(isset($_REQUEST['op']) ? $_REQUEST['op'] : '') {
//3:READ MAIL
case "3":
 $getid=$_REQUEST['id'];
 if (isset($_POST['submit'])) {
    $xeoport->query("UPDATE " . $_SESSION['MAILTABEL'] . " 
                    SET ContactID = '".$_POST['ContactID']."' 
                    WHERE xp_nr=$getid");
    UpdateMessageStatus('2',$getid,$xeoport,$employee_id, $_SESSION['MAILTABEL']);
 }
    
 $_SESSION[MESSAGES][CONTENT][$getid][READ]=1;
 
 if (isset($_POST['unread'])) {
    UpdateMessageStatus('0',$getid,$xeoport,$employee_id, $_SESSION['MAILTABEL']);
 } else if(!GetField("SELECT xp_status FROM " . $_SESSION['MAILTABEL'] . " WHERE xp_nr=$getid",
             $xeoport)) {
    // When the record is not read or replayed set it to read by this customer
    UpdateMessageStatus('2',$getid,$xeoport,$employee_id, $_SESSION['MAILTABEL']);
 }
 $sql = "SELECT * 
		 FROM " . $_SESSION['MAILTABEL'] . " 
		 WHERE xp_nr=$getid";
 
 $result = $xeoport->query($sql);
  $obj_mail = mysql_fetch_object($result);
 $statustext = GetStatus($getid,$xeoport,$iwex, $_SESSION['MAILTABEL']);
 $content_id_to_filename=array();
 $header=MessageParseHeader(split("\r\n",$obj_mail->xp_header_raw));
 $_SESSION['refw']['date']=htmlentities($header['date']);
 $_SESSION['refw']['from']=GetAddressFromFromHeader($header['from']);
 $_SESSION['refw']['subject']=htmlentities($header['subject']);
 $str_email_adres_search = '';
 if (!$obj_mail->ContactID) {
 	if (!strpos($_SESSION['refw']['from'], DEFAULT_DOMAIN)) {
        $obj_mail->ContactID =GetField("SELECT contacts.ContactID
                                       FROM contacts 
                                       INNER JOIN Personen ON contacts.ContactID = Personen.ContactID
                                       WHERE Personen.email = '".addslashes($_SESSION['refw']['from'])."' 
                                       OR contacts.email = '".addslashes($_SESSION['refw']['from'])."'");
		$str_email_adres_search = $_SESSION['refw']['from'];
    } else {
        $obj_mail->ContactID =GetField("SELECT contacts.ContactID
                                       FROM contacts 
                                       INNER JOIN Personen ON contacts.ContactID = Personen.ContactID
                                       WHERE Personen.email = '".addslashes(htmlentities($header['to']))."' 
                                       OR contacts.email = '".addslashes(htmlentities($header['to']))."'");
		$str_email_adres_search = htmlentities($header['to']);
    }
    $xeoport->query("UPDATE " . $_SESSION['MAILTABEL'] . " 
                    SET ContactID = '$obj_mail->ContactID' 
                    WHERE xp_nr=$getid");
 }
 echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."?op=3&id=$getid\" name=\"inboxform\">";
 echo("<td align='center' valign='top' style='padding:10pt;'><br>
  <table width='100%' cellspacing='0' cellpadding='0' border='0' style='border-collapse:collapse;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'>
   <tr bgcolor='".$COLORSET[$COLORS][DARK]."' valign='top'>
    <td width='75%' style='padding:5pt;'>
     <div style='padding-bottom:5pt;'><b><big>".htmlentities($header['subject'])."</big></b></div>
     <table border='0' width='100%' cellspacong='2' cellpadding='1'>
      <tr><td><b>From:</b> ".htmlentities($header['from'])."</td></tr>
      <tr><td><b>To:</b> ".htmlentities($header['to'])."</td></tr>
      <tr><td><b>Date:</b> ".htmlentities($header['date'])."</td></tr>
      <tr><td><b>Status:</b> $statustext</td></tr>
      <tr><td><b>Outlook:</b> Export click <a href='javascript:void()' onclick= \"window.open('inbox_download.php?id=$getid','popup','toolbar=0,menubar=0,scrollbars=1,resizable=1,dependent=0,status=0,width=200,height=100,left=25,top=25')\"'>here</a></td></tr>");
      if(isset($header["disposition-notification-to"])) echo("<tr><td><font color='#DD0000'><b>Sender ask for read notification to address ".htmlentities($header["disposition-notification-to"])."!</b></font></td></tr>");
      $int_order_id = FALSE;
      if ($obj_mail->ContactID) {
        echo "<tr><td><b>Customer:</b> <a href='".contacts."?custid=$obj_mail->ContactID' ".
                ShowShortContactInfo($obj_mail->ContactID)."' target=_new>"
             .GetField("SELECT CompanyName FROM contacts WHERE ContactID = $obj_mail->ContactID")
             ."</a>";
		
		$qry_order_id = $db_iwex->query("SELECT OrderID 
			 						     FROM orders 
									     WHERE xp_no = '$getid'
									   		 AND 
									   		 mailtable = '".$_SESSION['MAILTABEL']."'");
		while ($obj_order_id = mysql_fetch_object($qry_order_id)) {
            echo " <INPUT TYPE=\"button\" NAME=\"show_order\" VALUE=\"Show order\" onClick=\"window.open('order.php?contactID=$obj_mail->ContactID&orderID=$obj_order_id->OrderID','Orders',".STANDARD_WINDOW.");\">\n";
        }
		mysql_free_result($qry_order_id);
		
        echo " <INPUT TYPE=\"button\" NAME=\"new_order\" VALUE=\"Nieuwe order\" onClick=\"window.open('order.php?contactID=$obj_mail->ContactID&new_order=1&xp_no=$getid&OrderDate=".date("Y-m-d H:i", strtotime(htmlentities($header['date'])))."&mailtable=".$_SESSION['MAILTABEL']."','Orders',".STANDARD_WINDOW.");\">\n";
        echo "</td></tr>";
     }
     echo("<tr><td colspan='2'><input type='button' value='Show/hide other headers' style='width:200pt;height:15pt;' onClick='toggleMenu(\"allheaders\")'></td></tr>
     </table>
     <table border='0' width='100%' cellspacong='2' cellpadding='1' style='display:none;' id='allheaders'>");

 foreach($header as $hd_name=>$hd_content) if(($hd_name!="from") && ($hd_name!="subject") && ($hd_name!="to") && ($hd_name!="date") && (trim($hd_content)!="")) echo("<tr><td><table border='0' cellpadding='0' cellspacing='0'><tr valign='top'><td style='padding-right:5pt;'><b>".ucfirst($hd_name).":<b></td><td>".nl2br(htmlentities($hd_content))."</td></tr></table></td></tr>\n");
 if ($obj_mail->cancel == 1) {
  $del_message="<font color='#FF0000'><b>This message is marked for deletion</b></font><br>";
  $del_button="Undelete";
 } else {
  $del_button="Delete";
  $del_message="";
 }

 echo("</table>
    </td>
    <td width='25%' style='padding:5pt;' align='right'>
     $del_message
     <input type='button' value='Reply' style='width:130pt;' onClick='window.location=\"$WIZ?op=4&act=re&id=$getid\"'><br>
     <input type='button' value='Forward' style='width:130pt;' onClick='window.location=\"$WIZ?op=4&act=fw&id=$getid\"'><br>
     <input type='button' value='$del_button' style='width:130pt;' onClick='javascript:window.location=\"$WIZ?toggle_delete=$getid\"'><br>");
//  echo     "<input type='button' value='Mark as read' style='width:130pt;' onClick='javascript:window.location=\"$WIZ?op=3&id=$getid&read=1\"'><br>";
 echo "<input type='button' value='Back to Inbox' style='width:130pt;' onClick='javascript:window.location=\"$WIZ?op=2\"'><br>";
 if (!$int_order_id) {
    echo "<INPUT TYPE=\"text\" NAME=\"ContactID\" SIZE=\"2\" CLASS=\"form\" value=\"$obj_mail->ContactID\"> "
    //        ."<INPUT TYPE=\"text\" NAME=\"customername\" SIZE=\"13\" CLASS=\"form\"\" VALUE=\"".$_SESSION['refw']['from']."\">"
            .GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, 
                                   "ContactID", 
                                   "customername", 
                                   "inboxform.ContactID", 
                                   "cust",
                                   13,
                                   $str_email_adres_search)."<br>
			<input type=submit value='Update' name=submit style='width:130pt;'><br>
            <input type=submit value='Mark as unread' name=unread style='width:130pt;'>";
 }
 echo ("   </td>
   </tr>
  </table>
  <div align='left'>");
 $message=MessageRetrieveContent($header,POP3RetrieveMessage($getid,$xeoport, $_SESSION['MAILTABEL']));
 if(isset($message["attachments"]) && count($message["attachments"])) {
  echo("<br><table width='100%' cellspacing='0' cellpadding='0' border='0' style='border-collapse:collapse;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'><tr bgcolor='".$COLORSET[$COLORS][DARK]."' valign='top'><td><b>Attachments</b>:<br>\n");
  foreach($message["attachments"] as $atc) {
   $ctparts=split(";",$atc["header"]["content-type"]);
   foreach($ctparts as $ctpart) {
    if(strstr($ctpart,"name=")||strstr($ctpart,"file=")) {
     $filename=split("=",$ctpart);
     $filename=str_replace("\"","",$filename[1]);
    }
   }
   for($d=0;$d<strlen($filename);$d++) {
    if(!strstr($GLOBALS['LEGAL_CHARS'],$filename[$d])) $filename[$d]="_";
   }
   echo("&nbsp; &middot; <a href='".MAIL_TEMP_DIR."/$filename' target='_blank'>$filename</a><br>");
   if($attach_handle=@fopen(MAIL_TEMP_DIR."/$filename","wb")) @fwrite($attach_handle,$atc[content]);
   @fclose($attach_handle);
   if(is_file(MAIL_TEMP_DIR."/$filename")) @chmod(MAIL_TEMP_DIR."/$filename",0600);
   if(isset($atc["header"]["content-id"])) {
    $content_id=substr($atc["header"]["content-id"],1,-1);
    $content_id_to_filename=array_merge($content_id_to_filename,array("cid:$content_id"=>"".MAIL_TEMP_DIR."/$filename"));
   }
  }
  echo("</td></tr></table>\n");
 }
 echo("<p>");
 $button_show_plain="<input type='button' value='Show text/plain message' style='width:130pt;' onClick='javascript:window.location=\"$WIZ?op=3&id=$getid&show_plain=1\"'><br><br>\n";
 $button_show_html="<input type='button' value='Show HTML message' style='width:130pt;' onClick='javascript:window.location=\"$WIZ?op=3&id=$getid&show_html=1\"'><br><br>\n";
 $bl_html_is_used = FALSE;
 if (isset($message["text-plain"]) && isset($message["text-html"])) {
    if (isset($_GET['show_plain']) && $_GET['show_plain']) echo($button_show_html . $message["text-plain"]);
    else { 
        echo ($button_show_plain . strtr($message["text-html"],$content_id_to_filename));
        $bl_html_is_used = TRUE;
    }
 } elseif (isset($message["text-plain"]) && !isset($message["text-html"])) {
  echo ($message["text-plain"]);
 } elseif(!isset($message["text-plain"]) && isset($message["text-html"])) {
  echo (strtr($message["text-html"], $content_id_to_filename));
 } else {
  echo("<i>This e-mail doesn't contain any text.</i>");
 }
 echo("</p></div></td>");
 if ($bl_html_is_used) {
    $_SESSION['refw']['text']=$message["text-plain"];
 } else {
     $_SESSION['refw']['text']=split("\n",wordwrap(strip_tags($message["text-plain"]), 60, "\n", 1));
     for($x=0;$x<count($_SESSION['refw']['text']);$x++) $_SESSION['refw']['text'][$x]="> ".$_SESSION['refw']['text'][$x];
     $_SESSION['refw']['text']="<pre>".implode("\n",$_SESSION['refw']['text'])."</pre>";
 }
 MYSQL_FREE_RESULT($result);
 break;

//4:COMPOSE MAIL
case "4":
	$getid = $_REQUEST["id"];
	//include language 
	$ary_lang = array();
	/*if ($obj_mail->ContactID) { //set language if contactid is known
		$ary_lang = $ary_languages[getcontactlanguage($obj_mail->ContactID)];
	} else { // otherwise revert to the default*/
		$ary_lang = $ary_languages[getlanguage($GLOBALS["ary_config"]["default_language"])];
	//}
//print_r($ary_lang); //debug
 if($_GET['act']) {
  $refwtext="<i>Original message sent on the ".$_SESSION['refw']['date'].
			" by <a href='mailto:".$_SESSION['refw']['from']."'>"
            .$_SESSION['refw']['from']."</a></i><p>"
			.$_SESSION['refw']['text']
            ."</p>";
  //var_dump($_SESSION['refw']['text']);
  if($_GET['act']=="re") {
   $refwto=$_SESSION['refw']['from'];
   $refwsubject = (preg_match("/re:/i",$_SESSION['refw']['subject']) ? "" : "Re: ") . $_SESSION['refw']['subject'];
   //set status replied
   UpdateMessageStatus('3',$getid,$xeoport,$employee_id, $_SESSION['MAILTABEL']);
  } elseif ($_GET['act']=="fw") {
   $refwsubject = (preg_match("/fw:/i",$_SESSION['refw']['subject']) ? "" : "Fw: ") . $_SESSION['refw']['subject'];
   //set status forwarded
   UpdateMessageStatus('4',$getid,$xeoport,$employee_id, $_SESSION['MAILTABEL']);
  }
 }
	if ($_SESSION['FROM']) {
		$str_from = $_SESSION['FROM'];
	} else {
		$str_from = GetField(GET_EMPLOYEE_NAME. $employee_id) . "<br>" . $GLOBALS["ary_config"]["companyname"];
	}
 $refwtext = "<br><p>" . $ary_lang['email_regards'] . "</p><p>$str_from</p>
        <hr>$refwtext";
// var_dump ($_SESSION['refw']['text']);
 echo("<td valign='top' style='padding:10pt;'><form method='post' action='$WIZ?op=6' enctype='multipart/form-data'>
  <table width='100%' cellspacing='0' cellpadding='0' border='0' style='border-collapse:collapse;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'><tr valign='top' bgcolor='".$COLORSET[$COLORS][DARK]."'>
   <td width='65%'><table width='100%' cellspacing='0' cellpadding='4' border='0'>
    <tr>
     <th align='right'>From: </th>
     <td><input type='text' name='from' style='width:300pt;' value='".$sender."'></td>
    </tr>
    <tr>
     <th align='right'>To: </th>
     <td><input type='text' name='to' style='width:300pt;' value='$refwto'></td>
    </tr>
    <tr>
     <th align='right'>Cc: </th>
     <td><input type='text' name='cc' style='width:300pt;' VALUE='".($_SESSION['USE_CC'] ? $sender : '')."'></td>
    </tr>
    <tr>
     <th align='right'>Bcc: </th>
     <td><input type='text' name='bcc' style='width:300pt;'></td>
    </tr>
    <tr>
     <th align='right'>Subject: </th>
     <td><input type='text' name='subject' style='width:300pt;' value='$refwsubject'></td>
    </tr>
   </table></td>
   <td width='10%'><table width='100%' cellspacing='0' cellpadding='4' border='0'>
    <tr><td><b>Options:</b></td></tr>
    <tr><td><input type='checkbox' name='notification' value='1'> Ask for notification</td></tr>
    <tr><td><b>Attachments:</b></td></tr>
    <tr><td>
     <b>#1</b> <input type='file' name='atc[0]'><br>
     <b>#2</b> <input type='file' name='atc[1]'><br>
     <b>#3</b> <input type='file' name='atc[2]'>
    </td></tr>
   </table></td>
  </tr></table>
  ". AddEditorScript('message',FALSE) . "
  <input type='submit' value='Send e-mail' style='width:130pt;'> 
  <input type='reset' value='Reset form' style='width:130pt;'> 
  <input type='button' value='Back to Inbox' style='width:130pt;' onClick='javascript:window.location=\"$WIZ?op=2\"'>
 <textarea name='message' id='message' style='width:100%;height:300pt;'>".htmlentities($refwtext, ENT_QUOTES)."</textarea>
 </form></td>");
break;
 
//5:DELETE MESSAGES
case "5":
 echo("<td valign='top'><br>");
 POP3DeleteMessages();
 echo("<p><input type='button' value='Back to Inbox' style='height:15pt;' onClick='javascript:window.location=\"$WIZ?op=1\"'>
  <script language='javascript'>window.location=\"$WIZ?op=1\"</script>
 </td>");
 break;

//6:SEND EMAIL
case "6":
 $invalid_email_address ='';
 $email_address = array();
 echo("<td valign='top'><p>&nbsp;</p><p>&nbsp;</p>");
 $email_fields=array("from","to","cc","bcc");
 foreach($email_fields as $ef) {
  $eas=split('[;,]',$_POST[$ef]);
  foreach($eas as $ea) {
   if($ea=trim($ea)) {
    if(!ValidateEmailAddress($ea)) {
     $invalid_email_address.="<b>$ea</b> in <b>".ucfirst($ef)."</b> field<br>";
     echo("<br>");
    }
    $email_address[$ef].="$ea, ";
   }
  }
  $email_address[$ef]=substr($email_address[$ef],0,-2);
 }
 if($invalid_email_address || !$email_address['to']) {
  ShowMessage("ERROR!","<p>Error during delivering mail.</p>\n<p>E-mail address(es)<br>$invalid_email_address is(are) not valid e-mail address(es).</p>\n<p><a href='javascript:history.back()'><b>Back</b></a></p>");
 } else {
  $content_type="text/html";
  $message=explode("\n",$_POST['message']);
  $text = '';
  foreach($message as $line) $text.=stripslashes(rtrim($line))."\n";
  if (strpos($text, EMAIL_REMOVE_TEXT)!==FALSE) {
    ShowMessage("ERROR!","<p>Mail text '".EMAIL_REMOVE_TEXT."' not removed from mail.</p>\n<p>Mail command failed.</p>\n<p><a href='javascript:history.back()'><b>Back</b></a></p></td>");
    break; // The switch
  }
   	// Create new mail class
	$SMTPMail = new phpmailer();
	$SMTPMail->From     = $email_address['from'];
	if ($_SESSION['FROM']) {
		$SMTPMail->FromName = $_SESSION['FROM'];
	} else {
		$SMTPMail->FromName = GetField(GET_EMPLOYEE_NAME. $employee_id);
	}
	$SMTPMail->AddReplyTo($email_address['from']);
	$elements = preg_split("/[,;]+/", $email_address['to']);
	for ($i = 0; $i < count($elements); $i++) {
		$SMTPMail->AddAddress($elements[$i]);
	}
	if ($email_address['cc']) {
		$elements = preg_split("/[,;]+/", $email_address['cc']);
		for ($i = 0; $i < count($elements); $i++) {
			$SMTPMail->AddCC($elements[$i]);
		}
	}
	if ($email_address['bcc']) {
		$elements = preg_split("/[,;]+/", $email_address['bcc']);
		for ($i = 0; $i < count($elements); $i++) {
			$SMTPMail->AddBCC($elements[$i]);
		}
	}
	
  for($i=0;$i<3;$i++) {
   if($_FILES['atc']['name'][$i]) {
	 $SMTPMail->AddAttachment($_FILES['atc']['tmp_name'][$i],
							  $_FILES['atc']['name'][$i]);
/*    $content_type="multipart/mixed;\n  charset=\"iso-8859-1\";\n  boundary=\"$BOUNDARY\"";
    $headertext="This is a multi-part message in MIME format.\n\n--$BOUNDARY\nContent-Type: text/plain;\n  charset=\"iso-8859-1\"\nContent-Transfer-Encoding: quoted-printable\n\n";
    $footertext="--$BOUNDARY--\n";
    $fattach=@fopen($_FILES['atc']['tmp_name'][$i],"rb");
    $attach=chunk_split(base64_encode(@fread($fattach,@filesize($_FILES['atc']['tmp_name'][$i]))));
    @fclose($fattach);
    $text.="\n--$BOUNDARY\nContent-Type: ".$_FILES['atc']['type'][$i].";\n  charset=\"iso-8859-1\";\n  name=\"".$_FILES['atc']['name'][$i]."\"\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment; filename=\"".$_FILES['atc']['name'][$i]."\"\n\n$attach\n";
*/	
   }
  }
  //$text=$headertext.$text.$footertext;

  /*
  $headermail="From: $email_address[from]\r\nReply-to: $email_address[from]\r\n".(($email_address['cc'])?"Cc: $email_address[cc]\r\n":"").(($email_address['bcc'])?"Bcc: $email_address[bcc]\r\n":"")."MIME-Version: 1.0\r\nContent-Type: $content_type\r\nX-Mailer: $VER[NAME] $VER[MAJOR].$VER[MINOR]\r\n";
*/
  if(isset($_POST['notification'])) {
	//$headermail.="Disposition-Notification-To: $email_address[from]\r\n";
	$SMTPMail->ConfirmReadingTo = $email_address['from'];
  }
  $h2t =& new html2text($text );
  $text = $emailheader . "<body>\n"."$text"."</body></html>";

  //Send e-mail
	if (EXTERNAL_SMTP_SERVER) {
		$SMTPMail->Host     = EXTERNAL_SMTP_SERVER;
		$SMTPMail->Mailer   = "smtp";
	} else { // Use normail PHP mail().
		$SMTPMail->Mailer   = "mail";
	}
	$SMTPMail->Subject  = $_POST['subject'];
	$SMTPMail->Body     = $text;
	$SMTPMail->AltBody  = $h2t->get_text();
	$sentMailStatus = $SMTPMail->Send();
  /*
  if(EXTERNAL_SMTP_SERVER) {
    //send mail with external SMTP server
    $SMTPMail = new NamekoSendMailWithExternalSMTPServer(EXTERNAL_SMTP_SERVER);
    $SMTPMail->setMailParameters($email_address['from'], $email_address['to'], $headermail, $_POST['subject'], $text);
    $sentMailStatus = $SMTPMail->sendMailThroughExternalSMTPServer();
  } else {
    //send mail with PHP build-in mail() command
    $sentMailStatus = @mail("$email_address[to]",
							"$_POST[subject]",
							$text,
							"$headermail",
							"-f$email_address[from]");
  }
  */

  //Output sending mail result
  if($sentMailStatus) {
   ShowMessage("SUCCESS!","<p>Mail correctly delivered.</p>\n<p><a href='$WIZ?op=2'><b>Back to Inbox</b></a></p>");
  } else {
   ShowMessage("ERROR!","<p>Error during delivering mail.<br>$SMTPMail->ErrorInfo</p>\n<p>Mail command failed.</p>\n<p><a href='javascript:history.back()'><b>Back</b></a></p>");
  }

 }
 echo("</td>");
 break;

//999:CREDITS
case "999":
 echo("<td valign='top'>
  <p><br><b>Maintainer</b>:<br>
   &nbsp; <span class='title'>Marco Avidano</span>
  </p>
  <p><b>Thanks to</b>:<br>
   &nbsp; <span class='title'>Guenter (bug report [ver. 0.8.1])</span><br>
   &nbsp; <span class='title'>Sven</span> (bug report [ver. 0.6.1])<br>
   &nbsp; <span class='title'>Fred Bonani</span> (bug report [ver. 0.6.1, 0.4.4, 0.4.3])<br>
   &nbsp; <span class='title'>Steven Albarracin</span> (bug report [ver. 0.6.1, 0.5.3, 0.4.4])<br>
   &nbsp; <span class='title'>Simon Hickman</span> (bug report [ver. 0.4.3])<br>
   &nbsp; <span class='title'>Philip Chapman-Bell</span> (bug report [ver. 0.2.2])<br>
   &nbsp; <span class='title'>Roberto Bertuol</span><br>
  </p>
  <p><b>Some information about this program</b>:<br>
   &nbsp; Project name: <span class='title'>$VER[NAME]</span><br>
   &nbsp; Major version: <span class='title'>$VER[MAJOR]</span><br>
   &nbsp; Minor version: <span class='title'>$VER[MINOR]</span><br>
   &nbsp; Build: <span class='title'>$VER[BUILD]</span><br>
   &nbsp; Shortly: <span class='title'>$VER[MAJOR].$VER[MINOR]</span><br>
   &nbsp; Web site: <span class='title'>$VER[WEB]</span><br>
   &nbsp; URL: <a href='$VER[URL]' target='_blank'>$VER[URL]</a>
  </p>
  <p><b>Support my work</b>:<br>
   <span class='title'>Nameko</span> is totally free. I to not make any profit by its development and maintenance.<br>
   If you think it's great and useful, you can make me a little donation through Paypal.<br>
   Not a lot: only 2 or 3 Euros (or dollars, it's the same for me), and I'll drink a pineapple juice to yours health!<br>
   If you want go to:<br>
    <a href='https://www.paypal.com/xclick/business=paypal%40wiz.homelinux.net&item_name=Wiz%27s+Shelf+-+Nameko&no_note=1&tax=0&currency_code=EUR' target='_blank'>https://www.paypal.com/xclick/business=paypal%40wiz.homelinux.net&item_name=Wiz%27s+Shelf+-+Nameko&no_note=1&tax=0&currency_code=EUR</a><br>
   and fill the Paypal form to make me a donation.<br>
   Thank you in advance!
  </p>
  <p><b>License</b>:<br>
   Copyright (C) 2004  Marco Avidano<br>
   This program is free software; you can redistribute it and/or modify<br>
   it under the terms of the GNU General Public License as published by<br>
   the Free Software Foundation; either version 2 of the License, or<br>
   (at your option) any later version.<br>
   This program is distributed in the hope that it will be useful,<br>
   but WITHOUT ANY WARRANTY; without even the implied warranty of<br>
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the<br>
   GNU General Public License for more details.<br>
   You should have received a copy of the GNU General Public License<br>
   along with this program; if not, write to the Free Software<br>
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA<br>
   See <a href='http://www.gnu.org/licenses/gpl.html' target='_blank'>http://www.gnu.org/licenses/gpl.html</a> for the complete text of the license.
  </p>
  <p><b>Something else</b>:<br>
   &nbsp; &quot;I will suppose, then, not that a Deity, who is sovereignly good and the fountain<br>
   &nbsp; of truth but that some Malignant Demon, who is at once potent and deceitful,<br>
   &nbsp; has employed all his artifice to deceive me.<br>
   &nbsp; I will suppose that Paradise, the sky, the earth, colors, and all external things,<br>
   &nbsp; are nothing better than the illusions of dreams, by means of which this being<br>
   &nbsp; has laid snares for my credulity.<br>
   &nbsp; I will consider myself as without hands, eyes, flesh, blood, or any of the senses,<br>
   &nbsp; nevetheless I will falsely believe that I am in possession of all of these.&quot;<br>
   &nbsp; - Descartes, &quot;Of the Things of Which We May Doubt&quot;, 1641.
  </p>
  <p>&nbsp;</p>
 </td>");
 break;
 
default:
 if(isset($_GET['toggle_delete'])) 
 	$xeoport->query("UPDATE " . $_SESSION['MAILTABEL'] 
 				 . " SET cancel = !cancel 
 						   		  || 
 						          cancel IS NULL 
 	        		 WHERE xp_nr = '".$_GET['toggle_delete']."'");
 $showRead = GetCheckbox('Read') == '0' ? '' : '2'; 
 $showRe = GetCheckbox('Re') == '0' ? '' : '3'; 
 $showFwd = GetCheckbox('Fwd') == '0' ? '' : '4'; 
 $showDone = GetCheckbox('Done') == '0' ? '' : '5'; 
 $showDel = GetCheckbox('Del') == '0' ? '' : '1';

 $int_ContactID = GetSetFormVar('contactID');
 $mail_sql = " FROM " . $_SESSION['MAILTABEL'] . " ";
 if ($showDel) {
    $mail_sql .= queryparm('cancel', $showDel, $mail_sql, 0);
 } else {
    $mail_sql .= " WHERE cancel IS NULL ";
 } 
 if ($showRead
 	 ||
	 $showRe
	 ||
	 $showFwd
	 ||
	 $showDone
     ||
     $int_ContactID) {
     if (!$showDel) $mail_sql = $mail_sql . " AND ";
     $mail_sql.=queryparm('xp_status', $showRead, $mail_sql, 0, 'OR');
     $mail_sql.=queryparm('xp_status', $showRe, $mail_sql, 0, 'OR');
     $mail_sql.=queryparm('xp_status', $showFwd, $mail_sql, 0, 'OR');
     $mail_sql.=queryparm('xp_status', $showDone, $mail_sql, 0, 'OR');
     $mail_sql.=queryparm('ContactID', $int_ContactID, $mail_sql, 0, 'AND');
 } else {
     $mail_sql .=  " AND (xp_status IS NULL or xp_status = '0' or xp_status ='" . EMAIL_STATUS_DISABELD . "' or xp_status ='" . EMAIL_STATUS_ALREADY_DISABELD . "' or xp_status = '" . EMAIL_STATUS_NOT_IN_THE_LIST . "') "; 
 }
    $next = isset($_POST['next']) ;
    $priv = isset($_POST['priv']) ;
    
    $startrec = isset($_POST['startrec']) ? $_POST['startrec'] : 0;
    
    if ($next||$priv) {
        if ($next) {
           $startrec -= LIMITSIZE;
        } else if ($priv) {
           $startrec += LIMITSIZE;
        }
    } 
    
 $mail_sql .=  " ORDER BY xp_date_iso DESC, xp_time_iso DESC"; 
 //echo $mail_sql;
 $mailheaders = $xeoport->query("SELECT xp_nr $mail_sql");
 $numberofrecords = mysql_Numrows($mailheaders);
 $mailheaders = $xeoport->query("SELECT * $mail_sql LIMIT $startrec, ". LIMITSIZE); 

 echo("<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name=\"inboxform\" id=\"inboxform\">");
 echo "<script TYPE='text/javascript' language='JavaScript'>
		var mailtimerID;
		
		function refreshmail() {
			document.inboxform.submit();
		}
		
		mailtimerID = setInterval('refreshmail()',1000*60*5); // 5min.
		</script>";

    $pagetotal = $numberofrecords/LIMITSIZE +1;
    $pagenum =($numberofrecords/LIMITSIZE - $startrec/LIMITSIZE) +1;
    echo "<tr><td align='right' valign='top' style='padding:10pt;'>";
    echo 'Pagina <INPUT TYPE="text" NAME="page" SIZE="3" value="'.(int)$pagenum.'" OnChange="startrec.value = ('.(int)$pagetotal.' - page.value -1) * '.LIMITSIZE.' ;">';
    echo ' van '. (int)$pagetotal;
    
    if ($numberofrecords > LIMITSIZE) {
        if ($numberofrecords-LIMITSIZE> $startrec) {		
            echo '		<INPUT TYPE="submit" NAME="priv" value="<" CLASS="button">';
        }
        if ($startrec > 0) {
            echo '		<INPUT TYPE="submit" NAME="next" value=">" CLASS="button">';
        }
        echo '		<INPUT TYPE="hidden" NAME="startrec" value="'.$startrec.'">';
    }

 echo " <INPUT TYPE=submit Value='Filter'> ";
 echo "Customer ID <INPUT TYPE=\"text\" TABINDEX='10' NAME=\"contactID\" SIZE=\"3\" CLASS=\"form\" value='$int_ContactID'> Name ";
 echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "inboxform.ContactID", "cust", 30, "", 11);    
 echo   " Read".MakeCheckbox('Read', $showRead).
        "| Re".MakeCheckbox('Re', $showRe).
        "| Fwd".MakeCheckbox('Fwd', $showFwd).
        "| Done".MakeCheckbox('Done', $showDone).
        "| Del".MakeCheckbox('Del', $showDel)."</td></tr>
  <tr><td>
  <table width='100%' cellspacing='0' cellpadding='0' border='1' style='border-collapse:collapse;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'>
  <tr bgcolor='".$COLORSET[$COLORS]['DARK']."'>
    <td width='18%' class='title' style='padding:5pt;'><b>From</b></td>
    <td width='50%' class='title' style='padding:5pt;'><b>Subject</b></td>
    <td width='10%' class='title' style='padding:5pt;'><b>Date</b></td>
    <td width='3%' class='title' style='padding:5pt;'><b>ID</b></td>
    <td width='16%' class='title' style='padding:5pt;' align='right'><b>Status</b></td>
    <td width='6%' class='title' style='padding:5pt;' align='right'><b>Size</b></td>
    <th width='1%' class='title' style='padding:5pt;'>del <input type='checkbox' name='delinvert' onChange=\"javascript:inverse_selection('inboxform', 'delcheck')\"></th>
   </tr>";

   while ($obj_mailheader=mysql_fetch_object($mailheaders)) {

	// Check of the mail a returning error  mail is. 
	// Only unread mail will be checkt.
	// If it is a returning error  mail. The mail will be disabeld from the mailing list.
	// And the status will be set.
	$header = MessageParseHeader(split("\r\n",$obj_mailheader->xp_header_raw));	
	if (isset($header["x-failed-recipients"]) && $obj_mailheader->xp_status == 0) {
		$result = $iwex->query("SELECT mailing_yn FROM Personen WHERE email = '" . $header["x-failed-recipients"] . "'");
			if ($obj_mail_check = mysql_fetch_object($result)) {
				if ($obj_mail_check->mailing_yn) {
					$iwex->query("UPDATE Personen SET mailing_yn = 0 WHERE email = '" . $header["x-failed-recipients"] . "'");
					$status = EMAIL_STATUS_DISABELD;
				} else {
					$status = EMAIL_STATUS_ALREADY_DISABELD;
				}
			} else {
			$status = EMAIL_STATUS_NOT_IN_THE_LIST;
		}
		$xeoport->query("UPDATE " .  $_SESSION['MAILTABEL'] . " SET xp_status = $status WHERE xp_nr = '" . $obj_mailheader->xp_nr . "'");
	}
	/* Check if this is an email from our system that should be auto read and stored */
	$ary_comfirm_subjects = array(ORDER_CONFIRMATION_NL,
								  SHIP_CONFIRMATION_NL,
								  SALES_PROPOSAL_NL,
								  YOUR_INVOICE_NL,
								  INVOICE_STILL_OPEN_NL);
	preg_match('/\w+/',
			   htmlentities($header['subject']),
			   &$ary_results);
	//echo "<pre>". var_dump($ary_results)."</pre>";
	if (strpos(htmlentities($header['from']), DEFAULT_DOMAIN)
		&&
		in_array($ary_results[0], 
				 $ary_comfirm_subjects)) {
		if ($int_contact_mail_id = GetField("SELECT contacts.ContactID
										 FROM contacts 
										 INNER JOIN Personen ON contacts.ContactID = Personen.ContactID
										 WHERE Personen.email = '".htmlentities($header['to'])."' 
											   OR
											   contacts.email = '".htmlentities($header['to'])."'")) {
			$xeoport->query("UPDATE ". $_SESSION['MAILTABEL'] . 
							" SET xp_status = ".EMAIL_STATUS_VERWERKT.
							", ContactID = '$int_contact_mail_id'".
							" WHERE xp_nr = '$obj_mailheader->xp_nr'");
        }
	}
	

   echo("<tr bgcolor='".$COLORSET[$COLORS][MEDIUM]."'
 			onMouseOver='javascript:this.style.backgroundColor=\"".$COLORSET[$COLORS][LINE]."\"'
			onMouseOut='javascript:this.style.backgroundColor=\"".$COLORSET[$COLORS][MEDIUM]."\"'>
		<td width='18%' style='padding:5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'
		 	OnClick='javascript:location.replace(\"$WIZ?op=3&id=".$obj_mailheader->xp_nr."\");'>".$obj_mailheader->xp_from_full."
		</td>
		<td width='50%' style='padding:5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;
			".(($obj_mailheader->xp_status)?"":"font-weight:bold;")."'
			OnClick='javascript:location.replace(\"$WIZ?op=3&id=".$obj_mailheader->xp_nr."\");'>".
			(strlen($obj_mailheader->xp_attachments) ? ATTACHEMNT_IMAGE:"")." ".$obj_mailheader->xp_subject_text."
		</td>
		<td width='10%' style='padding:5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'>".
			$obj_mailheader->xp_date_iso." ".$obj_mailheader->xp_time_iso."
		</td>
	    <td width='3%' align=right style='padding:5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'>".
			$obj_mailheader->ContactID."
		</td>
		<td width='16%' style='padding:5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'
			 align='right'>".GetStatus($obj_mailheader->xp_nr,$xeoport,$iwex, $_SESSION['MAILTABEL'])."
		</td>
	    <td width='6%' style='padding:5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'
			 align='right'>".sprintf("%.2f",$obj_mailheader->xp_size/1024)." KB</td>
        <td width='1%' style='padding:0pt 5pt 0pt
			 5pt;border:solid ".$COLORSET[$COLORS][LINE].";border-width:1pt 0pt 1pt 0pt;'><input type='checkbox'
			 name='del[$obj_mailheader->xp_nr]' id='delcheck' ".($obj_mailheader->cancel ? "CHECKED" : "")
            ."'></td>
		</tr>");
 }
 
 echo("</table>\n</td>");
 mysql_free_result($mailheaders);
 break;
}



?>
    </tr>
    <tr valign="middle" height="20"><td style="border-top:1pt solid <?php$COLORSET[$COLORS][LINE]?>"><table cellspacing="0" cellpadding="0" width="100%" height="100%" border="0"><tr valign="middle">
      <td> <b>Mailbox: <?php echo $_SESSION['EMAIL']; ?></b></td>
	  <td align="right"><b>
      Colorset: <select name="colorset" onChange="javascript:window.location='<?php$WIZ?>?op=<?phpisset($_REQUEST['op'])?$_REQUEST['op']:''?>&id=<?phpisset($_REQUEST['id'])?$_REQUEST['id']:''?>&colorset='+this.value"><?phpforeach($COLORSET as $cs_n=>$cs_d) echo("<option value='$cs_n' ".(($cs_n==$COLORS)?"selected":"").">$cs_n</option>\n"); ?></select> &nbsp; | &nbsp;
      Font size: <select name="fontsize" onChange="javascript:window.location='<?php$WIZ?>?op=<?phpisset($_REQUEST['op'])?$_REQUEST['op']:''?>&id=<?phpisset($_REQUEST['id'])?$_REQUEST['id']:''?>&fontsize='+this.value"><?phpfor($i=7;$i<16;$i++) echo("<option value='$i' ".(($i==$_SESSION[FONTSIZE])?"selected":"").">$i pt</option>\n"); ?></select> &nbsp; | &nbsp;
      Functions: 
      <?phpif (isset($_REQUEST['id'])) {
			echo " <a href='$WIZ?op=2'>Back to Inbox</a> |";
		 }
			echo "<a href='$WIZ?op=4'>Compose new e-mail</a> |";
      
      	echo "<a href='<?php$WIZ?>?op=999'>Credits</a> |";
		if (!$showDel) {
		    echo "<input type='hidden' name='delall' value=''>";
		    echo "<a href='#' onClick='javascript:document.inboxform.delall.value=1;document.inboxform.submit()'>Del Selection</a> |";
		}
        echo "</form>";
	  ?>
     </b></td>
    </tr></table></td></tr>
   </table>
  </td>
 </tr>
</table>
</body>
</html>


