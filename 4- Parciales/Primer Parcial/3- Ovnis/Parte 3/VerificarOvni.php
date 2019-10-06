<?php 

require_once "./clases/Ovni.php";
// Se recibe por POST el objeto de tipo Ovni (en formato de cadena JSON), si coincide con algún
$ovniJson = isset($_POST["ovni"]) ? json_decode($_POST["ovni"]) : null;

$objOvni = new Ovni($ovniJson->tipo, $ovniJson->velocidad, $ovniJson->planeta, $ovniJson->foto);

// registro de la base de datos (invocar al método Traer)
$arrayOvnis = $objOvni->Traer();

//retornar los datos del objeto (invocar al ToJSON). Caso
if($objOvni->Existe($arrayOvnis)){
    echo $objOvni->ToJson();
}else{ // contrario informar: si no coincide el tipo o el planetaOrigen o ambos.
    $coinTipo = false;
    $coinPlaneta=false;
    foreach($arrayOvni as $ovn){
        if($ovn->tipo == $objOvni->tipo){
            $coinTipo=true;
        }
        if($ovn->planetaOrigen == $objOvni->planetaOrigen){
            $planetaComp=true;
        }
    }

    if($coinTipo == false && $coinPlaneta == false)
    {
        echo "No coincide ni tipo ni planeta";
    }else if($coinTipo == true){
       echo "Solo coincide el tipo";
    }else if($coinPlaneta == true){
      echo "Solo coincide el planeta";
    }
}
?>