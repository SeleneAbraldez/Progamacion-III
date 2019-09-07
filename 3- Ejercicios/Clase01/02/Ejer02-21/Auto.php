<?php
class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;
    
    function __construct($_marca, $color, $precio = 0.0, $fecha = "00/00/00"){
        $this->_marca  = $_marca;
        $this->_color  = $color;
        $this->_precio = $precio;
        $this->_fecha  = $fecha;
    }

    public function AgregarImpuestros($impuesto){
        $this->_precio += $impuesto;
    }

    public static function MostrarAuto($auto){
        echo "<br>Marca: ". $auto->_marca. "<br>Color: ". $auto->_color. "<br>Precio: ". $auto->_precio. "<br>Fecha: ". $auto->_fecha . "<br>";
    }

    public function Equals($a1, $a2){
        $retorno = false;
        if ($a1->_marca === $a2->_marca){
            $retorno = true;
        }
        return $retorno;
    }

    public static function Add($auto1, $auto2)
    {
        $retorno = 0;
        if ($auto1->Equals($auto1, $auto2) && $auto1->_color == $auto2->_color) {
            $retorno = $auto1->precio + $auto2->precio;
        } else {
            echo "Autos no sumables! ";
        }
        return $retorno;
    }
}

?>