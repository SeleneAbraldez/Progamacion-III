<?php
require_once "./clases/Juguete.php";

// ModificarJuguete.php: Se recibirán por POST todos los valores (incluida una imagen) para modificar un juguete
// en la base de datos. Invocar al método Modificar.
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : NULL;

$id = isset($_POST['id']) ? $_POST['id'] :NULL;

// Si se pudo modificar en la base de datos, la foto modificada se moverá al subdirectorio “./juguetesModificados/”,
// con el nombre formado por el tipo punto paisOrigen punto 'modificado' punto hora minutos y segundos de la
// modificación (Ejemplo: bolita.taiwan.modificado.105905.jpg). Redirigir hacia Listado.php.
$extension = pathinfo($foto,PATHINFO_EXTENSION);
$nombreNuevaFoto = $tipo . "." . $pais . "." . date("Gis") . "." . $extension; 
$destino = "./juguetes/imagenes/" . $nombreNuevaFoto;    //segun lo que entiendo del enunciado se giuarda la foto nueva en imagenes, y la vieja la movves con el nombre cambiado

$juguete= new Juguete($tipo, $precio, $pais, $nombreNuevaFoto);
$jugueteAnterior = $juguete->TraerId($id);  //traemos el juguete anterior para tener regritro del path a borrar

if($juguete->Modificar($id, $juguete)){
    if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)){  //si se pudo guardar la nueva
        $ext = pathinfo($jugueteAnterior->GetPath(), PATHINFO_EXTENSION);   //conseguimos la extension de la vieja
        $imagenModificadaVieja = $jugueteAnterior->GetTipo() . "." . $jugueteAnterior->GetPais() . "." . "modificada" . "." . date('Gis') . "." . $ext; //Modificamos el nombre de la vieja
        echo copy("./juguetes/imagenes/" . $jugueteAnterior->GetPath(), "./juguetesModificados/" . $imagenModificadaVieja); //copiamos la foto del directorio viejo al nuevo con el nombre ya modificado 
        echo unlink("./juguetes/imagenes/" . $jugueteAnterior->GetPath());    //eliminar foto vieja
        echo "Juguete modificado";
    }
    header('Location:Listado.php');
}else{  // Si no se pudo modificar, se mostrará un mensaje por pantalla.
    echo "No se pudo modificar el juguete";
}

?>

