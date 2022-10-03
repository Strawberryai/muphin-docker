<?php
require 'Database.php';
session_start();

if(isset($_SESSION['user'])){
    // ya existe una sesión iniciada
    header('Location:index.php');

}elseif(isset($_POST['login'])){
    // Se ha enviado una petición de log in
    $user = $_POST['username'];

    // Comprobamos si los datos están en nuestra base de datos
    $db = Database::getInstance();
    $identified = $db->comprobar_identidad($user, $_POST['password']);

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

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Muffin</title>
        <link rel="icon" href="/images/muffin.ico">

        <!-- Incluimos los estilos necesarios -->
        <link rel="stylesheet" href="/styles/common.css?version=0.1">
        <link rel="stylesheet" href="/styles/nav_bar.css?version=0.1">
        <link rel="stylesheet" href="/styles/form.css?version=0.1">

        <!-- Incluimos unas fuentes online -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

    </head>
    <body>
        <!-- Incluimos la barra del menú -->
        <?php require_once("components/nav_bar.php")?>

        <div id="zona-registro">
            <form action="log_in.php" method="POST">
                <div class="form-item">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" value="">
                </div>
                <div class="form-item">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" value="">
                </div>
                <div class="form-item">
                    <button type="submit" name="login" value="Submit">Log in</button>
                </div>
            </form>
        </div>

    </body>
</html>

