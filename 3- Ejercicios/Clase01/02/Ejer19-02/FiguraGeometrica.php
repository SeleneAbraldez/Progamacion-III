<?php

abstract class FiguraGeometrica {

    #atributos
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    #contructor
    public function __construct(){
        //$this->_color = "red";
        $this->_color = "#4F054F";
        $this->_perimetro = 0;
        $this->_superficie = 0;
    }

    #get & set color
    public function GetColor(){
        return $this->_color;
    }

    public function SetColor($_color){
        $this->_color = $_color;
    }

    #metodos
    public function ToString()
    {
        return "Color:". $this->GetColor(). "<br>Perimetro: ". $this->_perimetro. "<br>Superficie:". $this->_superficie;
    }

    protected abstract function CalcularDatos();

    public abstract function Dibujar();
}

?>