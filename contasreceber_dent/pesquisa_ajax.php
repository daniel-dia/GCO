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
	$senha = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `codigo` = '".$_GET[codigo_dentista]."'"));
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
		$conta = new TContas('dentista', 'receber');
		$data = converte_data($_GET[pesquisa], 1);
		$codigo_dentista = $_SESSION[codigo];
        switch ($_GET['peri']) {
            case 'dia': {
                $where = "`datavencimento` = '$data' AND";
            } break;
            case 'mes': {
                $where = "LEFT(`datavencimento`, 7) = '$data' AND";
            } break;
            default:
                //case 'mesatual': {
                $where = "LEFT(`datavencimento`, 7) = '".date(Y.'-'.m)."' AND";
            //} break;
            //    $where = '';
        }

        $sql = "SELECT * FROM `contasreceber_dent` WHERE " . $where . " `codigo_dentista` = '" . $codigo_dentista. "' ORDER BY `datavencimento` ASC, `codigo` ASC";

        if($_GET['pg'] != '') {
            $limit = ($_GET['pg']-1)*PG_MAX;
        } else {
            $limit = 0;
            $_GET['pg'] = 1;
        }

        $total_regs = $conta->ListConta($sql);
        $lista = $conta->ListConta($sql.' LIMIT '.$limit.', '.PG_MAX);

		$par = "F0F0F0";
		$impar = "F8F8F8";
		$saldo = 0;
		for($i = 0; $i < count($lista); $i++) {
			if($i % 2 == 0) {
				$odev = $par;
			} else {
				$odev = $impar;
			}
			$conta->LoadConta($lista[$i][codigo]);
			$saldo += $conta->RetornaDados('valor');
?>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="11%" height="23" align="left"><?php echo converte_data($conta->RetornaDados('datavencimento'), 2)?></td>
      <td width="50%" align="left"><?php echo $conta->RetornaDados('descricao')?></td>
      <td width="13%" align="right"><?php echo money_form($conta->RetornaDados('valor'))?></td>
      <td width="21%" align="right"><input type="text" size="13" name="datapagamento" id="datapagamento" value="<?php echo converte_data($conta->RetornaDados('datapagamento'), 2)?>" onblur="Ajax('contasreceber_dent/atualiza', 'conta_atualiza', 'codigo=<?php echo $conta->RetornaDados('codigo')?>&datapagamento='%2Bthis.value)" onKeypress="return Ajusta_Data(this, event);" <?php echo ((!verifica_nivel('contas_receber', 'E'))?'disabled':'')?>></td>
      <td width="5%" align="center"><?php echo ((verifica_nivel('contas_receber', 'A'))?'<a href="javascript:Ajax(\'contasreceber_dent/extrato\', \'conteudo\', \'codigo='.$conta->RetornaDados('codigo').'&codigo_dentista='.$_GET[codigo_dentista].'&senha_dentista='.$_GET[senha_dentista].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
	}
	if($odev == $impar) {
		$odev = $par;
	} else {
		$odev = $impar;
	}	
?>
    <tr>
      <td height="23" align="left" colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="61%" colspan="2" height="23" align="center"><b><?php echo $LANG['accounts_receivable']['total']?></b></td></td>
      <td width="13%" align="right"><font color="#<?php echo $cor?>"><b><?php echo $LANG['general']['currency'].' '.money_form($saldo)?></b></font></td>
      <td width="13%" colspan="2" align="right"></td>
    </tr>
  </table>
<br>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
        <td width="100%" align="center">
            <?php
            $pg_total = ceil(count($total_regs)/PG_MAX);
            $i = $_GET['pg'] - 5;
            if($i <= 1) {
                $i = 1;
                $reti = '';
            } else {
                $reti = '...&nbsp;&nbsp;';
            }
            $j = $_GET['pg'] + 5;
            if($j >= $pg_total) {
                $j = $pg_total;
                $retf = '';
            } else {
                $retf = '...';
            }
            echo $reti;
            while($i <= $j) {
                if($i == $_GET['pg']) {
                    echo $i.'&nbsp;&nbsp;';
                } else {
                    echo '<a href="javascript:;" onclick="javascript:Ajax(\'contaspagar_dent/pesquisa\', \'pesquisa\', \'pesquisa=\'%2BgetElementById(\'procurar\').value%2B\'&peri=\'%2BgetElementById(\'peri\').value%2B\'&pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
                }
                $i++;
            }
            echo $retf;
            ?>
        </td>
    </tr>
</table>
<div id="conta_atualiza"></div>
