<<<<<<< HEAD
<?php
require_once "./clases/Televisor.php";

//Se recibe por POST el tipo, el precio y el paisOrigen. 
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;

$televisor = new Televisor($tipo, $precio, $pais);

$retornoJson= new stdClass();
//Se invocará al método Agregar.
//Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
if($televisor->Agregar())
{
    $retornoJson->exito = true;
    $retornoJson->mensaje = "Se pudo agregar el televisor";
}else{
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo agregar el televisor";
}
echo json_encode($retornoJson);
=======
<?php
require_once "./clases/Televisor.php";

//Se recibe por POST el tipo, el precio y el paisOrigen. 
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;

$televisor = new Televisor($tipo, $precio, $pais);

$retornoJson= new stdClass();
//Se invocará al método Agregar.
//Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
if($televisor->Agregar())
{
    $retornoJson->exito = true;
    $retornoJson->mensaje = "Se pudo agregar el televisor";
}else{
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo agregar el televisor";
}
echo json_encode($retornoJson);
>>>>>>> 9e4f664727e3ad9ace1373f9fb9008d508c21fd3
?>