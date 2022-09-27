const nombre=document.getElementById("nombre")
const contraseña=document.getElementById("contraseña")
const contraseña2=document.getElementById("contraseña2")
const dni=document.getElementById("dni")
const telefono=document.getElementById("telefono")
const fechaNac=document.getElementById("fechaNac")
const email=document.getElementById("email")
const form=document.getElementById("form")
const errorElement=document.getElementById("error")



form.addEventListener("submit",function(e){
    let messages=[]
    if (nombre.value==""||contraseña.value==""||dni.value==""||telefono.value==""||email.value==""||fechaNac.value==""){
        messages.push("No ha rellenado todos los campos")
        window.alert("No ha rellenado todos los campos")
    }

    if(contraseña.value.length<6){
        messages.push("La contraseña debe de ser mayor que 6 carácteres")
        window.alert("La contraseña debe tener mas de 6 carácteres")
    }

    if(contraseña.value!=contraseña2.value){
        messages.push("Las contraseñas no coinciden")
        window.alert("Las contraseñas no coinciden")
    }
    var enc=false;

    if(telefono.value.length!=9){
        messages.push("El telefono debe tener 9 numeros")
        window.alert("El telefono debe tener 9 numeros")
    }
  
    if(dni.value.length!=9){
        messages.push("El dni no es correcto")
        window.alert("El dni no es correcto1")
        

    }
    
    
    else{
        var enc=false;
        var letraDNI = dni.value.substring(8, 9)
        var numDNI = dni.value.substring(0, 8)
        var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T']

        if(numDNI == /\d{8}[a-z A-Z]/){
           
        }
        else if(letraDNI.match(/[A-Z]/i)){
            enc=true 
        }
        

        if(!enc){
            messages.push("El dni no es correcto")
            window.alert("El dni no es correcto2") 
        }
    }
    if(messages.length>0){
        e.preventDefault()
        errorElement.innerText=messages.join(', ')
    }
    else{
        window.alert("Los datos del registro son correctos")
    
        let formulario=new FormData(document.getElementById("form"));
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
        })*/

    }

}) 