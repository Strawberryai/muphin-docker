<?php
session_start();
require('Database.php');
$db = Database::getInstance();
$content = "";

function get_muffin_screen(){
    $muffins=$db->obtener_muffins();

    $content = "
        <form action='catalogo.php' method='POST'>
            <button type='submit' name='añadirmuffin' value='añadir muffin'>
        </form>
    ";

    $list = "";

    foreach($muffins as $muffin){
        $list= "
            <tr>
                <td>
                    <img src='/images/TIPOS/{$muffin['imagen']}' width='300' height='300'>
                </td>
                <td>
                {$muffin['titulo']}
                </td>

                <td>
                {$muffin['descripcion']}
                </td>

                <td>
                {$muffin['user_prop']}
                </td>

                <td>
                {$muffin['likes']}
                <br>
                <button type='button' id='{$muffin['id']}' onclick='incrementarLikes('{$muffin['id']}')'>¡Da like!</button>
                </td>
                <td>
                <button type='button' id='{$muffin['id']}'>Edita tu muffin</button>
                </td>
            </tr>'
        ";

        $list = $list . $muffin_card;
    }
    
    return $list;
}

if(isset($_POST['confirmar-añadirmuffin'])){
    //El usuario quiere registrar un muffin
    unset($_POST['añadirmuffin']);
    $datos['titulo'] = $_POST['titulo'];
    $datos['tipo'] = $_POST['tipo'];
    $datos['descripcion'] = $_POST['descripcion'];
    if(isset($_SESSION['user'])){
        $datos['user_prop']=$_SESSION['user'];
    }
    else{
        $datos['user_prop']='Anonimo';
    }
    
    $error = $db->registrar_muffin($datos);

    $content = "";

    if(!isset($error)){
        // Si no hay error modificamos la sesión y volvemos a la página principal
        header('Location:catalogo.php');
    }
    echo $error;

    // Hacemos algo con el error
}elseif(isset($_POST['añadirmuffin'])){

    // Listado de muffins (pagina inicial)
    $directory = "images/TIPOS";                                       //location of directory with files
    $scanned_directory = array_diff(scandir($directory), array("..", "."));         //removes . and .. files whic$
    $files = array_map("htmlspecialchars",$scanned_directory);

    $options = "";
    foreach ($files as $file){
        $options = $options . "<option value='{$file}'>{$file}</option>";
    } 

    $content = "
        <div id='zona-añadir muffin'>
            <form id='form' action='catalogo.php' method='POST'>
                <div class='form-item'>
                    <label for='titulo'>Titulo:</label>
                    <input type='text' id='titulo' name='titulo' placeholder='Introduzca el titulo de tu muffinn' >
                    
                    <span id='errorTitulo' style='color:red'></span>
                </div>

                <div class='form-item'>
                    <label for='tipo'>Tipo:</label>
                    <select id='tipo' name='tipo'>{$options}</select>
                    <span id='errorTipo' style='color:red'></span>
                </div>

                <div class='form-item'>
                    <label for='descripcion'>Descripción:</label>
                    <input type='text' id='descripcion' name='descripcion' placeholder='Introduzca la descripción' value=''>
                    <span id='errorDescripcion' style='color:red'></span>
                </div>


                <div class='form-item'>
                    <button type='button' id='button' name='confirmar-añadirmuffin' value='Añadir muffin' onclick='validar_y_añadir_muffin()'>Añadir muffin</button>
                </div>
            </form>
        </div>
";

}else{
    // Pagina principal donde se listan los muffins
    $content = get_muffin_screen();
}

?>


<!DOCTYPE html>
<html lang="en">

    <style>
        table, th, td {
        border:1px solid black;
    }
    </style>
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

        <!-- Contenido de la página -->
        <h1>Catálogo de muffins</h1>

        <?php echo $content; ?>

        <script src="scripts/añadirMuffin.js"></script>
        <script src="scripts/nav_bar.js"></script>
        <script src="scripts/forms.js"></script>
        
    </body>
    
</html>
