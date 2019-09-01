<?php

$array = array();
$i = 0;
$j = 0;

while (count($array)<10) {
    if($i%2!==0){
        array_push($array, $i);
    }
    $i++;
}

//mostrar
echo "For: "; 
for ($i=0; $i < 10 ; $i++) { 
    echo $array[$i], " ";
}

echo " <br>While: "; 
while ($j < 10) {
    echo $array[$j], " ";
    $j++;
}

echo " <br>Foreach: "; 
foreach ($array as $k) {
    echo $k, " ";
}

?>