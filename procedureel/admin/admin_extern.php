<?php
$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';

$submit = isset($_POST['submit']);
$action = isset($_POST['action']) ? $_POST['action'] : '';
$action = $action == '' && isset($_GET['action']) ? $_GET['action'] : $action;
$int_contactID = GetSetFormVar('contactID',FALSE);

$username = isset($_POST['username']) ? $_POST['username'] : "" ;
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : "" ;
$email = isset($_POST['email']) ? $_POST['email'] : "" ;
$int_languageID = isset($_POST['languageID']) ? $_POST['languageID'] : "" ;
$CompanyID = isset($_POST['CompanyID']) ? $_POST['CompanyID'] : "" ;
$username  = isset($_POST['username']) ? $_POST['username'] : "" ;
$access_rma  = GetCheckBox('access_rma');
$access_purchase  = GetCheckBox('access_purchase');
$access_stock  = GetCheckBox('access_stock');

$delete = isset($_GET['delete']) ?  $_GET['delete'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$id = isset($_POST['id']) ? $_POST['id'] : $id;

// Print default Iwex HTML header.
printheader ("Irene Web Users");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='userform'>\n"; // start form to remember parameters , they will be submitted with authentication stuff
printIwexNav();

if (!$action) {
	echo 'filter op klantnummer: <INPUT TYPE="text" NAME="contactID" value="'.$int_contactID.'"><input type="submit" value="submit">';
} else {
	echo '<INPUT TYPE="hidden" NAME="contactID" value="'.$int_contactID.'">';
}

$_SERVER['PHP_SELF'] = str_replace(stristr($_SERVER['PHP_SELF'], '?'),'',$_SERVER['PHP_SELF']);

if($action == "delete") {

    echo "<b>Are you sure you want to delete this user?<p>
    <a href=".$_SERVER['PHP_SELF']."?delete=final&id=$id>Yes</a><p>
    <a href=".$_SERVER['PHP_SELF'].">No</a><p>";
    // Breaks the script.
    exit;

} else if($delete == "final" && $id) {

    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = @mysql_query($sql) or die(mysql_error());
    
    echo "<center>User successfully deleted</center>";

}

//echo "action = '$action', id = '$id', username = '$username'";
if(!$submit && $action == "edit") {

    $sql = "SELECT id,ContactID,CompanyName,email,languageID,uid,pwd,rma,purchase, stock 
			FROM users
			WHERE id = '$id'";
    $result = @mysql_query($sql) or die($sql.' '.mysql_error());
    $row = mysql_fetch_array($result);
    
    $contactID_user = $row['ContactID'] ? $row['ContactID'] : $int_contactID;
    
    echo "<center>
    <table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\" width=\"100%\">\n
    <td>
        <table width=\"50%\">
        <tr>
            <td>ID</td>
            <td>".$row['id']."</td>
        </tr>
        <tr>
            <td>Bedrijf ID</td>
            <td><input type=text name=CompanyID value=\"".$contactID_user."\"></TD>
        </TR>
        <TR>
            <TD>Zoek naam</TD>
            <TD>";
            echo GetRecordIdInputField(SQL_SEARCH_CUSTOMER_LIST, "ContactID", "customername", "userform.CompanyID", "cust", 30, $row['CompanyName'], 11);
            echo "</td>
        </tr>
        <tr>
            <td><BR>Bedrijfsnaam</td>
            <td><BR>".$row['CompanyName']."</td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type=text name=username value=\"".$row['uid']."\"></td>
        </tr> ";
        if (!empty($id)) {   //als er een nieuw lid wordt aangemaakt wordt het wachtwoord gegenereerd
            echo "<tr>
                <td>Password</td>
                <td><input type=password name=passwd></td>
            </tr> ";
        }
        echo " <tr>
            <td>Email Address</td>
            <td><input type=text name=email value=\"".$row['email']."\"></td>
        </tr>
		<tr>
            <td>Language</td>
            <td>". makelistbox("SELECT languageID, language 
								FROM languages ",  "languageID","languageID",
							   "language", $row["languageID"])."</td>
        </tr>
        <tr>
        <td>
            <input type=submit name=submit value=Submit>
            <input type=button name=cancel value=Cancel onClick=\"location.replace('".$_SERVER['PHP_SELF']."?contactID=$int_contactID','Webusers',".STANDARD_WINDOW.")\">
            <input type=hidden name=action value=edit>
            <input type=hidden name=id value=$id>
        </td>
        </tr>
        </table>
    </td>
    <td>
        <table width=\"100%\">
        <tr>
            <td></td><td>Access</td>
        </tr>
        <tr>
            <td>RMA</td><td>".MakeCheckBox("access_rma", $row['rma'])."</td>
        </tr>
        <tr>
            <td>Buy</td><td>". MakeCheckBox("access_purchase", $row['purchase'])."</td>
        </tr>";
    if (getfield("SELECT CompanyName FROM contacts WHERE warehouse_customer = 1 AND ContactID = '". $row['ContactID'] ."'")) {
        echo "<tr>
                <td>Stock</td><td>". MakeCheckBox("access_stock", $row['stock'])."</td>
            </tr>";
    }
    echo "</table>
    </td>
    </table>";

} else if($action == "reset" && $id){
     $sql_reset = "UPDATE users SET login_attempts = '0', passw_change_attempts = '0' WHERE id = '$id'";
     mysql_query($sql_reset) or die("Ongeldige update query: ". mysql_error());
     
     echo "<CENTER>De login attempts voor userid: " .$id. " zijn succesvol gereset.</CENTER>";

} else if($submit 
          && 
          $action == "edit"
          && 
          !empty($username) 
          && 
          !empty($email) 
          && 
          !empty($CompanyID) 
          && 
          !empty($int_languageID))
        // er moet een username, emailadres, companyID, languageID worden ingevoerd.        
{
  if (checkEmail($email)){
    if (INVALID != $CompanyID) { 
        $str_customer_name = getcontactname($CompanyID);
    } else {
        $str_customer_name = $_POST['customername'];
    }
    if ($message = WebUser($CompanyID,
                       $username,
                       $str_customer_name,
                       $email,
                       $int_languageID,
                       $id,
                       $access_rma,
                       $access_purchase,
                       $access_stock,
                       &$passwd))
    {
      echo $message;
      if ($msg = MailWebUser($username, $passwd, $int_languageID, $email, &$str_subject))
      {
        echo "<br>Email is verstuurd, deze ziet er als volgt uit:<br><br>";
        echo "<br>To: " .$email;
        echo "<br>Subject:" . $str_subject;
        echo "<br><pre>$msg</pre>";
      } else {
        echo "mail niet verzonden";
      }
    } else {
      echo "user update / create not succesfull, geen emailadres opgegeven";
    }
    
/*    $sql = " users SET ContactID='$CompanyID', uid='$username', CompanyName = '$str_customer_name', ";
    if (!empty($passwd)) {
        $sql .= "pwd='".encrypt($passwd)."', ";
    }
    $sql .= " email='$email', languageID='$int_languageID' ,rma='$access_rma', purchase='$access_purchase', stock='$access_stock'";
    if ($id) { 
        $sql = "UPDATE" . $sql . "WHERE id = '$id'";
    } else {
        $passwd = generate_Password();
        //echo "Het volgende password is gegenereerd: " .$passwd;
        $sql = "INSERT" . $sql. ", pwd='".encrypt($passwd)."'";
    }
    $result = mysql_query($sql) or die($sql . mysql_error());
    echo "<center>Irene User $username successfully";
    if ($id) {
        echo "updated.</center>";            
    } else {
        echo "added.</center>";            
    }*/
    //mail usernaam en wachtwoord naar de klant
  } else {
      echo "<center><br><br><br><H2>Geen wijzigingen toegepast - Controleer het Emailadres!</H2>";
      echo "<a href=\"javascript:history.go(-1)\">[ Probeer opnieuw ]</a></center>";
  }
} else if ($submit) {
    echo "<center><br><br><br><H2>Geen wijzigingen toegepast - Username, Emailadres, CompanyId en Language verplicht!</H2>";
    echo "<a href=\"javascript:history.go(-1)\">[ Probeer opnieuw ]</a></center>";
}


