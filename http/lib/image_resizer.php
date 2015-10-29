<?php
// The file
$filename = $_GET['file'];
$size = $_GET['size'];

// Content type
header('Content-Type: image/jpeg');

// Get new dimensions
list($width, $height) = getimagesize($filename);

$srcx =0;
$srcy =0;
$srcw =$width;
$srch =$height;

if($width > $height){
    $srcx = ($width-$height)/2;
    $srcw = $srch;
}
if($width < $height){
    $srcy = ($height-$width)/2;
    $srch = $srcw;
}

// Resample
$image_p = imagecreatetruecolor($size, $size);
$image   = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, $srcx, $srcy, $size, $size, $srcw, $srch);

// Output
imagejpeg($image_p, null, 100);
?> 