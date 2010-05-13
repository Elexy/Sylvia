<?php

$_GLOBAL["str_backdir"] = '../';

include $_GLOBAL["str_backdir"].'include.php';

$submit = GetSetFormVar("submit");
$action = GetSetFormVar("action");
$delete = GetSetFormVar("delete");
$id = GetSetFormVar('id');
$usename = GetSetFormVar('usename'); 
$passwd = GetSetFormVar('passwd');
$email = GetSetFormVar('email');

// Print default Iwex HTML header.
printheader (COMPANYNAME . " verzend berichten");

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\">\n"; // start form to remember parameters , they will be submitted 

printIwexNav();

$_SERVER['PHP_SELF'] = str_replace(stristr($_SERVER['PHP_SELF'], '?'),'',$_SERVER['PHP_SELF']);

if($action == "delete") {

echo "<b>Are you sure you want to delete this user?<p>
<a href=".$_SERVER['PHP_SELF']."?delete=final&id=$id>Yes</a><p>
<a href=".$_SERVER['PHP_SELF'].">No</a><p>";
exit;

} else if($delete == "final" && $id) {

$sql = "DELETE FROM genuser WHERE id = '$id'";
$result = @mysql_query($sql) or die(mysql_error());

echo "<center>User successfully deleted</center>";

}

if(!$submit && $action == "edit" && $id) {

$sql = 'select id, genuser.ContactID, genuser.uid, genuser.pwd, genuser.email, '
     .'raccess_s, raccess_a, raccess_v, raccess_r, '
     .'waccess_s, waccess_a, waccess_v, waccess_r, '
     .'saccess_s, saccess_a, saccess_v, saccess_r, supervisor, '
     .'contacts.CompanyName from genuser '
     .'left join contacts on genuser.ContactID=contacts.ContactID '
     .'where genuser.id = "'.$id.'"';
$result = @mysql_query($sql) or die($sql.' '.mysql_error());
$row = mysql_fetch_array($result);

echo "<center>
<form method=Post action=".$_SERVER['PHP_SELF'].">
<table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\" width=\"60%\">\n
   <td>
     <table width=\"30%\">
       <tr>
         <td>ID</td>
         <td>".$row['id']."</td>
       </tr>
       <tr>
         <td>Bedrijf ID</td>
         <td><input type=text name=CompanyID value=\"".$row['ContactID']."\"></td>
       </tr>
       <tr>
         <td>Bedrijfsnaam</td>
         <td>".$row['CompanyName']."</td>
       </tr>
       <tr>
         <td>Username</td>
         <td><input type=text name=usename value=\"".$row['uid']."\"></td>
       </tr>
       <tr>
         <td>Password</td>
         <td><input type=password name=passwd></td>
       </tr>
       <tr>
         <td>Email Address</td>
         <td><input type=text name=email value=\"".$row['email']."\"></td>
       </tr>
       <tr>
       <td>
         <input type=submit name=submit value=submit>
         <input type=hidden name=action value=edit>
         <input type=hidden name=id value=$id>
       </td>
       </tr>
     </table>
   </td>
   <td>
     <table width=\"100%\">
       <tr>
         <td></td><td>Read</td><td>Write</td><td>setup</td>
       </tr>
       <tr>
         <td>Sales</td><td><input type=text size=\"1\" name=read_s value=\"".$row['raccess_s']."\"</td><td><input type=text size=\"1\" name=write_s value=\"".$row['waccess_s']."\"</td><td><input type=text size=\"1\" name=setup_s value=\"".$row['saccess_s']."\"</td>
       </tr>
       <tr>
         <td>Voorraad</td><td><input type=text size=\"1\" name=read_v value=\"".$row['raccess_v']."\"</td><td><input type=text size=\"1\" name=write_v value=\"".$row['waccess_v']."\"</td><td><input type=text size=\"1\" name=setup_v value=\"".$row['saccess_v']."\"</td>
       </tr>
       <tr>
         <td>Administratie</td><td><input type=text size=\"1\" name=read_a value=\"".$row['raccess_a']."\"</td><td><input type=text size=\"1\" name=write_a value=\"".$row['waccess_a']."\"</td><td><input type=text size=\"1\" name=setup_a value=\"".$row['saccess_a']."\"</td>
       </tr>
       <tr>
         <td>RMA</td><td><input type=text size=\"1\" name=read_r value=\"".$row['raccess_r']."\"</td><td><input type=text size=\"1\" name=write_r value=\"".$row['waccess_r']."\"</td><td><input type=text size=\"1\" name=setup_r value=\"".$row['saccess_r']."\"</td>
       </tr>
       <tr>
         <td>Supervisor</td><td colspan=\"3\"><input type=text size=\"1\" name=super value=\"".$row['supervisor']."\"</td>
       </tr>
     </table>
   </td>
</table>";

} else if($submit && $action == "edit" && $id) {

     if(!$submit && $action == "edit" && $id 
     or !empty($usename) or !empty($passwd)
     or !empty($email)) {

          $sql = "UPDATE genuser SET uid='$usename', ";
          if ($passwd) {
            $sql .= "pwd='".encrypt($passwd)."', ";
          }
          $sql .= "email='$email'
            , raccess_s='$_POST[read_s]', raccess_a='$_POST[read_a]', raccess_v='$_POST[read_v]', raccess_r='$_POST[read_r]'
            , waccess_s='$_POST[write_s]', waccess_a='$_POST[write_a]', waccess_v='$_POST[write_v]', waccess_r='$_POST[write_r]'
            , saccess_s='$_POST[setup_s]', saccess_a='$_POST[setup_a]', saccess_v='$_POST[setup_v]', saccess_r='$_POST[setup_r]'
            , supervisor='$_POST[super]' WHERE id = '$id'";
          $result = @mysql_query($sql) or die(mysql_error());
          echo "<center>User successfully updated.</center>";
     }

}

echo "<br><br>
<link rel=\"stylesheet\" style=\"text/css\" href=\"/css/iwex.css\">
<center>
<table border=1 cellspacing=0 cellpadding=2 class=\"blockbody\">\n
 <tr>
  <th align=center><b>ID</b></th>
  <th align=center><b>Company ID</b></th>
  <th align=center><b>Company Name</b></th>
  <th align=center><b>Username</b></th>
  <th align=center><b>Password</b></th>
  <th align=center><b>Email Address</b></th>
  <th align=center><b>Option</b></th>
 </tr>
</center>";

$sql = 'select id, genuser.ContactID, genuser.uid, genuser.pwd, genuser.email, '
     .'raccess_s, raccess_a, raccess_v, raccess_r, '
     .'waccess_s, waccess_a, waccess_v, waccess_r, '
     .'saccess_s, saccess_a, saccess_v, saccess_r, supervisor, '
     .'contacts.CompanyName from genuser '
     .'left join contacts on genuser.ContactID=contacts.ContactID '
     .'order by genuser.ContactID';
$result = mysql_query($sql) or die($sql.' '.mysql_error());
while($row = mysql_fetch_array($result)) {

     echo "<tr>
     <td>".$row['id']."</td>
     <td>".$row['ContactID']."</td>
     <td>".$row['CompanyName']."</td>
     <td>".$row['uid']."</td>
     <td>".$row['pwd']."</td>
     <td>".$row['email']."</td>
     <td>
       <a href=".$_SERVER['PHP_SELF']."?action=edit&id=".$row['id'].">Edit</a> |
       <a href=".$_SERVER['PHP_SELF']."?action=delete&id=".$row['id'].">Delete</a>
     </td>
     </tr>";
}

?>
