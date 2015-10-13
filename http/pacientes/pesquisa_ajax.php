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
    function em_debito($codigo) {
        $query = mysql_query("SELECT DISTINCT(vo.codigo_paciente), tp.* FROM pacientes tp INNER JOIN v_orcamento vo ON tp.codigo = vo.codigo_paciente WHERE data < '".date('Y-m-d')."' AND pago = 'Não' AND confirmado = 'Sim' AND baixa = 'Não' AND tp.codigo = ".$codigo." ORDER BY `nome` ASC");
        return(mysql_num_rows($query) > 0);
    }
?>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
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
	$sql = "SELECT * FROM `pacientes` WHERE ".$where." ORDER BY `nome` ASC";

    if($_GET['campo'] == 'debito') {
        $sql = "SELECT DISTINCT(vo.codigo_paciente), tp.* FROM pacientes tp INNER JOIN v_orcamento vo ON tp.codigo = vo.codigo_paciente WHERE data < '".date('Y-m-d')."' AND pago = 'Não' AND confirmado = 'Sim' AND baixa = 'Não' ORDER BY `nome` ASC";
    }
    if($_GET['campo'] == 'agendados') {
        $sql = "SELECT DISTINCT ta.codigo_paciente, tp.* FROM agenda ta INNER JOIN pacientes tp ON ta.codigo_paciente = tp.codigo WHERE ta.data = CURDATE()";
    }
	$lista = $pacientes->ListPacientes($sql.' LIMIT '.$limit.', '.PG_MAX);
	$total_regs = $pacientes->ListPacientes($sql);
	$par = $odev = "F0F0F0";
	$impar = "F8F8F8";
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
?>
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="63%"><?php echo ((encontra_valor('pacientes', 'codigo', $lista[$i]['codigo'], 'falecido') == 'Sim')?'<font color="#808080">':((em_debito($lista[$i][codigo]))?'<font color="red">':'')).$lista[$i][nome].' ('.encontra_valor('pacientes', 'codigo', $lista[$i]['codigo'], 'status').')'?></td>
      <td width="20%"><?php echo ((encontra_valor('pacientes', 'codigo', $lista[$i]['codigo'], 'falecido') == 'Sim')?'<font color="#808080">':((em_debito($lista[$i][codigo]))?'<font color="red">':'')).$lista[$i][codigo]?></td>
      <td width="8%" align="center"><?php echo ((verifica_nivel('pacientes', 'V'))?'<a href="javascript:Ajax(\'pacientes/incluir\', \'conteudo\', \'codigo='.$lista[$i][codigo].'&acao=editar\')"><img src="imagens/icones/editar.gif" alt="Editar" width="16" height="18" border="0"></a>':'')?></td>
      <td width="9%" align="center"><?php echo ((verifica_nivel('pacientes', 'A'))?'<a href="javascript:Ajax(\'pacientes/gerenciar\', \'conteudo\', \'codigo='.$lista[$i][codigo].'" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a>':'')?></td>
    </tr>
<?php
	}
?>
  </table>
  <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?php echo $odev?>" onmouseout="style.background='#<?php echo $odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="20%">
      <?php echo $LANG['patients']['total_patients']?>: <b><?php echo count($total_regs)?></b>
      </td>
      <td width="40%" align="center">
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
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'pacientes/pesquisa\', \'pesquisa\', \'pesquisa=\'%2BgetElementById(getElementById(\'id_procurar\').value).value%2B\'&campo=\'%2BgetElementById(\'campo\').options[getElementById(\'campo\').selectedIndex].value%2B\'&pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="43%" align="right">
        <img src="imagens/icones/imprimir.gif" border="0" weight="29" height="33"> <a href="relatorios/pacientes.php?sql=<?php echo ajaxurlencode($sql)?>" target="_blank"><?php echo $LANG['patients']['print_report']?></a>
        <img src="imagens/icones/etiquetas.gif" border="0"> <a href="etiquetas/print_etiqueta.php?sql=<?php echo ajaxurlencode($sql)?><?php echo ($_GET['campo']=='nascimento' ? '&nasc=true' : '')?>" target="_blank"><?php echo $LANG['patients']['print_labels']?></a>
      </td>
    </tr>
  </table>
