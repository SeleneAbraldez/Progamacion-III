<?php
    //lama a los archivos del composer
    require_once __DIR__ . '/vendor/autoload.php';

    include_once ("./clases/AccesoDatos - Usuarixs.php");
    include_once ("./clases/usuarix.php");

    header('content-type:application/pdf');

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                            'pagenumPrefix' => 'Página nro. ',
                            'pagenumSuffix' => ' - ',
                            'nbpgPrefix' => ' de ',
                            'nbpgSuffix' => ' páginas']);

    $mpdf->SetHeader('{DATE j-m-Y}||{PAGENO}{nbpg}');
    $mpdf->setFooter('{DATE Y}|Programacón III|{PAGENO}{nbpg}');

    $mpdf->WriteHTML("<br><i><b><u>Lista de Usuarixs:</i></b></u><br><br><br>");

    $usuarixs = usuarix::TraerTodxsUsu();
            $tabla = "<table align='center' border='0' cellspacing='5' style='text-align:center;'><tr><td>ID</td><td>NOMBRE</td><td>APELLIDO</td><td>MAIL</td><td>PERFIL</td><td>ESTADO</td><td>FOTO</td></tr>";
            foreach ($usuarixs as $usuarix) {
                $exploUsu = $usuarix->MostrarDatosUsu();
                $fila = explode(" - ", $exploUsu);
                if($fila[7] == ""){
                    $fila[7] = "No hay foto";
                }else{
                    $fila[7] = "<img src='./fotos/" . $fila[7] . "' width='50px' height='50px'/>";
                }
                $tabla .= "<tr><td>" . $fila[0] . "</td><td>" . $fila[1] . "</td><td>" . $fila[2] .  "</td><td>" . $fila[3] . "</td><td>" . $fila[5] ."</td><td>" . $fila[6] ."</td><td>" . $fila[7] . "</td></tr>";
            }
            $tabla .= "</table>";
    echo $tabla;

    $mpdf->WriteHTML($tabla);

    $mpdf->Output('ListaUsuarixs.pdf', 'I');
?>