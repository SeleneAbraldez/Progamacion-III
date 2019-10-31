<?php
function Escribir($ruta, $datos){
    if(fopen($ruta, "r") == NULL){ 
        echo "Archivo no existe, sera creado.";
    }
    $retorno = 0;
    $archivo = fopen($ruta, "w");
    $cant = fwrite($archivo, $datos);

    if($cant){
        //echo "Archivo creado exitosamente <3 <br>";
        $retorno = 1;
    }else {
        echo "Error en la creacion de archivo.";
    }
    fclose($archivo);
    return $retorno;
}

// $ruta = "saluto.txt";
// $datos = "Hola mundo!";
// Escribir($ruta, $datos);
?>