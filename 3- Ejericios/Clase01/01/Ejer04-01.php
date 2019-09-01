<?php 
$a = 0;
$i = 0;
echo "Numeros sumados: ";
while ($a <= 1000) {
    $a += $i;
    $i++;
    if($i == 1){
        echo $i;
    }else{
        echo " + ", $i;
    }    
}
echo " =<br>Llegamos a ->",  $a;
?>
