<?php
require_once "FiguraGeometrica.php";
class Rectangulo extends FiguraGeometrica {

    #atributos
    private $_ladoDos;
    private $_ladoUno;

    #contructor
    public function __construct($l1, $l2){
        $this->_ladoDos = $l2;
        $this->_ladoUno = $l1;
    }

    #metodos
    public function ToString()
    {
        return parent::ToString(). "<br>Lado Uno:". $this->_ladoUno. "<br>Lado Dos: ". $this->_ladoDos;
    }

    protected function CalcularDatos(){
        $this->_perimetro = ($this->_ladoUno * 2) + ($this->_ladoDos * 2);
        $this->_superficie = ($this->_ladoUno * $this->_ladoDos);
    }

    public function Dibujar(){

    }
}

?>