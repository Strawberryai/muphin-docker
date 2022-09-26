<?php
require 'data_base.php';
session_start();

$log;

if (isset($_SESSION['user'])) {
    $log = "<a href='log_out.php'>LOG OUT</a>";

} else {
    $log = "<a href='log_in.php'>LOG IN</a>";
}
?>

<style>
:root{
    --bg-a: #F5F5F5;
    --bg-b: #333;

    --bg-active: #FFAB00;
    --bg-barhover: #111;
    
    --text-a: #000;
    --text-b: #fff;

    font-family: Arial;
} 

body{
    background: var(--bg-a);
}

a{
    text-decoration: none;
}

#top_bar{
    background: var(--bg-b);
    position: absolute;
    top: 0;
    left: 0;
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

a{
    color: var(--text-b)
}

.bar_elm:hover:not(.active){
    background: var(--bg-barhover);
}

.bar_user{
    float: right;
}

.active{
    background: var(--bg-active);
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
            <li class="bar_elm bar_user">
                    <?php echo $log; ?>
            </li>
        </nav>

        <div id="content">
            <h1>INICIO</h1>
        </div>

    </body>
</html>
