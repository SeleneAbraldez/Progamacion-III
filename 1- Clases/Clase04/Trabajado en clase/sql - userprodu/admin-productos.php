<?php

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$base = "mercado";

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$clave = $_POST['clave'];
$perfil = $_POST['perfil'];
$estado = $_POST['estado'];

$con = @mysqli_connect($host, $user, $pass, $base);
if(!$con){
        echo "Error: No se pudo conectar a MySQL.";
        echo "Error de depuración: " . mysqli_connect_errno();
        echo "Error: " . mysqli_connect_error();
}else{
    switch($queHago){

        case "Agregar_uruarixs";
        $sql = "INSERT INTO `usuarixs`(`nombre`, `apellido`, `clave`, `perfil`, `estado`)
         VALUES ('$nombre', '$apellido', '$clave', $perfil, $estado)";
        $rs = $con->query($sql);
        if($rs == true){
            if (mysqli_affected_rows($con) > 0) {
                echo "Usuarix agregadx";
            }else {
                echo "!! - Se ha generado un error.";
            }
        }else {
            var_dump($rs);
        }
        break;

        case "TraerTodxs_usuarixs":
            $sql = "SELECT * FROM usuarixs";
            $rs = $con->query($sql);
            //var_dump($rs);
            //echo "Cantidad de filas afectadas: " . mysqli_num_rows($rs);  
            if($rs == true){
                if (mysqli_num_rows($rs) > 0) {
                    while ($row = $rs->fetch_object()){
                        $user_arr[] = $row;
                    }
                    var_dump($user_arr);
                }else {
                    echo "Ningun x cumple con los parametros";
                }
            }            
        break;
        
        case "TraerxId_usuarixs":
            $sql = "SELECT * FROM usuarixs WHERE id=4";
            $rs = $con->query($sql);
            //var_dump($rs);
            //echo "Cantidad de filas afectadas: " . mysqli_num_rows($rs);  
            if($rs == true){
                if (mysqli_num_rows($rs) > 0) {
                    while ($row = $rs->fetch_object()){
                        $user_arr[] = $row;
                    }
                    var_dump($user_arr);
                }else {
                    echo "Ningun x cumple con los parametros";
                }
            }             
        break;
    
        case "TraerxEstado_usuarixs":        
            $sql = "SELECT * FROM usuarixs WHERE estado=1";
            $rs = $con->query($sql);
            //var_dump($rs);
            //echo "Cantidad de filas afectadas: " . mysqli_num_rows($rs);  
            if($rs == true){
                if (mysqli_num_rows($rs) > 0) {
                    while ($row = $rs->fetch_object()){
                        $user_arr[] = $row;
                    }
                    var_dump($user_arr);
                }else {
                    echo "Ningun x cumple con los parametros";
                }
            }                  
        break;

        case "Editar_uruarixs";
        $sql = "UPDATE `usuarixs` SET `nombre`='$nombre', `apellido`='$apellido', `clave`='$clave', `perfil`=$perfil, `estado`=$estado WHERE id=4";
        $rs = $con->query($sql);
        if($rs == true){
            if (mysqli_affected_rows($con) > 0) {
                echo "Usuarix modificadx";
            }else {
                echo "!! - Se ha generado un error.";
            }
        }else {
            var_dump($rs);
        }
        break;    

        case "EliminarxId_uruarixs";
        $sql = "DELETE FROM `usuarixs` WHERE id=5";
        $rs = $con->query($sql);
        if($rs == true){
            if (mysqli_affected_rows($con) > 0) {
                echo "Usuarix borradx";
            }else {
                echo "!! - Se ha generado un error o no se ha encontrado ningunx usuarix con dicha condicion.";
            }
        }     
        break;

        default:
            echo ":(";
    }
}

mysqli_close($con);