<?php

    class database{

        private static $instance;
        private $hostname = "db";
        private $username = "admin";
        private $password = "test";
        private $db = "database";
        private $conn; 

        private function __construct(){
            $this->conn = mysqli_connect($this->hostname,$this->username,$this->password,$this->db);

            if ($this->conn->connect_error) {
                die("Database connection failed: " . $this->conn->connect_error);
            }

        }

        private function send_query_db($select_instr){
            $query = mysqli_query($this->conn, $select_instr)
                or die (mysqli_error($this->conn));
            return mysqli_fetch_array($query);
        }

        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new database();
            }

            return self::$instance;
        }

        public function comprobar_identidad($user, $pass){
            $query = $this->send_query_db("SELECT password FROM usuarios WHERE username='" . $user . "' ");
            $identified = false;

            if(strcmp($pass, $query['password']) == 0){
                $identified = true;
            }

            return $identified;
        }

        public function modificar_datos($user, $pass, $new_usr, $new_pass, $new_nom_ape, $new_DNI, $new_telf, $new_email){
            $identified = $this->comprobar_identidad($user, $pass);

            if(!$identified){
                return "ERROR: error en la identificación";
            }

            // Validaríamos los datos

            // Enviaríamos una instruccion a la base de datos para modificar
            // los datos

            
        }

    }

?>
