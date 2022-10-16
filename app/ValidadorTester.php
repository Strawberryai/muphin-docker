<?php 
require('Validador.php');

class ValidadorTester{
    // Casos de prueba para el validador

    public function __construct(){
        // $this->val_DNI();
        // $this->val_telf();
        // $this->val_email();
        $this->val_date();
    }

    private function val_DNI(){
        $res = Validador::val_DNI("73442574D") ? "TRUE" : "FALSE"; 
        echo "val_DNI-1: Expected TRUE; Recibed: " . $res . "\n";

        $res = Validador::val_DNI("11111111Z") ? "TRUE" : "FALSE"; 
        echo "val_DNI-2: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_DNI("dasjfhadksjhf") ? "TRUE" : "FALSE"; 
        echo "val_DNI-3: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_DNI("aaaaaaaaa") ? "TRUE" : "FALSE"; 
        echo "val_DNI-4: Expected FALSE; Recibed: " . $res . "\n";
    }

    private function val_telf(){
        $res = Validador::val_telf("111111111") ? "TRUE" : "FALSE"; 
        echo "val_telf-1: Expected TRUE; Recibed: " . $res . "\n";

        $res = Validador::val_telf("1") ? "TRUE" : "FALSE"; 
        echo "val_telf-2: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_telf("11111111a") ? "TRUE" : "FALSE"; 
        echo "val_telf-3: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_telf("aaaaaaaaa") ? "TRUE" : "FALSE"; 
        echo "val_telf-4: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_telf("1111111111") ? "TRUE" : "FALSE"; 
        echo "val_telf-5: Expected FALSE; Recibed: " . $res . "\n";
    }

    private function val_email(){
        $res = Validador::val_email("tes@example.com") ? "TRUE" : "FALSE"; 
        echo "val_email-1: Expected TRUE; Recibed: " . $res . "\n";

        $res = Validador::val_email("1") ? "TRUE" : "FALSE"; 
        echo "val_email-2: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_email("@examil.com") ? "TRUE" : "FALSE"; 
        echo "val_email-3: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_email("asdfda") ? "TRUE" : "FALSE"; 
        echo "val_email-4: Expected FALSE; Recibed: " . $res . "\n";

        $res = Validador::val_email("1.com") ? "TRUE" : "FALSE"; 
        echo "val_email-5: Expected FALSE; Recibed: " . $res . "\n";
    }

    private function val_date(){
        $res = Validador::val_date("2022-10-10") ? "TRUE" : "FALSE"; 
        echo "val_date-1: Expected TRUE; Recibed: " . $res . "</br>";

        $res = Validador::val_date("2022/10/10") ? "TRUE" : "FALSE"; 
        echo "val_date-2: Expected FALSE; Recibed: " . $res . "</br>";

        $res = Validador::val_date("1") ? "TRUE" : "FALSE"; 
        echo "val_date-3: Expected FALSE; Recibed: " . $res . "</br>";

        $res = Validador::val_date("@examil.com") ? "TRUE" : "FALSE"; 
        echo "val_date-4: Expected FALSE; Recibed: " . $res . "</br>";

        $res = Validador::val_date("") ? "TRUE" : "FALSE"; 
        echo "val_date-5: Expected FALSE; Recibed: " . $res . "</br>";

        $res = Validador::val_date("2022/10/10") ? "TRUE" : "FALSE"; 
        echo "val_date-6: Expected FALSE; Recibed: " . $res . "</br>";
    }

}

?>
