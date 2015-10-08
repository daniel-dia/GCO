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
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
    $_GET['pesquisa'] = htmlspecialchars($_GET['pesquisa'], ENT_QUOTES);
	$dentistas = new TDentistas();
	if($_GET[campo] == 'nascimento') {
		$where = "WHERE MONTH(`nascimento`) = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'nome') {
		$where = "WHERE `nome` LIKE '%".$_GET[pesquisa]."%'";
	}elseif($_GET[campo] == 'cpf') {
		$where = "WHERE `cpf` = '".$_GET[pesquisa]."'";
	}
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	$sql = "SELECT * FROM `dentistas` ".$where." ORDER BY `nome` ASC";
	$lista = $dentistas->ListDentistas($sql.' LIMIT '.$limit.', '.PG_MAX);
	$total_regs = $dentistas->ListDentistas($sql);
	$par = $odev = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
		if($lista[$i][ativo] == 'Não') {
			$ativo = '#808080';
		} else {
			$ativo = '#000000';
		}
?>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="325"><font color="<?php echo $ativo?>"><?php echo $lista[$i][titulo].' '.$lista[$i][nome]?></td>
      <td width="150"><font color="<?php echo $ativo?>"><?php echo $lista[$i][telefone]?></td>
      <td width="150"><font color="<?php echo $ativo?>"><?php echo $lista[$i][conselho_tipo].'/'.$lista[$i][conselho_estado].' '.$lista[$i][conselho_numero]?></td>
      <td width="59" align="center"><?php echo ((verifica_nivel('profissionais', 'V'))?'<a href="javascript:Ajax(\'dentistas/incluir\', \'conteudo\', \'codigo='.$lista[$i][codigo].'&acao=editar\')"><img src="imagens/icones/editar.gif" alt="" width="16" height="18" border="0"></a>':'')?></td>
      <td width="66" align="center"><?php echo ((verifica_nivel('profissionais', 'A'))?'<a href="javascript:Ajax(\'dentistas/gerenciar\', \'conteudo\', \'codigo='.$lista[$i][codigo].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
	}
?>
  </table>
  <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="160">
      <?php echo $LANG['professionals']['total_professionals']?>: <b><?php echo count($total_regs)?></b>
      </td>
      <td width="450" align="center">
<?php
	$pg_total = ceil(count($total_regs)/PG_MAX);
	$i = $_GET[pg] - 5;
	if($i <= 1) {
		$i = 1;
		$reti = '';
	} else {
		$reti = '...&nbsp;&nbsp;';
	}
	$j = $_GET[pg] + 5;
	if($j >= $pg_total) {
		$j = $pg_total;
		$retf = '';
	} else {
		$retf = '...';
	}
	echo $reti;
	while($i <= $j) {
		if($i == $_GET[pg]) {
			echo $i.'&nbsp;&nbsp;';
		} else {
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'dentistas/pesquisa\', \'pesquisa\', \'pg='.$i.'&campo='.$_GET['campo'].'&pesquisa='.$_GET['pesquisa'].'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="140" align="right"><img src="imagens/icones/etiquetas.gif" border=""> <a href="etiquetas/print_etiqueta.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"><?php echo $LANG['professionals']['print_labels']?></a></td>
    </tr>
  </table>
