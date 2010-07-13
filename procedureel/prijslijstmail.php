<?php

include ("include.php");

/**
 * Function     : getmailingmessage
 * Input        : messagereference
 *                mailing db instance
 * Returns      : array[1] subject, [2] body, [3] fromname  [4] formemail etc all the fields
 **/
function getmailingmessage($int_msg,
                           $db_instance)
{
  if ($int_msg) {
    $msg_sql = "SELECT subject, 
					   body,
					   fromname,
					   fromemail,
					   testdate,
					   senddate
				FROM mailing
				WHERE mailingref = '$int_msg';";
    $result = $db_instance->query($msg_sql);
    $returnvar = mysql_fetch_row($result);
	mysql_free_result($result);
  } else {
    $returnvar = FALSE;
  }
  return $returnvar;
}

$str_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'list'; 
//select query
$str_id = isset($_POST['id']) ? $_POST['id'] : FALSE;

$formname = 'mailform';

$name = $GLOBALS["ary_config"]["emailname.sales"];
$myemail = $GLOBALS["ary_config"]["email.sales"];

// Close the DB from common.php
mysql_close();

$DB_mailing = new DB($GLOBALS["ary_config"]["hostname.mailing"],
					 $GLOBALS["ary_config"]["database.mailing"],
					 $GLOBALS["ary_config"]["username.mailing"],
					 $GLOBALS["ary_config"]["password.mailing"]);
$DB_iwex = new DB();

// get messageid from uri or post
$int_message_id = isset($_REQUEST['mailingref']) ? $_REQUEST['mailingref'] : 0;
if ($int_message_id)   
{
  $ary_message = getmailingmessage($int_message_id, $DB_mailing);
  $str_subject = isset($_POST['onderwerp']) ? $_POST['onderwerp'] : $ary_message[0];
  $str_bericht = isset($_POST['bericht']) ? $_POST['bericht'] : $ary_message[1];
} else {
  $str_subject = '';
  $str_bericht = '';
}

// Print default Iwex HTML header.
printheader (COMPANYNAME . " prijslijst mailing",'kk', FALSE);
printIwexNav();

echo "<BODY ".get_bgcolor().">";
echo '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';

echo "<FORM NAME='$formname' METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n";
echo "<INPUT TYPE='hidden' NAME='action' VALUE=$str_action>";

