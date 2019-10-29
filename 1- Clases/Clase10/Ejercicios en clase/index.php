<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
-La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

/* ******************************
GET, POST, PUT Y DELETE
******************************* */

//por convencion se usa request y response, aun si no se usan
$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenidx!!! a SlimFramework");
    return $response;
});

//cuando alog esta en [] significa que es opcional
$app->post('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("POST => Bienvenidx!!! a SlimFramework");
  return $response;
});

//se le podria poner en vez de especificar put delete etc any, lo qie toma cualquier valor mandando no importa el
// metodo
$app->put('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("PUT => Bienvenidx!!! a SlimFramework");
  return $response;
});

//si se usan los mismo metodos, es importante mandar rutas distintas para no generar un error
$app->delete('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("DELETE => Bienvenidx!!! a SlimFramework");
  return $response;
});


/*
    Recuperando parametros
*/

//de forma obligatoria hay que pasar el nombre y opcional el apellido, chequeando si esta seteado
$app->get('/parametros/{nombre}[/{apellido}]', function ($request, $response, $args) { 
  $nombre=$args['nombre']; 
  if(isset($args['apellido'])){
    $apellido=$args['apellido'];   
    $response->getBody()->write("GET => Recupero parametros nombre: $nombre y apellido: $apellido");
  }else{
    $response->getBody()->write("GET => Recupero solo parametro nombre: $nombre");
  }
  return $response;
});


//generamos un grupo de JSON, dentro de la misma ruta distintos metodos
$app->group('/JSON', function(){

  //por post recibimos los parametros
  $this->post('/', function ($request, $response, $args) { 
    $arrayParam = $request->getParsedBody();
    var_dump($arrayParam);

    $nombre= $arrayParam['nombre'];
    $apellido= $arrayParam['apellido'];

    $archivos = $request->getUploadedFiles();
    $nombreAnterior=$archivos['foto']->getClientFilename();
    $extension = explode(".", $nombreAnterior)  ;
    $extension =array_reverse($extension);

    $archivos['foto']->moveTo("./fotos/".$nombre.".".$apellido.".".date("G-i-s").".".$extension[0]);

    return $response;
  });

  //genera json con nombre y apellido
  $this->get('/{nombre}/{apellido}', function ($request, $response, $args) { 
    $jsonResp = array("nombre" => $args['nombre'], "apellido" => $args['apellido']);
    $responseJson = $response->withJson($jsonResp, 200);
    return $responseJson;  
  });
  
  //por alfguna razon hay que mandarlo por xx, ni el profe sabe porque
  $this->delete('/', function ($request, $response, $args) { 
    $arrayParam = $request->getParsedBody();
    //var_dump($arrayParam);
    $jsonDel = json_decode($arrayParam['datos']);
    //var_dump($jsonDel);
    $responseJson = new stdClass();
    //echo "<br><br>";
    $responseJson->nombre = $jsonDel->apellido;
    $responseJson->apellido = $jsonDel->nombre;
    return var_dump($responseJson);  
  });
});



//genero un grupo con
$app->group('/Credenciales', function(){

  $this->post('/', function ($request, $response, $args) { 
    $response = $response->getBody()->write("POST!");
    return $response;
  });

  $this->get('/', function ($request, $response, $args) { 
    $response = $response->getBody()->write("GET!");
    return $response;  
  });

})->add(function($request, $response, $next){
  if($request->isGet()){
    $response = $response->getBody()->write("GET 1");
    $response = $next($request, $response); 
    $response = $response->getBody()->write("GET 2");
  }else if ($request->isPost()) {
    $response = $response->getBody()->write("POST 1");
    $response = $next($request, $response);
    $response = $response->getBody()->write("POST 2");
  }
  return $response;
});












//esta linea es la que hace que funcione todo, ojo al piojo
$app->run();



//ojo con poner espacios en als rutas de las carpetas, puede que no encuentre la ruta

//usamos el htacces para hacer el redirecceo directo