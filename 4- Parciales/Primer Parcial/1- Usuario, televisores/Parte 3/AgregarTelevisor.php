<?php
require_once "./clases/Televisor.php";

//Se recibirán por POST todos los valores (incluida una imagen) para registrar un televisor en la base de datos.

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

$extension = pathinfo($foto, PATHINFO_EXTENSION);
//con el nombre formado por el tipo punto paisOrigen punto hora, minutos y segundos del alta (Ejemplo: led.china.105905.jpg).
$nombreFoto= $televisor->tipo . "." . $televisor->paisOrigen. "." . date("Gis") . "." . $extension;
// La imagen guardarla en “./televisores/imagenes/”, 
$destino = "./televisores/imagenes/" . $nombreFoto;

$televisor = new Televisor($tipo, $precio, $pais, $nombreFoto);
$retornoJson= new stdClass();

if($televisor->Agregar())
{
    $retornoJson->exito = true;
    $retornoJson->mensaje = "Se pudo agregar el televisor";
    if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino))
    {
        $retornoJson->mensaje .= " y subir la foto";
        // Si se pudo agregar se redirigirá hacia Listado
        header('Location:Listado.php');
    }else{
        $retornoJson->mensaje .= " pero no se pudo subir la foto";
    }
}else{
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo agregar el televisor";
}
echo json_encode($retornoJson);
?>