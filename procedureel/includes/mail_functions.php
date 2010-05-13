<?php

define("MESSAGES","MESSAGES");
define("CONTENT","CONTENT");
define("SIZE","SIZE");
define("COLORS","COLORS");
define("DARK","DARK");
define("FONTSIZE","FONTSIZE");
define("CHARSET","CHARSET");
define("SCRIPT_NAME","SCRIPT_NAME");
define("LINE","LINE");
define("MEDIUM","MEDIUM");
define("READ","READ");
define("DELETE","DELETE");
define("ATTACHEMNT_IMAGE","<img border=0 src='".IMAGES_URL."attachement.gif'>");

//*** CONFIGURE NAMEKO HERE *** START ***//
$DEFAULT_COLORSET="BLUE"; //GREY,VIOLET,GREEN,BLUE,BROWN
$DEFAULT_FONTSIZE=9; //integer from 7 to 16
$DEFAULT_CHARSET="english-iso-8859-1"; //see README_CHARSET
$DEFAULT_MAIL_PER_PAGE=10;
$USERS_POLICY="deny"; //allow, deny

$COLORSET=array(
 "GREY"=>array("GROUND"=>"#999999","DARK"=>"#DFDFDF","MEDIUM"=>"#E8E8E8","LIGHT"=>"#F7F7F7","LINE"=>"#7F7F7F","LINKS"=>"#000000"),
 "VIOLET"=>array("GROUND"=>"#CA6597","DARK"=>"#F6C5DB","MEDIUM"=>"#F3DAE8","LIGHT"=>"#FDEEF6","LINE"=>"#FE00BF","LINKS"=>"#FE4100"),
 "GREEN"=>array("GROUND"=>"#64C969","DARK"=>"#C4F5C9","MEDIUM"=>"#D9F2D9","LIGHT"=>"#EDFCED","LINE"=>"#2FFE00","LINKS"=>"#F21DAB"),
 "BLUE"=>array("GROUND"=>"#6699CC","DARK"=>"#C7DDF8","MEDIUM"=>"#DBEAF5","LIGHT"=>"#F0F8FF","LINE"=>"#00BFFF","LINKS"=>"#3E00FE"),
 "BROWN"=>array("GROUND"=>"#C98A64","DARK"=>"#F5D9C4","MEDIUM"=>"#F2E1D9","LIGHT"=>"#FCF2ED","LINE"=>"#FE2300","LINKS"=>"#2727F9")
);
$CHARSETS = array("afrikaans-iso-8859-1"=>"iso-8859-1", "afrikaans-utf-8"=>"utf-8", "albanian-iso-8859-1"=>"iso-8859-1", "albanian-utf-8"=>"utf-8", "arabic-utf-8"=>"utf-8", "arabic-windows-1256"=>"windows-1256",
 "azerbaijani-iso-8859-9"=>"iso-8859-9", "azerbaijani-utf-8"=>"utf-8", "bosnian-utf-8"=>"utf-8", "bosnian-windows-1250"=>"windows-1250", "brazilian_portuguese-iso-8859-1"=>"iso-8859-1", "brazilian_portuguese-utf-8"=>"utf-8",
 "bulgarian-koi8-r"=>"koi8-r", "bulgarian-utf-8"=>"utf-8", "bulgarian-windows-1251"=>"windows-1251", "catalan-iso-8859-1"=>"iso-8859-1", "catalan-utf-8"=>"utf-8", "chinese_big5-utf-8"=>"utf-8", "chinese_big5"=>"big5",
 "chinese_gb-utf-8"=>"utf-8", "chinese_gb"=>"gb2312", "croatian-iso-8859-2"=>"iso-8859-2", "croatian-utf-8"=>"utf-8", "croatian-windows-1250"=>"windows-1250", "czech-iso-8859-2"=>"iso-8859-2", "czech-utf-8"=>"utf-8",
 "czech-windows-1250"=>"windows-1250", "danish-iso-8859-1"=>"iso-8859-1", "danish-utf-8"=>"utf-8", "dutch-iso-8859-1"=>"iso-8859-1", "dutch-utf-8"=>"utf-8", "english-iso-8859-1"=>"iso-8859-1", "english-utf-8"=>"utf-8",
 "estonian-iso-8859-1"=>"iso-8859-1", "estonian-utf-8"=>"utf-8", "finnish-iso-8859-1"=>"iso-8859-1", "finnish-utf-8"=>"utf-8", "french-iso-8859-1"=>"iso-8859-1", "french-utf-8"=>"utf-8", "galician-iso-8859-1"=>"iso-8859-1",
 "galician-utf-8"=>"utf-8", "georgian-utf-8"=>"utf-8", "german-iso-8859-1"=>"iso-8859-1", "german-utf-8"=>"utf-8", "greek-iso-8859-7"=>"iso-8859-7", "greek-utf-8"=>"utf-8", "hebrew-iso-8859-8-i"=>"iso-8859-8-i", "hindi-utf-8"=>"utf-8",
 "hungarian-iso-8859-2"=>"iso-8859-2", "hungarian-utf-8"=>"utf-8", "indonesian-iso-8859-1"=>"iso-8859-1", "indonesian-utf-8"=>"utf-8", "italian-iso-8859-1"=>"iso-8859-1", "italian-utf-8"=>"utf-8", "japanese-euc"=>"euc-jp",
 "japanese-sjis"=>"SHIFT_JIS", "japanese-utf-8"=>"utf-8", "korean-ks_c_5601-1987"=>"ks_c_5601-1987", "latvian-utf-8"=>"utf-8", "latvian-windows-1257"=>"windows-1257", "lithuanian-utf-8"=>"utf-8", "lithuanian-windows-1257"=>"windows-1257",
 "malay-iso-8859-1"=>"iso-8859-1", "malay-utf-8"=>"utf-8", "norwegian-iso-8859-1"=>"iso-8859-1", "norwegian-utf-8"=>"utf-8", "persian-utf-8"=>"utf-8", "persian-windows-1256"=>"windows-1256", "polish-iso-8859-2"=>"iso-8859-2", "polish-utf-8"=>"utf-8",
 "portuguese-iso-8859-1"=>"iso-8859-1", "portuguese-utf-8"=>"utf-8", "romanian-iso-8859-1"=>"iso-8859-1", "romanian-utf-8"=>"utf-8", "russian-dos-866"=>"koi8-r", "russian-koi8-r"=>"koi8-r", "russian-utf-8"=>"utf-8", "russian-windows-1251"=>"windows-1251",
 "serbian_cyrillic-utf-8"=>"utf-8", "serbian_cyrillic-windows-1251"=>"utf-8", "serbian_latin-utf-8"=>"utf-8", "serbian_latin-windows-1250"=>"utf-8", "slovak-iso-8859-2"=>"iso-8859-2", "slovak-utf-8"=>"utf-8", "slovak-windows-1250"=>"windows-1250",
 "slovenian-iso-8859-2"=>"iso-8859-2", "slovenian-utf-8"=>"utf-8", "slovenian-windows-1250"=>"windows-1250", "spanish-iso-8859-1"=>"iso-8859-1", "spanish-utf-8"=>"utf-8", "swedish-iso-8859-1"=>"iso-8859-1", "swedish-utf-8"=>"utf-8",
 "thai-tis-620"=>"tis-620", "thai-utf-8"=>"utf-8", "turkish-iso-8859-9"=>"iso-8859-9", "turkish-utf-8"=>"utf-8", "ukrainian-utf-8"=>"utf-8", "ukrainian-windows-1251"=>"windows-1251");

