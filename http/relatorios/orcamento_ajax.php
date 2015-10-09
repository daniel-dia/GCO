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
	$strUpCase = "ALTERAÇÂO";
    $strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$acao = '&acao=editar';
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td>&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="<?php echo $LANG['patients']['manage_patients']?>"> <span class="h3"><?php echo $LANG['patients']['manage_patients']?> &nbsp;[<?php echo $strLoCase?>] </span></td>
    </tr>
</table>
<div class="conteudo" id="table dados">
<br />
<?php include('submenu.php')?>
<br>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    
    <tr>
      <td height="26">&nbsp;<?php echo $LANG['patients']['budget_of_the_patient']?> </td>
    </tr>
  </table>
  <table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;">
        <div align="center"><br /><?php echo ((verifica_nivel('pacientes', 'E'))?'<a href="javascript:Ajax(\'pacientes/orcamentofechar\', \'conteudo\', \'codigo='.$_GET[codigo].$acao.'\')">+ '.$LANG['patients']['insert_new_budget'].'</a><br />':'')?>
          <br />
        </div>
        <fieldset>
      <table width="588" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
        <tr>
          <td bgcolor="#009BE6" colspan="8">&nbsp;</td>
        </tr>
        <tr>
          <td width="15%" height="23" align="left"><?php echo $LANG['patients']['budget']?></td>
          <td width="34%" align="left"><?php echo $LANG['patients']['professional']?></td>
          <td width="13%" align="left"><?php echo $LANG['patients']['date']?></td>
          <td width="14%" align="center"><?php echo $LANG['patients']['value']?></td>
          <td width="11%" align="center"><?php echo $LANG['patients']['edit']?></td>
          <td width="14%" align="center"><?php echo $LANG['patients']['confirmed']?></td>
        </tr>
      </table>
      <table width="588" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
    limpa_orcamentos();
	$i = 0;
	$query = mysql_query("SELECT * FROM `orcamento` WHERE `codigo_paciente` = '$_GET[codigo]' ORDER BY `codigo` ASC");
	while($row = mysql_fetch_array($query)) {
		if($i%2 === 0) {
			$td_class = 'td_even';
		} else {
			$td_class = 'td_odd';
		}
		$dentista = new TDentistas();
		$lista = $dentista->LoadDentista($row[codigo_dentista]);
		$nome = explode(' ', $dentista->RetornaDados('nome'));
		$nome = $nome[0].' '.$nome[count($nome) - 1];
?>
      <tr class="<?php echo $td_class?>">
          <td width="15%"><?php echo $LANG['patients']['budget']?> <?php echo $i+1?></td>
          <td width="34%"><?php echo $dentista->RetornaDados('titulo').' '.$nome;?></td>
          <td width="13%"><?php echo converte_data($row[data], 2)?></td>
          <td width="14%" align="right"><?php echo $LANG['general']['currency'].' '.money_form($row[valortotal]-($row[valortotal]*($row[desconto]/100)))?></td>
          <td width="11%"><div align="center"><a href="javascript:Ajax('pacientes/orcamentofechar', 'conteudo', 'codigo=<?php echo $_GET[codigo]?>&indice_orc=<?php echo ($i+1)?>&acao=editar&subacao=editar&codigo_orc=<?php echo $row[codigo]?>')"><img src="imagens/icones/editar.gif" border="0" alt="Editar" width="16" height="18" /></div></td>
          <td width="14%"><div align="center"><?php echo (($row['confirmado'] == 'Não')?'':'<img src="imagens/icones/ok.gif" border="0" alt="Confirmado" width="19" height="19" /> '.((mysql_num_rows(mysql_query("SELECT * FROM parcelas_orcamento WHERE codigo_orcamento = ".$row['codigo']." AND pago = 'Não'")) > 0)?$LANG['patients']['open']:$LANG['patients']['paid']))?></div></td>
        </tr>
<?php
		$i++;
	}
?>
      </table>
      </fieldset>
        <br />
        <div align="center"></div>
      </form>      </td>
    </tr>
</table>
