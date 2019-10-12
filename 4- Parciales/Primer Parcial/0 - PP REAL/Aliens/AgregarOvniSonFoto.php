<?php
require_once "./clases/Ovni.php";

//Se recibe por POST un JSON (con el tipo, la velocidad y el planetaOrigen).
$jsonAgregar = isset($_POST['jsonAgregar']) ? $_POST['jsonAgregar'] : NULL;
$jsonAgregar = json_decode($jsonAgregar);
$tipo = $jsonAgregar->tipo;
$velocidad = $jsonAgregar->velocidad;
$planeta = $jsonAgregar->planeta;

$ovni = new Ovni($tipo, $velocidad, $planeta);
// Se invocará al método Agregar.
$retornoJson= new stdClass();
// Se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
if($ovni->Agregar()){
    $retornoJson->exito = true;
    $retornoJson->mensaje = "Se pudo agregar el ovni";
}else{
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo agregar ovni";
}
echo json_encode($retornoJson);
?>