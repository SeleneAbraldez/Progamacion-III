<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado</title>
</head>
<body>
    <?php
    //(GET) Se mostrará el listado completo de los ovnis (obtenidos de la base de datos) en una tabla (HTML con cabecera). 
    require_once "./clases/Ovni.php";
    $ovni = new Ovni("t", "p", "po");
    //Invocar al método Traer. 
    $arrayOvnis = $ovni->Traer();
    if($arrayOvnis!==null && count($arrayOvnis)!==0)
    {
        echo "<div>
        <table border=1>
            <thead>
                <tr>
                    <td>Tipo</td>
                    <td>Velocidad</td>
                    <td>Velocidad Con Warp</td> 
                    <td>Planeta de Origen</td>
                    <td>Imagen</td>
                </tr>
            </thead>";    
        foreach($arrayOvnis as $ovn)
        {
            echo "<tr>";
                echo "<td>" . $ovn->tipo . "</td>";
                echo "<td>" . $ovn->velocidad . "</td>";
                //Mostrar, además, una columna extra con las velocidades Warp incluidas.
                echo "<td>" . $ovn->ActivarVelocidadWarp() . "</td>";
                echo "<td>" . $ovn->planetaOrigen . "</td>";
                echo "<td>";
                if($ovn->pathFoto != "")
                {
                    if(file_exists("./ovnis/imagenes/".$ovn->pathFoto)) {
                        echo '<img src="./ovnis/imagenes/'.$ovn->pathFoto.'" alt=./ovnis/imagenes/"'.$ovn->pathFoto . '" height="100px" width="100px">'; 
                    }else{
                        echo 'No hay imagen guardada en '. $ovn->pathFoto; 
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