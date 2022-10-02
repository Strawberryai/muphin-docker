let form = document.getElementById('form');

let nombre= form.children.username;
let nombre_apellidos = form.children.nombre_apellidos;
let dni = form.children.DNI;
let telefono= form.children.telf;
let email = form.children.email;
let contraseña = form.children.password;
let contraseña2 = form.children.password2;
let errorUsername=form.children.errorUsername;
let errorNombreApellido=form.children.errorNombreApellido;
let errorDni=form.children.errorDni;
let errorTelf=form.children.errorTelf;
let errorMail=form.children.errorMail;
let errorPassword2=form.children.errorPassword2;
let errorPassword=form.children.errorPassword;



let button = form.children.button;

function validar_y_enviar_datos(){
    console.log("PRESSED");
}


form.addEventListener("submit",function(e){
    error=0;

    if (nombre.value==""){//si nombre vacio nombre incorrecto
        errorUsername.innerHTML="El usuario no puede estar vacio"
        errorUsername.style.color="red"
        error=error+1;
    }
    else{//mensaje de validez en verde
        errorUsername.innerHTML="Usuario valido"
        errorUsername.style.color="green"
       
    }
    if(nombre_apellidos.value==""){//si nombre y apellidos incorrecto
        errorNombreApellido.innerHTML="El nombre y apellidos no puede estar vacio"
        errorNombreApellido.style.color="red"//mensaje de error en rojo
        error=error+1;
    }
    else {//mensaje de validez en verde
        errorNombreApellido.innerHTML="Nombre y apellidos validos"
        errorNombreApellido.style.color="green"
    }

    if(contraseña.value!=contraseña2.value){//si las contraseñas no coinciden
        error=error+1;
        errorPassword2.innerHTML="Las contraseñas no coinciden"
        errorPassword.innerHTML="Las contraseñas no coinciden"
        errorPassword.style.color="red"//mensaje de error en rojo
        errorPassword2.style.color="red"
        
    }
    else {//mensaje de validez en verde
        errorPassword.innerHTML="Contraseña valida"
        errorPassword2.innerHTML="Contraseña valida"
        errorPassword.style.color="green"
        errorPassword2.style.color="green"
    }
    if(contraseña.value.length<6){//si la contraseña no tiene al menos 6 caracteres
        error=error+1;
        errorPassword.innerHTML="La contraseña debe tener al menos 6 caracteres"
        errorPassword.style.color="red"//mensaje de error en rojo
        errorPassword2.innerHTML=""
        
    }

    if(!Validador.comprobarDNI(dni)){//si el dni no es valido
        error=error+1;
        errorDni.innerHTML="El DNI no es valido"
        errorDni.style.color="red"//mensaje de error en rojo
        
    }
    else{//mensaje de validez en verde
        errorDni.innerHTML="DNI valido"
        errorDni.style.color="green"
    }
    if(!Validador.comprobarNum(telefono)){//si el telefono es valido
        error=error+1;
        errorTelf.innerHTML="El numero de telefono no es valido"
        errorTelf.style.color="red"//mensaje de error en rojo
    }else{//mensaje de validez en verde
        errorTelf.innerHTML="Telefono valido"
        errorTelf.style.color="green"
    }

    if(!Validador.comprobarMail(email)){//si el mail no es valido
        error=error+1;
        errorMail.innerHTML="El mail no es valido"
        errorMail.style.color="red"//mensaje de error en rojo
    }
    else{//mensaje de validez en verde
        errorMail.innerHTML="Mail valido"
        errorMail.style.color="green"
    }

    if(error>0){//si hay errores
        e.preventDefault()
    }
    else{

    }

}) 

