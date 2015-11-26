<?php
    include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
   
    $debito = em_debito($_GET['codigo']);
    
    if($debito) echo  number_format ($debito,2) ; 
    else echo 'false';  
    
?>