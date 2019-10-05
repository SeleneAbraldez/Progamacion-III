<?php
session_start();
if(isset($_SESSION["perfilUsuario"]))
{?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script type="text/javascript" src="ajax.js">

        </script>
    </head>
    <body>
        <form action="">
            <table align="center">
            <?php
            //session_start();
            if($_SESSION["perfilUsuario"] == 1){ 
            ?>
                <tr colspan="2">
                    <td>Show Users</td>
                    <td>
                    <a href="/Clase 06/mostrarUsuariosPDF.php">Continue</a>
                    </td>
                </tr>
            <?php }
            ?>
                <tr>
                    <td>Show products</td>
                    <td>
                    <a href="/Clase 06/mostrarProductosPDF.php">Continue</a>
                    </td>
                </tr>
                <tr>
                    <td>
                    <a href="/Clase 06/closeSession.php">Cerrar Sesion</a>
                    </td>
                </tr>

            </table>
        </form>    
    </body>
    </html>

<?php
}else
{
    header('Location:login.php');
}
?>