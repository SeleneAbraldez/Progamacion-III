<?php

class producto
{
    //AGREGAR BUSQUEDA POR CORREO - CLAVE
    public $id;
    public $codigo_barra;
    public $nombre;
    public $path_foto;

    function MostrarDatos()
    {
        return $this->id." - ".$this->codigo_barra." - ".$this->nombre." - ".$this->path_foto;
    }

    public static function GetAllProducts()
    {    
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM productos WHERE 1");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new producto);                                              

        return $consulta;
    }

    function GetProductsByID($id)
    {
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new producto);                                              

        return $consulta;
    }

    function ExisteEnBD($codigoBarra)
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE codigo_barra = :codigoBarra");        
        $consulta->bindValue(':codigoBarra', $codigoBarra, PDO::PARAM_STR);

        $consulta->execute();                                           

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;

    }

    function InsertProduct()
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $destino = "./fotos/" . date("Ymd_His") . ".jpg";
        
        move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO productos(codigo_barra, nombre, path_foto)" 
                                                        ."VALUES (:codigo_barra, :nombre, :path_foto)");
        
        $consulta->bindValue(':codigo_barra', $this->codigo_barra, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':path_foto', $this->path_foto, PDO::PARAM_INT);

        $consulta->execute();

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;
    }

    function UpdateProduct($id, $codigo_barra, $nombre, $path_foto)
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE productos
        SET codigo_barra = :codigo_barra, nombre = :nombre, path_foto = :path_foto
        WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':codigo_barra', $codigo_barra, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':path_foto', $path_foto, PDO::PARAM_STR);

        $consulta->execute();

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;
    }

    public static function DeleteProduct($product)
    {
        $result = false;
        $objetoAccesoDato = mySqlDataAccess::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM productos WHERE id = :id");
        
        $consulta->bindValue(':id', $product->id, PDO::PARAM_INT);

        $consulta->execute();

        if($consulta->rowCount() == 1)
        $result = true;

        return $result;
    }

}

?>