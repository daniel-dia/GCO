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
	if(!verifica_nivel('profissionais', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `dentistas` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
		@unlink('fotos/'.$_GET[cpf].'.jpg');
	}
?>
<script>
function esconde(campo) {
    if(campo.selectedIndex == 2) {
        document.getElementById('procurar').style.display = 'none';
        document.getElementById('procurar1').style.display = '';
        document.getElementById('id_procurar').value = 'procurar1';
    } else {
        document.getElementById('procurar').style.display = '';
        document.getElementById('procurar1').style.display = 'none';
        document.getElementById('id_procurar').value = 'procurar';
    }
}
</script>
<h1 class="page-header"> 
     <?php echo $LANG['professionals']['manage_professionals']?>
</h1>

<div id="conteudo_central">
    <div  class="form-inline">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></div>
            
                <select name="campo" id="campo" class="form-control" onchange="esconde(this)">
                    <option value="nome"><?php echo $LANG['professionals']['name']?></option>
                    <option value="cpf"><?php echo $LANG['professionals']['document1']?></option>
                    <option value="nascimento"><?php echo $LANG['patients']['birthdays_in_month']?></option>
                </select>
            </div>
        <input name="procurar" id="procurar" type="text" class="form-control" size="20" maxlength="40" onkeyup="javascript:Ajax('dentistas/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
        <input type="hidden" id="id_procurar" value="procurar" class="form-control">
        <select name="procurar1" id="procurar1" style="display:none" class=" col-sm-4 form-control" onchange="javascript:Ajax('dentistas/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.options[this.selectedIndex].value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
            <option value=""></option>
            <?php
                for($i = 1; $i <= 12; $i++) {
                    echo '                <option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.nome_mes($i).'</option>';
                }
            ?>
        </select>

        <?php if(verifica_nivel('profissionais', 'I')){ ?>
            <a href="javascript:Ajax('dentistas/incluir', 'conteudo', '')" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <?php echo $LANG['professionals']['include_new_professional'] ?>
            </a>
            <?php } ?>
    </div>
</div>


    <br>
  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('dentistas/pesquisa', 'pesquisa', 'pesquisa=');
  </script>

