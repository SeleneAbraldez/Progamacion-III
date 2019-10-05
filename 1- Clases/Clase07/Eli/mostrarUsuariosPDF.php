<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/usuario.php';
require_once __DIR__ . '/mySqlDataAccess.php';
session_start();

if($_SESSION["perfilUsuario"] == 1)
{
    header('content-type:application/pdf');

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                            'pagenumPrefix' => 'Página nro. ',
                            'pagenumSuffix' => ' - ',
                            'nbpgPrefix' => ' de ',
                            'nbpgSuffix' => ' páginas']);//P-> vertical; L-> horizontal


    $user = usuario::GetAllUsers();

    //INICIO TABLA
    $table =    "<table border='1'>
    <tr>
        <td>ID</td>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Perfil</td>
        <td>Estado</td>
        <td>Correo</td>
        <td>Foto</td>
    </tr>";
    //INICIO TABLA

    foreach ($user as $object) 
    {
        $exploded = $object->MostrarDatos();
        $row = explode(" - ", $exploded);
        $table .=   "<tr>
                    <td>".$row[0]."</td>
                    <td>".$row[1]."</td>
                    <td>".$row[2]."</td>
                    <td>".$row[3]."</td>
                    <td>".$row[5]."</td>
                    <td>".$row[6]."</td>
                    <td> <img id='imgFoto' src='".$row[7]."' width='250px' height='250px' /> </td>
                </tr>";
    }
    //CIERRO TABLA
    $table.="</table>";
    //CIERRO TABLA

    $mpdf->WriteHTML("<h3>Listado de usuarios</h3>");
    $mpdf->WriteHTML("<br>");

    $mpdf->WriteHTML($table);


    $mpdf->Output('mi_pdf.pdf', 'I');
}else
{
    header('Location:index.php');
}