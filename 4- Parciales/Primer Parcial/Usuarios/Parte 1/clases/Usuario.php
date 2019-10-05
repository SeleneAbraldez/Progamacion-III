<?php
class Usuario{

    //atributos privados
    private $_email;
    private $_clave;


    //constructor
    public function __construct($email, $clave)
    {
        $this->_email = $email;
        $this->_clave = $clave;             
    }

    //método de instancia ToJSON(), que retornará los datos de la instancia (en una cadena con formato JSON)
    public function ToJson()
    {
        $retornoJson = new stdClass();
        $retornoJson->email = $this->_email;
        $retornoJson->clave = $this->_clave;
        return json_encode($retornoJson);
    }


    //Método de instancia GuardarEnArchivo(), que agregará al usuario en ./archivos/usuarios.json.
    //Retornará un JSON que contendrá: éxito(bool) y mensaje(string)indicando lo acontecido.

    public function GuardarEnArchivo()
    {
        $retornoJson = new stdClass();
        $retornoJson->exito = false;
        $retornoJson->mensaje = "No se pudo guardar en el archivo";

        $ar=fopen("./archivos/usuarios.json","a"); //abro archivo

        if($ar != false) {
            if(fwrite($ar, $this->ToJson()."\r\n")) { //escribo este usuario por medio del metodo ToJson 
                $retornoJson->exito = true;
                $retornoJson->mensaje = "Se ha guardado usuarix con exito.";
            }
            fclose($ar);    //cierro archivo
        }

        return $retornoJson;
    }

    //Método de clase TraerTodos(), que retornará un array de objetos de tipo Usuario.
    public static function TraerTodos()
    {
        $retornoArray = array();
        if(file_exists("./archivos/usuarios.json")) { //si existe
            $ar = fopen("./archivos/usuarios.json", "r"); //abro archivo
            if($ar != false) {
                while(!feof($ar)) {
                    $linea = trim(fgets($ar)); //obtiene la linea sin espacios
                    if($linea != "") { //si llegamos a la linea vacia
                        $auxJson = json_decode($linea); //convierte la linea en un json para que lo lea y sea guardable en usuario
                        $auxUsuario = new Usuario($auxJson->email, $auxJson->clave);
                        array_push($retornoArray, $auxUsuario); //agrega el usuario leido al array
                    }
                }
                fclose($ar); //cierro el archivo
            }
        }
        return $retornoArray;
    }

    //Método de clase VerificarExistencia($usuario), retornará true, 
    //si el usuario está registrado (invocar a TraerTodos), caso contrario retornará false.

    public static function VerificarExistencia($usuario)
    {
        $retorno = false;
        $arrayUsuarios = Usuario::TraerTodos();

        foreach($arrayUsuarios as $usuarix){
          if($usuarix->_email == $usuario->_email){
               $retorno=true;
               break;
           } 
        }
        return $retorno;
    }






}
?>