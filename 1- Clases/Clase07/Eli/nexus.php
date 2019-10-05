<?php

include_once ("mySqlDataAccess.php");
include_once ("usuario.php");

$whatDo = isset($_POST['whatDo']) ? $_POST['whatDo'] : "tableShow";


$id = isset($_POST["id"])?$_POST["id"]:0;
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$clave = $_POST["clave"]? $_POST['clave'] : NULL;
$perfil = $_POST["perfil"];
$estado = isset($_POST["estado"])?$_POST["estado"]:0;
$correo = $_POST["correo"];

switch ($whatDo) 
{
    case "access":
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        break;

    case 'insertUser':
        $user = new usuario();
        $user->nombre = $nombre;
        $user->apellido = $apellido;
        $user->clave = $clave;
        $user->perfil = $perfil;
        $user->estado = $estado;
        $user->correo = $correo;

        if($user->InsertUser())
        {
            echo("Added one new user");
        }

        break;
    
    case 'updateUser':
        $user = new usuario();
        if( $user->UpdateUser($id, $nombre, $apellido, $clave, $perfil, $estado, $correo) )
        {
            echo("User updated suscesfully!");
        }
        break;
    
    case 'selectByID':
        $user = new usuario();
        $users = $user->GetUsersByID($id);

        foreach ($users as $object) 
        {
            echo($object->MostrarDatos()."\r\n");
        }
        break;
    
    case 'selectByState':
        $user = new usuario();
        $users = $user->GetUsersByEstado($estado);

        foreach ($users as $object) 
        {
            echo($object->MostrarDatos()."\r\n");
        }
        break;

    case 'selectAll':
        $user = usuario::GetAllUsers();
        foreach ($user as $object) 
        {
            echo($object->MostrarDatos()."\r\n");
        }
        break;

    case 'deleteByID':
        $user = new usuario();
        $user->id = $id;
        if($user->DeleteUser($user))
        {
            echo("User has been deleted!");
        }
        
        break;

    case 'userExists':
        $usuario = new usuario();
        $usuario->ExisteEnBD($correo, $clave);
        break;
    
    case 'tableShow':
        $user = usuario::GetAllUsers();

        //INICIO TABLA
        $table =    "<table border='1'>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Perfil</td>
            <td>Estado</td>
            <td>Correo</td>
            <td>Foto</td>
        </tr>";
        //INICIO TABLA

        foreach ($user as $object) 
        {
            $exploded = $object->MostrarDatos();
            $row = explode(" - ", $exploded);
            $table .=   "<tr>
                        <td>".$row[0]."</td>
                        <td>".$row[1]."</td>
                        <td>".$row[2]."</td>
                        <td>".$row[3]."</td>
                        <td>".$row[5]."</td>
                        <td>".$row[6]."</td>
                        <td> <img id='imgFoto' src='".$row[7]."' width='250px' height='250px' /> </td>
                    </tr>";
        }
        //CIERRO TABLA
        $table.="</table>";
        //CIERRO TABLA

        echo($table);
        break;

    default:
        # code...
        break;
}