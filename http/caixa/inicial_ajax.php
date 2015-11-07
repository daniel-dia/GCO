<?php

die();  
 	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}
	$caixa = new TCaixa();
	if(isset($_POST[Salvar])) {	
		$obrigatorios[1] = 'data';
		$obrigatorios[] = 'descricao';
		$obrigatorios[] = 'dc';
		$obrigatorios[] = 'valor';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
		if($j == 0) {
			$caixa->SalvarNovo();
			$caixa->SetDados('data', converte_data($_POST[data], 1));
			$caixa->SetDados('descricao', $_POST[descricao]);
			$caixa->SetDados('dc', $_POST[dc]);
			$caixa->SetDados('valor', $_POST[valor]);
			$caixa->Salvar();
		}
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
	$lista = $caixa->ListCaixa("SELECT * FROM `caixa` ORDER BY `data` DESC,  `codigo` DESC LIMIT 9");
	for($i = 0; $i < 9; $i++) {
		if($lista[$i][dc] != '') {
		
			if($lista[$i][dc] == "-") {
				$debito = $LANG['general']['currency'].' '.money_form($lista[$i][valor]);
				$credito = '';
			} else {
				$debito = '';
				$credito = $LANG['general']['currency'].' '.money_form($lista[$i][valor]);
			}
			$saldo = $caixa->SaldoTotal();
			for($j = $i-1; $j >= 0; $j--) {
				if($lista[$j][dc] == '-') {
					$saldo += $lista[$j][valor];
				} else {
					$saldo -= $lista[$j][valor];
				}
			}
?>
    <tr>
      <td><?php echo converte_data($lista[$i][data], 2)?></td>
      <td><?php echo $lista[$i][descricao]?></td>
      <td><?php echo $debito?></td>
      <td><?php echo $credito?></td>
      <td></td>
      <td><?php echo ((verifica_nivel('caixa', 'A'))?'<a href="javascript:Ajax(\'caixa/extrato\', \'conteudo\', \'codigo='.$lista[$i]['codigo'].'" onclick="return confirmLink(this)"><img  height="20" src="imagens/icones/excluir.png" border="0" /></a>':'')?></td>
    </tr>
<?php
		}
	}
?>
  </table>
