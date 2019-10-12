<?php
require_once "./clases/Ovni.php";

// Si recibe un id por GET, retorna si el ovni está en la base o no (mostrar mensaje).
$idGet = isset($_GET['id']) ? $_GET['id'] : NULL;
if(isset($_GET['id'])){
  $ovniTraer = new Ovni();
  $ovnis = $ovniTraer->Traer();
  $retorno = "No se encuetra en la base.";
  foreach ($ovnis as $ov) {
     if($ov->id == $idGet){
          $retorno = "Se encuentra en la base!";
          break;
     }
  }
  echo $retorno;
}

$retornoJson= new stdClass();
// Si recibe el id por POST, con el parámetro “accion” igual a "borrar", se deberá borrar el ovni 
$idPost = isset($_POST['id']) ? $_POST['id'] : NULL;
$accionPost= isset($_POST['accion']) ? $_POST['accion'] : NULL;
//(invocando al método Eliminar). Si se pudo borrar en la base de datos invocar al método GuardarEnArchivo y redirigir hacia
// Listado.php.
if($accionPost=="borrar"){
  $ovniEliminar = new Ovni();
  if($ovniEliminar->Eliminar($idPost))
  {
    header("location:Listado.php");
  }
  else
  {     // Si no se pudo borrar, mostrar un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo borrar el televisor";
  }
  echo json_encode($retornoJson);
}


// Si recibe por GET (sin parámetros), se mostrarán en una tabla (HTML) la información de todos los ovnis borrados
// y su respectiva imagen.

?>