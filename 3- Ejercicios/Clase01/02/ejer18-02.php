<?php

function EsPar($numero){
    $retorno = FALSE;
    if($numero%2==0){
        $retorno = TRUE;
    }
    return $retorno;
}

function EsImpar($numero){
    return !(EsPar($numero));
}
/* //rapido para probar
if(EsPar(4)){
    echo "es par";
}else{
    echo "es impar";
}
if(EsPar(7)){
    echo "es par";
}else{
    echo "es impar";
}
if(EsImpar(4)){
    echo "es impar";
}else{
    echo "es par";
}
*/

?>