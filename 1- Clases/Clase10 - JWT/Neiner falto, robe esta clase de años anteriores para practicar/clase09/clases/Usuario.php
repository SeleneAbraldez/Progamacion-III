<?php
class Usuario
{
    public $nombre;
    public $division;
    public $apellido;

    public function __construct($nombre=null,$apellido=null,$division=null)
    {
      $this->nombre=$nombre;
      $this->division = $division;
      $this->apellido=$apellido;
    }


    public static function Verificar($user)
    {
        $retorno = false;
        $arrayUsuarios= Usuario::TraerTodos();
        foreach($arrayUsuarios as $us)
        {
           
            if($user->nombre ==$us->nombre && $user->division==$us->division && $user->apellido ==$us->apellido )
            {
                $retorno=true;
                break;
            }
        }
        return $retorno;
    }


    private static function TraerTodos()
    {
        $arrayUsuarios=[];
        $ar=fopen("./archivos/usuarios.txt","r");

        while(!feof($ar))
        {
            $cadena=fgets($ar);

            if($cadena=="")
            {
                continue;
            }

            $divido=explode("-",$cadena);

            //para que lo ultimo en leer no tenga el "\r\n"
            $ultimo = explode("\r\n",$divido[2]);

            //Si lo hacemos de esta manera tenemos un usuario con Json
           /* $usuario=new stdClass();
            $usuario->nombre=$divido[0];
            $usuario->apellido=$divido[1];
            $usuario->division = trim($ultimo[0]);*/

            $usuario= new Usuario($divido[0],$divido[1],$ultimo[0]);

            array_push($arrayUsuarios,$usuario);
        }
        fclose($ar);
        return $arrayUsuarios;
    }

    public static function TraerListado()
    {
        $arrayUsuarios=Usuario::TraerTodos();

        $tabla="";

        $tabla .= "<table border=1>";
        $tabla .= "<thead>";
        $tabla .= "<tr>";
        $tabla .= "<td>Nombre</td>";
        $tabla .= "<td>Apellido</td>";
        $tabla .= "<td>Division</td>";
        $tabla .= "</tr>";
        $tabla .= "</thead>";

        foreach($arrayUsuarios as $us)
        {
            $tabla .= "<tr>";
            $tabla .= "<td>";
            $tabla .= $us->nombre;
            $tabla .= "</td>";
            $tabla .= "<td>";
            $tabla .=$us->apellido;
            $tabla .= "</td>";
            $tabla .= "<td>";
            $tabla .= $us->division;
            $tabla .= "</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";

        return $tabla;

    }

}



?>