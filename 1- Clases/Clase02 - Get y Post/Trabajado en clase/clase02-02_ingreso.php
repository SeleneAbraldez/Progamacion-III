<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingreso</title>
</head>
<body>
<form action="clase02-02_request.php" method="GET"> <!-- como se esta pasando por get, va al request y muestra por get, podria mostrar tambien por post -->
    <span>Nombre:</span>
    <input type="text" name="nombretxt" size="10" id="nombre" />
    <br><br>
    <span>Apellido:</span>
    <input type="text" name="apellidotxt" size="9" id="apellido" />
    <br><br>
    <input type="submit" value="Enviar datos" id="datos" />
    <input type="reset" value="Limpiar" id="limpiar" />
    <br>
</form>
</body>
</html>