<?php 

require_once "./clases/Ovni.php";
// Se recibe por POST el objeto de tipo Ovni (en formato de cadena JSON), si coincide con algún
$jsonVerificar = isset($_POST['jsonVerificar']) ? $_POST['jsonVerificar'] : NULL;
$jsonVerificar = json_decode($jsonVerificar);
$tipo = $jsonVerificar->tipo;
$velocidad = $jsonVerificar->velocidad;
$planeta = $jsonVerificar->planeta;

$ovni = new Ovni($tipo, $velocidad, $planeta);

// registro de la base de datos (invocar al método Traer)
$arrayOvnis = $ovni->Traer();

//retornar los datos del objeto (invocar al ToJSON). 
if($ovni->Existe($arrayOvnis)){
    echo $ovni->ToJson();
}else{ //Caso contrario informar lo acontecido.
    echo "No coincide el ovni";
}
?>