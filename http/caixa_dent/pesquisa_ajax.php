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
	$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `codigo` = '".$_SESSION[codigo]."'"));

?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
	$caixa = new TCaixa('caixa_dent');
	$data = converte_data($_GET[pesquisa], 1);
	switch ($_GET[peri]) {
		case 'dia': {
			$sql = "SELECT * FROM `caixa_dent` WHERE `codigo_dentista` = '".$_SESSION[codigo]."' AND `data` = '$data' ORDER BY `data` ASC, `codigo` ASC";
		} break;
		case 'mes': {
			$sql = "SELECT * FROM `caixa_dent` WHERE `codigo_dentista` = '".$_SESSION[codigo]."' AND LEFT(`data`, 7) = '$data' ORDER BY `data` ASC, `codigo` ASC";
		} break;
		case 'ano': {
			$sql = "SELECT * FROM `caixa_dent` WHERE `codigo_dentista` = '".$_SESSION[codigo]."' AND LEFT(`data`, 4) = '$data' ORDER BY `data` ASC, `codigo` ASC";
		} break;
		case 'mesatual': {
			$sql = "SELECT * FROM `caixa_dent` WHERE `codigo_dentista` = '".$_SESSION[codigo]."' AND LEFT(`data`, 7) = '".date('Y-m')."' ORDER BY `data` ASC, `codigo` ASC";
		} break;
	}
	$lista = $caixa->ListCaixa($sql);
	$par = "F0F0F0";
	$impar = "F8F8F8";
	$saldo = 0;
	$saldoc = 0;
	$saldod = 0;
	for($i = 0; $i < count($lista); $i++) {
		if($lista[$i][dc] != '') {
			if($i % 2 == 0) {
				$odev = $par;
			} else {
				$odev = $impar;
			}
			if($lista[$i][dc] == "-") {
				$debito = $LANG['general']['currency'].' '.money_form($lista[$i][valor]);
				$credito = '';
			} else {
				$debito = '';
				$credito = ' '.money_form($lista[$i][valor]);
			}
			if($lista[$i][dc] == '-') {
				$saldo -= $lista[$i][valor];
				$saldod += $lista[$i][valor];
			} else {
				$saldo += $lista[$i][valor];
				$saldoc += $lista[$i][valor];
			}
			if($saldo < 0) {
				$cor = "FF0000";
			} else {
				$cor = "000000";
			}
?>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="11%" height="23" align="left"><?php echo converte_data($lista[$i][data], 2)?></td>
      <td width="41%" align="left"><?php echo $lista[$i][descricao]?></td>
      <td width="13%" align="right"><?php echo $debito?></td>
      <td width="13%" align="right"><?php echo $credito?></td>
      <td width="13%" align="right"><font color="#<?php echo $cor?>"><?php echo $LANG['general']['currency'].' '.money_form($saldo)?></form></td>
      <td width="10%" align="center"><?php echo ((verifica_nivel('caixa', 'A'))?'<a href="javascript:Ajax(\'caixa_dent/extrato\', \'conteudo\', \'codigo='.$lista[$i]['codigo'].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" border="0" /></a>':'')?></td>
    </tr>
<?php
		}
	}
	if($odev == $impar) {
		$odev = $par;
	} else {
		$odev = $impar;
	}	
?>
    <tr>
      <td height="23" align="left" colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="51%" colspan="2" height="23" align="left"><b><?php echo $LANG['cash_flow']['total']?></b></td>
      <td width="13%" align="right"><b><?php echo $LANG['general']['currency'].' '.money_form($saldod)?></b></td>
      <td width="13%" align="right"><b><?php echo $LANG['general']['currency'].' '.money_form($saldoc)?></b></td>
      <td width="13%" align="right"><font color="#<?php echo $cor?>"><b><?php echo $LANG['general']['currency'].' '.money_form($saldo)?></b></form></td>
      <td width="10%" align="center"></td>
    </tr>
  </table><br />
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="20%">
      </td>
      <td width="40%" align="center">
      </td>
      <td width="40%" align="right">
        <img src="imagens/icones/imprimir.gif" border="0" weight="29" height="33"><a href="relatorios/caixa.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"><?php echo $LANG['patients']['print_report']?></a>
      </td>
    </tr>
  </table>
