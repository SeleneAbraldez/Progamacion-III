<?php

class media
{
  public $ID; 
  public $color;
  public $marca;
  public $precio;
  public $talle;


//PARTE 1
  //-alta-
  public function AltaMediaApi($request, $response){ 
    //obtengo los parametros
    $array = $request->getParsedBody();
    $med = new media();

    $med->color = $array["color"];
    $med->marca = $array["marca"];
    $med->precio = $array["precio"];
    $med->talle = $array["talle"];

    $std= new stdclass();

    if($med->AltaMediaBD($med)){
        $std->exito = true;
        $std->mensaje = "Media se ha agregado!";
        $std->media = $med;
    }else{
        $std->exito = false;
        $std->mensaje = "ERROR! Media no se ha  podido agregar!";
    }
    // $retorno = $response->withJson($std, 200);
    // return $retorno;
    return $response->getBody()->write($std->mensaje);

  }

  public static function AltaMediaBD($media)
  {
      $retorno = false;
      $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();    

      $consulta =$objetoAccesoDato->RetornarConsulta ("INSERT INTO `medias`(`color`, `marca`, `precio`, `talle`)
      VALUES (:color, :marca, :precio, :talle)");               
      $consulta->bindValue(':color', $media->color, PDO::PARAM_STR);
      $consulta->bindValue(':marca', $media->marca, PDO::PARAM_STR);
      $consulta->bindValue(':precio', $media->precio, PDO::PARAM_STR);
      $consulta->bindValue(':talle', $media->talle, PDO::PARAM_STR);
      $consulta->execute();   

      if ($consulta->rowCount()>0) {
          $retorno = true;
      }
      return $retorno;
  }

  //-traertod-
  public function TraerTodasMedApi($request, $response, $args){
      $medias= media::TraerTodasMedBD();
      $retorno = $response->withJson($medias, 200); 
      return $retorno;
    }
  
  public static function TraerTodasMedBD()
  {    
      $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();        
      $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM medias");    
      $consulta->execute();   
      $medias = $consulta->fetchAll(PDO::FETCH_CLASS, "media");
      return $medias;         
  }

/////////




}

?>