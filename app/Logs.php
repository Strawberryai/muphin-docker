<?php
class Log{
    public function __construct($filename){
        $this->path     = "/var/log/muffin/";
        $this->filename = ($filename) ? $filename : "log";
        $this->filepath = $this->path . $this->filename . ".log";
        $this->date     = date("Y-m-d H:i:s");
        $this->ip       = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0;

        if(! file_exists($this->path . $this-> filename . ".log")){
            $file = fopen($this->filepath, "w");
            fclose($file);
        }

    }

    /**
     * Añadir una nueva linea de log al registro
     * @param string $text Texto informativo del log 
     */
    public function insert($text){
        $log    = $this->date . " [ip] " . $this->ip . " [text] " . $text . PHP_EOL;
        $result = (file_put_contents($this->path . $this->filename . ".log", $log, FILE_APPEND)) ? 1 : 0;
         
        return $result;
    }
}
?>
