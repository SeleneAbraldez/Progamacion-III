<<<<<<< HEAD
<?php
require_once "IParte2.php";
require_once "IParte3.php";
require_once "IParte4.php";
require_once "./AccesoDatos - productos_bd.php";

class Televisor implements IParte2, IParte3, IParte4
{
    //atributos publicos
    public $tipo;
    public $precio;
    public $paisOrigen;
    public $path;

    //constructor con todos sus paramtreos opcionales
    public function __construct($tipo = null, $precio = null, $paisOrigen = null, $path = null)
    {
        $this->tipo = $tipo != null ? $tipo : "";
        $this->precio = $precio != null ? $precio : "";
        $this->paisOrigen = $paisOrigen != null ? $paisOrigen : "";
        $this->path = $path != null ? $path : "";
    }

    //método de instancia ToJSON(), que retornará los datos de la instancia (en una cadena con formato JSON).
    public function ToJson()
    {
        $auxJson = new stdClass();
        $auxJson->tipo = $this->tipo;
        $auxJson->precio = $this->precio;
        $auxJson->paisOrigen = $this->paisOrigen;
        $auxJson->path = $this->path;

        return json_encode($auxJson);
    }

//I2
    //Agregar: agrega, a partir de la instancia actual, 
    //un nuevo registro en la tabla televisores (id, tipo, precio, país, foto), de la base de datos productos_bd. 
    //Retorna true, si se pudo agregar, false, caso contrario.
    public function Agregar()
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso(); //no inserto el id porque es AI
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO televisores (tipo, precio, pais, foto)"
                                                    . "VALUES(:tipo, :precio, :pais, :foto)"); 
        
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
        $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->path, PDO::PARAM_STR);
        $consulta->execute();

        if (($consulta->rowCount())>0) {
            $retorno = true;
        }

        return $retorno;        
    }

    //Traer: retorna un array de objetos de tipo Televisor, recuperados de la base de datos.
    public function Traer()
    {
        $televisores = array();
        $objetoAccesoDato =AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores");
        $consulta->execute();

        while($fila = $consulta->fetch())
        {
          $tele= new Televisor($fila[1], $fila[2], $fila[3], $fila[4]);    //no guardo el id
          array_push($televisores, $tele);
        }
        return $televisores;
    }

    // CalcularIVA: retorna el precio del televisor más el 21%.
    public function CalcularIva()
    {
        if($this->precio != ""){
            $IVA = $this->precio * 21 / 100;            
            return ($this->precio + $IVA);
        }else{
            return "Sin datos //";
        }
    }


//I3
    //Modificar: Modifica en la base de datos el registro coincidente con la instancia actual. 
    //Retorna true, si se pudo modificar, false, caso contrario.
    public function Modificar($id, $televisor)  //lo hago haciendo que reciba una id y un televisor
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();                                                 
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE televisores SET tipo=:tipo, precio=:precio, 
                        pais=:pais, foto=:foto WHERE id=:id");
                                                     
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);  

        $consulta->bindValue(':tipo', $televisor->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $televisor->precio, PDO::PARAM_INT);
        $consulta->bindValue(':pais', $televisor->paisOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $televisor->path, PDO::PARAM_STR);
        $consulta->execute();

        if($consulta->rowCount() > 0)
        {
            $retorno = true;
        }
        return $retorno;
    }


//I4
    //Eliminar: elimina de la base de datos el registro coincidente con la instancia actual. 
    //Retorna true, si se pudo eliminar, false, caso contrario.
    public function Eliminar($tipo)  //lo hago haciendo que reciba un tipo
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM televisores WHERE tipo=:tipo");
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
        if($consulta->rowCount() > 0)
        {
            $retorno = true;
        }

        return $retorno;
    }
///
    //funcion para traer televisor por id
    public function TraerId($id)
    {
        $usuario = null;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE id=:id");
        $consulta->bindValue(':id',  $id, PDO::PARAM_INT);
        $consulta->execute();
        $fila = $consulta->fetch();
        if($fila !== null){
            $televisorRet = new Televisor($fila[1],$fila[2],$fila[3],$fila[4]);
        }
        return $televisorRet;
    }

    public function TraerTipo($tipo)
    {
        $usuario = null;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE tipo=:tipo");
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
        $fila = $consulta->fetch();
        if($fila !== null){
            $televisorRet = new Televisor($fila[1],$fila[2],$fila[3],$fila[4]);
        }
        return $televisorRet;
    }

}




