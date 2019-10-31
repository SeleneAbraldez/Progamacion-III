<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
//agrego la clase verificadora
require_once './clases/verificadora.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

//1
//genero un grupo con credenciales, en donde el add se agrega al grupo
$app->group('/credenciales', function(){

  $this->post('/', function ($request, $response, $args) { 
    $response = $response->getBody()->write("POST ~ Grupo credenciales API <br>");
    return $response;
  });

  $this->get('/', function ($request, $response, $args) { 
    $response = $response->getBody()->write("GET ~ Grupo credenciales API <br>");
    return $response;  
  });

})->add(function($request, $response, $next){
  //se fija depende que metodo sea
  if($request->isGet()){
    //son acciones antes de invocar la api
    $response->getBody()->write("GET 1 <br>");
    //la invoco
    $response = $next($request, $response); 
    //y hago acciones despues
    $response->getBody()->write("GET 2 <br>");
  }else if ($request->isPost()) {
    //hago lo mismo con el post
    $response->getBody()->write("POST 1 <br>");
    $response = $next($request, $response);
    $response->getBody()->write("POST 2 <br>");
  }
  return $response;
});


//tambien se puede hacer que el add este de forma particular en cada tipo
$app->group('/params', function () {

  $this->post('/',function (Request $request, Response $response){
      return $response->getBody()->write("Grupo POST ~> API <br>");
  })->add(function($request, $response, $next){
      $response->getBody()->write("POST 1 <br>");
      $response = $next($request, $response);
      $response->getBody()->write("POST 2 <br>");
      return $response;
  });

  $this->get('/',function (Request $request, Response $response){
      return $response->getBody()->write("Grupo GET ~> API <br>");
  })->add(function($request, $response, $next){
      $response->getBody()->write("GET 1 <br>");
      $response = $next($request, $response);
      $response->getBody()->write("GET 2 <br>");
      return $response;
  });
});

//2
//si llama a la clase verificadora para que no este todo el codigo aca, para que quede mas ordenado y lindo
$app->group('/credenciales/POO', function () {

  $this->get('/', function ($request, $response, $args) {
      return $response->getBody()->write("Credenciales POO ~ GET <br>");
  });

  $this->post('/', function ($request, $response, $args) {
      return $response->getBody()->write("Credenciales POO ~ POST <br>");
  });
})->add(\Verificadora::class . ":Verificar");










//esta linea es la que hace que funcione todo, ojo al piojo
$app->run();

//ojo con poner espacios en als rutas de las carpetas, puede que no encuentre la ruta