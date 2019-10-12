<?php
//(GET) Se mostrará el listado de todos los ufólogos en formato de array de JSON.

require_once "./clases/Ufologo.php";

$arrayUfolos= Ufologo::TraerTodos();
$retorno="";
foreach($arrayUfolos as $ufologox){
    $retorno.=$ufologox->ToJson()."<br>"; //llamo a tojson para que los formatee y los guardo en el retorno
}
echo $retorno;

?>