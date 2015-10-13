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
	if(!verifica_nivel('honorarios', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET['confirm_del'] == "delete") {
		mysql_query("DELETE FROM honorarios WHERE codigo = '".$_GET['codigo']."'") or die(mysql_error());
		mysql_query("DELETE FROM honorarios_convenios WHERE codigo_procedimento = '".$_GET['codigo']."'");
	}
	if(isset($_POST['Salvar'])) {
		$obrigatorios[1] = 'codigo';
		$obrigatorios[] = 'procedimento';
		$obrigatorios[] = 'valor_particular';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
        if($j == 0) {
            $codigo = mysql_fetch_assoc(mysql_query("SELECT RIGHT( codigo, 3 ) AS autoindex FROM `honorarios` WHERE codigo LIKE '".$_POST['area']."%' ORDER BY codigo DESC LIMIT 1"));
            $codigo = $_POST['area'].completa_zeros($codigo['autoindex']+1, 3);
            $caixa = new THonorarios();
            $caixa->SetDados('codigo', $codigo);
            $caixa->SetDados('procedimento', $_POST['procedimento']);
            $caixa->SalvarNovo();
            $caixa->Salvar();
            mysql_query("INSERT INTO honorarios_convenios VALUES (1, '".$codigo."', '".$_POST['valor_particular']."')");
        }
    }
    $disabled = 'disabled';
    if(checknivel('Administrador')) {
        $disabled = '';
	}
?>
<script>
function esconde(campo) {
    if(campo.selectedIndex == 2) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = '';
        document.getElementById('procurar1').selectedIndex = 0;
        document.getElementById('id_procurar').value = 'procurar1';
    } else {
        document.getElementById('procurar').style.display = '';
        document.getElementById('procurar').value = '';
        document.getElementById('procurar').focus();
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar';
    }
}
</script>
<div class="conteudo" id="conteudo_central">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="55%">&nbsp;&nbsp;&nbsp;<img src="honorarios/img/honorarios.png" alt="<?php echo $LANG['fee_table']['fee_table']?>"> <span class="h3"><?php echo $LANG['fee_table']['fee_table']?><br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo encontra_valor('convenios', 'codigo', $_GET['codigo_convenio'], 'nomefantasia')?></span></td>
      <td width="45%" valign="bottom">
      	<table width="98%" border="0" cellpadding="0" cellspacing="0" align="right">
      	  <tr>
      	    <td width="50%">
      	      <?php echo $LANG['fee_table']['search_for']?><br>
      	      <select name="campo" id="campo" class="forms" onchange="esconde(this)">
      	        <option value="procedimento"><?php echo $LANG['fee_table']['procedure']?></option>
      	        <option value="codigo"><?php echo $LANG['fee_table']['code']?></option>
      	        <option value="area"><?php echo $LANG['fee_table']['area']?></option>
      	      </select>
      	      <input type="hidden" id="id_procurar" value="procurar">
      	    </td>
      	    <td width="50%" align="right">&nbsp;
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="40" maxlength="40" onkeyup="javascript:Ajax('honorarios/pesquisa', 'pesquisa', 'codigo_convenio=<?php echo $_GET['codigo_convenio']?>&pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="forms" onchange="javascript:Ajax('honorarios/pesquisa', 'pesquisa', 'codigo_convenio=<?php echo $_GET['codigo_convenio']?>&pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option></option>
                <option value="CO"><?php echo $LANG['fee_table']['oral_surgery']?></option>
                <option value="DE"><?php echo $LANG['fee_table']['dentistic']?></option>
                <option value="EN"><?php echo $LANG['fee_table']['endodonty']?></option>
                <option value="EX"><?php echo $LANG['fee_table']['clinic_examination']?></option>
                <option value="IM"><?php echo $LANG['fee_table']['implantodonty']?></option>
                <option value="OD"><?php echo $LANG['fee_table']['odontopediatry']?></option>
                <option value="OR"><?php echo $LANG['fee_table']['orthodonty']?></option>
                <option value="RA"><?php echo $LANG['fee_table']['radiology']?></option>
                <option value="PE"><?php echo $LANG['fee_table']['periodonty']?></option>
                <option value="PR"><?php echo $LANG['fee_table']['prevention']?></option>
                <option value="PO"><?php echo $LANG['fee_table']['prosthesis']?></option>
                <option value="TE"><?php echo $LANG['fee_table']['laboratory_test_and_examination']?></option>
      	      </select>
      	    </td>
      	  </tr>
      	</table>
	  </td>
    </tr>
  </table><br />
<?php
	if(verifica_nivel('honorarios', 'I')) {
?>
  <form id="form2" name="form2" method="POST" action="honorarios/honorarios_ajax.php?codigo_convenio=<?php echo $_GET['codigo_convenio']?>" onsubmit="formSender(this, 'conteudo'); this.reset(); return false;">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="33%">Área <br />
        <select name="area" class="forms" id="area" <?php echo $disabled?>>
          <option value="CO"><?php echo $LANG['fee_table']['oral_surgery']?></option>
          <option value="DE"><?php echo $LANG['fee_table']['dentistic']?></option>
          <option value="EN"><?php echo $LANG['fee_table']['endodonty']?></option>
          <option value="EX"><?php echo $LANG['fee_table']['clinic_examination']?></option>
          <option value="IM"><?php echo $LANG['fee_table']['implantodonty']?></option>
          <option value="OD"><?php echo $LANG['fee_table']['odontopediatry']?></option>
          <option value="OR"><?php echo $LANG['fee_table']['orthodonty']?></option>
          <option value="RA"><?php echo $LANG['fee_table']['radiology']?></option>
          <option value="PE"><?php echo $LANG['fee_table']['periodonty']?></option>
          <option value="PR"><?php echo $LANG['fee_table']['prevention']?></option>
          <option value="PO"><?php echo $LANG['fee_table']['prosthesis']?></option>
          <option value="TE"><?php echo $LANG['fee_table']['laboratory_test_and_examination']?></option>
        </select>
      </td>
      <td width="40%"><?php echo $LANG['fee_table']['procedure']?> <br />
        <input type="text" size="50" name="procedimento" id="procedimento" class="forms" <?php echo $disabled?>>
      </td>
      <td width="17%"><?php echo $LANG['fee_table']['private_value']?><br />
        <input type="text" size="15" name="valor_particular" id="valor_particular" class="forms" <?php echo $disabled?> onKeypress="return Ajusta_Valor(this, event);">
      </td>
      <td width="11%" align="right">&nbsp; <br />
        <input type="submit" name="Salvar" id="Salvar" value="<?php echo $LANG['fee_table']['save']?>" class="forms" <?php echo $disabled?>>
      </td>
    </tr>
  </table>
  </form>
<?php
    }
?>
<div class="conteudo" id="table dados"><br>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td width="7%" height="23" align="left"><?php echo $LANG['fee_table']['code']?></td>
      <td width="50%" align="center"><?php echo $LANG['fee_table']['procedure']?></td>
      <td width="9%" align="center"><?php echo $LANG['fee_table']['private']?></td>
      <td width="9%" align="center"><?php echo $LANG['fee_table']['plan']?></td>
      <td width="18%" colspan="2" align="center"><?php echo $LANG['fee_table']['difference']?></td>
      <td width="7%" align="center"><?php echo $LANG['fee_table']['delete']?></td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('honorarios/pesquisa', 'pesquisa', 'codigo_convenio=<?php echo $_GET['codigo_convenio']?>&campo=procedimento&pesquisa=');
  </script>
</div>
