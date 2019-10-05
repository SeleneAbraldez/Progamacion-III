<?php

include_once ("AccesoDatos - Mercado.php");
include_once ("usuarix.php");

$signUpData = isset($_POST['RegistradxDatos']) ? $_POST['RegistradxDatos'] : NULL;

$objeto = json_decode($signUpData);

$usuario = new usuario();
$usuario->nombre = $objeto->nombre;
$usuario->apellido = $objeto->apellido;
$usuario->clave = $objeto->clave;
$usuario->perfil = $objeto->perfil;
$usuario->estado = $objeto->estado;
$usuario->correo = $objeto->correo;

if($usuario->ExisteEnBDCorreo($objeto->correo))
{
    echo false;
}
else
{
    echo($usuario->InsertUser());
}

?>