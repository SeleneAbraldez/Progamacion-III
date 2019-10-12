<?php
// Se recibe por GET un JSON (con el legajo del ufólogo)
$jsonCookie = isset($_GET['jsonCookie']) ? $_GET['jsonCookie'] : NULL;
$retornoJson = new stdClass();
$jsonCookie = json_decode($jsonCookie);
$legajo = $jsonCookie->legajo;

//y se verificará si existe una cookie con el mismo nombre, 
// de ser así, retornará un JSON que contendrá: éxito(bool) y mensaje(string), dónde se mostrará el contenido de la cookie. 
if(isset($_COOKIE[$legajo])) {
    $retornoJson->exito = true;
    $retornoJson->mensaje = $_COOKIE[$legajo];
}else{  // Caso contrario, false y el mensaje indicando lo acontecido.
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No hay una cookie con el mismo legajo";
}
echo json_encode($retornoJson);

?>