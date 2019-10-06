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
            <td>Nombre: </td>
            <td><input type="text" id="nombre" name="nombretxt" placeholder="Ingrese su nombre..."> </td>
        </tr>
        <tr>
            <td>Apellido: </td>
            <td><input type="text" id="apellido" name="apellidotxt" placeholder="Ingrese su apellido..."></td>
        </tr>
        <tr>
            <td>Correo: </td>
            <td><input type="text" id="correo" name="correotxt" placeholder="Ingrese su correo..."> </td>
        </tr>
        <tr>
            <td>Clave: </td>
            <td><input type="text" id="clave" name="clavetxt" placeholder="Ingrese su clave..."></td>
        </tr>
        <tr>
            <td>Perfil: </td>
            <td><input type="text" id="perfil" name="perfiltxt" placeholder="Ingrese su perfil..."> </td>
        </tr>
        <tr>
            <td>Foto: </td>
            <td><input type="file" id="fotofile" style="color:grey" accept="image/*"/> </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" value="Registrar" onclick="Register()" ; id="btnAceptar">
                <input type="reset" value="Cancelar">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                ¿Ya posee cuenta? <a href="login.php">Ingrese al login</a>
            </td>
        </tr>
    </table><br>
</body>

</html>