echo "<br><p><center><a href=".$_SERVER['PHP_SELF']."?action=edit&id=0>Nieuwe gebruiker</a></center><p>
<center>
<table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\">\n
 <tr>
  <th align=center><b>Logins</b></th>
  <th align=center><b>ID</b></th>
  <th align=center><b>Company ID</b></th>
  <th align=center><b>Company Name</b></th>
  <th align=center><b>Username</b></th>
  <th align=center><b>Password</b></th>
  <th align=center><b>Email Address</b></th>
  <th align=center><b>Language</b></th>
  <th align=center><b>RMA</b></th>
  <th align=center><b>Order</b></th>
  <th align=center><b>Stock</b></th>
  <th align=center colspan=2><b>Option</b></th>
  <th align=center><b>Total actions</b></th>
  <th align=center><b>Failed logins</b></th>

 </tr>
</center>";


$sql = "SELECT id,ContactID,CompanyName,email,language,uid,pwd,rma,stock,purchase,logins,login_attempts, passw_change_attempts,
			   last_online, total_logins FROM users
		LEFT JOIN languages ON languages.languageID = users.languageID";
                    
if ($int_contactID) {
	$sql .= " WHERE ContactID = '$int_contactID'";
}
$sql .= " ORDER BY CompanyName";
$result = mysql_query($sql) or die($sql.' '.mysql_error());
$count = 0;

