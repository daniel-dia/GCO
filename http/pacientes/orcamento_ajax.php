<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}
	$strUpCase = "ALTERAÇÂO";
    $strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
	$frmActEdt = "?acao=editar&codigo=".$_GET[codigo];
	$acao = '&acao=editar';
?>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
 
<div class="conteudo" id="table dados">

            <h3><?php echo $LANG['patients']['budget_of_the_patient']?></h3>
   
    
            <?php if(verifica_nivel('pacientes', 'E')){ ?>
                <a  class="btn btn-default" href="javascript:Ajax('pacientes/orcamentofechar', 'pacientesConteudo', 'codigo=<?php echo $_GET[codigo].$acao?> ')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  <?php echo $LANG['patients']['insert_new_budget']?></a>
            <?php }?>
 
      <br />
      <br />
    
      <table class="table table-hover">
        <tr>
          <th><?php echo $LANG['patients']['budget']?></td>
          <th><?php echo $LANG['patients']['professional']?></td>
          <th><?php echo $LANG['patients']['date']?></td>
          <th style="text-align:right"><?php echo $LANG['patients']['value']?></td>
          <th><?php echo $LANG['patients']['confirmed']?></td>
        </tr>
     
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
      <tr class="<?php echo $td_class?>" onclick="Ajax('pacientes/orcamentofechar', 'conteudo', 'codigo=<?php echo $_GET[codigo]?>&indice_orc=<?php echo ($i+1)?>&acao=editar&subacao=editar&codigo_orc=<?php echo $row[codigo]?>')">
          <td><?php echo $LANG['patients']['budget']?> <?php echo $i+1?></td>
          <td><?php echo $dentista->RetornaDados('titulo').' '.$nome;?></td>
          <td><?php echo converte_data($row[data], 2)?></td>
          <td align="right"><?php echo $LANG['general']['currency'].' '.money_form($row[valortotal]-($row[valortotal]*($row[desconto]/100)))?></td>
          <td><div align="center"><?php echo (($row['confirmado'] == 'Não')?'':'<img src="imagens/icones/ok.png" border="0" alt="Confirmado" width="19" height="19" /> '.((mysql_num_rows(mysql_query("SELECT * FROM parcelas_orcamento WHERE codigo_orcamento = ".$row['codigo']." AND pago = 'Não'")) > 0)?$LANG['patients']['open']:$LANG['patients']['paid']))?></div></td>
        </tr>
            <?php
                    $i++;
                }
            ?>
      </table>

</div>