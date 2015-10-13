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
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
	$lista = $caixa->ListCaixa("SELECT * FROM `caixa` ORDER BY `data` DESC,  `codigo` DESC LIMIT 9");
	$par = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < 9; $i++) {
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
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="11%" height="23" align="left"><?php echo converte_data($lista[$i][data], 2)?></td>
      <td width="41%" align="left"><?php echo $lista[$i][descricao]?></td>
      <td width="13%" align="right"><?php echo $debito?></td>
      <td width="13%" align="right"><?php echo $credito?></td>
      <td width="13%" align="right"></td>
      <td width="10%" align="center"><?php echo ((verifica_nivel('caixa', 'A'))?'<a href="javascript:Ajax(\'caixa/extrato\', \'conteudo\', \'codigo='.$lista[$i]['codigo'].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" border="0" /></a>':'')?></td>
    </tr>
<?php
		}
	}
?>
  </table>
