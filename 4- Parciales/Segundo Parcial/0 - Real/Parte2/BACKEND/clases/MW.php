<?php

use Firebase\JWT\JWT;

class MW
{
//(método de instancia) verifique que el token sea válido.
// Recibe el JWT a ser verificado.
// Retorna un JSON con el mensaje de error correspondiente (y status 403), en caso de no
// ser válido.
// Caso contrario, pasar al siguiente callable.
    public function VerificarToken($request, $response, $next)
    {
        $array = $request->getParsedBody();
        $token = $array["token"];

        $ok = false;

        $std= new stdClass();

        try{
            $decodificado=JWT::decode(
                $token,
                "claveSecreta",
                ['HS256']
            );
            $ok=true;
        }catch(Exception $e){
            $std->mensaje = $e->getMessage();
        }
        
        if($ok==true){
            $std->mensaje = "Todo Ok";
            $std->token = $decodificado;
            $retorno = $next($request, $response);
        }else{
            //$std->mensaje = "ERROR - Token no valido!";
            $std->token = $token;
            $retorno = $response->withJson($std, 403);
        }
        return $retorno;
    }  

    // (método de clase) verifique si es un ‘ propietario ’ o no.
    // Recibe el JWT a ser verificado.
    // Retorna un JSON con propietario: true/false; mensaje: string (mensaje correspondiente);
    // status: 200/409.
    public static function VerificarPropietario($request,$response,$next)
    {
        $array=$request->getParsedBody();
        $token = $array['token'];

        $objJson = new stdClass();

        $decodificado = JWT::decode(
            $token,
            "claveSecreta",
            ['HS256']
        );

        $usuario = $decodificado->data;
        $request = $request->withAttribute('propietario', false);

        //si el perfil es propietario pasa
        if($usuario->perfil == "propietario"){
            $newResponse = $next($request, $response);
        }else{ 
            // Si no lo es, retornar un JSON con el mensaje de error correspondiente (y status 409).
            $std= new stdClass();
            $std->mensaje="ERROR - No es de tipo propietario!";
            $newResponse= $response->withJson($std, 409);
        }
        return $newResponse;
    }

    // (método de instancia) verifique si es un ‘ encargado ’ o no.
    // Recibe el JWT a ser verificado.
    // Retorna un JSON con encargado: true/false; mensaje: string (mensaje correspondiente);
    // status: 200/409.
    public function VerificarEncargado($request, $response, $next)
    {
        $array=$request->getParsedBody();
        $token = $array['token'];

        $objJson = new stdClass();

        $decodificado = JWT::decode(
            $token,
            "claveSecreta",
            ['HS256']
        );

        $usuario = $decodificado->data;

        //si el perfil es encargado o propietario pasa
        if($usuario->perfil == "propietario" || $usuario->perfil == "encargado"){
            $newResponse = $next($request, $response);
        }else{ 
            // Si no lo es, retornar un JSON con el mensaje de error correspondiente (y status 409).
            $std= new stdClass();
            $std->mensaje="ERROR - No es de tipo encargado ni propietario!";
            $newResponse= $response->withJson($std, 409);
        }
        return $newResponse;
    }


}

?>
