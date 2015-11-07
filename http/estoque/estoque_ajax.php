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
	if(!verifica_nivel('estoque', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if(checknivel('Dentista')) {
		echo '<script>Ajax(\'estoque_dent/extrato\', \'conteudo\', \'\')</script>';
	} elseif(checknivel('Administrador') || checknivel('Funcionario')) {
		echo '<script>Ajax(\'estoque/extrato\', \'conteudo\', \'\')</script>';
	}

?>
