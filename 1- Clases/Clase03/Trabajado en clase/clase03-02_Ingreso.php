<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form align="center" action="clase03-03/Administracion.php/" method="POST" enctype="multipart/form-data">
        <br><br>
        <h3>Ingrese un nuevo producto: </h3>
        <br>Nombre: <input type="text" id="nombre" name="nombre">
        <br><br>Codigo de barra: <input type="text" id="codiBarra" name="codiBarra">
        <br><br>Foto: <input type="file" id="foto" name="foto">
        <br><br>
        <input type="submit" id="submitEnviar" name="submitEnviar" value="Enviar">
        <input type="reset" id="resetLimpiar" name ="resetLimpiar" value="Limpiar">
    </form>     
</body>
</html>