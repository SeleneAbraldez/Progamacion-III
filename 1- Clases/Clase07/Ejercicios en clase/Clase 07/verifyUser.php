<?php
session_start();
include_once ("usuario.php");
include_once ("mySqlDataAccess.php");

//GET THE JSON BY POST METHOD
$loginData = isset($_POST['loginData']) ? $_POST['loginData'] : NULL;

//DECODE THE JSON INTO AN OBJECT
$objeto = json_decode($loginData);

//CREATE NEW USER
$usuario = new usuario();
//CALL "ExisteEnBD" FUNCTION
$clase = new stdClass();

$clase = $usuario->ExisteEnBD($objeto->correo, $objeto->clave);
if($clase->existe == true)
{
    $_SESSION["perfilUsuario"] = $clase->user->perfil;
}

echo json_encode($clase);
//echo json_encode($obj);


?>