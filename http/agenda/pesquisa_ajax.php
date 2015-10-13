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
?>
<script>
  function muda_valor(input) {
    if(input.value == 'Sim') {
      input.value = 'Não';
    } else {
      input.value = 'Sim';
    }
  }
</script>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F0F0F0" onmouseout="style.background='#F0F0F0'" onmouseover="style.background='#DDE1E6'">
<?php
	if(is_date(converte_data($_GET[pesquisa], 1)) && $_GET[codigo_dentista] != "") {
		$agenda = new TAgendas();
		$par = "F0F0F0";
		$impar = "F8F8F8";
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

        $weekday = date( 'w' , converte_data ( converte_data($_GET['pesquisa'] , 1) , 3));
        $sql = "SELECT * FROM dentista_atendimento WHERE codigo_dentista = " . $_GET['codigo_dentista'] . " AND dia_semana = " . $weekday;
        $atend = mysql_fetch_assoc ( mysql_query ( $sql ) );

        $j = 0;
		for($i = 0; $i < count($horario); $i++) {
			if($j % 2 == 0) {
				$odev = $par;
			} else {
				$odev = $impar;
			}
			if($i % 2 == 0) {
				if($i !== 0) {
					echo '</tr> <tr bgcolor="#'.$odev.'" onmouseout="style.background=\'#'.$odev.'\'" onmouseover="style.background=\'#DDE1E6\'">';
				}
				$j++;
				$style = 'style="border-right: 1px; border-right-color=: #CCCCCC; border-right-style: solid"';
			} else {
				$style = '';
			}
			$agenda->LoadAgenda(converte_data($_GET[pesquisa], 1), $horario[$i], $_GET[codigo_dentista]);
			if(!$agenda->ExistHorario()) {
				$agenda->SalvarNovo();
			}
			if((converte_data($_GET[pesquisa], 1) < date(Y.'-'.m.'-'.d)) || ($_GET[codigo_dentista] != $_SESSION[codigo] && $_SESSION[nivel] == 'Dentista') || !verifica_nivel('agenda', 'E')) {
				$blur = 'onblur';
                $disable_obs = $disable = 'disabled';
			} else {
				$blur = '';
                $disable_obs = $disable = '';
			}
            if($agenda->RetornaDados('faltou') == 'Sim') {
                $chk = 'checked';
                $val_chk = 'Não';
            } else {
                $chk = '';
                $val_chk = 'Sim';
            }

            if ( $atend['ativo'] <= 0 ) {
                $disable_obs = $disable = 'disabled';
            } else {
                if ( $horario[$i].':00' < $atend['hora_inicio'] || $horario[$i].':00' > $atend['hora_fim'] ) {
                    $disable = 'disabled';
                    $disable_obs = '';
                }
            }

?>
      <td width="7%" align="center" height="23">&nbsp;<?php echo $horario[$i]?></td>
      <td width="24%" align="left">
        <input type="text" size="30" maxlength="90" name="descricao" onkeyup="searchSuggest(this, 'codigo_pac<?php echo $i?>', 'search<?php echo $i?>');" id="descricao<?php echo $i?>" value="<?php echo $agenda->RetornaDados('descricao')?>" <?php echo $disable?> onblur="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?php echo $agenda->RetornaDados('data')?>&hora=<?php echo $agenda->RetornaDados('hora')?>:00&descricao='%2Bthis.value%2B'&codigo_dentista=<?php echo $agenda->RetornaDados('codigo_dentista')?>&codigo_paciente='%2Bdocument.getElementById('codigo_pac<?php echo $i?>').value);"
        onfocus="esconde_itens('searches')" onkeypress="document.getElementById('codigo_pac<?php echo $i?>').value=''" class="forms" autocomplete="off"><BR>
        <input type="hidden" id="codigo_pac<?php echo $i?>" value="<?php echo $agenda->RetornaDados('codigo_paciente')?>">
        <div id='search<?php echo $i?>' style="position: absolute"></div>
      </td>
      <td width="13%" align="left"><input type="text" size="13" maxlength="15" name="procedimento" id="procedimento" value="<?php echo $agenda->RetornaDados('procedimento')?>" <?php echo $disable?> onblur="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?php echo $agenda->RetornaDados('data')?>&hora=<?php echo $agenda->RetornaDados('hora')?>:00&procedimento='%2Bthis.value%2B'&codigo_dentista=<?php echo $agenda->RetornaDados('codigo_dentista')?>')" class="forms" onfocus="esconde_itens('searches')"></td>
      <td width="6%" align="left" <?php echo $style?>><input type="checkbox" name="faltou" id="faltou" value="<?php echo $val_chk?>" <?php echo $disable.' '.$chk?> onclick="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?php echo $agenda->RetornaDados('data')?>&hora=<?php echo $agenda->RetornaDados('hora')?>:00&faltou='%2Bthis.value%2B'&codigo_dentista=<?php echo $agenda->RetornaDados('codigo_dentista')?>'); muda_valor(this);" onfocus="esconde_itens('searches')"></td>
<?php
		}
    $sql = "SELECT `data`, `obs` FROM agenda_obs WHERE data = '".converte_data($_GET['pesquisa'], 1)."' AND codigo_dentista = '".$_GET['codigo_dentista']."'";
    $query = mysql_query($sql) or die('Line 128: '.mysql_error());
    $row = mysql_fetch_array($query);
    if($row['data'] == '') {
        mysql_query("INSERT INTO agenda_obs (data, codigo_dentista) VALUES ('".converte_data($_GET['pesquisa'], 1)."', '".$_GET['codigo_dentista']."')") or die('Line 116: '.mysql_error());
        $sql = "SELECT data, obs FROM agenda_obs WHERE data = ".converte_data($_GET['pesquisa'], 1);
        $query = mysql_query($sql) or die('Line 118: '.mysql_error());
        $row = mysql_fetch_array($query);
    }
?>
	</tr>
  </table>
  <BR>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr style="background: #F8F8F8">
      <td align="center">
        <b><?php echo $LANG['calendar']['comments_of_day']?></b><BR>
        <textarea class="forms" name="observacoes" cols="100" rows="6" style="overflow:hidden" <?php echo $disable_obs?> onblur='Ajax("agenda/atualizaobs", "agenda_atualiza", "data=<?php echo converte_data($_GET['pesquisa'], 1)?>&codigo_dentista=<?php echo $_GET['codigo_dentista']?>&obs="%2Bthis.value.replace(/\n/g, "<br>"))'><?php echo ereg_replace('<br>', "\n", $row['obs'])?></textarea>
      </td>
    </tr>
  </table>
    <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr style="background: #F8F8F8">
      <td width="610" align="center"></td>
      <td width="140" align="right"><img src="imagens/icones/imprimir.gif" border=""> <a href="relatorios/agenda_consultas.php?data=<?php echo converte_data($_GET[pesquisa], 1)?>&codigo_dentista=<?php echo $_GET[codigo_dentista]?>" target="_blank"><?php echo $LANG['calendar']['print_calendar']?></a></td>
    </tr>
  </table>
  <div id="agenda_atualiza"></div>
<?php
	}
?>
