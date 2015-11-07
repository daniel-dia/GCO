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
      <th><?php echo $LANG['cash_flow']['date']?></td>
      <th><?php echo $LANG['cash_flow']['description']?></td>
      <th><?php echo $LANG['cash_flow']['debit']?></td>
      <th><?php echo $LANG['cash_flow']['credit']?></td>
      <th><?php echo $LANG['cash_flow']['total']?></td>
      <th><?php echo $LANG['patients']['delete']?></td>
    </tr>
      
      
<?php
	$caixa = new TCaixa();
	$data = converte_data($_GET[pesquisa], 1);
	switch ($_GET[peri]) {
		case 'dia': {
			$sql = "SELECT * FROM `caixa` WHERE `data` = '$data' ORDER BY `data` ASC, `codigo` ASC";
		} break;
		case 'mes': {
			$sql = "SELECT * FROM `caixa` WHERE LEFT(`data`, 7) = '$data' ORDER BY `data` ASC, `codigo` ASC";
		} break;
		case 'ano': {
			$sql = "SELECT * FROM `caixa` WHERE LEFT(`data`, 4) = '$data' ORDER BY `data` ASC, `codigo` ASC";
		} break;
		case 'mesatual': {
			$sql = "SELECT * FROM `caixa` WHERE LEFT(`data`, 7) = '".date('Y-m')."' ORDER BY `data` ASC, `codigo` ASC";
		} break;
	}
	$lista = $caixa->ListCaixa($sql);

	$saldo = 0;
	$saldoc = 0;
	$saldod = 0;
	for($i = 0; $i < count($lista); $i++) {
        if($_GET['cpf_dentista'] != 0) {
            $codigo_parcela = explode(' - ', $lista[$i]['descricao']);
       	    $codigo_parcela = explode(' ', $codigo_parcela[0]);
            $codigo_parcela = ((strpos($lista[$i]['descricao'], 'Pagamento da parcela') !== false)?$codigo_parcela[(count($codigo_parcela)-1)]:'');
            $sql1 = "SELECT tor.cpf_dentista FROM orcamento tor INNER JOIN parcelas_orcamento tpo ON tor.codigo = tpo.codigo_orcamento WHERE tpo.codigo = ".$codigo_parcela;
            $query1 = @mysql_query($sql1);
            $row1 = @mysql_fetch_assoc($query1);
            if($_GET['cpf_dentista'] != $row1['cpf_dentista'] || !is_numeric($codigo_parcela)){
                continue;
            }
        }
        if($lista[$i][dc] != '') {
			
			if($lista[$i][dc] == "-") {
				$debito = $LANG['general']['currency'].' '.money_form($lista[$i][valor]);
				$credito = '';
			} else {
				$debito = '';
				$credito = $LANG['general']['currency'].' '.money_form($lista[$i][valor]);
			}
			if($lista[$i][dc] == '-') {
				$saldo -= $lista[$i][valor];
				$saldod += $lista[$i][valor];
			} else {
				$saldo += $lista[$i][valor];
				$saldoc += $lista[$i][valor];
			}
			
?>
    <tr>
      <td><?php echo converte_data($lista[$i][data], 2)?></td>
      <td><?php echo $lista[$i][descricao]?></td>
      <td><?php echo $debito?></td>
      <td><?php echo $credito?></td>
      <td><font color="#<?php echo $cor?>"><?php echo $LANG['general']['currency'].' '.money_form($saldo)?></form></td>
      <td><?php echo ((verifica_nivel('caixa', 'A'))?'<a href="javascript:Ajax(\'caixa/extrato\', \'conteudo\', \'codigo='.$lista[$i]['codigo'].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.png" border="0" /></a>':'')?></td>
    </tr>
<?php
		}
	}
	
?>
        
    <tr>
      <td><b><?php echo $LANG['cash_flow']['total']?></b></td>
      <td><b><?php echo $LANG['general']['currency'].' '.money_form($saldod)?></b></td>
      <td><b><?php echo $LANG['general']['currency'].' '.money_form($saldoc)?></b></td>
      <td colspan="2"><b><?php echo $LANG['general']['currency'].' '.money_form($saldo)?></b></form></td>
    </tr>
  </table>


  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="20%">
      </td>
      <td width="40%" align="center">
      </td>
      <td width="40%" align="right">
        <img src="imagens/icones/imprimir.png" border="0" weight="29" height="33"><a href="relatorios/caixa.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"><?php echo $LANG['patients']['print_report']?></a>
      </td>
    </tr>
  </table>
