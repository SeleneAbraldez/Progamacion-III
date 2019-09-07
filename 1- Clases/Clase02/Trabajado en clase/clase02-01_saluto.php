<?php
require_once "Archivos/Escribir.php";
require_once "Archivos/Leer.php";
$ruta = "saluto.txt";
$datos = "Hola mundo!";
Escribir($ruta, $datos);
Leer($ruta);
?>