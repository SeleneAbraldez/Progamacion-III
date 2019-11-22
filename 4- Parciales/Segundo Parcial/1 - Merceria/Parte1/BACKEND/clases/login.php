<?php

use Firebase\JWT\JWT;

class login
{
    public static function LoginCC($request, $response, $next)
    {
        //obtengo los datos
        $array = $request->getParsedBody();

        $clave = $array['clave'];
        $correo = $array['correo'];

        $usu = usuario::ValidarUsu($correo, $clave);
        $tiempo = time();

        //creamos el payload pasandole un usuario
        $payload = array(
            'iat'=>$tiempo,  
            'exp'=>$tiempo+20,   //que dure 20
            'data'=>$usu,
            );
        
        //devolvemos jtw con la clave
        $token = JWT::encode($payload, "claveSecreta");
        //y el status 200
        return $response->withJson($token, 200);
    }

    public static function LoginVerificarJWT($request, $response, $next)
    {
        //recibe el token
        $token = $_GET['token'];
        $ok = false;

        $std= new stdClass();

        if(empty($token)  || $token===""){
            $std->mensaje = "ERROR! - Token vacio";
        }else{
            try{
                $decodificado=JWT::decode(
                    $token,
                    "claveSecreta",
                    ['HS256']
                );
                $ok=true;
            }
            catch(Exception $e){
              $std->mensaje = $e->getMessage();
            }
        }

        if($ok==true){
           $std->mensaje="Todo Ok";
           $retorno = $response->withJson($std, 200);
        }else{
            $objJson->Mensaje=$mensajeError;
            $retorno = $response->withJson($std, 409);
        }
        return $retorno;
    }
}


?>