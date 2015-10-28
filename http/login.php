<!DOCTYPE html>
<?php
include "lib/config.inc.php";
include "lib/func.inc.php";
include "lib/classes.inc.php";
require_once 'lang/'.$idioma.'.php';
?>

<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GCO Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
 

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				
                 <div class="login-panel panel panel-default">
					
                    <div class="panel-heading" style="text-align:center">
						<img src="imagens/Tooth.png" />
                        <h3 class="panel-title"><?php echo $LANG['wallpaper']['access_login']?></h3>
                    </div>
                     
                    <div class="panel-body">
				
                        <form id="form2" role="form"  name="form2" method="POST" action="login.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?php echo $LANG['wallpaper']['login']?>" name="usuario" id="usuario"  autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?php echo $LANG['wallpaper']['password']?>" name="senha" id="senha" type="password" value="">
                                </div>
                               <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                 Change this to a button or input when using this as a form -->
                                <input name="login" class="btn btn-lg btn-primary btn-block" type="submit" class="forms" id="login" value="<?php echo $LANG['wallpaper']['btn_login']?>" />
                            </fieldset>
                        </form>
                    </div>
                </div>

                
                
                <?php
                    if(checklog()) {
                        $handle = opendir('imagens/wallpapers');
                        while ($file = readdir($handle)) {
                            if(strpos($file, ".") !== 0 && $file != 'Thumbs.db') {
                                $papel[] = $file;
                            }
                        }
                        closedir($handle);
                        $rand = rand(0, (count($papel) - 1));
                        $prim_nome = explode(' ', $_SESSION[nome_user]);
                        $prim_nome = $prim_nome[0].' '.$prim_nome[count($prim_nome)-1];
                        $titulo = $_SESSION[titulo];
                        if($_SESSION[nome_user] == 'Administrador') {
                            $titulo = '';
                            $prim_nome = 'Administrador(a)';
                        }
                ?>

                <script>document.getElementById('saudacao').innerHTML='<?php
                    if(date('H') >= 0 && date('H') < 12) {
                        echo $LANG['func']['good_morning'];
                    } elseif(date('H') >= 12 && date('H') < 18) {
                        echo $LANG['func']['good_afternoon'];
                    } elseif(date('H') >= 18 && date('H') <= 23) {
                        echo $LANG['func']['good_night'];
                    }
                    echo ', '.$titulo.' '.$prim_nome;
                    ?>'</script>

                    <?php
                        } elseif(!isset($_POST[login])) {
                    ?>
                    <?php
                        
	} else {
		$nivel = 'Funcionario';
		$row = mysql_fetch_array(mysql_query("SELECT * FROM `funcionarios` WHERE `usuario` = '$_POST[usuario]'"));
		if($row[nome] == "") {
			$nivel = 'Dentista';
			$row = mysql_fetch_array(mysql_query("SELECT * FROM `dentistas` WHERE `usuario` = '$_POST[usuario]'"));
			if($row[nome] == "") {
				//echo "<scr"."ipt>alert('Login ou senha incorretos!'); Ajax('wallpapers/index', 'conteudo', '')</scr"."ipt>";
			} 
		} elseif($row[usuario] == 'admin') {
			$nivel = 'Administrador';
		}
		switch($nivel) {
			case 'Administrador': {
				$usuario = new TFuncionarios();
				$usuario->LoadFuncionario($row[codigo]);
				$dados = $usuario->RetornaTodosDados();
				$senha = $usuario->RetornaDados('senha');
				$ativo = $usuario->RetornaDados('ativo');
			}
			break;
			case 'Funcionario': {
				$usuario = new TFuncionarios();
				$usuario->LoadFuncionario($row[codigo]);
				$dados = $usuario->RetornaTodosDados();
				$senha = $usuario->RetornaDados('senha');
				$ativo = $usuario->RetornaDados('ativo');
			}
			break;
			case 'Dentista': {
				$usuario = new TDentistas();
				$usuario->LoadDentista($row[codigo]);
				$dados = $usuario->RetornaTodosDados();
				$senha = $usuario->RetornaDados('senha');
				$ativo = $usuario->RetornaDados('ativo');
			}
		}
		if($senha != md5($_POST[senha])) {
			echo '<div class="alert alert-danger" role="alert">'.$LANG['wallpaper']['invalid_login']."</div>";
		} elseif($ativo == 'Não') { 			
			echo '<div class="alert alert-danger" role="alert">'.$LANG['wallpaper']['login_inactive']."</div>";
		} else {
			foreach($dados as $chave => $valor) {
				$_SESSION[$chave] = $valor;
			}
                $_SESSION[nivel] = $nivel;
                $_SESSION[nome_user] = $dados[nome];
                $redirect = "index.php";
                header("location:$redirect");
            die();
		}
	}
?>

           
            </div>
        </div>
    </div>
</body>

</html>