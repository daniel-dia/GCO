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
	if(!verifica_nivel('patrimonio', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `patrimonio` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="46%">&nbsp;&nbsp;&nbsp;<img src="patrimonio/img/patrimonio.png" alt="<?php echo $LANG['patrimony']['manage_patrimony']?>"> <span class="h3"><?php echo $LANG['patrimony']['manage_patrimony']?></span></td>
      <td width="27%" valign="bottom">
<?php echo $LANG['patrimony']['search_for']?>
  <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('patrimonio/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value)">
</td>
      <td width="23%" align="right" valign="bottom"><?php echo ((verifica_nivel('patrimonio', 'I'))?'<img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax(\'patrimonio/incluir\', \'conteudo\', \'\')">'.$LANG['patrimony']['include_new_item'].'</a>':'')?></td>
      <td width="2%" valign="bottom">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr bgcolor="#009BE6">
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td width="50" height="23" align="left"><?php echo $LANG['patrimony']['code']?></td>
      <td width="338" align="left"><?php echo $LANG['patrimony']['description']?> </td>
      <td width="130" align="left"><?php echo $LANG['patrimony']['sector']?></td>
      <td width="107" align="center"><?php echo $LANG['patrimony']['value']?></td>
      <td width="59" align="center"><?php echo $LANG['patrimony']['edit_view']?></td>
      <td width="66" align="center"><?php echo $LANG['patrimony']['delete']?></td>
    </tr>
  </table>  
  <div id="pesquisa"></div>
  <script>
  Ajax('patrimonio/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