switch ($str_action) 
{
  case 'delete':
    if($int_message_id){
      $sql = "DELETE FROM mailing 
              WHERE mailingref = '$int_message_id';";
      if ($DB_mailing->query($sql)) echo "Message $int_message_id deleted!";
    } else {
      echo "no message deleted, no id given or found";
    }
    //no break becasue after delete we go back to list
  case 'list':
    // list mailings
    $mailing_sql = "SELECT 
                      mailingref,
                      subject,
                      fromname,
                      fromemail,
                      testdate,
                      senddate,
                      'select'
                    FROM mailing 
                    ORDER BY senddate DESC, mailingref ;";
    echo show_table($mailing_sql, TRUE, $DB_mailing);
  break; 
  //end list  
  case 'save':
    if($int_message_id){
      $sql = "UPDATE mailing 
              SET subject = '$str_subject',
                body = '$str_bericht',
                fromname = '$name',
                fromemail = '$myemail'
              WHERE mailingref = '$int_message_id';";
    } else {
      $str_subject = $_POST['onderwerp'];
      $str_bericht = $_POST['bericht'];
      $int_rand = rand(); // Randum number for ref.
      $sql = "INSERT mailing 
              SET subject = '$str_subject',
                body = '$str_bericht',
                fromname = '$name',
                fromemail = '$myemail',
                mailingref = '$int_rand'";
      echo "Saved as new message!";
      $ary_message = getmailingmessage($int_rand, $DB_mailing);
      $str_subject = isset($_POST['onderwerp']) ? $_POST['onderwerp'] : $ary_message[0];
      $str_bericht = isset($_POST['bericht']) ? $_POST['bericht'] : $ary_message[1];
      $int_message_id = $int_rand;
    }      
    $DB_mailing->query($sql);
  //no break because after save we want to keep editing  
  case 'edit':
    // edit mailing content    
    echo include_javascript();
    $textarea_style = "style='width:100%;height:400pt;'";
    echo AddEditorScript('bericht',TRUE);
    echo "<FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n";
    echo "<TABLE BORDER=\"1\" CELLPADDING=\"5\" CELLSPACING=\"0\" WIDTH=\"100%\">\n";
    echo "<TR>\n";
    echo "<TD>Message ID: $int_message_id</TD><TD>Onderwerp:</TD>\n";
    echo "<TD><INPUT TYPE=\"text\" NAME=\"onderwerp\" ID='onderwerp' SIZE=\"50\" CLASS=\"form\" VALUE=\"$str_subject\">\n";
    // check the subject
    echo "<INPUT TYPE='hidden' NAME='mailingref' VALUE=$int_message_id></TD>\n";
    echo "<TD><INPUT TYPE=\"button\" NAME=\"update\" VALUE=\"Update screen\" CLASS=\"button\" 
                      onclick='$formname.action.value=\"edit\";
                               $formname.mailingref.value=$int_message_id;
                               document.$formname.submit()';>\n";
    echo "<INPUT TYPE=\"button\" NAME=\"save\" VALUE=\"Save to DB\" CLASS=\"button\" 
                      onclick='if (confirm(\"Save to DB?\")){
                                $formname.action.value=\"save\";
                                $formname.mailingref.value=$int_message_id;
                                document.$formname.submit()
                               }'>\n";   
    echo "<INPUT TYPE=\"button\" NAME=\"savenew\" VALUE=\"Save as New\" CLASS=\"button\" 
                       onclick='if (confirm(\"Really save as new mailing?\")){
                                  $formname.action.value=\"save\";
                                  $formname.mailingref.value=0;
                                  document.$formname.submit();
                                }'>\n";   
    echo "<INPUT TYPE=\"button\" NAME=\"delete\" VALUE=\"Delete\" CLASS=\"button\" 
                       onclick='if (confirm(\"Are you sure you want to delete this mailing?\")){
                                  $formname.action.value=\"delete\";
                                  $formname.mailingref.value=$int_message_id;
                                  document.$formname.submit();
                                }'>\n";   
    echo "<INPUT TYPE=\"button\" NAME=\"cancel\" VALUE=\"Exit\" CLASS=\"button\" 
                      onclick='$formname.action.value=\"list\";
                               $formname.mailingref.value=0;
                               document.$formname.submit()'>\n";
    echo "</TD></TR>\n";
    echo "<TR>\n";
    echo "<TD COLSPAN=\"6\"><TEXTAREA NAME=\"bericht\" ID=\"bericht\" $textarea_style CLASS=\"form\">".stripslashes($str_bericht)."</TEXTAREA></TD>\n";
    echo "</TR>\n";
    echo "</TABLE>\n";
    break; //end edit  
  case 'query':
    echo "<INPUT TYPE='text' NAME='mailingref' VALUE=$int_message_id></TD>\n";
    if ($str_id) {
      // now get new / updated / old query
    	$get_qry_str = 'SELECT DISTINCTROW statement FROM query	WHERE ID = "'. $str_id . '"';
    	$str_query = stripslashes(GetField($get_qry_str));
    } else {
      $str_query = '';
    }
    echo "Query ".makelistbox('SELECT DISTINCTROW Name, ID
                                  FROM query
                                  WHERE statement LIKE "select%"
                                    AND Name LIKE "mailing%"
                                  ORDER BY Name',
                                  'id',
                                  'ID',
                                  'Name',
                                  $str_id,
                                  '',
                                  "document.$formname.action.value=\"query\"; $formname.submit();");
  		echo "<TD><INPUT TYPE=\"button\" NAME=\"update\" VALUE=\"Update screen\" CLASS=\"button\" 
                      onclick='$formname.action.value=\"query\";
                               $formname.mailingref.value=$int_message_id;
                               document.$formname.submit()';>\n";
      echo "<INPUT TYPE=\"button\" NAME=\"cancel\" VALUE=\"Exit\" CLASS=\"button\" 
                      onclick='$formname.action.value=\"list\";
                               $formname.mailingref.value=0;
                               document.$formname.submit()'>\n";
      echo "<INPUT TYPE=\"button\" NAME=\"Test\" VALUE=\"Test mail\" CLASS=\"button\" 
                      onclick='$formname.action.value=\"test\";
                               document.$formname.submit() }'>\n";
	  echo "<INPUT TYPE=\"button\" NAME=\"Generate\" VALUE=\"Generate\" CLASS=\"button\" 
			  onclick='if (confirm(\"Confirm that all Email adresses listed will receive this e-mailing!\")) {
		  $formname.action.value=\"generate\";
	  document.$formname.submit() }'>\n";
	  echo "To see the status click <a href='".IWEX_WEBSITE."/forms/mailing.php?ref=$int_message_id&status=1' TARGET='_new'>Iwex.nl</a>";
	  echo " or for <a href='".SEND_SELECTED_MAILING."?ref=$int_message_id&status=1' TARGET='_new'>local</a> send. ";
      if ($str_query) {
  			echo show_table($str_query,TRUE);
  		} else {
  			echo "<br>No result from query";
  		}      
  break; //end send testmail
	case 'test': // Generate the list of e-mails from query in the database.
		$DB_mailing->query( "INSERT INTO mailing_results 
							 SET mailingref = '$int_message_id',
							 	 ContactID = '".OWN_COMPANYID."',
								 Name = '".$GLOBALS["ary_config"]["emailname.test"]."',
								 email = '".$GLOBALS["ary_config"]["email.test"]."'");
		$DB_mailing->query("UPDATE mailing 
							SET testdate = NOW()
							WHERE mailingref = '$int_message_id'");
		echo "To send click <a href='".IWEX_WEBSITE."/forms/mailing.php?ref=$int_message_id' TARGET='_new'>Iwex.nl</a>";
		echo " or for <a href='".SEND_SELECTED_MAILING."?ref=$int_message_id' TARGET='_new'>local</a> send. ";
		echo " <a href=".$_SERVER['PHP_SELF'].">Return</a>";

	break; //end generate
  
	case 'generate': // Generate the list of e-mails from query in the database.
		if (GetField("SELECT testdate 
				  	  FROM mailing 
				  	  WHERE mailingref = '$int_message_id'",
					 $DB_mailing)) {
			$sql_emaillist = stripslashes(GetField("SELECT statement FROM query WHERE ID = '$str_id'"));
			$sql_emaillist = preg_replace ("/SELECT DISTINCTROW/",
										"SELECT DISTINCTROW '$int_message_id', ",
											$sql_emaillist);
			$DB_mailing->query( "INSERT INTO mailing_results (mailingref,
									ContactID,
									Name,
									email
									)
								".$sql_emaillist);
			$DB_mailing->query("UPDATE mailing 
								SET senddate = NOW()
								WHERE mailingref = '$int_message_id'");
			echo "To send click <a href='".IWEX_WEBSITE."/forms/mailing.php?ref=$int_message_id' TARGET='_new'>Iwex.nl</a>";
			echo " or for <a href='".SEND_SELECTED_MAILING."?ref=$int_message_id' TARGET='_new'>local</a> send. ";
		} else {
			echo "<h2>Before sending, do a test mailing!</h2>";
		}
		echo " <a href=".$_SERVER['PHP_SELF'].">Return</a>";
	break; //end generate
} //switch end
echo "</FORM>\n";
?>
