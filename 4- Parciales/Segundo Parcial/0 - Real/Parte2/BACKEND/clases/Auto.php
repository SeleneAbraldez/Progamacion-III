<?php

class Auto
{
  public $id;
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
          $tabla = "<table border=1><tr><td>COLOR<td>MARCA<td>PRECIO<td>MODELO";
          foreach ($autos as $auto) {
              $tabla .= "<tr><td>" . $auto->color . "<td>" . $auto->marca . "<td>" . $auto->precio .  "<td>" . $auto->modelo . "";
          }
          $std->exito = true;
          $std->mensaje = "Tabla correcta!";
          $std->tabla = $tabla;
          $retorno = $response->write(json_encode($std));
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

// -eliminar-
public function EliminarAutApi($request, $response, $args)
{
    $array = $request->getParsedBody();
    $auto = new Auto();

    $id = $array['id'];

    $std= new stdclass();

    if ($auto->EliminarAutoBD($id)) {
        $std->exito = true;
        $std->mensaje = "Auto se ha borrado";
        $retorno = $response->withJson($std, 200);
    } else {
        $std->exito = false;
        $std->mensaje = "ERROR - Auto no se ha podido borrar!";
        $retorno = $response->withJson($std, 418);
    }
    return $retorno;
}

public static function EliminarAutoBD($id)
{
    $retorno = false;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM autos WHERE id = :id");
    $consulta->bindValue(':id', $id, PDO::PARAM_INT);
    $consulta->execute();
    if ($consulta->rowCount() > 0) {
        $retorno = true;
    }
    return $retorno;
}

// -modificar-
public function ModificarAutApi($request, $response, $args)
{
    $array = $request->getParsedBody();
    $auto = new Auto();

    $aut = $array['auto'];
    $aut = json_decode($aut);

    $id = $aut->id;
    $auto->color = $aut->color;
    $auto->marca = $aut->marca;
    $auto->precio = $aut->precio;
    $auto->modelo = $aut->modelo;

    $std= new stdclass();

    if ($auto->ModificarAutBD($id, $auto)) {
        $std->exito = true;
        $std->mensaje = "Auto se ha modificado";
        $retorno = $response->withJson($std, 200);
    } else {
        $std->exito = false;
        $std->mensaje = "ERROR - Auto no se ha podido modificar!";
        $retorno = $response->withJson($std, 418);
    }
    return $retorno;
}

public static function ModificarAutBD($id, $producto)
{
    $retorno = 0;
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE autos SET color=:color, 
   marca=:marca, precio=:precio, modelo=:modelo WHERE id=:id");
                                                   
    $consulta->bindValue(':id', $id, PDO::PARAM_INT);
   
    $consulta->bindValue(':color', $producto->color, PDO::PARAM_STR);
    $consulta->bindValue(':marca', $producto->marca, PDO::PARAM_STR);
    $consulta->bindValue(':precio', $producto->precio, PDO::PARAM_STR);
    $consulta->bindValue(':modelo', $producto->modelo, PDO::PARAM_STR);

    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        $retorno = 1;
    }
    return $retorno;
}



}

?>