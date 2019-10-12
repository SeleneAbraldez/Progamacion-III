<?php 

require_once "./clases/Ovni.php";

// ModificarOvni.php: Se recibirán por POST todos los valores (incluida una imagen) para modificar un ovni en la
// base de datos. 
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$velocidad = isset($_POST['velocidad']) ? $_POST['velocidad'] : NULL;
$planeta = isset($_POST['planeta']) ? $_POST['planeta'] : NULL;
$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

$id = isset($_POST['id']) ? $_POST['id'] :NULL;

$extension = pathinfo($foto, PATHINFO_EXTENSION);
$nombreNuevaFoto = $tipo . "." . $planeta . "." . date("Gis") . "." . $extension; 
$destino = "./ovnis/imagenes/" . $nombreNuevaFoto;

$ovni=  new Ovni($tipo, $velocidad, $planeta, $nombreNuevaFoto);
$ovniAnterior = $ovni->TraerId($id);
var_dump($ovniAnterior);
$retornoJson = new stdClass();

//Invocar al método Modificar.
if($ovni->Modificar($id, $ovni))
{
    // Si se pudo modificar en la base de datos, la foto modificada se moverá al subdirectorio “./ovnisModificados/”,
    // con el nombre formado por el tipo punto planetaOrigen punto 'modificado' punto hora, minutos y segundos de
    // la modificación (Ejemplo: panal.kripton.modificado.105905.jpg). Redirigir hacia Listado.php.
    if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)){  //si se pudo guardar la nueva
        $ext = pathinfo($ovniAnterior->pathFoto, PATHINFO_EXTENSION);   //conseguimos la extension de la vieja
        $imagenModificadaVieja = $ovniAnterior->tipo . "." . $ovniAnterior->planetaOrigen . "." . "modificada" . "." . date('Gis') . "." . $ext; //Modificamos el nombre de la vieja
        echo copy("./ovnis/imagenes/" . $ovniAnterior->pathFoto, "./ovnisModificados/" . $imagenModificadaVieja); //copiamos la foto del directorio viejo al nuevo con el nombre ya modificado 
        echo unlink("./ovnis/imagenes/" . $ovniAnterior->pathFoto);    //eliminar foto vieja
        $retornoJson->mensaje = "Se pudo modidicar el ovni y la foto";
    }else{
        $retornoJson->mensaje = "Se pudo modidicar el ovni y pero no la foto";
    }
    //Redirigir hacia Listado.php.
    header("location:Listado.php");
    $retornoJson->exito = true;
}else{//Si no se pudo modificar, se mostrará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.     
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo modificar el ovni";
}
echo json_encode($retornoJson);

?>

