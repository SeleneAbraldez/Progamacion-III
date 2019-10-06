<?php
require_once "./clases/Televisor.php";

//ModificarTelevisor.php: Se recibirán por POST todos los valores (incluida una imagen) para 
//modificar un televisor en la base de datos. 
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

$id = isset($_POST['id']) ? $_POST['id'] :NULL;

$extension = pathinfo($foto, PATHINFO_EXTENSION);
$nombreNuevaFoto = $tipo . "." . $pais . "." . date("Gis") . "." . $extension; 
$destino = "./televisores/imagenes/" . $nombreNuevaFoto;

$retornoJson = new stdClass();
$televisor= new Televisor($tipo, $precio, $pais, $nombreNuevaFoto);
$televisorAnterior = $televisor->TraerId($id);
//Invocar al método Modificar.
if($televisor->Modificar($id, $televisor))
{
    if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)){  //si se pudo guardar la nueva
        echo unlink("./televisores/imagenes/" . $televisorAnterior->path);    //eliminar foto vieja
        $retornoJson->mensaje = "Se pudo modidicar el televisor y la foto";
    }else{
        $retornoJson->mensaje = "Se pudo modidicar el televisor y pero no la foto";
    }
    //Redirigir hacia Listado.php.
    header("location:Listado.php");
    $retornoJson->exito = true;
}else{//Si no se pudo modificar, se mostrará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.     
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo modificar el televisor";
}
echo json_encode($retornoJson);

?>