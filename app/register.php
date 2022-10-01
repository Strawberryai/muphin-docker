<?php
session_start();

require('Database.php');
$db = Database::getInstance();

if(isset($_SESSION['user'])){
    // Estamos loggeados -> volvemos a la página principal
    header("Location:index.php");

}else if(isset($_POST['register'])){
    unset($_POST['register']);

    if(strcmp($_POST['password'], $_POST['password2']) == 0){
        $datos['username'] = $_POST['username'];
        $datos['password'] = $_POST['password'];
        $datos['nombre_apellidos'] = $_POST['nombre_apellidos'];
        $datos['DNI'] = $_POST['DNI'];
        $datos['telf'] = $_POST['telf'];
        $datos['email'] = $_POST['email'];

        $error = $db->registrar_usuario($datos);

        if(!isset($error)){
            header('Location:log_in.php');
        }

        // Hacemos algo con el error
        echo $error;

    }else{
        echo "ERROR: las contraseñas no coinciden";
    }


}else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Muffin</title>
        <link rel="icon" href="/images/muffin.ico">

        <!-- Incluimos los estilos necesarios -->
        <link rel="stylesheet" href="/styles/common.css?version=0.1">
        <link rel="stylesheet" href="/styles/nav_bar.css?version=0.1">

        <!-- Incluimos unas fuentes online -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

    </head>
    <body>
        <!-- Incluimos la barra del menú -->
        <?php require_once("components/nav_bar.php")?>

        <form action="register.php" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value=<?php echo "{$datos['username']}"; ?>><br>

            <label for="nombre_apellidos">Nombre y apellidos:</label><br>
            <input type="text" id="nombre_apellidos" name="nombre_apellidos" value=""><br>

            <label for="DNI">DNI:</label><br>
            <input type="text" id="DNI" name="DNI" value=""><br>

            <label for="telf">Teléfono:</label><br>
            <input type="text" id="telf" name="telf" value=""><br>

            <label for="email">email:</label><br>
            <input type="text" id="email" name="email" value=""><br><br>

            <label for="password">New password:</label><br>
            <input type="password" id="password" name="password" value=""><br><br>
            <label for="password">Repeat password:</label><br>
            <input type="password" id="password2" name="password2" value=""><br><br>

            <input type="submit" name="register" value="Register">
        </form>

    </body>
</html>
<?php } ?>
