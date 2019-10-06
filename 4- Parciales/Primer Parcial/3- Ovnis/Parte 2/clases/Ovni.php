<?php 
require_once "IParte2.php";
require_once "AccesoDatos - aliens_bd.php";

class Ovni implements IParte2
{
    //atributos publicos
    public $tipo;
    public $velocidad;
    public $planetaOrigen;
    public $pathFoto;

    //contructor con todos los parametros opcionales
    public function __construct($tipo = null, $velocidad = null, $planetaOrigen = null, $pathFoto = null)
    {
        $this->tipo = $tipo != null ? $tipo : "";
        $this->velocidad = $velocidad != null ? $velocidad : "";
        $this->planetaOrigen = $planetaOrigen != null ? $planetaOrigen : "";
        $this->pathFoto = $pathFoto != null ? $pathFoto : "";
    }

    //metodos instancia
    public function ToJson()
    {
        $retornoJson = new stdClass();
        $retornoJson->tipo = $this->tipo;
        $retornoJson->velocidad = $this->velocidad;
        $retornoJson->planeta = $this->planetaOrigen;
        $retornoJson->path = $this->pathFoto;
        return json_encode($retornoJson);
    }

//I2

    // Agregar: agrega, a partir de la instancia actual, un nuevo registro en la tabla ovnis 
    //(id, tipo, velocidad, planeta, foto), de la base de datos aliens_bd. 
    //Retorna true, si se pudo agregar, false, caso contrario.
    public function Agregar(){
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso(); //no inserto el id porque es AI
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO ovnis (tipo, velocidad, planeta, foto)"
                                                    . "VALUES(:tipo, :velocidad, :planeta, :foto)");                                          
        
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':velocidad', $this->velocidad, PDO::PARAM_INT);
        $consulta->bindValue(':planeta', $this->planetaOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->pathFoto, PDO::PARAM_STR);
        $consulta->execute();

        if (($consulta->rowCount())>0) {
            $retorno = true;
        }

        return $retorno;  
    }

    // ● Traer: retorna un array de objetos de tipo Ovni, recuperados de la base de datos.
    public function Traer()
    {
        $ovnis = array();
        $objetoAccesoDato =AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM ovnis");
        $consulta->execute();

        while($fila = $consulta->fetch())
        {
          $ovn= new Ovni($fila[1], $fila[2], $fila[3], $fila[4]);    //no guardo el id
          array_push($ovnis, $ovn);
        }
        return $ovnis;
    }

    // ● ActivarVelocidadWarp: retorna la velocidad del ovni multiplicada por 10.45 JULES.
    public function ActivarVelocidadWarp()
    {
        return $this->velocidad * 10.45;
    }




}

?>