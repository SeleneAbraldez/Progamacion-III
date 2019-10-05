<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/producto.php';
require_once __DIR__ . '/mySqlDataAccess.php';


header('content-type:application/pdf');

$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas']);//P-> vertical; L-> horizontal


$producto = producto::GetAllProducts();

//INICIO TABLA
$table =    "<table border='1'>
<tr>
    <td>ID</td>
    <td>Codigo Barra</td>
    <td>Nombre</td>
    <td>Foto</td>
</tr>";
//INICIO TABLA

foreach ($producto as $object) 
{
    $exploded = $object->MostrarDatos();
    $row = explode(" - ", $exploded);
    $table .=   "<tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td> <img id='imgFoto' src='".$row[3]."' width='250px' height='250px' /> </td>
            </tr>";
}
//CIERRO TABLA
$table.="</table>";
//CIERRO TABLA

echo $table;


$mpdf->WriteHTML("<h3>Listado de usuarios</h3>");
$mpdf->WriteHTML("<br>");

$mpdf->WriteHTML($table);


$mpdf->Output('mi_pdf.pdf', 'I');