<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

require_once './vendor/autoload.php';

//require_once '/clases/AccesoDatos.php';
//require_once '/clases/cd.php';
require_once './clases/Usuario.php';
require_once './clases/middleware.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

//*********************************************************************************************//
//INICIALIZO EL APIREST
//*********************************************************************************************//
$app = new \Slim\App(["settings" => $config]);

//*********************************************************************************************//
//CONFIGURO LOS VERBOS GET, POST, PUT Y DELETE
//*********************************************************************************************//


$app->post('/crear', function (Request $request, Response $response) 
{   

    //datos que vamos a guardar en el payload
    $user= new stdClass();
    $user->nombre="ema";
    $user->apellido="villamayor";
    $user->division="3A";

    $ahora=time();

    //creamos el payload pasandole un usuario
    $payload = array(
       // 'iat'=>$ahora,  OPCIONALES
     //   'exp'=>$ahora+100, OPCIONALES
        'data'=>$user,
        'app'=>"API REST 2019",
    );

    //retornamos el jwt con la clave
   $token = JWT::encode($payload,"miClaveSuperSecreta");

    return $response->withJson($token,200);

});

$app->post('/verificar', function (Request $request, Response $response) 
{
    $ArrayDeParametros=$request->getParsedBody();
    $token = $ArrayDeParametros['token'];

    if(empty($token)  || $token==="")
    {
        throw new Exception("El token esta vacio!");
    }

    try
    {
        $decodificado=JWT::decode(
            $token,
            //tenemos que pasarle la clave tambien con la que lo guardamos
            "miClaveSuperSecreta",
            ['HS256']
        );

    }
    catch(Exception $e)
    {
        throw new Exception ("Token no valido!!! -->" .$e->getMessage() );
    }

    return "Token OK!!";

});

$app->post('/obtenerPayload', function (Request $request, Response $response) 
{
    $ArrayDeParametros=$request->getParsedBody();
    $token = $ArrayDeParametros['token'];

    if(empty($token)  || $token==="")
    {
        throw new Exception("El token esta vacio!");
    }

    try
    {
        
        $decodificado=JWT::decode(
            $token,
            //tenemos que pasarle la clave tambien con la que lo guardamos
            "miClaveSuperSecreta",
            ['HS256']
        );

        //obtengo los datos del usuario que venian dentro del JWT en el atributo propio "data"
        $usuario= $decodificado->data;
    }
    catch(Exception $e)
    {
        throw new Exception ("Token no valido!!! -->" .$e->getMessage() );
    }

   
 return  $response->withJson($usuario,200);

});

$app->group('/JWT', function () 
{

    $this->post('/verificar', function ($request, $response, $args) 
    {
        $ArrayDeParametros=$request->getParsedBody();

        $nombre=$ArrayDeParametros['nombre'];
        $apellido=$ArrayDeParametros['apellido'];
        $division =$ArrayDeParametros['division'];

        $usuario = new Usuario($nombre,$apellido,$division);

        if(Usuario::Verificar($usuario))
        {
            //creamos el payload con los datos del usuario
            $payload = array(
                 'data'=>$usuario
             );
         
             //retornamos el jwt con la clave
            $token = JWT::encode($payload,"miClaveSuperSecreta");
         
             return $response->withJson($token,200);

        }
        else
        {
            $objJson= new stdClass();
            $objJson->mensaje="Error , usuario erroneo";
            return $response->withJson($objJson,409);
        }

        //el ultimo add va a ser el primero en ejecutarse
    })->add(\Middleware::class . '::MiddlewareDos')->add(\Middleware::class . '::MiddlewareUno');

    $this->post('/mostrar', function ($request, $response, $args) 
    {
        $ArrayDeParametros=$request->getParsedBody();

        $objJson = new stdClass();
        $objJson->mensaje="";

        $token = $ArrayDeParametros['token'];

        if(empty($token)  || $token==="")
        {
         return  $objJson->mensaje="el token esta vacio";
        }

        try
        {
            
            $decodificado=JWT::decode(
                $token,
                //tenemos que pasarle la clave tambien con la que lo guardamos
                "miClaveSuperSecreta",
                ['HS256']
            );

            //obtengo los datos del usuario que venian dentro del JWT en el atributo propio "data"
          $tabla= Usuario::TraerListado();
        }
        catch(Exception $e)
        {
         return $objJson->mensaje=$e->getMessage();
        }

    
        //return  $response->withJson($tabla,200);
        return $tabla;


    });


});

$app->run();