<?php

function Leer($ruta){
    $retorno = 0;
    $archivo = fopen($ruta, "r");
    $datos = fread($archivo, filesize("saluto.txt"));

    echo $datos. "<br>";

    if($datos){
        echo "Archivo leido exitosamente <3 <br>";
        $retorno = 1;
    }else {
        echo "Error en la lectura de archivo.";
    }
    fclose($archivo);
    return $retorno;
}

// $ruta = "saluto.txt";
// Leer($ruta);

?>