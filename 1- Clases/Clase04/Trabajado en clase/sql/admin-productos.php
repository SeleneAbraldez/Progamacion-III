<?php

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$base = "mercado";

$codiBarra = $_POST['codiBarra'];
$nombre = $_POST['nombre'];
$path = $_POST['path'];

$con = @mysqli_connect($host, $user, $pass, $base);
if(!$con){
        echo "Error: No se pudo conectar a MySQL.";
        echo "Error de depuración: " . mysqli_connect_errno();
        echo "Error: " . mysqli_connect_error();
}else{
    switch($queHago){

        case "Agregar_productos";
        if ($path == "null") {
            $sql = "INSERT INTO `productos`(`codigo_barra`, `nombre`) 
            VALUES ($codiBarra,'$nombre')";
        }else {
            $sql = "INSERT INTO `productos`(`codigo_barra`, `nombre`, `path_foto`) 
            VALUES ($codiBarra,'$nombre', '$path')";
        }
        $rs = $con->query($sql);
        if($rs == true){
            if (mysqli_affected_rows($con) > 0) {
                echo "Producto agregado";
            }else {
                echo "!! - Se ha generado un error.";
            }
        }else {
            var_dump($rs);
        }
        break;

        case "TraerTodos_productos":
            $sql = "SELECT * FROM productos";
            $rs = $con->query($sql); 
            if($rs == true){
                if (mysqli_num_rows($rs) > 0) {
                    while ($row = $rs->fetch_object()){
                        $user_arr[] = $row;
                    }
                    var_dump($user_arr);
                }else {
                    echo "Base vacia.";
                }
            }            
        break;
        
        case "TraerxId_productos":
            $sql = "SELECT * FROM productos WHERE id=2";
            $rs = $con->query($sql);
            if($rs == true){
                if (mysqli_num_rows($rs) > 0) {
                    while ($row = $rs->fetch_object()){
                        $user_arr[] = $row;
                    }
                    var_dump($user_arr);
                }else {
                    echo "Ningun producto cumple con los parametros";
                }
            }             
        break;

        case "Editar_productos";
        if ($path == "null") {
            $sql = "UPDATE `productos` SET `codigo_barra`=$codiBarra, `nombre`='$nombre' WHERE id=2";
        }else {
            $sql = "UPDATE `productos` SET `codigo_barra`=$codiBarra, `nombre`='$nombre', `path_foto`='$path'
            WHERE id=2";
        }
        $rs = $con->query($sql);
        if($rs == true){
            if (mysqli_affected_rows($con) > 0) {
                echo "Producto modificado";
            }else {
                echo "!! - Se ha generado un error o no se ha encontrado un producto que cumpla con el requisito.";
            }
        }else {
            var_dump($rs);
        }
        break;    

        case "EliminarxId_productos";
        $sql = "DELETE FROM `productos` WHERE id=3";
        $rs = $con->query($sql);
        if($rs == true){
            if (mysqli_affected_rows($con) > 0) {
                echo "Producto borrado";
            }else {
                echo "!! - Se ha generado un error o no se ha encontrado ningun producto con dicha condicion.";
            }
        }     
        break;

        default:
            echo ":(";
    }
}

mysqli_close($con);