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
	if(!verifica_nivel('agenda', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
?>
<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?php
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central">
  
   


    <div  class="col-sm-8">
        <label><?php echo $LANG['calendar']['manage_calendar']?></span></label>
      <select name="codigo_dentista" class="form-control" id="codigo_dentista" onchange="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2BgetElementById('procurar').value%2B'&codigo_dentista='%2Bthis.options[this.selectedIndex].value)">
      <option></option>
      <?php
		$dentista = new TDentistas();
		$lista = $dentista->ListDentistas("SELECT * FROM `dentistas` WHERE `ativo` = 'Sim' ORDER BY `nome` ASC");
		for($i = 0; $i < count($lista); $i++) {
			if($_SESSION[cpf] == $lista[$i][cpf]) {
				echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
			} else {
				echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
			}
		}
        ?>     
		</select>
</div>
<div class="col-sm-4 input-group date"  id="datetimepicker12">
        
        <label><?php echo $LANG['calendar']['date']?> </label>
        <input name="procurar" id="procurar" value="<?php echo converte_data(hoje(), 2)?>" 
               
               type="text" class="form-control" size="20" maxlength="40"
               change="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&codigo_dentista='%2BgetElementById('codigo_dentista').options[getElementById('codigo_dentista').selectedIndex].value)"
               aonfocus="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&codigo_dentista='%2BgetElementById('codigo_dentista').options[getElementById('codigo_dentista').selectedIndex].value)"
               aonKeypress="return Ajusta_Data(this, event);"
               aonclick="abreCalendario(this)">
    
    <div style="overflow:hidden;">
    <div class="form-group">
     
            <div>
                <div></div>
            </div>
        
    </div>
    <script type="text/javascript">
        $(function () {
            $('#procurar').datetimepicker({ 
                sideBySide: false,
                locale: 'pt-br',
                viewMode: 'days', 
                format: 'DD/MM/YYYY',
            });
        });
    </script>
</div>
      
</div>
<br><br>
<div class="conteudo" id="table dados"><br>
    
    <div class="agendarow col-xs-12 col-sm-6">
        <div class="col-xs-2">
           <?php echo $LANG['calendar']['time']?>
        </div>
        <div class="col-xs-6">
            <?php echo $LANG['calendar']['patient']?>
        </div>
        <div class="col-xs-3"  style="text-overflow:ellipsis; overflow:hidden;">
            <?php echo $LANG['calendar']['procedure']?>
        </div>
        <div class="col-xs-1">
           <?php echo $LANG['calendar']['missed']?>
        </div>
    </div>
    
    <div class="agendarow col-xs-12 col-sm-6">
        <div class="col-xs-2">
           <?php echo $LANG['calendar']['time']?>
        </div>
        <div class="col-xs-6">
            <?php echo $LANG['calendar']['patient']?>
        </div>
        <div class="col-xs-3" style="text-overflow:ellipsis;overflow:hidden;">
            <?php echo $LANG['calendar']['procedure']?>
        </div>
        <div class="col-xs-1" >
           <?php echo $LANG['calendar']['missed']?>
        </div>
    </div>
   
  <div id="pesquisa"></div>
  <script>
  	function atualizaData() {
  		Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa=<?php echo converte_data(hoje(), 2)?>&codigo_dentista=<?php echo $_SESSION[codigo]?>');
  	}
<?php
  	if($_SESSION[nivel] == 'Dentista') {
  		echo 'atualizaData();';
  	}
?>
  </script>
</div>
