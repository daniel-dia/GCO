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
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX_MEN;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
    switch($_GET['campo']) {
        case 'area' : $sql = "SELECT * FROM honorarios WHERE LEFT(codigo, 2) = '".$_GET['pesquisa']."' ORDER BY codigo ASC";
            break;
        case 'codigo' : $sql = "SELECT * FROM honorarios WHERE ".$_GET['campo']." = '".$_GET['pesquisa']."' ORDER BY codigo ASC";
            break;
        default : $sql = "SELECT * FROM honorarios WHERE ".$_GET['campo']." LIKE '%".$_GET['pesquisa']."%' ORDER BY codigo ASC";
            break;
    }

	$conta = new THonorarios('clinica');
	$lista = $conta->Consulta($sql.' LIMIT '.$limit.', '.PG_MAX_MEN);
	$total_regs = $conta->Consulta($sql);
	$par = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
		$conta->LoadInfo($lista[$i]['codigo']);
		$valor_particular = encontra_valor('honorarios_convenios', 'codigo_convenio = 1 AND codigo_procedimento', $conta->RetornaDados('codigo'), 'valor');
		$valor_convenio = encontra_valor('honorarios_convenios', 'codigo_convenio = '.$_GET['codigo_convenio'].' AND codigo_procedimento', $conta->RetornaDados('codigo'), 'valor');
?>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="7%" align="left"><?php echo $conta->RetornaDados('codigo')?></td>
      <td width="50%" align="center"><input type="text" <?php echo ((!verifica_nivel('honorarios', 'E'))?'disabled':'')?> class="forms" size="70" name="procedimento" id="procedimento" value="<?php echo $conta->RetornaDados('procedimento')?>" onblur="Ajax('honorarios/atualiza', 'conta_atualiza', 'codigo=<?php echo $conta->RetornaDados('codigo')?>&procedimento='%2Bthis.value)"></td>
      <td width="9%" align="center"><input type="text" <?php echo (($_GET['codigo_convenio'] != '1' || !verifica_nivel('honorarios', 'E'))?'disabled':'')?> class="forms" size="8" name="valor_particular" id="valor_particular" value="<?php echo number_format($valor_particular, 2, '.', '')?>" onblur="Ajax('honorarios/atualiza', 'conta_atualiza', '&codigo_convenio=1&codigo=<?php echo $conta->RetornaDados('codigo')?>&valor='%2Bthis.value)" onKeypress="return Ajusta_Valor(this, event);"></td>
      <td width="9%" align="center"><?php echo (($_GET['codigo_convenio'] != '1')?'<input type="text" '.((!verifica_nivel('honorarios', 'E'))?'disabled':'').' class="forms" size="8" name="valor_convenio"   id="valor_convenio"   value="'.number_format($valor_convenio, 2, '.', '').'"   onblur="Ajax(\'honorarios/atualiza\', \'conta_atualiza\', \'&codigo_convenio='.$_GET['codigo_convenio'].'&codigo='.$conta->RetornaDados('codigo').'&valor=\'%2Bthis.value)" onKeypress="return Ajusta_Valor(this, event);">':'')?></td>
      <td width="9%" align="right"><?php echo (($_GET['codigo_convenio'] != '1')?$LANG['general']['currency'].' '.@number_format($valor_particular - $valor_convenio, 2, ',', '.'):'')?></td>
      <td width="9%" align="right"><?php echo (($_GET['codigo_convenio'] != '1')?@number_format(round(100 - ($valor_convenio / $valor_particular) * 100, 2), 2, ',', '.').' %':'')?></td>
      <td width="7%" align="center"><?php echo ((verifica_nivel('honorarios', 'A'))?'<a href="javascript:Ajax(\'honorarios/honorarios\', \'conteudo\', \'codigo_convenio='.$_GET['codigo_convenio'].'&codigo='.$conta->RetornaDados('codigo').'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
	}
?>
  </table>
  <br>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="25%">
      <?php echo $LANG['fee_table']['total_procedures']?>: <b><?php echo count($total_regs)?></b>
      </td>
      <td width="56%" align="center">
<?php
	$pg_total = ceil(count($total_regs)/PG_MAX_MEN);
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
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'honorarios/pesquisa\', \'pesquisa\', \'codigo_convenio='.$_GET['codigo_convenio'].'&pesquisa=\'%2Bdocument.getElementById(document.getElementById(\'id_procurar\').value).value%2B\'&campo=\'%2BgetElementById(\'campo\').options[getElementById(\'campo\').selectedIndex].value%2B\'&pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="19%" align="right"><img src="imagens/icones/imprimir.gif" border="0"> <a href="relatorios/honorarios.php?codigo_convenio=<?php echo $_GET['codigo_convenio']?>&sql=<?php echo $sql?>" target="_blank"><?php echo $LANG['fee_table']['print_report']?></a></td>
    </tr>
  </table>
  <div id="conta_atualiza"></div>
