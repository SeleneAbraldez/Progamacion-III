<?php
require_once "./clases/Ovni.php";

// Se recibirán por POST todos los valores (incluida una imagen) para registrar un ovni en la base
// de datos.
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$velocidad = isset($_POST['velocidad']) ? $_POST['velocidad'] : NULL;
$planeta = isset($_POST['planeta']) ? $_POST['planeta'] : NULL;

$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

// Verificar la previa existencia del ovni invocando al método Existe. Se le pasará como parámetro el array que
// retorna el método Traer.
$ovni = new Ovni($tipo, $velocidad, $planeta, $foto);
$arrayOvnis= $ovni->Traer();

if($ovni->Existe($arrayOvnis)){ // Si el ovni ya existe en la base de datos, se retornará un mensaje que indique lo acontecido.
    echo "El ovni ya existe en la base de datos";
}else{  // Si el ovni no existe, se invocará al método Agregar.
    // La imagen guardarla en “./ovnis/imagenes/”, con el nombre
    // formado por el tipo punto planetaOrigen punto hora, minutos y segundos del alta (Ejemplo:
    // pleyadiano.leyades.105905.jpg).
    $extension = pathinfo($foto, PATHINFO_EXTENSION);
    $nombreFoto=$tipo . "." . $planeta . "." . date("Gis") . "." . $extension;
    $destino = "./ovnis/imagenes/" . $nombreFoto;

    $ovniFinal = new Ovni($tipo, $velocidad, $planeta, $nombreFoto);

    $retornoJson= new stdClass();
    if($ovniFinal->Agregar()){     
        $retornoJson->exito = true;
        $retornoJson->mensaje = "Se pudo agregar el televisor";   
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)){
            // Si se pudo agregar se redirigirá hacia Listado.php. 
            $retornoJson->mensaje .= " y pudo subir la foto";
            header('Location:Listado.php');     
        }else{
            //Caso contrario, se mostrará un JSON que contendrá: éxito(bool)
            // y mensaje(string) indicando lo acontecido.
            $retornoJson->mensaje .= " pero no se pudo subir la foto";
        }
        
    }else{
        $retornoJson->exito = false;
        $retornoJson->mensaje = "No se pudo agregar el televisor";
    }
    echo json_encode($retornoJson);
}

?>