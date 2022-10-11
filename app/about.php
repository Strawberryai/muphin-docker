<?php 
session_start();
?>

<!-- About de nuestra página web -->
<!-- Alan García Justel -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Establecemos el icono y el título de la página -->
        <title>Muffin</title>
        <link rel="icon" href="/images/muffin.ico">

        <!-- Incluimos los estilos necesarios -->
        <link rel="stylesheet" href="/styles/common.css?version=0.1">
        <link rel="stylesheet" href="/styles/about.css?version=0.1">
        <link rel="stylesheet" href="/styles/nav_bar.css?version=0.1">

        <!-- Incluimos unas fuentes online -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

    </head>
    <body>
        <!-- Incluimos la barra del menú -->
        <?php require_once("components/nav_bar.php")?>

        <!-- Definimos la estructura de la página -->
        <section class="flex-container">

            <!-- Tarjeta usuario 1 -->
            <div class="tarjeta flex-vertical">
                <div class="profile">
                    <div class="image-cropper">
                        <img class="img" src="/images/developers/user-test.svg"></img>
                    </div>
                    <div class="name">Alan García</div>
                </div>

                <div class="info">
                    <div class="title">Información</div>
                    <div class="description">
                    Estudiante del grado de Ingeniería Informática de Gestión y Sistemas de Información de la EHU.
                    </div>
                </div>
            </div>

            <!-- Tarjeta usuario 2 -->
            <div class="tarjeta flex-vertical">
                <div class="profile">
                    <div class="image-cropper">
                        <img class="img" src="/images/developers/user-test.svg"></img>
                    </div>
                    <div class="name">Álvaro Díez</div>
                </div>

                <div class="info">
                    <div class="title">Información</div>
                    <div class="description">
                    Estudiante del grado de Ingeniería Informática de Gestión y Sistemas de Información de la EHU.
                    </div>
                </div>
            </div>

            <!-- Tarjeta usuario 3 -->
            <div class="tarjeta flex-vertical">
                <div class="profile">
                    <div class="image-cropper">
                        <img class="img" src="/images/developers/user-test.svg"></img>
                    </div>
                    <div class="name">Adrián López</div>
                </div>

                <div class="info">
                    <div class="title">Información</div>
                    <div class="description">
                    Estudiante del grado de Ingeniería Informática de Gestión y Sistemas de Información de la EHU.
                    </div>
                </div>
            </div>
        </section>

        <section class="documentacion">
            <h1>Documentación del proyecto</h1>
            <p>La documentacion del proyecto la puedes encontrar en <a href="https://github.com/Strawberryai/muphin-docker" target="_blank">nuestro repositorio</a> de GitHub</p>
        </section>

        <!-- Incluimos los scripts necesarios -->
        <script src="/scripts/nav_bar.js"></script>
    </body>
</html>
