<?php
session_start();
header("X-Frame-Options: DENY");
header('setcookie("sessionid", "QmFieWxvbiA1", ["httponly" => true]);SameSite=Strict');
header('Content-Type: text/html; charset=utf-8');
header("Content-Security-Policy: default-src 'self';frame-ancestors 'none'; font-src fonts.gstatic.com https://ka-f.fontawesome.com 'unsafe-inline'; style-src 'self' fonts.googleapis.com 'unsafe-inline'; script-src 'self' https://kit.fontawesome.com 'unsafe-inline'; connect-src 'self' https://ka-f.fontawesome.com");
require('Logs.php');
require('Database.php');

if (empty($_SESSION['_token'])) {
    if (function_exists('mcrypt_create_iv')) {
      $_SESSION['_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } 
    else {
      $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}

$token = $_SESSION['_token'];
$db = Database::getInstance();

if(isset($_SESSION['user'])){
    if (!empty($_POST['_token'])) {
        if (hash_equals($_SESSION['_token'], $_POST['_token'])) {
            header("Location:index.php"); // Estamos loggeados -> volvemos a la página principal
        } else {
            echo "error  LOGEAR POSIBLE MALICIOSO";
        }
    }

}else if(isset($_POST['register'])){
    unset($_POST['register']);

    // Comprobamos el número de intentos de registro de la ip
    $count = $db->ip_attempt($_SERVER["REMOTE_ADDR"]);
    $blocked = $count > 3;

    $log = new Log("log", "");

    if($blocked){
        $log->insert("Registro fallido {error: Demasiado numero de intentos de register}");
        echo "Demasiados intentos de register. Espere 1 minuto para volver a intentarlo";

    }else{
        if (!empty($_POST['_token'])) {
            if (hash_equals($_SESSION['_token'], $_POST['_token'])) {
                if(strcmp($_POST['password'], $_POST['password2']) == 0){
                    $datos['username'] = $_POST['username'];
                    $datos['password'] = $_POST['password'];
                    $datos['nombre_apellidos'] = $_POST['nombre_apellidos'];
                    $datos['DNI'] = $_POST['DNI'];
                    $datos['telf'] = $_POST['telf'];
                    $datos['email'] = $_POST['email'];
                    $datos['date'] = $_POST['date'];
            
                    $error = $db->registrar_usuario($datos);
            
                    if(!isset($error)){
                        header('Location:log_in.php');
                    }
            
                    // Hacemos algo con el error
                    echo $error;
            
                }else{
                    echo "ERROR: las contraseñas no coinciden";
                }
            } else {
                echo "error  LOGEAR POSIBLE MALICIOSO";
            }

        }
    }
}else{
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'/>
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
            <form id="form" action="register.php" method="POST">
                <div class="form-item">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter username" value=<?php echo "{$datos['username']}"; ?>>
                    <span id=errorUsername style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="nombre_apellidos">Nombre y apellidos:</label>
                    <input type="text" id="nombre_apellidos" name="nombre_apellidos" placeholder="Enter your name and subname" value="">
                    <span id=errorNombreApellido style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="DNI">DNI:</label>
                    <input type="text" id="DNI" name="DNI" placeholder="Enter your DNI" value="">
                    <span id="errorDNI" style="color:red;"></span>
                </div>

                <div class="form-item">
                    <label for="telf">Teléfono:</label>
                    <input type="tel" id="telf" name="telf" placeholder="Enter your telephone number"value="">
                    <span id=errorTelf style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="email">email:</label>
                    <input type="mail" id="email" name="email" placeholder="Enter your email" value="">
                    <span id=errorMail style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="date">Fecha nacimiento:</label>
                    <input type="date" id="date" name="date" placeholder="Enter your birth date" value="">
                    <span id=errorMail style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="password">New password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter a new password" value="">
                    <span id=errorPassword style="color:red"></span>
                </div>
                

                <div class="form-item">
                    <label for="password">Repeat password:</label>
                    <input type="password" id="password2" name="password2" placeholder="Repeat your password" value="">
                    <span id=errorPassword2 style="color:red"></span>
                </div>

                <div class="form-item">
                    <input name="_token" id="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                </div>

                <div class="form-item">
                    <button type="button" id="button" name="register" value="Register" onclick="validar_y_enviar_datos()">Register</button>
                </div>
            </form>

        </div>
        <script defer src="scripts/Validador.js"></script>
        <script defer src="scripts/forms.js"></script>
    </body>
</html>
<?php } ?>

