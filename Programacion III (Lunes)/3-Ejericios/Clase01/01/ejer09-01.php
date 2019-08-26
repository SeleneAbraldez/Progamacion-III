<?php

$array;
$suma = 0;
$promedio;

echo "Numeros: ";
for ($i=0; $i < 5 ; $i++) { 
    $array[$i] = rand(1, 10);
    echo $array[$i], " ";
}

for ($i=0; $i < 5 ; $i++) { 
    $suma += $array[$i];
}
echo " <br> Suma: ", $suma;

$promedio = ($suma/5);
echo " <br>"  ;
if($promedio == 6){
    echo "Promedio: Igual a 6";
}else if($promedio < 6){
    echo "Promedio: ", $promedio, " menor a 6";
}else{
    echo "Promedio: ", $promedio, " mayor a 6";
}

?>