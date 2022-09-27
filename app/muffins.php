<?php

    class database{

        private static $instance;
        private $hostname = "db";
        private $id = "1";
        private $imagen = "http://bitly.ws/uFqY";
        private $titulo = "muffinTest";
        private $desc = "esto es una descripción";
        private $likes = "0";
        private $user_prop = "Mikel001";
        private $db = "database";
        private $conn; 

        private function __construct(){
            $this->conn = mysqli_connect($this->hostname,$this->id,$this->imagen,$this->titulo,$this->desc, $this->likes,$this->user_prop);

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

        public function modificar_datos( $id, $new_img, $new_title, $new_desc){
            $query = $this->send_query_db(" UPDATE catalogo_muffins SET titulo='" . $new_title . "' , imagen='" . $new_img . "', desc='" . $new_desc . "' WHERE id= $id");
        }

        public function dar_like( $id, $new_likes){
            $query = $this->send_query_db(" UPDATE catalogo_muffins SET likes='" . $new_likes . "' WHERE id= $id");
        }

    }

?>