<?php
echo "Get: <br>";
var_dump($_GET);
echo "<br>Post: <br>";
var_dump($_POST);
echo "<br> Request <br>";
var_dump($_REQUEST);
echo "<br><br>";

$nombre = $_REQUEST["nombretxt"];
$apellido = $_REQUEST["apellidotxt"];

$archivo = fopen("datos.txt", "a");
$cant = fwrite($archivo, ($nombre. " ". $apellido. ","));
if($cant){
    echo "<br>Archivo de datis creado exitosamente <3 <br>";
}else {
    echo "Error en la creacion de archivo.";
}
fclose($archivo);
?>