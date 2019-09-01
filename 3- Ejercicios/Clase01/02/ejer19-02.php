<?php

require "Ejer19-02\Rectangulo.php";
require "Ejer19-02\Triangulo.php";

 $rectangulo = new Rectangulo(3,4);
 echo $rectangulo->ToString();
 echo "<br><br>";
 echo $rectangulo->Dibujar();

 echo "<br><br><br>";
 $triangulo = new Triangulo(3,3);
 echo $triangulo->ToString();
 echo "<br><br>";
 echo $triangulo->Dibujar();

?>