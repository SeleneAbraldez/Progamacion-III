<?php
require "Ejer02-21/Auto.php";

$auto1 = new Auto("Fiat", "Violeta");
$auto2=new Auto("Fiat", "Verde");

$auto3 = new Auto("Pancho", "Negro", 700000);
$auto4= new auto("Pancho", "Negro", 9000);

$auto5 = new Auto("Mai", "Gris", 30000, "28/01/2017");

$auto5::AgregarImpuestros(1500);

$importe= Auto::Add($auto1, $auto2);    //va a dar error porque son distintos
echo "<br>Importe sumado Auto1 y Auto2: ". $importe;

echo "<br><br>Comparo Auto1 con Auto2: " .(int) $auto1->Equals($auto1,$auto2);
echo "<br>Comparo Auto1 con Auto5: " .(int) $auto1->Equals($auto1,$auto5);

echo "<br><br><br><b>Muestro Auto1:</b>";
Auto::MostrarAuto($auto1);
echo "<br><b>Muestro Auto3:</b>";
Auto::MostrarAuto($auto3);
echo "<br><b>Muestro Auto5:</b>";
Auto::MostrarAuto($auto5);
?>