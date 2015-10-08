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
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `cheques` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>
<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?php
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="46%">&nbsp;&nbsp;&nbsp;<img src="cheques/img/cheques.png" alt="<?php echo $LANG['check_control']['clinic_check_control']?>"> <span class="h3"><?php echo $LANG['check_control']['clinic_check_control']?></span></td>
      <td width="27%" valign="bottom">
        <table width="100%" border="0">
      	  <tr>
      	    <td>
      	      Pesquisar por<br>
      	      <select name="campo" id="campo" class="forms">
      	        <option value="nometitular"><?php echo $LANG['check_control']['holder']?></option>
      	        <option value="recebidode"><?php echo $LANG['check_control']['received_from']?></option>
      	        <option value="encaminhadopara"><?php echo $LANG['check_control']['forwarded_to']?></option>
      	        <option value="compensacao"><?php echo $LANG['check_control']['compensation_date']?></option>
      	      </select>
      	    </td>
      	    <td>
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('cheques/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)" onKeypress="if(document.getElementById('campo').selectedIndex==3) {return Ajusta_Data(this, event);}"
                onclick="if(document.getElementById('campo').selectedIndex==3) {abreCalendario(this);}">
      	    </td>
      	  </tr>
      	</table>
      </td>
      <td width="23%" align="right" valign="bottom"><?php echo ((verifica_nivel('cheques', 'I'))?'<img src="imagens/icones/novo.gif" alt="" width="19" height="22" border="0"><a href="javascript:Ajax(\'cheques/incluir\', \'conteudo\', \'\')">'.$LANG['check_control']['include_new_check'].'</a>':'')?></td>
      <td width="2%" valign="bottom">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td colspan="7" bgcolor="#009BE6">&nbsp;</td>
    </tr>
    <tr>
      <td width="123" height="23" align="left"><?php echo $LANG['check_control']['holder']?></td>
      <td width="123" height="23" align="left"><?php echo $LANG['check_control']['received_from']?></td>
      <td width="123" height="23" align="left"><?php echo $LANG['check_control']['forwarded_to']?></td>
      <td width="123" height="23" align="left"><?php echo $LANG['check_control']['compensation_date']?></td>
      <td width="80" align="center"><?php echo $LANG['check_control']['value']?></td>
      <td width="66" align="center"><?php echo $LANG['check_control']['edit_view']?></td>
      <td width="66" align="center"><?php echo $LANG['check_control']['delete']?></td>
    </tr>
  </table>  
  <div id="pesquisa"></div>
  <script>
  Ajax('cheques/pesquisa', 'pesquisa', 'pesquisa=&campo=nometitular');
  </script>
</div>
