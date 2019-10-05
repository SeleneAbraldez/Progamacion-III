<?php
require_once "./clases/Televisor.php";

//ModificarTelevisor.php: Se recibirán por POST todos los valores (incluida una imagen) para 
//modificar un televisor en la base de datos. 
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

$id = isset($_POST['id']) ? $_POST['id'] :NULL;

$retornoJson = new stdClass();
$televisor= new Televisor($tipo, $precio, $pais, $foto);
//Invocar al método Modificar.
if($televisor->Modificar($id, $televisor))
{
    //Redirigir hacia Listado.php.
    header("location:Listado.php");
    $retornoJson->exito = true;
    $retornoJson->mensaje = "Se pudo modidicar el televisor";
}else{//Si no se pudo modificar, se mostrará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.     
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo modificar el televisor";
}
echo json_encode($retornoJson);

?>