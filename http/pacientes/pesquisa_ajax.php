<?php
   	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}

    $sql_leftJoin =  
    "SELECT 
        ( SELECT count(*) from v_orcamento vo
         WHERE 
            vo.data < CURDATE() AND 
            vo.pago = 'Não' AND 
            vo.confirmado = 'Sim' AND 
            vo.baixa = 'Não' AND
            vo.codigo_paciente = tp.codigo
         group by vo.codigo_paciente) as debito, tp.* 
         FROM pacientes tp ";

   
?>
<table class="table table-hover">
    <tr>
        <th>
            <?php echo $LANG['patients']['patient']?>
        </th>
        <th>
            <?php echo $LANG['patients']['clinical_sheet']?>
        </th>
    </tr> 
<?php
    $_GET['pesquisa'] = utf8_decode ( htmlspecialchars( utf8_encode($_GET['pesquisa']) , ENT_QUOTES | ENT_COMPAT, 'utf-8') );
	$pacientes = new TPacientes();
	if($_GET[campo] == 'nascimento') {

        if ( strlen ( $_GET['pesquisa'] ) <= 2 ) {
            $where .= "MONTH(nascimento) = '".$_GET['pesquisa']."'";
        } else {

            $pesq = explode ( '_' , $_GET['pesquisa'] );
            foreach ( $pesq as $k => $v ) {
                $v = explode ( '-' , $v );
                $v[1] = str_pad($v[1], 2, '0', STR_PAD_LEFT);
                $pesq[$k] = implode ( '-' , $v );
            }

            $where = "RIGHT(nascimento, 5) = '".$pesq[0]."'";
            if ( count ( $pesq ) > 1 ) {
                $where = "DATE_FORMAT(nascimento, '%m-%d') BETWEEN '".$pesq[0]."' AND '".$pesq[1]."'";
            }

        }

	} elseif($_GET[campo] == 'nome') {
		$where = "nome LIKE '%".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'telefone') {
		$where = "telefone1 = '".$_GET[pesquisa]."' OR telefone2 = '".$_GET[pesquisa]."' OR celular = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'matricula') {
		$where = "codigo = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'cidade') {
		$where = "cidade LIKE '".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'cep') {
		$where = "cep LIKE '".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'profissao') {
		$where = "profissao LIKE '%".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'area') {
		$where = "tratamento LIKE '%".$_GET[pesquisa]."%'";
	} elseif($_GET[campo] == 'procurado') {
		$where = "codigo_dentistaprocurado = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'atendido') {
		$where = "codigo_dentistaatendido = '".$_GET[pesquisa]."'";
	} elseif($_GET[campo] == 'indicacao') {
        $where = "indicadopor LIKE '%".$_GET[pesquisa]."%'";
    } elseif($_GET[campo] == 'endereco') {
        $where = "endereco LIKE '%".$_GET[pesquisa]."%'";
    }
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	//$sql = "SELECT * FROM `pacientes` WHERE "
            
   $sql = $sql_leftJoin." where ".$where." ORDER BY `nome` ASC";

    if($_GET['campo'] == 'debito') {
         $sql = "SELECT DISTINCT(vo.codigo_paciente), (select true) as debito, tp.* FROM pacientes tp INNER JOIN v_orcamento vo ON tp.codigo = vo.codigo_paciente WHERE data < '".date('Y-m-d')."' AND pago = 'Não' AND confirmado = 'Sim' AND baixa = 'Não' ORDER BY `nome` ASC";
    }
    if($_GET['campo'] == 'agendados') {
        $sql = $sql_leftJoin." INNER JOIN pacientes tp ON ta.codigo_paciente = tp.codigo WHERE ta.data = CURDATE()";
        //$sql = "SELECT DISTINCT ta.codigo_paciente, tp.* FROM agenda ta INNER JOIN pacientes tp ON ta.codigo_paciente = tp.codigo WHERE ta.data = CURDATE()";
    }
            
	$query = (mysql_query($sql.' LIMIT '.$limit.', '.PG_MAX));
 
     while($row = mysql_fetch_array($query)) { 
	 
?>
<tr onclick="Ajax('pacientes/incluir', 'conteudo', 'codigo=<?php echo $row[codigo] ?>&acao=editar')" class="<?php echo $row[debito] == 1 ? 'danger':'' ?> <?php echo $row[falecido] == 1 ? 'warning':'' ?>" >
<td>
    <img class="photosmall img-circle" height="30" src="pacientes/verfoto.php?size=30&codigo=<?php echo $row['codigo']?> "> 
    <?php echo $row[nome]?>
</td>
<td>
    <?php echo $row[codigo].'  '.$row['status'].''?></td>
    
    <!--<td><?php  echo ((verifica_nivel('pacientes', 'A'))?'<a href="javascript:Ajax(\'pacientes/gerenciar\', \'conteudo\', \'codigo='.$row[codigo].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
-->
<?php
	}
?>


  </table>
 

<nav>
  <ul class="pagination">
   
        
        <?php
      
            $pg_total = ceil(count($total_regs)/PG_MAX);
            $i = $_GET[pg] - 5;
            if($i <= 1) {
                $i = 1;
                $reti = '<li></li>';
            } else {
                $reti = '<li><a><span aria-hidden="true">...</span></a></li>';
            }
            $j = $_GET[pg] + 5;
            if($j >= $pg_total) {
                $j = $pg_total;
                $retf = '';
            } else {
                $retf = '<li><a><span aria-hidden="true">...</span></a></li>';
            }
            echo $reti;
      
            while($i <= $j) {
                if($i == $_GET[pg]) {
                    echo '<li class="active"><a>'.$i.'</a></li>';
                } else {
                    echo '<li><a  onclick="javascript:Ajax(\'pacientes/pesquisa\', \'pesquisa\', \'pesquisa=\'%2BgetElementById(getElementById(\'id_procurar\').value).value%2B\'&campo=\'%2BgetElementById(\'campo\').options[getElementById(\'campo\').selectedIndex].value%2B\'&pg='.$i.'\')">'.$i.'</a></li>';
                }
                $i++;
            }
        ?> 
  </ul>
</nav>


<div class="row">
<div class="col-sm-4">
 <?php echo $LANG['patients']['total_patients']?>: <b><?php echo count($total_regs)?></b>
</div>
<div class="col-sm-4">
        <a href="relatorios/pacientes.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> <?php echo $LANG['patients']['print_report']?></a>
</div>
<div class="col-sm-4">
        <a href="etiquetas/print_etiqueta.php?sql=<?php echo ajaxurlencode($sql)?><?php echo ($_GET['campo']=='nascimento' ? '&nasc=true' : '')?>" target="_blank"  class="btn btn-default"><span class="glyphicon glyphicon-tag"></span> <?php echo $LANG['patients']['print_labels']?></a>
</div>
</div>
<br>