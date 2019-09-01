<?php

function InvertirPalabra($palabra){
    for ($i= strlen($palabra)-1; $i >= 0 ; $i--) { 
        echo $palabra[$i];
    }
}

InvertirPalabra("Pantufla");

?>