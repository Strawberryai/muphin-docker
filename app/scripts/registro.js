
window.onload=function(){
    const nombre=document.getElementById("username")
    const contraseña=document.getElementById("password")
    const contraseña2=document.getElementById("password2")
    const dni=document.getElementById("DNI")
    const nombre_apellidos=document.getElementById("nombre_apellidos")
    const telefono=document.getElementById("telf")
    //const fechaNac=document.getElementById("fechaNac")
    const email=document.getElementById("email")
    let button=document.getElementById("button")
    const errorElement=document.getElementById("error")
    console.log(button)
    buttton.addEventListener("click",function(e){
    
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
            })*/
    
        }
    
    }) 
}

