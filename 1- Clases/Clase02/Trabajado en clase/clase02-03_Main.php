<?php
require_once "clase02-03_Producto.php";

$op = $_POST["opc"];
$nombre = $_POST["nombre"];
$codiBarra = $_POST["codiBarra"];

switch ($op) {
    case 1:
        $producto = new Producto("Tomate", "23456789");
        echo $producto->ToString();
    break;

    case 2:
        $producto = new Producto($nombre, $codiBarra);
        if(Producto::Guardar($producto)){
            echo "Archivo guardado";
        }else{ 
            echo "Archivo no se ha podido guardar";
        }
    break;

    case 3:
        $producto = new Producto($nombre, $codiBarra);
        echo Producto::TraerTodosProductos();
    break;
    
    default:
        
    break;
}

?>