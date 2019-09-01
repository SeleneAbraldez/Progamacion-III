<?php 
$a = 1;
$b = 4;
$c = 3;
if($a > $b && $a < $c || $a < $b && $a > $c){
    echo "$a es la variable del medio";
}else if ($b > $a && $b < $c || $b < $a && $b > $c){
    echo $b, " es la variable del medio";
}else if($c > $b && $c < $a || $c < $b && $c > $a){
    echo "$c es la variable del medio";
}else{
    echo "No hay valor del medio.";
}
?>