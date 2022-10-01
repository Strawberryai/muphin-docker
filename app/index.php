<?php 
session_start();
?>

<!-- Entrada principal de la página web -->
<!-- Alan García Justel -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Establecemos el icono y el título de la página -->
        <title>Muffin</title>
        <link rel="icon" href="/images/muffin.ico">

        <!-- Incluimos los estilos necesarios -->
        <link rel="stylesheet" href="/styles/common.css?version=0.1">
        <link rel="stylesheet" href="/styles/main.css?version=0.1">
        <link rel="stylesheet" href="/styles/nav_bar.css?version=0.1">

        <!-- Incluimos unas fuentes online -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

    </head>
    <body>
        <!-- Incluimos la barra del menú -->
        <?php require_once("components/nav_bar.php")?>

        <!-- Definimos la estructura de la página principal -->
        <section id="content">
            <div id="main-space">
                <div id="title"><div id="hi">Hi</div> <div id="muf">muffin!</div></div>
                <div id="muffin">
                    <object data="/images/muffin.svg" width="300" height="300"> </object>
                </div>
            </div>

        </section>
        
        <!-- Incluimos los scripts necesarios -->
        <script src="/scripts/nav_bar.js"></script>
        <script src="/scripts/main.js"></script>
    </body>
</html>
