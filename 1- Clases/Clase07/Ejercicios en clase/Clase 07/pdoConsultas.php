<?php

//CONECTION STRING, USER AND PASS
//$conectionString = "mysql:host=localhost;dbname=cdcol;charset=utf8";
$conectionString = "mysql:host=localhost;dbname=mercado;charset=utf8";
$user = "root";
$pass = "";

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;
$id = isset($_POST["id"])?$_POST["id"]:0;

$estado = isset($_POST["estado"])?$_POST["estado"]:0;
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$clave = $_POST["clave"];
$perfil = $_POST["perfil"];

/*
try 
{
    //PDO OBJECT DECLARATION
    $pdo = new PDO($conectionString, $user, $pass);
    echo("Established connection");

    //STRING QUERY
    $consulta = "SELECT * FROM cds";
    //EXECUTE QUERY AND ASIGN THE RESULTS TO "queryResult"
    //IT RETURNS AN INDEXED AND ASOCIATIVE
    $queryResult = $pdo->query($consulta);

    //SEARCH ONE BY ONE
    foreach ($queryResult as $row) 
    {
        echo $row[0] . "\t";
        echo $row[1] . "\t";
        echo $row[2] . "\n";
    }



} catch (PDOEXCEPTION $e) {
    echo("Error de conexion");
    echo($e);
}*/

/*
try 
{
    //PDO OBJECT DECLARATION
    $pdo = new PDO($conectionString, $user, $pass);
    echo("Established connection");

    //STRING QUERY
    $consulta = "SELECT * FROM cds";
    //EXECUTE QUERY AND ASIGN THE RESULTS TO "queryResult"
    //IT RETURNS AN INDEXED AND ASOCIATIVE
    $queryResult = $pdo->query($consulta);
    $fila = $queryResult->fetchAll();


    //INICIO TABLA
    $table =    "<table border='1'>
    <tr>
        <td>Titulo</td>
        <td>Interprete</td>
        <td>Año</td>
        <td>ID</td>
    </tr>";
    //INICIO TABLA
    
    //SEARCH ONE BY ONE
    foreach ($fila as $row) 
    {
        $table .=   "<tr>
                        <td>".$row["titel"]."</td>
                        <td>".$row["interpret"]."</td>
                        <td>".$row["jahr"]."</td>
                        <td>".$row["id"]."</td>
                    </tr>";
    }

    //CIERRO TABLA
    $table.="</table>";
    //CIERRO TABLA

    echo($table);

} catch (PDOEXCEPTION $e) {
    echo("Error de conexion");
    echo($e);
}*/


/////////////////////////////
//SELECT ALL
/////////////////////////////
/*try 
{
    //PDO OBJECT DECLARATION
    $pdo = new PDO($conectionString, $user, $pass);
    echo("Established connection");

    //STRING QUERY
    $consulta = $pdo->prepare("SELECT * FROM `usuarios` WHERE 1");
    
    //EXECUTE QUERY AND ASIGN THE RESULTS TO "queryResult"
    //IT RETURNS AN INDEXED AND ASOCIATIVE
    $consulta->execute();

    var_dump($queryResult);

    //INICIO TABLA
    $table =    "<table border='1'>
    <tr>
        <td>ID</td>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Perfil</td>
        <td>Estado</td>
    </tr>";
//INICIO TABLA
    
    //SEARCH ONE BY ONE
    foreach ($consulta as $row) 
    {
        $table .=   "<tr>
                        <td>".$row[0]."</td>
                        <td>".$row[1]."</td>
                        <td>".$row[2]."</td>
                        <td>".$row[3]."</td>
                        <td>".$row[4]."</td>
                    </tr>";
    }

    //CIERRO TABLA
    $table.="</table>";
    //CIERRO TABLA

    echo($table);

} catch (PDOEXCEPTION $e) {
    echo("Error de conexion");
    echo($e);
}*/

