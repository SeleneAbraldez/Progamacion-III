<?php

    //se utiliza una clase aparte para llamar a este codigo y no tenerlo en los add todo desprolijo
    class Verificadora
    {

        //genero un existe usuario apra verificar si usuarix esta regustrado o no
        private static function ExisteUsu($obj) 
        {
            $retorno = false;
            //abro el archivo y los leo como hemos hecho anteriormente
            $ar = fopen ("./archivos/usuarixs.txt", "r");
            while(!feof($ar)){
                $linea = trim(fgets($ar));
                $campo = explode(" - ", $linea);
                //compruebo si existe
                if ($campo[0] == $obj->nombre && $campo[2] == $obj->clave){
                    $retorno = true;
                    break;
                }                
            }
            //y cierro el archiv
            fclose($ar);
            return $retorno;
        }


        //Determinar si viene por get o por post
        //si viene por get solo avisa, si es por post recibe los aprametros pasados en un array y se fija si existe y si la cuenta es admin
        public function Verificar($request, $response, $next)
        {
            //si es por get solo avisa 
            if($request->isGet()){
                $response->getBody()->write("GET 1 ~ Clase verificadora <br>");
                $response = $next($request, $response);
                $response->getBody()->write("GET 2 ~ Clase verificadora <br>");
            }
        
            //si es por post
            if($request->isPost()){
                $response->getBody()->write("POST 1 ~ Clase verificadora <br>");

                $array = $request->getParsedBody();
                $tipo= $array['tipo'];
                $nombre= $array['nombre'];
                $clave = $array['clave'];

                $std = new stdClass();

                $std->nombre = $nombre;
                $std->clave = $clave;

                //se fija si el usuario existe
                if(Verificadora:: ExisteUsu($std)){
                    //y si es de tipo admin o no
                    if($tipo === "admin"){
                        $response->getBody()->write("Bienvenidx administradorx " . $nombre . "!! <br>");
                        $response = $next($request, $response);
                    }else{
                        $response->getBody()->write("Lo 100to, ". $nombre . " no tiene una cuenta de tipo Admin <br>");
                        $response = $next($request, $response);
                    }
                }else{
                    $response->getBody()->write("Usuarix " . $nombre . " no esta registradx <br>");
                    $response = $next($request, $response);
                }                   
            }
            return $response;
        }


    }

?>