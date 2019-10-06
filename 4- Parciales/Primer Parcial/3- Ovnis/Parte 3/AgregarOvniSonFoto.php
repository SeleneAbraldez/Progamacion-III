<?php
require_once "./clases/Ovni.php";

// Se recibe por POST el tipo, la velocidad y el planetaOrigen.
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$velocidad = isset($_POST['velocidad']) ? $_POST['velocidad'] : NULL;
$planeta = isset($_POST['planeta']) ? $_POST['planeta'] : NULL;

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