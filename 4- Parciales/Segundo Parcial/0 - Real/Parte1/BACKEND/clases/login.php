<?php

use Firebase\JWT\JWT;

class login
{
    public static function LoginCC($request, $response, $next)
    {
        //obtengo los datos
        $array = $request->getParsedBody();
        $usu = $array['usuario'];
        $usu = json_decode($usu);

        $clave = $usu->clave;
        $correo = $usu->correo;

        $std= new stdClass();
        $ok = false;

        $usu = Usuario::ValidarUsu($correo, $clave);
        
        try{
            $tiempo = time();
            //creamos el payload pasandole un usuario
            $payload = array(
                'iat'=>$tiempo,  
                // 'exp'=>$tiempo+20,   //que dure 20
                'data'=>$usu,
                );
                    //devolvemos jtw con la clave
                $token = JWT::encode($payload, "claveSecreta");
                $ok = true;
        }catch(Exception $e){
            // 
        }

        if($ok==true && $usu!=false){
            $std->exito=true;
            $std->jwt=$token;
            $retorno = $response->withJson($std, 200);
         }else{
             $std->exito=false;
             $std->jwt=null;
             $retorno = $response->withJson($std, 403);
         }
         return $retorno;
    }

    public static function LoginVerificarJWT($request, $response, $next)
    {
        //recibe el token
        $token = $_GET['token'];
        $ok = false;

        $std= new stdClass();

        try{
            $decodificado=JWT::decode(
                $token,
                "claveSecreta",
                ['HS256']
            );
            $ok = true;
        }
        catch(Exception $e){
            $mensajeError = $e->getMessage();
        }

        if($ok==true){
           $std->mensaje="Todo Ok";
           $std->token=$decodificado;
           $retorno = $response->withJson($std, 200);
        }else{
            $std->mensaje=$mensajeError;
            $retorno = $response->withJson($std, 403);
        }
        return $retorno;
    }
}


?>