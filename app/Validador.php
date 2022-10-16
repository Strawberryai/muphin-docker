<?php
header('Content-Type: text/html; charset=utf-8');

class Validador{
    // Esta clase reune un conjunto de métodos enfocados a comprobar si los
    // formatos de strings son correctos. 
    // NO IDENTIFICA INSTRUCCIONES SQL!!
    // NO REALIZA NINGUNA LLAMADA A LA BASE DE DATOS!!

    public static function val_DNI($DNI){
        // PRE: Un string
        // POST: True si el formato es de DNI y false si no
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $esDNI = strlen($DNI) == 9;
        $esDNI = !is_numeric($DNI[8]);

        $num = 0;

        $i = 0;
        while($i < 8 && $esDNI){
            $a = $DNI[$i];
            $esDNI = is_numeric($a);

            if($esDNI){
                $num += intval($a, 10) * pow(10, 7 - $i);
            }

            $i++;
        }

        $num = $num % 23;
        if($esDNI){
            $esDNI = $DNI[8] == $letras[$num];
        }

        return $esDNI;
    }

    public static function val_telf($telf){
        // PRE: Un string
        // POST: True si el formato es de teléfono y false si no
        $esTelf = strlen($telf) == 9;

        $i = 0;
        while($i < 8 && $esTelf){
            $a = $telf[$i];
            $telf = is_numeric($a);

            $i++;
        }

        return $esTelf;
    }

    public static function val_email($email){
        // PRE: Un string
        // POST: True si el formato es de email y false si no
        
        //$mail=utf8_encode($mail);
        //$sanitized=utf8_decode($mail) ;
        //return filter_var($mail, FILTER_VALIDATE_EMAIL); 
        return(true);
    }

    public static function val_date($date){
        if (DateTime::createFromFormat('Y-m-d', $date) !== false) {
          // it's a date
            return true;
        }

        return false;
    }
}

?>
