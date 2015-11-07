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
      <th><?php echo $LANG['stock']['description']?></th>
      <th><?php echo $LANG['stock']['quantity']?></th>
        <th><?php echo $LANG['stock']['delete']?></th>
    </tr>

<?php
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	$sql = "SELECT * FROM `estoque` WHERE `descricao` LIKE '%".$_GET['pesquisa']."%' ORDER BY `descricao` ASC";
	$conta = new TEstoque('clinica');
	$lista = $conta->ListConta($sql.' LIMIT '.$limit.', '.PG_MAX_MEN);
	$total_regs = $conta->ListConta($sql);
	$par = $odev = "F0F0F0";
	$impar = "F8F8F8";
	$saldo = 0;
	for($i = 0; $i < count($lista); $i++) {
	
		$conta->LoadConta($lista[$i][codigo]);
		$saldo += $conta->RetornaDados('valor');
?>
    <tr>
      <td><?php echo $conta->RetornaDados('descricao')?></td>
      <td><input type="text" class="form-control" size="13" name="quantidade" id="quantidade" value="<?php echo $conta->RetornaDados('quantidade')?>" onblur="Ajax('estoque/atualiza', 'conta_atualiza', 'codigo=<?php echo $conta->RetornaDados('codigo')?>&estoque='%2Bthis.value)" <?php echo ((!verifica_nivel('estoque', 'E'))?'disabled':'')?>></td>
      <td><?php echo ((verifica_nivel('estoque', 'A'))?'<a href="javascript:Ajax(\'estoque/extrato\', \'conteudo\', \'codigo='.$conta->RetornaDados('codigo').'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.png" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
	}
?>
  </table>

  <br>
  <table class="table">
    <tr>
      <td width="160">
      <?php echo $LANG['stock']['total_stock']?>: <b><?php echo count($total_regs)?></b>
      </td>
      <td width="450" align="center">
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
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'estoque/pesquisa\', \'pesquisa\', \'pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="140" align="right"><img src="imagens/icones/imprimir.png" border="0"> <a href="relatorios/estoque.php?sql=<?php echo $sql?>" target="_blank"><?php echo $LANG['stock']['print_report']?></a></td>
    </tr>
  </table>
  <div id="conta_atualiza"></div>
