<?php
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2009
    * Autores: Ivis Silva Andrade - Engenharia e Design(ivis@expandweb.com)
    *          Pedro Henrique Braga Moreira - Engenharia e Programação(ikkinet@gmail.com)
    *
    * Este arquivo é parte do programa Gerenciador Clínico Odontológico
    *
    * Gerenciador Clínico Odontológico é um software livre; você pode
    * redistribuí-lo e/ou modificá-lo dentro dos termos da Licença
    * Pública Geral GNU como publicada pela Fundação do Software Livre
    * (FSF); na versão 2 da Licença invariavelmente.
    *
    * Este programa é distribuído na esperança que possa ser útil,
    * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÂO
    * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
    * Licença Pública Geral GNU para maiores detalhes.
    *
    * Você recebeu uma cópia da Licença Pública Geral GNU,
    * que está localizada na raíz do programa no arquivo COPYING ou COPYING.TXT
    * junto com este programa. Se não, visite o endereço para maiores informações:
    * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html (Inglês)
    * http://www.magnux.org/doc/GPL-pt_BR.txt (Português - Brasil)
    *
    * Em caso de dúvidas quanto ao software ou quanto à licença, visite o
    * endereço eletrônico ou envie-nos um e-mail:
    *
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endereço:
    *
    * Smile Odontolóogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
	$agenda = new TAgendas();
	$agenda->LoadAgenda($_GET['data'], $_GET['hora'], $_GET['codigo_dentista']);
	if(isset($_GET['descricao'])) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $agenda->SetDados('descricao', $_GET['descricao']);
        } else {
            $agenda->SetDados('descricao', utf8_decode ( htmlspecialchars( utf8_encode($_GET['descricao']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') ));
        }
        //echo '<script>alert("'.$agenda->RetornaDados('descricao').'")</script>';
        if($_GET['codigo_paciente'] == '') {
            $_GET['codigo_paciente'] = 0;
            //echo '<script>alert("'.$agenda->RetornaDados('codigo_paciente').'")</script>';
        }
        $agenda->SetDados('codigo_paciente', $_GET['codigo_paciente']);
	} elseif(isset($_GET['procedimento'])) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $agenda->SetDados('procedimento', $_GET['procedimento']);
        } else {
            $agenda->SetDados('procedimento', utf8_decode($_GET['procedimento']));
        }
	} elseif(isset($_GET['faltou'])) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            $agenda->SetDados('faltou', $_GET['faltou']);
        } else {
            $agenda->SetDados('faltou', utf8_decode($_GET['faltou']));
        }
        //echo '<script>alert("'.$agenda->RetornaDados('faltou').'")</script>';
	}
	$agenda->Salvar();
?>
