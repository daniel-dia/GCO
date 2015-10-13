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
		die($frase_log);
	}
	$paciente = new TInquerito();
	if(isset($_POST[Salvar])) {	
		$paciente->LoadInquerito($_GET[codigo]);
		//$strScrp = "Ajax('pacientes/gerenciar', 'conteudo', '')";
		$paciente->SetDados('tratamento', $_POST[tratamento]);
		$paciente->SetDados('motivotrat', $_POST[motivotrat]);
		$paciente->SetDados('hospitalizado', $_POST[hospitalizado]);
		$paciente->SetDados('motivohosp', $_POST[motivohosp]);
		$paciente->SetDados('cardiovasculares', $_POST[cardiovasculares]);
		$paciente->SetDados('sanguineo', $_POST[sanguineo]);
		$paciente->SetDados('reumatico', $_POST[reumatico]);
		$paciente->SetDados('respiratorio', $_POST[respiratorio]);
		$paciente->SetDados('qualresp', $_POST[qualresp]);
		$paciente->SetDados('gastro', $_POST[gastro]);
		$paciente->SetDados('qualgastro', $_POST[qualgastro]);
		$paciente->SetDados('renal', $_POST[renal]);
		$paciente->SetDados('diabetico', $_POST[diabetico]);
		$paciente->SetDados('contagiosa', $_POST[contagiosa]);
		$paciente->SetDados('qualcont', $_POST[qualcont]);
		$paciente->SetDados('anestesia', $_POST[anestesia]);
		$paciente->SetDados('complicacoesanest', $_POST[complicacoesanest]);
		$paciente->SetDados('alergico', $_POST[alergico]);
		$paciente->SetDados('qualalergico', $_POST[qualalergico]);
		$paciente->SetDados('observacoes', $_POST[observacoes]);
		$paciente->Salvar();
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$paciente->LoadInquerito($_GET[codigo]);
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$row = $paciente->RetornaTodosDados();
	$check = array('tratamento', 'hospitalizado', 'cardiovasculares', 'sanguineo', 'reumatico', 'respiratorio', 'gastro', 'renal', 'diabetico', 'contagiosa', 'anestesia', 'alergico');
	foreach($check as $campo) {
		if($row[$campo] == 'Sim') {
			$chk[$campo]['Sim'] = 'checked';
		} else {
			$chk[$campo]['Não'] = 'checked';
		}
	}
	$acao = '&acao=editar';
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="<?php echo $LANG['patients']['manage_patients']?>"> <span class="h3"><?php echo $LANG['patients']['manage_patients']?> &nbsp;[<?php echo $strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?phpinclude('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;<?php echo $LANG['patients']['health_investigation']?> </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/inquerito_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td width="282">&nbsp;</td>
            <td width="112">&nbsp;</td>
            <td width="86"><div align="right"></div></td>
            <td width="126">&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td><?php echo $LANG['patients']['is_the_patient_under_medical_and_or_surgical_treatment']?></td>
            <td><input name="tratamento" <?php echo $chk[tratamento]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
              <?php echo $LANG['patients']['yes']?>
                <input name="tratamento" <?php echo $chk[tratamento]['Não']?> type="radio" <?php echo $disable?> value="Não" />
            <?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['reason']?>&nbsp; </div></td>
            <td><input name="motivotrat" value="<?php echo $row[motivotrat]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td height="21"><?php echo $LANG['patients']['has_the_patient_been_hospitalized']?> </td>
            <td><input name="hospitalizado" <?php echo $chk[hospitalizado]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="hospitalizado" <?php echo $chk[hospitalizado]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['reason']?>:&nbsp; </div></td>
            <td><input name="motivohosp" value="<?php echo $row[motivohosp]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td><?php echo $LANG['patients']['does_the_patient_suffer_from_cardiovascular_disorders']?></td>
            <td><input name="cardiovasculares" <?php echo $chk[cardiovasculares]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="cardiovasculares" <?php echo $chk[cardiovasculares]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['does_the_patient_suffer_some_blood_disorder']?> </td>
            <td><input name="sanguineo" <?php echo $chk[sanguineo]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="sanguineo" <?php echo $chk[sanguineo]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td><?php echo $LANG['patients']['does_the_patient_present_a_history_of_rheumatic_fever']?> </td>
            <td><input name="reumatico" <?php echo $chk[reumatico]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="reumatico" <?php echo $chk[reumatico]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['does_the_patient_suffer_some_respiratory_disorder']?> </td>
            <td><input name="respiratorio" <?php echo $chk[respiratorio]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="respiratorio" <?php echo $chk[respiratorio]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['which']?>?&nbsp;</div></td>
            <td><input name="qualresp" value="<?php echo $row[qualresp]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td><?php echo $LANG['patients']['does_the_patient_suffer_some_grastrointestinal_disorder']?> </td>
            <td><input name="gastro" <?php echo $chk[gastro]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="gastro" <?php echo $chk[gastro]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['which']?>?&nbsp;</div></td>
            <td><input name="qualgastro" value="<?php echo $row[qualgastro]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['does_the_patient_suffer_a_kidney_disorder']?></td>
            <td><input name="renal" <?php echo $chk[renal]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="renal" <?php echo $chk[renal]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td><?php echo $LANG['patients']['is_the_patient_diabetic']?></td>
            <td><input name="diabetico" <?php echo $chk[diabetico]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="diabetico" <?php echo $chk[diabetico]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['has_or_had_the_patient_infectious_diseases']?> </td>
            <td><input name="contagiosa" <?php echo $chk[contagiosa]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="contagiosa" <?php echo $chk[contagiosa]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['which']?>?&nbsp;</div></td>
            <td><input name="qualcont" value="<?php echo $row[qualcont]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td><?php echo $LANG['patients']['did_the_patient_take_dental_anesthesia']?> </td>
            <td><input name="anestesia" <?php echo $chk[anestesia]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="anestesia" <?php echo $chk[anestesia]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['complications']?>&nbsp;</div></td>
            <td><input name="complicacoesanest" value="<?php echo $row[complicacoesanest]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['is_the_patient_allergic_to_any_medicine']?> </td>
            <td><input name="alergico" <?php echo $chk[alergico]['Sim']?> type="radio" <?php echo $disable?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="alergico" <?php echo $chk[alergico]['Não']?> type="radio" <?php echo $disable?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
            <td><div align="right"><?php echo $LANG['patients']['which']?>?&nbsp;</div></td>
            <td><input name="qualalergico" value="<?php echo $row[qualalergico]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['comments']?></td>
            <td colspan="3"><textarea name="observacoes" cols="40" rows="5" class="forms" <?php echo $disable?>><?php echo $row[observacoes]?></textarea></td>
          </tr>
        </table>
        </fieldset>
        <br />
        <div align="center"><br />
          <input name="Salvar" type="submit" class="forms" <?php echo $disable?> id="Salvar" value="<?php echo $LANG['patients']['save']?>" />
        </div>
      </form>      </td>
    </tr>
  </table>
