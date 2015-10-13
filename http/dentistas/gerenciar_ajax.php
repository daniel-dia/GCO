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
	if(!verifica_nivel('profissionais', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `dentistas` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		@unlink('fotos/'.$_GET[cpf].'.jpg');
	}
?>
<script>
function esconde(campo) {
    if(campo.selectedIndex == 2) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = '';
        document.getElementById('id_procurar').value = 'procurar1';
    } else {
        document.getElementById('procurar').style.display = '';
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar';
    }
}
</script>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="45%">&nbsp;&nbsp;&nbsp;<img src="dentistas/img/dentista.png" alt="<?php echo $LANG['professionals']['manage_professionals']?>" width="21" height="31"> <span class="h3"><?php echo $LANG['professionals']['manage_professionals']?></span></td>
      <td width="28%" valign="bottom">
      	<table width="100%" border="0">
      	  <tr>
      	    <td>
      	      <?php echo $LANG['professionals']['search_for']?><br>
      	      <select name="campo" id="campo" class="forms" onchange="esconde(this)">
      	        <option value="nome"><?php echo $LANG['professionals']['name']?></option>
      	        <option value="cpf"><?php echo $LANG['professionals']['document1']?></option>
      	        <option value="nascimento"><?php echo $LANG['patients']['birthdays_in_month']?></option>
      	      </select>
      	    </td>
      	    <td>
      	      <br>
      	      <input type="hidden" id="id_procurar" value="procurar">
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('dentistas/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="forms" onchange="javascript:Ajax('dentistas/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option value=""></option>
<?php
    for($i = 1; $i <= 12; $i++) {
        echo '                <option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.nome_mes($i).'</option>';
    }
?>
      	      </select>
      	    </td>
      	  </tr>
      	</table>
      </td>
      <td width="25%" align="right" valign="bottom"><?php echo ((verifica_nivel('profissionais', 'I'))?'<img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax(\'dentistas/incluir\', \'conteudo\', \'\')">'.$LANG['professionals']['include_new_professional'].'</a>':'')?></td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
</table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td width="325" height="23" align="left"><?php echo $LANG['professionals']['professional']?></td>
      <td width="150" height="23" align="left"><?php echo $LANG['professionals']['telephone']?></td>
      <td width="150" align="left"><?php echo $LANG['professionals']['council']?></td>
      <td width="59" align="center"><?php echo $LANG['professionals']['edit_view']?></td>
      <td width="66" align="center"><?php echo $LANG['professionals']['delete']?></td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('dentistas/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
