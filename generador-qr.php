<?php
 include ('phpqrcode/qrlib.php');

$dir = 'temp/';

if(!file_exists($dir))
  mkdir($dir);
  $filename =  $dir.'test.png';

//generamos el QR
$tamaño = 10; //el tamaño de la img
$level = 'M'; // tipo de presicion L, M, Q, H
$frameSize = 3; // marco que va tener el qr en blanco
$contenido = 'Hola mundo';

QRcode::png($contenido, $filename,$level,$tamaño,$frameSize);

echo '<img src="'.$filename.'"/>';
?>
