class Validador{
    //Clase con metodos estaticos usada para metodos de validacion

    static comprobarDNI(dni){
        if(dni.value.length!=9){//si no tiene 9 caracteres error
          return false;
        }
        else{
            var enc=false;
            var letraDNI = dni.value.substring(8, 9)
            var numDNI = dni.value.substring(0, 8)
            var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T']
            var letraCorrecta=letras[numDNI % 23] //obtenemos la letra correcta adecuada al numero
            if(numDNI == /\d{8}[a-z A-Z]/){}//si los 8 caracteres son numeros
            else if((letraDNI.match(/[A-Z]/i)&&(letraDNI==letraCorrecta))){//si el ultimo es letra y es corrcto
                enc=true //dni valido
            }
            
    
            if(!enc){
                return false;
            }
            else {
                return true;
            }
        }
    }

    static comprobarNum(num){//comprueba telefono
        if((telefono.value.length!=9)){//si no tiene 9 numeros incorrecto
            
            return false;
        }
        else{
            return true;
        }
    
        
    }
    
    static comprobarMail(mail){//comprueba si el mail es valido
        if (/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(mail.value))
        {
          return (true)//mail valido
        }
          
          return (false)//mail no valido
    }

}