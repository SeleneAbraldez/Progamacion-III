<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filtrado</title>
</head>

<body>
    <?php
    require_once "./clases/Televisor.php";

// Se recibe por POST el tipo, se mostrarán en una tabla (HTML) los televisores cuyo tipo coincidan con el pasado por parámetro.
// Si se recibe por POST el paisOrigen, se mostrarán en una tabla (HTML) los televisores cuyo país de origen coincida con el pasado por parámetro.
// Si se recibe por POST el tipo y el paisOrigen, se mostrarán en una tabla (HTML) los televisores cuyo tipo y país de origen coincidan con los pasados por parámetro.

    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;

    if(isset($_POST["tipo"]) && isset($_POST["pais"]))
    {
        $televisores = array();
        $objetoAccesoDato =AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE pais=:pais AND tipo=:tipo");
        $consulta->bindValue(':tipo', $_POST["tipo"], PDO::PARAM_STR);
        $consulta->bindValue(':pais', $_POST["pais"], PDO::PARAM_STR);
        $consulta->execute();

        while($fila = $consulta->fetch())
        {
          $tele= new Televisor($fila[1], $fila[2], $fila[3], $fila[4]);
          array_push($televisores, $tele);
        }
    }
    else if(isset($_POST["tipo"]))
    {
        $televisores = array();
        $objetoAccesoDato =AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE tipo=:tipo");
        $consulta->bindValue(':tipo', $_POST["tipo"], PDO::PARAM_STR);
        $consulta->execute();

        while($fila = $consulta->fetch())
        {
          $tele= new Televisor($fila[1], $fila[2], $fila[3], $fila[4]);
          array_push($televisores, $tele);
        }
    }
    else if(isset($_POST["pais"]))
    {
        $televisores = array();
        $objetoAccesoDato =AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores WHERE pais=:pais");
        $consulta->bindValue(':pais', $_POST["pais"], PDO::PARAM_STR);
        $consulta->execute();

        while($fila = $consulta->fetch())
        {
          $tele= new Televisor($fila[1], $fila[2], $fila[3], $fila[4]);
          array_push($televisores, $tele);
        }
    }
    
    if($televisores!==null && count($televisores)!==0)
    {
        echo "<div>
                <table border=1>
                    <thead>
                        <tr>
                            <td>Tipo</td>
                            <td>Precio</td>
                            <td>Precio (iva)</td>
                            <td>Pais</td>
                            <td>Imagen</td>
                        </tr>
                    </thead> ";
        foreach($televisores as $tele)
        {
            echo "<tr>";
            echo "<td>" . $tele->tipo . "</td>";
            echo "<td>" . $tele->precio . "</td>";
            echo "<td>" . $tele->CalcularIva() . "</td>";
            echo "<td>" . $tele->paisOrigen . "</td>";
            echo "<td>";
            if($tele->path != "")
            {
                if(file_exists("./televisores/imagenes/".$tele->path)) {
                    echo '<img src="./televisores/imagenes/'.$tele->path.'" alt=./televisores/imagenes/"'.$tele->path.'" height="100px" width="100px">'; 
                }else{
                echo 'no hay imagen guardada '. $tele->path; 
                }
            }else{
                echo "Sin datos //";
            }
            echo "</td>";
        echo "</tr>";
        }
     echo "</table>
    </div>";
    }
    ?>
</body>

</html>