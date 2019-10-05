"use strict";
function Login() {
    var correo = document.getElementById("correotxt").value;
    var clave = document.getElementById("clavetxt").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var obj = JSON.parse(xhttp.responseText);
            if (obj.existe == true) {
                window.location.href = "./index.php";
            }
            else {
                alert("User not found!");
            }
        }
    };
    xhttp.open("POST", "Test_usuarix.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.send('Login={"correo":"' + correo + '","clave":"' + clave + '}');
}
function Register() {
    var nombre = document.getElementById("nombretxt").value;
    var apellido = document.getElementById("apellidotxt").value;
    var clave = document.getElementById("clavetxt").value;
    var perfil = document.getElementById("perfiltxt").value;
    var estado = document.getElementById("estadotxt").value;
    var correo = document.getElementById("correotxt").value;
    var foto = document.getElementById("fotofile");
    var xhttp = new XMLHttpRequest();
    var form = new FormData();
    form.append('RegistradxDatos', '{"nombre":"' + nombre + '","apellido":"' + apellido + '","clave":' + clave + ', "perfil":' + perfil + ',"estado":' + estado + ',"correo":"' + correo + '"}');
    form.append('foto', foto.files[0]);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText) {
                alert("Se ha agregado usuarix!");
            }
            else {
                alert("ERROR! - El mail ya se encuentra registrado!");
            }
        }
    };
    xhttp.open("POST", "./RegistrarUsuarix.php", true);
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    xhttp.send(form);
}
//# sourceMappingURL=xhttp.js.map