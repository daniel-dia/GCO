<?php
   	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	
	if(!checklog()) {
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
	if(!verifica_nivel('contatos', 'L')) {
        echo $LANG['general']['you_tried_to_access_a_restricted_area'];
        die();
    }
	if($_GET[confirm_del] == "delete") {
		mysql_query("DELETE FROM `telefones` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
    ?>
    <div>
  
        <h1 class="page-header"> 
            <?php echo $LANG['useful_telephones']['useful_telephones']?>
        </h1>

        
        <div class="form-inline">
       
            <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></div>
            <input id="procurar" type="text" class="form-control" placeholder="<?php echo $LANG['useful_telephones']['search_for']?>" onkeyup="javascript:Ajax('telefones/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value)">
            </div>
          
            <?php if (verifica_nivel('contatos', 'I')) { ?>
             <a href="javascript:Ajax('telefones/incluir', 'conteudo', '')">
            <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $LANG['useful_telephones']['include_new_contact']; ?>
            </button>
                 </a>
            <?php }?>
           
        </div> 
     
    <div class="conteudo" id="table dados"><br>
      <div id="pesquisa"></div>
      <script>
      document.getElementById('procurar').focus();
      Ajax('telefones/pesquisa', 'pesquisa', 'pesquisa=');
      </script>
    </div>
