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
		mysql_query("DELETE FROM `estoque` WHERE `codigo` = '".$_GET[codigo]."'") or die(mysql_error());
	}
	if(isset($_POST[Salvar])) {
		$obrigatorios[1] = 'descricao';
		$obrigatorios[] = 'valor';
		$i = $j = 0;
		foreach($_POST as $post => $valor) {
			$i++;
			if(array_search($post, $obrigatorios) && $valor == "") {
			    $j++;
				$r[$j] = '<font color="#FF0000">';
			}
		}
		if($j == 0) {
			$caixa = new TEstoque('clinica');
			$caixa->SetDados('descricao', $_POST[descricao]);
			$caixa->SetDados('quantidade', $_POST[quantidade]);
			$caixa->SalvarNovo();
			$caixa->Salvar();
		}
	}
?>
<h1 class="page-header"> <?php echo $LANG['stock']['clinic_stock_control']?> </h1>

      	      
<div class="input-group form-group">
    <div class="input-group-addon "><span class="glyphicon glyphicon-search"></span></div><input name="procurar" id="procurar" type="text" class="form-control" size="20" maxlength="40" onkeyup="javascript:Ajax('estoque/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value)">
</div>


<?php
	if(verifica_nivel('estoque', 'I')) {
?>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo $LANG['general']['add'] ?>
    </div>
  <div class="panel-body">
    <form id="form2" name="form2" method="POST" action="estoque/extrato_ajax.php" onsubmit="formSender(this, 'conteudo'); this.reset(); return false;">
        <div class="row">
            <div class="form-group col-sm-6">
                <label>
                    <?php echo $LANG['stock']['description']?>
                </label>
                <input type="text" size="80" name="descricao" id="descricao" class="form-control">
            </div>
            <div class="form-group col-sm-6">
                <label>
                    <?php echo $LANG['stock']['quantity']?>
                </label>
                <div class="input-group">
                    <input type="text" size="20" name="quantidade" id="quantidade" class="form-control">
                    <span class="input-group-btn">
                        <input type="submit" name="Salvar" class="btn btn-primary" id="Salvar" value="<?php echo $LANG['stock']['save']?>" class="forms"> &nbsp;&nbsp;
                    </span>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<?php
    }
?>
<div class="conteudo" id="table dados"><br>

  <div id="pesquisa"></div>
  <script>
  document.getElementById('procurar').focus();
  Ajax('estoque/pesquisa', 'pesquisa', 'pesquisa=');
  </script>
</div>
