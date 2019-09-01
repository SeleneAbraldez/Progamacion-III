<?php

$animales = array('Perro', 'Gato', 'Ratón', 'Araña', 'Mosca');
$numeros = array();
$lenguajes = array('php', 'mysql', 'html5', 'typescript', 'ajax');

echo "<b>Muestro animales (hardcodeado) con foreach: <br></b>";
foreach ($animales as $v) {
    echo "&emsp;", $v, "<br>";
}

array_push($numeros, '1986', '1996', '2015', '78', '86');
echo "<br><b>Muestro numeros (array_push) con foreach: <br></b>";
foreach ($numeros as $v) {
    echo "&emsp;", $v, "<br>";
}


$resultado = array_merge($animales, $numeros, $lenguajes);
echo "<br><b>Muestro MERGE con foreach: <br></b>";
foreach ($resultado as $v) {
    echo "&emsp;", $v, "<br>";
}

?>