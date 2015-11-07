<?php
  	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('caixa', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `caixa` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
    }
	if(checknivel('Dentista')) {
		echo '<script>Ajax(\'caixa_dent/extrato\', \'conteudo\', \'\')</script>';
	} else {
		echo '<script>Ajax(\'caixa/extrato\', \'conteudo\', \'\')</script>';
	}
?>
