<!-- Definimos la estructura de la barra del menú -->
<!-- Alan García Justel -->
<nav id="top_bar">
    <li class="bar_elm active"><a href="#">Inicio</a></li>
    <li class="bar_elm"><a href="#">Catálogo</a></li>
    <li class="bar_elm"><a href="#">Sobre nosotros</a></li>

    <!-- Comprobamos si la sesión se ha iniciado -->
    <?php if (!isset($_SESSION['user'])) { ?>
    <li class="bar_elm" style="float: right;"><a href='log_in.php'>LOG IN</a></li>

    <!-- Si se ha iniciado "imprimimos" el menú de opciones -->
    <?php } else { ?>
    <div class="dropdown">
        <a id="nav_options" class="dropbtn bar_elm">Opciones</a>
        <div id="drop_elms" class="dropdown-content dropdown-content-hide">
            <div>Signed in as</div>
            <div><?php echo $_SESSION['user'];?></div></br>
            <a href='perfil.php'>PERFIL</a></br>
            <a href='log_out.php'>LOG OUT</a>
        </div>
    </div>
    <?php } ?>
</nav>

