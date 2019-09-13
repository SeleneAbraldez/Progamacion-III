<?php
    require_once "Producto.php";
    require_once "Archivo.php";

    $nombre = $_POST["nombre"];
    $codiBarra = $_POST["codiBarra"];
    $rutaFoto = "Archivos/" . $_FILES["foto"]["name"];

    $producto = new Producto($nombre, $codiBarra, $rutaFoto);
    if(Archivo::subir() == true){
        if(Producto::guardar($producto->toString()) == true){
            echo($producto->toString() . " se ha guardado correctamente.");
        }
    }

    echo("<br><h4 align='center'>Lista de animales:</h4>");
    echo("<table border=2 align='center' cellpadding='10px'>");
    echo("<tr> <th>Nombre</th> <th>Codigo de barra</th> <th>Foto</th> </tr>");
    foreach(Producto::traerTodosLosProductos() as $produ)
    {
        $nombre = explode(" - ", $produ->toString())[0];
        $codiDeBarra = explode(" - ", $produ->toString())[1];
        $foto = explode(" - ", $produ->toString())[2];

        echo("<tr>");
        echo("<td>" . $nombre . "</td>");
        echo("<td>" . $codiDeBarra . "</td>");
        echo("<td> <img src='./" . $foto . "' height=50 width=50> </td>");
        echo($foto);
        echo("</tr>");
    }
    echo("</table>");
?>