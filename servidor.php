<?php
if(isset($_POST)){
  $url = $_POST['url'];
  //return $clave;
  echo $url;
  $url = rtrim($url, '/');
  $url = explode('/',$url);
  var_dump($url);
  echo "matricula: " . $url[3];
}
else{
  echo "error";
}
 ?>
