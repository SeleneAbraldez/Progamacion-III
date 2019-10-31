<?php
    class Producto{
        private $_nombre;
        private $_codiBarra;
        private $_rutaFoto;
    
        public function __construct ($n=null, $c=null, $r=null){
            if($n!=null){
                $this->_nombre = $n;
            }  
            if($c!=null){
                $this->_codiBarra = $c;
            }       
            if($r!=null){
                $this->_rutaFoto = $r;
            }
        }

        public function ToString(){
            return $this->_nombre.  " - ". $this->_codiBarra . " - " . $this->_rutaFoto . "\n";
        }
    
        public static function Guardar($obj) : bool {
            $retorno = FALSE;
    
            $ruta = "./Archivos/Productos.txt";
            
            $archivo = fopen($ruta, "a+");
            if(fwrite($archivo, $obj) != 0){
                $retorno = TRUE;
            }

            fclose($archivo);
            return $retorno;
        }
    
        public static function TraerTodosLosProductos() : array {
            $retorno = [];
            $ruta = "./Archivos/Productos.txt";
    
            $archivo = fopen($ruta, "r+");
            while(!feof($archivo)){
                $datos = fgets($archivo);
                $elemento = explode(" - ", $datos);
                if($elemento[0] != ""){ //no pude lograr que funque con isset pero seria mejor
                    $produ = new Producto($elemento[0], $elemento[1], $elemento[2]);
                    array_push($retorno, $produ);
                }
            }         
            fclose($archivo);
            return $retorno;
        }    
    }
?>