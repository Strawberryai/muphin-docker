// Tomamos los elementos del formulario
let user    = document.getElementById('username') 
let nom_ape = document.getElementById('nombre_apellidos') 
let dni     = document.getElementById('DNI') 
let telf    = document.getElementById('telf') 
let email   = document.getElementById('email') 
let date  = document.getElementById('date') 
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
    let server = window.location.href;
    let error=0;
    let data = {};
    let type;


    // Comprobamos el tipo de formulario (log in, register...)
    if(button){
        type = button.name;
    }else{
        console.error("ERROR: el formulario no tiene un tipo")
        return
    }

    data[type] = true

    // Comprobamos los campos y los validamos
    if(user){
        if(user.value==""){
            //si nombre vacio nombre incorrecto
            if(errUser){
                errUser.innerHTML="El usuario no puede estar vacio"
                errUser.style.color="red"
            }
            error=error+1;
        }else{
            data["username"] = user.value
            errUser.innerHTML=""
        } 
    }

    if(nom_ape){
        if(nom_ape && nom_ape.value==""){
            //si nombre y apellidos incorrecto
            if(errNomApe){
                errNomApe.innerHTML="El nombre y apellidos no puede estar vacio"
                errNomApe.style.color="red"//mensaje de error en rojo
            }
            error=error+1;
        }else{
            data["nombre_apellidos"] = nom_ape.value
            if(errNomApe){
                //mensaje de validez en verde
                errNomApe.innerHTML="Nombre y apellidos validos"
                errNomApe.style.color="green"
            }
        }
    }


    if(pass && pass2){
        if(pass.value!=pass2.value || pass.value==""){
            //si las contraseñas no coinciden
            if(errPass && errPass2){
                errorPassword.innerHTML="Las contraseñas no coinciden"
                errorPassword.style.color="red"//mensaje de error en rojo
            }
            error=error+1;
        }else{
            data["password"] = pass.value
            data["password2"] = pass2.value
            if(errPass && errPass2){
                //mensaje de validez en verde
                errorPassword.innerHTML="Contraseña valida"
                errorPassword2.innerHTML="Contraseña valida"
                errorPassword.style.color="green"
                errorPassword2.style.color="green"
            }
        }

    }else if(pass){
        if(pass.value == ""){
            //si la contraseña no tiene al menos 6 caracteres
            if(errPass){
                errorPassword.innerHTML="Introduzca una contraseña"
                errorPassword.style.color="red"//mensaje de error en rojo
                errorPassword2.innerHTML=""
            }
            error=error+1;
        }else{
            data["password"] = pass.value

        }
    }


    if(dni){
        if(!Validador.comprobarDNI(dni)){
            //si el dni no es valido
            if(errDni){
                errDni.innerHTML="El DNI no es valido"
                errDni.style.color="red"//mensaje de error en rojo
            }
            error=error+1;
        }else{
            data["DNI"] = dni.value
            if(errDni){
                //mensaje de validez en verde
                errDni.innerHTML="DNI valido"
                errDni.style.color="green"
            }
        } 
    }

    if(telf){
        if(!Validador.comprobarNum(telf)){
            //si el telefono es valido
            if(errTelf){
                errTelf.innerHTML="El numero de telefono no es valido"
                errTelf.style.color="red"//mensaje de error en rojo
            }
            error=error+1;
        }else {
            data["telf"] = telf.value
            if(errTelf){
                //mensaje de validez en verde
                errTelf.innerHTML="Telefono valido"
                errTelf.style.color="green"
            }
        }
    }

    if(email){
        if(!Validador.comprobarMail(email)){
            //si el mail no es valido
            if(errEmail){
                errEmail.innerHTML="El mail no es valido"
                errEmail.style.color="red"//mensaje de error en rojo
            }
            error=error+1;
        }else{
            data["email"] = email.value
            if(errEmail){
                //mensaje de validez en verde
                errEmail.innerHTML="Mail valido"
                errEmail.style.color="green"
            }
        }
    }

    if(date){
        if(date.value != ""){
            let formattedDate = yyyymmdd(new Date(date.value));
            data["date"] = formattedDate;

        }else{
            if(errDate){
                errDate.innerHTML="Introduce una fecha"
                errDate.style.color="red"//mensaje de error en rojo
            }

        }
    }

    // console.log(data)

    if(error==0){
        //si no hay errores
        send_POST_form(server, data);
    }
}

function send_POST_form(path, params, method='post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less verbose if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}

function yyyymmdd(dateIn) {
    let yyyy = dateIn.getFullYear();
    let mm = dateIn.getMonth() + 1; // getMonth() is zero-based
    let dd = dateIn.getDate();
    return yyyy + "-" + mm + "-" + dd
}
