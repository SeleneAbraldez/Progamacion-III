<?php

class Auto
{
  public $color;
  public $marca;
  public $precio;
  public $modelo;


//PARTE 1
  //-alta-
  public function AltaAutoApi($request, $response){ 
    //obtengo los parametros
    $array = $request->getParsedBody();
    $auto = $array['auto'];
    $auto = json_decode($auto);
    $aut = new Auto();

    $aut->color = $auto->color;
    $aut->marca = $auto->marca;
    $aut->precio = $auto->precio;
    $aut->modelo = $auto->modelo;

    $std= new stdclass();

    if($aut->AltaAutoBD($aut)){
        $std->exito = true;
        $std->mensaje = "Auto se ha agregado!";
        $std->auto = $aut;
        $retorno = $response->withJson($std, 200);
    }else{
        $std->exito = false;
        $std->mensaje = "ERROR! Auto no se ha  podido agregar!";
    }
    return $retorno;

  }

  public static function AltaAutoBD($auto)
  {
      $retorno = false;
      $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();    

      $consulta =$objetoAccesoDato->RetornarConsulta ("INSERT INTO `autos`(`color`, `marca`, `precio`, `modelo`)
      VALUES (:color, :marca, :precio, :modelo)");               
      $consulta->bindValue(':color', $auto->color, PDO::PARAM_STR);
      $consulta->bindValue(':marca', $auto->marca, PDO::PARAM_STR);
      $consulta->bindValue(':precio', $auto->precio, PDO::PARAM_STR);
      $consulta->bindValue(':modelo', $auto->modelo, PDO::PARAM_STR);
      $consulta->execute();   

      if ($consulta->rowCount()>0) {
          $retorno = true;
      }
      return $retorno;
  }

  //-traertod-
  public function TraerTablaAut($request, $response)
  {
      $aut = new Auto();
      $autos= $aut->TraerTodosAutBD();
      $std= new stdclass();

      if($autos){
          $tabla = "<table border=1><tr><td>COLOR</td><td>MARCA</td><td>PRECIO</td><td>MODELO</td></tr>";
          foreach ($autos as $auto) {
              $tabla .= "<tr><td>" . $auto->color . "</td><td>" . $auto->marca . "</td><td>" . $auto->precio .  "</td><td>" . $auto->modelo . "</td></tr>";
          }
          $tabla .= "</table>";
          $std->exito = true;
          $std->mensaje = "Tabla correcta!";
        //   $std->tabla = $autos;
          $retorno = $response->write($tabla . "<br>" . json_encode($std));
      }else{
          $std->exito = false;
          $std->mensaje = "ERROR - TABLA";
          $retorno = $response->withJson($std, 424);
      }
      return $retorno;
  }
  
  public static function TraerTodosAutBD()
  {    
      $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();        
      $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM autos");    
      $consulta->execute();   
      $autos = $consulta->fetchAll(PDO::FETCH_CLASS, "Auto");
      return $autos;         
  }

/////////




}

?>