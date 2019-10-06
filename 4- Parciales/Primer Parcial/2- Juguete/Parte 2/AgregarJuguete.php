<?php
require_once "./clases/Juguete.php";

// AgregarJuguete.php: Se recibirán por POST todos los valores (incluida una imagen) 
//para registrar un juguete en la base de datos.
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

$juguete = new Juguete($tipo, $precio, $pais, $foto);

// Verificar la previa existencia del juguete invocando al método Verificar. Se le pasará como parámetro el
//array que retorna el método Traer.
if($juguete->Verificar($juguete->Traer())){
    // Si el juguete no existe, se invocará al método Agregar. 
    //La imagen guardarla en “./juguetes/imagenes/”, con el nombre formado por el tipo punto 
    //paisOrigen punto hora minutos y segundos del borrado (Ejemplo: auto.china.105905.jpg).
    $extension = pathinfo($foto, PATHINFO_EXTENSION);
    $nombreFoto = $juguete->GetTipo() . "." . $juguete->GetPais() . "." . date("Gis") . "." . $extension;
    $destino = "juguetes/imagenes/" . $nombreFoto;

    $jugueteAgregar = new Juguete($tipo, $precio, $pais, $nombreFoto);
    if($jugueteAgregar->Agregar()){
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)){
            // Si se pudo agregar se redirigirá hacia Listado.php. Caso contrario, se mostrará un mensaje de error.
            header('Location:Listado.php'); 
        }
        else{
            echo "No se pudo guardar la foto";
        }
    }else{
        echo "no se pudo agregar en la base de datos";
    }
}else{   // Si el juguete ya existe en la base de datos, se retornará un mensaje por pantalla que indica lo acontecido.
    echo "El juguete ya existe en la base de datos";
}

?>