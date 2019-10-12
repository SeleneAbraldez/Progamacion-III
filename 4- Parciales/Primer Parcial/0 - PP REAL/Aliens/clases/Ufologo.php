<?php

class Ufologo{

    //atributos privados (país, legajo y clave)
    private $_pais;
    private $_legajo;
    private $_clave;

    //constructor (que inicialice los atributos)
    public function __construct($pais, $legajo, $clave)
    {
        $this->_pais = $pais;
        $this->_legajo = $legajo;
        $this->_clave = $clave;             
    }

    //un método de instancia ToJSON(), que retornará los datos de la instancia (en una cadena con formato JSON).
    public function ToJson()
    {
        $retornoJson = new stdClass();
        $retornoJson->pais = $this->_pais;
        $retornoJson->legajo = $this->_legajo;
        $retornoJson->clave = $this->_clave;
        return json_encode($retornoJson);
    }
    
    
    // Método de instancia GuardarEnArchivo(), que agregará al ufólogo en ./archivos/ufologos.json. 
    //Retornará un JSON que contendrá: éxito(bool) y mensaje(string) indicando lo acontecido.
    public function GuardarEnArchivo()
    {
        $retornoJson = new stdClass();
        $retornoJson->exito = false;
        $retornoJson->mensaje = "No se pudo guardar en el archivo";

        $ar=fopen("./archivos/ufologos.json","a"); //abro archivo

        if($ar != false) {
            if(fwrite($ar, $this->ToJson()."\r\n")) { //escribo este ufolo por medio del metodo ToJson 
                $retornoJson->exito = true;
                $retornoJson->mensaje = "Se ha guardado ufologx con exito.";
            }
            fclose($ar);    //cierro archivo
        }

        return $retornoJson;
    }

    // Método de clase TraerTodos(), que retornará un array de objetos de tipo Ufólogo.
    public static function TraerTodos()
    {
        $retornoArray = array();
        if(file_exists("./archivos/ufologos.json")) { //si existe
            $ar = fopen("./archivos/ufologos.json", "r"); //abro archivo
            if($ar != false) {
                while(!feof($ar)) {
                    $linea = trim(fgets($ar)); //obtiene la linea sin espacios
                    if($linea != "") { //si llegamos a la linea vacia
                        $auxJson = json_decode($linea); //convierte la linea en un json para que lo lea y sea guardable en ufolo
                        $auxUfologo = new Ufologo($auxJson->pais, $auxJson->legajo, $auxJson->clave);
                        array_push($retornoArray, $auxUfologo); //agrega el ufolo leido al array
                    }
                }
                fclose($ar); //cierro el archivo
            }
        }
        return $retornoArray;
    }

    // Método de clase VerificarExistencia($ufologo), que recorrerá el array (invocar a TraerTodos) y retornará un JSON
    // que contendrá: existe(bool) y mensaje(string).
    // Si el ufólogo está registrado (legajo y clave), retornará true. Caso contrario, retornará false. En mensaje se
    // indicará lo acontecido, según corresponda.
    public static function VerificarExistencia($ufologo)
    {
        $retorno = false;
        $arrayUfologos = Ufologo::TraerTodos();
        $retornoJson = new stdClass();
        $retornoJson->exito = false;
        $retornoJson->mensaje = "Ufologx no se encuentra registradx";
        //$retorno = false;

        foreach($arrayUfologos as $ufologx){
          if($ufologx->_legajo == $ufologo->_legajo && $ufologx->_clave == $ufologo->_clave){
                //$retorno = true;
                $retornoJson->exito = true;
                $retornoJson->mensaje = "Ufologx esta registradx";
                break;
           } 
        }
        return $retornoJson;
    }



}


?>