while($row = mysql_fetch_array($result)) {
     
        
//check of iemand online is
     if(isset($row['last_online'])){
        $date_now = strtotime(date('Y-m-d G:i:s'));
        $last_online = strtotime(date($row['last_online']));

        if (($date_now - $last_online) <= (15*60)){
            $font_color = "red";
            $online = "(online) ";
            $count ++;
        }else {
            $font_color = "black";
            $online = "";
        }
     }else {
            $font_color = "black";
            $online = "";
     }
     echo "<tr>
     <td align=right><FONT color=\"".$font_color."\">". $online ."</FONT>".$row['total_logins']."</td>
     <td align=right><FONT color=\"".$font_color."\">".$row['id']."</FONT></td>
     <td align=right><FONT color=\"".$font_color."\">".$row['ContactID']."</FONT></td>
     <td><FONT color=\"".$font_color."\">".$row['CompanyName']."</td>
     <td><FONT color=\"".$font_color."\">".$row['uid']."</FONT></td>
     <td><FONT color=\"".$font_color."\">".$row['pwd']."</FONT></td>
     <td><FONT color=\"".$font_color."\">".$row['email']."</FONT></td>
     <td><FONT color=\"".$font_color."\">".$row['language']."</FONT></td>
     <td align=right>".$row['rma']."</td>
     <td align=right>".$row['purchase']."</td>
     <td align=right>".$row['stock']."</td>
     <td><a href=".$_SERVER['PHP_SELF']."?action=edit&id=".$row['id'].">Edit</a></td>
     <td><a href=".$_SERVER['PHP_SELF']."?action=delete&id=".$row['id'].">Delete</a></td>
     </td>
     <td align=right>".$row['logins']."</td>
     <td align=right>";
     
     if($row['login_attempts'] || $row ['passw_change_attempts']){ //als er foute logins zijn geweest, dan een link weergeven om te resetten
         echo "<A HREF=".$_SERVER['PHP_SELF']."?action=reset&id=".$row['id']."
             onClick=\"return confirm('Weet u zeker dat u het aantal foute logins wilt resetten?')\";\">Reset</A> ";
     }
     
     if(!empty($row['login_attempts'])){ //foute logins
         echo "<FONT color=\"red\">".$row['login_attempts']."</FONT>";
     }else {
         echo $row['login_attempts'];
     }
     
     if(!empty($row['passw_change_attempts'])){ //foute wachtwoord wijzigingen
         echo "<FONT color=\"red\"> / ".$row['passw_change_attempts']."</FONT>";
     }else {
         echo " / " .$row['passw_change_attempts'];
     }
     
     
     echo "</td></tr>";
}
echo "</table>";
if($count){
    if($count == 1){
        $is_zijn = "is";
        $s = "";
    }else {
        $is_zijn = "zijn";
        $s = "s";
    }
    echo "<BR><BR>* Er ". $is_zijn ." in de laatste 15 minuten <FONT COLOR=\"red\">". $count ."</FONT> gebruiker". $s ." online geweest.";
}
?>
