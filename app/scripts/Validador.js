class Validador{
    //Clase con metodos estaticos usada para metodos de validacion

    static comprobarDNI(dni){
        if(dni.value.length!=9){//si no tiene 9 caracteres error
          return false;
        }

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

        return true;
    }

    static comprobarNum(telf){//comprueba telefono
        if((telf.value.length!=9)){//si no tiene 9 numeros incorrecto
            return false;
        }

        return true;
    }
    
    static comprobarMail(mail){//comprueba si el mail es valido
        console.log(mail);
        var re = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
        if (re.test(mail.value)){
          return (true)//mail valido
        }
          
      return (false)//mail no valido
    }

}
