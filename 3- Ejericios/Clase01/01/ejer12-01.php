<?php

$lapicera1 = array('color'=>"negro" ,'marca'=>"bic" ,'trazo'=>"0.5" , 'precio'=>70 );
$lapicera2 = array('color'=>"violeta" ,'marca'=>"pelican" ,'trazo'=>"0.7" , 'precio'=>60 );
$lapicera3 = array('color'=>"blanco" ,'marca'=>"frambula" ,'trazo'=>"1" , 'precio'=>40 );

echo "<b>Muestro lapicera #1 con foreach: <br></b>";
foreach ($lapicera1 as $v) {
    echo "&emsp;", $v, "<br>";
}

echo "<br><b>Muestro solo el COLOR de lapicera #2: </b>";
echo "<br>&emsp;" . $lapicera2["color"] ."<br>"; 

echo "<br><b>Muestro lapicera #3 con var_dump:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 
//var_dump muestra toda la info de \$lapicera3 de una forma detallada, aclarando el tipo y a que espacio pertenece <br>&emsp;";
var_dump(($lapicera3));
?>