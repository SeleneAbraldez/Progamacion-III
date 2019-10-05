<?php
//Se recibe por POST el email y la clave. Invocar al método GuardarEnArchivo.

require_once "./clases/Usuario.php";

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

$auxUsuario = new Usuario($email, $clave);
$auxGuardado = $auxUsuario->GuardarEnArchivo();
if($auxGuardado->exito==true)
{
    echo json_encode($auxGuardado);
}


?>