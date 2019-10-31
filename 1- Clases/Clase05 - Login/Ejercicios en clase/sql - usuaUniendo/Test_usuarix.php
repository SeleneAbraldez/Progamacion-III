<?php  
    include_once ("usuarix.php");
    include_once ("AccesoDatos - Usuarixs.php");
    //post de info de login
    $cuenta = isset($_POST["login"]) ? $_POST["login"]: NULL;

    $obj = json_decode($cuenta);

    //creamos un usuario para comparar en la funcion y que pase si existe o no
    $usu = new Usuarixs();
    if($usu->YaExiste($obj->correo, $obj->clave)){
        echo("Usuarix se encuentra!");
    }else{
        echo("ERROR - Mail o contraseña incorrectos");
    }

?>