<?php
require 'data_base.php';
session_start();

if(isset($_SESSION['user'])){
    // ya existe una sesión iniciada
    header('Location:index.php');

}elseif(isset($_POST['login'])){
    // Se ha enviado una petición de log in
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Comprobamos si los datos están en nuestra base de datos
    $db = database::getInstance();
    $identified = $db->comprobar_identidad($user, $pass);

    if($identified){
        // iniciamos la sesión y volvemos a la página principal
        $_SESSION['user'] = $user;
        header('Location:index.php');
    }else{
        // Avisamos de que no se ha podido iniciar la sesión
        echo "No se ha podido iniciar sesión con tus credenciales";
    }
}

?>

<form action="log_in.php" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" value=""><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" value=""><br><br>
    <input type="submit" name="login" value="Submit">
</form>

