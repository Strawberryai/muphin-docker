class Validador{


    static comprobarDNI(dni){
        if(dni.value.length!=9){
          return false;
        }
        else{
            var enc=false;
            var letraDNI = dni.value.substring(8, 9)
            var numDNI = dni.value.substring(0, 8)
            var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T']
            var letraCorrecta=letras[numDNI % 23] 
            if(numDNI == /\d{8}[a-z A-Z]/){}
            else if((letraDNI.match(/[A-Z]/i)&&(letraDNI==letraCorrecta))){
                enc=true 
            }
            
    
            if(!enc){
                window.alert("El dni no es correcto2") 
                return false;
            }
            else {
                return true;
            }
        }
    }

    static comprobarNum(num){
        if((telefono.value.length!=9)||(numDNI == /\d{9}[a-z A-Z]/)){
            
            return false;
        }
        else{
            return true;
        }
    
        
    }
    
    static comprobarMail(mail){
        if (/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(mail))
        {
          return (true)
        }
          alert("You have entered an invalid email address!")
          return (false)
    }

}