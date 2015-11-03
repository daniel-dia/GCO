<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('pagamentos', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if(isset($_POST['Salvar'])) {
        $row = mysql_fetch_array(mysql_query("SELECT * FROM v_orcamento WHERE pago = 'Não' AND codigo_parcela = ".$_POST['parcela']));
        mysql_query("UPDATE parcelas_orcamento SET pago = 'Sim', datapgto = '".date('Y-m-d')."', valor = '".$_POST['valor']."' WHERE codigo = ".$_POST['parcela']);
        mysql_query("INSERT INTO caixa (data, dc, valor, descricao) VALUES ('".date('Y-m-d')."', '+', '".$_POST['valor']."', 'Pagamento da parcela ".$row['codigo_parcela']." - Paciente: ".$row['paciente']." - Dentista: ".$row['dentista']."')");
        echo '<script>if(confirm("'.$LANG['payment']['payment_successfully_done'].'\n\n'.$LANG['payment']['patient'].': '.$row['paciente'].'\n\n'.$LANG['payment']['professional'].': '.(($row['sexo_dentista'] == 'Masculino')?'Dr. ':'Dra. ').$row['dentista'].'\n\n'.$LANG['payment']['total_to_pay'].': '.$LANG['general']['currency'].' '.money_form($_POST['valor']).'\n\n'.$LANG['payment']['deadline'].': '.converte_data($row['data'], 2).'\n\n'.$LANG['payment']['payment_date'].': '.date('d/m/Y').'\n\n'.$LANG['payment']['do_you_wish_to_print_the_receipt'].'")) { window.open("relatorios/recibo.php?codigo_parcela='.$_POST['parcela'].'", "'.$LANG['payment']['receipt'].'",  "height=350,width=320,status=yes,toolbar=no,menubar=no,location=no") }</script>';
	}
?>


    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $LANG['payment']['plot_information']?></h4>
        <!--<h4><?php echo $LANG['payment']['payment']?></h4>-->
    </div>
    <div class="modal-body" id="modalbody">

        <div class="form-group">
        <form id="form2" name="form2" method="POST" action="pagamentos/parcelas_ajax.php" onsubmit="formSender(this, 'conteudo'); return false;">

        <div class="alert alert-warning"> <?php echo $LANG['payment']['pass_the_optic_reader_or']?> <?php echo $LANG['payment']['type_the_bar_code']?></div>
        <input autocomplete="off" name="parcela" value="<?php echo $_GET['codigo']?>" <?php echo $disable?> type="text" class="form-control input-lg" id="parcela" size="50" maxlength="11" onkeypress="return Bloqueia_Caracteres(event);" onkeyup="javascript:Ajax('pagamentos/dadosparcela', 'pagamento', 'parcela='%2Bthis.value)" />
        </form>
        </div>

    <div id="pagamento"></div>

    </div>

<script>
document.getElementById('parcela').focus();
Ajax('pagamentos/dadosparcela', 'pagamento', 'parcela=<?php echo $_GET['codigo']?>');
</script>