switch ($queHago) {
    case 'traerTodosUsuarios':
        try 
        {
            //PDO OBJECT DECLARATION
            $pdo = new PDO($conectionString, $user, $pass);
            echo("Established connection");
        
            //STRING QUERY
            $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE 1");
            
            //EXECUTE QUERY AND ASIGN THE RESULTS TO "queryResult"
            //IT RETURNS AN INDEXED AND ASOCIATIVE
            $consulta->execute();
        
            //INICIO TABLA
            $table =    "<table border='1'>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Perfil</td>
                <td>Estado</td>
            </tr>";
            //INICIO TABLA
            
            //SEARCH ONE BY ONE
            while($row = $consulta->fetch()) 
            {
                $table .=   "<tr>
                                <td>".$row[0]."</td>
                                <td>".$row[1]."</td>
                                <td>".$row[2]."</td>
                                <td>".$row[3]."</td>
                                <td>".$row[4]."</td>
                            </tr>";
            }
        
            //CIERRO TABLA
            $table.="</table>";
            //CIERRO TABLA
        
            echo($table);
        
        } catch (PDOEXCEPTION $e) {
            echo("Error de conexion");
            echo($e);
        }
        break;
        
    case 'traerPorId_usuarios':
        try 
        {
            //PDO OBJECT DECLARATION
            $pdo = new PDO($conectionString, $user, $pass);
            echo("Established connection");
        
            //PREPARE THE QUERY TO BE EXECUTED
            $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        
            //BIND PARAMETER ID
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            
            //EXECUTE QUERY AND RETURN INTEMS TO "$consulta"
            $consulta->execute();
        
            //INICIO TABLA
            $table =    "<table border='1'>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Perfil</td>
                <td>Estado</td>
            </tr>";
        //INICIO TABLA
            
            //SEARCH ONE BY ONE
            while($row = $consulta->fetch()) 
            {
                $table .=   "<tr>
                                <td>".$row[0]."</td>
                                <td>".$row[1]."</td>
                                <td>".$row[2]."</td>
                                <td>".$row[3]."</td>
                                <td>".$row[4]."</td>
                            </tr>";
            }
        
            //CIERRO TABLA
            $table.="</table>";
            //CIERRO TABLA
        
            echo($table);
        
        } catch (PDOEXCEPTION $e) {
            echo("Error de conexion");
            echo($e);
        }

        break;
    
    case 'traerPorEstado_usuarios':

        try 
        {
            //PDO OBJECT DECLARATION
            $pdo = new PDO($conectionString, $user, $pass);
            echo("Established connection");
        
            //PREPARE THE QUERY TO BE EXECUTED
            $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE estado = :estado");
        
            //BIND PARAMETER ID
            $consulta->bindParam(':estado', $estado, PDO::PARAM_INT);
            
            //EXECUTE QUERY AND RETURN INTEMS TO "$consulta"
            $consulta->execute();

            //INICIO TABLA
            $table =    "<table border='1'>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Perfil</td>
                <td>Estado</td>
            </tr>";
        //INICIO TABLA
            
            //SEARCH ONE BY ONE
            while($row = $consulta->fetch()) 
            {
                $table .=   "<tr>
                                <td>".$row[0]."</td>
                                <td>".$row[1]."</td>
                                <td>".$row[2]."</td>
                                <td>".$row[3]."</td>
                                <td>".$row[4]."</td>
                            </tr>";
            }
        
            //CIERRO TABLA
            $table.="</table>";
            //CIERRO TABLA
        
            echo($table);
        
        } catch (PDOEXCEPTION $e) {
            echo("Error de conexion");
            echo($e);
        }

        break;

    case "agregar_usuario":

        try 
        {
            //PDO OBJECT DECLARATION
            $pdo = new PDO($conectionString, $user, $pass);
            echo("Established connection");
        
            //PREPARE THE QUERY TO BE EXECUTED
            $consulta = $pdo->prepare("INSERT INTO usuarios(nombre, apellido, clave, perfil, estado) VALUES (?, ?, ?, ?, ?)");
            $consulta->bindParam(1, $nombre);
            $consulta->bindParam(2, $apellido);
            $consulta->bindParam(3, $clave);
            $consulta->bindParam(4, $perfil);
            $consulta->bindParam(5, $estado);
            
            //EXECUTE QUERY AND RETURN INTEMS TO "$consulta"
            $consulta->execute();

            echo("Affected rows: ".$consulta->rowCount());
        
        } catch (PDOEXCEPTION $e) {
            echo("Error de conexion");
            echo($e);
        }
    case "borrar_usuario":

        try 
        {
            //PDO OBJECT DECLARATION
            $pdo = new PDO($conectionString, $user, $pass);
            echo("Established connection");
        
            //PREPARE THE QUERY TO BE EXECUTED
            $consulta = $pdo->prepare("DELETE FROM `usuarios` 

            WHERE id = 1");
            $consulta->bindParam(1, $nombre);
            $consulta->bindParam(2, $apellido);
            $consulta->bindParam(3, $clave);
            $consulta->bindParam(4, $perfil);
            $consulta->bindParam(5, $estado);
            
            //EXECUTE QUERY AND RETURN INTEMS TO "$consulta"
            $consulta->execute();

            echo("Affected rows: ".$consulta->rowCount());
        
        } catch (PDOEXCEPTION $e) {
            echo("Error de conexion");
            echo($e);
        }

        break;

    default:
        # code...
        break;
}
?>