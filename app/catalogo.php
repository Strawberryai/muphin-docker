<?php
session_start();

require('Database.php');
$db = Database::getInstance();
//if(isset($_SESSION['user'])){
    if(isset($_POST['catalogo'])){
        //El usuario quiere registrar un muffin
        unset($_POST['catalogo']);
        $datos['titulo'] = $_POST['titulo'];
        $datos['tipo'] = $_POST['tipo'];
        $datos['descripcion'] = $_POST['descripcion'];
    

    
        
        $error = $db->registrar_muffin($datos);
    
        if(!isset($error)){
            // Si no hay error modificamos la sesión y volvemos a la página principal
            session_destroy();
            session_start();
            header('Location:index.php');
        }
        else{
            header('Location:index.php');
            echo $error;
        }
    
        // Hacemos algo con el error
    }    

//}
//else{
   // header("Location:log_in.php");
//}

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

        <h1>
        Catálogo de muffins
        <br>
        <table >
            <tr>
                <td>
                    Muffins
                </td>
                <td>
                    Edición
                </td>
            </tr>

            <tr>
                <td>
                    <!--<img src="src/download.jpeg">-->
                </td>
                <td>
                    <button type="button">Edita tu muffin</button>
                </td>
            </tr>
            
            
        </table>

        <div id="zona-añadir muffin">
            <form id="form" action="catalogo.php" method="POST">
                <div class="form-item">
                    <label for="titulo">Tipo:</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Introduzca el titulo de tu muffinn" value=<?php echo "{$datos['username']}"; ?>>
                    <span id="errorTitulo" style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" placeholder="Introduzca el tipo de muffinn" value=<?php echo "{$datos['username']}"; ?>>
                    <span id="errorTipo" style="color:red"></span>
                </div>

                <div class="form-item">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Introduzca la descripción" value="">
                    <span id="errorDescripcion" style="color:red"></span>
                </div>


                <div class="form-item">
                    <button type="button" id="button" name="Añadir muffin" value="Añadir muffin" onclick="validar_y_añadir_muffin()">Añadir muffin</button>
                </div>
            </form>

        </div>

   
          

    </h1>
    <script defer src="scripts/añadirMuffin.js"></script>
    <script defer src="scripts/forms.js"></script>
        
    </body>
    
</html>
