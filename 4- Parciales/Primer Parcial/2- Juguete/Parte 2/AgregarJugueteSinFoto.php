<?php
require_once "./clases/Juguete.php";

//Se recibe por POST el tipo, el precio y el paisOrigen. 
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;

$juguete = new Juguete($tipo, $precio, $pais);

//Se invocará al método Agregar.
// Si retorna true, se debe de escribir en un archivo de texto la fecha (con horas y minutos) más
//la información del juguete (guardarlo en ./archivos/juguetes_sin_foto.txt).
//Mostrar por pantalla un mensaje de éxito.
// Si retorna false, se mostrará por pantalla la información del juguete.
if($juguete->Agregar())
{
    $ar = fopen("./archivos/juguetes_sin_foto.txt", "a");
    if($ar != false){
        $fecha = date("d/n/Y - G:i:s");

        $escrito = fwrite($ar, $juguete->ToString() . "-" . $fecha . "\r\n");

        if($escrito>0){ 
            $retorno =true;
            echo "Informacion guardada con exito";
        }
        fclose($ar);
    }
}else{
    echo "No se ha podido agregar el juguete: " . $juguete->ToString();
}

?>