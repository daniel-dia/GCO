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
    $nome_dentista = encontra_valor('dentistas', 'codigo', $_GET['codigo_dentista'], 'nome');
    $sexo_dentista = encontra_valor('dentistas', 'codigo', $_GET['codigo_dentista'], 'sexo');
?>
<font size="3"><?php echo $LANG['reports']['schedule_of'].' '.(($sexo_dentista == 'Masculino')?'<b>Dr.':'<b>Dra.').' '.$nome_dentista?></b> <?php echo $LANG['reports']['for_the_date']?> <b><?php echo converte_data($_GET['data'], 2).' ('.ucwords(nome_semana($_GET['data'])).')'?></font><br /><br />
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr style="font-size: 11px">
      <th width="8%" align="left" style="font-size: 11px">&nbsp;<?php echo $LANG['reports']['time']?></th>
      <th width="30%" align="left" style="font-size: 11px"><?php echo $LANG['reports']['patient']?></th>
      <th width="12%" align="left" style="font-size: 11px; border-right: 1px; border-right-color=: #000000; border-right-style: solid"><?php echo $LANG['reports']['procedure']?></th>
      <th width="8%" align="left" style="font-size: 11px; border-left: 1px; border-left-color=: #000000; border-left-style: solid">&nbsp;<?php echo $LANG['reports']['time']?></th>
      <th width="30%" align="left" style="font-size: 11px"><?php echo $LANG['reports']['patient']?></th>
      <th width="12%" align="left" style="font-size: 11px"><?php echo $LANG['reports']['procedure']?></th>
    </tr>
    <tr class="td_even">
<?php
	if(is_date($_GET['data']) && $_GET['codigo_dentista'] != "") {
        //$sql = "SELECT * FROM agenda_obs WHERE data = '" . $_GET['data'] . "' codigo_dentista = " . $_GET['codigo_dentista'];
        //$obs = mysql_fetch_assoc ( mysql_query ( $sql ) );
		$agenda = new TAgendas();
		for($i = 7; $i <= 22; $i++) {
			if(strlen($i) < 2) {
				$horas[] = "0".$i.":";
			} else {
				$horas[] = $i.":";
			}
		}
		$minutos = array('00', '15', '30', '45');
		foreach($horas as $hora) {
			foreach($minutos as $minuto) {
				$horario[] = $hora.$minuto;
			}
		}
		$j = 0;
		for($i = 0; $i < count($horario); $i++) {
			if($j % 2 == 0) {
				$td_class = 'td_even';
			} else {
				$td_class = 'td_odd';
			}
			if($i % 2 == 0) {
				if($i !== 0) {
					echo '</tr> <tr class="'.$td_class.'">';
				}
				$j++;
                $styles = 'style="border-right: 1px; border-right-color=: #CCCCCC; border-right-style: solid"';
			} else {
                $styles = '';
			}
			$agenda->LoadAgenda($_GET[data], $horario[$i], $_GET[codigo_dentista]);
			if(!$agenda->ExistHorario()) {
				$agenda->SalvarNovo();
			}
?>
      <td align="center" height="23">&nbsp;<?php echo $horario[$i]?></td>
      <td align="left"><?php echo $agenda->RetornaDados('descricao')?>&nbsp;</td>
      <td align="left" <?php echo $styles?>><?php echo $agenda->RetornaDados('procedimento')?>&nbsp;</td>
<?php
            $j++;
		}
	}
?>
  </tr>
</table>
<?php/*<div align="justify">
    <strong><?php echo $LANG['calendar']['comments_of_day']?></strong>:<br />
    <?php echo $obs['obs']?>
</div>*/?>
<script>
window.print();
</script>
<?php
    include "../timbre_foot.php";
?>
