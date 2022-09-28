<?php 
session_start()
?>

<!-- Entrada principal de la página web -->
<!-- Alan García Justel -->

<html>
    <header>
        <!-- Incluimos los estilos necesarios -->
        <link rel="stylesheet" href="/styles/main.css">
        <link rel="stylesheet" href="/styles/nav_bar.css">
    </header>
    <body>
        <!-- Incluimos la barra del menú -->
        <?php require_once("components/nav_bar.php")?>

        <!-- Definimos la estructura de la página principal -->
        <div id="content">
            <h1>INICIO</h1>
        </div>
        
        <!-- Incluimos los scripts necesarios -->
        <script src="/scripts/nav_bar.js"></script>
    </body>
</html>
