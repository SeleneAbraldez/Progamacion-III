<?php
require_once "./clases/Televisor.php";
// EliminarTelevisor.php: Si recibe un tipo por GET, retorna si el televisor está en la base o no (mostrar mensaje).
$tipoGet = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
if(isset($tipoGet)){
  $teleTraer = new Televisor();
  $televisores = $teleTraer->Traer();
  $retorno = "No se encuetra en la base.";
  foreach ($televisores as $tele) {
     if($tele->tipo == $tipoGet){
          $retorno = "Se encuentra en la base!";
          break;
     }
  }
  echo $retorno;
}

$retornoJson= new stdClass();
// Si recibe el tipo por POST, con el parámetro “accion” igual a "borrar", se deberá borrar el televisor 
$tipoPost = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$accionPost= isset($_POST['accion']) ? $_POST['accion'] : NULL;
//(invocando al método Eliminar). Si se pudo borrar en la base de datos redirigir hacia Listado.php.
if($accionPost=="borrar"){
  $teleEliminar = new Televisor();
  $telePath = $teleEliminar->TraerTipo($tipoPost);
  if($teleEliminar->Eliminar($tipoPost)){
    echo unlink("./televisores/imagenes/" . $telePath->path);
    $retornoJson->exito = true;
    $retornoJson->mensaje = "Se pudo borrar el televisor";
    //header("location:Listado.php");
  }else{     // Si no se pudo borrar, mostrar un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No se pudo borrar el televisor";
  }
  echo json_encode($retornoJson);
}

?>