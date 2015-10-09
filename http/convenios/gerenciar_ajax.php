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
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('convenios', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `convenios` WHERE `codigo` = '".$_GET['codigo']."'") or die(mysql_error());
        mysql_query("DELETE FROM honorarios_convenios WHERE codigo_convenio = '".$_GET['codigo']."'") or die(mysql_error());
	}
?>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="48%">&nbsp;&nbsp;&nbsp;<img src="convenios/img/convenios.png" alt="<?php echo $LANG['plan']['manage_plans']?>"> <span class="h3"><?php echo $LANG['plan']['manage_plans']?> </span></td>
      <td width="21%" valign="bottom">
        <table width="100%" border="0">
      	  <tr>
      	    <td colspan="2">
             <?php echo $LANG['plan']['search_for']?>
            </td>
          </tr>
          <tr>
            <td>
      	      <select name="campo" id="campo" class="forms">
      	        <option value="nomefantasia"><?php echo $LANG['plan']['name']?></option>
      	        <option value="cidade"><?php echo $LANG['plan']['city']?></option>
      	      </select>
      	    </td>
      	    <td>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('convenios/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	    </td>
      	  </tr>
      	</table>
      </td>
      <td width="27%" align="right" valign="bottom"><?php echo ((verifica_nivel('convenios', 'I'))?'<img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax(\'convenios/incluir\', \'conteudo\', \'\')">'.$LANG['plan']['include_new_plan'].'</a>':'')?></td>
      <td width="2%" valign="bottom">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td width="281" align="left"><?php echo $LANG['plan']['company']?></td>
      <td width="160" align="left"><?php echo $LANG['plan']['city_state']?></td>
      <td width="105" align="left"><?php echo $LANG['plan']['telephone']?></td>
      <td width="79" align="center"><?php echo $LANG['plan']['fee_table']?></td>
      <td width="59" align="center"><?php echo $LANG['plan']['edit_view']?></td>
      <td width="66" align="center"><?php echo $LANG['plan']['delete']?></td>
    </tr>
  </table>  
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('convenios/pesquisa', 'pesquisa', 'pesquisa=&campo=nomefantasia');
  </script>
</div>
