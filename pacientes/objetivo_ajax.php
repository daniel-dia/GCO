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
	$paciente = new TExObjetivo();
	if(isset($_POST[Salvar])) {	
		$paciente->LoadExObjetivo($_GET[codigo]);
		//$strScrp = "Ajax('pacientes/objetivos', 'conteudo', '')";
		$paciente->SetDados('pressao', $_POST[pressao]);
		$paciente->SetDados('peso', $_POST[peso]);
		$paciente->SetDados('altura', $_POST[altura]);
		$paciente->SetDados('edema', $_POST[edema]);
		$paciente->SetDados('face', $_POST[face]);
		$paciente->SetDados('atm', $_POST[atm]);
		$paciente->SetDados('linfonodos', $_POST[linfonodos]);
		$paciente->SetDados('labio', $_POST[labio]);
		$paciente->SetDados('mucosa', $_POST[mucosa]);
		$paciente->SetDados('soalhobucal', $_POST[soalhobucal]);
		$paciente->SetDados('palato', $_POST[palato]);
		$paciente->SetDados('orofaringe', $_POST[orofaringe]);
		$paciente->SetDados('lingua', $_POST[lingua]);
		$paciente->SetDados('gengiva', $_POST[gengiva]);
		$paciente->SetDados('higienebucal', $_POST[higienebucal]);
		$paciente->SetDados('habitosnocivos', $_POST[habitosnocivos]);
		$paciente->SetDados('aparelho', $_POST[aparelho]);
		$paciente->SetDados('lesaointra', $_POST[lesaointra]);
		$paciente->SetDados('observacoes', $_POST[observacoes]);
		$paciente->Salvar();
	}
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$paciente->LoadExObjetivo($_GET[codigo]);
	$row = $paciente->RetornaTodosDados();
	if($row[aparelho] == 'Sim') {
		$chk[aparelho][sim] = 'checked';
	} else {
		$chk[aparelho][nao] = 'checked';
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
      <td height="26">&nbsp;<?php echo $LANG['patients']['objective_examination']?> </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/objetivo_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td width="118">&nbsp;</td>
            <td width="184">&nbsp;</td>
            <td width="159">&nbsp;</td>
            <td width="145"><div align="right"></div></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="24"><?php echo $LANG['patients']['arterial_pressure']?>        </td>
            <td><input name="pressao" value="<?php echo $row[pressao]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['oral_floor']?> </td>
            <td><input name="soalhobucal" value="<?php echo $row[soalhobucal]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td height="24"><?php echo $LANG['patients']['weight']?></td>
            <td><input name="peso" value="<?php echo $row[peso]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['palate']?></td>
            <td><input name="palato" value="<?php echo $row[palato]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="24"><?php echo $LANG['patients']['height']?></td>
            <td><input name="altura" value="<?php echo $row[altura]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['oropharynx']?></td>
            <td><input name="orofaringe" value="<?php echo $row[orofaringe]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td height="24"><?php echo $LANG['patients']['edema']?></td>
            <td><input name="edema" value="<?php echo $row[edema]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['tongue']?></td>
            <td><input name="lingua" value="<?php echo $row[lingua]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="23"><?php echo $LANG['patients']['face']?></td>
            <td><input name="face" value="<?php echo $row[face]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['gingiva']?></td>
            <td><input name="gengiva" value="<?php echo $row[gengiva]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td height="28"><?php echo $LANG['patients']['atm']?></td>
            <td><input name="atm" value="<?php echo $row[atm]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['oral_hygiene']?></td>
            <td><input name="higienebucal" value="<?php echo $row[higienebucal]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="23"><?php echo $LANG['patients']['linfonodes']?></td>
            <td><input name="linfonodos" value="<?php echo $row[linfonodos]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['harmful_habits']?></td>
            <td><input name="habitosnocivos" value="<?php echo $row[habitosnocivos]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['lips']?></td>
            <td><input name="labio" value="<?php echo $row[labio]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['bearer_of_orthodontic_or_prosthetic_apparatus']?> </td>
            <td><input name="aparelho" type="radio" <?php echo $disable?> <?php echo $chk[aparelho][sim]?> value="Sim" />
<?php echo $LANG['patients']['yes']?>
  <input name="aparelho" type="radio" <?php echo $disable?> <?php echo $chk[aparelho][nao]?> value="Não" />
<?php echo $LANG['patients']['no']?></td>
          </tr>
          <tr bgcolor="#F8F8F8">
            <td height="23"><?php echo $LANG['patients']['mucus']?></td>
            <td><input name="mucosa" value="<?php echo $row[mucosa]?>" type="text" class="forms" <?php echo $disable?> /></td>
            <td><?php echo $LANG['patients']['intra_oral_lesion']?></td>
            <td><input name="lesaointra" value="<?php echo $row[lesaointra]?>" type="text" class="forms" <?php echo $disable?> /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $LANG['patients']['comments']?>:</td>
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
