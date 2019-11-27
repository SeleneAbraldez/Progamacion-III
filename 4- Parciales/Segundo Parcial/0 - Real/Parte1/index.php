<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

require_once './vendor/autoload.php';

require_once './BACKEND/clases/AccesoDatos.php';
require_once './BACKEND/clases/Auto.php';
require_once './BACKEND/clases/Usuario.php';
require_once './BACKEND/clases/login.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

///////// PARTE 1

// (POST) Alta de usuarios. Se agregará un nuevo registro en la tabla usuarios *.
// Se envía un JSON (correo, clave, nombre, apellido, perfil** y foto).
// * ID auto-incremental. ** propietario, encargado y empleado.
// Retorna un JSON (éxito: true/false; mensaje: string; status: 200/418)
$app->post('/usuarios', \Usuario::class . ':AgregarUsuApi');

// A nivel de aplicación:
// (GET) Listado de usuarios. Mostrará una tabla con el listado completo de los usuarios.
// Retorna un JSON (éxito: true/false; mensaje: string; tabla: string; status: 200/424)
$app->get('[/]',\Usuario::class . ':TraerTablaUsu');

// A nivel de aplicación:
// (POST) Alta de autos. Se agregará un nuevo registro en la tabla autos *.
// Se envía un JSON (color, marca, precio y modelo).
// * ID auto-incremental.
// Retorna un JSON (éxito: true/false; mensaje: string; status: 200/418)
$app->post('[/]', \Auto::class . ':AltaAutoApi');


// A nivel de ruta (/autos):
// (GET) Listado de autos. Mostrará una tabla con el listado completo de los autos.
// Retorna un JSON (éxito: true/false; mensaje: string; tabla: string; status: 200/424)
$app->get('/autos',\Auto::class . ':TraerTablaAut');

// A nivel de ruta (/login):
// (POST) Se envía un JSON (correo y clave) y retorna un JSON (éxito: true/false; jwt: JWT (con
// todos los datos del usuario) / null; status: 200/403)
$app->post('/login', \login::class . ':LoginCC');
// (GET) Se envía el JWT y se verifica. En caso exitoso, retorna un JSON con mensaje y status 200.
// Caso contrario, retorna un JSON con mensaje y status 403
$app->get('/login', \login::class . ':LoginVerificarJWT');

///////////////////


$app->run();


?>