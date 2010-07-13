<?php

include("common.php");

session_start();
   
unset($uname);
unset($pword);
if (isset($_COOKIE["uname"])) {
    $uname = $_COOKIE["uname"];
    $pword = $_COOKIE["pword"];
} else if (isset($_SESSION["uname"])) {
    $uname = $_SESSION["uname"];
    $pword = $_SESSION["pword"];
} else if (isset($_POST["uname"])) {
    $uname = $_POST["uname"];
    $pword = $_POST["pword"];
}
if (isset($uname)) {
	if (login($uname,$pword)) {
		set_globals($uname);
		setcookie ("uname", $uname, time()+$GLOBALS["ary_config"]["password_timeout_sec"]);
		setcookie ("pword", $pword, time()+$GLOBALS["ary_config"]["password_timeout_sec"]);
		$_SESSION["uname"] = $uname;
		$_SESSION["pword"] = $pword;
	} else {
		 setcookie ("uname", $_SESSION["uname"], time()-60*60);  /* Invalid */
	     unset($_SESSION["uname"]);
	     unset($_SESSION["pword"]);
		 unset($_COOKIE["uname"]);
	
		 printheader("Login scherm, verkeerde login!");
	     printIwexNav();
	     echo '<h2 align=center class="menubar">Niet of onjuist ingelogd, Probeer het nog eens</h2>';
		 printenddoc();
	     exit;
	}
}
else {
	// Not logged in.
	printheader("Login scherm");
	printIwexNav();
	?>
	<body>
	<FORM METHOD="post" name="loginform">
	<center>
	<table class="back">
	<tr>
	<td>Username:</td>
	<td><input type="text" name="uname" size="20"></td>
	</tr>
	<tr>
	<td>Password:</td>
	<td><input type="password" name="pword" size="20"></td>
	</tr>
	<tr>
	<td colspan="2">
	<p><input type="submit" value="Submit" name="pwdsubmit"></td>
	</tr>
	</table>
	</center>
	</form>
	<?php
	printenddoc();
	exit;
}
//$uname = mysql_result($result,0,"username");

?>
