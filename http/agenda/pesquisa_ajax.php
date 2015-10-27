<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) { die($frase_log); }
?>

<script>
  function muda_valor(input) {
    if(input.value == 'Sim') input.value = 'Não';else input.value = 'Sim';
  }
</script>

<div>
    
<?php
	if(!is_date(converte_data($_GET[pesquisa], 1)) || $_GET[codigo_dentista] == "") die();

    $agenda = new TAgendas();

    // Define as horas mostradas na agenda
    $horas = [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22];
    $minutos = array('00', '15', '30', '45');
    foreach($horas as $hora) foreach($minutos as $minuto) $horario[] = $hora.":".$minuto;

    // verifica os horários de atendimento do dentisa neste dia da semana
    $weekday = date( 'w' , converte_data ( converte_data($_GET['pesquisa'] , 1) , 3));
    $sql = "SELECT * FROM dentista_atendimento WHERE codigo_dentista = " . $_GET['codigo_dentista'] . " AND dia_semana = " . $weekday;
    $atend = mysql_fetch_assoc ( mysql_query ( $sql ) );

    // imprime os dias da agenda
    for($i = 0; $i < count($horario); $i++) {

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

        <div class="agendarow col-xs-12 col-sm-6">
            <div class="col-xs-2">
                <label><?php echo $horario[$i]?></label>
            </div>
            <div class="col-xs-6">
                <input type="text" size="30" maxlength="90" name="descricao" onkeyup="searchSuggest(this, 'codigo_pac<?php echo $i?>', 'search<?php echo $i?>');" id="descricao<?php echo $i?>" value="<?php echo $agenda->RetornaDados('descricao')?>" <?php echo $disable?> onblur="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?php echo $agenda->RetornaDados('data')?>&hora=<?php echo $agenda->RetornaDados('hora')?>:00&descricao='%2Bthis.value%2B'&codigo_dentista=<?php echo $agenda->RetornaDados('codigo_dentista')?>&codigo_paciente='%2Bdocument.getElementById('codigo_pac<?php echo $i?>').value);" onfocus="esconde_itens('searches')" onkeypress="document.getElementById('codigo_pac<?php echo $i?>').value=''" class="form-control" autocomplete="off"> 
                <input type="hidden" id="codigo_pac<?php echo $i?>" value="<?php echo $agenda->RetornaDados('codigo_paciente')?>">
                <div id='search<?php echo $i?>' style="position: absolute"></div>
            </div>
            <div class="col-xs-3">
                <input type="text" size="13" maxlength="15" name="procedimento" id="procedimento" value="<?php echo $agenda->RetornaDados('procedimento')?>" <?php echo $disable?> onblur="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?php echo $agenda->RetornaDados('data')?>&hora=<?php echo $agenda->RetornaDados('hora')?>:00&procedimento='%2Bthis.value%2B'&codigo_dentista=<?php echo $agenda->RetornaDados('codigo_dentista')?>')" class="form-control" onfocus="esconde_itens('searches')">
            </div>
            <div class="col-xs-1">
                <input style="margin:10px!important;" type="checkbox" name="faltou" id="faltou" value="<?php echo $val_chk?>" <?php echo $disable.' '.$chk?> onclick="Ajax('agenda/atualiza', 'agenda_atualiza', 'data=<?php echo $agenda->RetornaDados('data')?>&hora=<?php echo $agenda->RetornaDados('hora')?>:00&faltou='%2Bthis.value%2B'&codigo_dentista=<?php echo $agenda->RetornaDados('codigo_dentista')?>'); muda_valor(this);" onfocus="esconde_itens('searches')"  >
            </div>
        </div>

        <?php
    }

    // ?
    $sql = "SELECT `data`, `obs` FROM agenda_obs WHERE data = '".converte_data($_GET['pesquisa'], 1)."' AND codigo_dentista = '".$_GET['codigo_dentista']."'";
    $query = mysql_query($sql) or die('Line 128: '.mysql_error());
    $row = mysql_fetch_array($query);

    // ?
    if($row['data'] == '') {
        mysql_query("INSERT INTO agenda_obs (data, codigo_dentista) VALUES ('".converte_data($_GET['pesquisa'], 1)."', '".$_GET['codigo_dentista']."')") or die('Line 116: '.mysql_error());
        $sql = "SELECT data, obs FROM agenda_obs WHERE data = ".converte_data($_GET['pesquisa'], 1);
        $query = mysql_query($sql) or die('Line 118: '.mysql_error());
        $row = mysql_fetch_array($query);
    }
?>
	 

    </div>
    <div class="clearfix" id="agendacomprida">
        <div class="col-sm-1 col-xs-2">
            <div></div>
            <div></div>
        </div>
    </div>

     <div class="clearfix" >
            <label><?php echo $LANG['calendar']['comments_of_day']?></label>
            <textarea class="form-control" name="observacoes" rows="6" style="overflow:hidden" <?php echo $disable_obs?> onblur='Ajax("agenda/atualizaobs", "agenda_atualiza", "data=<?php echo converte_data($_GET['pesquisa'], 1)?>&codigo_dentista=<?php echo $_GET['codigo_dentista']?>&obs="%2Bthis.value.replace(/\n/g, "<br>"))'>
                <?php echo ereg_replace('<br>', "\n", $row['obs'])?>
            </textarea>

     </div>
     <div>

            <a href="relatorios/agenda_consultas.php?data=<?php echo converte_data($_GET[pesquisa], 1)?>&codigo_dentista=<?php echo $_GET[codigo_dentista]?>" target="_blank">
                <img src="imagens/icones/imprimir.png" />
                <?php echo $LANG['calendar']['print_calendar']?>
            </a>
    </div>
<div id="agenda_atualiza"></div>