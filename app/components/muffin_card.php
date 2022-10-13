<?php 
function get_muffin_screen(){
    $db = Database::getInstance();
    $muffins = $db->obtener_muffins();

    $content = "
        <form action='catalogo.php' method='POST'>
            <button type='submit' name='añadirmuffin' value='añadir muffin'>Añadir muffin</button>
        </form>
        <section class='muffin_section'>
    ";

    $list = "";

    foreach($muffins as $muffin){
        $muffin_card= "
            <div class='muffin_card'>
                <div class='muffin_author_section'>
                    <span class='muffin_autor'>{$muffin['user_prop']}</span>
                    <i class='fa-solid fa-gear muffin_settings' onclick='abrirOpciones(". '"' . $muffin['id'] . '"' . ")'></i>
                </div>
                <div class='muffin_img'>
                    <img src='./images/TIPOS/{$muffin['imagen']}' width='250px' height='250px'>
                </div>

                <div class='muffin_end_section'>
                    <div class='muffin_title'>{$muffin['titulo']}</div>

                    <div class='muffin_like_section'>
                        <i id='{$muffin['id']}_button' class='fa-solid fa-heart
                            muffin_heart' onclick='incrementarLikes(". '"' . $muffin['id'] . '"' . ")'></i>
                        <span class='muffin_like_num'>Likes: {$muffin['likes']}</span>
                    </div>
                    <p>{$muffin['descripcion']}</p>

                </div>

            </div>
        ";

        $list = $list . $muffin_card;
    }

    $content = $content . $list . "</section>";
    
    return $content;
}


?>
