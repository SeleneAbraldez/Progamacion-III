<?php

class media
{
    public $ID;
    public $color;
    public $marca;
    public $precio;
    public $talle;


    //PARTE 1
    //agrego un tojson para pasarlo str sin id y con id
    public function ToJson()
    {
        return '{"ID":"'.$this->ID.'","color":"'.$this->color.'","marca":"'.$this->marca.'","precio":'.$this->precio.',"talle":"'.$this->talle.'"}';
    }

    public function ToJsonSinID()
    {
        return '{"color":"'.$this->color.'","marca":"'.$this->marca.'","precio":'.$this->precio.',"talle":"'.$this->talle.'"}';
    }
    //


    //PARTE 1
    //-alta-
    public function AltaMediaApi($request, $response)
    {
        //obtengo los parametros
        $array = $request->getParsedBody();
        $med = new media();

        $med->color = $array["color"];
        $med->marca = $array["marca"];
        $med->precio = $array["precio"];
        $med->talle = $array["talle"];

        $std= new stdclass();

        if ($med->AltaMediaBD($med)) {
            $std->exito = true;
            $std->mensaje = "Media se ha agregado!";
            $std->media = $med;
        } else {
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

        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `medias`(`color`, `marca`, `precio`, `talle`)
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
    public function TraerTodasMedApi($request, $response, $args)
    {
        $medias= media::TraerTodasMedBD();
        $encargado = $request->getAttribute('encargado');
        $propietario = $request->getAttribute('propietario');
        if (isset($args['id'])) {
            $id = $args['id'];
        }
        $arraycolores = array();

        //abro json
        $mediasfinalstr = "[ ";

        //medias
        foreach ($medias as $med) {
            if ($mediasfinalstr != "[ ") {
                $mediasfinalstr .= ", ";
            }
            
            //PARTE 3 -  agrego, si el que recibe es unx encargadx retorna datos sin id
            if($encargado){
                $mediasfinalstr .= $med->ToJsonSinID();
                //agrego el array de colores para usarlo luego
                array_push($arraycolores, $med->color);
            }elseif ($id && $propietario) { //PARTE 3 - si es unx propietarix y pasa id, se muetra solo ese
                if ($med->ID == $id) {
                    $mediasfinalstr.= $med->toJson();
                    break;
                } else {
                    continue;
                }
            } else {
                $mediasfinalstr .= $med->ToJson();
            }
        }

        //colores
        if ($encargado) {
            //genero los colores eliminando los repetidos del array colores, los imprimo y luego los cuento 
            $colores = array_unique($arraycolores);    
            // $mediasfinalstr .= ', { "colores" : ';
            // foreach($colores as $col){
            //     $mediasfinalstr .=  $col . ", ";
            // }
            // rtrim($mediasfinalstr, ", ");
            // $mediasfinalstr .= ' }';
            $mediasfinalstr .= ', { "cantidad de colores distintos" : ' . count($colores) . ' }';
        }
  
        //cierre
        $mediasfinalstr .= " ]";

        $retorno = $response->withJson(json_decode($mediasfinalstr), 200);
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
    ///PARTE 2
    // -eliminar-
    public function EliminarMedApi($request, $response, $args)
    {
        $array = $request->getParsedBody();
        $ID = $array['ID'];
        $med = new media();
        $med->ID = $ID;

        $std= new stdclass();

        if ($usu->EliminarUsu($ID)) {
            $std->exito = true;
            $std->mensaje = "Media se ha borrado";
        } else {
            $std->exito = false;
            $std->mensaje = "ERROR - Media no se ha podido borrar!";
        }
        // $retorno = $response->withJson($std, 200);
        // return $retorno;
        return $response->getBody()->write($std->mensaje);
    }

    public static function EliminarMedBD($ID)
    {
        $retorno = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM medias WHERE ID = :ID");
        $consulta->bindValue(':ID', $ID, PDO::PARAM_INT);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $retorno = true;
        }
        return $retorno;
    }

    // -modificar-
    public function ModificarMedApi($request, $response, $args)
    {
        $array = $request->getParsedBody();
        $med = new media();

        $ID = $array['ID'];

        $med->color = $array["color"];
        $med->marca = $array["marca"];
        $med->precio = $array["precio"];
        $med->talle = $array["talle"];

        $std= new stdclass();

        if ($med->ModificarMedBD($ID, $med)) {
            $std->exito = true;
            $std->mensaje = "Media se ha modificado";
        } else {
            $std->exito = false;
            $std->mensaje = "ERROR - Media no se ha podido modificar!";
        }
        // $retorno = $response->withJson($std, 200);
        // return $retorno;
        return $response->getBody()->write($std->mensaje);
    }

    public static function ModificarMedBD($ID, $producto)
    {
        $retorno = 0;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE medias SET color=:color, 
       marca=:marca, precio=:precio, talle=:talle WHERE ID=:ID");
                                                       
        $consulta->bindValue(':ID', $ID, PDO::PARAM_INT);
       
        $consulta->bindValue(':color', $producto->color, PDO::PARAM_STR);
        $consulta->bindValue(':marca', $producto->marca, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $producto->precio, PDO::PARAM_STR);
        $consulta->bindValue(':talle', $producto->talle, PDO::PARAM_STR);

        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            $retorno = 1;
        }
        return $retorno;
    }
}
