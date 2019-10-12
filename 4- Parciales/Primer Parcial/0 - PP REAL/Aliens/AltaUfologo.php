<?php
//Se recibe por POST el país, el legajo y la clave. Invocar al método GuardarEnArchivo.

require_once "./clases/Ufologo.php";

$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

$auxUfolo = new Ufologo($pais, $legajo, $clave);
$auxGuardado = $auxUfolo->GuardarEnArchivo();
if($auxGuardado->exito==true)
{
    echo json_encode($auxGuardado);
}


?>