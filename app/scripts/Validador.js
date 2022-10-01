class Validador{


    static comprobarDNI(dni){
        window.alert("a")
        if(dni.value.length!=9){
          return false;
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
                window.alert("El dni no es correcto2") 
                return false;
            }
        }
    }

    static comprobarNum(num){
        if((telefono.value.length!=9)||(numDNI == /\d{8}[a-z A-Z]/)){
            window.alert("El telefono debe tener 9 numeros")
            return false;
        }
    
        
    }

}