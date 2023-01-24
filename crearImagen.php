<?php
header('Content-Type: image/png');

$txt =$_GET['text'];
$width =$_GET['width'];
$height =$_GET['height'];

$img= @imagecreate($width, $height);
$colorFondo = imagecolorallocate($img, 220, 109, 0);
$colorTexto = imagecolorallocate($img, 255, 255, 255);

imagestring($img, 10, 0, 0, $txt, $colorTexto);
imagepng($img);
imagedestroy($img);

?>
                        