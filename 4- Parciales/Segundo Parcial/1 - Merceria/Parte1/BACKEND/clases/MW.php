<?php

use Firebase\JWT\JWT;

class MW
{
////PARTE 1
    // (instancia) Verifique que estén “seteados” el correo y la clave.
    // Si no existe alguno de los dos (o los dos) retorne un JSON con el mensaje de error correspondiente 
    // (y status 409).
    public function VerificarSetCorreoClave($request, $response, $next)
    {
        $array = $request->getParsedBody();
        $ok = false;
        $mensajeError = "";

        if (isset($array['correo']) && isset($array['clave'])){
            $ok = true;
        }else if (isset($array['correo']) == true && isset($array['clave']) == false){
            $mensajeError = "ERROR - No esta seteada la clave!";
        }else if (isset($array['correo']) == false && isset($array['clave']) == true){
            $mensajeError = "ERROR - No esta seteado el correo!";
        }else{
            $mensajeError = "ERROR - No esta seteado ni el correo ni la clave!";
        }

        if ($ok == true){   //todo correcto pasa a la siguiente
            $newResponse = $next($request, $response);
        }else{
            $std = new stdClass();
            $std->mensaje = $mensajeError;
            $newResponse = $response->withJson($std, 409);
        }
        return $newResponse;
    }
    
    // Si alguno está vacío (o los dos) retorne un JSON con el mensaje de error correspondiente (y status 409). 
    public static function VerificarVacioCorreoClave($request, $response, $next)
    {
        $array = $request->getParsedBody();
        $mensajeError = "";
        $ok = false;

        if ($array['clave'] != "" && $array['correo'] != ""){
            $ok = true;
        }else if ($array['clave'] != "" && $array['correo'] == ""){
            $mensajeError = "ERROR - Correo esta vacio!";
        }else if ($array['clave'] == "" && $array['correo'] != ""){
            $mensajeError = "ERROR - Clave esta vacia!";
        }else{
            $mensajeError = "ERROR - Clave y Correo vacios!";
        }

        if ($ok == true){   //todo correcto pasa al siguiente
            $newResponse = $next($request, $response);
        }else{
            $std = new stdClass();
            $std->mensaje = $mensajeError;
            $newResponse = $response->withJson($std, 409);
        }

        return $newResponse;
    }

    // (instancia) Verificar que el correo y clave no existan en la base de datos. Si existen, 
    // retornar un JSON con el mensaje de error correspondiente (y status 409).
    public function VerificarBDCorreoClave($request, $response, $next)
    {
        $array = $request->getParsedBody();
        $clave = $array['clave'];
        $correo = $array['correo'];

        $ok = false;

        $user = new usuario();
        $usuarios = [];
        $usuarios = $user->TraerTodosUsuBD();

        foreach ($usuarios as $us){ //recorre todos los usuarios, y si encuentra rompe
            if ($us->clave == $clave && $us->correo == $correo){
                $ok = true;
                break;
            }
        }

        if ($ok == false){
            $std = new stdClass();
            $std->mensaje = "ERROR - Clave y correo no regsitrados en la base de datos!";
            $newResponse = $response->withJson($std, 409);
        }else{
            $newResponse = $next($request, $response);
        }

        return $newResponse;
    }
////////
    
}

?>
