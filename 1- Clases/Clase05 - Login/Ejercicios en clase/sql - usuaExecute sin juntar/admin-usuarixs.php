<?php

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

$conexion = 'mysql:host=localhost;dbname=mercado;charset=utf8';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO($conexion, $user, $pass);
    echo "Conexion establecida! \n";

    switch($queHago){
        case "Agregar_uruarixs";
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $nombre =  isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $apellido =  isset($_POST['apellido']) ? $_POST['apellido'] : NULL;
            $clave =  isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $perfil =  isset($_POST['perfil']) ? $_POST['perfil'] : NULL;
            $estado =  isset($_POST['estado']) ? $_POST['estado'] : NULL;

            $q = "INSERT INTO `usuarixs`(`nombre`, `apellido`, `clave`, `perfil`, `estado`)
            VALUES ('$nombre', '$apellido', '$clave', $perfil, $estado)";
            $colum = $pdo->prepare($q);    
            $colum->execute();

            if (($colum->rowCount())>0) {
                echo "Usuarix" . $id . "agregadx";
            }else {
                echo "!! - Se ha generado un error.";
            }
        break;

        case "TraerTodxs_usuarixs":
            $q = "SELECT * FROM usuarixs";
            $colum = $pdo->prepare($q);    
            $colum->execute();

            $tabla = "<table><tr><td>ID</td><td>NOMBRE</td><td>APELLIDO</td><td>PERFIL</td><td>ESTADO</td></tr>";
            while($fila = $colum->fetch()){
                $tabla .= "<tr><td>" . $fila[0] . "</td><td>" . $fila[1] . "</td><td>" . $fila[2] . "</td><td>" . $fila[4] ."</td><td>" . $fila[5] ."</td></tr>";
            }         
            $tabla .= "</table>";
            echo $tabla;
        break;
        
        case "TraerxId_usuarixs":
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $q = "SELECT * FROM usuarixs WHERE id=:id";
            $colum = $pdo->prepare($q);    
            $colum->execute(array("id"=> $id));

            $tabla = "<table><tr><td>ID</td><td>NOMBRE</td><td>APELLIDO</td><td>PERFIL</td><td>ESTADO</td></tr>";
            while($fila = $colum->fetch()){
                $tabla .= "<tr><td>" . $fila[0] . "</td><td>" . $fila[1] . "</td><td>" . $fila[2] . "</td><td>" . $fila[4] ."</td><td>" . $fila[5] ."</td></tr>";
            }         
            $tabla .= "</table>";
            echo $tabla;          
        break;
    
        case "TraerxEstado_usuarixs":        
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            $q = "SELECT * FROM usuarixs WHERE estado=:estado";
            $colum = $pdo->prepare($q);    
            $colum->execute(array("estado"=> $estado));

            $tabla = "<table><tr><td>ID</td><td>NOMBRE</td><td>APELLIDO</td><td>PERFIL</td><td>ESTADO</td></tr>";
            while($fila = $colum->fetch()){
                $tabla .= "<tr><td>" . $fila[0] . "</td><td>" . $fila[1] . "</td><td>" . $fila[2] . "</td><td>" . $fila[4] ."</td><td>" . $fila[5] ."</td></tr>";
            }         
            $tabla .= "</table>";
            echo $tabla;                 
        break;

        case "Editar_uruarixs";          
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $nombre =  isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $apellido =  isset($_POST['apellido']) ? $_POST['apellido'] : NULL;
            $clave =  isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $perfil =  isset($_POST['perfil']) ? $_POST['perfil'] : NULL;
            $estado =  isset($_POST['estado']) ? $_POST['estado'] : NULL;
            
            $q = "UPDATE `usuarixs` SET `nombre`='$nombre', `apellido`='$apellido', `clave`='$clave', `perfil`=$perfil, `estado`=$estado WHERE id=:id";
            $colum = $pdo->prepare($q);    
            $colum->execute(array("id"=> $id));

            if (($colum->rowCount())>0) {
                echo "Usuarix " . $id . " modificadx";
            }else {
                echo "!! - Se ha generado un error.";
            }
        break;    

        case "EliminarxId_uruarixs";
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $q = "DELETE FROM `usuarixs` WHERE id=:id";
            $colum = $pdo->prepare($q);    
            $colum->execute(array("id"=> $id));;

            if(($colum->rowCount())>0){
                echo "Usuarix ". $id ." borradx";
            }else{
                echo "!! - Se ha generado un error o no se ha encontrado ningunx usuarix con dicha condicion.";
            }   
        break;

        default:
            echo ":(";
    }

} catch (PDOEXCEPTION $e) {
    echo "Se ha producido un error!";
    echo $e;
}