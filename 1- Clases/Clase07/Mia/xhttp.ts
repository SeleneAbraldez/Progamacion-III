function Login() {
    var correo = (<HTMLInputElement>document.getElementById("correotxt")).value;
    var clave = (<HTMLInputElement>document.getElementById("clavetxt")).value;

    let xhttp: XMLHttpRequest = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var obj = JSON.parse(xhttp.responseText);
            if(obj.existe == true)
            {
                window.location.href = "./index.php";
            }else
            {
                alert("Usuarix no encontrado!");
            }
        }
    };

    xhttp.open("POST", "Test_usuarix.php", true);

    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    xhttp.send('Login={"correo":"' + correo + '","clave":"' + clave + '}');
}

function Register() {
    var nombre = (<HTMLInputElement>document.getElementById("nombretxt")).value
    var apellido = (<HTMLInputElement>document.getElementById("apellidotxt")).value
    var clave = (<HTMLInputElement>document.getElementById("clavetxt")).value
    var perfil = (<HTMLInputElement>document.getElementById("perfiltxt")).value
    var estado = (<HTMLInputElement>document.getElementById("estadotxt")).value
    var correo = (<HTMLInputElement>document.getElementById("correotxt")).value
    let foto : any = (<HTMLInputElement> document.getElementById("fotofile"));

    let xhttp : XMLHttpRequest = new XMLHttpRequest();
    let form : FormData = new FormData();

    form.append('RegistradxDatos','{"nombre":"'+nombre+'","apellido":"'+apellido+'","clave":'+clave+', "perfil":'+perfil+',"estado":'+estado+',"correo":"'+correo+'"}');
    form.append('foto', foto.files[0]);

    xhttp.onreadystatechange = () => 
    {        
        if (xhttp.readyState == 4 && xhttp.status == 200) 
        {
            if(xhttp.responseText)
            {
                alert("Se ha agregado usuarix!");
            }
            else
            {
                alert("ERROR! - El mail ya se encuentra registrado!");
            }

        }
    };

    xhttp.open("POST", "./RegistrarUsuarix.php", true);
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    xhttp.send(form);
}

