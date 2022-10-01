let form = document.getElementById('form');

let user_input = form.children.username;
let nomape_input = form.children.nombre_apellidos;
let DNI_input = form.children.DNI;
let telf_input = form.children.telf;
let email_input = form.children.email;
let password_input = form.children.password;
let password2_input = form.children.password2;


let button = form.children.button;

function validar_y_enviar_datos(){
    console.log("PRESSED");
}

/*
button.addEventListener("click",function(e){

    let messages=[]
    if (nombre.value==""||contraseña.value==""||dni.value==""||telefono.value==""||email.value==""||fechaNac.value==""){
        window.alert("No ha rellenado todos los campos")
         
    }

    if(contraseña.value.length<6){
        e.preventDefault()
        window.alert("La contraseña debe tener mas de 6 carácteres")
        
    }
    if(contraseña.value!=contraseña2.value){
        e.preventDefault()
        window.alert("Las contraseñas no coinciden")
       
    }

    if(!Validador.comprobarDNI(dni)){
        e.preventDefault()
        window.alert("El dni esta mal")
       
    }
    if(!Validador.comprobarNum(telefono)){
        e.preventDefault()
        window.alert("el num esta mal")
        
    }
    if(messages.length>0){
        e.preventDefault()
        errorElement.innerText=messages.join(', ')
    }
    else{
        e.preventDefault()
        window.alert("Los datos del registro son correctos")
        
    
        /*let formulario=new FormData(document.getElementById("form"));
        fetch("registro.php",{
            method: "POST",
            body: formulario
     })/*
        .then(res=>res.json())
        .then(data=>{
            if(data=="true"){
                document.getElementById("nombre").value="";
                document.getElementById("contraseña").value="";
                document.getElementById("contraseña2").value="";
                document.getElementById("dni").value="";
                document.getElementById("telefono").value="";
                document.getElementById("fechaNac").value="";
                document.getElementById("email").value="";
                document.getElementById("form").value="";
                document.getElementById("error").value="";
                alert("El usuario se registró");
            }
            else{
                console.log(data);
            }
        })
    }

}) 
*/