$VER['NAME'] = 'Iwex inbox';
$VER['MAJOR'] = ' stageing ';
$VER['MINOR'] = ' 1.2';
//*** CONFIGURE NAMEKO HERE *** STOP ***//

function ShowMessage($title,$message) {
 $COLORSET=$GLOBALS['COLORSET'];
 $COLORS=$GLOBALS['COLORS'];
 echo("<table width='250' align='center' cellspacing='0' cellpadding='0' border='0' style='border-collapse:collapse;border:1pt solid ".$COLORSET[$COLORS][LINE].";'>
  <tr><th style='padding:5pt;' bgcolor='".$COLORSET[$COLORS][DARK]."'>$title</th></tr>
  <tr><td style='padding:10pt;' align='center'>$message</td></tr>
 </table>");
 return;
}

function POP3OpenConnectionAndLogin() {
 if(!$GLOBALS[SOCK]=@fsockopen($_SESSION[server],110)) return "1";
 $rs=@fgets($GLOBALS[SOCK],512);
 if($_SESSION[auth_type]=="apop") {
  $rs=split(" ",$rs);
  $secret=md5(trim($rs[count($rs)-1]).$_SESSION[password]);
  @fputs($GLOBALS[SOCK],"apop ".$_SESSION[username]." $secret\r\n");
  if(!strstr(@fgets($GLOBALS[SOCK],512),"+OK")) return "2";
 } else {
  @fputs($GLOBALS[SOCK],"user ".$_SESSION[username]."\r\n");
  $rs=@fgets($GLOBALS[SOCK],512);
  @fputs($GLOBALS[SOCK],"pass ".$_SESSION[password]."\r\n");
  if(!strstr(@fgets($GLOBALS[SOCK],512),"+OK")) return "2";
 }
 return "3";
}

/*function POP3RetrieveHeaders($start,$db) {
 if($start==0) $start=1;
 @fputs($GLOBALS[SOCK],"stat\r\n");
 $stat=split(" ",@fgets($GLOBALS[SOCK],512));
 if($stat[0]!="+OK") return "391";
 $_SESSION[MESSAGES][SIZE]=$stat[2];
 for($i=$start;$i<($stat[1]+1);$i++) {
  @fputs($GLOBALS[SOCK],"list $i\r\n");
  $list=split(" ",@fgets($GLOBALS[SOCK],512));
  if($list[0]!="+OK") return "392";
  $_SESSION[MESSAGES][CONTENT][$i][SIZE]=$list[2];
  $header="";
  fputs($GLOBALS[SOCK],"top $i 0\r\n");
  while(($rs=fgets($GLOBALS[SOCK],512))!=".\r\n") $header.=$rs;
  $_SESSION[MESSAGES][CONTENT][$i][HEADER]=$header;
  $_SESSION[MESSAGES][CONTENT][$i][READ]=0;
  $_SESSION[MESSAGES][CONTENT][$i][DELETE]=(-1);
 }
 return "31";
}*/


function POP3RetrieveMessage($i,$db, $table) {
 $sql = "SELECT * FROM $table WHERE xp_nr=$i;";
 $result = $db->query($sql);
 $obj_mail = mysql_fetch_object($result);
 if($obj_mail) { 
     $message = explode("\r\n", $obj_mail->xp_body_raw);
     MYSQL_FREE_RESULT($result);
 }
 return $message;
}

function POP3DeleteMessages() {
 POP3OpenConnectionAndLogin();
 for($i=1,$j=1;$i<count($_SESSION[MESSAGES][CONTENT])+1;$i++) {
  if($_SESSION[MESSAGES][CONTENT][$i][DELETE]>0) {
   fputs($GLOBALS[SOCK],"dele $i\r\n");
   $del=split(" ",fgets($GLOBALS[SOCK],512));
   echo(((trim($del[0])=="+OK")?"Message number <b>$i</b> deleted":"Error deleting message number <b>$i</b>")."<br>\n");
  } else {
   $new_message_list[$j]=$_SESSION[MESSAGES][CONTENT][$i];
   $j++;
  }
 }
 $_SESSION[MESSAGES][CONTENT]=$new_message_list;
 echo("<p><b>Wait while realoading messages...</b></p>\n");
 if($GLOBALS[SOCK]) POP3CloseConnection();
}

function POP3CloseConnection() {
 @fputs($GLOBALS[SOCK],"quit\r\n");
 @fclose($GLOBALS[SOCK]);
 sleep(1);
 return;
}

function MessageParseHeader($header) {
 $parsed_header = array ();
 $last_header = FALSE;
 for($j=0;$j<count($header);$j++) {
  $hd=split(":",$header[$j],2);
  if(preg_match_all("/\s/",$hd[0],$matches) || !isset($hd[1])) {
   if ($last_header) $parsed_header[$last_header].="\r\n".trim($header[$j]);
  } else {
   $last_header=strtolower($hd[0]);
   $parsed_header[$last_header] =((isset($parsed_header[$last_header]) && $parsed_header[$last_header]) ?"\r\n" : "")
								 .trim($hd[1]);
  }
 }
 if(is_array($parsed_header)) foreach($parsed_header as $hd_name=>$hd_content) {
  $start_enc_tag=$stop_enc_tag=0;
  $pre_text=$enc_text=$post_text="";
  while(1) {
   if(strstr($hd_content,"=?") && strstr($hd_content,"?=") && substr_count($hd_content,"?")>3) {
    $start_enc_tag=strpos($hd_content,"=?");
    $pre_text=substr($hd_content,0,$start_enc_tag);
    do {
     $stop_enc_tag=strpos($hd_content,"?=",$stop_enc_tag)+2;
     $enc_text=substr($hd_content,$start_enc_tag,$stop_enc_tag);
    } while (!(substr_count($enc_text,"?")>3));
    $enc_text=explode("?",$enc_text,5);
    switch(strtoupper($enc_text[2])) {
     case "B":
      $dec_text=base64_decode($enc_text[3]);
      break;
     case "Q":
     default:
      $dec_text=quoted_printable_decode($enc_text[3]);
      $dec_text=str_replace("_"," ",$dec_text);
      break;
    }
    $post_text=substr($hd_content,$stop_enc_tag);
    if(substr(ltrim($post_text),0,2)=="=?") $post_text=ltrim($post_text);
    $hd_content=$pre_text.$dec_text.$post_text;
    $parsed_header[$hd_name]=$hd_content;
   } else break;
  }
 }
 return $parsed_header;
}

function MessageRetrieveContent($header,$message) {
 isset($header["content-transfer-encoding"]) ?  $content_transfer_encoding=strtolower(trim($header["content-transfer-encoding"])) :  $content_transfer_encoding="";
 if ($content_transfer_encoding=="") $content_transfer_encoding="8bit";
 $message=TextDecode($content_transfer_encoding,$message);
//echo "<pre>------------1---------";
 $content_type = isset($header["content-type"]) ? split(";",$header["content-type"],2) : array("");
//var_dump($content_type);
 for($i=0;$i<count($content_type);$i++) $content_type[$i]=trim($content_type[$i]);
 if($content_type[0]=="") $content_type[0]="text/plain";
 //echo $content_type[0].'<br><br>';
 if(stristr($content_type[0],"multipart/") || stristr($content_type[0],"message/")) $content_type[0]="multipart";
 if(isset($header["content-disposition"]) && !stristr($header["content-disposition"],"inline")) {
  if($header) $GLOBALS['parsed_message']["attachments"][]=array("header"=>$header, "content"=>@implode("\n",$message));
 } else {
 //echo $content_type[0].'<br>';
  switch(trim(strtolower($content_type[0]))) {
   case "text/plain":
    $message=nl2br(htmlentities(implode("\n",$message)));
    if(trim($message)) $GLOBALS['parsed_message']["text-plain"]=$message;
    break;
   case "text/html":
    $GLOBALS['parsed_message']["text-html"]=implode("\n",$message);
    break;
   case "multipart":
    $content_type[1]=split(";",$content_type[1]);
    foreach($content_type[1] as $ct_pars) {
     if(stristr($ct_pars,"boundary")) {
      $ct_pars=split("=",trim($ct_pars),2);
      if(strtolower($ct_pars[0])=="boundary") $boundary=str_replace("\"","",$ct_pars[1]);
     }
    }
    if($boundary) {
    $parts=MessageSplitMultipart($boundary,$message);
     foreach($parts as $part) ParsePart($part);
    } else {
     $GLOBALS[parsed_message]["text-plain"]="<p>".$GLOBALS[VER][NAME]." ".$GLOBALS[VER][MAJOR].".".$GLOBALS[VER][MINOR]."<br>Sorry, I'm unable to read this mail.<br>Please, report this error to <a href='http://wiz.homelinux.net/bugreport.php?prj=Nameko'>Wiz's Shelf Staff</a></p>";
    }
    break;
   default:
    if($header) $GLOBALS['parsed_message']["attachments"][]=array("header"=>$header, "content"=>@implode("\n",$message));
    break;
  }
 }
 return($GLOBALS['parsed_message']);
}

function MessageSplitMultipart($boundary,$text) {
 $parts=array();
 $tmp=array();
 foreach($text as $line) {
  if(strstr($line,"--$boundary")) {
   $parts[]=$tmp;
   $tmp=array();
  } else $tmp[]=$line;
 }
 for($i=0;$i<count($parts);$i++) $parts[$i]=explode("\n",trim(implode("\n",$parts[$i])));
 return $parts;
 
}

function ParsePart($text) {
 $headerpart=array();
 $contentpart=array();
 $noheader=0;
 foreach($text as $riga) {
  if(!$riga) $noheader++;
  if($noheader) $contentpart[]=$riga;
  else $headerpart[]=$riga;
 }
 if(count($contentpart)==0) {
  $contentpart=$headerpart;
  $headerpart=array();
 }
 MessageRetrieveContent(MessageParseHeader($headerpart),explode("\n",trim(implode("\n",$contentpart))));
}

function TextDecode($encoding,$text) {
 switch($encoding) {
  case "quoted-printable":
   $dec_text=explode("\n",quoted_printable_decode(implode("\n",$text)));
   break;
  case "base64":
   for($i=0;$i<count($text);$i++) $text[$i]=trim($text[$i]);
   $dec_text=explode("\n",base64_decode(@implode("",$text)));
   break;
  case "7bit":
  case "8bit":
  case "binary":
  default:
   $dec_text=$text;
   break;
 }
 return $dec_text;
}

function ValidateEmailAddress($addr) {
 $addr_len=strlen($addr);
 $at_pos=strpos($addr,"@");
 $lastdot_pos=strrpos($addr,".");
 for($i=0;$i<$addr_len;$i++) {
  if(!strstr($GLOBALS['LEGAL_CHARS'],$addr[$i])) return 0;
 }
 if(($addr[0]==".") || ($addr[0]=="-") || ($at_pos<1) || ($at_pos>($addr_len-5)) || ($at_pos>($lastdot_pos-2)) || ($lastdot_pos>$addr_len-3) || (substr_count($addr,"@")>1)) return 0;
 return 1;
}

function GetAddressFromFromHeader($addr) {
 $atpos=strpos($addr,"@");
 $minpos=strpos($addr,"<");
 $majpos=strpos($addr,">");
 $fromstart=0;
 $fromend=strlen($addr);
 if($minpos<$atpos && $majpos>$atpos) {
  $fromstart=$minpos+1;
  $fromend=$majpos;
 }
 return substr($addr,$fromstart,$fromend-$fromstart);
}

function FlushTmpDir() {
 if(!is_dir("tmp_nameko")) @mkdir("tmp_nameko",0700);
 if(is_dir("tmp_nameko")) {
  $tmpdir=opendir("tmp_nameko");
  while(($tmpfile=readdir($tmpdir))!=false) {
   if(($tmpfile!="..")&&($tmpfile!=".")) {
    $tmpfiledate=filectime("tmp_nameko/$tmpfile");
    if((filectime("tmp_nameko/$tmpfile"))<(time()-300)) @unlink("tmp_nameko/$tmpfile");
   }
  }
  closedir($tmpdir);
  return 1;
 } else {
  return 0;
 }
}

function UpdateMessageStatus($status,$id,$db,$employee_id, $table) {
    $sql = "UPDATE $table SET xp_status=$status, xp_lastchangeuserid='$employee_id' WHERE xp_nr=$id;";
    if ($result = $db->query($sql)) Return TRUE;
 return FALSE;
}

function GetStatus($msgid,$msgdb,$systemdb, $table) {
 global $employee_id;
 $sql = "SELECT * FROM $table WHERE xp_nr=$msgid;";
 $result = $msgdb->query($sql);
 $statustext = 'Nieuw / ongelezen';
 
 if ($obj_mail = mysql_fetch_object($result)) {
    if ($obj_mail->xp_status) {
        $status = Getfield("SELECT text FROM listbox WHERE category='5' AND value='".$obj_mail->xp_status."'",$systemdb);
        $lastchangeuser = Getfield("SELECT CONCAT_WS(' ', FirstName, middlename, LastName) fullname FROM employees WHERE EmployeeID='".$obj_mail->xp_lastchangeuserid."'",$systemdb);
        if ($employee_id == $obj_mail->xp_lastchangeuserid) {
            $color = "GREEN";
        } else {
            $color = "RED"; // Other user has done this e-mail.
        }
		
		if ($obj_mail->xp_status == EMAIL_STATUS_DISABELD 
		|| 
		$obj_mail->xp_status == EMAIL_STATUS_ALREADY_DISABELD
		|| 
		$obj_mail->xp_status == EMAIL_STATUS_NOT_IN_THE_LIST) {
			$statustext = "<FONT COLOR=$color>Mailing check / $status</FONT>";
		} else {
			$statustext = "<FONT COLOR=$color>$status / $lastchangeuser</FONT>";
		}
    }
 }
 Return $statustext;
}

//===============================================
// NamekoSendMailWithExternalSMTPServer Class
//===============================================

class NamekoSendMailWithExternalSMTPServer {
  var $SMTPServer;
  var $sender;
  var $destination;
  var $headers;
  var $body;
  var $SMTPConnection;

  function NamekoSendMailWithExternalSMTPServer($SMTPServer) {
    $this->SMTPServer = $SMTPServer;
  }

  function setMailParameters($sender, $destionation, $headers, $subject, $body) {
    $this->sender = $sender;
    $this->destination = $destionation;
    $this->headers = "Subject: $subject\nTo: $destionation\n$headers";
    $this->body = $body;
  }

  function sendMailThroughExternalSMTPServer() {
    if(!$this->sender || !$this->destination || !$this->headers || !$this->body) return false;
    if($this->_openSTMPConnection() && $this->_sendMailFromCommand() && $this->_sendRcptToCommand() && $this->_sendDataCommand()) {
      $this->_closeSTMPConnection();
      return true;
    } else {
      return false;
    }
  }

  function _openSTMPConnection() {
    $this->SMTPConnection = @fsockopen($this->SMTPServer, 25);
    if(!$this->SMTPConnection) return false;
    $rs = @fgets($this->SMTPConnection, 512);
    @fputs($this->SMTPConnection, "helo $_ENV[hostname]\r\n");
    $rs = @fgets($this->SMTPConnection, 512);
    return true;
  }

  function _sendMailFromCommand() {
    @fputs($this->SMTPConnection, "mail from: $this->sender\r\n");
    if(strstr(@fgets($this->SMTPConnection, 512), "250")) return true;
    else return false;
  }

  function _sendRcptToCommand() {
    @fputs($this->SMTPConnection, "rcpt to: $this->destination\r\n");
    if(strstr(@fgets($this->SMTPConnection, 512), "250")) return true;
    else return false;
  }

  function _sendDataCommand() {
    @fputs($this->SMTPConnection, "data\r\n");
    if(strstr(@fgets($this->SMTPConnection, 512), "354")) {
      @fputs($this->SMTPConnection, "$this->headers\r\n\r\n$this->body\r\n.\r\n");
      if(strstr(@fgets($this->SMTPConnection, 512), "250")) return true;
      else return false;
    }
    else return false;
  }

  function _closeSTMPConnection() {
    @fputs($this->SMTPConnection, "quit\r\n");
    $rs = @fgets($this->SMTPConnection, 512);
  }
}

/*********************************************************
 * Function     : MailWebUser
 * will mail an external user their login stuff and return the mail text
 * Input        : $str_user username
                  $str_pwd password
                  $int_languageID 
 * Returns      : mailtext, or '' if nothing
 *********************************************************/

function MailWebUser($str_user,
                     $str_pwd,
                     $int_languageID,
                     $str_email,
                     $str_subject='')

{
  $returnvar = FALSE;
  if ($str_user
      &&
      $str_pwd
      &&
      $int_languageID
      &&
      $str_email)
  {
	global $emailheader; // Get the default email header.
    $ary_text = Gettexten(DB_EMAIL_NEWACCOUNT, $int_languageID);
    $str_subject = $ary_text[0];
    $msg = str_replace(DB_NEWUSER_NAME, $str_user, $ary_text[1]);
    $msg = str_replace(DB_NEWUSER_PASSWORD, $str_pwd, $msg);
    $msg = str_replace(DB_DEALERLOGIN, $GLOBALS["ary_config"]["dealersitelink"] , $msg);
	if(EXTERNAL_MAILING_SMTP_SERVER) {
        //send mail with external SMTP server
        $SMTPMail = new phpmailer();
        $SMTPMail->From     = $GLOBALS["ary_config"]["email.sales"];
		$SMTPMail->FromName = $GLOBALS["ary_config"]["emailname.sales"];
        $SMTPMail->Host     = EXTERNAL_MAILING_SMTP_SERVER;
        $SMTPMail->Mailer   = "smtp";
        if (EXTERNAL_MAILING_SMTP_SERVER_USER) {
            $SMTPMail->SMTPAuth = TRUE;
            $SMTPMail->Username = EXTERNAL_MAILING_SMTP_SERVER_USER;
            $SMTPMail->Password = EXTERNAL_MAILING_SMTP_SERVER_PASSWORD;
        }
        $SMTPMail->Subject  = $str_subject;
		$SMTPMail->Body     = "$emailheader<body>$msg<br></body></html>";
		$SMTPMail->AltBody  = strip_tags($msg);
        $SMTPMail->AddAddress($str_email);
		$SMTPMail->AddCC($GLOBALS["ary_config"]["email.sales"]);
        $bl_result = $SMTPMail->Send();
		//echo "send using phpmailer result = '$bl_result'";
    } else {
        //send mail with PHP build-in mail() command
        $bl_result = mail($str_email, 
						  $str_subject,
						  "$emailheader<body>$msg<br></body></html>", 
						  "From: ". $GLOBALS["ary_config"]["email.sales"] 
						  	."\nCc: ". $GLOBALS["ary_config"]["email.sales"]
						  	."\nContent-type: text/html");
		//echo "send using mail result = '$bl_result'";
    }
	
    if (!$bl_result) $msg .= "Messages send failed<br>\n";
    
    $returnvar = $msg;
  }
  return $returnvar;
}
?>
