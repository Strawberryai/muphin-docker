<!-- Definimos la estructura de la barra del menú -->
<!-- Alan García Justel -->
<?php 
    $url = $_SERVER['REQUEST_URI'];
    $is_active;

    if(strcmp($url, "/") == 0 || strcmp($url, "/index.php") == 0){
        $is_active['inicio'] = "active";

    }else if(strcmp($url, "/catalogo.php") == 0){
        $is_active['catalogo'] = "active";

    }else if(strcmp($url, "/about.php") == 0){
        $is_active['about'] = "active";

    }else if(strcmp($url, "/log_in.php") == 0){
        $is_active['log_in'] = "active";

    }else if(strcmp($url, "/register.php") == 0){
        $is_active['register'] = "active";

    }else if(strcmp($url, "/perfil.php") == 0){
        $is_active['options'] = "active";

    }
?>

<nav id="top_bar">
    <li class="bar_elm <?php echo $is_active['inicio']; ?>"><a href="/">Inicio</a></li>
    <li class="bar_elm <?php echo $is_active['catalogo']; ?>"><a href="#">Catálogo</a></li>
    <li class="bar_elm <?php echo $is_active['about']; ?>"><a href="/about.php">Sobre nosotros</a></li>

    <!-- Comprobamos si la sesión se ha iniciado -->
    <?php if (!isset($_SESSION['user'])) { ?>
    <li class="bar_elm <?php echo $is_active['register']; ?>" style="float: right;"><a href='register.php'>Register</a></li>
    <li class="bar_elm <?php echo $is_active['log_in']; ?>" style="float: right;"><a href='log_in.php'>Log in</a></li>

    <!-- Si se ha iniciado "imprimimos" el menú de opciones -->
    <?php } else { ?>
    <div class="dropdown">
        <a id="nav_options" class="dropbtn bar_elm <?php echo $is_active['options']; ?>">Opciones</a>
        <div id="drop_elms" class="dropdown-content dropdown-content-hide">
            <div>Signed in as</div>
            <div><?php echo $_SESSION['user'];?></div></br>
            <a href='perfil.php'>Perfil</a></br>
            <a href='log_out.php'>Log out</a>
        </div>
    </div>
    <?php } ?>
</nav>

