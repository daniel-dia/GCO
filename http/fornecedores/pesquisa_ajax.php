<?php
  	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}
?>
  <table class="table table-hover">
      
      <tr>
      <th><?php echo $LANG['suppliers']['company']?></td>
      <th><?php echo $LANG['suppliers']['city_state']?></td>
      <th><?php echo $LANG['suppliers']['telephone']?></td>
      <th><?php echo $LANG['suppliers']['edit_view']?></td>
      <th><?php echo $LANG['suppliers']['delete']?></td>
   </tr>
      
<?php
    $_GET['pesquisa'] = htmlspecialchars($_GET['pesquisa'], ENT_QUOTES);
	$where = "`".$_GET['campo']."` LIKE '".$_GET['pesquisa']."%'";
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	$sql = "SELECT * FROM `fornecedores` WHERE ".$where." ORDER BY `nomefantasia` ASC";
	$pacientes = new TFornecedores();
	$lista = $pacientes->ListFornecedores($sql.' LIMIT '.$limit.', '.PG_MAX);
	$total_regs = $pacientes->ListFornecedores($sql);
	$par = $odev = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
?>
    <tr>
      <td><?php echo $lista[$i][nome]?></td>
      <td><?php echo $lista[$i][cidade_uf]?></td>
      <td><?php echo $lista[$i][telefone]?></td>
      <td><?php echo ((verifica_nivel('fornecedores', 'V'))?'<a href="javascript:Ajax(\'fornecedores/incluir\', \'conteudo\', \'codigo='.$lista[$i][codigo].'&acao=editar\')"><img src="imagens/icones/editar.png" alt="" width="16" height="18" border="0"></a>':'')?></td>
      <td><?php echo ((verifica_nivel('fornecedores', 'A'))?'<a href="javascript:Ajax(\'fornecedores/gerenciar\', \'conteudo\', \'codigo='.$lista[$i][codigo].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.png" alt="" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
	}
?>
  </table>
  <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="160">
      <?php echo $LANG['suppliers']['total_suppliers']?>: <b><?php echo count($total_regs)?></b>
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
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'fornecedores/pesquisa\', \'pesquisa\', \'pg='.$i.'&campo='.$_GET['campo'].'&pesquisa='.$_GET['pesquisa'].'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="140" align="right"><img src="imagens/icones/etiquetas.png" border=""> <a href="etiquetas/print_etiqueta.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"><?php echo $LANG['suppliers']['print_labels']?></a></td>
    </tr>
  </table>
