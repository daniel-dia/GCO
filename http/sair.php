
<?php
    include "lib/config.inc.php";
	include "lib/func.inc.php";
	include "lib/classes.inc.php";
	require_once 'lang/'.$idioma.'.php';
	
	if(!checklog()) {   
         $redirect = "login.php?sair=true";
         header("location:$redirect");
	}
	session_unset();
	session_destroy();
        $redirect = "login.php?sair=true";
        header("location:$redirect");
?>
