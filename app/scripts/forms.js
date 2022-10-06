// Tomamos los elementos del formulario
let user    = document.getElementById('username') 
let nom_ape = document.getElementById('nombre_apellidos') 
let dni     = document.getElementById('DNI') 
let telf    = document.getElementById('telf') 
let email   = document.getElementById('email') 
let pass    = document.getElementById('password') 
let pass2   = document.getElementById('password2') 
let button  = document.getElementById('button') 

// Tomamos los elementos de output para los errores
let errUser     = document.getElementById('errorUsername') 
let errNomApe   = document.getElementById('errorNombreApellido') 
let errDni      = document.getElementById('errorDNI') 
let errTelf     = document.getElementById('errorTelf') 
let errEmail    = document.getElementById('errorMail') 
let errPass     = document.getElementById('errorPassword') 
let errPass2    = document.getElementById('errorPassword2') 

function validar_y_enviar_datos(){
    let data = {};
    let server = window.location.href;

    // Comprobamos los campos y los validamos
    let error=0;

    if(user && user.value==""){
        //si nombre vacio nombre incorrecto
        if(errUser){
            errUser.innerHTML="El usuario no puede estar vacio"
            errUser.style.color="red"
        }
        error=error+1;
    }else{
        data += {"username" :user}
        if(errUser){
            //mensaje de validez en verde
            errUser.innerHTML="Usuario valido"
            errUser.style.color="green"
        }
    } 

    if(nom_ape && nom_ape.value==""){
        //si nombre y apellidos incorrecto
        if(errNomApe){
            errNomApe.innerHTML="El nombre y apellidos no puede estar vacio"
            errNomApe.style.color="red"//mensaje de error en rojo
        }
        error=error+1;
    }else{
        data += {"nombre_apellidos" : nom_ape}
        if(errNomApe){
            //mensaje de validez en verde
            errNomApe.innerHTML="Nombre y apellidos validos"
            errNomApe.style.color="green"
        }
    }


    if(pass && pass.value.length < 6){
        //si la contraseña no tiene al menos 6 caracteres
        if(errPass){
            errorPassword.innerHTML="La contraseña debe tener al menos 6 caracteres"
            errorPassword.style.color="red"//mensaje de error en rojo
            errorPassword2.innerHTML=""
        }
        error=error+1;
    }

    if(pass && pass2 && pass.value!=pass2.value){
        //si las contraseñas no coinciden
        if(errPass && errPass2){
            errorPassword2.innerHTML="Las contraseñas no coinciden"
            errorPassword.innerHTML="Las contraseñas no coinciden"
            errorPassword.style.color="red"//mensaje de error en rojo
            errorPassword2.style.color="red"
        }
        error=error+1;
    }else{
        data += {"password" : pass, "password2" : pass2}
        if(errPass && errPass2){
            //mensaje de validez en verde
            errorPassword.innerHTML="Contraseña valida"
            errorPassword2.innerHTML="Contraseña valida"
            errorPassword.style.color="green"
            errorPassword2.style.color="green"
        }
    }

    if(dni && !Validador.comprobarDNI(dni)){
        //si el dni no es valido
        if(errDni){
            errDni.innerHTML="El DNI no es valido"
            errDni.style.color="red"//mensaje de error en rojo
        }
        error=error+1;
    }else{
        data += {"DNI": dni}
        if(errDni){
            //mensaje de validez en verde
            errDni.innerHTML="DNI valido"
            errDni.style.color="green"
        }
    } 

    if(telf && !Validador.comprobarNum(telf)){
        //si el telefono es valido
        if(errTelf){
            errTelf.innerHTML="El numero de telefono no es valido"
            errTelf.style.color="red"//mensaje de error en rojo
        }
        error=error+1;
    }else {
        data += {"telf": telf}
        if(errTelf){
            //mensaje de validez en verde
            errTelf.innerHTML="Telefono valido"
            errTelf.style.color="green"
        }

    }

    if(email && !Validador.comprobarMail(email)){
        //si el mail no es valido
        if(errEmail){
            errEmail.innerHTML="El mail no es valido"
            errEmail.style.color="red"//mensaje de error en rojo
        }
        error=error+1;
    }else{
        data += {"mail": email}
        if(errEmail){
            //mensaje de validez en verde
            errEmail.innerHTML="Mail valido"
            errEmail.style.color="green"
        }
    }

    // if(error==0){
    //     //si no hay errores
    //     send_POST_form(server, data);
    // }
    console.log(data)
}

function send_POST_form(server, data){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", server);

    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = () => console.log(xhr.responseText);

    // let data = `{
    //   "Id": 78912,
    //   "Customer": "Jason Sweet",
    // }`;
    xhr.send(data);
}
