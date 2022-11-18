<?php
session_start();
require 'Database.php';
require 'Logs.php';
header('Content-Type: text/html; charset=utf-8');
header("Content-Security-Policy: default-src 'self'; frame-ancestors 'none';font-src fonts.gstatic.com https://ka-f.fontawesome.com 'unsafe-inline'; style-src 'self' fonts.googleapis.com 'unsafe-inline'; script-src 'self' https://kit.fontawesome.com 'unsafe-inline'; connect-src 'self' https://ka-f.fontawesome.com");
session_start();

if (empty($_SESSION['_token'])) {
    if (function_exists('mcrypt_create_iv')) {
      $_SESSION['_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } 
    else {
      $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}

$token = $_SESSION['_token'];

if(isset($_SESSION['user'])){
    if (!empty($_POST['_token'])) {
        if (hash_equals($_SESSION['_token'], $_POST['_token'])) {
            header('Location:index.php');// ya existe una sesión iniciada
        } else {
            echo "error  LOGEAR POSIBLE MALICIOSO";
        }
    }
}elseif(isset($_POST['login'])){
    if (!empty($_POST['_token'])) {
        if (hash_equals($_SESSION['_token'], $_POST['_token'])) {
            // Procesar el formulario
            // Comprobamos el número de intentos de login de la ip
            $user = $_POST['username'];

            // Comprobamos si los datos están en nuestra base de datos
            $db = Database::getInstance();
            $count = $db->ip_attempt($_SERVER["REMOTE_ADDR"]);
            $blocked = $count > 3;
            $blocked_mgs = $blocked ? "True" : "False";

            // Loggeamos el intento de inicio de sesión
            $log = new Log("log", "");
            $log->insert("Intento de login {attempt: $count, blocked: $blocked_mgs, user: $user}");

            //si tenemos más de 3 intentos en menos de 1 minuto no realizamos el login
            if($blocked){
                echo "Demasiados intentos fallidos. Espere 1 minuto para volver a intentarlo";

            }else{
                // Comprobamos si los datos están en nuestra base de datos
                $identified = $db->comprobar_identidad($user, $_POST['password']);

                if($identified){
                    // loggeamos el inicio de sesión
                    $log->insert("Login exitoso {user: $user}");

                    // iniciamos la sesión y volvemos a la página principal
                    $_SESSION['user'] = $user;

                    header('Location:index.php');
                }else{
                    // Avisamos de que no se ha podido iniciar la sesión
                    echo "No se ha podido iniciar sesión con tus credenciales";
                }
            }

        }else {
            // Posible petición malintencionada
            // Se recomienda guardar este acceso en un log
        }
    }else{
        echo "token no generado";
    }
    // Se ha enviado una petición de log in
    
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
            <form id="form" action="log_in.php" method="POST">
                <div class="form-item">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" value="">
                    <span id=errorUsername style="color:red"></span>
                </div>
                <div class="form-item">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" value="">
                    <span id=errorPassword style="color:red"></span>
                </div>
                <div class="form-item">
                    <input name="_token" id="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                </div>
               

                <div class="form-item">
                    <button type="button" id="button" name="login" onclick="validar_y_enviar_datos()">Log in</button>
                </div>
                
                

            </form>
        </div>

        <script src="scripts/forms.js"></script>
    </body>
</html>

