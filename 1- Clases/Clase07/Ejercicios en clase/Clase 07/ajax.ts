function LogIn()
{
    var correo = (<HTMLInputElement>document.getElementById("correo")).value
    var clave = (<HTMLInputElement>document.getElementById("clave")).value
    //CREO EL ARCHIVO XHttp
    let xhttp : XMLHttpRequest = new XMLHttpRequest();

    //ESTABLEZCO EL MANEJADOR DE EVENTOS
    xhttp.onreadystatechange = () => 
    {        
        if (xhttp.readyState == 4 && xhttp.status == 200) 
        {
            var receivedObj = JSON.parse(xhttp.responseText);
            //console.log(receivedObj);
            if(receivedObj.existe == true)
            {
                window.location.href = "./index.php";
            }else
            {
                alert("User not found!");
            }
            
                //window.location.href = "./index.php";
        }
    };

    //ABRO EN MODO POST Y APUNTO AL ARCHIVO PHP
    xhttp.open("POST", "./verifyUser.php", true);

    //AL SER UN METODO POST TENGO QUE PASARLE UN "setRequestHeader"
    xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    //LE PASO LOS VALORES DEL FORM VIA "ID = VALUE"
    xhttp.send('loginData={"correo":"'+correo+'","clave":'+clave+'}');
}

function SingUp()
{
    var nombre = (<HTMLInputElement>document.getElementById("nombre")).value
    var apellido = (<HTMLInputElement>document.getElementById("apellido")).value
    var clave = (<HTMLInputElement>document.getElementById("clave")).value
    var perfil = (<HTMLInputElement>document.getElementById("perfil")).value
    var estado = (<HTMLInputElement>document.getElementById("estado")).value
    var correo = (<HTMLInputElement>document.getElementById("correo")).value

    //RECUPERO LA IMAGEN SELECCIONADA POR EL USUARIO
    let foto : any = (<HTMLInputElement> document.getElementById("foto"));

    //CREO EL ARCHIVO XHttp
    let xhttp : XMLHttpRequest = new XMLHttpRequest();

    let form : FormData = new FormData();

    //AGREGO PARAMETROS AL FORMDATA:
    form.append('loginData','{"nombre":"'+nombre+'","apellido":"'+apellido+'","clave":'+clave+', "perfil":'+perfil+',"estado":'+estado+',"correo":"'+correo+'"}');
    form.append('foto', foto.files[0]);

    //ESTABLEZCO EL MANEJADOR DE EVENTOS
    xhttp.onreadystatechange = () => 
    {        
        if (xhttp.readyState == 4 && xhttp.status == 200) 
        {
            if(xhttp.responseText)
            {
                alert("Added Suscessfully!");
            }
            else
            {
                alert("The mail has already been registered");
            }

        }
    };

    //ABRO EN MODO POST Y APUNTO AL ARCHIVO PHP
    xhttp.open("POST", "./dataBaseSignUp.php", true);

    //AL SER UN METODO POST TENGO QUE PASARLE UN "setRequestHeader"
    //xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    //LE PASO LOS VALORES DEL FORM VIA "ID = VALUE"
    xhttp.send(form);
}

/*function SingUp()
{
    var nombre = (<HTMLInputElement>document.getElementById("nombre")).value
    var apellido = (<HTMLInputElement>document.getElementById("apellido")).value
    var clave = (<HTMLInputElement>document.getElementById("clave")).value
    var perfil = (<HTMLInputElement>document.getElementById("perfil")).value
    var estado = (<HTMLInputElement>document.getElementById("estado")).value
    var correo = (<HTMLInputElement>document.getElementById("correo")).value
    
    //RECUPERO LA IMAGEN SELECCIONADA POR EL USUARIO
    let foto : any = (<HTMLInputElement> document.getElementById("foto"));

    //CREO EL ARCHIVO XHttp
    let xhttp : XMLHttpRequest = new XMLHttpRequest();

    //ESTABLEZCO EL MANEJADOR DE EVENTOS
    xhttp.onreadystatechange = () => 
    {        
        if (xhttp.readyState == 4 && xhttp.status == 200) 
        {
            if(xhttp.responseText)
            {
                alert("Added Suscessfully!");
            }
            else
            {
                alert("The mail has already been registered");
            }

        }
    };

    //ABRO EN MODO POST Y APUNTO AL ARCHIVO PHP
    xhttp.open("POST", "./dataBaseSignUp.php", true);

    //AL SER UN METODO POST TENGO QUE PASARLE UN "setRequestHeader"
    xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    //LE PASO LOS VALORES DEL FORM VIA "ID = VALUE"
    xhttp.send('loginData={"nombre":"'+nombre+'","apellido":"'+apellido+'","clave":'+clave+', "perfil":'+perfil+',"estado":'+estado+',"correo":"'+correo+'"}');
}*/