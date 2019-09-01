<?php

function ValidarPalabra($palabra, $max){
    $retorno = 0;
    if(strlen($palabra) > $max){
        echo $palabra, ": Largo de palabra excede el maximo! <br>";
    }else{
        if($palabra == "Programacion" || $palabra == "Parcial" || $palabra == "Recuperatorio"){
            $retorno = 1;
            echo $palabra, ": Palabra pertene al listado <br>";
        }else{
            echo $palabra, ": Palabra no pertene al listado :( <br>";
        }
    }
    return $retorno;
}

ValidarPalabra("Pantufla", 6);
ValidarPalabra("Holi", 6);
ValidarPalabra("Programacion", 15);

?>