<?php
    $titulo = isset($_POST["titulo"])? $_POST["titulo"]:"";
    $imagen = isset($_POST["imagen"])? $_POST["imagen"]:"";
    $desc= isset($_POST["desc"])? $_POST["desc"]:"";
    $likes = isset($_POST["likes"])? $_POST["likes"]:"";
    $user_prop= isset($_POST["user_prop"])? $_POST["user_prop"]:"";

    try{
        $conexion =new mysqli("'localhost;port=8890:80;dbname=database','root',''");
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

        echo json_encode("Conectado correctamente");

    }catch(PDOException $error){    
        echo $error->getMessage();
        die();
}