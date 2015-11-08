<?php
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(!checklog()) {
		die($frase_log);
	}
	if($_GET['parcela'] == '') {
        die();
	}
	$_GET['parcela'] = substr($_GET['parcela'], 0, 11);
	$query = mysql_query("SELECT * FROM v_orcamento WHERE codigo_parcela = ".$_GET['parcela']) or die('Line 42: '.mysql_error());
	$row = mysql_fetch_array($query);
?>
<script>
function atualiza_valor() {
    var dc = document.getElementById('dc');
    var dc_valor = document.getElementById('dc_valor');
    var valor_total = document.getElementById('valor_total');
    var valor = document.getElementById('valor');
    if(dc.value== '%2B') {
        valor.value = <?php echo $row['valor']?> %2B parseFloat(dc_valor.value);
    } else {
        valor.value = <?php echo $row['valor']?> - parseFloat(dc_valor.value);
    }
    valor_total.innerHTML = '<?php echo $LANG['general']['currency']?> '%2Bvalor.value;
}
</script>

<blockquote>
    <div>
        <?php echo $LANG['payment']['patient']?>:
        <?php echo $row['paciente']?>
    </div>
    <div>
        <?php echo $LANG['payment']['professional']?>:
        <?php echo $row['dentista']?>
    </div>
    <div>
        <?php echo $LANG['payment']['plot_value']?>:
        <?php echo $LANG['general']['currency'].' '.money_form($row['valor'])?>
    </div>
</blockquote>

<?php if($row['pago'] == 'Não') { ?>
<div>
    <div class="form-group form-inline">
        <div class="input-group">
            <span class="input-group-addon">R$</span>
            <input class="form-control" type="text" id="dc_valor" name="dc_valor" value="0" class="forms" size="8" onKeypress="return Ajusta_Valor(this, event);" onblur="if(this.value=='') { this.value='0' }; javascript:atualiza_valor()" />
        </div>

        <label class="checkbox"><input type="radio" id="dc_p" name="dcc" value="%2B" checked onclick="document.getElementById('dc').value=this.value; javascript:atualiza_valor();" /> <?php echo $LANG['payment']['increase']?></label>
        <label class="checkbox"><input type="radio" id="dc_m" name="dcc" value="-" onclick="document.getElementById('dc').value=this.value; javascript:atualiza_valor();" /> <?php echo $LANG['payment']['decrease']?></label>
        <input class="form-control" type="hidden" id="dc" name="dc" value="%2B" />
    </div>

    <p class="lead">
        <?php echo $LANG['payment']['total_to_pay']?>:
        <span id="valor_total" > <?php echo $LANG['general']['currency']?> <?php echo money_form($row['valor'])?> </span>
        <input type="hidden" name="valor" id="valor" value="<?php echo $row['valor']?>">
    </p>
</div>
    
<?php } ?>
 
<?php echo $LANG['payment']['date']?>: <?php echo converte_data($row['data'], 2)?>
  
<?php if($row['baixa'] == 'Sim') { ?>
    <div class="alert alert-danger"><?php echo $LANG['payment']['canceled_plot']?></div>
<?php } elseif($row['confirmado'] == 'Não') { ?>
    <div class="alert alert-danger"><?php echo $LANG['payment']['not_confirmed_budget']?></div>
<?php } ?>

 <div class="modal-footer">
     <div class="form-group inline-form">
     <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <input <?php echo (($row['pago'] == 'Sim' || $row['baixa'] == 'Sim' || $row['confirmado'] == 'Não')?'disabled':'')?> type="submit" 
               name="Salvar" value="<?php echo $LANG['payment']['confirm_payment']?>" class="btn btn-primary">
     </div>
</div>


<?php if($row['pago'] == 'Sim') { ?>
<a href="javascript:;" onclick="window.open('relatorios/recibo.php?codigo_parcela=<?php echo $_GET['parcela']?>', 'Recibo', 'height=350,width=320,status=yes,toolbar=no,menubar=no,location=no')"><?php echo $LANG['payment']['reprint_the_receipt']?></a>
<?php } ?>
