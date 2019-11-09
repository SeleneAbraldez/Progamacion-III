<?php

class Middleware
{
    //valida que los atributos "nombre,division y apellido" esten seteados
    public static function MiddlewareUno($request,$response,$next)
    {
       
       $ArrayDeParametros=$request->getParsedBody();
       $mensajeError="";

    
       $retorno = false;
       if(isset($ArrayDeParametros['nombre']) && isset($ArrayDeParametros['apellido']) && isset($ArrayDeParametros['division']))
       {
           $retorno=true;
       }
    
       if($retorno==true)
       {
         $newResponse =$next($request,$response);
       }
       else
       {
           $objJson= new stdClass();
           $objJson->mensaje="Error no estan seteados algunos atributos";
           $response= $response->withJson($objJson,409);
           $newResponse=$response;
       }
    
        return $newResponse;  
      
    }

    //funcion que valida si los parametros "nombre,apellido y division" esten vacios dentro
    public static function MiddlewareDos($request,$response,$next)
    {
       $ArrayDeParametros=$request->getParsedBody();
  
       $retorno = true;
       if($ArrayDeParametros['nombre']=="" || $ArrayDeParametros['apellido']=="" || $ArrayDeParametros['division']=="")
       {
           $retorno=false;
       }
    
       if($retorno==true)
       {
         $newResponse =$next($request,$response);
       }
       else
       {
           $objJson= new stdClass();
           $objJson->mensaje="Error algunos parametros estan vacios";
           $response= $response->withJson($objJson,409);
           $newResponse=$response;
       }
    
        return $newResponse;  

    }
}


?>