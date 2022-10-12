<?php
session_start();

require('database_muffins.php');
$db = Database::getInstance();

if(!isset($_SESSION['user'])){
    // No estamos loggeados -> volvemos a la página principal
    header("Location:index.php");

}else if(isset($_POST['register_muffin'])){
    //El usuario quiere registrar un muffin
    unset($_POST['register_muffin']);

    $datos['titulo'] = $_POST['titulo'];
    $datos['imagen'] = $_POST['imagen'];
    $datos['desc'] = $_POST['desc'];

    $form = "

    <form action="muffins.php" method="POST">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value=<?php echo "{$datos['titulo']}"; ?>><br>

        <label for="imagen">Imagen:</label><br>
        <input type="image" id="imagen" name="imagen" value=""><br>

        <label for="desc">Descripción:</label><br>
        <input type="text" id="desc" name="desc" value=""><br>

        <input type="submit" name="register" value="Register">
    </form>
    ";
    $error = $db->registrar_muffin($datos);

    if(!isset($error)){
        // Si no hay error modificamos la sesión y volvemos a la página principal
        session_destroy();
        session_start();
        header('Location:index.php');
    }

        // Hacemos algo con el error
    echo $error;


}elseif(isset($_POST['eliminar_muffin'])){
    // Hemos recibido una peticion para eliminar un muffin y se ha confirmado
    // con contraseña (aún no sabemos si es correcta)
    unset($_POST['eliminar_muffin']);
    $identified = $db->comprobar_identidad($_SESSION['user'], $_POST['password']);

    if($identified){
        // Borramos el muffin
        
        $error = $db->eliminar_muffin($_SESSION['muffin']);

        if(!isset($error)){
            session_destroy();
            // TODO: Poner una pantalla de confirmación de borrado
            header("Location:index.php");
        }

        // TODO: Hacemos algo con el error
        return $error;
    }

}elseif(isset($_POST['dar_like_muffin'])){
    unset($_POST['dar_like_muffin']);
        
        $error = $db->dar_like_muffin($_SESSION['muffin']);

        if(!isset($error)){
            session_destroy();
            // TODO: Poner una pantalla de confirmación de borrado
            header("Location:index.php");
        }

        // TODO: Hacemos algo con el error
        return $error;

}elseif(isset($_POST['modificar_muffin'])){
    // Hemos recibido una petición de modificar
    unset($_POST['modificar_muffin']);

    $datos = $_SESSION['datos'];
    unset($_SESSION['datos']);

    // Comprobamos si la contraseña es correcta y modificamos los datos
    if(isset($datos)){
        $identified = $db->comprobar_identidad($_SESSION['user'], $_POST['password']);

        if($identified){
            // datos: $new_titulo, $new_desc
            $error = $db->modificar_datos_muffin($_SESSION['muffin'], $datos);

            if(!isset($error)){
                // Si no hay error modificamos la sesión y volvemos a la página principal
                session_destroy();
                session_start();
                $_SESSION['user'] = $datos['username'];
                
                header("Location:index.php");
            }

            // TODO: hacemos algo con el error
            echo $error;

        }else{
            echo "ERROR: contraseña inválida -- perfil.php";
        }
    }else{
        // Si no hay datos en la petición se ha recargado la página o se ha
        // llegado por error -> Volvemos a la página principal
        header("Location:index.php");
    }

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

    </body>
</html>
<?php } ?>