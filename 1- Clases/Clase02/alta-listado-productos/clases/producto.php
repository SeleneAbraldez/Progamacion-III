<?php
class Producto{
    private $_nombre;
    private $_codiBarra;

    public function __construct ($n=null, $c=null){
        if($n!=null){
            $this->_nombre = $n;
        }  
        if($c!=null){
            $this->_codiBarra = $c;
        }       
    }

    public function GetNombre(){
        return $this->_nombre;
    }

    public function GetCodBarra(){
        return $this->_codiBarra;
    }

    public function ToString(){
        return $this->_nombre.  " - ". $this->_codiBarra . "\n";
    }

    public static function Guardar($obj) : bool {
        $retorno = FALSE;

        $ruta = "productos.txt";
        $datos = $obj->ToString();
        
        $archivo = fopen($ruta, "a");
        $cant = fwrite($archivo, $datos);
        if($cant){
            $retorno = TRUE;
        }
        fclose($archivo);
        return $retorno;
    }

    public static function TraerTodosLosProductos() : array {
        $retorno = [];
        $ruta = "productos.txt";

        $archivo = fopen($ruta, "r");
        while(!feof($archivo)){
            $datos = fgets($archivo);
            if($datos=="")
            {
                continue;
            }
            $elemento = explode(" - ", $datos);
            $produ = new Producto($elemento[0], $elemento[1]);
            array_push($retorno, $produ);
        }         
        fclose($archivo);
        return $retorno;
    }

}
?>