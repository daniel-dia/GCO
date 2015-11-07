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
	if(!verifica_nivel('fornecedores', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `fornecedores` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
?>

<h1 class="page-header"> <?php echo $LANG['suppliers']['manage_suppliers']?></h1>



    <div class="form-inline">
    <div class="input-group">     
            <div class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></div>
  
             
      	      <select name="campo" id="campo" class="form-control">
      	        <option value="nomefantasia"><?php echo $LANG['suppliers']['name']?></option>
      	        <option value="cidade"><?php echo $LANG['suppliers']['city']?></option>
      	      </select>
            </div>
    <div  class="form-group">
      	      <input name="procurar" id="procurar" type="text" class="form-control" size="20" maxlength="40" onkeyup="javascript:Ajax('fornecedores/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&campo='%2BgetElementById('campo').options[getElementById('campo').selectedIndex].value)">
  </div>
    
    <div  class="form-group">
        <?php if(verifica_nivel('fornecedores', 'I')){ ?>
                    <a class="btn btn-default" href="javascript:Ajax('fornecedores/incluir', 'conteudo', '')">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
                    <?php echo $LANG['suppliers']['include_new_supplier']   ?>
                    </a>
        <?php }?>
        </div>

<div class="conteudo" id="table dados"><br>

  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('fornecedores/pesquisa', 'pesquisa', 'pesquisa=&campo=nomefantasia');
  </script>
</div>
