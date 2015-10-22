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
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('contatos', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `telefones` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
    ?>
    <div>
  
        <h1 class="page-header"> 
            <?php echo $LANG['useful_telephones']['useful_telephones']?>
        </h1>

          <?php echo $LANG['useful_telephones']['search_for']?>
            <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('telefones/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value)">
 
      <?php echo ((verifica_nivel('contatos', 'I'))?'<img src="imagens/icones/novo.png"  ><a href="javascript:Ajax(\'telefones/incluir\', \'conteudo\', \'\')">'.$LANG['useful_telephones']['include_new_contact'].'</a>':'')?>
    
   
    
    <div class="conteudo" id="table dados"><br>
      <div id="pesquisa"></div>
      <script>
      document.getElementById('procurar').focus();
      Ajax('telefones/pesquisa', 'pesquisa', 'pesquisa=');
      </script>
    </div>
