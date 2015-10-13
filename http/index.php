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
	include "lib/config.inc.php";
    if(!$install) {
        header('Location: ./configurador.php');
    } else {
        //@unlink('./configurador.php');
    }
	include "lib/func.inc.php";
	include "lib/classes.inc.php";
	require_once 'lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=utf-8", true);
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciador Clínico Odontológico Smile Odonto - Administração Odontológica Em Suas Mãos</title>
<link rel="SHORTCUT ICON" href="favicon.ico">
<link href="css/smile.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="lib/script.js.php"></script>
<script language="javascript" type="text/javascript" src="lib/ajax_search.js"></script>
</head>
<body onload="MM_preloadImages('imagens/menu/inicio_f2.jpg','imagens/menu/arquivo_f2.jpg','imagens/menu/financeiro_f2.jpg','imagens/menu/atualizacoes_f2.jpg','imagens/menu/utilitarios_f2.jpg','imagens/menu/configuracoes_f2.jpg','imagens/menu/ajuda_f2.jpg','imagens/menu/sair_f2.jpg','imagens/menu/pacientes_f2.jpg','imagens/menu/pagamentos_f2.jpg','imagens/menu/fornecedores_f2.jpg','imagens/menu/caixa_f2.jpg','imagens/menu/agenda_f2.jpg','imagens/menu/estoque_f2.jpg','imagens/menu/telefones_f2.jpg'); javascript:Ajax('wallpapers/index', 'conteudo', '')">
  <input type="hidden" id="ScriptID" value="0" />
  <div class="topo" id="topo"> <img src="imagens/top_gerenciador_smile.jpg" alt="Smile Odonto" width="770" height="40" />
    <?php include "menu.php"; ?>
    <br />
</div>
<div class="conteudo" id="conteudo"></div>
  <div class="rodape" id="rodape"> <br />
      <?php echo $LANG['general']['smile_odontology']?> - <?php echo $LANG['general']['enhancing_your_smile']?> - <a href="http://www.smileodonto.com.br" target="_blank">www.smileodonto.com.br </a><br>
      <br>
      <?php echo $LANG['general']['be_part_of_smile']?>
  </div>
</body>
</html>
