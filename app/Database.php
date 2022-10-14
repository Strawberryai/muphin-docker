<?php

require('Validador.php');

class Database{

    private static $instance;
    private $hostname = "db";
    private $username = "admin";
    private $password = "test";
    private $db = "database";
    private $conn; 

    private function __construct(){
        // Para evitar inyecciones SQL sería conveniente realizar consultas
        // parametrizadas. No es este caso.
        
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

    public function registrar_usuario($datos){
        // Validamos los datos 
        if(!Validador::val_DNI($datos['DNI'])){
            return "ERROR: el DNI introducido no tiene el formato correcto";
        }

        if(!Validador::val_email($datos['email'])){
            return "ERROR: el email introducido no tiene el formato correcto";
        }

        if(!Validador::val_telf($datos['telf'])){
            return "ERROR: el teléfono introducido no tiene el formato correcto";
        }

        if(!Validador::val_date($datos['date'])){
            return "ERROR: el teléfono introducido no tiene el formato correcto";
        }

        // Comprobar que el nombre de usuario es único
        if(strcmp($datos['username'], "") != 0){
            // El username no es un string vacío
            if($this->existe_nombre_usuario($datos['username'])){
                return "ERROR: el nombre de usuario introducido ya está registrado";
            }
        }else{
            return "ERROR: el nombre de usuario no puede ser una cadena vacía";

        }

        $sql_ins = "INSERT INTO usuarios (username, password, nombre_apellidos, DNI, telf, email, fecha) VALUES ('{$datos['username']}', '{$datos['password']}', '{$datos['nombre_apellidos']}', '{$datos['DNI']}', '{$datos['telf']}', '{$datos['email']}', '{$datos['date']}')";
        $res = $this->send_query_db($sql_ins);
    }

    public function registrar_muffin($datos){
        $sql_ins = "INSERT INTO muffins (titulo, imagen, descripcion, user_prop) VALUES ('{$datos['titulo']}', '{$datos['tipo']}', '{$datos['descripcion']}', '{$datos['user_prop']}')";
        $res = $this->send_query_db($sql_ins);
    }

    public function obtener_muffins(){
        $sql_ins="SELECT * FROM muffins";

        $query = mysqli_query($this->conn, $sql_ins)
            or die (mysqli_error($this->conn));
        return $query;

    }

    public function incrementarLikes($datos){
        $sql_ins= "UPDATE muffins SET likes=likes+1 WHERE id='{$datos["id"]}'";
        $res = $this->send_query_db($sql_ins);
    }

    public function obtener_datos_muffin($datos){
        $sql_ins= "SELECT * FROM muffins WHERE id=$datos";
        $res = $this->send_query_db($sql_ins);
        return $res;
    }

   public function modificar_datos_muffin($datos){
        $sql_params="likes='{$datos['likes']}',imagen='{$datos['imagen']}',titulo='{$datos['titulo']}',descripcion='{$datos['descripcion']}',user_prop='{$datos['user_prop']}'";
        $sql_ins= "UPDATE muffins SET {$sql_params} WHERE id='{$datos['id']}'";
        echo $sql_ins;
        $res = $this->send_query_db($sql_ins);
   }

   public function eliminar_muffin($id){
        $sql_ins= "DELETE FROM muffins WHERE id=$id";
        $res = $this->send_query_db($sql_ins);
   }
    


    

    public function obtener_datos_usuario($user){
        // PRE: El usuario está registrado y loggeado
        // POST: Sus datos personales exceptuando la contraseña actual
        
        $datos = $this->send_query_db("SELECT username, nombre_apellidos, DNI, telf, email, fecha from usuarios WHERE username='{$user}'");
        return $datos;
    }

    private function existe_nombre_usuario($username){
        $res = $this->send_query_db("SELECT * FROM usuarios WHERE username='{$username}'");
        if(isset($res)){
            return true;
        } 

        return false;
    }

    public function eliminar_usuario($user){
        $res = $this->send_query_db("DELETE FROM usuarios WHERE username='{$user}'");

        if(!$res){
            return "ERROR: no se pudo hacer el DELETE de {$user}";
        }
    }

    public function modificar_datos_usuario($user, $datos){
        // PRE: El usuario está registrado y loggeado 
        // y datos: $new_usr, $new_pass, $new_nom_ape, $new_DNI, $new_telf, $new_email
        // POST: Se han modificado los datos del usuario y se devuelve el
        // error

        // Validamos los datos 
        if(!Validador::val_DNI($datos['DNI'])){
            return "ERROR: el DNI introducido no tiene el formato correcto";
        }

        if(!Validador::val_email($datos['email'])){
            return "ERROR: el email introducido no tiene el formato correcto -> {$datos['email']}";
        }

        if(!Validador::val_telf($datos['telf'])){
            return "ERROR: el teléfono introducido no tiene el formato correcto";
        }

        if(!Validador::val_date($datos['date'])){
            return "ERROR: el teléfono introducido no tiene el formato correcto";
        }

        // Comprobar que el nombre de usuario es único
        if(strcmp($datos['username'], "") != 0){
            // El username no es un string vacío
            if(strcmp($user, $datos['username']) != 0 && $this->existe_nombre_usuario($datos['username'])){
                return "ERROR: el nombre de usuario introducido ya está registrado";
            }
        }else{
            return "ERROR: el nombre de usuario no puede ser una cadena vacía";

        }

        $sql_params = "username='{$datos['username']}', DNI='{$datos['DNI']}', telf='{$datos['telf']}', email='{$datos['email']}', fecha='{$datos['date']}'";

        // Si no hemos introducido una contraseña valida, mantenemos la
        // anterior
        if(isset($datos['password']) && strcmp($datos['password'], "") != 0){
            $sql_params = $sql_params . ", password='{$datos['password']}'";
        }

        // Enviamos una instruccion a la base de datos para modificarlos
        $sql_ins = "UPDATE usuarios SET {$sql_params}  WHERE username='{$user}'";
        $res = $this->send_query_db($sql_ins);

        if(!$res){
            return "ERROR: el UPDATE no se pudo realizar";
        }
    }

}

?>
