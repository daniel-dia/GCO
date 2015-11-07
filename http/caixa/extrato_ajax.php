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
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `caixa` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>
<h1 class="page-header">
    <?php echo $LANG['cash_flow']['clinic_cash_flow']?>
</h1>

<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?php
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central" >
    
    <div class="form-group">
      <input type="hidden" name="peri" id="peri" value="">
      <div class="input-group">
            
              <div class="input-group-addon radio"><label for="pesqdia"><input type="radio" name="pesq" id="pesqdia" value="dia" onclick="document.getElementById('peri').value='dia'"><?php echo $LANG['cash_flow']['day_month_year']?></label></div>
              <div class="input-group-addon radio"><label for="pesqmes"><input type="radio" name="pesq" id="pesqmes" value="mes" onclick="document.getElementById('peri').value='mes'"><?php echo $LANG['cash_flow']['month_year']?></label></div>
              <div class="input-group-addon radio"><label for="pesqano"> <input type="radio" name="pesq" id="pesqano" value="ano" onclick="document.getElementById('peri').value='ano'"><?php echo $LANG['cash_flow']['year']?></label></div>
              <input name="procurar" id="procurar" type="text" class="form-control" size="20" maxlength="40" 
                     onkeyup="javascript:Ajax('caixa/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&peri='%2Bdocument.getElementById('peri').value)" onKeypress="return Ajusta_DMA(this, event, document.getElementById('peri').value);"
                     onclick="if(document.getElementById('pesqdia').checked) {abreCalendario(this);}">
          <div class="input-group-addon radio"><label for="pesqmesatual"><input type="radio" name="pesq" id="pesqmesatual" value="mesatual" onclick="javascript:Ajax('caixa/pesquisa', 'pesquisa', 'peri=mesatual')"><?php echo $LANG['cash_flow']['current_month']?></label></div>
        	
                <span class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
</div>

</div>

<?php if(verifica_nivel('caixa', 'I')) { ?>
    
    <div class="panel panel-primary">
    <div class="panel-heading"><?php echo $LANG['general']['add'] ?></div>
  <div class="panel-body">
      
    <form id="form2" name="form2" method="POST" action="caixa/inicial_ajax.php" onsubmit="formSender(this, 'pesquisa'); this.reset(); return false;">
    <div class="row">
    <div class="form-group col-sm-2">
        <label>
            <?php echo $LANG['cash_flow']['date']?>
        </label>
        <input type="text" size="13" value="<?php echo converte_data(hoje(), 2)?>" name="data" id="data" class="form-control" onKeypress="return Ajusta_Data(this, event);">
    </div>
    <div class="form-group col-sm-5">
        <label>
            <?php echo $LANG['cash_flow']['description']?>
        </label>
        <input type="text" size="77" name="descricao" id="descricao" class="form-control">
    </div>
    <div class="form-group col-sm-2">
        <label>
            <?php echo $LANG['cash_flow']['d_c']?>
        </label>
        <select name="dc" class="form-control" id="dc">
            <?php
	$estados = array('%2B', '-');
	foreach($estados as $uf) {
		if($row[sexo] == $uf) {
			echo '<option value="'.$uf.'" selected>'.$uf.'</option>';
		} else {
			echo '<option value="'.$uf.'">'.$uf.'</option>';
		}
	}
?>
        </select>
    </div>
    <div class="form-group col-sm-3">
            <label><?php echo $LANG['cash_flow']['value']?></label>
        <div class="input-group">
            <input type="text" size="12" name="valor" id="valor" class="form-control" onKeypress="return Ajusta_Valor(this, event);">
              <span class="input-group-btn">

            <input type="submit" name="Salvar" class="btn btn-primary" id="Salvar" value="<?php echo $LANG['cash_flow']['save']?>" class="forms">
            </span>
        </div>
    </div>
    

</div>
      </form></div>
        </div>
<?php } ?>
    
<div class="conteudo" id="table dados"><br>
  
  <div id="pesquisa"></div>
  <script>
  Ajax('caixa/inicial', 'pesquisa', 'pesquisa=');
  </script>
</div>
