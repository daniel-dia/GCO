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
	if(!verifica_nivel('pacientes', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `pacientes` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		mysql_query("DELETE FROM `exameobjetivo` WHERE `codigo_paciente` = '".$_GET[codigo]."'") or die(mysql_error());
		mysql_query("DELETE FROM `inquerito` WHERE `codigo_paciente` = '".$_GET[codigo]."'") or die(mysql_error());
        mysql_query("UPDATE agenda SET descricao = NULL , procedimento = NULL , faltou = 'Não' , codigo_paciente = NULL WHERE codigo_paciente = '".$_GET[codigo]."'");
	}
?>
<script>
    function esconde(campo) {
        if(campo.selectedIndex == 7) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = '';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar1';
        } else if(campo.selectedIndex == 10 || campo.selectedIndex == 11) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar';
            Ajax('pacientes/pesquisa', 'pesquisa', 'campo='%2Bdocument.getElementById('campo').value);
        } else if(campo.selectedIndex == 8 || campo.selectedIndex == 9) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = '';
            document.getElementById('procurar2').selectedIndex = 0;
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar2';
        } else if(campo.selectedIndex == 1) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = '';
            document.getElementById('procurar3').selectedIndex = 0;
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar3';
        } else if(campo.selectedIndex == 5) {
            document.getElementById('procurar').style.display = 'none';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar3').selectedIndex = 0;
            document.getElementById('procurar4').style.display = '';
            document.getElementById('id_procurar').value = 'procurar3';
        } else {
            document.getElementById('procurar').style.display = '';
            document.getElementById('procurar1').style.display = 'none';
            document.getElementById('procurar2').style.display = 'none';
            document.getElementById('procurar3').style.display = 'none';
            document.getElementById('procurar4').style.display = 'none';
            document.getElementById('id_procurar').value = 'procurar';
        }
    }

    function niver() {

        var pesq = '';

        document.getElementById('dia1').disabled = true;
        document.getElementById('mes2').disabled = true;
        document.getElementById('dia2').disabled = true;

        if ( document.getElementById('mes1').options[document.getElementById('mes1').selectedIndex].value != '' ) {
            pesq %2B= document.getElementById('mes1').options[document.getElementById('mes1').selectedIndex].value;
            document.getElementById('dia1').disabled = false;
        }
        if ( document.getElementById('dia1').value != '' ) {
            pesq %2B= '-' %2B document.getElementById('dia1').value;
            document.getElementById('mes2').disabled = false;
        }

        if ( document.getElementById('mes2').options[document.getElementById('mes2').selectedIndex].value != '' ) {
            pesq %2B= '_' %2B document.getElementById('mes2').options[document.getElementById('mes2').selectedIndex].value;
            document.getElementById('dia2').disabled = false;
        }
        if ( document.getElementById('dia2').value != '' ) {
            pesq %2B= '-' %2B document.getElementById('dia2').value;
        }

        Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2B pesq %2B'&campo='%2Bdocument.getElementById('campo').options[document.getElementById('campo').selectedIndex].value)
    }
