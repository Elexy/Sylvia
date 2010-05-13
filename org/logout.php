<?php

include("common.php");

session_start();
setcookie ("uname", "", time()-60*60);  /* Invalid */
setcookie ("pword", "", time()-60*60);  /* Invalid */
session_destroy();

printIwexNav()
?>
<link rel="stylesheet" style="text/css" href="/css/iwex.css">
<body>
<h1 align=center class="menubar">Uitgelogd</h1>
<center>
<br><br>
Opnieuw inloggen? Klik <a href="index.php">hier</a>.
</center>
</body>

