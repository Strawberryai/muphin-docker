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

    if (nombre.value==""||contraseña.value==""||dni.value==""||telefono.value==""||email.value==""/*||fechaNac.value==""*/){
        window.alert("No ha rellenado todos los campos")
        error=error+1;
    }

    if(contraseña.value.length<6){
        error=error+1;
        errorPassword.innerHTML="La contraseña debe tener al menos 6 caracteres"
        
    }
    if(contraseña.value!=contraseña2.value){
        error=error+1;
        errorPassword2.innerHTML="Las contraseñas no coinciden"
        
    }

    if(!Validador.comprobarDNI(dni)){
        error=error+1;
        errorDni.innerHTML="El DNI es incorrecto"
        
    }
    if(!Validador.comprobarNum(telefono)){
        error=error+1;
        errorTelf.innerHTML="El numero de telefono es incorrecto"
        
    }

    if(Validador.comprobarMail(email.value)){
        errorMail.innerHTML="El mail es incorrecto"
    }

    if(error>0){
        e.preventDefault()
    }

}) 

