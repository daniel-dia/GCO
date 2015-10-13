<?php
   /**
    * Gerenciador Clínico Odontológico
    * Copyright (C) 2006 - 2009
    * Autores: Ivis Silva Andrade - Engenharia e Design(ivis@expandweb.com)
    *          Pedro Henrique Braga Moreira - Engenharia e Programação(ikkinet@gmail.com)
    *
    * Este arquivo é parte do programa Gerenciador Clínico Odontológico
    *
    * Gerenciador Clínico Odontológico é um software livre; você pode
    * redistribuí-lo e/ou modificá-lo dentro dos termos da Licença
    * Pública Geral GNU como publicada pela Fundação do Software Livre
    * (FSF); na versão 2 da Licença invariavelmente.
    *
    * Este programa é distribuído na esperança que possa ser útil,
    * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÂO
    * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
    * Licença Pública Geral GNU para maiores detalhes.
    *
    * Você recebeu uma cópia da Licença Pública Geral GNU,
    * que está localizada na raíz do programa no arquivo COPYING ou COPYING.TXT
    * junto com este programa. Se não, visite o endereço para maiores informações:
    * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html (Inglês)
    * http://www.magnux.org/doc/GPL-pt_BR.txt (Português - Brasil)
    *
    * Em caso de dúvidas quanto ao software ou quanto à licença, visite o
    * endereço eletrônico ou envie-nos um e-mail:
    *
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endereço:
    *
    * Smile Odontolóogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=UTF-8", true);
	if(checklog()) {
		$handle = opendir('../imagens/wallpapers');
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
<center><img src="imagens/wallpapers/<?php echo $papel[$rand]?>" border="0" width="753" height="230"></center>
<script>document.getElementById('saudacao').innerHTML='<font size=\"1\"><?php
  	if(date('H') >= 0 && date('H') < 12) {
  		echo $LANG['func']['good_morning'];
  	} elseif(date('H') >= 12 && date('H') < 18) {
  		echo $LANG['func']['good_afternoon'];
  	} elseif(date('H') >= 18 && date('H') <= 23) {
  		echo $LANG['func']['good_night'];
  	}
    echo ', '.$titulo.' '.$prim_nome;
?>&nbsp;&nbsp;'</script>
<?php
	} elseif(!isset($_POST[login])) {
?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="56%">&nbsp;&nbsp;&nbsp;<img src="wallpapers/img/login.png"> <span class="h3"><?php echo $LANG['wallpaper']['access_system']?></span></td>
      <td width="6%" valign="bottom"><a href="#"></a></td>
      <td width="36%" valign="bottom" align="right">&nbsp;</td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td width="243" height="23"><?php echo $LANG['wallpaper']['access_login']?></td>
      <td width="381">&nbsp;</td>
    </tr>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
    <tr>
      <td>
      <form id="form2" name="form2" method="POST" action="wallpapers/index_ajax.php<?php echo $frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;">
        <fieldset>
        <legend><span class="style1"><?php echo $LANG['wallpaper']['personal_access_information']?></span></legend>
        <table width="287" border="0" align="center" cellpadding="0" cellspacing="0" class="texto">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $LANG['wallpaper']['login']?>:<br />
              <input name="usuario" value="" type="text" class="forms" id="usuario" maxlength="11" />
              <br />
              <br /></td>
          </tr>
          <tr>
            <td><?php echo $LANG['wallpaper']['password']?>:<br />
              <input name="senha" value="" type="password" class="forms" id="senha" maxlength="32" />
              <br />
              <br /></td>
          </tr>
          <script>
            document.getElementById('usuario').focus();
          </script>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        <div align="center"><br>
          <input name="login" type="submit" class="forms" id="login" value="<?php echo $LANG['wallpaper']['btn_login']?>" />
        </div>
      </form>
      </td>
    </tr>
  </table>

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
			echo "<scr"."ipt>alert('".$LANG['wallpaper']['invalid_login']."'); Ajax('wallpapers/index', 'conteudo', '')</scr"."ipt>";
		} elseif($ativo == 'Não') { 			
			echo "<scr"."ipt>alert('".$LANG['wallpaper']['login_inactive']."'); Ajax('wallpapers/index', 'conteudo', '')</scr"."ipt>";
		} else {
			foreach($dados as $chave => $valor) {
				$_SESSION[$chave] = $valor;
			}
			$_SESSION[nivel] = $nivel;
			$_SESSION[nome_user] = $dados[nome];
			echo "<script>Ajax('wallpapers/index', 'conteudo', '');</script>";
		}
	}
?>
