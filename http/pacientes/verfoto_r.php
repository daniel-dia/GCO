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
	header("Content-type: image/jpeg", true);
	if(!checklog()) {
		die($frase_log);
	}
	$sql = "SELECT * FROM radiografias WHERE codigo = '".$_GET['codigo']."'";
	$query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    switch($_GET['tamanho']) {
        case '':
        case 'original': {
            echo $row['foto'];
        }; break;
        case 'thumb': {
            $fd = fopen('img_tmp.jpg', 'w+');
            fwrite($fd, $row['foto']);
            fclose($fd);
            $foto = imagecreatefromjpeg('img_tmp.jpg');
            unlink('img_tmp.jpg');
            if(imagesx($foto) > 222) {
                $ratio = imagesx($foto) / imagesy($foto);
                $siz_x = 222;
                $siz_y = $siz_x / $ratio;
            } else {
                $siz_x = imagesx($foto);
                $siz_y = imagesy($foto);
            }
            $imagem = imagecreatetruecolor($siz_x, $siz_y);
            $white = imagecolorallocate($imagem, 255, 255, 255);
            imagecopyresampled($imagem, $foto, 0, 0, 0, 0, $siz_x, $siz_y, imagesx($foto), imagesy($foto));
            imagejpeg($imagem, '', 100);
        }; break;
        case 'a4': {
            $fd = fopen('img_tmp.jpg', 'w+');
            fwrite($fd, $row['foto']);
            fclose($fd);
            $foto = imagecreatefromjpeg('img_tmp.jpg');
            unlink('img_tmp.jpg');
            if(imagesx($foto) > 650) {
                $ratio = imagesx($foto) / imagesy($foto);
                $siz_x = 650;
                $siz_y = $siz_x / $ratio;
            } else {
                $siz_x = imagesx($foto);
                $siz_y = imagesy($foto);
            }
            $imagem = imagecreatetruecolor($siz_x, $siz_y);
            $white = imagecolorallocate($imagem, 255, 255, 255);
            imagecopyresampled($imagem, $foto, 0, 0, 0, 0, $siz_x, $siz_y, imagesx($foto), imagesy($foto));
            imagejpeg($imagem, '', 100);
        }; break;
    }
?>
