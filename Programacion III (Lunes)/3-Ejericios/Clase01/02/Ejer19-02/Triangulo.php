<?php
require_once "FiguraGeometrica.php";
class Rectangulo extends FiguraGeometrica {

    #atributos
    private $_altura;
    private $_base;

    #contructor
    public function __construct($h, $b){
        $this->_altura = $h;
        $this->_base = $b;
    }

    #metodos
    public function ToString()
    {
        return parent::ToString(). "<br>Altura:". $this->_altura. "<br>Base: ". $this->_base;
    }

    protected function CalcularDatos(){
        $this->_perimetro=($this->_ladoUno * 2) + ($this->_ladoDos * 2);
        $this->_superficie=(($this->_base * $this->_altura) / 2);
    }

    public function Dibujar(){

    }
}

?>