<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

require_once './vendor/autoload.php';

require_once './BACKEND/clases/AccesoDatos.php';
require_once './BACKEND/clases/media.php';
require_once './BACKEND/clases/usuario.php';
require_once './BACKEND/clases/login.php';
require_once './BACKEND/clases/MW.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

///////// PARTE 1

// A nivel de aplicación: (POST) Alta de Medias (ID*, color, marca, precio y talle). * ID auto-incremental
$app->post('[/]', \media::class . ':AltaMediaApi');

// A nivel de ruta (/medias):(GET) Listado de todas las medias (JSON -status 200).
$app->get('/medias',\media::class . ':TraerTodasMedApi');

// A nivel de ruta (/usuarios):(POST) Alta de usuario (ID*, correo, clave, nombre, apellido, perfil** y foto).
//ID auto-incremental. ** propietario, encargado y empleado
$app->post('/usuarios', \usuario::class . ':AgregarUsuApi');

// A nivel de aplicación:(GET) Listado de usuarios (JSON -status 200)
$app->get('[/]',\usuario::class . ':TraerTodosUsuApi');

// A nivel de ruta (/login):
// (POST) Se ingresa correo y clave. (retorna un JWT -status 200)
$app->post('/login', \login::class . ':LoginCC')->add(\MW::class . ':VerificarBDCorreoClave')->add(\MW::class . '::VerificarVacioCorreoClave')->add(\MW::class . ':VerificarSetCorreoClave');
// (GET) Verifica el JWT. En caso exitoso, retorna un JSON con mensaje y status 200.
//Caso contrario, retorna un JSON con mensaje y status 409.
$app->get('/login', \login::class . ':LoginVerificarJWT');

///////////////////


$app->run();


?>