<?php
require 'data_base.php';
session_start();
?>

<style>
:root{
    --bg-a: #F5F5F5;
    --bg-b: #22262c;
    --bg-c: #171a1e;

    --bg-active: #FFAB00;
    --bg-barhover: #111;
    
    --text-a: #000;
    --text-b: #fff;

    font-family: Arial;
} 

body{
    background: var(--bg-a);
    margin: 0;
}

a{
    text-decoration: none;
}

/* Navbar styles */

#top_bar{
    background: var(--bg-b);
    width: 100%;
    height: min-content;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

.bar_elm{
    float: left;
    padding:1rem 2rem;
}

.bar_elm a{
    color: var(--text-b)
}

.bar_elm:hover:not(.active){
    background: var(--bg-barhover);
}

.active{
    background: var(--bg-active);
}

/* Dropdown menu */
.dropdown {
    float: right;
    overflow: hidden;
}

.dropdown a{
    color: var(--text-b);
}

.dropbtn{
    padding-left: 1.2rem;
}

.dropdown-content {
    visibility: hidden;
    position: absolute;
    background-color: var(--bg-b); 
    color: var(--text-b);
    padding-top: 2rem;
    padding-bottom: 2rem;
    padding-right: 1rem;
    padding-left: 1rem;
    right: 0;
    left: auto;
    top: 3.1rem;
    z-index: 1;
    height: 0;
    transition: height 0.07s ease-out;
    overflow: hidden;
}

.dropdown:hover .dropdown-content{
    visibility: visible;
    height: 75px;
}

#content{
    margin-top: 9rem;
}

</style>
<html>
    <header>

    </header>
    <body>
        <nav id="top_bar">
            <li class="bar_elm active"><a href="#">Inicio</a></li>
            <li class="bar_elm"><a href="#">Catálogo</a></li>
            <li class="bar_elm"><a href="#">Sobre nosotros</a></li>

            <?php if (!isset($_SESSION['user'])) { ?>
            <li class="bar_elm" style="float: right;"><a href='log_in.php'>LOG IN</a></li>

            <?php } else { ?>
                <div class="dropdown">
                    <a class="dropbtn bar_elm">Opciones</a>
                    <div class="dropdown-content">
                        <div>Signed in as</div>
                        <div><?php echo $_SESSION['user'];?></div></br>
                        <a href='perfil.php'>PERFIL</a></br>
                        <a href='log_out.php'>LOG OUT</a>
                    </div>
                </div>
                <?php } ?>
        </nav>

        <div id="content">
            <h1>INICIO</h1>
        </div>

    </body>
</html>
