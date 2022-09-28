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
            // PRE: Recibe una cadena de texto
            // POST: Comprueba si es una consulta SQL y la realiza a la base de
            // datos. Si recibe multiples valores (SELECT) devuelve un array.
            // Si no (UPDATE), devuelve un booleano.
            // TODO: Comprobar que la instrucción no es una inyección SQL

            $query = mysqli_query($this->conn, $select_instr)
                or die (mysqli_error($this->conn));

            if(is_bool($query)){
                return $query;
            }

            return mysqli_fetch_array($query);
        }

        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new database();
            }

            return self::$instance;
        }

        public function comprobar_identidad($user, $pass){
            // TODO: Validar datos antes de realizar peticiones
            
            $query = $this->send_query_db("SELECT password FROM usuarios WHERE username='" . $user . "' ");
            $identified = false;

            if(isset($query['password']) and strcmp($pass, $query['password']) == 0){
                $identified = true;
            }

            return $identified;
        }

        public function obtener_datos_usuario($user){
            // PRE: El usuario está registrado y loggeado
            // POST: Sus datos personales exceptuando la contraseña actual
            
            $datos = $this->send_query_db("SELECT username, nombre_apellidos, DNI, telf, email from usuarios WHERE username='{$user}'");
            return $datos;
        }

        public function modificar_datos_usuario($user, $datos){
            // PRE: El usuario está registrado y loggeado 
            // y datos: $new_usr, $new_pass, $new_nom_ape, $new_DNI, $new_telf, $new_email
            // POST: Se han modificado los datos del usuario y se devuelve el
            // error

            // TODO: Validar los datos 
            // (comprobar que el nombre de usuario es único)
            // Si no hemos introducido una contraseña valida, mantenemos la
            // anterior


            // Enviamos una instruccion a la base de datos para modificarlos
            // TODO: Esto se puede mejorar mucho con la validacion: da una
            // respuesta de lo que está mal y modificamos teniendolo en cuenta.
            
            // $sql_ins = "UPDATE usuarios SET username='{$datos['username']}', password='{$datos['password']}', nombre_apellidos='{$datos['nombre_apellidos']}', DNI='{$datos['DNI']}', telf='{$datos['telf']}', email='{$datos['email']}'  WHERE username='{$user}'";

            $sql_ins = "UPDATE usuarios SET username='{$datos['username']}', DNI='{$datos['DNI']}', telf='{$datos['telf']}', email='{$datos['email']}'  WHERE username='{$user}'";

            $this->send_query_db($sql_ins);

            // TODO: devuelve un error si se produce
            return;
        }

    }

?>
