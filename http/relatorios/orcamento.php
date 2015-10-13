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
	include "../timbre_head.php";
	$query_orcamento = mysql_query("SELECT * FROM orcamento WHERE codigo = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    $row_orcamento = mysql_fetch_assoc($query_orcamento);
    $query_paciente = mysql_query("SELECT * FROM pacientes WHERE codigo = ".$row_orcamento['codigo_paciente']) or die('Line 41: '.mysql_error());
    $row_paciente = mysql_fetch_assoc($query_paciente);
    $query_dentista = mysql_query("SELECT * FROM dentistas WHERE codigo = ".$row_orcamento['codigo_dentista']) or die('Line 43: '.mysql_error());
    $row_dentista = mysql_fetch_assoc($query_dentista);
?>
<font size="3"><?php echo $LANG['reports']['budget_to']?>: <b><?php echo $row_paciente['nome'].' ['.$row_paciente['codigo'].']'?></b><br /></font><font style="font-size: 3px;">&nbsp;<br /></font>
<font size="2"><?php echo $LANG['reports']['treatment_with']?> <b><?php echo (($row_dentista['sexo'] == 'Masculino')?'Dr.':'Dra.').' '.$row_dentista['nome']?></b></font><br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <th width="11%"><?php echo $LANG['reports']['code']?></th>
        <th width="11%"><?php echo $LANG['reports']['tooth']?></th>
        <th width="45%"><?php echo $LANG['reports']['procedure']?></th>
        <th width="16%" colspan="2"><?php echo $LANG['reports']['private_value']?></th>
        <th width="15%"><?php echo $LANG['reports']['plan_value']?></th>
      </tr>
<?php
    $i = 0;
    $total_particular = $total_convenio = 0;
    $query_procedimentos = mysql_query("SELECT * FROM procedimentos_orcamento WHERE codigo_orcamento = ".$_GET['codigo']) or die('Line 61: '.mysql_error());
    while($row_procedimentos = mysql_fetch_assoc($query_procedimentos)) {
        if($i % 2 === 0) {
            $td_class = 'td_even';
        } else {
            $td_class = 'td_odd';
        }
?>
      <tr class="<?php echo $td_class?>" style="font-size: 12px">
        <td><?php echo $row_procedimentos['codigoprocedimento']?></td>
        <td><?php echo $row_procedimentos['dente']?></td>
        <td><?php echo $row_procedimentos['descricao']?></td>
        <td align="right"><?php echo money_form($row_procedimentos['particular'])?></td>
        <td width="2%">&nbsp;</td>
        <td align="right"><?php echo money_form($row_procedimentos['convenio'])?></td>
      </tr>
<?php
        $total_particular += $row_procedimentos['particular'];
        $total_convenio += $row_procedimentos['convenio'];
        $i++;
    }
?>
      <tr style="font-size: 12px">
        <td colspan="3" align="center"><b><?php echo $LANG['reports']['total']?>:</b></td>
        <td align="right"><b><?php echo $LANG['general']['currency'].' '.money_form($total_particular)?></b></td>
        <td>&nbsp;</td>
        <td align="right"><b><?php echo $LANG['general']['currency'].' '.money_form($total_convenio)?></b></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><br /><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <th width="33%" align="center"><?php echo $LANG['reports']['charge']?></th>
        <th width="33%" align="center"><?php echo $LANG['reports']['total_value']?></th>
        <th width="33%" align="center"><?php echo $LANG['reports']['payment_method']?></th>
      </tr>
      <tr style="font-size: 12px" height="20" class="td_even">
        <td align="center"><?php echo $row_orcamento['aserpago']?></td>
        <td align="center"><?php echo $LANG['general']['currency'].''.money_form($row_orcamento['valortotal'])?></td>
        <td align="center"><?php echo $row_orcamento['formapagamento']?></td>
      </tr>
      <tr style="font-size: 12px" height="20" class="td_odd">
        <td align="center"><?php echo $LANG['reports']['number_of_plots']?>: <?php echo $row_orcamento['parcelas']?></td>
        <td align="center"><?php echo $LANG['reports']['first_plot']?>: <?php echo (($row_orcamento['entrada_tipo'] == '%')?$row_orcamento['entrada'].'%':$LANG['general']['currency'].' '.$row_orcamento['entrada'])?></td>
        <td align="center"><?php echo $LANG['reports']['discount']?>: <?php echo $row_orcamento['desconto']?>%</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><br /><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <th align="center"><?php echo $LANG['reports']['plots']?></th>
        <th align="center"><?php echo $LANG['reports']['date']?></th>
        <th align="center"><?php echo $LANG['reports']['status']?></th>
        <th align="center"><?php echo $LANG['reports']['vlaue']?></th>
      </tr>
<?php
    $i = $total = 0;
    $query_parcelas = mysql_query("SELECT tor.baixa, tpo.* FROM parcelas_orcamento tpo INNER JOIN orcamento tor ON tpo.codigo_orcamento = tor.codigo WHERE codigo_orcamento = ".$_GET['codigo']." ORDER BY codigo LIMIT ".$row_orcamento['parcelas']) or die('Line 119: '.mysql_error());
    while($row_parcelas = mysql_fetch_assoc($query_parcelas)) {
        if($i % 2 === 0) {
            $td_class = 'td_even';
        } else {
            $td_class = 'td_odd';
        }
        $total += $row_parcelas['valor'];

?>
      <tr style="font-size: 12px" class="<?php echo $td_class?>">
        <td align="center"><?php echo $LANG['reports']['plot'].' '.($i+1)?> (<?php echo $LANG['reports']['bill_number'].' '.$row_parcelas['codigo']?>)</td>
        <td align="center"><?php echo converte_data($row_parcelas['datavencimento'], 2)?></td>
        <td align="center"><?php echo (($row_parcelas['baixa'] == 'Não')?(($row_parcelas['pago'] == 'Sim')?$LANG['reports']['paid']:$LANG['reports']['open']).((($row_parcelas['datavencimento'] < date('Y-m-d')) && ($row_parcelas['pago'] != 'Sim'))?' ('.$LANG['reports']['overdue'].')</a>':'</a>').(($row_parcelas['pago'] == 'Sim')?' ('.converte_data($row_parcelas['datapgto'], 2).')':''):(($row_parcelas['pago'] == 'Sim')?$LANG['reports']['paid'].' ('.converte_data($row_parcelas['datapgto'], 2).')':$LANG['reports']['canceled']))?></td>
        <td align="right"><?php echo $LANG['general']['currency'].' '.money_form($row_parcelas['valor'])?></td>
      </tr>
<?php
        $i++;
    }
?>
      <tr>
        <td colspan="3" align="center"><b><?php echo $LANG['reports']['total']?>:</b></td>
        <td align="right"><b><?php echo $LANG['reports']['currency'].' '.money_form($total)?></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php
    include "../timbre_foot.php";
?>
<script>
window.print();
</script>
