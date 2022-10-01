<?php
// Pagina para modificar los datos del usuario
session_start();

require('Database.php');
$db = Database::getInstance();

$form = "";

if(!isset($_SESSION['user'])){
    // No se ha iniciado sesión -> Volvemos a la página principal
    header("Location:index.php");

}elseif(isset($_POST['modificar-confirmado'])){
    // Hemos recibido una petición de modificar y el usuario
    // ha vuelto a introducir la contraseña para confirmar
    unset($_POST['modificar-confirmado']);

    $datos = $_SESSION['datos'];
    unset($_SESSION['datos']);

    // Comprobamos si la contraseña es correcta y modificamos los datos
    if(isset($datos)){
        $identified = $db->comprobar_identidad($_SESSION['user'], $_POST['password']);

        if($identified){
            // datos: $new_usr, $new_pass, $new_nom_ape, $new_DNI, $new_telf, $new_email
            $error = $db->modificar_datos_usuario($_SESSION['user'], $datos);

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


}elseif(isset($_POST['modificar'])){
    // Hemos recibido una peticion para modificar los datos
    unset($_POST['modificar']);
    unset($datos);

    $datos['username'] = $_POST['username'];
    if(strcmp($_POST['password'], $_POST['password2']) == 0){
        $datos['password'] = $_POST['password'];
    }

    $datos['nombre_apellidos'] = $_POST['nombre_apellidos'];
    $datos['DNI'] = $_POST['DNI'];
    $datos['telf'] = $_POST['telf'];
    $datos['email'] = $_POST['email'];

    // Guardamos los datos para recuperarlos en la línea 17
    $_SESSION['datos'] = $datos;

    // Pedimos al usuario que vuelva a ingresar su contraseña
    $form = "
    <form action='perfil.php' method='POST'>
        <label for='password'>Confirma tu contraseña:</label><br>
        <input type='password' id='password' name='password' value=''><br><br>
        <input type='submit' name='modificar-confirmado' value='Submit'>
    </form>";

}elseif(isset($_POST['eliminar-confirmado'])){
    // Hemos recibido una peticion para eliminar el usuario y se ha confirmado
    // con contraseña (aún no sabemos si es correcta)
    unset($_POST['eliminar-confirmado']);
    $identified = $db->comprobar_identidad($_SESSION['user'], $_POST['password']);

    if($identified){
        // Borramos el usuario
        $error = $db->eliminar_usuario($_SESSION['user']);

        if(!isset($error)){
            session_destroy();
            // TODO: Poner una pantalla de confirmación de borrado
            header("Location:index.php");
        }

        // TODO: Hacemos algo con el error
        return $error;
    }

}elseif(isset($_POST['eliminar'])){
    // Le pedimos al usuario que vuelva a introducir la contraseña para
    // confirmar
    unset($_POST['eliminar']);
    $form = "
    <form action='perfil.php' method='POST'>
        <label for='password'>Confirma tu contraseña:</label><br>
        <input type='password' id='password' name='password' value=''><br><br>
        <input type='submit' name='eliminar-confirmado' value='Submit'>
    </form>
    ";
}else{
    // Se ha iniciado sesión pero no se han modificado aún los datos 
    // y no se ha pedido una confirmación al usuario

    // Obtenemos los datos del usuario loggeado
    $datos = $db->obtener_datos_usuario($_SESSION['user']);

    // Enviamos el formulario con los datos a modificar
    $form = "
    <form action='perfil.php' method='POST'>
        <label for='username'>Username:</label><br>
        <input type='text' id='username' name='username' value='{$datos['username']}'><br>

        <label for='nombre_apellidos'>Nombre y apellidos:</label><br>
        <input type='text' id='nombre_apellidos' name='nombre_apellidos' value='{$datos['nombre_apellidos']}'><br>

        <label for='DNI'>DNI:</label><br>
        <input type='text' id='DNI' name='DNI' value='{$datos['DNI']}'><br>

        <label for='telf'>Teléfono:</label><br>
        <input type='text' id='telf' name='telf' value='{$datos['telf']}'><br>

        <label for='email'>email:</label><br>
        <input type='text' id='email' name='email' value='{$datos['email']}'><br><br>

        <label for='password'>New password:</label><br>
        <input type='password' id='password' name='password' value=''><br><br>
        <label for='password'>Repeat password:</label><br>
        <input type='password' id='password2' name='password2' value=''><br><br>

        <input type='submit' name='modificar' value='Submit'>
        <input type='submit' name='eliminar' value='Eliminar'>
    </form>
    ";
?>

<?php } ?>
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

        <?php echo $form;?>
    </body>
</html>
