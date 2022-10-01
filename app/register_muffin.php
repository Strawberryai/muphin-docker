<?php
session_start();

require('database_muffins.php');
$db = Database::getInstance();

if(isset($_SESSION['user'])){
    // Estamos loggeados -> volvemos a la página principal
    header("Location:index.php");

}else if(isset($_POST['register'])){
    unset($_POST['register']);

    $datos['titulo'] = $_POST['titulo'];
    $datos['imagen'] = $_POST['imagen'];
    $datos['desc'] = $_POST['desc'];

    $error = $db->registrar_muffin($datos);

    if(!isset($error)){
        header('Location:log_in.php');
    }

        // Hacemos algo con el error
    echo $error;


}else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>

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

        <form action="register_muffin.php" method="POST">
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" value=<?php echo "{$datos['titulo']}"; ?>><br>

            <label for="imagen">Imagen:</label><br>
            <input type="image" id="imagen" name="imagen" value=""><br>

            <label for="desc">Descripción:</label><br>
            <input type="text" id="desc" name="desc" value=""><br>

            <input type="submit" name="register" value="Register">
        </form>

    </body>
</html>
<?php } ?>