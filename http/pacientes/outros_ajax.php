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
	$paciente = new TPacientes();

	$strUpCase = "ALTERAÇÂO";
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$paciente->LoadPaciente($_GET[codigo]);
	$row = $paciente->RetornaTodosDados();
	$row[nascimento] = converte_data($row[nascimento], 2);
	$row[nascimentomae] = converte_data($row[nascimentomae], 2);
	$row[nascimentopai] = converte_data($row[nascimentopai], 2);
	$row[datacadastro] = converte_data($row[datacadastro], 2);
	$acao = '&acao=editar';
	if(isset($strScrp)) {
		echo '<scr'.'ipt>'.$strScrp.'</scr'.'ipt>';
		die();	
	}
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="<?php echo $LANG['patients']['manage_patients']?>"> <span class="h3"><?php echo $LANG['patients']['manage_patients']?> &nbsp;[<?php echo $strLoCase?>] </span></td>
    </tr>
  </table>
<div class="conteudo" id="table dados">
<br />
<?php include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;<?php echo $LANG['patients']['others']?></td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
        <p align="left">
          <br />
          <ul>
            <li><a href="relatorios/agenda.php?codigo=<?php echo $_GET['codigo']?>" target="_blank"><?php echo $LANG['patients']['report_of_consultations_scheduled']?></a><br />&nbsp;</li>
<?php
	if(checknivel('Dentista')) {
?>
            <li><a href="relatorios/receita.php?codigo=<?php echo $_GET['codigo']?>&acao=editar" target="_blank"><?php echo $LANG['patients']['print_recipe']?></a><br />&nbsp;</li>
            <li><a href="relatorios/atestado.php?codigo=<?php echo $_GET['codigo']?>&acao=editar" target="_blank"><?php echo $LANG['patients']['print_certificate']?></a><br />&nbsp;</li>
            <li><a href="relatorios/exame.php?codigo=<?php echo $_GET['codigo']?>&acao=editar" target="_blank"><?php echo $LANG['patients']['print_request_for_examination']?></a><br />&nbsp;</li>
            <li><a href="relatorios/encaminhamento.php?codigo=<?php echo $_GET['codigo']?>&acao=editar" target="_blank"><?php echo $LANG['patients']['print_routing']?></a><br />&nbsp;</li>
            <li><a href="relatorios/laudo.php?codigo=<?php echo $_GET['codigo']?>&acao=editar" target="_blank"><?php echo $LANG['patients']['print_dental_opinion']?></a><br />&nbsp;</li>
            <li><a href="relatorios/agradecimento.php?codigo=<?php echo $_GET['codigo']?>&acao=editar" target="_blank"><?php echo $LANG['patients']['print_thanks_for_routing']?></a><br />&nbsp;</li>
            <li><a href="javascript:Ajax('pacientes/laboratorio', 'conteudo', 'codigo=<?php echo $_GET['codigo']?>&acao=editar');"><?php echo $LANG['patients']['laboratory_materials']?></a><br />&nbsp;</li>
<?php
	}
?>
          </ul>
  <br />
        </p>
        </fieldset>
        <br />
        <div align="center"></div>
      </form>      </td>
    </tr>
  </table>
