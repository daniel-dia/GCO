<?php
 	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: image/jpeg", true);

    $size = $_GET['size'];

	if(!checklog()) {
		die($frase_log);
	}
	$sql = "SELECT * FROM `fotospacientes` WHERE (legenda = 'Fotografia Sorriso' or legenda = 'Fotografia Frontal' or legenda = 'Fotografia Perfil') and `codigo_paciente` = '".$_GET['codigo']."'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
    $blob = $row['foto'];

    if( $row['foto'] == '') {
       $foto = "../imagens/noPhoto.png";
       header("location:$foto");
        die();
       //&blob =  ibase_blob_import($foto);
       //die();
	}

    if($size){
        $image = imagecreatefromstring($blob);

        $srcx =0;
        $srcy =0;
        $srcw =imagesx($image);
        $srch =imagesy($image);

        if($srcw > $srch){
            $srcx = ($srcw-$srch)/2;
            $srcw = $srch;
        }
        if($srcw < $srch){
            $srcy = ($srch-$srcw)/2;
            $srch = $srcw;
        }

        // Resample
        $image_p = imagecreatetruecolor($size, $size);
        imagecopyresampled($image_p, $image, 0, 0, $srcx, $srcy, $size, $size, $srcw, $srch);

        // Output
        imagejpeg($image_p, null, 100);
        
        die();
    }

	echo $blob ;
?>
