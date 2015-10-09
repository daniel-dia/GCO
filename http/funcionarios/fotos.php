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
	header("Content-type: text/html; charset=ISO-8859-1", true);
	$caminho = "fotos/".$_GET[codigo].".jpg";
	if($_GET[confirm_del] == "delete\')") {
        $sql = "UPDATE `funcionarios` SET `foto` = '' WHERE `codigo` = '".$_GET['codigo']."'";
        mysql_query($sql) or die(mysql_error());
	}
	if(isset($_POST[send])) {
		if($_FILES['foto']['name'] != "" && ($_FILES['foto']['type'] == 'image/gif' || $_FILES['foto']['type'] == 'image/pjpeg' || $_FILES['foto']['type'] == 'image/jpeg' || $_FILES['foto']['type'] == 'image/png')) {
            //$caminho = $_FILES['foto']['name'];
			//move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);
			$foto = imagecreatefromall($_FILES['foto']['tmp_name'], $_FILES['foto']['name']);
			$siz_x = 106;
			$siz_y = 140;
			$imagem = imagecreatetruecolor($siz_x, $siz_y);
			$white = imagecolorallocate($imagem, 255, 255, 255);
			imagecopyresized($imagem, $foto, 0, 0, 0, 0, $siz_x, $siz_y, imagesx($foto), imagesy($foto));
            imagejpeg($imagem, 'teste.jpg');
            $img_data = addslashes(file_get_contents('teste.jpg'));
            $sql = "UPDATE `funcionarios` SET `foto` = '".$img_data."' WHERE `codigo` = '".$_GET['codigo']."'";
            unlink('teste.jpg');
            mysql_query($sql) or die(mysql_error());
		}
	}
	$disable = '';
	$href = 'href=';
	$onclick = 'onclick=';
	if(checknivel('Dentista') || checknivel('Funcionario') || $_GET['disabled'] == 'yes') {
		$disable = 'disabled';
		$href = '';
		$onclick = '';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerenciador Clínico Odontológico Smile Odonto - Administração Odontológica Em Suas Mãos</title>
<link href="../css/smile.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../lib/script.js.php"></script>
</head>
<body style="background-color: #F0F0F0"><center>
<?php
    $sql = "SELECT `foto` FROM `funcionarios` WHERE `codigo` = '".$_GET['codigo']."'";
    $query = mysql_query($sql) or die('Erro: '. mysql_error());
    $row = mysql_fetch_array($query);
	if($row['foto'] != '') {
		echo '<img src="verfoto_p.php?codigo='.$_GET['codigo'].'" border="0">';
	}  else {
		echo '<img src="verfoto_p.php?codigo='.$_GET['codigo'].'&padrao=no_photo" border="0">';
	}
?><br><br>
<form action="fotos.php?codigo=<?php echo $_GET[codigo]?>" method="POST" enctype="multipart/form-data" target="_self">
<input type="file" <?php echo $disable?> name="foto" size="5" class="forms"><br>
<input type="submit" <?php echo $disable?> class="forms" value="<?php echo $LANG['employee']['send']?>" name="send">
</form>
<br>
<a <?php echo $href?>"fotos.php?codigo=<?php echo $_GET[codigo]?>" <?php echo $onclick?>"return confirmLink(this)"><?php echo $LANG['employee']['delete_photo']?></a>
</center>
</body>
</html>
