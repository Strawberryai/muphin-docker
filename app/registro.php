<?php
$nombre = isset($_POST["nombre"])? $_POST["nombre"]:"";
$contraseña = isset($_POST["contraseña"])? $_POST["contraseña"]:"";
$dni= isset($_POST["dni"])? $_POST["dni"]:"";
$telefono = isset($_POST["telefono"])? $_POST["telefono"]:"";
$fechaNac= isset($_POST["fechaNac"])? $_POST["fechaNac"]:"";
$email = isset($_POST["email"])? $_POST["email"]:"";

try{
    $conexion =new mysqli("'localhost;port=8890:80;dbname=database','root',''");
    $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

    echo json_encode("Conectado correctamente");

}catch(PDOException $error){
    echo $error->getMessage();
    die();
}