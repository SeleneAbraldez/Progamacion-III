<?php

class usuario
{
    //AGREGAR BUSQUEDA POR CORREO - CLAVE
    public $id;
    public $nombre;
    public $apellido;
    public $clave; //VALORES NO REPETIBLES ENTRE SI
    public $perfil;
    public $estado;
    public $correo; //VALOR NO REPETIBLE ENTRE SI
    public $foto;

    function MostrarDatos()
    {
        return $this->id." - ".$this->nombre." - ".$this->apellido." - ".$this->clave." - ".$this->perfil." - ".$this->estado." - ".$this->correo." - ".$this->foto;
    }

    public static function GetAllUsers()
    {    
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE 1");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);                                              

        return $consulta;
    }

    function GetUsersByID($id)
    {
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);                                              

        return $consulta;
    }

    function GetUsersByEstado($estado)
    {
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE estado = :estado");
        $consulta->bindValue(':estado', $estado, PDO::PARAM_INT);        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);                                              

        return $consulta;
    }

    function ExisteEnBD($correo, $clave)
    {
        $json = new stdClass();
        $json->existe = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE correo = :correo && clave = :clave");        
        $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);

        $consulta->execute();
        

        if($consulta->rowCount() == 1)
        {
            $json->existe = true;
            $json->user = $consulta->fetchObject();
        }


        return $json;

    }

    function ExisteEnBDCorreo($correo)
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE correo = :correo");        
        $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);

        $consulta->execute();                                           

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;

    }

    function InsertUser()
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $destino = "./fotos/" . date("Ymd_His") . ".jpg";
        
        move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios(nombre, apellido, clave, perfil, estado, correo, foto)" 
                                                        ."VALUES (:nombre, :apellido, :clave, :perfil, :estado, :correo, :foto)");
        
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_INT);
        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_INT);
        $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $destino, PDO::PARAM_STR);

        $consulta->execute();

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;
    }

    function UpdateUser($id, $nombre, $apellido, $clave, $perfil, $estado, $correo)
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios
        SET nombre = :nombre, apellido = :apellido, clave = :clave, perfil = :perfil, estado = :estado, correo = :correo
        WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_INT);
        $consulta->bindValue(':perfil', $perfil, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_INT);
        $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);

        $consulta->execute();

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;
    }

    public static function DeleteUser($user)
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
        
        $consulta->bindValue(':id', $user->id, PDO::PARAM_INT);

        $consulta->execute();

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;
    }

}

?>