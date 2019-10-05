<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script type="text/javascript" src="xhttp.js"></script>
</head>

<body>
    <br><br>
    <table border="0" align="center">
        <tr>
            <td>Correo: </td>
            <td><input type="text" id="correotxt" name="clavetxt" placeholder="Ingrese su correo..."> </td>
        </tr>
        <tr>
            <td>Clave: </td>
            <td><input type="text" id="clavetxt" name="clavetxt" placeholder="Ingrese su clave..."></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" value="Ingresar" onclick="Login()" id="btnAceptar">
                <input type="reset" value="Cancelar" id="btnCancelar">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                ¿Sin cuenta? <a href="registro.php">Registrese</a>
            </td>
        </tr>
    </table><br>
</body>

</html>