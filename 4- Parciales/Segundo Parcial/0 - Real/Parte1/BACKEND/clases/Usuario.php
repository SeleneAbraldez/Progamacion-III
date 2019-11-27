<?php

class usuario 
{
    public $id;
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
        $usu = $array['usuario'];
        $usu = json_decode($usu);

        //y los archivos
        $archivos = $request->getUploadedFiles(); 
        $destino = "./BACKEND/fotos/autos/";

        $usua = new usuario();

        $extension = explode(".", $archivos['foto']->getClientFilename()); //nombre de la ext
        $path =  $usu->apellido ."." . date("Gis").  "." . $extension[1];

        $usua->correo = $usu->correo;
        $usua->clave = $usu->clave;
        $usua->nombre = $usu->nombre;
        $usua->apellido = $usu->apellido;
        $usua->perfil = $usu->perfil;
        $usua->foto = $path;

        $std= new stdclass();

        $archivos['foto']->moveTo($destino . $path);

        if($usua->AltaUsuBD($usua)){
            $std->exito = true;
            $std->mensaje = "Usuarix se ha agregado!";
            $std->user = $usu;
            $retorno = $response->withJson($std, 200);
        }else{
            $std->exito = false;
            $std->mensaje = "ERROR! Usuarix no se ha  podido agregar!";
            $retorno = $response->withJson($std, 418);
        }
        return $retorno;
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


    //-traertabla-
    public function TraerTablaUsu($request, $response)
    {
        $usu = new usuario();
        $usuarixs= $usu->TraerTodosUsuBD();
        $std= new stdclass();
        $fotostring = "No hay foto";

        if($usuarixs){
            $tabla = "<table border=1><tr><td>CORREO</td><td>CLAVE</td><td>NOMBRE</td><td>APELLIDO</td><td>PERFIL</td><td>FOTO</td></tr>";
            foreach ($usuarixs as $usuarix) {
                if($usuarix->foto == ""){
                    $usuarix->foto = "No hay foto";
                }else{
                    $fotostring = $usuarix->foto;
                    $usuarix->foto = "<img src='BACKEND/fotos/autos/" . $usuarix->foto . "' width='100px' height='100px'/>";
                }
                $tabla .= "<tr><td>" . $usuarix->correo . "</td><td>" . $usuarix->clave .  "</td><td>" . $usuarix->nombre . "</td><td>" . $usuarix->apellido ."</td><td>" . $usuarix->perfil ."</td><td>" . $usuarix->foto . "</td></tr>";
                $usuarix->foto = $fotostring;
            }
            $tabla .= "</table>";
            $std->exito = true;
            $std->mensaje = "Tabla correcta!";
            $std->tabla = $tabla;          
            $retorno = $response->write("<br>" . json_encode($std));
        }else{
            $std->exito = false;
            $std->mensaje = "ERROR - TABLA";
            // $std->tabla = $tabla;
            $retorno = $response->withJson($std, 424);
        }

        return $retorno;
    }
    
    public static function TraerTodosUsuBD()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");    
        $consulta->execute();   
        $usuarios = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
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

        $usuario = false;

        if ($consulta->rowCount()>0) {
            $usuario= $consulta->fetchObject('Usuario');
        }

        return $usuario;
    }

    //////////


  
}
?>