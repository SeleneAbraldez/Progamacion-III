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
    //Se mostrará el listado completo de los juguetes (obtenidos de la base de datos) en una tabla (con cabecera). 
    require_once "./clases/Juguete.php";
    $juguete = new Juguete("t", "p", "po");
    //Invocar al método Traer. 
    $arrayJugue = $juguete->Traer();
    if($arrayJugue!==null && count($arrayJugue)!==0)
    {
        echo "<div>
        <table border=1>
            <thead>
                <tr>
                    <td>Tipo</td>
                    <td>Precio</td>
                    <td>Precio con IVA</td> 
                    <td>Pais</td>
                    <td>Imagen</td>
                </tr>
            </thead>";    
        foreach($arrayJugue as $jugue)
        {
            echo "<tr>";
                echo "<td>" . $jugue->GetTipo() . "</td>";
                echo "<td>" . $jugue->GetPrecio() . "</td>";
                //Mostrar además, una columna extra con los precios con IVA incluido.
                echo "<td>" . $jugue->CalcularIva() . "</td>";
                echo "<td>" . $jugue->GetPais() . "</td>";
                echo "<td>";
                if($jugue->GetPath() != "")
                {
                    if(file_exists("./juguetes/imagenes/".$jugue->GetPath())) {
                        echo '<img src="./juguetes/imagenes/'.$jugue->GetPath().'" alt=./juguetes/imagenes/"'.$jugue->GetPath() . '" height="100px" width="100px">'; 
                    }else{
                    echo 'no hay imagen guardada '. $jugue->GetPath(); 
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