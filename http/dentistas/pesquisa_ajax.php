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
  <table class="table  table-hover">
      
      <tr>
          <th><?php echo $LANG['professionals']['professional']?></th>
          <th><?php echo $LANG['professionals']['telephone']?></th>
          <th><?php echo $LANG['professionals']['council']?></th>
      </tr>
        

      
      
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
 
	for($i = 0; $i < count($lista); $i++) {
?>
 <tr onclick="Ajax('dentistas/incluir', 'conteudo', 'codigo= <?php echo $lista[$i][codigo] ?>&acao=editar')"  class="<?php if($lista[$i][ativo]=="Não") echo 'text-danger' ?> ">
      <td><?php echo $lista[$i][titulo].' '.$lista[$i][nome]?></td>
      <td><?php echo $lista[$i][telefone]?></td>
      <td><?php echo $lista[$i][conselho_tipo].'/'.$lista[$i][conselho_estado].' '.$lista[$i][conselho_numero]?></td>
  </tr>
<?php
	}
?>
  </table>
 
 
    
 


    </tr>
  </table>


<div class="row">
<div class="col-sm-4">
   <?php echo $LANG['professionals']['total_professionals']?>: <b><?php echo count($total_regs)?></b>
</div>

<div class="col-sm-4">
      <a href="etiquetas/print_etiqueta.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"  class="btn btn-default">
            <span class="glyphicon glyphicon-tag"></span><?php echo $LANG['professionals']['print_labels']?></a>
</div>
</div>

<div>
    <ul class="pagination">
<?php
	$pg_total = ceil(count($total_regs)/PG_MAX);
	$i = $_GET[pg] - 5;
	if($i <= 1) {
		$i = 1;
		$reti = '<li></li>';
	} else {
		$reti = '<li>...</li>';
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
			echo $i.'<li></li>';
		} else {
			echo '<li><a href="javascript:;" onclick="javascript:Ajax(\'dentistas/pesquisa\', \'pesquisa\', \'pg='.$i.'&campo='.$_GET['campo'].'&pesquisa='.$_GET['pesquisa'].'\')">'.$i.'</a></li>';
		}
		$i++;
	}
	echo $retf;
?>
    
    </ul>
    </div>

