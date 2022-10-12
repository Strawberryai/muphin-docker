<?php

    require('Validador.php');

    class database_muffins{

        private static $instance;
        private $hostname = "db";
        private $username = "admin";
        private $password = "test";
        private $db = "database_muffins";
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
    
        public function registrar_muffin($datos){
            // Validamos los datos 
            if(!Validador::val_titulo($datos['titulo'])){
                return "ERROR: límite de caracteres sobrepasado";
            }
    
            if(!Validador::val_imagen($datos['imagen'])){
                return "ERROR: no existe esa imagen";
            }
    
            if(!Validador::val_desc($datos['desc'])){
                return "ERROR: límite de caracteres sobrepasado";
            }
    
            // Comprobar que el titulo del muffin es único
            if(strcmp($datos['titulo'], "") != 0){
                // El titulo no es un string vacío
                if(strcmp($user, $datos['titulo']) != 0 && $this->existe_titulo_muffin($datos['titulo'])){
                    return "ERROR: el titulo del muffin introducido ya está registrado";
                }
            }else{
                return "ERROR: el nombre de usuario no puede ser una cadena vacía";
    
            }
    
            $sql_ins = "INSERT INTO muffins (titulo, imagen, desc, likes, user_prop) VALUES ('{$datos['titulo']}', '{$datos['imagen']}', '{$datos['desc']}', 0 , '{$datos_user['username']}')";
            $res = $this->send_query_db($sql_ins);
        }
    
        public function obtener_datos_usuario($user){
            // PRE: El usuario está registrado y loggeado
            // POST: Sus datos personales exceptuando la contraseña actual
            
            $datos = $this->send_query_db("SELECT username from usuarios WHERE username='{$user}'");
            return $datos_user;
        }

        public function obtener_datos_muffin($muffin){
            // PRE: El usuario está registrado y loggeado
            // POST: Sus datos personales exceptuando la contraseña actual
            
            $datos = $this->send_query_db("SELECT titulo, imagen, desc, likes, user_prop from muffins WHERE titulo='{$muffin}'");
            return $datos;
        }

        public function dar_like_muffin($muffin){
            $datos = obtener_datos_muffin($muffin);
            $sql_params = "likes='{$datos['likes']}';
            $sql_paramAct = $sql_params++;
            $sql_ins = "UPDATE muffins SET {$sql_paramAct} WHERE titulo='{$muffin}'";
            $res = $this->send_query_db($sql_ins);
        }
    
        public function eliminar_muffin($muffin){
            $res = $this->send_query_db("DELETE FROM muffins WHERE titulo='{$user}'");
    
            if(!$res){
                return "ERROR: no se pudo hacer el DELETE de {$user}";
            }
        }

        private function existe_titulo_muffin($muffin){
            $res = $this->send_query_db("SELECT * FROM muffins WHERE titulo='{$muffin}'");
            if(isset($res)){
                return true;
            } 
    
            return false;
        }
    
        public function modificar_datos_muffin($muffin, $datos){
            // PRE: El usuario está registrado y loggeado 
            // y datos: $new_titulo, $new_desc
            // POST: Se han modificado los datos del muffin y se devuelve el
            // error
    
            // Validamos los datos 
            if(!Validador::val_titulo($datos['titulo'])){
                return "ERROR: límite de caracteres sobrepasado";
            }
    
            if(!Validador::val_desc($datos['desc'])){
                return "ERROR: límite de caracteres en la descripción";
            }
    
            // Comprobar que el título del muffin es único
            if(strcmp($datos['titulo'], "") != 0){
                // El titulo no es un string vacío
                if(strcmp($user, $datos['titulo']) != 0 && $this->existe_titulo_muffin($datos['titulo'])){
                    return "ERROR: el titulo del muffin introducido ya está registrado";
                }
            }else{
                return "ERROR: el título del usuario no puede ser una cadena vacía";
    
            }
    
            $sql_params = "titulo='{$datos['titulo']}', ='{$datos['desc']}'";
    
            // Enviamos una instruccion a la base de datos para modificarlos
            $sql_ins = "UPDATE muffins SET {$sql_params}  WHERE titulo='{$muffin}'";
            $res = $this->send_query_db($sql_ins);
    
            if(!$res){
                return "ERROR: el UPDATE no se pudo realizar";
            }
        }
    
    }
    
    ?>