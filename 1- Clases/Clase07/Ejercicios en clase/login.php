<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script type="text/javascript" src="login.js"></script>
</head>

<body>
    <br><br>
    <table border="0" align="center">
        <tr>
            <td>Correo: </td>
            <td><input type="text" id="correo" name="clavetxt" placeholder="Ingrese su correo..."> </td>
        </tr>
        <tr>
            <td>Clave: </td>
            <td><input type="text" id="clave" name="clavetxt" placeholder="Ingrese su clave..."></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" value="Ingresar" onclick="Login()" ; id="btnAceptar">
                <input type="button" value="Cancelar" id="btnCancelar">
            </td>
        </tr>
    </table><br>
</body>

</html>