<<<<<<< HEAD
<?php
//(GET) Se mostrará el listado de todos los empleados en formato JSON.

require_once "./clases/Usuario.php";

$arrayUsuarios= Usuario::TraerTodos();
$retorno="";
foreach($arrayUsuarios as $usuarix){
    $retorno.=$usuarix->ToJson()."<br>"; //llamo a tojson para que los formatee y los guardo en el retorno
}
echo $retorno;

=======
<?php
//(GET) Se mostrará el listado de todos los empleados en formato JSON.

require_once "./clases/Usuario.php";

$arrayUsuarios= Usuario::TraerTodos();
$retorno="";
foreach($arrayUsuarios as $usuarix){
    $retorno.=$usuarix->ToJson()."<br>"; //llamo a tojson para que los formatee y los guardo en el retorno
}
echo $retorno;

>>>>>>> 9e4f664727e3ad9ace1373f9fb9008d508c21fd3
?>