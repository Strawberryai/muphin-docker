<?php
// Pagina para modificar los datos del usuario
session_start();

require('Database.php');
$db = Database::getInstance();

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
    $datos['password'] = strcmp($_POST['password'], $_POST['password2']) == 0 ? $_POST['password'] : NULL;
    $datos['nombre_apellidos'] = $_POST['nombre_apellidos'];
    $datos['DNI'] = $_POST['DNI'];
    $datos['telf'] = $_POST['telf'];
    $datos['email'] = $_POST['email'];

    // Guardamos los datos para recuperarlos en la línea 17
    $_SESSION['datos'] = $datos;

    // Pedimos al usuario que vuelva a ingresar su contraseña
?>
    <form action="perfil.php" method="POST">
        <label for="password">Confirma tu contraseña:</label><br>
        <input type="password" id="password" name="password" value=""><br><br>
        <input type="submit" name="modificar-confirmado" value="Submit">
    </form>

<?php
}else{
    // Se ha iniciado sesión pero no se han modificado aún los datos 
    // y no se ha pedido una confirmación al usuario

    // Obtenemos los datos del usuario loggeado
    $datos = $db->obtener_datos_usuario($_SESSION['user']);
    echo "DATOS: ";
    echo "nombre_apellidos: " . $datos['nombre_apellidos'];

    // Enviamos el formulario con los datos a modificar
?>
    <form action="perfil.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value=<?php echo "{$datos['username']}"; ?>><br>

        <!--
            TODO: CUIDADO -> El input text se lleva mal con los espacios del nombre_apellidos
        --> 
        <label for="nombre_apellidos">Nombre y apellidos:</label><br>
        <input type="text" id="nombre_apellidos" name="nombre_apellidos" value=<?php echo "{$datos['nombre_apellidos']}"; ?>><br>

        <label for="DNI">DNI:</label><br>
        <input type="text" id="DNI" name="DNI" value=<?php echo "{$datos['DNI']}"; ?>><br>

        <label for="telf">Teléfono:</label><br>
        <input type="text" id="telf" name="telf" value=<?php echo "{$datos['telf']}"; ?>><br>

        <label for="email">email:</label><br>
        <input type="text" id="email" name="email" value=<?php echo "{$datos['email']}"; ?>><br><br>

        <label for="password">New password:</label><br>
        <input type="password" id="password" name="password" value=""><br><br>
        <label for="password">Repeat password:</label><br>
        <input type="password" id="password2" name="password2" value=""><br><br>

        <input type="submit" name="modificar" value="Submit">
    </form>

<?php } ?>