</script>
<div class="conteudo" id="conteudo_central">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="38%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="<?php echo $LANG['patients']['manage_patients']?>"> <span class="h3"><?php echo $LANG['patients']['manage_patients']?></span></td>
      <td width="62%" valign="bottom">
      	<table width="98%" border="0" cellpadding="0" cellspacing="0">
      	  <tr>
      	    <td width="40%">
      	      <?php echo $LANG['patients']['search_for']?><br>
      	      <select name="campo" id="campo" class="forms" onchange="esconde(this)">
      	        <option value="nome"><?php echo $LANG['patients']['name']?></option>
      	        <option value="nascimento"><?php echo $LANG['patients']['birthdays']?></option>
      	        <option value="matricula"><?php echo $LANG['patients']['clinical_sheet']?></option>
      	        <option value="cidade"><?php echo $LANG['patients']['city']?></option>
      	        <option value="cep"><?php echo $LANG['patients']['zip']?></option>
      	        <option value="telefone"><?php echo $LANG['patients']['telephone']?></option>
      	        <option value="profissao"><?php echo $LANG['patients']['profession']?></option>
      	        <option value="area"><?php echo $LANG['patients']['treatment_area']?></option>
      	        <option value="procurado"><?php echo $LANG['patients']['professional_searched']?></option>
      	        <option value="atendido"><?php echo $LANG['patients']['professional_who_answered']?></option>
      	        <option value="debito"><?php echo $LANG['patients']['patients_in_debt']?></option>
                <option value="agendados"><?php echo $LANG['patients']['scheduled_patients']?></option>
                <option value="indicacao"><?php echo $LANG['patients']['indicated_by']?></option>
                <option value="endereco"><?php echo $LANG['patients']['address1']?></option>
      	      </select>
      	      <input type="hidden" id="id_procurar" value="procurar">
      	    </td>
      	    <td width="60%">
      	      <br>
      	      <input name="procurar" id="procurar" type="text" class="forms" size="20" maxlength="40" onkeyup="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	      <select name="procurar1" id="procurar1" style="display:none" class="forms" onchange="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option value=""></option>
                <option value="Ortodontia"><?php echo $LANG['patients']['orthodonty']?></option>
                <option value="Implantodontia"><?php echo $LANG['patients']['implantodonty']?></option>
                <option value="Dentística"><?php echo $LANG['patients']['dentistic']?></option>
                <option value="Prótese"><?php echo $LANG['patients']['prosthesis']?></option>
                <option value="Odontopediatria"><?php echo $LANG['patients']['odontopediatry']?></option>
                <option value="Cirurgia"><?php echo $LANG['patients']['surgery']?></option>
                <option value="Endodontia"><?php echo $LANG['patients']['endodonty']?></option>
                <option value="Periodontia"><?php echo $LANG['patients']['periodonty']?></option>
                <option value="Radiologia"><?php echo $LANG['patients']['radiology']?></option>
                <option value="DTM"><?php echo $LANG['patients']['dtm']?></option>
                <option value="Odontogeriatria"><?php echo $LANG['patients']['odontogeriatry']?></option>
                <option value="Ortopedia"><?php echo $LANG['patients']['orthopedy']?></option>
      	      </select>
      	      <select name="procurar2" id="procurar2" style="display:none" class="forms" onchange="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
                <option></option>
<?php
	$dentista = new TDentistas();
	$lista = $dentista->ListDentistas();
	for($i = 0; $i < count($lista); $i++) {
		if($row[codigo_dentistaprocurado] == $lista[$i][codigo]) {
			echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
		} else {
			echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
		}
	}
?>
			  </select>
              <div id="procurar3" style="display:none">
                  <select name="mes1" id="mes1" class="forms" onchange="javascript:niver()">
                      <option value=""></option>
                      <?php
                      for($i = 1; $i <= 12; $i++) {
                          echo '                <option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.nome_mes($i).'</option>';
                      }
                      ?>
                  </select>
                  <input name="dia1" id="dia1" disabled="disabled" type="text" class="forms" size="4" maxlength="2" onkeyup="javascript:niver()">
                  <br />

                  <select name="mes2" id="mes2" disabled="disabled" class="forms" onchange="javascript:niver()" style="margin-top: 3px;">
                      <option value=""></option>
                      <?php
                      for($i = 1; $i <= 12; $i++) {
                          echo '                <option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.nome_mes($i).'</option>';
                      }
                      ?>
                  </select>
                  <input name="dia2" id="dia2" disabled="disabled" type="text" class="forms" size="4" maxlength="2" onkeyup="javascript:niver()">
              </div>
      	      <input name="procurar4" id="procurar4" style="display:none" type="text" class="forms" size="20" maxlength="13" onkeypress="return Ajusta_Telefone(this, event);" onkeyup="javascript:Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
      	    </td>
      	  </tr>
      	</table>
	  </td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="bottom">
        <?php echo ((verifica_nivel('pacientes', 'I'))?'<img src="imagens/icones/novo.gif" alt="Incluir" width="19" height="22" border="0"><a href="javascript:Ajax(\'pacientes/incluir\', \'conteudo\', \'\')">'.$LANG['patients']['include_new_patient'].'</a>':'')?>
      </td>
    </tr>
</table>
<div class="conteudo" id="table dados"><br>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6">&nbsp;</td>
      <td bgcolor="#009BE6">&nbsp;</td>
      <td bgcolor="#009BE6">&nbsp;</td>
      <td bgcolor="#009BE6">&nbsp;</td>
    </tr>
    <tr>
      <td width="63%" height="23" align="left"><?php echo $LANG['patients']['patient']?></td>
      <td width="20%" align="left"><?php echo $LANG['patients']['clinical_sheet']?></td>
      <td width="8%" align="center"><?php echo $LANG['patients']['edit_view']?></td>
      <td width="9%" align="center"><?php echo $LANG['patients']['delete']?></td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('pacientes/pesquisa', 'pesquisa', 'pesquisa=&campo=nome');
  </script>
</div>
