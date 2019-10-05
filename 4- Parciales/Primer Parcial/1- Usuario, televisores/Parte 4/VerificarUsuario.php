<?php
require_once "./clases/Usuario.php";

//Se recibe por POST el email y la clave
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

$AuxUsu = new Usuario($email, $clave);

//si coinciden con algún registro del archivo JSON (VerificarExistencia),
//crear una COOKIE nombrada con el email del usuario que guardará la fecha actual (con horas, minutos y segundos). 
//Luego ir a ListadoUsuarios.php.
if(Usuario::VerificarExistencia($usuario)){
    //reemplazo el "." por la "_" ya que sino da error al obtener la cookie
    //https://www.php.net/manual/es/reserved.variables.cookies.php
    $cookieMail = str_replace(".", "_", $email);
    //seteo la cookie con el "email", fecha y 10seg de duracion
    setcookie($cookieMail, date("d/m/Y - G:i:s"), time()+10);
    //luego redirecteo al listado
    header("location:ListadoUsuarios.php");

}else{  //Caso contrario, retornar un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    $retornoJson = new stdClass();
    $retornoJson->exito=false;
    $retornoJson->mensaje="Usuarix no existente";
    echo json_encode($retornoJson);
}

?>
