<?php
// Se recibe por GET el email del usuario 
$email = isset($_GET['email']) ? $_GET['email'] : NULL;
$cookieMail = str_replace(".", "_", $email);
$retornoJson = new stdClass();

//y se verificará si existe una cookie con el mismo nombre, 
// de ser así, retornará un JSON que contendrá: éxito(bool) y mensaje(string), dónde se mostrará el contenido de la cookie. 
if(isset($_COOKIE[$cookieMail])) {
    $retornoJson->exito = true;
    $retornoJson->mensaje = $_COOKIE[$cookieMail];
}else{  // Caso contrario se retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    $retornoJson->exito = false;
    $retornoJson->mensaje = "No hay una cookie con el mismo nombre";
}
echo json_encode($retornoJson);

?>