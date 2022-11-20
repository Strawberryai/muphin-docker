<?php 
session_start();
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header('Content-Type: text/html; charset=utf-8');
header("Content-Security-Policy: default-src 'self'; frame-ancestors 'none';font-src fonts.gstatic.com https://ka-f.fontawesome.com 'unsafe-inline'; style-src 'self' fonts.googleapis.com 'unsafe-inline'; script-src 'self' https://kit.fontawesome.com 'unsafe-inline'; connect-src 'self' https://ka-f.fontawesome.com");
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
        <link rel="stylesheet" href="/styles/footer.css?version=0.1">

        <!-- Incluimos unas fuentes online -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

    </head>
    <body>
        <!-- Incluimos la barra del menú -->
        <?php require_once("components/nav_bar.php")?>

        <!-- Definimos la estructura de la página principal -->
        <section id="title">
            <div id="title-container">
                <div id="title-text"><div id="hi">Hi</div> <div id="muf">muffin!</div></div>

                <div id="muffins">
                    <object data="/images/muffin.svg" width="300" height="300"> </object>
                    <p id="res-hi">Hi!</p>
                    <object id="mini-muf" data="/images/muffin.svg" width="50" height="50"> </object>

                </div>
            </div>

        </section>
        <section id="presentacion" class="impar">
            <div class="content flex-desc">
                <img alt="" src="/images/pantalla1.svg">
                <div class="descripcion">
                    <h2>Explora y disfruta nuestro repo de muffins</h2>
                    <div>
                        No seas tímido y adéntrate en nuestra aventura. Descubre todas las posibilidades que engloban las magdalenas: de vainilla, de chocolate, con birutas, con pepitas... ¡Todo es posible!
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="par">
            <div class="content flex-desc flex-reverse">
                <img alt="" src="/images/pantalla2.svg">
                <div class="descripcion">
                    <h2>Comparte o modifica muffins a tu gusto</h2>
                    <div>
                        Puedes tanto crear una nueva tarjeta como modificar las magdalenas ya existentes a tu gusto. ¡Este es un espacio para todos!
                    </div>
                </div>
            </div>
        </section>

        <!-- Incluimos el footer-->
        <?php 
            require("components/footer.php");
            echo get_footer();

        ?>

        
        <!-- Incluimos los scripts necesarios -->
        <script src="/scripts/nav_bar.js"></script>
        <script src="/scripts/main.js"></script>
        <script src="https://kit.fontawesome.com/32457df416.js" crossorigin="anonymous"></script>
    </body>
</html>
