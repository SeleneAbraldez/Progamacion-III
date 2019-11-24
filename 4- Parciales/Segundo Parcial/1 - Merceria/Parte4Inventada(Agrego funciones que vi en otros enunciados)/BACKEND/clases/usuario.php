<?php

class usuario 
{
    public $ID;
    public $correo;
    public $clave;
    public $nombre;
    public $apellido;
    public $perfil; 
    public $foto;

//PARTE 1
    //-alta-
    public function AgregarUsuApi($request, $response){ 
        //obtengo los parametros
        $array = $request->getParsedBody();
        //y los archivos
        $archivos = $request->getUploadedFiles(); 
        $destino = "./BACKEND/fotos/usuarios/";

        $usu = new usuario();

        $extension = explode(".", $archivos['foto']->getClientFilename()); //nombre de la ext
        $path =  $array["apellido"] ."." . date("Gis").  "." . $extension[1];

        $usu->correo = $array["correo"];
        $usu->clave = $array["clave"];
        $usu->nombre = $array["nombre"];
        $usu->apellido = $array["apellido"];
        $usu->perfil = $array["perfil"];
        $usu->foto = $path;

        $std= new stdclass();

        $archivos['foto']->moveTo($destino . $path);

        if($usu->AltaUsuBD($usu)){
            $std->exito = true;
            $std->mensaje = "Usuarix se ha agregado!";
            $std->user = $usu;
        }else{
            $std->exito = false;
            $std->mensaje = "ERROR! Usuarix no se ha  podido agregar!";
        }
        // $retorno = $response->withJson($std, 200);
        // return $retorno;
        return $response->getBody()->write($std->mensaje);
    }

    public static function AltaUsuBD($usuario)
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();    

        $consulta =$objetoAccesoDato->RetornarConsulta ("INSERT INTO `usuarios`(`correo`, `clave`, `nombre`, `apellido`, `perfil`, `foto`)
        VALUES (:correo, :clave, :nombre, :apellido, :perfil, :foto)");
                                                        
        $consulta->bindValue(':correo', $usuario->correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $usuario->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $usuario->perfil, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $usuario->foto, PDO::PARAM_STR);
        $consulta->execute();   

        if ($consulta->rowCount()>0) {
            $retorno = true;
        }
        return $retorno;
    }


    //-traertds-
    public function TraerTodosUsuApi($request, $response, $args){
        $usuarios= usuario::TraerTodosUsuBD();
        $retorno = $response->withJson($usuarios, 200); 
        return $retorno;
    }
    
    public static function TraerTodosUsuBD()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");    
        $consulta->execute();   
        $usuarios = $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
        return $usuarios;         
    }

    // -verificar usu-
    public static function ValidarUsu($correo, $clave)
    {
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE correo=:correo AND clave=:clave");
        $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
        $consulta->execute();
        $usuario= $consulta->fetchObject('usuario');
        return $usuario;
    }

//////////


///EXTRAS

    //agrego funcion para mostrar tabla
    public function TraerTabla()
    {
        $usu = new usuario();
        $usuarixs= $usu->TraerTodosUsuBD();

        $tabla = "<table border=1><tr><td>ID</td><td>CORREO</td><td>CLAVE</td><td>NOMBRE</td><td>APELLIDO</td><td>PERFIL</td><td>FOTO</td></tr>";
        foreach ($usuarixs as $usuarix) {
            if($usuarix->foto == ""){
                $usuarix->foto = "No hay foto";
            }else{
                $usuarix->foto = "<img src='BACKEND/fotos/usuarios/" . $usuarix->foto . "' width='100px' height='100px'/>";
            }
            $tabla .= "<tr><td>" . $usuarix->ID . "</td><td>" . $usuarix->correo . "</td><td>" . $usuarix->clave .  "</td><td>" . $usuarix->nombre . "</td><td>" . $usuarix->apellido ."</td><td>" . $usuarix->perfil ."</td><td>" . $usuarix->foto . "</td></tr>";
        }
        $tabla .= "</table>";
        return $tabla;
    }


///
}
?>