=======
<?php
require_once "IParte2.php";
require_once "IParte3.php";
require_once "IParte4.php";
require_once "./AccesoDatos - productos_bd.php";

class Televisor implements IParte2, IParte3, IParte4
{
    //atributos publicos
    public $tipo;
    public $precio;
    public $paisOrigen;
    public $path;

    //constructor con todos sus paramtreos opcionales
    public function __construct($tipo = null, $precio = null, $paisOrigen = null, $path = null)
    {
        $this->tipo = $tipo != null ? $tipo : "";
        $this->precio = $precio != null ? $precio : "";
        $this->paisOrigen = $paisOrigen != null ? $paisOrigen : "";
        $this->path = $path != null ? $path : "";
    }

    //método de instancia ToJSON(), que retornará los datos de la instancia (en una cadena con formato JSON).
    public function ToJson()
    {
        $auxJson = new stdClass();
        $auxJson->tipo = $this->tipo;
        $auxJson->precio = $this->precio;
        $auxJson->paisOrigen = $this->paisOrigen;
        $auxJson->path = $this->path;

        return json_encode($auxJson);
    }

//I2
    //Agregar: agrega, a partir de la instancia actual, 
    //un nuevo registro en la tabla televisores (id, tipo, precio, país, foto), de la base de datos productos_bd. 
    //Retorna true, si se pudo agregar, false, caso contrario.
    public function Agregar()
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso(); //no inserto el id porque es AI
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO televisores (tipo, precio, pais, foto)"
                                                    . "VALUES(:tipo, :precio, :pais, :foto)"); 
        
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
        $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->path, PDO::PARAM_STR);
        $consulta->execute();

        if (($consulta->rowCount())>0) {
            $retorno = true;
        }

        return $retorno;        
    }

    //Traer: retorna un array de objetos de tipo Televisor, recuperados de la base de datos.
    public function Traer()
    {
        $televisores = array();
        $objetoAccesoDato =AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores");
        $consulta->execute();

        while($fila = $consulta->fetch())
        {
          $tele= new Televisor($fila[1], $fila[2], $fila[3], $fila[4]);    //no guardo el id
          array_push($televisores, $tele);
        }
        return $televisores;
    }

    // CalcularIVA: retorna el precio del televisor más el 21%.
    public function CalcularIva()
    {
        if($this->precio != ""){
            $IVA = $this->precio * 21 / 100;            
            return ($this->precio + $IVA);
        }else{
            return "Sin datos //";
        }
    }


//I3
    //Modificar: Modifica en la base de datos el registro coincidente con la instancia actual. 
    //Retorna true, si se pudo modificar, false, caso contrario.
    public function Modificar($id, $televisor)  //lo hago haciendo que reciba una id y un televisor
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();                                                 
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE televisores SET tipo=:tipo, precio=:precio, 
                        pais=:pais, foto=:foto WHERE id=:id");
                                                     
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);  

        $consulta->bindValue(':tipo', $televisor->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $televisor->precio, PDO::PARAM_INT);
        $consulta->bindValue(':pais', $televisor->paisOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $televisor->path, PDO::PARAM_STR);
        $consulta->execute();

        if($consulta->rowCount() > 0)
        {
            $retorno = true;
        }
        return $retorno;
    }


//I4
    //Eliminar: elimina de la base de datos el registro coincidente con la instancia actual. 
    //Retorna true, si se pudo eliminar, false, caso contrario.
    public function Eliminar($tipo)  //lo hago haciendo que reciba un tipo
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM televisores WHERE tipo=:tipo");
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
        if($consulta->rowCount() > 0)
        {
            $retorno = true;
        }

        return $retorno;
    }
///
    //funcion para traer televisor por id
    public function TraerId($id)
    {
        $usuario = null;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE id=:id");
        $consulta->bindValue(':id',  $id, PDO::PARAM_INT);
        $consulta->execute();
        $fila = $consulta->fetch();
        if($fila !== null){
            $televisorRet = new Televisor($fila[1],$fila[2],$fila[3],$fila[4]);
        }
        return $televisorRet;
    }

    public function TraerTipo($tipo)
    {
        $usuario = null;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE tipo=:tipo");
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
        $fila = $consulta->fetch();
        if($fila !== null){
            $televisorRet = new Televisor($fila[1],$fila[2],$fila[3],$fila[4]);
        }
        return $televisorRet;
    }

}




>>>>>>> 9e4f664727e3ad9ace1373f9fb9008d508c21fd3
?>